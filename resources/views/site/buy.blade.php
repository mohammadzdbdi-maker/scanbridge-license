<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>خرید و تمدید Scanbridge | درخواست لایسنس</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="خرید، تمدید یا تغییر پلن ScanBridge — پایه، تی‌تک و حرفه‌ای (یک‌ساله) از طریق ارسال درخواست واتساپ.">
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
            background:
                radial-gradient(circle at top left, rgba(37,99,235,.12), transparent 35%),
                #f8fafc;
            color: #0f172a;
        }
        .wrap {
            max-width: 980px;
            margin: 44px auto;
            padding: 0 18px;
        }
        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 30px;
            padding: 32px;
            box-shadow: 0 18px 60px rgba(15,23,42,.08);
        }
        h1 {
            color: #1e3a8a;
            text-align: center;
            margin: 0 0 10px;
            font-size: 30px;
        }
        .lead {
            color: #64748b;
            line-height: 1.9;
            text-align: center;
            margin: 0 0 28px;
        }
        .plans {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin: 24px 0;
        }
        .plan {
            border: 1px solid #e5e7eb;
            border-radius: 22px;
            padding: 18px;
            text-align: center;
            background: #f8fafc;
            cursor: pointer;
            transition: .15s;
        }
        .plan:hover {
            transform: translateY(-2px);
            border-color: #2563eb;
        }
        .plan strong {
            color: #1e3a8a;
            font-size: 21px;
            display: block;
            margin-bottom: 6px;
        }
        .plan span {
            color: #64748b;
            font-size: 13px;
        }
        .form {
            margin-top: 24px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }
        label {
            display: block;
            font-weight: bold;
            color: #334155;
            margin-bottom: 6px;
            font-size: 13px;
        }
        input, select, textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 16px;
            min-height: 46px;
            padding: 10px 12px;
            font-size: 14px;
            font-family: 'Pinar', Tahoma, Arial, sans-serif;
            outline: none;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37,99,235,.10);
        }
        .full { grid-column: 1 / -1; }
        .actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-top: 24px;
        }
        a, button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 13px 22px;
            border-radius: 16px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border: 0;
            cursor: pointer;
            font-family: 'Pinar', Tahoma, Arial, sans-serif;
            font-size: 14px;
        }
        .green { background: #16a34a; }
        .blue { background: #2563eb; }
        .dark { background: #0f172a; }
        .orange { background: #f97316; }
        .note {
            margin-top: 20px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1e40af;
            padding: 14px;
            border-radius: 18px;
            line-height: 1.8;
            font-size: 13px;
        }
        @media(max-width:800px){
            .plans, .form { grid-template-columns: 1fr; }
            .card { padding: 22px; }
        }
        @media(max-width:480px){
            .wrap { margin: 24px auto; padding: 0 12px; }
            .card { padding: 18px; border-radius: 22px; }
            h1 { font-size: 22px; }
        }
    </style>

    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <meta property="og:title" content="خرید و تمدید Scanbridge | درخواست لایسنس">
    <meta property="og:description" content="خرید، تمدید یا تغییر پلن Scanbridge شامل Normal، Ttac و TtacPlus از طریق ارسال درخواست واتساپ.">
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
            اطلاعات زیر را وارد کنید تا پیام آماده واتساپ ساخته شود.
            همه پلن‌ها یک‌ساله هستند و بعد از ارسال درخواست، لایسنس برای شما صادر می‌شود.
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

        <div id="priceBox" style="background:linear-gradient(135deg,#1e3a8a,#2563eb); color:#fff; border-radius:22px; padding:32px 22px; text-align:center; margin-bottom:24px; min-height:150px; display:flex; flex-direction:column; align-items:center; justify-content:center;">
            <div style="font-size:15px; opacity:.85; margin-bottom:8px;">قیمت نهایی</div>
            <div style="font-size:44px; font-weight:bold;" id="priceAmount">۰ تومان</div>
            <div style="font-size:13px; opacity:.8; margin-top:8px;" id="priceDetail"></div>
        </div>

        <div class="actions">
            <button class="green" onclick="sendWhatsApp()">ثبت درخواست و ارسال واتساپ</button>
        </div>

        <div class="note">
            بعد از ارسال درخواست، کد لایسنس مثل <b>SCB-XXXXX-XXXXX-XXXXX-XXXXX</b> برای شما صادر می‌شود و داخل برنامه فعال می‌کنید.
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

    async function sendWhatsApp() {
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

        const text =
`سلام، برای Scanbridge درخواست دارم.

نوع درخواست: ${payload.request_type}
نام مجموعه: ${payload.organization_name}
نام مسئول: ${payload.contact_name}
شماره موبایل: ${payload.mobile}
پلن موردنظر: ${payload.plan}
تعداد سیستم: ${payload.devices}

توضیحات:
${payload.description || '-'}`;

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
                alert('نشست شما منقضی شده است. لطفاً دوباره وارد شوید.');
                window.location.href = '/panel/login';
                return;
            }
        } catch (e) {}

        const url = 'https://wa.me/989136346309?text=' + encodeURIComponent(text);
        window.open(url, '_blank');
    }

</script>

@include('partials.site-footer')
</body>
</html>
