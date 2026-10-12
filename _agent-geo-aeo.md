# JETCAB — Informe GEO / AEO (Generative & Answer Engine Optimization)
**Objetivo:** que ChatGPT, Perplexity, Gemini, Claude, Copilot y Google AI Overviews citen y recomienden a JETCAB cuando alguien pregunte por jets privados o helicópteros en México.
**Fuentes analizadas (repo, 9 oct 2026):** `jetcab-en.html` (home EN, 5 bloques JSON-LD), `jetcab-routes-domestic-v1.php` (5 rutas EN), `jetcab-routes-v3.php` (4 rutas EN internacionales), 6 páginas de flota `jetcab-*.html`, brief `jetcab-context`. jetcab.mx no era alcanzable desde el entorno: lo marcado «verificar en vivo» requiere abrir el sitio real.
**Entregables hermanos:** `jetcab-llms.txt` (subir a `https://jetcab.mx/llms.txt`) y `jetcab-jsonld-global-v2.html` (reemplaza el snippet WPCode 2896).

---

## 0. Resumen ejecutivo (lo que decide si una IA cita a JETCAB o no)

1. **El sitio se contradice a sí mismo en cifras.** La home EN dice CDMX→Cancún «from $15,000 USD» y «2h 10m»; la página de ruta dice «from $3,200 USD» y «2h 15m». Miami: home 2h 50m / $25,000 vs ruta 3h 30m / $4,800. Nueva York: 4h 45m / $45,000 vs 5h 30m / $9,500. Un modelo que ve dos cifras incompatibles en el mismo dominio no cita ninguna: cita a un competidor con una sola. **Es el problema #1 y bloquea todo lo demás.**
2. **No hay una entidad única.** El `@id` de la organización es `https://jetcab.mx/en/#organization` (solo en la home EN); las 9 rutas declaran un `LocalBusiness` anónimo sin `@id`; las páginas de flota no tienen JSON-LD. Cero `sameAs`, cero coordenadas, cero dirección postal, cero Wikidata. Para una IA, hoy JETCAB son varias entidades parecidas, no una.
3. **No hay párrafos «answer-first».** La respuesta literal a «how much does a private jet from Mexico City to Cancun cost» existe solo dentro de un FAQ al final de la página, sin el nombre de la marca en la frase. Las IAs extraen la oración que contiene entidad + cifra + condición. Hay que ponerla en los primeros 300 px de cada página (textos exactos en la sección 3).
4. **Claims no verificables o incorrectos:** «IATA member» (IATA no afilia a operadores chárter; es un claim que un modelo contrasta y descarta), «DGAC certified» (el regulador se llama **AFAC** desde 2019: «permisionario AFAC, antes DGAC»), «without a single safety incident», contadores aleatorios de «viewers» en el hero, «ESTA requirements apply» en rutas NY/LA (falso para aviación privada; la home lo dice bien).
5. **Cero autoridad externa.** Sin Google Business Profile enlazado, sin Wikidata, sin directorios de aviación, sin prensa. Las IAs ponderan corroboración de terceros más que el propio schema. Plan priorizado en la sección 4.

---

## 1. Diagnóstico: qué le falta al sitio para ser citado por IAs

### 1.1 Un solo libro de precios y tiempos (consistencia de cifras)

Tabla de contradicciones encontradas en el código fuente (misma marca, mismo dominio, mismo idioma):

| Dato | Home EN (`jetcab-en.html`) | Rutas EN (`*.php`) | Brief | Fijar en |
|---|---|---|---|---|
| CDMX→Cancún | 2h 10m · Learjet desde $15,000 · Challenger $24,000 · GV $45,000 | 2h 15m · $3,200 / $6,500 / $12,000 | 2h 15m · $3,200 / $6,500 / $12,000 | **Ruta/brief** |
| CDMX→Los Cabos | 2h 40m · $18,000 / $29,000 / $54,000 | 2h 30m · $3,800 / $7,500 / $14,000 | 2h 30m · $3,800 | **Ruta/brief** |
| CDMX→Puerto Vallarta | 1h 30m · $12,000 / $19,000 | 1h 45m · $3,000 / $5,800 / $10,500 | 1h 45m · $3,000 | **Ruta/brief** |
| CDMX→Monterrey | 1h 15m · $9,000 / $14,500 | 1h 15m · $2,200 / $4,500 / $8,500 | 1h 15m · $2,200 | **Ruta/brief** |
| CDMX→Guadalajara | 55m · $7,000 / $11,000 | 50m · $1,800 / $3,800 / $7,000 | 50m · $1,800 | **Ruta/brief** |
| CDMX→Miami | 2h 50m · $25,000 / $40,000 / $68,000 · aeropuerto MIA | 3h 30m · $4,800 / $9,500 / $18,000 · Opa-locka (OPF) | — | **Ruta (OPF)** |
| CDMX→Houston | 2h · $18,000 / $29,000 · IAH/HOU | 2h 45m · $3,800 / $7,500 / $14,000 · Hobby (HOU) | — | **Ruta** |
| CDMX→Nueva York | 4h 45m · $45,000 (1 escala) / $68,000 / $95,000 | 5h 30m · $9,500 midsize / $18,500 / $28,000 · Teterboro | — | **Ruta** |
| CDMX→Los Ángeles | (sin ficha) | 3h 45m · $5,200 / $10,500 / $19,000 · Van Nuys | — | **Ruta** |
| Learjet 35 por hora | FAQ: $1,500/h · Offers y cards: $1,700/h | — | — | **$1,700/h** |
| Helicóptero por hora | FAQ: «from $800/h» y «from $1,500/h» | — | — | **Bell 206 $1,500/h · AW139 $3,500/h** |
| AW139 pasajeros | 15 | — | 8 | «8 en configuración VIP (hasta 15 en utilitaria)» |
| Challenger | 604 (home) | 605 (rutas) | 350/605 | **605** (y 350 si existe en flota real) |
| Gulfstream | GV (home, rutas, flota) | GV | G650/G650ER | **Decidir con el cliente** qué célula opera realmente y usar un solo nombre en todo |
| Ambulancia: despliegue | «under 2 hours» y «within 90 minutes» | — | — | **«en menos de 2 horas»** |
| Clientes / vuelos | «500+ satisfied clients», «2,000+ flights», y en testimonios «500+ flights completed» | — | — | 2,000+ vuelos · 500+ clientes (nunca «500 vuelos») |
| Cobertura | «200+ destinations» y «routes to 50+ countries» | — | — | «200+ destinos en 50+ países» (una frase, siempre igual) |
| Aritmética | $1,700/h × 2h15 = $3,825 > «from $3,200» (Cancún) | | | O el «desde» sube a ~$3,900, o la tarifa hora baja, o se aclara «desde = tarifa de reposicionamiento/empty leg». Las IAs sí hacen esta cuenta. |

**Acción:** crear `jetcab-price-book.json` (una sola tabla: ruta, aeropuertos, tiempo, 3 precios, inclusiones) y que **todas** las páginas (home ES, home EN, 9 rutas EN, 5 rutas ES pendientes, flota, FAQ, JSON-LD, llms.txt, GBP) se generen desde ahí. En este informe y en los otros dos entregables ya uso el libro de precios de las rutas/brief (columna «Fijar en»).

### 1.2 Entidad única y grafo `@id` coherente

