<?php
/* JETCAB — GA4 + eventos de contacto en las páginas EN servidas por template_redirect (sin wp_head/wp_footer). Snippet 18. */
add_action('template_redirect', function () {
    $uri = isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : '';
    if (!($uri === '/en' || strpos($uri, '/en/') === 0 || strpos($uri, '/private-jet-') === 0)) return;
    ob_start(function ($html) {
        if (strpos($html, 'G-GDZ8NL03E5') !== false || stripos($html, '</head>') === false) return $html;
        $tag = '<script async src="https://www.googletagmanager.com/gtag/js?id=G-GDZ8NL03E5"></script><script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag("js",new Date());gtag("config","G-GDZ8NL03E5");</script>'
             . '<script id="jc-ga4-contacto">(function(){function send(n,p){try{gtag("event",n,p||{});}catch(e){}}'
             . 'document.addEventListener("click",function(ev){var a=ev.target&&ev.target.closest?ev.target.closest("a[href]"):null;if(!a)return;var h=a.getAttribute("href")||"";if(/wa\.me|wa\.link|api\.whatsapp\.com|whatsapp:\/\//i.test(h)){send("contacto_whatsapp",{link_url:h,page_path:location.pathname});}else if(/^tel:/i.test(h)){send("contacto_telefono",{link_url:h,page_path:location.pathname});}else if(/^mailto:/i.test(h)){send("contacto_email",{link_url:h,page_path:location.pathname});}},true);'
             . 'document.addEventListener("submit",function(ev){var f=ev.target;if(f&&f.tagName==="FORM"){send("cotizacion_enviada",{form_id:f.id||"",page_path:location.pathname});}},true);})();</script>';
        return preg_replace('/<\/head>/i', $tag . '</head>', $html, 1);
    });
}, 0);
