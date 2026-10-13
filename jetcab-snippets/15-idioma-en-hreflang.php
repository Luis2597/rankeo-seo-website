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
        '/destinos/'                          => '/private-jet-destination-guide/',
    ];
}

function jetcab_is_en() {
    static $en = null;
    if ($en !== null) return $en;
    $p = jetcab_path();
    $en = in_array($p, array_values(jetcab_lang_pairs()), true)
        || strpos($p, '/private-jet-mexico-city-') === 0
        || in_array($p, array('/private-jet-charter-mexico-guide/', '/privacy/', '/terms/'), true)
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

// Menús en inglés en las páginas EN que usan la cabecera de Astra (blog EN, posts EN): antes mostraban el menú en español.
add_filter('wp_nav_menu_args', function ($args) {
    if (!jetcab_is_en()) return $args;
    $loc = isset($args['theme_location']) ? $args['theme_location'] : '';
    if (in_array($loc, array('primary', 'mobile_menu', 'secondary_menu'), true)) $args['menu'] = 58;  // Main menu EN
    if ($loc === 'footer_menu') $args['menu'] = 59;                                                // Footer menu EN
    return $args;
}, 99);

// Páginas y posts EN: los textos del tema y de WordPress (meta del post, comentarios, navegación, saltar al contenido) en inglés.
add_action('wp', function () {
    if (!is_admin() && jetcab_is_en()) switch_to_locale('en_US');
}, 1);

// Autor y categoría visibles en inglés.
add_filter('the_author', function ($n) { return (!is_admin() && jetcab_is_en()) ? 'JETCAB team' : $n; }, 99);
// Astra arma la categoría con get_the_terms(): en los posts EN se muestra «Private jet guides» y lleva al blog en inglés.
add_filter('get_the_terms', function ($terms, $post_id, $tax) {
    if (is_admin() || $tax !== 'category' || !is_array($terms) || !jetcab_is_en()) return $terms;
    foreach ($terms as $t) {
        if ($t->slug === 'english') { $c = clone $t; $c->name = 'Private jet guides'; return array($c); }
    }
    return $terms;
}, 99, 3);
add_filter('term_link', function ($url, $term) {
    return (!is_admin() && $term->slug === 'english') ? 'https://jetcab.mx/private-jet-guides/' : $url;
}, 99, 2);

// Crédito del pie y etiquetas de los iconos sociales.
add_filter('astra_get_option_footer-copyright-editor', function ($v) {
    return (is_string($v) && jetcab_is_en()) ? str_replace('Sitio Web & SEO por', 'Website & SEO by', $v) : $v;
}, 99);
add_action('wp_footer', function () {
    if (!jetcab_is_en()) return;
    // El crédito del pie y el botón de WhatsApp los pintan otros snippets; se traducen al cargar la página.
    echo '<script>(function(){var m={"Telefono":"Phone","Whats":"WhatsApp","Cotizar por WhatsApp":"Get a quote on WhatsApp"};'
       . 'function t(){document.querySelectorAll("[aria-label]").forEach(function(e){var l=e.getAttribute("aria-label").trim();if(m[l])e.setAttribute("aria-label",m[l]);});'
       . 'var w=document.createTreeWalker(document.body,NodeFilter.SHOW_TEXT),n;while(n=w.nextNode()){if(n.nodeValue.indexOf("Sitio Web & SEO por")>-1)n.nodeValue=n.nodeValue.replace("Sitio Web & SEO por","Website & SEO by");}}'
       . 'if(document.readyState==="complete")t();else window.addEventListener("load",function(){t();setTimeout(t,800);});})();</script>' . "\n";
}, 99);

// «Anterior / siguiente» solo entre artículos del mismo idioma (antes un post EN enlazaba a uno en español y viceversa).
foreach (array('get_previous_post_where', 'get_next_post_where') as $jc_hook) {
    add_filter($jc_hook, function ($where) {
        $t = get_term_by('slug', 'english', 'category');
        if (!$t) return $where;
        global $wpdb;
        $in = jetcab_is_en() ? 'IN' : 'NOT IN';
        return $where . $wpdb->prepare(" AND p.ID $in (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id = %d)", $t->term_taxonomy_id);
    });
}