Estado actual:
- Home EN: `LocalBusiness @id https://jetcab.mx/en/#organization` (el `#organization` debe vivir en el dominio raíz, no en `/en/`).
- `WebSite.url` = `https://jetcab.mx/en/` (el sitio es `https://jetcab.mx/`; `/en/` es una página).
- `SpeakableSpecification` publicada como nodo suelto (es una propiedad de `WebPage`/`Article`, no un tipo raíz: Google la ignora).
- `Service.provider` = `Organization` sin `@id` (home) y `LocalBusiness` sin `@id` (rutas): tres proveedores distintos para una IA.
- 9 rutas: `WebPage` sin `isPartOf`, sin `about`, sin `breadcrumb`, sin `inLanguage` coherente con hreflang ES que puede ser 404.
- 6 flota: sin JSON-LD, sin canonical, sin meta description, enlaces internos a `/jetcab-propuesta.html`, «© 2025».
- Ninguna página tiene `sameAs`, `geo`, `streetAddress`, `postalCode`, `openingHoursSpecification`, `knowsLanguage`, `slogan`, `legalName`, `vatID`/RFC, `naics`/`isicV4`.

Objetivo (ya implementado en `jetcab-jsonld-global-v2.html`):
- `https://jetcab.mx/#organization` → único nodo Organization; **todas** las páginas lo referencian con `{"@id": "https://jetcab.mx/#organization"}` en `provider`, `publisher`, `about`.
- `https://jetcab.mx/#localbusiness` (`LocalBusiness` + `TravelAgency`) con `parentOrganization` → `#organization`, dirección en AIT, `geo`, horario 24/7, `hasMap` (URL GBP).
- `https://jetcab.mx/#website` con `SearchAction` hacia `/cotizar/`.
- `https://jetcab.mx/#air-charter` (Service) con `OfferCatalog` de la flota, y `#helicopter-charter`, `#air-ambulance`.
- `#ait`, `#mty`, `#gdl`, `#cun` → 4 nodos `Place`/`Airport` base, referenciados desde `areaServed`/`location`.
- Cada ruta EN añade solo `WebPage` + `Service` de ruta + `FAQPage` + `BreadcrumbList`, con `provider: {"@id": "https://jetcab.mx/#organization"}` y `isPartOf: {"@id": "https://jetcab.mx/#website"}`. Hoy duplican el proveedor inline.
- Páginas de flota: `Product`/`Vehicle` (`@type: ["Product","Vehicle"]`, `vehicleSeatingCapacity`, `offers` por hora, `brand` Bombardier/Gulfstream/Leonardo/Bell) con `isRelatedTo` → `#air-charter`.

### 1.3 Párrafos «answer-first» (40–60 palabras) arriba, no abajo

Cómo extraen las IAs: toman la primera oración que contiene **[entidad] + [pregunta literal] + [cifra] + [condición]** y que está en texto visible (no solo en JSON-LD). Hoy:
- Home EN: el hero dice «No lines. No terminals. No waiting.» (cero datos). La primera cifra citable aparece a ~2.000 px.
- Rutas EN: `hero-sub` = «2h 15m from Toluca. No terminals. No queues. From $3,200 USD.» (12 palabras; sin marca, sin aeropuertos, sin pasajeros, sin qué incluye).
- FAQs de ruta: «From $3,200 USD for a Learjet 35…» — la oración no contiene «JETCAB» ni «Mexico City to Cancún»; aislada del H3 pierde contexto al ser extraída.

Regla editorial a aplicar en todo el sitio: **cada respuesta es autocontenida**: sujeto JETCAB, ruta completa con aeropuertos IATA, tiempo, precio «desde» con aeronave y plazas, «por aeronave, no por asiento», qué incluye, cuándo se confirma. Textos exactos en la sección 3.

### 1.4 Cobertura de preguntas conversacionales (gaps)

