<?php
/*
 * JETCAB Rutas Nacionales ES v1
 * /vuelos-privados-a-{cancun|los-cabos|puerto-vallarta|monterrey|guadalajara}/
 * Diseño: fotos full-bleed de destino, H2 naranja, fondo negro, Barlow Condensed.
 * Espejo ES de jetcab-routes-domestic-v1.php (rutas EN /private-jet-mexico-city-{slug}/).
 */

add_action("init", function() {
    add_rewrite_rule('^vuelos-privados-a-(cancun|los-cabos|puerto-vallarta|monterrey|guadalajara)/?$', 'index.php?jetcab_domestic_es=$matches[1]', 'top');
});
add_filter("query_vars", function($vars) { $vars[] = "jetcab_domestic_es"; return $vars; });
add_action("template_redirect", function() {
    $route = get_query_var("jetcab_domestic_es");
    if (!$route) return;
    $routes = [
        "cancun" => [
            "title"        => 'Vuelos Privados a Cancún desde CDMX | Jet Privado — JETCAB',
            "dest"         => 'Cancún',
            "dest_full"    => 'Cancún, Quintana Roo',
            "slug"         => 'cancun',
            "slug_en"      => 'private-jet-mexico-city-cancun',
            "to_iata"      => 'CUN',
            "dest_airport" => 'Aeropuerto Internacional de Cancún',
            "time"         => '2h 15m',
            "price"        => '3,200',
            "p1"           => '$3,200',
            "p2"           => '$6,500',
            "p3"           => '$12,000',
            "meta_desc"    => 'Vuelos privados a Cancún desde CDMX en 2h 15m. Salida del FBO privado de Toluca, terminal privada en CUN a 15 min de la Zona Hotelera. Desde $3,200 USD. JETCAB.',
            "wa_text"      => 'Hola%2C+quiero+cotizar+un+vuelo+privado+de+CDMX+a+Cancun.',
            "hero_img"     => '1510097803753-ac3a64c7f298',
            "gallery_1"    => '1507525428034-b723cf961d3e',
            "gallery_2"    => '1436491865332-7a61a109cc05',
            "gallery_3"    => '1544551763-46a013bb70d5',
            "alt_1"        => 'Playa de Cancún con agua turquesa del Caribe mexicano',
            "alt_2"        => 'Jet privado en plataforma al atardecer listo para vuelo a Cancún',
            "alt_3"        => 'Vista aérea del mar de Cancún, destino de vuelos privados desde CDMX',
            "answer"       => 'Un vuelo privado de CDMX a Cancún cuesta desde $3,200 USD por aeronave en un Learjet 35 para 7 pasajeros, $6,500 USD en un Challenger 605 para 12 y $12,000 USD en un Gulfstream GV para 16. El precio es por avión, no por asiento. La salida es desde el FBO privado del Aeropuerto Internacional de Toluca (AIT) y el tiempo de vuelo es de 2 horas 15 minutos sin escalas hasta la terminal privada de Cancún (CUN).',
            "about_1"      => 'La ruta comercial CDMX–Cancún consume cuatro horas de puerta a puerta: fila de documentación en el AICM, filtro de seguridad, sala de espera, abordaje por grupos y la fila de taxis al llegar. En jet privado desde Toluca usted está en la Zona Hotelera en menos de tres horas. Sin check-in. Sin filtro. Sin conexión.',
            "about_2"      => 'La Zona Hotelera corre 26 kilómetros a lo largo del Caribe. La terminal privada de CUN queda a 15 minutos del primer resort y a 35 de Puerto Morelos. Al ser vuelo nacional no hay migración ni aduana: baja de la escalinata y su camioneta ya está en la plataforma.',
            "about_3"      => 'JETCAB opera desde el FBO privado del Aeropuerto Internacional de Toluca (AIT), a 40 minutos de Santa Fe y Polanco. Camioneta hasta la escalinata, abordaje en menos de 10 minutos, cero tráfico comercial. Es el protocolo Tarmac-to-Cabin con el que operamos desde hace 25 años.',
            "faqs" => [
                ["q" => '¿Cuánto cuesta un vuelo privado de CDMX a Cancún?', "a" => 'Desde $3,200 USD por aeronave en Learjet 35 (hasta 7 pasajeros). El Challenger 605 para 12 pasajeros parte de $6,500 USD y el Gulfstream GV para 16 de $12,000 USD. El precio cubre el avión completo, tripulación y tasas de aterrizaje en CUN; no se cobra por asiento. Cotización confirmada por WhatsApp en 30 minutos.'],
                ["q" => '¿Cuánto dura el vuelo privado de Toluca a Cancún?', "a" => '2 horas 15 minutos sin escalas desde el Aeropuerto Internacional de Toluca (AIT) hasta la terminal privada de Cancún (CUN). De puerta a puerta, desde Polanco o Santa Fe, el trayecto completo queda por debajo de 3 horas. Un pasajero comercial invierte entre 4 y 5 horas en la misma ruta.'],
                ["q" => '¿Desde qué aeropuerto salen los jets privados a Cancún?', "a" => 'Desde el FBO privado del Aeropuerto Internacional de Toluca (AIT), a 40 minutos de Santa Fe. Su camioneta entra directo a la plataforma y aborda en menos de 10 minutos. En Cancún aterriza en la terminal de aviación general de CUN, separada de las salas comerciales y a 15 minutos de la Zona Hotelera.'],
                ["q" => '¿Hay migración o aduana en un vuelo privado nacional a Cancún?', "a" => 'No. CDMX–Cancún es ruta nacional: sin migración, sin declaración aduanal, sin revisión de equipaje en banda. Al aterrizar en CUN su vehículo lo espera al pie de la escalinata y sale de la terminal privada en menos de 5 minutos. El único documento necesario es una identificación oficial vigente por pasajero.'],
                ["q" => '¿Puedo ir y regresar a Cancún el mismo día en jet privado?', "a" => 'Sí. Con 2 horas 15 minutos por tramo, el viaje redondo en el día es habitual para consejos de administración, inauguraciones hoteleras y eventos corporativos en la Riviera Maya. Salida 7:00 de Toluca, reunión a las 10:00 en Cancún y de regreso en la CDMX antes de las 20:00. Sujeto a disponibilidad de flota.'],
                ["q" => '¿Qué jet conviene para renta de jet privado CDMX Cancún en familia?', "a" => 'Para familias de 4 a 7 personas con equipaje de playa, el Learjet 35 desde $3,200 USD resuelve. Si viajan con niños, nana y más de 8 maletas, el Challenger 605 (12 asientos, cabina de pie, galley completo) desde $6,500 USD es la cabina que recomendamos. Mascotas en cabina, previa confirmación.'],
                ["q" => '¿Con cuánta anticipación debo reservar un jet privado Toluca Cancún?', "a" => 'Con 2 horas desde su solicitud el jet puede estar listo en Toluca, siempre que haya aeronave disponible. En temporada alta (Semana Santa, diciembre, Spring Break) recomendamos confirmar con 48 a 72 horas, porque los slots de la terminal privada de CUN se agotan. La aeronave queda bloqueada en cuanto confirma por WhatsApp.'],
            ],
        ],
        "los-cabos" => [
            "title"        => 'Vuelos Privados a Los Cabos desde CDMX | Jet Privado JETCAB',
            "dest"         => 'Los Cabos',
            "dest_full"    => 'Los Cabos, Baja California Sur',
            "slug"         => 'los-cabos',
            "slug_en"      => 'private-jet-mexico-city-los-cabos',
            "to_iata"      => 'SJD',
            "dest_airport" => 'Aeropuerto Internacional de Los Cabos',
            "time"         => '2h 30m',
            "price"        => '3,800',
            "p1"           => '$3,800',
            "p2"           => 'Cotizar',
            "p3"           => 'Cotizar',
            "meta_desc"    => 'Vuelos privados a Los Cabos desde CDMX en 2h 30m. Salida del FBO privado de Toluca, terminal privada en SJD a 20 min del Corredor. Desde $3,800 USD. JETCAB.',
            "wa_text"      => 'Hola%2C+quiero+cotizar+un+vuelo+privado+de+CDMX+a+Los+Cabos.',
            "hero_img"     => '1506905925346-21bda4d32df4',
            "gallery_1"    => '1562690423-a6f6b3b7af7b',
            "gallery_2"    => '1436491865332-7a61a109cc05',
            "gallery_3"    => '1476514525535-07fb3b4ae5f1',
            "alt_1"        => 'El Arco de Cabo San Lucas y resort de lujo en Los Cabos',
            "alt_2"        => 'Jet privado en plataforma al atardecer listo para vuelo a Los Cabos',
            "alt_3"        => 'Acantilados del Pacífico en Baja California Sur, destino de jet privado',
            "answer"       => 'Un vuelo privado de CDMX a Los Cabos cuesta bajo cotización por aeronave en Learjet 35 (7 pasajeros), Challenger 605 (12) y Gulfstream GV (16) bajo cotización. Se paga por avión, no por asiento. Despega del FBO privado de Toluca (AIT) y aterriza 2 horas 30 minutos después en la terminal privada de Los Cabos (SJD), a 20 minutos del Corredor Turístico.',
            "about_1"      => 'Los Cabos son dos ciudades unidas por el Corredor. San José del Cabo es la dirección discreta: hoteles boutique, galerías, la marina del centro histórico. Cabo San Lucas es el hub de hospitalidad internacional: resorts cinco estrellas, pesca deportiva, El Arco. En el Corredor están Las Ventanas, Montage, Esperanza y One&Only, todos a menos de 25 minutos de la terminal privada de SJD.',
            "about_2"      => 'En jet privado, CDMX–Los Cabos son 2 horas 30 minutos sin escalas. En comercial son mínimo 4 horas de puerta a puerta, y más en temporada alta cuando el AICM satura. La terminal privada de SJD está separada de las salas comerciales: sin autobús de plataforma, sin banda de equipaje, sin fila de taxis.',
            "about_3"      => 'Vuelo nacional: sin migración, sin aduana. Baja del avión y su camioneta está al pie de la escalinata. Los resorts del Corredor quedan a 20–30 minutos; la marina de Cabo San Lucas a 25. Si su destino es una residencia en Palmilla o Querencia, el trayecto es de 10 minutos.',
            "faqs" => [
                ["q" => '¿Cuánto cuesta un vuelo privado de CDMX a Los Cabos?', "a" => 'Desde $3,800 USD por aeronave en Learjet 35 para 7 pasajeros. El Challenger 605 para 12 y el Gulfstream GV para 16 se cotizan bajo solicitud, con respuesta en 30 minutos. El precio incluye tripulación, combustible y tasas de SJD; el avión completo es suyo, no se vende por asiento. Cotización por WhatsApp en 30 minutos.'],
                ["q" => '¿Cuánto dura el vuelo de Toluca a Los Cabos en jet privado?', "a" => '2 horas 30 minutos sin escalas desde el Aeropuerto Internacional de Toluca (AIT) hasta Los Cabos (SJD). Sumando los 40 minutos desde Santa Fe y los 10 minutos de abordaje Tarmac-to-Cabin, está en el Corredor en menos de 4 horas. En comercial, la misma ruta toma entre 5 y 6 horas de puerta a puerta.'],
                ["q" => '¿Qué resort de Los Cabos queda más cerca de la terminal privada de SJD?', "a" => 'Los resorts del Corredor (Las Ventanas, Montage, Esperanza, One&Only Palmilla) están a 15–25 minutos de la terminal privada de SJD. La marina de Cabo San Lucas a 25 minutos y Chileno Bay a 20. Coordinamos la camioneta al pie de la escalinata para que no haya ninguna espera al aterrizar.'],
                ["q" => '¿Hay migración en un vuelo privado nacional a Los Cabos?', "a" => 'No. CDMX–Los Cabos es ruta nacional: cero migración, cero aduana, cero revisión de equipaje. Al aterrizar en la terminal de aviación general de SJD baja directo a su vehículo. El tiempo en tierra es menor a 5 minutos. Solo necesita identificación oficial vigente por cada pasajero.'],
                ["q" => '¿Puedo rentar un jet privado CDMX Los Cabos para un grupo corporativo?', "a" => 'Sí. El Challenger 605 con 12 asientos y cabina de pie es la aeronave más solicitada para offsites directivos y consejos en Los Cabos, bajo cotización. Para grupos de hasta 16 con sala de juntas a bordo, el Gulfstream GV bajo cotización. Cotizamos en menos de una hora.'],
                ["q" => '¿Qué equipaje puedo llevar en un jet privado Toluca Los Cabos?', "a" => 'El Learjet 35 admite alrededor de 7 maletas medianas más bolsas de golf en compartimento. El Challenger 605 tiene bodega de 115 pies cúbicos: tablas cortas de surf, equipo de pesca y maletas para 12 personas sin problema. No hay límite de peso por pasajero como en aerolínea; solo confirmamos el volumen total al cotizar.'],
                ["q" => '¿Con cuánta anticipación reservo un vuelo privado a Los Cabos?', "a" => 'Con 2 horas desde su mensaje podemos tener el jet listo en Toluca si hay aeronave disponible. En Semana Santa, Thanksgiving y del 20 de diciembre al 6 de enero los slots de SJD se agotan: confirme con 72 horas de anticipación. La aeronave queda bloqueada en cuanto confirma por WhatsApp.'],
            ],
        ],
        "puerto-vallarta" => [
            "title"        => 'Vuelos Privados a Puerto Vallarta desde CDMX | Jet — JETCAB',
            "dest"         => 'Puerto Vallarta',
            "dest_full"    => 'Puerto Vallarta, Jalisco',
            "slug"         => 'puerto-vallarta',
            "slug_en"      => 'private-jet-mexico-city-puerto-vallarta',
            "to_iata"      => 'PVR',
            "dest_airport" => 'Aeropuerto Internacional de Puerto Vallarta',
            "time"         => '1h 45m',
            "price"        => '3,000',
            "p1"           => '$3,000',
            "p2"           => 'Cotizar',
            "p3"           => 'Cotizar',
            "meta_desc"    => 'Vuelos privados a Puerto Vallarta desde CDMX en 1h 45m. Salida del FBO de Toluca, terminal privada en PVR a 10 min del Malecón. Desde $3,000 USD. JETCAB.',
            "wa_text"      => 'Hola%2C+quiero+cotizar+un+vuelo+privado+de+CDMX+a+Puerto+Vallarta.',
            "hero_img"     => '1518509562785-1e33754df4b5',
            "gallery_1"    => '1476514525535-07fb3b4ae5f1',
            "gallery_2"    => '1436491865332-7a61a109cc05',
            "gallery_3"    => '1507003211169-0a1dd7228f2d',
            "alt_1"        => 'Costa tropical de Puerto Vallarta y Bahía de Banderas',
            "alt_2"        => 'Jet privado en plataforma listo para vuelo a Puerto Vallarta',
            "alt_3"        => 'Alberca de resort en Puerto Vallarta con vista a la bahía',
            "answer"       => 'Un vuelo privado de CDMX a Puerto Vallarta cuesta bajo cotización por aeronave en Learjet 35 (7 pasajeros), Challenger 605 (12) y Gulfstream GV (16) bajo cotización. Precio por avión, no por asiento. Sale del FBO privado de Toluca (AIT) y aterriza en 1 hora 45 minutos en la terminal privada de Puerto Vallarta (PVR), a 10 minutos del Malecón.',
            "about_1"      => 'Puerto Vallarta está a 1 hora 45 minutos de Toluca en jet privado. Un pasajero comercial desde la CDMX pasa esa misma hora y 45 minutos formado en el AICM antes de abordar. De puerta a puerta, lo privado reduce el viaje de 4 horas a menos de 2 horas 30 minutos.',
            "about_2"      => 'El Malecón queda a 10 minutos de la terminal privada de PVR. Para quien va a Punta Mita, donde están el Four Seasons y el St. Regis, el jet privado ahorra dos horas por tramo. Sin fila de migración nacional, sin aduana, sin banda de equipaje.',
            "about_3"      => 'La Riviera Nayarit empieza donde termina Bahía de Banderas: Sayulita, San Pancho, Punta de Mita, Litibú, todos a menos de una hora de PVR. La terminal de aviación general atiende su aeronave separada de la operación comercial. Camioneta al pie de la escalinata en cuanto apagan motores.',
            "faqs" => [
                ["q" => '¿Cuánto cuesta un vuelo privado de CDMX a Puerto Vallarta?', "a" => 'Desde $3,000 USD por aeronave en Learjet 35 para 7 pasajeros. El Challenger 605 para 12 y el Gulfstream GV para 16 se cotizan bajo solicitud, con respuesta en 30 minutos. Es precio por avión completo con tripulación, combustible y tasas de PVR; no se cobra por asiento. Cotización por WhatsApp en 30 minutos.'],
                ["q" => '¿Cuánto dura el vuelo privado de Toluca a Puerto Vallarta?', "a" => '1 hora 45 minutos sin escalas desde el Aeropuerto Internacional de Toluca (AIT) hasta Puerto Vallarta (PVR), una de las rutas más cortas de la flota JETCAB. De puerta a puerta, saliendo de Polanco, Lomas o Santa Fe, el trayecto completo queda en menos de 2 horas 30 minutos.'],
                ["q" => '¿Vale la pena volar en jet privado de CDMX a Puerto Vallarta?', "a" => 'En comercial, el pasajero pasa más tiempo en el AICM que en el aire: 2 horas de terminal para 1 hora 20 de vuelo. En privado desde Toluca el tiempo total baja de 4 horas a menos de 2 horas 30. Si su destino es Punta Mita, el ahorro es de 2 horas por tramo.'],
                ["q" => '¿Hay migración o aduana al llegar a Puerto Vallarta en jet privado?', "a" => 'No. Es vuelo nacional: sin migración, sin aduana, sin declaración. Aterriza en la terminal de aviación general de PVR, separada de las salas comerciales, y baja directo a su camioneta. Tiempo en tierra menor a 5 minutos. Solo se requiere identificación oficial vigente de cada pasajero.'],
                ["q" => '¿A qué distancia queda Punta Mita de la terminal privada de PVR?', "a" => 'Aproximadamente 45 minutos al norte por la carretera 200 hacia la Riviera Nayarit. Sayulita está a 50 minutos y San Pancho a 55. Coordinamos camioneta blindada o SUV de lujo directo desde la escalinata hasta su resort o residencia en Punta Mita, Kupuri o Litibú.'],
                ["q" => '¿Puedo hacer viaje redondo a Puerto Vallarta el mismo día?', "a" => 'Sí. Con 1 hora 45 por tramo es una de las rutas con más viajes redondos en el día: salida 8:00 de Toluca, comida de negocios o visita a propiedad en Punta Mita, y de regreso en la CDMX a las 19:00. La tripulación espera en PVR; no hay cargo de pernocta en ese caso.'],
                ["q" => '¿Qué jet recomiendan para renta de jet privado CDMX Puerto Vallarta en familia?', "a" => 'Para 4 a 7 personas, el Learjet 35 bajo cotización es la opción directa. Familias con niños, personal y más de 8 maletas viajan mejor en el Challenger 605 (12 asientos, cabina de pie) bajo cotización. Mascotas en cabina previa confirmación. Catering de firma cargado antes del abordaje.'],
            ],
        ],
        "monterrey" => [
            "title"        => 'Vuelos Privados a Monterrey desde CDMX | Jet Privado JETCAB',
            "dest"         => 'Monterrey',
            "dest_full"    => 'Monterrey, Nuevo León',
            "slug"         => 'monterrey',
            "slug_en"      => 'private-jet-mexico-city-monterrey',
            "to_iata"      => 'MTY',
            "dest_airport" => 'Aeropuerto Internacional de Monterrey',
            "time"         => '1h 15m',
            "price"        => '2,200',
            "p1"           => '$2,200',
            "p2"           => 'Cotizar',
            "p3"           => 'Cotizar',
            "meta_desc"    => 'Vuelos privados a Monterrey desde CDMX en 1h 15m. Salida del FBO privado de Toluca, terminal privada en MTY a 20 min de San Pedro. Desde $2,200 USD. JETCAB.',
            "wa_text"      => 'Hola%2C+quiero+cotizar+un+vuelo+privado+de+CDMX+a+Monterrey.',
            "hero_img"     => '1518773553398-650c184e0bb3',
            "gallery_1"    => '1486325212027-8081e485255e',
            "gallery_2"    => '1436491865332-7a61a109cc05',
            "gallery_3"    => '1544085701-00f6122853de',
            "alt_1"        => 'Skyline moderno de Monterrey con el Cerro de la Silla',
            "alt_2"        => 'Jet privado en plataforma listo para vuelo a Monterrey',
            "alt_3"        => 'Distrito corporativo de Monterrey de noche, destino de jets privados',
            "answer"       => 'Un vuelo privado de CDMX a Monterrey cuesta bajo cotización por aeronave en Learjet 35 (7 pasajeros), Challenger 605 (12) y Gulfstream GV (16) bajo cotización. Es una de las tarifas nacionales más competitivas de JETCAB y se paga por avión, no por asiento. Despega del FBO privado de Toluca (AIT) y aterriza en 1 hora 15 minutos en la terminal privada de Monterrey (MTY), a 20 minutos de San Pedro Garza García.',
            "about_1"      => 'Monterrey es la capital industrial de México. CEMEX, FEMSA, Alfa, Vitro, Banorte: los corporativos que construyeron la industria mexicana moderna tienen aquí su sede. San Pedro Garza García, a 20 minutos de la terminal privada de MTY, es el municipio con mayor ingreso per cápita de América Latina.',
            "about_2"      => 'Con 1 hora 15 minutos, CDMX–Monterrey es la ruta más rápida de la flota nacional de JETCAB después de Guadalajara. La mayoría de nuestros clientes la vuela redonda en el día: consejo matutino en San Pedro, comida en Valle Oriente y de regreso en la CDMX antes de las 18:00. El ahorro frente a comercial se mide en horas, no en minutos.',
            "about_3"      => 'Vuelo nacional de Toluca (AIT) al Aeropuerto Internacional General Mariano Escobedo (MTY). Sin migración, sin aduana. Terminal de aviación general separada de la operación comercial. Chofer al pie de la escalinata y camioneta blindada disponible para la última milla a San Pedro o Apodaca.',
            "faqs" => [
                ["q" => '¿Cuánto cuesta un vuelo privado de CDMX a Monterrey?', "a" => 'Desde $2,200 USD por aeronave en Learjet 35 para 7 pasajeros, una de las tarifas nacionales más bajas de JETCAB junto con Guadalajara. El Challenger 605 para 12 y el Gulfstream GV para 16 se cotizan bajo solicitud, con respuesta en 30 minutos. Precio por avión completo, no por asiento. Cotización por WhatsApp en 30 minutos.'],
                ["q" => '¿Cuánto dura el vuelo privado de Toluca a Monterrey?', "a" => '1 hora 15 minutos sin escalas desde el Aeropuerto Internacional de Toluca (AIT) hasta Monterrey (MTY). De puerta a puerta, desde Santa Fe hasta una oficina en San Pedro Garza García, el trayecto completo se resuelve en 2 horas 30 minutos. En comercial, la misma ruta toma de 4 a 5 horas.'],
                ["q" => '¿Puedo ir y volver de Monterrey el mismo día en jet privado?', "a" => 'Sí, y es el patrón de reserva más común en esta ruta. Salida 7:00 de Toluca, en San Pedro Garza García a las 9:00. Regreso a las 17:00 y en la CDMX a las 18:30. La tripulación permanece en MTY durante su agenda, sin cargo de pernocta en viajes redondos el mismo día.'],
                ["q" => '¿Qué aeropuerto usan los jets privados en Monterrey?', "a" => 'El Aeropuerto Internacional General Mariano Escobedo (MTY), en Apodaca, a 20 minutos de San Pedro Garza García y 25 de Valle Oriente. La terminal de aviación general está separada del tráfico comercial. Para reuniones en el Parque Industrial Apodaca o en Santa Catarina coordinamos la camioneta directo a la plataforma.'],
                ["q" => '¿Hay migración en un vuelo privado de CDMX a Monterrey?', "a" => 'No. Es ruta nacional: sin migración, sin aduana, sin filtro de seguridad comercial. Baja de la aeronave y su vehículo lo espera al pie de la escalinata; el tiempo en tierra en MTY es menor a 5 minutos. Cada pasajero solo presenta una identificación oficial vigente al abordar en Toluca.'],
                ["q" => '¿Conviene el Learjet o el Challenger para renta de jet privado CDMX Monterrey?', "a" => 'Para 1 a 7 ejecutivos con portafolios, el Learjet 35 bajo cotización resuelve el viaje en 1 hora 15. Si viaja con su consejo o con inversionistas y necesita mesa de trabajo, cabina de pie y Starlink para seguir la junta en el aire, el Challenger 605 bajo cotización es el escenario correcto.'],
                ["q" => '¿Cómo es el abordaje en Toluca para un jet privado a Monterrey?', "a" => 'Su camioneta ingresa al FBO privado del Aeropuerto Internacional de Toluca (AIT) y lo deja al pie de la escalinata. Del tarmac a la cabina pasan menos de 10 minutos. Sin sala de espera, sin filtro de rayos X comercial, sin anuncios por altavoz. Llega 15 minutos antes de la hora de despegue y listo.'],
            ],
        ],
        "guadalajara" => [
            "title"        => 'Vuelos Privados a Guadalajara desde CDMX | Jet — JETCAB',
            "dest"         => 'Guadalajara',
            "dest_full"    => 'Guadalajara, Jalisco',
            "slug"         => 'guadalajara',
            "slug_en"      => 'private-jet-mexico-city-guadalajara',
            "to_iata"      => 'GDL',
            "dest_airport" => 'Aeropuerto Internacional de Guadalajara',
            "time"         => '50m',
            "price"        => '1,800',
            "p1"           => '$1,800',
            "p2"           => 'Cotizar',
            "p3"           => 'Cotizar',
            "meta_desc"    => 'Vuelos privados a Guadalajara desde CDMX en 50 minutos. Salida del FBO privado de Toluca, terminal privada en GDL a 15 min de Zapopan. Desde $1,800 USD. JETCAB.',
            "wa_text"      => 'Hola%2C+quiero+cotizar+un+vuelo+privado+de+CDMX+a+Guadalajara.',
            "hero_img"     => '1558618666-fcd25c85cd64',
            "gallery_1"    => '1512917774080-9991f1c4c750',
            "gallery_2"    => '1436491865332-7a61a109cc05',
            "gallery_3"    => '1494522358652-f30e61a60313',
            "alt_1"        => 'Skyline moderno de Zapopan, Guadalajara, destino de vuelos privados',
            "alt_2"        => 'Jet privado en plataforma listo para vuelo a Guadalajara',
            "alt_3"        => 'Arquitectura colonial de Tlaquepaque en Guadalajara, Jalisco',
            "answer"       => 'Un vuelo privado de CDMX a Guadalajara cuesta bajo cotización por aeronave en Learjet 35 (7 pasajeros), Challenger 605 (12) y Gulfstream GV (16) bajo cotización. Es la tarifa más baja de la flota nacional de JETCAB y se paga por avión, no por asiento. Sale del FBO privado de Toluca (AIT) y aterriza en 50 minutos en la terminal privada de Guadalajara (GDL), a 15 minutos de Zapopan.',
            "about_1"      => 'Guadalajara está a 50 minutos de Toluca en jet privado: la ruta nacional más corta de la flota JETCAB. En comercial, el mismo viaje consume de 3 a 4 horas de puerta a puerta. En privado baja a menos de 2 horas en total. La cuenta es simple.',
            "about_2"      => 'Oracle, Intel, IBM, HP y Luxoft operan en el corredor tecnológico de Zapopan, a 15 minutos de la terminal privada de GDL. Andares y Puerta de Hierro a 20. La Ribera de Chapala, a 45 minutos del aeropuerto, es destino frecuente de clientes con residencia de fin de semana en Ajijic.',
            "about_3"      => 'Vuelo nacional de Toluca (AIT) al Aeropuerto Internacional Miguel Hidalgo y Costilla (GDL). Sin migración, sin aduana. La mayoría de nuestros clientes vuela redondo en el día: junta en Zapopan por la mañana, de regreso en la CDMX antes de la cena. Tequila queda a 50 minutos por carretera desde el aeropuerto.',
            "faqs" => [
                ["q" => '¿Cuánto cuesta un vuelo privado de CDMX a Guadalajara?', "a" => 'Desde $1,800 USD por aeronave en Learjet 35 para 7 pasajeros, la tarifa nacional más baja de JETCAB. El Challenger 605 para 12 y el Gulfstream GV para 16 se cotizan bajo solicitud, con respuesta en 30 minutos. El precio cubre el avión completo, tripulación y tasas de GDL; nunca por asiento. Cotización por WhatsApp en 30 minutos.'],
                ["q" => '¿Cuánto dura el vuelo privado de Toluca a Guadalajara?', "a" => '50 minutos sin escalas desde el Aeropuerto Internacional de Toluca (AIT) hasta Guadalajara (GDL), la ruta más corta de la flota nacional. De puerta a puerta, desde Santa Fe hasta una oficina en Zapopan, el trayecto completo queda por debajo de 2 horas. En comercial son de 3 a 4 horas.'],
                ["q" => '¿Vale la pena un jet privado para un vuelo tan corto a Guadalajara?', "a" => 'El pasajero comercial pasa de 2 a 3 horas en el AICM por 1 hora 10 de vuelo. En privado desde Toluca el viaje completo baja a menos de 2 horas de puerta a puerta: un ahorro de 2 horas o más por tramo. En un viaje redondo el mismo día recupera media jornada de trabajo.'],
                ["q" => '¿Puedo hacer viaje redondo CDMX Guadalajara el mismo día?', "a" => 'Sí, es el patrón más frecuente en esta ruta. Salida 7:00 de Toluca, en Zapopan a las 8:30. Regreso a las 16:00 y en la CDMX a las 18:00. La tripulación permanece en GDL durante su agenda sin cargo de pernocta. Para agendas que cierran tarde, el jet espera hasta la hora que usted indique.'],
                ["q" => '¿Qué aeropuerto usan los jets privados en Guadalajara?', "a" => 'El Aeropuerto Internacional Miguel Hidalgo y Costilla (GDL), en Tlajomulco, a 15 minutos de Zapopan, 20 de Providencia y 25 de Andares. La terminal de aviación general opera separada de las salas comerciales. Camioneta blindada disponible al pie de la escalinata para la última milla a Puerta de Hierro o Chapala.'],
                ["q" => '¿Hay migración en un vuelo privado nacional a Guadalajara?', "a" => 'No. CDMX–Guadalajara es ruta nacional: sin migración, sin aduana, sin filtro comercial. Baja de la aeronave y su vehículo lo espera en plataforma; el tiempo en tierra en GDL es menor a 5 minutos. Cada pasajero presenta identificación oficial vigente al abordar en el FBO de Toluca y nada más.'],
                ["q" => '¿Qué jet conviene para renta de jet privado CDMX Guadalajara?', "a" => 'Para 1 a 7 ejecutivos, el Learjet 35 bajo cotización es la decisión lógica: 50 minutos de vuelo y la tarifa más baja. Si lleva a su consejo o a inversionistas, el Challenger 605 bajo cotización ofrece cabina de pie, mesa de juntas y Starlink. Para 16 pasajeros, el Gulfstream GV bajo cotización.'],
            ],
        ],
    ];
    if (!isset($routes[$route])) return;
    status_header(200);
    header("Content-Type: text/html; charset=UTF-8");
    echo jetcab_domestic_es_page_v1($routes[$route], $routes);
    exit;
});


