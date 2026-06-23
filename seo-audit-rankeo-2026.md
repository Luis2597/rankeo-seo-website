# Auditoría SEO — Rankeo
**Sitio:** rankeo-nu.vercel.app | **Actualizado:** 22 Junio 2026 | **Páginas auditadas:** 19

---

## Executive Summary

Rankeo tiene una base técnica notablemente sólida para un sitio de dos semanas: schema JSON-LD completo en cada página, sitemap.xml con 19 URLs, robots.txt correcto, OG tags, GA4 activo, hreflang, y un diferenciador único (SEO + GEO / ChatGPT) que ningún competidor directo en Colombia ofrece. Sin embargo, hay **tres problemas que bloquean todo el tráfico orgánico hoy**:

1. **Cero indexación en Google** — `site:rankeo-nu.vercel.app` devuelve 0 resultados. El sitio lleva semanas publicado pero Google aún no lo ha rastreado. La causa raíz es que el dominio `rankeo-nu.vercel.app` es un subdominio de prueba de Vercel con baja autoridad inherente.
2. **Sin dominio propio conectado** — rankeo.agency (o el dominio de marca final) no está activo en Vercel. Sin dominio propio, Google trata el sitio como temporal.
3. **Inconsistencia canonical vs. sitemap** — algunas páginas usan URL sin `.html` en su canonical (ej. `/seo-colombia`) pero el sitemap usa `.html`. Esto crea señales duplicadas para Googlebot.

Las tres prioridades son: (1) conectar el dominio de marca en Vercel inmediatamente, (2) normalizar todos los canonicals, y (3) iniciar link building para que Google empiece a rastrear.

---

## Oportunidades de Keywords

| Keyword | Dificultad est. | Oportunidad | Ranking actual | Intención | Formato recomendado |
|---|---|---|---|---|---|
| agencia seo colombia | Alta | Alta | No indexado | Comercial | Landing `/seo-colombia.html` ✅ existe |
| agencia seo bogota | Alta | Alta | No indexado | Comercial | Landing `/seo-bogota.html` ✅ existe |
| agencia seo medellin | Media | Alta | No indexado | Comercial | Landing `/seo-medellin.html` ✅ existe |
| agencia seo cali | Media | Alta | No indexado | Comercial | Landing `/seo-cali.html` ✅ existe |
| agencia seo mexico | Alta | Media | No indexado | Comercial | Landing `/seo-mexico.html` ✅ existe |
| cuanto cuesta seo colombia 2026 | Media | **Muy Alta** | No indexado | Informacional | Blog ✅ existe |
| por que no aparezco en google | Media | **Muy Alta** | No indexado | Informacional | Blog ✅ existe |
| como aparecer en chatgpt | Baja | **Muy Alta** | No indexado | Informacional | Blog ✅ existe x2 |
| seo para dentistas colombia | Baja | **Muy Alta** | No indexado | Comercial | Landing ✅ existe |
| seo para abogados colombia | Baja | **Muy Alta** | No indexado | Comercial | Landing ✅ existe |
| seo para gimnasios colombia | Muy baja | **Muy Alta** | No indexado | Comercial | Landing ✅ existe |
| seo para restaurantes colombia | Baja | Alta | No indexado | Comercial | Landing ✅ existe |
| agencia geo colombia | Muy baja | **Muy Alta** | No indexado | Comercial | Landing ✅ existe |
| generative engine optimization colombia | Muy baja | **Muy Alta** | No indexado | Informacional | Blog ✅ existe |
| auditoria seo gratis colombia | Media | Alta | No indexado | Transaccional | Landing ✅ existe |
| precios agencia seo colombia 2026 | Media | Alta | No indexado | Comercial | Landing ✅ existe |
| posicionamiento web colombia | Alta | Media | No indexado | Comercial | Ampliar `/seo-colombia` |
| seo local colombia | Media | Media | No indexado | Comercial | Sección en home |
| diseno web colombia seo | Media | Media | No indexado | Comercial | Landing — **pendiente** |
| casos de exito agencia seo colombia | Baja | Alta | No indexado | Comercial | Páginas de caso — **pendiente** |
| como elegir agencia seo colombia | Baja | Alta | No indexado | Informacional | Blog post — **pendiente** |
| seo vs sem colombia | Baja | Media | No indexado | Informacional | Blog post — **pendiente** |

---

## Problemas On-Page

