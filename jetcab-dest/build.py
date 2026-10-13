"""Genera las páginas de destino en inglés y español de JETCAB (una por destino) desde data/<id>.json.
Uso: python build.py  ->  escribe <slug>.html en esta carpeta. Las sirve el snippet «JETCAB destinos EN v5».
Hechos de JETCAB (precios, tiempos, aeropuertos) viven aquí en DEST; el texto de cada destino en data/."""
import json, os, html, re, sys, urllib.parse

HERE = os.path.dirname(os.path.abspath(__file__))
WA = '527291081200'
U = 'https://jetcab.mx/wp-content/uploads/'
IMG = lambda p: U + p
LJ, CL, GV = IMG('2024/11/Learjet35enrenta.jpeg'), IMG('2024/11/Challenger-605-en-renta.jpeg'), IMG('2024/11/Gulfstream-Gv-en-Renta.jpeg')
REQ = 'Quote in 30 min'

# id: slug, nombre corto, IATA destino, tiempo, página ES, precios [LJ, CL, GV] o ('one', precio) o ('long',) o ('hub', filas), fotos del sitio
DEST = {
 'cancun':        dict(slug='private-jet-mexico-city-cancun', name='Cancún', iata='CUN', time='2h 15m', es='/vuelos-privados-a-cancun/', p=['$3,200', '$6,500', '$12,000'], g=['2024/10/vuelosprivadosacancun-scaled.jpg', '2024/10/vuelos-privados-a-cancun-scaled.jpg', '2024/10/vuelos-privados-a-cancun-1-scaled.jpg'], region='Mexico'),
 'loscabos':      dict(slug='private-jet-mexico-city-los-cabos', name='Los Cabos', iata='SJD', time='2h 30m', es='/vuelos-privados-a-los-cabos/', p=['$3,800', REQ, REQ], g=['2024/10/vuelos-privados-a-los-cabos-scaled.jpg', '2024/10/Vuelos-Privados-a-Los-Cabos-1-scaled.jpg', '2024/10/Vuelos-Privados-a-los-cabos-2-scaled.jpg'], region='Mexico'),
 'puertovallarta':dict(slug='private-jet-mexico-city-puerto-vallarta', name='Puerto Vallarta', iata='PVR', time='1h 45m', es='/vuelos-privados-a-puerto-vallarta/', p=['$3,000', REQ, REQ], g=['2024/10/Vuelos-privados-a-puerto-vallarta-scaled.jpg', '2024/10/Vuelos-privados-a-puerto-vallarta-1-scaled.jpg', '2024/10/vuelosprivadosapuertovallarta-scaled.jpg'], region='Mexico'),
 'monterrey':     dict(slug='private-jet-mexico-city-monterrey', name='Monterrey', iata='MTY', time='1h 15m', es='/vuelos-privados-a-monterrey/', p=['$2,200', REQ, REQ], g=['2024/10/Vuelosprivadosmonterrey-scaled.jpg', '2024/10/vuelosprivadosamonterrey-scaled.jpg', '2024/10/vuelos-privados-a-monterrey-scaled.jpg'], region='Mexico'),
 'guadalajara':   dict(slug='private-jet-mexico-city-guadalajara', name='Guadalajara', iata='GDL', time='50 min', es='/vuelos-privados-a-guadalajara/', p=['$1,800', REQ, REQ], g=['2024/10/vuelos-privados-a-Guadalajara-scaled.jpg', '2024/10/vuelos-privados-a-guadalajara-1-scaled.jpg', '2024/10/vuelosprivadosaguadalajara-scaled.jpg'], region='Mexico'),
 'acapulco':      dict(slug='private-jet-mexico-city-acapulco', name='Acapulco', iata='ACA', time='45 min', es='/vuelos-privados-a-acapulco/', p=('one', '$1,500'), g=['2024/10/Vuelos-privados-a-Acapulco-Guerrero-scaled.jpg', '2024/10/vuelosprivadosaacapulcomexico.jpg', '2024/10/Vuelos-privados-a-Acapulco-scaled.jpg'], region='Mexico'),
 'queretaro':     dict(slug='private-jet-mexico-city-queretaro', name='Querétaro', iata='QRO', time='35 min', es='/vuelos-privados-a-queretaro-jetcab/', p=('one', '$3,000'), g=['2024/10/Vuelosprivadosaqueretaro-scaled.jpg', '2024/10/Vuelos-privados-a-queretaro-1-scaled.jpg', '2024/10/Vuelos-Privados-a-Queretaro-scaled.jpg'], region='Mexico'),
 'toluca':        dict(slug='private-jet-toluca-airport', name='Toluca', iata='TLC', time='Home base', es='/vuelos-privados-toluca/', p=('hub', [('Guadalajara · 50 min', '$1,800'), ('Monterrey · 1h 15m', '$2,200'), ('Cancún · 2h 15m', '$3,200'), ('Los Cabos · 2h 30m', '$3,800')]), g=['2024/10/vuelosprivadosatoluca-scaled.jpg', '2024/10/vuelos-privados-a-toluca-scaled.jpg', '2024/10/vuelosprivados-a-toluca-scaled.jpg'], region='Mexico', hub=True),
 'cdmx':          dict(slug='private-jet-mexico-city', name='Mexico City', iata='TLC', time='Departures', es='/vuelos-privados-a-cdmx/', p=('hub', [('Guadalajara · 50 min', '$1,800'), ('Monterrey · 1h 15m', '$2,200'), ('Cancún · 2h 15m', '$3,200'), ('Miami · 3h 30m', '$4,800')]), g=['2024/10/vuelos-privados-a-cdmx-scaled.jpg', '2024/10/vuelos-privados-a-ciudad-de-mexico-scaled.jpg', '2024/10/Vuelosprivadosacdmx-scaled.jpg'], region='Mexico', hub=True),
 'newyork':       dict(slug='private-jet-mexico-city-new-york', name='New York', iata='TEB', time='5h 30m', es='/vuelo-privado-cdmx-nueva-york/', p=['$9,500', '$18,500', '$28,000'], g=['2024/10/vuelosprivadosanuevayork-scaled.jpg', '2024/10/vuelos-privados-a-nueva-york-scaled.jpg', '2024/10/vuelosprivadosnuevayork-scaled.jpg'], region='United States', stop=True),
 'miami':         dict(slug='private-jet-mexico-city-miami', name='Miami', iata='OPF', time='3h 30m', es='/vuelo-privado-cdmx-miami/', p=['$4,800', '$9,500', '$18,000'], g=['2026/10/jet-privado-mexico-miami-skyline.jpg'], region='United States'),
 'houston':       dict(slug='private-jet-mexico-city-houston', name='Houston', iata='HOU', time='2h 45m', es='/vuelo-privado-cdmx-houston/', p=['$3,800', '$7,500', '$14,000'], g=['2026/10/jet-privado-mexico-houston-skyline.jpg'], region='United States'),
 'losangeles':    dict(slug='private-jet-mexico-city-los-angeles', name='Los Angeles', iata='VNY', time='3h 45m', es='/vuelo-privado-cdmx-los-angeles/', p=['$5,200', '$10,500', '$19,000'], g=['https://images.unsplash.com/photo-1444723121867-7a241cacace9?auto=format&fit=crop&w=1800&q=80', 'https://images.unsplash.com/photo-1534190760961-74e8c1c5c3da?auto=format&fit=crop&w=1200&q=80'], region='United States'),
 'lasvegas':      dict(slug='private-jet-mexico-city-las-vegas', name='Las Vegas', iata='LAS', time='3h 50m', es='/vuelos-privados-a-las-vegas/', p=('one', '$15,000'), g=['2024/10/vuelos-privados-a-lasvegas.jpg', '2024/10/Vuelos-Privados-a-Las-Vegas-scaled.jpg', '2024/10/Vuelos-privados-a-Las-Vegas-1.jpg'], region='United States'),
 'sandiego':      dict(slug='private-jet-mexico-city-san-diego', name='San Diego', iata='SAN', time='3h 20m', es='/vuelos-privados-a-san-diego/', p=('one', '$9,000'), g=['2024/10/vuelosprivadosasandiego-scaled.jpg', '2024/10/vuelos-privados-a-san-diego-scaled.jpg', '2024/10/vuelos-privados-a-san-diego-1-scaled.jpg'], region='United States'),
 'tijuana':       dict(slug='private-jet-mexico-city-tijuana', name='Tijuana', iata='TIJ', time='3h 10m', es='/vuelos-privados-a-tijuana/', p=('one', '$12,000'), g=['2024/10/vuelosprivadosatijuana-scaled.jpg', '2024/10/Vuelos-privados-a-Tijuana-1-scaled.jpg', '2024/10/Vuelos-privados-a-tijuana-scaled.jpg'], region='Mexico'),
 'mcallen':       dict(slug='private-jet-mexico-city-mcallen', name='McAllen', iata='MFE', time='1h 30m', es='/vuelos-privados-a-mcallen/', p=('one', '$8,000'), g=['2024/10/vuelosprivadosamcallen.jpg', '2024/10/Vuelos-privados-a-McAllenjpg-scaled.jpg'], region='United States'),
 'estadosunidos': dict(slug='private-jet-mexico-to-usa', name='United States', iata='USA', time='From 1h 30m', es='/vuelos-privados-a-estados-unidos/', p=('hub', [('Houston · 2h 45m', '$3,800'), ('Miami · 3h 30m', '$4,800'), ('Los Angeles · 3h 45m', '$5,200'), ('New York · 5h 30m, one fuel stop', '$9,500')]), g=['2024/10/Vuelos-privados-a-Estados-Unidos-1-scaled.jpg', '2024/10/Vuelospriavdos-a-estados.unidos.jpg', '2024/10/Vuelosprivadosaestadosunidos-scaled.jpg'], region='United States', hub=True),
 'cuba':          dict(slug='private-jet-mexico-city-havana', name='Havana', iata='HAV', time='2h 30m', es='/vuelos-privados-a-cuba/', p=('one', '$1,800'), g=['2024/10/vuelos-privados-a-cuba-scaled.jpg', '2024/10/vuelosprivadosacuba-scaled.jpg', '2024/10/vuelos-privados-a-cuba-1-scaled.jpg'], region='Caribbean'),
 'espana':        dict(slug='private-jet-mexico-to-spain', name='Spain', iata='MAD', time='~11h', es='/vuelos-privados-a-espana/', p=('long',), g=['2024/10/vuelos-privados-a-espana-1-scaled.jpg', '2024/10/Vuelosprivadosaespana-scaled.jpg'], region='Europe'),
 'europa':        dict(slug='private-jet-mexico-to-europe', name='Europe', iata='EU', time='10.5 to 13h', es='/vuelos-privados-a-europa/', p=('long',), g=['2024/10/Vuelosprivadosaeuropa.jpg', '2024/10/Vuelos-privados-a-europa-scaled.jpg', '2024/10/vuelos-privados-a-europa-1-scaled.jpg'], region='Europe'),
}
ORDER = ['cancun', 'loscabos', 'puertovallarta', 'monterrey', 'guadalajara', 'acapulco', 'queretaro', 'toluca', 'cdmx', 'newyork', 'miami', 'houston', 'losangeles', 'lasvegas', 'sandiego', 'tijuana', 'mcallen', 'estadosunidos', 'cuba', 'espana', 'europa']
URL = lambda i: 'https://jetcab.mx/' + DEST[i]['slug'] + '/'
e = lambda s: html.escape(str(s), quote=True)
img = lambda g: g if g.startswith('http') else IMG(g)

