# Rankeo — Sitio Web de la Agencia SEO+GEO
**Claude Code: lee todo antes de tocar una sola línea de código.**

---

## 1. Identidad del proyecto

| Campo | Valor |
|---|---|
| Agencia | Rankeo |
| Dominio | rankeo.agency (producción) / rankeo-nu.vercel.app (staging) |
| Mercado | Colombia, México, USA Hispanic |
| Propuesta | Sitios web + SEO + GEO que posicionan en Google **y** en IAs (ChatGPT, Perplexity, AI Overviews) |
| Modelo | Suscripción mensual $199–$649/mes con auditoría gratis como gancho |
| WhatsApp | +525532894890 |

**REGLA ABSOLUTA:** El cliente final NUNCA debe saber que el trabajo se hace con IA. Todo código, copy y diseño deben verse y sonar como producidos por una agencia humana de primer nivel. Cero menciones a IA, "generado por", plantillas o automatización en ningún entregable de cara al cliente.

---

## 2. Estado actual del repositorio

```
seo-company/
├── index.html                          ← Sitio principal LIVE
├── preview.png                         ← og:image 1200×630 (ya existe, no regenerar)
├── demo/
│   ├── restaurante-bogota.html         ✅ Premium — mantener (DARK WARM, dish card)
│   ├── hotel-boutique-cartagena.html   ✅ Reconstruido — magazine 50/50 split
│   ├── clinica-dental-bogota.html      ✅ Reconstruido — Apple Health aesthetic
│   ├── firma-abogados-medellin.html    ✅ Reconstruido — editorial monumental
│   ├── gimnasio-crossfit-cali.html     ✅ Premium — mantener (Bebas Neue, dark red)
│   ├── inmobiliaria-barranquilla.html  ✅ Reconstruido — search-first hero
│   ├── centro-medico-cdmx.html         ✅ Reconstruido — foto izq / form der invertido
│   └── arquitectura-bogota.html        ✅ Premium — mantener (stacked words cream)
└── CLAUDE.md
```

**Último commit funcional (jun 2026):** `1d271421d282e7e12aaddec1291e6a94193045cf`  
**El sitio está LIVE en:** `https://rankeo-nu.vercel.app`  
Vercel redeploya automáticamente en cada push a `master`.

### Precios actuales en el sitio (NO cambiar sin autorización):
- Plan Local: **$199/mes**
- Plan Web + SEO: **$349/mes**
- Plan Autoridad: **$649/mes**

---

## 2B. LECCIONES CRÍTICAS — ERRORES QUE NO REPETIR

### ⛔ GIT: NUNCA usar `git add` en este repo
El repo está montado en NTFS desde Windows. `git add` falla siempre con `.git/index.lock`.
**Workflow correcto SIEMPRE:**
```python
# 1. Hash cada archivo modificado
git hash-object -w --path <filename> <filepath>
# 2. Construir árbol demo (NON-RECURSIVE con mktree)
git mktree  # con stdin de entradas "100644 blob <hash>\t<nombre>"
# 3. Construir árbol raíz igual
git mktree
# 4. Crear commit
git commit-tree <tree> -p <parent> -m "mensaje"
# 5. Escribir ref directamente
open(".git/refs/heads/master").write(new_commit)
# 6. Push con token en URL
git push https://Luis2597:<TOKEN>@github.com/Luis2597/rankeo-seo-website.git master
```
**Script Python completo y verificado para push:**
```python
import subprocess, os

REPO = "/sessions/.../mnt/seo-company"  # ajustar path de sesión
REMOTE = "https://Luis2597:<TOKEN>@github.com/Luis2597/rankeo-seo-website.git"
# TOKEN: leerlo desde .git/config → [remote "origin"] url

def run(cmd):
    r = subprocess.run(cmd, cwd=REPO, capture_output=True, text=True)
    if r.returncode != 0: raise Exception(r.stderr)
    return r.stdout.strip()

# 1. Hash archivos modificados
files = ["demo/archivo.html"]  # lista de archivos cambiados
hashes = {}
for f in files:
    fname = os.path.basename(f)
    h = run(["git", "hash-object", "-w", "--path", f, os.path.join(REPO, f)])
    hashes[fname] = h

# 2. Leer árbol demo actual y reemplazar hashes
demo_ls = run(["git", "ls-tree", "HEAD:demo"])
tree_lines = {}
for line in demo_ls.splitlines():
    parts = line.split(None, 3); tree_lines[parts[3]] = line
for fname, h in hashes.items():
    tree_lines[fname] = f"100644 blob {h}\t{fname}"
tree_input = "\n".join(sorted(tree_lines.values())) + "\n"

# 3. Crear árbol demo
r = subprocess.run(["git", "mktree"], input=tree_input, cwd=REPO, capture_output=True, text=True)
demo_tree = r.stdout.strip()

# 4. Crear árbol raíz (reemplazar subtree demo)
root_ls = run(["git", "ls-tree", "HEAD"])
root_lines = {}
for line in root_ls.splitlines():
    parts = line.split(None, 3); root_lines[parts[3]] = (parts[0], parts[1], parts[2])
root_lines["demo"] = ("040000", "tree", demo_tree)
root_input = "\n".join(f"{m} {t} {h}\t{n}" for n,(m,t,h) in sorted(root_lines.items())) + "\n"
r2 = subprocess.run(["git", "mktree"], input=root_input, cwd=REPO, capture_output=True, text=True)
root_tree = r2.stdout.strip()

# 5. Commit + push
head = run(["git", "rev-parse", "HEAD"])
r3 = subprocess.run(["git", "commit-tree", root_tree, "-p", head, "-m", "mensaje"], cwd=REPO, capture_output=True, text=True)
new_commit = r3.stdout.strip()
open(os.path.join(REPO, ".git/refs/heads/master"), "w").write(new_commit + "\n")
subprocess.run(["git", "push", REMOTE, "master"], cwd=REPO)
```
Commits funcionales de referencia: `ff5f3053` (original) · `1d271421` (jun 2026 - 5 demos)

