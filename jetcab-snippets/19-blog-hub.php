<?php
/* JETCAB — Página índice del blog (/blog/ y /en/guides/ vía shortcode [jetcab_blog lang="es|en"]).
   Agrupa los artículos por la landing que apoyan (método Andrés Agudelo): cada grupo enlaza a su landing con la
   keyword principal como anchor y nombra las búsquedas secundarias. Artículos publicados con enlace; programados
   con su fecha, sin enlace. Snippet 26. */

function jetcab_blog_grupos($lang) {
    if ($lang === 'en') return array(
        array('h' => 'Private jet prices and planning', 'url' => 'https://jetcab.mx/en/', 'a' => 'private jet charter in Mexico', 'kw' => array('how much does a private jet cost', 'average cost of a private jet', 'is it cheaper to fly first class or private', 'can you fly a private plane from the US to Mexico'),
              'p' => array('how-much-does-a-private-jet-cost-mexico', 'how-much-is-a-2-hour-private-jet-flight', 'private-jet-vs-first-class', 'can-you-fly-a-private-plane-from-the-us-to-mexico', 'do-you-go-through-security-on-a-private-jet', 'empty-leg-flights-mexico', 'toluca-vs-mexico-city-airport-private-jet')),
        array('h' => 'Routes from Mexico City', 'url' => 'https://jetcab.mx/private-jet-mexico-city-cancun/', 'a' => 'private jet from Mexico City to Cancún', 'kw' => array('private jet to cancun', 'private jet to cabo', 'private jet charter miami'),
              'p' => array('private-jet-to-cancun-cost', 'how-much-is-a-private-jet-to-cabo', 'private-jet-charter-miami-mexico-city')),
        array('h' => 'Helicopter charter', 'url' => 'https://jetcab.mx/helicopter-charter-mexico-city/', 'a' => 'helicopter charter in Mexico City', 'kw' => array('helicopter charter', 'private helicopter charter', 'how much is it to hire a helicopter'),
              'p' => array('helicopter-charter-mexico-city-cost')),
    );
    return array(
        array('h' => 'Precios de jet privado', 'url' => 'https://jetcab.mx/precios-jet-privado/', 'a' => 'precios de jet privado', 'kw' => array('cuánto cuesta un avión privado', 'cuánto cuesta un jet privado en México', 'cuánto cuesta una hora de jet privado', 'precio de un avión privado'),
              'p' => array('cuanto-cuesta-un-avion-privado-por-hora', 'cuanto-cuesta-jet-privado-mexico', 'jet-privado-o-primera-clase', 'como-pagar-un-vuelo-privado-de-ultima-hora')),
        array('h' => 'Renta de avión privado', 'url' => 'https://jetcab.mx/renta-de-aviones-privados/', 'a' => 'renta de avión privado', 'kw' => array('qué es un vuelo chárter', 'chárter avión', 'qué es un jet privado', 'qué es un taxi aéreo'),
              'p' => array('que-es-un-vuelo-charter', 'que-es-un-jet-privado-tipos', 'que-es-un-taxi-aereo')),
        array('h' => 'Flota y tipos de jet', 'url' => 'https://jetcab.mx/flota/', 'a' => 'flota de jets privados', 'kw' => array('cuántas personas caben en un jet privado', 'tipos de jets privados', 'light jet, midsize o long range'),
              'p' => array('cuantas-personas-caben-en-un-jet-privado', 'light-jet-midsize-o-long-range')),
        array('h' => 'Vuelos privados desde Toluca', 'url' => 'https://jetcab.mx/vuelos-privados-toluca/', 'a' => 'vuelos privados desde Toluca', 'kw' => array('cómo llegar al aeropuerto de Toluca', 'cómo se llama el aeropuerto de Toluca', 'qué es un FBO', 'jet privado Toluca'),
              'p' => array('como-llegar-al-aeropuerto-de-toluca-desde-cdmx', 'aeropuerto-internacional-de-toluca-guia', 'que-es-un-fbo-aviacion-privada', 'como-es-abordar-un-vuelo-privado-en-toluca', 'jet-privado-toluca-vs-aicm')),
        array('h' => 'Rutas nacionales', 'url' => 'https://jetcab.mx/vuelos-privados-a-cancun/', 'a' => 'vuelos privados a Cancún', 'kw' => array('vuelo privado a Cancún', 'vuelo privado a Los Cabos', 'vuelo privado a Monterrey', 'vuelo Toluca Acapulco'),
              'p' => array('vuelo-privado-cdmx-cancun-tiempo-aeronaves-precio', 'cuanto-cuesta-un-vuelo-privado-a-los-cabos', 'cuanto-cuesta-un-vuelo-privado-a-monterrey', 'vuelo-privado-toluca-acapulco', 'mascotas-en-jet-privado-mexico', 'empty-legs-vuelos-privados-mexico')),
        array('h' => 'Vuelos privados a Estados Unidos', 'url' => 'https://jetcab.mx/vuelo-privado-cdmx-miami/', 'a' => 'vuelo privado de la CDMX a Miami', 'kw' => array('jet privado a Miami', 'jet privado a Houston', 'jet privado a Nueva York', 'vuelo privado a Las Vegas'),
              'p' => array('cuanto-cuesta-un-jet-privado-a-miami-houston-nueva-york', 'vuelo-privado-a-las-vegas', 'documentos-para-volar-en-jet-privado-a-estados-unidos')),
        array('h' => 'Ambulancia aérea', 'url' => 'https://jetcab.mx/flota/ambulancia-aerea/', 'a' => 'ambulancia aérea en México', 'kw' => array('cuánto cuesta una ambulancia aérea', 'transporte sanitario aéreo'),
              'p' => array('cuanto-cuesta-una-ambulancia-aerea-en-mexico', 'que-es-el-transporte-sanitario-aereo')),
        array('h' => 'Helicópteros', 'url' => 'https://jetcab.mx/helicopteros-en-renta-cdmx/', 'a' => 'renta de helicópteros en la CDMX', 'kw' => array('cuánto cuesta un helicóptero en México', 'cuánto cuesta rentar un helicóptero por hora', 'paseo en helicóptero CDMX', 'helicóptero o jet privado'),
              'p' => array('cuanto-cuesta-un-helicoptero-en-mexico', 'cuanto-cuesta-rentar-un-helicoptero-por-hora', 'cuanto-cuesta-un-paseo-en-helicoptero-cdmx', 'helicoptero-o-jet-privado')),
    );
}

