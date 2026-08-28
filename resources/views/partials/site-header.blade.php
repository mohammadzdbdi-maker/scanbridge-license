<style>
/* SCANBRIDGE_SHARED_HEADER_CSS_START */
.scb-nav, .scb-nav * {
    box-sizing: border-box !important;
    line-height: 1.4 !important;
    margin: 0 !important;
}
.scb-nav {
    position: sticky !important;
    top: 0 !important;
    z-index: 50 !important;
    background: rgba(255,255,255,.92) !important;
    backdrop-filter: blur(14px) !important;
    -webkit-backdrop-filter: blur(14px) !important;
    border-bottom: 1px solid #e5e7eb !important;
    font-family: 'Pinar', Tahoma, Arial, sans-serif !important;
    width: 100% !important;
    display: block !important;
    height: 77px !important;
}
.scb-nav-inner {
    max-width: 1180px !important;
    margin: 0 auto !important;
    padding: 0 20px !important;
    height: 76px !important;
    display: flex !important;
    flex-wrap: nowrap !important;
    align-items: center !important;
    justify-content: space-between !important;
    position: relative !important;
}
.scb-brand {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    font-size: 24px !important;
    font-weight: bold !important;
    color: #1e3a8a !important;
    direction: ltr !important;
    text-decoration: none !important;
}
.scb-brand img {
    width: 36px !important;
    height: 36px !important;
    border-radius: 10px !important;
    object-fit: cover !important;
}
.scb-nav-links {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
}
.scb-nav-links a {
    display: inline-flex !important;
    align-items: center !important;
    color: #334155 !important;
    font-weight: bold !important;
    font-size: 15px !important;
    padding: 8px 12px !important;
    border-radius: 12px !important;
    text-decoration: none !important;
    white-space: nowrap !important;
}
.scb-nav-links a:hover { background: #eef2ff !important; }
.scb-nav-links a.scb-login {
    background: #eff6ff !important;
    color: #2563eb !important;
}
.scb-nav-links a.scb-whatsapp {
    background: #16a34a !important;
    color: #fff !important;
}
.scb-nav-toggle {
    display: none;
    background: none !important;
    border: 0 !important;
    cursor: pointer !important;
    padding: 8px !important;
}
.scb-nav-toggle span {
    display: block !important;
    width: 26px !important;
    height: 3px !important;
    background: #1e3a8a !important;
    margin: 5px 0 !important;
    border-radius: 3px !important;
}
@media (max-width: 900px) {
    .scb-nav-links {
        display: none !important;
        position: absolute !important;
        top: 100% !important;
        right: 0 !important;
        left: 0 !important;
        background: #ffffff !important;
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 4px !important;
        padding: 12px 16px 20px !important;
        border-bottom: 1px solid #e5e7eb !important;
        box-shadow: 0 10px 24px rgba(15,23,42,.08) !important;
    }
    .scb-nav-links.scb-open {
        display: flex !important;
    }
    .scb-nav-links a {
        text-align: center !important;
        padding: 12px 14px !important;
        justify-content: center !important;
    }
    .scb-nav-toggle {
        display: block !important;
    }
}
/* SCANBRIDGE_SHARED_HEADER_CSS_END */
</style>

<nav class="scb-nav">
    <div class="scb-nav-inner">
        <a href="/" class="scb-brand">
            <img src="/icons/logo.png" alt="Scanbridge">
            Scanbridge
        </a>
        <button type="button" class="scb-nav-toggle" id="scb-nav-toggle" aria-label="باز کردن منو">
            <span></span><span></span><span></span>
        </button>
        <div class="scb-nav-links" id="scb-nav-links">
            <a class="scb-login" href="/panel/login">ورود به پنل</a>
            <a href="/#features">امکانات</a>
            <a href="/#plans">پلن‌ها</a>
            <a href="/download">دانلود</a>
            <a href="/buy">خرید / تمدید</a>
            <a href="/guide">راهنما 🎓</a>
            <a href="/about">درباره ما</a>
            <a href="/contact">تماس با ما</a>
            <a class="scb-whatsapp" href="https://wa.me/989136346309">واتساپ</a>
        </div>
    </div>
</nav>

<script>
(function () {
    var btn = document.getElementById('scb-nav-toggle');
    var links = document.getElementById('scb-nav-links');
    if (btn && links) {
        btn.addEventListener('click', function () {
            links.classList.toggle('scb-open');
        });
        links.querySelectorAll('a').forEach(function (a) {
            a.addEventListener('click', function () {
                links.classList.remove('scb-open');
            });
        });
    }
})();
</script>
