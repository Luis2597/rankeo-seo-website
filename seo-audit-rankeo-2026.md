# Auditoría SEO — Rankeo
**Sitio:** rankeo-nu.vercel.app | **Fecha:** Junio 2026

---

## Executive Summary

Rankeo tiene una base técnica sólida — schema markup completo, hreflang, meta tags en todas las páginas, GA4 activo, y un diferenciador único (SEO + GEO / ChatGPT) que ningún competidor directo tiene. Sin embargo, hay **un problema crítico que bloquea toda la indexación:** el dominio activo (`rankeo-nu.vercel.app`) y el dominio de marca (`rankeo.agency`) están desconectados — todos los canonicals, el sitemap y las OG tags apuntan al dominio equivocado. Adicionalmente, el sitemap aún apunta a una URL vieja de Netlify. Mientras esto no se corrija, Google no indexará el sitio correctamente. Las tres prioridades son: (1) conectar `rankeo.agency` como dominio principal en Vercel, (2) regenerar el sitemap con las 13 URLs reales, y (3) ampliar el contenido de las landings y el blog para competir contra iaLab y otros establecidos.

---

## Oportunidades de Keywords

| Keyword | Dificultad est. | Oportunidad | Ranking actual | Intención | Formato recomendado |
|---|---|---|---|---|---|
| agencia seo colombia | Alta | Alta | No indexado | Comercial | Landing `/seo-colombia` ✅ existe |
| agencia seo bogota | Alta | Alta | No indexado | Comercial | Landing `/seo-bogota` ✅ existe |
| cuanto cuesta seo colombia | Media | **Muy Alta** | No indexado | Informacional | Blog ✅ existe |
| agencia seo medellin | Media | Alta | No indexado | Comercial | Landing — pendiente |
| posicionamiento web colombia | Alta | Media | No indexado | Comercial | Ampliar `/seo-colombia` |
| seo para dentistas colombia | Baja | **Muy Alta** | No indexado | Comercial | Landing ✅ existe |
| seo para restaurantes colombia | Baja | Alta | No indexado | Comercial | Landing ✅ existe |
| seo para abogados colombia | Baja | Alta | No indexado | Comercial | Landing — pendiente |
| seo para gimnasios colombia | Muy baja | **Muy Alta** | No indexado | Comercial | Landing — pendiente |
| agencia geo colombia | Muy baja | **Muy Alta** | No indexado | Comercial | Landing ✅ existe |
| aparecer en chatgpt con mi empresa | Muy baja | **Muy Alta** | No indexado | Informacional | Blog ✅ existe |
| que es geo seo | Baja | Alta | No indexado | Informacional | Blog ✅ existe |
| auditoria seo gratis colombia | Media | Alta | No indexado | Transaccional | Landing ✅ existe |
| agencia seo mexico | Alta | Media | No indexado | Comercial | Landing ✅ existe |
| precios agencia seo colombia 2026 | Media | Alta | No indexado | Comercial | Landing ✅ existe |
| seo local colombia | Media | Media | No indexado | Comercial | Sección en `/seo-colombia` |
| por que no aparezco en google | Baja | **Muy Alta** | No indexado | Informacional | Blog — pendiente |
| agencia seo cali | Media | Alta | No indexado | Comercial | Landing — pendiente |
| diseno web colombia seo | Media | Media | No indexado | Comercial | Landing — pendiente |
| seo para clinicas dentales | Baja | Alta | No indexado | Comercial | Ampliar `/seo-para-dentistas` |

---

## Problemas On-Page