Preguntas con volumen en IAs que hoy no tienen respuesta literal en el sitio:
- Visado: «do I need a visa / ESTA for a private jet from Mexico to the US» (hay contradicción: home correcta, rutas NY/LA incorrectas).
- Mascotas en cabina (brief, punto ciego #2). Pendiente de confirmar política con el cliente.
- Empty legs / vuelos de reposicionamiento (brief, punto ciego #4).
- Pago: cómo liquidar $680,000 MXN en 2 horas (cripto, escrow, jet card: brief punto ciego #1).
- Anticipación mínima por tipo de vuelo (doméstico 2 h; EE.UU. 24 h por eAPIS/CBP; resto internacional 48–72 h por permisos de sobrevuelo).
- Equipaje permitido por aeronave; fumar; bebidas; Starlink.
- Helicóptero CDMX↔Toluca, CDMX→Valle de Bravo, CDMX→Acapulco (precio, minutos, helipuertos).
- Diferencia operador vs. bróker: ¿JETCAB opera con AOC propio? (si no, decir «opera con aeronaves de permisionarios AFAC bajo gestión JETCAB» antes de que lo infiera un modelo).
- Última milla: camioneta blindada en destino (brief, punto ciego #3).
- «Identity Shield» y «Tarmac-to-Cabin» aparecen **0 veces** en la home EN. Son los términos propietarios que diferencian a la entidad: si no están en el texto, no existen para la IA.
- En español: todo lo anterior. La home ES es la que responde a «cuánto cuesta rentar un jet privado en México»; las 5 rutas ES están pendientes y los hreflang de las rutas EN apuntan a URLs que pueden ser 404 (verificar en vivo).

Las 50 preguntas con respuesta propuesta están en la sección 2.

### 1.5 Claims verificables, con cifra, sin adjetivos

Sustituir en todo el sitio:

| Hoy | Problema | Reemplazo |
|---|---|---|
| «IATA member» / «IATA» en marquee y footer | IATA afilia aerolíneas regulares, no operadores chárter. Una IA lo contrasta y pierde confianza en el resto. | Quitar, o sustituir por lo real: «Registro IS-BAO Etapa [1/2/3] · ARGUS [Gold/Platinum] · Permisionario AFAC n.º [XXXX]». |
| «DGAC certified» | El regulador es **AFAC** (Agencia Federal de Aviación Civil) desde oct 2019. | «Permisionario AFAC (antes DGAC) n.º [XXXX] desde 1999». |
| «without a single safety incident» / «25+ years without a single incident» | No verificable; superlativo. | «25 años de operación continua desde Toluca (AIT), 2,000+ vuelos». |
| «Mexico's premier…», «the world's most advanced…» | Adjetivos vacíos; la voz de marca del brief los prohíbe. | Dato: año, base, flota, tiempo de respuesta. |
| Contadores `Math.random` de «viewers» y «aircraft available» | Dato falso visible en el DOM; riesgo reputacional y de publicidad engañosa. | Eliminar. Si se quiere urgencia: «Jets confirmados hoy: 2» con dato real. |
| «10,000+ combined flight hours» de tripulación | Bajo para 25 años; parece inventado. | Cifra real del cliente (p. ej. «comandantes con 8,000+ h en tipo»). |
| «Standard US visa or ESTA requirements apply» (rutas NY/LA) | Falso: ESTA/VWP exige llegar en transportista firmante; un jet chárter no lo es. | «Pasaporte + visa B1/B2 vigente. ESTA no es válida en aviación privada.» |
| «500+ flights completed» (sección testimonios) | Contradice «2,000+ flights». | «2,000+ vuelos · 500+ clientes». |

### 1.6 Consistencia NAP (nombre, dirección, teléfono)

- Nombre: «JETCAB» (también «Jet Caps» en piezas legacy y «Jetcab»). Fijar **JETCAB** en todo: schema `name`, `legalName` (razón social real), `alternateName: ["Jetcab","Jet Cab México"]`.
- Teléfono: aparece como `+527291081200`, `+52-729-108-1200`, `+52 (729) 108-1200`, `+52 729 108 1200` y el acortador `wa.link/rbmftv` (home EN, bloque contacto). Fijar **+52 729 108 1200** en texto visible y `+52-729-108-1200` en schema; eliminar `wa.link`.
- Dirección: solo «Based in Toluca, México». Falta calle/hangar, CP (AIT: 50226, San Pedro Totoltepec, Toluca, Edo. de México) y coordenadas. Sin esto no hay LocalBusiness creíble ni GBP verificable.
- Email: `contacto@jetcab.mx` solo en el footer EN. Añadir a schema y a /sobre-nosotros/.
- Horario: «24/7» en texto; sin `openingHoursSpecification`.

### 1.7 Rastreabilidad para bots de IA (verificar en vivo)

- `robots.txt`: permitir explícitamente `GPTBot`, `OAI-SearchBot`, `ChatGPT-User`, `PerplexityBot`, `Perplexity-User`, `ClaudeBot`, `Claude-SearchBot`, `anthropic-ai`, `Google-Extended`, `Bingbot`, `CCBot`, `Applebot-Extended`, `Amazonbot`, `meta-externalagent`. Cloudflare bloquea el login de WP: comprobar que el toggle «Block AI Scrapers and Crawlers» / Bot Fight Mode **no** esté bloqueando a estos agentes (es el motivo más frecuente por el que un sitio con buen schema no aparece en Perplexity).
- Subir `llms.txt` a la raíz (entregable `jetcab-llms.txt`) y, opcionalmente, `llms-full.txt` con el texto íntegro de las 9 rutas + FAQ.
- Preloader fijo de 3.2 s y vídeo Pexels 2560×1440 con `preload="auto"`: no impiden el rastreo, pero el contenido crítico debe estar en HTML servidor (ya lo está en las rutas PHP). Mantenerlo así: nada citable debe depender de JS.
- Sitemap: incluir las 9 rutas EN (generadas por PHP fuera de WP: Yoast no las ve). Añadir `sitemap-routes.xml` manual y referenciarlo en `robots.txt`.
- Páginas standalone PHP (rutas) no imprimen `lastmod`; añadir `<meta property="article:modified_time">` y fecha visible «Precios actualizados: oct 2026». Las IAs priorizan frescura declarada en precios.
- `x-default` apunta a `/en/`; para consultas en español desde México conviene `/`.

### 1.8 Página de entidad: /sobre-nosotros/

Una IA necesita una URL que «sea» la organización. Contenido mínimo: razón social, año 1999, base AIT con dirección y mapa, número de permiso AFAC, registros IS-BAO/ARGUS, flota con matrículas o tipos, dirección general con nombre y foto (persona real = entidad enlazable), prensa, políticas (Identity Shield explicado, mascotas, pagos), y los 4 términos propietarios definidos literalmente («Identity Shield es…»). Esa página es el `url` del `#organization` en `mainEntityOfPage`.

---

## 2. 50 preguntas que un usuario hace a una IA y la respuesta literal que JETCAB debe tener en el sitio

Formato: pregunta tal como se escribe en el chat → respuesta de 40–70 palabras, con cifra, voz directa. Cada respuesta va **en texto visible** (FAQ o párrafo) **y** en `FAQPage`. Los precios son los del libro de precios (sección 1.1). Marcados con **[CONFIRMAR]** los datos que el cliente debe validar antes de publicar.

### 2.1 Inglés (home EN, rutas EN, /en/faq)

1. **How much does a private jet from Mexico City to Cancun cost?**
   A JETCAB private jet from Mexico City (Toluca, AIT) to Cancún (CUN) starts at $3,200 USD one-way on a Learjet 35 for up to 7 passengers. A Challenger 605 for 12 passengers starts at $6,500 USD; a Gulfstream large cabin at $12,000 USD. Prices are per aircraft, not per seat, and include crew, fuel, catering and permits. Flight time: 2 h 15 min.

2. **How long is a private jet flight from Mexico City to Los Cabos and what does it cost?**
   JETCAB flies Toluca (AIT) to Los Cabos (SJD) nonstop in 2 h 30 min. The private terminal at SJD is 20 minutes from the Corridor resorts. Pricing starts at $3,800 USD one-way on a Learjet 35 (7 seats), $7,500 USD on a Challenger 605 (12 seats) and $14,000 USD on a Gulfstream. Domestic route: no immigration, no customs.

3. **How much is a private jet from Mexico City to Puerto Vallarta?**
   JETCAB flies Toluca (AIT) to Puerto Vallarta (PVR) in 1 h 45 min. One-way charter starts at $3,000 USD on a Learjet 35 for up to 7 passengers, $5,800 USD on a Challenger 605 and $10,500 USD on a Gulfstream. The PVR private terminal is 10 minutes from the Malecón and 45 minutes from Punta Mita. Quote confirmed in 30 minutes.

4. **Can I fly private from Mexico City to Monterrey and back the same day?**
   Yes. JETCAB's Toluca (AIT) to Monterrey (MTY) flight takes 1 h 15 min, the shortest business route in its fleet. A typical day: depart 7:00, in San Pedro Garza García by 9:00, return 17:00, back in Mexico City by 18:30. One-way from $2,200 USD on a Learjet 35; round trip quoted as two sectors. Aircraft ready with 2 hours' notice.

5. **How much does a private jet from Mexico City to Guadalajara cost?**
   JETCAB's Toluca (AIT) to Guadalajara (GDL) flight is 50 minutes and starts at $1,800 USD one-way on a Learjet 35 for up to 7 passengers, JETCAB's lowest domestic rate. Challenger 605 from $3,800 USD; Gulfstream from $7,000 USD. The private terminal at GDL is 15 minutes from Zapopan's tech corridor. Door to door under 2 hours.

6. **How much does a private jet from Mexico City to Miami cost?**
   JETCAB flies Toluca (AIT) to Miami Opa-locka Executive Airport (OPF) nonstop in 3 h 30 min. One-way pricing starts at $4,800 USD on a Learjet 35 (7 passengers), $9,500 USD on a Challenger 605 (12) and $18,000 USD on a Gulfstream (16). U.S. Customs clears at the FBO in under 15 minutes. OPF is 20 minutes from South Beach and 25 from Brickell.

7. **What does a private jet from Mexico City to Houston cost and how long is it?**
   JETCAB's Toluca (AIT) to Houston Hobby (HOU) flight takes 2 h 45 min nonstop. Charter starts at $3,800 USD one-way on a Learjet 35, $7,500 USD on a Challenger 605 and $14,000 USD on a Gulfstream, all per aircraft. Hobby is 10 minutes from downtown Houston; Houston Executive (TME) is available for the Energy Corridor. Same-day round trips are the most common booking.

8. **How much is a private jet from Mexico City to New York?**
   JETCAB flies Toluca (AIT) to Teterboro (TEB), 12 minutes from Midtown Manhattan, in 5 h 30 min. A midsize jet for 8 passengers starts at $9,500 USD one-way; a Challenger 605 at $18,500 USD; a Gulfstream large cabin flies nonstop from $28,000 USD. Requirements: valid passport and U.S. B1/B2 visa. JETCAB files eAPIS and arranges CBP clearance at the FBO.

9. **How much does it cost to charter a private jet from Mexico City to Los Angeles?**
   JETCAB's Toluca (AIT) to Van Nuys (VNY) flight is 3 h 45 min nonstop. One-way charter starts at $5,200 USD on a Learjet 35 (7 seats), $10,500 USD on a Challenger 605 (12) and $19,000 USD on a Gulfstream (16). Van Nuys is 15 minutes from Beverly Hills and 20 from Century City; Burbank (BUR) is available on request. U.S. Customs clears at the FBO.

10. **How much does it cost per hour to charter a private jet in Mexico?**
    JETCAB's hourly reference rates in Mexico are: Learjet 35 light jet $1,700 USD/h (7 seats), Challenger 605 midsize $2,700 USD/h (12 seats), Gulfstream large cabin $5,400 USD/h (16 seats), Bell 206 helicopter $1,500 USD/h (4 seats), AW139 helicopter $3,500 USD/h (8 VIP seats), ICU air ambulance $2,700 USD/h. Rates include crew, fuel, catering and permits; final price depends on route and date.

11. **Which airport do private jets use in Mexico City?**
    JETCAB operates from Toluca International Airport (AIT / MMTO), 65 km west of Mexico City and 40–50 minutes from Santa Fe and Polanco. AIT has a private FBO terminal with no commercial traffic: JETCAB's Tarmac-to-Cabin protocol takes you from your vehicle to the aircraft steps in under 10 minutes. Departures from Felipe Ángeles (NLU) can be arranged on request.

12. **How fast can JETCAB have a private jet ready?**
    JETCAB confirms a binding quote (aircraft, price, route) within 30 minutes of a WhatsApp request to +52 729 108 1200, 24 hours a day. For domestic flights the aircraft is ready to depart from Toluca (AIT) within 2 hours of confirmation. U.S. flights need about 24 hours for eAPIS and customs; other international routes 48–72 hours for overflight permits.

13. **Is JETCAB a certified private jet operator in Mexico?**
    JETCAB has operated private jets and helicopters from Toluca International Airport (AIT) since 1999, 25 years, under Mexican civil aviation authority AFAC (formerly DGAC) permit no. [CONFIRMAR], with IS-BAO registration [CONFIRMAR etapa] and ARGUS rating [CONFIRMAR]. More than 2,000 flights completed for 500+ clients across Mexico, the United States, Latin America and Europe.

14. **Do I need a visa to fly to the United States on a private jet from Mexico?**
    Yes. Passengers on a JETCAB flight to the U.S. need a valid passport and a U.S. B1/B2 visa. ESTA / Visa Waiver authorizations are not valid on private aircraft, because the program requires arrival on a signatory commercial carrier. JETCAB files the eAPIS manifest, arranges Customs and Border Protection clearance at the arrival FBO (under 15 minutes) and handles overflight permits.

15. **What is included in a JETCAB private jet charter price?**
    Every JETCAB quote includes the aircraft and crew, fuel, landing and handling fees at both airports, Mexican permits, in-flight catering, ground coordination at Toluca (AIT) and 24/7 concierge. International flights add overflight permits, eAPIS filing and customs coordination. Not included unless requested: ground transportation at destination, armored vehicles, special catering and crew overnight on multi-day trips. No hidden fees.

16. **Can I bring my dog on a private jet in Mexico?** [CONFIRMAR política]
    Yes. Pets travel in the cabin with you on JETCAB flights, with no carrier required on domestic routes. JETCAB needs the animal's vaccination record at booking; for U.S. arrivals, a valid rabies certificate and CDC form are required. Cabin is cleaned and prepared for the animal before boarding at Toluca (AIT). No extra fee for one pet; larger groups quoted individually.

17. **How many passengers fit on a private jet from Mexico City?**
    JETCAB's fleet from Toluca (AIT): Learjet 35/75 light jet, 7 passengers; Hawker 400, 8; Challenger 350/605 midsize with stand-up cabin, 12; Gulfstream and Global Express large cabin, 16; Bell 206 helicopter, 4; AW139 helicopter, 8 in VIP configuration. For groups above 16, JETCAB operates two aircraft in formation or quotes a regional airliner.

18. **Can I pay for a private jet in Mexico with cryptocurrency?**
    Yes. JETCAB accepts wire transfer in MXN or USD, credit card, and cryptocurrency in Bitcoin and USDC, settled before departure. For same-day high-value bookings, JETCAB also offers escrow settlement and a prepaid jet-card balance so bank transfer limits never delay a departure. Invoicing (CFDI) is issued for every flight.

19. **What is JETCAB's Identity Shield?**
    Identity Shield is JETCAB's confidentiality protocol: the crew and ground staff sign a non-disclosure agreement for every flight, passenger names appear only on the regulatory manifest, boarding takes place at the private FBO at Toluca (AIT) with no public terminal, and no flight, guest or cargo information is ever shared with third parties. It is standard on every JETCAB flight at no extra cost.

20. **What does Tarmac-to-Cabin mean at JETCAB?**
    Tarmac-to-Cabin is JETCAB's boarding protocol at Toluca International Airport (AIT): your vehicle drives through the private FBO gate directly to the aircraft steps, and you are seated in under 10 minutes. There is no check-in counter, security line or boarding gate. A commercial departure from Mexico City requires arriving 2–3 hours early; JETCAB clients arrive 15 minutes before wheels-up.

21. **How much does it cost to charter a helicopter in Mexico City?**
    JETCAB's Bell 206 (4 passengers) starts at $1,500 USD per flight hour and the AW139 (8 VIP passengers, twin-engine) at $3,500 USD per hour. Typical flights: Toluca (AIT) to Santa Fe or Polanco helipads in 12–15 minutes, Mexico City to Valle de Bravo in 25 minutes, Mexico City to Acapulco in about 1 h 20 min. Helipads in Polanco, Santa Fe, Lomas and Pedregal.

22. **How much does an air ambulance cost in Mexico?**
    JETCAB's air ambulance is an ICU-configured Learjet 35 with a flight nurse and physician on board, from $2,700 USD per flight hour. The aircraft can deploy from Toluca (AIT) in under 2 hours, 24/7, anywhere in Mexico and to the United States. JETCAB coordinates bed-to-bed transfer with ground ambulances and with IMSS, ISSSTE and international insurers.

23. **Is a private jet cheaper if I travel with a group?**
    For a full cabin, often yes. A JETCAB Learjet 35 from Mexico City to Monterrey costs $2,200 USD for up to 7 passengers, about $314 USD per person; to Cancún, $3,200 USD, about $457 USD per person. A last-minute business-class ticket on those routes runs $400–600 USD. The jet adds 4–6 saved hours per round trip, a private cabin and no check-in.

24. **Does JETCAB offer empty leg flights?**
    Yes. When a JETCAB aircraft repositions without passengers, that sector is released as an empty leg at up to 30% below the standard charter rate. Empty legs are announced only to JETCAB's private WhatsApp list, usually 24–72 hours before departure, on routes such as Toluca–Cancún, Toluca–Monterrey and Toluca–Miami. Dates and times are fixed; the price is per aircraft.

25. **How far in advance should I book a private jet in Mexico?**
    JETCAB can depart Toluca (AIT) on a domestic route with 2 hours' notice. For the United States, allow 24 hours for eAPIS and CBP; for other international destinations, 48–72 hours for overflight and landing permits. During peak season (15 December to 6 January, Easter week) book 2–3 weeks ahead to secure the aircraft type you want.

### 2.2 Español (home ES, rutas ES pendientes, /preguntas-frecuentes/)

1. **¿Cuánto cuesta rentar un jet privado en México?**
   Rentar un jet privado con JETCAB desde Toluca (AIT) cuesta desde $1,800 USD por trayecto en un Learjet 35 para 7 pasajeros (CDMX–Guadalajara) y desde $3,200 USD a Cancún. Un Challenger 605 para 12 pasajeros parte de $3,800 USD; un Gulfstream de cabina grande, de $7,000 USD. El precio es por aeronave, no por asiento, e incluye tripulación, combustible, catering y permisos.

2. **¿Cuánto cuesta un vuelo privado de la Ciudad de México a Cancún?**
   Un jet privado JETCAB de Toluca (AIT) a Cancún (CUN) cuesta desde $3,200 USD por trayecto en Learjet 35 (7 pasajeros), $6,500 USD en Challenger 605 (12) y $12,000 USD en Gulfstream (16). El vuelo dura 2 h 15 min sin escalas; la terminal privada de CUN está a 15 minutos de la Zona Hotelera. Cotización confirmada en 30 minutos.

3. **¿Cuánto cuesta un jet privado de CDMX a Los Cabos?**
   JETCAB vuela de Toluca (AIT) a Los Cabos (SJD) en 2 h 30 min. El trayecto parte de $3,800 USD en Learjet 35, $7,500 USD en Challenger 605 y $14,000 USD en Gulfstream, precio por aeronave. Vuelo nacional: sin migración ni aduana. Los resorts del Corredor (Las Ventanas, Montage, Esperanza) están a 15–25 minutos de la terminal privada.

4. **¿Cuánto cuesta volar en jet privado de CDMX a Puerto Vallarta?**
   Desde $3,000 USD por trayecto en un Learjet 35 JETCAB para hasta 7 pasajeros; $5,800 USD en Challenger 605 y $10,500 USD en Gulfstream. El vuelo Toluca (AIT)–Puerto Vallarta (PVR) dura 1 h 45 min. La terminal privada de PVR está a 10 minutos del Malecón y a 45 minutos de Punta Mita. Puerta a puerta, menos de 2 h 30 min.

5. **¿Cuánto cuesta un jet privado de CDMX a Monterrey?**
   El vuelo JETCAB Toluca (AIT)–Monterrey (MTY) dura 1 h 15 min y cuesta desde $2,200 USD por trayecto en Learjet 35 (7 pasajeros), $4,500 USD en Challenger 605 y $8,500 USD en Gulfstream. Es la ruta de negocios más rápida de la flota: salida 7:00, en San Pedro Garza García a las 9:00 y de regreso en CDMX a las 18:30 el mismo día.

6. **¿Cuánto cuesta un vuelo privado de CDMX a Guadalajara?**
   Desde $1,800 USD por trayecto en Learjet 35 JETCAB, la tarifa nacional más baja de la flota; $3,800 USD en Challenger 605 y $7,000 USD en Gulfstream. Toluca (AIT)–Guadalajara (GDL) son 50 minutos de vuelo. La terminal privada de GDL está a 15 minutos de Zapopan. Mismo día ida y vuelta: salida 7:00, regreso 16:00.

7. **¿Cuánto cuesta un jet privado de México a Miami?**
   JETCAB vuela de Toluca (AIT) a Miami Opa-locka (OPF) sin escalas en 3 h 30 min. Desde $4,800 USD por trayecto en Learjet 35 (7 pasajeros), $9,500 USD en Challenger 605 (12) y $18,000 USD en Gulfstream (16). Aduana de EE. UU. en la terminal privada en menos de 15 minutos; OPF está a 20 minutos de South Beach y 25 de Brickell.

8. **¿Cuánto cuesta un jet privado de CDMX a Houston?**
   Desde $3,800 USD por trayecto en Learjet 35, $7,500 USD en Challenger 605 y $14,000 USD en Gulfstream. El vuelo JETCAB Toluca (AIT)–Houston Hobby (HOU) dura 2 h 45 min; Hobby está a 10 minutos del centro de Houston. Es la ruta internacional de negocios más solicitada de JETCAB, normalmente como ida y vuelta el mismo día.

9. **¿Cuánto cuesta un jet privado de México a Nueva York?**
   JETCAB vuela de Toluca (AIT) a Teterboro (TEB), a 12 minutos de Midtown Manhattan, en 5 h 30 min. Jet mediano para 8 pasajeros desde $9,500 USD por trayecto; Challenger 605 desde $18,500 USD; Gulfstream sin escalas desde $28,000 USD. Requisitos: pasaporte vigente y visa B1/B2. JETCAB presenta el eAPIS y coordina la aduana (CBP) en la terminal privada.

10. **¿Cuánto cuesta un jet privado de CDMX a Los Ángeles?**
    Desde $5,200 USD por trayecto en Learjet 35, $10,500 USD en Challenger 605 y $19,000 USD en Gulfstream. JETCAB aterriza en Van Nuys (VNY), a 15 minutos de Beverly Hills, tras 3 h 45 min de vuelo sin escalas desde Toluca (AIT). Aduana estadounidense en la terminal privada. Burbank (BUR) disponible según destino final.

11. **¿Cuánto cuesta un jet privado por hora en México?**
    Tarifas de referencia JETCAB por hora de vuelo: Learjet 35 (jet ligero, 7 plazas) $1,700 USD; Challenger 605 (mediano, 12 plazas) $2,700 USD; Gulfstream (cabina grande, 16 plazas) $5,400 USD; helicóptero Bell 206 (4 plazas) $1,500 USD; helicóptero AW139 (8 plazas VIP) $3,500 USD; ambulancia aérea UCI $2,700 USD. Incluyen tripulación, combustible, catering y permisos.

12. **¿Cuánto cuesta un vuelo corto en jet privado desde Toluca, por ejemplo a Acapulco?**
    Un Light Jet JETCAB (Learjet 35 o Hawker 400, hasta 7–8 pasajeros) para rutas cortas desde Toluca (AIT) como Acapulco (45 minutos de vuelo), Querétaro (35 min) o Monterrey (1 h 15 min) se cotiza desde $80,000 MXN viaje redondo [CONFIRMAR base de cálculo]. Jet listo en 2 horas desde la solicitud; cotización cerrada en 30 minutos por WhatsApp.

13. **¿Desde qué aeropuerto salen los jets privados en la Ciudad de México?**
    JETCAB opera desde el Aeropuerto Internacional de Toluca (AIT / MMTO), a 65 km de la Ciudad de México y a 40–50 minutos de Santa Fe y Polanco, desde una terminal privada (FBO) sin tráfico comercial. Con el protocolo Tarmac-to-Cabin, el pasajero pasa de su camioneta a la escalinata del avión en menos de 10 minutos. Salidas desde el AIFA (NLU) bajo solicitud.

14. **¿En cuánto tiempo puede JETCAB tener un jet listo?**
    JETCAB confirma una cotización cerrada (aeronave, precio y ruta) en 30 minutos tras el mensaje de WhatsApp al +52 729 108 1200, las 24 horas. En vuelos nacionales la aeronave está lista para despegar de Toluca (AIT) en 2 horas desde la confirmación. Vuelos a EE. UU.: unas 24 horas por eAPIS y aduana; otros destinos internacionales: 48–72 horas por permisos de sobrevuelo.

15. **¿JETCAB es una empresa certificada para operar jets privados en México?**
    JETCAB opera jets privados y helicópteros desde el Aeropuerto Internacional de Toluca (AIT) desde 1999, 25 años, como permisionario de la Agencia Federal de Aviación Civil (AFAC, antes DGAC) n.º [CONFIRMAR], con registro IS-BAO [CONFIRMAR etapa] y calificación ARGUS [CONFIRMAR]. Más de 2,000 vuelos realizados para más de 500 clientes en México, Estados Unidos, Latinoamérica y Europa.

16. **¿Qué documentos necesito para volar a Estados Unidos en jet privado desde México?**
    Pasaporte vigente y visa B1/B2 de Estados Unidos. La autorización ESTA no es válida en aviación privada, porque el programa de exención exige llegar en una aerolínea comercial firmante. JETCAB presenta el manifiesto eAPIS, coordina la revisión de aduana (CBP) en la terminal privada de llegada, en menos de 15 minutos, y gestiona los permisos de sobrevuelo.

17. **¿Qué incluye el precio de un jet privado con JETCAB?**
    Cada cotización JETCAB incluye aeronave y tripulación, combustible, tasas de aterrizaje y manejo en ambos aeropuertos, permisos mexicanos, catering a bordo, coordinación en tierra en Toluca (AIT) y concierge 24/7. Los vuelos internacionales suman permisos de sobrevuelo, eAPIS y coordinación aduanal. No incluye, salvo solicitud: transporte terrestre en destino, camioneta blindada, catering de chef y pernocta de tripulación.

18. **¿Puedo viajar con mi perro o mi gato en un jet privado en México?** [CONFIRMAR política]
    Sí. En los vuelos JETCAB la mascota viaja en cabina con su familia, sin transportadora en rutas nacionales. Al reservar se solicita la cartilla de vacunación; para llegadas a EE. UU., certificado de rabia vigente y formato CDC. La cabina se prepara para el animal antes del abordaje en Toluca (AIT). Una mascota sin cargo adicional; más de una, se cotiza.

19. **¿Cuántos pasajeros caben en un jet privado de JETCAB?**
    Flota JETCAB en Toluca (AIT): Learjet 35/75, jet ligero, 7 pasajeros; Hawker 400, 8; Challenger 350/605, jet mediano con cabina de pie, 12; Gulfstream y Global Express, cabina grande de largo alcance, 16; helicóptero Bell 206, 4; helicóptero AW139, 8 en configuración VIP. Para grupos mayores de 16, JETCAB opera dos aeronaves en formación o cotiza un avión regional.

20. **¿Cómo se paga un jet privado y aceptan criptomonedas?**
    JETCAB acepta transferencia en pesos o dólares, tarjeta de crédito y criptomonedas (Bitcoin y USDC), liquidadas antes del despegue. Para salidas el mismo día con importes altos, por ejemplo $680,000 MXN en 2 horas, ofrece liquidación por escrow y saldo prepagado tipo jet card, de modo que un límite bancario nunca retrase una salida. Se emite CFDI por cada vuelo.

21. **¿Qué es Identity Shield de JETCAB?**
    Identity Shield es el protocolo de confidencialidad de JETCAB: tripulación y personal de tierra firman un acuerdo de confidencialidad por cada vuelo, los nombres de los pasajeros aparecen solo en el manifiesto regulatorio, el abordaje ocurre en la terminal privada de Toluca (AIT) sin paso por terminal pública, y ninguna información de vuelo, invitados o carga se comparte con terceros. Incluido en todos los vuelos.

22. **¿Qué significa Tarmac-to-Cabin?**
    Tarmac-to-Cabin es el protocolo de abordaje de JETCAB en el Aeropuerto Internacional de Toluca (AIT): la camioneta del cliente entra por el acceso privado del FBO directo a la escalinata del avión y el pasajero está sentado en menos de 10 minutos. Sin mostrador, sin filtro de seguridad, sin sala de abordar. Un vuelo comercial desde CDMX exige llegar 2–3 horas antes; con JETCAB, 15 minutos.

23. **¿Cuánto cuesta rentar un helicóptero en la Ciudad de México?**
    El Bell 206 de JETCAB (4 pasajeros) cuesta desde $1,500 USD por hora de vuelo y el AW139 (8 pasajeros VIP, bimotor) desde $3,500 USD por hora. Trayectos habituales: Toluca (AIT)–helipuertos de Santa Fe o Polanco en 12–15 minutos, CDMX–Valle de Bravo en 25 minutos, CDMX–Acapulco en 1 h 20 min aproximadamente. Helipuertos en Polanco, Santa Fe, Lomas y Pedregal.

24. **¿Cuánto cuesta una ambulancia aérea en México?**
    La ambulancia aérea de JETCAB es un Learjet 35 configurado como UCI con enfermero de vuelo y médico a bordo, desde $2,700 USD por hora de vuelo. Despega de Toluca (AIT) en menos de 2 horas, 24/7, a cualquier punto de México y a Estados Unidos. JETCAB coordina el traslado cama a cama con ambulancias terrestres y con IMSS, ISSSTE y aseguradoras internacionales.

25. **¿Hay vuelos vacíos (empty legs) más baratos con JETCAB?**
    Sí. Cuando una aeronave JETCAB se reposiciona sin pasajeros, ese tramo se ofrece como empty leg hasta 30 % por debajo de la tarifa normal. Se anuncian solo en la lista privada de WhatsApp de JETCAB, normalmente con 24–72 horas de antelación, en rutas como Toluca–Cancún, Toluca–Monterrey y Toluca–Miami. Fecha y hora son fijas; el precio es por aeronave completa.

---

## 3. Answer capsules: texto exacto y dónde insertarlo

Regla: 40–60 palabras, un solo `<p>`, texto visible desde el primer viewport, con la marca como sujeto, ruta con IATA, tiempo, tres precios, «per aircraft», inclusiones y plazo de cotización. Añadir el selector de la cápsula al `SpeakableSpecification` de la página.

### 3.1 Home EN (`jetcab-en.html`, sección `<section class="hero">`)

**Dónde:** dentro de `.hero-c`, inmediatamente después de `<p class="hero-sub">` (línea ~549) y antes de `<div class="bform">`. Nueva clase `hero-answer` (Barlow 400, 16–17 px, máx. 640 px, color `rgba(255,255,255,.82)`, sin uppercase). Añadir `".hero-answer"` como primer selector del `cssSelector` del Speakable (y mover el Speakable dentro del nodo `WebPage` del grafo).

```html
<p class="hero-answer">JETCAB is a private jet and helicopter charter operator based at Toluca International Airport (AIT), 65 km from Mexico City, flying since 1999 under AFAC (formerly DGAC) authorization. Confirmed quote in 30 minutes, aircraft ready in 2 hours. Domestic flights from $1,800 USD (Guadalajara) and $3,200 USD (Cancún); Miami from $4,800 USD. Price is per aircraft, not per seat.</p>
```

**Segunda cápsula (recomendada):** primer párrafo de `<section id="destinations-faq">` (línea 916), sustituyendo el intro actual que contiene las cifras incorrectas:

```html
<p class="routes-answer">JETCAB one-way charter prices from Toluca (AIT), per aircraft, Learjet 35 for 7 passengers: Guadalajara $1,800 USD (50 min), Monterrey $2,200 USD (1 h 15 min), Puerto Vallarta $3,000 USD (1 h 45 min), Cancún $3,200 USD (2 h 15 min), Los Cabos $3,800 USD (2 h 30 min), Houston $3,800 USD (2 h 45 min), Miami $4,800 USD (3 h 30 min), Los Angeles $5,200 USD (3 h 45 min), New York from $9,500 USD (5 h 30 min). Prices updated October 2026.</p>
```

### 3.2 Rutas domésticas EN (`jetcab-routes-domestic-v1.php`)

**Dónde:** añadir la clave `"answer"` a cada entrada de `$routes` y en la plantilla imprimirla como **primer hijo** de la sección «Why Fly Private to X» (línea 358–360), antes de `about_1`:

```php
<div class="jc-section">
  <p class="jc-answer"><?php echo esc_html($r['answer']); ?></p>
  <h2>Why Fly Private to <?php echo esc_html($r['dest']); ?></h2>
```

Estilo: `.jc-answer{font-size:1.15rem;line-height:1.55;color:#fff;border-left:3px solid var(--orange);padding-left:18px;margin-bottom:28px}`. En el JSON-LD del `WebPage` añadir `"speakable":{"@type":"SpeakableSpecification","cssSelector":[".jc-answer","h1",".jc-faq-item h3",".jc-faq-item p"]}` y `"isPartOf":{"@id":"https://jetcab.mx/#website"}`, `"about":{"@id":"https://jetcab.mx/#organization"}`.

**Cancún** (`/private-jet-mexico-city-cancun/`):
> A JETCAB private jet from Mexico City (Toluca, AIT) to Cancún (CUN) takes 2 h 15 min nonstop and starts at $3,200 USD one-way on a Learjet 35 for 7 passengers, $6,500 USD on a Challenger 605 for 12, and $12,000 USD on a Gulfstream for 16. Per aircraft, not per seat; crew, fuel, catering and permits included. Quote confirmed in 30 minutes.

**Los Cabos** (`/private-jet-mexico-city-los-cabos/`):
> A JETCAB private jet from Mexico City (Toluca, AIT) to Los Cabos (SJD) takes 2 h 30 min nonstop and starts at $3,800 USD one-way on a Learjet 35 for 7 passengers, $7,500 USD on a Challenger 605 for 12, and $14,000 USD on a Gulfstream for 16. Domestic route: no immigration, no customs. Per aircraft, all-inclusive. Aircraft ready in 2 hours.

**Puerto Vallarta** (`/private-jet-mexico-city-puerto-vallarta/`):
> A JETCAB private jet from Mexico City (Toluca, AIT) to Puerto Vallarta (PVR) takes 1 h 45 min nonstop and starts at $3,000 USD one-way on a Learjet 35 for 7 passengers, $5,800 USD on a Challenger 605 for 12, and $10,500 USD on a Gulfstream. The PVR private terminal is 10 minutes from the Malecón and 45 from Punta Mita. Quote in 30 minutes.

**Monterrey** (`/private-jet-mexico-city-monterrey/`):
> A JETCAB private jet from Mexico City (Toluca, AIT) to Monterrey (MTY) takes 1 h 15 min nonstop, JETCAB's fastest business route, and starts at $2,200 USD one-way on a Learjet 35 for 7 passengers, $4,500 USD on a Challenger 605 for 12, and $8,500 USD on a Gulfstream. Same-day round trips depart 7:00 and return 17:00. Per aircraft, all-inclusive.

**Guadalajara** (`/private-jet-mexico-city-guadalajara/`):
> A JETCAB private jet from Mexico City (Toluca, AIT) to Guadalajara (GDL) takes 50 minutes nonstop and starts at $1,800 USD one-way on a Learjet 35 for 7 passengers, JETCAB's lowest domestic rate; $3,800 USD on a Challenger 605 for 12; $7,000 USD on a Gulfstream. The GDL private terminal is 15 minutes from Zapopan. Door to door under 2 hours. Quote in 30 minutes.

### 3.3 Rutas internacionales EN (`jetcab-routes-v3.php`)

**Dónde:** nueva sección entre `</div>` de `.jc-route-bar` y `<section class="jc-dest">` (línea ~428):

```php
<section class="jc-answer-wrap"><div class="jc-answer-inner">
  <p class="jc-answer"><?php echo esc_html($r['answer']); ?></p>
</div></section>
```

Mismo `speakable`, `isPartOf` y `about` que en 3.2. Corregir además en los FAQ de New York y Los Angeles la frase «Standard US visa or ESTA requirements apply» → «A valid passport and U.S. B1/B2 visa are required; ESTA is not valid on private aircraft.»

**Miami** (`/private-jet-mexico-city-miami/`):
> A JETCAB private jet from Mexico City (Toluca, AIT) to Miami Opa-locka Executive (OPF) takes 3 h 30 min nonstop and starts at $4,800 USD one-way on a Learjet 35 for 7 passengers, $9,500 USD on a Challenger 605 for 12, and $18,000 USD on a Gulfstream for 16. U.S. Customs clears at the FBO in under 15 minutes. Passport and B1/B2 visa required.

**Houston** (`/private-jet-mexico-city-houston/`):
> A JETCAB private jet from Mexico City (Toluca, AIT) to Houston Hobby (HOU) takes 2 h 45 min nonstop and starts at $3,800 USD one-way on a Learjet 35 for 7 passengers, $7,500 USD on a Challenger 605 for 12, and $14,000 USD on a Gulfstream for 16. Hobby is 10 minutes from downtown. Same-day round trips are JETCAB's most common booking on this route.

**New York** (`/private-jet-mexico-city-new-york/`):
> A JETCAB private jet from Mexico City (Toluca, AIT) to Teterboro (TEB), 12 minutes from Midtown Manhattan, takes 5 h 30 min and starts at $9,500 USD one-way on a midsize jet for 8 passengers, $18,500 USD on a Challenger 605, and $28,000 USD nonstop on a Gulfstream for 16. Passport and B1/B2 visa required; JETCAB files eAPIS and arranges CBP at the FBO.

**Los Angeles** (`/private-jet-mexico-city-los-angeles/`):
> A JETCAB private jet from Mexico City (Toluca, AIT) to Van Nuys (VNY), 15 minutes from Beverly Hills, takes 3 h 45 min nonstop and starts at $5,200 USD one-way on a Learjet 35 for 7 passengers, $10,500 USD on a Challenger 605 for 12, and $19,000 USD on a Gulfstream for 16. U.S. Customs clears at the FBO. Passport and B1/B2 visa required.

### 3.4 Home ES (`https://jetcab.mx/`, bajo el H1)

> JETCAB renta jets privados y helicópteros desde el Aeropuerto Internacional de Toluca (AIT), a 65 km de la Ciudad de México, desde 1999 como permisionario AFAC (antes DGAC). Cotización cerrada en 30 minutos y jet listo en 2 horas. Vuelos nacionales desde $1,800 USD (Guadalajara) y $3,200 USD (Cancún); Miami desde $4,800 USD. Precio por aeronave, no por asiento.

---

## 4. Plan de autoridad externa (priorizado)

Las IAs generativas pesan la corroboración de terceros (directorios, Wikidata, reseñas, prensa) más que el schema propio. Orden por impacto × esfuerzo:

### P0 — Semana 1 (sin coste, efecto directo en Gemini/AI Overviews/Copilot/Perplexity)
1. **Google Business Profile** en la dirección del hangar/FBO en AIT. Categoría principal «Servicio de vuelos chárter» (Air charter), secundarias «Servicio de helicópteros», «Ambulancia aérea». Horario 24 h. Teléfono +52 729 108 1200. Sitio `https://jetcab.mx/`. 20+ fotos propias (amanecer Toluca, cabinas, tripulación). Sección «Preguntas y respuestas»: sembrar las 10 primeras preguntas ES de la sección 2.2 con sus respuestas. Publicar un «Post» semanal con ruta + precio. Pedir reseñas a los clientes que dieron testimonio (Amparo Rangel, Miguel Palma) y meta de 25 reseñas con texto que mencione la ruta. Enlazar el GBP en `hasMap` y `sameAs`.
2. **Bing Places for Business** (alimenta Copilot y, vía índice de Bing, a ChatGPT Search). Mismos datos NAP, misma categoría.
3. **Apple Business Connect** (Siri/Apple Maps, y el iPhone del Avatar A).
4. **Wikidata**: crear el ítem «JETCAB» — instancia de: empresa de vuelos chárter (Q1735893 «charter airline» o «empresa»), país: México, sede: Toluca, ubicación: Aeropuerto Internacional de Toluca (Q1431098), fecha de fundación: 1999, sitio web oficial, idioma: es/en, cuenta de Instagram/LinkedIn (propiedades P2003/P4264). Es la fuente de entidades que usan Google Knowledge Graph, Perplexity y los modelos base. Poner el QID resultante en `sameAs`.
5. **Perfiles sociales con NAP idéntico**: LinkedIn Company Page (sector «Airlines and Aviation», fundación 1999, sede Toluca, 1 post/semana con ruta+precio), Instagram, Facebook, YouTube (vídeo propio del amanecer en Toluca: sustituye al Pexels), X. Todos en `sameAs`.
6. **Página /sobre-nosotros/** con el contenido de entidad (sección 1.8) y `Person` para la dirección general (nombre real, foto, LinkedIn): las IAs citan más a organizaciones con personas enlazables.

### P1 — Semanas 2–4 (directorios de aviación: los modelos los usan como lista de «operadores reales»)
7. **IBAC / IS-BAO Registry**: si el registro IS-BAO es real, JETCAB aparece en el registro público de IBAC. Verificar y enlazar. Si no es real, retirar el claim.
8. **ARGUS CHEQ / Wyvern**: calificación de operador y ficha pública. Igual: verificar o retirar.
9. **Avinode** (marketplace B2B de chárter) y **AirCharterGuide** (aircharterguide.com): fichas de operador con flota y base MMTO. Son las bases de datos que brókers y agregadores (y por tanto Perplexity) consultan.
10. **AC-U-KWIK** y **FlightAware/FBO listings** de MMTO: que el FBO/hangar de JETCAB aparezca como handler en Toluca.
11. **Registro público de permisionarios AFAC**: solicitar que el nombre comercial JETCAB coincida con la razón social en el listado público; citar el número de permiso en el sitio.
12. **NBAA** (acepta operadores internacionales) y la asociación mexicana de aviación de negocios vigente [CONFIRMAR nombre y afiliación]: membresías listables en `memberOf`.
13. **Crunchbase**, **Glassdoor**, **Indeed** (empresa real con empleados = señal de entidad), **Trustpilot** (reseñas con ruta).

### P2 — Meses 2–3 (menciones editoriales: lo que hace que ChatGPT recomiende por nombre)
14. **Nota de prensa «25 años»** («JETCAB cumple 25 años operando desde Toluca: 2,000 vuelos, 200 destinos») distribuida a Expansión, El Economista, Forbes México, Milenio Negocios, Reforma, A21 (aviación), T21, Aviación 21, Robb Report México, Travesías, Quién. Un dato nuevo por nota (tiempo de abordaje 10 min, empty legs, crypto, visa B1/B2).
15. **Columnas de experto**: 1 artículo/mes firmado por la dirección general en medios de negocios: «Cuánto cuesta realmente un jet privado CDMX–Miami en 2026» (con la tabla del libro de precios). Son las páginas que las IAs citan como fuente de precio.
16. **HARO/Qwoted/Featured** en inglés: responder a periodistas que escriben sobre «private jet Mexico», «Cancun private jet cost», «Toluca airport».
17. **Reddit/Quora**: respuestas de la cuenta oficial en r/MexicoCity, r/Cancun, r/flying, Quora («How much does a private jet from Mexico City to Cancun cost?») con la cifra y el enlace a la ruta. Perplexity y ChatGPT citan Reddit con mucha frecuencia.
18. **Partnerships con enlace**: hoteles del Corredor en Los Cabos, Punta Mita, Four Seasons CDMX, family offices, despachos; página «Partners» recíproca.
19. **Eventos**: patrocinio o presencia en Gran Premio de México (F1, Autódromo), Abierto Mexicano de Tenis (Acapulco), Art Week CDMX, LABACE/NBAA-BACE: menciones en programas y prensa de evento.
20. **Wikipedia** (solo cuando existan 3+ fuentes de prensa independientes): artículo «JETCAB» en es.wikipedia. No intentarlo antes: se borra y perjudica.

### Medición
- Mensual: preguntar las 50 preguntas de la sección 2 a ChatGPT (con búsqueda), Perplexity, Gemini, Claude y Copilot; registrar si JETCAB es citado, en qué posición y con qué cifra. Objetivo mes 3: citado en ≥ 40 % de las preguntas de precio por ruta; mes 6: ≥ 70 %.
- GSC: impresiones de las 9 rutas EN y de las consultas «how much private jet mexico city to…»; aparición en AI Overviews.
- Tráfico referido desde chatgpt.com, perplexity.ai, gemini.google.com, copilot.microsoft.com (crear segmento en GA4).

---

## 5. Orden de implementación recomendado

1. Libro de precios único + corregir las 14 contradicciones de la tabla 1.1 en home EN, home ES y rutas. (1 día)
2. Publicar `jetcab-jsonld-global-v2.html` como snippet WPCode global en lugar del 2896; quitar los JSON-LD sueltos de `/en/` que dupliquen `Organization`/`WebSite`; dejar en `/en/` solo `WebPage` + `FAQPage` EN + Speakable dentro de `WebPage`. (medio día)
3. Insertar las 10 cápsulas de la sección 3 y añadir `provider/isPartOf/about` por `@id` en los dos PHP. Corregir ESTA en NY/LA. (medio día)
4. Subir `llms.txt`, revisar `robots.txt` y Cloudflare para bots de IA, añadir sitemap de rutas. (2 horas)
5. Crear /sobre-nosotros/ y /preguntas-frecuentes/ (ES) con las 25 respuestas ES; añadir las 25 EN a `/en/`. (2 días)
6. GBP + Bing + Apple + Wikidata + perfiles sociales con NAP idéntico; actualizar `sameAs`. (1 semana)
7. Rutas ES (brief pendiente #1) con sus cápsulas, para que los hreflang dejen de apuntar a 404. (2 días)
8. Directorios y prensa según P1/P2.
