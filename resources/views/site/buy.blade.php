<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>خرید و تمدید Scanbridge | درخواست لایسنس</title>
    <link rel="canonical" href="https://scanbridge.ir/buy">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="خرید، تمدید یا تغییر پلن ScanBridge — پایه، تی‌تک و حرفه‌ای (یک‌ساله) با ثبت درخواست آنلاین.">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta property="og:title" content="خرید و تمدید Scanbridge | درخواست لایسنس">
    <meta property="og:description" content="خرید، تمدید یا تغییر پلن ScanBridge — پایه، تی‌تک و حرفه‌ای (یک‌ساله) با ثبت درخواست آنلاین.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://scanbridge.ir/buy">
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
            margin: 0; font-family: var(--font); background: var(--bg); color: var(--text);
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

        .wrap { max-width: 980px; margin: 44px auto; padding: 0 18px; position: relative; z-index: 1; }
        .card {
            background: rgba(255,255,255,.68);
            backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,.8); border-radius: var(--radius-card);
            padding: var(--sp-8); box-shadow: 0 12px 40px rgba(15,23,42,.06);
        }
        h1 { color: var(--accent); text-align: center; margin: 0 0 10px; font-size: 30px; }
        .lead { color: var(--muted); line-height: 1.9; text-align: center; margin: 0 0 28px; }

        .plans { display: grid; grid-template-columns: repeat(3, 1fr); gap: var(--sp-3); margin: var(--sp-6) 0; }
        .plan {
            border: 1px solid var(--border); border-radius: 18px; padding: var(--sp-4); text-align: center;
            background: var(--elevated); cursor: pointer; transition: .15s;
        }
        .plan:hover { transform: translateY(-2px); border-color: var(--accent-2); }
        .plan strong { color: var(--accent); font-size: 21px; display: block; margin-bottom: 6px; }
        .plan span { color: var(--muted); font-size: 13px; }

        .form { margin-top: var(--sp-6); display: grid; grid-template-columns: repeat(2, 1fr); gap: var(--sp-3); }
        label { display: block; font-weight: bold; color: #334155; margin-bottom: 6px; font-size: 13px; }
        input, select, textarea {
            width: 100%; border: 1px solid #d1d5db; border-radius: 14px; min-height: 46px;
            padding: 10px 12px; font-size: 14px; font-family: var(--font); outline: none; background: #fff; color: var(--text);
        }
        input:focus, select:focus, textarea:focus {
            border-color: var(--accent-2); box-shadow: 0 0 0 4px rgba(37,99,235,.10);
        }
        .full { grid-column: 1 / -1; }
        .actions { display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; margin-top: var(--sp-6); }

        .btn, button {
            display: inline-flex; align-items: center; justify-content: center;
            padding: 12px 22px; border-radius: var(--radius-btn); color: #fff; text-decoration: none;
            font-weight: bold; border: 0; cursor: pointer; font-family: var(--font); font-size: 14px;
            transition: filter .15s ease;
        }
        .btn:hover, button:hover { filter: brightness(1.06); }
        .green { background: var(--green); }
        .blue { background: var(--accent-2); }
        .dark { background: var(--text); }
        .orange { background: var(--orange); }

        .note {
            margin-top: var(--sp-5); background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af;
            padding: var(--sp-4); border-radius: 16px; line-height: 1.8; font-size: 13px;
        }

        @media(max-width:800px){
            .plans, .form { grid-template-columns: 1fr; }
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

<div id="scbModalOverlay" style="display:none; position:fixed; inset:0; background:rgba(15,23,42,.55); z-index:999; align-items:center; justify-content:center; padding:20px;">
    <div style="position:relative; background:#fff; border-radius:22px; max-width:420px; width:100%; padding:50px 26px 30px; text-align:center; box-shadow:0 20px 60px rgba(15,23,42,.25);">
        <img src="/icons/icon-warning.png" alt="" style="position:absolute; top:-50px; left:50%; transform:translateX(-50%); width:110px; height:110px; filter:drop-shadow(0 10px 16px rgba(220,38,38,.35));">
        <div style="font-size:17px; font-weight:bold; color:#0f172a; margin-bottom:10px;">لطفاً این فیلدها را پر کنید</div>
        <div id="scbModalList" style="font-size:14px; color:#64748b; line-height:2;"></div>
        <button onclick="document.getElementById('scbModalOverlay').style.display='none';" style="margin-top:20px; background:#2563eb; color:#fff; border:0; border-radius:14px; padding:12px 28px; font-weight:bold; font-family:inherit; font-size:14px; cursor:pointer;">متوجه شدم</button>
    </div>
</div>
<div class="wrap">
    <div class="card">
        <h1>خرید و تمدید ScanBridge</h1>
        <p class="lead">
            اطلاعات زیر را وارد کنید تا درخواست شما ثبت شود.
            همه پلن‌ها یک‌ساله هستند و بعد از تأیید، پلن در پنل کاربری شما فعال می‌شود.
        </p>
        @if(!empty($customer->name))
        <p style="color:#2563eb;font-weight:bold;font-size:13.5px;margin-top:-6px;">
            سلام {{ $customer->name }} 👋 این درخواست با حساب پنل شما ثبت می‌شود.
        </p>
        @endif

        <div class="form">
            <div>
                <label>نام مجموعه</label>
                <input id="orgName" placeholder="مثلاً داروخانه دکتر محمدی یا شرکت ...">
            </div>

            <div>
                <label>نام مسئول</label>
                <input id="contactName" placeholder="نام و نام خانوادگی" value="{{ $customer->name ?? '' }}">
            </div>

            <div>
                <label>شماره موبایل</label>
                <input id="mobile" placeholder="09xxxxxxxxx" dir="ltr" value="{{ $customer->mobile ?? '' }}">
            </div>

            <div>
                <label>پلن موردنظر</label>
                <select id="plan">
                    <option value="Ttac" selected>تی‌تک ⭐ (پیشنهاد ما برای اکثر داروخانه‌ها)</option>
                    <option value="Normal">پایه — اسکن و تاریخچه</option>
                    <option value="TtacPlus">حرفه‌ای — امکانات کامل</option>
                    <option value="Trial">آزمایشی — ۱۴ روزه رایگان (دمو)</option>
                </select>
            </div>

            <div>
                <label>تعداد سیستم</label>
                <input id="devices" type="number" value="1" min="1" max="50">
            </div>

            <div>
                <label>نوع درخواست</label>
                <select id="requestType">
                    <option value="خرید جدید">خرید جدید</option>
                    <option value="تمدید">تمدید</option>
                    <option value="تغییر پلن">تغییر پلن</option>
                    <option value="نسخه آزمایشی">نسخه آزمایشی</option>
                </select>
            </div>

            <div class="full">
                <label>توضیحات</label>
                <textarea id="desc" rows="3" placeholder="اگر توضیح خاصی دارید بنویسید..."></textarea>
            </div>
        </div>

        <div id="scbSuccessBox" style="display:none; background:linear-gradient(135deg,#059669,#10b981); color:#fff; border-radius:22px; padding:38px 22px; text-align:center; margin-bottom:24px; box-shadow:0 14px 40px rgba(5,150,105,.25);">
            <div style="font-size:48px; line-height:1; margin-bottom:14px;">✅</div>
            <div style="font-size:21px; font-weight:bold; margin-bottom:10px;">درخواست شما با موفقیت ثبت شد</div>
            <div style="font-size:14.5px; opacity:.95; line-height:2;">
                بعد از بررسی و تأیید، پلن شما در پنل کاربری فعال خواهد شد.<br>
                کارشناسان ما نیز برای هماهنگی با شما تماس می‌گیرند.
            </div>
            <a href="/panel" style="display:inline-block; margin-top:18px; background:#fff; color:#059669; font-weight:bold; border-radius:12px; padding:10px 24px; text-decoration:none;">رفتن به پنل کاربری</a>
        </div>

        <div id="priceBox" style="background:linear-gradient(135deg,#1e3a8a,#2563eb); color:#fff; border-radius:22px; padding:32px 22px; text-align:center; margin-bottom:24px; min-height:150px; display:flex; flex-direction:column; align-items:center; justify-content:center;">
            <div style="font-size:15px; opacity:.85; margin-bottom:8px;">قیمت نهایی</div>
            <div style="font-size:44px; font-weight:bold;" id="priceAmount">۰ تومان</div>
            <div style="font-size:13px; opacity:.8; margin-top:8px;" id="priceDetail"></div>
        </div>

        <div class="actions">
            <button class="green" onclick="submitRequest()">ثبت درخواست</button>
        </div>

        <div class="note">
            بعد از تأیید درخواست، کد لایسنس مثل <b>SCB-XXXXX-XXXXX-XXXXX-XXXXX</b> در پنل کاربری شما قرار می‌گیرد و داخل برنامه فعال می‌کنید.
        </div>
    </div>
</div>

<script>
    const scbPrices = @json($pricingData ?? []);
    const scbDeviceData = @json($deviceData ?? []);

    function scbFormatToman(n) {
        return n.toLocaleString('en-US') + ' تومان';
    }

    function updatePrice() {
        const plan = document.getElementById('plan').value;
        const devices = parseInt(document.getElementById('devices').value || '1', 10);
        const priceAmount = document.getElementById('priceAmount');
        const priceDetail = document.getElementById('priceDetail');

        if (plan === 'Trial') {
            priceAmount.textContent = 'رایگان';
            priceDetail.textContent = 'نسخه آزمایشی ۱۴ روزه';
            return;
        }

        const duration = 12; // فقط پلن یک‌ساله
        const basePrice = (scbPrices[plan] && scbPrices[plan][duration]) ? scbPrices[plan][duration] : 0;
        const deviceInfo = scbDeviceData[plan] || { base_devices: 1, price_per_extra_device: 0 };
        const extraDevices = Math.max(0, devices - deviceInfo.base_devices);
        const extraCost = extraDevices * deviceInfo.price_per_extra_device;
        const total = basePrice + extraCost;

        priceAmount.textContent = scbFormatToman(total);

        if (extraDevices > 0) {
            priceDetail.textContent = 'یک‌ساله — شامل ' + extraDevices + ' دستگاه اضافه، هر کدام ' + deviceInfo.price_per_extra_device.toLocaleString('en-US') + ' تومان';
        } else {
            priceDetail.textContent = 'یک‌ساله';
        }
    }

    function setPlan(plan) {
        document.getElementById('plan').value = plan;
        updatePrice();
        window.scrollTo({ top: document.querySelector('.form').offsetTop - 20, behavior: 'smooth' });
    }

    (function () {
        const params = new URLSearchParams(window.location.search);
        const planFromUrl = params.get('plan');
        const validPlans = ['Normal', 'Ttac', 'TtacPlus', 'Trial'];
        if (planFromUrl && validPlans.includes(planFromUrl)) {
            document.getElementById('plan').value = planFromUrl;
        }
        document.getElementById('plan').addEventListener('change', updatePrice);
        document.getElementById('devices').addEventListener('input', updatePrice);
        updatePrice();
    })();

    function val(id) {
        return document.getElementById(id).value.trim();
    }

    function scbClearErrors() {
        ['orgName', 'contactName', 'mobile', 'devices'].forEach(function (id) {
            document.getElementById(id).style.border = '';
        });
    }

    function scbValidateForm() {
        scbClearErrors();
        const requiredFields = [
            { id: 'orgName', label: 'نام مجموعه' },
            { id: 'contactName', label: 'نام مسئول' },
            { id: 'mobile', label: 'شماره موبایل' },
            { id: 'devices', label: 'تعداد سیستم' },
        ];
        let firstInvalid = null;
        let missing = [];

        requiredFields.forEach(function (f) {
            const el = document.getElementById(f.id);
            if (!el.value || !el.value.trim()) {
                el.style.border = '2px solid #dc2626';
                missing.push(f.label);
                if (!firstInvalid) { firstInvalid = el; }
            }
        });

        if (missing.length > 0) {
            document.getElementById('scbModalList').textContent = missing.join('، ');
            document.getElementById('scbModalOverlay').style.display = 'flex';
            if (firstInvalid) { firstInvalid.focus(); }
            return false;
        }
        return true;
    }

    async function submitRequest() {
        if (!scbValidateForm()) {
            return;
        }

        const payload = {
            organization_name: val('orgName'),
            contact_name: val('contactName'),
            mobile: val('mobile'),
            plan: val('plan'),
            devices: parseInt(val('devices') || '1', 10),
            request_type: val('requestType'),
            description: val('desc')
        };

        const btn = document.querySelector('.actions .green');
        if (btn) { btn.disabled = true; btn.textContent = 'در حال ثبت درخواست...'; }

        try {
            const res = await fetch('/buy/request', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(payload)
            });
            if (!res.ok) {
                if (res.status === 401) {
                    alert('نشست شما منقضی شده است. لطفاً دوباره وارد شوید.');
                    window.location.href = '/panel/login';
                } else {
                    alert('ثبت درخواست با خطا مواجه شد. لطفاً دوباره تلاش کنید.');
                }
                return;
            }

            document.getElementById('scbSuccessBox').style.display = '';
            document.querySelector('.card .form').style.display = 'none';
            document.getElementById('priceBox').style.display = 'none';
            document.querySelector('.card .actions').style.display = 'none';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } catch (e) {
            alert('ثبت درخواست با خطا مواجه شد. لطفاً دوباره تلاش کنید.');
        } finally {
            if (btn) { btn.disabled = false; btn.textContent = 'ثبت درخواست'; }
        }
    }

</script>

@include('partials.site-footer')
</body>
</html>
