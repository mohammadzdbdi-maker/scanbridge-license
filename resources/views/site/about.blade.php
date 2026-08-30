<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>درباره Scanbridge | نرم‌افزار مدیریت بارکد و تی‌تک</title>
    <link rel="canonical" href="https://scanbridge.ir/about">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="درباره نرم‌افزار Scanbridge و امکانات آن برای اتصال بارکدخوان موبایل، مدیریت تی‌تک، تاریخچه و عملیات داروخانه.">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta property="og:title" content="درباره Scanbridge | نرم‌افزار مدیریت بارکد و تی‌تک">
    <meta property="og:description" content="درباره نرم‌افزار Scanbridge و امکانات آن برای اتصال بارکدخوان موبایل، مدیریت تی‌تک، تاریخچه و عملیات داروخانه.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://scanbridge.ir/about">
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
        body { margin: 0; font-family: var(--font); background: var(--bg); color: var(--text); line-height: 1.9; }
        a { text-decoration: none; }

        .wrap { max-width: 980px; margin: 44px auto; padding: 0 18px; }
        .card {
            background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-card);
            padding: var(--sp-8); box-shadow: 0 12px 40px rgba(15,23,42,.06);
        }
        h1, h2 { color: var(--accent); margin-top: 0; }
        p { color: var(--muted); }

        .grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: var(--sp-3); margin: var(--sp-6) 0; }
        .item { background: var(--elevated); border: 1px solid var(--border); border-radius: 18px; padding: var(--sp-4); }
        .item h3 { color: var(--accent); margin: 0 0 var(--sp-2); }

        .btn {
            display: inline-flex; align-items: center; justify-content: center; margin: 8px;
            padding: 12px 22px; border-radius: var(--radius-btn); color: #fff; text-decoration: none;
            font-weight: bold; border: 0; cursor: pointer; transition: filter .15s ease;
        }
        .btn:hover { filter: brightness(1.06); }
        .green { background: var(--green); }
        .blue { background: var(--accent-2); }
        .dark { background: var(--text); }
        .actions { text-align: center; margin-top: var(--sp-6); }

        @media(max-width:800px){
            .grid { grid-template-columns: 1fr; }
            .card { padding: var(--sp-6); }
        }
        @media(max-width:480px){
            .wrap { margin: 24px auto; padding: 0 12px; }
            .card { padding: 18px; border-radius: 22px; }
            h1 { font-size: 22px; }
        }
    </style>
</head>
<body>

@include('partials.site-header')
<div class="wrap">
    <div class="card">
        <h1>درباره Scanbridge</h1>
        <p>
            Scanbridge یک نرم‌افزار کاربردی برای اتصال سریع بارکدخوان موبایل به کامپیوتر،
            مدیریت تاریخچه اسکن، عملیات تی‌تک، ثبت شیر خشک، تعیین وضعیت و تحویل بار است.
        </p>
        <p>
            هدف Scanbridge کاهش خطاهای ورود اطلاعات، افزایش سرعت کار روزانه و ساده‌تر کردن
            عملیات تکراری در مجموعه‌ها و داروخانه‌هاست.
        </p>

        <h2>Scanbridge برای چه کسانی مناسب است؟</h2>
        <div class="grid">
            <div class="item">
                <h3>داروخانه‌ها</h3>
                <p>برای مدیریت اسکن، تی‌تک، شیر خشک، تعیین وضعیت و تحویل بار.</p>
            </div>
            <div class="item">
                <h3>مجموعه‌های فروشگاهی</h3>
                <p>برای اتصال بارکدخوان موبایل و ثبت سریع بارکدها روی کامپیوتر.</p>
            </div>
            <div class="item">
                <h3>کاربران اداری</h3>
                <p>برای ورود سریع بارکد و نگهداری تاریخچه قابل جستجو و گزارش‌گیری.</p>
            </div>
        </div>

        <h2>چرا Scanbridge؟</h2>
        <p>
            چون بدون نیاز به تجهیزات پیچیده، موبایل شما را به یک بارکدخوان متصل به کامپیوتر تبدیل می‌کند
            و در نسخه‌های داروخانه‌ای، امکانات تخصصی تی‌تک و مدیریت عملیات را هم ارائه می‌دهد.
        </p>

        <div class="actions">
            <a class="btn blue" href="/pharmacy">امکانات داروخانه</a>
            <a class="btn green" href="/retail">امکانات فروشگاه‌ها</a>
            <a class="btn dark" href="/contact">تماس با ما</a>
        </div>
    </div>
</div>

@include('partials.site-footer')
</body>
</html>
