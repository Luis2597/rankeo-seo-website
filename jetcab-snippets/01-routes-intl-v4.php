/*
 * JETCAB English Route Pages v4 - Destination-first, GEO/SEO optimized
 * WPCode snippet #2900
 */

add_action("init", function() {
    add_rewrite_rule("^private-jet-mexico-city-(miami|houston|new-york|los-angeles)/?$", 'index.php?jetcab_route=$matches[1]', "top");
});
add_filter("query_vars", function($vars) { $vars[] = "jetcab_route"; return $vars; });
add_action("template_redirect", function() {
    $route = get_query_var("jetcab_route");
    if (!$route) return;
    $routes = [
        "miami" => [
            "title"        => "Private Jet Mexico City to Miami | Nonstop 3h 30m — JETCAB",
            "dest"         => "Miami",
            "dest_full"    => "Miami, Florida",
            "from"         => "Toluca · Mexico City",
            "from_iata"    => "TLC",
            "to_iata"      => "MIA",
            "time"         => "3h 30m",
            "slug"         => "miami",
            "es_live"      => false,
            "answer"       => "A JETCAB private jet from Mexico City (Toluca, AIT) to Miami Opa-locka Executive (OPF) takes 3 h 30 min nonstop and is quoted per full aircraft on request (Learjet 35 for 7 passengers, Challenger 605 for 12 or Gulfstream for 16), confirmed in 30 minutes. U.S. Customs clears at the FBO in under 15 minutes. Passport and B1/B2 visa required.",
            "slug_es"      => "vuelo-privado-cdmx-miami",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+Miami.",
            "meta_desc"    => "Private jet from Mexico City (Toluca) to Miami nonstop in 3h 30m. Land at Opa-locka Executive, 20 min from South Beach. US Customs at the FBO. Quote in 30 min.",
            "fomo"         => "Availability confirmed within 30 minutes",
            "p1"           => "Quote on request",
            "p2"           => "Quote on request",
            "p3"           => "Quote on request",
            "cta_urgency"  => "Flying to Miami this week?",
            "cta_sub"      => "Availability open. Send your dates — quote in 30 minutes.",
            "hero_img"     => "1519501025264-65ba15a82390",
            "hero_line1"   => "Mexico City",
            "hero_line2"   => "to Miami.",
            "hero_sub"     => "3 hours 30 minutes nonstop. Opa-locka Executive Airport — 20 minutes from South Beach, 25 from Brickell. No boarding line. No Dallas connection.",
            "fbo_name"     => "Opa-locka Executive Airport (OPF)",
            "fbo_dist1"    => "20 min from South Beach",
            "fbo_dist2"    => "25 min from Brickell",
            "dest_about"   => "Miami runs on two tracks. Brickell — the financial district — hosts the Latin American offices of every major investment bank, private equity firm, and family office in the hemisphere. South Beach, 20 minutes away, is where those conversations continue over dinner. The private terminal at Opa-locka Executive Airport (OPF) puts you between them. You clear US Customs at the FBO in under 15 minutes. Your driver is at the steps — not in a terminal queue.",
            "dest_gallery" => ["1533680834271-61bba76cf10a", "1571896349842-33c89424de2d", "1507525428034-b723cf961d3e"],
            "dest_alts"    => ["Miami Brickell skyline at night", "Miami luxury pool and resort hotel", "Miami Beach ocean and shoreline"],
            "dest_areas"   => [
                ["name" => "Brickell", "desc" => "Latin America\'s financial capital. Investment banks, family offices, private equity headquarters."],
                ["name" => "South Beach", "desc" => "Art Deco district. The restaurants and hotels that matter on this continent."],
                ["name" => "Wynwood", "desc" => "Art, tech, venture capital. The creative district that became a business address."],
                ["name" => "Design District", "desc" => "Luxury retail, architecture studios, gallery openings."],
                ["name" => "Coral Gables", "desc" => "Corporate headquarters, law firms, luxury residential. 20 minutes from OPF."],
            ],
            "faqs" => [
                ["q" => "How long is the flight from Mexico City to Miami on a private jet?", "a" => "3 hours 30 minutes nonstop from Toluca (AIT) to Miami. Commercial routes via Dallas or Atlanta typically take 6 to 7 hours door to door."],
                ["q" => "Which airport do private jets use in Miami?", "a" => "JETCAB flies into Opa-locka Executive Airport (OPF), 20 minutes from South Beach and 25 minutes from Brickell. We can also arrange arrivals at Fort Lauderdale Executive (FXE) depending on your destination."],
                ["q" => "Is there US Customs at Opa-locka for private jet arrivals?", "a" => "Yes. US Customs and Border Protection operates at OPF. Private jet passengers clear at the FBO — the process takes under 15 minutes with no queues."],
                ["q" => "How much does a private jet from Mexico City to Miami cost?", "a" => "Quoted per full aircraft, not per seat: Learjet 35 (up to 7 passengers), Challenger 605 (up to 12) or Gulfstream GV (up to 16). Confirmed price in 30 minutes, including crew, fuel, catering and permits."],
                ["q" => "Can I fly private from Mexico City to Miami same day?", "a" => "Yes. JETCAB has confirmed same-day availability on this route with as little as 2 hours notice, subject to fleet availability."],
            ],
        ],
        "houston" => [
            "title"        => "Private Jet Mexico City to Houston | 2h 45m — JETCAB",
            "dest"         => "Houston",
            "dest_full"    => "Houston, Texas",
            "from"         => "Toluca · Mexico City",
            "from_iata"    => "TLC",
            "to_iata"      => "HOU",
            "time"         => "2h 45m",
            "slug"         => "houston",
            "es_live"      => false,
            "answer"       => "A JETCAB private jet from Mexico City (Toluca, AIT) to Houston Hobby (HOU) takes 2 h 45 min nonstop and is quoted per full aircraft on request (Learjet 35 for 7 passengers, Challenger 605 for 12 or Gulfstream for 16), confirmed in 30 minutes. Hobby is 10 minutes from downtown. Same-day round trips are JETCAB's most common booking on this route.",
            "slug_es"      => "vuelo-privado-cdmx-houston",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+Houston.",
            "meta_desc"    => "Private jet from Mexico City (Toluca) to Houston in 2h 45m. Land at Hobby Airport, 10 min from Downtown and the Texas Medical Center. Quote in 30 min. Same-day.",
            "fomo"         => "Availability confirmed within 30 minutes",
            "p1"           => "Quote on request",
            "p2"           => "Quote on request",
            "p3"           => "Quote on request",
            "cta_urgency"  => "Business trip to Houston?",
            "cta_sub"      => "Our most-requested route. Quote in under 30 minutes.",
            "hero_img"     => "1486325212027-8081e485255e",
            "hero_line1"   => "Mexico City",
            "hero_line2"   => "to Houston.",
            "hero_sub"     => "2 hours 45 minutes. The energy capital. Oil, gas, construction, medicine. The people who make this trip weekly have already done the math.",
            "fbo_name"     => "William P. Hobby Airport (HOU)",
            "fbo_dist1"    => "10 min from Downtown",
            "fbo_dist2"    => "30 min from Energy Corridor",
            "dest_about"   => "Houston is the energy capital of the world and home to the largest medical center on earth. The Energy Corridor — where Shell, BP, ExxonMobil and hundreds of operators are headquartered — is 30 minutes from William P. Hobby Airport. The Texas Medical Center is 15 minutes away. For Mexico City executives in oil, gas, construction, or healthcare, this is the most-flown business route in our fleet. You can take a 7am meeting in the Galleria and be back in Mexico City before dinner. The people who fly this route weekly have already done the calculation.",
            "dest_gallery" => ["1548504769-57e9bd53e42c", "1518709268805-4e9042af9f23", "1557804483-ef9b4e13ac8a"],
            "dest_alts"    => ["Houston downtown skyline at dusk", "Houston office towers and business district", "Houston energy sector architecture"],
            "dest_areas"   => [
                ["name" => "Energy Corridor", "desc" => "Shell, BP, ExxonMobil, ConocoPhillips. The corporate address for global energy."],
                ["name" => "Texas Medical Center", "desc" => "World\'s largest medical complex — 60 institutions, 180,000 people."],
                ["name" => "The Galleria", "desc" => "Houston\'s business and luxury hub. Corporate towers, five-star hotels, boardrooms."],
                ["name" => "Downtown Houston", "desc" => "Theater district, banking, law. 10 minutes from Hobby Airport."],
                ["name" => "River Oaks", "desc" => "Houston\'s most exclusive residential address, adjacent to the Galleria corridor."],
            ],
            "faqs" => [
                ["q" => "How long is the flight from Mexico City to Houston on a private jet?", "a" => "2 hours 45 minutes nonstop from Toluca (AIT) to Houston — one of the fastest international private jet routes from Mexico City."],
                ["q" => "Which Houston airport do private jets use from Mexico City?", "a" => "JETCAB primarily uses William P. Hobby Airport (HOU), 10 minutes from downtown Houston. For the Energy Corridor, we can arrange arrivals at Houston Executive Airport (TME), 20 minutes closer to the west side."],
                ["q" => "Why is Mexico City to Houston the most popular business route for JETCAB?", "a" => "Houston is the global hub for energy and petrochemicals, with strong Mexico-US ties in oil, construction, and infrastructure. Many of our clients fly this route weekly — often same-day round trips."],
                ["q" => "Can I fly to Houston and back in the same day from Mexico City?", "a" => "Yes. At 2 hours 45 minutes each way, a same-day round trip is the most common booking pattern. You can arrive for a 10am meeting and be back in Mexico City by 9pm."],
                ["q" => "How much does a private jet from Mexico City to Houston cost?", "a" => "Quoted per full aircraft, not per seat: Learjet 35 (up to 7 passengers), Challenger 605 (up to 12) or Gulfstream GV (up to 16). Confirmed price in 30 minutes, including crew, fuel, catering and permits."],
            ],
        ],
        "new-york" => [
            "title"        => "Private Jet Mexico City to New York | Teterboro — JETCAB",
            "dest"         => "New York",
            "dest_full"    => "New York, NY",
            "from"         => "Toluca · Mexico City",
            "from_iata"    => "TLC",
            "to_iata"      => "TEB",
            "time"         => "5h 30m",
            "slug"         => "new-york",
            "es_live"      => false,
            "answer"       => "A JETCAB private jet from Mexico City (Toluca, AIT) to Teterboro (TEB), 12 minutes from Midtown Manhattan, takes 5 h 30 min and is quoted per full aircraft on request (midsize jet for 8 passengers, Challenger 605 for 12 or Gulfstream nonstop for 16), confirmed in 30 minutes. Passport and B1/B2 visa required; JETCAB files eAPIS and arranges CBP at the FBO.",
            "slug_es"      => "vuelo-privado-cdmx-nueva-york",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+New+York.",
            "meta_desc"    => "Private jet from Mexico City (Toluca) to New York in 5h 30m. Land at Teterboro, 12 min from Midtown Manhattan. Skip JFK. Quote in 30 min. DGAC certified.",
            "fomo"         => "Availability confirmed within 30 minutes",
            "p1"           => "Quote on request",
            "p2"           => "Quote on request",
            "p3"           => "Quote on request",
            "cta_urgency"  => "New York this month?",
            "cta_sub"      => "One long-range jet on this route this week. Send your dates.",
            "hero_img"     => "1534430480872-e9a62c0c8d96",
            "hero_line1"   => "Mexico City",
            "hero_line2"   => "to New York.",
            "hero_sub"     => "5 hours 30 minutes. Teterboro Airport is 12 minutes from Midtown. JFK is 45. The people who matter in that city don\'t use JFK.",
            "fbo_name"     => "Teterboro Airport (TEB), New Jersey",
            "fbo_dist1"    => "12 min from Midtown Manhattan",
            "fbo_dist2"    => "15 min from Financial District",
            "dest_about"   => "New York\'s markets do not pause for airline delays. Teterboro Airport (TEB) is 12 minutes from Midtown by car — versus 45 minutes from JFK on a good day, and considerably longer at peak hours. Private jet passengers clear US Customs at the FBO in under 10 minutes. No immigration queue, no baggage carousel, no taxi line. From CDMX, you can be in a conference room on Park Avenue before the commercial passengers have retrieved their luggage. On the Gulfstream GV, the 5.5-hour flight becomes a working environment: conference seating for eight, satellite Wi-Fi, a full bedroom if you need it.",
            "dest_gallery" => ["1485871900405-a6fc37cb82e0", "1496588152203-86173ca8af83", "1538970272-ae5a36d0b83f"],
            "dest_alts"    => ["Manhattan skyline at night over the Hudson River", "New York City aerial view and bridges", "Central Park surrounded by Manhattan skyscrapers"],
            "dest_areas"   => [
                ["name" => "Midtown Manhattan", "desc" => "Investment banks, media companies, law firms. The business center of the United States."],
                ["name" => "Financial District", "desc" => "Wall Street, NYSE, the Fed. 15 minutes from Teterboro."],
                ["name" => "Tribeca & SoHo", "desc" => "Media, private equity, creative agencies. The other New York address that matters."],
                ["name" => "Hudson Yards", "desc" => "New York\'s newest business district. Tech and finance headquarters on the west side."],
                ["name" => "Upper East Side", "desc" => "Museum Mile, luxury residential, private wealth management offices."],
            ],
            "faqs" => [
                ["q" => "Why land at Teterboro instead of JFK for a private jet to New York?", "a" => "Teterboro Airport (TEB) is 12 minutes from Midtown Manhattan. JFK averages 45 minutes by car, often more. For business travelers, this difference compounds across every trip."],
                ["q" => "How long is the private jet flight from Mexico City to New York?", "a" => "5 hours 30 minutes nonstop from Toluca (AIT) to Teterboro (TEB). Commercial routes via Dallas or Atlanta typically take 8 to 10 hours door to door."],
                ["q" => "Does a private jet clear US Customs at Teterboro?", "a" => "Yes. US Customs and Border Protection operates at Teterboro for private jet arrivals. The process at the FBO takes under 10 minutes. A valid passport and U.S. B1/B2 visa are required; ESTA is not valid on private aircraft."],
                ["q" => "How much does it cost to charter a private jet from Mexico City to New York?", "a" => "Quoted per full aircraft, not per seat: midsize jet (8 passengers) or Gulfstream GV (up to 16, nonstop). Confirmed price in 30 minutes. For groups of 4 or more, the per-person cost is comparable to business class."],
                ["q" => "Can the Gulfstream GV fly nonstop from Mexico City to New York?", "a" => "Yes. The Gulfstream GV has the range to fly CDMX to New York nonstop in 5 hours 30 minutes. It includes a full bedroom, conference seating for 8, and satellite Wi-Fi."],
            ],
        ],
        "los-angeles" => [
            "title"        => "Private Jet Mexico City to Los Angeles | Van Nuys — JETCAB",
            "dest"         => "Los Angeles",
            "dest_full"    => "Los Angeles, California",
            "from"         => "Toluca · Mexico City",
            "from_iata"    => "TLC",
            "to_iata"      => "VNY",
            "time"         => "3h 45m",
            "slug"         => "los-angeles",
            "es_live"      => false,
            "answer"       => "A JETCAB private jet from Mexico City (Toluca, AIT) to Van Nuys (VNY), 15 minutes from Beverly Hills, takes 3 h 45 min nonstop and is quoted per full aircraft on request (Learjet 35 for 7 passengers, Challenger 605 for 12 or Gulfstream for 16), confirmed in 30 minutes. U.S. Customs clears at the FBO. Passport and B1/B2 visa required.",
            "slug_es"      => "vuelo-privado-cdmx-los-angeles",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+Los+Angeles.",
            "meta_desc"    => "Private jet from Mexico City (Toluca) to Los Angeles in 3h 45m. Land at Van Nuys, 15 min from Beverly Hills. Skip LAX. Quote in 30 min. Jet ready in 2 hours.",
            "fomo"         => "Availability confirmed within 30 minutes",
            "p1"           => "Quote on request",
            "p2"           => "Quote on request",
            "p3"           => "Quote on request",
            "cta_urgency"  => "Los Angeles this week?",
            "cta_sub"      => "Availability confirmed in under 30 minutes.",
            "hero_img"     => "1504941812617-26c6e088459a",
            "hero_line1"   => "Mexico City",
            "hero_line2"   => "to Los Angeles.",
            "hero_sub"     => "3 hours 45 minutes. Van Nuys Airport — 15 minutes from Beverly Hills. LAX is not your airport.",
            "fbo_name"     => "Van Nuys Airport (VNY), San Fernando Valley",
            "fbo_dist1"    => "15 min from Beverly Hills",
            "fbo_dist2"    => "20 min from Century City",
            "dest_about"   => "Los Angeles operates on two industries that run on discretion: entertainment and high-end real estate. Van Nuys Airport (VNY) is the busiest general aviation airport in California — over 200 private jet movements daily. No commercial terminal, no international arrivals hall, no crowd. You land, step off, your driver is at the steps. FBO to car in under 5 minutes. The airport sits 15 minutes from Beverly Hills, 20 from Century City, 25 from Malibu. For talent agents, studio executives, and luxury real estate clients, this is the city from the right angle.",
            "dest_gallery" => ["1517816743775-5dc8e8e97e56", "1501594907352-04cda38ebc29", "1453391351177-7ab71c45c13b"],
            "dest_alts"    => ["Hollywood Hills and Los Angeles at dusk", "Los Angeles downtown skyline", "Pacific Coast Highway and California coastline"],
            "dest_areas"   => [
                ["name" => "Beverly Hills", "desc" => "Entertainment, luxury real estate, the address that needs no explanation. 15 minutes from VNY."],
                ["name" => "Century City", "desc" => "Corporate towers, major agencies (CAA, WME), law firms. Los Angeles\'s Midtown."],
                ["name" => "Santa Monica", "desc" => "Tech companies, creative agencies, the Pacific. The west side\'s working address."],
                ["name" => "West Hollywood", "desc" => "Entertainment offices, the Sunset Strip, hospitality and media industry."],
                ["name" => "Malibu", "desc" => "25 minutes from VNY. The address for those who\'ve stopped needing an address."],
            ],
            "faqs" => [
                ["q" => "What airport do private jets use in Los Angeles when flying from Mexico City?", "a" => "JETCAB flies into Van Nuys Airport (VNY), the busiest general aviation airport in California. No commercial traffic. We can also arrange arrivals at Burbank Bob Hope (BUR) or Santa Monica Airport (SMO) based on your destination."],
                ["q" => "How long is the private jet flight from Mexico City to Los Angeles?", "a" => "3 hours 45 minutes nonstop from Toluca (AIT) to Van Nuys (VNY). Commercial routes with connections typically take 6 to 8 hours door to door."],
                ["q" => "Is Van Nuys Airport closer to Beverly Hills than LAX?", "a" => "Significantly closer. Van Nuys is 15 minutes from Beverly Hills. LAX is 25 to 45 minutes in typical traffic — and LAX traffic is unpredictable. For Malibu, VNY saves up to an hour each way."],
                ["q" => "How much does a private jet from Mexico City to Los Angeles cost?", "a" => "Quoted per full aircraft, not per seat: Learjet 35 (up to 7 passengers), Challenger 605 (up to 12) or Gulfstream GV (up to 16). Confirmed price in 30 minutes, including crew, fuel, catering and permits."],
                ["q" => "Do I need US Customs for a private jet to Los Angeles from Mexico?", "a" => "Yes. US Customs clears at Van Nuys Airport for arrivals from Mexico. The process takes under 15 minutes at the FBO. A valid passport and U.S. B1/B2 visa are required; ESTA is not valid on private aircraft."],
            ],
        ],
    ];
    if (!isset($routes[$route])) return;
    status_header(200);
    header("Content-Type: text/html; charset=UTF-8");
    echo jetcab_route_page_v4_cs($routes[$route]);
    exit;
}, 1);


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

