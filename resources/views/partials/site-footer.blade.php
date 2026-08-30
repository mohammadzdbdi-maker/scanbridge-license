{{-- footer --}}
<style>footer.site-footer{position:relative!important;z-index:999!important;clear:both!important;background:#0f172a!important;color:#cbd5e1!important;padding:26px 20px!important;text-align:center!important;border-top:2px solid #3b82f6!important;line-height:2!important;}footer.site-footer a{color:#93c5fd!important;font-weight:bold!important;margin:0 8px!important;text-decoration:none!important;}footer.site-footer a:hover{color:#fff!important;text-decoration:underline!important;}</style><footer class="site-footer"><div><a href="/privacy">حریم خصوصی</a> | <a href="/terms">شرایط استفاده</a> | <a href="https://wa.me/989136346309">پشتیبانی واتساپ</a><div style="margin-top:8px;font-size:13px;color:#94a3b8;">© 1405 Scanbridge — تمامی حقوق محفوظ است.</div></div></footer>
<script>/*SCB_FA_DIGITS*/
(function(){
    var fa = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
    var SKIP_TAGS = {SCRIPT:1,STYLE:1,TEXTAREA:1};
    function isSkipped(el){
        while (el) {
            if (el.classList && el.classList.contains('no-fa-digits')) { return true; }
            el = el.parentElement;
        }
        return false;
    }
    function convert(node){
        if (!node) { return; }
        if (node.nodeType === 3) {
            if (node.nodeValue && /[0-9]/.test(node.nodeValue) && !isSkipped(node.parentElement)) {
                node.nodeValue = node.nodeValue.replace(/[0-9]/g, function (d) { return fa[+d]; });
            }
        } else if (node.nodeType === 1 && !SKIP_TAGS[node.tagName]) {
            for (var i = 0; i < node.childNodes.length; i++) { convert(node.childNodes[i]); }
        }
    }
    function watch(){
        convert(document.body);
        if (window.MutationObserver) {
            var mo = new MutationObserver(function (mutations) {
                mutations.forEach(function (m) {
                    if (m.type === 'childList') {
                        m.addedNodes.forEach(function (n) { convert(n); });
                    } else if (m.type === 'characterData') {
                        convert(m.target);
                    }
                });
            });
            mo.observe(document.body, { childList: true, subtree: true, characterData: true });
        }
    }
    if (document.body) {
        watch();
    } else {
        document.addEventListener('DOMContentLoaded', watch);
    }
})();
</script>
