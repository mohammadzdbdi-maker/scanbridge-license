@php
    // ─── ویدیوهای آموزشی آپارات ───
    // برای هر بخش، ویدیو را در aparat.com آپلود کنید و «هش» آن را اینجا وارد کنید.
    // هش را از لینک ویدیو بردارید: aparat.com/v/XXXXX  →  فقط XXXXX
    // مثال: 'install' => 'abc12',
    $videos = [
        'install'      => '', // نصب و راه‌اندازی
        'license'      => '', // فعال‌سازی لایسنس
        'pairing'      => '', // اتصال موبایل
        'ttac'         => '', // تی‌تک و شیرخشک
        'delivery'     => '', // تحویل بار و تعیین وضعیت
        'barcodebank'  => '', // بانک بارکد پرمصرف
        'expiry'       => '', // هشدار انقضا و یادآور بله
        'support'      => '', // پشتیبانی و تیکت
    ];
@endphp

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>راهنمای استفاده از ScanBridge | آموزش گام‌به‌گام</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="راهنمای تصویری و ویدیویی کار با نرم‌افزار ScanBridge: نصب، فعال‌سازی لایسنس، اتصال موبایل، تی‌تک، شیرخشک، تحویل بار و پشتیبانی.">
    <style>
        @font-face {
            font-family: 'Pinar';
            src: url('/fonts/Pinar-DS1-FD-Regular.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Pinar', Tahoma, Arial, sans-serif;
            background: linear-gradient(180deg, #eef2ff 0%, #f8fafc 340px);
            color: #0f172a;
            line-height: 1.9;
        }
        .wrap { max-width: 980px; margin: 0 auto; padding: 34px 20px 60px; }

        .g-hero { text-align: center; margin-bottom: 26px; }
        .g-hero h1 { color: #1e3a8a; font-size: 30px; margin-bottom: 8px; }
        .g-hero p { color: #475569; font-size: 15px; }

        .g-toc {
            display: flex; flex-wrap: wrap; gap: 8px; justify-content: center;
            position: sticky; top: 78px; z-index: 30;
            background: rgba(248,250,252,.94); backdrop-filter: blur(10px);
            padding: 12px 8px; border-radius: 16px; margin-bottom: 30px;
            border: 1px solid #e5e7eb;
        }
        .g-toc a {
            background: #fff; border: 1px solid #e2e8f0; color: #1e3a8a;
            border-radius: 999px; padding: 6px 14px; font-size: 13px;
            font-weight: bold; text-decoration: none; transition: all .15s;
        }
        .g-toc a:hover { background: #1e3a8a; color: #fff; border-color: #1e3a8a; }

        .g-card {
            background: #fff; border: 1px solid #e5e7eb; border-radius: 22px;
            box-shadow: 0 12px 34px rgba(15,23,42,.07);
            padding: 26px 26px 22px; margin-bottom: 26px; scroll-margin-top: 150px;
        }
        .g-head { display: flex; align-items: center; gap: 14px; margin-bottom: 6px; }
        .g-head img { width: 58px; height: 58px; object-fit: contain; mix-blend-mode: multiply; flex-shrink: 0; }
        .g-head h2 { color: #1e3a8a; font-size: 21px; }
        .g-sub { color: #64748b; font-size: 13.5px; margin-bottom: 16px; margin-right: 72px; }

        ol.g-steps { counter-reset: step; list-style: none; }
        ol.g-steps li {
            counter-increment: step; position: relative;
            padding: 0 52px 14px 0; color: #334155; font-size: 14.5px;
        }
        ol.g-steps li::before {
            content: counter(step);
            position: absolute; right: 0; top: 1px;
            width: 34px; height: 34px; border-radius: 12px;
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: #fff; font-weight: bold; font-size: 15px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 10px rgba(37,99,235,.25);
        }
        ol.g-steps li b { color: #1e3a8a; }

        .g-tip {
            display: flex; gap: 10px; align-items: flex-start;
            background: #eff6ff; border: 1px solid #dbeafe; border-radius: 14px;
            padding: 12px 14px; margin-top: 6px; font-size: 13.5px; color: #1e40af;
        }
        .g-tip b { color: #1e3a8a; }

        .g-video { margin-top: 18px; }
        .g-video-frame {
            position: relative; width: 100%; padding-top: 56.25%;
            border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0;
            background: #0f172a;
        }
        .g-video-frame iframe { position: absolute; inset: 0; width: 100%; height: 100%; border: 0; }
        .g-video-soon {
            display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 6px;
            border: 2px dashed #c7d2fe; border-radius: 16px; padding: 34px 16px;
            color: #64748b; font-size: 14px; background: #f8fafc;
        }
        .g-video-soon span.big { font-size: 34px; }
        .g-video-cap { text-align: center; color: #94a3b8; font-size: 12px; margin-top: 6px; }

        @media (max-width: 640px) {
            .g-toc { position: static; }
            .g-sub { margin-right: 0; }
            ol.g-steps li { padding-right: 46px; }
            ol.g-steps li::before { width: 30px; height: 30px; font-size: 13px; }
            .g-head h2 { font-size: 18px; }
        }
    </style>
</head>
<body>

@include('partials.site-header')

<div class="wrap">

    <div class="g-hero">
        <h1>راهنمای استفاده از ScanBridge</h1>
        <p>آموزش گام‌به‌گام و ویدیویی همه‌ی بخش‌های نرم‌افزار — از نصب تا امکانات پیشرفته</p>
    </div>

    <div class="g-toc">
        <a href="#g-install">نصب و راه‌اندازی</a>
        <a href="#g-license">فعال‌سازی لایسنس</a>
        <a href="#g-pairing">اتصال موبایل</a>
        <a href="#g-ttac">تی‌تک و شیرخشک</a>
        <a href="#g-delivery">تحویل بار</a>
        <a href="#g-barcodebank">بانک بارکد</a>
        <a href="#g-expiry">هشدار انقضا</a>
        <a href="#g-support">پشتیبانی</a>
    </div>

    {{-- ۱. نصب --}}
    <div class="g-card" id="g-install">
        <div class="g-head">
            <img src="/icons/feature-license.png" alt="">
            <h2>نصب و راه‌اندازی</h2>
        </div>
        <p class="g-sub">از دانلود تا اولین اجرای برنامه روی ویندوز</p>
        <ol class="g-steps">
            <li>از صفحه‌ی <b>دانلود</b> سایت، آخرین نسخه‌ی نصب ScanBridge را دریافت کنید.</li>
            <li>فایل نصب را اجرا کنید و مراحل نصب را دنبال کنید.</li>
            <li>اگر <b>WebView2</b> روی سیستم نصب نباشد، نصب‌کننده خودش آن را همراه برنامه نصب می‌کند.</li>
            <li>پس از پایان نصب، برنامه را اجرا کنید — آیکون ScanBridge روی دسکتاپ ساخته می‌شود.</li>
        </ol>
        <div class="g-tip">💡 <span><b>نکته:</b> اگر آنتی‌ویروس یا فایروال اجازه‌ی اجرا نخواست، اجازه دهید — ScanBridge برای اتصال موبایل و لایسنس به شبکه محلی و اینترنت نیاز دارد.</span></div>
        @include('site.guide._video', ['key' => 'install', 'title' => 'نصب و راه‌اندازی'])
    </div>

    {{-- ۲. لایسنس --}}
    <div class="g-card" id="g-license">
        <div class="g-head">
            <img src="/icons/plan-normal.png" alt="">
            <h2>فعال‌سازی لایسنس</h2>
        </div>
        <p class="g-sub">وارد کردن کلید لایسنس و شروع استفاده از برنامه</p>
        <ol class="g-steps">
            <li>پس از ثبت درخواست خرید و تأیید آن، کلید لایسنس شما با الگوی <b>SCB-XXXXX-XXXXX-XXXXX-XXXXX</b> صادر می‌شود.</li>
            <li>کلید را از پیام پشتیبانی یا بخش لایسنس‌های <b>پنل کاربری</b> سایت بردارید.</li>
            <li>برنامه را باز کنید و در صفحه‌ی فعال‌سازی، کلید را وارد کرده و روی <b>فعال‌سازی</b> بزنید.</li>
            <li>اتصال اینترنت لازم است؛ پس از تأیید آنلاین، پلن و تاریخ انقضای شما نمایش داده می‌شود.</li>
        </ol>
        <div class="g-tip">💡 <span><b>نکته:</b> هر لایسنس روی تعداد مشخصی سیستم فعال می‌شود. برای انتقال به سیستم جدید، از پنل کاربری یا از طریق پشتیبانی درخواست <b>ریست دستگاه</b> بدهید.</span></div>
        @include('site.guide._video', ['key' => 'license', 'title' => 'فعال‌سازی لایسنس'])
    </div>

    {{-- ۳. اتصال موبایل --}}
    <div class="g-card" id="g-pairing">
        <div class="g-head">
            <img src="/icons/feature-barcode.png" alt="">
            <h2>اتصال موبایل به کامپیوتر</h2>
        </div>
        <p class="g-sub">تبدیل گوشی به بارکدخوان بی‌سیم با یک اسکن ساده QR</p>
        <ol class="g-steps">
            <li>موبایل و کامپیوتر را به <b>همان شبکه‌ی Wi-Fi</b> وصل کنید.</li>
            <li>در برنامه، بخش اتصال موبایل را باز کنید تا <b>کد QR</b> اتصال نمایش داده شود.</li>
            <li>با دوربین گوشی، QR را اسکن کنید — صفحه‌ی اسکن بارکد در مرورگر گوشی باز می‌شود.</li>
            <li>حالا هر بارکدی که با دوربین گوشی بگیرید، بلافاصله در برنامه روی کامپیوتر ثبت می‌شود.</li>
            <li>می‌توانید هم‌زمان از <b>چند گوشی</b> برای اسکن استفاده کنید.</li>
        </ol>
        <div class="g-tip">💡 <span><b>نکته:</b> اگر گوشی وصل نشد، اجازه‌ی دسترسی «شبکه‌های خصوصی» را در فایروال ویندوز برای ScanBridge فعال کنید.</span></div>
        @include('site.guide._video', ['key' => 'pairing', 'title' => 'اتصال موبایل به کامپیوتر'])
    </div>

    {{-- ۴. تی‌تک و شیرخشک --}}
    <div class="g-card" id="g-ttac">
        <div class="g-head">
            <img src="/icons/feature-ttac.png" alt="">
            <h2>ثبت تی‌تک و شیرخشک</h2>
        </div>
        <p class="g-sub">ثبت سریع در سامانه‌ی تی‌تک با مرورگر داخلی و فرمول شیرخشک</p>
        <ol class="g-steps">
            <li>از پنل تی‌تک برنامه، وارد حساب کاربری خود در سامانه شوید (مرورگر داخلی، بدون نیاز به خروج از برنامه).</li>
            <li>دارو را اسکن کنید تا اطلاعات آن از سامانه استعلام شود.</li>
            <li>برای <b>شیرخشک</b>، نوع فرمول را انتخاب کنید: <b>با نسخه</b> یا <b>بدون نسخه</b>.</li>
            <li>مشخصات بیمار را از طریق صفحه‌ی موبایل یا مستقیم در برنامه وارد کنید.</li>
            <li>تأیید نهایی — ثبت در تاریخچه انجام و در صورت نیاز قابل خروجی گرفتن است.</li>
        </ol>
        <div class="g-tip">💡 <span><b>نکته:</b> امکانات تی‌تک در صورت در دسترس بودن سرویس رسمی TTAC ارائه می‌شوند.</span></div>
        @include('site.guide._video', ['key' => 'ttac', 'title' => 'ثبت تی‌تک و شیرخشک'])
    </div>

    {{-- ۵. تحویل بار و تعیین وضعیت --}}
    <div class="g-card" id="g-delivery">
        <div class="g-head">
            <img src="/icons/feature-delivery.png" alt="">
            <h2>تحویل بار و تعیین وضعیت</h2>
        </div>
        <p class="g-sub">ثبت گروهی بارکدهای بار دریافتی و مدیریت وضعیت اقلام (پلن حرفه‌ای)</p>
        <ol class="g-steps">
            <li>به بخش <b>تحویل بار</b> بروید و بارکدهای بار را پشت سر هم اسکن کنید.</li>
            <li>لیست ثبت‌شده را بررسی کنید و روی <b>افزودن به داروخانه</b> بزنید.</li>
            <li>خروجی کامل لیست را در Excel یا PDF دریافت کنید.</li>
            <li>در بخش <b>تعیین وضعیت</b>، اقلام دلخواه را انتخاب و به‌صورت تکی یا <b>گروهی</b> وضعیت‌دهی کنید.</li>
        </ol>
        @include('site.guide._video', ['key' => 'delivery', 'title' => 'تحویل بار و تعیین وضعیت'])
    </div>

    {{-- ۶. بانک بارکد پرمصرف --}}
    <div class="g-card" id="g-barcodebank">
        <div class="g-head">
            <img src="/icons/feature-barcodebank.png" alt="">
            <h2>بانک بارکد پرمصرف</h2>
        </div>
        <p class="g-sub">ذخیره‌ی بارکدهای پرتکرار و اشتراک‌گذاری بین سیستم‌های شبکه</p>
        <ol class="g-steps">
            <li>بارکدهای پرمصرف داروخانه را در <b>گروه‌های دلخواه</b> ذخیره کنید.</li>
            <li>هر بار لازم بود، بدون اسکن مجدد، از بانک انتخاب کنید.</li>
            <li>بانک بین چند سیستم <b>هم‌شبکه</b> به‌سرعت به اشتراک گذاشته می‌شود.</li>
        </ol>
        @include('site.guide._video', ['key' => 'barcodebank', 'title' => 'بانک بارکد پرمصرف'])
    </div>

    {{-- ۷. هشدار انقضا و یادآور بله --}}
    <div class="g-card" id="g-expiry">
        <div class="g-head">
            <img src="/icons/feature-expiry.png" alt="">
            <h2>هشدار تاریخ انقضا و یادآور بله</h2>
        </div>
        <p class="g-sub">دیگر هیچ کالای تاریخ‌گذشته‌ای در داروخانه نمی‌ماند (پلن حرفه‌ای)</p>
        <ol class="g-steps">
            <li>در تنظیمات هشدار، <b>آستانه‌ی انقضا</b> (مثلاً ۳ ماه مانده) و دفعات یادآوری را مشخص کنید.</li>
            <li>برنامه خودکار اقلام نزدیک به انقضا را پایش و هشدار می‌دهد.</li>
            <li>برای دریافت یادآور در <b>پیام‌رسان بله</b>، یک بار اتصال بله را فعال کنید.</li>
            <li>از آن به بعد هشدارها هم در برنامه و هم در بله برایتان ارسال می‌شود.</li>
        </ol>
        @include('site.guide._video', ['key' => 'expiry', 'title' => 'هشدار انقضا و یادآور بله'])
    </div>

    {{-- ۸. پشتیبانی --}}
    <div class="g-card" id="g-support">
        <div class="g-head">
            <img src="/icons/feature-remote.png" alt="">
            <h2>پشتیبانی و ثبت تیکت</h2>
        </div>
        <p class="g-sub">ارتباط مستقیم با تیم پشتیبانی از داخل برنامه یا پنل کاربری</p>
        <ol class="g-steps">
            <li>از داخل برنامه (بخش پشتیبانی) یا <b>پنل کاربری سایت</b> یک تیکت جدید بسازید.</li>
            <li>موضوع و توضیحات را بنویسید؛ در صورت نیاز <b>فایل یا تصویر</b> پیوست کنید.</li>
            <li>پاسخ پشتیبانی به‌صورت گفتگوی رفت‌وبرگشتی در همان تیکت نمایش داده می‌شود.</li>
            <li>در صورت نیاز به بررسی مستقیم، تیم پشتیبانی از طریق <b>اتصال از راه دور</b> مشکل را رفع می‌کند.</li>
        </ol>
        @include('site.guide._video', ['key' => 'support', 'title' => 'پشتیبانی و ثبت تیکت'])
    </div>

</div>

@include('partials.site-footer')
</body>
</html>
