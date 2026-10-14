<?php
/* JETCAB — el formulario de cotización de /en/ manda copia por correo a fly@jetcab.mx (igual que WPForms en /cotizar/) antes de abrir WhatsApp.
   Guarda además las últimas 100 solicitudes en la opción jetcab_leads_en por si un correo no llega. */
add_action('rest_api_init', function () {
    register_rest_route('jetcab/v1', '/lead', array(
        'methods'             => 'POST',
        'permission_callback' => '__return_true',
        'callback'            => function (WP_REST_Request $req) {
            $p = $req->get_json_params();
            if (!is_array($p)) $p = $req->get_body_params();
            if (!empty($p['website'])) return array('ok' => true); // trampa para bots

            $ip  = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
            $key = 'jc_lead_' . md5($ip);
            $n   = (int) get_transient($key);
            if ($n >= 5) return new WP_REST_Response(array('ok' => false), 429);
            set_transient($key, $n + 1, 10 * MINUTE_IN_SECONDS);

            $f = array();
            foreach (array('name', 'phone', 'origin', 'destination', 'date', 'passengers', 'aircraft', 'page') as $k) {
                $f[$k] = isset($p[$k]) ? mb_substr(sanitize_text_field(wp_unslash($p[$k])), 0, 160) : '';
            }
            if ($f['name'] === '' || $f['phone'] === '') return new WP_REST_Response(array('ok' => false), 400);

            $ruta    = trim(($f['origin'] ?: '—') . ' → ' . ($f['destination'] ?: '—'));
            $subject = 'Nueva cotización (página en inglés): ' . $ruta . ' · ' . $f['name'];
            $body    = "Llegó una solicitud de cotización desde la página en inglés de jetcab.mx.\n"
                     . "El cliente también fue enviado a WhatsApp (+52 729 108 1200) con estos datos.\n\n"
                     . 'Nombre: ' . $f['name'] . "\n"
                     . 'WhatsApp / teléfono: ' . $f['phone'] . "\n"
                     . 'Origen: ' . ($f['origin'] ?: '—') . "\n"
                     . 'Destino: ' . ($f['destination'] ?: '—') . "\n"
                     . 'Fecha: ' . ($f['date'] ?: '—') . "\n"
                     . 'Pasajeros: ' . ($f['passengers'] ?: '—') . "\n"
                     . 'Aeronave: ' . ($f['aircraft'] ?: 'Sin preferencia') . "\n"
                     . 'Página: ' . ($f['page'] ?: home_url('/en/')) . "\n"
                     . 'Fecha de envío: ' . wp_date('d/m/Y H:i') . " (hora de México)\n";
            $headers = array('Content-Type: text/plain; charset=UTF-8', 'From: Jetcab Mexico <fly@jetcab.mx>');
            $sent    = wp_mail('fly@jetcab.mx', $subject, $body, $headers);

            $log = get_option('jetcab_leads_en', array());
            if (!is_array($log)) $log = array();
            array_unshift($log, array_merge($f, array('t' => current_time('mysql'), 'mail' => $sent ? 1 : 0)));
            update_option('jetcab_leads_en', array_slice($log, 0, 100), false);

            return array('ok' => true, 'mail' => (bool) $sent);
        },
    ));
    // Consulta de las solicitudes guardadas (solo administradores).
    register_rest_route('jetcab/v1', '/leads', array(
        'methods'             => 'GET',
        'permission_callback' => function () { return current_user_can('manage_options'); },
        'callback'            => function () {
            $log = get_option('jetcab_leads_en', array());
            return is_array($log) ? $log : array();
        },
    ));
});
