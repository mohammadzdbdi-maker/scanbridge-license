<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>نرم‌افزار اسکن بارکد و عملیات تی‌تک داروخانه | ScanBridge</title>
    <link rel="canonical" href="https://scanbridge.ir/pharmacy">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ScanBridge؛ سیستم هوشمند اسکن بارکد و عملیات تی‌تک داروخانه — کنار نرم‌افزار فعلی شما: اتصال موبایل به کامپیوتر، ثبت تی‌تک و شیرخشک، استعلام قیمت دارو، تحویل بار، تعیین وضعیت و هشدار تاریخ انقضا.">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta property="og:title" content="Scanbridge | اتصال بارکدخوان موبایل، تی‌تک و مدیریت داروخانه">
    <meta property="og:description" content="Scanbridge نرم‌افزار اتصال بارکدخوان موبایل به کامپیوتر، مدیریت اسکن، تی‌تک، استعلام قیمت دارو، ثبت شیر خشک، تعیین وضعیت و تحویل بار برای داروخانه‌ها و مجموعه‌ها.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://scanbridge.ir/pharmacy">
    <meta property="og:site_name" content="Scanbridge">

    <style>
        /* ===== Design tokens (Phase 1 foundation) ===== */
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
            --sp-1: 4px; --sp-2: 8px; --sp-3: 12px; --sp-4: 16px; --sp-5: 20px;
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
            margin: 0;
            font-family: var(--font);
            background: var(--bg);
            color: var(--text);
            line-height: 1.75;
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
        a { text-decoration: none; }

        /* ===== Nav (shared with site-header partial) ===== */
        .nav {
            position: sticky;
            top: 0;
            z-index: 10;
            background: rgba(255,255,255,.92);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
        }
        .nav-inner {
            max-width: 1180px;
            margin: auto;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: bold;
            color: var(--accent);
            direction: ltr;
        }
        .logo-bars { display: inline-flex; gap: 4px; }
        .logo-bars span { width: 7px; height: 28px; border-radius: 5px; display: block; }
        .b1 { background: var(--accent); }
        .b2 { background: var(--orange); }
        .b3 { background: var(--accent-2); }
        .nav-links { display: flex; align-items: center; gap: 10px; }
        .nav-links a { color: #334155; font-weight: bold; padding: 8px 12px; border-radius: var(--sp-3); }
        .nav-links a:hover { background: var(--elevated); }
        .nav-links .nav-btn {
            background: var(--accent-2) !important;
            color: #fff !important;
            border-radius: var(--radius-btn);
            padding: 8px 18px !important;
            font-weight: bold;
            white-space: nowrap;
        }
        .nav-links .nav-btn:hover { background: #1d4ed8 !important; }

        /* ===== Buttons ===== */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-btn);
            padding: 12px 22px;
            font-weight: bold;
            color: white;
            border: 0;
            cursor: pointer;
            transition: transform .15s ease, filter .15s ease;
        }
        .btn:hover { filter: brightness(1.06); }
        .btn:active { transform: scale(.98); }
        .btn-primary { background: var(--accent-2); }
        .btn-green { background: var(--green); }
        .btn-orange { background: var(--orange); }
        .btn-dark { background: var(--text); }
        .btn-outline { background: transparent; color: var(--accent); border: 1.5px solid var(--accent); }

        /* ===== Hero ===== */
        .hero { padding: var(--sp-16) 20px var(--sp-12); position: relative; z-index: 1; }
        .hero-inner {
            max-width: 1180px;
            margin: auto;
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            gap: var(--sp-8);
            align-items: center;
        }
        .badge {
            display: inline-block;
            background: rgba(255,255,255,.6);
            backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,.7);
            color: var(--accent);
            padding: 6px 14px;
            border-radius: 999px;
            margin-bottom: var(--sp-5);
            font-weight: bold;
            font-size: 13px;
        }
        h1 { font-size: 44px; line-height: 1.35; margin: 0 0 var(--sp-4); color: var(--text); }
        .hero p { color: var(--muted); font-size: 17px; margin: 0 0 var(--sp-6); }
        .hero-actions { display: flex; flex-wrap: wrap; gap: var(--sp-3); }

        /* Revived "app preview" mock card for the hero's right column */
        .mock {
            background: rgba(242,244,247,.5);
            backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,.6); border-radius: 28px; padding: var(--sp-5);
        }
        .mock-card {
            background: rgba(255,255,255,.7);
            backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,.8);
            color: var(--text); border-radius: var(--radius-card); padding: var(--sp-5);
            box-shadow: 0 12px 40px rgba(30,58,138,.10);
        }
        .mock-card-title { font-weight: bold; color: var(--accent); margin-bottom: var(--sp-3); }
        .mock-row {
            display: flex; justify-content: space-between; align-items: center;
            background: var(--bg); border: 1px solid var(--border); border-radius: var(--sp-4);
            padding: var(--sp-3) var(--sp-4); margin-top: var(--sp-2); font-size: 14px;
        }
        .dot { width: 10px; height: 10px; background: var(--green); border-radius: 50%; display: inline-block; }

        section { padding: var(--sp-12) 20px; position: relative; z-index: 1; }
        .container { max-width: 1180px; margin: auto; }
        .section-title { text-align: center; margin-bottom: var(--sp-8); }
        .section-title h2 { color: var(--accent); font-size: 30px; margin: 0 0 var(--sp-2); }
        .section-title p { color: var(--muted); margin: 0; }

        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: var(--sp-5); }
        .card {
            background: rgba(255,255,255,.65);
            backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,.75);
            border-radius: var(--radius-card);
            padding: var(--sp-6);
            box-shadow: 0 12px 40px rgba(30,58,138,.10);
        }
        .card h3 { margin: 0 0 var(--sp-3); color: var(--accent); font-size: 20px; }
        .card p { color: var(--muted); margin: 0; }
        .feat-icon { width: 56px; height: 56px; border-radius: 16px; object-fit: cover; margin-bottom: var(--sp-3); display: block; background: transparent; mix-blend-mode: multiply; }

        /* ===== How it works ===== */
        .steps { position: relative; display: grid; grid-template-columns: repeat(4, 1fr); gap: var(--sp-5); }
        .steps::before { content: ""; position: absolute; top: 26px; right: 12%; left: 12%; height: 2px; background: var(--border); z-index: 0; }
        .step-item { position: relative; z-index: 1; text-align: center; }
        .step-num {
            width: 52px; height: 52px; border-radius: 50%; background: var(--accent-2); color: #fff;
            display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 800;
            margin: 0 auto var(--sp-3);
        }
        .step-item h3 { color: var(--accent); font-size: 17px; margin: 0 0 var(--sp-2); }
        .step-item p { color: var(--muted); font-size: 14px; margin: 0; }

        .plans { display: grid; grid-template-columns: repeat(3, 1fr); gap: var(--sp-5); }
        .plan {
            background: rgba(255,255,255,.65);
            backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,.75);
            border-radius: 26px;
            padding: var(--sp-6);
            box-shadow: 0 12px 40px rgba(30,58,138,.10);
            display: flex; flex-direction: column; height: 100%;
            position: relative;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .plan:hover { transform: translateY(-4px); box-shadow: 0 18px 44px rgba(15,23,42,.1); }
        .plan.featured { border: 2px solid var(--accent-2); box-shadow: 0 0 0 5px rgba(37,99,235,.12), 0 18px 44px rgba(37,99,235,.18); }
        .plan-icon { width: 64px; height: 64px; border-radius: 18px; object-fit: cover; background: transparent; mix-blend-mode: multiply; flex-shrink: 0; }
        .plan h3 { display: flex; align-items: center; gap: var(--sp-3); margin: 4px 0 2px; color: var(--accent); font-size: 24px; }
        .plan > p { color: var(--muted); margin: 0 0 var(--sp-3); }
        .plan ul { padding: 0; list-style: none; margin: var(--sp-4) 0; flex: 1 1 auto; }
        .plan li { padding: 7px 0; color: #334155; }
        .plan li::before { content: "✓"; color: var(--green); font-weight: bold; margin-left: var(--sp-2); }
        .plan a.btn { margin-top: auto; }
        .plan-ribbon {
            position: absolute; top: -13px; right: 18px; z-index: 2;
            background: linear-gradient(135deg, var(--accent), var(--accent-2)); color: #fff;
            font-size: 12px; font-weight: bold; padding: 5px 14px; border-radius: 999px;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .ribbon-star { width: 20px; height: 20px; object-fit: contain; }
        .plan-price { margin: 2px 0 var(--sp-3); padding: var(--sp-3); background: var(--bg); border: 1px solid var(--border); border-radius: var(--sp-4); text-align: center; }
        .plan.featured .plan-price { background: #eff6ff; border-color: #dbeafe; }
        .plan-price-annual { font-size: 23px; font-weight: 800; color: var(--accent); line-height: 1.3; }
        .plan-price-annual small { font-size: 12px; font-weight: bold; color: var(--muted); }
        .plan-price-monthly { font-size: 12.5px; color: var(--muted); margin-top: 3px; }
        .plan-price-empty { font-size: 13px; color: var(--muted); text-align: center; margin: 2px 0 var(--sp-3); }
        .launch-tag { display: inline-block; background: #fee2e2; color: #dc2626; font-size: 11px; font-weight: bold; border-radius: 999px; padding: 2px 10px; margin-top: 6px; }

        .scb-trust { display: grid; grid-template-columns: repeat(auto-fit, minmax(230px,1fr)); gap: var(--sp-3); margin-bottom: var(--sp-8); }
        .trust-item {
            background: rgba(255,255,255,.6);
            backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,.75); border-radius: 16px; padding: var(--sp-4);
            display: flex; align-items: center; gap: var(--sp-3); font-size: 14.5px;
            box-shadow: 0 10px 30px rgba(30,58,138,.08);
        }
        .trust-icon { width: 52px; height: 52px; object-fit: contain; flex-shrink: 0; background: transparent; mix-blend-mode: multiply; }
        .trust-txt { display: flex; flex-direction: column; gap: 3px; align-items: flex-start; }
        .trust-item b { color: var(--accent); font-size: 14.5px; }
        .trust-item span { color: var(--muted); font-size: 12.5px; }
        .trust-item a.demo-btn {
            background: linear-gradient(135deg, var(--accent), var(--accent-2)); color: #fff !important;
            border-radius: 10px; padding: 6px 16px; font-size: 12.5px; font-weight: bold;
            display: inline-block; margin-top: 6px;
        }
        .ttac-note {
            display: flex; align-items: center; gap: var(--sp-4);
            background: rgba(255,255,255,.6);
            backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,.75);
            border-radius: 16px; padding: var(--sp-4) var(--sp-5); margin: var(--sp-5) auto 0; width: 100%;
            box-shadow: 0 10px 30px rgba(30,58,138,.08); color: var(--muted); font-size: 15.5px; font-weight: bold;
        }
        .ttac-note img { width: 56px; height: 56px; object-fit: contain; flex-shrink: 0; background: transparent; mix-blend-mode: multiply; }

        /* ===== FAQ ===== */
        .faq-list { max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: var(--sp-3); }
        .faq-item {
            background: rgba(255,255,255,.6);
            backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,.75); border-radius: 16px; padding: var(--sp-4) var(--sp-5);
            box-shadow: 0 10px 30px rgba(30,58,138,.08);
        }
        .faq-item summary { cursor: pointer; font-weight: bold; color: var(--accent); font-size: 15.5px; list-style: none; display: flex; align-items: center; justify-content: space-between; gap: var(--sp-3); }
        .faq-item summary::-webkit-details-marker { display: none; }
        .faq-item summary::after { content: "+"; font-size: 22px; line-height: 1; color: var(--muted); font-weight: normal; transition: transform .2s ease; flex-shrink: 0; }
        .faq-item[open] summary::after { transform: rotate(45deg); }
        .faq-item p { color: var(--muted); margin: var(--sp-3) 0 0; font-size: 14.5px; }

        .cta {
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            color: white; border-radius: 30px; padding: var(--sp-8);
            display: flex; justify-content: space-between; align-items: center; gap: var(--sp-5);
        }
        .cta h2 { margin: 0 0 var(--sp-2); }
        .cta p { margin: 0; color: #dbeafe; }

        footer { background: var(--text); color: #cbd5e1; padding: var(--sp-6) 20px; text-align: center; position: relative; z-index: 1; }

        .brand-logo { width: 36px; height: 36px; border-radius: 10px; object-fit: cover; vertical-align: middle; background: transparent; mix-blend-mode: multiply; }

        .scb-reveal { opacity: 0; transform: translateY(30px); transition: opacity .7s cubic-bezier(.22,.61,.36,1), transform .7s cubic-bezier(.22,.61,.36,1); }
        .scb-reveal.scb-show { opacity: 1; transform: translateY(0); }
        .scb-reveal:nth-child(2) { transition-delay: .08s; }
        .scb-reveal:nth-child(3) { transition-delay: .16s; }
        @media (prefers-reduced-motion: reduce) { .scb-reveal { opacity: 1; transform: none; transition: none; } }

        @media (max-width: 900px) {
            .hero-inner, .grid-3, .plans, .steps { grid-template-columns: 1fr; }
            .steps { gap: var(--sp-6); }
            .steps::before { display: none; }
            h1 { font-size: 32px; }
            .nav-inner { flex-direction: column; gap: 12px; }
            .cta { flex-direction: column; align-items: stretch; }
        }
    </style>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "SoftwareApplication",
      "name": "ScanBridge برای داروخانه",
      "url": "https://scanbridge.ir/pharmacy",
      "applicationCategory": "BusinessApplication",
      "operatingSystem": "Windows 10, Windows 11",
      "inLanguage": "fa-IR",
      "description": "سیستم هوشمند اسکن بارکد و عملیات تی‌تک داروخانه — کنار هر نرم‌افزار داروخانه",
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
    <div class="hero-inner">
        <div>
            <div class="badge">ابزار تخصصی عملیات تی‌تک داروخانه</div>
            <h1>سیستم هوشمند اسکن و عملیات تی‌تک داروخانه</h1>
            <p>
                کنار هر نرم‌افزار داروخانه‌ای که دارید، ScanBridge را نصب کنید: اسکن سریع با موبایل،
                استعلام و ثبت تی‌تک، استعلام قیمت دارو، تحویل بار، تعیین وضعیت و هشدار تاریخ انقضا —
                بارکدخوان فعلی خود را هم نگه می‌دارید.
            </p>
            <div class="hero-actions">
                <a class="btn btn-green" href="/buy">درخواست خرید / تمدید</a>
                <a class="btn btn-primary" href="/download">دانلود نرم‌افزار</a>
                <a class="btn btn-outline" href="https://wa.me/989136346309">مشاوره واتساپ</a>
            </div>
        </div>
        <div class="mock scb-reveal">
            <div class="mock-card">
                <div class="mock-card-title">آخرین اسکن‌ها</div>
                <div class="mock-row"><span>ژلوفن ۴۰۰ میلی‌گرم</span><span class="dot"></span></div>
                <div class="mock-row"><span>آموکسی‌سیلین ۵۰۰</span><span class="dot"></span></div>
                <div class="mock-row"><span>شربت سرماخوردگی کودک</span><span class="dot"></span></div>
                <div class="mock-row"><span>استعلام قیمت: تأیید شد</span><span class="dot"></span></div>
            </div>
        </div>
    </div>
</header>

<section id="how">
    <div class="container">
        <div class="section-title">
            <h2>ScanBridge چطور کار می‌کند؟</h2>
            <p>در چند دقیقه راه‌اندازی می‌شود و کنار نرم‌افزار فعلی داروخانه شما کار می‌کند</p>
        </div>
        <div class="steps">
            <div class="step-item scb-reveal">
                <div class="step-num">۱</div>
                <h3>نصب روی سیستم</h3>
                <p>ScanBridge را روی کامپیوتر داروخانه نصب کنید؛ نرم‌افزار فعلی شما دست‌نخورده باقی می‌ماند.</p>
            </div>
            <div class="step-item scb-reveal">
                <div class="step-num">۲</div>
                <h3>اتصال موبایل با QR</h3>
                <p>با اسکن یک QR کد، موبایل خودتان (یا چند موبایل دیگر) به‌عنوان بارکدخوان وصل می‌شود.</p>
            </div>
            <div class="step-item scb-reveal">
                <div class="step-num">۳</div>
                <h3>اسکن و ثبت خودکار</h3>
                <p>هر اسکن بلافاصله وارد سیستم می‌شود؛ تی‌تک، شیرخشک، قیمت دارو و بقیه‌ی عملیات مرتبط خودکار انجام می‌شود.</p>
            </div>
            <div class="step-item scb-reveal">
                <div class="step-num">۴</div>
                <h3>مدیریت و گزارش</h3>
                <p>تاریخچه، هشدار انقضا و خروجی Excel/PDF را از همان نرم‌افزار در هر لحظه ببینید.</p>
            </div>
        </div>
    </div>
</section>

<section id="features">
    <div class="container">
        <div class="section-title">
            <h2>امکانات اصلی</h2>
            <p>برای کاهش خطا، افزایش سرعت و مدیریت بهتر عملیات روزانه داروخانه</p>
        </div>

        <div class="grid-3">
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-barcode.png" alt="">اتصال بارکدخوان موبایل</h3>
                <p>با اسکن QR، موبایل به کامپیوتر وصل می‌شود و بارکدها سریع وارد سیستم می‌شوند.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-ttac.png" alt="">تی‌تک و شیر خشک</h3>
                <p>ورود از مرورگر داخلی، ثبت تی‌تک، فرمول شیر خشک و مدیریت عملیات مرتبط.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-expiry.png" alt="">هشدار تاریخ انقضا</h3>
                <p>پایش خودکار اقلام و هشدار برای کالاهایی که تاریخ انقضای نزدیک دارند، با تنظیم آستانه و تکرار یادآوری دلخواه.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-barcodebank.png" alt="">بانک بارکد پرمصرف</h3>
                <p>بارکدهای پرمصرف را در گروه‌های دلخواه ذخیره کن و بین چند سیستم هم‌شبکه به‌سرعت به اشتراک بگذار.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-status.png" alt="">تعیین وضعیت</h3>
                <p>بررسی وضعیت فرآورده و مدیریت دریافت/تایید برای داروخانه در پلن کامل.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-bale.png" alt="">یادآور در پیام‌رسان بله</h3>
                <p>با یک بار فعال‌سازی، هشدارهای تاریخ انقضا علاوه بر نرم‌افزار، توی بله هم برات ارسال می‌شود.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-history.png" alt="">تاریخچه و خروجی</h3>
                <p>ثبت تاریخچه اسکن‌ها، جستجو، فیلتر، خروجی Excel و PDF برای گزارش‌گیری.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-delivery.png" alt="">تحویل بار</h3>
                <p>ثبت گروهی بارکدها، افزودن به داروخانه، خروجی و مشاهده جزئیات هر ردیف.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-license.png" alt="">لایسنس آنلاین</h3>
                <p>فعال‌سازی امن آنلاین با پلن‌های مختلف و مدیریت لایسنس از پنل اختصاصی.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-remote.png" alt="">پشتیبانی از راه دور</h3>
                <p>با یک اتصال سریع، تیم پشتیبانی می‌تواند مستقیم مشکل را از راه دور بررسی و رفع کند.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-autoupdate.png" alt="">به‌روزرسانی خودکار</h3>
                <p>نرم‌افزار هر ۲۴ ساعت خودش بررسی می‌کند و در صورت وجود نسخه جدید، به‌سادگی مطلعت می‌کند.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-price.png" alt="" onerror="this.style.display='none'">استعلام قیمت دارو</h3>
                <p>با نام، اسکن بارکد یا کد ژنریک، قیمت فرآورده را مستقیم از تی‌تک استعلام بگیرید؛ بین چند نتیجه‌ی مشابه، بالاترین قیمت واقعی خودکار انتخاب و نمایش داده می‌شود.</p>
            </div>
        </div>
    </div>
</section>

<section id="plans" style="background:var(--elevated);">
    <div class="container">
        <div class="section-title">
            <h2>پلن‌های ScanBridge</h2>
            <p>کنار نرم‌افزار فعلی داروخانه — بدون نیاز به تجهیزات جدید</p>
        </div>

        <div class="scb-trust">
            <div class="trust-item"><img class="trust-icon" src="/icons/trust-instant.png" alt=""><div class="trust-txt"><b>فعال‌سازی آنی</b><span>لایسنس آنلاین، بلافاصله پس از تأیید</span></div></div>
            <div class="trust-item"><img class="trust-icon" src="/icons/trust-support.png" alt=""><div class="trust-txt"><b>پشتیبانی از راه دور</b><span>اتصال مستقیم تیم پشتیبانی به سیستم شما</span></div></div>
            <div class="trust-item"><img class="trust-icon" src="/icons/trust-mobile.png" alt=""><div class="trust-txt"><b>بدون خرید بارکدخوان جدید</b><span>با موبایل خودتان یا اسکنر فعلی کار می‌کند</span></div></div>
            <div class="trust-item"><img class="trust-icon" src="/icons/trust-demo.png" alt=""><div class="trust-txt"><b>دموی ۱۴ روزه در داروخانه شما</b><span>بدون تعهد خرید</span><a class="demo-btn" href="/buy?plan=Trial">درخواست دمو</a></div></div>
        </div>

        @php
            $scbPlanPrice = function (string $plan) use ($planPrices) {
                $entry = $planPrices[$plan] ?? null;
                if (!$entry) { return null; }
                $annual = $entry['annual'] ?? $entry['longest'];
                return $annual ? ['annual' => (int) $annual, 'monthly' => (int) round($annual / 12)] : null;
            };
            $pBase = $scbPlanPrice('Normal');
            $pTtac = $scbPlanPrice('Ttac');
            $pPlus = $scbPlanPrice('TtacPlus');
        @endphp

        <div class="plans">
            <div class="plan scb-reveal">
                <h3><img class="plan-icon" src="/icons/plan-normal.png" alt="">پایه</h3>
                <p>مناسب برای اسکن و مدیریت بارکد</p>
                @if($pBase)
                    <div class="plan-price">
                        <div class="plan-price-annual">{{ number_format($pBase['annual']) }} <small>تومان / سال</small></div>
                        <div class="plan-price-monthly">معادل ماهانه {{ number_format($pBase['monthly']) }} تومان</div>
                        <span class="launch-tag">قیمت دوره راه‌اندازی</span>
                    </div>
                @else
                    <div class="plan-price-empty">برای قیمت هماهنگ کنید</div>
                @endif
                <ul>
                    <li>اتصال بارکدخوان موبایل (چند گوشی هم‌زمان)</li>
                    <li>تاریخچه و جستجوی اسکن‌ها</li>
                    <li>مدیریت دستگاه‌ها</li>
                    <li>به‌روزرسانی خودکار</li>
                </ul>
                <a class="btn btn-dark" href="/buy?plan=Normal">درخواست خرید</a>
            </div>

            <div class="plan featured scb-reveal">
                <span class="plan-ribbon"><img class="ribbon-star" src="/icons/ribbon-star.png" alt="">پیشنهاد ما برای اکثر داروخانه‌ها</span>
                <h3><img class="plan-icon" src="/icons/plan-ttac.png" alt="">تی‌تک</h3>
                <p>ثبت تی‌تک و شیرخشک در چند ثانیه</p>
                @if($pTtac)
                    <div class="plan-price">
                        <div class="plan-price-annual">{{ number_format($pTtac['annual']) }} <small>تومان / سال</small></div>
                        <div class="plan-price-monthly">معادل ماهانه {{ number_format($pTtac['monthly']) }} تومان</div>
                        <span class="launch-tag">قیمت دوره راه‌اندازی</span>
                    </div>
                @else
                    <div class="plan-price-empty">برای قیمت هماهنگ کنید</div>
                @endif
                <ul>
                    <li>تمام امکانات پایه</li>
                    <li>استعلام و ثبت تی‌تک + مرورگر داخلی</li>
                    <li>استعلام قیمت دارو</li>
                    <li>ثبت شیرخشک با نسخه و بدون نسخه</li>
                    <li>ثبت اطلاعات بیمار از موبایل</li>
                    <li>خروجی Excel و PDF</li>
                    <li>🔒 قفل اینترنت پرسنل (فعال‌سازی توسط پشتیبانی)</li>
                </ul>
                <a class="btn btn-primary" href="/buy?plan=Ttac">درخواست خرید</a>
            </div>

            <div class="plan scb-reveal">
                <h3><img class="plan-icon" src="/icons/plan-ttacplus.png" alt="">حرفه‌ای</h3>
                <p>پلن کامل عملیات روزانه داروخانه</p>
                @if($pPlus)
                    <div class="plan-price">
                        <div class="plan-price-annual">{{ number_format($pPlus['annual']) }} <small>تومان / سال</small></div>
                        <div class="plan-price-monthly">معادل ماهانه {{ number_format($pPlus['monthly']) }} تومان</div>
                        <span class="launch-tag">قیمت دوره راه‌اندازی</span>
                    </div>
                @else
                    <div class="plan-price-empty">برای قیمت هماهنگ کنید</div>
                @endif
                <ul>
                    <li>تمام امکانات تی‌تک</li>
                    <li>تعیین وضعیت (تکی و گروهی)</li>
                    <li>تحویل بار حرفه‌ای</li>
                    <li>بانک بارکد پرمصرف</li>
                    <li>هشدار تاریخ انقضا + یادآور بله</li>
                    <li>همگام‌سازی چند سیستم با یک لایسنس</li>
                    <li>🔒 قفل اینترنت پرسنل (فعال‌سازی توسط پشتیبانی)</li>
                    <li>پشتیبانی اولویت‌دار</li>
                </ul>
                <a class="btn btn-green" href="/buy?plan=TtacPlus">درخواست خرید</a>
            </div>
        </div>

        <div class="ttac-note">
            <img src="/icons/icon-warning.png" alt="">
            <span>امکانات وابسته به سامانه تی‌تک، در صورت در دسترس بودن سرویس رسمی TTAC ارائه می‌شود.</span>
        </div>
    </div>
</section>

<section id="faq" style="background:var(--elevated);">
    <div class="container">
        <div class="section-title">
            <h2>سوالات متداول</h2>
            <p>پاسخ چند سوالی که داروخانه‌ها معمولاً می‌پرسند</p>
        </div>
        <div class="faq-list">
            <details class="faq-item scb-reveal">
                <summary>آیا باید بارکدخوان جدید بخرم؟</summary>
                <p>نه؛ ScanBridge با موبایل خودتان یا بارکدخوان فعلی‌تان کار می‌کند و نیازی به خرید تجهیزات جدید نیست.</p>
            </details>
            <details class="faq-item scb-reveal">
                <summary>آیا نرم‌افزار داروخانه فعلی من از بین می‌رود؟</summary>
                <p>خیر. ScanBridge کنار نرم‌افزار فعلی شما نصب می‌شود و آن را جایگزین نمی‌کند؛ فقط اسکن و عملیات مرتبط را سریع‌تر و خودکارتر می‌کند.</p>
            </details>
            <details class="faq-item scb-reveal">
                <summary>امکانات تی‌تک و استعلام قیمت دارو چطور فعال می‌شود؟</summary>
                <p>در پلن‌های تی‌تک و حرفه‌ای، ثبت تی‌تک، شیرخشک و استعلام قیمت دارو مستقیم از داخل ScanBridge در دسترس است و نیازی به مرورگر جدا نیست.</p>
            </details>
            <details class="faq-item scb-reveal">
                <summary>می‌توانم قبل از خرید امتحانش کنم؟</summary>
                <p>بله؛ یک دموی ۱۴ روزه بدون تعهد خرید در داروخانه‌ی خودتان در دسترس است.</p>
            </details>
            <details class="faq-item scb-reveal">
                <summary>اگر مشکلی پیش بیاید، پشتیبانی چطور کمک می‌کند؟</summary>
                <p>تیم پشتیبانی می‌تواند با یک اتصال از راه دور مستقیم به سیستم شما وصل شود و مشکل را همان لحظه بررسی و رفع کند.</p>
            </details>
            <details class="faq-item scb-reveal">
                <summary>لایسنس چطور فعال می‌شود؟</summary>
                <p>لایسنس به‌صورت آنلاین و بلافاصله پس از تأیید خرید فعال می‌شود؛ نیازی به ارسال فایل یا فعال‌سازی دستی نیست.</p>
            </details>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="cta scb-reveal">
            <div>
                <h2>برای خرید، تمدید یا دریافت نسخه تست پیام بدهید</h2>
                <p>از طریق واتساپ سریع‌تر پاسخ می‌گیرید.</p>
            </div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <a class="btn btn-green" href="https://wa.me/989136346309">واتساپ 09136346309</a>
                <a class="btn btn-orange" href="/download">دانلود نرم‌افزار</a>
            </div>
        </div>
    </div>
</section>

@include('partials.site-footer')

<!--SCB_REVEAL_JS-->
<script>
(function(){
 var els=document.querySelectorAll(".scb-reveal");
 if(!("IntersectionObserver" in window)){els.forEach(function(e){e.classList.add("scb-show");});return;}
 var io=new IntersectionObserver(function(entries){
  entries.forEach(function(en){
   if(en.isIntersecting){en.target.classList.add("scb-show");io.unobserve(en.target);}
  });
 },{threshold:.08});
 els.forEach(function(e){io.observe(e);});
})();
</script>
</body>
</html>
