<?php
/* JETCAB — El CDN de GoDaddy obliga a los navegadores a guardar el HTML 31 días (Cache-Control max-age=2678400,
   no se puede cambiar desde WordPress). Cada página lleva su «versión del sitio»; al cargar, consulta
   /jc-version.txt con un parámetro único (el CDN no lo tiene en caché) y, si hay una versión más nueva, recarga
   la página con ?r=<versión>, que el CDN tampoco tiene en caché. Así los visitantes que ya habían entrado ven los
   cambios en su siguiente visita. Versión = última modificación de cualquier página o post + JETCAB_BUILD
   (subir a mano cuando un cambio vive solo en un snippet). Snippet 28. */
if (!defined('JETCAB_BUILD')) define('JETCAB_BUILD', '2026-10-14b');

function jetcab_site_version() {
    static $v = null;
    if ($v === null) $v = substr(md5((string) get_lastpostmodified('gmt', 'any') . '|' . JETCAB_BUILD), 0, 10);
    return $v;
}

add_action('init', function () {
    $p = isset($_SERVER['REQUEST_URI']) ? trim(strtok($_SERVER['REQUEST_URI'], '?'), '/') : '';
    if ($p !== 'jc-version.txt') return;
    status_header(200);
    header('Content-Type: text/plain; charset=utf-8');
    header('Cache-Control: no-store, max-age=0');
    header('X-Robots-Tag: noindex');
    echo jetcab_site_version();
    exit;
}, 0);

add_action('template_redirect', function () {
    if (is_admin() || is_user_logged_in() || is_feed() || wp_doing_ajax()) return;
    $v = jetcab_site_version();
    $js = '<script id="jc-version">(function(){var V="' . $v . '";'
        . 'if(/bot|crawl|spider|lighthouse|headless/i.test(navigator.userAgent)||navigator.webdriver)return;'
        . 'try{var k="jcv:"+location.pathname,lt=+sessionStorage.getItem(k)||0;if(Date.now()-lt<300000)return;}catch(e){}'
        . 'fetch("/jc-version.txt?t="+Date.now(),{cache:"no-store"}).then(function(r){return r.ok?r.text():"";}).then(function(t){t=(t||"").trim();'
        . 'if(!/^[a-f0-9]{10}$/.test(t))return;try{sessionStorage.setItem(k,String(Date.now()));}catch(e){}'
        . 'if(t!==V){var u=new URL(location.href);if(u.searchParams.get("r")===t)return;u.searchParams.set("r",t);location.replace(u.toString());}'
        . '}).catch(function(){});})();</script>';
    ob_start(function ($buf) use ($js) {
        if (stripos($buf, '<html') === false || strpos($buf, 'id="jc-version"') !== false) return $buf;
        $i = stripos($buf, '</head>');
        return $i === false ? $buf : substr($buf, 0, $i) . $js . substr($buf, $i);
    });
}, -10);