ES_URL = lambda i: 'https://jetcab.mx' + DEST[i]['es']
ES_NAME = {'cancun': 'Cancún', 'loscabos': 'Los Cabos', 'puertovallarta': 'Puerto Vallarta', 'monterrey': 'Monterrey', 'guadalajara': 'Guadalajara', 'acapulco': 'Acapulco',
           'queretaro': 'Querétaro', 'toluca': 'Toluca', 'cdmx': 'Ciudad de México', 'newyork': 'Nueva York', 'miami': 'Miami', 'houston': 'Houston', 'losangeles': 'Los Ángeles',
           'lasvegas': 'Las Vegas', 'sandiego': 'San Diego', 'tijuana': 'Tijuana', 'mcallen': 'McAllen', 'estadosunidos': 'Estados Unidos', 'cuba': 'La Habana', 'espana': 'España', 'europa': 'Europa'}
ES_TIME = {'Home base': 'Base JETCAB', 'Departures': 'Salidas', 'From 1h 30m': 'Desde 1h 30m', '10.5 to 13h': '10.5 a 13 h', '~11h': '~11 h'}

L = {
 'en': dict(LANG='en', LOCALE='en_US', ALT='es', ALTSHORT='ES', ALTLONG='Español', QUOTE='Get a quote', MENU='Open menu', CLOSE='Close menu',
            QUOTE30='Get a quote in 30 minutes', SEEPRICES='See prices', TOLUCA='Toluca · Mexico City',
            TRUST='<span><b>25 years</b> flying from Toluca</span><span><b>2,000+</b> flights</span><span>AFAC permit</span><span>Jet <b>ready in 2h</b></span>',
            K1='The trip', K2='Why fly private', K3='Door to door', K4='Aircraft and prices', K5='At your destination', K6='Questions', K7='More routes',
            PRLEAD='One way, per whole aircraft, not per seat. Every price includes crew, fuel, catering, airport fees and permits, and is confirmed in writing within 30 minutes.',
            INCL='<span>Crew</span><span>Fuel</span><span>Catering</span><span>Permits</span><span>Private terminal</span><span>Quote in 30 min</span>',
            QUOTEWA='Quote on WhatsApp', CALL='Call +52 729 108 1200', RELH2='Private jet destinations from Mexico City', CONTACT='Contact',
            FTP='Private jet and helicopter charter from Toluca International Airport since 1999.', ADDR='Toluca International Airport, Hangar 62, Mexico.', RANKEO='Website &amp; SEO by Rankeo',
            FROM='from %s USD', REQ='Quote in 30 min', PRT='Private jet prices to %s', FAQT='%s private jet FAQ', PHOTOS='Photos of %s. Wikimedia Commons.',
            HEROALT='%s, private jet charter destination from Mexico City', STORYALT='%s by private jet', GALALT='%s, private jet destination', ACALT='%s private jet charter to %s',
            WA="Hi JETCAB, I'd like a quote for a private jet to %s.", ONE='Full-aircraft price from %s USD. Other cabins are quoted in 30 minutes.',
            C_LJ='Light jet · up to 7 passengers', C_CL='Midsize · up to 12 passengers · stand-up cabin', C_GV='Long range · up to 16 passengers', STOP=' · one fuel stop',
            C_GVN='Long range · up to 16 passengers · nonstop', C_CLS='Midsize · up to 12 passengers · technical stop',
            BADGE={'toluca': 'JETCAB home base · Toluca International Airport (TLC)', 'cdmx': 'Departures from Toluca (TLC) · 65 km from Mexico City', 'estadosunidos': 'Toluca (TLC) to the United States · from 1h 30m'},
            HOME='https://jetcab.mx/en/', BC=[('JETCAB', 'https://jetcab.mx/en/'), ('Destinations', 'https://jetcab.mx/private-jet-destination-guide/')],
            NAV=[('Destinations', 'https://jetcab.mx/en/#destinations'), ('Fleet', 'https://jetcab.mx/en/#fleet'), ('Blog', 'https://jetcab.mx/private-jet-guides/'), ('FAQ', 'https://jetcab.mx/private-jet-faq/')],
            FT=[('Charter', [('Private jet charter Mexico', 'https://jetcab.mx/en/'), ('Helicopter charter', 'https://jetcab.mx/helicopter-charter-mexico-city/'), ('Destination guide', 'https://jetcab.mx/private-jet-destination-guide/'), ('Charter guide', 'https://jetcab.mx/private-jet-charter-mexico-guide/')]),
                ('Learn', [('Blog', 'https://jetcab.mx/private-jet-guides/'), ('FAQ', 'https://jetcab.mx/private-jet-faq/')])]),
 'es': dict(LANG='es-MX', LOCALE='es_MX', ALT='en', ALTSHORT='EN', ALTLONG='English', QUOTE='Cotizar', MENU='Abrir menú', CLOSE='Cerrar menú',
            QUOTE30='Cotizar en 30 minutos', SEEPRICES='Ver precios', TOLUCA='Toluca · Ciudad de México',
            TRUST='<span><b>25 años</b> volando desde Toluca</span><span><b>2,000+</b> vuelos</span><span>Permiso AFAC</span><span>Jet <b>listo en 2 h</b></span>',
            K1='El viaje', K2='Por qué volar privado', K3='De puerta a puerta', K4='Aeronaves y precios', K5='En su destino', K6='Preguntas', K7='Más rutas',
            PRLEAD='Precio por trayecto sencillo y por aeronave completa, no por asiento. Incluye tripulación, combustible, catering, derechos de aeropuerto y permisos, y se confirma por escrito en 30 minutos.',
            INCL='<span>Tripulación</span><span>Combustible</span><span>Catering</span><span>Permisos</span><span>Terminal privada</span><span>Cotización en 30 min</span>',
            QUOTEWA='Cotizar por WhatsApp', CALL='Llamar +52 729 108 1200', RELH2='Destinos en jet privado desde la Ciudad de México', CONTACT='Contacto',
            FTP='Renta de jets privados y helicópteros desde el Aeropuerto Internacional de Toluca desde 1999.', ADDR='Aeropuerto Internacional de Toluca, Hangar 62, México.', RANKEO='Sitio web y SEO por Rankeo',
            FROM='desde %s USD', REQ='Cotización en 30 min', PRT='Precios de jet privado a %s', FAQT='Preguntas frecuentes: jet privado a %s', PHOTOS='Fotos de %s. Wikimedia Commons.',
            HEROALT='%s, destino en jet privado desde la Ciudad de México', STORYALT='%s en jet privado', GALALT='%s, destino en jet privado', ACALT='Renta de %s, jet privado a %s',
            WA='Hola JETCAB, quiero cotizar un vuelo privado a %s.', ONE='Precio por aeronave completa desde %s USD. Las demás cabinas se cotizan en 30 minutos.',
            C_LJ='Jet ligero · hasta 7 pasajeros', C_CL='Mediano · hasta 12 pasajeros · cabina de pie', C_GV='Largo alcance · hasta 16 pasajeros', STOP=' · una escala técnica',
            C_GVN='Largo alcance · hasta 16 pasajeros · sin escalas', C_CLS='Mediano · hasta 12 pasajeros · escala técnica',
            BADGE={'toluca': 'Base de JETCAB · Aeropuerto Internacional de Toluca (TLC)', 'cdmx': 'Salidas desde Toluca (TLC) · a 65 km de la CDMX', 'estadosunidos': 'De Toluca (TLC) a Estados Unidos · desde 1h 30m'},
            HOME='https://jetcab.mx/', BC=[('Inicio', 'https://jetcab.mx/'), ('Destinos', 'https://jetcab.mx/destinos/')],
            NAV=[('Inicio', 'https://jetcab.mx/'), ('Nuestra flota', 'https://jetcab.mx/flota/'), ('Precios', 'https://jetcab.mx/precios-jet-privado/'), ('Destinos', 'https://jetcab.mx/destinos/'), ('Blog', 'https://jetcab.mx/blog/'), ('Sobre nosotros', 'https://jetcab.mx/sobre-nosotros/')],
            FT=[('Servicios', [('Renta de aviones privados', 'https://jetcab.mx/renta-de-aviones-privados/'), ('Precios de jet privado', 'https://jetcab.mx/precios-jet-privado/'), ('Renta de helicópteros', 'https://jetcab.mx/helicopteros-en-renta-cdmx/'), ('Ambulancia aérea', 'https://jetcab.mx/flota/ambulancia-aerea/')]),
                ('Aprenda', [('Blog', 'https://jetcab.mx/blog/'), ('Preguntas frecuentes', 'https://jetcab.mx/preguntas-frecuentes/'), ('Destinos', 'https://jetcab.mx/destinos/')])]),
}


