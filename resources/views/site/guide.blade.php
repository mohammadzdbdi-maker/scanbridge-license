<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>راهنمای استفاده از ScanBridge | آموزش گام‌به‌گام</title>
    <link rel="canonical" href="https://scanbridge.ir/guide">
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
            background: #f8fafc;
            color: #0f172a;
            line-height: 1.9;
            position: relative;
            overflow-x: hidden;
            min-height: 100vh;
        }
        body::before {
            content: "";
            position: fixed;
            top: -300px;
            left: 50%;
            transform: translateX(-50%);
            width: 900px;
            height: 900px;
            background: radial-gradient(circle at center, rgba(37,99,235,.85) 0%, rgba(37,99,235,.45) 35%, transparent 68%);
            filter: blur(70px);
            z-index: 0;
            pointer-events: none;
        }
        body::after {
            content: "";
            position: fixed;
            top: 10%;
            right: -220px;
            width: 560px;
            height: 560px;
            background: radial-gradient(circle at center, rgba(30,58,138,.35), transparent 70%);
            filter: blur(80px);
            z-index: 0;
            pointer-events: none;
        }
        .wrap { max-width: 980px; margin: 0 auto; padding: 34px 20px 60px; position: relative; z-index: 1; }

        .g-hero { text-align: center; margin-bottom: 26px; }
        .g-hero h1 { color: #1e3a8a; font-size: 30px; margin-bottom: 8px; }
        .g-hero p { color: #475569; font-size: 15px; }

        .g-toc {
            display: flex; flex-wrap: wrap; gap: 8px; justify-content: center;
            position: sticky; top: 78px; z-index: 30;
            background: rgba(255,255,255,.6); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
            padding: 12px 8px; border-radius: 16px; margin-bottom: 30px;
            border: 1px solid rgba(255,255,255,.75);
        }
        .g-toc a {
            background: #fff; border: 1px solid #e2e8f0; color: #1e3a8a;
            border-radius: 999px; padding: 6px 14px; font-size: 13px;
            font-weight: bold; text-decoration: none; transition: all .15s;
        }
        .g-toc a:hover { background: #1e3a8a; color: #fff; border-color: #1e3a8a; }

        .g-card {
            background: rgba(255,255,255,.68);
            backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,.8); border-radius: 22px;
            box-shadow: 0 12px 34px rgba(30,58,138,.10);
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

        .g-gallery { margin-top: 16px; padding-top: 14px; border-top: 1px dashed #e2e8f0; text-align: center; }
        .g-gallery-label { font-size: 13.5px; font-weight: bold; color: #1e3a8a; margin-bottom: 10px; }
        .g-gallery-thumbs { display: flex; flex-wrap: wrap; gap: 14px; justify-content: center; }
        .g-gallery-item { display: flex; flex-direction: column; align-items: center; gap: 5px; cursor: zoom-in; }
        .g-gallery-item img {
            width: 90px; height: 50px; object-fit: cover; border-radius: 8px;
            border: 1px solid #e2e8f0; box-shadow: 0 3px 8px rgba(15,23,42,.08);
            transition: transform .15s, box-shadow .15s;
        }
        .g-gallery-item:hover img { transform: translateY(-2px); box-shadow: 0 8px 16px rgba(15,23,42,.15); }
        .g-gallery-num {
            width: 18px; height: 18px; border-radius: 50%; background: #eef2ff;
            color: #1e3a8a; font-size: 11px; font-weight: bold;
            display: flex; align-items: center; justify-content: center;
        }

        .g-lightbox {
            display: none; position: fixed; inset: 0; z-index: 100;
            background: rgba(15,23,42,.86); padding: 30px;
            align-items: center; justify-content: center;
        }
        .g-lightbox.open { display: flex; }
        .g-lightbox img {
            max-width: min(100%, 1100px); max-height: 100%;
            border-radius: 14px; box-shadow: 0 20px 60px rgba(0,0,0,.4);
            cursor: pointer;
        }
        .g-lightbox-close {
            position: absolute; top: 18px; left: 18px;
            width: 40px; height: 40px; border-radius: 50%;
            background: #fff; color: #1e3a8a; font-size: 20px; font-weight: bold;
            display: flex; align-items: center; justify-content: center;
            border: none; cursor: pointer; z-index: 2;
        }
        .g-lightbox-nav {
            position: absolute; top: 50%; transform: translateY(-50%);
            width: 46px; height: 46px; border-radius: 50%;
            background: #fff; color: #1e3a8a; font-size: 24px; font-weight: bold;
            border: none; cursor: pointer; z-index: 2;
            display: flex; align-items: center; justify-content: center;
        }
        .g-lightbox-prev { left: 18px; }
        .g-lightbox-next { right: 18px; }
        .g-lightbox-counter {
            position: absolute; bottom: 18px; left: 50%; transform: translateX(-50%);
            color: #fff; font-size: 13px; background: rgba(0,0,0,.4);
            padding: 4px 14px; border-radius: 999px;
        }

        @media (max-width: 640px) {
            .g-toc { position: static; }
            .g-sub { margin-right: 0; }
            ol.g-steps li { padding-right: 46px; }
            ol.g-steps li::before { width: 30px; height: 30px; font-size: 13px; }
            .g-head h2 { font-size: 18px; }
            .g-gallery-item img { width: 74px; height: 42px; }
            .g-lightbox-nav { width: 38px; height: 38px; font-size: 20px; }
            .g-lightbox-prev { left: 8px; }
            .g-lightbox-next { right: 8px; }
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
        <a href="#g-modemlock">قفل مودم</a>
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

        <div class="g-gallery">
            <div class="g-gallery-label">📷 راهنمای تصویری</div>
            <div class="g-gallery-thumbs" dir="ltr">
                <div class="g-gallery-item" onclick="gOpenLightbox(0)">
                    <img src="/guide-photos/install-download-1.jpg" alt="دانلود از سایت - مرحله ۱" loading="lazy">
                    <span class="g-gallery-num">1</span>
                </div>
                <div class="g-gallery-item" onclick="gOpenLightbox(1)">
                    <img src="/guide-photos/install-download-2.jpg" alt="دانلود از سایت - مرحله ۲" loading="lazy">
                    <span class="g-gallery-num">2</span>
                </div>
                <div class="g-gallery-item" onclick="gOpenLightbox(2)">
                    <img src="/guide-photos/install-run-1.jpg" alt="اجرای فایل نصب - مرحله ۱" loading="lazy">
                    <span class="g-gallery-num">3</span>
                </div>
                <div class="g-gallery-item" onclick="gOpenLightbox(3)">
                    <img src="/guide-photos/install-run-2.jpg" alt="اجرای فایل نصب - مرحله ۲" loading="lazy">
                    <span class="g-gallery-num">4</span>
                </div>
            </div>
        </div>
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
    </div>

    {{-- ۳. اتصال موبایل --}}
    <div class="g-card" id="g-pairing">
        <div class="g-head">
            <img src="/icons/feature-barcode.png" alt="">
            <h2>اتصال موبایل به کامپیوتر</h2>
        </div>
        <p class="g-sub">دو راه: وای‌فای (اسکن QR) یا کابل USB</p>
        <ol class="g-steps">
            <li>اپلیکیشن موبایل ScanBridge را نصب کنید (از صفحه‌ی دانلود سایت یا کافه‌بازار).</li>
            <li>در اپ، دکمه‌ی <b>«اتصال به سیستم»</b> را بزنید و روش را انتخاب کنید:</li>
            <li><b>وای‌فای:</b> گوشی و کامپیوتر در همان شبکه باشند و کد QR نمایش‌داده‌شده در نرم‌افزار ویندوز را با اپ اسکن کنید.</li>
            <li><b>کابل USB:</b> گوشی را با کابل وصل کنید و در تنظیمات گوشی «USB Tethering» را روشن کنید — اپ خودکار وصل می‌شود. (با فعال‌سازی یک‌بار USB Debugging حتی Tethering هم لازم نیست)</li>
            <li>بعد از اتصال، هر بارکدی که با دوربین بگیرید بلافاصله در نرم‌افزار ویندوز ثبت می‌شود — با زوم برای بارکدهای ریز و چراغ‌قوه برای محیط تاریک.</li>
            <li>می‌توانید هم‌زمان از <b>چند گوشی</b> برای اسکن استفاده کنید.</li>
        </ol>
        <div class="g-tip">💡 <span><b>نکته:</b> داروخانه بدون وای‌فای یا اینترنتِ پرسنل؟ از «حالت داروخانه» داخل اپ استفاده کنید — اینترنت گوشی کامل قطع می‌شود و فقط ارتباط با سیستم روی شبکه‌ی محلی باز می‌ماند.</span></div>
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
    </div>

    {{-- ۶. بانک بارکد پرمصرف --}}
    <div class="g-card" id="g-barcodebank">
        <div class="g-head">
            <img src="/icons/feature-barcodebank.png" alt="">
            <h2>بانک بارکد پرمصرف</h2>
        </div>
        <p class="g-sub">ذخیره‌ی بارکدهای پرتکرار و اشتراک‌گذاری بین سیستم‌های شبکه (پلن حرفه‌ای)</p>
        <ol class="g-steps">
            <li>بارکدهای پرمصرف داروخانه را در <b>گروه‌های دلخواه</b> ذخیره کنید.</li>
            <li>هر بار لازم بود، بدون اسکن مجدد، از بانک انتخاب کنید.</li>
            <li>بانک بین چند سیستم <b>هم‌شبکه</b> به‌سرعت به اشتراک گذاشته می‌شود.</li>
        </ol>
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
    </div>

    {{-- قفل اینترنت پرسنل (مودم) --}}
    <div class="g-card" id="g-modemlock">
        <div class="g-head">
            <img src="/icons/trust-mobile.png" alt="">
            <h2>قفل اینترنت پرسنل (تنظیم مودم)</h2>
        </div>
        <p class="g-sub">گوشی‌های پرسنل به وای‌فای داروخانه وصل می‌شوند، اما فقط ScanBridge کار می‌کند — بدون اینترنت (مخصوص پلن‌های تی‌تک و حرفه‌ای)</p>
        <ol class="g-steps">
            <li>با پشتیبانی ScanBridge در ارتباط باشید؛ تنظیمات مودم داروخانه را از راه دور یا تلفنی با هم انجام می‌دهیم.</li>
            <li>مودم طوری تنظیم می‌شود که گوشی‌های پرسنل <b>اینترنت نداشته باشند</b> اما ارتباطشان با سیستم و اسکن ScanBridge کاملاً سالم بماند.</li>
            <li>از آن به بعد گوشی پرسنل فقط یک ابزار اسکن است — نه بیشتر؛ حتی اگر بخواهد هم نمی‌تواند دور بزند.</li>
            <li>هر وقت خواستید (مثلاً گوشی جدید برای پرسنل)، با یک پیام به پشتیبانی، تنظیم به‌روز می‌شود.</li>
        </ol>
        <div class="g-tip">🔒 <span><b>چرا مودم؟</b> محدودیت از سمت مودم داروخانه است، نه گوشی پرسنل — پس قابل غیرفعال‌کردن توسط پرسنل نیست و همه‌ی گوشی‌ها (اندروید و آیفون) را می‌گیرد.</span></div>
        <div style="text-align:center; background:linear-gradient(135deg,#1e3a8a,#2563eb); color:#fff; border-radius:16px; padding:16px 18px; margin-top:14px;">
            <div style="font-size:15px; font-weight:bold; margin-bottom:6px;">این سرویس روی پلن‌های تی‌تک و حرفه‌ای فعال است</div>
            <a href="https://wa.me/989136346309" style="display:inline-block; background:#fff; color:#1e3a8a; font-weight:bold; border-radius:12px; padding:10px 24px; text-decoration:none;">درخواست فعال‌سازی از پشتیبانی</a>
        </div>
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
    </div>

</div>

@include('partials.site-footer')

<div class="g-lightbox" id="g-lightbox" onclick="gCloseLightbox()">
    <button class="g-lightbox-close" onclick="event.stopPropagation(); gCloseLightbox()">✕</button>
    <button class="g-lightbox-nav g-lightbox-prev" dir="ltr" onclick="gPrev(event)">‹</button>
    <img id="g-lightbox-img" src="" alt="" onclick="event.stopPropagation(); gNext()">
    <button class="g-lightbox-nav g-lightbox-next" dir="ltr" onclick="gNext(event)">›</button>
    <div class="g-lightbox-counter" id="g-lightbox-counter"></div>
</div>
<script>
    var gImages = [
        { src: '/guide-photos/install-download-1.jpg', alt: 'دانلود از سایت - مرحله ۱' },
        { src: '/guide-photos/install-download-2.jpg', alt: 'دانلود از سایت - مرحله ۲' },
        { src: '/guide-photos/install-run-1.jpg', alt: 'اجرای فایل نصب - مرحله ۱' },
        { src: '/guide-photos/install-run-2.jpg', alt: 'اجرای فایل نصب - مرحله ۲' }
    ];
    var gIndex = 0;

    function gRenderLightbox() {
        var item = gImages[gIndex];
        document.getElementById('g-lightbox-img').src = item.src;
        document.getElementById('g-lightbox-img').alt = item.alt;
        document.getElementById('g-lightbox-counter').textContent = (gIndex + 1) + ' / ' + gImages.length;
    }
    function gOpenLightbox(i) {
        gIndex = i;
        gRenderLightbox();
        document.getElementById('g-lightbox').classList.add('open');
    }
    function gNext(e) {
        if (e) e.stopPropagation();
        gIndex = (gIndex + 1) % gImages.length;
        gRenderLightbox();
    }
    function gPrev(e) {
        if (e) e.stopPropagation();
        gIndex = (gIndex - 1 + gImages.length) % gImages.length;
        gRenderLightbox();
    }
    function gCloseLightbox() {
        document.getElementById('g-lightbox').classList.remove('open');
    }
    document.addEventListener('keydown', function (e) {
        if (!document.getElementById('g-lightbox').classList.contains('open')) return;
        if (e.key === 'Escape') gCloseLightbox();
        if (e.key === 'ArrowLeft') gNext();
        if (e.key === 'ArrowRight') gPrev();
    });
</script>
</body>
</html>
