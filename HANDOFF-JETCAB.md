# Traspaso de sesión: JETCAB (jetcab.mx), 12 oct 2026

Lee esto junto con `CLAUDE.md` y la skill `jetcab-context` antes de tocar jetcab.mx.

## Dónde quedó el trabajo
- Informe vivo y todo lo aplicado: `jetcab-auditoria-seo-geo-aeo-live-oct2026.md` (secciones 1 a 9) y `jetcab-auditoria-playwright-oct2026.md` (fases 1 a 3).
- Código instalado en jetcab.mx como Code Snippets (copias exactas en `jetcab-snippets/`): 5 Yoast REST meta, 6 hreflang, 7 llms.txt, 8 rutas internacionales EN, 9 sitemap landings, 12 JSON-LD global v2, 13 H1 páginas del constructor, 14 footer de enlaces, 15 IndexNow, 16 contenido home y cápsulas de rutas ES, 17 eventos GA4, 18 GA4 en páginas EN, 19 banderas de idioma. Inactivos: 10, 11.
- Páginas publicadas por REST: payloads en `jetcab-publish/` (landings, flota, rutas EN, precios 2959) y `jetcab-publish/blog/` (posts 2960 a 2962 y 2967 a 2970).
- Entregables para el cliente: `jetcab-kit-fichas-directorios.md`, `jetcab-prensa-25-anos.md`, `jetcab-redes-bios-y-resenas.md`.

## Cómo se publica
- WordPress REST con Application Password del usuario `jetcab` (está en la skill `jetcab-context`, no en el repo). Snippets: `/wp-json/code-snippets/v1/snippets`. Meta Yoast editable por REST gracias al snippet 5.
- Cloudflare cachea HTML 31 días: el cambio se ve con `?v=<timestamp>`; la purga real es desde el admin de GoDaddy.
- Google Search Console (`sc-domain:jetcab.mx`) y GA4 (`properties/369436223`, la propiedad «JETCAB»; la «jetcab.mx - GA4» está vacía) se consultaron vía Composio.

## Reglas que el usuario fijó
- Precios: solo los del brief (Learjet 35: GDL $1,800, MTY $2,200, PVR $3,000, CUN $3,200, SJD $3,800 USD; CDMX a Cancún Challenger $6,500 y Gulfstream $12,000; light jet desde $80,000 MXN; long range desde $100,000 USD). Todo lo demás: «Cotizar».
- Fotos de aeronaves: las reales del sitio (`/wp-content/uploads/2024/11/`).
- Hero de `/en/`: solo título y video, sin párrafo.
- Copy con aspecto humano: sin rayas largas, sin listas de tres, sin etiquetas en negrita, sin adjetivos de folleto. Nunca mencionar IA.
- No usar las credenciales de GoDaddy.

## Pendiente
- Usuario: estrella de evento clave en GA4 para `contacto_whatsapp`, `contacto_telefono`, `cotizacion_enviada`; pedir indexación de `/flota/challenger-605/` y `/jet-privado-toluca-vs-aicm/2026/`.
- Cliente: dirección exacta del hangar y Google Business Profile, correo de prensa, bios en redes, reseñas.
- Seguimiento semanal automático los lunes 8:52 (Ciudad de México), routine «JETCAB seguimiento semanal SEO», que escribe en la sesión cloud original.
