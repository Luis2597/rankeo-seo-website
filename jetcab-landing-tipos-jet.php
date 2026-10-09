<?php
/*
 * JETCAB Landings por tipo de jet
 * /light-jets-toluca/      → keyword: vuelos cortos nacionales desde Toluca (Learjet 35/75, Hawker 400, desde $80,000 MXN)
 * /long-range-jets-toluca/ → keyword: jets privados intercontinentales Toluca (Gulfstream G650/G650ER, Global Express, desde $100,000 USD)
 * Mismo patrón técnico que jetcab-routes-domestic-v1.php (rewrite + query var + template_redirect).
 */

add_action("init", function() {
    add_rewrite_rule('^(light-jets-toluca|long-range-jets-toluca)/?$', 'index.php?jetcab_jettype=$matches[1]', 'top');
});
add_filter("query_vars", function($vars) { $vars[] = "jetcab_jettype"; return $vars; });
add_action("template_redirect", function() {
    $slug = get_query_var("jetcab_jettype");
    if (!$slug) return;
    $pages = [
        "light-jets-toluca" => [
            "title"      => 'Light Jets desde Toluca | Vuelos Cortos Nacionales — JETCAB',
            "meta_desc"  => 'Light jets desde Toluca para vuelos cortos nacionales: Learjet 35/75 y Hawker 400, 4 a 8 pax, desde $80,000 MXN. Acapulco en 45 min, Monterrey 1h 15m. JETCAB.',
            "h1"         => 'Light jets desde Toluca: vuelos cortos nacionales',
            "tag"        => 'Light Jet · 4–8 pasajeros · desde $80,000 MXN',
            "sub"        => 'Learjet 35, Learjet 75 y Hawker 400 listos en 2 horas en el FBO privado de Toluca. Acapulco en 45 minutos, Monterrey en 1 hora 15. Precio por aeronave, no por asiento.',
            "wa_text"    => 'Hola%2C+quiero+cotizar+un+light+jet+desde+Toluca.',
            "hero_img"   => '1436491865332-7a61a109cc05',
            "img_1"      => '1518773553398-650c184e0bb3',
            "alt_1"      => 'Skyline de Monterrey, ruta Toluca–Monterrey en light jet en 1 hora 15 minutos',
            "img_2"      => '1581093806997-124204d9fa9d',
            "alt_2"      => 'Cabina de piel de un light jet para vuelos cortos nacionales desde Toluca',
            "q_h2"       => '¿Cuánto cuesta rentar un light jet desde Toluca?',
            "answer"     => 'Rentar un light jet desde Toluca cuesta desde $80,000 MXN por aeronave completa en rutas cortas nacionales como Toluca–Acapulco (45 minutos) o Toluca–Querétaro (35 minutos), con tripulación, combustible y tasas incluidas. Para Toluca–Guadalajara (50 minutos) o Toluca–Monterrey (1 hora 15) la referencia es de $1,800 a $2,200 USD. Los light jets de JETCAB (Learjet 35, Learjet 75 y Hawker 400) transportan de 4 a 8 pasajeros y despegan en 2 horas desde su solicitud.',
            "intro_1"    => 'Un light jet es la herramienta correcta cuando el vuelo dura menos de 2 horas 30 y el grupo es de 4 a 8 personas. Es la flota más ágil de JETCAB: tripulación en base, aeronave en hangar propio en el Aeropuerto Internacional de Toluca (AIT) y plan de vuelo nacional sin permisos internacionales. De su mensaje al despegue pasan 2 horas.',
            "intro_2"    => 'La cuenta es simple. La Autopista del Sol a Acapulco toma de 4 a 5 horas un viernes; el Learjet 35 aterriza en 45 minutos. Un pasajero comercial a Monterrey invierte 4 horas de puerta a puerta; en light jet desde Toluca son 2 horas 30, con junta a las 9:00 y de regreso en la CDMX a las 18:30.',
            "fleet_h2"   => 'Los tres light jets de JETCAB',
            "fleet_p"    => 'Certificación DGAC, mantenimiento bajo estándar del fabricante y tripulación propia. Precio de referencia Toluca–Acapulco, por aeronave completa.',
            "currency"   => 'MXN',
            "aircraft"   => [
                ["name" => 'Learjet 35', "class" => 'Light Jet', "img" => '1436491865332-7a61a109cc05', "alt" => 'Learjet 35, light jet para vuelos cortos nacionales desde Toluca', "desc" => 'El clásico de la flota. Cabina de piel para 7 pasajeros, crucero a 850 km/h, alcance de 3,700 km. Para equipos pequeños y salidas de última hora.', "pax" => '7', "speed" => '850 km/h', "extra_l" => 'Alcance', "extra_v" => '3,700 km', "price" => '$80,000', "price_num" => '80000'],
                ["name" => 'Hawker 400', "class" => 'Light Jet', "img" => '1581093806997-124204d9fa9d', "alt" => 'Hawker 400, light jet de cabina ancha con baño cerrado', "desc" => 'Cabina ancha con baño cerrado y 8 asientos. La opción cómoda para familias en rutas de playa: Acapulco, Ixtapa, Huatulco.', "pax" => '8', "speed" => '830 km/h', "extra_l" => 'Alcance', "extra_v" => '2,800 km', "price" => '$88,000', "price_num" => '88000'],
                ["name" => 'Learjet 75', "class" => 'Light Jet', "img" => '1540962351504-03099e0a754b', "alt" => 'Learjet 75, light jet moderno con Wi-Fi y cabina ampliada', "desc" => 'La versión moderna del Learjet: 8 asientos, Wi-Fi, pantallas individuales y cabina ampliada. Para directivos que trabajan en el aire.', "pax" => '8', "speed" => '860 km/h', "extra_l" => 'Wi-Fi', "extra_v" => 'A bordo', "price" => '$98,000', "price_num" => '98000'],
            ],
            "routes_h2"  => 'Rutas cortas nacionales desde Toluca',
            "routes_p"   => 'Tiempos de vuelo sin escalas desde el FBO privado del Aeropuerto Internacional de Toluca (AIT). Todas son rutas nacionales: sin migración, sin aduana, menos de 5 minutos en tierra al llegar.',
            "routes"     => [
                ['Toluca – Querétaro', '35 min'], ['Toluca – Acapulco', '45 min'], ['Toluca – León / Bajío', '45 min'],
                ['Toluca – Guadalajara', '50 min'], ['Toluca – Oaxaca', '1h 05m'], ['Toluca – Monterrey', '1h 15m'],
                ['Toluca – Puerto Vallarta', '1h 45m'], ['Toluca – Cancún', '2h 15m'],
            ],
            "why_h2"     => 'Cuándo conviene un light jet y cuándo no',
            "why"        => [
                ['Conviene:', 'rutas nacionales de hasta 2 horas 30, grupos de 4 a 8 personas, viajes redondos en el día, salidas con menos de 24 horas de aviso.'],
                ['Conviene:', 'fines de semana en Acapulco, Ixtapa o Vallarta con familia. La camioneta espera al pie de la escalinata en la terminal de aviación general del destino.'],
                ['No conviene:', 'grupos de 9 o más, vuelos de más de 3 horas o si necesita cabina de pie para trabajar. Ahí la respuesta es el Challenger 605 midsize desde $6,500 USD.'],
                ['No conviene:', 'rutas internacionales largas. Para Nueva York, Madrid o Londres sin escalas, la cabina correcta es un long range: Gulfstream G650 o Global Express.'],
            ],
            "faqs" => [
                ["q" => '¿Cuánto cuesta rentar un light jet desde Toluca?', "a" => 'Desde $80,000 MXN por aeronave completa en rutas cortas como Toluca–Acapulco (45 minutos) o Toluca–Querétaro (35 minutos), con tripulación, combustible y tasas de aterrizaje incluidas. Toluca–Guadalajara desde $1,800 USD y Toluca–Monterrey desde $2,200 USD. El precio es por avión, no por asiento: con 7 pasajeros a bordo el costo por persona baja de forma considerable.'],
                ["q" => '¿Qué light jets opera JETCAB desde Toluca?', "a" => 'Tres aeronaves: Learjet 35 (7 pasajeros, 850 km/h), Learjet 75 (8 pasajeros, cabina ampliada, Wi-Fi) y Hawker 400 (8 pasajeros, cabina ancha con baño cerrado). Las tres están certificadas por DGAC, se mantienen bajo estándar del fabricante y despegan del FBO privado del Aeropuerto Internacional de Toluca (AIT), a 40 minutos de Santa Fe.'],
                ["q" => '¿Cuántos pasajeros caben en un light jet?', "a" => 'De 4 a 8 pasajeros con equipaje de mano y maletas medianas. El Learjet 35 acomoda 7; el Learjet 75 y el Hawker 400, 8. Para grupos de 9 a 12 o para vuelos de más de 3 horas con cabina de pie, el Challenger 605 midsize desde $6,500 USD es la siguiente cabina. Le decimos cuál conviene al cotizar.'],
                ["q" => '¿Qué rutas conviene volar en light jet desde Toluca?', "a" => 'Cualquier ruta nacional de hasta 2 horas 30: Toluca–Acapulco en 45 minutos, Toluca–Querétaro en 35, Toluca–Guadalajara en 50, Toluca–Monterrey en 1 hora 15, Toluca–Puerto Vallarta en 1 hora 45 y Toluca–Cancún en 2 horas 15. Para Houston o Miami la referencia es el Challenger 605; para Nueva York sin escalas, un long range.'],
                ["q" => '¿En cuánto tiempo puede despegar un light jet desde Toluca?', "a" => 'En 2 horas desde su mensaje, sujeto a disponibilidad. Los light jets son la flota más ágil de JETCAB: tripulación en base, aeronave en hangar propio y plan de vuelo nacional sin permisos internacionales. Llega al FBO privado de Toluca 15 minutos antes y aborda directo desde su camioneta en menos de 10 minutos.'],
                ["q" => '¿Vale la pena un light jet a Acapulco si en carretera son 4 horas?', "a" => 'La Autopista del Sol toma de 4 a 5 horas un viernes por la tarde; el Learjet 35 aterriza en Acapulco en 45 minutos. Desde $80,000 MXN por aeronave, un grupo de 7 convierte un fin de semana de dos noches en uno de tres. La camioneta espera al pie de la escalinata en la terminal de aviación general de Acapulco.'],
                ["q" => '¿Puedo hacer viaje redondo en el día con un light jet?', "a" => 'Sí, es el uso más frecuente de la flota light: salida 7:00 de Toluca, junta en Monterrey a las 9:00 y de regreso en la CDMX a las 18:30. La tripulación permanece en destino durante su agenda sin cargo de pernocta en viajes redondos el mismo día. Aplica igual para Guadalajara, Querétaro, León y Acapulco.'],
            ],
            "links" => [
                ['https://jetcab.mx/long-range-jets-toluca/', 'Long Range: jets intercontinentales desde Toluca'],
                ['https://jetcab.mx/vuelos-privados-confidenciales/', 'Vuelos privados confidenciales: Identity Shield'],
                ['https://jetcab.mx/vuelos-privados-a-monterrey/', 'Vuelos privados a Monterrey'],
                ['https://jetcab.mx/vuelos-privados-a-guadalajara/', 'Vuelos privados a Guadalajara'],
                ['https://jetcab.mx/cotizar/', 'Cotizar un vuelo privado'],
                ['https://jetcab.mx/#flota', 'Ver toda la flota JETCAB'],
            ],
            "cta_h2"     => '¿Acapulco o Monterrey esta semana?',
            "cta_p"      => 'Light jet listo en 2 horas en Toluca. Desde $80,000 MXN por aeronave. Cotización en 30 minutos.',
            "cta_btn"    => 'Cotizar light jet por WhatsApp',
        ],
        "long-range-jets-toluca" => [
            "title"      => 'Long Range Jets desde Toluca | Vuelos Intercontinentales',
            "meta_desc"  => 'Jets privados intercontinentales desde Toluca: Gulfstream G650 y Global Express, 12 a 16 pax, sin escalas a Nueva York o Madrid. Desde $100,000 USD. JETCAB.',
            "h1"         => 'Jets privados intercontinentales desde Toluca',
            "tag"        => 'Long Range · 12–16 pasajeros · Sin escalas · desde $100,000 USD',
            "sub"        => 'Gulfstream G650, G650ER y Global Express con cabina completa, recámara y sala de juntas. De Toluca a Madrid, Londres o Tokio sin tocar tierra. El escenario donde se firma antes de aterrizar.',
            "wa_text"    => 'Hola%2C+quiero+cotizar+un+jet+long+range+sin+escalas+desde+Toluca.',
            "hero_img"   => '1540962351504-03099e0a754b',
            "img_1"      => '1486325212027-8081e485255e',
            "alt_1"      => 'Skyline nocturno, destino intercontinental de jets privados desde Toluca',
            "img_2"      => '1521791136064-7986c2920216',
            "alt_2"      => 'Sala de juntas ejecutiva, el jet long range como escenario de negociación',
            "q_h2"       => '¿Cuánto cuesta un jet privado intercontinental desde Toluca?',
            "answer"     => 'Un jet privado intercontinental desde Toluca cuesta desde $100,000 USD por aeronave completa en un Gulfstream G650 o Global Express para 12 a 16 pasajeros, con tripulación doble, combustible, permisos de sobrevuelo y FBO en destino incluidos. Referencias: Toluca–Nueva York (Teterboro) 4 horas 30 sin escalas; Toluca–Madrid 10 horas; Toluca–Londres 10 horas 30; Toluca–Tokio 13 horas 30 en G650ER. Cabina completa: recámara, sala de juntas para 8, Starlink y catering de chef.',
            "intro_1"    => 'Un long range no es un avión más grande. Es una cabina de 14 metros con recámara, dos baños, galley para catering de chef y una mesa de juntas donde caben 8 personas y un contrato. A 956 km/h y sin escalas, Toluca–Madrid son 10 horas en las que nadie puede pedirle nada y usted controla la agenda.',
            "intro_2"    => 'Invitar a un inversionista a un restaurante ya no cierra rondas. Subirlo a un G650 en el FBO privado de Toluca, sin terminal, con Starlink y un menú de firma, convierte el vuelo en el máximo símbolo de solvencia. Nuestros clientes no llegan rápido a Nueva York: llegan con la autoridad necesaria para que firmen antes de aterrizar.',
            "fleet_h2"   => 'La flota long range de JETCAB',
            "fleet_p"    => 'Certificación DGAC, mantenimiento bajo estándar del fabricante, tripulación doble en vuelos de más de 8 horas. Precio de referencia Toluca–Madrid, por aeronave completa.',
            "currency"   => 'USD',
            "aircraft"   => [
                ["name" => 'Gulfstream G650', "class" => 'Long Range', "img" => '1540962351504-03099e0a754b', "alt" => 'Gulfstream G650, jet privado intercontinental con cabina completa', "desc" => 'Alcance de 12,900 km a 956 km/h. Recámara, sala de juntas para 8, Starlink y 16 asientos convertibles. La aeronave de jefes de Estado.', "pax" => '16', "speed" => '956 km/h', "extra_l" => 'Alcance', "extra_v" => '12,900 km', "price" => '$100,000', "price_num" => '100000'],
                ["name" => 'Global Express', "class" => 'Long Range', "img" => '1581093806997-124204d9fa9d', "alt" => 'Bombardier Global Express, cabina de tres zonas para 16 pasajeros', "desc" => 'Cabina de tres zonas: trabajo, descanso y recámara. 11,300 km de alcance, 16 asientos y galley completo. Madrid o São Paulo sin escalas.', "pax" => '16', "speed" => '935 km/h', "extra_l" => 'Alcance', "extra_v" => '11,300 km', "price" => '$100,000', "price_num" => '100000'],
                ["name" => 'Gulfstream G650ER', "class" => 'Ultra Long Range', "img" => '1436491865332-7a61a109cc05', "alt" => 'Gulfstream G650ER, el jet de mayor alcance de la flota JETCAB', "desc" => 'El mayor alcance de la flota: 13,890 km. Toluca–Tokio o Toluca–Dubái sin escalas. Misma cabina del G650 con 6 camas convertibles para vuelos nocturnos.', "pax" => '16', "speed" => '956 km/h', "extra_l" => 'Alcance', "extra_v" => '13,890 km', "price" => '$115,000', "price_num" => '115000'],
            ],
            "routes_h2"  => 'Destinos sin escalas desde Toluca',
            "routes_p"   => 'Tiempos de vuelo directo desde el FBO privado del Aeropuerto Internacional de Toluca (AIT). Ninguna ruta requiere parada técnica de combustible. Migración en sala reservada del FBO en destino.',
            "routes"     => [
                ['Toluca – Miami', '3h 00m'], ['Toluca – Los Ángeles', '3h 45m'], ['Toluca – Nueva York (Teterboro)', '4h 30m'],
                ['Toluca – São Paulo', '8h 30m'], ['Toluca – Madrid', '10h 00m'], ['Toluca – Londres (Farnborough)', '10h 30m'],
                ['Toluca – Tokio', '13h 30m'], ['Toluca – Dubái (G650ER)', '15h 30m'],
            ],
            "why_h2"     => 'El jet como escenario de negociación',
            "why"        => [
                ['Estatus Visible:', 'su contraparte no ve un asiento más ancho. Ve un Gulfstream en plataforma privada, una tripulación que lo recibe por su nombre y un menú de chef. Reconoce la solvencia antes de que usted hable.'],
                ['Soberanía del Tiempo:', 'un retraso de 3 horas en una aerolínea comercial no es una molestia; es la pérdida potencial de un trato de millones. Aquí el horario lo fija usted y el jet está listo en 2 horas.'],
                ['Sala de consejo a 40,000 pies:', 'mesa para 8, pantallas, Starlink para videollamada con su equipo legal y 10 horas sin interrupciones. Muchos de nuestros clientes cierran antes de aterrizar.'],
                ['Identity Shield:', 'tripulación bajo NDA, sin terminal comercial en ningún extremo, migración en sala reservada del FBO. Nadie sabe con quién voló ni qué firmó.'],
            ],
            "faqs" => [
                ["q" => '¿Cuánto cuesta un jet privado intercontinental desde Toluca?', "a" => 'Desde $100,000 USD por aeronave completa en Gulfstream G650 o Global Express, con tripulación doble, combustible, permisos de sobrevuelo, tasas y FBO en destino incluidos. Referencia Toluca–Madrid o Toluca–Londres desde $100,000 USD; Toluca–Tokio en G650ER desde $115,000 USD. Para 12 a 16 pasajeros el costo por persona es comparable con una primera clase comercial con escala.'],
                ["q" => '¿Qué jets de largo alcance opera JETCAB?', "a" => 'Gulfstream G650 (alcance 12,900 km, 16 pasajeros), Gulfstream G650ER (13,890 km, el de mayor alcance de la flota) y Bombardier Global Express (11,300 km, 16 pasajeros). Los tres tienen cabina completa con recámara, sala de juntas, dos baños, galley para catering de chef y Starlink. Certificación DGAC y mantenimiento bajo estándar del fabricante.'],
                ["q" => '¿A qué destinos llega sin escalas un long range desde Toluca?', "a" => 'Nueva York (Teterboro) en 4 horas 30, Miami en 3, Los Ángeles en 3 horas 45, São Paulo en 8 horas 30, Madrid en 10, Londres en 10 horas 30 y Tokio en 13 horas 30 con el G650ER. Ninguna requiere parada técnica de combustible. Despega del FBO privado de Toluca (AIT) con tripulación doble para vuelos de más de 8 horas.'],
                ["q" => '¿Cómo funciona el jet como escenario de negociación?', "a" => 'La cabina se configura como sala de consejo: mesa para 8, pantallas, Starlink para videollamada y catering de chef servido en vajilla. Sus invitados abordan desde la camioneta en el FBO de Toluca sin pasar por terminal, y durante 10 horas sin interrupciones usted controla la agenda. Muchos de nuestros clientes cierran antes de aterrizar.'],
                ["q" => '¿Cuántos pasajeros y cuánto equipaje caben en un G650?', "a" => 'De 12 a 16 pasajeros según configuración, con 6 camas convertibles para vuelos nocturnos. La bodega del G650 admite 195 pies cúbicos: maletas de 16 personas, equipo de golf, esquís o muestras de producto. Personal de servicio, asistentes y escoltas viajan en la misma cabina sin registros separados ni filtros adicionales.'],
                ["q" => '¿Con cuánta anticipación debo solicitar un vuelo intercontinental?', "a" => 'Recomendamos 48 horas por permisos de sobrevuelo y slots de FBO en Europa o Asia; para Estados Unidos, 24 horas bastan. Con tripulación en base y aeronave disponible, JETCAB puede despegar hacia Teterboro en menos de 4 horas desde la solicitud. Un solo concierge coordina permisos, migración en FBO privado y la camioneta en destino.'],
                ["q" => '¿Hay migración o aduana al llegar en jet privado a Europa o Estados Unidos?', "a" => 'Sí, pero en sala reservada del FBO privado del destino, sin fila pública ni contacto con pasajeros comerciales. En Teterboro, Miami o Houston el trámite toma de 10 a 15 minutos; en Madrid o Londres (Farnborough), menos de 20. Su camioneta espera al pie de la escalinata al terminar. Identity Shield aplica en ambos extremos.'],
            ],
            "links" => [
                ['https://jetcab.mx/light-jets-toluca/', 'Light Jets: vuelos cortos nacionales desde Toluca'],
                ['https://jetcab.mx/vuelos-privados-confidenciales/', 'Vuelos privados confidenciales: Identity Shield'],
                ['https://jetcab.mx/private-jet-mexico-city-new-york/', 'Private jet Mexico City to New York (English)'],
                ['https://jetcab.mx/private-jet-mexico-city-miami/', 'Private jet Mexico City to Miami (English)'],
                ['https://jetcab.mx/cotizar/', 'Cotizar un vuelo privado'],
                ['https://jetcab.mx/#flota', 'Ver toda la flota JETCAB'],
            ],
            "cta_h2"     => '¿Nueva York, Madrid o Tokio sin escalas?',
            "cta_p"      => 'Gulfstream G650 o Global Express listos desde Toluca. Desde $100,000 USD por aeronave. Un solo concierge coordina todo.',
            "cta_btn"    => 'Cotizar long range por WhatsApp',
        ],
    ];
    if (!isset($pages[$slug])) return;
    status_header(200);
    header("Content-Type: text/html; charset=UTF-8");
    echo jetcab_landing_tipos_jet_page($pages[$slug], $slug);
    exit;
});


