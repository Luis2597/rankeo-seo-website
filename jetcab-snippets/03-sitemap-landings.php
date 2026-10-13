<?php
/* JETCAB — Sitemap de landings servidas por template_redirect (Yoast no las ve) + limpieza del índice y robots.txt. Snippet 9.
   Solo lista URLs que Yoast no publica, con hreflang ES/EN. lastmod fijo: se actualiza a mano cuando cambia el contenido. */
if (!defined('JETCAB_LANDINGS_LASTMOD')) define('JETCAB_LANDINGS_LASTMOD', '2026-10-12');

add_filter('wpseo_sitemap_index', function ($xml) {
    return $xml . '<sitemap><loc>https://jetcab.mx/jetcab-landings-sitemap.xml</loc><lastmod>' . JETCAB_LANDINGS_LASTMOD . 'T00:00:00+00:00</lastmod></sitemap>' . "\n";
});

// WooCommerce no se usa: fuera el sitemap de productos (solo contenía un registro interno de estilos).
add_filter('wpseo_sitemap_exclude_post_type', function ($excluded, $post_type) {
    return $post_type === 'product' ? true : $excluded;
}, 10, 2);

// robots.txt: declarar el sitemap (solo aplica si WordPress sirve robots.txt).
add_filter('robots_txt', function ($output, $public) {
    if (strpos($output, 'Sitemap:') === false) {
        $output = rtrim($output) . "\n\nSitemap: https://jetcab.mx/sitemap_index.xml\n";
    }
    return $output;
}, 99, 2);

add_action('init', function () {
    $path = isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : '';
    if (trim($path, '/') !== 'jetcab-landings-sitemap.xml') return;
    // [url, prioridad, alterna en otro idioma, idioma de la url]
    $pairs = [
        ['miami', 'miami'], ['houston', 'houston'], ['new-york', 'nueva-york'], ['los-angeles', 'los-angeles'],
    ];
    $urls = [['https://jetcab.mx/en/', '0.9', 'https://jetcab.mx/', 'en']];
    foreach ($pairs as $p) {
        $en = 'https://jetcab.mx/private-jet-mexico-city-' . $p[0] . '/';
        $es = 'https://jetcab.mx/vuelo-privado-cdmx-' . $p[1] . '/';
        $urls[] = [$en, '0.8', $es, 'en'];
        $urls[] = [$es, '0.8', $en, 'es'];
    }
    status_header(200);
    header('Content-Type: application/xml; charset=UTF-8');
    header('X-Robots-Tag: noindex, follow');
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";
    foreach ($urls as $u) {
        $self = $u[3];
        $other = $self === 'en' ? 'es-MX' : 'en';
        $selfcode = $self === 'en' ? 'en' : 'es-MX';
        echo '<url><loc>' . esc_url($u[0]) . '</loc><lastmod>' . JETCAB_LANDINGS_LASTMOD . '</lastmod><priority>' . $u[1] . '</priority>'
           . '<xhtml:link rel="alternate" hreflang="' . $selfcode . '" href="' . esc_url($u[0]) . '"/>'
           . '<xhtml:link rel="alternate" hreflang="' . $other . '" href="' . esc_url($u[2]) . '"/>'
           . '</url>' . "\n";
    }
    echo '</urlset>';
    exit;
}, 0);