### ⛔ Write tool TRUNCA archivos grandes
El Write tool de Claude Code tiene límite de tamaño. Si un archivo es > ~20KB **puede quedar cortado** sin `</body></html>`.
**Verificar SIEMPRE antes de hacer hash-object:**
```python
txt = open(filepath).read()
assert '</html>' in txt, f"ARCHIVO TRUNCADO: {filepath}"
assert '<script' in txt or 'function' in txt, "FALTA JS"
```
Si el archivo está incompleto → restaurar desde git: `git show ff5f305:demo/<archivo>.html`

### ⛔ Burger menu sin JS = no funciona en móvil
Agregar siempre el drawer al final antes de `</body>`:
```js
(function(){
  var b=document.getElementById('burger'),d=document.getElementById('drawer'),o=document.getElementById('drawer-overlay'),c=document.getElementById('drawer-close');
  function op(){d.classList.add('open');o.classList.add('open');document.body.style.overflow='hidden';}
  function cl(){d.classList.remove('open');o.classList.remove('open');document.body.style.overflow='';}
  if(b)b.addEventListener('click',op);if(c)c.addEventListener('click',cl);if(o)o.addEventListener('click',cl);
  if(d)d.querySelectorAll('a').forEach(function(a){a.addEventListener('click',cl);});
})();
```

### ⛔ Páginas demo se ven como plantillas
**El problema real**: 5 de 8 páginas usaban la misma estructura de héroe:
`badge → H1 grande → subtítulo → dos botones → tarjeta flotante a la derecha`

**Regla de diseño para demos**: Cada página DEBE tener una estructura de héroe única:
| Página | Estructura héroe |
|--------|-----------------|
| restaurante | texto izq + featured dish card der (DARK WARM) |
| hotel | split 50/50: panel blanco izq / foto full-height der SIN overlay |
| dental | héroe centrado blanco, imagen a la derecha SIN fondo oscuro |
| abogados | texto monumental full-width, sin tarjeta derecha |
| crossfit | Bebas Neue gigante, dark red, texto izq + WOD card der |
| inmobiliaria | buscador de propiedades como héroe principal (no foto full-bleed) |
| centro médico | blanco, foto izq / formulario cita der (invertido) |
| arquitectura | stacked words cream, imagen grid derecha |

### ⛔ Imágenes: SIEMPRE usar Unsplash CDN con IDs específicos
Formato: `https://images.unsplash.com/photo-{ID}?auto=format&fit=crop&w={W}&q=80`
No usar emojis como placeholders. Ver sección 2C para IDs por industria.
- Mínimo 4–6 imágenes reales por página para que no parezca plantilla
- Widths recomendados: hero `w=1200`, cards `w=800`, thumbnails `w=600`
- Siempre incluir `alt` descriptivo en español, con keyword de la industria

