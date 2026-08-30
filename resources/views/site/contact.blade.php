<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>تماس با Scanbridge | پشتیبانی و خرید</title>
    <link rel="canonical" href="https://scanbridge.ir/contact">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="تماس با پشتیبانی Scanbridge برای خرید، تمدید، دریافت لایسنس و راهنمای نصب نرم‌افزار.">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta property="og:title" content="تماس با Scanbridge | پشتیبانی و خرید">
    <meta property="og:description" content="تماس با پشتیبانی Scanbridge برای خرید، تمدید، دریافت لایسنس و راهنمای نصب نرم‌افزار.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://scanbridge.ir/contact">
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
            --font: 'Arad', Tahoma, Arial, sans-serif;
        }
        @font-face {
            font-family: 'Arad';
            src: url('/fonts/Arad-Regular.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        @font-face {
            font-family: 'Arad';
            src: url('/fonts/Arad-Bold.woff2') format('woff2');
            font-weight: bold;
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

        .wrap { max-width: 820px; margin: 44px auto; padding: 0 18px; position: relative; z-index: 1; }
        .card {
            background: rgba(255,255,255,.68);
            backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,.8); border-radius: var(--radius-card);
            padding: var(--sp-8); box-shadow: 0 12px 40px rgba(15,23,42,.06); text-align: center;
        }
        h1 { color: var(--accent); margin-top: 0; }
        p { color: var(--muted); }
        .contact-box { background: var(--elevated); border: 1px solid var(--border); border-radius: 18px; padding: var(--sp-5); margin: var(--sp-6) 0; }
        .phone { direction: ltr; font-size: 26px; font-weight: bold; color: var(--green); margin: 10px 0; }

        .btn {
            display: inline-flex; align-items: center; justify-content: center; margin: 8px;
            padding: 12px 22px; border-radius: var(--radius-btn); color: #fff; text-decoration: none;
            font-weight: bold; border: 0; cursor: pointer; transition: filter .15s ease;
        }
        .btn:hover { filter: brightness(1.06); }
        .green { background: var(--green); }
        .blue { background: var(--accent-2); }
        .dark { background: var(--text); }
        .orange { background: var(--orange); }

        @media (max-width: 600px) {
            .wrap { margin: 24px auto; padding: 0 14px; }
            .card { padding: 22px 18px; border-radius: 22px; }
            h1 { font-size: 22px; }
            .phone { font-size: 20px; }
            .btn { padding: 12px 16px; font-size: 14px; margin: 6px 4px; }
        }
    </style>
</head>
<body>

@include('partials.site-header')
<div class="wrap">
    <div class="card">
        <h1>تماس با Scanbridge</h1>
        <p>
            برای خرید، تمدید، پشتیبانی یا دریافت راهنمای نصب می‌توانید از طریق واتساپ پیام بدهید.
        </p>

        <div class="contact-box">
            <h2>پشتیبانی واتساپ</h2>
            <div class="phone">09136346309</div>
            <p>سریع‌ترین روش ارتباطی برای خرید، تمدید و پشتیبانی.</p>
            <a class="btn green" href="https://wa.me/989136346309">پیام در واتساپ</a>
        </div>

        <a class="btn blue" href="/buy">خرید / تمدید</a>
        <a class="btn dark" href="/guide">راهنمای نصب</a>
    </div>
</div>

@include('partials.site-footer')
</body>
</html>