def price_rows(d, l):
    p = d['p']
    fmt = lambda b: (l['FROM'] % b) if b.startswith('$') else (l['REQ'] if b == REQ else b)
    def row(a, b): return '<div class="pr-r"><span>%s</span><b>%s</b></div>' % (e(a), e(fmt(b)))
    if isinstance(p, list):
        return [('Learjet 35', l['C_LJ'] + (l['STOP'] if d.get('stop') else ''), p[0], LJ), ('Challenger 605', l['C_CL'], p[1], CL), ('Gulfstream GV', l['C_GV'], p[2], GV)], None, fmt
    if p[0] == 'one':
        return [('Learjet 35', l['C_LJ'], p[1], LJ), ('Challenger 605', l['C_CL'], REQ, CL), ('Gulfstream GV', l['C_GV'], REQ, GV)], l['ONE'] % p[1], fmt
    if p[0] == 'long':
        return [('Gulfstream GV', l['C_GVN'], '$100,000', GV), ('Global Express', l['C_GV'], REQ, GV), ('Challenger 605', l['C_CLS'], REQ, CL)], None, fmt
    rows = [(a if l['LANG'] == 'en' else a.replace('one fuel stop', 'una escala técnica'), b) for a, b in p[1]]
    return None, ''.join(row(a, b) for a, b in rows), fmt


