<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>Scanbridge | اتصال بارکدخوان موبایل، تی‌تک و مدیریت داروخانه</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Scanbridge نرم‌افزار اتصال بارکدخوان موبایل به کامپیوتر، مدیریت اسکن، تی‌تک، ثبت شیر خشک، تعیین وضعیت و تحویل بار برای داروخانه‌ها و مجموعه‌ها.">
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
            background: #f8fafc;
            color: #0f172a;
            line-height: 1.9;
        }
        a { text-decoration: none; }
        .nav {
            position: sticky;
            top: 0;
            z-index: 10;
            background: rgba(255,255,255,.92);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid #e5e7eb;
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
            color: #1e3a8a;
            direction: ltr;
        }
        .logo-bars {
            display: inline-flex;
            gap: 4px;
        }
        .logo-bars span {
            width: 7px;
            height: 28px;
            border-radius: 5px;
            display: block;
        }
        .b1 { background:#1e3a8a; }
        .b2 { background:#f59e0b; }
        .b3 { background:#2563eb; }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .nav-links a {
            color: #334155;
            font-weight: bold;
            padding: 8px 12px;
            border-radius: 12px;
        }
        .nav-links a:hover { background: #eef2ff; }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            padding: 12px 20px;
            font-weight: bold;
            color: white;
            border: 0;
            cursor: pointer;
        }
        .btn-primary { background: #2563eb; }
        .btn-green { background: #16a34a; }
        .btn-orange { background: #f97316; }
        .btn-dark { background: #0f172a; }
        .hero {
            background:
                radial-gradient(circle at top left, rgba(37,99,235,.18), transparent 35%),
                linear-gradient(135deg, #0f172a, #1e3a8a 55%, #2563eb);
            color: white;
            padding: 70px 20px;
        }
        .hero-inner {
            max-width: 1180px;
            margin: auto;
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            gap: 34px;
            align-items: center;
        }
        .badge {
            display: inline-block;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.25);
            padding: 6px 12px;
            border-radius: 999px;
            margin-bottom: 18px;
            font-weight: bold;
        }
        h1 {
            font-size: 44px;
            line-height: 1.45;
            margin: 0 0 18px;
        }
        .hero p {
            color: #dbeafe;
            font-size: 18px;
            margin: 0 0 26px;
        }
        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }
        .mock {
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.22);
            border-radius: 28px;
            padding: 22px;
            box-shadow: 0 30px 80px rgba(0,0,0,.28);
        }
        .mock-card {
            background: white;
            color: #0f172a;
            border-radius: 22px;
            padding: 22px;
        }
        .mock-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 12px;
            margin-top: 10px;
        }
        .dot {
            width: 10px;
            height: 10px;
            background: #22c55e;
            border-radius: 50%;
            display: inline-block;
            margin-left: 6px;
        }
        section {
            padding: 58px 20px;
        }
        .container {
            max-width: 1180px;
            margin: auto;
        }
        .section-title {
            text-align: center;
            margin-bottom: 34px;
        }
        .section-title h2 {
            color: #1e3a8a;
            font-size: 30px;
            margin: 0 0 8px;
        }
        .section-title p {
            color: #64748b;
            margin: 0;
        }
        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }
        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 24px;
            padding: 22px;
            box-shadow: 0 12px 40px rgba(15,23,42,.06);
        }
        .card h3 {
            margin: 0 0 10px;
            color: #1e3a8a;
            font-size: 20px;
        }
        .card p {
            color: #64748b;
            margin: 0;
        }
        .plans {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }
        .plan {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 26px;
            padding: 24px;
            box-shadow: 0 12px 40px rgba(15,23,42,.06);
        }
        .plan.featured {
            border: 2px solid #2563eb;
            transform: translateY(-6px);
        }
        .plan h3 {
            margin: 0 0 8px;
            color: #1e3a8a;
            font-size: 23px;
        }
        .plan ul {
            padding: 0;
            list-style: none;
            margin: 18px 0;
        }
        .plan li {
            padding: 7px 0;
            color: #334155;
        }
        .plan li::before {
            content: "✓";
            color: #16a34a;
            font-weight: bold;
            margin-left: 8px;
        }
        .cta {
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: white;
            border-radius: 30px;
            padding: 34px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
        }
        .cta h2 { margin: 0 0 8px; }
        .cta p { margin: 0; color: #dbeafe; }
        footer {
            background: #0f172a;
            color: #cbd5e1;
            padding: 28px 20px;
            text-align: center;
        }
        @media (max-width: 900px) {
            .hero-inner, .grid-3, .plans {
                grid-template-columns: 1fr;
            }
            h1 { font-size: 32px; }
            .nav-inner {
                flex-direction: column;
                gap: 12px;
            }
            .cta {
                flex-direction: column;
                align-items: stretch;
            }
        }
    
/* SCANBRIDGE_HERO_USER_BOX_START */
.user-box-title {
    margin: 0 0 8px;
    color: #1e3a8a;
    font-size: 22px;
    text-align: center;
}

.user-box-desc {
    margin: 0 0 16px;
    color: #64748b;
    font-size: 13px;
    text-align: center;
    line-height: 1.9;
}

.user-input {
    width: 100%;
    height: 46px;
    border: 1px solid #d1d5db;
    border-radius: 16px;
    padding: 0 14px;
    font-size: 14px;
    outline: none;
    margin-bottom: 12px;
    direction: ltr;
    text-align: left;
    font-family: 'Pinar', Tahoma, Arial, sans-serif;
}

.user-input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37,99,235,.12);
}

