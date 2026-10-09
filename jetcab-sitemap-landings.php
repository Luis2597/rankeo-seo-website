<?php
/*
 * JETCAB — Sitemap de landings servidas por template_redirect (no las ve Yoast)
 * WPCode: PHP Snippet · Auto Insert · Run Everywhere.
 * Después de activar: Ajustes → Enlaces permanentes → Guardar (flush) y reenviar sitemap_index.xml en Search Console.
 * Expone https://jetcab.mx/jetcab-landings-sitemap.xml y lo añade al índice de Yoast.
 */
add_filter('wpseo_sitemap_index', function ($xml) {
    return $xml . '<sitemap><loc>https://jetcab.mx/jetcab-landings-sitemap.xml</loc><lastmod>' . date('c') . '</lastmod></sitemap>' . "\n";
});
add_action('init', function () {
    add_rewrite_rule('^jetcab-landings-sitemap\.xml$', 'index.php?jetcab_landings_sitemap=1', 'top');
});
add_filter('query_vars', function ($v) { $v[] = 'jetcab_landings_sitemap'; return $v; });
add_action('template_redirect', function () {
    if (!get_query_var('jetcab_landings_sitemap')) return;
    $urls = [
        ['https://jetcab.mx/en/', '0.9'],
        ['https://jetcab.mx/vuelos-privados-confidenciales/', '0.8'],
        ['https://jetcab.mx/light-jets-toluca/', '0.8'],
        ['https://jetcab.mx/long-range-jets-toluca/', '0.8'],
    ];
    foreach (['cancun','los-cabos','puerto-vallarta','monterrey','guadalajara'] as $s) {
        $urls[] = ['https://jetcab.mx/private-jet-mexico-city-' . $s . '/', '0.8'];
        $urls[] = ['https://jetcab.mx/vuelos-privados-a-' . $s . '/', '0.8'];
    }
    foreach (['miami','houston','new-york','los-angeles'] as $s) {
        $urls[] = ['https://jetcab.mx/private-jet-mexico-city-' . $s . '/', '0.8'];
    }
    status_header(200);
    header('Content-Type: application/xml; charset=UTF-8');
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($urls as $u) {
        echo '<url><loc>' . esc_url($u[0]) . '</loc><lastmod>' . date('Y-m-d') . '</lastmod><changefreq>monthly</changefreq><priority>' . $u[1] . '</priority></url>' . "\n";
    }
    echo '</urlset>';
    exit;
});
