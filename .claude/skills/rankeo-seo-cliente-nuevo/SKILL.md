---
name: rankeo-seo-cliente-nuevo
description: Proyecto SEO + GEO completo de Rankeo para un cliente (método Andrés Agudelo con DataForSEO), de la investigación de keywords a los reportes, en 8 fases con reglas SEO obligatorias. Úsalo cuando el usuario pida "empezar un cliente nuevo", "proyecto SEO para [cliente]", "aplica el método a [cliente]", "haz el SEO completo de [dominio]" o retome cualquier fase (keywords, landings, blog, schema, indexación, reportes) de un cliente de Rankeo.
argument-hint: "[cliente] [dominio] — o déjalo vacío y te pregunto los datos"
---

# Proyecto SEO + GEO de Rankeo para un cliente

Eres el equipo SEO + GEO de Rankeo trabajando para el cliente.

## 0. Datos del cliente (rellenar antes de empezar)

Si faltan datos en los argumentos o en la skill de contexto del cliente (`<cliente>-context`), pídelos **en un solo mensaje** y no empieces la Fase 1 sin ellos:

| Campo | Ejemplo (JETCAB) |
|---|---|
| Cliente y dominio | JETCAB · jetcab.mx |
| Giro o industria | Renta de jets privados y helicópteros |
| Mercado: país y ciudades | México (CDMX, Toluca, GDL, MTY) |
| Segundo idioma y país, si aplica | Inglés · EE. UU. |
| Servicio prioritario | Renta de jet privado |
| Servicios secundarios (siempre con venta cruzada hacia el principal) | Helicópteros, ambulancia aérea |
| Búsqueda nacional para el inicio | «renta de jet privado en México» |
| Fecha de la medición a 20 días | 2 nov |
| Login y password de DataForSEO | Los da el usuario en el chat. **NUNCA se guardan en el repo ni en la memoria.** |

**REGLA ABSOLUTA:** nada de cara al cliente menciona IA, automatización ni plantillas. Todo debe sonar a una agencia humana de primer nivel.

## Antes de empezar

- Lee el `CLAUDE.md` del proyecto y la skill de contexto del cliente, si existe. Revisa la memoria del proyecto para ver pendientes y decisiones anteriores.
- Skills de apoyo: `seo-audit`, `ai-seo`, `schema`, `copywriting`, `content-strategy`, `site-architecture`, `find-skills`, `qa-visual` (Playwright), `humanizer`, `claude-in-chrome` y `reporte-cliente` (Fase 8).
- **Método Andrés Agudelo:** cada decisión se respalda con datos reales de DataForSEO, nunca con suposiciones.
- Si el proyecto ya está avanzado, identifica en qué fase va (git log, memoria, último reporte) y continúa desde ahí. No rehagas fases terminadas.

## REGLAS SEO (obligatorias en todo el proyecto)

1. **Selección de keywords**
   - Criterio: volumen mensual > 100 **y** competencia < 35.
   - Si ninguna keyword del tema cumple, elige la de mayor volumen con la menor competencia disponible. Documenta cuál se eligió y por qué.
2. **Jerarquía en cada página**
   - Keyword principal = H1, y base del title y de la meta description.
   - De 2 a 4 keywords secundarias y semánticas por página, en H2, intro, alt de imágenes y texto. Nunca repitas la principal de otra página (sin canibalización).
3. **Dos tipos de página**
   - a) **Landing pages (comerciales):** donde el cliente obtiene el servicio. Llevan llamados a la acción visibles (WhatsApp, cotizar, llamar), precios o tabla de precios, beneficios, prueba de confianza y FAQ. Se construyen **primero**, en orden de prioridad de los servicios que más quiere vender el cliente.
   - b) **Páginas secundarias (posts, guías):** demuestran conocimiento y autoridad. Cada una enlaza a **su** landing, no al inicio. El **cliente** revisa cada artículo antes de publicarse para asegurar que los datos sean correctos; lo que no se sepa se marca «por confirmar».
4. **Blog con datos**
   - Con DataForSEO, scrapea los posts mejor posicionados del tema (top 3 a 10): estructura, H2, número de palabras, preguntas que responden y huecos que no cubren.
   - Cada post supera al top 3 en profundidad (normalmente de 1,300 a 1,700 palabras y de 13 a 17 preguntas reales) y aporta datos propios del cliente.
5. **Preguntas frecuentes de Google**
   - Con DataForSEO, extrae por cada keyword las preguntas reales de Google («People also ask» / «Otras preguntas de los usuarios»).
   - Crea una **página individual** de preguntas frecuentes con esta estructura:
     1. La **pregunta** como encabezado, tal como la escribe la gente.
     2. La respuesta directa en 1 a 2 frases.
     3. El detalle e información relacionada de la empresa (precios, procesos, ubicación, contacto).
     4. Un enlace a la landing que corresponde.
   - Marcado FAQPage solo con las preguntas visibles en esa página. Una versión por idioma.

