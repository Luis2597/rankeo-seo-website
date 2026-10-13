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
add_filter('astra_get_option_footer-copyright-editor', function ($v) {
    return is_string($v) ? str_replace('2025', wp_date('Y'), $v) : $v;
});
