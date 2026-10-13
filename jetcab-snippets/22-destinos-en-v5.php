<?php
/* JETCAB — Páginas de destino v5 en inglés y español (21 + 21, una plantilla). El HTML se genera en el repo (jetcab-dest/build.py),
   se publica en Vercel y aquí se sirve en su URL de jetcab.mx con caché de 12 h. Sustituye a las rutas v4 (snippet 8), a las rutas ES
   vuelo-privado-cdmx-* y al contenido de las páginas WP de destino, cuyas URLs se conservan. «Guías relacionadas» se llena en vivo con los
   artículos publicados que enlazan a cada destino. Para refrescar todas: subir JETCAB_DEST_V. Snippet 29. */
if (!defined('JETCAB_DEST_V')) define('JETCAB_DEST_V', '6');

function jetcab_dest_slugs() {
    return array('private-jet-mexico-city-cancun', 'private-jet-mexico-city-los-cabos', 'private-jet-mexico-city-puerto-vallarta', 'private-jet-mexico-city-monterrey',
        'private-jet-mexico-city-guadalajara', 'private-jet-mexico-city-acapulco', 'private-jet-mexico-city-queretaro', 'private-jet-toluca-airport', 'private-jet-mexico-city',
        'private-jet-mexico-city-new-york', 'private-jet-mexico-city-miami', 'private-jet-mexico-city-houston', 'private-jet-mexico-city-los-angeles',
        'private-jet-mexico-city-las-vegas', 'private-jet-mexico-city-san-diego', 'private-jet-mexico-city-tijuana', 'private-jet-mexico-city-mcallen',
        'private-jet-mexico-to-usa', 'private-jet-mexico-city-havana', 'private-jet-mexico-to-spain', 'private-jet-mexico-to-europe');
}
function jetcab_dest_slugs_es() {
    return array('vuelos-privados-a-cancun', 'vuelos-privados-a-los-cabos', 'vuelos-privados-a-puerto-vallarta', 'vuelos-privados-a-monterrey', 'vuelos-privados-a-guadalajara',
        'vuelos-privados-a-acapulco', 'vuelos-privados-a-queretaro-jetcab', 'vuelos-privados-toluca', 'vuelos-privados-a-cdmx', 'vuelo-privado-cdmx-nueva-york',
        'vuelo-privado-cdmx-miami', 'vuelo-privado-cdmx-houston', 'vuelo-privado-cdmx-los-angeles', 'vuelos-privados-a-las-vegas', 'vuelos-privados-a-san-diego',
        'vuelos-privados-a-tijuana', 'vuelos-privados-a-mcallen', 'vuelos-privados-a-estados-unidos', 'vuelos-privados-a-cuba', 'vuelos-privados-a-espana', 'vuelos-privados-a-europa');
}

// Artículos publicados que enlazan a este destino (los posts enlazan a su landing).
function jetcab_dest_guides($url, $es) {
    $key = 'jc_guides_' . md5($url);
    $out = get_transient($key);
    if ($out !== false) return $out;
    global $wpdb;
    $ids = $wpdb->get_col($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE post_type = 'post' AND post_status = 'publish' AND post_content LIKE %s ORDER BY post_date DESC LIMIT 6", '%' . $wpdb->esc_like($url) . '%'));
    $out = '';
    if ($ids) {
        $cards = '';
        foreach ($ids as $id) {
            $cards .= '<a href="' . esc_url(get_permalink($id)) . '"><small>' . ($es ? 'Guía' : 'Guide') . '</small>' . esc_html(get_the_title($id)) . '</a>';
        }
        $out = '<section class="sec" style="padding-bottom:0"><div class="wrap"><p class="k">' . ($es ? 'Del blog' : 'From the blog') . '</p><h2>' . ($es ? 'Guías relacionadas' : 'Related guides') . '</h2><div class="gd">' . $cards . '</div></div></section>';
    }
    set_transient($key, $out, HOUR_IN_SECONDS);
    return $out;
}

add_action('template_redirect', function () {
    $p = isset($_SERVER['REQUEST_URI']) ? trim(strtok($_SERVER['REQUEST_URI'], '?'), '/') : '';
    if ($p === 'vuelos-privados-a-nueva-york') { wp_redirect('https://jetcab.mx/vuelo-privado-cdmx-nueva-york/', 301); exit; } // página duplicada de Nueva York
    $es = in_array($p, jetcab_dest_slugs_es(), true);
    if (!$es && !in_array($p, jetcab_dest_slugs(), true)) return;
    $key = 'jc_dest_' . JETCAB_DEST_V . '_' . md5($p);
    $html = get_transient($key);
    if (!$html) {
        $r = wp_remote_get('https://rankeo.agency/jetcab-dest/' . ($es ? 'es/' : '') . $p . '.html', array('timeout' => 15, 'redirection' => 5));
        $body = is_wp_error($r) ? '' : wp_remote_retrieve_body($r);
        if (wp_remote_retrieve_response_code($r) == 200 && strpos($body, '</html>') !== false && strpos($body, 'https://jetcab.mx/' . $p . '/') !== false) {
            $html = $body;
            set_transient($key, $html, 12 * HOUR_IN_SECONDS);
        }
    }
    if (!$html) return; // sin copia: WordPress sigue con la página que exista
    $html = str_replace('<!--JC_GUIDES-->', jetcab_dest_guides('https://jetcab.mx/' . $p . '/', $es), $html);
    status_header(200);
    header('Content-Type: text/html; charset=utf-8');
    echo $html;
    exit;
}, 0);