### ⛔ Write tool + heredoc para archivos grandes
Si el Write tool falla por tamaño, usar bash heredoc en Python:
```python
subprocess.run(["bash", "-c", f"cat > {fpath} << 'EOF'\n{contenido}\nEOF"])
```
O escribir con `open(fpath, 'w').write(contenido)` desde Python directamente.
**Siempre verificar después:** `assert '</html>' in open(fpath).read()`

### ⛔ Cada demo debe tener su propio sistema de color, tipografía y personalidad
No basta con cambiar el hero — el sitio entero debe sentirse diferente:
| Demo | Fuentes | Color primario | Personalidad |
|------|---------|---------------|-------------|
| dental | DM Serif Display + Inter | Teal #0E7A6B | Apple Health, limpio |
| abogados | EB Garamond + Outfit | Gold #9B7D3C | Editorial The Economist |
| centro médico | Libre Baskerville + IBM Plex Sans | Teal #087E72 | Clínica moderna mexicana |
| hotel | Cormorant Garamond + Jost | Forest #1E3832 + Gold #C4924A | Revista de lujo |
| inmobiliaria | Unbounded + Manrope | Blue #1455A8 | PropTech moderno |
| restaurante | (mantener original) | Warm dark | — |
| crossfit | Bebas Neue + (sans) | Red oscuro | — |
| arquitectura | (mantener original) | Cream editorial | — |

---

## 2C. UNSPLASH IMAGE IDs POR INDUSTRIA

```
DENTAL (clinica-dental-bogota.html — IDs verificados en producción):
  hero/clínica:  1588776814546-1ffed88e896c   ← hero principal
  sonrisa:       1606265755561-6d6058697b27
  clínica int:   1519494026892-80bbd2d6fd0d   ← interior clínica
  doctor blend:  1606811971618-4486d14f3f99
  doctor(a):     1559839734-2b71ea197ec2
  consultorio:   1612349317150-e413f6a5b16d
  equipo:        1576091160399-112ba8d25d1d

HOTEL CARTAGENA (hotel-boutique-cartagena.html — IDs verificados):
  exterior:      1582719508461-905c673771fd   ← hero split derecho
  habitación:    1631049307264-da0ec9d70304
  habitación2:   1520250497591-112f2f40a3f4
  piscina:       1571896349842-33c89424de2d
  desayuno:      1414235077428-338989a2e8c0

FIRMA ABOGADOS (firma-abogados-medellin.html — IDs verificados):
  oficina dark:  1521791136064-7986c2920216   ← hero full-bleed
  abogado(a):    1568602471122-7832951cc4c5
  abogado2:      1560250097-0b93528c311a
  abogado3:      1507003211169-0a1dd7228f2d

CENTRO MÉDICO (centro-medico-cdmx.html — IDs verificados):
  doctor:        1612349317150-e413f6a5b16d
  clínica:       1519494026892-80bbd2d6fd0d
  equipo:        1576091160399-112ba8d25d1d
  atención:      1579154204601-01588f351e67
  doctor héroe:  1559839734-2b71ea197ec2
  quirófano:     1530026405186-ed1f139313f3
  urgencias:     1587351021759-3e566b6af7cc

INMOBILIARIA (inmobiliaria-barranquilla.html — IDs verificados):
  torres/apto:   1512917774080-9991f1c4c750   ← featured card
  sala living:   1560448204-603b3fc33ddc
  penthouse:     1560448204-603b3fc33ddc
  exterior:      1570129477492-45c003edd2be
  skyline:       1486325212027-8081e485255e   ← about section
  apto moderno:  1522708323590-d8be8d4b56b3

RESTAURANTE (restaurante-bogota.html — mantener, no editar):
  parrilla:      1544025162-d76538a0bfa9
  plato:         1504674900247-0877df9cc836
  ambiente:      1517248135467-4c7edcad34c4

CROSSFIT (gimnasio-crossfit-cali.html — mantener, no editar):
  entrenamiento: 1541534741688-6078c787b3ea
  box/gym:       1526506118085-60ce8714f8c5

ARQUITECTURA (arquitectura-bogota.html — mantener, no editar):
  interior:      1618220179428-22790b461013
  exterior:      1486325212027-8081e485255e
  detalle:       1503708928676-1cb796a0891e
```

