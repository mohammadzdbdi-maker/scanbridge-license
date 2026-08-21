<?php
$root = __DIR__;

function scb_flexible_pattern(string $old): string
{
    $escaped = preg_quote($old, '/');
    $escaped = preg_replace('/\n{2,}/', '\n\n*', $escaped);
    return '/' . $escaped . '/u';
}

function scb_patch(string $path, array $replacements): void
{
    if (!is_file($path)) {
        fwrite(STDERR, "❌ فایل پیدا نشد: {$path}\n");
        exit(1);
    }
    $content = file_get_contents($path);
    $original = $content;

    foreach ($replacements as $i => [$old, $new]) {
        $pattern = scb_flexible_pattern($old);
        $count = preg_match_all($pattern, $content);
        if ($count !== 1) {
            fwrite(STDERR, "❌ در {$path}، تکه‌ی شماره‌ی " . ($i + 1) . " دقیقاً یک‌بار پیدا نشد (پیدا شد: {$count} بار). هیچ تغییری روی این فایل اعمال نشد.\n");
            exit(1);
        }
        $content = preg_replace_callback($pattern, function () use ($new) {
            return $new;
        }, $content, 1);
    }

    if ($content === $original) {
        echo "⚠️  {$path}: هیچ تغییری لازم نبود (شاید قبلاً patch شده).\n";
        return;
    }

    $backup = $path . '.bak-support-' . date('Ymd-His');
    copy($path, $backup);
    file_put_contents($path, $content);
    echo "✅ {$path} patch شد (نسخه‌ی قبلی: {$backup})\n";
}

scb_patch($root . '/routes/web.php', [
    [
        <<<'OLD1'
    $deviceRows = DB::table('scanbridge_plan_device_pricing')->get();
    $deviceData = [];
    foreach ($deviceRows as $row) {
        $deviceData[$row->plan] = [
            'base_devices' => (int) $row->base_devices,
            'price_per_extra_device' => (int) $row->price_per_extra_device,
        ];
    }

    return view('site.panel.dashboard', compact('customer', 'licenses', 'requests', 'pricingData', 'deviceData'));
});
OLD1,
        <<<'NEW1'
    $deviceRows = DB::table('scanbridge_plan_device_pricing')->get();
    $deviceData = [];
    foreach ($deviceRows as $row) {
        $deviceData[$row->plan] = [
            'base_devices' => (int) $row->base_devices,
            'price_per_extra_device' => (int) $row->price_per_extra_device,
        ];
    }

    $supportTickets = DB::table('scanbridge_support_tickets')
        ->where('customer_id', $customer->id)
        ->orderByDesc('id')
        ->get();

    return view('site.panel.dashboard', compact('customer', 'licenses', 'requests', 'pricingData', 'deviceData', 'supportTickets'));
});
NEW1,
    ],
    [
        <<<'OLD2'
    return redirect('/panel')->with('ok', 'درخواست شما با موفقیت ثبت شد.');
});
// SCANBRIDGE_CUSTOMER_PANEL_END
OLD2,
        <<<'NEW2'
    return redirect('/panel')->with('ok', 'درخواست شما با موفقیت ثبت شد.');
});

Route::post('/panel/support', function (Request $request) use ($requireCustomer) {
    if ($redirect = $requireCustomer($request)) {
        return $redirect;
    }
    $customer = DB::table('scanbridge_customers')->where('id', $request->session()->get('scanbridge_customer_id'))->first();

    $data = $request->validate([
        'log_file' => 'required|file|max:5120|mimes:txt,log',
        'license_id' => 'nullable|integer',
        'note' => 'nullable|string|max:2000',
    ]);

    $ownedLicenses = DB::table('scanbridge_licenses')
        ->where('customer_id', $customer->id)
        ->orWhere('pharmacy_name', $customer->name)
        ->pluck('id');

    $licenseId = null;
    if (!empty($data['license_id']) && $ownedLicenses->contains((int) $data['license_id'])) {
        $licenseId = (int) $data['license_id'];
    } elseif ($ownedLicenses->count() === 1) {
        $licenseId = $ownedLicenses->first();
    }

    $file = $request->file('log_file');
    $storedName = 'ticket-' . time() . '-' . bin2hex(random_bytes(8)) . '.' . strtolower($file->getClientOriginalExtension());
    $file->storeAs('support-logs', $storedName);

    DB::table('scanbridge_support_tickets')->insert([
        'customer_id' => $customer->id,
        'license_id' => $licenseId,
        'original_filename' => $file->getClientOriginalName(),
        'stored_path' => 'support-logs/' . $storedName,
        'customer_note' => $data['note'] ?? null,
        'status' => 'new',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect('/panel')->with('ok', 'فایل گزارش با موفقیت ارسال شد. پاسخ پشتیبانی به‌زودی همین‌جا (بخش پشتیبانی) و توی «پیام‌ها»ی نرم‌افزار نمایش داده می‌شود.');
});
// SCANBRIDGE_CUSTOMER_PANEL_END
NEW2,
    ],
]);

