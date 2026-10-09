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
