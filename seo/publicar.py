"""Publica los posts programados del blog de Rankeo cuando llega su fecha.

Cadencia del método: 3 posts por semana (lunes, miércoles y viernes, 09:00 hora de CDMX).
Mientras no llega la fecha, el post existe pero lleva noindex y no aparece en el índice
del blog, el sitemap ni llms.txt. Al publicarse:
  1. se quita la meta robots noindex del post,
  2. se agrega su tarjeta arriba en blog/index.html,
  3. se agrega su URL a sitemap.xml,
  4. se agrega su línea a llms.txt.
Es idempotente: si el post ya está publicado no hace nada.

Uso:  python seo/publicar.py            (publica lo que toque hoy)
      python seo/publicar.py --hasta 2026-10-21   (simula una fecha)
"""
import argparse, datetime, os, re, sys

RAIZ = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
DOM = 'https://rankeo.agency'
MARCA_NOINDEX = '<meta name="robots" content="noindex,follow"><!-- rankeo:programado -->'
ROBOTS_PUBLICO = '<meta name="robots" content="index,follow,max-image-preview:large"/>'

CALENDARIO = [
    # fecha, slug, etiqueta, extracto, minutos de lectura
    ('2026-10-14', 'como-poner-mi-negocio-en-google-maps', 'Google Maps · México',
     'Requisitos, alta, verificación, tiempos y qué hacer si tu negocio no aparece en el mapa.', 11),
    ('2026-10-16', 'google-mi-negocio', 'Perfil de Negocio · México',
     'Qué es, cómo entrar, cómo darte de alta gratis y cómo optimizar cada campo de tu perfil.', 11),
    ('2026-10-19', 'como-conseguir-resenas-en-google', 'Reseñas · México',
     'Cómo pedir reseñas sin romper las reglas de Google, con mensajes listos y plantillas de respuesta.', 10),
    ('2026-10-21', 'que-es-seo', 'SEO · Guía',
     'Cómo decide Google qué mostrar, tipos de SEO, diferencia con SEM, cuánto tarda y cuánto cuesta.', 12),
    ('2026-10-23', 'que-son-ai-overviews', 'IA · Google',
     'Qué son los AI Overviews, cuándo aparecen, si se pueden quitar y cómo lograr que citen a tu negocio.', 9),
    ('2026-10-26', 'que-es-aeo', 'AEO · Guía',
     'Answer Engine Optimization explicado: diferencias con SEO y GEO y cómo optimizar tu sitio.', 9),
]
MESES = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
FONDOS = ['#ffe3cf,#fde9b0', '#c3e8ff,#d5c3ff', '#d8f3dc,#c3e8ff', '#fde9b0,#d8f3dc', '#d5c3ff,#ffe3cf', '#c3e8ff,#d8f3dc']


def leer(rel):
    return open(os.path.join(RAIZ, rel), encoding='utf-8').read()


def escribir(rel, texto):
    open(os.path.join(RAIZ, rel), 'w', encoding='utf-8', newline='').write(texto)


def hoy_cdmx():
    # CDMX es UTC-6 todo el año desde 2022 (sin horario de verano).
    return (datetime.datetime.utcnow() - datetime.timedelta(hours=6)).date()


def titulo(html):
    h1 = re.search(r'<h1[^>]*>(.*?)</h1>', html, re.S).group(1)
    return re.sub(r'\s+', ' ', re.sub(r'<[^>]+>', '', h1)).strip()


def publicar(i, fecha, slug, etiqueta, extracto, minutos):
    rel = f'blog/{slug}.html'
    url = f'{DOM}/blog/{slug}'
    html = leer(rel)
    cambios = []
    if MARCA_NOINDEX in html:
        html = html.replace(MARCA_NOINDEX, ROBOTS_PUBLICO)
        escribir(rel, html)
        cambios.append('noindex quitado')

    indice = leer('blog/index.html')
    if f'href="/blog/{slug}"' not in indice:
        y, m, d = fecha.split('-')
        tarjeta = f'''
      <article class="blog-card">
        <div class="bc-img" style="background:linear-gradient(135deg,{FONDOS[i % len(FONDOS)]})">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="rgba(10,9,8,.25)" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="bc-body">
          <span class="bc-tag">{etiqueta}</span>
          <a href="/blog/{slug}" class="bc-title">{titulo(html)}</a>
          <p class="bc-excerpt">{extracto}</p>
          <div class="bc-meta"><span>Luis Díaz · {int(d)} {MESES[int(m) - 1]} {y}</span><span>·</span><span>{minutos} min lectura</span></div>
        </div>
      </article>
'''
        ancla = '<div class="blog-grid rv">\n'
        assert ancla in indice, 'No encontré la cuadrícula del blog'
        escribir('blog/index.html', indice.replace(ancla, ancla + tarjeta, 1))
        cambios.append('tarjeta en blog/index.html')

    sm = leer('sitemap.xml')
    if f'<loc>{url}</loc>' not in sm:
        entrada = f'''  <url>
    <loc>{url}</loc>
    <lastmod>{fecha}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
    <xhtml:link rel="alternate" hreflang="es-MX" href="{url}"/>
  </url>

'''
        escribir('sitemap.xml', sm.replace('</urlset>', entrada + '</urlset>'))
        cambios.append('sitemap')

    llms = leer('llms.txt')
    if url not in llms:
        linea = f'- {titulo(html)}: {url}\n'
        ancla = '\n## Contacto'
        llms = llms.replace(ancla, linea.rstrip('\n') + '\n' + ancla, 1) if ancla in llms else llms + linea
        escribir('llms.txt', llms)
        cambios.append('llms.txt')
    return cambios


def main():
    ap = argparse.ArgumentParser()
    ap.add_argument('--hasta', help='fecha AAAA-MM-DD (por defecto, hoy en CDMX)')
    a = ap.parse_args()
    hasta = a.hasta or hoy_cdmx().isoformat()
    total = 0
    for i, (fecha, slug, etiqueta, extracto, minutos) in enumerate(CALENDARIO):
        if fecha > hasta:
            print(f'pendiente  {fecha}  {slug}')
            continue
        cambios = publicar(i, fecha, slug, etiqueta, extracto, minutos)
        total += bool(cambios)
        print(f'{"PUBLICADO" if cambios else "ya estaba"}  {fecha}  {slug}  {", ".join(cambios)}')
    print(f'posts publicados en esta corrida: {total}')


if __name__ == '__main__':
    sys.exit(main())
