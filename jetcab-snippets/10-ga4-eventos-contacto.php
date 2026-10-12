<?php
/* JETCAB — eventos GA4 de contacto (snippet 17). Envía contacto_whatsapp, contacto_telefono, contacto_email y
   cotizacion_enviada por gtag (MonsterInsights) o dataLayer (GTM-P3Q6QZ3C). Marcar como eventos clave en GA4 > Admin > Eventos. */
add_action('wp_footer', function () {
    if (is_admin()) return;
    echo '<script id="jc-ga4-contacto">(function(){function send(n,p){try{if(typeof gtag==="function"){gtag("event",n,p||{});}else if(typeof __gtagTracker==="function"){__gtagTracker("event",n,p||{});}else{(window.dataLayer=window.dataLayer||[]).push(Object.assign({event:n},p||{}));}}catch(e){}}
document.addEventListener("click",function(ev){var a=ev.target&&ev.target.closest?ev.target.closest("a[href]"):null;if(!a)return;var h=a.getAttribute("href")||"";if(/wa\\.me|wa\\.link|api\\.whatsapp\\.com|whatsapp:\\/\\//i.test(h)){send("contacto_whatsapp",{link_url:h,page_path:location.pathname});}else if(/^tel:/i.test(h)){send("contacto_telefono",{link_url:h,page_path:location.pathname});}else if(/^mailto:/i.test(h)){send("contacto_email",{link_url:h,page_path:location.pathname});}},true);
document.addEventListener("submit",function(ev){var f=ev.target;if(f&&f.tagName==="FORM"){send("cotizacion_enviada",{form_id:f.id||"",page_path:location.pathname});}},true);})();</script>' . "\n";
}, 60);
