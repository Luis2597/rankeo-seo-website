# JETCAB — Auditoría SEO técnico y on-page (código fuente)

**Fecha:** 9 oct 2026 · **Analista:** consultoría SEO técnico Rankeo
**Alcance:** `jetcab-en.html` (home EN, `/en/`), `jetcab-routes-domestic-v1.php` (5 rutas EN), `jetcab-routes-v3.php` (4 rutas EN internacionales), 6 páginas de flota (`jetcab-learjet35.html`, `jetcab-challenger605.html`, `jetcab-gulfstreamgv.html`, `jetcab-bell206.html`, `jetcab-aw139.html`, `jetcab-ambulancia-aerea.html`).
**Método:** solo código fuente del repo (jetcab.mx no es alcanzable desde este entorno). Nada se editó.
**Referencias:** brief `jetcab-context/SKILL.md` (clusters §7, arquitectura §8, flota §13) y `jetcab-auditoria-playwright-oct2026.md`.

> **Aviso sobre el estado de los archivos.** Durante esta auditoría otro proceso estaba editando el working tree (mtime 10:00–10:06 UTC, cambios sin commit en los 7 `.html`). Los `old` de abajo se tomaron de la **instantánea de las 10:06 UTC**. Ya están resueltos en el working tree (no en HEAD) y por eso **no se repiten** aquí: preloader a 1.6 s con `sessionStorage`, `preconnect` a `fonts.gstatic.com`, `preload` del póster, eliminación de `wa.link/rbmftv` y de los contadores aleatorios de «viewers», enlaces a las 9 rutas en footer/`route-links`/modal de destino, targets táctiles de 44 px, y en flota: title/description/OG/JSON-LD y enlaces de logo a jetcab.mx. Antes de publicar, hay que commitear ese working tree (ver §2B del CLAUDE.md: `hash-object` + `mktree`, nunca `git add`).

---

## 0. Resumen ejecutivo (lo que más pesa)

| # | Hallazgo | Impacto | Archivos |
|---|----------|---------|----------|
| 1 | **Precios y tiempos contradictorios entre home EN y páginas de ruta** (Cancún: $15,000 vs $3,200; Miami: $25,000/2h50/MIA vs $4,800/3h30/OPF; NY: $45,000/4h45 vs $9,500/5h30; Houston $18,000/2h vs $3,800/2h45; MTY $9,000 vs $2,200). Las mismas preguntas están en el `FAQPage` de la home y en el de cada ruta con respuestas distintas. Google y las IAs reciben dos «verdades»; el cliente UHNWI también. | Crítico | `jetcab-en.html` (secciones `#destinations-faq` y JSON-LD FAQ) vs ambos PHP |
| 2 | **Canibalización home EN ↔ rutas**: 18 `<h3>` «How long is a private jet from Mexico City to X? How much does it cost?» en la home repiten literalmente la keyword e intención de las 9 landings de ruta. La home compite con sus propias páginas por «private jet Mexico City to Cancun». | Alto | `jetcab-en.html` |
| 3 | **Modelo de aeronave inconsistente**: «Challenger 604» 39 veces en la home EN vs «Challenger 605» en rutas, página de flota y nombre del archivo de imagen (`Challenger-605-en-renta.jpeg`). El brief (§13) dice «Challenger 350/605». | Alto | `jetcab-en.html` |
| 4 | **Tarifas por hora inconsistentes dentro de la misma home**: Learjet 35 «$1,500/hr» (FAQ visible y JSON-LD) vs «$1,700/hr» (card, Service schema, guía); helicóptero «$800/hr» (guía) vs «$1,500/hr» (card Bell 206, FAQ). | Alto | `jetcab-en.html` |
| 5 | **Las 9 rutas EN y `/en/` se sirven por `template_redirect` → no entran en el sitemap de Yoast.** Sin sitemap propio, dependen 100 % del enlazado interno (que hasta hoy no existía). | Alto | ambos PHP + WPCode |
| 6 | **hreflang «es» hacia URLs que probablemente no existen** (`/vuelo-privado-cdmx-miami/`, y las domésticas están «pendientes» en el brief §15.1). Además, la home ES debe declarar `hreflang="en"` de vuelta o el par no es válido. | Alto | ambos PHP, `jetcab-en.html`, home ES |
| 7 | **«AIT» presentado como código IATA** en la barra de ruta («AIT → MIA»). El IATA de Toluca es **TLC** (ICAO MMTO). | Medio | `jetcab-routes-v3.php`, copy de la home |
| 8 | **Schema con riesgo**: `aggregateRating` autoservido en `LocalBusiness` (5★/500 sin reseñas en página), `award: "IATA Member"` (verificar), `logo` apuntando a `/uploads/jetcab-logo.png` (ruta distinta a la del logo real que sí carga la nav), `SpeakableSpecification` como nodo raíz (inválido), `price:"3,200"` con coma en `Offer`. | Medio | `jetcab-en.html`, ambos PHP |
| 9 | **Flota: sin `canonical`, CTA de nav a `/jetcab-propuesta.html#contacto` (documento interno de Rankeo), fotos stock repetidas** (la misma foto Unsplash es «exterior» del Learjet, del Challenger y del Gulfstream) cuando jetcab.mx ya tiene fotos reales de cada aeronave. | Medio | 6 páginas de flota |
| 10 | **Señales de urgencia ficticias que siguen vivas**: `● LIVE — Aircraft Ready`, badge «2 Left» en Gulfstream GV, «● Chartered today» en 3 destinos, «2 jets available this week» en rutas internacionales (valores estáticos en PHP). | Medio | `jetcab-en.html`, `jetcab-routes-v3.php` |

---

## 1–2. Problemas on-page por archivo, cada uno con su snippet de reemplazo (old → new)

Formato: **Problema → `old` (buscar) → `new` (pegar)**. Edits mínimos; no se toca diseño.

### 1.1 `jetcab-en.html` — home EN (`https://jetcab.mx/en/`)

#### 1.1.1 Open Graph / Twitter incompletos y `og:image` de stock (Unsplash)
Falta `og:url`, `og:site_name`, `og:image:width/height/alt`, `twitter:title/description/image`. La imagen social es una foto de stock de terceros; el sitio ya tiene fotos propias.

**old** (líneas 44–48):
```html
<meta property="og:title" content="JETCAB — Private Jet Charter Mexico">
<meta property="og:description" content="Mexico's premier private aviation. Jets, helicopters & air ambulance. DGAC certified. Response in 30 minutes.">
<meta property="og:image" content="https://images.unsplash.com/photo-1540962351504-03099e0a754b?auto=format&fit=crop&w=1200&q=85">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
```
**new**:
```html
<meta property="og:title" content="Private Jet Charter Mexico City | Toluca FBO — JETCAB">
<meta property="og:description" content="Private jet & helicopter charter from Toluca, Mexico City's private aviation base. Cancún, Los Cabos, Miami, New York & 200+ destinations. Quote in 30 min.">
<meta property="og:url" content="https://jetcab.mx/en/">
<meta property="og:site_name" content="JETCAB">
<meta property="og:image" content="https://jetcab.mx/wp-content/uploads/2023/09/jetcab-og.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="JETCAB private jet on the tarmac at Toluca International Airport">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Private Jet Charter Mexico City | Toluca FBO — JETCAB">
<meta name="twitter:description" content="Private jet & helicopter charter from Toluca, Mexico City's private aviation base. Quote in 30 minutes, 24/7.">
<meta name="twitter:image" content="https://jetcab.mx/wp-content/uploads/2023/09/jetcab-og.jpg">
```
> Verificar en vivo cuál de las dos rutas existe: `/wp-content/uploads/2023/09/jetcab-og.jpg` (rutas PHP) o `/wp-content/uploads/jetcab-og.jpg` (flota). Hoy el repo usa **ambas**; una es 404. Unificar en la que responda 200 y tenga 1200×630.

#### 1.1.2 `x-default` apunta a `/en/`
Negocio mexicano con ES como idioma principal: `x-default` debe ir a `https://jetcab.mx/`. Es decisión de negocio, pero el patrón habitual es idioma del mercado principal.

**old** (línea 51): `<link rel="alternate" hreflang="x-default" href="https://jetcab.mx/en/">`
**new**: `<link rel="alternate" hreflang="x-default" href="https://jetcab.mx/">`

