<?php
/* JETCAB — una sola vez: añade «Sitemap:» al robots.txt estático de 2023 (WordPress no lo genera, es un archivo).
   Guarda copia del original en wp-content/robots-2023-original.txt. Se desactiva tras ejecutarse. Snippet 25. */
add_action('init', function () {
    if (get_option('jetcab_robots_sitemap_20261012') === '1') return;
    update_option('jetcab_robots_sitemap_20261012', '1', false);
    $f = ABSPATH . 'robots.txt';
    if (!file_exists($f) || !is_writable($f)) { update_option('jetcab_robots_result', 'no escribible'); return; }
    $c = file_get_contents($f);
    if (strpos($c, 'Sitemap:') !== false) { update_option('jetcab_robots_result', 'ya tenía sitemap'); return; }
    @copy($f, WP_CONTENT_DIR . '/robots-2023-original.txt');
    $ok = file_put_contents($f, rtrim($c) . "\n\nSitemap: https://jetcab.mx/sitemap_index.xml\n");
    update_option('jetcab_robots_result', $ok ? 'actualizado' : 'falló escritura');
}, 1);
