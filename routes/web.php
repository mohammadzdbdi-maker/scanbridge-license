<?php

if (!function_exists('scb_admin_log')) {
    function scb_admin_log(string $action, string $message = ''): void
    {
        try {
            \Illuminate\Support\Facades\DB::table('scanbridge_admin_logs')->insert([
                'action' => $action,
                'message' => $message,
                'ip_address' => request()->ip(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Throwable $e) {
            // ignore log errors
        }
    }
}


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// SCANBRIDGE_OTP_HELPERS_START
if (!function_exists('scb_send_sms')) {
    function scb_send_sms(string $mobile, string $message): bool
    {
        $apiKey = config('services.kavenegar.key');
        $sender = config('services.kavenegar.sender');

        if (!$apiKey) {
            \Illuminate\Support\Facades\Log::warning('KAVENEGAR_API_KEY is not configured — OTP SMS cannot be sent.');
            return false;
        }

        try {
            $payload = [
                'receptor' => $mobile,
                'message' => $message,
            ];
            // خط فرستنده اختیاری است: اگر تنظیم نشده باشد، کاوه‌نگار از خط پیش‌فرض حساب استفاده می‌کند
            if ($sender) {
                $payload['sender'] = $sender;
            }

            $response = Http::timeout(10)->get("https://api.kavenegar.com/v1/{$apiKey}/sms/send.json", $payload);

            if (!$response->successful()) {
                \Illuminate\Support\Facades\Log::error('Kavenegar SMS send failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'receptor' => $mobile,
                ]);
            }

            return $response->successful();
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Kavenegar SMS exception: ' . $e->getMessage());
            return false;
        }
    }
}

if (!function_exists('scb_issue_otp')) {
    /**
     * Generate + send a fresh OTP for a mobile/purpose pair.
     * Returns ['ok' => bool, 'wait' => int] — 'wait' is seconds left before a resend is allowed.
     */
    function scb_issue_otp(string $mobile, string $purpose): array
    {
        $recent = DB::table('scanbridge_otps')
            ->where('mobile', $mobile)
            ->where('purpose', $purpose)
            ->whereNull('used_at')
            ->orderByDesc('id')
            ->first();

        if ($recent) {
            $secondsSince = Carbon::parse($recent->created_at)->diffInSeconds(now());
            if ($secondsSince < 60) {
                return ['ok' => false, 'wait' => 60 - $secondsSince];
            }
        }

        $code = (string) random_int(100000, 999999);

        DB::table('scanbridge_otps')->insert([
            'mobile' => $mobile,
            'code' => $code,
            'purpose' => $purpose,
            'attempts' => 0,
            'expires_at' => now()->addMinutes(5),
            'used_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $sent = scb_send_sms($mobile, "کد تایید شما در Scanbridge: {$code}\nاین کد تا ۵ دقیقه معتبر است.");

        return ['ok' => $sent, 'wait' => 0];
    }
}

if (!function_exists('scb_check_otp')) {
    function scb_check_otp(string $mobile, string $purpose, string $code): bool
    {
        $otp = DB::table('scanbridge_otps')
            ->where('mobile', $mobile)
            ->where('purpose', $purpose)
            ->whereNull('used_at')
            ->orderByDesc('id')
            ->first();

        if (!$otp) {
            return false;
        }

        if (Carbon::parse($otp->expires_at)->isPast()) {
            return false;
        }

        if ($otp->attempts >= 5) {
            return false;
        }

        if (!hash_equals((string) $otp->code, $code)) {
            DB::table('scanbridge_otps')->where('id', $otp->id)->increment('attempts');
            return false;
        }

        DB::table('scanbridge_otps')->where('id', $otp->id)->update(['used_at' => now()]);

        return true;
    }
}
// SCANBRIDGE_OTP_HELPERS_END

$requireAdmin = function (Request $request) {
    if (!$request->session()->get('scanbridge_admin')) {
        return redirect('/admin/login');
    }
    return null;
};


// SCANBRIDGE_ADMIN_AUTH_START
function scb_admin_password_hash_value(): string
{
    $file = storage_path('app/admin-password.hash');

    if (file_exists($file)) {
        return trim((string) file_get_contents($file));
    }

    return trim((string) env('LICENSE_ADMIN_PASSWORD_HASH'), "\"'");
}

function scb_set_admin_password_hash(string $hash): void
{
    $file = storage_path('app/admin-password.hash');
    file_put_contents($file, $hash);
    @chmod($file, 0600);
}

Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', function (Request $request) {
    $request->validate([
        'password' => 'required|string',
    ]);

    $hash = scb_admin_password_hash_value();

    if (!$hash || !password_verify($request->password, $hash)) {
        return back()->with('error', 'رمز عبور اشتباه است.');
    }

    $request->session()->put('scanbridge_admin', true);
    $request->session()->regenerate();

    return redirect('/admin');
});

Route::post('/admin/logout', function (Request $request) {
    $request->session()->forget('scanbridge_admin');
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/admin/login');
});

Route::get('/admin/password', function (Request $request) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    return view('admin.password');
});

Route::post('/admin/password', function (Request $request) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    $data = $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8|confirmed',
    ], [
        'current_password.required' => 'رمز فعلی را وارد کنید.',
        'new_password.required' => 'رمز جدید را وارد کنید.',
        'new_password.min' => 'رمز جدید حداقل باید ۸ کاراکتر باشد.',
        'new_password.confirmed' => 'تکرار رمز جدید با رمز جدید یکسان نیست.',
    ]);

    $hash = scb_admin_password_hash_value();

    if (!$hash || !password_verify($data['current_password'], $hash)) {
        return back()->with('error', 'رمز فعلی اشتباه است.');
    }

    $newHash = password_hash($data['new_password'], PASSWORD_BCRYPT);
    scb_set_admin_password_hash($newHash);

    \Illuminate\Support\Facades\Artisan::call('optimize:clear');

    $request->session()->forget('scanbridge_admin');
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/admin/login')->with('error', 'رمز با موفقیت تغییر کرد. دوباره با رمز جدید وارد شوید.');
});
// SCANBRIDGE_ADMIN_AUTH_END

Route::get('/', function () {
    if (request()->getHost() === 'license.scanbridge.ir') {
        return redirect('/admin');
    }

    $planPrices = [];
    try {
        foreach (DB::table('scanbridge_prices')->get() as $row) {
            $entry = $planPrices[$row->plan] ?? ['annual' => null, 'longest' => null, 'longestMonths' => 0];
            if ((int) $row->duration_months === 12) {
                $entry['annual'] = (int) $row->price;
            }
            if ((int) $row->duration_months > $entry['longestMonths']) {
                $entry['longest'] = (int) $row->price;
                $entry['longestMonths'] = (int) $row->duration_months;
            }
            $planPrices[$row->plan] = $entry;
        }
    } catch (\Throwable $e) {
        $planPrices = [];
    }

    return view('site.home', ['planPrices' => $planPrices]);
});