Y en la **home ES** (WPCode, snippet PHP, `wp_head` prioridad 1) hace falta la reciprocidad o Google ignora el par:
```php
add_action('wp_head', function () {
    if (!is_front_page()) return;
    echo '<link rel="alternate" hreflang="es" href="https://jetcab.mx/">' . "\n";
    echo '<link rel="alternate" hreflang="en" href="https://jetcab.mx/en/">' . "\n";
    echo '<link rel="alternate" hreflang="x-default" href="https://jetcab.mx/">' . "\n";
}, 1);
```

#### 1.1.3 `LocalBusiness` JSON-LD: logo roto, rating autoservido, award dudoso
- `logo` → `https://jetcab.mx/wp-content/uploads/jetcab-logo.png` no coincide con el logo que realmente carga la nav (`/uploads/2023/03/cropped-1024-LOGO-JETCAB-TRANSPARENTE-1-96x96.png`). Usar la versión 1024 px.
- `aggregateRating` 5/500 sin reseñas visibles ni fuente: Google no muestra ratings autoservidos en `LocalBusiness` y puede tratarlo como spam estructurado. Quitar hasta tener reseñas reales con `review` en página.
- `"award":"IATA Member"`: un operador chárter normalmente no es miembro IATA (es de aerolíneas). Confirmar con el cliente; si no hay número de membresía, quitarlo también del marquee y del footer (`IATA · IS-BAO · ARGUS`).

**old** (línea 65): `  "logo":"https://jetcab.mx/wp-content/uploads/jetcab-logo.png",`
**new**:
```json
  "logo":"https://jetcab.mx/wp-content/uploads/2023/03/cropped-1024-LOGO-JETCAB-TRANSPARENTE-1.png",
  "image":"https://jetcab.mx/wp-content/uploads/2023/09/jetcab-og.jpg",
  "priceRange":"$$$$",
  "openingHoursSpecification":{"@type":"OpeningHoursSpecification","dayOfWeek":["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"opens":"00:00","closes":"23:59"},
```
**old** (línea 73): `  "aggregateRating":{"@type":"AggregateRating","ratingValue":"5","reviewCount":500},`
**new**: *(línea eliminada)*

**old** (línea 76): `  "@id":"https://jetcab.mx/en/#organization"`
**new**: `  "@id":"https://jetcab.mx/#organization"`
> Un solo `@id` de organización para todo el sitio (la flota ya usa `https://jetcab.mx/#organization`). Verificar que el snippet global 2896 use el mismo.

#### 1.1.4 `SpeakableSpecification` como nodo raíz (inválido)
`speakable` es una propiedad de `WebPage`/`Article`, no un tipo raíz. Tal como está, Google lo descarta.

**old** (líneas ~484–490):
```html
<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"SpeakableSpecification",
  "cssSelector":[".hero-title",".hero-sub",".sec-h","h2",".di-h",".di-p",".faq-q-text",".faq-a p",".sbc-n",".sbc-l"]
}
</script>
```
**new**:
```html
<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"WebPage",
  "@id":"https://jetcab.mx/en/#webpage",
  "url":"https://jetcab.mx/en/",
  "name":"Private Jet Charter Mexico City | Toluca FBO — JETCAB",
  "inLanguage":"en",
  "isPartOf":{"@type":"WebSite","@id":"https://jetcab.mx/#website"},
  "about":{"@id":"https://jetcab.mx/#organization"},
  "speakable":{"@type":"SpeakableSpecification","cssSelector":[".hero-title",".hero-sub",".di-h",".di-p",".faq-q-text",".faq-a p"]},
  "breadcrumb":{"@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"JETCAB","item":"https://jetcab.mx/"},{"@type":"ListItem","position":2,"name":"English","item":"https://jetcab.mx/en/"}]}
}
</script>
```
> Y en el bloque `WebSite` (línea ~474) cambiar `"url":"https://jetcab.mx/en/"` por `"@id":"https://jetcab.mx/#website","url":"https://jetcab.mx/"` para que `isPartOf` resuelva.

#### 1.1.5 Tarifas por hora contradictorias dentro de la home
Decidir una tarifa (la card, el `Service` schema y la guía dicen **$1,700/hr** Learjet 35; la página de flota también). Alinear FAQ visible + JSON-LD + helicóptero.

**old** (FAQ visible): `<div class="faq-a"><p>From $1,500 USD/hr for a Learjet 35 up to $5,400 USD/hr for a Gulfstream GV. Helicopter charters from $1,500 USD/hr. All prices include catering, permits and full crew — no hidden fees.</p></div>`
**new**: `<div class="faq-a"><p>From $1,700 USD/hr for a Learjet 35 up to $5,400 USD/hr for a Gulfstream GV. Helicopter charters from $1,500 USD/hr (Bell 206). All prices include catering, permits and full crew — no hidden fees.</p></div>`

**old** (JSON-LD FAQ, línea ~81): `"text":"Private jet charter in Mexico starts from $1,500 USD/hour for a light jet (Learjet 35) up to $5,400 USD/hour for a long-range jet (Gulfstream GV). Helicopter charters start from $1,500 USD/hour. All prices include catering, permits, and full crew."`
**new**: `"text":"Private jet charter in Mexico starts from $1,700 USD/hour for a light jet (Learjet 35) up to $5,400 USD/hour for a long-range jet (Gulfstream GV). Helicopter charters start from $1,500 USD/hour (Bell 206). All prices include catering, permits, and full crew."`

**old** (guía, JSON-LD y visible — 2 ocurrencias): `Helicopter charter rates start from $800 USD/hr.`
**new**: `Helicopter charter rates start from $1,500 USD/hr.`

**old** (sección testimonios): `<p class="sec-p">500+ flights completed. The trust of those who demand the very best on every journey.</p>`
**new**: `<p class="sec-p">2,000+ flights completed. The trust of those who demand the very best on every journey.</p>`

#### 1.1.6 Challenger 604 vs 605
Confirmar con el cliente el modelo real (imagen y brief dicen **605**). Después, reemplazo global (39 ocurrencias; incluye `openJet('challenger604')`, que es solo una clave interna, pero conviene renombrar por coherencia):
```bash
sed -i 's/Challenger 604/Challenger 605/g; s/challenger604/challenger605/g' jetcab-en.html
```
Y el `alt` de la card: **old** `alt="Challenger 604 private jet Mexico"` → **new** `alt="Challenger 605 midsize private jet charter Mexico — JETCAB"`.

#### 1.1.7 Canibalización y cifras contradictorias en `#destinations-faq` (línea 938)
La sección tiene 18 `<h3>` en formato pregunta con precios ×4–5 superiores a los de las landings de ruta. Edit mínimo y seguro para las **9 rutas con página propia**: convertir el H3 en encabezado descriptivo (no pregunta), citar la cifra de la landing y enlazar con anchor de keyword. Las otras 9 (Mérida, Oaxaca, Las Vegas, Acapulco, San Diego, Tijuana, McAllen, La Habana, Madrid) pueden quedarse como están hasta tener landing.

Plantilla con **Cancún** (repetir con la tabla de abajo):

**old**: `<h3 style="font-size:16px;font-weight:700;color:var(--white);margin:0 0 10px;line-height:1.4">How long is a private jet from Mexico City to Cancún (CUN)? How much does it cost?</h3>`
**new**: `<h3 style="font-size:16px;font-weight:700;color:var(--white);margin:0 0 10px;line-height:1.4">Mexico City to Cancún (CUN): 2h 15m, from $3,200 USD</h3>`

**old**: `<p style="font-size:12px;color:rgba(255,255,255,.4);margin:10px 0 0;font-style:italic">Ideal for: beach getaways, destination weddings, incentive travel, family vacations.</p>`
**new**: `<p style="font-size:12px;color:rgba(255,255,255,.4);margin:10px 0 0;font-style:italic">Ideal for: beach getaways, destination weddings, incentive travel, family vacations. <a href="https://jetcab.mx/private-jet-mexico-city-cancun/" style="color:var(--orange);font-style:normal;font-weight:600">Private jet Mexico City to Cancún: full route guide →</a></p>`

Y las cifras del párrafo (Learjet 35 / Challenger / Gulfstream) deben copiar las de la landing (`p1/p2/p3` del PHP). Tabla de valores a usar en los 9 bloques:

