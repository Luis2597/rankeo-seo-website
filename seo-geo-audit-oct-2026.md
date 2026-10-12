# Auditoría SEO + GEO — Rankeo (octubre 2026)

**Sitio:** rankeo-nu.vercel.app · **Páginas auditadas:** 33 (index, 3 páginas de ciudad nuevas, 7 landings, 4 industrias, 7 posts, 9 demos, portal) · **Método:** revisión de código + navegador real (Playwright) + búsqueda web para el panorama competitivo. Las herramientas Ahrefs/Similarweb del plugin no conectaron desde el entorno, así que no hay volúmenes de búsqueda exactos.

## Resumen ejecutivo

La base técnica es fuerte y, tras esta ronda, casi todo lo que depende del código está resuelto: metadatos, schema, sitemap, enlaces internos, señales para rastreadores de IA y profundidad de contenido en las páginas más delgadas. **Lo que hoy frena el posicionamiento no está en el código: es el dominio y la autoridad.** `rankeo.agency` no resuelve en DNS, el sitio vive en un subdominio de Vercel y no tiene backlinks. Ningún ajuste on-page compensa eso.

Prioridades, en orden:
1. ~~Conectar `rankeo.agency`~~ **Hecho el 11 oct 2026**: dominio válido en Vercel y canonicals, sitemap, robots, llms.txt y schema migrados a `rankeo.agency`.
2. Verificar el sitio en Google Search Console (meta de verificación o registro DNS), enviar el sitemap y pedir indexación de las 23 URLs.
3. Conseguir las primeras 10 a 15 menciones externas: directorios (Clutch, GoodFirms, Sortlist, directorio de agencias de SE Ranking y Semrush), perfil de LinkedIn e Instagram enlazando al sitio, y un primer artículo invitado.

## Lo corregido en esta ronda (en el código)

| Área | Hallazgo | Acción |
|---|---|---|
| Enlazado interno | La portada no enlazaba a ninguna landing ni al blog (toda la autoridad se quedaba en el index) | Mapa de enlaces en el footer: 6 ciudades, 4 industrias, GEO y recursos |
| Redirecciones | 212 enlaces internos usaban `.html`; con `cleanUrls` cada clic pasaba por un 308 | Todos los enlaces internos en URL limpia; `og:url` igualado al canonical |
| Sitemap | 3 páginas de ciudad con hreflang apuntando a la portada; `lastmod` de junio | Corregido y fechado; añadido el post nuevo |
| Rastreadores IA | `robots.txt` sin mención a bots de IA | Permiso explícito a GPTBot, OAI-SearchBot, ChatGPT-User, ClaudeBot, PerplexityBot, Google-Extended y Applebot-Extended; referencia a `llms.txt` |
| Entidad de marca | Sin `Organization` ni `WebSite` en la portada; sin `sameAs` | Añadidos con logo, áreas servidas, `knowsAbout`, Instagram y LinkedIn, y `SearchAction` hacia la auditoría |
| Blog | `BlogPosting` sin imagen, sin `mainEntityOfPage`, `dateModified` de junio | Completado en los 6 posts |
| FAQ sin schema | Precios y 3 páginas de ciudad tenían acordeones sin `FAQPage` | Schema generado a partir del contenido real |
| Contenido delgado | Auditoría gratis: 401 palabras | Sección "Cómo leer tu reporte" + 4 preguntas frecuentes con schema |
| Landings de ciudad | Sin preguntas frecuentes (Bogotá, Medellín, Cali, México) | 4 preguntas por ciudad con precios, plazos y zonas reales + `FAQPage` |
| Hueco de contenido | "Cómo elegir agencia SEO en Colombia" (alta oportunidad, baja dificultad) | Post nuevo de 1.300 palabras enlazado desde blog, portada, posts relacionados y `llms.txt` |

En la ronda anterior (9 oct): 21 títulos a ≤60 caracteres, 3 descriptions rotas, BreadcrumbList en 22 páginas, FAQPage en industrias, favicon, demos ficticias con `noindex`, dominio canónico unificado, `llms.txt`.