Route::get('/download', function () {
    return view('site.download');
});

Route::get('/guide', function () {
    return view('site.guide');
});

Route::get('/buy', function (Request $request) {
    $customerId = $request->session()->get('scanbridge_customer_id');
    if (!$customerId) {
        $request->session()->put('scb_intended', $request->fullUrl());
        return redirect('/panel/login')->with('error', 'برای ثبت درخواست خرید، ابتدا وارد حساب خود شوید یا ثبت‌نام کنید.');
    }
    $customer = DB::table('scanbridge_customers')->where('id', $customerId)->first();

    $pricesRaw = DB::table('scanbridge_prices')->get();
    $prices = [];
    foreach ($pricesRaw as $p) {
        $prices[$p->plan][$p->duration_months] = (int) $p->price;
    }
    $devicePricing = DB::table('scanbridge_plan_device_pricing')->get()->keyBy('plan');
    $deviceData = [];
    foreach ($devicePricing as $plan => $row) {
        $deviceData[$plan] = [
            'base_devices' => (int) $row->base_devices,
            'price_per_extra_device' => (int) $row->price_per_extra_device,
        ];
    }

    return view('site.buy', [
        'pricingData' => $prices,
        'deviceData' => $deviceData,
        'customer' => $customer,
    ]);
});

Route::get('/about', function () {
    return view('site.about');
});

Route::get('/contact', function () {
    return view('site.contact');
});

Route::get('/privacy', function () {
    return view('site.privacy');
});

Route::get('/terms', function () {
    return view('site.terms');
});



Route::get('/latest', function () {
    $path = public_path('downloads/Scanbridge-Setup.exe');

    if (!file_exists($path)) {
        return redirect('/download');
    }

    return response()->download($path, 'Scanbridge-Setup.exe');
});


Route::get('/admin', function (Request $request) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    $q = trim((string) $request->query('q', ''));
    $licenseFilter = trim((string) $request->query('license_filter', 'all'));

    $query = DB::table('scanbridge_licenses')->orderByDesc('id');

    if ($q !== '') {
        $query->where(function ($sub) use ($q) {
            $sub->where('license_key', 'like', "%{$q}%")
                ->orWhere('pharmacy_name', 'like', "%{$q}%")
                ->orWhere('customer_name', 'like', "%{$q}%")
                ->orWhere('plan', 'like', "%{$q}%")
                ->orWhere('status', 'like', "%{$q}%");
        });
    }

    if ($licenseFilter === 'active') {
        $query->where('status', 'active');
    } elseif ($licenseFilter === 'disabled') {
        $query->where('status', '!=', 'active');
    } elseif ($licenseFilter === 'expired') {
        $query->whereNotNull('expires_at')->where('expires_at', '<', now());
    } elseif (in_array($licenseFilter, ['Normal', 'Ttac', 'TtacPlus', 'Trial'], true)) {
        $query->where('plan', $licenseFilter);
    }

    $licenses = $query->get();

    $activationCounts = DB::table('scanbridge_activations')
        ->select('license_id', DB::raw('COUNT(*) as count'))
        ->groupBy('license_id')
        ->pluck('count', 'license_id');

    $activations = DB::table('scanbridge_activations')
        ->orderByDesc('last_seen_at')
        ->get()
        ->groupBy('license_id');

    $totalLicenses = DB::table('scanbridge_licenses')->count();
    $activeLicenses = DB::table('scanbridge_licenses')->where('status', 'active')->count();
    $disabledLicenses = DB::table('scanbridge_licenses')->where('status', '!=', 'active')->count();
    $expiredLicenses = DB::table('scanbridge_licenses')
        ->whereNotNull('expires_at')
        ->where('expires_at', '<', now())
        ->count();

    $pricesRaw = DB::table('scanbridge_prices')->get();
    $prices = [];
    foreach ($pricesRaw as $p) {
        $prices[$p->plan][$p->duration_months] = $p->price;
    }
    $devicePricing = DB::table('scanbridge_plan_device_pricing')->get()->keyBy('plan');

    return view('admin.dashboard', [
        'licenses' => $licenses,
        'activationCounts' => $activationCounts,
        'activations' => $activations,
        'q' => $q,
        'licenseFilter' => $licenseFilter,
        'totalLicenses' => $totalLicenses,
        'activeLicenses' => $activeLicenses,
        'disabledLicenses' => $disabledLicenses,
        'expiredLicenses' => $expiredLicenses,
        'prices' => $prices,
        'devicePricing' => $devicePricing,
    ]);
});

Route::post('/admin/licenses', function (Request $request) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    $data = $request->validate([
        'plan' => 'required|string|in:Normal,Ttac,TtacPlus,Trial',
        'customer_name' => 'nullable|string|max:255',
        'pharmacy_name' => 'required|string|max:255',
        'mobile' => 'nullable|string|max:20',
        'max_devices' => 'required|integer|min:1|max:50',
        'days' => 'required|integer|min:1|max:3650',
    ]);

    do {
        $licenseKey = 'SCB-' .
            strtoupper(Str::random(5)) . '-' .
            strtoupper(Str::random(5)) . '-' .
            strtoupper(Str::random(5)) . '-' .
            strtoupper(Str::random(5));

        $exists = DB::table('scanbridge_licenses')
            ->where('license_key', $licenseKey)
            ->exists();
    } while ($exists);

    $expiresAt = now()->addDays((int) $data['days'])->toDateTimeString();

    DB::table('scanbridge_licenses')->insert([
        'license_key' => $licenseKey,
        'plan' => $data['plan'],
        'customer_name' => $data['customer_name'] ?: $data['pharmacy_name'],
        'pharmacy_name' => $data['pharmacy_name'],
        'mobile' => $data['mobile'] ?? null,
        'status' => 'active',
        'max_devices' => (int) $data['max_devices'],
        'expires_at' => $expiresAt,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    scb_admin_log('create_license', 'لایسنس جدید ساخته شد: ' . $licenseKey);
    return redirect('/admin')->with('ok', 'لایسنس جدید ساخته شد: ' . $licenseKey);
});

Route::post('/admin/licenses/{id}/status', function (Request $request, int $id) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    $status = $request->input('status') === 'active' ? 'active' : 'disabled';

    DB::table('scanbridge_licenses')
        ->where('id', $id)
        ->update([
            'status' => $status,
            'updated_at' => now(),
        ]);

    scb_admin_log('license_status', ($status === 'active' ? 'فعال‌سازی لایسنس ID ' : 'غیرفعال‌سازی لایسنس ID ') . $id);
    return redirect('/admin')->with('ok', $status === 'active' ? 'لایسنس فعال شد.' : 'لایسنس غیرفعال شد.');
});