---

## 2D. DISEÑO EJECUTADO — DECISIONES POR PÁGINA

Documenta qué se construyó para no rehacerlo ni contradecirlo en futuras sesiones.

### clinica-dental-bogota.html ✅ (jun 2026)
- **Concepto**: Apple Health / Premium Clinic — todo blanco, nada dark
- **Hero**: 2 columnas — texto izq (badge + H1 + sub + CTAs + trust bar) + foto clínica der con esquinas redondeadas y card Google Rating overlay
- **Nav**: blanco siempre visible, teléfono a la derecha, SIN fondo oscuro
- **Secciones**: trust bar → 6 servicios (3-col grid) → about (foto grid + texto) → stats (teal bg) → 3 doctores con fotos → testimonials → formulario cita (teal bg) → footer
- **Tamaño archivo**: ~37KB — completo y verificado

### firma-abogados-medellin.html ✅ (jun 2026)
- **Concepto**: Editorial / The Economist — oscuro, oro, tipografía serif masiva
- **Hero**: full-bleed imagen oscura + 3 líneas de H1 ENORME que cruza el ancho. Sin tarjeta derecha. Stats como contadores al fondo del héroe.
- **Nav**: ultra-minimalista transparente→dark, botón CTA solo con borde en oro
- **Secciones**: áreas de práctica (lista numerada editorial) → blockquote manifesto → team (cards 3/4 ratio) → stats strip (gold bg) → contacto (texto + form)
- **Tamaño archivo**: ~28KB — completo y verificado

### centro-medico-cdmx.html ✅ (jun 2026)
- **Concepto**: Clínica moderna mexicana — blanco, layout INVERTIDO
- **Hero**: foto grande izq (con badges de confianza encima) + formulario de cita derecha sobre fondo blanco. Completamente opuesto al dental.
- **Nav**: siempre blanco, botón rojo "Urgencias 24h" con animación pulse
- **Lang**: `es-MX` (no es-CO — es México)
- **Secciones**: 8 especialidades (4-col) → 3 médicos con badge disponibilidad → about → stats (teal) → testimonials
- **Tamaño archivo**: ~33KB — completo y verificado

### hotel-boutique-cartagena.html ✅ (jun 2026)
- **Concepto**: Revista de lujo — split 50/50, ZERO dark overlay en foto
- **Hero**: panel crema izq (texto editorial + stats) / foto full-height der sin ningún overlay oscuro. Card de disponibilidad en esquina inferior derecha.
- **Nav**: logo CENTRADO (no izquierda), links de nav divididos a ambos lados del logo, transparente→crema en scroll
- **Paleta**: cream #FAF7F2, forest #1E3832, gold #C4924A
- **Secciones**: habitaciones (grid featured + 2) → experiencias (sección oscura) → amenidades (4-col) → testimonials (2-col warm) → booking form
- **Tamaño archivo**: ~30KB — completo y verificado

### inmobiliaria-barranquilla.html ✅ (jun 2026)
- **Concepto**: PropTech moderno — buscador de propiedades como elemento principal del hero, NO foto full-bleed
- **Hero**: título centrado + search box con tabs (Comprar/Arrendar/Proyectos/Vender) + 3 selects + botón buscar + stats bajo el buscador
- **Nav**: logo con subtítulo "Barranquilla, Colombia" + counter "143 propiedades disponibles" visible en desktop
- **Secciones**: 4 propiedades (grid con featured span-2) → about (foto + texto + stats) → 3 servicios → stats navy → testimonials
- **Tamaño archivo**: ~34KB — completo y verificado

---

## 3. Próxima tarea: Migrar a Next.js (App Router)

### 3.1 Stack técnico

```
Framework:   Next.js 14+ (App Router, TypeScript estricto)
Styling:     Tailwind CSS v3 con tokens propios — NO usar shadcn sin customizar
Fuentes:     next/font/google → Syne (display) + Plus Jakarta Sans (body)
Imágenes:    next/image con WebP automático, lazy loading, layout fill
SEO:         next/metadata API, JSON-LD por página, sitemap.xml dinámico, robots.txt
Deploy:      Vercel (auto-deploy en push)
Animaciones: Framer Motion (solo transform/opacity, respeta prefers-reduced-motion)
```