## Oportunidades de keywords

| Keyword | Dificultad | Oportunidad | Intención | Dónde |
|---|---|---|---|---|
| agencia seo colombia | Alta (NP Digital, Awisee, AMD, iaLab en el top) | Media | Comercial | /seo-colombia |
| agencia seo bogotá | Alta | Media | Comercial | /agencia-seo-bogota |
| agencia seo medellín / cali | Media | Alta | Comercial | /agencia-seo-medellin, /seo-cali |
| agencia geo colombia | Muy baja (solo Cangrejo Digital compite con página dedicada) | **Muy alta** | Comercial | /geo-colombia |
| cómo aparecer en chatgpt con mi empresa | Baja | **Muy alta** | Informacional | 2 posts existentes |
| qué es geo generative engine optimization | Baja | **Muy alta** | Informacional | post existente |
| cómo elegir agencia seo colombia | Baja | **Muy alta** | Informacional | post nuevo |
| cuánto cuesta el seo en colombia 2026 | Media | **Muy alta** | Informacional | post existente |
| seo para dentistas / abogados / gimnasios / restaurantes colombia | Baja | **Muy alta** | Comercial | landings existentes |
| auditoría seo gratis colombia | Media | Alta | Transaccional | /auditoria-seo-gratis |
| precios agencia seo colombia | Media | Alta | Comercial | /precios |
| diseño web colombia seo | Media | Media | Comercial | **pendiente** (landing) |
| seo para clínicas / hoteles colombia | Baja | Alta | Comercial | **pendiente** (2 landings de industria) |
| seo vs sem colombia | Baja | Media | Informacional | **pendiente** (post) |

## Competidores observados en las búsquedas

| Dimensión | Rankeo | NP Digital / AMD / Awisee | Cangrejo Digital (GEO) |
|---|---|---|---|
| Páginas por ciudad e industria | 6 ciudades + 4 industrias | 2 a 6 ciudades, 1 a 2 industrias | 1 |
| Página dedicada a GEO | Sí | No | Sí (se declara pionera) |
| Precios públicos | Sí, desde $199 USD/mes | No | No |
| Schema (Organization, FAQ, Breadcrumb, Service) | Completo | Parcial | Parcial |
| Dominio propio y backlinks | **No** | Sí, autoridad alta | Sí |
| Años en el mercado | Meses | 5 a 15 años | 13 años |

Rankeo gana en estructura, claridad de oferta y cobertura de GEO. Pierde en autoridad y antigüedad, que solo se construyen con dominio propio, menciones y tiempo.

## Pendiente que no se puede hacer desde el código

1. **Dominio**: añadir `rankeo.agency` al proyecto en Vercel y crear los registros DNS en el registrador.
2. **Search Console**: verificar propiedad (meta tag o TXT en DNS), enviar `sitemap.xml`, inspeccionar y pedir indexación de cada URL.
3. **Perfil de empresa en Google** (Google Business Profile) para Rankeo, con el mismo nombre, teléfono y sitio.
4. **Backlinks iniciales**: directorios de agencias, LinkedIn de empresa, Instagram, un artículo invitado en un blog de marketing colombiano.
5. **Casos de éxito reales** con cifras verificables: hoy el portafolio muestra demos ficticias con `noindex`.
6. **Contenido nuevo**: 2 posts al mes; siguientes temas: "SEO vs SEM en Colombia", "Cuánto tarda el SEO", landing "Diseño web Colombia", landings de clínicas y hoteles.

## Métricas a seguir cada mes

Páginas indexadas en Search Console (objetivo: 23 en 60 días tras conectar el dominio) · posiciones de las keywords de arriba · tráfico orgánico por página en GA4 · menciones en ChatGPT y Perplexity con prompts de prueba ("agencia SEO en Bogotá", "cómo aparecer en ChatGPT") · backlinks nuevos.
