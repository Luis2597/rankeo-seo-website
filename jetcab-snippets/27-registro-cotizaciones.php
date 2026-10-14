<?php
/* JETCAB — Registro de cotizaciones. WPForms Lite no guarda las solicitudes de /cotizar/ (formulario 80), solo las manda por correo;
   aquí se guardan las últimas 300 en la opción jetcab_leads_es. La página «Cotizaciones» del escritorio muestra juntas las de /cotizar/
   y las de /en/ (opción jetcab_leads_en, snippet 32). Snippet 36. */

add_action('wpforms_process_complete', function ($fields, $entry, $form_data, $entry_id) {
    if (empty($form_data['id']) || (int) $form_data['id'] !== 80) return;
    $campos = array();
    foreach ((array) $fields as $f) {
        $n = isset($f['name']) ? trim(wp_strip_all_tags($f['name'])) : '';
        $v = isset($f['value']) ? $f['value'] : '';
        if (is_array($v)) $v = implode(', ', $v);
        $v = trim(wp_strip_all_tags((string) $v));
        if ($n === '' || $v === '') continue;
        $campos[mb_substr($n, 0, 80)] = mb_substr($v, 0, 500);
    }
    $log = get_option('jetcab_leads_es', array());
    if (!is_array($log)) $log = array();
    array_unshift($log, array('t' => current_time('mysql'), 'campos' => $campos));
    update_option('jetcab_leads_es', array_slice($log, 0, 300), false);
}, 10, 4);

add_action('admin_menu', function () {
    add_menu_page('Cotizaciones', 'Cotizaciones', 'manage_options', 'jetcab-cotizaciones', 'jetcab_cotizaciones_page', 'dashicons-email-alt', 3);
});

function jetcab_cotizaciones_rows() {
    $rows = array();
    foreach ((array) get_option('jetcab_leads_es', array()) as $r) {
        if (is_array($r)) $rows[] = array('t' => $r['t'], 'form' => 'Cotizar (español)', 'campos' => (array) $r['campos']);
    }
    $en = array('name' => 'Nombre', 'phone' => 'WhatsApp / teléfono', 'origin' => 'Origen', 'destination' => 'Destino', 'date' => 'Fecha del vuelo',
        'passengers' => 'Pasajeros', 'aircraft' => 'Aeronave', 'page' => 'Página');
    foreach ((array) get_option('jetcab_leads_en', array()) as $r) {
        if (!is_array($r)) continue;
        $c = array();
        foreach ($en as $k => $label) if (!empty($r[$k])) $c[$label] = $r[$k];
        $rows[] = array('t' => $r['t'], 'form' => 'Quote (inglés)', 'campos' => $c);
    }
    usort($rows, function ($a, $b) { return strcmp($b['t'], $a['t']); });
    return $rows;
}

function jetcab_cotizaciones_page() {
    $rows = jetcab_cotizaciones_rows();
    echo '<div class="wrap"><h1>Cotizaciones</h1>';
    echo '<p>Solicitudes de los formularios de <a href="https://jetcab.mx/cotizar/" target="_blank">/cotizar/</a> y de <a href="https://jetcab.mx/en/" target="_blank">/en/</a>. '
       . 'Las de /cotizar/ se guardan desde el 14 de octubre de 2026; las anteriores solo llegaron por correo a fly@jetcab.mx. '
       . 'Los contactos directos por WhatsApp o teléfono no aparecen aquí.</p>';
    if (!$rows) { echo '<p><em>Todavía no hay solicitudes guardadas.</em></p></div>'; return; }
    echo '<table class="widefat striped"><thead><tr><th style="width:150px">Fecha</th><th style="width:140px">Formulario</th><th>Datos</th></tr></thead><tbody>';
    foreach ($rows as $r) {
        $d = '';
        foreach ($r['campos'] as $k => $v) $d .= '<strong>' . esc_html($k) . ':</strong> ' . esc_html($v) . '<br>';
        echo '<tr><td>' . esc_html(mysql2date('d/m/Y H:i', $r['t'])) . '</td><td>' . esc_html($r['form']) . '</td><td>' . $d . '</td></tr>';
    }
    echo '</tbody></table></div>';
}