def page(i, c, pimgs, lang='en'):
    l = L[lang]; d = DEST[i]
    url = URL(i) if lang == 'en' else ES_URL(i)
    alt_url = ES_URL(i) if lang == 'en' else URL(i)
    name = d['name'] if lang == 'en' else ES_NAME[i]
    tlabel = lambda j: DEST[j]['time'] if lang == 'en' else ES_TIME.get(DEST[j]['time'], DEST[j]['time'])
    hero = img(d['g'][0]); gal = [img(x) for x in d['g'][1:]]
    wa = 'https://wa.me/%s?text=%s' % (WA, urllib.parse.quote(l['WA'] % c['dest']))
    cards, table, fmt = price_rows(d, l)
    if cards:
        av = ''.join('<article class="ac"><img src="%s" alt="%s" loading="lazy" width="800" height="500"><div class="ac-b"><h3>%s</h3><p>%s</p><div class="ac-p">%s</div></div></article>'
                     % (e(im), e(l['ACALT'] % (n, c['dest'])), e(n), e(sub), e(fmt(pr))) for n, sub, pr, im in cards)
        av_html = '<div class="ac-grid">%s</div>' % av + ('<p class="note">%s</p>' % e(table) if table else '')
    else:
        av_html = '<div class="pr">%s</div>' % table
    places = ''.join('<figure class="pl"><img src="%s" alt="%s, %s" loading="lazy" width="800" height="560"><figcaption><h3>%s</h3><p>%s</p></figcaption></figure>'
                     % (e(pimgs[k]['url']), e(pl['name']), e(c['dest_full']), e(pl['name']), e(pl['d'])) for k, pl in enumerate(c['places']))
    why = ''.join('<div class="wy"><span class="wy-n">%02d</span><h3>%s</h3><p>%s</p></div>' % (k + 1, e(w['t']), e(w['d'])) for k, w in enumerate(c['why']))
    jr = ''.join('<li><span class="jr-t">%s</span><div><h3>%s</h3><p>%s</p></div></li>' % (e(j['time']), e(j['t']), e(j['d'])) for j in c['journey'])
    faq = ''.join('<details class="fq"%s><summary>%s</summary><p>%s</p></details>' % (' open' if k == 0 else '', e(f['q']), e(f['a'])) for k, f in enumerate(c['faq']))
    story = ''.join('<p>%s</p>' % e(p) for p in c['story'])
    galhtml = ''.join('<img src="%s" alt="%s" loading="lazy" width="900" height="600">' % (e(g), e(l['GALALT'] % c['dest_full'])) for g in gal[1:])
    rel = ''.join('<a href="%s"><span>%s</span><small>%s</small></a>' % (URL(j) if lang == 'en' else ES_URL(j), e(DEST[j]['name'] if lang == 'en' else ES_NAME[j]), e(tlabel(j))) for j in ORDER if j != i)
    credits = '; '.join('%s: %s, %s' % (e(c['places'][k]['name']), e(pimgs[k]['author']), e(pimgs[k]['license'])) for k in range(len(c['places'])) if pimgs[k].get('author'))
    offers = ''
    if isinstance(d['p'], list):
        offers = ',"offers":{"@type":"AggregateOffer","priceCurrency":"USD","lowPrice":"%s","offerCount":"3"}' % d['p'][0].strip('$').replace(',', '')
    elif d['p'][0] == 'one':
        offers = ',"offers":{"@type":"Offer","priceCurrency":"USD","price":"%s"}' % d['p'][1].strip('$').replace(',', '')
    bc = [{'@type': 'ListItem', 'position': k + 1, 'name': n, 'item': u} for k, (n, u) in enumerate(l['BC'])] + [{'@type': 'ListItem', 'position': 3, 'name': c['h1'], 'item': url}]
    ld = {'@context': 'https://schema.org', '@graph': [
        {'@type': 'WebPage', '@id': url + '#webpage', 'url': url, 'name': c['title'], 'description': c['meta'], 'inLanguage': l['LANG'], 'isPartOf': {'@id': 'https://jetcab.mx/#website'}, 'about': {'@id': 'https://jetcab.mx/#organization'}, 'primaryImageOfPage': {'@type': 'ImageObject', 'url': hero}, 'speakable': {'@type': 'SpeakableSpecification', 'cssSelector': ['.answer', 'h1']}, 'breadcrumb': {'@id': url + '#breadcrumb'}},
        {'@type': 'BreadcrumbList', '@id': url + '#breadcrumb', 'itemListElement': bc},
        {'@type': 'FAQPage', '@id': url + '#faq', 'mainEntity': [{'@type': 'Question', 'name': f['q'], 'acceptedAnswer': {'@type': 'Answer', 'text': f['a']}} for f in c['faq']]}]}
    svc = '{"@type":"Service","name":%s,"serviceType":"%s","provider":{"@id":"https://jetcab.mx/#organization"},"areaServed":%s%s}' % (json.dumps(c['h1'], ensure_ascii=False), 'Private jet charter' if lang == 'en' else 'Renta de jet privado', json.dumps(c['dest_full'], ensure_ascii=False), offers)
    ldtxt = json.dumps(ld, ensure_ascii=False, separators=(',', ':'))[:-2] + ',' + svc + ']}'
    badge = e(l['BADGE'][i]) if d.get('hub') else 'Toluca (TLC) &rarr; %s (%s) · %s' % (e(name), e(d['iata']), e(tlabel(i)))
    T = TEMPLATE if not d.get('hub') else re.sub(r'<div class="rb">.*?</div></div>\s*', '', TEMPLATE, flags=re.S)
    nav = ''.join('\n    <a href="%s">%s</a>' % (u, e(n)) for n, u in l['NAV'])
    drawer = ''.join('<a href="%s">%s</a>\n  ' % (u, e(n)) for n, u in ([('Home', l['HOME'])] if lang == 'en' else []) + l['NAV'])
    ftcols = ''.join('<div><h4>%s</h4>%s</div>' % (e(h), ''.join('<a href="%s">%s</a>' % (u, e(n)) for n, u in items)) for h, items in l['FT'][:-1] + [(l['FT'][-1][0], l['FT'][-1][1] + [('Versión en español' if lang == 'en' else 'English version', alt_url)])])
    rep = {'{{BADGE}}': badge, '{{TITLE}}': e(c['title']), '{{META}}': e(c['meta']), '{{URL}}': url, '{{EN_URL}}': URL(i), '{{ES_URL}}': ES_URL(i), '{{ALT_URL}}': alt_url,
           '{{HOME}}': l['HOME'], '{{NAV}}': nav, '{{DRAWER}}': drawer, '{{FTCOLS}}': ftcols, '{{GUIDES}}': '<!--JC_GUIDES-->',
           '{{HERO}}': e(hero), '{{LD}}': ldtxt.replace('</', '<\\/'), '{{H1}}': e(c['h1']), '{{SUB}}': e(c['hero_sub']), '{{WA}}': e(wa), '{{TO}}': e(d['iata']), '{{TIME}}': e(tlabel(i)), '{{NAME}}': e(name),
           '{{ANSWER}}': e(c['answer']), '{{STORY_T}}': e(c['story_title']), '{{STORY}}': story, '{{STORY_IMG}}': e(gal[0] if gal else hero), '{{GAL}}': galhtml,
           '{{WHY_T}}': e(c['why_title']), '{{WHY}}': why, '{{JR_T}}': e(c['journey_title']), '{{JR}}': jr, '{{PR_T}}': e(l['PRT'] % c['dest']), '{{AV}}': av_html,
           '{{PL_T}}': e(c['places_title']), '{{PL}}': places, '{{BT_T}}': e(c['best_time_title']), '{{BT}}': e(c['best_time']), '{{AP_T}}': e(c['airport_title']), '{{AP}}': e(c['airport']),
           '{{DOC_T}}': e(c['docs_title']), '{{DOC}}': e(c['docs']), '{{FAQ_T}}': e(l['FAQT'] % c['dest']), '{{FAQ}}': faq, '{{CTA_T}}': e(c['cta_title']), '{{CTA_S}}': e(c['cta_sub']),
           '{{REL}}': rel, '{{CREDITS}}': (l['PHOTOS'] % credits) if credits else '',
           '{{L_HEROALT}}': e(l['HEROALT'] % c['dest_full']), '{{L_STORYALT}}': e(l['STORYALT'] % c['dest_full'])}
    for k in ['LANG', 'LOCALE', 'ALT', 'ALTSHORT', 'ALTLONG', 'QUOTE', 'MENU', 'CLOSE', 'QUOTE30', 'SEEPRICES', 'TOLUCA', 'TRUST', 'K1', 'K2', 'K3', 'K4', 'K5', 'K6', 'K7', 'PRLEAD', 'INCL', 'QUOTEWA', 'CALL', 'RELH2', 'CONTACT', 'FTP', 'ADDR', 'RANKEO']:
        rep['{{L_%s}}' % k] = l[k]
    for k, v in rep.items(): T = T.replace(k, v)
    assert '{{' not in T, re.findall(r'\{\{\w+\}\}', T)
    return T


