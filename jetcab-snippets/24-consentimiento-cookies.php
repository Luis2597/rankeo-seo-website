<?php
/* JETCAB — consentimiento de cookies (oct 2026). Snippet 33.
   Google Consent Mode v2: en EEE/Reino Unido/Suiza la analítica arranca negada hasta que el visitante acepta (GDPR);
   en el resto (México, EE. UU.) arranca permitida y el visitante puede rechazarla (aviso + opción de exclusión).
   La publicidad siempre queda negada porque el sitio no usa anuncios. La elección se guarda en la cookie jc_cookie_consent (1 año).
   Páginas ES: wp_head / wp_footer. Páginas EN (servidas sin wp_head): el snippet 18 llama a jc_consent_head() y jc_consent_banner(). */

if (!function_exists('jc_consent_head')) {
    function jc_consent_head() {
        $eea = "['AT','BE','BG','HR','CY','CZ','DK','EE','FI','FR','DE','GR','HU','IE','IT','LV','LT','LU','MT','NL','PL','PT','RO','SK','SI','ES','SE','IS','LI','NO','GB','CH']";
        return '<script id="jc-consent-default">window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}'
            . "gtag('consent','default',{ad_storage:'denied',ad_user_data:'denied',ad_personalization:'denied',analytics_storage:'denied',region:$eea,wait_for_update:500});"
            . "gtag('consent','default',{ad_storage:'denied',ad_user_data:'denied',ad_personalization:'denied',analytics_storage:'granted'});"
            . "(function(){var m=document.cookie.match(/(?:^|; )jc_cookie_consent=(all|essential)/);if(m){gtag('consent','update',{analytics_storage:m[1]==='all'?'granted':'denied'});}})();</script>";
    }
}

if (!function_exists('jc_consent_banner')) {
    function jc_consent_banner($lang) {
        $t = $lang === 'en'
            ? array('We use analytics cookies (Google Analytics) to understand how our site is used. You can accept or decline them.', 'Privacy Notice', 'https://jetcab.mx/privacy/', 'Accept', 'Decline', 'Cookie settings')
            : array('Usamos cookies de analítica (Google Analytics) para entender cómo se usa el sitio. Puede aceptarlas o rechazarlas.', 'Política de Cookies', 'https://jetcab.mx/politica-de-cookies/', 'Aceptar', 'Rechazar', 'Configuración de cookies');
        return '<div id="jc-cookies" role="dialog" aria-live="polite" aria-label="' . esc_attr($t[5]) . '" hidden>'
            . '<p>' . esc_html($t[0]) . ' <a href="' . esc_url($t[2]) . '">' . esc_html($t[1]) . '</a></p>'
            . '<div class="jcc-b"><button type="button" data-jcc="essential">' . esc_html($t[4]) . '</button><button type="button" data-jcc="all" class="jcc-ok">' . esc_html($t[3]) . '</button></div></div>'
            . '<style>#jc-cookies{position:fixed;left:16px;right:16px;bottom:16px;z-index:100000;max-width:560px;margin:0 auto;background:#111;color:#eee;border:1px solid rgba(255,255,255,.14);border-radius:10px;padding:16px 18px;box-shadow:0 12px 40px rgba(0,0,0,.45);font:14px/1.55 system-ui,-apple-system,"Segoe UI",sans-serif;opacity:0;transform:translateY(12px);transition:opacity .3s cubic-bezier(.23,1,.32,1),transform .3s cubic-bezier(.23,1,.32,1)}'
            . '#jc-cookies.on{opacity:1;transform:none}#jc-cookies[hidden]{display:none}#jc-cookies p{margin:0 0 12px}#jc-cookies a{color:#fff;text-decoration:underline;text-underline-offset:2px}'
            . '#jc-cookies .jcc-b{display:flex;gap:10px;justify-content:flex-end}#jc-cookies button{min-height:44px;padding:0 18px;border-radius:100px;border:1px solid rgba(255,255,255,.3);background:none;color:#fff;font:600 13px system-ui,sans-serif;cursor:pointer;transition:transform .15s ease-out}'
            . '#jc-cookies button:active{transform:scale(.97)}#jc-cookies .jcc-ok{background:#E85A1E;border-color:#E85A1E;color:#111}'
            . '@media(prefers-reduced-motion:reduce){#jc-cookies{transition:none}}</style>'
            . '<script id="jc-consent-banner">(function(){var b=document.getElementById("jc-cookies");if(!b)return;'
            . 'function has(){return /(?:^|; )jc_cookie_consent=(all|essential)/.test(document.cookie);}'
            . 'function show(){b.hidden=false;requestAnimationFrame(function(){b.classList.add("on");});}'
            . 'function hide(){b.classList.remove("on");setTimeout(function(){b.hidden=true;},300);}'
            . 'b.addEventListener("click",function(e){var v=e.target&&e.target.getAttribute("data-jcc");if(!v)return;'
            . 'document.cookie="jc_cookie_consent="+v+"; path=/; max-age=31536000; SameSite=Lax; Secure";'
            . 'if(typeof gtag==="function")gtag("consent","update",{analytics_storage:v==="all"?"granted":"denied"});hide();});'
            . 'window.jcCookieSettings=show;'
            . 'document.addEventListener("click",function(e){var a=e.target&&e.target.closest?e.target.closest("a[href$=\'#cookie-settings\']"):null;if(a){e.preventDefault();show();}});'
            . 'if(location.hash==="#cookie-settings"||!has())setTimeout(show,800);})();</script>';
    }
}

// Páginas ES servidas por WordPress
add_action('wp_head', function () { if (!is_admin()) echo jc_consent_head(); }, 1);
add_action('wp_footer', function () { if (!is_admin()) echo jc_consent_banner('es'); }, 99);
