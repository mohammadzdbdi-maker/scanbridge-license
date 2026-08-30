<!doctype html>
<html lang="fa" dir="rtl">
<head>
<meta charset="utf-8">
<title>{{ $pageTitle }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
@font-face{font-family:'Arad';src:url('/fonts/Arad-Regular.woff2') format('woff2');font-weight:normal;font-style:normal;font-display:swap;}
@font-face{font-family:'Arad';src:url('/fonts/Arad-Bold.woff2') format('woff2');font-weight:bold;font-style:normal;font-display:swap;}
*{box-sizing:border-box}
html,body{height:100%}
body{margin:0;font-family:'Arad',Tahoma,Arial,sans-serif;background:linear-gradient(135deg,#eef2f7 0%,#e3ecfa 55%,#dbeafe 130%)!important;background-attachment:fixed!important;color:#0f172a;line-height:1.9;display:flex;flex-direction:column;position:relative;overflow-x:hidden;}
body::before{content:"";position:fixed;top:-300px;left:50%;transform:translateX(-50%);width:900px;height:900px;background:radial-gradient(circle at center, rgba(37,99,235,.85) 0%, rgba(37,99,235,.45) 35%, transparent 68%);filter:blur(70px);z-index:0;pointer-events:none;}
body::after{content:"";position:fixed;top:10%;right:-220px;width:560px;height:560px;background:radial-gradient(circle at center, rgba(30,58,138,.35), transparent 70%);filter:blur(80px);z-index:0;pointer-events:none;}
.wrap{flex:1 0 auto;display:flex;align-items:center;justify-content:center;padding:24px 16px;position:relative;z-index:1;}
.card{background:rgba(255,255,255,.85);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);border:1px solid rgba(255,255,255,.95);border-radius:24px;box-shadow:0 16px 45px rgba(30,58,138,.16);padding:30px;width:100%;max-width:430px;}
.brand{display:flex;align-items:center;justify-content:center;gap:10px;margin-bottom:16px;}
.brand img{width:40px;height:40px;border-radius:10px;object-fit:cover;}
.brand span{font-size:24px;font-weight:800;color:#1e3a8a;direction:ltr;}
h1{font-size:19px;text-align:center;margin:0 0 16px;color:#1e3a8a;}
.tabs{display:flex;background:#eef2f7;border-radius:14px;padding:5px;margin-bottom:20px;}
.tabs a{flex:1;text-align:center;padding:9px;border-radius:10px;font-weight:800;font-size:14px;color:#64748b;text-decoration:none;}
.tabs a.active{background:#2563eb;color:#fff;box-shadow:0 4px 12px rgba(37,99,235,.3);}
label{display:block;font-weight:bold;font-size:13.5px;margin-bottom:6px;color:#334155;}
.field{position:relative;margin-bottom:14px;}
.field input{width:100%;padding:12px 44px;border-radius:12px;border:1px solid #cbd5e1;font-family:inherit;font-size:15px;background:#fff;color:#0f172a;}
.field input:focus{outline:none;border-color:#2563eb;box-shadow:0 0 0 4px rgba(37,99,235,.15);}
.ic{position:absolute;right:12px;top:50%;transform:translateY(-50%);width:20px;height:20px;pointer-events:none;}
.eye{position:absolute!important;left:8px!important;top:50%!important;transform:translateY(-50%)!important;width:36px!important;height:36px!important;border:0!important;border-radius:10px!important;background:#eef2ff!important;color:#1e3a8a!important;cursor:pointer!important;display:flex!important;align-items:center!important;justify-content:center!important;padding:0!important;}
.eye:hover{background:#e0e7ff!important;}
.eye svg{width:20px;height:20px;pointer-events:none;}
.btn{display:block;width:100%;border-radius:14px;padding:13px;font-weight:bold;font-size:15px;color:#fff;border:0;cursor:pointer;background:linear-gradient(135deg,#2563eb,#1d4ed8);box-shadow:0 8px 20px rgba(37,99,235,.35);margin-top:4px;font-family:inherit;}
.error{background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;border-radius:12px;padding:10px 14px;font-size:13.5px;margin-bottom:14px;}
.ok{background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;border-radius:12px;padding:10px 14px;font-size:13.5px;margin-bottom:14px;}
.forgot-link{text-align:left;margin:-6px 0 14px;font-size:12.5px;}
.forgot-link a{color:#2563eb;font-weight:bold;text-decoration:none;}
.forgot-link a:hover{text-decoration:underline;}
.foot{text-align:center;margin-top:16px;font-size:13.5px;color:#64748b;}
.foot a{color:#2563eb;font-weight:bold;}
</style>

<style>/*SCB_ICON_BG_FIX*/
.ic{background:transparent!important;mix-blend-mode:multiply!important;}
.brand-logo,.brand img{background:transparent!important;mix-blend-mode:multiply!important;}
.feat-icon,.plan-icon,.ico-img{background:transparent!important;mix-blend-mode:multiply!important;}
.stat img,.cust-stat img{background:transparent!important;mix-blend-mode:multiply!important;}
</style>
</head>
<body>
<div class="wrap">
<div class="card">
<div class="brand"><img src="/icons/logo.png" alt=""><span>Scanbridge</span></div>
<h1>{{ $activeTab === 'register' ? 'ثبت‌نام مشتری' : 'ورود به پنل مشتری' }}</h1>
<div class="tabs">
<a href="/panel/login" class="{{ $activeTab === 'login' ? 'active' : '' }}">ورود</a>
<a href="/panel/register" class="{{ $activeTab === 'register' ? 'active' : '' }}">ثبت‌نام</a>
</div>
@if (session('error'))
<div class="error">{{ session('error') }}</div>
@endif
@if (session('ok'))
<div class="ok">{{ session('ok') }}</div>
@endif
@if ($errors->any())
<div class="error">{{ $errors->first() }}</div>
@endif
@if ($activeTab === 'login')
<form method="POST" action="/panel/login">
@csrf
<label>شماره موبایل</label>
<div class="field">
<img class="ic" src="/icons/icon-mobile.png" alt="">
<input type="text" name="mobile" value="{{ old('mobile') }}" required inputmode="numeric" placeholder="09xxxxxxxxx">
</div>
<label>رمز عبور</label>
<div class="field">
<img class="ic" src="/icons/icon-lock.png" alt="">
<input type="password" id="pw-login" name="password" required placeholder="رمز عبور">
<button class="eye" type="button" onclick="togglePassword('pw-login', this)" title="نمایش رمز"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg></button>
</div>
@if(config('services.scanbridge.sms_otp_enabled'))
<div class="forgot-link"><a href="/panel/forgot-password">رمز عبور را فراموش کرده‌اید؟</a></div>
@endif
<button class="btn" type="submit">ورود</button>
</form>
@else
<form method="POST" action="/panel/register">
@csrf
<label>نام و نام خانوادگی</label>
<div class="field">
<img class="ic" src="/icons/icon-user.png" alt="">
<input type="text" name="name" value="{{ old('name') }}" required placeholder="نام و نام خانوادگی">
</div>
<label>شماره موبایل</label>
<div class="field">
<img class="ic" src="/icons/icon-mobile.png" alt="">
<input type="text" name="mobile" value="{{ old('mobile') }}" required inputmode="numeric" placeholder="09xxxxxxxxx">
</div>
<label>رمز عبور</label>
<div class="field">
<img class="ic" src="/icons/icon-lock.png" alt="">
<input type="password" id="pw-reg1" name="password" required placeholder="حداقل ۸ کاراکتر">
<button class="eye" type="button" onclick="togglePassword('pw-reg1', this)" title="نمایش رمز"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg></button>
</div>
<label>تکرار رمز عبور</label>
<div class="field">
<img class="ic" src="/icons/icon-lock.png" alt="">
<input type="password" id="pw-reg2" name="password_confirmation" required placeholder="تکرار رمز عبور">
<button class="eye" type="button" onclick="togglePassword('pw-reg2', this)" title="نمایش رمز"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg></button>
</div>
<button class="btn" type="submit">ثبت‌نام</button>
</form>
@endif
<div class="foot">@if ($activeTab === 'login')حساب ندارید؟ <a href="/panel/register">ثبت‌نام کنید</a>@elseحساب دارید؟ <a href="/panel/login">وارد شوید</a>@endif</div>
</div>
</div>
@include('partials.site-footer')
<script>
function togglePassword(id,btn){
var el=document.getElementById(id);if(!el)return;
var open='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>';
var closed='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-10-8-10-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 10 8 10 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>';
if(el.type==='password'){el.type='text';btn.innerHTML=closed;}
else{el.type='password';btn.innerHTML=open;}
}
</script>
</body>
</html>