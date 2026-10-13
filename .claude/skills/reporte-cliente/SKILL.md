---
name: reporte-cliente
description: Arma el siguiente reporte de avance para un cliente de Rankeo (JETCAB primero) y lo publica en dos lugares, como página para compartir (jetcab-reporte<N>.html) y en el portal clientes.html. Úsalo cuando el usuario pida "haz el reporte", "el siguiente reporte", "reporte para el cliente", "actualiza el portal con lo que hicimos" o "qué hicimos desde el último reporte".
---

# Reporte de avance para el cliente

Un reporte retoma donde se quedó el anterior, presenta solo datos verificados y deja claro lo que el cliente tiene que hacer. Va en dos lugares a la vez: la página para compartir y el portal.

**Regla absoluta (CLAUDE.md §1):** el cliente nunca debe saber que el trabajo se hace con IA. No se nombra ninguna herramienta interna (Claude, Playwright, agentes, skills, «automatización»). Sí se pueden nombrar las herramientas de Google: Search Console, Lighthouse, PageSpeed y Analytics.

## 1. Dónde quedó el último reporte

1. En `clientes.html`, dentro de `CLIENTS.<cliente>.reports`, el último elemento da el número, la fecha y la URL del reporte anterior.
2. Lee ese reporte completo (`jetcab-reporte<N-1>.html`) para saber qué ya se le contó al cliente. No repitas logros de ese reporte salvo en los resultados.
3. Saca el alcance desde git: `git log --reverse --date=format:'%d %H:%M' --format='%ad %h %s' <commit del reporte anterior>..HEAD`. El commit del reporte anterior se encuentra con `git log --format='%h %s' -- jetcab-reporte<N-1>.html`. Agrupa los commits por tema y no los presentes uno por uno.
4. Revisa la memoria del proyecto (pendientes del cliente) para la sección «Lo que necesitamos».

## 2. Datos de resultados (solo reales, nunca estimados como si fueran medidos)

**Search Console.** Se usa en el Chrome del usuario con Claude in Chrome, que tiene la sesión de Google. Los navegadores de wmux y Playwright no la tienen.
- Abre el rendimiento comparado de dos semanas: `https://search.google.com/search-console/performance/search-analytics?resource_id=sc-domain%3Ajetcab.mx&start_date=AAAAMMDD&end_date=AAAAMMDD&compare_start_date=…&compare_end_date=…&metrics=CLICKS%2CIMPRESSIONS%2CPOSITION`. Para ver las páginas, agrega `&breakdown=page`. Lee los datos con `get_page_text`.
- Los datos llegan con 2 a 3 días de retraso. Dilo en el reporte cuando los cambios recientes todavía no aparezcan.
- Muestra apariciones, clics, posición media y CTR (con antes y después), las búsquedas que más mejoran y las páginas que más crecen.

**Velocidad.** Usa primero la API de PageSpeed (`strategy=mobile`). Si responde «Quota exceeded», corre Lighthouse en local:
`npx -y lighthouse@12.2.1 <url> --quiet --chrome-flags="--headless=new" --only-categories=performance,seo,accessibility,best-practices --output=json --output-path=<scratchpad>/lh-<id>.json`.
Reporta también las páginas que salen mal, cada una con su siguiente paso.

**Estado del blog.** Con la REST de WordPress (credenciales en la skill `jetcab-context`): `posts?status=publish` y `posts?status=future` con `_fields=date,title`. De ahí salen los publicados y el calendario siguiente.

**Indexación.** Usa lo que quedó anotado en la memoria y en Search Console.

## 3. Página para compartir: `jetcab-reporte<N>.html`

- Copia el `<style>` del reporte anterior sin cambios (Syne + Plus Jakarta Sans y los tokens de Rankeo). Agrega solo las clases nuevas que haga falta, como `.kpi-grid`, y su ajuste para móvil.
- Pon `<meta name="robots" content="noindex,nofollow">`, `lang="es-MX"` y trata al cliente de «usted».
- Orden de secciones:
  1. Héroe: el resultado más fuerte como titular y 4 cifras.
  2. Resultados en Google: KPIs y tablas.
  3. Antes vs. Después.
  4. Hallazgos.
  5. Lo que hicimos: tarjetas con su impacto.
  6. Velocidad.
  7. Próximos artículos.
  8. Lo que necesitamos del cliente: prioridad y tiempo estimado.
  9. Próxima medición.
  10. CTA de WhatsApp `525532894890` con el texto «Reporte #N».
- Cuenta los hallazgos propios como lo que se encontró y se corrigió, sin culpas ni tecnicismos.
- Antes de publicar, revisa cada cifra contra su fuente: conteos de artículos, fechas y «probado en…». Si algo no se pudo confirmar (por ejemplo, una prueba en el teléfono del cliente), no lo afirmes.
- No escribas precios, tiempos ni capacidades pendientes de confirmar como si fueran ciertos; ponlos en «Lo que necesitamos».
- Al terminar, confirma que el archivo cierra con `</html>`, porque el Write tool puede truncar archivos grandes (CLAUDE.md §2B).

## 4. Portal `clientes.html`

Edítalo con un script de Python que respete el fin de línea del archivo (`newline=''`) y que use reemplazos con `assert count == 1`:

1. En `reports`, agrega `{title, date, url:"https://rankeo.agency/jetcab-reporte<N>.html", desc}` al final.
2. En `notificaciones`, agrega al inicio `{id:"n<k+1>", fecha, hora, icono, titulo, mensaje, leido:false}`. El mensaje da el resultado principal y dice que al final del reporte están los datos que se necesitan del cliente.
3. En `actividad`, agrega al inicio las entradas nuevas, de la más reciente a la más antigua, con los tipos `entregable`, `seo`, `geo` o `implementacion`.
4. En `metrics`, agrega al inicio 2 o 3 métricas nuevas con fuente y fecha en `sub`.

## 5. QA y publicación

1. Sirve el repo en local con `python -m http.server <puerto> --bind 127.0.0.1` y revisa con Playwright a 390×844:
   - el reporte no tiene desborde horizontal (`scrollWidth <= innerWidth`);
   - la captura del héroe se ve bien;
   - el portal carga sin errores de consola;
   - `CLIENTS.<cliente>.reports.at(-1).title` es el reporte nuevo.
2. Haz commit de `jetcab-reporte<N>.html` y `clientes.html`, con el mensaje en español y las líneas de atribución, y luego push a `master` (Vercel despliega solo).
3. Verifica en vivo con `curl -L` (Vercel redirige `.html` a la URL sin extensión). Comprueba que el `<title>` del reporte responda y que `clientes` contenga «Reporte #N».

## 6. Entrega al usuario

Entrega el enlace del reporte, un resumen de qué contiene (resultados con cifras y pendientes del cliente) y lo que cambió en el portal. Agrega un texto corto listo para mandar por WhatsApp con el resultado principal y el enlace.