.user-actions {
    display: grid;
    grid-template-columns: 1fr;
    gap: 10px;
}

.user-actions a,
.user-actions button {
    width: 100%;
    border: 0;
    font-family: 'Pinar', Tahoma, Arial, sans-serif;
}

.user-note {
    margin-top: 14px;
    background: #eff6ff;
    color: #1e40af;
    border: 1px solid #bfdbfe;
    border-radius: 16px;
    padding: 10px;
    font-size: 12px;
    text-align: center;
}
/* SCANBRIDGE_HERO_USER_BOX_END */


        /* panel nav button (added by patch) */
        .nav-links .nav-btn {
            background: #2563eb !important;
            color: #fff !important;
            border-radius: 12px;
            padding: 8px 18px !important;
            font-weight: bold;
            white-space: nowrap;
            box-shadow: 0 4px 12px rgba(37, 99, 235, .35);
        }
        .nav-links .nav-btn:hover {
            background: #1d4ed8 !important;
        }
</style>

    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta property="og:title" content="Scanbridge | اتصال بارکدخوان موبایل، تی‌تک و مدیریت داروخانه">
    <meta property="og:description" content="Scanbridge نرم‌افزار اتصال بارکدخوان موبایل به کامپیوتر، مدیریت اسکن، تی‌تک، ثبت شیر خشک، تعیین وضعیت و تحویل بار برای داروخانه‌ها و مجموعه‌ها.">
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

<style>/*SCB_ICONS_V1*/
.brand-logo{width:36px;height:36px;border-radius:10px;object-fit:cover;vertical-align:middle;}
.feat-icon{width:56px;height:56px;border-radius:16px;object-fit:cover;margin-bottom:12px;display:block;}
.plan-icon{width:64px;height:64px;border-radius:18px;object-fit:cover;margin-bottom:12px;display:block;}
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