| Destino | H3 nuevo | Learjet 35 | Challenger 605 | Gulfstream GV | Enlace |
|---|---|---|---|---|---|
| Cancún (CUN) | 2h 15m, from $3,200 USD | $3,200 | $6,500 | $12,000 | `/private-jet-mexico-city-cancun/` |
| Los Cabos (SJD) | 2h 30m, from $3,800 USD | $3,800 | $7,500 | ver PHP `p3` | `/private-jet-mexico-city-los-cabos/` |
| Puerto Vallarta (PVR) | 1h 45m, from $3,000 USD | $3,000 | ver PHP | ver PHP | `/private-jet-mexico-city-puerto-vallarta/` |
| Monterrey (MTY) | 1h 15m, from $2,200 USD | $2,200 | ver PHP | ver PHP | `/private-jet-mexico-city-monterrey/` |
| Guadalajara (GDL) | 50 min, from $1,800 USD | $1,800 | ver PHP | ver PHP | `/private-jet-mexico-city-guadalajara/` |
| Miami (OPF) | 3h 30m nonstop, from $4,800 USD | $4,800 | $9,500 | $18,000 | `/private-jet-mexico-city-miami/` |
| Houston (HOU) | 2h 45m, from $3,800 USD | $3,800 | $7,500 | $14,000 | `/private-jet-mexico-city-houston/` |
| New York (TEB) | 5h 30m, from $9,500 USD | $9,500 | $18,500 | $28,000 | `/private-jet-mexico-city-new-york/` |
| Los Angeles (VNY) | 3h 45m, from $5,200 USD | $5,200 | $10,500 | $19,000 | `/private-jet-mexico-city-los-angeles/` |

> Nota de negocio: $3,200 USD por un Learjet 35 CDMX–Cancún (2h15 × $1,700/hr más reposicionamiento) no cuadra aritméticamente con la tarifa por hora publicada. Las landings y el brief (§12) coinciden en $3,200; la home dice $15,000. **El cliente debe confirmar cuál es la cifra real antes de tocar nada**; lo que no puede seguir es que ambas convivan.

Lo mismo en el **JSON-LD FAQPage** de la home: eliminar las 9 `Question` «How long is a private jet flight from Mexico City to {Cancún, Los Cabos, Puerto Vallarta, Monterrey, Guadalajara, New York, Miami*, Houston*, Los Angeles*}…» (líneas 66–76 y siguientes) porque ya viven en el `FAQPage` de cada ruta con respuesta distinta. Ejemplo del `old` a borrar (Cancún):
```json
{"@type":"Question","name":"How long is a private jet flight from Mexico City to Cancún and how much does it cost?","acceptedAnswer":{"@type":"Answer","text":"JETCAB private jets fly from Toluca Airport (AIT) to Cancún (IATA: CUN) in approximately 2h 10m. A private charter starts from approximately $15,000 USD one-way on a Learjet 35 for up to 7 passengers, including crew, catering, permits, and airport fees. JETCAB provides confirmed quotes within 30 minutes, 24/7."}},
```
(* Miami/Houston/LA no están en el JSON-LD de la home pero sí como H3 visibles; aplicar solo la parte visible.)

#### 1.1.8 Cards de flota sin enlace rastreable
Las 11 cards son `<div onclick="openJet(...)">`. Googlebot no sigue `onclick`. Cuando las páginas de flota tengan URL (propuesta §3), añadir un `<a>` real dentro de la card sin romper el modal:

**old**: `<div class="fc-foot"><span class="fc-price">From $1,700 USD/hr</span><span class="fc-link">View aircraft →</span></div>`
**new**: `<div class="fc-foot"><span class="fc-price">From $1,700 USD/hr</span><a class="fc-link" href="https://jetcab.mx/flota/learjet-35/" hreflang="es" onclick="event.stopPropagation()">Learjet 35 charter details →</a></div>`
(Repetir para Challenger 605, Gulfstream GV, Bell 206, AW139 y Ambulancia con sus URLs definitivas.)

#### 1.1.9 Variable CSS inexistente en la sección guía
`var(--ink)` no está definida en `:root` (solo `--bg`, `--bg2`, `--bg3`…). El fondo cae a transparente.

**old** (línea 939): `style="background:var(--ink);padding:64px 48px 80px;border-top:1px solid rgba(255,255,255,.05)"`
**new**: `style="background:var(--bg);padding:64px 48px 80px;border-top:1px solid rgba(255,255,255,.05)"`

#### 1.1.10 Señales de urgencia ficticias (credibilidad + publicidad engañosa)
**old**: `<span class="hero-eyebrow">● LIVE — Aircraft Ready · DGAC Certified · Departs on Demand</span>`
**new**: `<span class="hero-eyebrow">Toluca FBO · DGAC Certified · Jet ready in 2 hours</span>`

**old**: `<span class="fc-avail">2 Left</span>`
**new**: `<span class="fc-avail">● Available</span>`

**old** (3 ocurrencias): `<span class="dc-urgency">● Chartered today</span>` / `● Chartered this week`
**new**: `<span class="dc-urgency">● Route guide</span>` (en los 9 destinos con landing) o `● Popular route` en el resto.

#### 1.1.11 Fuentes: CSS de Google Fonts bloquea el render y pide pesos sin uso
`Barlow Condensed 300/400` no se usa en display (todo es 600–800) y `Barlow 300` aparece una sola vez. Cargar menos pesos y de forma no bloqueante.

**old** (línea 57): `<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;400;600;700;800&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">`
**new**:
```html
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Barlow:wght@400;500&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Barlow:wght@400;500&display=swap" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Barlow:wght@400;500&display=swap"></noscript>
```
> Si se usa `font-weight:300` en algún `<p>`, cambiarlo a 400 (una ocurrencia).

#### 1.1.12 `.rv` sin fallback: contenido invisible si falla JS o con `prefers-reduced-motion`
Solo hay un `@media(prefers-reduced-motion)` y es para el botón de WhatsApp. Añadir después de la línea 135:

**old**: `.rv{opacity:0;transform:translateY(40px);transition:opacity .65s ease,transform .65s ease}`
**new**:
```css
.rv{opacity:0;transform:translateY(40px);transition:opacity .65s ease,transform .65s ease}
@media(prefers-reduced-motion:reduce){.rv,.rv-l,.rv-r{opacity:1!important;transform:none!important;transition:none!important}.hero-bg::before,.mq-track{animation:none!important}}
```
y antes de `</head>`: `<noscript><style>.rv,.rv-l,.rv-r{opacity:1;transform:none}</style></noscript>`.
Además, regla del CLAUDE.md: la última sección con `.rv-l/.rv-r` es `.contact` → añadir `.contact{overflow:hidden}` para que el `translateY` no deje franja blanca bajo el footer.

#### 1.1.13 LCP: póster de héroe desde Unsplash a 2000 px para todos los viewports
El `preload` ya existe, pero carga la misma imagen de 2000 px en móvil. Servir la foto propia (regla «cero stock») y variante móvil:

**old** (línea 56): `<link rel="preload" as="image" href="https://images.unsplash.com/photo-1540962351504-03099e0a754b?auto=format&fit=crop&w=2000&q=85" fetchpriority="high">`
**new**:
```html
<link rel="preload" as="image" href="https://jetcab.mx/wp-content/uploads/jetcab-hero-toluca-1920.webp" media="(min-width:769px)" fetchpriority="high">
<link rel="preload" as="image" href="https://jetcab.mx/wp-content/uploads/jetcab-hero-toluca-900.webp" media="(max-width:768px)" fetchpriority="high">
```
y en CSS (línea 171, `.hero-bg::before`) la misma URL de 1920 más `@media(max-width:768px){.hero-bg::before{background-image:url('https://jetcab.mx/wp-content/uploads/jetcab-hero-toluca-900.webp')}}`. Requiere subir dos WebP (≤180 KB y ≤70 KB) del amanecer en Toluca.

#### 1.1.14 INP: canvas de partículas corre en `requestAnimationFrame` indefinidamente
55 nodos redibujados ~60 fps aunque el héroe ya no esté en pantalla. Pausar fuera de viewport (insertar tras la función `draw()` del bloque «CANVAS FLIGHT-PATH»):
```js
new IntersectionObserver(function(e){
  if(e[0].isIntersecting){ if(!RAF) RAF=requestAnimationFrame(draw); }
  else { cancelAnimationFrame(RAF); RAF=null; }
},{threshold:0}).observe(canvas);
```
(y en `draw()` asegurarse de que `RAF = requestAnimationFrame(draw)` solo corre si `RAF !== null`.)