scb_patch($root . '/routes/api.php', [
    [
        <<<'OLD3'
    DB::table('scanbridge_activations')->where('id', $activation->id)->update([
        'last_seen_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json(scb_license_response($license, $data['device_id']));
});
OLD3,
        <<<'NEW3'
    DB::table('scanbridge_activations')->where('id', $activation->id)->update([
        'last_seen_at' => now(),
        'updated_at' => now(),
    ]);

    $responseData = scb_license_response($license, $data['device_id']);

    $pendingMessages = DB::table('scanbridge_support_tickets')
        ->where('license_id', $license->id)
        ->whereNotNull('admin_reply')
        ->whereNull('delivered_to_app_at')
        ->orderBy('replied_at')
        ->get();

    if ($pendingMessages->count() > 0) {
        $responseData['support_messages'] = $pendingMessages->map(function ($ticket) {
            return [
                'id' => $ticket->id,
                'title' => 'پاسخ پشتیبانی اسکن‌بریج',
                'body' => $ticket->admin_reply,
            ];
        })->values();

        DB::table('scanbridge_support_tickets')
            ->whereIn('id', $pendingMessages->pluck('id'))
            ->update(['delivered_to_app_at' => now()]);
    }

    return response()->json($responseData);
});
NEW3,
    ],
]);

scb_patch($root . '/resources/views/site/panel/dashboard.blade.php', [
    [
        <<<'OLD4'
                document.getElementById('panelPlan').addEventListener('change', updatePanelPrice);
                document.getElementById('panelDuration').addEventListener('change', updatePanelPrice);
                document.getElementById('panelDevices').addEventListener('input', updatePanelPrice);
                updatePanelPrice();
            })();
            </script>
        </div>

    </div>

@include('partials.site-footer')
OLD4,
        <<<'NEW4'
                document.getElementById('panelPlan').addEventListener('change', updatePanelPrice);
                document.getElementById('panelDuration').addEventListener('change', updatePanelPrice);
                document.getElementById('panelDevices').addEventListener('input', updatePanelPrice);
                updatePanelPrice();
            })();
            </script>
        </div>

        <div class="section-title">پشتیبانی</div>
        <div class="card scb-reveal">
            <form method="POST" action="/panel/support" enctype="multipart/form-data" style="margin-bottom:20px;">
                @csrf
                <label>فایل گزارش تشخیصی (از نرم‌افزار: دکمه‌ی «ساخت گزارش تشخیصی برای پشتیبانی»)</label>
                <input type="file" name="log_file" accept=".txt,.log" required>
                @if ($licenses->count() > 1)
                <label>مربوط به کدام لایسنس؟</label>
                <select name="license_id">
                    @foreach ($licenses as $lic)
                    <option value="{{ $lic->id }}">{{ $lic->license_key }} ({{ $lic->plan }})</option>
                    @endforeach
                </select>
                @endif
                <label>توضیح (اختیاری)</label>
                <textarea name="note" placeholder="مشکل رو کوتاه توضیح بدید..."></textarea>
                <button type="submit" class="btn">ارسال به پشتیبانی</button>
            </form>
            @if ($supportTickets->count() === 0)
                <div class="empty">هنوز گزارشی ارسال نکرده‌اید.</div>
            @else
                <table>
                    <tr><th>فایل</th><th>وضعیت</th><th>پاسخ پشتیبانی</th><th>تاریخ</th></tr>
                    @foreach ($supportTickets as $ticket)
                    <tr>
                        <td>{{ $ticket->original_filename }}</td>
                        <td>
                            @php
                                $tStatusLabels = ['new' => 'در حال بررسی', 'answered' => 'پاسخ داده شد', 'closed' => 'بسته شد'];
                                $tStatusClass = ['new' => 'badge-new', 'answered' => 'badge-done', 'closed' => 'badge-ignored'];
                            @endphp
                            <span class="badge {{ $tStatusClass[$ticket->status] ?? 'badge-new' }}">{{ $tStatusLabels[$ticket->status] ?? $ticket->status }}</span>
                        </td>
                        <td>{{ $ticket->admin_reply ?: '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($ticket->created_at)->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                </table>
            @endif
        </div>

    </div>

@include('partials.site-footer')
NEW4,
    ],
]);

echo "\nتمام.\n";