<style>/*SCB_HERO_V2*/
.hero-magic{display:flex;align-items:center;justify-content:center;}
.hero-magic img{width:min(340px,80vw);height:auto;aspect-ratio:1/1;object-fit:cover;border-radius:28px;box-shadow:0 30px 70px rgba(0,0,0,.5),0 0 0 3px rgba(255,255,255,.15);animation:scbFloat 5s ease-in-out infinite alternate;}
@keyframes scbFloat{from{transform:translateY(0)}to{transform:translateY(-12px)}}
a.btn-green,a[href*="wa.me"].btn-green{color:#ffffff!important;text-shadow:none!important;}
</style>

<style>/*SCB_HERO_V5*/
/* هیرو: تصویر به عنوان پس‌زمینه تمام‌صفحه */
.hero{
 background:linear-gradient(180deg,rgba(15,23,42,.75),rgba(15,23,42,.45)),url("/icons/hero-magic-barcode.png") center/cover no-repeat!important;
 background-attachment:fixed!important;
 min-height:92vh!important;
 display:flex!important;
 align-items:center!important;
 justify-content:center!important;
 padding:100px 20px!important;
}
/* متن روی عکس: بلور پشت متن (همون عکس که بلوره) */
.hero-inner{grid-template-columns:1fr!important;max-width:900px!important;margin:0 auto!important;}
.hero-inner>div:first-child{
 text-align:center!important;
 background:rgba(15,23,42,.38)!important;
 backdrop-filter:blur(10px)!important;
 -webkit-backdrop-filter:blur(10px)!important;
 border:1px solid rgba(255,255,255,.15)!important;
 border-radius:26px!important;
 padding:38px 34px!important;
 box-shadow:0 25px 60px rgba(0,0,0,.45)!important;
}
.hero .badge{background:rgba(37,99,235,.7)!important;color:#fff!important;border:1px solid rgba(255,255,255,.4)!important;text-shadow:none!important;}
.hero h1{font-size:40px!important;line-height:1.4!important;color:#fff!important;text-shadow:0 2px 12px rgba(0,0,0,.5)!important;}
.hero p{color:rgba(255,255,255,.95)!important;text-shadow:0 1px 6px rgba(0,0,0,.5)!important;}
.hero-actions{justify-content:center!important;}
.hero-magic{display:none!important;}
@media(max-width:900px){.hero{background-attachment:scroll!important;min-height:0!important;padding:60px 16px!important;}.hero h1{font-size:30px!important;}}
</style>

<style>/*SCB_REVEAL_V1*/
/* دکمه درخواست خرید در همه پلن‌ها پایین کارت */
.plan{display:flex!important;flex-direction:column!important;height:100%!important;}
.plan ul{flex:1 1 auto!important;}
.plan a.btn{margin-top:auto!important;}
/* انیمیشن اسکرول */
.scb-reveal{opacity:0!important;transform:translateY(30px)!important;transition:opacity .7s cubic-bezier(.22,.61,.36,1),transform .7s cubic-bezier(.22,.61,.36,1)!important;}
.scb-reveal.scb-show{opacity:1!important;transform:translateY(0)!important;}
.scb-reveal:nth-child(2){transition-delay:.08s!important;}
.scb-reveal:nth-child(3){transition-delay:.16s!important;}
@media (prefers-reduced-motion:reduce){.scb-reveal{opacity:1!important;transform:none!important;transition:none!important;}}
</style>
</head>
<body>

@include('partials.site-header')

<style>/*SCB_HOME_PROMO_V1*/
.scb-newsbar{background:linear-gradient(90deg,#1e3a8a,#2563eb)!important;color:#fff!important;text-align:center;padding:11px 16px;font-size:14px;}
.scb-trust{display:grid!important;grid-template-columns:repeat(auto-fit,minmax(230px,1fr))!important;gap:12px!important;margin-bottom:6px;}
.trust-item{background:#fff!important;border:1px solid #e5e7eb!important;border-radius:16px;padding:14px 16px;display:flex;flex-direction:column;gap:3px;font-size:14.5px;box-shadow:0 8px 22px rgba(15,23,42,.06)!important;}
.trust-item b{color:#1e3a8a!important;font-size:14.5px;}
.trust-item span{color:#475569!important;font-size:12.5px;}
.trust-item a{color:#2563eb!important;font-weight:bold;}
.plan{position:relative;}
.plan-ribbon{position:absolute;top:-13px;right:18px;z-index:2;background:linear-gradient(135deg,#1e3a8a,#2563eb);color:#fff;font-size:12px;font-weight:bold;padding:5px 14px;border-radius:999px;box-shadow:0 6px 16px rgba(37,99,235,.35);}
.plan-price{margin:2px 0 10px;padding:10px 12px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:14px;text-align:center;}
.plan.featured .plan-price{background:#eff6ff;border-color:#dbeafe;}
.plan-price-annual{font-size:23px;font-weight:800;color:#1e3a8a!important;line-height:1.3;}
.plan-price-annual small{font-size:12px;font-weight:bold;color:#475569;}
.plan-price-monthly{font-size:12.5px;color:#475569!important;margin-top:3px;}
.plan-price-empty{font-size:13px;color:#64748b;text-align:center;margin:2px 0 10px;}
.launch-tag{display:inline-block;background:#fee2e2;color:#dc2626!important;font-size:11px;font-weight:bold;border-radius:999px;padding:2px 10px;margin-top:6px;}
.plans-note{text-align:center;color:#64748b!important;font-size:12.5px;margin:18px auto 0;max-width:640px;}
.enterprise-strip{text-align:center;background:linear-gradient(135deg,#1e3a8a,#2563eb);color:#fff!important;border-radius:16px;padding:14px 18px;font-size:14.5px;margin-top:14px;}
.enterprise-strip a{color:#fff!important;font-weight:bold;text-decoration:underline;}
@media (max-width:700px){.scb-trust{grid-template-columns:1fr!important;}}
</style>

<div class="scb-newsbar">
    🎉 نسخه جدید منتشر شد: <strong>هشدار تاریخ انقضا</strong> و <strong>یادآور پیام‌رسان بله</strong> + بانک بارکد پرمصرف
</div>

<header class="hero">
    <div class="hero-inner">
        <div>
            <div class="badge">ابزار تخصصی عملیات تی‌تک داروخانه</div>
            <h1>سیستم هوشمند اسکن و عملیات تی‌تک داروخانه</h1>
            <p>
                کنار هر نرم‌افزار داروخانه‌ای که دارید، ScanBridge را نصب کنید: اسکن سریع با موبایل،
                استعلام و ثبت تی‌تک، تحویل بار، تعیین وضعیت و هشدار تاریخ انقضا —
                بارکدخوان فعلی خود را هم نگه می‌دارید.
            </p>
            <div class="hero-actions">
                <a class="btn btn-green" href="/buy">درخواست خرید / تمدید</a>
                <a class="btn btn-primary" href="/download">دانلود نرم‌افزار</a>
                <a class="btn btn-orange" href="https://wa.me/989136346309">مشاوره واتساپ</a>
            </div>
        </div>
        <div class="hero-magic"><img src="/icons/hero-magic-barcode.png" alt="بارکدخوان هوشمند Scanbridge"></div>
    </div>
</header>

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
        </div>
    </div>
</section>

<section id="plans" style="background:#eef2ff;">
    <div class="container">
        <div class="section-title">
            <h2>پلن‌های ScanBridge</h2>
            <p>کنار نرم‌افزار فعلی داروخانه — بدون نیاز به تجهیزات جدید</p>
        </div>

        <div class="scb-trust">
            <div class="trust-item">⚡<b>فعال‌سازی آنی</b><span>لایسنس آنلاین، بلافاصله پس از تأیید</span></div>
            <div class="trust-item">🛠<b>پشتیبانی از راه دور</b><span>اتصال مستقیم تیم پشتیبانی به سیستم شما</span></div>
            <div class="trust-item">📱<b>بدون خرید بارکدخوان جدید</b><span>با موبایل خودتان یا اسکنر فعلی کار می‌کند</span></div>
            <div class="trust-item">🧪<b>دموی ۱۴ روزه در داروخانه شما</b><span>بدون تعهد خرید — <a href="/contact">درخواست دمو</a></span></div>
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
                    <li>بانک بارکد پرمصرف</li>
                    <li>مدیریت دستگاه‌ها</li>
                    <li>به‌روزرسانی خودکار</li>
                </ul>
                <a class="btn btn-dark" href="/buy?plan=Normal">درخواست خرید</a>
            </div>

            <div class="plan featured scb-reveal">
                <span class="plan-ribbon">⭐ پیشنهاد ما برای اکثر داروخانه‌ها</span>
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
                    <li>ثبت شیرخشک با نسخه و بدون نسخه</li>
                    <li>ثبت اطلاعات بیمار از موبایل</li>
                    <li>خروجی Excel و PDF</li>
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
                    <li>هشدار تاریخ انقضا + یادآور بله</li>
                    <li>همگام‌سازی چند سیستم با یک لایسنس</li>
                    <li>پشتیبانی اولویت‌دار</li>
                </ul>
                <a class="btn btn-green" href="/buy?plan=TtacPlus">درخواست خرید</a>
            </div>
        </div>

        <p class="plans-note">⚠️ امکانات وابسته به سامانه تی‌تک، در صورت در دسترس بودن سرویس رسمی TTAC ارائه می‌شود.</p>
        <div class="enterprise-strip">🏢 چند شعبه یا شبکه چندسیستمی دارید؟ برای شرایط ویژه <a href="https://wa.me/989136346309">در واتساپ تماس بگیرید</a>.</div>
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




<script>
    function heroUserWhatsApp() {
        const el = document.getElementById('heroUserInput');
        const value = el ? el.value.trim() : '';

        const text =
`سلام، برای Scanbridge درخواست پیگیری دارم.

شماره موبایل یا کد لایسنس:
${value || '-'}

موضوع:
خرید / تمدید / پیگیری لایسنس`;

        window.open('https://wa.me/989136346309?text=' + encodeURIComponent(text), '_blank');
    }
</script>


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
