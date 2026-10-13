<?php
/* JETCAB — Idioma de las páginas en inglés servidas por WordPress y hreflang de los pares ES/EN. Snippet 22.
   Antes: las rutas EN que son páginas de WP salían con <html lang="es"> y og:locale es_MX. */

function jetcab_path() {
    $p = isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : '';
    return '/' . trim($p, '/') . '/';
}

// Pares ES <-> EN (rutas relativas). x-default apunta a la versión en español (mercado principal).
function jetcab_lang_pairs() {
    return [
        '/vuelos-privados-a-cancun/'          => '/private-jet-mexico-city-cancun/',
        '/vuelos-privados-a-los-cabos/'       => '/private-jet-mexico-city-los-cabos/',
        '/vuelos-privados-a-puerto-vallarta/' => '/private-jet-mexico-city-puerto-vallarta/',
        '/vuelos-privados-a-monterrey/'       => '/private-jet-mexico-city-monterrey/',
        '/vuelos-privados-a-guadalajara/'     => '/private-jet-mexico-city-guadalajara/',
        '/helicopteros-en-renta-cdmx/'        => '/helicopter-charter-mexico-city/',
        '/preguntas-frecuentes/'              => '/private-jet-faq/',
        '/blog/'                              => '/private-jet-guides/',
    ];
}

function jetcab_is_en() {
    static $en = null;
    if ($en !== null) return $en;
    $p = jetcab_path();
    $en = in_array($p, array_values(jetcab_lang_pairs()), true)
        || strpos($p, '/private-jet-mexico-city-') === 0
        || in_array($p, array('/private-jet-destination-guide/', '/private-jet-charter-mexico-guide/'), true)
        || (is_singular('post') && has_category('english'));
    return $en;
}

add_filter('language_attributes', function ($out) {
    return jetcab_is_en() ? preg_replace('/lang="[^"]*"/', 'lang="en-US"', $out) : $out;
}, 99);

add_filter('wpseo_locale', function ($l) { return jetcab_is_en() ? 'en_US' : $l; }, 99);

add_filter('wpseo_schema_graph', function ($graph) {
    if (!jetcab_is_en() || !is_array($graph)) return $graph;
    foreach ($graph as $i => $piece) {
        if (is_array($piece) && isset($piece['inLanguage'])) $graph[$i]['inLanguage'] = 'en-US';
    }
    return $graph;
}, 99);

add_action('wp_head', function () {
    $p = jetcab_path();
    $pairs = jetcab_lang_pairs();
    $es = isset($pairs[$p]) ? $p : array_search($p, $pairs, true);
    if ($es === false) return;
    $en = $pairs[$es];
    echo '<link rel="alternate" hreflang="es-MX" href="https://jetcab.mx' . esc_attr($es) . '">' . "\n";
    echo '<link rel="alternate" hreflang="en" href="https://jetcab.mx' . esc_attr($en) . '">' . "\n";
    echo '<link rel="alternate" hreflang="x-default" href="https://jetcab.mx' . esc_attr($es) . '">' . "\n";
}, 2);