### 3.2 Inicialización

```bash
cd "C:\Users\berna_1oneq3n\Documents\Claude code poyect"
npx create-next-app@latest rankeo-next --typescript --tailwind --app --src-dir --import-alias "@/*"
cd rankeo-next
npm install framer-motion
```

---

## 4. Sistema de diseño — LA BIBLIA

### 4.1 Tokens de color

```ts
// tailwind.config.ts → extend.colors
const colors = {
  ink:     '#0A0908',  // texto principal, fondos dark
  orange:  '#F04E23',  // acento primario, CTAs, hover states
  bg:      '#FAF8F5',  // fondo página (cream cálido, NO blanco puro)
  surface: '#F2EFE9',  // cards, inputs, elementos elevados
  border:  '#E4E0D9',  // bordes sutiles
  subtle:  '#787370',  // texto secundario, placeholders
}
```

```css
/* globals.css — también como CSS custom properties */
:root {
  --c-ink:     #0A0908;
  --c-orange:  #F04E23;
  --c-bg:      #FAF8F5;
  --c-surface: #F2EFE9;
  --c-border:  #E4E0D9;
  --c-subtle:  #787370;

  --dur-fast:  150ms;
  --dur-base:  250ms;
  --dur-slow:  400ms;
  --ease-out:  cubic-bezier(0.0, 0.0, 0.2, 1);
  --ease-in:   cubic-bezier(0.4, 0.0, 1, 1);
  --ease-both: cubic-bezier(0.4, 0.0, 0.2, 1);
}
```

### 4.2 Tipografía

```ts
// layout.tsx
import { Syne, Plus_Jakarta_Sans } from 'next/font/google'

const syne = Syne({
  subsets: ['latin'],
  weight: ['400', '700', '800'],
  variable: '--font-syne',
  display: 'swap',
})

const jakarta = Plus_Jakarta_Sans({
  subsets: ['latin'],
  weight: ['300', '400', '500', '600', '700'],
  variable: '--font-jakarta',
  display: 'swap',
})
```

```css
/* globals.css */
h1, h2, h3, .display { font-family: var(--font-syne); font-weight: 800; letter-spacing: -0.03em; }
body, p, span, a      { font-family: var(--font-jakarta); font-weight: 400; }
```

**Escala tipográfica:**
| Token | rem | px | Uso |
|---|---|---|---|
| `text-5xl`–`text-8xl` | 3–6rem | 48–96px | Hero H1 |
| `text-3xl`–`text-4xl` | 1.875–2.25rem | 30–36px | Section H2 |
| `text-xl`–`text-2xl` | 1.25–1.5rem | 20–24px | Card H3 |
| `text-base` | 1rem | 16px | Body (mínimo en mobile) |
| `text-sm` | 0.875rem | 14px | Labels, captions |

### 4.3 Espaciado y grid

- Base unit: 4px (escala 4/8/16/24/32/48/64/80/96/128px)
- Max width contenido: `max-w-7xl` (1280px) con `px-6` en mobile, `px-8` en desktop
- Grid: 12 columnas en desktop, 4 en mobile
- Section padding: `py-24` desktop / `py-16` mobile
- Nunca menos de `gap-8` entre elementos de grid

### 4.4 Motion system

```ts
// lib/motion.ts — variantes reutilizables
export const fadeUp = {
  hidden: { opacity: 0, y: 32 },
  visible: { opacity: 1, y: 0, transition: { duration: 0.4, ease: [0, 0, 0.2, 1] } }
}

export const stagger = {
  visible: { transition: { staggerChildren: 0.08 } }
}

export const scaleIn = {
  hidden: { opacity: 0, scale: 0.92 },
  visible: { opacity: 1, scale: 1, transition: { duration: 0.35, ease: [0, 0, 0.2, 1] } }
}
```

Reglas de animación:
- Solo `opacity` y `transform` (GPU, no causa reflow)
- Enter: ease-out. Exit: ease-in, 60% de la duración de entrada
- Stagger en listas: 40–80ms por elemento
- SIEMPRE `@media (prefers-reduced-motion: reduce)` → sin animaciones
- Nunca animar `width`, `height`, `top`, `left`, `padding`, `margin`

---

## 5. Arquitectura de páginas

