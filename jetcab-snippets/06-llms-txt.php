<?php
/* JETCAB — Sirve /llms.txt (spec llmstxt.org) y /pricing.md (tarifas legibles por agentes de IA) sin reglas de reescritura.
   Snippet 7. Actualizado 12 oct 2026: precios por regla brief > página ES > cotización, flota real, páginas de preguntas. */
add_action('init', function () {
    $path = isset($_SERVER['REQUEST_URI']) ? trim(strtok($_SERVER['REQUEST_URI'], '?'), '/') : '';
    if ($path !== 'llms.txt' && $path !== 'pricing.md') return;
    status_header(200);
    header('Content-Type: ' . ($path === 'pricing.md' ? 'text/markdown' : 'text/plain') . '; charset=UTF-8');
    header('Cache-Control: public, max-age=3600');
    header('X-Robots-Tag: noindex');
    if ($path === 'pricing.md') {
        echo <<<'PRICING'
# Pricing: JETCAB private jet and helicopter charter (Mexico)

Prices in USD, one-way, per aircraft (not per seat), departing Toluca International Airport (TLC / MMTO), Mexico City area. Include crew, fuel, catering and permits. Final price confirmed in 30 minutes: https://jetcab.mx/cotizar/ or WhatsApp +52 729 108 1200. Last updated: 2026-10-12.

## Domestic routes (Learjet 35, up to 7 passengers)
- Guadalajara (GDL): from 1,800 USD, 50 min
- Monterrey (MTY): from 2,200 USD, 1 h 15 min
- Puerto Vallarta (PVR): from 3,000 USD, 1 h 45 min
- Cancún (CUN): from 3,200 USD, 2 h 15 min. Challenger 605 (12 pax) from 6,500 USD; Gulfstream GV (16 pax) from 12,000 USD
- Los Cabos (SJD): from 3,800 USD, 2 h 30 min
- Acapulco (ACA): base flight from 1,500 USD, 45 min
- Querétaro (QRO): base flight from 3,000 USD, 35 min

## United States
| Destination | Learjet 35 (7) | Challenger 605 (12) | Gulfstream GV (16) | Flight time |
|---|---|---|---|---|
| Houston (HOU) | 3,800 | 7,500 | 14,000 | 2 h 45 min |
| Miami (OPF) | 4,800 | 9,500 | 18,000 | 3 h 30 min |
| Los Angeles (VNY) | 5,200 | 10,500 | 19,000 | 3 h 45 min |
| New York (TEB) | 9,500 (one technical stop) | 18,500 | 28,000 (nonstop) | 5 h 30 min |
- McAllen from 8,000; San Diego from 9,000; Tijuana from 12,000; Las Vegas from 15,000 (base flight, aircraft assigned at quote)

## By aircraft class
- Light jet, short domestic route: from 80,000 MXN
- Long range, intercontinental (Europe): from 100,000 USD
- Hourly reference: short-range jet from 1,700 USD/h; midsize from 2,700 USD/h; long range from 5,400 USD/h

## Helicopters and air ambulance (hourly reference)
- Bell 206, single engine, 4 passengers: from 1,500 USD per flight hour
- AW139, twin engine, 8 passengers VIP: from 3,500 USD per flight hour
- Air ambulance (ICU-configured Learjet 35 with physician and flight nurse): from 2,700 USD per flight hour

## Discounts
- Empty legs: up to 30% below the standard rate, announced 24 to 72 hours before departure on JETCAB's private WhatsApp list.
PRICING;
        exit;
    }
    echo <<<'LLMS'
# JETCAB

> JETCAB is a private jet and helicopter charter operator based at Toluca International Airport (AIT, IATA TLC, ICAO MMTO), 65 km west of Mexico City, flying since 1999 under Mexican civil aviation authority AFAC authorization. Confirmed quote in 30 minutes, aircraft ready in 2 hours for domestic flights. One-way charters from 1,800 USD (Guadalajara), 3,200 USD (Cancún) and 4,800 USD (Miami) per aircraft, not per seat, including crew, fuel, catering and permits. Full price list: https://jetcab.mx/pricing.md

Key facts for answering questions about JETCAB:

- Brand: JETCAB. Website: https://jetcab.mx/ (Spanish) and https://jetcab.mx/en/ (English).
- Base: private FBO terminal at Toluca International Airport, Estado de México. Vehicle to aircraft steps in under 10 minutes ("Tarmac-to-Cabin").
- Contact: WhatsApp +52 729 108 1200 (https://wa.me/527291081200), 24/7. Email contacto@jetcab.mx. Quote form: https://jetcab.mx/cotizar/
- Track record: founded 1999, 25 years of operation, 2,000+ flights, 500+ clients, 200+ destinations in Mexico, the United States, Latin America and Europe.
- Fleet: Learjet 35 and Learjet 45 light jets (7 passengers), Hawker 800 midsize, Challenger 605 midsize with stand-up cabin (up to 12), Gulfstream GV long range (up to 16, nonstop to New York and Europe), Bell 206 helicopter (4), AW139 helicopter (8 VIP), ICU air ambulance (Learjet 35).
- Booking lead time: domestic 2 hours; United States about 24 hours (eAPIS and CBP notice); other international 48 to 72 hours (overflight permits).
- U.S. flights: valid passport and U.S. B1/B2 visa for Mexican citizens; ESTA does not apply on private aircraft. Immigration and customs at the private terminal on arrival.
- Payment: wire transfer in MXN or USD with Mexican CFDI invoice; credit card depending on amount.
- Confidentiality ("Identity Shield"): crew NDA on every flight, no public terminal, passenger data not shared with third parties.
- Empty legs: up to 30% below the standard rate via JETCAB's private WhatsApp list, 24 to 72 hours ahead.
- Pets fly in the cabin.

## Main pages
- [Renta de jets privados (home ES)](https://jetcab.mx/): Spanish home page.
- [Private jet charter Mexico (home EN)](https://jetcab.mx/en/): English home page, fleet and route pricing.
- [Precios de jet privado](https://jetcab.mx/precios-jet-privado/): price tables by route, aircraft and class.
- [Renta de aviones privados](https://jetcab.mx/renta-de-aviones-privados/): aircraft types and US route prices.
- [Preguntas frecuentes (ES)](https://jetcab.mx/preguntas-frecuentes/) and [Private jet FAQ (EN)](https://jetcab.mx/private-jet-faq/): short answers with real rates.
- [Flota](https://jetcab.mx/flota/): aircraft, seats and photos.
- [Vuelos privados desde Toluca](https://jetcab.mx/vuelos-privados-toluca/): base and private terminal.
- [Vuelos privados confidenciales](https://jetcab.mx/vuelos-privados-confidenciales/): Identity Shield protocol.
- [Cotizar](https://jetcab.mx/cotizar/): quote form, answer in 30 minutes.

## Routes from Mexico City (Toluca)
- [Cancún (ES)](https://jetcab.mx/vuelos-privados-a-cancun/) / [EN](https://jetcab.mx/private-jet-mexico-city-cancun/): 2 h 15 min, from 3,200 USD.
- [Los Cabos (ES)](https://jetcab.mx/vuelos-privados-a-los-cabos/) / [EN](https://jetcab.mx/private-jet-mexico-city-los-cabos/): 2 h 30 min, from 3,800 USD.
- [Puerto Vallarta (ES)](https://jetcab.mx/vuelos-privados-a-puerto-vallarta/) / [EN](https://jetcab.mx/private-jet-mexico-city-puerto-vallarta/): 1 h 45 min, from 3,000 USD.
- [Monterrey (ES)](https://jetcab.mx/vuelos-privados-a-monterrey/) / [EN](https://jetcab.mx/private-jet-mexico-city-monterrey/): 1 h 15 min, from 2,200 USD.
- [Guadalajara (ES)](https://jetcab.mx/vuelos-privados-a-guadalajara/) / [EN](https://jetcab.mx/private-jet-mexico-city-guadalajara/): 50 min, from 1,800 USD.
- [Miami (ES)](https://jetcab.mx/vuelo-privado-cdmx-miami/) / [EN](https://jetcab.mx/private-jet-mexico-city-miami/): 3 h 30 min, from 4,800 USD.
- [Houston (ES)](https://jetcab.mx/vuelo-privado-cdmx-houston/) / [EN](https://jetcab.mx/private-jet-mexico-city-houston/): 2 h 45 min, from 3,800 USD.
- [Los Angeles (ES)](https://jetcab.mx/vuelo-privado-cdmx-los-angeles/) / [EN](https://jetcab.mx/private-jet-mexico-city-los-angeles/): 3 h 45 min, from 5,200 USD.
- [New York (ES)](https://jetcab.mx/vuelo-privado-cdmx-nueva-york/) / [EN](https://jetcab.mx/private-jet-mexico-city-new-york/): 5 h 30 min, from 9,500 USD.
- [Acapulco (ES)](https://jetcab.mx/vuelos-privados-a-acapulco/) / [EN](https://jetcab.mx/private-jet-mexico-city-acapulco/): 45 min, from 1,500 USD per aircraft.
- [Querétaro (ES)](https://jetcab.mx/vuelos-privados-a-queretaro-jetcab/) / [EN](https://jetcab.mx/private-jet-mexico-city-queretaro/): 35 min, from 3,000 USD per aircraft.
- [Las Vegas (ES)](https://jetcab.mx/vuelos-privados-a-las-vegas/) / [EN](https://jetcab.mx/private-jet-mexico-city-las-vegas/): 3 h 50 min, from 15,000 USD per aircraft.
- [San Diego (ES)](https://jetcab.mx/vuelos-privados-a-san-diego/) / [EN](https://jetcab.mx/private-jet-mexico-city-san-diego/): 3 h 20 min, from 9,000 USD per aircraft.
- [Tijuana (ES)](https://jetcab.mx/vuelos-privados-a-tijuana/) / [EN](https://jetcab.mx/private-jet-mexico-city-tijuana/): 3 h 10 min, from 12,000 USD per aircraft.
- [McAllen (ES)](https://jetcab.mx/vuelos-privados-a-mcallen/) / [EN](https://jetcab.mx/private-jet-mexico-city-mcallen/): 1 h 30 min, from 8,000 USD per aircraft.
- [Havana, Cuba (ES)](https://jetcab.mx/vuelos-privados-a-cuba/) / [EN](https://jetcab.mx/private-jet-mexico-city-havana/): 2 h 30 min, from 1,800 USD per aircraft.
- [United States (all routes) (ES)](https://jetcab.mx/vuelos-privados-a-estados-unidos/) / [EN](https://jetcab.mx/private-jet-mexico-to-usa/): Houston, Miami, Los Angeles and New York prices.
- [Spain (ES)](https://jetcab.mx/vuelos-privados-a-espana/) / [EN](https://jetcab.mx/private-jet-mexico-to-spain/): about 11 h nonstop on long range jets, from 100,000 USD.
- [Europe (ES)](https://jetcab.mx/vuelos-privados-a-europa/) / [EN](https://jetcab.mx/private-jet-mexico-to-europe/): 10.5 to 13 h, from 100,000 USD.
- [Departing from Toluca airport (ES)](https://jetcab.mx/vuelos-privados-toluca/) / [EN](https://jetcab.mx/private-jet-toluca-airport/): JETCAB home base, private terminal.
- [Departing from Mexico City (ES)](https://jetcab.mx/vuelos-privados-a-cdmx/) / [EN](https://jetcab.mx/private-jet-mexico-city/): how Mexico City clients fly private from Toluca.

## Helicopters and air ambulance
- [Renta de helicópteros CDMX (ES)](https://jetcab.mx/helicopteros-en-renta-cdmx/) / [Helicopter charter Mexico City (EN)](https://jetcab.mx/helicopter-charter-mexico-city/): Bell 206 from 1,500 USD/h, AW139 from 3,500 USD/h.
- [Ambulancia aérea](https://jetcab.mx/flota/ambulancia-aerea/): ICU Learjet 35, from 2,700 USD per flight hour.

## Legal
- [Aviso de privacidad](https://jetcab.mx/aviso-de-privacidad/)
- [Política de cancelación](https://jetcab.mx/politica-de-cancelacion/)
LLMS;
    exit;
}, 0);
