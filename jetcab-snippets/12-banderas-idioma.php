<?php
/* JETCAB — selector de idioma con banderas (México / Estados Unidos) en lugar de ES / EN. Snippet 19.
   Páginas ES: wp_footer. Páginas EN servidas por template_redirect: inyección por búfer antes de </body>. */
function jetcab_banderas_html() {
    $mx = '<svg viewBox="0 0 30 20" width="22" height="15" aria-hidden="true"><rect width="10" height="20" fill="#006847"/><rect x="10" width="10" height="20" fill="#fff"/><rect x="20" width="10" height="20" fill="#ce1126"/><circle cx="15" cy="10" r="2.6" fill="#8c6b3f"/><circle cx="15" cy="10" r="1.3" fill="#5c4327"/></svg>';
    $us = '<svg viewBox="0 0 30 20" width="22" height="15" aria-hidden="true"><rect width="30" height="20" fill="#fff"/><g fill="#b22234"><rect y="0" width="30" height="2.86"/><rect y="5.71" width="30" height="2.86"/><rect y="11.43" width="30" height="2.86"/><rect y="17.14" width="30" height="2.86"/></g><rect width="12" height="10.77" fill="#3c3b6e"/><g fill="#fff"><circle cx="2" cy="2" r=".7"/><circle cx="6" cy="2" r=".7"/><circle cx="10" cy="2" r=".7"/><circle cx="4" cy="4.2" r=".7"/><circle cx="8" cy="4.2" r=".7"/><circle cx="2" cy="6.4" r=".7"/><circle cx="6" cy="6.4" r=".7"/><circle cx="10" cy="6.4" r=".7"/><circle cx="4" cy="8.6" r=".7"/><circle cx="8" cy="8.6" r=".7"/></g></svg>';
    $css = '.jc-lang-switch a{display:flex!important;align-items:center;justify-content:center;padding:7px 11px!important;min-height:30px}.jc-lang-switch a svg{display:block;border-radius:2px;box-shadow:0 0 0 1px rgba(255,255,255,.25)}.jc-lang-switch .jc-l-es,.jc-lang-switch .jc-l-en{background:rgba(20,20,20,.85)!important;border:0!important}.jc-lang-switch a.jc-active{background:#E85A1E!important}.jc-lang-switch a:not(.jc-active){opacity:.8}.jc-lang-switch a:not(.jc-active):hover{opacity:1;background:rgba(40,40,40,.95)!important}';
    $js  = '(function(){var MX=' . json_encode($mx) . ',US=' . json_encode($us) . ';var isEN=location.pathname.indexOf("/en")===0||location.pathname.indexOf("/private-jet-")===0;function apply(){var es=document.querySelector(".jc-lang-switch .jc-l-es"),en=document.querySelector(".jc-lang-switch .jc-l-en");if(!es||!en)return false;if(!es.querySelector("svg")){es.innerHTML=MX;es.setAttribute("title","Español");es.setAttribute("aria-label","Versión en español");}if(!en.querySelector("svg")){en.innerHTML=US;en.setAttribute("title","English");en.setAttribute("aria-label","English version");}(isEN?en:es).classList.add("jc-active");return true;}var n=0,t=setInterval(function(){if(apply()||++n>40)clearInterval(t);},100);apply();})();';
    return '<style id="jc-banderas-css">' . $css . '</style><script id="jc-banderas-js">' . $js . '</script>';
}
add_action('wp_footer', function () { if (!is_admin()) echo jetcab_banderas_html() . "\n"; }, 70);
add_action('template_redirect', function () {
    $uri = isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : '';
    if (!($uri === '/en' || strpos($uri, '/en/') === 0 || strpos($uri, '/private-jet-') === 0)) return;
    ob_start(function ($html) {
        if (strpos($html, 'jc-banderas-js') !== false || stripos($html, '</body>') === false) return $html;
        return preg_replace('/<\/body>/i', jetcab_banderas_html() . '</body>', $html, 1);
    });
}, 0);
