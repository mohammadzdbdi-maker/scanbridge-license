<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>پنل من | Scanbridge</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        .nav {
            position: sticky;
            top: 0;
            z-index: 10;
            background: rgba(255,255,255,.92);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid #e5e7eb;
        }
        .nav-inner {
            max-width: 1100px;
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
            font-size: 22px;
            font-weight: bold;
            color: #1e3a8a;
            direction: ltr;
        }
        .logo-bars { display: inline-flex; gap: 4px; }
        .logo-bars span { width: 6px; height: 24px; border-radius: 5px; display: block; }
        .b1 { background:#1e3a8a; }
        .b2 { background:#f59e0b; }
        .b3 { background:#2563eb; }
        .nav-right { display: flex; align-items: center; gap: 12px; }
        .nav-right span { font-weight: bold; color: #334155; font-size: 14px; }
        .btn-logout {
            background: #f1f5f9;
            color: #0f172a;
            border: 0;
            border-radius: 12px;
            padding: 8px 14px;
            font-family: inherit;
            font-weight: bold;
            font-size: 13px;
            cursor: pointer;
        }
        .wrap { max-width: 1100px; margin: auto; padding: 30px 20px 60px; position: relative; z-index: 1; }
        .flash-ok {
            background: #f0fdf4;
            color: #15803d;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .flash-error {
            background: #fef2f2;
            color: #b91c1c;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .section-title { font-size: 18px; font-weight: bold; margin: 30px 0 14px; }
        .grid { display: grid; grid-template-columns: 1fr; gap: 14px; }
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(15,23,42,.05);
            padding: 20px;
        }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th, td { text-align: right; padding: 10px 8px; border-bottom: 1px solid #f1f5f9; }
        th { color: #64748b; font-size: 13px; }
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-active { background: #f0fdf4; color: #15803d; }
        .badge-disabled { background: #fef2f2; color: #b91c1c; }
        .badge-new { background: #eff6ff; color: #2563eb; }
        .badge-contacted { background: #fefce8; color: #a16207; }
        .badge-done { background: #f0fdf4; color: #15803d; }
        .badge-ignored { background: #f1f5f9; color: #64748b; }
        .empty { color: #94a3b8; font-size: 14px; padding: 10px 0; }
        .scb-status-filters { display: flex; gap: 6px; flex-wrap: wrap; }
        .scb-status-pill {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 12.5px;
            font-weight: bold;
            text-decoration: none;
            color: #334155;
            background: #f1f5f9;
        }
        .scb-status-pill.active { background: linear-gradient(135deg,#1e3a8a,#2563eb); color: #fff; }
        .scb-ticket { border: 1px solid #e5e7eb; border-radius: 14px; margin-bottom: 14px; background: #f9fafb; overflow: hidden; }
        .scb-ticket-head { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; padding: 14px 16px; font-size: 14px; cursor: pointer; user-select: none; transition: background .2s; }
        .scb-ticket-head:hover { background: #f1f5f9; }
        .scb-ticket-head-info { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        .scb-chevron { width: 18px; height: 18px; color: #94a3b8; transition: transform .3s ease; flex-shrink: 0; }
        .scb-ticket-body { max-height: 0; overflow: hidden; padding: 0 16px; transition: max-height .4s ease, padding .4s ease; }
        .scb-ticket-body.open { max-height: 650px; padding: 0 16px 16px; }
        .scb-chat {
            max-height: 360px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 14px;
            background: #eef2f7;
            border-radius: 14px;
            margin-bottom: 12px;
        }
        .scb-row { display: flex; }
        .scb-row-customer { justify-content: flex-end; }
        .scb-row-admin { justify-content: flex-start; }
        .scb-bubble {
            max-width: 78%;
            padding: 9px 13px;
            border-radius: 16px;
            font-size: 13.5px;
            line-height: 1.7;
        }
        .scb-bubble-customer {
            background: linear-gradient(135deg,#2563eb,#1d4ed8);
            color: #fff;
            border-bottom-left-radius: 4px;
        }
        .scb-bubble-admin {
            background: #fff;
            color: #0f172a;
            border: 1px solid #e2e8f0;
            border-bottom-right-radius: 4px;
        }
        .scb-bubble-time { font-size: 10.5px; opacity: .65; margin-top: 4px; text-align: left; direction: ltr; }
        .scb-reply-form { display: flex; gap: 8px; align-items: flex-end; margin: 0; }
        .scb-reply-form textarea {
            flex: 1;
            min-height: 44px;
            max-height: 120px;
            resize: none;
            border-radius: 20px;
            margin-bottom: 0;
            padding: 11px 16px;
        }
        .scb-send {
            width: 44px;
            height: 44px;
            min-width: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            margin: 0;
            flex-shrink: 0;
            border: 0;
            background: linear-gradient(135deg,#1e3a8a,#2563eb);
            color: #fff;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(30,58,138,.25);
        }
        .scb-send svg { width: 19px; height: 19px; transform: scaleX(-1); }
        label { display: block; font-weight: bold; font-size: 14px; margin-bottom: 6px; }
        input, select, textarea {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            margin-bottom: 16px;
            font-family: inherit;
            font-size: 15px;
            background: white;
        }
        textarea { resize: vertical; min-height: 90px; }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            padding: 12px 22px;
            font-weight: bold;
            color: white;
            border: 0;
            cursor: pointer;
            background: #2563eb;
            font-family: inherit;
            font-size: 15px;
        }
        .license-key { direction: ltr; font-family: monospace; font-size: 13px; }
        .scb-reveal{opacity:0;transform:translateY(24px);transition:opacity .6s cubic-bezier(.22,.61,.36,1),transform .6s cubic-bezier(.22,.61,.36,1);}
        .scb-reveal.scb-show{opacity:1;transform:translateY(0);}
        @media (prefers-reduced-motion:reduce){.scb-reveal{opacity:1;transform:none;transition:none;}}
    </style>

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

<style>/*SCB_PANEL_V1*/
header{background:linear-gradient(135deg,#1e3a8a,#2563eb)!important;box-shadow:0 8px 25px rgba(30,58,138,.35)!important;border-radius:0 0 18px 18px!important;}
.stats{display:grid!important;grid-template-columns:repeat(auto-fit,minmax(190px,1fr))!important;gap:14px!important;}
.stat{background:#fff!important;border-radius:18px!important;border:1px solid #e5e7eb!important;box-shadow:0 10px 30px rgba(15,23,42,.08)!important;padding:18px!important;}
.stat .num{font-size:26px!important;color:#1e3a8a!important;}
.card{background:rgba(255,255,255,.85)!important;border-radius:20px!important;border:1px solid #e5e7eb!important;box-shadow:0 10px 30px rgba(15,23,42,.06)!important;backdrop-filter:blur(10px)!important;}
.card h2{color:#1e3a8a!important;}
table{border-collapse:separate!important;border-spacing:0 8px!important;}
td{background:#f8fafc!important;border:1px solid #eef2f7!important;border-radius:10px!important;}
th{color:#64748b!important;}
.btn{border-radius:12px!important;box-shadow:0 4px 12px rgba(15,23,42,.12)!important;}
.badge{border-radius:999px!important;font-weight:bold!important;}
.flash-ok,.alert-ok{background:#dcfce7!important;border:1px solid #bbf7d0!important;color:#166534!important;border-radius:14px!important;}
.flash-error,.alert-error{background:#fee2e2!important;border:1px solid #fecaca!important;color:#991b1b!important;border-radius:14px!important;}
</style>

<style>/*SCB_COPY_V1*/.btn-copy{background:linear-gradient(135deg,#06b6d4,#0e7490);color:#fff;border:0;border-radius:8px;padding:5px 12px;font-family:inherit;font-weight:bold;font-size:12px;cursor:pointer;box-shadow:0 3px 8px rgba(6,182,212,.3);}.btn-copy:hover{filter:brightness(1.1);}.copy-note{position:fixed;left:24px;bottom:24px;background:#0f172a;color:#fff;padding:10px 18px;border-radius:12px;display:none;z-index:9999;font-size:13px;}</style>

<style>/*SCB_FONT_ALL*/
@font-face{font-family:'Pinar';src:url('/fonts/Pinar-DS1-FD-Regular.woff2') format('woff2');font-weight:normal;font-style:normal;font-display:swap;}
html,body,button,input,select,textarea,a,th,td,label,span,div,h1,h2,h3,h4,h5,h6,small,strong,summary{font-family:'Pinar',Tahoma,Arial,sans-serif!important;}
</style>

<style>/*SCB_CUST_V1*/
 .cust-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:22px;}
 .cust-stat{background:rgba(255,255,255,.72);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border:1px solid rgba(255,255,255,.9);border-radius:18px;box-shadow:0 10px 30px rgba(30,58,138,.12);padding:16px;display:flex;align-items:center;gap:12px;}
 .cust-stat img{width:46px;height:46px;border-radius:12px;object-fit:cover;}
 .cust-stat .num{font-size:24px;font-weight:800;color:#1e3a8a;line-height:1.2;}
 .cust-stat .lbl{font-size:13px;color:#64748b;}
 .badge-plan{background:#ede9fe;color:#5b21b6;border:1px solid #ddd6fe;display:inline-block;padding:4px 12px;border-radius:999px;font-size:12px;font-weight:bold;}
 .section-title{color:#1e3a8a!important;border-right:4px solid #2563eb;padding-right:10px;}
 .btn-logout{display:inline-flex;align-items:center;gap:6px;}
 @media(max-width:700px){
    .cust-stats{grid-template-columns:1fr 1fr;}
    .card{overflow-x:auto;-webkit-overflow-scrolling:touch;}
    table{min-width:560px;}
    #reqGrid{grid-template-columns:1fr 1fr !important;}
    .wrap{padding:16px 12px 40px;}
    .section-title{font-size:16px;}
}
 </style>

<style>/*SCB_ICON_BG_FIX*/
.ic{background:transparent!important;mix-blend-mode:multiply!important;}
.brand-logo,.brand img{background:transparent!important;mix-blend-mode:multiply!important;}
.feat-icon,.plan-icon,.ico-img{background:transparent!important;mix-blend-mode:multiply!important;}
.stat img,.cust-stat img{background:transparent!important;mix-blend-mode:multiply!important;}
</style>
</head>
<body>

<div id="scbModalOverlay" style="display:none; position:fixed; inset:0; background:rgba(15,23,42,.55); z-index:999; align-items:center; justify-content:center; padding:20px;">
    <div style="position:relative; background:#fff; border-radius:22px; max-width:420px; width:100%; padding:50px 26px 30px; text-align:center; box-shadow:0 20px 60px rgba(15,23,42,.25);">
        <img src="/icons/icon-warning.png" alt="" style="position:absolute; top:-50px; left:50%; transform:translateX(-50%); width:110px; height:110px; filter:drop-shadow(0 10px 16px rgba(220,38,38,.35));">
        <div style="font-size:17px; font-weight:bold; color:#0f172a; margin-bottom:10px;">لطفاً این فیلدها را پر کنید</div>
        <div id="scbModalList" style="font-size:14px; color:#64748b; line-height:2;"></div>
        <button onclick="document.getElementById('scbModalOverlay').style.display='none';" style="margin-top:20px; background:#2563eb; color:#fff; border:0; border-radius:14px; padding:12px 28px; font-weight:bold; font-family:inherit; font-size:14px; cursor:pointer;">متوجه شدم</button>
    </div>
</div>
    <div class="nav">
        <div class="nav-inner">
            <a href="https://scanbridge.ir" class="brand" style="text-decoration:none;">
                <img class="brand-logo" src="/icons/logo.png" alt="Scanbridge">
                Scanbridge
            </a>
            <div class="nav-right">
                <span>سلام، {{ $customer->name }}</span>
                <form method="POST" action="/panel/logout" style="margin:0;">
                    @csrf
                    <button type="submit" class="btn-logout"><img src="/icons/icon-logout.png" style="width:16px;height:16px;vertical-align:middle;"> خروج</button>
                </form>
            </div>
        </div>
    </div>

    <div class="wrap">
<div class="cust-stats">
  <div class="cust-stat"><img src="/icons/stat-licenses.png" alt=""><div><div class="num">{{ $licenses->count() }}</div><div class="lbl">لایسنس‌ها</div></div></div>
  <div class="cust-stat"><img src="/icons/stat-active.png" alt=""><div><div class="num">{{ $licenses->where('status','active')->count() }}</div><div class="lbl">فعال</div></div></div>
  <div class="cust-stat"><img src="/icons/stat-requests.png" alt=""><div><div class="num">{{ $requests->count() }}</div><div class="lbl">درخواست‌ها</div></div></div>
  </div>

        @if (session('ok'))
            <div class="flash-ok">{{ session('ok') }}</div>
        @endif
        @if (session('error'))
            <div class="flash-error">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="flash-error">{{ $errors->first() }}</div>
        @endif

        <div class="section-title">لایسنس‌های من</div>
        <div class="card scb-reveal">
            @if ($licenses->count() === 0)
                <div class="empty">هنوز لایسنسی برای شما ثبت نشده است.</div>
            @else
                <table>
                    <tr>
                        <th>کد لایسنس</th>
                        <th>پلن</th>
                        <th>وضعیت</th>
                        <th>تعداد دستگاه</th>
                        <th>تاریخ انقضا</th>
                    </tr>
                    @foreach ($licenses as $lic)
                    <tr>
                        <td><div style="display:flex;align-items:center;gap:8px;"><span class="license-key">{{ $lic->license_key }}</span><button type="button" class="btn-copy" onclick="copyLicense('{{ $lic->license_key }}')">کپی</button></div></td>
                        <td>{{ $lic->plan }}</td>
                        <td>
                            <span class="badge {{ $lic->status === 'active' ? 'badge-active' : 'badge-disabled' }}">
                                {{ $lic->status === 'active' ? 'فعال' : 'غیرفعال' }}
                            </span>
                        </td>
                        <td>{{ $lic->max_devices }}</td>
                        <td>{{ $lic->expires_at ? \Carbon\Carbon::parse($lic->expires_at)->format('Y-m-d') : '—' }}</td>
                    </tr>
                    @endforeach
                </table>
            @endif
        </div>

        <div class="section-title">درخواست‌های من</div>
        <div class="card scb-reveal">
            @if ($requests->count() === 0)
                <div class="empty">هنوز درخواستی ثبت نکرده‌اید.</div>
            @else
                <table>
                    <tr>
                        <th>پلن</th>
                        <th>نوع درخواست</th>
                        <th>وضعیت</th>
                        <th>تاریخ</th>
                    </tr>
                    @foreach ($requests as $req)
                    <tr>
                        <td>{{ $req->plan ?: '—' }}</td>
                        <td>{{ $req->request_type ?: '—' }}</td>
                        <td>
                            @php
                                $statusLabels = ['new' => 'جدید', 'contacted' => 'تماس گرفته شد', 'done' => 'انجام شد', 'ignored' => 'نادیده گرفته شد'];
                                $statusClass = ['new' => 'badge-new', 'contacted' => 'badge-contacted', 'done' => 'badge-done', 'ignored' => 'badge-ignored'];
                            @endphp
                            <span class="badge {{ $statusClass[$req->status] ?? 'badge-new' }}">
                                {{ $statusLabels[$req->status] ?? $req->status }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($req->created_at)->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                </table>
            @endif
        </div>

        <div class="section-title">ثبت درخواست جدید</div>
        <div class="card scb-reveal">
            <form method="POST" action="/panel/request" id="panelRequestForm" novalidate>
                @csrf
                <div id="reqGrid" style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:16px;">
                    <div>
                        <label>نام مجموعه / داروخانه</label>
                        <input type="text" name="organization_name" value="{{ $customer->name }}" required>
                    </div>
                    <div>
                        <label>پلن مورد نظر</label>
                        <select name="plan" id="panelPlan">
                            <option value="Normal">Normal</option>
                            <option value="Ttac">Ttac</option>
                            <option value="TtacPlus">TtacPlus</option>
                        </select>
                    </div>
                    <div>
                        <label>مدت زمان</label>
                        <select name="duration" id="panelDuration">
                            <option value="1">۱ ماهه</option>
                            <option value="3">۳ ماهه</option>
                            <option value="6">۶ ماهه</option>
                            <option value="12">یک‌ساله</option>
                        </select>
                    </div>
                    <div>
                        <label>تعداد سیستم</label>
                        <input type="number" name="devices" id="panelDevices" value="1" min="1" max="50" required>
                    </div>
                    <div>
                        <label>نوع درخواست</label>
                        <select name="request_type">
                            <option value="خرید جدید">خرید جدید</option>
                            <option value="تمدید">تمدید</option>
                            <option value="افزایش دستگاه">افزایش دستگاه</option>
                            <option value="پشتیبانی">پشتیبانی</option>
                        </select>
                    </div>
                </div>

                <label>توضیحات</label>
                <textarea name="description" placeholder="توضیح یا پیام شما..."></textarea>

                <div id="panelPriceBox" style="background:linear-gradient(135deg,#1e3a8a,#2563eb); color:#fff; border-radius:20px; padding:22px 20px; text-align:center; margin:16px 0;">
                    <div style="font-size:13px; opacity:.85; margin-bottom:6px;">قیمت تخمینی</div>
                    <div style="font-size:32px; font-weight:bold;" id="panelPriceAmount">۰ تومان</div>
                    <div style="font-size:12px; opacity:.8; margin-top:6px;" id="panelPriceDetail"></div>
                </div>

                <button type="submit" class="btn">ارسال درخواست</button>
            </form>

            <script>
            (function () {
                const pPrices = @json($pricingData ?? []);
                const pDeviceData = @json($deviceData ?? []);

                function pFormat(n) {
                    return n.toLocaleString('en-US') + ' تومان';
                }

                function updatePanelPrice() {
                    const plan = document.getElementById('panelPlan').value;
                    const duration = parseInt(document.getElementById('panelDuration').value, 10);
                    const devices = parseInt(document.getElementById('panelDevices').value || '1', 10);
                    const amountEl = document.getElementById('panelPriceAmount');
                    const detailEl = document.getElementById('panelPriceDetail');

                    const basePrice = (pPrices[plan] && pPrices[plan][duration]) ? pPrices[plan][duration] : 0;
                    const deviceInfo = pDeviceData[plan] || { base_devices: 1, price_per_extra_device: 0 };
                    const extraDevices = Math.max(0, devices - deviceInfo.base_devices);
                    const extraCost = extraDevices * deviceInfo.price_per_extra_device;
                    const total = basePrice + extraCost;

                    amountEl.textContent = pFormat(total);
                    detailEl.textContent = extraDevices > 0
                        ? ('شامل ' + extraDevices + ' دستگاه اضافه، هر کدام ' + deviceInfo.price_per_extra_device.toLocaleString('en-US') + ' تومان')
                        : '';
                }

                document.getElementById('panelPlan').addEventListener('change', updatePanelPrice);
                document.getElementById('panelDuration').addEventListener('change', updatePanelPrice);
                document.getElementById('panelDevices').addEventListener('input', updatePanelPrice);
                updatePanelPrice();
            })();
            </script>
        </div>

        <div class="section-title" id="support">پشتیبانی</div>
        <div class="card scb-reveal">
            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; margin-bottom:{{ $errors->any() || old('note') ? '16px' : '0' }};">
                <div class="scb-status-filters">
                    <a class="scb-status-pill {{ $supportStatus === 'all' ? 'active' : '' }}" href="/panel?sstatus=all#support">همه</a>
                    <a class="scb-status-pill {{ $supportStatus === 'new' ? 'active' : '' }}" href="/panel?sstatus=new#support">در حال بررسی</a>
                    <a class="scb-status-pill {{ $supportStatus === 'answered' ? 'active' : '' }}" href="/panel?sstatus=answered#support">پاسخ داده‌شده</a>
                    <a class="scb-status-pill {{ $supportStatus === 'closed' ? 'active' : '' }}" href="/panel?sstatus=closed#support">بسته‌شده</a>
                </div>
                <button type="button" id="scbNewTicketBtn" class="btn" style="margin-top:0; {{ $errors->any() || old('note') ? 'display:none;' : '' }}" onclick="document.getElementById('scbNewTicketForm').style.display='block';this.style.display='none';">+ تیکت جدید</button>
            </div>

            <form method="POST" action="/panel/support" enctype="multipart/form-data" id="scbNewTicketForm" style="margin:16px 0 20px; {{ $errors->any() || old('note') ? '' : 'display:none;' }}">
                @csrf
                <label>فایل گزارش تشخیصی (اختیاری — از نرم‌افزار: دکمه‌ی «ساخت گزارش تشخیصی برای پشتیبانی»)</label>
                <input type="file" name="log_file" accept=".txt,.log">
                @if ($licenses->count() > 1)
                <label>مربوط به کدام لایسنس؟</label>
                <select name="license_id">
                    @foreach ($licenses as $lic)
                    <option value="{{ $lic->id }}">{{ $lic->license_key }} ({{ $lic->plan }})</option>
                    @endforeach
                </select>
                @endif
                <label>پیام / توضیح</label>
                <textarea name="note" placeholder="مشکل رو بنویسید... (اگر فایلی آپلود نمی‌کنید، این فیلد را پر کنید)">{{ old('note') }}</textarea>
                <div style="display:flex; gap:8px;">
                    <button type="submit" class="btn">ارسال به پشتیبانی</button>
                    <button type="button" class="btn" style="background:#f1f5f9; color:#334155; box-shadow:none;" onclick="document.getElementById('scbNewTicketForm').style.display='none';document.getElementById('scbNewTicketBtn').style.display='inline-block';">انصراف</button>
                </div>
            </form>

            @if ($supportTickets->count() === 0)
                <div class="empty">هنوز تیکتی در این دسته ثبت نشده.</div>
            @else
                @php
                    $tStatusLabels = ['new' => 'در حال بررسی', 'answered' => 'پاسخ داده شد', 'closed' => 'بسته شد'];
                    $tStatusClass = ['new' => 'badge-new', 'answered' => 'badge-done', 'closed' => 'badge-ignored'];
                @endphp
                @foreach ($supportTickets as $ticket)
                @php
                    $thread = $supportMessages->get($ticket->id, collect());
                    $timeline = collect();
                    if ($ticket->customer_note) {
                        $timeline->push(['sender' => 'customer', 'message' => $ticket->customer_note, 'at' => $ticket->created_at]);
                    }
                    $hasAdminMsg = false;
                    foreach ($thread as $m) {
                        if ($m->sender === 'admin') { $hasAdminMsg = true; }
                        $timeline->push(['sender' => $m->sender, 'message' => $m->message, 'at' => $m->created_at]);
                    }
                    if (!$hasAdminMsg && $ticket->admin_reply) {
                        $timeline->push(['sender' => 'admin', 'message' => $ticket->admin_reply, 'at' => $ticket->replied_at ?? $ticket->created_at]);
                    }
                    $timeline = $timeline->sortBy('at')->values();
                @endphp
                <div class="scb-ticket">
                    <div class="scb-ticket-head" onclick="scbToggleTicket(this)">
                        <div class="scb-ticket-head-info">
                            <span>{{ $ticket->original_filename ?: 'تیکت #' . $ticket->id }}</span>
                            <span style="color:#94a3b8; font-size:12px;">{{ \Carbon\Carbon::parse($ticket->created_at)->format('Y-m-d') }}</span>
                            <span class="badge {{ $tStatusClass[$ticket->status] ?? 'badge-new' }}">{{ $tStatusLabels[$ticket->status] ?? $ticket->status }}</span>
                        </div>
                        <svg class="scb-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </div>
                    <div class="scb-ticket-body">
                        <div class="scb-chat">
                            @forelse ($timeline as $item)
                                <div class="scb-row scb-row-{{ $item['sender'] }}">
                                    <div class="scb-bubble scb-bubble-{{ $item['sender'] }}">
                                        <div>{{ $item['message'] }}</div>
                                        <div class="scb-bubble-time">{{ \Carbon\Carbon::parse($item['at'])->format('m-d H:i') }}</div>
                                    </div>
                                </div>
                            @empty
                                <div class="empty">هنوز پیامی ثبت نشده.</div>
                            @endforelse
                        </div>

                        @if ($ticket->status !== 'closed')
                        <form method="POST" action="/panel/support/{{ $ticket->id }}/reply" class="scb-reply-form">
                            @csrf
                            <textarea name="message" placeholder="پیام خود را برای پشتیبانی بنویسید..." required maxlength="2000"></textarea>
                            <button type="submit" class="scb-send" title="ارسال پیام"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="21" y1="3" x2="10" y2="14"/><polygon points="21 3 14 21 10 14 3 10 21 3"/></svg></button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            @endif
        </div>

    </div>

@include('partials.site-footer')

<div id="copy-note" class="copy-note">کد لایسنس کپی شد</div><script>function copyLicense(t){var n=document.getElementById("copy-note");if(navigator.clipboard&&navigator.clipboard.writeText){navigator.clipboard.writeText(t).then(function(){showN(n);}).catch(function(){fallback(t,n);});}else{fallback(t,n);}}function fallback(t,n){var ta=document.createElement("textarea");ta.value=t;ta.style.position="fixed";ta.style.left="-9999px";document.body.appendChild(ta);ta.focus();ta.select();try{document.execCommand("copy");}catch(e){}document.body.removeChild(ta);showN(n);}function showN(n){n.style.display="block";setTimeout(function(){n.style.display="none";},1800);}</script>
<script>
document.querySelectorAll('.scb-chat').forEach(function(box){box.scrollTop=box.scrollHeight;});
document.querySelectorAll('.scb-reply-form textarea').forEach(function(ta){
ta.addEventListener('keydown',function(e){
if(e.key==='Enter'&&!e.shiftKey){e.preventDefault();ta.closest('form').submit();}
});
});
function scbToggleTicket(head){
var body=head.nextElementSibling;
if(!body)return;
var chevron=head.querySelector('.scb-chevron');
var willOpen=!body.classList.contains('open');
body.classList.toggle('open');
if(chevron){chevron.style.transform=willOpen?'rotate(180deg)':'';}
if(willOpen){
var chat=body.querySelector('.scb-chat');
if(chat){setTimeout(function(){chat.scrollTop=chat.scrollHeight;},320);}
}
}
</script>
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
<script>
(function () {
    var form = document.getElementById('panelRequestForm');
    if (!form) { return; }
    form.addEventListener('submit', function (e) {
        var requiredFields = [
            { id: 'orgName', name: 'organization_name', label: 'نام مجموعه / داروخانه' },
            { id: 'panelDevices', name: 'devices', label: 'تعداد سیستم' },
        ];
        var missing = [];
        var firstInvalid = null;

        var orgInput = form.querySelector('[name="organization_name"]');
        var devicesInput = document.getElementById('panelDevices');

        [orgInput, devicesInput].forEach(function (el, idx) {
            el.style.border = '';
            if (!el.value || !el.value.toString().trim()) {
                el.style.border = '2px solid #dc2626';
                missing.push(requiredFields[idx].label);
                if (!firstInvalid) { firstInvalid = el; }
            }
        });

        if (missing.length > 0) {
            e.preventDefault();
            document.getElementById('scbModalList').textContent = missing.join('، ');
            document.getElementById('scbModalOverlay').style.display = 'flex';
            if (firstInvalid) { firstInvalid.focus(); }
        }
    });
})();
</script>
</body>
</html>