if (!function_exists('jc_json_str')) {
    // Escapa un string para usarlo dentro de un literal JSON (esc_js produce \' que es JSON inválido).
    function jc_json_str($str) {
        return substr(json_encode((string)$str, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), 1, -1);
    }
}

if (!function_exists('jc_price_html')) {
    // Prints "From $X USD" when a brief price exists, otherwise a quote-on-request label.
    function jc_price_html($v, $from = 'From', $quote = 'Quote on request') {
        $v = trim((string)$v);
        if (preg_match('/^\$?[0-9][0-9,]*$/', $v)) {
            return '<span class="jc-fleet-price-from">' . esc_html($from) . '</span><span class="jc-fleet-price-amount">' . esc_html(ltrim($v, '$') === $v ? '$' . $v : $v) . ' USD</span>';
        }
        return '<span class="jc-fleet-price-amount jc-fleet-price-quote">' . esc_html($quote) . '</span>';
    }
}

function jetcab_domestic_es_page_v1($r, $all) {
    $wa = 'https://wa.me/527291081200?text=' . $r['wa_text'];
    $canonical = 'https://jetcab.mx/vuelos-privados-a-' . $r['slug'] . '/';
    $canonical_en = 'https://jetcab.mx/' . $r['slug_en'] . '/';
    $hero_url = 'https://images.unsplash.com/photo-' . $r['hero_img'] . '?auto=format&fit=crop&w=1400&q=80';
    $others = [];
    foreach ($all as $k => $o) { if ($k !== $r['slug']) $others[] = $o; }
    ob_start();
?><!DOCTYPE html>
<html lang="es-MX">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo esc_html($r['title']); ?></title>
<meta name="description" content="<?php echo esc_attr($r['meta_desc']); ?>">
<link rel="canonical" href="<?php echo $canonical; ?>">
<link rel="alternate" hreflang="es" href="<?php echo $canonical; ?>">
<link rel="alternate" hreflang="en" href="<?php echo $canonical_en; ?>">
<link rel="alternate" hreflang="x-default" href="<?php echo $canonical; ?>">
<meta property="og:title" content="<?php echo esc_attr($r['title']); ?>">
<meta property="og:description" content="<?php echo esc_attr($r['meta_desc']); ?>">
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
{"@type":"WebPage","@id":"<?php echo $canonical; ?>","url":"<?php echo $canonical; ?>","name":"<?php echo jc_json_str($r['title']); ?>","description":"<?php echo jc_json_str($r['meta_desc']); ?>","inLanguage":"es-MX","isPartOf":{"@type":"WebSite","@id":"https://jetcab.mx/#website","url":"https://jetcab.mx","name":"JETCAB"}},
{"@type":"Service","name":"Vuelos privados a <?php echo jc_json_str($r['dest_full']); ?> desde Ciudad de México","description":"<?php echo jc_json_str($r['meta_desc']); ?>","provider":{"@type":"LocalBusiness","name":"JETCAB","url":"https://jetcab.mx","telephone":"+52-729-108-1200","foundingDate":"1999","areaServed":"México"},"serviceType":"Renta de jet privado","areaServed":["México","<?php echo jc_json_str($r['dest_full']); ?>"],"offers":{"@type":"Offer","priceCurrency":"USD","price":"<?php echo str_replace(',', '', $r['price']); ?>","priceSpecification":{"@type":"UnitPriceSpecification","priceCurrency":"USD","price":"<?php echo str_replace(',', '', $r['price']); ?>","unitText":"por aeronave"}}},
{"@type":"FAQPage","mainEntity":[<?php $fq=array_map(function($f){return '{"@type":"Question","name":"'.jc_json_str($f["q"]).'","acceptedAnswer":{"@type":"Answer","text":"'.jc_json_str($f["a"]).'"}}';},$r['faqs']);echo implode(',',$fq);?>]}
]}
</script>
<style>
:root{--orange:#E85A1E;--gold:#C9973F;--dark:#0D0D0D;--dark2:#141414;--text:#E8E8E8;--muted:#888;--ff-head:'Barlow Condensed',sans-serif;--ff-body:'Barlow',sans-serif}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{background:var(--dark);color:var(--text);font-family:var(--ff-body);line-height:1.6}
/* NAV */
.jc-nav{position:fixed;top:0;left:0;right:0;z-index:100;display:flex;align-items:center;justify-content:space-between;padding:1rem 2rem;background:rgba(13,13,13,0.9);backdrop-filter:blur(14px);border-bottom:1px solid rgba(255,255,255,0.07)}
.jc-nav-logo{font-family:var(--ff-head);font-size:1.5rem;font-weight:800;letter-spacing:0.08em;color:#fff;text-decoration:none}
.jc-nav-logo span{color:var(--orange)}
.jc-nav-links{display:flex;align-items:center;gap:2rem}
.jc-nav-links a{color:var(--muted);text-decoration:none;font-size:0.875rem;transition:color 0.2s cubic-bezier(.32,.72,0,1)}
.jc-nav-links a:hover{color:#fff}
.jc-nav-cta{background:var(--orange);color:#fff!important;padding:0.5rem 1.25rem;border-radius:50px;font-family:var(--ff-head);font-weight:700;letter-spacing:0.05em}
.jc-nav-cta:hover{background:#ff6a2f!important}
.jc-lang{color:var(--muted)!important;font-size:0.75rem;border:1px solid rgba(255,255,255,0.15);padding:0.3rem 0.6rem;border-radius:3px}
@media(max-width:768px){.jc-nav-links{display:none}}
/* HERO */
.jc-hero{position:relative;min-height:90vh;display:flex;align-items:flex-end;background-size:cover;background-position:center}
.jc-hero::after{content:'';position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.88) 0%,rgba(0,0,0,.35) 60%,transparent 100%)}
.jc-hero-inner{position:relative;z-index:2;padding:80px 24px 56px;max-width:900px;margin:0 auto;width:100%}
.jc-route-tag{font-family:var(--ff-head);font-size:.85rem;letter-spacing:.15em;text-transform:uppercase;color:var(--orange);margin-bottom:12px}
.jc-hero h1{font-family:var(--ff-head);font-size:clamp(2.5rem,6vw,5rem);font-weight:700;line-height:1.05;text-transform:uppercase;margin-bottom:16px;color:#fff}
.jc-hero-sub{font-size:1.1rem;color:rgba(255,255,255,.78);margin-bottom:32px;max-width:560px;line-height:1.6}
.jc-trust-row{display:flex;gap:2rem;flex-wrap:wrap;margin-bottom:32px}
.jc-trust-row span{font-size:0.78rem;color:rgba(255,255,255,0.45);letter-spacing:0.05em;text-transform:uppercase}
.jc-trust-row span strong{color:var(--gold);font-weight:600}
.jc-btn{display:inline-block;background:var(--orange);color:#fff;font-family:var(--ff-head);font-size:.95rem;letter-spacing:.1em;text-transform:uppercase;padding:14px 32px;border-radius:50px;text-decoration:none;transition:background 0.2s cubic-bezier(.32,.72,0,1),transform 0.15s}
.jc-btn:hover{background:#ff6a2f;transform:translateY(-1px)}
.jc-btn-ghost{background:transparent;border:1px solid rgba(255,255,255,.4);margin-left:12px;color:#fff!important}
.jc-btn-ghost:hover{border-color:rgba(255,255,255,.75);background:transparent!important}
/* SECTIONS */
.jc-section{padding:64px 24px;max-width:900px;margin:0 auto}
.jc-section h2{font-family:var(--ff-head);font-size:clamp(1.8rem,4vw,3rem);font-weight:700;text-transform:uppercase;color:var(--orange);margin-bottom:20px;line-height:1.1}
.jc-section p{font-size:1rem;line-height:1.75;color:var(--text);margin-bottom:16px}
.jc-section p:last-child{margin-bottom:0}
.jc-answer{font-size:1.15rem!important;line-height:1.7!important;color:#fff!important;border-left:1px solid var(--gold);padding-left:20px;margin-bottom:24px!important}
/* FULL-BLEED PHOTO */
.jc-photo{width:100%;height:480px;object-fit:cover;display:block}
.jc-photo.tall{height:600px}
/* PILARES */
.jc-pillars{display:grid;grid-template-columns:1fr;gap:16px;margin-top:32px}
@media(min-width:640px){.jc-pillars{grid-template-columns:repeat(3,1fr)}}
.jc-pillar{background:var(--dark2);border-top:3px solid var(--orange);padding:28px 24px}
.jc-pillar .num{font-family:var(--ff-head);font-size:2.4rem;font-weight:800;color:var(--gold);line-height:1;margin-bottom:10px}
.jc-pillar h3{font-family:var(--ff-head);font-size:1.3rem;font-weight:700;text-transform:uppercase;letter-spacing:.04em;color:#fff;margin-bottom:10px}
.jc-pillar p{font-size:.92rem;color:#aaa;line-height:1.65;margin:0}
/* BENEFITS */
.jc-benefits{list-style:none;margin:24px 0 0}
.jc-benefits li{padding:14px 0;border-bottom:1px solid rgba(255,255,255,.08);font-size:1rem;line-height:1.55}
.jc-benefits li:first-child{border-top:1px solid rgba(255,255,255,.08)}
.jc-benefits li strong{color:var(--orange);font-weight:600}
/* DETAILS GRID */
.jc-details-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin:24px 0}
@media(min-width:640px){.jc-details-grid{grid-template-columns:repeat(4,1fr)}}
.jc-detail-box{background:var(--dark2);padding:20px;border-left:1px solid var(--orange)}
.jc-detail-box .label{font-size:.72rem;letter-spacing:.12em;text-transform:uppercase;color:var(--muted);margin-bottom:6px;font-family:var(--ff-head)}
.jc-detail-box .value{font-family:var(--ff-head);font-size:1.35rem;font-weight:700;color:var(--text)}
/* FLEET */
.jc-fleet-grid{display:grid;grid-template-columns:1fr;gap:16px;margin-top:32px}
@media(min-width:640px){.jc-fleet-grid{grid-template-columns:repeat(3,1fr)}}
.jc-fleet-card{background:var(--dark2);border:1px solid rgba(255,255,255,.07);border-radius:6px;overflow:hidden;transition:border-color 0.2s cubic-bezier(.32,.72,0,1),transform 0.2s}
.jc-fleet-card:hover{border-color:rgba(232,90,30,.4);transform:translateY(-2px)}
.jc-fleet-card-img{position:relative;aspect-ratio:16/10;overflow:hidden}
.jc-fleet-card-img img{width:100%;height:100%;object-fit:cover;opacity:0.85;transition:opacity 0.3s cubic-bezier(.32,.72,0,1);display:block}
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
.jc-fleet-cta{display:block;text-align:center;background:transparent;border:1px solid var(--orange);color:var(--orange);padding:10px;border-radius:4px;font-size:.875rem;font-weight:600;text-decoration:none;transition:background 0.2s cubic-bezier(.32,.72,0,1),color 0.2s;font-family:var(--ff-head);letter-spacing:.05em;text-transform:uppercase}
.jc-fleet-cta:hover{background:var(--orange);color:#fff}
/* FAQ */
.jc-faq{margin:32px 0 0}
.jc-faq-item{border-bottom:1px solid rgba(255,255,255,.1);padding:20px 0}
.jc-faq-item:first-child{border-top:1px solid rgba(255,255,255,.1)}
.jc-faq-item h3{font-family:var(--ff-head);font-size:1.15rem;font-weight:600;color:var(--text);margin-bottom:8px}
.jc-faq-item p{font-size:.95rem;color:var(--muted);line-height:1.65;margin:0}
/* LINKS INTERNOS */
.jc-links{display:grid;grid-template-columns:1fr;gap:10px;margin-top:24px}
@media(min-width:640px){.jc-links{grid-template-columns:repeat(2,1fr)}}
.jc-links a{display:flex;align-items:center;justify-content:space-between;background:var(--dark2);border:1px solid rgba(255,255,255,.07);padding:16px 20px;color:var(--text);text-decoration:none;font-family:var(--ff-head);font-size:1.05rem;font-weight:600;letter-spacing:.03em;transition:border-color .2s cubic-bezier(.32,.72,0,1),color .2s}
.jc-links a:hover{border-color:var(--orange);color:#fff}
.jc-links a span{color:var(--orange);font-size:1.2rem}
/* CTA FINAL */
.jc-cta-final{background:var(--dark2);padding:80px 24px;text-align:center;border-top:1px solid rgba(255,255,255,.07)}
.jc-cta-final h2{font-family:var(--ff-head);font-size:clamp(1.6rem,4vw,2.8rem);font-weight:700;text-transform:uppercase;color:#fff;margin-bottom:16px;line-height:1.1}
.jc-cta-final p{color:var(--muted);margin-bottom:32px;font-size:1rem;max-width:480px;margin-left:auto;margin-right:auto;line-height:1.65}
/* FOOTER */
.jc-footer{background:#0A0A0A;border-top:1px solid rgba(255,255,255,.07);padding:3rem 24px;overflow:hidden}
.jc-footer-inner{max-width:900px;margin:0 auto;display:flex;justify-content:space-between;align-items:flex-start;gap:2rem;flex-wrap:wrap}
.jc-footer-brand p{font-size:.8rem;color:var(--muted);margin-top:8px;max-width:240px;line-height:1.6}
.jc-footer-links{display:flex;flex-direction:column;gap:8px}
.jc-footer-links a{font-size:.85rem;color:var(--muted);text-decoration:none;transition:color 0.2s cubic-bezier(.32,.72,0,1)}
.jc-footer-links a:hover{color:#fff}
.jc-footer-bottom{text-align:center;font-size:.75rem;color:#8a8a8a;padding-top:2rem;margin-top:2rem;border-top:1px solid rgba(255,255,255,.07);max-width:900px;margin-left:auto;margin-right:auto}
@keyframes pulse-wa{0%,100%{box-shadow:0 4px 16px rgba(37,211,102,.4)}50%{box-shadow:0 4px 24px rgba(37,211,102,.65)}}
@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation:none!important;transition:none!important}}
@media(max-width:640px){
  .jc-photo{height:280px}
  .jc-photo.tall{height:360px}
  .jc-btn-ghost{margin-left:0;margin-top:12px;display:inline-block}
}

/* ── Craft floor: browser surfaces, states, motion ── */
::selection{background:rgba(232,90,30,.35);color:#fff}
html{scrollbar-color:rgba(255,255,255,.18) #0D0D0D}
::-webkit-scrollbar{width:10px}::-webkit-scrollbar-track{background:#0D0D0D}::-webkit-scrollbar-thumb{background:rgba(255,255,255,.18);border-radius:10px;border:2px solid #0D0D0D}
:focus-visible{outline:2px solid var(--orange);outline-offset:3px;border-radius:4px}
a:focus:not(:focus-visible),button:focus:not(:focus-visible){outline:none}
[id]{scroll-margin-top:88px}
h1,h2,h3{text-wrap:balance}
p,li{text-wrap:pretty}
.jc-route-time,.jc-detail-box .value,.jc-fleet-price-amount,.jc-fleet-spec b,.jc-stat strong,.jc-hero-stats strong,.jc-pillar-num,.jc-pilar-num,.jc-route-table td,.jc-ruta-t{font-variant-numeric:tabular-nums}
.jc-fleet-price-quote{color:var(--muted);font-weight:500;letter-spacing:.02em}
a,button{transition-timing-function:cubic-bezier(.32,.72,0,1)}
.jc-btn,.jc-btn-primary,.jc-btn-ghost,.jc-fleet-cta,.jc-cta-btn,.jc-nav-cta,.jc-hero-cta a{transition:transform .22s cubic-bezier(.32,.72,0,1),background-color .22s cubic-bezier(.32,.72,0,1),border-color .22s cubic-bezier(.32,.72,0,1),color .22s cubic-bezier(.32,.72,0,1),box-shadow .22s cubic-bezier(.32,.72,0,1)}
.jc-btn:active,.jc-btn-primary:active,.jc-btn-ghost:active,.jc-fleet-cta:active,.jc-cta-btn:active,.jc-nav-cta:active{transform:scale(.98)}
@media(hover:hover) and (pointer:fine){.jc-fleet-card:hover,.jc-pillar:hover,.jc-pilar:hover,.jc-related-links a:hover{transition-timing-function:cubic-bezier(.32,.72,0,1)}}
@media(hover:none){.jc-fleet-card:hover,.jc-pillar:hover,.jc-pilar:hover{transform:none!important}}
@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation-duration:.01ms!important;transition-duration:.01ms!important;scroll-behavior:auto!important}}
</style>
</head>
<body>

<nav class="jc-nav">
  <a href="https://jetcab.mx" class="jc-nav-logo">JET<span>CAB</span></a>
  <div class="jc-nav-links">
    <a href="https://jetcab.mx/#flota">Flota</a>
    <a href="https://jetcab.mx/sobre-nosotros/">Nosotros</a>
    <a href="https://jetcab.mx/cotizar/">Cotizar</a>
    <a href="<?php echo $canonical_en; ?>" class="jc-lang">EN</a>
    <a href="<?php echo $wa; ?>" class="jc-nav-cta" target="_blank" rel="noopener">Cotizar por WhatsApp</a>
  </div>
</nav>

<!-- 1. HERO -->
<div class="jc-hero" style="background-image:url('<?php echo $hero_url; ?>')">
  <div class="jc-hero-inner">
    <div class="jc-route-tag">Ciudad de México &rarr; <?php echo esc_html($r['dest']); ?> &middot; Salida FBO Toluca</div>
    <h1>Vuelos privados<br>a <?php echo esc_html($r['dest']); ?></h1>
    <p class="jc-hero-sub"><?php echo esc_html($r['time']); ?> desde Toluca. Sin terminal, sin filas, sin escrutinio. Desde $<?php echo esc_html($r['price']); ?> USD por aeronave.</p>
    <div class="jc-trust-row">
      <span><strong>25 años</strong> en aviación</span>
      <span><strong>2,000+</strong> vuelos</span>
      <span><strong>Certificación</strong> DGAC</span>
      <span>Jet <strong>listo en 2h</strong></span>
    </div>
    <a href="<?php echo $wa; ?>" class="jc-btn" target="_blank" rel="noopener">Solicitar disponibilidad</a>
    <a href="#flota" class="jc-btn jc-btn-ghost">Ver aeronaves</a>
  </div>
</div>

<!-- 2. RESPUESTA DIRECTA (answer-first) -->
<div class="jc-section">
  <h2>¿Cuánto cuesta un vuelo privado de CDMX a <?php echo esc_html($r['dest']); ?>?</h2>
  <p class="jc-answer"><?php echo esc_html($r['answer']); ?></p>
  <p><?php echo esc_html($r['about_1']); ?></p>
</div>

<!-- 3. FOTO DESTINO -->
<img class="jc-photo tall" src="https://images.unsplash.com/photo-<?php echo esc_attr($r['gallery_1']); ?>?auto=format&fit=crop&w=1400&q=80" alt="<?php echo esc_attr($r['alt_1']); ?>" loading="lazy">

<!-- 4. PILARES -->
<div class="jc-section">
  <h2>Renta de jet privado CDMX <?php echo esc_html($r['dest']); ?>: así operamos</h2>
  <p>Tres protocolos que llevamos 25 años ejecutando desde el Aeropuerto Internacional de Toluca. No son promesas de marketing; son la operación.</p>
  <div class="jc-pillars">
    <div class="jc-pillar">
      <div class="num">NDA</div>
      <h3>Identity Shield</h3>
      <p>Confidencialidad de grado gubernamental. Tripulación bajo acuerdo de confidencialidad, sin pantallas de terminal, sin sistemas de reservación comercial. Nadie sabe que voló ni con quién.</p>
    </div>
    <div class="jc-pillar">
      <div class="num">10<small style="font-size:.9rem;color:var(--muted)"> min</small></div>
      <h3>Tarmac-to-Cabin</h3>
      <p>Su camioneta entra al FBO privado de Toluca y lo deja al pie de la escalinata. Del tarmac a la cabina en menos de 10 minutos. Cero filas, cero filtros, cero anuncios por altavoz.</p>
    </div>
    <div class="jc-pillar">
      <div class="num">2<small style="font-size:.9rem;color:var(--muted)"> horas</small></div>
      <h3>Jet listo en 2h</h3>
      <p>Soberanía del Tiempo: aeronave lista en 2 horas desde su mensaje, sujeta a disponibilidad. Flota certificada por DGAC y mantenida bajo estándar internacional. Cotización en 30 minutos.</p>
    </div>
  </div>
</div>

<!-- 5. FOTO JET -->
<img class="jc-photo" src="https://images.unsplash.com/photo-<?php echo esc_attr($r['gallery_2']); ?>?auto=format&fit=crop&w=1400&q=80" alt="<?php echo esc_attr($r['alt_2']); ?>" loading="lazy">

<!-- 6. DATOS DEL VUELO -->
<div class="jc-section">
  <h2>Jet privado Toluca <?php echo esc_html($r['dest']); ?>: datos del vuelo</h2>
  <div class="jc-details-grid">
    <div class="jc-detail-box"><div class="label">Salida</div><div class="value">AIT — Toluca</div></div>
    <div class="jc-detail-box"><div class="label">Destino</div><div class="value"><?php echo esc_html($r['to_iata']); ?> — <?php echo esc_html($r['dest']); ?></div></div>
    <div class="jc-detail-box"><div class="label">Tiempo de vuelo</div><div class="value"><?php echo esc_html($r['time']); ?></div></div>
    <div class="jc-detail-box"><div class="label">Desde</div><div class="value">$<?php echo esc_html($r['price']); ?> USD</div></div>
  </div>
  <p><?php echo esc_html($r['about_3']); ?></p>
  <p><?php echo esc_html($r['about_2']); ?></p>
</div>

<!-- 7. POR QUÉ PRIVADO -->
<div class="jc-section" style="padding-top:0">
  <h2>Lo que cambia al volar privado a <?php echo esc_html($r['dest']); ?></h2>
  <ul class="jc-benefits">
    <li><strong>Su horario, no el de la aerolínea:</strong> despega cuando usted decide. Sin ventanas de documentación, sin hora límite de abordaje.</li>
    <li><strong>Cero Fricción Logística:</strong> llegue 15 minutos antes del despegue. Sin terminal, sin filtro de seguridad comercial, sin sala de espera.</li>
    <li><strong>Sin migración ni aduana:</strong> vuelo nacional. Aterriza y sale: menos de 5 minutos en tierra en <?php echo esc_html($r['to_iata']); ?>.</li>
    <li><strong>Cabina exclusiva:</strong> solo su grupo a bordo. Las conversaciones que importan se quedan en la cabina.</li>
    <li><strong>Puerta a puerta más rápido:</strong> la salida privada desde Toluca (AIT) ahorra más de 2 horas frente a comercial en esta ruta.</li>
    <li><strong>Catering de firma:</strong> menú a su medida, cargado antes del abordaje. Última milla con camioneta blindada en destino si lo requiere.</li>
  </ul>
</div>

<!-- 8. FOTO DESTINO #3 -->
<img class="jc-photo" src="https://images.unsplash.com/photo-<?php echo esc_attr($r['gallery_3']); ?>?auto=format&fit=crop&w=1400&q=80" alt="<?php echo esc_attr($r['alt_3']); ?>" loading="lazy">

<!-- 9. FLOTA -->
<div class="jc-section" id="flota">
  <h2>Elija su aeronave</h2>
  <p>Toda la flota está certificada por DGAC y mantenida bajo estándar internacional. El precio es por aeronave completa, no por asiento.</p>
  <div class="jc-fleet-grid">
    <div class="jc-fleet-card">
      <div class="jc-fleet-card-img">
        <img src="https://jetcab.mx/wp-content/uploads/2024/11/Learjet35enrenta.jpeg" width="700" height="394" decoding="async" alt="Learjet 35, light jet para vuelos privados nacionales desde Toluca" loading="lazy">
        <span class="jc-fleet-badge">Light Jet</span>
      </div>
      <div class="jc-fleet-body">
        <div class="jc-fleet-class">Light Jet</div>
        <div class="jc-fleet-name">Learjet 35</div>
        <p class="jc-fleet-desc">Rápido y eficiente. Cabina de piel completa para 7 pasajeros, crucero a 850 km/h. La decisión correcta para equipos pequeños y viajes de última hora.</p>
        <div class="jc-fleet-specs">
          <div class="jc-fleet-spec"><strong>7</strong>Pasajeros</div>
          <div class="jc-fleet-spec"><strong>850 km/h</strong>Crucero</div>
          <div class="jc-fleet-spec"><strong>Wi-Fi</strong>Disponible</div>
        </div>
        <div class="jc-fleet-price"><?php echo jc_price_html($r['p1'], 'Desde', 'Cotizar'); ?></div>
        <a href="<?php echo $wa; ?>" class="jc-fleet-cta" target="_blank" rel="noopener">Reservar esta aeronave</a>
      </div>
    </div>
    <div class="jc-fleet-card">
      <div class="jc-fleet-card-img">
        <img src="https://jetcab.mx/wp-content/uploads/2024/11/Challenger-605-en-renta.jpeg" width="700" height="394" decoding="async" alt="Cabina del Challenger 605, jet privado midsize para grupos corporativos" loading="lazy">
        <span class="jc-fleet-badge">Midsize Jet</span>
      </div>
      <div class="jc-fleet-body">
        <div class="jc-fleet-class">Midsize Jet</div>
        <div class="jc-fleet-name">Challenger 605</div>
        <p class="jc-fleet-desc">Cabina de pie de 1.85 m, 12 asientos, galley completo y ventanas sobredimensionadas. La aeronave más reservada para consejos y offsites directivos.</p>
        <div class="jc-fleet-specs">
          <div class="jc-fleet-spec"><strong>12</strong>Pasajeros</div>
          <div class="jc-fleet-spec"><strong>882 km/h</strong>Crucero</div>
          <div class="jc-fleet-spec"><strong>Starlink</strong>Wi-Fi</div>
        </div>
        <div class="jc-fleet-price"><?php echo jc_price_html($r['p2'], 'Desde', 'Cotizar'); ?></div>
        <a href="<?php echo $wa; ?>" class="jc-fleet-cta" target="_blank" rel="noopener">Reservar esta aeronave</a>
      </div>
    </div>
    <div class="jc-fleet-card">
      <div class="jc-fleet-card-img">
        <img src="https://jetcab.mx/wp-content/uploads/2024/11/Gulfstream-Gv-en-Renta.jpeg" width="700" height="394" decoding="async" alt="Gulfstream GV, jet privado de cabina grande con recámara a bordo" loading="lazy">
        <span class="jc-fleet-badge">Cabina Grande</span>
      </div>
      <div class="jc-fleet-body">
        <div class="jc-fleet-class">Long Range</div>
        <div class="jc-fleet-name">Gulfstream GV</div>
        <p class="jc-fleet-desc">Recámara completa, sala de juntas para 8, Starlink. La aeronave que usan jefes de Estado. Cuando el viaje define el trato, esta es la cabina.</p>
        <div class="jc-fleet-specs">
          <div class="jc-fleet-spec"><strong>16</strong>Pasajeros</div>
          <div class="jc-fleet-spec"><strong>904 km/h</strong>Crucero</div>
          <div class="jc-fleet-spec"><strong>Recámara</strong>A bordo</div>
        </div>
        <div class="jc-fleet-price"><?php echo jc_price_html($r['p3'], 'Desde', 'Cotizar'); ?></div>
        <a href="<?php echo $wa; ?>" class="jc-fleet-cta" target="_blank" rel="noopener">Reservar esta aeronave</a>
      </div>
    </div>
  </div>
</div>

<!-- 10. FAQ -->
<div class="jc-section">
  <h2>Preguntas frecuentes: vuelos privados a <?php echo esc_html($r['dest']); ?></h2>
  <div class="jc-faq">
    <?php foreach ($r['faqs'] as $faq): ?>
    <div class="jc-faq-item">
      <h3><?php echo esc_html($faq['q']); ?></h3>
      <p><?php echo esc_html($faq['a']); ?></p>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- 11. ENLACES INTERNOS -->
<div class="jc-section" style="padding-top:0">
  <h2>Otras rutas privadas desde Toluca</h2>
  <p>Las cinco rutas nacionales con mayor demanda salen del mismo FBO privado. Mismo protocolo, misma tripulación certificada.</p>
  <div class="jc-links">
    <?php foreach ($others as $o): ?>
    <a href="https://jetcab.mx/vuelos-privados-a-<?php echo esc_attr($o['slug']); ?>/">Vuelos privados a <?php echo esc_html($o['dest']); ?> <span>&rarr;</span></a>
    <?php endforeach; ?>
    <a href="<?php echo $canonical_en; ?>" hreflang="en">Private jet Mexico City to <?php echo esc_html($r['dest']); ?> (English) <span>&rarr;</span></a>
    <a href="https://jetcab.mx/cotizar/">Cotizar un vuelo privado <span>&rarr;</span></a>
    <a href="https://jetcab.mx/#flota">Ver toda la flota JETCAB <span>&rarr;</span></a>
  </div>
</div>

<!-- 12. CTA FINAL -->
<div class="jc-cta-final">
  <h2>¿Vuela a <?php echo esc_html($r['dest']); ?> esta semana?</h2>
  <p>Jet listo en 2 horas desde su mensaje. 25 años operando desde Toluca. Certificación DGAC. Cotización en 30 minutos.</p>
  <a href="<?php echo $wa; ?>" class="jc-btn" target="_blank" rel="noopener">Escríbanos por WhatsApp &rarr;</a>
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
  <p class="jc-footer-bottom">&copy; <?php echo date('Y'); ?> JETCAB. Todos los derechos reservados. &mdash; <a href="https://jetcab.mx/aviso-de-privacidad/" style="color:#8a8a8a">Aviso de privacidad</a></p>
</footer>

<a href="<?php echo $wa; ?>" target="_blank" rel="noopener" style="position:fixed;bottom:1.5rem;right:1.5rem;background:#25D366;color:#fff;width:56px;height:56px;border-radius:50%;display:flex;align-items:center;justify-content:center;text-decoration:none;box-shadow:0 4px 16px rgba(37,211,102,0.4);z-index:999;animation:pulse-wa 2.5s infinite" aria-label="WhatsApp JETCAB">
  <svg width="28" height="28" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
</a>

</body>
</html>
<?php
    return ob_get_clean();
}