Route::post('/admin/licenses/{id}/plan', function (Request $request, int $id) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    $data = $request->validate([
        'plan' => 'required|string|in:Normal,Ttac,TtacPlus,Trial',
    ]);

    DB::table('scanbridge_licenses')
        ->where('id', $id)
        ->update([
            'plan' => $data['plan'],
            'updated_at' => now(),
        ]);

    scb_admin_log('license_plan', 'تغییر پلن لایسنس ID ' . $id . ' به ' . $data['plan']);
    return redirect('/admin')->with('ok', 'پلن لایسنس تغییر کرد.');
});

Route::post('/admin/licenses/{id}/reset-devices', function (Request $request, int $id) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    DB::table('scanbridge_activations')
        ->where('license_id', $id)
        ->delete();

    scb_admin_log('reset_devices', 'ریست دستگاه‌های لایسنس ID ' . $id);
    return redirect('/admin')->with('ok', 'دستگاه‌های فعال‌شده این لایسنس ریست شدند.');
});

Route::post('/admin/licenses/{id}/renew', function (Request $request, int $id) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    $days = max(1, min(3650, (int) $request->input('days', 365)));

    $license = DB::table('scanbridge_licenses')->where('id', $id)->first();

    if (!$license) {
        return redirect('/admin')->with('error', 'لایسنس پیدا نشد.');
    }

    $base = now();

    if ($license->expires_at) {
        $current = Carbon::parse($license->expires_at);
        if ($current->isFuture()) {
            $base = $current;
        }
    }

    DB::table('scanbridge_licenses')
        ->where('id', $id)
        ->update([
            'expires_at' => $base->copy()->addDays($days)->toDateTimeString(),
            'updated_at' => now(),
        ]);

    scb_admin_log('renew_license', 'تمدید لایسنس ID ' . $id . ' به مدت ' . $days . ' روز');
    return redirect('/admin')->with('ok', 'اعتبار لایسنس تمدید شد.');
});

Route::post('/admin/licenses/{id}/max-devices', function (Request $request, int $id) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    $maxDevices = max(1, min(50, (int) $request->input('max_devices', 1)));

    DB::table('scanbridge_licenses')
        ->where('id', $id)
        ->update([
            'max_devices' => $maxDevices,
            'updated_at' => now(),
        ]);

    scb_admin_log('max_devices', 'تغییر تعداد دستگاه لایسنس ID ' . $id . ' به ' . $maxDevices);
    return redirect('/admin')->with('ok', 'تعداد دستگاه مجاز تغییر کرد.');
});



// SCB_DELETE_ROUTES_START
Route::post('/admin/licenses/{id}/delete', function (\Illuminate\Http\Request $request, int $id) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }
    $license = \Illuminate\Support\Facades\DB::table('scanbridge_licenses')->where('id', $id)->first();
    if (!$license) {
        return redirect('/admin')->with('error', 'لایسنس پیدا نشد.');
    }
    \Illuminate\Support\Facades\DB::table('scanbridge_activations')->where('license_id', $id)->delete();
    \Illuminate\Support\Facades\DB::table('scanbridge_licenses')->where('id', $id)->delete();
    scb_admin_log('delete_license', 'لایسنس حذف شد: ' . ($license->license_key ?? 'ID ' . $id));
    return redirect('/admin')->with('ok', 'لایسنس حذف شد.');
});

Route::post('/admin/purchase-requests/{id}/delete', function (\Illuminate\Http\Request $request, int $id) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }
    $req = \Illuminate\Support\Facades\DB::table('scanbridge_purchase_requests')->where('id', $id)->first();
    if (!$req) {
        return redirect('/admin')->with('error', 'درخواست پیدا نشد.');
    }
    \Illuminate\Support\Facades\DB::table('scanbridge_purchase_requests')->where('id', $id)->delete();
    scb_admin_log('delete_request', 'درخواست حذف شد: ID ' . $id);
    return redirect('/admin')->with('ok', 'درخواست حذف شد.');
});

