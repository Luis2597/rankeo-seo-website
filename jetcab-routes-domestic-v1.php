<?php
/*
 * JETCAB Domestic Mexico Route Pages v1
 * Visual design: full-bleed destination photos, orange H2, black background
 * Matches ES destination page aesthetic (e.g. jetcab.mx/vuelos-privados-a-cancun/)
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
            "title"        => "Private Jet Mexico City to Cancún | 2h 15m Nonstop — JETCAB",
            "dest"         => "Cancún",
            "dest_full"    => "Cancún, Quintana Roo",
            "slug"         => "cancun",
            "es_live"      => true,
            "answer"       => "A JETCAB private jet from Mexico City (Toluca, AIT) to Cancún (CUN) takes 2 h 15 min nonstop and starts at $3,200 USD one-way on a Learjet 35 for 7 passengers, $6,500 USD on a Challenger 605 for 12, and $12,000 USD on a Gulfstream for 16. Per aircraft, not per seat; crew, fuel, catering and permits included. Quote confirmed in 30 minutes.",
            "slug_es"      => "vuelos-privados-a-cancun",
            "to_iata"      => "CUN",
            "dest_airport" => "Cancún International",
            "time"         => "2h 15m",
            "price"        => "3,200",
            "p1"           => "\$3,200",
            "p2"           => "\$6,500",
            "p3"           => "\$12,000",
            "meta_desc"    => "Private jet from Mexico City (Toluca) to Cancún in 2h 15m. Private terminal at CUN, 15 min from the Hotel Zone. Learjet 35 from \$3,200 USD. Ready in 2 hours.",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+Cancun.",
            "hero_img"     => "1510097803753-ac3a64c7f298",
            "gallery_1"    => "1507525428034-b723cf961d3e",
            "gallery_2"    => "1436491865332-7a61a109cc05",
            "gallery_3"    => "1544551763-46a013bb70d5",
            "alt_1"        => "Cancún beach turquoise Caribbean water",
            "alt_2"        => "Private jet on tarmac at sunset",
            "alt_3"        => "Cancún clear blue water aerial view",
            "about_1"      => "The commercial flight from Mexico City to Cancún takes four hours door to door — check-in lines at Juárez, the domestic terminal shuffle, the taxi queue at CUN. A private jet from Toluca puts you in the Hotel Zone in under three hours. No check-in. No domestic security queue. No connection.",
            "about_2"      => "Cancún\'s Hotel Zone runs 26 kilometers along the Caribbean coast. The private terminal at CUN is 15 minutes from the first resort. Domestic flights mean no immigration process, no customs declaration — step off the aircraft and your driver is at the steps.",
            "about_3"      => "JETCAB departs from Toluca International Airport (AIT), 40 minutes from Mexico City\'s financial center. Private terminal. Armored vehicle to plane steps. Zero commercial traffic.",
            "faqs" => [
                ["q" => "How long is the private jet flight from Mexico City to Cancún?", "a" => "2 hours 15 minutes nonstop from Toluca (AIT) to Cancún (CUN). Door to door, under 3 hours. Commercial passengers typically take 4 to 5 hours on the same route."],
                ["q" => "Is there immigration or customs for a domestic private jet to Cancún?", "a" => "No. Mexico City to Cancún is a domestic flight. No immigration, no customs declaration. You land at the private terminal and go directly to your vehicle in under 5 minutes."],
                ["q" => "Which airport do private jets use when flying to Cancún from Mexico City?", "a" => "JETCAB departs from Toluca (AIT) and arrives at Cancún International (CUN) private terminal, separate from commercial traffic."],
                ["q" => "How much does a private jet from Mexico City to Cancún cost?", "a" => "From \$3,200 USD for a Learjet 35 (up to 7 passengers). Challenger 605 from \$6,500. Gulfstream GV from \$12,000. Price is per aircraft, not per seat."],
                ["q" => "Can I fly same-day to Cancún and back from Mexico City?", "a" => "Yes. At 2 hours 15 minutes each way, same-day round trips are common for corporate events and executive offsites. Subject to fleet availability."],
            ],
        ],
        "los-cabos" => [
            "title"        => "Private Jet Mexico City to Los Cabos | 2h 30m — JETCAB",
            "dest"         => "Los Cabos",
            "dest_full"    => "Los Cabos, Baja California Sur",
            "slug"         => "los-cabos",
            "es_live"      => true,
            "answer"       => "A JETCAB private jet from Mexico City (Toluca, AIT) to Los Cabos (SJD) takes 2 h 30 min nonstop and starts at $3,800 USD one-way on a Learjet 35 for 7 passengers; a Challenger 605 for 12 or a Gulfstream for 16 is quoted on request. Domestic route: no immigration, no customs. Per aircraft, all-inclusive. Aircraft ready in 2 hours.",
            "slug_es"      => "vuelos-privados-a-los-cabos",
            "to_iata"      => "SJD",
            "dest_airport" => "Los Cabos International",
            "time"         => "2h 30m",
            "price"        => "3,800",
            "p1"           => "\$3,800",
            "p2"           => "Quote on request",
            "p3"           => "Quote on request",
            "meta_desc"    => "Private jet from Mexico City (Toluca) to Los Cabos in 2h 30m. Private terminal at SJD, 25 min from Cabo San Lucas. Learjet 35 from \$3,800 USD. Same-day flights.",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+Los+Cabos.",
            "hero_img"     => "1506905925346-21bda4d32df4",
            "gallery_1"    => "1562690423-a6f6b3b7af7b",
            "gallery_2"    => "1436491865332-7a61a109cc05",
            "gallery_3"    => "1476514525535-07fb3b4ae5f1",
            "alt_1"        => "Los Cabos Arch El Arco and luxury beach resort",
            "alt_2"        => "Private jet on tarmac at sunset",
            "alt_3"        => "Baja California Pacific Ocean cliff coastline",
            "about_1"      => "Los Cabos operates as two towns connected by the Corridor. San José del Cabo is the quieter address — boutique hotels, art galleries, the old town marina. Cabo San Lucas is the international hospitality hub: five-star resorts, sport fishing, the Arch. The Corridor holds Las Ventanas, Montage, Esperanza, and One&Only — all within 20 minutes of the private terminal at SJD.",
            "about_2"      => "By private jet, Mexico City to Los Cabos is 2 hours 30 minutes nonstop. Commercial passengers face a minimum of 4 hours door to door — more during high season when connections through Juárez fill up. The private terminal at SJD is separate from the commercial halls: no shuttle bus, no baggage carousel.",
            "about_3"      => "Domestic flight means no immigration, no customs. Step off the aircraft and your vehicle is at the steps. The Corridor\'s major resorts are 20 to 30 minutes away.",
            "faqs" => [
                ["q" => "How long is the flight from Mexico City to Los Cabos on a private jet?", "a" => "2 hours 30 minutes nonstop from Toluca (AIT) to Los Cabos (SJD). Commercial passengers on the same route typically take 4 to 5 hours door to door."],
                ["q" => "Is there immigration for a domestic private jet to Los Cabos?", "a" => "No. Mexico City to Los Cabos is a domestic route. No immigration, no customs. Step off at the SJD private terminal and go directly to your vehicle."],
                ["q" => "Which Cabo resort is closest to the private terminal at SJD?", "a" => "The Corridor resorts (Las Ventanas, Montage, Esperanza) are 15 to 25 minutes from the SJD private terminal. Cabo San Lucas marina is 25 minutes."],
                ["q" => "How much does a private jet from Mexico City to Los Cabos cost?", "a" => "From \$3,800 USD for a Learjet 35 (7 passengers). Challenger 605 and Gulfstream GV are quoted on request. Full aircraft pricing — not per seat."],
                ["q" => "Can I charter a private jet to Los Cabos for a group corporate offsite?", "a" => "Yes. The Challenger 605 seats 12 and is our most-requested aircraft for executive offsite groups. Quote in under an hour."],
            ],
        ],
        "puerto-vallarta" => [
            "title"        => "Private Jet Mexico City to Puerto Vallarta | 1h 45m — JETCAB",
            "dest"         => "Puerto Vallarta",
            "dest_full"    => "Puerto Vallarta, Jalisco",
            "slug"         => "puerto-vallarta",
            "es_live"      => true,
            "answer"       => "A JETCAB private jet from Mexico City (Toluca, AIT) to Puerto Vallarta (PVR) takes 1 h 45 min nonstop and starts at $3,000 USD one-way on a Learjet 35 for 7 passengers; a Challenger 605 for 12 or a Gulfstream for 16 is quoted on request. The PVR private terminal is 10 minutes from the Malecón and 45 from Punta Mita. Quote in 30 minutes.",
            "slug_es"      => "vuelos-privados-a-puerto-vallarta",
            "to_iata"      => "PVR",
            "dest_airport" => "Puerto Vallarta International",
            "time"         => "1h 45m",
            "price"        => "3,000",
            "p1"           => "\$3,000",
            "p2"           => "Quote on request",
            "p3"           => "Quote on request",
            "meta_desc"    => "Private jet from Mexico City (Toluca) to Puerto Vallarta in 1h 45m. Private terminal at PVR, 10 min from the Malecón, 45 from Punta Mita. From \$3,000 USD.",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+Puerto+Vallarta.",
            "hero_img"     => "1518509562785-1e33754df4b5",
            "gallery_1"    => "1476514525535-07fb3b4ae5f1",
            "gallery_2"    => "1436491865332-7a61a109cc05",
            "gallery_3"    => "1507003211169-0a1dd7228f2d",
            "alt_1"        => "Puerto Vallarta tropical coastline Bay of Banderas",
            "alt_2"        => "Private jet on tarmac",
            "alt_3"        => "Puerto Vallarta resort pool and bay view",
            "about_1"      => "Puerto Vallarta is 1 hour 45 minutes from Toluca on a private jet. Commercial passengers from Mexico City spend that same hour and 45 minutes waiting at Juárez Airport before boarding. Door to door, private cuts the trip from 4 hours to under 2 hours 30 minutes.",
            "about_2"      => "The Malecón is 10 minutes from the private terminal at PVR. For clients heading to Punta Mita — where the Four Seasons and St. Regis sit on the peninsula — private saves two hours each way. No domestic immigration queue, no customs.",
            "about_3"      => "The Riviera Nayarit begins where Bahía de Banderas ends: Sayulita, San Pancho, Punta de Mita — all within an hour of PVR. The private terminal handles your aircraft separate from commercial operations.",
            "faqs" => [
                ["q" => "How long is the private jet flight from Mexico City to Puerto Vallarta?", "a" => "1 hour 45 minutes nonstop from Toluca (AIT) to Puerto Vallarta (PVR) — one of the shortest routes in the JETCAB fleet."],
                ["q" => "Is there immigration for a domestic private jet to Puerto Vallarta?", "a" => "No. Domestic flight — no immigration, no customs. You land at the PVR private terminal and go directly to your vehicle. Ground time under 5 minutes."],
                ["q" => "Is it worth flying private from Mexico City to Puerto Vallarta?", "a" => "Commercial passengers spend more time at Juárez Airport than in the air. Private reduces door-to-door from 4 hours to under 2h30m. For Punta Mita, you save 2 hours each way."],
                ["q" => "How much does a private jet from Mexico City to Puerto Vallarta cost?", "a" => "From \$3,000 USD for a Learjet 35 (7 passengers). Challenger 605 and Gulfstream GV are quoted on request. Per aircraft, not per seat."],
                ["q" => "How far is Punta Mita from the Puerto Vallarta private terminal?", "a" => "Approximately 45 minutes north of PVR by car. We can arrange ground transportation from the private terminal directly to your resort."],
            ],
        ],
        "monterrey" => [
            "title"        => "Private Jet Mexico City to Monterrey | 1h 15m — JETCAB",
            "dest"         => "Monterrey",
            "dest_full"    => "Monterrey, Nuevo León",
            "slug"         => "monterrey",
            "es_live"      => true,
            "answer"       => "A JETCAB private jet from Mexico City (Toluca, AIT) to Monterrey (MTY) takes 1 h 15 min nonstop, JETCAB's fastest business route, and starts at $2,200 USD one-way on a Learjet 35 for 7 passengers; a Challenger 605 for 12 or a Gulfstream for 16 is quoted on request. Same-day round trips are the most common booking. Per aircraft, all-inclusive.",
            "slug_es"      => "vuelos-privados-a-monterrey",
            "to_iata"      => "MTY",
            "dest_airport" => "Monterrey International",
            "time"         => "1h 15m",
            "price"        => "2,200",
            "p1"           => "\$2,200",
            "p2"           => "Quote on request",
            "p3"           => "Quote on request",
            "meta_desc"    => "Private jet from Mexico City (Toluca) to Monterrey in 1h 15m. Private terminal at MTY, 20 min from San Pedro Garza García. From \$2,200 USD. Same-day trips.",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+Monterrey.",
            "hero_img"     => "1518773553398-650c184e0bb3",
            "gallery_1"    => "1486325212027-8081e485255e",
            "gallery_2"    => "1436491865332-7a61a109cc05",
            "gallery_3"    => "1544085701-00f6122853de",
            "alt_1"        => "Monterrey modern city skyline and Cerro de la Silla",
            "alt_2"        => "Private jet on tarmac",
            "alt_3"        => "Monterrey business district at night",
            "about_1"      => "Monterrey is Mexico\'s industrial capital. CEMEX, FEMSA, Alfa, Vitro, Banorte — the companies that built modern Mexican industry are headquartered here. San Pedro Garza García, 20 minutes from the private terminal at MTY, is the wealthiest municipality per capita in Latin America.",
            "about_2"      => "At 1 hour 15 minutes, CDMX-Monterrey is the fastest route in the JETCAB domestic fleet. Most clients fly same-day round trips: morning board meeting in San Pedro Garza García, back in Mexico City before 6pm. The time saved over commercial is measured in hours, not minutes.",
            "about_3"      => "Domestic flight from Toluca (AIT) to General Mariano Escobedo Airport (MTY). No immigration, no customs. Private terminal, separate from commercial operations. Driver at the steps.",
            "faqs" => [
                ["q" => "How long is the private jet flight from Mexico City to Monterrey?", "a" => "1 hour 15 minutes nonstop from Toluca (AIT) to Monterrey (MTY) — the fastest domestic route in the JETCAB fleet."],
                ["q" => "Can I fly same-day round trip from Mexico City to Monterrey?", "a" => "Yes, and it\'s the most common booking pattern on this route. Depart 7am, in San Pedro Garza García by 9am. Return at 5pm, back in CDMX by 6:30pm."],
                ["q" => "Which airport do private jets use in Monterrey?", "a" => "JETCAB uses General Mariano Escobedo Airport (MTY), 20 minutes from San Pedro Garza García and 25 minutes from Valle Oriente. Private terminal, separate from commercial traffic."],
                ["q" => "Is there immigration for private jets to Monterrey from Mexico City?", "a" => "No. Domestic flight — no immigration, no customs. Ground time at MTY is under 5 minutes."],
                ["q" => "How much does a private jet from Mexico City to Monterrey cost?", "a" => "From \$2,200 USD for a Learjet 35 — our most competitive domestic rate. Challenger 605 and Gulfstream GV are quoted on request. Full aircraft pricing."],
            ],
        ],
        "guadalajara" => [
            "title"        => "Private Jet Mexico City to Guadalajara | 50 min — JETCAB",
            "dest"         => "Guadalajara",
            "dest_full"    => "Guadalajara, Jalisco",
            "slug"         => "guadalajara",
            "es_live"      => true,
            "answer"       => "A JETCAB private jet from Mexico City (Toluca, AIT) to Guadalajara (GDL) takes 50 minutes nonstop and starts at $1,800 USD one-way on a Learjet 35 for 7 passengers, JETCAB's lowest domestic rate; Challenger 605 and Gulfstream are quoted on request. The GDL private terminal is 15 minutes from Zapopan. Door to door under 2 hours. Quote in 30 minutes.",
            "slug_es"      => "vuelos-privados-a-guadalajara",
            "to_iata"      => "GDL",
            "dest_airport" => "Miguel Hidalgo International",
            "time"         => "50m",
            "price"        => "1,800",
            "p1"           => "\$1,800",
            "p2"           => "Quote on request",
            "p3"           => "Quote on request",
            "meta_desc"    => "Private jet from Mexico City (Toluca) to Guadalajara in 50 minutes. Private terminal at GDL, 15 min from Zapopan. From \$1,800 USD. Same-day round trips.",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+Guadalajara.",
            "hero_img"     => "1558618666-fcd25c85cd64",
            "gallery_1"    => "1512917774080-9991f1c4c750",
            "gallery_2"    => "1436491865332-7a61a109cc05",
            "gallery_3"    => "1494522358652-f30e61a60313",
            "alt_1"        => "Guadalajara modern Zapopan city skyline",
            "alt_2"        => "Private jet on tarmac",
            "alt_3"        => "Guadalajara Tlaquepaque colonial architecture",
            "about_1"      => "Guadalajara is 50 minutes by private jet from Toluca — the shortest domestic route in the JETCAB fleet. By commercial, the same trip takes 3 to 4 hours door to door. Private brings it under 2 hours total. The math is simple.",
            "about_2"      => "Oracle, Intel, IBM, HP, and Luxoft all maintain significant operations in Guadalajara\'s tech corridor in Zapopan, 15 minutes from the private terminal at GDL. Lake Chapala, 45 minutes from the airport, is a frequent destination for luxury residential clients on this route.",
            "about_3"      => "Domestic flight from Toluca (AIT) to Miguel Hidalgo y Costilla Airport (GDL). No immigration, no customs. Most clients fly same-day round trips — morning meeting in Zapopan, back in Mexico City before dinner.",
            "faqs" => [
                ["q" => "How long is the private jet flight from Mexico City to Guadalajara?", "a" => "50 minutes nonstop from Toluca (AIT) to Guadalajara (GDL) — the shortest domestic route in the JETCAB fleet. Door to door under 2 hours."],
                ["q" => "Is it worth flying private from Mexico City to Guadalajara for such a short flight?", "a" => "Commercial passengers spend 2 to 3 hours in Juárez Airport for a 45-minute flight. Private reduces total travel to under 2 hours door to door — a saving of 2 hours or more each way."],
                ["q" => "Can I fly same-day round trip from Mexico City to Guadalajara?", "a" => "Yes — it\'s the most common booking pattern. Depart 7am, in Zapopan by 9am. Return at 4pm, back in Mexico City by 6pm."],
                ["q" => "Which airport do private jets use in Guadalajara?", "a" => "JETCAB uses Miguel Hidalgo y Costilla International Airport (GDL), 15 minutes from Zapopan and 20 minutes from Providencia. Private terminal separate from commercial operations."],
                ["q" => "How much does a private jet from Mexico City to Guadalajara cost?", "a" => "From \$1,800 USD for a Learjet 35 — our lowest domestic rate. Challenger 605 and Gulfstream GV are quoted on request. Per aircraft, not per seat."],
            ],
        ],
    ];
    if (!isset($routes[$route])) return;
    status_header(200);
    header("Content-Type: text/html; charset=UTF-8");
    echo jetcab_domestic_page_v1($routes[$route]);
    exit;
});


if (!function_exists('jc_json_str')) {
    // Escape a string for use inside a JSON string literal (esc_js produces \' which is invalid JSON).
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

function jetcab_domestic_page_v1($r) {
    $wa = 'https://wa.me/527291081200?text=' . $r['wa_text'];
    $canonical = 'https://jetcab.mx/private-jet-mexico-city-' . $r['slug'] . '/';
    $canonical_es = 'https://jetcab.mx/' . $r['slug_es'] . '/';
    $hero_url = 'https://images.unsplash.com/photo-' . $r['hero_img'] . '?auto=format&fit=crop&w=1400&q=80';
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
<?php if (!empty($r['es_live'])) : ?><link rel="alternate" hreflang="es" href="<?php echo $canonical_es; ?>"><?php endif; ?>
<link rel="alternate" hreflang="x-default" href="<?php echo $canonical; ?>">
<meta property="og:title" content="<?php echo esc_attr($r['title']); ?>">
<meta property="og:description" content="<?php echo esc_attr($r['meta_desc']); ?>">
<meta property="og:url" content="<?php echo $canonical; ?>">
<meta property="og:type" content="website">
<meta property="og:image" content="<?php echo $hero_url; ?>">
<meta property="og:image:width" content="1400"><meta property="og:image:height" content="933">
<meta property="og:image:alt" content="Private jet Mexico City to <?php echo esc_attr($r['dest']); ?> — JETCAB">
<meta property="og:site_name" content="JETCAB"><meta property="og:locale" content="en_US">
<meta name="twitter:card" content="summary_large_image"><meta name="twitter:title" content="<?php echo esc_attr($r['title']); ?>"><meta name="twitter:description" content="<?php echo esc_attr($r['meta_desc']); ?>"><meta name="twitter:image" content="<?php echo $hero_url; ?>">
<meta name="twitter:card" content="summary_large_image">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" as="image" href="<?php echo $hero_url; ?>" fetchpriority="high">
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Barlow:wght@400;500;600&display=swap" rel="stylesheet">
<script type="application/ld+json">
{"@context":"https://schema.org","@graph":[
{"@type":"WebPage","@id":"<?php echo $canonical; ?>#webpage","url":"<?php echo $canonical; ?>","name":"<?php echo jc_json_str($r['title']); ?>","description":"<?php echo jc_json_str($r['meta_desc']); ?>","primaryImageOfPage":{"@type":"ImageObject","url":"<?php echo $hero_url; ?>"},"breadcrumb":{"@id":"<?php echo $canonical; ?>#breadcrumb"},"speakable":{"@type":"SpeakableSpecification","cssSelector":[".jc-answer","h1",".jc-faq-item h3",".jc-faq-item p"]},"isPartOf":{"@id":"https://jetcab.mx/#website"},"about":{"@id":"https://jetcab.mx/#organization"},"inLanguage":"en"},
{"@type":"Service","name":"Private Jet Charter Mexico City to <?php echo jc_json_str($r['dest_full']); ?>","description":"<?php echo jc_json_str($r['meta_desc']); ?>","provider":{"@type":"LocalBusiness","@id":"https://jetcab.mx/#organization","name":"JETCAB","url":"https://jetcab.mx/","telephone":"+52-729-108-1200","foundingDate":"1999","areaServed":"Mexico"},"serviceType":"Air Charter","areaServed":["Mexico","<?php echo jc_json_str($r['dest_full']); ?>"],"offers":{"@type":"Offer","priceCurrency":"USD","price":"<?php echo str_replace(',', '', $r['price']); ?>","priceSpecification":{"@type":"UnitPriceSpecification","priceCurrency":"USD","price":"<?php echo str_replace(',', '', $r['price']); ?>","unitText":"per aircraft, one-way"},"availability":"https://schema.org/InStock","url":"<?php echo $canonical; ?>"}},
{"@type":"BreadcrumbList","@id":"<?php echo $canonical; ?>#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"name":"JETCAB","item":"https://jetcab.mx/en/"},{"@type":"ListItem","position":2,"name":"Private Jet Routes from Mexico City","item":"https://jetcab.mx/en/#destinations"},{"@type":"ListItem","position":3,"name":"Mexico City to <?php echo jc_json_str($r['dest']); ?>"}]},
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
.jc-nav-links a{color:var(--muted);text-decoration:none;font-size:0.875rem;transition:color 0.2s}
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
.jc-btn{display:inline-block;background:var(--orange);color:#fff;font-family:var(--ff-head);font-size:.95rem;letter-spacing:.1em;text-transform:uppercase;padding:14px 32px;border-radius:50px;text-decoration:none;transition:background 0.2s,transform 0.15s}
.jc-btn:hover{background:#ff6a2f;transform:translateY(-1px)}
.jc-btn-ghost{background:transparent;border:1px solid rgba(255,255,255,.4);margin-left:12px;color:#fff!important}
.jc-btn-ghost:hover{border-color:rgba(255,255,255,.75);background:transparent!important}
/* SECTIONS */
.jc-section{padding:64px 24px;max-width:900px;margin:0 auto}
.jc-section h2{font-family:var(--ff-head);font-size:clamp(1.8rem,4vw,3rem);font-weight:700;text-transform:uppercase;color:var(--orange);margin-bottom:20px;line-height:1.1}
.jc-section p{font-size:1rem;line-height:1.75;color:var(--text);margin-bottom:16px}
.jc-section p:last-child{margin-bottom:0}
/* FULL-BLEED PHOTO */
.jc-photo{width:100%;height:480px;object-fit:cover;display:block}
.jc-photo.tall{height:600px}
/* BENEFITS */
.jc-benefits{list-style:none;margin:24px 0 0}
.jc-benefits li{padding:14px 0;border-bottom:1px solid rgba(255,255,255,.08);font-size:1rem;line-height:1.55}
.jc-benefits li:first-child{border-top:1px solid rgba(255,255,255,.08)}
.jc-benefits li strong{color:var(--orange);font-weight:600}
/* DETAILS GRID */
.jc-details-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin:24px 0}
@media(min-width:640px){.jc-details-grid{grid-template-columns:repeat(4,1fr)}}
.jc-detail-box{background:var(--dark2);padding:20px;border-left:3px solid var(--orange)}
.jc-detail-box .label{font-size:.72rem;letter-spacing:.12em;text-transform:uppercase;color:var(--muted);margin-bottom:6px;font-family:var(--ff-head)}
.jc-detail-box .value{font-family:var(--ff-head);font-size:1.35rem;font-weight:700;color:var(--text)}
/* FLEET */
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
/* FAQ */
.jc-faq{margin:32px 0 0}
.jc-faq-item{border-bottom:1px solid rgba(255,255,255,.1);padding:20px 0}
.jc-faq-item:first-child{border-top:1px solid rgba(255,255,255,.1)}
.jc-faq-item h3{font-family:var(--ff-head);font-size:1.15rem;font-weight:600;color:var(--text);margin-bottom:8px}
.jc-faq-item p{font-size:.95rem;color:var(--muted);line-height:1.65;margin:0}
/* CTA FINAL */
.jc-cta-final{background:var(--dark2);padding:80px 24px;text-align:center;border-top:1px solid rgba(255,255,255,.07)}
.jc-cta-final h2{font-family:var(--ff-head);font-size:clamp(1.6rem,4vw,2.8rem);font-weight:700;text-transform:uppercase;color:#fff;margin-bottom:16px;line-height:1.1}
.jc-cta-final p{color:var(--muted);margin-bottom:32px;font-size:1rem;max-width:480px;margin-left:auto;margin-right:auto;line-height:1.65}
/* FOOTER */
.jc-footer{background:#0A0A0A;border-top:1px solid rgba(255,255,255,.07);padding:3rem 24px}
.jc-footer-inner{max-width:900px;margin:0 auto;display:flex;justify-content:space-between;align-items:flex-start;gap:2rem;flex-wrap:wrap}
.jc-footer-brand p{font-size:.8rem;color:var(--muted);margin-top:8px;max-width:240px;line-height:1.6}
.jc-footer-links{display:flex;flex-direction:column;gap:0}
.jc-footer-links a{font-size:.85rem;color:var(--muted);text-decoration:none;transition:color 0.2s;min-height:44px;display:inline-flex;align-items:center}
.jc-footer-links a:hover{color:#fff}
.jc-footer-bottom{text-align:center;font-size:.75rem;color:#444;padding-top:2rem;margin-top:2rem;border-top:1px solid rgba(255,255,255,.07);max-width:900px;margin-left:auto;margin-right:auto}
@keyframes pulse-wa{0%,100%{box-shadow:0 4px 16px rgba(37,211,102,.4)}50%{box-shadow:0 4px 24px rgba(37,211,102,.65)}}
@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation:none!important;transition:none!important}}
@media(max-width:640px){
  .jc-photo{height:280px}
  .jc-photo.tall{height:360px}
  .jc-btn-ghost{margin-left:0;margin-top:12px;display:inline-block}
}
.jc-answer{font-size:1.15rem;line-height:1.55;color:#fff;border-left:3px solid var(--orange);padding-left:18px;margin:0 0 28px}
.jc-answer-wrap{background:var(--dark);padding:2.5rem 24px 0}
.jc-answer-inner{max-width:900px;margin:0 auto}
.jc-related{background:#0A0A0A;border-top:1px solid rgba(255,255,255,.07);padding:3rem 24px}
.jc-related-inner{max-width:900px;margin:0 auto}
.jc-related h2{font-family:var(--ff-head);font-size:1.4rem;color:#fff;margin-bottom:16px}
.jc-related-links{display:flex;flex-wrap:wrap;gap:4px 18px}
.jc-related-links a{display:inline-flex;align-items:center;min-height:44px;color:var(--muted);text-decoration:none;font-size:.95rem;border-bottom:1px solid transparent}
.jc-related-links a:hover{color:#fff;border-color:var(--orange)}
.jc-related-note{margin-top:14px;font-size:.85rem;color:var(--muted)}
.jc-related-note a{color:var(--orange);text-decoration:none}
</style>
</head>
<body>

<nav class="jc-nav">
  <a href="https://jetcab.mx/en/" class="jc-nav-logo" aria-label="JETCAB — Private jet charter Mexico (home)">JET<span>CAB</span></a>
  <div class="jc-nav-links">
    <a href="https://jetcab.mx/en/#fleet">Fleet</a>
    <a href="https://jetcab.mx/en/#destinations">Routes</a>
    <a href="https://jetcab.mx/sobre-nosotros/">About</a>
    <a href="https://jetcab.mx/cotizar/">Pricing</a>
    <a href="<?php echo $canonical_es; ?>" class="jc-lang">ES</a>
    <a href="<?php echo $wa; ?>" class="jc-nav-cta" target="_blank" rel="noopener">Get a Quote</a>
  </div>
</nav>

<!-- 1. HERO -->
<div class="jc-hero" style="background-image:url('<?php echo $hero_url; ?>')">
  <div class="jc-hero-inner">
    <div class="jc-route-tag">Mexico City &rarr; <?php echo esc_html($r['dest']); ?></div>
    <h1>Private Jet Mexico City<br>to <?php echo esc_html($r['dest']); ?></h1>
    <p class="jc-hero-sub"><?php echo esc_html($r['time']); ?> from Toluca. No terminals. No queues. From $<?php echo esc_html($r['price']); ?> USD.</p>
    <div class="jc-trust-row">
      <span><strong>25 years</strong> in aviation</span>
      <span><strong>2,000+</strong> flights</span>
      <span><strong>DGAC</strong> certified</span>
      <span>Jet <strong>ready in 2h</strong></span>
    </div>
    <a href="<?php echo $wa; ?>" class="jc-btn" target="_blank" rel="noopener">Request availability</a>
    <a href="#fleet" class="jc-btn jc-btn-ghost">View fleet</a>
  </div>
</div>

<!-- 2. WHY PRIVATE -->
<div class="jc-section">
  <p class="jc-answer"><?php echo esc_html($r['answer']); ?></p>
  <h2>Why Fly Private to <?php echo esc_html($r['dest']); ?></h2>
  <p><?php echo esc_html($r['about_1']); ?></p>
  <p><?php echo esc_html($r['about_2']); ?></p>
</div>

<!-- 3. FULL-BLEED DESTINATION PHOTO -->
<img class="jc-photo tall" src="https://images.unsplash.com/photo-<?php echo esc_attr($r['gallery_1']); ?>?auto=format&fit=crop&w=1400&q=80" alt="<?php echo esc_attr($r['alt_1']); ?>" loading="lazy">

<!-- 4. BENEFITS -->
<div class="jc-section">
  <h2>Flying Private Changes Everything</h2>
  <ul class="jc-benefits">
    <li><strong>Total Flexibility:</strong> Depart on your schedule, not the airline's. No check-in windows, no cutoff times.</li>
    <li><strong>Zero Queues:</strong> Arrive 20 minutes before takeoff. No terminals, no domestic security line.</li>
    <li><strong>No Immigration:</strong> Domestic flights mean no customs, no immigration process. Land and go — under 5 minutes on the ground.</li>
    <li><strong>Exclusive Cabin:</strong> Only your group on board. Total privacy for conversations that matter.</li>
    <li><strong>Door-to-Door Faster:</strong> Private departure from Toluca (AIT) saves 2+ hours vs. commercial door to door.</li>
    <li><strong>Custom Catering:</strong> Menu tailored to your preferences, loaded before boarding.</li>
  </ul>
</div>

<!-- 5. JET PHOTO -->
<img class="jc-photo" src="https://images.unsplash.com/photo-<?php echo esc_attr($r['gallery_2']); ?>?auto=format&fit=crop&w=1400&q=80" alt="<?php echo esc_attr($r['alt_2']); ?>" loading="lazy">

<!-- 6. FLIGHT DETAILS -->
<div class="jc-section">
  <h2>Flight Details</h2>
  <div class="jc-details-grid">
    <div class="jc-detail-box"><div class="label">Departure</div><div class="value">AIT — Toluca</div></div>
    <div class="jc-detail-box"><div class="label">Destination</div><div class="value"><?php echo esc_html($r['to_iata']); ?> — <?php echo esc_html($r['dest_airport']); ?></div></div>
    <div class="jc-detail-box"><div class="label">Flight time</div><div class="value"><?php echo esc_html($r['time']); ?></div></div>
    <div class="jc-detail-box"><div class="label">From</div><div class="value">$<?php echo esc_html($r['price']); ?> USD</div></div>
  </div>
  <p><?php echo esc_html($r['about_3']); ?></p>
</div>

<!-- 7. DESTINATION PHOTO #3 -->
<img class="jc-photo" src="https://images.unsplash.com/photo-<?php echo esc_attr($r['gallery_3']); ?>?auto=format&fit=crop&w=1400&q=80" alt="<?php echo esc_attr($r['alt_3']); ?>" loading="lazy">

<!-- 8. FLEET -->
<div class="jc-section" id="fleet">
  <h2>Private Jets from Mexico City to <?php echo esc_html($r['dest']); ?></h2>
  <p>Every aircraft is DGAC-certified and maintained to international standards. Price is per aircraft — not per seat.</p>
  <div class="jc-fleet-grid">
    <div class="jc-fleet-card">
      <div class="jc-fleet-card-img">
        <img src="https://jetcab.mx/wp-content/uploads/2024/11/Learjet35enrenta.jpeg" width="700" height="394" decoding="async" alt="Learjet 35 light jet private cabin" loading="lazy">
        <span class="jc-fleet-badge">Light Jet</span>
      </div>
      <div class="jc-fleet-body">
        <div class="jc-fleet-class">Light Jet</div>
        <div class="jc-fleet-name">Learjet 35</div>
        <p class="jc-fleet-desc">Fast and efficient. Full leather cabin, up to 7 passengers. Cruises at 850 km/h. The right choice for small teams and last-minute trips.</p>
        <div class="jc-fleet-specs">
          <div class="jc-fleet-spec"><strong>7</strong>Passengers</div>
          <div class="jc-fleet-spec"><strong>850 km/h</strong>Cruise</div>
          <div class="jc-fleet-spec"><strong>Wi-Fi</strong>Available</div>
        </div>
        <div class="jc-fleet-price"><?php echo jc_price_html($r['p1']); ?></div>
        <a href="<?php echo $wa; ?>" class="jc-fleet-cta" target="_blank" rel="noopener">Book this aircraft</a>
      </div>
    </div>
    <div class="jc-fleet-card">
      <div class="jc-fleet-card-img">
        <img src="https://jetcab.mx/wp-content/uploads/2024/11/Challenger-605-en-renta.jpeg" width="700" height="394" decoding="async" alt="Challenger 605 midsize private jet cabin" loading="lazy">
        <span class="jc-fleet-badge">Midsize Jet</span>
      </div>
      <div class="jc-fleet-body">
        <div class="jc-fleet-class">Midsize Jet</div>
        <div class="jc-fleet-name">Challenger 605</div>
        <p class="jc-fleet-desc">Stand-up cabin, 6ft tall. Seats 12. Full galley, oversized windows. The most-booked aircraft for corporate groups and executive offsites.</p>
        <div class="jc-fleet-specs">
          <div class="jc-fleet-spec"><strong>12</strong>Passengers</div>
          <div class="jc-fleet-spec"><strong>882 km/h</strong>Cruise</div>
          <div class="jc-fleet-spec"><strong>Starlink</strong>Wi-Fi</div>
        </div>
        <div class="jc-fleet-price"><?php echo jc_price_html($r['p2']); ?></div>
        <a href="<?php echo $wa; ?>" class="jc-fleet-cta" target="_blank" rel="noopener">Book this aircraft</a>
      </div>
    </div>
    <div class="jc-fleet-card">
      <div class="jc-fleet-card-img">
        <img src="https://jetcab.mx/wp-content/uploads/2024/11/Gulfstream-Gv-en-Renta.jpeg" width="700" height="394" decoding="async" alt="Gulfstream GV large cabin private jet" loading="lazy">
        <span class="jc-fleet-badge">Large Cabin</span>
      </div>
      <div class="jc-fleet-body">
        <div class="jc-fleet-class">Large Cabin Jet</div>
        <div class="jc-fleet-name">Gulfstream GV</div>
        <p class="jc-fleet-desc">Full bedroom, conference seating for 8, Starlink Wi-Fi. The aircraft heads of state use. When the trip matters, this is the cabin you want.</p>
        <div class="jc-fleet-specs">
          <div class="jc-fleet-spec"><strong>16</strong>Passengers</div>
          <div class="jc-fleet-spec"><strong>904 km/h</strong>Cruise</div>
          <div class="jc-fleet-spec"><strong>Bedroom</strong>On board</div>
        </div>
        <div class="jc-fleet-price"><?php echo jc_price_html($r['p3']); ?></div>
        <a href="<?php echo $wa; ?>" class="jc-fleet-cta" target="_blank" rel="noopener">Book this aircraft</a>
      </div>
    </div>
  </div>
</div>

<!-- 9. FAQ -->
<div class="jc-section">
  <h2>Private Jet Mexico City to <?php echo esc_html($r['dest']); ?>: FAQ</h2>
  <div class="jc-faq">
    <?php foreach ($r['faqs'] as $faq): ?>
    <div class="jc-faq-item">
      <h3><?php echo esc_html($faq['q']); ?></h3>
      <p><?php echo esc_html($faq['a']); ?></p>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- 10. CTA FINAL -->
<div class="jc-cta-final">
  <h2>Flying to <?php echo esc_html($r['dest']); ?> This Week?</h2>
  <p>Jet ready in 2 hours from your call. 25 years of aviation. DGAC certified. Quote in 30 minutes.</p>
  <a href="<?php echo $wa; ?>" class="jc-btn" target="_blank" rel="noopener">WhatsApp us now &rarr;</a>
</div>


<section class="jc-related" aria-label="Other private jet routes from Mexico City">
  <div class="jc-related-inner">
    <h2>Other private jet routes from Mexico City</h2>
    <div class="jc-related-links"><?php if ($r["slug"] !== "cancun") { ?><a href="https://jetcab.mx/private-jet-mexico-city-cancun/">Mexico City → Cancún</a><?php } ?><?php if ($r["slug"] !== "los-cabos") { ?><a href="https://jetcab.mx/private-jet-mexico-city-los-cabos/">Mexico City → Los Cabos</a><?php } ?><?php if ($r["slug"] !== "puerto-vallarta") { ?><a href="https://jetcab.mx/private-jet-mexico-city-puerto-vallarta/">Mexico City → Puerto Vallarta</a><?php } ?><?php if ($r["slug"] !== "monterrey") { ?><a href="https://jetcab.mx/private-jet-mexico-city-monterrey/">Mexico City → Monterrey</a><?php } ?><?php if ($r["slug"] !== "guadalajara") { ?><a href="https://jetcab.mx/private-jet-mexico-city-guadalajara/">Mexico City → Guadalajara</a><?php } ?><?php if ($r["slug"] !== "miami") { ?><a href="https://jetcab.mx/private-jet-mexico-city-miami/">Mexico City → Miami</a><?php } ?><?php if ($r["slug"] !== "houston") { ?><a href="https://jetcab.mx/private-jet-mexico-city-houston/">Mexico City → Houston</a><?php } ?><?php if ($r["slug"] !== "new-york") { ?><a href="https://jetcab.mx/private-jet-mexico-city-new-york/">Mexico City → New York</a><?php } ?><?php if ($r["slug"] !== "los-angeles") { ?><a href="https://jetcab.mx/private-jet-mexico-city-los-angeles/">Mexico City → Los Angeles</a><?php } ?></div>
    <p class="jc-related-note">Prices are per aircraft, one-way, from Toluca (AIT). <a href="https://jetcab.mx/en/">All destinations &amp; fleet</a> · <a href="https://jetcab.mx/cotizar/">Request a quote</a></p>
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
      <a href="https://jetcab.mx/en/#destinations">All private jet routes from Mexico City</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-cancun/">Private jet Mexico City to Cancún</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-los-cabos/">Private jet Mexico City to Los Cabos</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-puerto-vallarta/">Private jet Mexico City to Puerto Vallarta</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-monterrey/">Private jet Mexico City to Monterrey</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-guadalajara/">Private jet Mexico City to Guadalajara</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-miami/">Private jet Mexico City to Miami</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-houston/">Private jet Mexico City to Houston</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-new-york/">Private jet Mexico City to New York</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-los-angeles/">Private jet Mexico City to Los Angeles</a>
    </div>
  </div>
  <p class="jc-footer-bottom">&copy; <?php echo date('Y'); ?> JETCAB. All rights reserved. &mdash; <a href="https://jetcab.mx/aviso-de-privacidad/" style="color:#444">Privacy notice</a></p>
</footer>

<a href="<?php echo $wa; ?>" target="_blank" style="position:fixed;bottom:1.5rem;right:1.5rem;background:#25D366;color:#fff;width:56px;height:56px;border-radius:50%;display:flex;align-items:center;justify-content:center;text-decoration:none;box-shadow:0 4px 16px rgba(37,211,102,0.4);z-index:999;animation:pulse-wa 2.5s infinite" aria-label="WhatsApp JETCAB">
  <svg width="28" height="28" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
</a>

</body>
</html>
<?php
    return ob_get_clean();
}
