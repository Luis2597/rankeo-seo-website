<?php
/* JETCAB — una sola vez: borra la copia en caché de /en/ (transient jetcab_en_v3 del WPCode 2893) para que descargue la versión nueva. Snippet 21. */
add_action('init', function () {
    if (get_option('jetcab_en_purge_20261014d') === '1') return;
    delete_transient('jetcab_en_v3');
    // No llamar aquí a wpcode()->cache->cache_all_loaded_snippets(): en 'init' la lista de WPCode aún está incompleta,
    // la caché queda sin sus snippets PHP y /en/ deja de servirse desde Vercel (pasó el 14 oct 2026).
    update_option('jetcab_en_purge_20261014d', '1');
}, 1);