Route::post('/admin/logs/{id}/delete', function (\Illuminate\Http\Request $request, int $id) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }
    \Illuminate\Support\Facades\DB::table('scanbridge_admin_logs')->where('id', $id)->delete();
    return redirect('/admin')->with('ok', 'رویداد حذف شد.');
});
// SCB_DELETE_ROUTES_END
// SCANBRIDGE_PURCHASE_REQUESTS_START
Route::post('/buy/request', function (\Illuminate\Http\Request $request) {
    if (!$request->session()->get('scanbridge_customer_id')) {
        return response()->json(['success' => false, 'error' => 'برای ثبت درخواست، ابتدا وارد حساب خود شوید.'], 401);
    }

    $data = $request->validate([
        'organization_name' => 'nullable|string|max:255',
        'contact_name' => 'nullable|string|max:255',
        'mobile' => 'nullable|string|max:50',
        'plan' => 'nullable|string|max:50',
        'devices' => 'nullable|integer|min:1|max:50',
        'request_type' => 'nullable|string|max:100',
        'description' => 'nullable|string|max:2000',
    ]);

    \Illuminate\Support\Facades\DB::table('scanbridge_purchase_requests')->insert([
        'organization_name' => $data['organization_name'] ?? null,
        'contact_name' => $data['contact_name'] ?? null,
        'mobile' => $data['mobile'] ?? null,
        'plan' => $data['plan'] ?? null,
        'devices' => $data['devices'] ?? 1,
        'request_type' => $data['request_type'] ?? null,
        'description' => $data['description'] ?? null,
        'ip_address' => $request->ip(),
        'status' => 'new',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json(['success' => true]);
});

Route::post('/admin/purchase-requests/{id}/status', function (\Illuminate\Http\Request $request, int $id) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    $status = $request->input('status', 'done');

    if (!in_array($status, ['new', 'contacted', 'done', 'ignored'], true)) {
        $status = 'done';
    }

    \Illuminate\Support\Facades\DB::table('scanbridge_purchase_requests')
        ->where('id', $id)
        ->update([
            'status' => $status,
            'updated_at' => now(),
        ]);

    scb_admin_log('request_status', 'تغییر وضعیت درخواست ID ' . $id . ' به ' . $status);
    return redirect('/admin')->with('ok', 'وضعیت درخواست تغییر کرد.');
});

\View::composer('admin.dashboard', function ($view) {
    try {
        $requestStatus = request()->query('request_status', 'all');

        $purchaseQuery = \Illuminate\Support\Facades\DB::table('scanbridge_purchase_requests')
            ->orderByDesc('id');

        if (in_array($requestStatus, ['new', 'contacted', 'done', 'ignored'], true)) {
            $purchaseQuery->where('status', $requestStatus);
        }

        $purchaseRequests = $purchaseQuery
            ->limit(50)
            ->get();

        $newPurchaseRequests = \Illuminate\Support\Facades\DB::table('scanbridge_purchase_requests')
            ->where('status', 'new')
            ->count();

        $view->with('purchaseRequests', $purchaseRequests);
        $view->with('newPurchaseRequests', $newPurchaseRequests);
        $view->with('requestStatus', $requestStatus);
    } catch (\Throwable $e) {
        $view->with('purchaseRequests', collect());
        $view->with('newPurchaseRequests', 0);
    }
});
// SCANBRIDGE_PURCHASE_REQUESTS_END


Route::post('/admin/purchase-requests/{id}/create-license', function (\Illuminate\Http\Request $request, int $id) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    $req = \Illuminate\Support\Facades\DB::table('scanbridge_purchase_requests')->where('id', $id)->first();

    if (!$req) {
        return redirect('/admin')->with('error', 'درخواست پیدا نشد.');
    }

    // اگر قبلاً برای این درخواست لایسنس ساخته شده، دوباره نساز.
    if (!empty($req->license_key)) {
        return redirect('/admin')->with('ok', 'برای این درخواست قبلاً لایسنس ساخته شده است: ' . $req->license_key);
    }

    $plan = $request->input('plan') ?: ($req->plan ?: 'TtacPlus');

    if (!in_array($plan, ['Normal', 'Ttac', 'TtacPlus', 'Trial'], true)) {
        $plan = 'TtacPlus';
    }

    $days = (int) $request->input('days', $plan === 'Trial' ? 14 : 365);
    $days = max(1, min(3650, $days));

    $maxDevices = (int) ($req->devices ?: 1);
    $maxDevices = max(1, min(50, $maxDevices));

    do {
        $licenseKey = 'SCB-' .
            strtoupper(\Illuminate\Support\Str::random(5)) . '-' .
            strtoupper(\Illuminate\Support\Str::random(5)) . '-' .
            strtoupper(\Illuminate\Support\Str::random(5)) . '-' .
            strtoupper(\Illuminate\Support\Str::random(5));

        $exists = \Illuminate\Support\Facades\DB::table('scanbridge_licenses')
            ->where('license_key', $licenseKey)
            ->exists();
    } while ($exists);

    $expiresAt = now()->addDays($days)->toDateTimeString();

    \Illuminate\Support\Facades\DB::table('scanbridge_licenses')->insert([
        'license_key' => $licenseKey,
        'plan' => $plan,
        'customer_name' => $req->contact_name ?: $req->organization_name,
        'pharmacy_name' => $req->organization_name ?: $req->contact_name,
        'mobile' => $req->mobile ?? null,
        'status' => 'active',
        'max_devices' => $maxDevices,
        'expires_at' => $expiresAt,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    \Illuminate\Support\Facades\DB::table('scanbridge_purchase_requests')
        ->where('id', $id)
        ->update([
            'status' => 'done',
            'license_key' => $licenseKey,
            'updated_at' => now(),
        ]);

    scb_admin_log('create_license_from_request', 'لایسنس از روی درخواست ID ' . $id . ' ساخته شد: ' . $licenseKey);
    return redirect('/admin')->with('ok', 'لایسنس از روی درخواست ساخته شد: ' . $licenseKey);
});


\View::composer('admin.dashboard', function ($view) {
    try {
        $adminLogs = \Illuminate\Support\Facades\DB::table('scanbridge_admin_logs')
            ->orderByDesc('id')
            ->limit(30)
            ->get();

        $view->with('adminLogs', $adminLogs);
    } catch (\Throwable $e) {
        $view->with('adminLogs', collect());
    }
});


Route::get('/admin/export/licenses.csv', function (\Illuminate\Http\Request $request) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    $rows = \Illuminate\Support\Facades\DB::table('scanbridge_licenses')
        ->orderByDesc('id')
        ->get();

    $headers = [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename="scanbridge-licenses.csv"',
    ];

    return response()->stream(function () use ($rows) {
        $out = fopen('php://output', 'w');
        fwrite($out, "\xEF\xBB\xBF");
        fputcsv($out, ['id', 'license_key', 'plan', 'customer_name', 'organization_name', 'status', 'max_devices', 'expires_at', 'created_at']);
        foreach ($rows as $row) {
            fputcsv($out, [
                $row->id,
                $row->license_key,
                $row->plan,
                $row->customer_name,
                $row->pharmacy_name,
                $row->status,
                $row->max_devices,
                $row->expires_at,
                $row->created_at,
            ]);
        }
        fclose($out);
    }, 200, $headers);
});

Route::get('/admin/export/requests.csv', function (\Illuminate\Http\Request $request) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    $rows = \Illuminate\Support\Facades\DB::table('scanbridge_purchase_requests')
        ->orderByDesc('id')
        ->get();

    $headers = [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename="scanbridge-purchase-requests.csv"',
    ];

    return response()->stream(function () use ($rows) {
        $out = fopen('php://output', 'w');
        fwrite($out, "\xEF\xBB\xBF");
        fputcsv($out, ['id', 'organization_name', 'contact_name', 'mobile', 'plan', 'devices', 'request_type', 'status', 'license_key', 'description', 'created_at']);
        foreach ($rows as $row) {
            fputcsv($out, [
                $row->id,
                $row->organization_name,
                $row->contact_name,
                $row->mobile,
                $row->plan,
                $row->devices,
                $row->request_type,
                $row->status,
                $row->license_key ?? '',
                $row->description,
                $row->created_at,
            ]);
        }
        fclose($out);
    }, 200, $headers);
});

Route::get('/admin/export/logs.csv', function (\Illuminate\Http\Request $request) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    $rows = \Illuminate\Support\Facades\DB::table('scanbridge_admin_logs')
        ->orderByDesc('id')
        ->limit(2000)
        ->get();

    $headers = [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename="scanbridge-admin-logs.csv"',
    ];

    return response()->stream(function () use ($rows) {
        $out = fopen('php://output', 'w');
        fwrite($out, "\xEF\xBB\xBF");
        fputcsv($out, ['id', 'action', 'message', 'ip_address', 'created_at']);
        foreach ($rows as $row) {
            fputcsv($out, [
                $row->id,
                $row->action,
                $row->message,
                $row->ip_address,
                $row->created_at,
            ]);
        }
        fclose($out);
    }, 200, $headers);
});


// SCANBRIDGE_XLSX_EXPORTS_START
if (!function_exists('scb_xlsx_col')) {
    function scb_xlsx_col(int $index): string
    {
        $name = '';
        $index++;
        while ($index > 0) {
            $mod = ($index - 1) % 26;
            $name = chr(65 + $mod) . $name;
            $index = intdiv($index - $mod, 26);
        }
        return $name;
    }
}