#### 1.1.15 `<img src="">` en los modales
`<img class="jm-hero-img" id="jm-hero-img" src="" alt="" width="1800" height="900" loading="eager">` y `dm-hero-img`/`dm-img2`: `src=""` es inválido y en algunos navegadores dispara una petición a la propia página. Reemplazar `src=""` por `src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="` en las 3 etiquetas (el JS ya sobrescribe `src` y `alt` al abrir).

#### 1.1.16 Copy de entidades: «AIT» y Toluca
El cluster 1 del brief es «Aeropuerto Internacional de Toluca (AIT), FBO Privado Toluca». Mantener «AIT» como marca, pero cuando se cite código de aeropuerto usar el IATA real: **old** `Toluca International Airport (AIT/MMTO)` (guía y modal) → **new** `Toluca International Airport (TLC/MMTO — "AIT")`.

### 1.2 `jetcab-routes-domestic-v1.php` — 5 rutas domésticas EN

#### 1.2.1 H1 sin la keyword completa
Title y keyword son «Private Jet Mexico City to Cancún», pero el H1 es «Private Jet to Cancún». Falta la entidad «Mexico City».

**old** (línea 344): `    <h1>Private Jet<br>to <?php echo esc_html($r['dest']); ?></h1>`
**new**: `    <h1>Private Jet Mexico City<br>to <?php echo esc_html($r['dest']); ?></h1>`

#### 1.2.2 hreflang «es» a URL no verificada
`$canonical_es` = `https://jetcab.mx/vuelos-privados-a-cancun/` etc. El brief (§15, pendiente 1) dice que las rutas domésticas ES están por crear. Un hreflang a 404 invalida el par; además la página ES debe devolver `hreflang="en"`.

**old** (línea 212): `<link rel="alternate" hreflang="es" href="<?php echo $canonical_es; ?>">`
**new**: `<?php if (!empty($r['es_live'])) : ?><link rel="alternate" hreflang="es" href="<?php echo $canonical_es; ?>"><?php endif; ?>`
y en cada entrada del array `$routes` añadir `"es_live" => false,` (cambiar a `true` cuando la ES exista y enlace de vuelta). Lo mismo para el link `class="jc-lang"` (línea 335): envolverlo en el mismo `if`.

#### 1.2.3 LCP: héroe como `background-image` CSS (no lo ve el preload scanner)
**old** (línea 222): `<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800&family=Barlow:wght@300;400;500;600&display=swap" rel="stylesheet">`
**new**:
```php
<link rel="preload" as="image" href="<?php echo $hero_url; ?>" fetchpriority="high">
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Barlow:wght@400;500;600&display=swap" rel="stylesheet">
```

#### 1.2.4 Open Graph incompleto
**old** (línea 218): `<meta property="og:image" content="https://jetcab.mx/wp-content/uploads/2023/09/jetcab-og.jpg">`
**new**:
```php
<meta property="og:image" content="<?php echo $hero_url; ?>">
<meta property="og:image:width" content="1400">
<meta property="og:image:height" content="933">
<meta property="og:image:alt" content="Private jet Mexico City to <?php echo esc_attr($r['dest']); ?> — JETCAB">
<meta property="og:site_name" content="JETCAB">
<meta property="og:locale" content="en_US">
<meta name="twitter:title" content="<?php echo esc_attr($r['title']); ?>">
<meta name="twitter:description" content="<?php echo esc_attr($r['meta_desc']); ?>">
<meta name="twitter:image" content="<?php echo $hero_url; ?>">
```

#### 1.2.5 JSON-LD: `price` con coma, provider sin `@id`, sin `BreadcrumbList`, sin `isPartOf`
`"price":"3,200"` no es un número válido para schema.org. El `provider` repite datos del negocio en vez de referenciar la entidad global.

**old** (línea 225): `{"@type":"WebPage","@id":"<?php echo $canonical; ?>","url":"<?php echo $canonical; ?>","name":"<?php echo jc_json_str($r['title']); ?>","inLanguage":"en"},`
**new**:
```php
{"@type":"WebPage","@id":"<?php echo $canonical; ?>#webpage","url":"<?php echo $canonical; ?>","name":"<?php echo jc_json_str($r['title']); ?>","description":"<?php echo jc_json_str($r['meta_desc']); ?>","inLanguage":"en","isPartOf":{"@type":"WebSite","@id":"https://jetcab.mx/#website"},"primaryImageOfPage":{"@type":"ImageObject","url":"<?php echo $hero_url; ?>"},"breadcrumb":{"@id":"<?php echo $canonical; ?>#breadcrumb"}},
{"@type":"BreadcrumbList","@id":"<?php echo $canonical; ?>#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"name":"JETCAB","item":"https://jetcab.mx/en/"},{"@type":"ListItem","position":2,"name":"Private Jet Routes from Mexico City","item":"https://jetcab.mx/en/#destinations"},{"@type":"ListItem","position":3,"name":"Mexico City to <?php echo jc_json_str($r['dest']); ?>"}]},
```
**old** (línea 226, fragmento): `"provider":{"@type":"LocalBusiness","name":"JETCAB","url":"https://jetcab.mx","telephone":"+52-729-108-1200","foundingDate":"1999","areaServed":"Mexico"}`
**new**: `"provider":{"@type":"LocalBusiness","@id":"https://jetcab.mx/#organization","name":"JETCAB","url":"https://jetcab.mx/","telephone":"+52-729-108-1200"}`

**old** (línea 226, fragmento): `"offers":{"@type":"Offer","priceCurrency":"USD","price":"<?php echo $r['price']; ?>","priceSpecification":{"@type":"UnitPriceSpecification","priceCurrency":"USD","price":"<?php echo $r['price']; ?>","unitText":"per aircraft"}}`
**new**: `"url":"<?php echo $canonical; ?>","offers":{"@type":"Offer","url":"<?php echo $canonical; ?>","priceCurrency":"USD","price":"<?php echo str_replace(',', '', $r['price']); ?>","availability":"https://schema.org/InStock","priceSpecification":{"@type":"UnitPriceSpecification","priceCurrency":"USD","price":"<?php echo str_replace(',', '', $r['price']); ?>","unitText":"per aircraft, one-way"}}`

#### 1.2.6 Nav mezcla idiomas y no enlaza a la home EN ni al clúster de rutas
Logo → `https://jetcab.mx` (ES), «Fleet» → `/#flota` (ES). Un usuario EN pierde el idioma al primer clic. (Solo `/cotizar/` y `/sobre-nosotros/` existen en ES, se mantienen.)

**old** (líneas 330–334):
```html
  <a href="https://jetcab.mx" class="jc-nav-logo">JET<span>CAB</span></a>
  <div class="jc-nav-links">
    <a href="https://jetcab.mx/#flota">Fleet</a>
    <a href="https://jetcab.mx/sobre-nosotros/">About</a>
    <a href="https://jetcab.mx/cotizar/">Pricing</a>
```
**new**:
```html
  <a href="https://jetcab.mx/en/" class="jc-nav-logo" aria-label="JETCAB — Private jet charter Mexico (home)">JET<span>CAB</span></a>
  <div class="jc-nav-links">
    <a href="https://jetcab.mx/en/#fleet">Fleet</a>
    <a href="https://jetcab.mx/en/#destinations">Routes</a>
    <a href="https://jetcab.mx/sobre-nosotros/" hreflang="es">About</a>
    <a href="https://jetcab.mx/cotizar/" hreflang="es">Pricing</a>
```

#### 1.2.7 `target="_blank"` sin `rel` (7 por página, ambos PHP)
```bash
sed -i 's/target="_blank"/target="_blank" rel="noopener"/g' jetcab-routes-domestic-v1.php jetcab-routes-v3.php
```
(Seguro: ninguno tiene `rel` hoy; verificado con grep.)

#### 1.2.8 Cards de aeronave con stock genérico cuando existen fotos reales
**old** (línea 405): `<img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=75" alt="Learjet 35 light jet private cabin" loading="lazy">`
**new**: `<img src="https://jetcab.mx/wp-content/uploads/2024/11/Learjet35enrenta.jpeg" alt="Learjet 35 light jet — private jet Mexico City to <?php echo esc_attr($r['dest']); ?>" loading="lazy" width="700" height="394" decoding="async">`

**old** (línea 423): `<img src="https://images.unsplash.com/photo-1581093806997-124204d9fa9d?auto=format&fit=crop&w=800&q=75" alt="Challenger 605 midsize private jet cabin" loading="lazy">`
**new**: `<img src="https://jetcab.mx/wp-content/uploads/2024/11/Challenger-605-en-renta.jpeg" alt="Challenger 605 midsize jet — private jet Mexico City to <?php echo esc_attr($r['dest']); ?>" loading="lazy" width="700" height="394" decoding="async">`