add_shortcode('jetcab_blog', function ($atts) {
    $lang = (isset($atts['lang']) && $atts['lang'] === 'en') ? 'en' : 'es';
    $soon = $lang === 'en' ? 'Publishes on' : 'Se publica el';
    $guide = $lang === 'en' ? 'Main page:' : 'Página de servicio:';
    $also = $lang === 'en' ? 'Searches this section answers:' : 'Búsquedas que responde esta sección:';
    $h = '<div class="jcb">';
    foreach (jetcab_blog_grupos($lang) as $g) {
        $items = '';
        foreach ($g['p'] as $slug) {
            $q = get_posts(array('name' => $slug, 'post_type' => 'post', 'post_status' => array('publish', 'future'), 'numberposts' => 1));
            if (!$q) continue;
            $p = $q[0];
            if ($p->post_status === 'publish') {
                $items .= '<li><a href="' . esc_url(get_permalink($p)) . '">' . esc_html(get_the_title($p)) . '</a></li>';
            } else {
                $d = $lang === 'en' ? get_the_date('F j', $p) : date_i18n('j \d\e F', get_post_time('U', false, $p));
                $items .= '<li class="jcb-soon">' . esc_html(get_the_title($p)) . ' <span>' . $soon . ' ' . esc_html($d) . '</span></li>';
            }
        }
        if ($items === '') continue;
        $h .= '<section class="jcb-g"><h2>' . esc_html($g['h']) . '</h2>';
        $h .= '<p class="jcb-l">' . $guide . ' <a href="' . esc_url($g['url']) . '">' . esc_html($g['a']) . '</a></p>';
        $h .= '<p class="jcb-k">' . $also . ' ' . esc_html(implode(' · ', $g['kw'])) . '</p>';
        $h .= '<ul>' . $items . '</ul></section>';
    }
    $h .= '</div><style>.jcb-g{border-top:1px solid rgba(128,128,128,.25);padding:28px 0}.jcb-g h2{margin:0 0 8px}.jcb-l{margin:0 0 6px;font-weight:600}.jcb-k{margin:0 0 14px;font-size:.92rem;opacity:.75}.jcb ul{margin:0;padding-left:18px}.jcb li{margin:8px 0;line-height:1.5}.jcb li a{display:inline-block;min-height:24px}.jcb-soon{opacity:.6}.jcb-soon span{font-size:.85rem}</style>';
    return $h;
});