| Página | Problema | Severidad | Fix recomendado |
|---|---|---|---|
| Todas (13 páginas) | Canonical apunta a `rankeo.agency` pero el sitio live es `rankeo-nu.vercel.app` | **Crítica** | Conectar dominio rankeo.agency en Vercel o cambiar canonicals al dominio activo |
| `sitemap.xml` | URLs apuntan a `cosmic-banoffee-d624f3.netlify.app` (URL vieja de Netlify) | **Crítica** | Reemplazar todas las URLs con el dominio correcto; además solo tiene 1 URL en lugar de 13 |
| Todas | `og:image` apunta a `rankeo.agency/og-image.png` — archivo no existe en el dominio activo | **Alta** | Subir `og-image.png` al repo |
| `seo-colombia.html` y otras landings | `<link rel="stylesheet" href="/style.css"/>` — el archivo no existe en el repo | **Alta** | Crear `style.css` compartido o eliminar la referencia |
| `index.html` | Title no incluye "Colombia" ni "agencia SEO" — keyword principal ausente | **Alta** | Cambiar a: "Agencia SEO Colombia, México y USA — Rankeo" |
| `index.html` | Meta description tiene 194 caracteres (límite: 150–160) | **Media** | Recortar a máximo 160 caracteres |
| `seo-colombia.html` | Title bien estructurado pero sin año "2026" que competidores usan | **Baja** | Añadir "2026" para capturar búsquedas con año |
| Blog | Solo 3 posts — insuficiente para construir autoridad temática | **Alta** | Publicar mínimo 2 posts/mes |
| Todas las landings | Contenido muy corto (168–356 líneas HTML incluyendo nav/footer) vs. competidores | **Alta** | Ampliar cada landing a 800+ palabras de cuerpo textual |
| `index.html` | hreflang tiene 3 locales (es-CO, es-MX, es-US) apuntando a la misma URL | **Media** | Crear páginas separadas por mercado o usar solo x-default |
| Todas | No hay favicon declarado en el `<head>` | **Baja** | Añadir `<link rel="icon" href="/favicon.ico">` |
| Todas | Las landings no se enlazan entre sí (sin links internos cruzados) | **Media** | Añadir links entre páginas relacionadas con anchor text descriptivo |

---

## Gaps de Contenido

| Tema | Por qué importa | Formato | Prioridad | Esfuerzo |
|---|---|---|---|---|
| "Por qué no aparezco en Google" | Keyword informacional de alto volumen, intención perfecta para captar clientes | Blog post | **Alta** | Moderado (1 día) |
| Landing Medellín | iaLab y competidores rankean fuerte para "agencia seo medellin" | Landing page | **Alta** | Bajo (3 horas) |
| Landing Cali | Segunda ciudad de Colombia sin cobertura | Landing page | **Alta** | Bajo (3 horas) |
| SEO para abogados | Nicho de baja competencia y alta conversión | Landing page | Media | Bajo (3 horas) |
| SEO para gimnasios | Muy baja competencia, fácil de rankear | Landing page | Media | Bajo (3 horas) |
| Diseño web Colombia | Servicio complementario con buen volumen, sin página actual | Landing page | Media | Moderado (1 día) |
| Casos de éxito como páginas independientes | Generan backlinks naturales y fortalecen E-E-A-T | Páginas de caso | Alta | Alto (varios días) |
| "Cómo elegir agencia SEO en Colombia" | Top-of-funnel, alta demanda, captura leads en etapa de consideración | Blog post | Alta | Moderado (1 día) |
| Comparativa "SEO vs. SEM en Colombia" | Muy buscado, posiciona a Rankeo como experto | Blog post | Media | Moderado (1 día) |

---

## Checklist Técnico

