<?php
/*
 * JETCAB Domestic Mexico Route Pages v1 - Destination-first, GEO/SEO optimized
 * WPCode snippet — domestic routes from Mexico City (AIT) to Mexican destinations
 */

add_action("init", function() {
    add_rewrite_rule('^private-jet-mexico-city-(cancun|los-cabos|puerto-vallarta|monterrey|guadalajara)/?$', 'index.php?jetcab_domestic=$matches[1]', 'top');
});
add_filter("query_vars", function($vars) { $vars[] = "jetcab_domestic"; return $vars; });
add_action("template_redirect", function() {
    $route = get_query_var("jetcab_domestic");
    if (!$route) return;
    $routes = [
        "cancun" => [
            "title"        => "Private Jet Mexico City to Cancun | Charter Flights - JETCAB",
            "dest"         => "Cancún",
            "dest_full"    => "Cancún, Quintana Roo",
            "from"         => "Mexico City",
            "from_iata"    => "AIT",
            "to_iata"      => "CUN",
            "time"         => "2h 15m",
            "slug"         => "cancun",
            "slug_es"      => "vuelo-privado-cdmx-cancun",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+Cancun.",
            "meta_desc"    => "Private jet from Mexico City to Cancun in 2h 15m. Land at the private terminal, 15 min from the Hotel Zone. From \$3,200. No immigration queues. JETCAB.",
            "fomo"         => "2 jets available this week",
            "p1"           => "\$3,200",
            "p2"           => "\$6,500",
            "p3"           => "\$12,000",
            "cta_urgency"  => "Flying to Cancún this week?",
            "cta_sub"      => "Quote in 30 minutes. No immigration, no domestic queue.",
            "hero_img"     => "1510097803753-ac3a64c7f298",
            "hero_line1"   => "Mexico City",
            "hero_line2"   => "to Cancún.",
            "hero_sub"     => "2 hours 15 minutes nonstop. Private terminal at CUN — 15 minutes from the Hotel Zone. No check-in line, no domestic security queue, no connection through an airport hub.",
            "fbo_name"     => "Cancún International — Private Terminal (CUN)",
            "fbo_dist1"    => "15 min from Zona Hotelera",
            "fbo_dist2"    => "20 min from Puerto Cancún",
            "dest_about"   => "Cancún\'s Hotel Zone runs 26 kilometers along the Caribbean coast. The commercial flight experience from Mexico City takes 4 hours door to door — check-in, security, the domestic terminal shuffle, the taxi queue at CUN. Private puts you in the Hotel Zone in under 3 hours total. No immigration process for domestic arrivals, no customs, no queue. Step off the aircraft and your driver is at the steps. The private terminal at Cancún handles corporate offsite groups, family travel, and high-season arrivals when commercial capacity disappears.",
            "dest_gallery" => ["1544551763-46a013bb70d5", "1507525428034-b723cf961d3e", "1519046904884-53103b34b206"],
            "dest_alts"    => ["Cancún Caribbean beach turquoise water", "Cancún white sand beach and palm trees", "Cancún Hotel Zone aerial view coastline"],
            "dest_areas"   => [
                ["name" => "Zona Hotelera", "desc" => "26 km of Caribbean beachfront. The five-star resort corridor. 15 minutes from the private terminal."],
                ["name" => "Puerto Cancún", "desc" => "New marina development. Luxury residential, golf, private marina slips."],
                ["name" => "El Centro", "desc" => "Downtown Cancún — local dining, business offices, residential towers."],
                ["name" => "Isla Mujeres", "desc" => "20 minutes by ferry from Puerto Juárez. Boutique hotels, quiet Caribbean."],
                ["name" => "Playa del Carmen", "desc" => "70 minutes south of CUN. La Quinta, Quinta Avenida, boutique hotels along the Riviera."],
            ],
            "faqs" => [
                ["q" => "How long is the private jet flight from Mexico City to Cancún?", "a" => "2 hours 15 minutes nonstop from Toluca (AIT) to Cancún (CUN). Door to door, including arrival at the private terminal, you\'re in the Hotel Zone in under 3 hours. Commercial passengers from CDMX typically spend 4 to 5 hours on the same trip."],
                ["q" => "Is there immigration or customs for a domestic private jet to Cancún?", "a" => "No. Mexico City to Cancún is a domestic flight — no immigration process, no customs declaration. You land at the private terminal, step off the aircraft, and go directly to your vehicle. The process takes under 5 minutes."],
                ["q" => "Which airport do private jets use when flying from Mexico City to Cancún?", "a" => "JETCAB departs from Toluca (AIT) and arrives at Cancún International Airport (CUN) private terminal. Separate from commercial traffic, with dedicated ground handling and priority runway access."],
                ["q" => "How much does a private jet from Mexico City to Cancún cost?", "a" => "From \$3,200 USD for a Learjet 35 (up to 7 passengers). Challenger 605 from \$6,500 for groups up to 12. Gulfstream GV from \$12,000. Price is per aircraft, not per seat."],
                ["q" => "Can I fly same-day to Cancún and back from Mexico City?", "a" => "Yes. At 2 hours 15 minutes each way, same-day round trips are common for corporate events and executive offsites. Departure as early as 6am, back before midnight. Subject to fleet availability."],
            ],
        ],
        "los-cabos" => [
            "title"        => "Private Jet Mexico City to Los Cabos | Charter Flights - JETCAB",
            "dest"         => "Los Cabos",
            "dest_full"    => "Los Cabos, Baja California Sur",
            "from"         => "Mexico City",
            "from_iata"    => "AIT",
            "to_iata"      => "SJD",
            "time"         => "2h 30m",
            "slug"         => "los-cabos",
            "slug_es"      => "vuelo-privado-cdmx-los-cabos",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+Los+Cabos.",
            "meta_desc"    => "Private jet from Mexico City to Los Cabos in 2h 30m. Land at SJD private terminal, 25 min from Cabo San Lucas. From \$3,800. No queues. JETCAB.",
            "fomo"         => "2 jets available this week",
            "p1"           => "\$3,800",
            "p2"           => "\$7,500",
            "p3"           => "\$14,000",
            "cta_urgency"  => "Los Cabos this week?",
            "cta_sub"      => "Quote in under 30 minutes. Fleet ready at Toluca.",
            "hero_img"     => "1582650625122-1c5e4f37e5f4",
            "hero_line1"   => "Mexico City",
            "hero_line2"   => "to Los Cabos.",
            "hero_sub"     => "2 hours 30 minutes nonstop. Private terminal at SJD — 25 minutes from Cabo San Lucas, 15 from San José del Cabo. The Corridor resorts in between.",
            "fbo_name"     => "Los Cabos International — Private Terminal (SJD)",
            "fbo_dist1"    => "25 min from Cabo San Lucas",
            "fbo_dist2"    => "15 min from San José del Cabo",
            "dest_about"   => "Los Cabos operates as two towns connected by the Corridor. San José del Cabo is the quieter address — boutique hotels, the art district, the marina. Cabo San Lucas is the international hospitality hub: five-star resorts, sport fishing, the Arch. For clients arriving for corporate offsites, real estate transactions, or family travel during high season, the private terminal at SJD makes the comparison with commercial obvious. No middle seat. No connection in CDMX Juárez. No shuttle from a remote parking structure at SJD. The Corridor\'s major resorts — Las Ventanas, Montage, Esperanza — are 20 minutes from the private terminal.",
            "dest_gallery" => ["1568402102990-bc814441e5e0", "1564501049412-61a79ceaf344", "1508672019048-2f4e2ca0f2a7"],
            "dest_alts"    => ["Los Cabos Arch El Arco landmark Pacific Ocean", "Los Cabos resort pool and Sea of Cortez", "Los Cabos marina and luxury yachts"],
            "dest_areas"   => [
                ["name" => "Cabo San Lucas", "desc" => "The international hub. Luxury marina, five-star hotels, Sport fishing capital of Baja."],
                ["name" => "San José del Cabo", "desc" => "Art galleries, boutique hotels, the marina district. The quieter address."],
                ["name" => "The Corridor", "desc" => "Las Ventanas, Montage, Esperanza, One&Only. The resort strip between the two towns."],
                ["name" => "Pedregal", "desc" => "Cabo\'s most exclusive residential hillside enclave, above Medano Beach."],
                ["name" => "Puerto Los Cabos", "desc" => "New marina development north of San José. 27-hole golf, private residences, boutique hotels."],
            ],
            "faqs" => [
                ["q" => "How long is the flight from Mexico City to Los Cabos on a private jet?", "a" => "2 hours 30 minutes nonstop from Toluca (AIT) to Los Cabos (SJD). Commercial passengers flying the same route typically take 4 to 5 hours door to door, including check-in and ground transportation."],
                ["q" => "Is there immigration or customs for a domestic private jet to Los Cabos?", "a" => "No. Mexico City to Los Cabos is a domestic route — no immigration, no customs declaration. You step off the aircraft at the SJD private terminal and go directly to your vehicle."],
                ["q" => "Which Cabo airport is closest to the main resorts?", "a" => "Los Cabos International (SJD) serves all resort areas. The Corridor resorts are 15 to 25 minutes from the private terminal. Las Ventanas al Paraíso is 20 minutes away. Montage and Esperanza are within the same window."],
                ["q" => "How much does a private jet from Mexico City to Los Cabos cost?", "a" => "From \$3,800 USD for a Learjet 35 (up to 7 passengers). Challenger 605 from \$7,500. Gulfstream GV from \$14,000. Full aircraft pricing — not per seat."],
                ["q" => "Can I charter a private jet for a group to Los Cabos for a corporate event?", "a" => "Yes. The Challenger 605 seats up to 12 and is the most-requested aircraft for executive offsite groups. We handle ground coordination, catering, and hotel ground transfers. Quote in under an hour."],
            ],
        ],
        "puerto-vallarta" => [
            "title"        => "Private Jet Mexico City to Puerto Vallarta | Charter Flights - JETCAB",
            "dest"         => "Puerto Vallarta",
            "dest_full"    => "Puerto Vallarta, Jalisco",
            "from"         => "Mexico City",
            "from_iata"    => "AIT",
            "to_iata"      => "PVR",
            "time"         => "1h 45m",
            "slug"         => "puerto-vallarta",
            "slug_es"      => "vuelo-privado-cdmx-puerto-vallarta",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+Puerto+Vallarta.",
            "meta_desc"    => "Private jet from Mexico City to Puerto Vallarta in 1h 45m. Private terminal at PVR, 10 min from the Malecon. From \$3,000. JETCAB — 25 years in aviation.",
            "fomo"         => "3 jets available this week",
            "p1"           => "\$3,000",
            "p2"           => "\$5,800",
            "p3"           => "\$10,500",
            "cta_urgency"  => "Puerto Vallarta this week?",
            "cta_sub"      => "Availability open. Quote in 30 minutes from Toluca.",
            "hero_img"     => "1518509562785-1e33754df4b5",
            "hero_line1"   => "Mexico City",
            "hero_line2"   => "to Puerto Vallarta.",
            "hero_sub"     => "1 hour 45 minutes nonstop. Private terminal at PVR — 10 minutes from the Malecón. No domestic queue, no connection. Punta Mita 45 minutes away.",
            "fbo_name"     => "Licenciado Gustavo Díaz Ordaz Airport (PVR)",
            "fbo_dist1"    => "10 min from the Malecón",
            "fbo_dist2"    => "45 min from Punta Mita",
            "dest_about"   => "Puerto Vallarta is 1 hour 45 minutes from Toluca on a private jet. The Malecón is 10 minutes from the PVR private terminal. Commercial passengers from CDMX spend that same 1h45m waiting at Juárez Airport before boarding. For clients heading to Punta Mita — the peninsula that holds the Four Seasons, the St. Regis, and some of Mexico\'s most expensive private residences — the private terminal shortens the overall journey by two hours each way. The Riviera Nayarit begins where Bahía de Banderas ends: Sayulita, San Pancho, Punta de Mita — all accessible from PVR in under an hour.",
            "dest_gallery" => ["1507003211169-0a1dd7228f2d", "1516815231560-8f41ec531527", "1571896349842-33c89424de2d"],
            "dest_alts"    => ["Puerto Vallarta Malecon waterfront and bay", "Puerto Vallarta colorful town and jungle hills", "Puerto Vallarta luxury resort pool Banderas Bay"],
            "dest_areas"   => [
                ["name" => "Malecón / Centro", "desc" => "The iconic boardwalk. Restaurants, galleries, the cathedral. 10 minutes from PVR."],
                ["name" => "Zona Romántica", "desc" => "Old Vallarta. Cobblestone streets, boutique hotels, the best dining in the city."],
                ["name" => "Marina Vallarta", "desc" => "Marina, golf club, luxury residential. Adjacent to the airport — 5 minutes."],
                ["name" => "Nuevo Vallarta", "desc" => "All-inclusive resort corridor. Families, large groups, beachfront condos."],
                ["name" => "Punta Mita", "desc" => "Four Seasons, St. Regis, private residences. The exclusive peninsula 45 minutes north."],
            ],
            "faqs" => [
                ["q" => "How long is the private jet flight from Mexico City to Puerto Vallarta?", "a" => "1 hour 45 minutes nonstop from Toluca (AIT) to Puerto Vallarta (PVR). The shortest option among JETCAB\'s Pacific coast routes. Door to door, under 2h30m total."],
                ["q" => "Is there immigration for a domestic private jet to Puerto Vallarta?", "a" => "No. Mexico City to Puerto Vallarta is a domestic flight — no immigration, no customs. You land at the PVR private terminal and go directly to your vehicle. Process takes under 5 minutes on the ground."],
                ["q" => "Which airport terminal do private jets use at Puerto Vallarta?", "a" => "The private terminal at Licenciado Gustavo Díaz Ordaz Airport (PVR), separate from commercial departures and arrivals. Ground handling is dedicated and separate from commercial traffic."],
                ["q" => "How much does a private jet from Mexico City to Puerto Vallarta cost?", "a" => "From \$3,000 USD for a Learjet 35 (up to 7 passengers). Challenger 605 from \$5,800. Gulfstream GV from \$10,500. Per aircraft, not per seat."],
                ["q" => "Is it worth flying private from Mexico City to Puerto Vallarta instead of commercial?", "a" => "At 1 hour 45 minutes flight time, the private vs. commercial comparison is clearest here: commercial passengers spend more time in Juárez Airport check-in than the actual flight. Private reduces total travel time from 4 hours to under 2h30m door to door."],
            ],
        ],
        "monterrey" => [
            "title"        => "Private Jet Mexico City to Monterrey | Charter Flights - JETCAB",
            "dest"         => "Monterrey",
            "dest_full"    => "Monterrey, Nuevo León",
            "from"         => "Mexico City",
            "from_iata"    => "AIT",
            "to_iata"      => "MTY",
            "time"         => "1h 15m",
            "slug"         => "monterrey",
            "slug_es"      => "vuelo-privado-cdmx-monterrey",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+Monterrey.",
            "meta_desc"    => "Private jet Mexico City to Monterrey in 1h 15m. Private terminal at MTY, 20 min from San Pedro Garza García. From \$2,200. Same-day round trips standard. JETCAB.",
            "fomo"         => "4 jets available this week",
            "p1"           => "\$2,200",
            "p2"           => "\$4,500",
            "p3"           => "\$8,500",
            "cta_urgency"  => "Business in Monterrey today?",
            "cta_sub"      => "Our most-requested domestic route. Same-day round trips available.",
            "hero_img"     => "1518773553398-650c184e0bb3",
            "hero_line1"   => "Mexico City",
            "hero_line2"   => "to Monterrey.",
            "hero_sub"     => "1 hour 15 minutes nonstop. Private terminal at MTY — 20 minutes from San Pedro Garza García. The industrial capital of Mexico. Most clients fly same-day round trip.",
            "fbo_name"     => "General Mariano Escobedo Airport (MTY)",
            "fbo_dist1"    => "20 min from San Pedro Garza García",
            "fbo_dist2"    => "25 min from Valle Oriente",
            "dest_about"   => "Monterrey is Mexico\'s industrial capital. CEMEX, FEMSA, Alfa, Vitro, Coca-Cola FEMSA, Banorte — the companies that built modern Mexican industry are headquartered here. San Pedro Garza García, 20 minutes from the private terminal at MTY, is the wealthiest municipality per capita in Latin America. The CDMX-Monterrey route at 1 hour 15 minutes is the fastest in our domestic fleet. Most of our clients on this route fly same-day round trips: morning board meeting in San Pedro, back in Mexico City before 6pm. The private terminal at General Mariano Escobedo Airport is dedicated — no commercial traffic, no domestic queue.",
            "dest_gallery" => ["1486325212027-8081e485255e", "1544085701-00f6122853de", "1504674900247-0877df9cc836"],
            "dest_alts"    => ["Monterrey city skyline and Cerro de la Silla mountain", "Monterrey modern business district at night", "Monterrey industrial and commercial architecture"],
            "dest_areas"   => [
                ["name" => "San Pedro Garza García", "desc" => "Wealthiest municipality in Latin America. CEMEX, Alfa, Banorte headquarters. Corporate towers, private offices."],
                ["name" => "Valle Oriente", "desc" => "Monterrey\'s financial and business corridor. Investment banks, consulting firms, luxury retail."],
                ["name" => "Centro de Monterrey", "desc" => "Macroplaza, Obispado, UANL. Government and institutional address."],
                ["name" => "Cumbres", "desc" => "Monterrey\'s largest residential development. Corporate executives, upper middle class residential."],
                ["name" => "Santa Catarina", "desc" => "Industrial corridor west of the city. Manufacturing plants, logistics hubs."],
            ],
            "faqs" => [
                ["q" => "How long is the private jet flight from Mexico City to Monterrey?", "a" => "1 hour 15 minutes nonstop from Toluca (AIT) to Monterrey (MTY). The shortest business route in the JETCAB fleet. Most clients do same-day round trips — morning meeting, back by dinner."],
                ["q" => "Can I fly same-day round trip from Mexico City to Monterrey on a private jet?", "a" => "Yes, and it\'s the most common booking pattern on this route. A 7am departure from Toluca puts you in San Pedro Garza García by 9am. Return at 5pm, back in Mexico City by 6:30pm. The day is yours."],
                ["q" => "Which airport do private jets use in Monterrey?", "a" => "JETCAB uses General Mariano Escobedo Airport (MTY), 20 minutes from San Pedro Garza García and 25 minutes from Valle Oriente. The private terminal is separate from commercial operations."],
                ["q" => "Is there a domestic queue or immigration for private jets to Monterrey?", "a" => "None. Monterrey is a domestic destination — no immigration, no customs. You land, step off, and your driver is at the steps. Ground time is under 5 minutes."],
                ["q" => "How much does a private jet from Mexico City to Monterrey cost?", "a" => "From \$2,200 USD for a Learjet 35 (up to 7 passengers) — our most competitive domestic rate. Challenger 605 from \$4,500. Gulfstream GV from \$8,500. Full aircraft pricing."],
            ],
        ],
        "guadalajara" => [
            "title"        => "Private Jet Mexico City to Guadalajara | Charter Flights - JETCAB",
            "dest"         => "Guadalajara",
            "dest_full"    => "Guadalajara, Jalisco",
            "from"         => "Mexico City",
            "from_iata"    => "AIT",
            "to_iata"      => "GDL",
            "time"         => "50m",
            "slug"         => "guadalajara",
            "slug_es"      => "vuelo-privado-cdmx-guadalajara",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+Guadalajara.",
            "meta_desc"    => "Private jet Mexico City to Guadalajara in 50 minutes. Private terminal at GDL, 15 min from Zapopan. From \$1,800. Fastest domestic route in our fleet. JETCAB.",
            "fomo"         => "4 jets available this week",
            "p1"           => "\$1,800",
            "p2"           => "\$3,800",
            "p3"           => "\$7,000",
            "cta_urgency"  => "Guadalajara today?",
            "cta_sub"      => "50 minutes. Same-day round trips. Quote in under 30 minutes.",
            "hero_img"     => "1558618666-fcd25c85cd64",
            "hero_line1"   => "Mexico City",
            "hero_line2"   => "to Guadalajara.",
            "hero_sub"     => "50 minutes nonstop from Toluca. Private terminal at GDL — 15 minutes from Zapopan, 20 from Providencia. The tech capital of Mexico. Door to door in under 2 hours.",
            "fbo_name"     => "Miguel Hidalgo y Costilla Airport (GDL)",
            "fbo_dist1"    => "15 min from Zapopan",
            "fbo_dist2"    => "20 min from Providencia",
            "dest_about"   => "Guadalajara is 50 minutes by private jet from Toluca — the shortest domestic route in the JETCAB fleet. The tech sector that anchors the city — Oracle, Intel, IBM, HP, and Luxoft all maintain significant operations in Guadalajara\'s \'Silicon Valley of Mexico\' — combined with the luxury real estate market in Zapopan and the lakeside communities around Lake Chapala makes this one of our most-flown same-day routes. By commercial, Mexico City to Guadalajara takes 3 to 4 hours door to door. Private eliminates the math: 50 minutes in the air, under 2 hours total.",
            "dest_gallery" => ["1512917774080-9991f1c4c750", "1519501025264-65ba15a82390", "1494522358652-f30e61a60313"],
            "dest_alts"    => ["Guadalajara modern city skyline Zapopan", "Guadalajara historic cathedral centro historico", "Guadalajara Tlaquepaque traditional architecture"],
            "dest_areas"   => [
                ["name" => "Zapopan", "desc" => "Corporate headquarters, tech campuses (Oracle, Intel, IBM). Luxury residential adjacent."],
                ["name" => "Providencia", "desc" => "The established executive residential and business district. Financial offices, law firms."],
                ["name" => "Tlaquepaque", "desc" => "Artisan district, galleries, design studios. Guadalajara\'s creative address."],
                ["name" => "Lake Chapala", "desc" => "Mexico\'s largest freshwater lake. 45 minutes from GDL — luxury lakeside residential."],
                ["name" => "Tequila region", "desc" => "90 minutes west of Guadalajara. Corporate tours, distillery visits, brand events."],
            ],
            "faqs" => [
                ["q" => "How long is the private jet flight from Mexico City to Guadalajara?", "a" => "50 minutes nonstop from Toluca (AIT) to Guadalajara (GDL). The shortest domestic route in the JETCAB fleet. Door to door, you are in Zapopan in under 2 hours from Mexico City."],
                ["q" => "Is it worth taking a private jet on such a short flight to Guadalajara?", "a" => "The value calculation is straightforward: commercial passengers spend 2 to 3 hours in Juárez Airport for a 45-minute flight. Private means door to door in under 2 hours, same-day return, and zero time wasted. For executives with morning meetings, the numbers are obvious."],
                ["q" => "Can I fly same-day round trip from Mexico City to Guadalajara?", "a" => "Yes, it\'s our most common booking pattern on this route. Departure at 7am, in Zapopan by 9am. Return at 4pm, back in Mexico City by 6pm. Single-day full agenda, both cities."],
                ["q" => "Which airport do private jets use in Guadalajara?", "a" => "JETCAB uses Miguel Hidalgo y Costilla International Airport (GDL), 15 minutes from Zapopan and 20 minutes from Providencia. The private terminal is separate from Terminal 1 and 2 commercial operations."],
                ["q" => "How much does a private jet from Mexico City to Guadalajara cost?", "a" => "From \$1,800 USD for a Learjet 35 — our lowest domestic rate. Challenger 605 from \$3,800. Gulfstream GV from \$7,000. Full aircraft pricing. For 4 or more passengers, the per-person cost is comparable to a business class ticket."],
            ],
        ],
    ];
    if (!isset($routes[$route])) return;
    status_header(200);
    header("Content-Type: text/html; charset=UTF-8");
    echo jetcab_domestic_page_v1($routes[$route]);
    exit;
});

