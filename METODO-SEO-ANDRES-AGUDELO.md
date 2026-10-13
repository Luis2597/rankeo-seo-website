# Método SEO de Andrés Agudelo (aplicado a JETCAB desde el 12 oct 2026)

Resumen de la sesión de Luis con Andrés Agudelo, especialista SEO. Es la regla de trabajo para jetcab.mx y para cualquier cliente de Rankeo.

## 1. Contexto antes que nada
- Cada sesión empieza con contexto largo y específico: qué es la empresa, años, servicios, mercado, ciudades. Si el contexto ya existe, va en un `.md` (aquí: `HANDOFF-JETCAB.md`, la skill `jetcab-context`, `jetcab-publish/blog/_BRIEF-REDACCION.md`).
- Una sesión por cliente. No mezclar clientes.
- Si algo no se entiende: preguntar a Claude cómo se hace y por qué, paso a paso, antes de pedir que lo haga.

## 2. Sitemap primero
- Lo que no está en el sitemap no se indexa. El sitemap refleja los servicios principales que confirmó el cliente.
- Estado JETCAB: índice de Yoast (posts, páginas) + `jetcab-landings-sitemap.xml` (snippet 9) con las rutas servidas por template_redirect y hreflang ES/EN.

## 3. Skills externas, no conocimiento propio
- Las decisiones se basan en skills de líderes de la industria, buscadas con `find-skills` (`npx skills find <tema>`).
- Instaladas: copywriting, seo-audit, ai-seo (GEO/AEO), schema, site-architecture, content-strategy (coreyhaines31/marketingskills), find-skills (vercel-labs).

## 4. Keyword research con DataForSEO (API, menos de 20 USD por sitio)
- Search Console sirve solo con historial (unos 2 años). Para decidir páginas: DataForSEO con búsquedas reales.
- Regla: volumen mayor a 100 y competencia menor a 35. Si no hay para un servicio, la de más volumen y menos competencia.
- Keyword map: URL, keyword principal (va en el H1), volumen, competencia y 2 o 3 keywords secundarias de apoyo con algo de volumen. Archivo: `jetcab-keyword-map-oct2026.xlsx`.
- SEO focalizado: ciudad o zona antes que país. Cuando hay tráfico y conversión, Google da posiciones en términos grandes.

## 5. Landings y blog posts
- Landing: intención comercial, vender el servicio. Blog post: intención informativa, demostrar conocimiento.
- Primero las landings de los servicios del cliente; después posts de soporte.
- Cada post enlaza con enlaces internos a SU landing (no al home). Las landings muestran sus guías relacionadas (snippet 23).
- Antes de escribir: scrapear con DataForSEO las 3 primeras páginas de Google para la keyword y ver estructura y contenido (`jetcab-competidores-dataforseo-oct2026.md`).
- Redacción con skill de copywriting: sin rayas largas ni señales de texto automático. El cliente revisa que los datos sean reales.
- Cadencia: unos 3 posts y 3 landings por semana. No publicar 100 páginas de golpe.

## 6. Preguntas frecuentes (el «truco»)
- DataForSEO da las preguntas que más se hacen en Google sobre el servicio (Labs + People Also Ask). Se responden con información de la empresa, idealmente una página por pregunta, y en inglés también.
- JETCAB: `/preguntas-frecuentes/` (22) y `/private-jet-faq/` (13); los 33 posts responden una pregunta cada uno.

## 7. E-E-A-T
- Experience, Expertise, Authoritativeness, Trustworthiness. Autor real con experiencia, datos verificables, sin prometer resultados inmediatos.
- Pendiente JETCAB: nombre y cargo del autor real de los posts (Person en el schema y caja de autor).

## 8. Schema markup
- Prioridad: FAQ, Business (Organization/LocalBusiness) y Blog (Article/BlogPosting con autor). Validar, no suponer.
- Nota técnica: Google retiró los resultados enriquecidos de FAQ en mayo de 2026; el FAQPage sigue sirviendo a otros buscadores de IA.

## 9. Medición
- Conectar Search Console y Analytics a Claude (Andrés usa Windsor) y revisar cada dos semanas: qué página se lanzó, cómo va, qué mejorar.
- Google Business Profile es de lo más poderoso para leads locales.

## 10. Negocio (consejos para Rankeo)
- Cobrar el hosting aparte (los deploys cuestan con el tiempo). El dominio lo paga el cliente.
- El SEO es mensual: si se abandona, el ranking se deteriora.