**old** (línea 441): `<img src="https://images.unsplash.com/photo-1540962351504-03099e0a754b?auto=format&fit=crop&w=800&q=75" alt="Gulfstream GV large cabin private jet" loading="lazy">`
**new**: `<img src="https://jetcab.mx/wp-content/uploads/2024/11/Gulfstream-Gv-en-Renta.jpeg" alt="Gulfstream GV long-range jet — private jet Mexico City to <?php echo esc_attr($r['dest']); ?>" loading="lazy" width="700" height="394" decoding="async">`
(Mismas tres sustituciones en `jetcab-routes-v3.php`, líneas 503/520/537.) Las fotos `.jc-photo` de galería (líneas 365/381/396) tienen alto fijo por CSS (`height:480px`), así que no generan CLS; añadir igualmente `width="1400" height="933" decoding="async"`.

#### 1.2.9 H2 genéricos sin keyword
**old** (línea 400): `  <h2>Choose Your Aircraft</h2>`
**new**: `  <h2>Private Jets from Mexico City to <?php echo esc_html($r['dest']); ?></h2>`

**old** (línea 462): `  <h2>What People Ask</h2>`
**new**: `  <h2>Private Jet Mexico City to <?php echo esc_html($r['dest']); ?>: FAQ</h2>`

#### 1.2.10 Footer: solo enlaza rutas domésticas
Ver §4 (plan de enlazado) — añadir las 4 internacionales y la home EN con anchor de keyword.

---

### 1.3 `jetcab-routes-v3.php` — 4 rutas internacionales EN

#### 1.3.1 H1 sin «private jet»
H1 renderizado: «Mexico City / to Miami.» — no contiene el término de cabeza.

**old** (línea 405): `    <h1><span class="line1"><?php echo esc_html($r['hero_line1']); ?></span><span class="line2"><?php echo esc_html($r['hero_line2']); ?></span></h1>`
**new**: `    <h1><span class="line1">Private Jet <?php echo esc_html($r['hero_line1']); ?></span><span class="line2"><?php echo esc_html($r['hero_line2']); ?></span></h1>`
(Resultado: «Private Jet Mexico City / to Miami.» — revisar en 390 px que `.line1` no desborde; si lo hace, bajar `font-size` de `.line1` un escalón en el media query.)

#### 1.3.2 «AIT» mostrado como código IATA
**old** (línea 20, y equivalentes en houston/new-york/los-angeles): `            "from_iata"    => "AIT",`
**new**: `            "from_iata"    => "TLC",`
**old** (línea 19 y equivalentes): `            "from"         => "Mexico City",`
**new**: `            "from"         => "Toluca · Mexico City",`
(La barra de ruta pasará a mostrar «TLC Toluca · Mexico City → MIA Miami», que es correcto.)

#### 1.3.3 Escasez ficticia estática
`"fomo" => "2 jets available this week"` / `"3 jets…"` / `"1 long-range jet…"` son constantes en PHP: siempre dicen lo mismo. Para marca de lujo, riesgo reputacional.

**old** (4 entradas): `"fomo"         => "2 jets available this week",` (y variantes)
**new**: `"fomo"         => "Availability confirmed within 30 minutes",`

#### 1.3.4 Héroe `<img>` sin dimensiones
**old** (línea 400): `<img src="https://images.unsplash.com/photo-<?php echo esc_attr($r['hero_img']); ?>?auto=format&fit=crop&w=1800&q=85" alt="<?php echo esc_attr($r['dest_full']); ?>" fetchpriority="high">`
**new**: `<img src="https://images.unsplash.com/photo-<?php echo esc_attr($r['hero_img']); ?>?auto=format&fit=crop&w=1800&q=85" alt="Private jet Mexico City to <?php echo esc_attr($r['dest_full']); ?> — <?php echo esc_attr($r['fbo_name']); ?>" width="1800" height="1013" fetchpriority="high" decoding="async">`
(El CSS ya tiene `width:100%;height:100%;object-fit:cover`, así que los atributos solo reservan ratio.)

#### 1.3.5 H2 sin keyword
**old** (línea 498): `    <h2>Three cabins for this route.</h2>`
**new**: `    <h2>Private jets Mexico City to <?php echo esc_html($r['dest']); ?>: three cabins.</h2>`

#### 1.3.6 Igual que domésticas
Aplicar 1.2.2 (hreflang condicional — aquí es casi seguro que `/vuelo-privado-cdmx-miami/` no existe), 1.2.4 (OG), 1.2.5 (JSON-LD con `price` sin coma, `@id`, breadcrumb; en v3 el precio está en `p1` → `str_replace(array('$',','),'',$r['p1'])`), 1.2.6 (nav), 1.2.7 (`rel`), 1.2.8 (fotos reales de aeronave).

---

### 1.4 Páginas de flota (6 archivos, ES-MX, aún sin URL en jetcab.mx)

> Estado actual (working tree): ya tienen title, description, OG, JSON-LD (`Organization` + `Service` + `BreadcrumbList`) y nav/logo apuntando a jetcab.mx. Lo que sigue es lo que falta antes de publicarlas.

#### 1.4.1 Sin `canonical`
Insertar tras `<meta name="robots" content="index, follow">` (línea 7) en cada archivo, con la URL definitiva (propuesta: `/flota/{slug}/`, confirmar con el cliente):
```html
<link rel="canonical" href="https://jetcab.mx/flota/learjet-35/">
<link rel="alternate" hreflang="es-MX" href="https://jetcab.mx/flota/learjet-35/">
<link rel="alternate" hreflang="x-default" href="https://jetcab.mx/flota/learjet-35/">
```
Slugs propuestos: `learjet-35`, `challenger-605`, `gulfstream-gv`, `helicoptero-bell-206`, `helicoptero-aw139`, `ambulancia-aerea`.

#### 1.4.2 CTA de nav a un documento interno de Rankeo
**old** (línea 158, los 6 archivos): `<a href="/jetcab-propuesta.html#contacto" class="n-cta">Cotizar este vuelo</a>`
**new**: `<a href="#cotizar" class="n-cta">Cotizar este vuelo</a>`
(La sección `id="cotizar"` existe en las 6 páginas — verificado.)

#### 1.4.3 Fotos stock repetidas y sin relación con la aeronave
`photo-1583416750470` es «exterior» del Learjet, del Challenger y del Gulfstream; `photo-1474302770737` aparece hasta 5 veces en la misma página. El sitio ya tiene foto real de cada aeronave. Sustituir el héroe (y preload) por la foto real:

| Archivo | `old` (fragmento en `hero-bg`) | `new` |
|---|---|---|
| learjet35 | `photo-1556388158-158ea5ccacbd?auto=format&fit=crop&w=1800&q=80` | `https://jetcab.mx/wp-content/uploads/2024/11/Learjet35enrenta.jpeg` |
| challenger605 | `photo-1474302770737-173ee21bab63?auto=format&fit=crop&w=1800&q=80` | `https://jetcab.mx/wp-content/uploads/2024/11/Challenger-605-en-renta.jpeg` |
| gulfstreamgv | `photo-1464037866556-6812c9d1c72e?auto=format&fit=crop&w=1800&q=80` | `https://jetcab.mx/wp-content/uploads/2024/11/Gulfstream-Gv-en-Renta.jpeg` |
| bell206 | `photo-1436891678271-9c672565d8f6?auto=format&fit=crop&w=1800&q=80` | `https://jetcab.mx/wp-content/uploads/2024/11/Bel-206-en-renta.jpeg` |
| aw139 | `photo-1540962351504-03099e0a754b?auto=format&fit=crop&w=1800&q=80` | `https://jetcab.mx/wp-content/uploads/2024/11/Renta-de-Helicopteros-Mex.jpeg` |
| ambulancia-aerea | `photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=1800&q=80` (es un retrato de médico, no una ambulancia aérea) | `https://jetcab.mx/wp-content/uploads/2024/11/Ambulancia-aerea-Mexico.jpeg` |

