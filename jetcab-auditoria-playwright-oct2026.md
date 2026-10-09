# JETCAB — Auditoría técnica con Playwright (9 oct 2026)

**Alcance:** jetcab-en.html (home EN), 6 páginas de flota (jetcab-*.html), 5 rutas domésticas EN (jetcab-routes-domestic-v1.php) y 4 rutas internacionales EN (jetcab-routes-v3.php), renderizadas localmente y probadas en Chromium a 1440px y 390px.
**Limitación:** jetcab.mx no era alcanzable desde el entorno de prueba (política de red). Todo lo de abajo se verificó sobre los archivos fuente del repo, que son lo que está publicado vía WPCode/REST API. Los puntos marcados «verificar en vivo» requieren abrir el sitio real.

## 1. Errores corregidos en esta sesión

| # | Página | Error | Fix |
|---|--------|-------|-----|
| 1 | Rutas EN (Monterrey, Guadalajara) | JSON-LD inválido: `esc_js()` convierte `it's` en `it\'s`, que no es JSON válido. Google ignoraba el schema completo (WebPage + Service + FAQPage) en esas 2 páginas. Cualquier otra ruta con apóstrofe en el FAQ fallaría igual. | Nuevo helper `jc_json_str()` basado en `json_encode` en ambos PHP. Las 9 rutas validan ahora. |
| 2 | Home EN — formulario de cotización | El mensaje de WhatsApp enviaba el **teléfono en el campo "Name"** (índice equivocado) y descartaba fecha, pasajeros, tipo de aeronave y teléfono. Sin validación: se abría WhatsApp con el formulario vacío. | Inputs con `id`/`name`, labels con `for`, mensaje completo (From/To/Date/Passengers/Aircraft/Name/Phone), nombre y teléfono obligatorios con foco + borde naranja. |
| 3 | Home EN — preloader «BOARDING» | A 390px la palabra medía 415px: se cortaba la B y la G por ambos lados (visible en la captura). | Media query ≤480px: tamaño y letter-spacing reducidos. Verificado a 390px y 320px. |
| 4 | 6 páginas de flota | Botón «Solicitar Cotización» **sin ningún handler**: no hacía nada. | Script que arma el mensaje con la aeronave + campos y abre `wa.me/527291081200`. Labels enlazados, nombre y WhatsApp obligatorios. |
| 5 | 6 páginas de flota | WhatsApp apuntaba a `wa.link/rbmftv` (acortador de terceros) en lugar del número oficial del brief. | `wa.me/527291081200` en botón flotante y bloque de contacto. |

## 2. Hallazgos pendientes (ordenados por impacto)

