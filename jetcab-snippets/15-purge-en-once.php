<?php
/* JETCAB — una sola vez: borra la copia en caché de /en/ (transient jetcab_en_v3 del WPCode 2893) para que descargue la versión nueva. Snippet 21. */
add_action('init', function () {
    if (get_option('jetcab_en_purge_20261012g') === '1') return;
    delete_transient('jetcab_en_v3');
    update_option('jetcab_en_purge_20261012g', '1');
}, 1);