| Verificación | Estado | Detalle |
|---|---|---|
| HTTPS | ✅ Pass | Vercel provee SSL automático |
| Mobile-friendly | ✅ Pass | Viewport declarado, fix H1 mobile aplicado, `overflow-x: hidden` |
| Canonical tags | ❌ Fail | Apuntan a `rankeo.agency`, no al dominio activo |
| Sitemap | ❌ Fail | URLs de Netlify, solo 1 URL, no refleja las 13 páginas del sitio |
| robots.txt | ⚠️ Warning | No encontrado en el repo — Vercel sirve default, verificar que no bloquee rastreo |
| Schema JSON-LD | ✅ Pass | LocalBusiness + FAQPage + Service schemas en index.html |
| hreflang | ⚠️ Warning | Declarado pero todos los locales apuntan al mismo URL |
| OG image | ❌ Fail | URL apunta a dominio inexistente (`rankeo.agency`) |
| Google Fonts | ⚠️ Warning | Cargando sin `font-display: swap` — riesgo de render-blocking |
| Favicon | ❌ Fail | No declarado en `<head>` |
| GA4 | ✅ Pass | G-JCFGB2YC7G activo en los 13 archivos HTML |
| Search Console | ✅ Pass | Propiedad verificada vía Google Analytics, sitemap enviado |
| Páginas indexadas | ❌ Fail | 0 páginas indexadas — dominio nuevo + canonical mismatch |
| Internal linking | ⚠️ Warning | Las landings no se enlazan entre sí |
| Image alt text | ✅ Pass | SVGs con aria-labels, imágenes con alt declarado |
| FAQPage schema | ✅ Pass | 8 preguntas — apto para rich results en Google |

---

## Comparación vs. Competidores

| Dimensión | Rankeo | ialab.co | agenciaseoencolombia.com.co | Ganador |
|---|---|---|---|---|
| Páginas indexadas | 0 (nuevo) | 100+ | 20+ | Competidores |
| Páginas de ciudad | 2 (Bogotá, MX) | 6+ (Bogotá, Medellín, Cali…) | 3 | Competidores |
| Blog / contenido | 3 posts | 15+ artículos | 5+ | Competidores |
| Schema markup | ✅ Completo | Parcial | Básico | **Rankeo** |
| Diferenciador GEO / ChatGPT | ✅ Único en el mercado | No | No | **Rankeo** |
| Precio visible y claro | ✅ Desde $199/mes | No | No | **Rankeo** |
| Backlinks / autoridad de dominio | Ninguno | Establecida | Establecida | Competidores |
| Velocidad estimada | Media | Media | Media | Empate |

---

## Plan de Acción Priorizado

### Quick Wins — Esta semana

| Acción | Impacto | Esfuerzo | Dependencias |
|---|---|---|---|
| Conectar `rankeo.agency` como dominio en Vercel (DNS + dashboard) | **Crítico** | 30 min | Acceso al registrador de dominios |
| Regenerar `sitemap.xml` con las 13 URLs reales del sitio | **Crítico** | 20 min | Ninguna |
| Agregar `robots.txt` explícito al repo | Alto | 5 min | Ninguna |
| Subir `og-image.png` al repo | Medio | 10 min | Diseño de imagen (1200×630px) |
| Cambiar title del home a "Agencia SEO Colombia, México y USA — Rankeo" | Alto | 5 min | Ninguna |
| Recortar meta description del home a ≤160 caracteres | Medio | 5 min | Ninguna |
| Añadir favicon en `<head>` de todos los archivos | Bajo | 15 min | Ninguna |
| Agregar links internos entre landings | Medio | 1 hora | Ninguna |
| Crear `style.css` compartido para las landing pages | Alto | 2 horas | Ninguna |

### Inversiones Estratégicas — Este Trimestre

| Acción | Impacto | Esfuerzo |
|---|---|---|
| Construir landings de Medellín y Cali | Alto | 1 día |
| Ampliar contenido de todas las landings a 800+ palabras reales | Alto | 3 días |
| Publicar "Por qué no aparezco en Google" (blog post) | Alto | 1 día |
| Publicar "Cómo elegir agencia SEO en Colombia" (blog post) | Alto | 1 día |
| Construir landings de abogados y gimnasios | Medio | 1 día |
| Iniciar estrategia de backlinks (directorios + guest posts) | Crítico a largo plazo | Ongoing |
| Migrar a Next.js (elimina Google Fonts render-blocking, sitemap dinámico) | Alto técnico | Semanas |

---

*Auditoría generada con Rankeo SEO Audit Skill — Junio 2026*