Ejemplo completo (learjet35, línea 162):
**old**: `  <div class="hero-bg" style="background-image:url('https://images.unsplash.com/photo-1556388158-158ea5ccacbd?auto=format&fit=crop&w=1800&q=80')"></div>`
**new**: `  <div class="hero-bg" style="background-image:url('https://jetcab.mx/wp-content/uploads/2024/11/Learjet35enrenta.jpeg')"></div>`
y en `<head>`: `<link rel="preload" as="image" href="https://jetcab.mx/wp-content/uploads/2024/11/Learjet35enrenta.jpeg" fetchpriority="high">`. Cuando no quede ninguna URL de Unsplash, borrar `<link rel="preconnect" href="https://images.unsplash.com">`.
> Verificar en vivo la resolución de esos JPEG; si son <1400 px, pedir al cliente las originales (el brief exige fotos propias del amanecer en Toluca).

Las 3 miniaturas `.gt` y las 3 `.cap-img` no llevan `loading="lazy"` ni `decoding="async"`; añadir ambos a las 6 imágenes bajo el pliegue (CSS fija alto, no hay CLS).

#### 1.4.4 JSON-LD: falta `WebPage` e imagen; `Service` sin `url`
**old** (línea 142, fragmento común): `"offers":{"@type":"Offer","priceCurrency":"USD","price":"1700",`
**new**: `"url":"https://jetcab.mx/flota/learjet-35/","image":"https://jetcab.mx/wp-content/uploads/2024/11/Learjet35enrenta.jpeg","offers":{"@type":"Offer","url":"https://jetcab.mx/flota/learjet-35/","priceCurrency":"USD","price":"1700",`
(Adaptar precio/slug/imagen por archivo: 2700, 5400, 1500, 3500, 2700.)

**old** (línea 143, fragmento): `{"@type":"ListItem","position":2,"name":"Flota","item":"https://jetcab.mx/#flota"}`
**new**: `{"@type":"ListItem","position":2,"name":"Flota","item":"https://jetcab.mx/flota/"}` (cuando exista el hub; mientras, dejar `#flota`).

#### 1.4.5 Copyright fijo y gramática
**old** (línea 258, 6 archivos): `<span class="ft-copy">© 2025 JETCAB · Private Aviation México · +52 (729) 108-1200</span>`
**new**: `<span class="ft-copy">© <span id="yr">2026</span> JETCAB · Aviación Privada México · +52 (729) 108-1200</span>` + antes de `</body>`: `<script>document.getElementById('yr').textContent=new Date().getFullYear();</script>`

**old** (`jetcab-ambulancia-aerea.html`): `<h2 class="cta-h">Vuela en<br>el Ambulancia Aérea</h2>`
**new**: `<h2 class="cta-h">Solicita<br>la Ambulancia Aérea</h2>`

#### 1.4.6 H1 sin intención transaccional
Los H1 son solo el nombre del modelo («Learjet 35»). El title ya lleva «Renta de…»; el H1 debería también, sin romper el display (el nombre sigue grande, el prefijo pequeño):

**old** (learjet35, línea 166): `    <h1 class="hero-h1">Learjet 35</h1>`
**new**: `    <h1 class="hero-h1"><span style="display:block;font-size:.22em;letter-spacing:.3em;font-weight:700;color:var(--orange);margin-bottom:8px">Renta de jet privado desde Toluca</span>Learjet 35</h1>`
(Y eliminar el `<span class="hero-tag">Jet Corto Alcance</span>` justo encima, o moverlo bajo el H1, para no duplicar etiqueta.) Para helicópteros: «Renta de helicóptero desde Toluca y CDMX»; ambulancia: «Traslado médico aéreo 24/7 desde Toluca».

#### 1.4.7 Alineación con el brief
- El brief (§7 cluster 2, §13) habla de **Gulfstream G650/G650ER** como insignia Long Range; la página y la home dicen **Gulfstream GV**. Confirmar qué opera realmente JETCAB antes de posicionar «G650».
- Las páginas no mencionan ni una vez «Identity Shield», «Tarmac-to-Cabin», «Cero Fricción Logística» (cluster 3), salvo la description del Gulfstream. Añadir un párrafo en `.sec-p` de cada página (copy, no código).

---

### 1.5 Transversal: sitemap, robots, entidades

#### 1.5.1 Las 9 rutas y `/en/` no están en el sitemap de Yoast
Se generan por `add_rewrite_rule` + `template_redirect`; Yoast solo indexa posts/páginas. Snippet WPCode (PHP) que añade un sitemap propio al índice de Yoast:
```php
add_filter('wpseo_sitemap_index', function ($xml) {
    return $xml . '<sitemap><loc>https://jetcab.mx/jetcab-landings-sitemap.xml</loc><lastmod>' . date('c') . '</lastmod></sitemap>' . "\n";
});
add_action('init', function () {
    add_rewrite_rule('^jetcab-landings-sitemap\.xml$', 'index.php?jetcab_landings_sitemap=1', 'top');
});
add_filter('query_vars', function ($v) { $v[] = 'jetcab_landings_sitemap'; return $v; });
add_action('template_redirect', function () {
    if (!get_query_var('jetcab_landings_sitemap')) return;
    $urls = ['https://jetcab.mx/en/'];
    foreach (['cancun','los-cabos','puerto-vallarta','monterrey','guadalajara','miami','houston','new-york','los-angeles'] as $s) {
        $urls[] = 'https://jetcab.mx/private-jet-mexico-city-' . $s . '/';
    }
    status_header(200);
    header('Content-Type: application/xml; charset=UTF-8');
    echo '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($urls as $u) echo '<url><loc>' . esc_url($u) . '</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>';
    echo '</urlset>';
    exit;
});
```
Después: Ajustes → Enlaces permanentes → Guardar (flush) y reenviar `sitemap_index.xml` en GSC. Añadir las URLs de flota cuando se publiquen.

#### 1.5.2 robots
Ninguna de las 16 páginas bloquea nada (correcto). Pendiente del brief (§15.5): `noindex` en `/cart/`, `/checkout/`, `/my-account/` — está fuera de estos archivos pero afecta al crawl budget del mismo dominio.

#### 1.5.3 Una sola entidad JETCAB
Hoy hay tres `@id`/formas de organización: `https://jetcab.mx/en/#organization` (home EN), `https://jetcab.mx/#organization` (flota) y un `LocalBusiness` inline sin `@id` (rutas). Unificar todo a `https://jetcab.mx/#organization` y comprobar que el snippet global 2896 lo declara con ese mismo `@id`.

---

## 3. Title · meta description · H1 propuestos (16 páginas)

Longitudes verificadas por script: títulos 52–60 caracteres, descriptions 151–160. Keywords del brief: «private jet Mexico City to {destino}» (rutas EN), «renta de jets privados Toluca» / «renta de {modelo}» (flota ES), clúster Toluca/AIT/FBO en todas.

