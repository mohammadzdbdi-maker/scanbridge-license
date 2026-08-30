@php
    $version = '1.0.0';
    $installerPath = public_path('downloads/Scanbridge-Setup.exe');
    $installerExists = file_exists($installerPath);
    $installerSize = '-';
    $updatedAtPersian = '-';

    if (!function_exists('scb_gregorian_to_jalali')) {
        function scb_gregorian_to_jalali($gy, $gm, $gd) {
            $g_d_m = [0,31,59,90,120,151,181,212,243,273,304,334];

            if ($gy > 1600) {
                $jy = 979;
                $gy -= 1600;
            } else {
                $jy = 0;
                $gy -= 621;
            }

            $gy2 = ($gm > 2) ? ($gy + 1) : $gy;
            $days = 365 * $gy
                + intdiv($gy2 + 3, 4)
                - intdiv($gy2 + 99, 100)
                + intdiv($gy2 + 399, 400)
                - 80
                + $gd
                + $g_d_m[$gm - 1];

            $jy += 33 * intdiv($days, 12053);
            $days %= 12053;

            $jy += 4 * intdiv($days, 1461);
            $days %= 1461;

            if ($days > 365) {
                $jy += intdiv($days - 1, 365);
                $days = ($days - 1) % 365;
            }

            if ($days < 186) {
                $jm = 1 + intdiv($days, 31);
                $jd = 1 + ($days % 31);
            } else {
                $jm = 7 + intdiv($days - 186, 30);
                $jd = 1 + (($days - 186) % 30);
            }

            return [$jy, $jm, $jd];
        }
    }

    if ($installerExists) {
        $bytes = filesize($installerPath);
        $installerSize = number_format($bytes / 1024 / 1024, 1) . ' MB';

        $dt = new DateTime('@' . filemtime($installerPath));
        $dt->setTimezone(new DateTimeZone('Asia/Tehran'));

        [$jy, $jm, $jd] = scb_gregorian_to_jalali(
            (int)$dt->format('Y'),
            (int)$dt->format('m'),
            (int)$dt->format('d')
        );

        $updatedAtPersian = sprintf(
            '%04d/%02d/%02d - %02d:%02d',
            $jy,
            $jm,
            $jd,
            (int)$dt->format('H'),
            (int)$dt->format('i')
        );
    }


@endphp

@php
    $androidPath = public_path('downloads/Scanbridge.apk');
    $androidExists = file_exists($androidPath);
    $androidSize = '-';
    $androidUpdatedAtPersian = '-';

    if ($androidExists) {
        $bytes2 = filesize($androidPath);
        $androidSize = number_format($bytes2 / 1024 / 1024, 1) . ' MB';

        $dt2 = new DateTime('@' . filemtime($androidPath));
        $dt2->setTimezone(new DateTimeZone('Asia/Tehran'));

        [$jy2, $jm2, $jd2] = scb_gregorian_to_jalali(
            (int)$dt2->format('Y'),
            (int)$dt2->format('m'),
            (int)$dt2->format('d')
        );

        $androidUpdatedAtPersian = sprintf(
            '%04d/%02d/%02d - %02d:%02d',
            $jy2,
            $jm2,
            $jd2,
            (int)$dt2->format('H'),
            (int)$dt2->format('i')
        );
    }
@endphp

