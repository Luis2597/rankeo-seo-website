<?php
/* JETCAB — 301 de URLs rotas tipo /<página>/jetcab.mx/cotizar (oct 2026). Snippet 34.
   Venían de botones con href relativo "jecab.mx/cotizar" / "jetcab.mx/cotizar" (ya corregidos); Search Console las reportaba como 404. */
add_action('template_redirect', function () {
    if (!is_404()) return;
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
    if ($path && preg_match('#/(?:www\.)?je?t?cab\.mx/cotizar/?$#i', $path)) {
        wp_redirect('https://jetcab.mx/cotizar/', 301);
        exit;
    }
}, 1);
