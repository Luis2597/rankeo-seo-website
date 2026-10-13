<?php
/* JETCAB — una sola vez: borra la copia en caché de /en/ (transient jetcab_en_v3 del WPCode 2893) para que descargue la versión nueva. Snippet 21. */
add_action('init', function () {
    if (get_option('jetcab_en_purge_20261013e') === '1') return;
    delete_transient('jetcab_en_v3');
    // Sin esto WPCode puede seguir sirviendo la copia anterior de /en/ (visto el 13 oct 2026).
    if (function_exists('wpcode') && isset(wpcode()->cache) && method_exists(wpcode()->cache, 'cache_all_loaded_snippets')) wpcode()->cache->cache_all_loaded_snippets();
    update_option('jetcab_en_purge_20261013e', '1');
}, 1);
