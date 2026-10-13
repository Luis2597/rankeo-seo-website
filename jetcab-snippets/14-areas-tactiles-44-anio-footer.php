<?php
/* JETCAB — áreas táctiles de 44 px en móvil y año vigente en el footer de Astra. Snippet 20. */
add_action('wp_head', function () {
    if (is_admin()) return;
    echo '<style id="jc-touch-44">'
       . '.custom-logo-link{display:inline-flex;align-items:center;min-height:44px}'
       . '.wp-block-button__link.uagb-infobox-cta-link,.uagb-cta__button-link-wrapper{display:inline-flex;align-items:center;justify-content:center;min-height:44px}'
       . 'a.uagb-infobox-cta-link[href="#"]{display:none}'
       . '.ast-builder-social-element{display:inline-flex!important;align-items:center;justify-content:center;min-width:44px;min-height:44px}'
       . '.site-footer .menu-link{display:flex;align-items:center;justify-content:center;min-width:44px;min-height:44px}'
       . '.jc-links-strip a{display:inline-flex;align-items:center;justify-content:center;min-width:44px;min-height:44px}'
       . 'a[href="https://rankeo.agency"]{display:inline-flex;align-items:center;min-height:44px}'
       . '.jc-nav-logo,.fl-logo,.jc-footer-links a,.jc-footer-brand a,.jc-table a{display:inline-flex;align-items:center;min-height:44px}'
       // Con la cabecera del sitio activa, la barra propia de cada página sobra y tapaba el botón del menú móvil.
       . '#masthead ~ #content .jc-nav,#masthead ~ #content .fl-nav,#masthead ~ #content nav.nav{display:none!important}'
       . '#masthead ~ #content .fl-wrap{padding-top:40px}'
       // Tablas anchas de los posts: desplazamiento dentro de la tabla, no de la página.
       // Artículos del blog: Astra pinta la caja del post en blanco y el texto del sitio es blanco; caja oscura de la marca.
       . 'body.single-post .ast-article-single,body.single-post .comments-area,body.single-post .ast-single-related-posts-container{background:#141414!important;color:#E8E8E8}'
       . 'body.single-post .entry-content th,body.single-post .entry-content td{background:transparent;color:#E8E8E8;border-color:rgba(255,255,255,.15)}'
       . 'body.single-post .entry-content a{color:#E85A1E}'
       . '@media(max-width:768px){.entry-content table{display:block;max-width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch}}'
       . '</style>' . "\n";
}, 20);
// Inicio: la portada usaba la foto de 1600 px (342 KB) también en celular; se sirve la variante por tamaño y se precarga.
add_action('wp_head', function () {
    if (!is_front_page()) return;
    $b = 'https://jetcab.mx/wp-content/uploads/2023/03/WhatsApp-Image-2023-03-29-at-17.09.33-1-1';
    echo '<link rel="preload" as="image" href="' . $b . '-768x512.jpeg" media="(max-width:767px)" fetchpriority="high">'
       . '<link rel="preload" as="image" href="' . $b . '-1536x1023.jpeg" media="(min-width:768px)" fetchpriority="high">'
       . '<style id="jc-home-hero">@media(max-width:767px){body .wp-block-uagb-container.uagb-block-18190b82{background-image:url(' . $b . '-768x512.jpeg)!important}}'
       . '@media(min-width:768px){body .wp-block-uagb-container.uagb-block-18190b82{background-image:url(' . $b . '-1536x1023.jpeg)!important}}</style>' . "\n";
}, 1);
// Fuentes de Astra (Karla y Rubik, sí se usan): mismas letras, pero sin bloquear el primer pintado.
add_filter('style_loader_tag', function ($tag, $handle) {
    if ($handle !== 'astra-google-fonts' || is_admin()) return $tag;
    return str_replace("rel='stylesheet'", "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\"", $tag) . '<noscript>' . $tag . '</noscript>';
}, 10, 2);

// Cormorant y Montserrat solo se usan en /cotizar/: fuera de ahí se quita su @import (se descargaban sin usarse).
add_action('template_redirect', function () {
    if (is_admin() || is_page('cotizar')) return;
    ob_start(function ($buf) {
        return preg_replace("#@import url\('https://fonts\.googleapis\.com/css2\?family=Cormorant\+Garamond[^']*'\);?#", '', $buf);
    });
}, 1);

// Botón de llamada ligero (mismo aspecto que el de Call Now Button, sin su script externo de 86 KB).
add_action('wp_footer', function () {
    if (is_admin()) return;
    echo '<a class="jc-call" href="tel:7291081200" aria-label="Llamar a JETCAB"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg></a>'
       . '<style>.jc-call{position:fixed;right:23px;bottom:23px;z-index:2147483646;width:55px;height:55px;border-radius:50%;background:#009900;display:flex;align-items:center;justify-content:center;box-shadow:0 1px 2px rgba(0,0,0,.4)}.jc-call svg{width:28px;height:28px;fill:#fff}.jc-call:hover{filter:brightness(1.08)}</style>' . "\n";
}, 99);
add_filter('astra_get_option_footer-copyright-editor', function ($v) {
    return is_string($v) ? str_replace('2025', wp_date('Y'), $v) : $v;
});