if (!function_exists('jc_json_str')) {
    // Escapa un string para usarlo dentro de un literal JSON (esc_js produce \' que es JSON inválido).
    function jc_json_str($str) {
        return substr(json_encode((string)$str, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), 1, -1);
    }
}

function jetcab_landing_tipos_jet_page($p, $slug) {
    $wa = 'https://wa.me/527291081200?text=' . $p['wa_text'];
    $canonical = 'https://jetcab.mx/' . $slug . '/';
    $catalog_id = $canonical . '#catalogo';
    $hero_url = 'https://images.unsplash.com/photo-' . $p['hero_img'] . '?auto=format&fit=crop&w=1400&q=80';
    $min_price = $p['aircraft'][0]['price_num'];
    foreach ($p['aircraft'] as $a) { if ((int)$a['price_num'] < (int)$min_price) $min_price = $a['price_num']; }
    ob_start();
?><!DOCTYPE html>
<html lang="es-MX">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo esc_html($p['title']); ?></title>
<meta name="description" content="<?php echo esc_attr($p['meta_desc']); ?>">
<link rel="canonical" href="<?php echo $canonical; ?>">
<link rel="alternate" hreflang="es" href="<?php echo $canonical; ?>">
<link rel="alternate" hreflang="x-default" href="<?php echo $canonical; ?>">
<meta property="og:title" content="<?php echo esc_attr($p['title']); ?>">
<meta property="og:description" content="<?php echo esc_attr($p['meta_desc']); ?>">
<meta property="og:url" content="<?php echo $canonical; ?>">
<meta property="og:type" content="website">
<meta property="og:locale" content="es_MX">
<meta property="og:image" content="https://jetcab.mx/wp-content/uploads/2023/09/jetcab-og.jpg">
<meta name="twitter:card" content="summary_large_image">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800&family=Barlow:wght@300;400;500;600&display=swap" rel="stylesheet">
<script type="application/ld+json">
{"@context":"https://schema.org","@graph":[
{"@type":"WebPage","@id":"<?php echo $canonical; ?>","url":"<?php echo $canonical; ?>","name":"<?php echo jc_json_str($p['title']); ?>","description":"<?php echo jc_json_str($p['meta_desc']); ?>","inLanguage":"es-MX","isPartOf":{"@type":"WebSite","@id":"https://jetcab.mx/#website","url":"https://jetcab.mx","name":"JETCAB"}},
{"@type":"Service","name":"<?php echo jc_json_str($p['h1']); ?>","description":"<?php echo jc_json_str($p['meta_desc']); ?>","provider":{"@type":"LocalBusiness","name":"JETCAB","url":"https://jetcab.mx","telephone":"+52-729-108-1200","foundingDate":"1999","areaServed":"México"},"serviceType":"Renta de jet privado","areaServed":"México","hasOfferCatalog":{"@id":"<?php echo $catalog_id; ?>"},"offers":{"@type":"Offer","priceCurrency":"<?php echo $p['currency']; ?>","price":"<?php echo $min_price; ?>","priceSpecification":{"@type":"UnitPriceSpecification","priceCurrency":"<?php echo $p['currency']; ?>","price":"<?php echo $min_price; ?>","unitText":"por aeronave"}}},
{"@type":"OfferCatalog","@id":"<?php echo $catalog_id; ?>","name":"<?php echo jc_json_str($p['fleet_h2']); ?>","itemListElement":[<?php $oc=array_map(function($a) use ($p){return '{"@type":"Offer","name":"'.jc_json_str($a["name"]).'","priceCurrency":"'.$p["currency"].'","price":"'.$a["price_num"].'","availability":"https://schema.org/InStock","itemOffered":{"@type":"Product","name":"'.jc_json_str($a["name"]).'","description":"'.jc_json_str($a["desc"]).'","category":"'.jc_json_str($a["class"]).'"}}';},$p['aircraft']);echo implode(',',$oc);?>]},
{"@type":"FAQPage","mainEntity":[<?php $fq=array_map(function($f){return '{"@type":"Question","name":"'.jc_json_str($f["q"]).'","acceptedAnswer":{"@type":"Answer","text":"'.jc_json_str($f["a"]).'"}}';},$p['faqs']);echo implode(',',$fq);?>]}
]}
</script>
<style>
:root{--orange:#E85A1E;--gold:#C9973F;--dark:#0D0D0D;--dark2:#141414;--text:#E8E8E8;--muted:#888;--ff-head:'Barlow Condensed',sans-serif;--ff-body:'Barlow',sans-serif}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{background:var(--dark);color:var(--text);font-family:var(--ff-body);line-height:1.6}
.jc-nav{position:fixed;top:0;left:0;right:0;z-index:100;display:flex;align-items:center;justify-content:space-between;padding:1rem 2rem;background:rgba(13,13,13,0.9);backdrop-filter:blur(14px);border-bottom:1px solid rgba(255,255,255,0.07)}
.jc-nav-logo{font-family:var(--ff-head);font-size:1.5rem;font-weight:800;letter-spacing:0.08em;color:#fff;text-decoration:none}
.jc-nav-logo span{color:var(--orange)}
.jc-nav-links{display:flex;align-items:center;gap:2rem}
.jc-nav-links a{color:var(--muted);text-decoration:none;font-size:0.875rem;transition:color 0.2s}
.jc-nav-links a:hover{color:#fff}
.jc-nav-cta{background:var(--orange);color:#fff!important;padding:0.5rem 1.25rem;border-radius:50px;font-family:var(--ff-head);font-weight:700;letter-spacing:0.05em}
.jc-nav-cta:hover{background:#ff6a2f!important}
@media(max-width:768px){.jc-nav-links{display:none}}
.jc-hero{position:relative;min-height:90vh;display:flex;align-items:flex-end;background-size:cover;background-position:center}
.jc-hero::after{content:'';position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.9) 0%,rgba(0,0,0,.4) 60%,rgba(0,0,0,.1) 100%)}
.jc-hero-inner{position:relative;z-index:2;padding:80px 24px 56px;max-width:900px;margin:0 auto;width:100%}
.jc-route-tag{font-family:var(--ff-head);font-size:.85rem;letter-spacing:.15em;text-transform:uppercase;color:var(--orange);margin-bottom:12px}
.jc-hero h1{font-family:var(--ff-head);font-size:clamp(2.5rem,6vw,5rem);font-weight:700;line-height:1.05;text-transform:uppercase;margin-bottom:16px;color:#fff}
.jc-hero-sub{font-size:1.1rem;color:rgba(255,255,255,.78);margin-bottom:32px;max-width:600px;line-height:1.6}
.jc-trust-row{display:flex;gap:2rem;flex-wrap:wrap;margin-bottom:32px}
.jc-trust-row span{font-size:0.78rem;color:rgba(255,255,255,0.45);letter-spacing:0.05em;text-transform:uppercase}
.jc-trust-row span strong{color:var(--gold);font-weight:600}
.jc-btn{display:inline-block;background:var(--orange);color:#fff;font-family:var(--ff-head);font-size:.95rem;letter-spacing:.1em;text-transform:uppercase;padding:14px 32px;border-radius:50px;text-decoration:none;transition:background 0.2s,transform 0.15s}
.jc-btn:hover{background:#ff6a2f;transform:translateY(-1px)}
.jc-btn-ghost{background:transparent;border:1px solid rgba(255,255,255,.4);margin-left:12px;color:#fff!important}
.jc-btn-ghost:hover{border-color:rgba(255,255,255,.75);background:transparent!important}
.jc-section{padding:64px 24px;max-width:900px;margin:0 auto}
.jc-section h2{font-family:var(--ff-head);font-size:clamp(1.8rem,4vw,3rem);font-weight:700;text-transform:uppercase;color:var(--orange);margin-bottom:20px;line-height:1.1}
.jc-section p{font-size:1rem;line-height:1.75;color:var(--text);margin-bottom:16px}
.jc-section p:last-child{margin-bottom:0}
.jc-answer{font-size:1.15rem!important;line-height:1.7!important;color:#fff!important;border-left:3px solid var(--gold);padding-left:20px;margin-bottom:24px!important}
.jc-photo{width:100%;height:480px;object-fit:cover;display:block}
.jc-photo.tall{height:600px}
.jc-routes{display:grid;grid-template-columns:1fr;gap:10px;margin-top:28px}
@media(min-width:640px){.jc-routes{grid-template-columns:repeat(2,1fr)}}
.jc-route{display:flex;justify-content:space-between;align-items:center;background:var(--dark2);border-left:3px solid var(--orange);padding:16px 20px}
.jc-route .r{font-family:var(--ff-head);font-size:1.1rem;font-weight:600;color:#fff;letter-spacing:.03em}
.jc-route .t{font-family:var(--ff-head);font-size:1.2rem;font-weight:800;color:var(--gold)}
.jc-benefits{list-style:none;margin:24px 0 0}
.jc-benefits li{padding:14px 0;border-bottom:1px solid rgba(255,255,255,.08);font-size:1rem;line-height:1.55}
.jc-benefits li:first-child{border-top:1px solid rgba(255,255,255,.08)}
.jc-benefits li strong{color:var(--orange);font-weight:600}
.jc-fleet-grid{display:grid;grid-template-columns:1fr;gap:16px;margin-top:32px}
@media(min-width:640px){.jc-fleet-grid{grid-template-columns:repeat(3,1fr)}}
.jc-fleet-card{background:var(--dark2);border:1px solid rgba(255,255,255,.07);border-radius:6px;overflow:hidden;transition:border-color 0.2s,transform 0.2s}
.jc-fleet-card:hover{border-color:rgba(232,90,30,.4);transform:translateY(-2px)}
.jc-fleet-card-img{position:relative;aspect-ratio:16/10;overflow:hidden}
.jc-fleet-card-img img{width:100%;height:100%;object-fit:cover;opacity:0.85;transition:opacity 0.3s;display:block}
.jc-fleet-card:hover .jc-fleet-card-img img{opacity:1}
.jc-fleet-badge{position:absolute;bottom:10px;left:10px;font-family:var(--ff-head);font-size:0.7rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:var(--orange);background:rgba(0,0,0,.85);padding:4px 8px;border-radius:2px}
.jc-fleet-body{padding:20px}
.jc-fleet-class{font-size:.7rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:var(--orange);margin-bottom:4px}
.jc-fleet-name{font-family:var(--ff-head);font-size:1.4rem;font-weight:800;color:#fff;margin-bottom:8px}
.jc-fleet-desc{font-size:.85rem;color:#999;line-height:1.6;margin-bottom:12px}
.jc-fleet-specs{display:flex;gap:16px;flex-wrap:wrap;margin-bottom:12px}
.jc-fleet-spec{font-size:.78rem;color:var(--muted)}
.jc-fleet-spec strong{display:block;font-size:.92rem;color:#fff;font-weight:700;font-family:var(--ff-head)}
.jc-fleet-price{display:flex;align-items:baseline;gap:6px;margin-bottom:12px}
.jc-fleet-price-from{font-size:.72rem;color:var(--muted)}
.jc-fleet-price-amount{font-family:var(--ff-head);font-size:1.5rem;font-weight:800;color:var(--gold)}
.jc-fleet-cta{display:block;text-align:center;background:transparent;border:1px solid var(--orange);color:var(--orange);padding:10px;border-radius:4px;font-size:.875rem;font-weight:600;text-decoration:none;transition:background 0.2s,color 0.2s;font-family:var(--ff-head);letter-spacing:.05em;text-transform:uppercase}
.jc-fleet-cta:hover{background:var(--orange);color:#fff}
.jc-faq{margin:32px 0 0}
.jc-faq-item{border-bottom:1px solid rgba(255,255,255,.1);padding:20px 0}
.jc-faq-item:first-child{border-top:1px solid rgba(255,255,255,.1)}
.jc-faq-item h3{font-family:var(--ff-head);font-size:1.15rem;font-weight:600;color:var(--text);margin-bottom:8px}
.jc-faq-item p{font-size:.95rem;color:var(--muted);line-height:1.65;margin:0}
.jc-links{display:grid;grid-template-columns:1fr;gap:10px;margin-top:24px}
@media(min-width:640px){.jc-links{grid-template-columns:repeat(2,1fr)}}
.jc-links a{display:flex;align-items:center;justify-content:space-between;background:var(--dark2);border:1px solid rgba(255,255,255,.07);padding:16px 20px;color:var(--text);text-decoration:none;font-family:var(--ff-head);font-size:1.05rem;font-weight:600;letter-spacing:.03em;transition:border-color .2s,color .2s}
.jc-links a:hover{border-color:var(--orange);color:#fff}
.jc-links a span{color:var(--orange);font-size:1.2rem}
.jc-cta-final{background:var(--dark2);padding:80px 24px;text-align:center;border-top:1px solid rgba(255,255,255,.07)}
.jc-cta-final h2{font-family:var(--ff-head);font-size:clamp(1.6rem,4vw,2.8rem);font-weight:700;text-transform:uppercase;color:#fff;margin-bottom:16px;line-height:1.1}
.jc-cta-final p{color:var(--muted);margin-bottom:32px;font-size:1rem;max-width:480px;margin-left:auto;margin-right:auto;line-height:1.65}
.jc-footer{background:#0A0A0A;border-top:1px solid rgba(255,255,255,.07);padding:3rem 24px;overflow:hidden}
.jc-footer-inner{max-width:900px;margin:0 auto;display:flex;justify-content:space-between;align-items:flex-start;gap:2rem;flex-wrap:wrap}
.jc-footer-brand p{font-size:.8rem;color:var(--muted);margin-top:8px;max-width:240px;line-height:1.6}
.jc-footer-links{display:flex;flex-direction:column;gap:8px}
.jc-footer-links a{font-size:.85rem;color:var(--muted);text-decoration:none;transition:color 0.2s}
.jc-footer-links a:hover{color:#fff}
.jc-footer-bottom{text-align:center;font-size:.75rem;color:#444;padding-top:2rem;margin-top:2rem;border-top:1px solid rgba(255,255,255,.07);max-width:900px;margin-left:auto;margin-right:auto}
@keyframes pulse-wa{0%,100%{box-shadow:0 4px 16px rgba(37,211,102,.4)}50%{box-shadow:0 4px 24px rgba(37,211,102,.65)}}
@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation:none!important;transition:none!important}}
@media(max-width:640px){
  .jc-photo{height:280px}
  .jc-photo.tall{height:360px}
  .jc-btn-ghost{margin-left:0;margin-top:12px;display:inline-block}
}
.jc-hero{overflow:hidden}
@media(max-width:480px){.jc-hero h1{font-size:2.2rem!important;overflow-wrap:anywhere;hyphens:auto}}
</style>
</head>
<body>

<nav class="jc-nav">
  <a href="https://jetcab.mx" class="jc-nav-logo">JET<span>CAB</span></a>
  <div class="jc-nav-links">
    <a href="https://jetcab.mx/light-jets-toluca/">Light Jets</a>
    <a href="https://jetcab.mx/long-range-jets-toluca/">Long Range</a>
    <a href="https://jetcab.mx/vuelos-privados-confidenciales/">Identity Shield</a>
    <a href="https://jetcab.mx/cotizar/">Cotizar</a>
    <a href="<?php echo $wa; ?>" class="jc-nav-cta" target="_blank" rel="noopener">Cotizar por WhatsApp</a>
  </div>
</nav>

<!-- 1. HERO -->
<div class="jc-hero" style="background-image:url('<?php echo $hero_url; ?>')">
  <div class="jc-hero-inner">
    <div class="jc-route-tag"><?php echo esc_html($p['tag']); ?></div>
    <h1><?php echo esc_html($p['h1']); ?></h1>
    <p class="jc-hero-sub"><?php echo esc_html($p['sub']); ?></p>
    <div class="jc-trust-row">
      <span><strong>25 años</strong> desde Toluca</span>
      <span><strong>2,000+</strong> vuelos</span>
      <span><strong>Certificación</strong> DGAC</span>
      <span>Jet <strong>listo en 2h</strong></span>
    </div>
    <a href="<?php echo $wa; ?>" class="jc-btn" target="_blank" rel="noopener">Solicitar disponibilidad</a>
    <a href="#flota" class="jc-btn jc-btn-ghost">Ver aeronaves</a>
  </div>
</div>

<!-- 2. RESPUESTA DIRECTA -->
<div class="jc-section">
  <h2><?php echo esc_html($p['q_h2']); ?></h2>
  <p class="jc-answer"><?php echo esc_html($p['answer']); ?></p>
  <p><?php echo esc_html($p['intro_1']); ?></p>
  <p><?php echo esc_html($p['intro_2']); ?></p>
</div>

<!-- 3. FOTO -->
<img class="jc-photo tall" src="https://images.unsplash.com/photo-<?php echo esc_attr($p['img_1']); ?>?auto=format&fit=crop&w=1400&q=80" alt="<?php echo esc_attr($p['alt_1']); ?>" loading="lazy">

<!-- 4. FLOTA -->
<div class="jc-section" id="flota">
  <h2><?php echo esc_html($p['fleet_h2']); ?></h2>
  <p><?php echo esc_html($p['fleet_p']); ?></p>
  <div class="jc-fleet-grid">
    <?php foreach ($p['aircraft'] as $a): ?>
    <div class="jc-fleet-card">
      <div class="jc-fleet-card-img">
        <img src="https://images.unsplash.com/photo-<?php echo esc_attr($a['img']); ?>?auto=format&fit=crop&w=800&q=75" alt="<?php echo esc_attr($a['alt']); ?>" loading="lazy">
        <span class="jc-fleet-badge"><?php echo esc_html($a['class']); ?></span>
      </div>
      <div class="jc-fleet-body">
        <div class="jc-fleet-class"><?php echo esc_html($a['class']); ?></div>
        <div class="jc-fleet-name"><?php echo esc_html($a['name']); ?></div>
        <p class="jc-fleet-desc"><?php echo esc_html($a['desc']); ?></p>
        <div class="jc-fleet-specs">
          <div class="jc-fleet-spec"><strong><?php echo esc_html($a['pax']); ?></strong>Pasajeros</div>
          <div class="jc-fleet-spec"><strong><?php echo esc_html($a['speed']); ?></strong>Crucero</div>
          <div class="jc-fleet-spec"><strong><?php echo esc_html($a['extra_v']); ?></strong><?php echo esc_html($a['extra_l']); ?></div>
        </div>
        <div class="jc-fleet-price"><span class="jc-fleet-price-from">Desde</span><span class="jc-fleet-price-amount"><?php echo esc_html($a['price']); ?> <?php echo esc_html($p['currency']); ?></span></div>
        <a href="<?php echo $wa; ?>" class="jc-fleet-cta" target="_blank" rel="noopener">Reservar esta aeronave</a>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- 5. RUTAS -->
<div class="jc-section" style="padding-top:0">
  <h2><?php echo esc_html($p['routes_h2']); ?></h2>
  <p><?php echo esc_html($p['routes_p']); ?></p>
  <div class="jc-routes">
    <?php foreach ($p['routes'] as $rt): ?>
    <div class="jc-route"><span class="r"><?php echo esc_html($rt[0]); ?></span><span class="t"><?php echo esc_html($rt[1]); ?></span></div>
    <?php endforeach; ?>
  </div>
</div>

<!-- 6. FOTO -->
<img class="jc-photo" src="https://images.unsplash.com/photo-<?php echo esc_attr($p['img_2']); ?>?auto=format&fit=crop&w=1400&q=80" alt="<?php echo esc_attr($p['alt_2']); ?>" loading="lazy">

<!-- 7. CUÁNDO / ESCENARIO -->
<div class="jc-section">
  <h2><?php echo esc_html($p['why_h2']); ?></h2>
  <ul class="jc-benefits">
    <?php foreach ($p['why'] as $w): ?>
    <li><strong><?php echo esc_html($w[0]); ?></strong> <?php echo esc_html($w[1]); ?></li>
    <?php endforeach; ?>
  </ul>
</div>

<!-- 8. FAQ -->
<div class="jc-section" style="padding-top:0">
  <h2>Preguntas frecuentes</h2>
  <div class="jc-faq">
    <?php foreach ($p['faqs'] as $faq): ?>
    <div class="jc-faq-item">
      <h3><?php echo esc_html($faq['q']); ?></h3>
      <p><?php echo esc_html($faq['a']); ?></p>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- 9. ENLACES INTERNOS -->
<div class="jc-section" style="padding-top:0">
  <h2>Siguiente paso</h2>
  <div class="jc-links">
    <?php foreach ($p['links'] as $l): ?>
    <a href="<?php echo esc_attr($l[0]); ?>"><?php echo esc_html($l[1]); ?> <span>&rarr;</span></a>
    <?php endforeach; ?>
  </div>
</div>

<!-- 10. CTA FINAL -->
<div class="jc-cta-final">
  <h2><?php echo esc_html($p['cta_h2']); ?></h2>
  <p><?php echo esc_html($p['cta_p']); ?></p>
  <a href="<?php echo $wa; ?>" class="jc-btn" target="_blank" rel="noopener"><?php echo esc_html($p['cta_btn']); ?> &rarr;</a>
</div>

<footer class="jc-footer">
  <div class="jc-footer-inner">
    <div class="jc-footer-brand">
      <a href="https://jetcab.mx" style="font-family:var(--ff-head);font-size:1.25rem;font-weight:800;color:#fff;text-decoration:none">JET<span style="color:var(--orange)">CAB</span></a>
      <p>Renta de jets privados desde Toluca desde 1999. Certificación DGAC. Disponibles los 365 días del año.</p>
    </div>
    <div class="jc-footer-links">
      <a href="https://jetcab.mx/">Inicio</a>
      <a href="https://jetcab.mx/#flota">Nuestra flota</a>
      <a href="https://jetcab.mx/cotizar/">Cotizar</a>
      <a href="https://jetcab.mx/sobre-nosotros/">Sobre JETCAB</a>
      <a href="https://jetcab.mx/en/">English</a>
    </div>
    <div class="jc-footer-links">
      <a href="https://jetcab.mx/vuelos-privados-a-cancun/">CDMX a Cancún</a>
      <a href="https://jetcab.mx/vuelos-privados-a-los-cabos/">CDMX a Los Cabos</a>
      <a href="https://jetcab.mx/vuelos-privados-a-monterrey/">CDMX a Monterrey</a>
      <a href="https://jetcab.mx/vuelos-privados-a-guadalajara/">CDMX a Guadalajara</a>
      <a href="https://jetcab.mx/vuelos-privados-a-puerto-vallarta/">CDMX a Puerto Vallarta</a>
    </div>
  </div>
  <p class="jc-footer-bottom">&copy; <?php echo date('Y'); ?> JETCAB. Todos los derechos reservados. &mdash; <a href="https://jetcab.mx/aviso-de-privacidad/" style="color:#444">Aviso de privacidad</a></p>
</footer>

<a href="<?php echo $wa; ?>" target="_blank" rel="noopener" style="position:fixed;bottom:1.5rem;right:1.5rem;background:#25D366;color:#fff;width:56px;height:56px;border-radius:50%;display:flex;align-items:center;justify-content:center;text-decoration:none;box-shadow:0 4px 16px rgba(37,211,102,0.4);z-index:999;animation:pulse-wa 2.5s infinite" aria-label="WhatsApp JETCAB">
  <svg width="28" height="28" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
</a>

</body>
</html>
<?php
    return ob_get_clean();
}