## Fase 1 · Datos

1. Keyword research en el país principal (y en el segundo, en su idioma) aplicando las Reglas SEO.
2. Posición actual del dominio en cada keyword: es la línea base y lleva fecha.
3. Top 3 competidores por keyword: tráfico orgánico estimado, keywords en top 10, páginas que les traen tráfico, palabras y preguntas por página.
4. Preguntas reales de Google por keyword.
5. Entregables:
   - tabla de keywords (keyword, volumen, competencia, posición hoy, URL asignada, tipo landing o post);
   - tabla de competidores;
   - un Excel con el mismo formato.

## Fase 2 · Mapa de keywords y arquitectura

- Una keyword principal por URL. Primero las landings, después los posts.
- El inicio y las páginas amplias apuntan a la búsqueda nacional (servicio en el país), salvo que el usuario indique otra cosa.
- Menú con Precios, Servicios o Destinos, Preguntas frecuentes y Blog. Página índice de servicios o destinos. Footer con enlaces internos.

## Fase 3 · Landings y páginas por servicio, ciudad o destino

- Una sola plantilla consistente para todas: `build.py` + `data/<id>.json` (+ `data_es/`), con el mismo orden de secciones.
- Cada página lleva:
  - más palabras que el top 3 (unas 1,500 a 1,600);
  - precio real;
  - de 9 a 12 fotos verificadas visualmente, sin stock genérico;
  - proceso o recorrido;
  - FAQ con preguntas reales;
  - CTA.
- Los textos sobre fotos deben ser legibles en el celular. Los puntos de partida van en genérico («su casa u oficina»); las zonas concretas van en las FAQ.
- Datos desconocidos: no se inventan, se juntan en una lista para el cliente.

## Fase 4 · Blog

- Unos 30 posts sacados de las preguntas reales y del scraping de la Regla 4, cada uno con FAQPage y enlazado a su landing.
- Cadencia: 3 por semana (lunes, miércoles y viernes a las 9:00 hora local), primero los del servicio prioritario. **NUNCA publicar en masa sin una orden explícita.** Si el usuario dice que «no aparecen», arregla la visibilidad (página del blog, menú, caché), no el calendario.
- Autor real con cargo (E-E-A-T), fecha visible y revisión del cliente antes de la fecha de salida.

## Fase 5 · Técnico, schema y GEO

- JSON-LD:
  - Organization/LocalBusiness alineado con el perfil de Google: dirección, coordenadas, horario, sameAs y hasMap;
  - Service con offers;
  - FAQPage solo con preguntas visibles;
  - BreadcrumbList con `item` en **todos** los elementos;
  - **nunca** Product sin offers, review o aggregateRating.
- Hreflang por pares. **Sin redirección automática por idioma ni por cookie.** El botón de idioma lleva a una URL propia (`/?lang=xx`).
- `llms.txt`, `pricing.md`, sitemap limpio y `robots.txt` con el sitemap.
- Velocidad: video e imágenes responsivos, fuentes que no bloquean y fuera los plugins sin uso. **Pregunta antes de quitar trackers o la tienda.**
- Si el CDN cachea HTML por semanas, usa versión del sitio + recarga automática, y purga la caché después de cada cambio importante.

## Fase 6 · QA antes de cada push

- `/qa-visual` en escritorio y en 390×844. Revisa:
  - overflow;
  - espacio blanco al final;
  - menú móvil;
  - touch targets ≥ 44 px;
  - consola limpia;
  - ambos idiomas y los CTA probados.
- Lighthouse móvil: SEO 100 y Performance ≥ 90 en las landings.

## Fase 7 · Google

- Search Console (en el Chrome del usuario, con `claude-in-chrome`; los navegadores de wmux y Playwright no tienen su sesión):
  - enviar los sitemaps;
  - pedir indexación de unas 10 URLs al día, inspeccionando antes y saltando las que ya están indexadas, primero las landings del servicio prioritario;
  - revisar Mejoras, corregir, purgar la caché y «Validar corrección».
- Perfil de Google: categoría principal, descripción y servicios (con el texto listo).

## Fase 8 · Reportes

- Línea base el día 0 y medición a los 20 días con DataForSEO + Search Console, en la fecha acordada.
- Reporte #N en HTML con el mismo diseño, siguiendo la skill `reporte-cliente`. Incluye:
  - resultados contra el periodo anterior;
  - antes y después;
  - hallazgos;
  - lo que hicimos;
  - velocidad;
  - calendario;
  - «Lo que necesitamos del cliente».
- Publícalo y agrégalo al portal `clientes.html`: reporte, notificación, actividad y métricas.
- Al cerrar cada sesión, deja los pendientes en la memoria y los commits en español.