| Página | Problema | Severidad | Fix recomendado |
|---|---|---|---|
| Todas | 0 páginas indexadas en Google | **Crítica** | Conectar dominio propio + solicitar indexación en Search Console |
| Sin dominio propio | Sitio vive en subdominio de prueba de Vercel | **Crítica** | Conectar rankeo.agency (o dominio elegido) en Vercel |
| 8 páginas | Canonical sin `.html` (ej. `/seo-colombia`) pero sitemap usa `.html` | **Alta** | Uniformizar: elegir uno (preferible sin extensión) y aplicar en sitemap también |
| 11 páginas | Meta description excede 160 caracteres (rango: 162–172 chars) | **Media** | Recortar a ≤155 chars para evitar truncamiento en SERPs |
| `seo-colombia.html` | Sin año 2026 en title — competidores iaLab usan "2026" como señal de frescura | **Baja** | Cambiar a "Agencia SEO Colombia 2026 \| Posicionamiento Web — Rankeo" |
| Blog | Solo 5 posts — insuficiente para construir autoridad temática en 6 meses | **Alta** | Meta: 2 posts/mes mínimo |
| Todas las landings | Contenido textual estimado: 400–600 palabras vs. competidores con 1,200+ | **Alta** | Ampliar cada landing de ciudad/industria a 800+ palabras de body |
| `index.html` | hreflang: 3 locales apuntan al mismo URL raíz | **Media** | Crear páginas separadas por mercado o simplificar a x-default únicamente |
| Portafolio | "Próximamente" en 4 de 6 casos — señal de sitio nuevo sin credibilidad | **Alta** | Publicar casos reales o mockups convincentes lo antes posible |
| FAQ | Menciona "Plan Crecer" y "Plan Dominar" pero pricing muestra "Web+SEO" y "Autoridad" | **Media** | Uniformizar nombres de planes en todo el sitio |
| Blog posts x2 | Dos posts sobre ChatGPT/GEO con temática similar pueden canibalizar keywords | **Media** | Definir keyword primaria única para cada post, diferenciar ángulo editorial |

---

## Gaps de Contenido

| Tema | Por qué importa | Formato | Prioridad | Esfuerzo |
|---|---|---|---|---|
| Diseño web Colombia | Servicio complementario con alto volumen de búsqueda, 0 cobertura actual | Landing page | **Alta** | Moderado (1 día) |
| Casos de éxito (páginas independientes) | Generan confianza, backlinks naturales y fortalecen E-E-A-T — los competidores los tienen | Páginas de caso | **Alta** | Alto (varios días) |
| "Cómo elegir agencia SEO en Colombia" | Top-of-funnel muy buscado, captura leads en etapa de consideración | Blog post | **Alta** | Moderado (medio día) |
| Landing /seo-hispanos-usa | Mercado hispano de USA sin cobertura específica | Landing page | Media | Moderado (1 día) |
| Glosario SEO Colombia | Genera tráfico informacional pasivo, fortalece autoridad temática (topic cluster) | Página de glosario | Media | Moderado (1 día) |
| "SEO vs. SEM en Colombia" | Keyword comparativa muy buscada por PYMES que no saben cuál elegir | Blog post | Media | Bajo (3 horas) |
| Herramienta: calculadora ROI del SEO | Diferenciador único, muy compartible, genera backlinks | Herramienta interactiva | Baja | Alto (varios días) |

---

## Checklist Técnico

| Verificación | Estado | Detalle |
|---|---|---|
| HTTPS | ✅ Pass | Vercel provee SSL automático |
| Mobile-friendly | ✅ Pass | Viewport declarado, diseño responsive |
| robots.txt | ✅ Pass | Existe, Allow: /, sitemap declarado correctamente |
| Sitemap.xml | ✅ Pass | 19 URLs con lastmod, changefreq, priority — actualizado |
| Canonical tags | ⚠️ Warning | Presentes en todas las páginas pero inconsistentes (algunas con `.html`, otras sin) |
| Schema JSON-LD | ✅ Pass | LocalBusiness + FAQPage + Service + BlogPosting — completo |
| hreflang | ⚠️ Warning | Declarado pero todos los locales apuntan al mismo URL |
| OG tags | ✅ Pass | Completo en todas las páginas, imagen en preview.png (1200×630) |
| Twitter Card | ✅ Pass | summary_large_image en todas las páginas |
| Favicon | ✅ Pass | `<link rel="icon" href="/favicon.ico">` en todas las páginas |
| Google Fonts | ⚠️ Warning | Syne + Plus Jakarta Sans vía CDN — riesgo render-blocking; usar `font-display: swap` |
| GA4 | ✅ Pass | G-JCFGB2YC7G activo en las 19 páginas |
| Search Console | ⚠️ Warning | Verificar que sitemap esté enviado y sin errores de cobertura |
| Páginas indexadas | ❌ Fail | 0 páginas indexadas — dominio nuevo sin autoridad de dominio |
| Internal linking | ⚠️ Warning | Landings de ciudad no se enlazan entre sí; mejorar anchor text |
| Image alt text | ✅ Pass | SVGs con aria-labels, OG image con alt declarado |
| Dominio propio | ❌ Fail | Usando `rankeo-nu.vercel.app` — sin dominio de marca conectado |
| Backlinks | ❌ Fail | Cero backlinks externos — Ahrefs/Semrush darían DR 0 |
| Core Web Vitals (estimado) | ⚠️ Warning | Google Fonts bloqueante + 93KB index.html — probables métricas LCP/CLS por mejorar |
| Velocidad | ⚠️ Warning | preview.png = 275KB — optimizar a WebP <100KB |

---

## Comparación vs. Competidores

