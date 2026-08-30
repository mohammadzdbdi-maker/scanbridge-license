<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>حریم خصوصی Scanbridge</title>
    <link rel="canonical" href="https://scanbridge.ir/privacy">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="سیاست حریم خصوصی Scanbridge درباره لایسنس، اطلاعات دستگاه، پشتیبانی و استفاده از امکانات تی‌تک.">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
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
        body {
            margin: 0; font-family: var(--font); background: var(--bg); color: var(--text); line-height: 1.9;
            position: relative; overflow-x: hidden; min-height: 100vh;
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

        .wrap { max-width: 920px; margin: 44px auto; padding: 0 18px; position: relative; z-index: 1; }
        .card {
            background: rgba(255,255,255,.68);
            backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,.8); border-radius: var(--radius-card);
            padding: var(--sp-8); box-shadow: 0 12px 40px rgba(15,23,42,.06);
        }
        h1, h2 { color: var(--accent); }
        h1 { margin-top: 0; text-align: center; }
        p, li { color: var(--muted); }
        .note {
            background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af;
            padding: var(--sp-4); border-radius: 16px; margin: var(--sp-5) 0;
        }

        .btn {
            display: inline-flex; align-items: center; justify-content: center; margin: 8px;
            padding: 12px 22px; border-radius: var(--radius-btn); color: #fff; text-decoration: none;
            font-weight: bold; border: 0; cursor: pointer; transition: filter .15s ease;
        }
        .btn:hover { filter: brightness(1.06); }
        .blue { background: var(--accent-2); }
        .green { background: var(--green); }
        .dark { background: var(--text); }
        .actions { text-align: center; margin-top: var(--sp-6); }

        @media (max-width: 600px) {
            .wrap { margin: 24px auto; padding: 0 14px; }
            .card { padding: 22px 18px; border-radius: 22px; }
            h1 { font-size: 22px; }
            .btn { padding: 12px 16px; font-size: 14px; margin: 6px 4px; }
        }
    </style>
</head>
<body>

@include('partials.site-header')
<div class="wrap">
    <div class="card">
        <h1>حریم خصوصی Scanbridge</h1>

        <div class="note">
            این صفحه توضیح می‌دهد Scanbridge چه اطلاعاتی را برای فعال‌سازی، پشتیبانی و عملکرد نرم‌افزار استفاده می‌کند.
        </div>

        <h2>۱. اطلاعات لایسنس و دستگاه</h2>
        <p>
            برای فعال‌سازی آنلاین لایسنس، نرم‌افزار Scanbridge ممکن است اطلاعاتی مانند کلید لایسنس،
            شناسه دستگاه، نام سیستم، نسخه برنامه، وضعیت فعال‌سازی و زمان آخرین بررسی آنلاین را به سرور لایسنس ارسال کند.
            این اطلاعات برای جلوگیری از سوءاستفاده از لایسنس و مدیریت تعداد دستگاه‌های مجاز استفاده می‌شود.
        </p>

        <h2>۲. اطلاعات مشتری</h2>
        <p>
            اطلاعاتی مانند نام مجموعه، نام مسئول، شماره موبایل و پلن انتخابی که از طریق واتساپ یا پنل مدیریت ثبت می‌شود،
            فقط برای صدور لایسنس، پشتیبانی، تمدید و ارتباط با مشتری استفاده می‌شود.
        </p>

        <h2>۳. اطلاعات تی‌تک</h2>
        <p>
            Scanbridge برای ورود به تی‌تک از مرورگر داخلی استفاده می‌کند.
            نرم‌افزار به‌صورت عمدی رمز عبور تی‌تک را ذخیره نمی‌کند.
            اگر مرورگر داخلی یا WebView2 اطلاعات ورود را ذخیره کند، این ذخیره‌سازی توسط موتور مرورگر/ویندوز انجام می‌شود
            و نه توسط خود نرم‌افزار Scanbridge.
        </p>

        <h2>۴. تاریخچه اسکن‌ها</h2>
        <p>
            تاریخچه اسکن‌ها و اطلاعات عملیاتی نرم‌افزار به‌صورت محلی روی سیستم کاربر ذخیره می‌شود،
            مگر در مواردی که کاربر خودش برای پشتیبانی اطلاعاتی را ارسال کند.
        </p>

        <h2>۵. امنیت</h2>
        <p>
            سرور لایسنس از HTTPS، فایروال، محدودسازی ورود و بکاپ دوره‌ای استفاده می‌کند.
            با این حال کاربر باید از رمزهای خود، سیستم ویندوز و دسترسی افراد غیرمجاز محافظت کند.
        </p>

        <h2>۶. پشتیبانی</h2>
        <p>
            در صورت درخواست پشتیبانی، ممکن است کاربر اطلاعات خطا، وضعیت لایسنس یا توضیحات مشکل را برای بررسی ارسال کند.
            این اطلاعات فقط برای حل مشکل استفاده می‌شود.
        </p>

        <div class="actions">
            <a class="btn blue" href="/">صفحه اصلی</a>
            <a class="btn green" href="/buy">خرید / تمدید</a>
            <a class="btn dark" href="/terms">شرایط استفاده</a>
        </div>
    </div>
</div>

@include('partials.site-footer')
</body>
</html>