function jetcab_route_page_v4_cs($r) {
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
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800&family=Barlow:wght@300;400;500;600&display=swap" rel="stylesheet">
<script type="application/ld+json">
{"@context":"https://schema.org","@graph":[
{"@type":"WebPage","@id":"<?php echo $canonical; ?>#webpage","url":"<?php echo $canonical; ?>","name":"<?php echo jc_json_str($r['title']); ?>","description":"<?php echo jc_json_str($r['meta_desc']); ?>","primaryImageOfPage":{"@type":"ImageObject","url":"<?php echo $hero_url; ?>"},"breadcrumb":{"@id":"<?php echo $canonical; ?>#breadcrumb"},"speakable":{"@type":"SpeakableSpecification","cssSelector":[".jc-answer","h1",".jc-faq-item h3",".jc-faq-item p"]},"isPartOf":{"@id":"https://jetcab.mx/#website"},"about":{"@id":"https://jetcab.mx/#organization"},"inLanguage":"en"},
{"@type":"Service","name":"Private Jet Charter Mexico City to <?php echo jc_json_str($r['dest_full']); ?>","description":"<?php echo jc_json_str($r['meta_desc']); ?>","provider":{"@type":"LocalBusiness","@id":"https://jetcab.mx/#organization","name":"JETCAB","url":"https://jetcab.mx/","telephone":"+52-729-108-1200","foundingDate":"1999","areaServed":"Mexico"},"serviceType":"Air Charter","areaServed":["Mexico","<?php echo jc_json_str($r['dest_full']); ?>"],"offers":{"@type":"Offer","url":"<?php echo $canonical; ?>","priceCurrency":"USD","availability":"https://schema.org/InStock"}},
{"@type":"BreadcrumbList","@id":"<?php echo $canonical; ?>#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"name":"JETCAB","item":"https://jetcab.mx/en/"},{"@type":"ListItem","position":2,"name":"Private Jet Routes from Mexico City","item":"https://jetcab.mx/en/#destinations"},{"@type":"ListItem","position":3,"name":"Mexico City to <?php echo jc_json_str($r['dest']); ?>"}]},
{"@type":"FAQPage","mainEntity":[<?php $fq=array_map(function($f){return '{"@type":"Question","name":"'.jc_json_str($f["q"]).'","acceptedAnswer":{"@type":"Answer","text":"'.jc_json_str($f["a"]).'"}}';},$r['faqs']);echo implode(',',$fq);?>]}
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
.jc-nav-links a{color:var(--muted);text-decoration:none;font-size:0.875rem;transition:color 0.2s cubic-bezier(.32,.72,0,1)}.jc-nav-links a:hover{color:#fff}
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
.jc-avail-dot{width:8px;height:8px;background:#22c55e;border-radius:50%;flex-shrink:0}
@keyframes pulse-green{0%,100%{box-shadow:0 0 0 0 rgba(34,197,94,0.4)}50%{box-shadow:0 0 0 6px rgba(34,197,94,0)}}
.jc-hero-ctas{display:flex;gap:1rem;flex-wrap:wrap;margin-bottom:2.5rem}
.btn-primary{background:var(--orange);color:#fff;padding:0.9rem 2rem;border-radius:4px;font-size:1rem;font-weight:600;text-decoration:none;transition:background 0.2s cubic-bezier(.32,.72,0,1),transform 0.15s;display:inline-block}
.btn-primary:hover{background:#ff6a2f;transform:translateY(-1px)}
.btn-ghost{border:1px solid rgba(255,255,255,0.25);color:#fff;padding:0.9rem 2rem;border-radius:4px;font-size:1rem;text-decoration:none;transition:border-color 0.2s cubic-bezier(.32,.72,0,1);display:inline-block}
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
.jc-fbo-box{background:var(--dark3);border:1px solid var(--border);background:rgba(232,90,30,.08);padding:1.25rem 1.5rem;border-radius:12px;margin-bottom:2rem}
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
.jc-gallery-main img{width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.4s cubic-bezier(.32,.72,0,1) ease}
.jc-gallery-main:hover img{transform:scale(1.03)}
.jc-gallery-sub{position:relative;border-radius:8px;overflow:hidden;aspect-ratio:4/3}
.jc-gallery-sub img{width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.4s cubic-bezier(.32,.72,0,1) ease}
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
.jc-fleet-card{background:var(--dark3);border:1px solid var(--border);border-radius:8px;overflow:hidden;transition:border-color 0.2s cubic-bezier(.32,.72,0,1),transform 0.2s}
.jc-fleet-card:hover{border-color:rgba(232,90,30,0.4);transform:translateY(-3px)}
.jc-fleet-img{position:relative;aspect-ratio:16/10;overflow:hidden}
.jc-fleet-img img{width:100%;height:100%;object-fit:cover;opacity:0.85;transition:opacity 0.3s cubic-bezier(.32,.72,0,1)}
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
.jc-fleet-cta{display:block;text-align:center;background:transparent;border:1px solid var(--orange);color:var(--orange);padding:0.6rem 1rem;border-radius:4px;font-size:0.875rem;font-weight:600;text-decoration:none;transition:background 0.2s cubic-bezier(.32,.72,0,1),color 0.2s}
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
.jc-faq-q:hover{color:var(--orange)}.jc-faq-icon{font-size:1.25rem;color:var(--orange);flex-shrink:0;transition:transform 0.25s cubic-bezier(.32,.72,0,1)}
.jc-faq-item.open .jc-faq-icon{transform:rotate(45deg)}
.jc-faq-a{max-height:0;overflow:hidden;transition:max-height .3s cubic-bezier(.32,.72,0,1)}
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
.jc-footer-links{display:flex;flex-direction:column;gap:0}
.jc-footer-links a{font-size:0.85rem;color:var(--muted);text-decoration:none;transition:color 0.2s cubic-bezier(.32,.72,0,1);min-height:44px;display:inline-flex;align-items:center}
.jc-footer-links a:hover{color:#fff}
.jc-footer-bottom{text-align:center;font-size:0.75rem;color:#8a8a8a;padding-top:2rem;margin-top:2rem;border-top:1px solid var(--border);max-width:1000px;margin-left:auto;margin-right:auto}
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
.jc-answer{font-size:1.15rem;line-height:1.55;color:#fff;background:rgba(232,90,30,.08);padding:18px 22px;border-radius:12px;margin:0 0 28px}
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

<section class="jc-hero">
  <div class="jc-hero-bg">
    <img src="https://images.unsplash.com/photo-<?php echo esc_attr($r['hero_img']); ?>?auto=format&fit=crop&w=1800&q=85" alt="Private jet Mexico City to <?php echo esc_attr($r['dest_full']); ?> — <?php echo esc_attr($r['fbo_name']); ?>" width="1800" height="1013" fetchpriority="high" decoding="async">
    <div class="jc-hero-grad"></div>
  </div>
  <div class="jc-hero-inner">
    <div class="jc-route-badge"><?php echo esc_html($r['from']); ?> &rarr; <?php echo esc_html($r['dest']); ?></div>
    <h1><span class="line1">Private Jet <?php echo esc_html($r['hero_line1']); ?></span><span class="line2"><?php echo esc_html($r['hero_line2']); ?></span></h1>
    <p class="jc-hero-sub"><?php echo esc_html($r['hero_sub']); ?></p>
    <div class="jc-avail"><span class="jc-avail-dot"></span><?php echo esc_html($r['fomo']); ?></div>
    <div class="jc-hero-ctas">
      <a href="<?php echo $wa; ?>" class="btn-primary" target="_blank" rel="noopener">Request availability &rarr;</a>
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

<section class="jc-answer-wrap"><div class="jc-answer-inner">
  <p class="jc-answer"><?php echo esc_html($r['answer']); ?></p>
</div></section>

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
        <p>Toluca Airport (AIT). Armored vehicle to plane steps. No commercial terminal, no departure board.</p>
      </div>
      <div class="jc-step">
        <div class="jc-step-num">2</div>
        <h3><?php echo esc_html($r['time']); ?> nonstop</h3>
        <p>Full leather cabin. Crew briefed on your preferences. Catering loaded to order before boarding.</p>
      </div>
      <div class="jc-step">
        <div class="jc-step-num">3</div>
        <h3>US Customs at FBO</h3>
        <p><?php echo esc_html($r['fbo_name']); ?>. Dedicated private terminal. Cleared in under 15 minutes.</p>
      </div>
      <div class="jc-step">
        <div class="jc-step-num">4</div>
        <h3><?php echo esc_html($r['fbo_dist1']); ?></h3>
        <p>Driver at the steps. No taxi queue, no baggage carousel. You're already there.</p>
      </div>
    </div>
  </div>
</section>

<section class="jc-fleet-section">
  <div class="jc-fleet-inner">
    <div class="jc-section-label">Choose your aircraft</div>
    <h2>Private jets Mexico City to <?php echo esc_html($r['dest']); ?>: three cabins.</h2>
    <p>Every aircraft is DGAC-certified and maintained to international standards. Your crew briefs you on board.</p>
    <div class="jc-fleet-grid">
      <div class="jc-fleet-card">
        <div class="jc-fleet-img">
          <img src="https://jetcab.mx/wp-content/uploads/2024/11/Learjet35enrenta.jpeg" width="700" height="394" decoding="async" alt="Learjet 35 light jet — private jet Mexico City to <?php echo esc_attr($r['dest']); ?>" loading="lazy">
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
          <div class="jc-fleet-price"><?php echo jc_price_html($r['p1']); ?></div>
          <a href="<?php echo $wa; ?>" class="jc-fleet-cta" target="_blank" rel="noopener">Book this aircraft</a>
        </div>
      </div>
      <div class="jc-fleet-card">
        <div class="jc-fleet-img">
          <img src="https://jetcab.mx/wp-content/uploads/2024/11/Challenger-605-en-renta.jpeg" width="700" height="394" decoding="async" alt="Challenger 605 midsize jet — private jet Mexico City to <?php echo esc_attr($r['dest']); ?>" loading="lazy">
          <span class="jc-fleet-badge">Midsize Jet</span>
        </div>
        <div class="jc-fleet-body">
          <div class="jc-fleet-class">Midsize Jet</div><div class="jc-fleet-name">Challenger 605</div>
          <p class="jc-fleet-desc">Stand-up cabin, 6ft tall. Seats 12. Full galley, windows twice the size of most jets in this class. For board-level meetings and family trips.</p>
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
        <div class="jc-fleet-img">
          <img src="https://jetcab.mx/wp-content/uploads/2024/11/Gulfstream-Gv-en-Renta.jpeg" width="700" height="394" decoding="async" alt="Gulfstream GV large cabin private jet" loading="lazy">
          <span class="jc-fleet-badge">Large Cabin</span>
        </div>
        <div class="jc-fleet-body">
          <div class="jc-fleet-class">Large Cabin Jet</div><div class="jc-fleet-name">Gulfstream GV</div>
          <p class="jc-fleet-desc">Full bedroom, conference seating for 8, satellite Wi-Fi, nonstop range. The aircraft heads of state use. When the trip matters, this is the cabin you want.</p>
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
</section>

<section class="jc-why">
  <div class="jc-why-inner">
    <div class="jc-section-label">Why JETCAB</div>
    <h2>Why our clients come back.</h2>
    <div class="jc-why-grid">
      <div class="jc-why-card"><h3>Jet ready in 2 hours</h3><p>From your call to wheels-up. Our operations center has confirmed this on hundreds of last-minute requests. Two hours is real.</p></div>
      <div class="jc-why-card"><h3>Private terminal at Toluca</h3><p>AIT (Toluca International). Armored vehicle to plane steps in under 10 minutes. No crowds, no commercial terminal.</p></div>
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
      <a href="<?php echo $wa; ?>" class="btn-primary" target="_blank" rel="noopener">WhatsApp us now &rarr;</a>
      <a href="https://jetcab.mx/cotizar/" class="btn-ghost">Get a full quote online</a>
    </div>
  </div>
</section>


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
  <p class="jc-footer-bottom">&copy; <?php echo date('Y'); ?> JETCAB. All rights reserved. &mdash; <a href="https://jetcab.mx/aviso-de-privacidad/" style="color:#8a8a8a">Privacy notice</a></p>
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
