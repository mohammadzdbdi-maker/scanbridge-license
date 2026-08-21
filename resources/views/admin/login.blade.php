<!doctype html>
<html lang="fa" dir="rtl">
<head>
<meta charset="utf-8">
<title>ورود پنل مدیریت | Scanbridge</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
@font-face{font-family:'Pinar';src:url('/fonts/Pinar-DS1-FD-Regular.woff2') format('woff2');}
*{box-sizing:border-box}
html,body{height:100%}
body{margin:0;font-family:'Pinar',Tahoma,Arial,sans-serif;background:linear-gradient(135deg,#eef2f7 0%,#e3ecfa 55%,#dbeafe 130%)!important;background-attachment:fixed!important;color:#0f172a;line-height:1.9;display:flex;flex-direction:column;}
.wrap{flex:1 0 auto;display:flex;align-items:center;justify-content:center;padding:24px 16px;}
.card{background:rgba(255,255,255,.85);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);border:1px solid rgba(255,255,255,.95);border-radius:24px;box-shadow:0 16px 45px rgba(30,58,138,.16);padding:30px;width:100%;max-width:420px;}
.brand{display:flex;align-items:center;justify-content:center;gap:10px;margin-bottom:16px;}
.brand img{width:40px;height:40px;border-radius:10px;object-fit:cover;}
.brand span{font-size:24px;font-weight:800;color:#1e3a8a;direction:ltr;}
h1{font-size:19px;text-align:center;margin:0 0 16px;color:#1e3a8a;}
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
<h1>ورود به پنل مدیریت</h1>
@if(session('error'))
<div class="error">{{ session('error') }}</div>
@endif
@if($errors->any())
<div class="error">{{ $errors->first() }}</div>
@endif
<form method="post" action="/admin/login">
@csrf
<label>رمز عبور</label>
<div class="field">
<img class="ic" src="/icons/icon-lock.png" alt="">
<input id="password" type="password" name="password" required autofocus placeholder="رمز عبور پنل مدیریت">
<button class="eye" type="button" onclick="togglePassword('password', this)" title="نمایش رمز"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg></button>
</div>
<button class="btn" type="submit">ورود به پنل</button>
</form>
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