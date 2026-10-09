/*
 * JETCAB — hreflang recíproco en la home ES (sin esto Google ignora el par ES/EN)
 * WPCode: PHP Snippet · Auto Insert · Run Everywhere.
 */
add_action('wp_head', function () {
    if (!is_front_page()) return;
    echo '<link rel="alternate" hreflang="es" href="https://jetcab.mx/">' . "\n";
    echo '<link rel="alternate" hreflang="en" href="https://jetcab.mx/en/">' . "\n";
    echo '<link rel="alternate" hreflang="x-default" href="https://jetcab.mx/">' . "\n";
}, 1);
