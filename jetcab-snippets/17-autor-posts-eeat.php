<?php
/* JETCAB — Autoría de los posts (E-E-A-T) sin datos inventados: el autor es la empresa (Organization),
   con caja de autor visible y fecha de actualización. Cuando el cliente confirme nombre y cargo de una persona
   real (p. ej. José Chávez), se sustituye aquí por un Person. Snippet 24. */

// Article.author -> Organization de JETCAB (definida en el grafo global, snippet 12).
add_filter('wpseo_schema_article', function ($data) {
    if (is_singular('post')) {
        $data['author'] = array('@id' => 'https://jetcab.mx/#organization');
    }
    return $data;
}, 20);

// Quita del grafo el Person genérico del usuario «jetcab».
add_filter('wpseo_schema_graph', function ($graph) {
    if (!is_singular('post') || !is_array($graph)) return $graph;
    return array_values(array_filter($graph, function ($p) {
        return !(is_array($p) && isset($p['@type']) && $p['@type'] === 'Person');
    }));
}, 20);

// Caja de autor y fecha de actualización al final de cada post.
add_filter('the_content', function ($content) {
    if (is_admin() || !is_singular('post') || !in_the_loop() || !is_main_query()) return $content;
    $en = has_category('english');
    $fecha = $en ? get_the_modified_date('F j, Y') : date_i18n('j \d\e F \d\e Y', get_the_modified_time('U'));
    $txt = $en
        ? '<strong>JETCAB operations team.</strong> Private jet and helicopter charter operator flying from Toluca International Airport since 1999 under Mexican civil aviation authority (AFAC) authorization. Prices and flight times in this guide come from JETCAB quotes. Last updated: ' . esc_html($fecha) . '.'
        : '<strong>Equipo de operaciones de JETCAB.</strong> Operador de jets privados y helicópteros desde el Aeropuerto Internacional de Toluca desde 1999, con permiso de la AFAC. Los precios y tiempos de esta guía salen de cotizaciones reales de JETCAB. Actualizado: ' . esc_html($fecha) . '.';
    $cta = $en ? '<a href="https://jetcab.mx/cotizar/">Request a quote</a>' : '<a href="https://jetcab.mx/cotizar/">Cotizar un vuelo</a>';
    return $content . '<aside class="jc-autor" style="border-top:1px solid rgba(128,128,128,.3);margin-top:40px;padding-top:20px;font-size:.95rem;line-height:1.6">' . $txt . ' ' . $cta . '</aside>';
}, 40);
