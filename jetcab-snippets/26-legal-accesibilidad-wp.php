<?php
/* JETCAB — accesibilidad (WCAG 2.2 AA / ADA) y enlaces legales en las páginas servidas por WordPress (oct 2026). Snippet 35.
   /en/ y las páginas de destino tienen su propio HTML (jetcab-en.html y jetcab-dest/build.py) y llevan lo mismo allí. */

// Contraste: texto tinta sobre los botones naranjas; crédito del footer legible; enlaces dentro del texto subrayados.
add_action('wp_head', function () {
    if (is_admin()) return;
    echo '<style id="jc-a11y">'
       . 'html body .uagb-infobox-cta-link,html body .uagb-infobox-cta-link .uagb-inline-editing,html body .uagb-cta__button-link-wrapper,html body .uagb-cta__button-link-wrapper *,'
       . 'html body .jch-cta,html body .jcr-cta,html body .fl-guia-cta,html body .jc-cta-final>.jc-btn:not(.jc-btn-ghost),html body .jc-cta-band>.jc-btn:not(.jc-btn-ghost),html body .wpforms-container .wpforms-form button#wpforms-submit-80[type=submit],html body .wpforms-container .wpforms-form button#wpforms-submit-80[type=submit] *{color:#111!important}'
       . 'a[href$="rankeo.agency"],.credits,.credits a{color:#a3a3a3!important}'
       . '.entry-content p a:not([class]),.entry-content li a:not([class]),.jc-more a,.jc-benefits a,.jc-section p a:not([class]),.jcr p a:not([class]),.jch p a:not([class]),.jc-autor a{text-decoration:underline;text-underline-offset:3px}'
       // Botón de llamar (snippet 20) encima del WhatsApp flotante de algunas páginas: se sube para que ambos se vean
       . 'body:has(a[aria-label="WhatsApp JETCAB"][style*="position:fixed"]) .jc-call{bottom:92px}'
       . '.jc-legal{background:#0D0D0D;border-top:1px solid rgba(255,255,255,.08);padding:18px 24px 22px;font:14px/1.5 Barlow,Arial,sans-serif;color:#b5b5b5;text-align:center}'
       . '.jc-legal nav{display:flex;flex-wrap:wrap;gap:4px 22px;justify-content:center}'
       . '.jc-legal a{color:#d6d6d6;text-decoration:underline;text-underline-offset:3px;display:inline-block;min-height:44px;line-height:44px}'
       . '.jc-legal p{max-width:820px;margin:6px auto 0;font-size:13px}'
       . '</style>' . "\n";
}, 99);

// Enlaces legales + aviso de precios al pie de todas las páginas WP (ES o EN según la página).
add_action('wp_footer', function () {
    if (is_admin()) return;
    $en = function_exists('jetcab_is_en') && jetcab_is_en();
    $l = $en
        ? array('Legal', array('Terms & conditions' => 'https://jetcab.mx/terms/', 'Privacy policy' => 'https://jetcab.mx/privacy/', 'Cookie settings' => '#cookie-settings', 'Cancellation policy (Spanish)' => 'https://jetcab.mx/politica-de-cancelacion/'),
            'Reference prices per aircraft, one way, in USD, crew and fuel included. VAT (IVA) not included; overnight crew stays, itinerary changes or special catering are itemized in your quote. Subject to availability.')
        : array('Información legal', array('Términos y condiciones (en inglés)' => 'https://jetcab.mx/terms/', 'Aviso de privacidad' => 'https://jetcab.mx/aviso-de-privacidad/', 'Política de cookies' => 'https://jetcab.mx/politica-de-cookies/', 'Configuración de cookies' => '#cookie-settings', 'Política de cancelación' => 'https://jetcab.mx/politica-de-cancelacion/'),
            'Precios de referencia por aeronave, viaje sencillo, en USD, con tripulación y combustible. No incluyen IVA; pernocta de tripulación, cambios de itinerario o catering especial se detallan en la cotización. Sujetos a disponibilidad.');
    $h = '<div class="jc-legal"><nav aria-label="' . esc_attr($l[0]) . '">';
    foreach ($l[1] as $t => $u) $h .= '<a href="' . esc_url($u) . '">' . esc_html($t) . '</a>';
    echo $h . '</nav><p>' . esc_html($l[2]) . '</p></div>'
       // Tablas con scroll horizontal: alcanzables con teclado (WCAG 2.1.1)
       . '<script id="jc-a11y-js">document.querySelectorAll(".fl-tw,.jct-wrap>table,.jct-wrap").forEach(function(e){if(e.scrollWidth>e.clientWidth+1&&!e.hasAttribute("tabindex")){e.setAttribute("tabindex","0");e.setAttribute("role","region");e.setAttribute("aria-label","Tabla");}});</script>' . "\n";
}, 60);