```
src/app/
├── layout.tsx                          ← root layout: fonts, metadata base, analytics
├── page.tsx                            ← / (home, migrar index.html)
├── agencia-seo-colombia/page.tsx       ← keyword: 18k búsq/mes CO
├── agencia-seo-bogota/page.tsx         ← keyword local alta conversión
├── agencia-seo-medellin/page.tsx
├── agencia-seo-cali/page.tsx
├── agencia-seo-mexico/page.tsx
├── diseno-web-colombia/page.tsx
├── seo-para-dentistas/page.tsx         ← nichos: alta conversión, baja competencia
├── seo-para-abogados/page.tsx
├── seo-para-gimnasios/page.tsx
├── seo-para-restaurantes/page.tsx
├── auditoria-seo-gratis/page.tsx       ← landing dedicada con AuditTool
├── blog/
│   ├── page.tsx                        ← blog index
│   ├── cuanto-cuesta-seo-colombia-2026/page.tsx
│   └── por-que-no-aparezco-en-google/page.tsx
├── sitemap.ts                          ← sitemap.xml dinámico
└── robots.ts                           ← robots.txt
```

---

## 6. Componentes a extraer del index.html

Migrar **exactamente** el diseño del index.html. No reinterpretar. Si hay duda, index.html gana.

| # | Componente | Notas críticas |
|---|---|---|
| 1 | `<Navbar>` | Scroll detection → fondo blur/oscuro al bajar. Mobile: drawer hamburger con animación. Logo "Rankeo" en Syne 800. |
| 2 | `<Hero>` | Animated gradient background (background-size 400% + gradShift keyframe). Ranking card flotante con animación de conteo. Badge GEO: "SEO + GEO · Google · ChatGPT · Perplexity · AI Overviews". Dos CTAs: Auditoría gratis (orange fill) + Ver precios (ghost). |
| 3 | `<Band>` | Marquee horizontal animado con palabras clave de servicios. Infinito, smooth, sin JS extra. |
| 4 | `<Manifesto>` | Strip editorial oscuro. Texto grande Syne 800. La frase: "Tus clientes ya no solo buscan en Google. Nosotros decidimos dónde apareces — en todos." |
| 5 | `<HowItWorks>` | 3 pasos: Auditoría → Estrategia → Resultados. Numeración editorial grande. |
| 6 | `<AuditTool>` | ⚠️ COMPLEJO — ver abajo sección 6.1 |
| 7 | `<Portfolio>` | 6 tarjetas con browser mockup CSS puro. Hover: scale + shadow. NO imágenes reales (son CSS). |
| 8 | `<Pricing>` | 3 planes. Toggle mensual/anual (agregar 20% descuento en anual). Highlight plan del medio. |
| 9 | `<FAQ>` | Acordeón. 8 preguntas. Smooth height animation. |
| 10 | `<ContactForm>` | Checkbox HABEAS DATA obligatorio. Validación HTML5 + JS. Submit → WhatsApp o email. |
| 11 | `<Footer>` | Links, redes, legal (Ley 1581), copyright dinámico con JS para el año. |
| 12 | `<WhatsAppFloat>` | Botón fijo bottom-right. Número: +525532894890. Pulse animation. |
| 13 | `<CookieBanner>` | Aviso Ley 1581 de 2012 (Colombia). Aceptar/Rechazar. Guardar en localStorage. |

### 6.1 AuditTool — preservar UX exacta

La herramienta interactiva es el gancho de ventas más importante del sitio. Preservar al 100%:
1. Input URL del usuario
2. 6 pasos animados en secuencia (con delays realistas: 0.4s, 0.8s, 1.4s, 2.0s, 2.8s, 3.5s)
3. Circle score animado (0 → número) con color semafórico
4. 4 categorías colapsables: Velocidad / SEO On-Page / Contenido / Técnico
5. CTA final → WhatsApp con mensaje pre-llenado

Los datos son mock (generados algorítmicamente desde la URL), pero deben verse 100% reales.

---

## 7. SEO técnico — patrón por página

### 7.1 Metadata (next/metadata)