<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>دانلود Scanbridge | دریافت فایل نصب نرم‌افزار</title>
    <link rel="canonical" href="https://scanbridge.ir/download">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="دانلود آخرین نسخه نصب Scanbridge برای ویندوز به همراه راهنمای نصب، WebView2 و فعال‌سازی لایسنس.">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta property="og:title" content="دانلود Scanbridge | دریافت فایل نصب نرم‌افزار">
    <meta property="og:description" content="دانلود آخرین نسخه نصب Scanbridge برای ویندوز به همراه راهنمای نصب، WebView2 و فعال‌سازی لایسنس.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://scanbridge.ir/download">
    <meta property="og:site_name" content="Scanbridge">

    <style>
        :root {
            --bg: #f7f8fa;
            --surface: #ffffff;
            --elevated: #f2f4f7;
            --text: #0f172a;
            --muted: #64748b;
            --border: #e5e7eb;
            --accent: #1e3a8a;
            --accent-2: #2563eb;
            --green: #16a34a;
            --orange: #f97316;
            --radius-btn: 12px;
            --radius-card: 24px;
            --sp-2: 8px; --sp-3: 12px; --sp-4: 16px; --sp-5: 20px; --sp-6: 24px; --sp-8: 32px;
            --font: 'Pinar', Tahoma, Arial, sans-serif;
        }
        @font-face {
            font-family: 'Pinar';
            src: url('/fonts/Pinar-DS1-FD-Regular.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        * { box-sizing: border-box; }
        body { margin: 0; font-family: var(--font); background: var(--bg); color: var(--text); }
        a { text-decoration: none; }

        .wrap { max-width: 980px; margin: 44px auto; padding: 0 18px; }
        .card {
            background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-card);
            padding: var(--sp-8); box-shadow: 0 12px 40px rgba(15,23,42,.06);
        }
        h1 { color: var(--accent); text-align: center; margin: 0 0 10px; font-size: 30px; }
        .lead { color: var(--muted); line-height: 1.9; text-align: center; margin: 0 0 28px; }

        .download-box {
            background: linear-gradient(135deg, var(--accent), var(--accent-2)); color: white;
            border-radius: 22px; padding: var(--sp-6); display: grid; grid-template-columns: 1fr auto;
            gap: var(--sp-4); align-items: center; margin-bottom: var(--sp-5);
        }
        .download-box h2 { margin: 0 0 8px; font-size: 24px; color: #fff !important; }
        .download-box p { margin: 0; color: #dbeafe; }

        .grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: var(--sp-3); margin: var(--sp-6) 0; }
        .info { border: 1px solid var(--border); background: var(--elevated); border-radius: 18px; padding: var(--sp-4); }
        .info h3 { margin: 0 0 var(--sp-2); color: var(--accent); font-size: 18px; }
        .info p, .info li { color: var(--muted); line-height: 1.8; font-size: 13px; }
        .info ul { padding-right: 18px; margin: 0; }

        .note {
            background: #fff7ed; border: 1px solid #fed7aa; color: #9a3412;
            padding: var(--sp-4); border-radius: 16px; line-height: 1.8; font-size: 13px; margin-top: var(--sp-5);
        }

        .btn {
            display: inline-flex; align-items: center; justify-content: center;
            padding: 12px 22px; border-radius: var(--radius-btn); color: #fff; text-decoration: none;
            font-weight: bold; border: 0; cursor: pointer; font-family: var(--font); font-size: 14px;
            transition: filter .15s ease;
        }
        .btn:hover { filter: brightness(1.06); }
        .green { background: var(--green); }
        .blue { background: var(--accent-2); }
        .dark { background: var(--text); }
        .orange { background: var(--orange); }
        .white-btn { background: white; color: var(--accent); }

        @media(max-width:800px){
            .download-box, .grid { grid-template-columns: 1fr; }
            .card { padding: var(--sp-6); }
        }
        @media(max-width:480px){
            .wrap { margin: 24px auto; padding: 0 12px; }
            .card { padding: 16px; border-radius: 22px; }
            h1 { font-size: 22px; }
        }
    </style>
</head>
<body>

@include('partials.site-header')
<div class="wrap">
    <div class="card">
        <h1>دانلود Scanbridge</h1>
        <p class="lead">
            آخرین نسخه نصب نرم‌افزار Scanbridge را از این صفحه دریافت کنید.
        </p>

        <div class="download-box">
            <div>
                <h2>Scanbridge Setup</h2>
                <p>
                    مناسب Windows 10 / 11
                    @if($installerExists)
                        — حجم {{ $installerSize }} — بروزرسانی {{ $updatedAtPersian }}
                    @endif
                </p>
            </div>
            <a class="btn white-btn" href="/latest">دانلود آخرین نسخه</a>
        </div>

        <div class="download-box" style="background: linear-gradient(135deg, #16a34a, #15803d);">
            <div>
                <h2>Scanbridge اندروید</h2>
                <p>
                    @if($androidExists)
                        نسخه فعلی — حجم {{ $androidSize }} — بروزرسانی {{ $androidUpdatedAtPersian }}
                    @else
                        به‌زودی در دسترس قرار می‌گیرد
                    @endif
                </p>
            </div>
            @if($androidExists)
                <a class="btn white-btn" href="/latest-android">دانلود اپلیکیشن اندروید</a>
            @else
                <span class="btn white-btn" style="opacity:.6; cursor:default;">به زودی</span>
            @endif
        </div>


        <div class="grid">
            <div class="info">
                <h3>راهنمای نصب</h3>
                <ul>
                    <li>فایل نصب را دانلود کنید.</li>
                    <li>روی فایل Setup دوبار کلیک کنید.</li>
                    <li>بعد از نصب، برنامه را از آیکون دسکتاپ باز کنید.</li>
                    <li>کلید لایسنس را وارد و فعال‌سازی آنلاین را بزنید.</li>
                </ul>
            </div>

            <div class="info">
                <h3>نیازمندی‌ها</h3>
                <ul>
                    <li>Windows 10 یا Windows 11</li>
                    <li>اتصال اینترنت برای فعال‌سازی</li>
                    <li>WebView2 برای مرورگر داخلی تی‌تک</li>
                    <li>دسترسی به تی‌تک برای امکانات مرتبط</li>
                </ul>
            </div>

            <div class="info">
                <h3>WebView2</h3>
                <p>
                    اگر هنگام ورود به تی‌تک پیام نصب WebView2 دیدید،
                    از لینک زیر نسخه رسمی Microsoft را نصب کنید.
                </p>
                <a class="btn blue" href="https://developer.microsoft.com/microsoft-edge/webview2/" target="_blank">دانلود WebView2</a>
            </div>
        </div>

        <div class="note">
            برای استفاده از نرم‌افزار، نیاز به کلید لایسنس دارید.
            اگر هنوز لایسنس ندارید، از بخش خرید/تمدید درخواست خود را ارسال کنید.
        </div>

    </div>
</div>

@include('partials.site-footer')
</body>
</html>
