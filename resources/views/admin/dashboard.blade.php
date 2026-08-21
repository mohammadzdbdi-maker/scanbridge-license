<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>مدیریت لایسنس Scanbridge</title>
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
            background: #f3f4f6;
            color: #111827;
        }
        header {
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: white;
            padding: 22px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        header h1 {
            margin: 0;
            font-size: 24px;
        }
        header small {
            display: block;
            opacity: .85;
            margin-top: 5px;
        }
        .logout {
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.35);
            color: white;
            border-radius: 12px;
            height: 46px;
            min-width: 118px;
            padding: 0 18px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: 'Pinar', Tahoma, Arial, sans-serif;
            font-size: 14px;
            font-weight: bold;
            line-height: 1;
            text-decoration: none;
        }
        main {
            padding: 24px;
            max-width: 1580px;
            margin: 0 auto;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 20px;
        }
        .stat {
            background: white;
            border-radius: 18px;
            padding: 16px;
            box-shadow: 0 10px 35px rgba(15,23,42,.06);
            border: 1px solid #e5e7eb;
        }
        .stat .num {
            font-size: 24px;
            font-weight: bold;
            color: #1e3a8a;
        }
        .stat .label {
            color: #6b7280;
            margin-top: 4px;
            font-size: 13px;
        }
        .alert-ok {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 13px 16px;
            border-radius: 16px;
            margin-bottom: 18px;
            direction: ltr;
            text-align: left;
            font-weight: bold;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 13px 16px;
            border-radius: 16px;
            margin-bottom: 18px;
        }
        .card {
            background: white;
            border-radius: 22px;
            box-shadow: 0 10px 35px rgba(15,23,42,.08);
            padding: 20px;
            margin-bottom: 22px;
        }
        .card h2 {
            margin: 0 0 16px;
            color: #1e3a8a;
            font-size: 20px;
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 12px;
        }
        label {
            display: block;
            font-size: 12px;
            color: #4b5563;
            margin-bottom: 6px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            height: 42px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            padding: 0 11px;
            font-size: 14px;
            background: white;
        }
        .btn {
            border: 0;
            border-radius: 12px;
            padding: 10px 14px;
            font-weight: bold;
            cursor: pointer;
            color: white;
            min-height: 40px;
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }
        .btn-create { background: #16a34a; width: 100%; margin-top: 22px; }
        .btn-blue { background: #2563eb; }
        .btn-red { background: #dc2626; }
        .btn-orange { background: #f59e0b; color: #111827; }
        .btn-gray { background: #6b7280; }
        .btn-purple { background: #7c3aed; }
        .btn-copy { background: #0891b2; }
        .btn-search { background: #1d4ed8; }
        .search-row {
            display: grid;
            grid-template-columns: 1fr 140px 120px;
            gap: 10px;
            align-items: end;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }
        th {
            text-align: right;
            color: #6b7280;
            font-size: 12px;
            padding: 0 10px;
        }
        td {
            background: #ffffff;
            border-top: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
            padding: 12px 10px;
            vertical-align: top;
            font-size: 13px;
        }
        tr.expired-row td {
            background: #fff7ed;
            border-color: #fed7aa;
        }
        tr.disabled-row td {
            background: #f9fafb;
            opacity: .86;
        }
        td:first-child {
            border-right: 1px solid #e5e7eb;
            border-radius: 0 16px 16px 0;
        }
        td:last-child {
            border-left: 1px solid #e5e7eb;
            border-radius: 16px 0 0 16px;
        }
        .license-box {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 8px;
            align-items: center;
            min-width: 330px;
        }
        .license-key {
            direction: ltr;
            text-align: left;
            font-family: Consolas, monospace;
            background: #f9fafb;
            border: 1px dashed #cbd5e1;
            padding: 8px;
            border-radius: 10px;
            white-space: nowrap;
            overflow: auto;
        }
        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }
        .active { background: #dcfce7; color: #166534; }
        .disabled { background: #fee2e2; color: #991b1b; }
        .expired { background: #ffedd5; color: #9a3412; }
        .plan { background: #dbeafe; color: #1e40af; }
        .actions {
            display: grid;
            grid-template-columns: 1fr;
            gap: 8px;
            min-width: 210px;
        }
        .inline-form {
            display: flex;
            gap: 6px;
            align-items: center;
        }
        .inline-form input {
            height: 38px;
            width: 80px;
        }
        .inline-form select {
            height: 38px;
            flex: 1;
        }
        .inline-form button {
            flex: 1;
        }
        details {
            margin-top: 10px;
        }
        summary {
            cursor: pointer;
            color: #2563eb;
            font-weight: bold;
        }
        .activation {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 8px;
            margin-top: 6px;
            direction: ltr;
            text-align: left;
            font-size: 12px;
        }
        .copy-note {
            position: fixed;
            left: 24px;
            bottom: 24px;
            background: #111827;
            color: white;
            padding: 12px 18px;
            border-radius: 14px;
            box-shadow: 0 15px 40px rgba(0,0,0,.25);
            display: none;
            z-index: 9999;
        }
        @media (max-width: 1200px) {
            .form-grid { grid-template-columns: repeat(2, 1fr); }
            .stats { grid-template-columns: repeat(2, 1fr); }
            .search-row { grid-template-columns: 1fr; }
            table { font-size: 12px; }
        }
    
/* SCANBRIDGE_ADMIN_FONT_BUTTON_FIX_START */
@font-face {
    font-family: 'Pinar';
    src: url('/fonts/Pinar-DS1-FD-Regular.woff2') format('woff2');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}

/* اعمال فونت روی همه اجزای پنل */
html,
body,
button,
input,
select,
textarea,
a,
table,
th,
td,
label,
span,
div,
h1,
h2,
h3,
small,
strong {
    font-family: 'Pinar', Tahoma, Arial, sans-serif !important;
}

/* کدهای لایسنس باید لاتین و خوانا بمانند */
.license-key {
    font-family: Consolas, 'Courier New', monospace !important;
    direction: ltr !important;
    text-align: left !important;
}

/* یکدست‌سازی دکمه‌ها */
.btn,
button,
.logout {
    height: 42px !important;
    min-height: 42px !important;
    border-radius: 12px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    line-height: 1 !important;
    white-space: nowrap !important;
    font-size: 13px !important;
    font-weight: bold !important;
    padding: 0 14px !important;
}

/* دکمه‌های بالای پنل: تغییر رمز / خروج */
header .logout,
.logout {
    height: 46px !important;
    min-width: 118px !important;
    padding: 0 18px !important;
}

/* دکمه‌های سرچ هم‌اندازه */
.search-row {
    display: grid !important;
    grid-template-columns: minmax(0, 1fr) 140px 120px !important;
    gap: 10px !important;
    align-items: end !important;
}

.search-row .btn,
.search-row button,
.search-row a {
    width: 100% !important;
    height: 44px !important;
    min-height: 44px !important;
}

/* فرم ساخت لایسنس */
.btn-create {
    width: 100% !important;
    height: 44px !important;
    min-height: 44px !important;
    margin-top: 22px !important;
}

/* دکمه‌های عملیات داخل جدول‌ها */
.actions {
    display: grid !important;
    grid-template-columns: 1fr !important;
    gap: 8px !important;
    min-width: 170px !important;
}

.actions form {
    margin: 0 !important;
}

.actions .btn,
.actions button {
    width: 100% !important;
    min-width: 150px !important;
    height: 40px !important;
    min-height: 40px !important;
    padding: 0 12px !important;
    font-size: 13px !important;
}

/* فرم‌های کوچک تمدید/تعداد/تغییر پلن */
.inline-form {
    display: grid !important;
    grid-template-columns: 76px 1fr !important;
    gap: 6px !important;
    align-items: center !important;
}

.inline-form input,
.inline-form select {
    height: 38px !important;
    min-height: 38px !important;
}

.inline-form button {
    height: 38px !important;
    min-height: 38px !important;
    width: 100% !important;
}

/* بخش درخواست‌های خرید و تمدید */
#purchase-requests table {
    table-layout: auto !important;
}

#purchase-requests th,
#purchase-requests td {
    font-size: 13px !important;
    vertical-align: middle !important;
}

#purchase-requests .actions {
    min-width: 160px !important;
}

#purchase-requests .license-box {
    min-width: 300px !important;
    display: grid !important;
    grid-template-columns: 1fr 70px !important;
    gap: 8px !important;
    align-items: center !important;
}

#purchase-requests .license-box .btn-copy {
    width: 70px !important;
    min-width: 70px !important;
    height: 38px !important;
}

/* کادرهای فرم */
input,
select,
textarea {
    font-size: 14px !important;
    height: 42px !important;
    min-height: 42px !important;
}

textarea {
    height: auto !important;
}

/* badges */
.badge {
    font-family: 'Pinar', Tahoma, Arial, sans-serif !important;
    line-height: 1.4 !important;
}

/* حالت موبایل */
@media (max-width: 1200px) {
    .search-row {
        grid-template-columns: 1fr !important;
    }

    .actions {
        min-width: 140px !important;
    }

    #purchase-requests .license-box {
        min-width: 240px !important;
        grid-template-columns: 1fr !important;
    }

    #purchase-requests .license-box .btn-copy {
        width: 100% !important;
    }
}
/* SCANBRIDGE_ADMIN_FONT_BUTTON_FIX_END */


/* SCANBRIDGE_PLAN_SELECT_FIX_START */

/* فرم تغییر پلن باید دو ردیفه باشد تا نام پلن کامل دیده شود */
.actions form.inline-form:has(select[name="plan"]) {
    display: grid !important;
    grid-template-columns: 1fr !important;
    gap: 6px !important;
}

.actions form.inline-form:has(select[name="plan"]) select {
    width: 100% !important;
    min-width: 150px !important;
    height: 40px !important;
    direction: ltr !important;
    text-align: left !important;
    padding: 0 10px !important;
}

.actions form.inline-form:has(select[name="plan"]) button {
    width: 100% !important;
    min-width: 150px !important;
    height: 40px !important;
}

/* اگر مرورگر :has را کامل اعمال نکرد، این کلاس عمومی هم کمک می‌کند */
select[name="plan"] {
    min-width: 150px !important;
    width: 100% !important;
    direction: ltr !important;
    text-align: left !important;
}

/* در فرم‌های عملیات، ستون دوم کمتر از حد لازم نشود */
.inline-form {
    grid-template-columns: 76px minmax(150px, 1fr) !important;
}

/* SCANBRIDGE_PLAN_SELECT_FIX_END */


/* SCANBRIDGE_REQUEST_FILTER_START */
.request-filter-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin: 0 0 16px;
}

.request-filter {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 38px;
    min-width: 92px;
    padding: 0 14px;
    border-radius: 999px;
    border: 1px solid #dbeafe;
    background: #eff6ff;
    color: #1e40af;
    text-decoration: none;
    font-weight: bold;
    font-size: 13px;
}

.request-filter.active {
    background: #2563eb;
    color: white;
    border-color: #2563eb;
}
/* SCANBRIDGE_REQUEST_FILTER_END */


/* SCANBRIDGE_LICENSE_FILTER_START */
.license-filter-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin: 0 0 16px;
}

.license-filter {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 38px;
    min-width: 88px;
    padding: 0 14px;
    border-radius: 999px;
    border: 1px solid #dbeafe;
    background: #eff6ff;
    color: #1e40af;
    text-decoration: none;
    font-weight: bold;
    font-size: 13px;
}

.license-filter.active {
    background: #2563eb;
    color: white;
    border-color: #2563eb;
}
/* SCANBRIDGE_LICENSE_FILTER_END */


/* SCANBRIDGE_EXPORT_BUTTONS_START */
.export-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.export-buttons .btn {
    min-width: 180px !important;
    height: 44px !important;
}
/* SCANBRIDGE_EXPORT_BUTTONS_END */


/* SCANBRIDGE_UPLOAD_INSTALLER_START_CSS */
.upload-installer-form {
    display: grid;
    grid-template-columns: 1fr 190px 190px;
    gap: 10px;
    align-items: center;
}

.upload-installer-form input[type="file"] {
    height: 44px !important;
    padding: 9px 12px !important;
    border: 1px solid #d1d5db;
    border-radius: 12px;
    background: #f9fafb;
}

.upload-installer-form .btn {
    width: 100% !important;
    height: 44px !important;
}

@media (max-width: 900px) {
    .upload-installer-form {
        grid-template-columns: 1fr;
    }
}
/* SCANBRIDGE_UPLOAD_INSTALLER_END_CSS */

/* SCANBRIDGE_UPLOAD_PROGRESS_CSS_START */
.upload-progress {
    display: none;
    margin-top: 12px;
}
.upload-progress-bar-bg {
    background: #e5e7eb;
    border-radius: 999px;
    height: 16px;
    overflow: hidden;
}
.upload-progress-bar-fill {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    height: 100%;
    width: 0%;
    transition: width .2s ease;
}
.upload-progress-text {
    margin-top: 6px;
    font-size: 13px;
    color: #374151;
    text-align: center;
    font-weight: bold;
}
/* SCANBRIDGE_UPLOAD_PROGRESS_CSS_END */

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

<style>/*SCB_ADMIN_BEAUTY*/
/* پس‌زمینه روشن و ملایم */
body{background:linear-gradient(135deg,#eef2f7 0%,#e3ecfa 55%,#dbeafe 130%)!important;background-attachment:fixed!important;color:#0f172a!important;font-family:'Pinar',Tahoma,Arial,sans-serif!important;}
/* هدر */
header{background:linear-gradient(135deg,#1e3a8a,#2563eb)!important;box-shadow:0 8px 25px rgba(30,58,138,.35)!important;border-radius:0 0 20px 20px!important;}
header h1{color:#fff!important;font-size:22px!important;}
header small{color:#dbeafe!important;}
/* دکمه‌های هدر */
header .logout{background:rgba(255,255,255,.18)!important;border:1px solid rgba(255,255,255,.45)!important;color:#fff!important;border-radius:12px!important;font-weight:bold!important;}
header .logout:hover{background:rgba(255,255,255,.3)!important;}
/* کارت‌ها */
.card{background:#ffffff!important;border:1px solid #e5e7eb!important;border-radius:20px!important;box-shadow:0 10px 30px rgba(15,23,42,.08)!important;padding:22px!important;margin-bottom:20px!important;}
.card h2{color:#1e3a8a!important;font-size:18px!important;margin-bottom:14px!important;}
/* آمار */
.stats{display:grid!important;grid-template-columns:repeat(auto-fit,minmax(200px,1fr))!important;gap:14px!important;margin-bottom:20px!important;}
.stat{background:#fff!important;border:1px solid #e5e7eb!important;border-radius:18px!important;box-shadow:0 8px 24px rgba(15,23,42,.08)!important;padding:18px 20px!important;display:flex!important;align-items:center!important;gap:14px!important;}
.stat .num{font-size:28px!important;font-weight:800!important;color:#1e3a8a!important;line-height:1.2!important;}
.stat .label{font-size:13px!important;color:#475569!important;font-weight:bold!important;}
.stat::before{content:''!important;width:44px!important;height:44px!important;flex-shrink:0!important;background-size:contain!important;background-repeat:no-repeat!important;background-position:center!important;}
.stat:nth-child(1)::before{background-image:url('/icons/stat-total.png')!important;}
.stat:nth-child(2)::before{background-image:url('/icons/stat-active.png')!important;}
.stat:nth-child(3)::before{background-image:url('/icons/stat-disabled.png')!important;}
.stat:nth-child(4)::before{background-image:url('/icons/stat-expired.png')!important;}
/* فرم‌ها */
label{color:#334155!important;font-weight:bold!important;}
input,select,textarea{background:#fff!important;border:1.5px solid #cbd5e1!important;color:#0f172a!important;border-radius:12px!important;font-family:'Pinar',Tahoma,Arial,sans-serif!important;}
input:focus,select:focus,textarea:focus{border-color:#2563eb!important;box-shadow:0 0 0 4px rgba(37,99,235,.15)!important;outline:none!important;}
select option{background:#fff!important;color:#0f172a!important;}
/* جدول‌ها */
table{border-collapse:separate!important;border-spacing:0 8px!important;}
th{color:#475569!important;font-size:13px!important;font-weight:bold!important;padding:6px 12px!important;}
td{background:#f8fafc!important;border:1px solid #eef2f7!important;border-radius:12px!important;color:#1e293b!important;font-size:13px!important;padding:12px!important;vertical-align:middle!important;}
tbody tr:hover td{background:#eff6ff!important;}
td strong{color:#0f172a!important;}
tr.expired-row td{background:#fff7ed!important;border-color:#fed7aa!important;}
tr.disabled-row td{background:#f9fafb!important;opacity:.85!important;}
/* کد لایسنس */
.license-key{background:#fff!important;border:1px dashed #94a3b8!important;color:#0f172a!important;border-radius:8px!important;font-family:Consolas,monospace!important;}
/* بج‌ها - کنتراست درست */
.badge{border-radius:999px!important;font-weight:bold!important;padding:5px 12px!important;font-size:12px!important;}
.badge.active{background:#dcfce7!important;color:#166534!important;}
.badge.disabled{background:#fee2e2!important;color:#991b1b!important;}
.badge.expired{background:#ffedd5!important;color:#9a3412!important;}
.badge.plan{background:#ede9fe!important;color:#5b21b6!important;}
/* دکمه‌ها - متن سفید روی رنگ */
.btn{border-radius:12px!important;font-weight:bold!important;color:#fff!important;box-shadow:0 4px 14px rgba(15,23,42,.15)!important;font-family:'Pinar',Tahoma,Arial,sans-serif!important;}
.btn:hover{filter:brightness(1.08)!important;transform:translateY(-1px)!important;}
.btn-gray{background:#6b7280!important;color:#fff!important;}
.btn-orange{background:#d97706!important;color:#fff!important;}
.btn-red{background:#dc2626!important;color:#fff!important;}
.btn-blue,.btn-search{background:#2563eb!important;color:#fff!important;}
.btn-purple{background:#7c3aed!important;color:#fff!important;}
.btn-copy{background:#0891b2!important;color:#fff!important;}
.btn-green,.btn-create{background:#16a34a!important;color:#fff!important;}
/* فیلترها */
.request-filter,.license-filter{background:#eff6ff!important;border:1px solid #bfdbfe!important;color:#1e40af!important;border-radius:999px!important;font-weight:bold!important;padding:6px 14px!important;}
.request-filter.active,.license-filter.active{background:#2563eb!important;color:#fff!important;border-color:#2563eb!important;}
/* آلرت‌ها */
.alert-ok{background:#dcfce7!important;color:#166534!important;border:1px solid #bbf7d0!important;border-radius:14px!important;font-weight:bold!important;}
.alert-error{background:#fee2e2!important;color:#991b1b!important;border:1px solid #fecaca!important;border-radius:14px!important;font-weight:bold!important;}
/* جزئیات دستگاه */
.activation{background:#fff!important;border:1px solid #e2e8f0!important;color:#334155!important;border-radius:10px!important;}
details summary{color:#1d4ed8!important;font-weight:bold!important;}
/* لینک‌ها */
a{color:#1d4ed8!important;}
/* فرم‌های داخل اکشن */
.inline-form input,.inline-form select{height:38px!important;}
</style>



<style>/*SCB_ADMIN_VIVID*/
.btn{position:relative;border:none!important;transition:all .2s!important;}
.btn:hover{transform:translateY(-1px)!important;filter:brightness(1.06)!important;}
.btn:active{transform:translateY(0)!important;}
/* گرادیان‌های رنگی */
.btn-blue,.btn-search{background:linear-gradient(135deg,#3b82f6,#2563eb)!important;box-shadow:0 4px 14px rgba(37,99,235,.35)!important;color:#fff!important;}
.btn-red{background:linear-gradient(135deg,#f87171,#dc2626)!important;box-shadow:0 4px 14px rgba(220,38,38,.3)!important;color:#fff!important;}
.btn-green,.btn-create{background:linear-gradient(135deg,#4ade80,#16a34a)!important;box-shadow:0 4px 14px rgba(22,163,74,.3)!important;color:#fff!important;}
.btn-orange{background:linear-gradient(135deg,#fb923c,#ea580c)!important;box-shadow:0 4px 14px rgba(234,88,12,.3)!important;color:#fff!important;}
.btn-purple{background:linear-gradient(135deg,#a78bfa,#7c3aed)!important;box-shadow:0 4px 14px rgba(124,58,237,.3)!important;color:#fff!important;}
.btn-gray{background:linear-gradient(135deg,#94a3b8,#64748b)!important;box-shadow:0 4px 14px rgba(100,116,139,.25)!important;color:#fff!important;}
.btn-copy{background:linear-gradient(135deg,#22d3ee,#0891b2)!important;box-shadow:0 4px 14px rgba(8,145,178,.3)!important;color:#fff!important;}
/* بج‌های زنده */
.badge.active{background:linear-gradient(135deg,#bbf7d0,#86efac)!important;color:#14532d!important;}
.badge.disabled{background:linear-gradient(135deg,#fecaca,#fca5a5)!important;color:#7f1d1d!important;}
.badge.expired{background:linear-gradient(135deg,#fed7aa,#fdba74)!important;color:#7c2d12!important;}
.badge.plan{background:linear-gradient(135deg,#ddd6fe,#c4b5fd)!important;color:#4c1d95!important;}
/* فیلتر فعال */
.request-filter.active,.license-filter.active{background:linear-gradient(135deg,#3b82f6,#2563eb)!important;border-color:#2563eb!important;color:#fff!important;box-shadow:0 4px 12px rgba(37,99,235,.3)!important;}
/* هدر */
header{background:linear-gradient(135deg,#1e3a8a,#2563eb,#3b82f6)!important;box-shadow:0 8px 25px rgba(30,58,138,.4)!important;}
/* آمار */
.stat{background:#fff!important;border:1px solid #e2e8f0!important;box-shadow:0 8px 20px rgba(15,23,42,.07)!important;}
/* لینک‌ها */
a{color:#1d4ed8!important;}
</style>

<style>/*SCB_ADMIN_TABS*/
.scb-admin-tabs { display:flex; gap:10px; margin-bottom:20px; flex-wrap:wrap; }
.scb-admin-tab-btn {
    display:inline-flex; align-items:center; gap:8px;
    padding:12px 22px; border-radius:14px; font-size:14.5px; font-weight:bold;
    background:#fff; color:#334155; border:1px solid #e5e7eb; cursor:pointer;
    font-family:'Pinar',Tahoma,Arial,sans-serif;
    box-shadow:0 4px 14px rgba(15,23,42,.05);
    transition:all .15s;
}
.scb-admin-tab-btn:hover { border-color:#bfdbfe; }
.scb-admin-tab-btn.active {
    background:linear-gradient(135deg,#1e3a8a,#2563eb);
    color:#fff; border-color:transparent;
    box-shadow:0 8px 22px rgba(30,58,138,.28);
}
.scb-admin-tab-btn .cnt {
    background:#fee2e2; color:#dc2626; border-radius:999px;
    padding:2px 9px; font-size:12px; font-weight:bold;
}
.scb-admin-tab-btn.active .cnt { background:rgba(255,255,255,.25); color:#fff; }
.scb-tab-panel { display:none; }
.scb-tab-panel.active { display:block; }
@media (max-width: 700px) {
    .scb-admin-tabs { gap:8px; }
    .scb-admin-tab-btn { flex:1 1 auto; justify-content:center; padding:11px 12px; font-size:13px; }
}
</style>
</head>
<body>
<header>
    <div>
        <h1>پنل مدیریت لایسنس Scanbridge</h1>
        <small>ساخت، تمدید، تغییر پلن، کپی کد، جستجو و ریست دستگاه‌ها</small>
    </div>
    <div style="display:flex; gap:10px; align-items:center;">
        <a href="/admin/password" class="logout" style="text-decoration:none;">تغییر رمز</a>
        <form method="post" action="/admin/logout" style="margin:0;">
            @csrf
            <button class="logout" type="submit">خروج</button>
        </form>
    </div>
</header>

<main>
    @if(session('ok'))
        <div class="alert-ok">{{ session('ok') }}</div>
    @endif

    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <section class="stats">
        <div class="stat">
            <div class="num">{{ $totalLicenses }}</div>
            <div class="label">کل لایسنس‌ها</div>
        </div>
        <div class="stat">
            <div class="num">{{ $activeLicenses }}</div>
            <div class="label">فعال</div>
        </div>
        <div class="stat">
            <div class="num">{{ $disabledLicenses }}</div>
            <div class="label">غیرفعال</div>
        </div>
        <div class="stat">
            <div class="num">{{ $expiredLicenses }}</div>
            <div class="label">منقضی‌شده</div>
        </div>
    </section>

    <div class="scb-admin-tabs" id="scbAdminTabs">
        <button type="button" class="scb-admin-tab-btn" data-tab="licenses" onclick="scbAdminShowTab('licenses')">لایسنس‌ها</button>
        <button type="button" class="scb-admin-tab-btn" data-tab="requests" onclick="scbAdminShowTab('requests')">
            درخواست‌های خرید و تمدید
            @if(($newPurchaseRequests ?? 0) > 0)<span class="cnt">{{ $newPurchaseRequests }}</span>@endif
        </button>
        <button type="button" class="scb-admin-tab-btn" data-tab="settings" onclick="scbAdminShowTab('settings')">بروزرسانی و تنظیمات</button>
    </div>

    <div class="scb-tab-panel" data-tab="settings">
<!-- SCANBRIDGE_PURCHASE_REQUESTS_PANEL_START -->


<!-- SCANBRIDGE_UPLOAD_INSTALLER_START -->
<section class="card">
    <h2>آپلود نسخه جدید Scanbridge</h2>

    <p style="color:#6b7280; margin-top:0;">
        فایل نصب جدید را انتخاب کنید. بعد از آپلود، لینک دانلود سایت به‌صورت خودکار به همین فایل جدید وصل می‌شود.
    </p>

    <form method="post" action="/admin/upload-installer" enctype="multipart/form-data" class="upload-installer-form" id="installer-form">
        @csrf

        <input type="file" name="installer" accept=".exe" required>

        <button class="btn btn-blue" type="submit">آپلود فایل نصب جدید</button>

        <a class="btn" style="background:#16a34a;" href="/latest">تست دانلود آخرین نسخه</a>
    </form>
    <div class="upload-progress" id="progress-installer">
        <div class="upload-progress-bar-bg"><div class="upload-progress-bar-fill" id="progress-installer-fill"></div></div>
        <div class="upload-progress-text" id="progress-installer-text">0%</div>
    </div>
</section>
<!-- SCANBRIDGE_UPLOAD_INSTALLER_END -->

<!-- SCANBRIDGE_UPLOAD_INSTALLER_ANDROID_START -->
<section class="card">
    <h2>آپلود نسخه جدید اندروید Scanbridge</h2>

    <p style="color:#6b7280; margin-top:0;">
        فایل APK جدید را انتخاب کنید. بعد از آپلود، لینک دانلود اندروید در سایت به‌صورت خودکار به همین فایل جدید وصل می‌شود.
    </p>

    <form method="post" action="/admin/upload-installer-android" enctype="multipart/form-data" class="upload-installer-form" id="installer-android-form">
        @csrf

        <input type="file" name="installer_android" accept=".apk" required>

        <button class="btn btn-blue" type="submit">آپلود فایل APK جدید</button>

        <a class="btn" style="background:#16a34a;" href="/latest-android">تست دانلود آخرین نسخه</a>
    </form>
    <div class="upload-progress" id="progress-installer-android">
        <div class="upload-progress-bar-bg"><div class="upload-progress-bar-fill" id="progress-installer-android-fill"></div></div>
        <div class="upload-progress-text" id="progress-installer-android-text">0%</div>
    </div>
</section>
<!-- SCANBRIDGE_UPLOAD_INSTALLER_ANDROID_END -->

<section class="card">
    <h2>خروجی گزارش‌ها</h2>
    <div class="export-buttons">
        <a class="btn btn-blue" href="/admin/export/licenses.xlsx">خروجی لایسنس‌ها Excel</a>
        <a class="btn" style="background:#16a34a;" href="/admin/export/requests.xlsx">خروجی درخواست‌ها Excel</a>
        <a class="btn btn-gray" href="/admin/export/logs.xlsx">خروجی لاگ‌ها Excel</a>
    </div>
</section>

<section class="card">
    <h2>مدیریت قیمت‌ها</h2>
    <p style="color:#6b7280; margin-top:0;">
        قیمت‌ها به تومان وارد کنید. عدد صفر یعنی رایگان یا هنوز قیمت‌گذاری نشده.
    </p>

    <form method="post" action="/admin/prices">
        @csrf

        @php
            $planLabels = ['Normal' => 'Normal', 'Ttac' => 'Ttac', 'TtacPlus' => 'TtacPlus'];
            $durationLabels = [1 => '۱ ماهه', 3 => '۳ ماهه', 6 => '۶ ماهه', 12 => 'یک‌ساله'];
        @endphp

        <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; margin-bottom:24px;">
            <tr>
                <th style="text-align:right; padding:10px; border-bottom:2px solid #e5e7eb;">پلن</th>
                @foreach ($durationLabels as $months => $label)
                    <th style="text-align:right; padding:10px; border-bottom:2px solid #e5e7eb;">{{ $label }}</th>
                @endforeach
            </tr>
            @foreach ($planLabels as $planKey => $planLabel)
            <tr>
                <td style="padding:10px; font-weight:bold; border-bottom:1px solid #f1f5f9;">{{ $planLabel }}</td>
                @foreach ($durationLabels as $months => $label)
                <td style="padding:10px; border-bottom:1px solid #f1f5f9;">
                    <div style="position:relative;">
                        <input
                            type="text"
                            inputmode="numeric"
                            class="scb-price-input"
                            name="price_{{ $planKey }}_{{ $months }}"
                            value="{{ number_format($prices[$planKey][$months] ?? 0) }}"
                            style="width:150px; padding:8px 55px 8px 10px; border-radius:10px; border:1px solid #e2e8f0; font-family:inherit; text-align:left; direction:ltr;"
                        >
                        <span style="position:absolute; left:10px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:12px; pointer-events:none;">تومان</span>
                    </div>
                </td>
                @endforeach
            </tr>
            @endforeach
        </table>
        </div>

        <h3 style="margin-bottom:10px;">قیمت هر دستگاه اضافه</h3>
        <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; margin-bottom:20px;">
            <tr>
                <th style="text-align:right; padding:10px; border-bottom:2px solid #e5e7eb;">پلن</th>
                <th style="text-align:right; padding:10px; border-bottom:2px solid #e5e7eb;">تعداد دستگاه پایه (رایگان)</th>
                <th style="text-align:right; padding:10px; border-bottom:2px solid #e5e7eb;">قیمت هر دستگاه اضافه (تومان)</th>
            </tr>
            @foreach ($planLabels as $planKey => $planLabel)
            <tr>
                <td style="padding:10px; font-weight:bold; border-bottom:1px solid #f1f5f9;">{{ $planLabel }}</td>
                <td style="padding:10px; border-bottom:1px solid #f1f5f9;">
                    <input
                        type="number"
                        min="1"
                        name="base_devices_{{ $planKey }}"
                        value="{{ $devicePricing[$planKey]->base_devices ?? 1 }}"
                        style="width:100px; padding:8px 10px; border-radius:10px; border:1px solid #e2e8f0; font-family:inherit;"
                    >
                </td>
                <td style="padding:10px; border-bottom:1px solid #f1f5f9;">
                    <div style="position:relative;">
                        <input
                            type="text"
                            inputmode="numeric"
                            class="scb-price-input"
                            name="extra_device_{{ $planKey }}"
                            value="{{ number_format($devicePricing[$planKey]->price_per_extra_device ?? 0) }}"
                            style="width:150px; padding:8px 55px 8px 10px; border-radius:10px; border:1px solid #e2e8f0; font-family:inherit; text-align:left; direction:ltr;"
                        >
                        <span style="position:absolute; left:10px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:12px; pointer-events:none;">تومان</span>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
        </div>

        <button class="btn btn-blue" type="submit">ذخیره قیمت‌ها</button>
    </form>

    <script>
    (function () {
        function formatNumber(val) {
            var digits = val.replace(/[^0-9]/g, '');
            if (!digits) { return ''; }
            return parseInt(digits, 10).toLocaleString('en-US');
        }
        document.querySelectorAll('.scb-price-input').forEach(function (input) {
            input.addEventListener('input', function () {
                var cursorFromEnd = input.value.length - input.selectionStart;
                input.value = formatNumber(input.value);
                var pos = input.value.length - cursorFromEnd;
                input.setSelectionRange(pos, pos);
            });
        });
        var priceForm = document.querySelector('form[action="/admin/prices"]');
        if (priceForm) {
            priceForm.addEventListener('submit', function () {
                document.querySelectorAll('.scb-price-input').forEach(function (input) {
                    input.value = input.value.replace(/,/g, '');
                });
            });
        }
    })();
    </script>
</section>
    </div>

    <div class="scb-tab-panel" data-tab="requests">
<section class="card" id="purchase-requests">
    <h2>درخواست‌های خرید و تمدید</h2>

    <div style="margin-bottom:14px; color:#6b7280;">
        درخواست‌های جدید:
        <strong style="color:#dc2626;">{{ $newPurchaseRequests ?? 0 }}</strong>
    </div>

    <div class="request-filter-bar">
        <a class="request-filter {{ ($requestStatus ?? 'all') === 'all' ? 'active' : '' }}" href="/admin#purchase-requests">همه</a>
        <a class="request-filter {{ ($requestStatus ?? 'all') === 'new' ? 'active' : '' }}" href="/admin?request_status=new#purchase-requests">جدید</a>
        <a class="request-filter {{ ($requestStatus ?? 'all') === 'contacted' ? 'active' : '' }}" href="/admin?request_status=contacted#purchase-requests">تماس گرفته شد</a>
        <a class="request-filter {{ ($requestStatus ?? 'all') === 'done' ? 'active' : '' }}" href="/admin?request_status=done#purchase-requests">انجام شد</a>
        <a class="request-filter {{ ($requestStatus ?? 'all') === 'ignored' ? 'active' : '' }}" href="/admin?request_status=ignored#purchase-requests">نادیده</a>
    </div>

    <table>
        <thead>
        <tr>
            <th>زمان</th>
            <th>نام مجموعه</th>
            <th>مسئول / موبایل</th>
            <th>درخواست</th>
            <th>لایسنس صادرشده</th>
            <th>توضیحات</th>
            <th>وضعیت</th>
            <th>عملیات</th>
        </tr>
        </thead>
        <tbody>
        @forelse(($purchaseRequests ?? collect()) as $req)
            <tr>
                <td>{{ $req->created_at }}</td>

                <td>{{ $req->organization_name ?: '-' }}</td>

                <td>
                    {{ $req->contact_name ?: '-' }}
                    <br>
                    <span style="direction:ltr; display:inline-block;">{{ $req->mobile ?: '-' }}</span>
                </td>

                <td>
                    {{ $req->request_type ?: '-' }}
                    <br>
                    <span class="badge plan">{{ $req->plan ?: '-' }}</span>
                    <br>
                    تعداد سیستم: {{ $req->devices }}
                </td>

                <td>
                    @if(!empty($req->license_key))
                        <div class="license-box" style="min-width:280px;">
                            <div class="license-key" style="font-size:12px;">{{ $req->license_key }}</div>
                            <button type="button" class="btn btn-copy" onclick="copyLicense('{{ $req->license_key }}')">کپی</button>
                        </div>
                    @else
                        <span style="color:#9ca3af;">هنوز صادر نشده</span>
                    @endif
                </td>

                <td style="max-width:260px; white-space:normal;">{{ $req->description ?: '-' }}</td>

                <td>
                    @if($req->status === 'new')
                        <span class="badge expired">جدید</span>
                    @elseif($req->status === 'contacted')
                        <span class="badge plan">تماس گرفته شد</span>
                    @elseif($req->status === 'done')
                        <span class="badge active">انجام شد</span>
                    @else
                        <span class="badge disabled">نادیده</span>
                    @endif
                </td>

                <td>
                    <div class="actions">
                        @if(empty($req->license_key))
                            <form method="post" action="/admin/purchase-requests/{{ $req->id }}/create-license">
                                @csrf
                                <input type="hidden" name="plan" value="{{ $req->plan ?: 'TtacPlus' }}">
                                <input type="hidden" name="days" value="{{ ($req->plan ?? '') === 'Trial' ? 14 : 365 }}">
                                <button class="btn" style="background:#16a34a;" type="submit">ساخت لایسنس</button>
                            </form>
                        @endif

                        <form method="post" action="/admin/purchase-requests/{{ $req->id }}/status">
                            @csrf
                            <input type="hidden" name="status" value="contacted">
                            <button class="btn btn-blue" type="submit">تماس گرفتم</button>
                        </form>

                        <form method="post" action="/admin/purchase-requests/{{ $req->id }}/status">
                            @csrf
                            <input type="hidden" name="status" value="done">
                            <button class="btn" style="background:#16a34a;" type="submit">انجام شد</button>
                        </form>

                        <form method="post" action="/admin/purchase-requests/{{ $req->id }}/status">
                            @csrf
                            <input type="hidden" name="status" value="ignored">
                            <button class="btn btn-gray" type="submit">نادیده</button>
                        </form>
<!-- SCB_DEL_BTN_REQ -->
                        <form method="post" action="/admin/purchase-requests/{{ $req->id }}/delete" onsubmit="return confirm('این درخواست برای همیشه حذف شود؟');">
                            @csrf
                            <button class="btn btn-red" type="submit">حذف</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" style="text-align:center; padding:24px; color:#6b7280;">
                    هنوز درخواستی ثبت نشده است.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</section>
<!-- SCANBRIDGE_PURCHASE_REQUESTS_PANEL_END -->
    </div>

    <div class="scb-tab-panel" data-tab="settings">
<!-- SCANBRIDGE_ADMIN_LOGS_START -->
<section class="card" id="admin-logs">
    <h2>آخرین فعالیت‌های پنل</h2>

    <table>
        <thead>
        <tr>
            <th>زمان</th>
            <th>عملیات</th>
            <th>توضیح</th>
            <th>IP</th>
        </tr>
        </thead>
        <tbody>
        @forelse(($adminLogs ?? collect()) as $log)
            <tr>
                <td>{{ $log->created_at }}</td>
                <td><span class="badge plan">{{ $log->action }}</span></td>
                <td style="white-space:normal;">{{ $log->message ?: '-' }}</td>
                <td style="direction:ltr;">{{ $log->ip_address ?: '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align:center; padding:24px; color:#6b7280;">
                    هنوز فعالیتی ثبت نشده است.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</section>
<!-- SCANBRIDGE_ADMIN_LOGS_END -->
    </div>

    <div class="scb-tab-panel" data-tab="licenses">
<section class="card">
        <h2>ساخت لایسنس جدید</h2>
        <form method="post" action="/admin/licenses">
            @csrf
            <div class="form-grid">
                <div>
                    <label>پلن</label>
                    <select name="plan" required>
                        <option value="Normal">Normal - بارکدخوان</option>
                        <option value="Ttac">Ttac - تی‌تک</option>
                        <option value="TtacPlus" selected>TtacPlus - کامل</option>
                        <option value="Trial">Trial - آزمایشی</option>
                    </select>
                </div>
                <div>
                    <label>نام داروخانه</label>
                    <input name="pharmacy_name" placeholder="مثلاً داروخانه دکتر زارعی" required>
                </div>
                <div>
                    <label>نام مشتری</label>
                    <input name="customer_name" placeholder="اختیاری">
                </div>
                <div>
                    <label>شماره تماس</label>
                    <input name="mobile" placeholder="09xxxxxxxxx" dir="ltr">
                </div>
                <div>
                    <label>مدت اعتبار - روز</label>
                    <input type="number" name="days" value="365" min="1" max="3650" required>
                </div>
                <div>
                    <label>تعداد سیستم مجاز</label>
                    <input type="number" name="max_devices" value="1" min="1" max="50" required>
                </div>
                <div>
                    <button class="btn btn-create" type="submit">ساخت لایسنس</button>
                </div>
            </div>
        </form>
    </section>

    <section class="card">
        <h2>جستجو</h2>
        <form method="get" action="/admin" class="search-row">
            <div>
                <label>جستجو بر اساس کد، نام داروخانه، مشتری، پلن یا وضعیت</label>
                <input name="q" value="{{ $q }}" placeholder="مثلاً Dr.Zarei یا SCB یا TtacPlus">
            </div>
            <button class="btn btn-search" type="submit">جستجو</button>
            <a class="btn btn-gray" href="/admin">پاک کردن</a>
        </form>
    </section>

    <section class="card">
        <h2>لیست لایسنس‌ها</h2>

        <div class="license-filter-bar">
            <a class="license-filter {{ ($licenseFilter ?? 'all') === 'all' ? 'active' : '' }}" href="/admin">همه</a>
            <a class="license-filter {{ ($licenseFilter ?? 'all') === 'active' ? 'active' : '' }}" href="/admin?license_filter=active">فعال</a>
            <a class="license-filter {{ ($licenseFilter ?? 'all') === 'disabled' ? 'active' : '' }}" href="/admin?license_filter=disabled">غیرفعال</a>
            <a class="license-filter {{ ($licenseFilter ?? 'all') === 'expired' ? 'active' : '' }}" href="/admin?license_filter=expired">منقضی‌شده</a>
            <a class="license-filter {{ ($licenseFilter ?? 'all') === 'Normal' ? 'active' : '' }}" href="/admin?license_filter=Normal">Normal</a>
            <a class="license-filter {{ ($licenseFilter ?? 'all') === 'Ttac' ? 'active' : '' }}" href="/admin?license_filter=Ttac">Ttac</a>
            <a class="license-filter {{ ($licenseFilter ?? 'all') === 'TtacPlus' ? 'active' : '' }}" href="/admin?license_filter=TtacPlus">TtacPlus</a>
            <a class="license-filter {{ ($licenseFilter ?? 'all') === 'Trial' ? 'active' : '' }}" href="/admin?license_filter=Trial">Trial</a>
        </div>

        <table>
            <thead>
            <tr>
                <th>کد</th>
                <th>مشتری / داروخانه</th>
                <th>پلن</th>
                <th>وضعیت</th>
                <th>اعتبار</th>
                <th>دستگاه‌ها</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @forelse($licenses as $license)
                @php
                    $count = (int)($activationCounts[$license->id] ?? 0);
                    $licenseActivations = $activations[$license->id] ?? collect();
                    $isExpired = $license->expires_at && \Carbon\Carbon::parse($license->expires_at)->isPast();
                    $rowClass = $isExpired ? 'expired-row' : ($license->status !== 'active' ? 'disabled-row' : '');
                @endphp
                <tr class="{{ $rowClass }}">
                    <td>
                        <div class="license-box">
                            <div class="license-key" id="lic-{{ $license->id }}">{{ $license->license_key }}</div>
                            <button type="button" class="btn btn-copy" onclick="copyLicense('{{ $license->license_key }}')">کپی</button>
                        </div>
                    </td>
                    <td>
                        <strong>{{ $license->pharmacy_name ?: '-' }}</strong>
                        <br>
                        <span style="color:#6b7280">{{ $license->customer_name ?: '-' }}</span>
                    </td>
                    <td>
                        <span class="badge plan">{{ $license->plan }}</span>
                    </td>
                    <td>
                        @if($license->status === 'active')
                            <span class="badge active">فعال</span>
                        @else
                            <span class="badge disabled">غیرفعال</span>
                        @endif

                        @if($isExpired)
                            <br><br>
                            <span class="badge expired">منقضی‌شده</span>
                        @endif
                    </td>
                    <td>
                        {{ $license->expires_at ?: 'بدون تاریخ' }}
                    </td>
                    <td>
                        {{ $count }} / {{ $license->max_devices }}

                        <details>
                            <summary>مشاهده دستگاه‌ها</summary>
                            @forelse($licenseActivations as $activation)
                                <div class="activation">
                                    Device: {{ $activation->device_name ?: '-' }}<br>
                                    ID: {{ $activation->device_id }}<br>
                                    IP: {{ $activation->ip_address ?: '-' }}<br>
                                    App: {{ $activation->app_version ?: '-' }}<br>
                                    Activated: {{ $activation->activated_at ?: '-' }}<br>
                                    Last Seen: {{ $activation->last_seen_at ?: '-' }}
                                </div>
                            @empty
                                <div style="color:#6b7280; margin-top:8px;">هنوز فعال‌سازی نشده</div>
                            @endforelse
                        </details>
                    </td>
                    <td>
                        <div class="actions">
                            @if($license->status === 'active')
                                <form method="post" action="/admin/licenses/{{ $license->id }}/status">
                                    @csrf
                                    <input type="hidden" name="status" value="disabled">
                                    <button class="btn btn-red" type="submit">غیرفعال کردن</button>
                                </form>
                            @else
                                <form method="post" action="/admin/licenses/{{ $license->id }}/status">
                                    @csrf
                                    <input type="hidden" name="status" value="active">
                                    <button class="btn btn-blue" type="submit">فعال کردن</button>
                                </form>
                            @endif

                            <form method="post" action="/admin/licenses/{{ $license->id }}/reset-devices" onsubmit="return confirm('دستگاه‌های فعال‌شده این لایسنس حذف شوند؟')">
                                @csrf
                                <button class="btn btn-orange" type="submit">ریست دستگاه‌ها</button>
                            </form>

                            <form class="inline-form" method="post" action="/admin/licenses/{{ $license->id }}/renew">
                                @csrf
                                <input type="number" name="days" value="365" min="1" max="3650">
                                <button class="btn btn-purple" type="submit">تمدید</button>
                            </form>

                            <form class="inline-form" method="post" action="/admin/licenses/{{ $license->id }}/max-devices">
                                @csrf
                                <input type="number" name="max_devices" value="{{ $license->max_devices }}" min="1" max="50">
                                <button class="btn btn-gray" type="submit">تعداد</button>
                            </form>

                            <form class="inline-form" method="post" action="/admin/licenses/{{ $license->id }}/plan">
                                @csrf
                                <select name="plan">
                                    <option value="Normal" @selected($license->plan === 'Normal')>Normal</option>
                                    <option value="Ttac" @selected($license->plan === 'Ttac')>Ttac</option>
                                    <option value="TtacPlus" @selected($license->plan === 'TtacPlus')>TtacPlus</option>
                                    <option value="Trial" @selected($license->plan === 'Trial')>Trial</option>
                                </select>
                                <button class="btn btn-blue" type="submit">تغییر پلن</button>
                            </form>
<!-- SCB_DEL_BTN_LIC -->
                            <form method="post" action="/admin/licenses/{{ $license->id }}/delete" onsubmit="return confirm('این لایسنس برای همیشه حذف شود؟ تمام دستگاه‌های آن هم پاک می‌شوند.');">
                                @csrf
                                <button class="btn btn-red" type="submit">حذف</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:30px; color:#6b7280;">
                        هیچ لایسنسی پیدا نشد.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </section>
    </div>
</main>

<div id="copy-note" class="copy-note">کد لایسنس کپی شد</div>

<script>
    function copyLicense(text) {
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text).then(showCopyNote).catch(function () {
                fallbackCopy(text);
            });
        } else {
            fallbackCopy(text);
        }
    }

    function fallbackCopy(text) {
        const ta = document.createElement('textarea');
        ta.value = text;
        ta.style.position = 'fixed';
        ta.style.left = '-9999px';
        document.body.appendChild(ta);
        ta.focus();
        ta.select();
        try { document.execCommand('copy'); } catch (e) {}
        document.body.removeChild(ta);
        showCopyNote();
    }

    function showCopyNote() {
        const n = document.getElementById('copy-note');
        n.style.display = 'block';
        setTimeout(function () {
            n.style.display = 'none';
        }, 1800);
    }
</script>

<script>
function scbAttachUploadProgress(formId, fillId, textId) {
    var form = document.getElementById(formId);
    if (!form) { return; }
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var fill = document.getElementById(fillId);
        var text = document.getElementById(textId);
        var wrap = fill.closest('.upload-progress');
        var btn = form.querySelector('button[type="submit"]');
        var formData = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.getAttribute('action'), true);
        wrap.style.display = 'block';
        if (btn) { btn.disabled = true; }
        xhr.upload.onprogress = function (evt) {
            if (evt.lengthComputable) {
                var pct = Math.round((evt.loaded / evt.total) * 100);
                fill.style.width = pct + '%';
                var mbLoaded = (evt.loaded / 1024 / 1024).toFixed(1);
                var mbTotal = (evt.total / 1024 / 1024).toFixed(1);
                text.textContent = pct + '% آپلود شد (' + mbLoaded + ' از ' + mbTotal + ' مگابایت)';
            }
        };
        xhr.onload = function () {
            text.textContent = 'در حال پردازش نهایی...';
            window.location.href = '/admin';
        };
        xhr.onerror = function () {
            text.textContent = 'خطا در آپلود. لطفا دوباره تلاش کنید.';
            if (btn) { btn.disabled = false; }
        };
        xhr.send(formData);
    });
}
scbAttachUploadProgress('installer-form', 'progress-installer-fill', 'progress-installer-text');
scbAttachUploadProgress('installer-android-form', 'progress-installer-android-fill', 'progress-installer-android-text');
</script>

<script>
function scbAdminShowTab(name) {
    document.querySelectorAll('.scb-tab-panel').forEach(function (p) {
        p.classList.toggle('active', p.getAttribute('data-tab') === name);
    });
    document.querySelectorAll('.scb-admin-tab-btn').forEach(function (b) {
        b.classList.toggle('active', b.getAttribute('data-tab') === name);
    });
}
(function () {
    var initial = 'licenses';
    var params = new URLSearchParams(window.location.search);
    if (params.has('request_status') || window.location.hash === '#purchase-requests') {
        initial = 'requests';
    } else if (params.has('license_filter') || params.has('q')) {
        initial = 'licenses';
    }
    scbAdminShowTab(initial);
    if (window.location.hash) {
        setTimeout(function () {
            var el = document.querySelector(window.location.hash);
            if (el) { el.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
        }, 80);
    }
})();
</script>

@include('partials.site-footer')
</body>
</html>