```tsx
// Ejemplo para /agencia-seo-bogota
export const metadata: Metadata = {
  title: 'Agencia SEO Bogotá | Posicionamiento Web Real — Rankeo',
  description: 'Agencia SEO en Bogotá especializada en posicionar negocios locales en Google y en IAs. Auditoría gratis. Resultados desde el mes 3. Desde $199/mes.',
  alternates: {
    canonical: 'https://rankeo.agency/agencia-seo-bogota',
    languages: {
      'es-CO': 'https://rankeo.agency/agencia-seo-bogota',
      'x-default': 'https://rankeo.agency/agencia-seo-bogota',
    },
  },
  openGraph: {
    title: 'Agencia SEO Bogotá — Rankeo',
    description: '...',
    url: 'https://rankeo.agency/agencia-seo-bogota',
    siteName: 'Rankeo',
    images: [{ url: 'https://rankeo.agency/preview.png', width: 1200, height: 630 }],
    locale: 'es_CO',
    type: 'website',
  },
  twitter: { card: 'summary_large_image', title: '...', description: '...', images: ['...'] },
}
```

### 7.2 JSON-LD schemas

Cada página lleva su schema específico en un `<script type="application/ld+json">`:

- **Homepage:** `LocalBusiness` + `Organization` + `WebSite` (con SearchAction) + `FAQPage`
- **Páginas de ciudad:** `LocalBusiness` con `areaServed` específico + `Service`
- **Páginas de industria:** `Service` + `FAQPage` específica del nicho
- **Blog posts:** `BlogPosting` + `BreadcrumbList` + `Article`
- **Todas las páginas:** `BreadcrumbList`

### 7.3 Sitemap dinámico

```ts
// app/sitemap.ts
export default function sitemap(): MetadataRoute.Sitemap {
  return [
    { url: 'https://rankeo.agency', changeFrequency: 'weekly', priority: 1 },
    { url: 'https://rankeo.agency/agencia-seo-colombia', changeFrequency: 'monthly', priority: 0.9 },
    // ... todas las páginas
  ]
}
```

---

## 8. Performance — objetivos Core Web Vitals

| Métrica | Target | Cómo lograrlo |
|---|---|---|
| LCP | < 1.8s | Hero sin imagen pesada. Fuentes con `display: swap`. CSS crítico inline. |
| CLS | < 0.05 | `width`/`height` en todas las imágenes. Fuentes reservadas con `size-adjust`. |
| INP | < 150ms | Hydration solo donde se necesita (`'use client'` mínimo). |
| TTFB | < 600ms | Static generation (SSG) para todas las páginas. No SSR innecesario. |
| Bundle JS | < 150KB | Framer Motion solo en client components. Lazy import de AuditTool. |

**Reglas de imagen:**
- Siempre `next/image` con `width` y `height` explícitos
- Hero images: `priority={true}` (no lazy)
- Todo lo demás: `loading="lazy"` (default)
- Formato: WebP automático vía next/image
- No imágenes decorativas sin alt text (accesibilidad + SEO)

---

## 9. El checklist $10K — revisión antes de cada deploy

Antes de cada push a master, verificar estos 8 criterios. Si alguno falla, **no deployar**.

### ✓ 1. Punto de vista, no plantilla
¿El diseño tiene una dirección de arte clara y coherente? ¿O podría confundirse con cualquier otro sitio de agencia? Rankeo es editorial-moderno: cream cálido, tipografía bold, naranja como único acento, whitespace generoso. Si algo se ve "genérico de Tailwind", rediseñar.

### ✓ 2. Tipografía que trabaja
- Display: Syne 800 únicamente. JAMÁS Inter, Roboto, o Poppins.
- Body: Plus Jakarta Sans. Nunca system-ui como fallback visible.
- Jerarquía: H1 mínimo 48px mobile / 80px desktop. H2 mínimo 32px / 48px.
- Letter-spacing en display: -0.03em. En body: normal (0).

### ✓ 3. Sistema de color restringido
Solo los 5 tokens del sistema. Ningún color hardcodeado fuera de ellos. El naranja `#F04E23` SOLO para: CTAs primarios, hovers, acentos activos, iconos de énfasis. Nunca en fondos grandes ni texto largo.

### ✓ 4. Jerarquía que respira
- Whitespace entre secciones: mínimo `py-24` (96px).
- Nada de "walls of content". Máximo 3–4 elementos por fila en desktop.
- La vista debe poder escanear la página en 3 segundos y entender de qué trata.

### ✓ 5. Imágenes con intención
- CERO imágenes de stock genéricas (personas sonriendo con laptops).
- Portfolio: browser mockups CSS (ya implementados en index.html). Preservar.
- Si se agregan imágenes reales en el futuro: fotografía de negocios locales reales o assets generados con art direction consistente.

