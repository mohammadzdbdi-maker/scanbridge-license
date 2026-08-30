<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>ScanBridge | نرم‌افزار هوشمند اسکن بارکد برای داروخانه، سوپرمارکت و فروشگاه</title>
    <link rel="canonical" href="https://scanbridge.ir/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ScanBridge؛ سیستم هوشمند اسکن بارکد و مدیریت عملیات — کنار نرم‌افزار فعلی شما، برای داروخانه‌ها و همچنین سوپرمارکت، فروشگاه و هایپرمارکت.">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta property="og:title" content="ScanBridge | اسکن بارکد و مدیریت عملیات، برای هر کسب‌وکاری">
    <meta property="og:description" content="ScanBridge نرم‌افزار اتصال بارکدخوان موبایل به کامپیوتر و مدیریت عملیات — برای داروخانه‌ها و همچنین سوپرمارکت، فروشگاه و هایپرمارکت.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://scanbridge.ir">
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
            --radius-btn: 12px;
            --radius-card: 24px;
            --sp-2: 8px; --sp-3: 12px; --sp-4: 16px; --sp-5: 20px;
            --sp-6: 24px; --sp-8: 32px; --sp-10: 40px; --sp-12: 48px; --sp-16: 64px;
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
        body {
            margin: 0; font-family: var(--font); color: var(--text); line-height: 1.75;
            background: var(--bg);
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
        .scb-nav, header.hero, .chooser, .trust, footer.site-footer { position: relative; z-index: 1; }
        a { text-decoration: none; }

        .hero { padding: var(--sp-16) 20px var(--sp-10); text-align: center; }
        .hero .container { max-width: 760px; margin: auto; }
        .badge {
            display: inline-block; background: rgba(255,255,255,.6);
            backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,.7);
            color: var(--accent); padding: 6px 14px; border-radius: 999px; margin-bottom: var(--sp-5);
            font-weight: bold; font-size: 13px;
        }
        h1 { font-size: 38px; line-height: 1.4; margin: 0 0 var(--sp-4); color: var(--text); }
        .hero p { color: var(--muted); font-size: 17px; margin: 0; }

        .chooser {
            max-width: 980px; margin: 0 auto; padding: 0 20px var(--sp-16);
            display: grid; grid-template-columns: 1fr 1fr; gap: var(--sp-6);
        }
        .choice {
            background: rgba(255,255,255,.62);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,.75); border-radius: var(--radius-card);
            padding: var(--sp-8) var(--sp-6); text-align: center; box-shadow: 0 20px 60px rgba(30,58,138,.14);
            display: flex; flex-direction: column; align-items: center;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .choice:hover { transform: translateY(-6px) scale(1.04); box-shadow: 0 26px 68px rgba(30,58,138,.22); }
        .choice-icon-box {
            height: 190px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            margin-bottom: var(--sp-4);
        }
        .choice-icon {
            max-width: 220px;
            max-height: 190px;
            width: auto;
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 14px 20px rgba(15,23,42,.28));
        }
        .choice h2 { color: var(--accent); font-size: 22px; margin: 0 0 var(--sp-3); }
        .choice p { color: var(--muted); font-size: 14.5px; margin: 0 0 var(--sp-6); flex: 1 1 auto; }
        .btn {
            display: inline-flex; align-items: center; justify-content: center; border-radius: var(--radius-btn);
            padding: 12px 26px; font-weight: bold; color: white; border: 0; cursor: pointer;
            transition: transform .15s ease, filter .15s ease;
        }
        .btn:hover { filter: brightness(1.06); }
        .btn:active { transform: scale(.98); }
        .btn-primary { background: var(--accent-2); }
        .btn-green { background: var(--green); }

        .trust {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px,1fr)); gap: var(--sp-3);
            max-width: 980px; margin: 0 auto; padding: 0 20px var(--sp-16);
        }
        .trust-item {
            background: rgba(255,255,255,.55);
            backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,.7); border-radius: 16px;
            padding: var(--sp-4); text-align: center; font-size: 13.5px; color: var(--muted);
            box-shadow: 0 10px 30px rgba(30,58,138,.08);
        }
        .trust-item b { display: block; color: var(--accent); font-size: 14.5px; margin-bottom: 3px; }

        @media (max-width: 700px) {
            h1 { font-size: 28px; }
            .chooser { grid-template-columns: 1fr; }
        }
    </style>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "SoftwareApplication",
      "name": "ScanBridge",
      "url": "https://scanbridge.ir/",
      "applicationCategory": "BusinessApplication",
      "operatingSystem": "Windows 10, Windows 11",
      "inLanguage": "fa-IR",
      "description": "سیستم هوشمند اسکن بارکد و مدیریت عملیات — برای داروخانه‌ها و همچنین سوپرمارکت، فروشگاه و هایپرمارکت",
      "publisher": {
        "@type": "Organization",
        "name": "ScanBridge",
        "url": "https://scanbridge.ir/",
        "logo": "https://scanbridge.ir/icons/logo.png"
      }
    }
    </script>
</head>
<body>

@include('partials.site-header')

<header class="hero">
    <div class="container">
        <div class="badge">اسکن بارکد و مدیریت عملیات، کنار نرم‌افزار فعلی شما</div>
        <h1>ScanBridge برای هر کسب‌وکاری که بارکد اسکن می‌کند</h1>
        <p>کسب‌وکار خودتان را انتخاب کنید تا امکانات و پلن‌های مخصوص همان حوزه را ببینید.</p>
    </div>
</header>

<div class="chooser">
    <a href="/pharmacy" class="choice">
        <div class="choice-icon-box"><img class="choice-icon" src="/icons/category-pharmacy.png" alt="داروخانه"></div>
        <h2>داروخانه</h2>
        <p>اتصال بارکدخوان موبایل، ثبت و استعلام تی‌تک، شیرخشک، استعلام قیمت دارو، تحویل بار و هشدار تاریخ انقضا.</p>
        <span class="btn btn-primary">ورود به بخش داروخانه‌ها</span>
    </a>
    <a href="/retail" class="choice">
        <div class="choice-icon-box"><img class="choice-icon" src="/icons/category-retail.png" alt="سوپرمارکت، فروشگاه و هایپرمارکت"></div>
        <h2>سوپرمارکت، فروشگاه و هایپرمارکت</h2>
        <p>اسکن بارکد با موبایل، ثبت کالای ورودی، هشدار تاریخ انقضا و بانک بارکد پرمصرف برای هر فروشگاهی.</p>
        <span class="btn btn-green">ورود به بخش کسب‌وکارها</span>
    </a>
</div>

<div class="trust">
    <div class="trust-item"><b>بدون بارکدخوان جدید</b>با موبایل خودتان یا اسکنر فعلی کار می‌کند</div>
    <div class="trust-item"><b>فعال‌سازی آنی</b>لایسنس آنلاین، بلافاصله پس از تأیید</div>
    <div class="trust-item"><b>پشتیبانی از راه دور</b>اتصال مستقیم تیم پشتیبانی به سیستم شما</div>
</div>

@include('partials.site-footer')
</body>
</html>
