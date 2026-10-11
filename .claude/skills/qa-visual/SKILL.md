---
name: qa-visual
description: QA visual de una página HTML del sitio Rankeo (index, demos, landings) usando el navegador del Playwright MCP. Úsalo antes de hacer push de cualquier cambio de diseño, para revisar una demo nueva, o cuando el usuario pida "revisar cómo se ve", "verificar en móvil", "sacar captura" o "probar el menú/formulario".
---

# QA visual con Playwright MCP

Revisión de una página en un navegador real, desktop y móvil, usando las herramientas
`browser_*` del servidor MCP `playwright` definido en `.mcp.json`.

## 0. Preparación

1. Servir el repo en local (el MCP no puede abrir `file://` y en el entorno cloud no hay salida a vercel.app):
   ```bash
   python3 -m http.server 8080 --bind 127.0.0.1 &
   ```
2. Si las herramientas `browser_*` no están cargadas, buscarlas con ToolSearch (`+browser navigate`).
3. Las capturas y snapshots quedan en `.playwright-mcp/` (ignorado por git). Las capturas con `filename` explícito
   se resuelven contra la raíz del repo: usar siempre `filename: ".playwright-mcp/<nombre>.png"`.

## 1. Desktop (1280×800 es el viewport por defecto)

1. `browser_navigate` → `http://127.0.0.1:8080/<ruta>.html`
2. Leer el resumen de la respuesta: título, errores de consola, y el snapshot.
   - Ignorar `googletagmanager.com` bloqueado y `favicon.ico 404` en el entorno cloud; cualquier otro error de consola se reporta.
3. `browser_take_screenshot` con `fullPage: true` → revisar jerarquía, imágenes rotas, textos cortados.
4. Espacio blanco al final de la página (lección 2B de CLAUDE.md): `browser_evaluate` con
   ```js
   () => { const f = document.querySelector('footer'); const r = f.getBoundingClientRect();
     return { docH: document.documentElement.scrollHeight, footerBottom: Math.round(r.bottom + window.scrollY) } }
   ```
   `docH` debe ser igual (±2px) a `footerBottom`. Si es mayor, falta `overflow:hidden` en el footer o en la última sección con `.rv`.
5. Overflow horizontal: `browser_evaluate` → `() => document.documentElement.scrollWidth - window.innerWidth` debe ser `0`.

## 2. Móvil

1. `browser_resize` → `width: 390, height: 844`.
2. Captura `fullPage: true`.
3. Menú burger: `browser_find` texto o rol del botón → `browser_click` → verificar en el snapshot que el drawer tiene los links y que el overlay/cierre funciona (`browser_click` en cerrar).
4. Repetir los dos `browser_evaluate` del paso 1 (espacio blanco y overflow horizontal) en este viewport.
5. Touch targets: botones y links principales deben medir ≥ 44px de alto (`browser_snapshot` con `boxes: true` o `browser_evaluate` sobre `getBoundingClientRect`).

## 3. Interacciones críticas (solo en las páginas que las tienen)

- **index.html**: AuditTool → `browser_type` una URL en el input + `submit: true`; `browser_wait_for` texto del score; captura. Acordeón FAQ → click y verificar que abre. Cookie banner → "Aceptar" desaparece y no vuelve tras `browser_navigate` a la misma URL (persistente en localStorage).
- **clientes.html**: login con la cuenta de cliente de CLAUDE.md; verificar que NO se dispara PageSpeed automáticamente (revisar `browser_network_requests` con `filter: "pagespeedonline"` → debe estar vacío hasta pulsar "Analizar").
- **Formularios de contacto / cita**: `browser_fill_form` con datos de prueba y verificar validación HTML5 (no enviar a WhatsApp real).

## 4. Reporte

Entregar al usuario, en español, una lista corta: ✅ lo que pasó, ❌ lo que falló con la medida exacta (px, texto, selector), y las rutas de las capturas.
No corregir nada sin que el usuario lo pida, salvo que la tarea original fuera ya el fix.

## Notas de entorno

- **Windows (local)**: el MCP usa Google Chrome instalado, con ventana visible. Si no hay Chrome: `npx @playwright/mcp install-browser`.
- **Sesión cloud de Claude Code**: no hay Chrome ni display. El lanzador `.claude/mcp/playwright-launcher.cjs` arranca solo el Chromium preinstalado en headless; no hace falta configurar variables (ver CLAUDE.md §2E).
- No usar `browser_run_code_unsafe` salvo necesidad real: `browser_evaluate` cubre casi todo.
