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
├── index.html        ← Sitio actual (HTML/CSS/JS, una sola página, deployado en Vercel)
├── preview.png       ← og:image 1200×630 (ya existe, no regenerar)
└── CLAUDE.md         ← Este archivo
```

**El sitio está LIVE en:** `https://rankeo-nu.vercel.app`  
Vercel redeploya automáticamente en cada push a `master`.

### Precios actuales en el sitio (NO cambiar sin autorización):
- Plan Local: **$199/mes**
- Plan Web + SEO: **$349/mes**
- Plan Autoridad: **$649/mes**

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
- Nunca animar `width`, `height`, `top`, `left