MEDIA = json.load(open(os.path.join(HERE, 'data', '_media_sizes.json'), encoding='utf-8')) if os.path.exists(os.path.join(HERE, 'data', '_media_sizes.json')) else {}
SIZES_WIDE = '100vw'
SIZES_HALF = '(max-width: 960px) 100vw, 50vw'


def srcset(u):
    """Variantes de WordPress (768/1024/1536/2048/original) o de Unsplash para una URL de imagen."""
    if u.startswith('https://images.unsplash.com/'):
        base = re.sub(r'[?&]w=\d+', '', u)
        return base + '&w=1024', ', '.join('%s&w=%d %dw' % (base, w, w) for w in (640, 1024, 1600, 2000))
    m = MEDIA.get(u)
    if not m: return u, ''
    cand = {}
    for k in ('medium_large', 'large', '1536x1536', '2048x2048', 'full'):
        if k in m['sizes']:
            su, w, h = m['sizes'][k]
            cand[w] = su
    src = cand.get(1024) or u
    return src, ', '.join('%s %dw' % (cand[w], w) for w in sorted(cand))


def responsive(html_txt):
    """Agrega srcset/sizes a cada <img> y al preload de la portada; fuentes sin bloquear el render."""
    def rep(mo):
        tag = mo.group(0); u = html.unescape(mo.group(1))
        src, ss = srcset(u)
        if not ss: return tag
        wide = 'fetchpriority="high"' in tag or 'alt=""' in tag
        return tag.replace('src="%s"' % mo.group(1), 'src="%s" srcset="%s" sizes="%s"' % (e(src), e(ss), SIZES_WIDE if wide else SIZES_HALF), 1)
    out = re.sub(r'<img src="([^"]+)"[^>]*>', rep, html_txt)
    def pre(mo):
        u = html.unescape(mo.group(1)); src, ss = srcset(u)
        return '<link rel="preload" as="image" href="%s"%s fetchpriority="high">' % (e(src), (' imagesrcset="%s" imagesizes="100vw"' % e(ss)) if ss else '')
    out = re.sub(r'<link rel="preload" as="image" href="([^"]+)" fetchpriority="high">', pre, out)
    f = '<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Barlow:wght@300;400;500;600&display=swap" rel="stylesheet">'
    out = out.replace(f, f.replace('rel="stylesheet"', 'rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\'"') + '<noscript>' + f + '</noscript>')
    return out


TEMPLATE = open(os.path.join(HERE, 'template.html'), encoding='utf-8').read()

if __name__ == '__main__':
    langs = [a for a in sys.argv[1:] if a in ('en', 'es')] or ['en', 'es']
    only = [a for a in sys.argv[1:] if a not in ('en', 'es')] or ORDER
    pim = json.load(open(os.path.join(HERE, 'data', '_place_images.json'), encoding='utf-8'))
    for lang in langs:
        for i in only:
            src = os.path.join(HERE, 'data' if lang == 'en' else 'data_es', i + '.json')
            if not os.path.exists(src): print('falta', lang, i); continue
            c = json.load(open(src, encoding='utf-8'))
            out = responsive(page(i, c, pim[i], lang))
            assert '—' not in out and '–' not in out, i + ': raya larga'
            name = DEST[i]['slug'] if lang == 'en' else 'es/' + DEST[i]['es'].strip('/')
            os.makedirs(os.path.join(HERE, os.path.dirname(name)) if os.path.dirname(name) else HERE, exist_ok=True)
            open(os.path.join(HERE, name + '.html'), 'w', encoding='utf-8', newline='\n').write(out)
            print('ok', lang, i, name, len(out))