| # | Página | Title (chars) | Meta description (chars) | H1 |
|---|--------|---------------|--------------------------|----|
| 1 | `/en/` | Private Jet Charter Mexico City \| Toluca FBO — JETCAB (53) | Private jet & helicopter charter from Toluca, Mexico City's private aviation base. Cancún, Los Cabos, Miami, New York & 200+ destinations. Quote in 30 min. (155) | Private Jet Charter Mexico City *(3 líneas: Private Jet / Charter / Mexico City)* |
| 2 | `/private-jet-mexico-city-cancun/` | Private Jet Mexico City to Cancún \| 2h 15m Nonstop — JETCAB (59) | Private jet from Mexico City (Toluca) to Cancún in 2h 15m. Private terminal at CUN, 15 min from the Hotel Zone. Learjet 35 from $3,200 USD. Ready in 2 hours. (157) | Private Jet Mexico City to Cancún |
| 3 | `/private-jet-mexico-city-los-cabos/` | Private Jet Mexico City to Los Cabos \| 2h 30m — JETCAB (54) | Private jet from Mexico City (Toluca) to Los Cabos in 2h 30m. Private terminal at SJD, 25 min from Cabo San Lucas. Learjet 35 from $3,800 USD. Same-day flights. (160) | Private Jet Mexico City to Los Cabos |
| 4 | `/private-jet-mexico-city-puerto-vallarta/` | Private Jet Mexico City to Puerto Vallarta \| 1h 45m — JETCAB (60) | Private jet from Mexico City (Toluca) to Puerto Vallarta in 1h 45m. Private terminal at PVR, 10 min from the Malecón, 45 from Punta Mita. From $3,000 USD. (154) | Private Jet Mexico City to Puerto Vallarta |
| 5 | `/private-jet-mexico-city-monterrey/` | Private Jet Mexico City to Monterrey \| 1h 15m — JETCAB (54) | Private jet from Mexico City (Toluca) to Monterrey in 1h 15m. Private terminal at MTY, 20 min from San Pedro Garza García. From $2,200 USD. Same-day trips. (155) | Private Jet Mexico City to Monterrey |
| 6 | `/private-jet-mexico-city-guadalajara/` | Private Jet Mexico City to Guadalajara \| 50 min — JETCAB (56) | Private jet from Mexico City (Toluca) to Guadalajara in 50 minutes. Private terminal at GDL, 15 min from Zapopan. From $1,800 USD. Same-day round trips. (152) | Private Jet Mexico City to Guadalajara |
| 7 | `/private-jet-mexico-city-miami/` | Private Jet Mexico City to Miami \| Nonstop 3h 30m — JETCAB (58) | Private jet from Mexico City (Toluca) to Miami nonstop in 3h 30m. Land at Opa-locka Executive, 20 min from South Beach. US Customs at the FBO. From $4,800 USD. (159) | Private Jet Mexico City to Miami |
| 8 | `/private-jet-mexico-city-houston/` | Private Jet Mexico City to Houston \| 2h 45m — JETCAB (52) | Private jet from Mexico City (Toluca) to Houston in 2h 45m. Land at Hobby Airport, 10 min from Downtown and the Texas Medical Center. From $3,800 USD. Same-day. (160) | Private Jet Mexico City to Houston |
| 9 | `/private-jet-mexico-city-new-york/` | Private Jet Mexico City to New York \| Teterboro — JETCAB (56) | Private jet from Mexico City (Toluca) to New York in 5h 30m. Land at Teterboro, 12 min from Midtown Manhattan. Skip JFK. From $9,500 USD. DGAC certified. (153) | Private Jet Mexico City to New York |
| 10 | `/private-jet-mexico-city-los-angeles/` | Private Jet Mexico City to Los Angeles \| Van Nuys — JETCAB (58) | Private jet from Mexico City (Toluca) to Los Angeles in 3h 45m. Land at Van Nuys, 15 min from Beverly Hills. Skip LAX. From $5,200 USD. Jet ready in 2 hours. (157) | Private Jet Mexico City to Los Angeles |
| 11 | `/flota/learjet-35/` | Renta de Learjet 35 en Toluca \| Jet Privado — JETCAB (52) | Renta de Learjet 35 desde el Aeropuerto de Toluca (AIT): 4–7 pasajeros, 3,500 km de alcance, desde $1,700 USD/hora. Ideal Acapulco, Monterrey o Cancún. (151) | Renta de jet privado desde Toluca · **Learjet 35** |
| 12 | `/flota/challenger-605/` | Renta de Challenger 605 en Toluca \| Midsize Jet — JETCAB (56) | Renta de Challenger 605 desde Toluca (AIT): 6–9 pasajeros, 6,500 km sin escalas, desde $2,700 USD/hora. Cabina ancha para juntas rumbo a Miami o Houston. (153) | Renta de jet privado desde Toluca · **Challenger 605** |
| 13 | `/flota/gulfstream-gv/` | Renta de Gulfstream GV en Toluca \| Long Range — JETCAB (54) | Renta de Gulfstream GV desde Toluca (AIT): 8–16 pasajeros, 12,000 km sin escalas a Nueva York o Europa, desde $5,400 USD/hora. Cabina completa, Identity Shield. (160) | Jet intercontinental desde Toluca · **Gulfstream GV** |
| 14 | `/flota/helicoptero-bell-206/` | Renta de Helicóptero Bell 206 CDMX y Toluca — JETCAB (52) | Renta de helicóptero Bell 206 en CDMX y Toluca: 3–5 pasajeros, 620 km de alcance, desde $1,500 USD/hora. Polanco–Toluca en 20 min, Valle de Bravo y más. (152) | Renta de helicóptero CDMX · **Bell 206** |
| 15 | `/flota/helicoptero-aw139/` | Renta de Helicóptero AW139 México \| Ejecutivo — JETCAB (54) | Renta de helicóptero AW139 en México: hasta 15 pasajeros, bimotor Pratt & Whitney, 1,000 km de alcance, desde $3,500 USD/hora. Traslados corporativos y VIP. (156) | Helicóptero ejecutivo bimotor · **AW139** |
| 16 | `/flota/ambulancia-aerea/` | Ambulancia Aérea México 24/7 \| Traslado Médico — JETCAB (55) | Ambulancia aérea en México 24/7: UCI a bordo, médico y enfermero especializados, desde $2,700 USD/hora. Despegue desde Toluca en 2 horas. México y EE. UU. (154) | Ambulancia Aérea en México 24/7 |

Notas:
- Rutas EN: el H1 pasa de «Private Jet to X» / «Mexico City to X.» a la keyword exacta del brief (§8).
- Las cifras de las descriptions de rutas son las de los PHP (`time`, `price`), que coinciden con el brief §12. Si el cliente corrige precios, cambiar PHP → description se regenera sola.
- Flota: el prefijo del H1 va en `<span>` pequeño dentro del `<h1>` (ver 1.4.6) para conservar el display grande del modelo.
- La home EN hoy tiene title «Private Jet Charter Mexico | JETCAB — DGAC Certified» (54). La propuesta mete «Mexico City» + «Toluca FBO» (cluster 1) y saca «DGAC Certified», que no es término de búsqueda.

---

## 4. Plan de enlazado interno (qué, dónde, con HTML)

Estado actual: la home EN ya enlaza las 9 rutas (footer + `route-links` + modal de destino, cambios del working tree). Faltan: rutas → home EN, rutas domésticas ↔ internacionales, cualquier cosa ↔ flota, flota ↔ rutas, y breadcrumbs visibles.

### 4.1 Rutas → home EN y entre clusters (ambos PHP, bloque «Routes» del footer)
**old** (`jetcab-routes-domestic-v1.php`, líneas 493–497):
```html
      <a href="https://jetcab.mx/private-jet-mexico-city-cancun/">CDMX to Cancún</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-los-cabos/">CDMX to Los Cabos</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-monterrey/">CDMX to Monterrey</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-guadalajara/">CDMX to Guadalajara</a>
      <a href="https://jetcab.mx/private-jet-mexico-city-puerto-vallarta/">CDMX to Puerto Vallarta</a>
```
**new** (mismo bloque en **ambos** PHP; en v3 sustituye las líneas 610–613):
```html
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
```
Y mejor aún, como PHP para no duplicar listas (poner antes de `function jetcab_domestic_page_v1`):
```php
if (!function_exists('jc_route_links')) {
    function jc_route_links($current_slug) {
        $all = ['cancun'=>'Cancún','los-cabos'=>'Los Cabos','puerto-vallarta'=>'Puerto Vallarta','monterrey'=>'Monterrey','guadalajara'=>'Guadalajara','miami'=>'Miami','houston'=>'Houston','new-york'=>'New York','los-angeles'=>'Los Angeles'];
        $out = '<a href="https://jetcab.mx/en/#destinations">All private jet routes from Mexico City</a>';
        foreach ($all as $slug => $name) {
            if ($slug === $current_slug) continue;
            $out .= '<a href="https://jetcab.mx/private-jet-mexico-city-' . $slug . '/">Private jet Mexico City to ' . esc_html($name) . '</a>';
        }
        return $out;
    }
}
```
y en el footer: `<?php echo jc_route_links($r['slug']); ?>`.

### 4.2 Rutas → flota (sección «Choose Your Aircraft» / «Three cabins»)
Hoy los 3 botones «Book this aircraft» van a WhatsApp. Añadir un enlace secundario a la página de la aeronave (cuando tenga URL) sin quitar el de WhatsApp:

**old** (domestic línea 418 / v3 línea 515): `        <a href="<?php echo $wa; ?>" class="jc-fleet-cta" target="_blank">Book this aircraft</a>`
**new**:
```html
        <a href="<?php echo $wa; ?>" class="jc-fleet-cta" target="_blank" rel="noopener">Book this aircraft</a>
        <a href="https://jetcab.mx/flota/learjet-35/" hreflang="es" style="display:block;text-align:center;margin-top:8px;font-size:.8rem;color:var(--muted)">Learjet 35 specs &amp; hourly rate →</a>
```
(Challenger → `/flota/challenger-605/`, Gulfstream → `/flota/gulfstream-gv/`.)

