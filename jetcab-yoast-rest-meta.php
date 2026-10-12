<?php
/*
 * JETCAB — Exponer título y meta description de Yoast en la REST API
 * WPCode: PHP Snippet · Auto Insert · Run Everywhere.
 * Permite fijar _yoast_wpseo_title y _yoast_wpseo_metadesc por página vía
 * POST /wp-json/wp/v2/pages/{id} con {"meta":{"_yoast_wpseo_title":"...","_yoast_wpseo_metadesc":"..."}}
 * (solo usuarios con permiso de edición; el Application Password de "jetcab" lo tiene).
 */
add_action('init', function () {
    foreach (['_yoast_wpseo_title', '_yoast_wpseo_metadesc', '_yoast_wpseo_opengraph-title', '_yoast_wpseo_opengraph-description'] as $key) {
        register_post_meta('page', $key, [
            'show_in_rest'  => true,
            'single'        => true,
            'type'          => 'string',
            'auth_callback' => function () { return current_user_can('edit_pages'); },
        ]);
        register_post_meta('post', $key, [
            'show_in_rest'  => true,
            'single'        => true,
            'type'          => 'string',
            'auth_callback' => function () { return current_user_can('edit_posts'); },
        ]);
    }
}, 20);