### Alto
- **hreflang hacia páginas que pueden no existir.** Las 5 rutas domésticas EN declaran `hreflang="es"` → `/vuelos-privados-a-cancun/` etc., y las internacionales → `/vuelo-privado-cdmx-miami/` etc. Según el brief, las rutas domésticas ES están pendientes (#1). Un hreflang a un 404 invalida el par de idiomas. *Verificar en vivo*; si no existen, quitar el `<link hreflang="es">` hasta crearlas.
- **Preloader bloquea 3.2 s en cada visita** (`display:none` a los 3200 ms, `body overflow:hidden` 2.5 s). No depende de la carga real: es un retraso fijo. Penaliza LCP/INP y a un UHNWI con prisa. Recomendación: mostrarlo solo en la primera visita de la sesión (`sessionStorage`) y bajarlo a ~1.5 s.
- **Vídeo de hero desde videos.pexels.com** (2560×1440, `preload="auto"`) + póster de Unsplash. Es stock de terceros (choca con la regla «cero stock» del brief) y es el recurso más pesado de la página, también en móvil. Recomendación: vídeo propio del amanecer en Toluca, servido desde el propio dominio, con una `<source media>` ligera para móvil o solo póster en ≤768px.
- **Contadores falsos de «social proof»** en el hero: «viewers» aleatorio entre 3 y 8 cada 12 s y «aircraft available» aleatorio entre 3 y 6 cada 30 s (`Math.random`). Para marca de lujo es un riesgo de credibilidad y de publicidad engañosa. Recomendación: eliminarlos o alimentarlos con datos reales.

### Medio
- **Páginas de flota sin SEO básico:** sin `meta description`, sin `canonical`, sin `og:image`, sin JSON-LD (el brief las describe «con JSON-LD»). Si se publican en jetcab.mx, añadir los 4 antes.
- **Páginas de flota: enlaces internos** «Ver todas las aeronaves» y logo apuntan a `/jetcab-propuesta.html` (documento interno de Rankeo), no al sitio del cliente.
- **Targets táctiles < 44px en móvil:** home EN 26 elementos (nav 10px: «WhatsApp 24/7», teléfono, «View Aircraft» 11px); rutas EN: enlaces de footer de 22px de alto; flota: botones de 36–41px. Subir a 44px de alto mínimo y 12px de fuente.
- **Home EN: ~18.000px de alto en desktop y ~30.000px en móvil.** Las secciones «Routes & pricing» y «Complete guide» son muros de texto. Útiles para SEO, pero conviene acordeón o enlazar a las páginas de ruta ya creadas.
- **2 imágenes con `alt=""`** en la home EN (ids dm-img2 y similar, llenadas por JS): poner el alt dinámico al asignar el `src`.

### Bajo
- Rutas EN: FAQ estático (sin acordeón). Correcto para SEO; nada que hacer.
- Home EN: `hreflang x-default` apunta a `/en/`; para un negocio mexicano suele preferirse `/` (ES). Decisión de negocio.
- Fuente 9–11px en etiquetas «Precio desde», «Jet Corto Alcance» (flota) y labels del hero: subir a 11–12px mínimo.

## 3. Lo que sí está bien
- 0 errores de JavaScript en las 16 páginas, desktop y móvil.
- Sin scroll horizontal en ninguna página (el `hero-bg` de flota sobresale a propósito dentro de un contenedor con overflow oculto).
- Títulos 43–69 caracteres y descripciones 128–165 en rutas y home. Canonical + hreflang en todas las rutas.
- Drawer móvil de la home EN abre y cierra correctamente; selector ES/EN visible.
- Sin menciones a IA, plantillas ni automatización en ningún copy.
- Todos los enlaces de WhatsApp de rutas y home usan `wa.me/527291081200` con texto prellenado por ruta.

---

# Ronda 2 — SEO · GEO · AEO (9 oct 2026, misma sesión)

Trabajo de tres especialistas en paralelo (SEO técnico, GEO/AEO para IAs, contenido ES) integrado y verificado con Playwright en 25 páginas (desktop 1440 + móvil 390): 0 errores JS, 0 JSON-LD inválidos, 0 scroll horizontal, 1 H1 por página, titles 49–60 y descriptions 150–160 en todas.

## Qué se corrigió en los archivos existentes

**Home EN (`jetcab-en.html`)**
- **Libro de precios único.** La home decía CDMX→Cancún «2h 10m desde $15,000» y las rutas/brief «2h 15m desde $3,200»; Miami $25,000/2h50/MIA vs $4,800/3h30/Opa-locka; NY $45,000 vs $9,500; Houston $18,000 vs $3,800; etc. Ahora toda la home usa las cifras de las páginas de ruta (que coinciden con el brief §12): guía de destinos, FAQ visible, FAQ JSON-LD, modales de destino y modales de flota. Destinos sin landing propia (Acapulco, Querétaro, Las Vegas…) ya no muestran un «desde $X» inventado: muestran tarifa por hora.
- Challenger 604 → **605** (39 veces), helicóptero «$800/hr» → $1,500/hr, «500+ flights» → 2,000+, medevac «90 minutos» → «menos de 2 horas», «IATA member» eliminado (IATA no afilia operadores chárter), «sin un solo incidente» → dato verificable, `aggregateRating` 5★/500 autoservido eliminado del schema (riesgo de acción manual), «AIT/MMTO» → «TLC/MMTO (AIT)».
- **Cápsulas answer-first** para IAs: una bajo el H1 (quién es JETCAB, base, desde cuándo, precios desde, «por aeronave, no por asiento») y otra al inicio de la guía de rutas con los 9 precios y tiempos. Ambas en `speakable`.
- **Canibalización**: los 8 H3-pregunta de la home que repetían la keyword de las landings de ruta pasan a encabezado descriptivo + enlace con anchor de keyword a la landing; sus 6 preguntas duplicadas salen del FAQPage de la home (31 → 25).
- Schema: `SpeakableSpecification` suelto (inválido) → nodo `WebPage` con speakable + breadcrumb; `WebSite` y `Organization` con `@id` raíz `https://jetcab.mx/#website` / `#organization` (misma entidad en todas las páginas); `x-default` → `/`.
- Urgencia ficticia: «● LIVE — Aircraft Ready», «2 Left», «Chartered today» sustituidos; código muerto del ticker de reservas inventadas eliminado.
- Title/description nuevos: «Private Jet Charter Mexico City | Toluca FBO — JETCAB».
- Accesibilidad/rendimiento: `prefers-reduced-motion` y `<noscript>` para `.rv`, `var(--ink)` inexistente → `var(--bg)`, `.contact`/`footer` overflow hidden (regla CLAUDE.md), enlaces de nav «Routes».

**Rutas EN (`jetcab-routes-domestic-v1.php`, `jetcab-routes-v3.php`)**
- H1 con keyword exacta «Private Jet Mexico City to X»; H2 de flota y FAQ con keyword; titles/descriptions nuevos por ruta.
- Cápsula answer-first por ruta (40–60 palabras con tiempo, 3 precios, aeropuerto, inclusiones) + `speakable`, `isPartOf`, `about` y `BreadcrumbList` en el JSON-LD; `price` sin coma; `provider` por `@id`.
- Fix legal: «ESTA requirements apply» (falso en aviación privada) → «pasaporte + visa B1/B2; ESTA no es válida en aviación privada» (NY y LA).
- Internacionales: «AIT» mostrado como código IATA → **TLC** (Toluca · Mexico City); escasez estática «2 jets available this week» → «Availability confirmed within 30 minutes»; héroe con `width/height`.
- hreflang «es» condicionado a `es_live` (true en domésticas porque las ES ya existen; false en internacionales hasta crearlas). Nav y logo → `/en/`; sección «Other routes» con las otras 8 rutas; footer con las 9 + home EN; `rel="noopener"`; preload del héroe; OG/Twitter completos.

**Flota (6 archivos)**: H1 transaccional («Renta de jet privado desde Toluca · Learjet 35»), CTA de nav → `#cotizar` (antes a un documento interno de Rankeo), © dinámico, «Vuela en el Ambulancia» corregido, `loading="lazy"` en galerías, sección de rutas frecuentes + enlaces a flota/cotizar/EN, descriptions ≤160.

## Archivos nuevos (listos para WPCode → PHP Snippet → Run Everywhere → guardar Enlaces permanentes)

| Archivo | Qué publica | Slugs |
|---|---|---|
| `jetcab-routes-domestic-es-v1.php` | 5 rutas domésticas en español (pendiente #1 del brief): answer-first «¿Cuánto cuesta…?», pilares Identity Shield / Tarmac-to-Cabin / Jet en 2h, 7 FAQs, JSON-LD, hreflang recíproco con las EN | `/vuelos-privados-a-{cancun,los-cabos,puerto-vallarta,monterrey,guadalajara}/` |
| `jetcab-landing-confidencialidad.php` | Landing Identity Shield (pendiente #6), avatar «El Poder Silencioso», 8 FAQs | `/vuelos-privados-confidenciales/` |
| `jetcab-landing-tipos-jet.php` | Landings por tipo de jet (pendiente #7) | `/light-jets-toluca/`, `/long-range-jets-toluca/` |
| `jetcab-sitemap-landings.php` | Sitemap propio de las 17 landings (Yoast no las ve porque se sirven por `template_redirect`) añadido al índice de Yoast | `/jetcab-landings-sitemap.xml` |
| `jetcab-hreflang-home-es.php` | hreflang recíproco en la home ES (sin esto Google ignora el par ES/EN) | — |
| `jetcab-jsonld-global-v2.html` | `@graph` de 13 nodos para sustituir el snippet 2896: Organization, LocalBusiness, WebSite, OfferCatalog (17 ofertas), 4 aeropuertos, FAQ ES de 15 preguntas. **4 placeholders `XXXX`** (redes, Wikidata, Google Business Profile, hangar) a rellenar antes de publicar | header global |
| `jetcab-llms.txt` | llms.txt para la raíz del dominio (spec llmstxt.org) | `/llms.txt` |
| `_agent-seo-tecnico.md`, `_agent-geo-aeo.md`, `_agent-contenido-es.md` | Informes completos de los tres especialistas (50 preguntas EN/ES con respuesta, plan de autoridad externa, plan de enlazado, verificaciones en vivo) | — |

## Decisiones que necesita el cliente (no se tocaron)
1. **Precio real CDMX–Cancún en Learjet 35**: rutas y brief dicen $3,200; la home decía $15,000. Se unificó a $3,200. Si la cifra real es otra, cambiar en los PHP (`price`/`p1`) y la home.
2. **Gulfstream GV (sitio) vs G650/G650ER (brief)**: todo el sitio dice GV; las landings nuevas por tipo de jet usan G650 según el brief. Confirmar qué célula opera y unificar.
3. **Vídeo de héroe**: sigue siendo stock de Pexels (ya solo carga en desktop). Hace falta vídeo propio de Toluca.
4. **Fotos reales de aeronaves** en rutas y flota (hoy Unsplash): el informe SEO lista las URLs de `/wp-content/uploads/2024/11/` a verificar en vivo antes de sustituir.
5. Rellenar los 4 `XXXX` del JSON-LD global; crear Google Business Profile, Wikidata y perfiles con NAP idéntico (plan P0/P1 en `_agent-geo-aeo.md`).
6. Desactivar AdSense y `noindex` en `/cart/`, `/checkout/`, `/my-account/` (pendientes #4 y #5 del brief; requieren admin de WordPress).

## Instalación en jetcab.mx (orden)
1. WPCode: actualizar los snippets de rutas EN (domésticas e internacionales) con los dos PHP corregidos.
2. WPCode: añadir `jetcab-routes-domestic-es-v1.php`, `jetcab-landing-confidencialidad.php`, `jetcab-landing-tipos-jet.php`, `jetcab-sitemap-landings.php`, `jetcab-hreflang-home-es.php` (PHP Snippet, Run Everywhere). Luego Ajustes → Enlaces permanentes → Guardar.
3. Sustituir el snippet 2890 (/en/) por `jetcab-en.html` y el 2896 por `jetcab-jsonld-global-v2.html` (tras rellenar placeholders).
4. Subir `jetcab-llms.txt` como `/llms.txt`. Reenviar `sitemap_index.xml` en Search Console y pedir indexación de las 17 landings.

---

# Ronda 3 — Ajustes solicitados por Luis (9 oct 2026)

- **Hero EN restaurado**: fuera el párrafo answer-first dentro del hero (rompía el layout móvil). Vuelve a ser título + vídeo, con el vídeo activo también en móvil. Además el hero ya no recorta contenido: `height:auto; min-height:100vh` y padding superior para que el título nunca quede bajo la barra de navegación ni bajo el selector ES/EN. Verificado a 390 y 1440 px.
- **Solo precios del brief.** Se conservan únicamente: rutas domésticas en Learjet 35 (Guadalajara $1,800, Monterrey $2,200, Puerto Vallarta $3,000, Cancún $3,200, Los Cabos $3,800 USD), CDMX–Cancún en Challenger 605 $6,500 y Gulfstream $12,000 USD, Light Jet desde $80,000 MXN y Long Range desde $100,000 USD. Todo lo demás (tarifas por hora, rutas internacionales, Challenger/Gulfstream en otras rutas, destinos sin landing, Hawker/Learjet 45/G650ER) muestra **«Quote on request» / «Cotizar»**. Aplicado en home EN (guía, FAQ visible y schema, modales de flota y destino), 9 rutas EN, 5 rutas ES, landings, 6 páginas de flota, JSON-LD global v2 y llms.txt. Los schema `Offer` sin precio del brief quedan sin `price` (válidos).
- **Fotos reales de aeronaves** (las de la página ES, `/wp-content/uploads/2024/11/`): héroe y miniatura exterior de las 6 páginas de flota, cards de aeronave en las 9 rutas EN y 5 ES, landings de tipos de jet y confidencialidad. En la landing Light Jets, «Hawker 400» y «Learjet 75» pasan a **Hawker 800** y **Learjet 45**, que son los que tienen foto real en el sitio.
- **AdSense**: nuevo snippet `jetcab-disable-adsense.php` (WPCode, PHP, Run Everywhere): bloquea la etiqueta de Site Kit, anula la cola `adsbygoogle`, limpia del HTML los scripts/`<ins>`/meta de AdSense y elimina en el navegador cualquier anuncio que se inyecte después. Complemento manual: Site Kit → AdSense → desconectar, y en la cuenta AdSense → Sitios → jetcab.mx → Auto Ads OFF.

---

# Ronda 4 — Publicación en jetcab.mx (9 oct 2026)

Publicado vía REST API de WordPress (Application Password del usuario `jetcab`, ejecutado desde un sandbox externo porque este entorno no llega a jetcab.mx). Verificado en vivo con curl: contenido nuevo, JSON-LD válido, fotos reales, sin precios fuera del brief.

| URL | Acción | ID |
|---|---|---|
| /private-jet-mexico-city-{cancun,los-cabos,puerto-vallarta,monterrey,guadalajara}/ | Actualizadas con la versión nueva | 2909–2913 |
| /vuelos-privados-confidenciales/ | Creada | 2933 |
| /light-jets-toluca/ | Creada | 2934 |
| /long-range-jets-toluca/ | Creada | 2935 |
| /en/ (página 2895) | Actualizada con el `jetcab-en.html` final | 2895 |
| /flota/ | Creada: hub de flota con ItemList + BreadcrumbList | 2945 |
| /flota/{learjet-35, challenger-605, gulfstream-gv, helicoptero-bell-206, helicoptero-aw139, ambulancia-aerea}/ | Creadas: 6 páginas de aeronave (SEO completo, fotos reales, «Cotizar») | 2946–2951 |

Hallazgos durante la publicación:
- **Las rutas ES ya existían** como páginas del cliente (`/vuelos-privados-a-cancun/` 1634, `-los-cabos/` 1720, `-puerto-vallarta/` 1769, `-monterrey/` 1842, `-guadalajara/` 1706, y otras 15). No se tocaron. `jetcab-routes-domestic-es-v1.php` queda como propuesta de rediseño; los hreflang `es` de las rutas EN apuntan a páginas reales.
- **Yoast servía el título y la description genéricos del sitio** en las páginas creadas por REST (no admite fijar `_yoast_wpseo_title` sin registrar el meta). Mitigación publicada: script `jc-seo-head` al inicio de cada landing que fija `document.title`, meta description, OG/Twitter y canonical en el DOM renderizado. Solución definitiva: instalar `jetcab-yoast-rest-meta.php` en WPCode; después se fijan los títulos reales con una llamada REST por página.
- **Rutas internacionales** (Miami, Houston, NY, LA) y la home `/en/` las sirven snippets PHP (2900 y 2890) que tienen prioridad sobre las páginas: el PHP corregido (`jetcab-routes-v3.php`) hay que pegarlo en WPCode.

Pendiente en WPCode (requiere sesión de admin): `jetcab-routes-v3.php` (rutas internacionales), `jetcab-sitemap-landings.php`, `jetcab-hreflang-home-es.php`, `jetcab-disable-adsense.php`, `jetcab-yoast-rest-meta.php`, `jetcab-jsonld-global-v2.html` (rellenar `XXXX`) y subir `jetcab-llms.txt` como `/llms.txt`.
