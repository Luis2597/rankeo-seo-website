/*
 * JETCAB — Desactivar Google AdSense en todo el sitio
 * WPCode: PHP Snippet · Auto Insert · Run Everywhere · prioridad 1.
 * Cubre: Site Kit (AdSense module), Auto Ads insertados por tema/plugins, bloques <ins class="adsbygoogle">
 * y cualquier iframe de anuncio que llegue a renderizarse. Complemento: en Site Kit → AdSense → desconectar,
 * y en la cuenta de AdSense → Sitios → jetcab.mx → desactivar Auto Ads.
 */

// 1. Site Kit: bloquea la etiqueta de AdSense (filtro oficial del módulo)
add_filter('googlesitekit_adsense_tag_blocked', '__return_true');
add_filter('googlesitekit_adsense_tag_amp_blocked', '__return_true');

// 2. Neutraliza la cola de adsbygoogle antes de que cargue cualquier script
add_action('wp_head', function () {
    echo "<script>window.adsbygoogle=window.adsbygoogle||[];window.adsbygoogle.push=function(){};window.adsbygoogle.loaded=true;</script>\n";
    echo "<style>ins.adsbygoogle,.adsbygoogle,.google-auto-placed,iframe[id^=\"aswift\"],iframe[id^=\"google_ads\"],#google_esf,div[id^=\"div-gpt-ad\"]{display:none!important;height:0!important;max-height:0!important;overflow:hidden!important}</style>\n";
}, 0);

// 3. Limpia el HTML de salida: scripts adsbygoogle, bloques <ins> y meta google-adsense-account
add_action('template_redirect', function () {
    if (is_admin() || wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) return;
    ob_start(function ($html) {
        $html = preg_replace('#<script[^>]+pagead2\.googlesyndication\.com[^>]*>\s*</script>#i', '', $html);
        $html = preg_replace('#<script[^>]*>\s*\(adsbygoogle\s*=\s*window\.adsbygoogle\s*\|\|\s*\[\]\)\.push\(\{[^}]*\}\);?\s*</script>#i', '', $html);
        $html = preg_replace('#<ins[^>]+class="[^"]*adsbygoogle[^"]*"[^>]*>.*?</ins>#is', '', $html);
        $html = preg_replace('#<meta[^>]+name="google-adsense-account"[^>]*>#i', '', $html);
        return $html;
    });
});

// 4. Red de seguridad en el navegador: elimina anuncios inyectados tras la carga
add_action('wp_footer', function () {
    echo "<script>(function(){function k(){document.querySelectorAll('ins.adsbygoogle,.google-auto-placed,iframe[id^=\"aswift\"],#google_esf,script[src*=\"pagead2.googlesyndication.com\"]').forEach(function(e){e.remove();});}k();new MutationObserver(k).observe(document.documentElement,{childList:true,subtree:true});})();</script>\n";
}, 99);
