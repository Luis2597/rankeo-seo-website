<?php
/* JETCAB — sirve la clave de IndexNow en /<key>.txt (snippet 15). La clave real vive en el snippet instalado.
   El bloque send_headers con Cache-Control de 1 h NO surte efecto: el gateway de GoDaddy/Cloudflare lo sobrescribe (max-age=2678400). */
add_action('init', function () {
    $key = 'CLAVE_INDEXNOW';
    $uri = isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : '';
    if ($uri === '/' . $key . '.txt') {
        header('Content-Type: text/plain; charset=utf-8');
        echo $key;
        exit;
    }
}, 0);
