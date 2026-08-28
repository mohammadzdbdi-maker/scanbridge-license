<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'kavenegar' => [
        'key' => env('KAVENEGAR_API_KEY'),
        'sender' => env('KAVENEGAR_SENDER'),
    ],

    // کلید روشن/خاموشِ ثبت‌نام و بازیابی رمز با کد پیامکی (OTP).
    // تا زمان آماده شدن خط خدماتی کاوه‌نگار، خاموش (false) بماند — ثبت‌نام مستقیم انجام می‌شود.
    // برای فعال‌سازی بعداً: در .env مقدار SMS_OTP_ENABLED=true بگذارید.
    'scanbridge' => [
        'sms_otp_enabled' => env('SMS_OTP_ENABLED', false),
    ],

];
