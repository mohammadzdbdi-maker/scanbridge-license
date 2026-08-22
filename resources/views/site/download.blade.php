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
    <style>
        @font-face {
            font-family: 'Pinar';
            src: url('/fonts/Pinar-DS1-FD-Regular.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Pinar', Tahoma, Arial, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(37,99,235,.12), transparent 35%),
                #f8fafc;
            color: #0f172a;
        }
        .wrap {
            max-width: 980px;
            margin: 44px auto;
            padding: 0 18px;
        }
        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 30px;
            padding: 32px;
            box-shadow: 0 18px 60px rgba(15,23,42,.08);
        }
        h1 {
            color: #1e3a8a;
            text-align: center;
            margin: 0 0 10px;
            font-size: 30px;
        }
        .lead {
            color: #64748b;
            line-height: 1.9;
            text-align: center;
            margin: 0 0 28px;
        }
        .download-box {
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: white;
            border-radius: 26px;
            padding: 26px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 18px;
            align-items: center;
            margin-bottom: 20px;
        }
        .download-box h2 {
            margin: 0 0 8px;
            font-size: 24px;
            color: #fff !important;
        }
        .download-box p {
            margin: 0;
            color: #dbeafe;
        }
        .meta-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 24px;
        }
        .meta {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            padding: 14px;
            text-align: center;
        }
        .meta strong {
            display: block;
            color: #1e3a8a;
            font-size: 18px;
            margin-bottom: 4px;
            direction: ltr;
        }
        .meta span {
            color: #64748b;
            font-size: 13px;
        }
        a, button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 13px 22px;
            border-radius: 16px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border: 0;
            cursor: pointer;
            font-family: 'Pinar', Tahoma, Arial, sans-serif;
            font-size: 14px;
        }
        .green { background: #16a34a; }
        .blue { background: #2563eb; }
        .dark { background: #0f172a; }
        .orange { background: #f97316; }
        .white-btn {
            background: white;
            color: #1e3a8a;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin: 24px 0;
        }
        .info {
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            border-radius: 22px;
            padding: 18px;
        }
        .info h3 {
            margin: 0 0 10px;
            color: #1e3a8a;
            font-size: 18px;
        }
        .info p, .info li {
            color: #64748b;
            line-height: 1.8;
            font-size: 13px;
        }
        .info ul {
            padding-right: 18px;
            margin: 0;
        }
        .note {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #9a3412;
            padding: 14px;
            border-radius: 18px;
            line-height: 1.8;
            font-size: 13px;
            margin-top: 18px;
        }
        .actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-top: 24px;
        }
        @media(max-width:800px){
            .download-box, .grid, .meta-grid { grid-template-columns: 1fr; }
            .card { padding: 22px; }
        }
        @media(max-width:480px){
            .wrap { margin: 24px auto; padding: 0 12px; }
            .card { padding: 16px; border-radius: 22px; }
            h1 { font-size: 22px; }
        }
    </style>

    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta property="og:title" content="دانلود Scanbridge | دریافت فایل نصب نرم‌افزار">
    <meta property="og:description" content="دانلود آخرین نسخه نصب Scanbridge برای ویندوز به همراه راهنمای نصب، WebView2 و فعال‌سازی لایسنس.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://scanbridge.ir">
    <meta property="og:site_name" content="Scanbridge">

<style>/*SCB_GLASS_V1*/
body{background:linear-gradient(135deg,#eef2f7 0%,#e3ecfa 55%,#dbeafe 130%)!important;background-attachment:fixed!important;color:#0f172a!important;}
.nav{background:rgba(255,255,255,.78)!important;backdrop-filter:blur(14px)!important;-webkit-backdrop-filter:blur(14px)!important;border-bottom:1px solid rgba(148,163,184,.25)!important;}
.card,.plan{background:rgba(255,255,255,.72)!important;backdrop-filter:blur(16px)!important;-webkit-backdrop-filter:blur(16px)!important;border:1px solid rgba(255,255,255,.9)!important;box-shadow:0 14px 40px rgba(30,58,138,.14)!important;}
.hero{background:rgba(255,255,255,.5)!important;backdrop-filter:blur(12px)!important;}
.stat{background:rgba(255,255,255,.8)!important;backdrop-filter:blur(12px)!important;border:1px solid rgba(255,255,255,.9)!important;}
h1,h2,h3,h4{color:#1e3a8a!important;}
label,td,th{color:#0f172a!important;}
input,select,textarea{background:rgba(255,255,255,.85)!important;border:1px solid #cbd5e1!important;color:#0f172a!important;}
.cta{background:linear-gradient(135deg,#1e3a8a,#2563eb)!important;color:#fff!important;}
.cta h2,.cta p{color:#fff!important;}
.brand{color:#1e3a8a!important;}
</style>

<style>/*SCB_FONT_ALL*/
@font-face{font-family:'Pinar';src:url('/fonts/Pinar-DS1-FD-Regular.woff2') format('woff2');font-weight:normal;font-style:normal;font-display:swap;}
html,body,button,input,select,textarea,a,th,td,label,span,div,h1,h2,h3,h4,h5,h6,small,strong,summary{font-family:'Pinar',Tahoma,Arial,sans-serif!important;}
</style>

<style>/*SCB_ICON_BG_FIX*/
.ic{background:transparent!important;mix-blend-mode:multiply!important;}
.brand-logo,.brand img{background:transparent!important;mix-blend-mode:multiply!important;}
.feat-icon,.plan-icon,.ico-img{background:transparent!important;mix-blend-mode:multiply!important;}
.stat img,.cust-stat img{background:transparent!important;mix-blend-mode:multiply!important;}
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
            <a class="white-btn" href="/latest">دانلود آخرین نسخه</a>
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
                <a class="white-btn" href="/latest-android">دانلود اپلیکیشن اندروید</a>
            @else
                <span class="white-btn" style="opacity:.6; cursor:default;">به زودی</span>
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
                <a class="blue" href="https://developer.microsoft.com/microsoft-edge/webview2/" target="_blank">دانلود WebView2</a>
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
