<?php
/* JETCAB — sirve /en/ con el HTML de jetcab-en.html publicado en Vercel (rankeo.agency/jetcab-en). Snippet 37.
   Antes lo hacía WPCode 2893, pero WPCode dejó de ejecutar sus PHP el 14 oct 2026 y /en/ caía al tema con el título en español.
   Prioridad 11: después del ob_start de GA4 (snippet 18, prioridad 10), que inyecta la etiqueta en el HTML.
   Misma caché que usaba WPCode (transient jetcab_en_v3, 300 s), así que el snippet 21 sigue sirviendo para purgar. */
add_action('template_redirect', function () {
    $uri = isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : '';
    if ($uri !== '/en/' && $uri !== '/en') return;
    $h = get_transient('jetcab_en_v3');
    if (!$h) {
        $r = wp_remote_get('https://rankeo.agency/jetcab-en', array('timeout' => 20));
        $h = (!is_wp_error($r) && wp_remote_retrieve_response_code($r) === 200) ? wp_remote_retrieve_body($r) : '';
        // Si Vercel falla, se deja que WordPress muestre la página 2895 en vez de una página en blanco
        if (stripos($h, '</html>') === false) return;
        set_transient('jetcab_en_v3', $h, 300);
    }
    echo $h;
    exit;
}, 11);
