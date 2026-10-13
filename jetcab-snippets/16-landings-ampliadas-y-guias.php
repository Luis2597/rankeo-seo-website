<?php
/* JETCAB — Secciones nuevas en landings (datos que los competidores mejor posicionados sí publican) y bloque
   «Guías relacionadas» que enlaza cada landing con sus posts de apoyo. Un post solo aparece cuando ya está publicado.
   Corre después del snippet 16 (prioridad 25). Reversible: desactivar el snippet. */

function jetcab_guias_map() {
    // id de landing => slugs de posts que la apoyan (plan de 33 posts, oct 2026, más posts previos)
    return array(
        2641 => array('cuanto-cuesta-un-helicoptero-en-mexico', 'cuanto-cuesta-rentar-un-helicoptero-por-hora', 'helicoptero-o-jet-privado'),
        2642 => array('cuanto-cuesta-un-paseo-en-helicoptero-cdmx', 'cuanto-cuesta-rentar-un-helicoptero-por-hora'),
        2951 => array('cuanto-cuesta-una-ambulancia-aerea-en-mexico', 'que-es-el-transporte-sanitario-aereo'),
        2739 => array('que-es-un-vuelo-charter', 'que-es-un-jet-privado-tipos', 'que-es-un-taxi-aereo', 'cuanto-cuesta-jet-privado-mexico'),
        2959 => array('cuanto-cuesta-un-avion-privado-por-hora', 'jet-privado-o-primera-clase', 'cuanto-cuesta-jet-privado-mexico', 'como-pagar-un-vuelo-privado-de-ultima-hora'),
        1770 => array('como-llegar-al-aeropuerto-de-toluca-desde-cdmx', 'aeropuerto-internacional-de-toluca-guia', 'que-es-un-fbo-aviacion-privada', 'como-es-abordar-un-vuelo-privado-en-toluca', 'jet-privado-toluca-vs-aicm'),
        2945 => array('cuantas-personas-caben-en-un-jet-privado', 'light-jet-midsize-o-long-range', 'que-es-un-jet-privado-tipos'),
        2934 => array('light-jet-midsize-o-long-range', 'cuantas-personas-caben-en-un-jet-privado'),
        1720 => array('cuanto-cuesta-un-vuelo-privado-a-los-cabos'),
        1842 => array('cuanto-cuesta-un-vuelo-privado-a-monterrey'),
        1448 => array('vuelo-privado-toluca-acapulco'),
        1708 => array('vuelo-privado-a-las-vegas', 'documentos-para-volar-en-jet-privado-a-estados-unidos'),
        1634 => array('vuelo-privado-cdmx-cancun-tiempo-aeronaves-precio', 'mascotas-en-jet-privado-mexico', 'empty-legs-vuelos-privados-mexico'),
    );
}

function jetcab_guias_html($id) {
    $map = jetcab_guias_map();
    if (empty($map[$id])) return '';
    $items = '';
    foreach ($map[$id] as $slug) {
        $p = get_page_by_path($slug, OBJECT, 'post');
        if (!$p || $p->post_status !== 'publish') continue;
        $items .= '<li><a href="' . esc_url(get_permalink($p)) . '">' . esc_html(get_the_title($p)) . '</a></li>';
    }
    if ($items === '') return '';
    return '<section class="jcr jcg"><div class="jcr-in"><h2>Guías relacionadas</h2><ul class="jcg-list">' . $items . '</ul></div></section>'
         . '<style>.jcg-list{list-style:none;margin:0;padding:0}.jcg-list li{border-bottom:1px solid rgba(255,255,255,.1)}.jcg-list a{display:block;color:#E8E8E8;text-decoration:none;font-size:1.02rem;line-height:1.5;padding:14px 0;min-height:44px}.jcg-list a:hover{color:#C9973F}</style>';
}

function jetcab_tabla_css() {
    static $done = false; if ($done) return ''; $done = true;
    return '<style>.jct{width:100%;border-collapse:collapse;margin:8px 0 36px;font-size:.98rem}.jct th,.jct td{text-align:left;padding:12px 14px;border-bottom:1px solid rgba(255,255,255,.1);vertical-align:top}.jct th{font-family:"Barlow Condensed",Barlow,Arial,sans-serif;letter-spacing:.06em;text-transform:uppercase;color:#C9973F;font-weight:600}.jct td strong{color:#fff}.jct-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch}</style>';
}

