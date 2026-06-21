# Rankeo — Sitio Web de la Agencia SEO

## Contexto del proyecto

Este es el sitio web de **Rankeo**, una agencia de SEO y sitios web para Colombia, México y USA Hispanic. El modelo de negocio es suscripción mensual ($149/$299/$599 USD/mes) con auditoría SEO gratis como gancho de ventas.

**REGLA CRÍTICA:** El cliente final NUNCA debe saber que el trabajo se hace con IA. Todo el código, copy y diseño deben verse y sonar como producidos por una agencia humana profesional.

## Estado actual

- `index.html` — Sitio completo de una sola página (HTML/CSS/JS sin framework)
- Diseño: gradient hero animado, tipografía Syne + Plus Jakarta Sans, paleta cream/orange/ink
- Incluye: navbar, hero con ranking card animado, manifesto, how-it-works, audit tool interactivo, portfolio, pricing, FAQ accordion, contact form
- SEO técnico aplicado: canonical, hreflang (es-CO/es-MX/es-US), og:image, LocalBusiness schema, Service schema x3, FAQPage schema (8 preguntas), WhatsApp float button, cookie consent (Ley 1581 Colombia)

## Próxima tarea — Migrar a Next.js

### Objetivo
Convertir el `index.html` actual en un proyecto **Next.js (App Router)** multi-página con arquitectura SEO real.

### Stack
- Framework: Next.js 14+ (App Router)
- Styling: Tailwind CSS con tokens propios (NO usar shadcn genérico)
- SEO: `next/metadata` API, schema JSON-LD por página, sitemap.xml dinámico, robots.txt
- Performance: `next/font` (Syne + Plus Jakarta Sans locales), `next/image`, Core Web Vitals
- Deploy: Vercel

### Tokens de diseño a preservar
```
--c-ink:     #0A0908
--c-orange:  #F04E23
--c-bg:      #FAF8F5
--c-surface: #F2EFE9
--c-border:  #E4E0D9
--c-subtle:  #787370
```

### Arquitectura de páginas a construir

```
/                          → Página principal (migrar index.html)
/agencia-seo-colombia      → Landing SEO Colombia (keyword de alto volumen)
/agencia-seo-bogota        → Landing local Bogotá
/agencia-seo-medellin      → Landing local Medellín
/agencia-seo-cali          → Landing local Cali
/agencia-seo-mexico        → Landing México
/diseno-web-colombia       → Página de servicio diseño web
/seo-para-dentistas        → Landing por industria (baja competencia, alta conversión)
/seo-para-abogados         → Landing por industria
/seo-para-gimnasios        → Landing por industria
/seo-para-restaurantes     → Landing por industria
/blog                      → Blog index
/blog/cuanto-cuesta-seo-colombia-2026  → Post prioritario (keyword de alto volumen)
/blog/por-que-no-aparezco-en-google    → Post top-of-funnel
/auditoria-seo-gratis      → Landing dedicada para la herramienta de auditoría
```

### Componentes a extraer del index.html

1. `Navbar` — con scroll detection y mobile drawer
2. `Hero` — con animated gradient + ranking card SVG + mini metric card
3. `Band` — marquee animado
4. `Manifesto` — strip editorial
5. `HowItWorks` — 3 pasos
6. `AuditTool` — herramienta interactiva de auditoría SEO (lógica compleja — ver index.html)
7. `Portfolio` — 6 tarjetas con browser mockup CSS
8. `Pricing` — 3 planes con toggle mensual/anual (agregar toggle)
9. `FAQ` — acordeón con 7 preguntas
10. `ContactForm` — con checkbox HABEAS DATA
11. `Footer`
12. `WhatsAppFloat` — botón flotante fijo
13. `CookieBanner` — aviso Ley 1581

### SEO por página — patrón a seguir

Cada página debe tener en `layout.tsx` o `page.tsx`:
```tsx
export const metadata: Metadata = {
  title: 'Agencia SEO Bogotá | Posicionamiento Web — Rankeo',
  description: '...',
  alternates: { canonical: 'https://rankeo.agency/agencia-seo-bogota' },
  openGraph: { ... },
}
```

Y un schema JSON-LD específico por página (LocalBusiness para las de ciudad, Service para las de industria).

### Diseño — reglas no negociables ($10K Checklist)

1. Diseño con punto de vista propio, NO plantilla genérica
2. Tipografía: Syne (display, 700/800) + Plus Jakarta Sans (body, 300-700) — NUNCA Inter/Roboto
3. Sistema de color restringido: solo los tokens de arriba
4. Whitespace y jerarquía visual clara
5. Mobile diseñado diferente al desktop, no solo "encogido"
6. Animaciones: transform/opacity únicamente, ease-out enter, ease-in exit, 150-300ms
7. Carga < 2s, contraste WCAG AA, HTML semántico
8. Micro-interacciones artesanales (ver index.html como referencia)

### Nota sobre la herramienta de auditoría

El `AuditTool` actual en index.html simula un análisis con datos mock. En el futuro se puede conectar a una API real (PageSpeed Insights, etc.), pero por ahora el mock es suficiente. Preservar la UX exactamente: 6 pasos animados → circle score → 4 categorías → CTA.

## Comandos para empezar

```bash
cd "C:\Users\berna_1oneq3n\Documents\Claude code poyect"
npx create-next-app@latest rankeo-next --typescript --tailwind --app --src-dir
cd rankeo-next
```

Luego migrar componente por componente usando el `index.html` como fuente de verdad para el diseño.

## Archivos de referencia

- `index.html` — Diseño completo actual (fuente de verdad visual)
- `C:\Users\berna_1oneq3n\Claude\Projects\NEW MULTIBILLIONARE COMPANY\CLAUDE.md` — Instrucciones globales de la agencia Rankeo