### ✓ 6. Movimiento que susurra
- Scroll reveal: fade+translateY(32px), duración 400ms, stagger 80ms.
- Hover en cards: `scale(1.02)` + `box-shadow` más pronunciada, 200ms.
- Nada que distraiga. Nada que tarde más de 500ms.
- `prefers-reduced-motion`: todas las animaciones OFF.

### ✓ 7. Mobile diseñado, no encogido
Breakpoints con decisiones propias para mobile:
- Hero H1: 3rem (48px) en mobile, 5.5rem (88px) en desktop.
- Ranking card: se convierte en badge compacto en mobile (no card full-size).
- Pricing: una columna en mobile con scroll horizontal opcional.
- Nav: drawer full-screen en mobile, no mini-menú.
- Touch targets: mínimo 44×44px todos los elementos interactivos.

### ✓ 8. Lo invisible caro
Verificar antes de cada deploy:
```bash
# Core Web Vitals
npx lighthouse https://rankeo-nu.vercel.app --only-categories=performance,seo,accessibility,best-practices

# Targets: Performance ≥90 | SEO ≥95 | Accessibility ≥90 | Best Practices ≥95
```
- Contraste WCAG AA: todo texto sobre `bg-bg` (#FAF8F5) y `bg-ink` (#0A0908)
- Metadatos: title (50–60 chars), description (150–160 chars) en todas las páginas
- JSON-LD: sin errores en Google Rich Results Test
- Sitemap: `rankeo.agency/sitemap.xml` accesible
- robots.txt: correcto, no bloqueando recursos de Vercel

---

## 10. Flujo de trabajo en Claude Code

### Para cada nuevo componente:
1. Crear en `src/components/[Nombre].tsx`
2. Tipos TypeScript estrictos (no `any`)
3. Props con valores default donde aplique
4. Exportar como default
5. Si tiene animaciones: `'use client'` + `useReducedMotion()` de Framer Motion
6. Si tiene estado del servidor: RSC (sin 'use client')

### Para cada nueva página:
1. Crear `src/app/[slug]/page.tsx`
2. Exportar `metadata` estático
3. Agregar JSON-LD schema en `<script>` dentro del JSX
4. Agregar al sitemap.ts
5. Lint + build local antes de push: `npm run build`

### Para cambios al diseño:
1. Verificar que el cambio existe en index.html (fuente de verdad visual)
2. Aplicar usando SOLO los tokens del sistema de diseño
3. Screenshot + comparar con index.html antes de push
4. Checklist $10K → ¿algún criterio falla?

---

## 11. Copywriting — reglas de voz

El copy de Rankeo es directo, confiante, sin jerga técnica innecesaria. Le habla a dueños de negocios, no a desarrolladores.

**Voz:** Consultor experto que habla claro. No vendedor. No corporativo.

**Frases que SÍ usar:**
- "Tus clientes te buscan hoy. ¿Te encuentran?"
- "Auditoría gratis en 48 horas"
- "Sin contratos anuales. Sin letra pequeña."
- "Resultados medibles, no promesas vacías"

**Frases que NUNCA usar:**
- "Soluciones digitales integrales"
- "Potenciamos tu presencia online"
- "Somos líderes en el sector"
- Cualquier cosa que suene a template de agencia genérica

---

## 12. Archivos de referencia

| Archivo | Uso |
|---|---|
| `index.html` | **Fuente de verdad visual.** Si algo se ve diferente al migrar, index.html gana. |
| `preview.png` | og:image (1200×630). Ya existe. No regenerar. |
| `C:\Users\berna_1oneq3n\Claude\Projects\NEW MULTIBILLIONARE COMPANY\CLAUDE.md` | Instrucciones globales de la agencia Rankeo (modelo de negocio, precios, estrategia) |

---

## 13. Comandos frecuentes

```bash
# Desarrollo local
npm run dev          # http://localhost:3000

# Verificar antes de push
npm run build        # build de producción (0 errores = OK para push)
npm run lint         # ESLint estricto

# Lighthouse local
npx lighthouse http://localhost:3000 --view

# Push a producción — NUNCA usar git add (falla en NTFS)
# Usar siempre el script Python de la sección 2B
```

---

*Este archivo es instrucciones para Claude Code. No es documentación pública. Actualizar cuando cambien decisiones de arquite