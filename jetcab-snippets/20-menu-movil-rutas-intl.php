<?php
/* JETCAB — Menú móvil para las rutas internacionales que no pasan por el tema (ES: /vuelo-privado-cdmx-*, WPCode 2901;
   EN: /private-jet-mexico-city-{miami,houston,new-york,los-angeles}/, snippet 8). En teléfono solo mostraban el logo.
   Se inyecta por búfer antes de </body>, con los mismos enlaces del menú principal de cada idioma. Snippet 27. */
add_action('template_redirect', function () {
    $p = isset($_SERVER['REQUEST_URI']) ? '/' . trim(strtok($_SERVER['REQUEST_URI'], '?'), '/') . '/' : '';
    $es = strpos($p, '/vuelo-privado-cdmx-') === 0;
    $en = (bool) preg_match('#^/private-jet-mexico-city-(miami|houston|new-york|los-angeles)/$#', $p);
    if (!$es && !$en) return;
    $items = $en
        ? array(array('Home', 'https://jetcab.mx/en/'), array('Fleet', 'https://jetcab.mx/en/#fleet'), array('Destinations & prices', 'https://jetcab.mx/private-jet-destination-guide/'), array('Blog', 'https://jetcab.mx/private-jet-guides/'), array('FAQ', 'https://jetcab.mx/private-jet-faq/'), array('Get a quote', 'https://jetcab.mx/en/#contact'))
        : array(array('Inicio', 'https://jetcab.mx/'), array('Nuestra flota', 'https://jetcab.mx/flota/'), array('Precios', 'https://jetcab.mx/precios-jet-privado/'), array('Destinos', 'https://jetcab.mx/destinos/'), array('Blog', 'https://jetcab.mx/blog/'), array('Sobre nosotros', 'https://jetcab.mx/sobre-nosotros/'), array('Cotizar', 'https://jetcab.mx/cotizar/'));
    $label = $en ? 'Open menu' : 'Abrir menú';
    $close = $en ? 'Close menu' : 'Cerrar menú';
    $links = '';
    foreach ($items as $it) $links .= '<a href="' . esc_url($it[1]) . '">' . esc_html($it[0]) . '</a>';
    $html = '<style>.jcm-btn{display:none}@media(max-width:768px){.jcm-btn{display:flex;position:fixed;top:10px;right:12px;z-index:9999;width:44px;height:44px;align-items:center;justify-content:center;background:#E85A1E;border:0;border-radius:6px;cursor:pointer}'
          . '.jcm-btn span,.jcm-btn span:before,.jcm-btn span:after{display:block;width:20px;height:2px;background:#fff;position:relative;content:""}.jcm-btn span:before{position:absolute;top:-6px}.jcm-btn span:after{position:absolute;top:6px}}'
          . '.jcm-drawer{position:fixed;inset:0;z-index:10000;background:#0D0D0D;display:flex;flex-direction:column;padding:72px 28px 28px;transform:translateX(100%);visibility:hidden;transition:transform .3s ease,visibility 0s linear .3s}'
          . '.jcm-drawer.open{transform:none;visibility:visible;transition:transform .3s ease}'
          . '.jcm-drawer a{color:#fff;text-decoration:none;font-family:"Barlow Condensed",Barlow,Arial,sans-serif;font-size:20px;letter-spacing:.08em;text-transform:uppercase;padding:14px 0;border-bottom:1px solid rgba(255,255,255,.12);min-height:44px}'
          . '.jcm-x{position:absolute;top:10px;right:12px;width:44px;height:44px;background:none;border:0;color:#fff;font-size:28px;cursor:pointer}</style>'
          . '<button class="jcm-btn" type="button" aria-label="' . esc_attr($label) . '" aria-controls="jcm-drawer" aria-expanded="false"><span></span></button>'
          . '<nav class="jcm-drawer" id="jcm-drawer" aria-label="Menu"><button class="jcm-x" type="button" aria-label="' . esc_attr($close) . '">&times;</button>' . $links . '</nav>'
          . '<script>(function(){var b=document.querySelector(".jcm-btn"),d=document.getElementById("jcm-drawer"),x=d.querySelector(".jcm-x");'
          . 'function o(){d.classList.add("open");b.setAttribute("aria-expanded","true");document.body.style.overflow="hidden";}'
          . 'function c(){d.classList.remove("open");b.setAttribute("aria-expanded","false");document.body.style.overflow="";}'
          . 'b.addEventListener("click",o);x.addEventListener("click",c);d.querySelectorAll("a").forEach(function(a){a.addEventListener("click",c);});})();</script>';
    ob_start(function ($buf) use ($html) {
        $buf = str_replace('https://jetcab.mx/#flota', 'https://jetcab.mx/flota/', $buf);
        $i = strripos($buf, '</body>');
        return $i === false ? $buf . $html : substr($buf, 0, $i) . $html . substr($buf, $i);
    });
}, 0);
