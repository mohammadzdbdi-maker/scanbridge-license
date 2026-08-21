<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Carbon\Carbon;

function scb_admin_ok(Request $request): bool {
    $token = $request->bearerToken() ?: $request->header('X-Admin-Token');
    return is_string($token) && hash_equals((string) env('LICENSE_ADMIN_TOKEN'), $token);
}

function scb_base64url(string $data): string {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function scb_features(string $plan): array {
    return match ($plan) {
        'Trial' => [
            'barcodeBridge' => true,
            'history' => true,
            'ttac' => true,
            'formula' => true,
            'exports' => true,
            'receiveStatus' => true,
            'cargoDelivery' => true,
        ],
        'Ttac' => [
            'barcodeBridge' => true,
            'history' => true,
            'ttac' => true,
            'formula' => true,
            'exports' => true,
            'receiveStatus' => false,
            'cargoDelivery' => false,
        ],
        'TtacPlus' => [
            'barcodeBridge' => true,
            'history' => true,
            'ttac' => true,
            'formula' => true,
            'exports' => true,
            'receiveStatus' => true,
            'cargoDelivery' => true,
        ],
        default => [
            'barcodeBridge' => true,
            'history' => true,
            'ttac' => false,
            'formula' => false,
            'exports' => false,
            'receiveStatus' => false,
            'cargoDelivery' => false,
        ],
    };
}

function scb_sign_license(array $payload): string {
    $payloadJson = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $payloadPart = scb_base64url($payloadJson);

    $privateKeyPath = base_path(env('LICENSE_PRIVATE_KEY_PATH', 'storage/app/license-keys/private.pem'));
    $privateKey = file_get_contents($privateKeyPath);

    openssl_sign($payloadPart, $signature, $privateKey, OPENSSL_ALGO_SHA256);

    return 'SCB2.' . $payloadPart . '.' . scb_base64url($signature);
}

function scb_license_response(object $license, string $deviceId): array {
    $now = Carbon::now();

    $payload = [
        'iss' => 'license.scanbridge.ir',
        'app' => 'Scanbridge',
        'license_id' => $license->id,
        'license_key' => $license->license_key,
        'plan' => $license->plan,
        'status' => $license->status,
        'customer_name' => $license->customer_name,
        'pharmacy_name' => $license->pharmacy_name,
        'mobile' => $license->mobile,
        'device_id' => $deviceId,
        'features' => scb_features($license->plan),
        'issued_at' => $now->toIso8601String(),
        'expires_at' => $license->expires_at,
    ];

    return [
        'success' => true,
        'server_time' => $now->toIso8601String(),
        'license' => $payload,
        'signed_license' => scb_sign_license($payload),
    ];
}

Route::get('/health', function () {
    return response()->json([
        'success' => true,
        'app' => 'Scanbridge License API',
        'time' => now()->toIso8601String(),
    ]);
});

Route::post('/admin/licenses', function (Request $request) {
    if (!scb_admin_ok($request)) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }

    $data = $request->validate([
        'plan' => 'required|string|in:Normal,Ttac,TtacPlus,Trial',
        'customer_name' => 'nullable|string|max:255',
        'pharmacy_name' => 'nullable|string|max:255',
        'max_devices' => 'nullable|integer|min:1|max:50',
        'expires_at' => 'nullable|date',
        'days' => 'nullable|integer|min:1|max:3650',
    ]);

    $expiresAt = $data['expires_at'] ?? null;
    if (!$expiresAt && isset($data['days'])) {
        $expiresAt = now()->addDays((int) $data['days'])->toDateTimeString();
    }

    if (!$expiresAt && $data['plan'] === 'Trial') {
        $expiresAt = now()->addDays(14)->toDateTimeString();
    }

    $licenseKey = 'SCB-' . strtoupper(Str::random(5)) . '-' . strtoupper(Str::random(5)) . '-' . strtoupper(Str::random(5)) . '-' . strtoupper(Str::random(5));

    $id = DB::table('scanbridge_licenses')->insertGetId([
        'license_key' => $licenseKey,
        'plan' => $data['plan'],
        'customer_name' => $data['customer_name'] ?? null,
        'pharmacy_name' => $data['pharmacy_name'] ?? null,
        'status' => 'active',
        'max_devices' => $data['max_devices'] ?? 1,
        'expires_at' => $expiresAt,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json([
        'success' => true,
        'id' => $id,
        'license_key' => $licenseKey,
        'plan' => $data['plan'],
        'expires_at' => $expiresAt,
    ]);
});

Route::post('/license/activate', function (Request $request) {
    $data = $request->validate([
        'license_key' => 'required|string',
        'device_id' => 'required|string|max:255',
        'device_name' => 'nullable|string|max:255',
        'app_version' => 'nullable|string|max:50',
        'pharmacy_name' => 'nullable|string|max:255',
    ]);

    $license = DB::table('scanbridge_licenses')->where('license_key', $data['license_key'])->first();

    if (!$license) {
        return response()->json(['success' => false, 'message' => 'License not found'], 404);
    }

    if ($license->status !== 'active') {
        return response()->json(['success' => false, 'message' => 'License is not active'], 403);
    }

    if ($license->expires_at && Carbon::parse($license->expires_at)->isPast()) {
        return response()->json(['success' => false, 'message' => 'License expired'], 403);
    }

    $existing = DB::table('scanbridge_activations')
        ->where('license_id', $license->id)
        ->where('device_id', $data['device_id'])
        ->first();

    if (!$existing) {
        $count = DB::table('scanbridge_activations')->where('license_id', $license->id)->count();
        if ($count >= (int) $license->max_devices) {
            return response()->json(['success' => false, 'message' => 'Device limit reached'], 403);
        }

        DB::table('scanbridge_activations')->insert([
            'license_id' => $license->id,
            'device_id' => $data['device_id'],
            'device_name' => $data['device_name'] ?? null,
            'app_version' => $data['app_version'] ?? null,
            'ip_address' => $request->ip(),
            'activated_at' => now(),
            'last_seen_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    } else {
        DB::table('scanbridge_activations')->where('id', $existing->id)->update([
            'device_name' => $data['device_name'] ?? $existing->device_name,
            'app_version' => $data['app_version'] ?? $existing->app_version,
            'ip_address' => $request->ip(),
            'last_seen_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return response()->json(scb_license_response($license, $data['device_id']));
});

Route::post('/license/validate', function (Request $request) {
    $data = $request->validate([
        'license_key' => 'required|string',
        'device_id' => 'required|string|max:255',
    ]);

    $license = DB::table('scanbridge_licenses')->where('license_key', $data['license_key'])->first();

    if (!$license) {
        return response()->json(['success' => false, 'message' => 'License not found'], 404);
    }

    $activation = DB::table('scanbridge_activations')
        ->where('license_id', $license->id)
        ->where('device_id', $data['device_id'])
        ->first();

    if (!$activation) {
        return response()->json(['success' => false, 'message' => 'Device not activated'], 403);
    }

    if ($license->status !== 'active') {
        return response()->json(['success' => false, 'message' => 'License is not active'], 403);
    }

    if ($license->expires_at && Carbon::parse($license->expires_at)->isPast()) {
        return response()->json(['success' => false, 'message' => 'License expired'], 403);
    }

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

Route::post('/license/heartbeat', function (Request $request) {
    return app('router')->getRoutes()->match(Request::create('/api/license/validate', 'POST', $request->all()))->run();
});

Route::get('/license/public-key', function () {
    $path = base_path(env('LICENSE_PUBLIC_KEY_PATH', 'storage/app/license-keys/public.pem'));
    if (!file_exists($path)) {
        return response('Public key not found', 404);
    }

    return response(file_get_contents($path), 200)
        ->header('Content-Type', 'text/plain; charset=UTF-8');
});
