<?php
/* JETCAB — barra de enlaces internos (rastreable) en el footer de las paginas ES
   Instalado como snippet 14 de Code Snippets (scope global). Se omite en /en/, rutas EN, /flota/ y landings. */
add_action('wp_footer', function () {
    if (is_admin()) return;
    $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    if (strpos($uri, '/en/') === 0 || strpos($uri, '/private-jet-') === 0 || strpos($uri, '/flota') === 0 || strpos($uri, '/light-jets') === 0 || strpos($uri, '/long-range') === 0 || strpos($uri, '/vuelos-privados-confidenciales') === 0) return;
    $a = 'style="color:#bdbdbd;text-decoration:none;font-size:14px;line-height:44px"';
    echo '<nav class="jc-links-strip" aria-label="Más de JETCAB" style="background:#0D0D0D;border-top:1px solid rgba(255,255,255,.08);padding:22px 24px;font-family:Barlow,Arial,sans-serif">'
       . '<div style="max-width:1200px;margin:0 auto;display:flex;flex-wrap:wrap;gap:6px 22px;align-items:center;justify-content:center">'
       . '<span style="font-size:11px;letter-spacing:.3em;text-transform:uppercase;color:#E85A1E;font-weight:700">JETCAB</span>'
       . '<a href="https://jetcab.mx/flota/" ' . $a . '>Flota</a>'
       . '<a href="https://jetcab.mx/light-jets-toluca/" ' . $a . '>Light Jets desde Toluca</a>'
       . '<a href="https://jetcab.mx/long-range-jets-toluca/" ' . $a . '>Jets intercontinentales</a>'
       . '<a href="https://jetcab.mx/vuelos-privados-confidenciales/" ' . $a . '>Vuelos confidenciales</a>'
       . '<a href="https://jetcab.mx/vuelos-privados-a-cancun/" ' . $a . '>Cancún</a>'
       . '<a href="https://jetcab.mx/vuelos-privados-a-monterrey/" ' . $a . '>Monterrey</a>'
       . '<a href="https://jetcab.mx/vuelos-privados-a-los-cabos/" ' . $a . '>Los Cabos</a>'
       . '<a href="https://jetcab.mx/cotizar/" ' . $a . '>Cotizar</a>'
       . '<a href="https://jetcab.mx/en/" hreflang="en" ' . $a . '>English</a>'
       . '</div></nav>' . "\n";
}, 50);
