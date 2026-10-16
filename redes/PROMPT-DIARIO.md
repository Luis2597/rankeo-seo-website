# Rankeo — carrusel diario (Instagram + LinkedIn)

Lo corre `redes/publicar-diario.ps1` (tarea de Windows "Rankeo - redes diario", lun-vie 16:00 CDMX).
Trabajas solo, sin nadie que revise: Luis decidió que esto sea 100% automático. No hagas preguntas; si algo falla, déjalo escrito en `redes/registro.json` (campo "error") y termina.

Lee antes la memoria `rankeo-redes-automatizacion` (estilo y reglas de foto) y la skill `rankeo-publicar` (pasos de IG y LinkedIn). La skill `rankeo-carrusel` describe un estilo viejo: no la uses.

## 1. Tema
- Lee `redes/registro.json`. Elige DOS temas nuevos, uno por red, que no repitan ninguno anterior ni en enfoque.
- Instagram: dueño de negocio local (Google Maps, reseñas, web que no vende, WhatsApp, fotos, horarios, SEO local en MX/USA hispano).
- LinkedIn: más estratégico (GEO, ChatGPT/Perplexity/AI Overviews, SEO técnico, medir resultados, contenido que cita la IA).
- Si hoy es la primera publicación de la semana, alterna: la red que ayer usó `errfix` hoy usa `editorial` y viceversa (mira la última fecha del registro).

## 2. Textos
- Español de México, frases cortas, tono de agencia humana. Nada de "en el mundo digital de hoy", "descubre", "potencia", emojis en cadena ni guiones largos. Nunca mencionar IA como autora del contenido.
- Datos solo si son verificables; si no, consejos concretos sin cifras inventadas.
- Formato del JSON: ver `redes/posts/2026-10-15.json` (`ig` y `li`, `tpl`, `cover`, 5 `body`, `close`; `*resaltado*` en naranja, `<b>` en apoyo).
- Caption IG: gancho + 5 puntos breves + CTA "Escríbenos AUDITORÍA por DM" + 5-8 hashtags.
- Texto LinkedIn: gancho de 1-2 líneas, desarrollo breve, pregunta final, CTA a rankeo.agency, 3-5 hashtags.

## 3. Fotos (obligatorio: una grande y relevante por slide)
- Estilo oscuro, cinematográfico y tecnológico: neón, pantallas en penumbra, laptops que brillan, ciudad de noche, cabezas de IA. NUNCA stock claro y alegre.
- Primero usa `C:\Users\berna_1oneq3n\Downloads\rankeo\unsplash\` (no repitas fotos usadas en los últimos 10 días: revisa `redes/posts/*.json`).
- Si faltan: en Chrome, dentro de unsplash.com, `fetch('/s/photos/<busqueda>?license=free')` y saca los IDs `photo-\d+-[0-9a-f]+`. Usa términos "dark", "night", "neon", "moody", "glow". Descarga con `https://images.unsplash.com/photo-<id>?auto=format&fit=crop&w=1400&q=82&fm=jpg` a `unsplash\<id>.jpg` y descarta las de brillo medio >= 95 (PIL, escala de grises).
- Mira cada foto elegida (Read de la imagen) antes de usarla: tiene que corresponder al texto del slide.

## 4. Generar y revisar
- Guarda `redes/posts/<AAAA-MM-DD>.json`.
- Número de carrusel: el mayor de `registro.json` + 1 para IG y + 2 para LinkedIn.
- `python redes/gen.py redes/posts/<fecha>.json <salida>` y revisa `vista-previa.jpg` de cada red. Si un texto se corta o una foto no encaja, corrige y regenera.
- Copias locales en `Downloads\rankeo\instagram\carrusel-<siguiente>\` (con `caption.txt`) y `Downloads\rankeo\linkedin\carrusel-<siguiente>\` (con `texto-linkedin.txt`).

## 5. Subir imágenes
`git worktree add --detach <tmp>/sa origin/social-assets`, copia a `social/carrusel-N/carruselN_slideK.jpg`, commit, `git push origin HEAD:social-assets`, `git worktree remove`. Verifica que cada URL raw responda 200.

## 6. Publicar
- Instagram (Composio, cuenta `instagram_ruta-kafa`): un `INSTAGRAM_POST_IG_USER_MEDIA` por slide con `is_carousel_item:true` → `INSTAGRAM_CREATE_CAROUSEL_CONTAINER` (children en orden + caption) → `INSTAGRAM_POST_IG_USER_MEDIA_PUBLISH` → `INSTAGRAM_GET_IG_MEDIA` para el permalink.
- LinkedIn (Claude in Chrome, Chrome normal de Luis con sesión): `https://www.linkedin.com/company/75624098/admin/page-posts/published/?share=true` → botón "More" → "Add a document" → inyectar el PDF con el script de la skill `rankeo-publicar` → título → esperar "7 pages" → Done → texto en `.ql-editor` con `execCommand('insertText')` → comprobar que el documento está adjunto → Post → "Post successful" → link de "View post".
- Si Chrome no está conectado, publica solo Instagram y registra el error de LinkedIn.
- Nunca borres publicaciones.

## 7. Registrar y subir
- Añade una entrada por red a `redes/registro.json` (fecha, red, carrusel, plantilla, tema, link).
- `git pull --rebase --autostash origin master`, commit SOLO de `redes/registro.json` y `redes/posts/<fecha>.json` ("Redes: carruseles del <fecha>"), `git push origin master`. No toques `.claude/settings.local.json`.