function jetcab_domestic_page_v1($r) {
    $wa = 'https://wa.me/527291081200?text=' . $r['wa_text'];
    $canonical = 'https://jetcab.mx/private-jet-mexico-city-' . $r['slug'] . '/';
    $canonical_es = 'https://jetcab.mx/' . $r['slug_es'] . '/';
    ob_start();
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo esc_html($r['title']); ?></title>
<meta name="description" content="<?php echo esc_attr($r['meta_desc']); ?>">
<link rel="canonical" href="<?php echo $canonical; ?>">
<link rel="alternate" hreflang="en" href="<?php echo $canonical; ?>">
<link rel="alternate" hreflang="es" href="<?php echo $canonical_es; ?>">
<link rel="alternate" hreflang="x-default" href="<?php echo $canonical; ?>">
<meta property="og:title" content="<?php echo esc_attr($r['title']); ?>">
<meta property="og:description" content="<?php echo esc_attr($r['meta_desc']); ?>">
<meta property="og:url" content="<?php echo $canonical; ?>">
<meta property="og:type" content="website">
<meta property="og:image" content="https://jetcab.mx/wp-content/uploads/2023/09/jetcab-og.jpg">
<meta name="twitter:card" content="summary_large_image">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800&family=Barlow:wght@300;400;500;600&display=swap" rel="stylesheet">
<script type="application/ld+json">
{"@context":"https://schema.org","@graph":[
{"@type":"WebPage","@id":"<?php echo $canonical; ?>","url":"<?php echo $canonical; ?>","name":"<?php echo esc_js($r['title']); ?>","inLanguage":"en"},
{"@type":"Service","name":"Private Jet Charter Mexico City to <?php echo esc_js($r['dest_full']); ?>","description":"<?php echo esc_js($r['meta_desc']); ?>","provider":{"@type":"LocalBusiness","name":"JETCAB","url":"https://jetcab.mx","telephone":"+52-729-108-1200","foundingDate":"1999","areaServed":"Mexico"},"serviceType":"Air Charter","areaServed":["Mexico","<?php echo esc_js($r['dest_full']); ?>"],"offers":{"@type":"Offer","priceCurrency":"USD","price":"<?php echo ltrim($r['p1'],'\$'); ?>","priceSpecification":{"@type":"UnitPriceSpecification","priceCurrency":"USD","price":"<?php echo ltrim($r['p1'],'\$'); ?>","unitText":"per aircraft"}}},
{"@type":"FAQPage","mainEntity":[<?php $fq=array_map(function($f){return '{"@type":"Question","name":"'.esc_js($f["q"]).'","acceptedAnswer":{"@type":"Answer","text":"'.esc_js($f["a"]).'"}}';},$r['faqs']);echo implode(',',$fq);?>]}
]}
</script>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{--orange:#E85A1E;--gold:#C9973F;--dark:#0D0D0D;--dark2:#141414;--dark3:#1A1A1A;--border:rgba(255,255,255,0.08);--text:#E8E8E8;--muted:#888;--ff-head:'Barlow Condensed',sans-serif;--ff-body:'Barlow',sans-serif}
html{scroll-behavior:smooth}body{background:var(--dark);color:var(--text);font-family:var(--ff-body);line-height:1.6}
/* NAV */
.jc-nav{position:fixed;top:0;left:0;right:0;z-index:100;display:flex;align-items:center;justify-content:space-between;padding:1rem 2rem;background:rgba(13,13,13,0.88);backdrop-filter:blur(14px);border-bottom:1px solid var(--border)}
.jc-nav-logo{font-family:var(--ff-head);font-size:1.5rem;font-weight:800;letter-spacing:0.08em;color:#fff;text-decoration:none}
.jc-nav-logo span{color:var(--orange)}.jc-nav-links{display:flex;align-items:center;gap:2rem}
.jc-nav-links a{color:var(--muted);text-decoration:none;font-size:0.875rem;transition:color 0.2s}.jc-nav-links a:hover{color:#fff}
.jc-nav-cta{background:var(--orange);color:#fff!important;padding:0.5rem 1.25rem;border-radius:4px;font-weight:600;text-decoration:none}
.jc-nav-cta:hover{background:#ff6a2f!important}.jc-lang{color:var(--muted)!important;font-size:0.75rem;border:1px solid var(--border);padding:0.3rem 0.6rem;border-radius:3px}
@media(max-width:768px){.jc-nav-links{display:none}}
/* HERO */
.jc-hero{position:relative;min-height:100vh;display:flex;align-items:flex-end;overflow:hidden}
.jc-hero-bg{position:absolute;inset:0}
.jc-hero-bg img{width:100%;height:100%;object-fit:cover;display:block}
.jc-hero-grad{position:absolute;inset:0;background:linear-gradient(to top,rgba(13,13,13,1) 0%,rgba(13,13,13,0.7) 40%,rgba(13,13,13,0.3) 70%,rgba(13,13,13,0.15) 100%)}
.jc-hero-inner{position:relative;z-index:2;width:100%;max-width:1000px;margin:0 auto;padding:2rem 2rem 5rem}
.jc-route-badge{display:inline-flex;align-items:center;background:rgba(232,90,30,0.18);border:1px solid rgba(232,90,30,0.45);color:var(--orange);padding:0.4rem 1rem;border-radius:2px;font-family:var(--ff-head);font-size:0.85rem;letter-spacing:0.12em;text-transform:uppercase;margin-bottom:1.5rem}
.jc-hero h1{font-family:var(--ff-head);font-weight:800;line-height:0.95;color:#fff;letter-spacing:-0.02em;margin-bottom:1.5rem}
.jc-hero h1 .line1{display:block;font-size:clamp(3rem,8vw,6.5rem);color:rgba(255,255,255,0.55)}
.jc-hero h1 .line2{display:block;font-size:clamp(3.5rem,9vw,7.5rem)}
.jc-hero-sub{font-size:1.1rem;color:rgba(255,255,255,0.72);max-width:580px;line-height:1.65;margin-bottom:2rem}
.jc-avail{display:inline-flex;align-items:center;gap:0.6rem;background:rgba(20,20,20,0.9);border:1px solid rgba(255,255,255,0.1);padding:0.6rem 1.25rem;border-radius:3px;font-size:0.85rem;color:#ccc;margin-bottom:2rem}
.jc-avail-dot{width:8px;height:8px;background:#22c55e;border-radius:50%;flex-shrink:0;animation:pulse-green 2s infinite}
@keyframes pulse-green{0%,100%{box-shadow:0 0 0 0 rgba(34,197,94,0.4)}50%{box-shadow:0 0 0 6px rgba(34,197,94,0)}}
.jc-hero-ctas{display:flex;gap:1rem;flex-wrap:wrap;margin-bottom:2.5rem}
.btn-primary{background:var(--orange);color:#fff;padding:0.9rem 2rem;border-radius:4px;font-size:1rem;font-weight:600;text-decoration:none;transition:background 0.2s,transform 0.15s;display:inline-block}
.btn-primary:hover{background:#ff6a2f;transform:translateY(-1px)}
.btn-ghost{border:1px solid rgba(255,255,255,0.25);color:#fff;padding:0.9rem 2rem;border-radius:4px;font-size:1rem;text-decoration:none;transition:border-color 0.2s;display:inline-block}
.btn-ghost:hover{border-color:rgba(255,255,255,0.5)}
.jc-trust-bar{display:flex;gap:2rem;flex-wrap:wrap}
.jc-trust-bar span{font-size:0.8rem;color:rgba(255,255,255,0.45);letter-spacing:0.05em;text-transform:uppercase}
.jc-trust-bar span strong{color:var(--gold);font-weight:600}
/* ROUTE BAR */
.jc-route-bar{background:var(--dark2);border-top:1px solid var(--border);border-bottom:1px solid var(--border);padding:1.5rem 2rem}
.jc-route-bar-inner{max-width:1000px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap}
.jc-port{text-align:center}.jc-port-iata{font-family:var(--ff-head);font-size:2.2rem;font-weight:800;color:#fff;letter-spacing:0.05em}
.jc-port-name{font-size:0.78rem;color:var(--muted);letter-spacing:0.08em;text-transform:uppercase;margin-top:0.2rem}
.jc-route-line{flex:1;display:flex;align-items:center;gap:0.75rem}
.jc-route-line-bar{flex:1;height:1px;background:linear-gradient(to right,var(--orange),var(--gold))}
.jc-route-time{font-family:var(--ff-head);font-size:1.1rem;font-weight:700;color:var(--gold);white-space:nowrap}
/* DESTINATION SECTION */
.jc-dest{padding:5rem 2rem;background:var(--dark2)}
.jc-dest-inner{max-width:1100px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:start}
.jc-dest-label{font-family:var(--ff-head);font-size:0.78rem;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:var(--orange);margin-bottom:0.75rem}
.jc-dest h2{font-family:var(--ff-head);font-size:clamp(2.2rem,5vw,3.5rem);font-weight:800;color:#fff;line-height:1.05;margin-bottom:1.5rem}
.jc-dest-about{font-size:1rem;color:#bbb;line-height:1.8;margin-bottom:2rem}
.jc-fbo-box{background:var(--dark3);border:1px solid var(--border);border-left:3px solid var(--orange);padding:1.25rem 1.5rem;border-radius:0 6px 6px 0;margin-bottom:2rem}
.jc-fbo-box .label{font-family:var(--ff-head);font-size:0.7rem;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:var(--orange);margin-bottom:0.4rem}
.jc-fbo-box .name{font-family:var(--ff-head);font-size:1.1rem;font-weight:700;color:#fff;margin-bottom:0.3rem}
.jc-fbo-box .dist{font-size:0.875rem;color:var(--muted)}
.jc-areas-title{font-family:var(--ff-head);font-size:0.85rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#fff;margin-bottom:1rem}
.jc-areas{display:flex;flex-direction:column;gap:0.75rem}
.jc-area-item{display:flex;gap:1rem;align-items:flex-start}
.jc-area-dot{width:6px;height:6px;background:var(--orange);border-radius:50%;flex-shrink:0;margin-top:0.45rem}
.jc-area-name{font-family:var(--ff-head);font-size:0.95rem;font-weight:700;color:#fff}
.jc-area-desc{font-size:0.85rem;color:var(--muted);margin-top:0.15rem}
/* DESTINATION GALLERY */
.jc-gallery{display:grid;grid-template-columns:1fr 1fr;grid-template-rows:auto auto;gap:0.75rem}
.jc-gallery-main{grid-column:1 / -1;position:relative;border-radius:8px;overflow:hidden;aspect-ratio:16/9}
.jc-gallery-main img{width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.4s ease}
.jc-gallery-main:hover img{transform:scale(1.03)}
.jc-gallery-sub{position:relative;border-radius:8px;overflow:hidden;aspect-ratio:4/3}
.jc-gallery-sub img{width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.4s ease}
.jc-gallery-sub:hover img{transform:scale(1.03)}
/* ARRIVAL SECTION */
.jc-arrival{padding:5rem 2rem}
.jc-arrival-inner{max-width:1000px;margin:0 auto}
.jc-section-label{font-family:var(--ff-head);font-size:0.78rem;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:var(--orange);margin-bottom:0.75rem}
.jc-arrival h2{font-family:var(--ff-head);font-size:clamp(1.8rem,4vw,2.8rem);font-weight:800;color:#fff;line-height:1.1;margin-bottom:2.5rem}
.jc-steps{display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;position:relative}
.jc-steps::before{content:'';position:absolute;top:1.5rem;left:2rem;right:2rem;height:1px;background:linear-gradient(to right,var(--orange),var(--gold),var(--orange));opacity:0.3}
.jc-step{text-align:center;position:relative}
.jc-step-num{width:48px;height:48px;border-radius:50%;background:var(--dark2);border:2px solid var(--orange);display:flex;align-items:center;justify-content:center;font-family:var(--ff-head);font-size:1.2rem;font-weight:800;color:var(--orange);margin:0 auto 1rem;position:relative;z-index:1}
.jc-step h3{font-family:var(--ff-head);font-size:0.9rem;font-weight:700;letter-spacing:0.05em;color:#fff;text-transform:uppercase;margin-bottom:0.4rem}
.jc-step p{font-size:0.82rem;color:var(--muted);line-height:1.5}
/* FLEET */
.jc-fleet-section{padding:5rem 2rem;background:var(--dark2)}
.jc-fleet-inner{max-width:1000px;margin:0 auto}
.jc-fleet-section h2{font-family:var(--ff-head);font-size:clamp(1.8rem,4vw,2.6rem);font-weight:800;color:#fff;line-height:1.1;margin-bottom:0.75rem}
.jc-fleet-section > .jc-fleet-inner > p{color:#aaa;font-size:0.95rem;margin-bottom:2.5rem;max-width:600px}
.jc-fleet-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem}
.jc-fleet-card{background:var(--dark3);border:1px solid var(--border);border-radius:8px;overflow:hidden;transition:border-color 0.2s,transform 0.2s}
.jc-fleet-card:hover{border-color:rgba(232,90,30,0.4);transform:translateY(-3px)}
.jc-fleet-img{position:relative;aspect-ratio:16/10;overflow:hidden}
.jc-fleet-img img{width:100%;height:100%;object-fit:cover;opacity:0.85;transition:opacity 0.3s}
.jc-fleet-card:hover .jc-fleet-img img{opacity:1}
.jc-fleet-badge{position:absolute;bottom:0.75rem;left:0.75rem;font-family:var(--ff-head);font-size:0.7rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:var(--orange);background:rgba(0,0,0,0.82);padding:0.25rem 0.6rem;border-radius:2px}
.jc-fleet-body{padding:1.25rem}
.jc-fleet-class{font-size:0.7rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:var(--orange);margin-bottom:0.3rem}
.jc-fleet-name{font-family:var(--ff-head);font-size:1.4rem;font-weight:800;color:#fff;margin-bottom:0.5rem}
.jc-fleet-desc{font-size:0.85rem;color:#999;line-height:1.6;margin-bottom:1rem}
.jc-fleet-specs{display:flex;gap:1.25rem;flex-wrap:wrap;margin-bottom:1rem}
.jc-fleet-spec{font-size:0.78rem;color:var(--muted)}.jc-fleet-spec strong{display:block;font-size:0.95rem;color:#fff;font-weight:700;font-family:var(--ff-head)}
.jc-fleet-price{display:flex;align-items:baseline;gap:0.4rem;margin-bottom:0.75rem}
.jc-fleet-price-from{font-size:0.72rem;color:var(--muted)}
.jc-fleet-price-amount{font-family:var(--ff-head);font-size:1.5rem;font-weight:800;color:var(--gold)}
.jc-fleet-cta{display:block;text-align:center;background:transparent;border:1px solid var(--orange);color:var(--orange);padding:0.6rem 1rem;border-radius:4px;font-size:0.875rem;font-weight:600;text-decoration:none;transition:background 0.2s,color 0.2s}
.jc-fleet-cta:hover{background:var(--orange);color:#fff}
/* WHY */
.jc-why{padding:5rem 2rem}
.jc-why-inner{max-width:1000px;margin:0 auto}
.jc-why h2{font-family:var(--ff-head);font-size:clamp(1.8rem,4vw,2.6rem);font-weight:800;color:#fff;line-height:1.1;margin-bottom:2rem}
.jc-why-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.5rem}
.jc-why-card{border-left:2px solid var(--orange);padding-left:1.25rem}
.jc-why-card h3{font-family:var(--ff-head);font-size:1.05rem;font-weight:700;color:#fff;margin-bottom:0.5rem}
.jc-why-card p{font-size:0.875rem;color:var(--muted);line-height:1.6}
/* FAQ */
.jc-faq{padding:5rem 2rem;background:var(--dark2)}
.jc-faq-inner{max-width:800px;margin:0 auto}
.jc-faq h2{font-family:var(--ff-head);font-size:clamp(1.8rem,4vw,2.6rem);font-weight:800;color:#fff;line-height:1.1;margin-bottom:0.5rem}
.jc-faq-sub{font-size:0.9rem;color:var(--muted);margin-bottom:2rem}
.jc-faq-list{margin-top:0}.jc-faq-item{border-bottom:1px solid var(--border)}
.jc-faq-q{width:100%;background:none;border:none;color:#fff;font-family:var(--ff-body);font-size:1rem;font-weight:500;text-align:left;padding:1.25rem 0;cursor:pointer;display:flex;justify-content:space-between;align-items:center;gap:1rem}
.jc-faq-q:hover{color:var(--orange)}.jc-faq-icon{font-size:1.25rem;color:var(--orange);flex-shrink:0;transition:transform 0.25s}
.jc-faq-item.open .jc-faq-icon{transform:rotate(45deg)}
.jc-faq-a{max-height:0;overflow:hidden;transition:max-height 0.3s ease}
.jc-faq-item.open .jc-faq-a{max-height:300px}
.jc-faq-a p{padding:0 0 1.25rem;color:#aaa;font-size:0.95rem;line-height:1.75;margin:0}
/* CTA FINAL */
.jc-cta-final{padding:6rem 2rem;background:var(--dark3);text-align:center;border-top:1px solid var(--border)}
.jc-cta-final h2{font-family:var(--ff-head);font-size:clamp(2rem,5vw,3.5rem);font-weight:800;color:#fff;margin-bottom:1rem}
.jc-cta-final p{color:#888;font-size:1rem;max-width:500px;margin:0 auto 2.5rem}
.jc-cta-pair{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap}
/* FOOTER */
.jc-footer{background:#0A0A0A;border-top:1px solid var(--border);padding:3rem 2rem}
.jc-footer-inner{max-width:1000px;margin:0 auto;display:flex;justify-content:space-between;align-items:flex-start;gap:2rem;flex-wrap:wrap}
.jc-footer-brand p{font-size:0.8rem;color:var(--muted);margin-top:0.5rem;max-width:240px;line-height:1.6}
.jc-footer-links{display:flex;flex-direction:column;gap:0.5rem}
.jc-footer-links a{font-size:0.85rem;color:var(--muted);text-decoration:none;transition:color 0.2s}
.jc-footer-links a:hover{color:#fff}
.jc-footer-bottom{text-align:center;font-size:0.75rem;color:#555;padding-top:2rem;margin-top:2rem;border-top:1px solid var(--border);max-width:1000px;margin-left:auto;margin-right:auto}
@keyframes pulse-wa{0%,100%{box-shadow:0 4px 16px rgba(37,211,102,0.4)}50%{box-shadow:0 4px 24px rgba(37,211,102,0.65)}}
@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation:none!important;transition:none!important}}
@media(max-width:768px){
  .jc-dest-inner{grid-template-columns:1fr;gap:2.5rem}
  .jc-steps{grid-template-columns:1fr 1fr;gap:1.5rem}
  .jc-steps::before{display:none}
  .jc-fleet-grid{grid-template-columns:1fr}
}
@media(max-width:640px){
  .jc-route-bar-inner{flex-direction:column;text-align:center;gap:0.5rem}
  .jc-route-line{width:100%;justify-content:center}
  .jc-hero-ctas{flex-direction:column}
  .btn-primary,.btn-ghost{text-align:center}
  .jc-steps{grid-template-columns:1fr}
}
</style>
</head>
<body>

<nav class="jc-nav">
  <a href="https://jetcab.mx" class="jc-nav-logo">JET<span>CAB</span></a>
  <div class="jc-nav-links">
    <a href="https://jetcab.mx/#flota">Fleet</a>
    <a href="https://jetcab.mx/sobre-nosotros/">About</a>
    <a href="https://jetcab.mx/cotizar/">Pricing</a>
    <a href="<?php echo $canonical_es; ?>" class="jc-lang">ES</a>
    <a href="<?php echo $wa; ?>" class="jc-nav-cta" target="_blank">Get a Quote</a>
  </div>
</nav>

<section class="jc-hero">
  <div class="jc-hero-bg">
    <img src="https://images.unsplash.com/photo-<?php echo esc_attr($r['hero_img']); ?>?auto=format&fit=crop&w=1800&q=85" alt="<?php echo esc_attr($r['dest_full']); ?>" fetchpriority="high">
    <div class="jc-hero-grad"></div>
  </div>
  <div class="jc-hero-inner">
    <div class="jc-route-badge"><?php echo esc_html($r['from']); ?> &rarr; <?php echo esc_html($r['dest']); ?></div>
    <h1><span class="line1"><?php echo esc_html($r['hero_line1']); ?></span><span class="line2"><?php echo esc_html($r['hero_line2']); ?></span></h1>
    <p class="jc-hero-sub"><?php echo esc_html($r['hero_sub']); ?></p>
    <div class="jc-avail"><span class="jc-avail-dot"></span><?php echo esc_html($r['fomo']); ?></div>
    <div class="jc-hero-ctas">
      <a href="<?php echo $wa; ?>" class="btn-primary" target="_blank">Request availability &rarr;</a>
      <a href="https://jetcab.mx/cotizar/" class="btn-ghost">See pricing</a>
    </div>
    <div class="jc-trust-bar">
      <span><strong>25 years</strong> in aviation</span>
      <span><strong>2,000+</strong> flights</span>
      <span><strong>DGAC</strong> certified</span>
      <span>Jet <strong>ready in 2h</strong></span>
    </div>
  </div>
</section>

<div class="jc-route-bar">
  <div class="jc-route-bar-inner">
    <div class="jc-port"><div class="jc-port-iata"><?php echo esc_html($r['from_iata']); ?></div><div class="jc-port-name"><?php echo esc_html($r['from']); ?></div></div>
    <div class="jc-route-line"><div class="jc-route-line-bar"></div><div class="jc-route-time"><?php echo esc_html($r['time']); ?></div><div class="jc-route-line-bar"></div></div>
    <div class="jc-port"><div class="jc-port-iata"><?php echo esc_html($r['to_iata']); ?></div><div class="jc-port-name"><?php echo esc_html($r['dest']); ?></div></div>
  </div>
</div>

<section class="jc-dest">
  <div class="jc-dest-inner">
    <div>
      <div class="jc-dest-label">Your destination</div>
      <h2><?php echo esc_html($r['dest_full']); ?></h2>
      <p class="jc-dest-about"><?php echo esc_html($r['dest_about']); ?></p>
      <div class="jc-fbo-box">
        <div class="label">Private arrival terminal</div>
        <div class="name"><?php echo esc_html($r['fbo_name']); ?></div>
        <div class="dist"><?php echo esc_html($r['fbo_dist1']); ?> &nbsp;&middot;&nbsp; <?php echo esc_html($r['fbo_dist2']); ?></div>
      </div>
      <div class="jc-areas-title">Key areas</div>
      <div class="jc-areas">
        <?php foreach ($r['dest_areas'] as $area): ?>
        <div class="jc-area-item">
          <div class="jc-area-dot"></div>
          <div><div class="jc-area-name"><?php echo esc_html($area['name']); ?></div><div class="jc-area-desc"><?php echo esc_html($area['desc']); ?></div></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div>
      <div class="jc-gallery">
        <div class="jc-gallery-main">
          <img src="https://images.unsplash.com/photo-<?php echo esc_attr($r['dest_gallery'][0]); ?>?auto=format&fit=crop&w=1000&q=85" alt="<?php echo esc_attr($r['dest_alts'][0]); ?>" loading="lazy">
        </div>
        <div class="jc-gallery-sub">
          <img src="https://images.unsplash.com/photo-<?php echo esc_attr($r['dest_gallery'][1]); ?>?auto=format&fit=crop&w=600&q=80" alt="<?php echo esc_attr($r['dest_alts'][1]); ?>" loading="lazy">
        </div>
        <div class="jc-gallery-sub">
          <img src="https://images.unsplash.com/photo-<?php echo esc_attr($r['dest_gallery'][2]); ?>?auto=format&fit=crop&w=600&q=80" alt="<?php echo esc_attr($r['dest_alts'][2]); ?>" loading="lazy">
        </div>
      </div>
    </div>
  </div>
</section>

<section class="jc-arrival">
  <div class="jc-arrival-inner">
    <div class="jc-section-label">The arrival experience</div>
    <h2>From Mexico City to <?php echo esc_html($r['dest']); ?>.</h2>
    <div class="jc-steps">
      <div class="jc-step">
        <div class="jc-step-num">1</div>
        <h3>Private terminal</h3>
        <p>Toluca Airport (AIT). Armored vehicle to plane steps. No commercial terminal, no departure board, no queue.</p>
      </div>
      <div class="jc-step">
        <div class="jc-step-num">2</div>
        <h3><?php echo esc_html($r['time']); ?> nonstop</h3>
        <p>Full leather cabin. Crew briefed on your preferences. Catering loaded to order before boarding.</p>
      </div>
      <div class="jc-step">
        <div class="jc-step-num">3</div>
        <h3>No immigration</h3>
        <p>Domestic flight — no customs, no immigration process. Land at <?php echo esc_html($r['fbo_name']); ?> and walk straight to your vehicle.</p>
      </div>
      <div class="jc-step">
        <div class="jc-step-num">4</div>
        <h3><?php echo esc_html($r['fbo_dist1']); ?></h3>
        <p>Driver at the steps. No taxi queue, no baggage carousel. Under 5 minutes on the ground before you are moving.</p>
      </div>
    </div>
  </div>
</section>

<section class="jc-fleet-section">
  <div class="jc-fleet-inner">
    <div class="jc-section-label">Choose your aircraft</div>
    <h2>Three cabins for this route.</h2>
    <p>Every aircraft is DGAC-certified and maintained to international standards. Your crew briefs you on board.</p>
    <div class="jc-fleet-grid">
      <div class="jc-fleet-card">
        <div class="jc-fleet-img">
          <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=75" alt="Light jet private cabin interior" loading="lazy">
          <span class="jc-fleet-badge">Light Jet</span>
        </div>
        <div class="jc-fleet-body">
          <div class="jc-fleet-class">Light Jet</div><div class="jc-fleet-name">Learjet 35</div>
          <p class="jc-fleet-desc">Fast, efficient. Full leather, up to 7 passengers. Cruises at 850 km/h — the right choice for small teams and last-minute trips.</p>
          <div class="jc-fleet-specs">
            <div class="jc-fleet-spec"><strong>7</strong>Passengers</div>
            <div class="jc-fleet-spec"><strong>850 km/h</strong>Cruise</div>
            <div class="jc-fleet-spec"><strong>Wi-Fi</strong>Available</div>
          </div>
          <div class="jc-fleet-price"><span class="jc-fleet-price-from">From</span><span class="jc-fleet-price-amount"><?php echo esc_html($r['p1']); ?> USD</span></div>
          <a href="<?php echo $wa; ?>" class="jc-fleet-cta" target="_blank">Book this aircraft</a>
        </div>
      </div>
      <div class="jc-fleet-card">
        <div class="jc-fleet-img">
          <img src="https://images.unsplash.com/photo-1581093806997-124204d9fa9d?auto=format&fit=crop&w=800&q=75" alt="Midsize private jet Challenger cabin" loading="lazy">
          <span class="jc-fleet-badge">Midsize Jet</span>
        </div>
        <div class="jc-fleet-body">
          <div class="jc-fleet-class">Midsize Jet</div><div class="jc-fleet-name">Challenger 605</div>
          <p class="jc-fleet-desc">Stand-up cabin, 6ft tall. Seats 12. Full galley, windows twice the size of most jets in this class. For board-level meetings and group travel.</p>
          <div class="jc-fleet-specs">
            <div class="jc-fleet-spec"><strong>12</strong>Passengers</div>
            <div class="jc-fleet-spec"><strong>882 km/h</strong>Cruise</div>
            <div class="jc-fleet-spec"><strong>Starlink</strong>Wi-Fi</div>
          </div>
          <div class="jc-fleet-price"><span class="jc-fleet-price-from">From</span><span class="jc-fleet-price-amount"><?php echo esc_html($r['p2']); ?> USD</span></div>
          <a href="<?php echo $wa; ?>" class="jc-fleet-cta" target="_blank">Book this aircraft</a>
        </div>
      </div>
      <div class="jc-fleet-card">
        <div class="jc-fleet-img">
          <img src="https://images.unsplash.com/photo-1540962351504-03099e0a754b?auto=format&fit=crop&w=800&q=75" alt="Gulfstream GV large cabin private jet" loading="lazy">
          <span class="jc-fleet-badge">Large Cabin</span>
        </div>
        <div class="jc-fleet-body">
          <div class="jc-fleet-class">Large Cabin Jet</div><div class="jc-fleet-name">Gulfstream GV</div>
          <p class="jc-fleet-desc">Full bedroom, conference seating for 8, satellite Wi-Fi. The aircraft heads of state use. When the trip matters, this is the cabin you want.</p>
          <div class="jc-fleet-specs">
            <div class="jc-fleet-spec"><strong>16</strong>Passengers</div>
            <div class="jc-fleet-spec"><strong>904 km/h</strong>Cruise</div>
            <div class="jc-fleet-spec"><strong>Bedroom</strong>On board</div>
          </div>
          <div class="jc-fleet-price"><span class="jc-fleet-price-from">From</span><span class="jc-fleet-price-amount"><?php echo esc_html($r['p3']); ?> USD</span></div>
          <a href="<?php echo $wa; ?>" class="jc-fleet-cta" target="_blank">Book this aircraft</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="jc-why">
  <div class="jc-why-inner">
    <div class="jc-section-label">Why JETCAB</div>
    <h2>Why our clients come back.</h2>
    <div class="jc-why-grid">
      <div class="jc-why-card"><h3>Jet ready in 2 hours</h3><p>From your call to wheels-up. Our operations center has confirmed this on hundreds of last-minute requests. Two hours is real.</p></div>
      <div class="jc-why-card"><h3>No domestic queues</h3><p>Domestic flights mean no immigration, no customs, no declaration. You land and go. Total ground time at destination: under 5 minutes.</p></div>
      <div class="jc-why-card"><h3>The crew knows who you are</h3><p>Before you board, your captain has your preferences. The cabin is stocked how you like it. The only person waiting is your crew.</p></div>
      <div class="jc-why-card"><h3>25 years, zero incidents</h3><p>JETCAB has operated since 1999. DGAC certified, OACI compliant, unblemished safety record across 2,000+ flights.</p></div>
    </div>
  </div>
</section>

<section class="jc-faq">
  <div class="jc-faq-inner">
    <div class="jc-section-label">Common questions</div>
    <h2>Mexico City to <?php echo esc_html($r['dest']); ?>: what people ask.</h2>
    <p class="jc-faq-sub">Specific questions about this route, answered directly.</p>
    <div class="jc-faq-list">
      <?php foreach ($r['faqs'] as $faq): ?>
      <div class="jc-faq-item">
        <button class="jc-faq-q"><?php echo esc_html($faq['q']); ?> <span class="jc-faq-icon">+</span></button>
        <div class="jc-faq-a"><p><?php echo esc_html($faq['a']); ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="jc-cta-final">
  <div style="max-width:600px;margin:0 auto">
    <div class="jc-section-label">Ready to fly</div>
    <h2><?php echo esc_html($r['cta_urgency']); ?></h2>
    <p><?php echo esc_html($r['cta_sub']); ?> Send us the dates and we take care of everything else.</p>
    <div class="jc-cta-pair">
      <a href="<?php echo $wa; ?>" class="btn-primary" target="_blank">WhatsApp us now &rarr;</a>
      <a href="https://jetcab.mx/cotizar/" class="btn-ghost">Get a full quote online</a>
    </div>
  </div>
</section>

<footer class="jc-footer">
  <div class="jc-footer-inner">
    <div class="jc-footer-brand">
      <a href="https://jetcab.mx" style="font-family:var(--ff-head);font-size:1.25rem;font-weight:800;color:#fff;text-decoration:none">JET<span style="color:var(--orange)">CAB</span></a>
      <p>Private jet charters from Mexico since 1999. DGAC certified. Available 365 days a year.</p>
    </div>
    <div class="jc-footer-links">
      <a href="https://jetcab.mx/en/">English home</a>
      <a href="https://jetcab.mx/#flota">Our fleet</a>
      <a href="https://jetcab.mx/cotizar/">Request a quote</a>
      <a href="https://jetcab.mx/sobre-nosotros/">About JETCAB</a>
    </div>
    <div class="jc-footer-links">
      <a href="https://jetcab.mx/private-jet-mexico-city-cancun/">CDMX to Cancún</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-los-cabos/">CDMX to Los Cabos</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-monterrey/">CDMX to Monterrey</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-guadalajara/">CDMX to Guadalajara</a>
    </div>
  </div>
  <p class="jc-footer-bottom">&copy; <?php echo date('Y'); ?> JETCAB. All rights reserved. &mdash; <a href="https://jetcab.mx/aviso-de-privacidad/" style="color:#555">Privacy notice</a></p>
</footer>

<a href="<?php echo $wa; ?>" target="_blank" style="position:fixed;bottom:1.5rem;right:1.5rem;background:#25D366;color:#fff;width:56px;height:56px;border-radius:50%;display:flex;align-items:center;justify-content:center;text-decoration:none;box-shadow:0 4px 16px rgba(37,211,102,0.4);z-index:999;animation:pulse-wa 2.5s infinite" aria-label="WhatsApp JETCAB">
  <svg width="28" height="28" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
</a>

<script>
(function(){
  document.querySelectorAll('.jc-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=this.closest('.jc-faq-item');
      var isOpen=item.classList.contains('open');
      document.querySelectorAll('.jc-faq-item.open').forEach(function(i){i.classList.remove('open')});
      if(!isOpen)item.classList.add('open');
    });
  });
})();
</script>
</body>
</html>
<?php
    return ob_get_clean();
}
