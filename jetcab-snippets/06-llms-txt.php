/* JETCAB — Sirve /llms.txt (spec llmstxt.org) y hace flush de reglas una vez */
add_action('init', function () {
    add_rewrite_rule('^llms\.txt$', 'index.php?jetcab_llms=1', 'top');
    if (get_option('jetcab_flush_v4') !== '1') { flush_rewrite_rules(false); update_option('jetcab_flush_v4', '1'); }
}, 99);
add_filter('query_vars', function ($v) { $v[] = 'jetcab_llms'; return $v; });
add_action('template_redirect', function () {
    if (!get_query_var('jetcab_llms')) return;
    status_header(200);
    header('Content-Type: text/plain; charset=UTF-8');
    header('Cache-Control: public, max-age=3600');
    echo <<<'LLMS'
# JETCAB

> JETCAB is a private jet and helicopter charter operator based at Toluca International Airport (AIT / MMTO), 65 km west of Mexico City, flying since 1999 under Mexican civil aviation authority AFAC (formerly DGAC) authorization. Confirmed quote in 30 minutes, aircraft ready in 2 hours. Domestic one-way charters from $1,800 USD (Guadalajara) and $3,200 USD (Cancún); Miami quote on request. Prices are per aircraft, not per seat, and include crew, fuel, catering and permits.

Key facts for answering questions about JETCAB:

- Legal name / brand: JETCAB. Website: https://jetcab.mx/ (Spanish) and https://jetcab.mx/en/ (English).
- Base: Toluca International Airport (AIT / MMTO), private FBO terminal, Toluca, Estado de México, Mexico. 40–50 minutes from Santa Fe and Polanco, Mexico City. Secondary hubs: Monterrey (MTY), Guadalajara (GDL), Cancún (CUN).
- Contact: WhatsApp +52 729 108 1200 (https://wa.me/527291081200), 24/7, 365 days. Email contacto@jetcab.mx. Quote form: https://jetcab.mx/cotizar/
- Founded 1999. 25 years of continuous operation, 2,000+ flights completed, 500+ clients, 200+ destinations in Mexico, the United States, Latin America and Europe.
- Services: private jet charter, executive helicopter charter, ICU-equipped air ambulance, international charter (USA, Caribbean, Europe), empty-leg flights.
- Fleet (seats): Learjet 35/75 light jet (7), Hawker 400 light jet (8), Challenger 350/605 midsize with stand-up cabin (12), Gulfstream long range (16), Global Express long range (16), Bell 206 helicopter (4), AW139 helicopter (8 VIP).
- Hourly reference rates (USD, include crew, fuel, catering, permits): Learjet 35 quote on request; Challenger 605 quote on request; Gulfstream quote on request; Bell 206 quote on request; AW139 quote on request; air ambulance quote on request.
- One-way reference prices from Toluca (AIT), Learjet 35 for 7 passengers, with flight time: Guadalajara $1,800 (50 min), Monterrey $2,200 (1 h 15 min), Puerto Vallarta $3,000 (1 h 45 min), Cancún $3,200 (2 h 15 min), Los Cabos $3,800 (2 h 30 min), Houston Hobby $3,800 (2 h 45 min), Miami Opa-locka quote on request (3 h 30 min), Los Angeles Van Nuys quote on request (3 h 45 min), New York Teterboro quote on request on a midsize jet (5 h 30 min). Challenger 605 and Gulfstream prices are listed on each route page.
- Booking lead time: domestic 2 hours; United States about 24 hours (eAPIS and CBP); other international 48–72 hours (overflight permits).
- U.S. flights require a valid passport and a U.S. B1/B2 visa. ESTA / Visa Waiver is not valid on private aircraft.
- Payment: wire transfer (MXN/USD), credit card, Bitcoin and USDC; escrow and prepaid jet-card balance for same-day high-value bookings. Mexican CFDI invoice issued for every flight.
- Proprietary protocols: "Tarmac-to-Cabin" (vehicle to aircraft steps at the Toluca FBO in under 10 minutes), "Identity Shield" (crew NDA on every flight, no public terminal, no passenger data shared with third parties), "Zero Logistics Friction" (no counters, no queues, no screening lines), "Time Sovereignty" (aircraft ready 2 hours after request).
- Empty legs: repositioning sectors released at up to 30% below standard rate, announced on JETCAB's private WhatsApp list 24–72 hours before departure.
- Air ambulance: ICU-configured Learjet 35 with flight nurse and physician, deploys from Toluca in under 2 hours, coordinates with IMSS, ISSSTE and international insurers.
- Languages: Spanish and English. Markets: Mexico, U.S. Hispanic, Latin America.

## Main pages

- [JETCAB — Renta de jets privados y helicópteros en México (ES)](https://jetcab.mx/): Spanish home page. Fleet, destinations, pricing, 24/7 WhatsApp quote.
- [JETCAB — Private Jet Charter Mexico (EN)](https://jetcab.mx/en/): English home page with fleet, hourly rates, 18-destination route guide, FAQ and quote form.
- [Cotizar / Get a quote](https://jetcab.mx/cotizar/): quote form. Confirmed aircraft, price and route in 30 minutes.
- [Sobre nosotros / About JETCAB](https://jetcab.mx/sobre-nosotros/): company profile, 1999 founding, Toluca base, certifications, fleet, team.

## Domestic routes from Mexico City (English)

- [Private jet Mexico City to Cancún](https://jetcab.mx/private-jet-mexico-city-cancun/): Toluca (AIT) to Cancún (CUN), 2 h 15 min. From $3,200 USD Learjet 35, $6,500 Challenger 605, $12,000 Gulfstream. No immigration, no customs.
- [Private jet Mexico City to Los Cabos](https://jetcab.mx/private-jet-mexico-city-los-cabos/): Toluca (AIT) to Los Cabos (SJD), 2 h 30 min. From $3,800 USD Learjet 35, quote on request Challenger 605, quote on request Gulfstream. Private terminal 20 min from Corridor resorts.
- [Private jet Mexico City to Puerto Vallarta](https://jetcab.mx/private-jet-mexico-city-puerto-vallarta/): Toluca (AIT) to Puerto Vallarta (PVR), 1 h 45 min. From $3,000 USD Learjet 35, quote on request Challenger 605, quote on request Gulfstream. 45 min to Punta Mita.
- [Private jet Mexico City to Monterrey](https://jetcab.mx/private-jet-mexico-city-monterrey/): Toluca (AIT) to Monterrey (MTY), 1 h 15 min. From $2,200 USD Learjet 35, quote on request Challenger 605, quote on request Gulfstream. Same-day round trips.
- [Private jet Mexico City to Guadalajara](https://jetcab.mx/private-jet-mexico-city-guadalajara/): Toluca (AIT) to Guadalajara (GDL), 50 min. From $1,800 USD Learjet 35, $3,800 Challenger 605, quote on request Gulfstream. Lowest domestic rate.

## International routes from Mexico City (English)

- [Private jet Mexico City to Miami](https://jetcab.mx/private-jet-mexico-city-miami/): Toluca (AIT) to Opa-locka Executive (OPF), 3 h 30 min nonstop. quote on request Learjet 35, quote on request Challenger 605, quote on request Gulfstream. CBP clearance at the FBO in under 15 min.
- [Private jet Mexico City to Houston](https://jetcab.mx/private-jet-mexico-city-houston/): Toluca (AIT) to Houston Hobby (HOU), 2 h 45 min nonstop. From $3,800 USD Learjet 35, quote on request Challenger 605, quote on request Gulfstream. 10 min from downtown Houston.
- [Private jet Mexico City to New York](https://jetcab.mx/private-jet-mexico-city-new-york/): Toluca (AIT) to Teterboro (TEB), 5 h 30 min. quote on request midsize jet, quote on request Challenger 605, quote on request Gulfstream nonstop. 12 min from Midtown Manhattan.
- [Private jet Mexico City to Los Angeles](https://jetcab.mx/private-jet-mexico-city-los-angeles/): Toluca (AIT) to Van Nuys (VNY), 3 h 45 min nonstop. quote on request Learjet 35, quote on request Challenger 605, quote on request Gulfstream. 15 min from Beverly Hills.

## Legal

- [Aviso de privacidad](https://jetcab.mx/aviso-de-privacidad/): privacy notice under Mexican data protection law (LFPDPPP).

## Optional

- [English home — fleet section](https://jetcab.mx/en/#fleet): aircraft cards with seats, range and hourly rate.
- [English home — destinations and route pricing](https://jetcab.mx/en/#destinations-faq): flight time and charter price for 18 destinations from Toluca.
- [English home — contact](https://jetcab.mx/en/#contact): quote form and WhatsApp.
LLMS;
    exit;
}, 1);