| Dimensión | Rankeo | ialab.co | btodigital.com | agenciaseocolombia.com.co | Ganador |
|---|---|---|---|---|---|
| Páginas indexadas | 0 (nuevo) | 200+ | 100+ | 30+ | Competidores |
| Landings de ciudad | 4 (Bogotá, Med, Cali, MX) | 6+ | 3 | 2 | **Rankeo** (con ciudad) |
| Landings de industria | 4 (dent, abog, gym, rest) | 2 | 1 | 1 | **Rankeo** |
| Blog / contenido | 5 posts | 20+ | 10+ | 5 | Empate |
| Schema markup | ✅ Completo | Parcial | Básico | Básico | **Rankeo** |
| Diferenciador GEO/ChatGPT | ✅ Único | No | No | No | **Rankeo** |
| Precio visible y claro | ✅ Desde $199/mes | No | No | No | **Rankeo** |
| Backlinks / autoridad | DR 0 | DR 30+ est. | DR 25+ est. | DR 15+ est. | Competidores |
| Velocidad estimada | Media | Media | Media | Lenta | **Rankeo** (ligero) |
| Dominio de marca | ❌ Subdominio Vercel | ✅ Propio | ✅ Propio | ✅ Propio | Competidores |
| Años de historia | <1 mes | 5+ años | 3+ años | 2+ años | Competidores |

**Conclusión competitiva:** Rankeo tiene el mejor stack técnico y el mejor diferenciador de producto. La brecha crítica es autoridad de dominio (backlinks) y tiempo en el mercado.

---

## Plan de Acción Priorizado

### 🔴 Quick Wins — Esta semana (impacto máximo, mínimo esfuerzo)

| Acción | Impacto | Esfuerzo | Dependencias |
|---|---|---|---|
| **Conectar dominio propio en Vercel** (rankeo.agency u otro) | **Crítico** | 30 min | Acceso al registrador + Vercel dashboard |
| **Normalizar canonicals**: elegir patrón sin `.html` y aplicar en sitemap también | **Alto** | 1 hora | Editar 19 archivos + sitemap.xml |
| **Solicitar indexación** en Google Search Console para las 19 URLs (inspeccionar URL → solicitar) | **Crítico** | 30 min | Search Console activo |
| **Optimizar preview.png** de 275KB → WebP <80KB | Medio | 15 min | squoosh.app o similar |
| **Uniformizar nombres de planes** en FAQ vs. pricing (elegir uno y aplicar en todo el sitio) | Medio | 30 min | Decisión editorial |
| **Recortar meta descriptions** de las 11 páginas que exceden 160 chars | Medio | 45 min | Ninguna |
| **Agregar `display=swap`** al link de Google Fonts para evitar render-blocking | Medio | 10 min | Editar `<head>` en todos los archivos |

### 🟡 Inversiones Estratégicas — Este mes

| Acción | Impacto | Esfuerzo |
|---|---|---|
| **Registrar en 10 directorios de negocios** (Clutch, GoodFirms, Hotfrog Colombia, Páginas Amarillas CO, etc.) — genera primeros backlinks y señales de autoridad | **Crítico para indexación** | 2 horas |
| **Publicar en redes sociales** con links al sitio (LinkedIn, Instagram, Twitter/X) — genera señales sociales y primeros crawls | Alto | Ongoing |
| **Ampliar contenido de landings de ciudad** a 800+ palabras cada una (agregar secciones: zonas que cubre, negocios que atiende, testimonios placeholder) | Alto | 2 días |
| **Landing diseño web Colombia** — servicio complementario sin cobertura | Alto | 1 día |
| **Blog post: "Cómo elegir agencia SEO en Colombia"** — top-of-funnel de alto volumen | Alto | Medio día |
| **Casos de éxito**: aunque el portafolio está en construcción, publicar 2-3 casos con datos reales o proyectados claramente etiquetados | Alto | 1 día |

### 🟢 Inversiones a Largo Plazo — Este trimestre

| Acción | Impacto | Esfuerzo |
|---|---|---|
| Estrategia de backlinks activa: guest posts en blogs de marketing colombianos, mención en medios digitales | **Crítico para rankings** | Ongoing |
| Migrar a Next.js con App Router — sitemap dinámico, `next/font` (elimina render-blocking), mejor LCP | Alto técnico | Semanas |
| Publicar 2 posts SEO/mes hasta llegar a 20 posts — construye autoridad temática | Alto acumulativo | Ongoing |
| Implementar páginas de casos de éxito reales con métricas verificables | Alto para conversión | Por cliente |
| Explorar schema `Review`/`AggregateRating` en homepage cuando se tengan primeras reseñas | Medio (rich results) | 1 hora |

---

## Métricas a monitorear mensualmente

- Páginas indexadas en Google Search Console (objetivo: 19 en <60 días tras conectar dominio)
- Rankings por keyword objetivo (herramienta: Google Search Console gratuito)
- Tráfico orgánico por página (GA4: G-JCFGB2YC7G)
- Core Web Vitals: LCP <2.5s, CLS <0.1, INP <200ms (PageSpeed Insights)
- Backlinks (Ahrefs / Semrush / Google Search Console → Links)

---

*Auditoría SEO Rankeo — Junio 2026 — 19 páginas auditadas*
