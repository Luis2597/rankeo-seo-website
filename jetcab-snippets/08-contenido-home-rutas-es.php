<?php
/* JETCAB — contenido SEO/AEO añadido al final del home (página 355) y cápsulas de respuesta en las rutas ES.
   Instalado como snippet 16 de Code Snippets. Reversible: desactivar el snippet. */
function jetcab_css_bloques() {
    static $done = false; if ($done) return ''; $done = true;
    return '<style>
.jch,.jcr{background:#0D0D0D;color:#E8E8E8;font-family:Barlow,Arial,sans-serif;padding:72px 24px;border-top:1px solid rgba(255,255,255,.07)}
.jch-in,.jcr-in{max-width:960px;margin:0 auto}
.jch h2,.jcr h2{font-family:"Barlow Condensed",Barlow,Arial,sans-serif;font-size:clamp(1.9rem,4vw,3rem);font-weight:700;text-transform:uppercase;color:#E85A1E;line-height:1.1;margin:0 0 18px}
.jch h3,.jcr h3{font-family:"Barlow Condensed",Barlow,Arial,sans-serif;font-size:1.2rem;font-weight:600;color:#fff;margin:0 0 8px;text-transform:none}
.jch p,.jcr p{font-size:1.02rem;line-height:1.75;color:#E8E8E8;margin:0 0 16px}
.jch .a,.jcr .a{font-size:1.18rem;line-height:1.65;color:#fff;border-left:1px solid #C9973F;padding-left:20px;margin-bottom:28px}
.jch .k{font-family:"Barlow Condensed",Barlow,Arial,sans-serif;font-size:.8rem;letter-spacing:.2em;text-transform:uppercase;color:#C9973F;margin:0 0 10px}
.jch-grid{display:grid;grid-template-columns:1fr;gap:14px;margin:8px 0 48px}
@media(min-width:720px){.jch-grid{grid-template-columns:repeat(3,1fr)}}
.jch-step{background:#141414;border-top:1px solid #E85A1E;padding:22px 20px}
.jch-step .n{font-family:"Barlow Condensed",Barlow,Arial,sans-serif;font-size:2.2rem;font-weight:800;color:#C9973F;line-height:1;margin-bottom:8px}
.jch-step p{font-size:.95rem;color:#bdbdbd;margin:0}
.jch-rates{display:grid;grid-template-columns:minmax(0,1fr);gap:10px;margin:8px 0 48px}
@media(min-width:640px){.jch-rates{grid-template-columns:repeat(2,minmax(0,1fr))}}
.jch-rate{display:flex;flex-wrap:wrap;justify-content:space-between;align-items:center;gap:4px 12px;min-width:0;background:#141414;border-left:1px solid #E85A1E;padding:16px 20px;text-decoration:none;color:#fff;transition:background .2s}
.jch-rate:hover{background:#1b1b1b}
.jch-rate .r{font-family:"Barlow Condensed",Barlow,Arial,sans-serif;font-size:1.1rem;font-weight:600;letter-spacing:.03em}
.jch-rate .r small{display:block;font-family:Barlow,Arial,sans-serif;font-size:.8rem;color:#888;font-weight:400;letter-spacing:0}
.jch-rate .r{min-width:0}
.jch-rate .p{font-family:"Barlow Condensed",Barlow,Arial,sans-serif;font-size:1.3rem;font-weight:800;color:#C9973F}
.jc-faqv{margin:0 0 40px}
.jc-faqv div{border-bottom:1px solid rgba(255,255,255,.1);padding:18px 0}
.jc-faqv div:first-child{border-top:1px solid rgba(255,255,255,.1)}
.jc-faqv p{font-size:.95rem;color:#a9a9a9;margin:0}
.jch-cta,.jcr-cta{display:inline-block;background:#E85A1E;color:#fff!important;font-family:"Barlow Condensed",Barlow,Arial,sans-serif;font-size:.95rem;letter-spacing:.1em;text-transform:uppercase;padding:14px 32px;border-radius:50px;text-decoration:none;line-height:1.2;min-height:44px}
.jch-cta:hover,.jcr-cta:hover{background:#ff6a2f}
.jcr-links{display:flex;flex-wrap:wrap;gap:8px 22px;margin-top:22px}
.jcr-links a{color:#C9973F;text-decoration:none;font-size:.95rem;line-height:44px}
.jcr-links a:hover{color:#fff}
</style>';
}
function jetcab_faq_html($faq) {
    $h = '<div class="jc-faqv">';
    foreach ($faq as $q => $a) $h .= '<div><h3>' . esc_html($q) . '</h3><p>' . esc_html($a) . '</p></div>';
    return $h . '</div>';
}
function jetcab_faq_ld($faq) {
    $items = array();
    foreach ($faq as $q => $a) $items[] = array('@type' => 'Question', 'name' => $q, 'acceptedAnswer' => array('@type' => 'Answer', 'text' => $a));
    return '<script type="application/ld+json">' . wp_json_encode(array('@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $items), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
}
function jetcab_rutas_es_data() {
    return array(
        1634 => array('d' => 'Cancún', 'iata' => 'CUN', 't' => '2 h 15 min', 'ac' => 'Learjet 35', 'pax' => 7, 'p' => '$3,200 USD', 'en' => 'https://jetcab.mx/private-jet-mexico-city-cancun/', 'arr' => 'la terminal de aviación general de Cancún, a 15 minutos de la Zona Hotelera'),
        1842 => array('d' => 'Monterrey', 'iata' => 'MTY', 't' => '1 h 15 min', 'ac' => 'Learjet 35', 'pax' => 7, 'p' => '$2,200 USD', 'en' => 'https://jetcab.mx/private-jet-mexico-city-monterrey/', 'arr' => 'la terminal privada de Monterrey, a 20 minutos de San Pedro Garza García'),
        1706 => array('d' => 'Guadalajara', 'iata' => 'GDL', 't' => '50 min', 'ac' => 'Learjet 35', 'pax' => 7, 'p' => '$1,800 USD', 'en' => 'https://jetcab.mx/private-jet-mexico-city-guadalajara/', 'arr' => 'la terminal privada de Guadalajara, a 15 minutos de Zapopan'),
        1769 => array('d' => 'Puerto Vallarta', 'iata' => 'PVR', 't' => '1 h 45 min', 'ac' => 'Learjet 35', 'pax' => 7, 'p' => '$3,000 USD', 'en' => 'https://jetcab.mx/private-jet-mexico-city-puerto-vallarta/', 'arr' => 'la terminal privada de Puerto Vallarta, a 10 minutos del Malecón'),
        1720 => array('d' => 'Los Cabos', 'iata' => 'SJD', 't' => '2 h 30 min', 'ac' => 'Learjet 35', 'pax' => 7, 'p' => '$3,800 USD', 'en' => 'https://jetcab.mx/private-jet-mexico-city-los-cabos/', 'arr' => 'la terminal privada de San José del Cabo, a 25 minutos de Cabo San Lucas'),
        1448 => array('d' => 'Acapulco', 'iata' => 'ACA', 't' => '45 min', 'ac' => 'Learjet 35', 'pax' => 7, 'p' => '', 'en' => '', 'arr' => 'la terminal de aviación general de Acapulco'),
        1773 => array('d' => 'Querétaro', 'iata' => 'QRO', 't' => '35 min', 'ac' => 'Learjet 35', 'pax' => 7, 'p' => '', 'en' => '', 'arr' => 'la terminal privada del Aeropuerto Intercontinental de Querétaro'),
        2578 => array('d' => 'Mazatlán', 'iata' => 'MZT', 't' => '1 h 40 min', 'ac' => 'Learjet 35', 'pax' => 7, 'p' => '', 'en' => '', 'arr' => 'la terminal privada de Mazatlán'),
        1775 => array('d' => 'Tijuana', 'iata' => 'TIJ', 't' => '3 h 10 min', 'ac' => 'Challenger 605', 'pax' => 12, 'p' => '', 'en' => '', 'arr' => 'la terminal privada de Tijuana'),
        1751 => array('d' => 'Nueva York', 'iata' => 'TEB', 't' => '5 h sin escalas', 'ac' => 'Gulfstream', 'pax' => 16, 'p' => '', 'en' => 'https://jetcab.mx/private-jet-mexico-city-new-york/', 'arr' => 'Teterboro, a 25 minutos de Manhattan'),
        1708 => array('d' => 'Las Vegas', 'iata' => 'LAS', 't' => '3 h 30 min', 'ac' => 'Challenger 605', 'pax' => 12, 'p' => '', 'en' => '', 'arr' => 'la terminal privada de Las Vegas, a 10 minutos del Strip'),
        1777 => array('d' => 'San Diego', 'iata' => 'SAN', 't' => '3 h 20 min', 'ac' => 'Challenger 605', 'pax' => 12, 'p' => '', 'en' => '', 'arr' => 'la terminal privada de San Diego'),
    );
}
add_filter('the_content', function ($content) {
    if (is_admin() || !in_the_loop() || !is_main_query()) return $content;
    $id = get_the_ID();
    if ($id == 355) {
        $faq = array(
            '¿Cuánto cuesta rentar un jet privado en México?' => 'Desde $1,800 USD por aeronave completa (Toluca–Guadalajara en Learjet 35). Monterrey desde $2,200 USD, Puerto Vallarta $3,000, Cancún $3,200 y Los Cabos $3,800 USD. Light jets en ruta corta desde $80,000 MXN y long range intercontinental desde $100,000 USD. El precio es por avión, no por pasajero.',
            '¿Por qué JETCAB sale del Aeropuerto de Toluca y no del AICM?' => 'Porque Toluca (AIT) tiene FBO privado: su camioneta llega a la escalinata y aborda en menos de 10 minutos, sin terminal, sin filas y sin escrutinio. Está a 40 minutos de Santa Fe y a 55 de Polanco, y el jet puede estar listo en 2 horas desde su confirmación.',
            '¿En cuánto tiempo puede despegar un jet privado?' => 'En 2 horas desde su mensaje, sujeto a disponibilidad. Tripulación en base, aeronave en hangar propio y plan de vuelo nacional sin permisos adicionales. Para Estados Unidos conviene avisar con 24 horas por los permisos de aduana.',
            '¿Qué aeronaves opera JETCAB?' => 'Light jets Learjet 35 y Learjet 45 y Hawker 800 (4 a 8 pasajeros), midsize Challenger 605 (12 pasajeros, cabina de pie), long range Gulfstream y Global Express (16 pasajeros, intercontinental), helicópteros Bell 206 y AW139, y ambulancia aérea medicalizada.',
            '¿Es confidencial volar con JETCAB?' => 'Sí. El protocolo Identity Shield garantiza que nadie sabe quién vuela, con quién ni a dónde: tripulación bajo acuerdo de confidencialidad, abordaje directo desde la camioneta y sin registro público de pasajeros. Es el estándar que exigen directivos, políticos y figuras públicas.',
            '¿Cómo cotizo un vuelo privado?' => 'Envíe origen, destino, fecha y número de pasajeros por WhatsApp al +52 729 108 1200 o en jetcab.mx/cotizar. En 30 minutos recibe aeronave, horarios y total cerrado, con factura.',
        );
        $b  = jetcab_css_bloques() . jetcab_faq_ld($faq);
        $b .= '<section class="jch" id="renta-jets-privados-toluca"><div class="jch-in">';
        $b .= '<p class="k">Renta de jets privados en Toluca y CDMX</p><h2>25 años despegando desde Toluca</h2>';
        $b .= '<p class="a">JETCAB renta jets privados y helicópteros desde el Aeropuerto Internacional de Toluca (AIT) desde 1999: jet listo en 2 horas, abordaje Tarmac-to-Cabin en menos de 10 minutos y cotización formal en 30 minutos. Más de 2,000 vuelos a Cancún, Los Cabos, Monterrey, Houston, Miami y Nueva York con tripulación certificada por DGAC.</p>';
        $b .= '<p>Toluca es la base de la aviación ejecutiva del centro del país por una razón: tiene FBO privado. Su camioneta entra a plataforma y se detiene al pie de la escalinata. No hay terminal, no hay filas, no hay cámaras de prensa. A 40 minutos de Santa Fe, es más rápido llegar a Toluca y despegar que cruzar el filtro de seguridad del AICM. Esa certeza operativa es lo que compran nuestros clientes: directivos que cierran en Monterrey y regresan a cenar a la CDMX, familias que llegan a Los Cabos sin pisar una sala de espera y figuras públicas que necesitan que nadie sepa que volaron.</p>';
        $b .= '<h2>Cómo funciona</h2><div class="jch-grid">';
        $b .= '<div class="jch-step"><div class="n">01</div><h3>Cotice en 30 minutos</h3><p>Origen, destino, fecha y pasajeros por WhatsApp o en el formulario. Recibe aeronave, horarios y total cerrado.</p></div>';
        $b .= '<div class="jch-step"><div class="n">02</div><h3>Jet listo en 2 horas</h3><p>Confirmado el pago, tripulación y aeronave quedan asignadas. Para rutas nacionales puede despegar el mismo día.</p></div>';
        $b .= '<div class="jch-step"><div class="n">03</div><h3>Aborde en 10 minutos</h3><p>Llegue al FBO de Toluca 15 minutos antes. De la camioneta a su asiento sin terminal ni filas.</p></div></div>';
        $b .= '<h2>Tarifas de referencia desde Toluca</h2><p>Precio por aeronave completa en Learjet 35 para 7 pasajeros. <a href="https://jetcab.mx/precios-jet-privado/" style="color:#C9973F">Vea todas las tarifas y qué incluyen</a>.</p><div class="jch-rates">';
        foreach (array(1706, 1842, 1769, 1634, 1720) as $rid) { $r = jetcab_rutas_es_data()[$rid]; $b .= '<a class="jch-rate" href="' . get_permalink($rid) . '"><span class="r">Toluca – ' . esc_html($r['d']) . '<small>' . esc_html($r['t']) . ' · ' . esc_html($r['ac']) . '</small></span><span class="p">' . esc_html($r['p']) . '</span></a>'; }
        $b .= '<a class="jch-rate" href="https://jetcab.mx/long-range-jets-toluca/"><span class="r">Intercontinental<small>Nueva York, Los Ángeles, Europa · Gulfstream</small></span><span class="p">desde $100,000 USD</span></a></div>';
        $b .= '<h2>Preguntas frecuentes</h2>' . jetcab_faq_html($faq);
        $b .= '<a class="jch-cta" href="https://jetcab.mx/cotizar/">Cotizar mi vuelo</a>';
        $b .= '</div></section>';
        return $content . $b;
    }
    $rutas = jetcab_rutas_es_data();
    if (isset($rutas[$id])) {
        $r = $rutas[$id];
        $precio = $r['p'] !== '' ? 'desde ' . $r['p'] . ' por aeronave completa para ' . $r['pax'] . ' pasajeros' : 'con tarifa por aeronave completa para hasta ' . $r['pax'] . ' pasajeros, cotizada en 30 minutos';
        $faq = array(
            '¿Cuánto dura el vuelo privado de CDMX a ' . $r['d'] . '?' => $r['t'] . ' desde el Aeropuerto Internacional de Toluca en ' . $r['ac'] . ', sin escalas. Aterriza en ' . $r['arr'] . '.',
            '¿Cuánto cuesta un jet privado a ' . $r['d'] . '?' => ($r['p'] !== '' ? 'Desde ' . $r['p'] . ' por aeronave completa en ' . $r['ac'] . ' (' . $r['pax'] . ' pasajeros), con tripulación, combustible y tasas incluidas. ' : 'Se cotiza por aeronave completa según fecha, aeronave y pernocta; recibe el total cerrado en 30 minutos. ') . 'El precio es por avión, no por pasajero. Viaje redondo el mismo día sin cargo de pernocta.',
            '¿Con cuánta anticipación debo reservar el vuelo a ' . $r['d'] . '?' => 'El jet puede estar listo en 2 horas desde su confirmación, sujeto a disponibilidad. En temporada alta (diciembre, Semana Santa y puentes) conviene reservar con dos semanas para asegurar aeronave y tarifa.',
        );
        $b  = jetcab_css_bloques() . jetcab_faq_ld($faq);
        $b .= '<section class="jcr"><div class="jcr-in"><h2>Jet privado CDMX – ' . esc_html($r['d']) . ' en resumen</h2>';
        $b .= '<p class="a">Un jet privado de la Ciudad de México a ' . esc_html($r['d']) . ' con JETCAB despega del Aeropuerto Internacional de Toluca y aterriza en ' . esc_html($r['iata']) . ' en ' . esc_html($r['t']) . ' en ' . esc_html($r['ac']) . ', ' . $precio . '. Jet listo en 2 horas, abordaje en menos de 10 minutos y cotización formal en 30 minutos.</p>';
        $b .= jetcab_faq_html($faq);
        $b .= '<a class="jcr-cta" href="https://jetcab.mx/cotizar/">Cotizar vuelo a ' . esc_html($r['d']) . '</a>';
        $b .= '<div class="jcr-links"><a href="https://jetcab.mx/precios-jet-privado/">Precios de jet privado</a><a href="https://jetcab.mx/flota/">Flota JETCAB</a><a href="https://jetcab.mx/vuelos-privados-confidenciales/">Vuelos confidenciales</a>' . ($r['en'] ? '<a href="' . esc_url($r['en']) . '" hreflang="en">Read in English</a>' : '') . '</div>';
        $b .= '</div></section>';
        return $content . $b;
    }
    return $content;
}, 20);
