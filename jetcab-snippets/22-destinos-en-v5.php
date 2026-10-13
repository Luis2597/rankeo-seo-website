<?php
/* JETCAB — Páginas de destino en inglés v5 (21 destinos, una plantilla). El HTML se genera en el repo (jetcab-dest/build.py),
   se publica en Vercel y aquí se sirve en su URL de jetcab.mx con caché de 12 h. Sustituye a las rutas v4 (snippet 8) y a las
   páginas WP 2909-2913, cuyas URLs se conservan. Para refrescar todas: subir JETCAB_DEST_V. */
if (!defined('JETCAB_DEST_V')) define('JETCAB_DEST_V', '1');

function jetcab_dest_slugs() {
    return array('private-jet-mexico-city-cancun', 'private-jet-mexico-city-los-cabos', 'private-jet-mexico-city-puerto-vallarta', 'private-jet-mexico-city-monterrey',
        'private-jet-mexico-city-guadalajara', 'private-jet-mexico-city-acapulco', 'private-jet-mexico-city-queretaro', 'private-jet-toluca-airport', 'private-jet-mexico-city',
        'private-jet-mexico-city-new-york', 'private-jet-mexico-city-miami', 'private-jet-mexico-city-houston', 'private-jet-mexico-city-los-angeles',
        'private-jet-mexico-city-las-vegas', 'private-jet-mexico-city-san-diego', 'private-jet-mexico-city-tijuana', 'private-jet-mexico-city-mcallen',
        'private-jet-mexico-to-usa', 'private-jet-mexico-city-havana', 'private-jet-mexico-to-spain', 'private-jet-mexico-to-europe');
}

add_action('template_redirect', function () {
    $p = isset($_SERVER['REQUEST_URI']) ? trim(strtok($_SERVER['REQUEST_URI'], '?'), '/') : '';
    if (!in_array($p, jetcab_dest_slugs(), true)) return;
    $key = 'jc_dest_' . JETCAB_DEST_V . '_' . md5($p);
    $html = get_transient($key);
    if (!$html) {
        $r = wp_remote_get('https://rankeo.agency/jetcab-dest/' . $p . '.html', array('timeout' => 15, 'redirection' => 5));
        $body = is_wp_error($r) ? '' : wp_remote_retrieve_body($r);
        if (wp_remote_retrieve_response_code($r) == 200 && strpos($body, '</html>') !== false && strpos($body, 'https://jetcab.mx/' . $p . '/') !== false) {
            $html = $body;
            set_transient($key, $html, 12 * HOUR_IN_SECONDS);
        }
    }
    if (!$html) return; // sin copia: WordPress sigue con la página que exista
    status_header(200);
    header('Content-Type: text/html; charset=utf-8');
    echo $html;
    exit;
}, 0);
