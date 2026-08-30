<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>نرم‌افزار اسکن بارکد برای سوپرمارکت، فروشگاه و هایپرمارکت | ScanBridge</title>
    <link rel="canonical" href="https://scanbridge.ir/retail">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ScanBridge؛ سیستم هوشمند اسکن بارکد و مدیریت عملیات برای سوپرمارکت، فروشگاه و هایپرمارکت — کنار نرم‌افزار فعلی شما: اتصال موبایل به کامپیوتر، ثبت کالای ورودی، بانک بارکد پرمصرف و هشدار تاریخ انقضا.">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta property="og:title" content="ScanBridge | اسکن بارکد و مدیریت عملیات فروشگاه">
    <meta property="og:description" content="ScanBridge نرم‌افزار اتصال بارکدخوان موبایل به کامپیوتر، ثبت کالای ورودی، بانک بارکد پرمصرف و هشدار تاریخ انقضا برای سوپرمارکت، فروشگاه و هایپرمارکت.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://scanbridge.ir/retail">
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
        body { margin: 0; font-family: var(--font); background: var(--bg); color: var(--text); line-height: 1.75; }
        a { text-decoration: none; }

        .btn {
            display: inline-flex; align-items: center; justify-content: center; border-radius: var(--radius-btn);
            padding: 12px 22px; font-weight: bold; color: white; border: 0; cursor: pointer;
            transition: transform .15s ease, filter .15s ease;
        }
        .btn:hover { filter: brightness(1.06); }
        .btn:active { transform: scale(.98); }
        .btn-primary { background: var(--accent-2); }
        .btn-green { background: var(--green); }
        .btn-outline { background: transparent; color: var(--accent); border: 1.5px solid var(--accent); }

        .hero { padding: var(--sp-16) 20px var(--sp-12); }
        .hero-inner {
            max-width: 1180px; margin: auto; display: grid; grid-template-columns: 1.05fr .95fr;
            gap: var(--sp-8); align-items: center;
        }
        .badge {
            display: inline-block; background: var(--elevated); border: 1px solid var(--border);
            color: var(--accent); padding: 6px 14px; border-radius: 999px; margin-bottom: var(--sp-5);
            font-weight: bold; font-size: 13px;
        }
        h1 { font-size: 40px; line-height: 1.35; margin: 0 0 var(--sp-4); color: var(--text); }
        .hero p { color: var(--muted); font-size: 17px; margin: 0 0 var(--sp-6); }
        .hero-actions { display: flex; flex-wrap: wrap; gap: var(--sp-3); }

        .mock { background: var(--elevated); border: 1px solid var(--border); border-radius: 28px; padding: var(--sp-5); }
        .mock-card { background: var(--surface); color: var(--text); border-radius: var(--radius-card); padding: var(--sp-5); box-shadow: 0 12px 40px rgba(15,23,42,.06); }
        .mock-card-title { font-weight: bold; color: var(--accent); margin-bottom: var(--sp-3); }
        .mock-row {
            display: flex; justify-content: space-between; align-items: center;
            background: var(--bg); border: 1px solid var(--border); border-radius: var(--sp-4);
            padding: var(--sp-3) var(--sp-4); margin-top: var(--sp-2); font-size: 14px;
        }
        .dot { width: 10px; height: 10px; background: var(--green); border-radius: 50%; display: inline-block; }

        section { padding: var(--sp-12) 20px; }
        .container { max-width: 1180px; margin: auto; }
        .section-title { text-align: center; margin-bottom: var(--sp-8); }
        .section-title h2 { color: var(--accent); font-size: 30px; margin: 0 0 var(--sp-2); }
        .section-title p { color: var(--muted); margin: 0; }

        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: var(--sp-5); }
        .card {
            background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-card);
            padding: var(--sp-6); box-shadow: 0 12px 40px rgba(15,23,42,.06);
        }
        .card h3 { margin: 0 0 var(--sp-3); color: var(--accent); font-size: 20px; }
        .card p { color: var(--muted); margin: 0; }
        .feat-icon { width: 56px; height: 56px; border-radius: 16px; object-fit: cover; margin-bottom: var(--sp-3); display: block; background: transparent; mix-blend-mode: multiply; }

        .plan-wrap { max-width: 520px; margin: 0 auto; }
        .plan {
            background: var(--surface); border: 2px solid var(--accent-2); border-radius: 26px; padding: var(--sp-6);
            box-shadow: 0 0 0 5px rgba(37,99,235,.12), 0 18px 44px rgba(37,99,235,.18);
            display: flex; flex-direction: column;
        }
        .plan-icon { width: 64px; height: 64px; border-radius: 18px; object-fit: cover; background: transparent; mix-blend-mode: multiply; flex-shrink: 0; }
        .plan h3 { display: flex; align-items: center; gap: var(--sp-3); margin: 4px 0 2px; color: var(--accent); font-size: 24px; }
        .plan > p { color: var(--muted); margin: 0 0 var(--sp-3); }
        .plan ul { padding: 0; list-style: none; margin: var(--sp-4) 0; }
        .plan li { padding: 7px 0; color: #334155; }
        .plan li::before { content: "✓"; color: var(--green); font-weight: bold; margin-left: var(--sp-2); }
        .plan-price { margin: 2px 0 var(--sp-3); padding: var(--sp-3); background: #eff6ff; border: 1px solid #dbeafe; border-radius: var(--sp-4); text-align: center; }
        .plan-price-annual { font-size: 23px; font-weight: 800; color: var(--accent); line-height: 1.3; }
        .plan-price-annual small { font-size: 12px; font-weight: bold; color: var(--muted); }
        .plan-price-monthly { font-size: 12.5px; color: var(--muted); margin-top: 3px; }
        .plan-price-empty { font-size: 13px; color: var(--muted); text-align: center; margin: 2px 0 var(--sp-3); }
        .launch-tag { display: inline-block; background: #fee2e2; color: #dc2626; font-size: 11px; font-weight: bold; border-radius: 999px; padding: 2px 10px; margin-top: 6px; }

        .enterprise-note {
            display: flex; align-items: center; gap: var(--sp-4); background: var(--surface); border: 1px solid var(--border);
            border-radius: 16px; padding: var(--sp-4) var(--sp-5); margin: var(--sp-6) auto 0; max-width: 520px;
            box-shadow: 0 8px 22px rgba(15,23,42,.06); color: var(--muted); font-size: 14.5px; text-align: center;
        }
        .enterprise-note b { color: var(--accent); }

        .cta {
            background: linear-gradient(135deg, var(--accent), var(--accent-2)); color: white; border-radius: 30px;
            padding: var(--sp-8); display: flex; justify-content: space-between; align-items: center; gap: var(--sp-5);
        }
        .cta h2 { margin: 0 0 var(--sp-2); }
        .cta p { margin: 0; color: #dbeafe; }

        .scb-reveal { opacity: 0; transform: translateY(30px); transition: opacity .7s cubic-bezier(.22,.61,.36,1), transform .7s cubic-bezier(.22,.61,.36,1); }
        .scb-reveal.scb-show { opacity: 1; transform: translateY(0); }
        @media (prefers-reduced-motion: reduce) { .scb-reveal { opacity: 1; transform: none; transition: none; } }

        @media (max-width: 900px) {
            .hero-inner, .grid-3 { grid-template-columns: 1fr; }
            h1 { font-size: 30px; }
            .cta { flex-direction: column; align-items: stretch; }
        }
    </style>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "SoftwareApplication",
      "name": "ScanBridge برای فروشگاه",
      "url": "https://scanbridge.ir/retail",
      "applicationCategory": "BusinessApplication",
      "operatingSystem": "Windows 10, Windows 11",
      "inLanguage": "fa-IR",
      "description": "سیستم هوشمند اسکن بارکد و مدیریت عملیات — برای سوپرمارکت، فروشگاه و هایپرمارکت",
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
            <div class="badge">برای سوپرمارکت، فروشگاه و هایپرمارکت</div>
            <h1>اسکن بارکد و مدیریت عملیات فروشگاه با ScanBridge</h1>
            <p>
                کنار نرم‌افزار فروشگاهی فعلی خود ScanBridge را نصب کنید: اسکن سریع با موبایل،
                ثبت گروهی کالای ورودی، هشدار تاریخ انقضا و بانک بارکد پرمصرف —
                بدون نیاز به خرید بارکدخوان جدید.
            </p>
            <div class="hero-actions">
                <a class="btn btn-green" href="https://wa.me/989136346309">مشاوره واتساپ</a>
                <a class="btn btn-primary" href="/download">دانلود نرم‌افزار</a>
                <a class="btn btn-outline" href="/pharmacy">نسخه‌ی داروخانه رو می‌خوام</a>
            </div>
        </div>
        <div class="mock scb-reveal">
            <div class="mock-card">
                <div class="mock-card-title">آخرین اسکن‌ها</div>
                <div class="mock-row"><span>شامپو ضدشوره ۴۰۰ میلی‌لیتر</span><span class="dot"></span></div>
                <div class="mock-row"><span>بیسکویت خانواده</span><span class="dot"></span></div>
                <div class="mock-row"><span>نوشابه قوطی ۳۳۰ سی‌سی</span><span class="dot"></span></div>
                <div class="mock-row"><span>هشدار انقضا: ۳ قلم کالا</span><span class="dot"></span></div>
            </div>
        </div>
    </div>
</header>

<section id="features">
    <div class="container">
        <div class="section-title">
            <h2>امکانات اصلی</h2>
            <p>برای کاهش خطا، افزایش سرعت و مدیریت بهتر عملیات روزانه فروشگاه</p>
        </div>

        <div class="grid-3">
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-barcode.png" alt="">اتصال بارکدخوان موبایل</h3>
                <p>با اسکن QR، موبایل به کامپیوتر وصل می‌شود و بارکدها سریع وارد سیستم می‌شوند — با موبایل خودتان یا اسکنر فعلی.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-delivery.png" alt="">ثبت کالای ورودی</h3>
                <p>ثبت گروهی بارکدهای کالای دریافتی، افزودن به انبار فروشگاه، خروجی Excel و PDF و مشاهده جزئیات هر ردیف.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-expiry.png" alt="">هشدار تاریخ انقضا</h3>
                <p>پایش خودکار اقلام و هشدار برای کالاهایی که تاریخ انقضای نزدیک دارند، با تنظیم آستانه و تکرار یادآوری دلخواه.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-barcodebank.png" alt="">بانک بارکد پرمصرف</h3>
                <p>بارکدهای پرفروش را در گروه‌های دلخواه ذخیره کن و بین چند صندوق یا سیستم هم‌شبکه به‌سرعت به اشتراک بگذار.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-status.png" alt="">تعیین وضعیت کالا</h3>
                <p>بررسی و تأیید یا رد کالای دریافتی هنگام تحویل بار، تکی یا گروهی.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-history.png" alt="">تاریخچه و خروجی</h3>
                <p>ثبت تاریخچه اسکن‌ها، جستجو، فیلتر، خروجی Excel و PDF برای گزارش‌گیری.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/trust-mobile.png" alt="">قفل اینترنت پرسنل</h3>
                <p>گوشی پرسنل فروشگاه به وای‌فای وصل می‌شود ولی فقط برای اسکن کار می‌کند — بدون اینترنت آزاد.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-remote.png" alt="">پشتیبانی از راه دور</h3>
                <p>با یک اتصال سریع، تیم پشتیبانی می‌تواند مستقیم مشکل را از راه دور بررسی و رفع کند.</p>
            </div>
            <div class="card scb-reveal">
                <h3><img class="feat-icon" src="/icons/feature-autoupdate.png" alt="">به‌روزرسانی خودکار</h3>
                <p>نرم‌افزار هر ۲۴ ساعت خودش بررسی می‌کند و در صورت وجود نسخه جدید، به‌سادگی مطلعتان می‌کند.</p>
            </div>
        </div>
    </div>
</section>

<section id="plans" style="background:var(--elevated);">
    <div class="container">
        <div class="section-title">
            <h2>پلن ScanBridge برای فروشگاه‌ها</h2>
            <p>کنار نرم‌افزار فعلی‌تان — بدون نیاز به تجهیزات جدید</p>
        </div>

        @php
            $scbPlanPrice = function (string $plan) use ($planPrices) {
                $entry = $planPrices[$plan] ?? null;
                if (!$entry) { return null; }
                $annual = $entry['annual'] ?? $entry['longest'];
                return $annual ? ['annual' => (int) $annual, 'monthly' => (int) round($annual / 12)] : null;
            };
            $pBase = $scbPlanPrice('Normal');
        @endphp

        <div class="plan-wrap">
            <div class="plan scb-reveal">
                <h3><img class="plan-icon" src="/icons/plan-normal.png" alt="">پایه</h3>
                <p>مناسب برای اسکن و مدیریت بارکد فروشگاه</p>
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
                <a class="btn btn-primary" href="https://wa.me/989136346309">درخواست خرید</a>
            </div>
        </div>

        <div class="enterprise-note">
            برای فروشگاه‌های زنجیره‌ای یا بزرگ با نیاز به امکانات کامل (ثبت کالای ورودی، بانک بارکد، هشدار انقضا و قفل اینترنت پرسنل)، از طریق <b>واتساپ</b> با ما در تماس باشید تا پلن مناسب کسب‌وکارتان را پیشنهاد بدهیم.
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="cta scb-reveal">
            <div>
                <h2>برای خرید، تست یا مشاوره پیام بدهید</h2>
                <p>از طریق واتساپ سریع‌تر پاسخ می‌گیرید.</p>
            </div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <a class="btn btn-green" href="https://wa.me/989136346309">واتساپ 09136346309</a>
                <a class="btn btn-primary" href="/download">دانلود نرم‌افزار</a>
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
