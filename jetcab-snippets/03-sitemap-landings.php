/* JETCAB — Sitemap de landings servidas por template_redirect (Yoast no las ve); se añade al índice de Yoast */
add_filter('wpseo_sitemap_index', function ($xml) {
    return $xml . '<sitemap><loc>https://jetcab.mx/jetcab-landings-sitemap.xml</loc><lastmod>' . date('c') . '</lastmod></sitemap>' . "\n";
});
add_action('init', function () {
    $path = isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : '';
    if (trim($path, '/') !== 'jetcab-landings-sitemap.xml') return;
    $urls = [
        ['https://jetcab.mx/en/', '0.9'],
        ['https://jetcab.mx/flota/', '0.8'],
        ['https://jetcab.mx/vuelos-privados-confidenciales/', '0.8'],
        ['https://jetcab.mx/light-jets-toluca/', '0.8'],
        ['https://jetcab.mx/long-range-jets-toluca/', '0.8'],
    ];
    foreach (['learjet-35','challenger-605','gulfstream-gv','helicoptero-bell-206','helicoptero-aw139','ambulancia-aerea'] as $s) {
        $urls[] = ['https://jetcab.mx/flota/' . $s . '/', '0.7'];
    }
    foreach (['cancun','los-cabos','puerto-vallarta','monterrey','guadalajara','miami','houston','new-york','los-angeles'] as $s) {
        $urls[] = ['https://jetcab.mx/private-jet-mexico-city-' . $s . '/', '0.8'];
    }
    status_header(200);
    nocache_headers();
    header('Content-Type: application/xml; charset=UTF-8');
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($urls as $u) {
        echo '<url><loc>' . esc_url($u[0]) . '</loc><lastmod>' . date('Y-m-d') . '</lastmod><changefreq>monthly</changefreq><priority>' . $u[1] . '</priority></url>' . "\n";
    }
    echo '</urlset>';
    exit;
}, 0);