### 4.3 Rutas → breadcrumb visible (coincide con el `BreadcrumbList` de 1.2.5)
Insertar justo después de `<nav class="jc-nav">…</nav>` en ambos PHP:
```html
<nav aria-label="Breadcrumb" style="position:absolute;top:72px;left:0;right:0;z-index:5;padding:0 2rem;font-size:.75rem;letter-spacing:.08em;text-transform:uppercase;color:rgba(255,255,255,.55)">
  <a href="https://jetcab.mx/en/" style="color:inherit;text-decoration:none">JETCAB</a> &rsaquo;
  <a href="https://jetcab.mx/en/#destinations" style="color:inherit;text-decoration:none">Routes from Mexico City</a> &rsaquo;
  <span style="color:#fff">Mexico City to <?php echo esc_html($r['dest']); ?></span>
</nav>
```

### 4.4 Home EN → flota (cards + footer «Fleet»)
- Cards: ver 1.1.8 (`<a class="fc-link">` real dentro de cada card).
- Footer: los 6 `<li><a href="#fleet" onclick="event.preventDefault();openJet('…')">` → `href` a la URL de la página de flota, manteniendo el `onclick` solo si se quiere abrir el modal en desktop:
```html
<li><a href="https://jetcab.mx/flota/learjet-35/" hreflang="es">Learjet 35 charter</a></li>
<li><a href="https://jetcab.mx/flota/challenger-605/" hreflang="es">Challenger 605 charter</a></li>
<li><a href="https://jetcab.mx/flota/gulfstream-gv/" hreflang="es">Gulfstream GV charter</a></li>
<li><a href="https://jetcab.mx/flota/helicoptero-bell-206/" hreflang="es">Bell 206 helicopter charter</a></li>
<li><a href="https://jetcab.mx/flota/helicoptero-aw139/" hreflang="es">AW139 helicopter charter</a></li>
<li><a href="https://jetcab.mx/flota/ambulancia-aerea/" hreflang="es">Air ambulance Mexico</a></li>
```
- Nav principal: añadir «Routes» (`#destinations`) entre «Destinations» y «Why JETCAB» no aporta; en su lugar renombrar `<a href="#destinations">Destinations</a>` → `<a href="#destinations">Routes &amp; Destinations</a>` para que el ancla lleve la palabra «Routes» que el usuario busca.

### 4.5 Flota → rutas + otras aeronaves (6 archivos, antes de `<footer>`)
```html
<section class="specs-section" aria-label="Rutas y otras aeronaves" style="padding-top:0">
  <div class="wrap">
    <span class="sec-tag">Rutas frecuentes con esta aeronave</span>
    <p class="sec-p" style="margin-bottom:18px">
      <a href="https://jetcab.mx/private-jet-mexico-city-cancun/" hreflang="en" style="color:var(--orange)">Jet privado CDMX – Cancún</a> ·
      <a href="https://jetcab.mx/private-jet-mexico-city-monterrey/" hreflang="en" style="color:var(--orange)">CDMX – Monterrey</a> ·
      <a href="https://jetcab.mx/private-jet-mexico-city-los-cabos/" hreflang="en" style="color:var(--orange)">CDMX – Los Cabos</a> ·
      <a href="https://jetcab.mx/private-jet-mexico-city-miami/" hreflang="en" style="color:var(--orange)">CDMX – Miami</a>
    </p>
    <span class="sec-tag">Otras aeronaves JETCAB</span>
    <p class="sec-p">
      <a href="https://jetcab.mx/flota/learjet-35/">Learjet 35</a> · <a href="https://jetcab.mx/flota/challenger-605/">Challenger 605</a> · <a href="https://jetcab.mx/flota/gulfstream-gv/">Gulfstream GV</a> · <a href="https://jetcab.mx/flota/helicoptero-bell-206/">Bell 206</a> · <a href="https://jetcab.mx/flota/helicoptero-aw139/">AW139</a> · <a href="https://jetcab.mx/flota/ambulancia-aerea/">Ambulancia aérea</a>
    </p>
  </div>
</section>
```
Ajustar por aeronave: Learjet 35 → Acapulco/MTY/GDL/Cancún (cluster «Light Jet»); Challenger 605 → Miami/Houston (cluster «Midsize»); Gulfstream GV → New York/Los Angeles (cluster «Long Range»); helicópteros → ninguna ruta de jet, solo «otras aeronaves». Cuando existan las rutas ES (`/vuelos-privados-a-cancun/`), cambiar estos href a las ES.

### 4.6 Home ES (fuera de estos archivos, pero necesario)
El snippet 2891 pone un switcher JS, no un enlace rastreable. Añadir en el footer ES un `<a href="https://jetcab.mx/en/" hreflang="en">English</a>` y enlaces a las 9 rutas EN y a las páginas de flota: sin ello, `/en/` recibe PageRank solo desde las rutas.

---

## 5. Top 10 acciones priorizadas (impacto / esfuerzo)

| # | Acción | Impacto | Esfuerzo | Archivos |
|---|--------|---------|----------|----------|
| 1 | **Unificar precios, tiempos y aeropuertos** entre home EN y rutas (una fuente de verdad: los PHP, validados por el cliente). Quitar las 9 `Question` duplicadas del FAQ JSON-LD de la home y convertir los H3-pregunta en encabezados + enlace (1.1.7). | Crítico | Medio (1–2 h, copy) | `jetcab-en.html` |
| 2 | **Commitear y publicar el working tree** (preloader 1.6 s, `wa.me`, enlaces a rutas, 44 px, head de flota). Hoy nada de esto está en HEAD ni en producción. | Alto | Bajo | 7 `.html` |
| 3 | **Sitemap propio para `/en/` + 9 rutas** en el índice de Yoast y reenviar a GSC (1.5.1). | Alto | Bajo (snippet WPCode) | WPCode |
| 4 | **hreflang**: condicionar `hreflang="es"` en rutas a que la ES exista; añadir reciprocidad en home ES; `x-default` → `/` (1.1.2, 1.2.2). | Alto | Bajo | PHP ×2, home ES, `jetcab-en.html` |
| 5 | **Challenger 604 → 605** (o viceversa) y **$1,500 → $1,700/hr**, helicóptero **$800 → $1,500/hr**, «500+ flights» → «2,000+» (1.1.5, 1.1.6). | Alto | Bajo (sed + 4 edits) | `jetcab-en.html` |
| 6 | **H1 de rutas con keyword exacta** («Private Jet Mexico City to X») y H2 con keyword (1.2.1, 1.3.1, 1.2.9, 1.3.5). | Alto | Bajo | PHP ×2 |
| 7 | **JSON-LD limpio**: quitar `aggregateRating` y «IATA Member» (si no es verificable), `logo` correcto, `Speakable` dentro de `WebPage`, `price` sin coma, `@id` único de organización, `BreadcrumbList` en rutas (1.1.3, 1.1.4, 1.2.5, 1.5.3). | Medio-Alto | Medio | `jetcab-en.html`, PHP ×2 |
| 8 | **Enlazado cruzado** rutas → home EN, domésticas ↔ internacionales, rutas ↔ flota, flota → rutas (§4). | Medio-Alto | Bajo-Medio | PHP ×2, flota ×6 |
| 9 | **Flota publicable**: canonical + URL definitiva, CTA `#cotizar`, fotos reales en vez de stock repetido, `WebPage`/`image` en schema, © dinámico (1.4). | Medio | Medio | flota ×6 |
| 10 | **Rendimiento**: fuentes no bloqueantes y menos pesos, póster de héroe propio en WebP con variante móvil, pausa del canvas fuera de viewport, fallback `.rv` para reduced-motion/no-JS, `var(--ink)` → `var(--bg)` (1.1.9–1.1.14). | Medio | Medio | `jetcab-en.html`, PHP ×2 |

**Qué no tocar:** el FAQ estático de rutas (correcto para SEO), los `FAQPage` por ruta (válidos tras el fix `jc_json_str`), el formulario → WhatsApp, el idioma ES-MX de las páginas de flota, y el diseño. Todo lo propuesto aquí es sustitución de strings o inserción de bloques.

**Verificar en vivo antes de aplicar:** (a) cuál `jetcab-og.jpg` existe, (b) si existen `/vuelos-privados-a-*/` y `/vuelo-privado-cdmx-*/`, (c) `@id` del snippet 2896, (d) resolución real de los JPEG de aeronaves en `/uploads/2024/11/`, (e) el precio real CDMX–Cancún en Learjet 35 ($3,200 vs $15,000).