function jetcab_helicopteros_extra() {
    $h  = '<section class="jcr" id="tarifas-helicoptero"><div class="jcr-in">';
    $h .= '<h2>¿Cuánto cuesta rentar un helicóptero en la CDMX?</h2>';
    $h .= '<p class="a">La renta de un helicóptero con JETCAB parte de 1,500 USD por hora en Bell 206, monomotor para 4 pasajeros, y de 3,500 USD por hora en AW139, bimotor para 8 pasajeros. El precio es por aeronave completa e incluye piloto, combustible y permisos de operación.</p>';
    $h .= '<div class="jct-wrap"><table class="jct"><thead><tr><th>Helicóptero</th><th>Pasajeros</th><th>Motores</th><th>Tarifa de referencia</th></tr></thead><tbody>';
    $h .= '<tr><td><strong>Bell 206</strong></td><td>4</td><td>Monomotor</td><td>desde 1,500 USD por hora</td></tr>';
    $h .= '<tr><td><strong>AW139</strong></td><td>8, configuración VIP</td><td>Bimotor</td><td>desde 3,500 USD por hora</td></tr>';
    $h .= '</tbody></table></div>';
    $h .= '<p>La cotización final depende del helipuerto de salida, del destino, del tiempo de espera en tierra y de si el helicóptero regresa vacío o espera al pasajero. La recibe cerrada en 30 minutos por WhatsApp, con factura.</p>';
    $h .= '<h2>¿Cuánto tarda un vuelo en helicóptero desde la Ciudad de México?</h2>';
    $h .= '<p>Los trayectos que más se piden son cortos. Ahí el helicóptero gana horas frente al tráfico de la ciudad.</p>';
    $h .= '<div class="jct-wrap"><table class="jct"><thead><tr><th>Trayecto</th><th>Tiempo de vuelo aproximado</th></tr></thead><tbody>';
    $h .= '<tr><td>Aeropuerto de Toluca a helipuertos de Santa Fe o Polanco</td><td>12 a 15 minutos</td></tr>';
    $h .= '<tr><td>Ciudad de México a Valle de Bravo</td><td>25 minutos</td></tr>';
    $h .= '<tr><td>Ciudad de México a Acapulco</td><td>1 hora 20 minutos</td></tr>';
    $h .= '<tr><td>Cuernavaca, Tequesquitengo, Puebla y Querétaro</td><td>bajo cotización según helipuerto</td></tr>';
    $h .= '</tbody></table></div>';
    $h .= '<h2>¿Conviene helicóptero o jet privado?</h2>';
    $h .= '<p>Para moverse dentro de la ciudad o a destinos de menos de una hora, el helicóptero despega y aterriza en helipuertos cercanos a oficinas, hoteles y residencias, y evita el traslado por carretera a Toluca. Cuando el destino supera la hora y media de vuelo, el jet resulta más rápido y por lo general más económico por kilómetro. Un ejemplo: Acapulco son 1 hora 20 minutos en helicóptero y 45 minutos en jet desde Toluca, con vuelo base desde 1,500 USD. También puede combinar los dos: helicóptero de Santa Fe a Toluca y de ahí jet a Cancún, Los Cabos o Estados Unidos.</p>';
    $h .= '<p><a href="https://jetcab.mx/precios-jet-privado/" style="color:#C9973F">Vea las tarifas de jet privado por ruta</a> o <a href="https://jetcab.mx/tour-helicoptero-cdmx/" style="color:#C9973F">el tour en helicóptero por la CDMX</a>.</p>';
    $h .= '</div></section>';
    return $h;
}

