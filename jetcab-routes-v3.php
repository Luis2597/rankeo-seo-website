<?php
/*
 * JETCAB English Route Pages v3 - Photos + destination context, no competitor videos
 * WPCode snippet #2900 - replace existing content
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
            "title"        => "Private Jet Mexico City to Miami | Charter Flights - JETCAB",
            "dest"         => "Miami",
            "dest_full"    => "Miami, Florida",
            "from"         => "Mexico City",
            "from_iata"    => "AIT",
            "to_iata"      => "MIA",
            "time"         => "3h 30m",
            "slug"         => "miami",
            "slug_es"      => "vuelo-privado-cdmx-miami",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+Miami.",
            "meta_desc"    => "Private jet charter from Mexico City to Miami in 3h 30m. No terminals, no queues. From $4,800. JETCAB - 25 years, 2,000+ flights, ready in 2 hours.",
            "hero_tagline" => "5 hours on commercial. 3h 30m with JETCAB.",
            "hero_sub"     => "No boarding line. No connections. Your itinerary, not the airline\'s.",
            "hero_detail"  => "Miami - CDMX by private jet from AIT. Arrival at MIA or Opa-locka Executive.",
            "fomo"         => "2 jets available this week on this route",
            "p1"           => "$4,800",
            "p2"           => "$9,500",
            "p3"           => "$18,000",
            "cta_urgency"  => "Flying to Miami this week?",
            "cta_sub"      => "Availability still open. Send us your dates - quote in 30 minutes.",
            "intro_p1"     => "Commercial flights to Miami almost always connect. The private flight leaves from Toluca and arrives direct. The door-to-door time difference isn\'t 30 minutes - it\'s three hours.",
            "intro_p2"     => "You leave through a private terminal. No immigration queue. No departure board that keeps changing. Your jet is waiting on the tarmac when you arrive, not the other way around.",
            "detail_title" => "What changes when you fly private to Miami",
            "detail_body"  => "Opa-locka Executive Airport is 20 minutes from Miami Beach. MIA is 40. Your afternoon meetings in Brickell can start the same day you left CDMX. And if your schedule changes, the flight adjusts - not the other way around.",
            "hero_img"     => "1540962351504-03099e0a754b",
            "dest_img"     => "1533680834271-61bba76cf10a",
            "dest_label"   => "Miami, Florida — 20 minutes from South Beach.",
            "dest_sub"     => "Land at Opa-locka Executive. Step off and the driver is already waiting.",
        ],
        "houston" => [
            "title"        => "Private Jet Mexico City to Houston | Charter Flights - JETCAB",
            "dest"         => "Houston",
            "dest_full"    => "Houston, Texas",
            "from"         => "Mexico City",
            "from_iata"    => "AIT",
            "to_iata"      => "HOU",
            "time"         => "2h 45m",
            "slug"         => "houston",
            "slug_es"      => "vuelo-privado-cdmx-houston",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+Houston.",
            "meta_desc"    => "Private jet charter from Mexico City to Houston in 2h 45m. Business-class cabin, no queues. From $3,800. JETCAB - 25 years, 2,000+ flights.",
            "hero_tagline" => "Mexico City to Houston. 2h 45m and you\'re there.",
            "hero_sub"     => "The most-requested business route in our fleet. No connections, no waiting at the gate.",
            "hero_detail"  => "Houston - departure from AIT Toluca. Arrival at Hobby or Bush Intercontinental.",
            "fomo"         => "3 jets available this week on this route",
            "p1"           => "$3,800",
            "p2"           => "$7,500",
            "p3"           => "$14,000",
            "cta_urgency"  => "Business trip to Houston this week?",
            "cta_sub"      => "Our most-requested route. Quote in under 30 minutes.",
            "intro_p1"     => "Houston is the most frequently requested business route we operate. Oil companies, construction firms, law offices - the people who make this trip weekly know that flying private isn\'t an expense, it\'s recovered time.",
            "intro_p2"     => "Two hours forty-five minutes in the cabin. You arrive rested, not having spent that time in a terminal with 400 strangers. The afternoon meeting starts at a different level of energy.",
            "detail_title" => "Why Houston by private jet makes financial sense",
            "detail_body"  => "If the trip includes two or more people from the same team, the per-person cost of a Learjet 35 is comparable to business class in high season. With the difference that the aircraft runs on your schedule, catering is what you order, and there\'s no risk of a last-minute cancellation.",
            "hero_img"     => "1486325212027-8081e485255e",
            "dest_img"     => "1548504769-57e9bd53e42c",
            "dest_label"   => "Houston, Texas — Energy Capital of the World.",
            "dest_sub"     => "Wheels down at Hobby or Bush Intercontinental. Meetings start the same afternoon.",
        ],
        "new-york" => [
            "title"        => "Private Jet Mexico City to New York | Charter Flights - JETCAB",
            "dest"         => "New York",
            "dest_full"    => "New York, NY",
            "from"         => "Mexico City",
            "from_iata"    => "AIT",
            "to_iata"      => "TEB",
            "time"         => "5h 30m",
            "slug"         => "new-york",
            "slug_es"      => "vuelo-privado-cdmx-nueva-york",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+New+York.",
            "meta_desc"    => "Private jet charter from Mexico City to New York in 5h 30m. Arrive at Teterboro, skip JFK. From $9,500. JETCAB - 25 years, DGAC certified.",
            "hero_tagline" => "Mexico City to New York. Direct. 5 hours 30 minutes.",
            "hero_sub"     => "The long route flies differently when there are no connections through Dallas and no lines at JFK.",
            "hero_detail"  => "New York - departure from AIT. Arrival at Teterboro (TEB) or White Plains. No JFK.",
            "fomo"         => "1 long-range jet available this week",
            "p1"           => "$9,500",
            "p2"           => "$18,500",
            "p3"           => "$28,000",
            "cta_urgency"  => "New York this month?",
            "cta_sub"      => "Only one long-range jet available this week. Send us your dates.",
            "intro_p1"     => "The commercial flight to New York almost always connects through Dallas or Atlanta. Five hours becomes eight. The private jet leaves from Toluca and arrives at Teterboro - 15 minutes from Manhattan - nonstop, no baggage carousel, no JFK cab.",
            "intro_p2"     => "On board the Gulfstream GV there are six hours of flight you can use: conference seating for 8, a full bedroom, satellite Wi-Fi. This isn\'t lost time. It\'s the most productive part of the trip.",
            "detail_title" => "Teterboro versus JFK",
            "detail_body"  => "JFK is 45 minutes from Midtown by taxi, more during peak hours. Teterboro is 12. If you have meetings in the Financial District the same day you arrive, the airport difference can matter more than the aircraft difference.",
            "hero_img"     => "1485871900405-a6fc37cb82e0",
            "dest_img"     => "1534430480872-e9a62c0c8d96",
            "dest_label"   => "New York, New York — 12 minutes from Teterboro to Midtown.",
            "dest_sub"     => "Skip JFK. Your car meets you at the FBO steps.",
        ],
        "los-angeles" => [
            "title"        => "Private Jet Mexico City to Los Angeles | Charter Flights - JETCAB",
            "dest"         => "Los Angeles",
            "dest_full"    => "Los Angeles, California",
            "from"         => "Mexico City",
            "from_iata"    => "AIT",
            "to_iata"      => "VNY",
            "time"         => "3h 45m",
            "slug"         => "los-angeles",
            "slug_es"      => "vuelo-privado-cdmx-los-angeles",
            "wa_text"      => "Hi%2C+I%27d+like+a+quote+for+a+private+jet+from+Mexico+City+to+Los+Angeles.",
            "meta_desc"    => "Private jet charter from Mexico City to Los Angeles in 3h 45m. Land at Van Nuys, skip LAX. From $5,200. JETCAB - 25 years, 2,000+ flights.",
            "hero_tagline" => "Mexico City to Los Angeles. 3 hours 45 minutes, nonstop.",
            "hero_sub"     => "Commercial flights connect. The private one doesn\'t. Van Nuys is 15 minutes from Beverly Hills.",
            "hero_detail"  => "Los Angeles - departure from AIT. Arrival at Van Nuys (VNY) or Santa Monica.",
            "fomo"         => "2 jets available this week on this route",
            "p1"           => "$5,200",
            "p2"           => "$10,500",
            "p3"           => "$19,000",
            "cta_urgency"  => "Los Angeles this week?",
            "cta_sub"      => "Availability confirmed in under 30 minutes.",
            "intro_p1"     => "Los Angeles has three private airport options: Van Nuys, Santa Monica, and Burbank. LAX is not one of them - and that\'s part of the point. You arrive 15 minutes from Beverly Hills, not 45 from Inglewood.",
            "intro_p2"     => "The entertainment industry and high-profile real estate in California are two of the most common reasons our clients make this trip. In both cases, the time between the meeting and the plane matters.",
            "detail_title" => "Van Nuys: the airport commercial flyers never see",
            "detail_body"  => "Van Nuys (VNY) is the busiest general aviation airport in California. No commercial flights, no international terminal, no lines. Just private jets and their passengers. You land, step off, and you\'re in the car in under 5 minutes.",
            "hero_img"     => "1501594907352-04cda38ebc29",
            "dest_img"     => "1504941812617-26c6e088459a",
            "dest_label"   => "Los Angeles, California — 15 minutes from Van Nuys to Beverly Hills.",
            "dest_sub"     => "No LAX. No Inglewood traffic. You arrive where your meeting is.",
        ],
    ];
    if (!isset($routes[$route])) return;
    status_header(200);
    header("Content-Type: text/html; charset=UTF-8");
    echo jetcab_route_page_v3($routes[$route]);
    exit;
});

function jetcab_route_page_v3($r) {
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
{"@context":"https://schema.org","@graph":[{"@type":"WebPage","@id":"<?php echo $canonical; ?>","url":"<?php echo $canonical; ?>","name":"<?php echo esc_js($r['title']); ?>","inLanguage":"en"},{"@type":"Service","name":"Private Jet Charter Mexico City to <?php echo esc_js($r['dest_full']); ?>","description":"<?php echo esc_js($r['meta_desc']); ?>","provider":{"@type":"LocalBusiness","name":"JETCAB","url":"https://jetcab.mx","telephone":"+52-729-108-1200"},"serviceType":"Air Charter","offers":{"@type":"Offer","priceCurrency":"USD","price":"<?php echo ltrim($r['p1'],'$'); ?>"}},{"@type":"FAQPage","mainEntity":[{"@type":"Question","name":"How long is the flight from Mexico City to <?php echo esc_js($r['dest']); ?>?","acceptedAnswer":{"@type":"Answer","text":"The flight takes <?php echo esc_js($r['time']); ?> on a private jet."}},{"@type":"Question","name":"How much does a private jet to <?php echo esc_js($r['dest']); ?> cost?","acceptedAnswer":{"@type":"Answer","text":"Prices start at <?php echo esc_js($r['p1']); ?> USD for a light jet up to 7 passengers."}}]}]}
</script>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{--orange:#E85A1E;--gold:#C9973F;--dark:#0D0D0D;--dark2:#141414;--dark3:#1A1A1A;--border:rgba(255,255,255,0.1);--text:#E8E8E8;--muted:#999;--ff-head:'Barlow Condensed',sans-serif;--ff-body:'Barlow',sans-serif}
html{scroll-behavior:smooth}body{background:var(--dark);color:var(--text);font-family:var(--ff-body);line-height:1.6}
.jc-nav{position:fixed;top:0;left:0;right:0;z-index:100;display:flex;align-items:center;justify-content:space-between;padding:1rem 2rem;background:rgba(13,13,13,0.92);backdrop-filter:blur(12px);border-bottom:1px solid var(--border)}
.jc-nav-logo{font-family:var(--ff-head);font-size:1.5rem;font-weight:800;letter-spacing:0.08em;color:#fff;text-decoration:none}
.jc-nav-logo span{color:var(--orange)}.jc-nav-links{display:flex;align-items:center;gap:2rem}
.jc-nav-links a{color:var(--muted);text-decoration:none;font-size:0.875rem;transition:color 0.2s}.jc-nav-links a:hover{color:#fff}
.jc-nav-cta{background:var(--orange);color:#fff!important;padding:0.5rem 1.25rem;border-radius:4px;font-size:0.875rem;font-weight:600;text-decoration:none}
.jc-nav-cta:hover{background:#ff6a2f}.jc-lang{color:var(--muted)!important;font-size:0.75rem;border:1px solid var(--border);padding:0.3rem 0.6rem;border-radius:3px}
@media(max-width:768px){.jc-nav-links{display:none}}
.jc-hero{min-height:100vh;display:flex;align-items:center;padding:7rem 2rem 4rem;position:relative;overflow:hidden}
.jc-hero::before{content:'';position:absolute;inset:0;background:url('https://images.unsplash.com/photo-<?php echo esc_attr($r['hero_img']); ?>?auto=format&fit=crop&w=1600&q=85') center/cover no-repeat;opacity:0.6}
.jc-hero::after{content:'';position:absolute;inset:0;background:linear-gradient(105deg,rgba(13,13,13,0.93) 40%,rgba(13,13,13,0.6) 70%,rgba(13,13,13,0.25) 100%)}
.jc-hero-inner{max-width:900px;margin:0 auto;position:relative;z-index:2}
.jc-vista{position:relative;height:56vh;min-height:300px;overflow:hidden}
.jc-vista img{width:100%;height:100%;object-fit:cover;display:block}
.jc-vista-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(13,13,13,0.88) 0%,rgba(13,13,13,0.25) 55%,transparent 100%)}
.jc-vista-text{position:absolute;bottom:2.5rem;left:50%;transform:translateX(-50%);text-align:center;width:100%;padding:0 2rem}
.jc-vista-text h3{font-family:var(--ff-head);font-size:clamp(1.5rem,3.5vw,2.4rem);font-weight:800;color:#fff;letter-spacing:-0.01em;text-transform:uppercase;margin-bottom:0.5rem}
.jc-vista-text p{font-size:0.9rem;color:rgba(255,255,255,0.62);max-width:520px;margin:0 auto}
.jc-intro-split{display:grid;grid-template-columns:1.1fr 0.9fr;gap:4rem;align-items:start}
.jc-cabin-photo{position:relative;border-radius:10px;overflow:hidden}
.jc-cabin-photo img{width:100%;display:block;object-fit:cover;aspect-ratio:4/5}
.jc-cabin-caption{position:absolute;bottom:0;left:0;right:0;background:linear-gradient(to top,rgba(0,0,0,0.85) 0%,transparent 100%);padding:2rem 1.5rem 1.25rem}
.jc-cabin-caption p{font-size:0.82rem;color:rgba(255,255,255,0.75);line-height:1.5}
.jc-cabin-caption strong{display:block;font-family:var(--ff-head);font-size:0.72rem;letter-spacing:0.18em;text-transform:uppercase;color:var(--orange);margin-bottom:0.25rem}
.jc-route-badge{display:inline-flex;align-items:center;background:rgba(232,90,30,0.15);border:1px solid rgba(232,90,30,0.4);color:var(--orange);padding:0.4rem 1rem;border-radius:2px;font-family:var(--ff-head);font-size:0.85rem;letter-spacing:0.12em;text-transform:uppercase;margin-bottom:1.5rem}
.jc-hero h1{font-family:var(--ff-head);font-size:clamp(2.5rem,6vw,4.5rem);font-weight:800;line-height:1.05;color:#fff;margin-bottom:1.25rem}
.jc-hero-sub{font-size:1.15rem;color:#bbb;max-width:600px;margin-bottom:0.5rem;line-height:1.7}
.jc-hero-detail{font-size:0.85rem;color:var(--muted);margin-bottom:2rem}
.jc-avail{display:inline-flex;align-items:center;gap:0.6rem;background:rgba(20,20,20,0.9);border:1px solid rgba(255,255,255,0.12);padding:0.6rem 1.25rem;border-radius:3px;font-size:0.85rem;color:#ccc;margin-bottom:2rem}
.jc-avail-dot{width:8px;height:8px;background:#22c55e;border-radius:50%;flex-shrink:0;animation:pulse-green 2s infinite}
@keyframes pulse-green{0%,100%{box-shadow:0 0 0 0 rgba(34,197,94,0.4)}50%{box-shadow:0 0 0 6px rgba(34,197,94,0)}}
.jc-hero-ctas{display:flex;gap:1rem;flex-wrap:wrap;margin-bottom:2.5rem}
.btn-primary{background:var(--orange);color:#fff;padding:0.9rem 2rem;border-radius:4px;font-size:1rem;font-weight:600;text-decoration:none;transition:background 0.2s,transform 0.15s;display:inline-block}
.btn-primary:hover{background:#ff6a2f;transform:translateY(-1px)}
.btn-ghost{border:1px solid rgba(255,255,255,0.25);color:#fff;padding:0.9rem 2rem;border-radius:4px;font-size:1rem;text-decoration:none;transition:border-color 0.2s;display:inline-block}
.btn-ghost:hover{border-color:rgba(255,255,255,0.5)}
.jc-trust-bar{display:flex;gap:2rem;flex-wrap:wrap}
.jc-trust-bar span{font-size:0.8rem;color:var(--muted);letter-spacing:0.05em;text-transform:uppercase}
.jc-trust-bar span strong{color:var(--gold);font-weight:600}
.jc-route-bar{background:var(--dark2);border-top:1px solid var(--border);border-bottom:1px solid var(--border);padding:1.5rem 2rem}
.jc-route-bar-inner{max-width:900px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap}
.jc-port{text-align:center}.jc-port-iata{font-family:var(--ff-head);font-size:2rem;font-weight:800;color:#fff;letter-spacing:0.05em}
.jc-port-name{font-size:0.78rem;color:var(--muted);letter-spacing:0.08em;text-transform:uppercase;margin-top:0.2rem}
.jc-route-line{flex:1;display:flex;align-items:center;gap:0.75rem}
.jc-route-line-bar{flex:1;height:1px;background:linear-gradient(to right,var(--orange),var(--gold))}
.jc-route-time{font-family:var(--ff-head);font-size:1.1rem;font-weight:700;color:var(--gold);white-space:nowrap}
.jc-section{padding:5rem 2rem}.jc-section-inner{max-width:900px;margin:0 auto}
.jc-section-label{font-family:var(--ff-head);font-size:0.8rem;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:var(--orange);margin-bottom:1rem}
.jc-section h2{font-family:var(--ff-head);font-size:clamp(1.8rem,4vw,2.8rem);font-weight:800;color:#fff;line-height:1.1;margin-bottom:1rem}
.jc-section p{color:#bbb;font-size:1rem;max-width:620px;line-height:1.75;margin-bottom:1.25rem}
.jc-intro-grid{display:grid;grid-template-columns:1fr 1fr;gap:2.5rem;margin-top:2rem}
.jc-intro-card{border-left:2px solid var(--orange);padding-left:1.25rem}
.jc-intro-card h3{font-family:var(--ff-head);font-size:1.05rem;font-weight:700;color:#fff;margin-bottom:0.6rem}
.jc-intro-card p{color:#aaa;font-size:0.9rem;line-height:1.7;margin:0}
.jc-fleet-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1.5rem;margin-top:2.5rem}
.jc-fleet-card{background:var(--dark3);border:1px solid var(--border);border-radius:8px;overflow:hidden;transition:border-color 0.2s,transform 0.2s}
.jc-fleet-card:hover{border-color:rgba(232,90,30,0.4);transform:translateY(-2px)}
.jc-fleet-img{position:relative;padding-top:52%;background:#111;overflow:hidden}
.jc-fleet-img img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:0.85;transition:opacity 0.3s}
.jc-fleet-card:hover .jc-fleet-img img{opacity:1}
.jc-fleet-badge{position:absolute;bottom:0.75rem;left:0.75rem;font-family:var(--ff-head);font-size:0.7rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:var(--orange);background:rgba(0,0,0,0.8);padding:0.25rem 0.6rem;border-radius:2px}
.jc-fleet-txt-top{padding:2rem 1.5rem;text-align:center;border-bottom:1px solid var(--border);background:#0a0a0a}
.jc-fleet-txt-name{font-family:var(--ff-head);font-size:2.2rem;font-weight:800;color:rgba(255,255,255,0.07);letter-spacing:-0.02em}
.jc-fleet-txt-sub{font-size:0.72rem;color:var(--muted);letter-spacing:0.15em;text-transform:uppercase;margin-top:0.4rem}
.jc-fleet-body{padding:1.25rem}
.jc-fleet-class{font-size:0.72rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:var(--orange);margin-bottom:0.4rem}
.jc-fleet-name{font-family:var(--ff-head);font-size:1.4rem;font-weight:800;color:#fff;margin-bottom:0.5rem}
.jc-fleet-desc{font-size:0.875rem;color:#999;line-height:1.6;margin-bottom:1rem}
.jc-fleet-specs{display:flex;gap:1.5rem;flex-wrap:wrap;margin-bottom:1rem}
.jc-fleet-spec{font-size:0.78rem;color:var(--muted)}.jc-fleet-spec strong{display:block;font-size:1rem;color:#fff;font-weight:700;font-family:var(--ff-head)}
.jc-fleet-price{display:flex;align-items:baseline;gap:0.4rem}
.jc-fleet-price-from{font-size:0.72rem;color:var(--muted)}
.jc-fleet-price-amount{font-family:var(--ff-head);font-size:1.6rem;font-weight:800;color:var(--gold)}
.jc-fleet-cta{display:block;text-align:center;margin-top:0.75rem;background:transparent;border:1px solid var(--orange);color:var(--orange);padding:0.6rem 1rem;border-radius:4px;font-size:0.875rem;font-weight:600;text-decoration:none;transition:background 0.2s,color 0.2s}
.jc-fleet-cta:hover{background:var(--orange);color:#fff}
.jc-why-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.5rem;margin-top:2rem}
.jc-why-card{border-left:2px solid var(--orange);padding-left:1.25rem}
.jc-why-card h3{font-family:var(--ff-head);font-size:1.1rem;font-weight:700;color:#fff;margin-bottom:0.5rem}
.jc-why-card p{font-size:0.875rem;color:var(--muted);line-height:1.6}
.jc-faq-list{margin-top:2rem}.jc-faq-item{border-bottom:1px solid var(--border)}
.jc-faq-q{width:100%;background:none;border:none;color:#fff;font-family:var(--ff-body);font-size:1rem;font-weight:500;text-align:left;padding:1.25rem 0;cursor:pointer;display:flex;justify-content:space-between;align-items:center;gap:1rem}
.jc-faq-q:hover{color:var(--orange)}.jc-faq-icon{font-size:1.25rem;color:var(--orange);flex-shrink:0;transition:transform 0.25s}
.jc-faq-item.open .jc-faq-icon{transform:rotate(45deg)}
.jc-faq-a{max-height:0;overflow:hidden;transition:max-height 0.3s ease}
.jc-faq-item.open .jc-faq-a{max-height:300px}
.jc-faq-a p{padding:0 0 1.25rem;color:#aaa;font-size:0.95rem;line-height:1.7;margin:0}
.jc-cta-final{background:linear-gradient(135deg,var(--dark2),#0a0a0a);border-top:1px solid var(--border);text-align:center}
.jc-cta-final h2{font-family:var(--ff-head);font-size:clamp(2rem,5vw,3.5rem);font-weight:800;color:#fff;margin-bottom:1rem}
.jc-cta-final p{color:#999;font-size:1rem;max-width:500px;margin:0 auto 2.5rem}
.jc-cta-pair{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap}
.jc-footer{background:#0A0A0A;border-top:1px solid var(--border);padding:3rem 2rem}
.jc-footer-inner{max-width:900px;margin:0 auto;display:flex;justify-content:space-between;align-items:flex-start;gap:2rem;flex-wrap:wrap}
.jc-footer-brand p{font-size:0.8rem;color:var(--muted);margin-top:0.5rem;max-width:240px;line-height:1.6}
.jc-footer-links{display:flex;flex-direction:column;gap:0.5rem}
.jc-footer-links a{font-size:0.85rem;color:var(--muted);text-decoration:none;transition:color 0.2s}
.jc-footer-links a:hover{color:#fff}
.jc-footer-bottom{text-align:center;font-size:0.75rem;color:#555;padding-top:2rem;margin-top:2rem;border-top:1px solid var(--border);max-width:900px;margin-left:auto;margin-right:auto}
@keyframes pulse-wa{0%,100%{box-shadow:0 4px 16px rgba(37,211,102,0.4)}50%{box-shadow:0 4px 24px rgba(37,211,102,0.65)}}
@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation:none!important;transition:none!important}}
@media(max-width:768px){.jc-intro-split{grid-template-columns:1fr!important;gap:2rem}.jc-cabin-photo{display:none}}
@media(max-width:640px){.jc-intro-grid{grid-template-columns:1fr}.jc-route-bar-inner{flex-direction:column;text-align:center;gap:0.5rem}.jc-route-line{width:100%;justify-content:center}.jc-hero-ctas{flex-direction:column}.btn-primary,.btn-ghost{text-align:center}}
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
  <div class="jc-hero-inner">
    <div class="jc-route-badge"><?php echo esc_html($r['from']); ?> &rarr; <?php echo esc_html($r['dest']); ?></div>
    <h1><?php echo esc_html($r['hero_tagline']); ?></h1>
    <p class="jc-hero-sub"><?php echo esc_html($r['hero_sub']); ?></p>
    <p class="jc-hero-detail"><?php echo esc_html($r['hero_detail']); ?></p>
    <div class="jc-avail"><span class="jc-avail-dot"></span><?php echo esc_html($r['fomo']); ?></div>
    <div class="jc-hero-ctas">
      <a href="<?php echo $wa; ?>" class="btn-primary" target="_blank">Request availability &rarr;</a>
      <a href="https://jetcab.mx/cotizar/" class="btn-ghost">View pricing</a>
    </div>
    <div class="jc-trust-bar">
      <span><strong>25 years</strong> in aviation</span>
      <span><strong>2,000+</strong> flights completed</span>
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
<div class="jc-vista">
  <img src="https://images.unsplash.com/photo-<?php echo esc_attr($r['dest_img']); ?>?auto=format&fit=crop&w=1600&q=85" alt="<?php echo esc_attr($r['dest_full']); ?> private jet arrival" loading="lazy">
  <div class="jc-vista-overlay"></div>
  <div class="jc-vista-text">
    <h3><?php echo esc_html($r['dest_label']); ?></h3>
    <p><?php echo esc_html($r['dest_sub']); ?></p>
  </div>
</div>
<section class="jc-section" style="background:var(--dark2)">
  <div class="jc-section-inner">
    <div class="jc-intro-split">
      <div>
        <div class="jc-section-label">Why this route</div>
        <h2><?php echo esc_html($r['detail_title']); ?></h2>
        <div class="jc-intro-grid" style="margin-top:1.5rem">
          <div class="jc-intro-card"><h3>The real difference</h3><p><?php echo esc_html($r['intro_p1']); ?></p></div>
          <div class="jc-intro-card"><h3>In practical terms</h3><p><?php echo esc_html($r['intro_p2']); ?></p></div>
        </div>
        <p style="margin-top:2rem"><?php echo esc_html($r['detail_body']); ?></p>
      </div>
      <div class="jc-cabin-photo">
        <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=85" alt="Private jet cabin interior luxury" loading="lazy">
        <div class="jc-cabin-caption">
          <strong>On board</strong>
          <p>Full leather cabin. Crew briefed on your preferences before departure. Catering loaded to order.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="jc-section">
  <div class="jc-section-inner">
    <div class="jc-section-label">Choose your cabin</div>
    <h2>Three aircraft for this route.</h2>
    <p>Every aircraft in our fleet is DGAC-certified and maintained to international standards. Your crew briefs you on board - no gate announcements, no overhead bins.</p>
    <div class="jc-fleet-grid">
      <div class="jc-fleet-card">
        <div class="jc-fleet-img">
          <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=75" alt="Light jet private cabin" loading="lazy">
          <span class="jc-fleet-badge">Light Jet</span>
        </div>
        <div class="jc-fleet-body">
          <div class="jc-fleet-class">Light Jet</div><div class="jc-fleet-name">Learjet 35</div>
          <p class="jc-fleet-desc">Fast, efficient, comfortable for groups up to 7. Built for routes like this one - quick turnaround, cruises at 850 km/h, full leather cabin. If it's just you or a small team, this is the jet.</p>
          <div class="jc-fleet-specs">
            <div class="jc-fleet-spec"><strong>7</strong>Passengers</div>
            <div class="jc-fleet-spec"><strong>850 km/h</strong>Cruise speed</div>
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
          <p class="jc-fleet-desc">The cabin stands 6 feet tall. You can walk through it without ducking. Seats 12, full-size galley, windows twice the size of most jets in this class. For family trips or board-level meetings, this is the right call.</p>
          <div class="jc-fleet-specs">
            <div class="jc-fleet-spec"><strong>12</strong>Passengers</div>
            <div class="jc-fleet-spec"><strong>882 km/h</strong>Cruise speed</div>
            <div class="jc-fleet-spec"><strong>Starlink</strong>Wi-Fi</div>
          </div>
          <div class="jc-fleet-price"><span class="jc-fleet-price-from">From</span><span class="jc-fleet-price-amount"><?php echo esc_html($r['p2']); ?> USD</span></div>
          <a href="<?php echo $wa; ?>" class="jc-fleet-cta" target="_blank">Book this aircraft</a>
        </div>
      </div>
      <div class="jc-fleet-card">
        <div class="jc-fleet-img">
          <img src="https://images.unsplash.com/photo-1540962351504-03099e0a754b?auto=format&fit=crop&w=800&q=75" alt="Large cabin private jet" loading="lazy">
          <span class="jc-fleet-badge">Large Cabin</span>
        </div>
        <div class="jc-fleet-body">
          <div class="jc-fleet-class">Large Cabin Jet</div><div class="jc-fleet-name">Gulfstream GV</div>
          <p class="jc-fleet-desc">This is the aircraft heads of state use. The GV has a full-size bedroom, conference seating for 8, and the range to get from CDMX to New York nonstop. If this trip matters, this is the cabin you want around it.</p>
          <div class="jc-fleet-specs">
            <div class="jc-fleet-spec"><strong>16</strong>Passengers</div>
            <div class="jc-fleet-spec"><strong>904 km/h</strong>Cruise speed</div>
            <div class="jc-fleet-spec"><strong>Bedroom</strong>On board</div>
          </div>
          <div class="jc-fleet-price"><span class="jc-fleet-price-from">From</span><span class="jc-fleet-price-amount"><?php echo esc_html($r['p3']); ?> USD</span></div>
          <a href="<?php echo $wa; ?>" class="jc-fleet-cta" target="_blank">Book this aircraft</a>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="jc-section" style="background:var(--dark2)">
  <div class="jc-section-inner">
    <div class="jc-section-label">What makes the difference</div>
    <h2>Why JETCAB clients come back.</h2>
    <div class="jc-why-grid">
      <div class="jc-why-card"><h3>Jet ready in 2 hours</h3><p>From your call to wheels-up. Our operations center has confirmed this on hundreds of last-minute requests. Two hours is real.</p></div>
      <div class="jc-why-card"><h3>Private terminal at Toluca</h3><p>AIT (Toluca International) is 60 km from CDMX. Our clients go from armored vehicle to plane steps in under 10 minutes. No crowds, no commercial terminals.</p></div>
      <div class="jc-why-card"><h3>The crew knows who you are</h3><p>Before you board, your captain has your preferences. The cabin is stocked how you like it. The only person waiting is your crew.</p></div>
      <div class="jc-why-card"><h3>25 years, zero incidents</h3><p>JETCAB has operated since 1999. DGAC certified, OACI compliant, with an unblemished safety record across 2,000+ flights.</p></div>
    </div>
  </div>
</section>
<section class="jc-section">
  <div class="jc-section-inner">
    <div class="jc-section-label">Common questions</div>
    <h2>What people ask before their first charter.</h2>
    <div class="jc-faq-list">
      <div class="jc-faq-item"><button class="jc-faq-q">How do I book? <span class="jc-faq-icon">+</span></button><div class="jc-faq-a"><p>Send us a WhatsApp or fill out the quote form. We respond within 30 minutes with aircraft availability and pricing for your exact dates. No commitment required at that stage.</p></div></div>
      <div class="jc-faq-item"><button class="jc-faq-q">What's included in the price? <span class="jc-faq-icon">+</span></button><div class="jc-faq-a"><p>The quote covers the full aircraft, not per seat. Included: crew, taxes, landing fees, standard catering, and ground handling. Optional add-ons: specific beverages, upgraded catering, international handling fees on some routes.</p></div></div>
      <div class="jc-faq-item"><button class="jc-faq-q">How far in advance do I need to book? <span class="jc-faq-icon">+</span></button><div class="jc-faq-a"><p>We've confirmed flights with 90 minutes' notice. For specific aircraft types or high-demand dates, earlier is better. Same-day availability drops significantly during holiday periods.</p></div></div>
      <div class="jc-faq-item"><button class="jc-faq-q">Which airport do we fly from in Mexico City? <span class="jc-faq-icon">+</span></button><div class="jc-faq-a"><p>Most clients depart from Toluca (AIT), which has a private terminal with no commercial traffic. We can also depart from AICM or AIFA depending on the aircraft type and your preference.</p></div></div>
      <div class="jc-faq-item"><button class="jc-faq-q">How much does a private jet to <?php echo esc_html($r['dest']); ?> cost? <span class="jc-faq-icon">+</span></button><div class="jc-faq-a"><p>The price covers the full aircraft, not per seat. Learjet 35 (up to 7 people) from <?php echo esc_html($r['p1']); ?> USD. Challenger 605 (12 people) from <?php echo esc_html($r['p2']); ?> USD. Gulfstream GV (16 people) from <?php echo esc_html($r['p3']); ?> USD. Includes crew, taxes, landing fees, standard catering and ground coordination.</p></div></div>
    </div>
  </div>
</section>
<section class="jc-section jc-cta-final">
  <div class="jc-section-inner" style="text-align:center">
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
      <p>Private jet charters from Mexico since 1999. DGAC certified. Available 7 days a week, 365 days a year.</p>
    </div>
    <div class="jc-footer-links">
      <a href="https://jetcab.mx/en/">English home</a>
      <a href="https://jetcab.mx/#flota">Our fleet</a>
      <a href="https://jetcab.mx/cotizar/">Request a quote</a>
      <a href="https://jetcab.mx/sobre-nosotros/">About JETCAB</a>
    </div>
    <div class="jc-footer-links">
      <a href="https://jetcab.mx/private-jet-mexico-city-miami/">CDMX to Miami</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-houston/">CDMX to Houston</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-new-york/">CDMX to New York</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-los-angeles/">CDMX to Los Angeles</a>
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