if (!function_exists('scb_xlsx_clean')) {
    function scb_xlsx_clean($value): string
    {
        $value = (string) ($value ?? '');
        $value = preg_replace('/[^\P{C}\t\r\n]/u', '', $value) ?? $value;
        return htmlspecialchars($value, ENT_XML1 | ENT_COMPAT, 'UTF-8');
    }
}

if (!function_exists('scb_xlsx_response')) {
    function scb_xlsx_response(string $filename, array $headers, array $rows)
    {
        $tmpDir = storage_path('app/xlsx-temp');
        if (!is_dir($tmpDir)) {
            mkdir($tmpDir, 0775, true);
        }

        $tmpFile = $tmpDir . '/' . uniqid('scanbridge_', true) . '.xlsx';

        $allRows = array_merge([$headers], $rows);

        $sheetXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
        $sheetXml .= '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">';
        $sheetXml .= '<sheetViews><sheetView workbookViewId="0" rightToLeft="1"/></sheetViews>';
        $sheetXml .= '<sheetFormatPr defaultRowHeight="18"/>';
        $sheetXml .= '<cols>';

        $colCount = count($headers);
        for ($i = 1; $i <= $colCount; $i++) {
            $sheetXml .= '<col min="' . $i . '" max="' . $i . '" width="24" customWidth="1"/>';
        }

        $sheetXml .= '</cols>';
        $sheetXml .= '<sheetData>';

        foreach ($allRows as $rIndex => $row) {
            $rowNumber = $rIndex + 1;
            $style = $rIndex === 0 ? ' s="1"' : '';
            $sheetXml .= '<row r="' . $rowNumber . '">';

            foreach ($row as $cIndex => $cell) {
                $cellRef = scb_xlsx_col($cIndex) . $rowNumber;
                $sheetXml .= '<c r="' . $cellRef . '" t="inlineStr"' . $style . '><is><t>' . scb_xlsx_clean($cell) . '</t></is></c>';
            }

            $sheetXml .= '</row>';
        }

        $sheetXml .= '</sheetData>';
        $sheetXml .= '</worksheet>';

        $zip = new \ZipArchive();
        if ($zip->open($tmpFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            abort(500, 'Cannot create Excel file');
        }

        $zip->addFromString('[Content_Types].xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">
    <Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>
    <Default Extension="xml" ContentType="application/xml"/>
    <Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>
    <Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>
    <Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>
</Types>');

        $zip->addFromString('_rels/.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
    <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>
</Relationships>');

        $zip->addFromString('xl/workbook.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">
    <sheets>
        <sheet name="Scanbridge" sheetId="1" r:id="rId1"/>
    </sheets>
</workbook>');

        $zip->addFromString('xl/_rels/workbook.xml.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
    <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>
    <Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>
</Relationships>');

        $zip->addFromString('xl/styles.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">
    <fonts count="2">
        <font><sz val="11"/><name val="Calibri"/></font>
        <font><b/><sz val="11"/><name val="Calibri"/></font>
    </fonts>
    <fills count="2">
        <fill><patternFill patternType="none"/></fill>
        <fill><patternFill patternType="gray125"/></fill>
    </fills>
    <borders count="1">
        <border><left/><right/><top/><bottom/><diagonal/></border>
    </borders>
    <cellStyleXfs count="1">
        <xf numFmtId="0" fontId="0" fillId="0" borderId="0"/>
    </cellStyleXfs>
    <cellXfs count="2">
        <xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/>
        <xf numFmtId="0" fontId="1" fillId="0" borderId="0" xfId="0" applyFont="1"/>
    </cellXfs>
</styleSheet>');

        $zip->addFromString('xl/worksheets/sheet1.xml', $sheetXml);
        $zip->close();

        return response()->download($tmpFile, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }
}

Route::get('/admin/export/licenses.xlsx', function (\Illuminate\Http\Request $request) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    $items = \Illuminate\Support\Facades\DB::table('scanbridge_licenses')
        ->orderByDesc('id')
        ->get();

    $headers = [
        'شناسه',
        'کد لایسنس',
        'پلن',
        'نام مشتری',
        'نام مجموعه',
        'وضعیت',
        'تعداد دستگاه مجاز',
        'تاریخ انقضا',
        'تاریخ ساخت',
    ];

    $rows = [];
    foreach ($items as $item) {
        $rows[] = [
            $item->id,
            $item->license_key,
            $item->plan,
            $item->customer_name,
            $item->pharmacy_name,
            $item->status,
            $item->max_devices,
            $item->expires_at,
            $item->created_at,
        ];
    }

    return scb_xlsx_response('scanbridge-licenses.xlsx', $headers, $rows);
});

Route::get('/admin/export/requests.xlsx', function (\Illuminate\Http\Request $request) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    $items = \Illuminate\Support\Facades\DB::table('scanbridge_purchase_requests')
        ->orderByDesc('id')
        ->get();

    $headers = [
        'شناسه',
        'نام مجموعه',
        'نام مسئول',
        'موبایل',
        'پلن',
        'تعداد سیستم',
        'نوع درخواست',
        'وضعیت',
        'لایسنس صادر شده',
        'توضیحات',
        'تاریخ ثبت',
    ];

    $rows = [];
    foreach ($items as $item) {
        $rows[] = [
            $item->id,
            $item->organization_name,
            $item->contact_name,
            $item->mobile,
            $item->plan,
            $item->devices,
            $item->request_type,
            $item->status,
            $item->license_key ?? '',
            $item->description,
            $item->created_at,
        ];
    }

    return scb_xlsx_response('scanbridge-purchase-requests.xlsx', $headers, $rows);
});

Route::get('/admin/export/logs.xlsx', function (\Illuminate\Http\Request $request) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    $items = \Illuminate\Support\Facades\DB::table('scanbridge_admin_logs')
        ->orderByDesc('id')
        ->limit(2000)
        ->get();

    $headers = [
        'شناسه',
        'عملیات',
        'توضیح',
        'IP',
        'تاریخ',
    ];

    $rows = [];
    foreach ($items as $item) {
        $rows[] = [
            $item->id,
            $item->action,
            $item->message,
            $item->ip_address,
            $item->created_at,
        ];
    }

    return scb_xlsx_response('scanbridge-admin-logs.xlsx', $headers, $rows);
});
// SCANBRIDGE_XLSX_EXPORTS_END


Route::post('/admin/upload-installer', function (\Illuminate\Http\Request $request) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    $request->validate([
        'installer' => 'required|file|max:512000',
    ], [
        'installer.required' => 'فایل نصب را انتخاب کنید.',
        'installer.file' => 'فایل نامعتبر است.',
        'installer.max' => 'حجم فایل بیشتر از حد مجاز است.',
    ]);

    $file = $request->file('installer');

    $originalName = $file->getClientOriginalName();
    $extension = strtolower($file->getClientOriginalExtension());

    if ($extension !== 'exe') {
        return redirect('/admin')->with('error', 'فقط فایل exe قابل قبول است.');
    }

    $downloadDir = public_path('downloads');
    if (!is_dir($downloadDir)) {
        mkdir($downloadDir, 0775, true);
    }

    $target = $downloadDir . '/Scanbridge-Setup.exe';

    if (file_exists($target)) {
        $backupName = 'Scanbridge-Setup-backup-' . date('Ymd-His') . '.exe';
        @rename($target, $downloadDir . '/' . $backupName);
    }

    $file->move($downloadDir, 'Scanbridge-Setup.exe');

    scb_admin_log('upload_installer', 'نسخه جدید فایل نصب آپلود شد: ' . $originalName);

    return redirect('/admin')->with('ok', 'فایل نصب جدید با موفقیت آپلود شد.');
});


// SCANBRIDGE_CUSTOMER_PANEL_START
$requireCustomer = function (Request $request) {
    if (!$request->session()->get('scanbridge_customer_id')) {
        return redirect('/panel/login');
    }
    return null;
};

Route::get('/panel/register', function () {
    return view('site.panel.register');
});

Route::post('/panel/register', function (Request $request) {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'mobile' => 'required|string|max:20|unique:scanbridge_customers,mobile',
        'password' => 'required|string|min:6|confirmed',
    ], [
        'mobile.unique' => 'این شماره موبایل قبلا ثبت‌نام کرده است.',
        'password.confirmed' => 'تکرار رمز عبور مطابقت ندارد.',
        'password.min' => 'رمز عبور باید حداقل ۶ کاراکتر باشد.',
    ]);

    $mobile = trim($data['mobile']);

    // ورود/ثبت‌نام با کد پیامکی (OTP) فعلاً با کلید SMS_OTP_ENABLED کنترل می‌شود.
    // تا وقتی خط خدماتی کاوه‌نگار آماده نشده، ثبت‌نام مستقیم و بدون پیامک انجام می‌شود
    // و کاربر بلافاصله وارد پنل می‌شود. کل جریان OTP (کد، صفحه تأیید، ارسال مجدد) دست‌نخورده
    // باقی مانده و بعداً فقط با true کردن همین کلید برمی‌گردد.
    if (!config('services.scanbridge.sms_otp_enabled')) {
        $id = DB::table('scanbridge_customers')->insertGetId([
            'name' => $data['name'],
            'mobile' => $mobile,
            'password' => bcrypt($data['password']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $request->session()->put('scanbridge_customer_id', $id);
        $request->session()->regenerate();

        return redirect('/panel');
    }

    $issue = scb_issue_otp($mobile, 'register');
    if (!$issue['ok'] && ($issue['wait'] ?? 0) > 0) {
        return back()->withInput()->with('error', 'همین الان یک کد برای این شماره ارسال شده. لطفا ' . $issue['wait'] . ' ثانیه دیگر تلاش کنید.');
    }
    if (!$issue['ok']) {
        return back()->withInput()->with('error', 'ارسال پیامک با خطا مواجه شد. لطفا دوباره تلاش کنید.');
    }

    $request->session()->put('scb_pending_register', [
        'name' => $data['name'],
        'mobile' => $mobile,
        'password' => bcrypt($data['password']),
    ]);

    return redirect('/panel/register/verify');
});

Route::get('/panel/register/verify', function (Request $request) {
    $pending = $request->session()->get('scb_pending_register');
    if (!$pending) {
        return redirect('/panel/register');
    }

    return view('site.panel.verify', ['mobile' => $pending['mobile']]);
});

Route::post('/panel/register/verify', function (Request $request) {
    $pending = $request->session()->get('scb_pending_register');
    if (!$pending) {
        return redirect('/panel/register');
    }

    $data = $request->validate([
        'code' => 'required|string|max:10',
    ]);

    if (!scb_check_otp($pending['mobile'], 'register', trim($data['code']))) {
        return back()->with('error', 'کد وارد شده صحیح نیست یا منقضی شده است.');
    }

    $id = DB::table('scanbridge_customers')->insertGetId([
        'name' => $pending['name'],
        'mobile' => $pending['mobile'],
        'password' => $pending['password'],
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $request->session()->forget('scb_pending_register');
    $request->session()->put('scanbridge_customer_id', $id);
    $request->session()->regenerate();

    $scbIntended = $request->session()->get('scb_intended', '/panel');
    $request->session()->forget('scb_intended');
    return redirect($scbIntended);
});

Route::post('/panel/register/resend', function (Request $request) {
    $pending = $request->session()->get('scb_pending_register');
    if (!$pending) {
        return redirect('/panel/register');
    }

    $issue = scb_issue_otp($pending['mobile'], 'register');
    if (!$issue['ok'] && ($issue['wait'] ?? 0) > 0) {
        return back()->with('error', 'لطفا ' . $issue['wait'] . ' ثانیه دیگر تلاش کنید.');
    }
    if (!$issue['ok']) {
        return back()->with('error', 'ارسال پیامک با خطا مواجه شد.');
    }

    return back()->with('ok', 'کد جدید ارسال شد.');
});

Route::get('/panel/login', function () {
    return view('site.panel.login');
});

Route::post('/panel/login', function (Request $request) {
    $data = $request->validate([
        'mobile' => 'required|string',
        'password' => 'required|string',
    ]);

    $customer = DB::table('scanbridge_customers')->where('mobile', $data['mobile'])->first();

    if (!$customer || !password_verify($data['password'], $customer->password)) {
        return back()->with('error', 'شماره موبایل یا رمز عبور اشتباه است.');
    }

    $request->session()->put('scanbridge_customer_id', $customer->id);
    $request->session()->regenerate();

    $scbIntended = $request->session()->get('scb_intended', '/panel');
    $request->session()->forget('scb_intended');
    return redirect($scbIntended);
});

Route::post('/panel/logout', function (Request $request) {
    $request->session()->forget('scanbridge_customer_id');
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/panel/login');
});

// SCANBRIDGE_PASSWORD_RESET_START
Route::get('/panel/forgot-password', function () {
    if (!config('services.scanbridge.sms_otp_enabled')) {
        return redirect('/panel/login')->with('error', 'بازیابی رمز عبور فعلاً غیرفعال است. لطفاً با پشتیبانی (واتساپ) تماس بگیرید تا رمز شما را بازنشانی کنند.');
    }

    return view('site.panel.forgot-password');
});

Route::post('/panel/forgot-password', function (Request $request) {
    if (!config('services.scanbridge.sms_otp_enabled')) {
        return redirect('/panel/login')->with('error', 'بازیابی رمز عبور فعلاً غیرفعال است. لطفاً با پشتیبانی (واتساپ) تماس بگیرید تا رمز شما را بازنشانی کنند.');
    }

    $data = $request->validate([
        'mobile' => 'required|string|max:20',
    ]);

    $mobile = trim($data['mobile']);
    $customer = DB::table('scanbridge_customers')->where('mobile', $mobile)->first();

    if (!$customer) {
        return back()->withInput()->with('error', 'شماره موبایلی با این مشخصات پیدا نشد.');
    }

    $issue = scb_issue_otp($mobile, 'reset');
    if (!$issue['ok'] && ($issue['wait'] ?? 0) > 0) {
        return back()->withInput()->with('error', 'همین الان یک کد برای این شماره ارسال شده. لطفا ' . $issue['wait'] . ' ثانیه دیگر تلاش کنید.');
    }
    if (!$issue['ok']) {
        return back()->withInput()->with('error', 'ارسال پیامک با خطا مواجه شد. لطفا دوباره تلاش کنید.');
    }

    $request->session()->put('scb_pending_reset_mobile', $mobile);

    return redirect('/panel/reset-password');
});

Route::get('/panel/reset-password', function (Request $request) {
    $mobile = $request->session()->get('scb_pending_reset_mobile');
    if (!$mobile) {
        return redirect('/panel/forgot-password');
    }

    return view('site.panel.reset-password', ['mobile' => $mobile]);
});

Route::post('/panel/reset-password', function (Request $request) {
    $mobile = $request->session()->get('scb_pending_reset_mobile');
    if (!$mobile) {
        return redirect('/panel/forgot-password');
    }

    $data = $request->validate([
        'code' => 'required|string|max:10',
        'password' => 'required|string|min:6|confirmed',
    ], [
        'password.confirmed' => 'تکرار رمز عبور مطابقت ندارد.',
        'password.min' => 'رمز عبور باید حداقل ۶ کاراکتر باشد.',
    ]);

    if (!scb_check_otp($mobile, 'reset', trim($data['code']))) {
        return back()->with('error', 'کد وارد شده صحیح نیست یا منقضی شده است.');
    }

    DB::table('scanbridge_customers')->where('mobile', $mobile)->update([
        'password' => bcrypt($data['password']),
        'updated_at' => now(),
    ]);

    $request->session()->forget('scb_pending_reset_mobile');

    return redirect('/panel/login')->with('ok', 'رمز عبور با موفقیت تغییر کرد. حالا وارد شوید.');
});

Route::post('/panel/reset-password/resend', function (Request $request) {
    $mobile = $request->session()->get('scb_pending_reset_mobile');
    if (!$mobile) {
        return redirect('/panel/forgot-password');
    }

    $issue = scb_issue_otp($mobile, 'reset');
    if (!$issue['ok'] && ($issue['wait'] ?? 0) > 0) {
        return back()->with('error', 'لطفا ' . $issue['wait'] . ' ثانیه دیگر تلاش کنید.');
    }
    if (!$issue['ok']) {
        return back()->with('error', 'ارسال پیامک با خطا مواجه شد.');
    }

    return back()->with('ok', 'کد جدید ارسال شد.');
});
// SCANBRIDGE_PASSWORD_RESET_END

Route::get('/panel', function (Request $request) use ($requireCustomer) {
    if ($redirect = $requireCustomer($request)) {
        return $redirect;
    }

    $customer = DB::table('scanbridge_customers')->where('id', $request->session()->get('scanbridge_customer_id'))->first();

    $licenses = DB::table('scanbridge_licenses')
        ->where('customer_id', $customer->id)
        ->orWhere('pharmacy_name', $customer->name)
        ->orderByDesc('id')
        ->get();

    $requests = DB::table('scanbridge_purchase_requests')
        ->where('customer_id', $customer->id)
        ->orWhere('mobile', $customer->mobile)
        ->orderByDesc('id')
        ->get();

    $pricesRaw = DB::table('scanbridge_prices')->get();
    $pricingData = [];
    foreach ($pricesRaw as $p) {
        $pricingData[$p->plan][$p->duration_months] = (int) $p->price;
    }
    $deviceRows = DB::table('scanbridge_plan_device_pricing')->get();
    $deviceData = [];
    foreach ($deviceRows as $row) {
        $deviceData[$row->plan] = [
            'base_devices' => (int) $row->base_devices,
            'price_per_extra_device' => (int) $row->price_per_extra_device,
        ];
    }

    $supportStatus = 'all';
    if (in_array($request->query('sstatus'), ['new', 'answered', 'closed'], true)) {
        $supportStatus = $request->query('sstatus');
    }

    $supportTicketsQuery = DB::table('scanbridge_support_tickets')
        ->where('customer_id', $customer->id);
    if ($supportStatus !== 'all') {
        $supportTicketsQuery->where('status', $supportStatus);
    }
    $supportTickets = $supportTicketsQuery->orderByDesc('id')->get();

    $supportMessages = DB::table('scanbridge_support_messages')
        ->whereIn('ticket_id', $supportTickets->pluck('id'))
        ->orderBy('created_at')
        ->get()
        ->groupBy('ticket_id');

    return view('site.panel.dashboard', compact('customer', 'licenses', 'requests', 'pricingData', 'deviceData', 'supportTickets', 'supportMessages', 'supportStatus'));
});

Route::post('/panel/request', function (Request $request) use ($requireCustomer) {
    if ($redirect = $requireCustomer($request)) {
        return $redirect;
    }

    $customer = DB::table('scanbridge_customers')->where('id', $request->session()->get('scanbridge_customer_id'))->first();

    $data = $request->validate([
        'organization_name' => 'nullable|string|max:255',
        'plan' => 'nullable|string|max:50',
        'devices' => 'nullable|integer|min:1|max:50',
        'request_type' => 'nullable|string|max:100',
        'description' => 'nullable|string|max:2000',
    ]);

    DB::table('scanbridge_purchase_requests')->insert([
        'customer_id' => $customer->id,
        'organization_name' => $data['organization_name'] ?? $customer->name,
        'contact_name' => $customer->name,
        'mobile' => $customer->mobile,
        'plan' => $data['plan'] ?? null,
        'devices' => $data['devices'] ?? 1,
        'request_type' => $data['request_type'] ?? 'درخواست از پنل مشتری',
        'description' => $data['description'] ?? null,
        'ip_address' => $request->ip(),
        'status' => 'new',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect('/panel')->with('ok', 'درخواست شما با موفقیت ثبت شد.');
});

Route::post('/panel/support', function (Request $request) use ($requireCustomer) {
    if ($redirect = $requireCustomer($request)) {
        return $redirect;
    }
    $customer = DB::table('scanbridge_customers')->where('id', $request->session()->get('scanbridge_customer_id'))->first();

    $data = $request->validate([
        'log_file' => 'nullable|file|max:5120|mimes:txt,log',
        'license_id' => 'nullable|integer',
        'note' => 'nullable|string|max:2000',
    ]);

    if (!$request->hasFile('log_file') && empty($data['note'])) {
        return back()->withErrors(['note' => 'لطفاً یا فایل گزارش تشخیصی را آپلود کنید یا پیام خود را بنویسید.'])->withInput();
    }

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

    $originalFilename = null;
    $storedPath = null;
    if ($request->hasFile('log_file')) {
        $file = $request->file('log_file');
        $storedName = 'ticket-' . time() . '-' . bin2hex(random_bytes(8)) . '.' . strtolower($file->getClientOriginalExtension());
        $file->storeAs('support-logs', $storedName);
        $originalFilename = $file->getClientOriginalName();
        $storedPath = 'support-logs/' . $storedName;
    }

    $ticketId = DB::table('scanbridge_support_tickets')->insertGetId([
        'customer_id' => $customer->id,
        'license_id' => $licenseId,
        'original_filename' => $originalFilename,
        'stored_path' => $storedPath,
        'customer_note' => $data['note'] ?? null,
        'status' => 'new',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    if (!empty($data['note'])) {
        DB::table('scanbridge_support_messages')->insert([
            'ticket_id' => $ticketId,
            'sender' => 'customer',
            'message' => $data['note'],
            'created_at' => now(),
        ]);
    }

    return redirect('/panel')->with('ok', 'تیکت شما با موفقیت ثبت شد. پاسخ پشتیبانی به‌زودی همین‌جا (بخش پشتیبانی) و توی «پیام‌ها»ی نرم‌افزار نمایش داده می‌شود.');
});

Route::post('/panel/support/{ticket}/reply', function (Request $request, $ticket) use ($requireCustomer) {
    if ($redirect = $requireCustomer($request)) {
        return $redirect;
    }
    $customer = DB::table('scanbridge_customers')->where('id', $request->session()->get('scanbridge_customer_id'))->first();

    $ticketRow = DB::table('scanbridge_support_tickets')
        ->where('id', (int) $ticket)
        ->where('customer_id', $customer->id)
        ->first();

    if (!$ticketRow) {
        return redirect('/panel')->with('error', 'تیکت پیدا نشد.');
    }
    if ($ticketRow->status === 'closed') {
        return redirect('/panel')->with('error', 'این تیکت بسته شده و امکان ارسال پیام جدید در آن نیست.');
    }

    $data = $request->validate([
        'message' => 'required|string|max:2000',
    ]);

    DB::table('scanbridge_support_messages')->insert([
        'ticket_id' => $ticketRow->id,
        'sender' => 'customer',
        'message' => $data['message'],
        'created_at' => now(),
    ]);

    DB::table('scanbridge_support_tickets')->where('id', $ticketRow->id)->update([
        'status' => 'new',
        'updated_at' => now(),
    ]);

    return redirect('/panel')->with('ok', 'پیام شما ارسال شد.');
});
// SCANBRIDGE_CUSTOMER_PANEL_END

// SCANBRIDGE_ANDROID_DOWNLOAD_START
Route::get('/latest-android', function () {
    $path = public_path('downloads/Scanbridge.apk');
    if (!file_exists($path)) {
        return redirect('/download');
    }
    return response()->download($path, 'Scanbridge.apk');
});

Route::post('/admin/upload-installer-android', function (\Illuminate\Http\Request $request) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }
    $request->validate([
        'installer_android' => 'required|file|max:512000',
    ], [
        'installer_android.required' => 'فایل APK را انتخاب کنید.',
        'installer_android.file' => 'فایل نامعتبر است.',
        'installer_android.max' => 'حجم فایل بیشتر از حد مجاز است.',
    ]);
    $file = $request->file('installer_android');
    $originalName = $file->getClientOriginalName();
    $extension = strtolower($file->getClientOriginalExtension());
    if ($extension !== 'apk') {
        return redirect('/admin')->with('error', 'فقط فایل apk قابل قبول است.');
    }
    $downloadDir = public_path('downloads');
    if (!is_dir($downloadDir)) {
        mkdir($downloadDir, 0775, true);
    }
    $target = $downloadDir . '/Scanbridge.apk';
    if (file_exists($target)) {
        $backupName = 'Scanbridge-backup-' . date('Ymd-His') . '.apk';
        @rename($target, $downloadDir . '/' . $backupName);
    }
    $file->move($downloadDir, 'Scanbridge.apk');
    scb_admin_log('upload_installer_android', 'نسخه جدید اپلیکیشن اندروید آپلود شد: ' . $originalName);
    return redirect('/admin')->with('ok', 'فایل نصب اندروید با موفقیت آپلود شد.');
});
// SCANBRIDGE_ANDROID_DOWNLOAD_END

// SCANBRIDGE_PRICES_SAVE_START
Route::post('/admin/prices', function (\Illuminate\Http\Request $request) use ($requireAdmin) {
    if ($redirect = $requireAdmin($request)) {
        return $redirect;
    }

    $plans = ['Normal', 'Ttac', 'TtacPlus'];
    $durations = [12]; // فقط پلن یک‌ساله

    // مدت‌های غیرسالانه دیگر پشتیبانی نمی‌شوند — ردیف‌های قدیمی پاک شوند
    DB::table('scanbridge_prices')->whereNotIn('duration_months', [12])->delete();

    foreach ($plans as $plan) {
        foreach ($durations as $d) {
            $field = 'price_' . $plan . '_' . $d;
            $value = (int) $request->input($field, 0);
            DB::table('scanbridge_prices')
                ->updateOrInsert(
                    ['plan' => $plan, 'duration_months' => $d],
                    ['price' => $value, 'updated_at' => now()]
                );
        }

        $baseDevices = (int) $request->input('base_devices_' . $plan, 1);
        $extraPrice = (int) $request->input('extra_device_' . $plan, 0);
        DB::table('scanbridge_plan_device_pricing')
            ->updateOrInsert(
                ['plan' => $plan],
                [
                    'base_devices' => max(1, $baseDevices),
                    'price_per_extra_device' => max(0, $extraPrice),
                    'updated_at' => now(),
                ]
            );
    }

    scb_admin_log('update_prices', 'قیمت‌های پلن‌ها بروزرسانی شد.');

    return redirect('/admin')->with('ok', 'قیمت‌ها با موفقیت ذخیره شد.');
});
// SCANBRIDGE_PRICES_SAVE_END