function jetcab_aviones_extra() {
    $h  = '<section class="jcr" id="tipos-de-avion-privado"><div class="jcr-in">';
    $h .= '<h2>¿Qué avión privado conviene para su ruta?</h2>';
    $h .= '<p class="a">La renta de un avión privado con JETCAB se cotiza por aeronave completa según la ruta. Un Learjet 35 para 7 pasajeros vuela de Toluca a Guadalajara desde 1,800 USD; un Challenger 605 para 12 va a Cancún desde 6,500 USD; un Gulfstream GV para 16 cruza a Nueva York sin escalas desde 28,000 USD.</p>';
    $h .= '<div class="jct-wrap"><table class="jct"><thead><tr><th>Clase</th><th>Avión</th><th>Pasajeros</th><th>Para qué ruta</th><th>Precio de referencia</th></tr></thead><tbody>';
    $h .= '<tr><td>Light jet</td><td><strong>Learjet 35 / 45</strong></td><td>hasta 7</td><td>Nacional: Guadalajara, Monterrey, Puerto Vallarta, Cancún, Los Cabos</td><td>desde 1,800 USD o 80,000 MXN en ruta corta</td></tr>';
    $h .= '<tr><td>Midsize</td><td><strong>Challenger 605</strong></td><td>hasta 12</td><td>Cancún, Houston, Miami, Los Ángeles, con cabina de pie</td><td>desde 6,500 USD a Cancún</td></tr>';
    $h .= '<tr><td>Long range</td><td><strong>Gulfstream GV</strong></td><td>hasta 16</td><td>Nueva York sin escalas, Europa</td><td>desde 28,000 USD a Nueva York; Europa desde 100,000 USD</td></tr>';
    $h .= '</tbody></table></div>';
    $h .= '<h2>¿Cuánto cuesta rentar un avión privado a Estados Unidos?</h2>';
    $h .= '<div class="jct-wrap"><table class="jct"><thead><tr><th>Destino</th><th>Learjet 35</th><th>Challenger 605</th><th>Gulfstream GV</th><th>Tiempo</th></tr></thead><tbody>';
    $h .= '<tr><td>Houston</td><td>3,800 USD</td><td>7,500 USD</td><td>14,000 USD</td><td>2 h 45 min</td></tr>';
    $h .= '<tr><td>Miami</td><td>4,800 USD</td><td>9,500 USD</td><td>18,000 USD</td><td>3 h 30 min</td></tr>';
    $h .= '<tr><td>Los Ángeles</td><td>5,200 USD</td><td>10,500 USD</td><td>19,000 USD</td><td>3 h 45 min</td></tr>';
    $h .= '<tr><td>Nueva York</td><td>9,500 USD con escala técnica</td><td>18,500 USD</td><td>28,000 USD sin escalas</td><td>5 h 30 min</td></tr>';
    $h .= '</tbody></table></div>';
    $h .= '<p>Los precios son por avión y sencillo, desde Toluca, con tripulación, combustible, catering y permisos. Para Estados Unidos conviene confirmar con unas 24 horas por el aviso de aduana. <a href="https://jetcab.mx/precios-jet-privado/" style="color:#C9973F">Vea todos los precios de jet privado</a> o <a href="https://jetcab.mx/preguntas-frecuentes/" style="color:#C9973F">las preguntas frecuentes</a>.</p>';
    $h .= '</div></section>';
    return $h;
}

add_filter('the_content', function ($content) {
    if (is_admin() || !in_the_loop() || !is_main_query() || !is_page()) return $content;
    $id = get_the_ID();
    $extra = '';
    if ($id == 2641) $extra .= jetcab_tabla_css() . jetcab_helicopteros_extra();
    if ($id == 2739) $extra .= jetcab_tabla_css() . jetcab_aviones_extra();
    $extra .= jetcab_guias_html($id);
    if ($extra === '') return $content;
    $css = function_exists('jetcab_css_bloques') ? jetcab_css_bloques() : '';
    return $content . $css . $extra;
}, 25);

/* Enlaces a posts todavía programados: se muestran como texto hasta que el post se publica, para no dejar 404.
   También activa los «Leer la guía completa» (data-jc-post) de las páginas de preguntas frecuentes. */
function jetcab_post_publicado($slug) {
    static $cache = array();
    if (!isset($cache[$slug])) {
        $p = get_page_by_path($slug, OBJECT, 'post');
        $cache[$slug] = ($p && $p->post_status === 'publish') ? get_permalink($p) : '';
    }
    return $cache[$slug];
}
add_filter('the_content', function ($content) {
    if (is_admin() || !is_singular()) return $content;
    $content = preg_replace_callback('#<span class="jc-more" data-jc-post="([a-z0-9-]+)">([^<]*)</span>#', function ($m) {
        $u = jetcab_post_publicado($m[1]);
        return $u ? '<span class="jc-more"><a href="' . esc_url($u) . '">' . $m[2] . '</a></span>' : '';
    }, $content);
    return preg_replace_callback('#<a href="https://jetcab\.mx/([a-z0-9-]+)/2026/"([^>]*)>(.*?)</a>#s', function ($m) {
        return jetcab_post_publicado($m[1]) ? $m[0] : $m[3];
    }, $content);
}, 30);
