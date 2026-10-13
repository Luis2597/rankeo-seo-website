"""Genera las páginas de destino en inglés de JETCAB (una por destino) desde data/<id>.json.
Uso: python build.py  ->  escribe <slug>.html en esta carpeta. Las sirve el snippet «JETCAB destinos EN v5».
Hechos de JETCAB (precios, tiempos, aeropuertos) viven aquí en DEST; el texto de cada destino en data/."""
import json, os, html, re, sys

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

def price_rows(d):
    p = d['p']
    def row(a, b): return '<div class="pr-r"><span>%s</span><b>%s</b></div>' % (e(a), e('from ' + b + ' USD' if b.startswith('$') else b))
    if isinstance(p, list):
        return [('Learjet 35', 'Light jet · up to 7 passengers' + (' · one fuel stop' if d.get('stop') else ''), p[0], LJ),
                ('Challenger 605', 'Midsize · up to 12 passengers · stand-up cabin', p[1], CL),
                ('Gulfstream GV', 'Long range · up to 16 passengers', p[2], GV)], None
    if p[0] == 'one':
        return [('Learjet 35', 'Light jet · up to 7 passengers', p[1], LJ), ('Challenger 605', 'Midsize · up to 12 passengers', REQ, CL), ('Gulfstream GV', 'Long range · up to 16 passengers', REQ, GV)], 'Full-aircraft price from ' + p[1] + ' USD. Other cabins are quoted in 30 minutes.'
    if p[0] == 'long':
        return [('Gulfstream GV', 'Long range · up to 16 passengers · nonstop', '$100,000', GV), ('Global Express', 'Long range · up to 16 passengers', REQ, GV), ('Challenger 605', 'Midsize · up to 12 passengers · technical stop', REQ, CL)], None
    return None, ''.join(row(a, b) for a, b in p[1])

def page(i, c, pimgs):
    d = DEST[i]; url = URL(i); es_url = 'https://jetcab.mx' + d['es']
    hero = img(d['g'][0]); gal = [img(x) for x in d['g'][1:]]
    kw = c['primary_kw']
    wa = 'https://wa.me/%s?text=%s' % (WA, re.sub(r'\s', '+', "Hi JETCAB, I'd like a quote for a private jet to %s." % c['dest']).replace("'", '%27').replace(',', '%2C'))
    cards, table = price_rows(d)
    # aviones
    if cards:
        av = ''.join('<article class="ac"><img src="%s" alt="%s private jet charter to %s" loading="lazy" width="800" height="500"><div class="ac-b"><h3>%s</h3><p>%s</p><div class="ac-p">%s</div></div></article>'
                     % (e(im), e(n), e(c['dest']), e(n), e(sub), e('from ' + pr + ' USD' if pr.startswith('$') else pr)) for n, sub, pr, im in cards)
        av_html = '<div class="ac-grid">%s</div>' % av
        if table: av_html += '<p class="note">%s</p>' % e(table)
    else:
        av_html = '<div class="pr">%s</div>' % table
    places = ''.join('<figure class="pl"><img src="%s" alt="%s, %s" loading="lazy" width="800" height="560"><figcaption><h3>%s</h3><p>%s</p></figcaption></figure>'
                     % (e(pimgs[k]['url']), e(pl['name']), e(c['dest_full']), e(pl['name']), e(pl['d'])) for k, pl in enumerate(c['places']))
    why = ''.join('<div class="wy"><span class="wy-n">%02d</span><h3>%s</h3><p>%s</p></div>' % (k + 1, e(w['t']), e(w['d'])) for k, w in enumerate(c['why']))
    jr = ''.join('<li><span class="jr-t">%s</span><div><h3>%s</h3><p>%s</p></div></li>' % (e(j['time']), e(j['t']), e(j['d'])) for j in c['journey'])
    faq = ''.join('<details class="fq"%s><summary>%s</summary><p>%s</p></details>' % (' open' if k == 0 else '', e(f['q']), e(f['a'])) for k, f in enumerate(c['faq']))
    story = ''.join('<p>%s</p>' % e(p) for p in c['story'])
    galhtml = ''.join('<img src="%s" alt="%s, private jet destination" loading="lazy" width="900" height="600">' % (e(g), e(c['dest_full'])) for g in gal[1:])
    rel = ''.join('<a href="%s"><span>%s</span><small>%s</small></a>' % (URL(j), e(DEST[j]['name']), e(DEST[j]['time'])) for j in ORDER if j != i)
    credits = '; '.join('%s: %s, %s' % (e(c['places'][k]['name']), e(pimgs[k]['author']), e(pimgs[k]['license'])) for k in range(len(c['places'])) if pimgs[k].get('author'))
    offers = ''
    if isinstance(d['p'], list):
        offers = ',"offers":{"@type":"AggregateOffer","priceCurrency":"USD","lowPrice":"%s","offerCount":"3"}' % d['p'][0].strip('$').replace(',', '')
    elif d['p'][0] == 'one':
        offers = ',"offers":{"@type":"Offer","priceCurrency":"USD","price":"%s"}' % d['p'][1].strip('$').replace(',', '')
    ld = {'@context': 'https://schema.org', '@graph': [
        {'@type': 'WebPage', '@id': url + '#webpage', 'url': url, 'name': c['title'], 'description': c['meta'], 'inLanguage': 'en', 'isPartOf': {'@id': 'https://jetcab.mx/#website'}, 'about': {'@id': 'https://jetcab.mx/#organization'}, 'primaryImageOfPage': {'@type': 'ImageObject', 'url': hero}, 'speakable': {'@type': 'SpeakableSpecification', 'cssSelector': ['.answer', 'h1']}, 'breadcrumb': {'@id': url + '#breadcrumb'}},
        {'@type': 'BreadcrumbList', '@id': url + '#breadcrumb', 'itemListElement': [{'@type': 'ListItem', 'position': 1, 'name': 'JETCAB', 'item': 'https://jetcab.mx/en/'}, {'@type': 'ListItem', 'position': 2, 'name': 'Destinations', 'item': 'https://jetcab.mx/private-jet-destination-guide/'}, {'@type': 'ListItem', 'position': 3, 'name': c['h1'], 'item': url}]},
        {'@type': 'FAQPage', '@id': url + '#faq', 'mainEntity': [{'@type': 'Question', 'name': f['q'], 'acceptedAnswer': {'@type': 'Answer', 'text': f['a']}} for f in c['faq']]}]}
    svc = '{"@type":"Service","name":%s,"serviceType":"Private jet charter","provider":{"@id":"https://jetcab.mx/#organization"},"areaServed":%s%s}' % (json.dumps(c['h1']), json.dumps(c['dest_full']), offers)
    ldtxt = json.dumps(ld, ensure_ascii=False, separators=(',', ':'))
    ldtxt = ldtxt[:-2] + ',' + svc + ']}'
    if d.get('hub'):
        badge = {'toluca': 'JETCAB home base · Toluca International Airport (TLC)', 'cdmx': 'Departures from Toluca (TLC) · 65 km from Mexico City', 'estadosunidos': 'Toluca (TLC) to the United States · from 1h 30m'}[i]
    else:
        badge = 'Toluca (TLC) &rarr; %s (%s) · %s' % (e(d['name']), e(d['iata']), e(d['time']))
    T = TEMPLATE if not d.get('hub') else re.sub(r'<div class="rb">.*?</div></div>\s*', '', TEMPLATE, flags=re.S)
    rep = {
        '{{BADGE}}': badge, '{{TITLE}}': e(c['title']), '{{META}}': e(c['meta']), '{{URL}}': url, '{{ES}}': es_url, '{{HERO}}': e(hero), '{{LD}}': ldtxt.replace('</', '<\\/'),
        '{{H1}}': e(c['h1']), '{{SUB}}': e(c['hero_sub']), '{{WA}}': e(wa), '{{FROM}}': 'TLC', '{{TO}}': e(d['iata']), '{{TIME}}': e(d['time']), '{{NAME}}': e(d['name']), '{{DESTFULL}}': e(c['dest_full']),
        '{{ANSWER}}': e(c['answer']), '{{STORY_T}}': e(c['story_title']), '{{STORY}}': story, '{{STORY_IMG}}': e(gal[0] if gal else hero), '{{GAL}}': galhtml,
        '{{WHY_T}}': e(c['why_title']), '{{WHY}}': why, '{{JR_T}}': e(c['journey_title']), '{{JR}}': jr, '{{PR_T}}': e('Private jet prices to ' + c['dest']), '{{AV}}': av_html,
        '{{PL_T}}': e(c['places_title']), '{{PL}}': places, '{{BT_T}}': e(c['best_time_title']), '{{BT}}': e(c['best_time']), '{{AP_T}}': e(c['airport_title']), '{{AP}}': e(c['airport']),
        '{{DOC_T}}': e(c['docs_title']), '{{DOC}}': e(c['docs']), '{{FAQ_T}}': e(c['dest'] + ' private jet FAQ'), '{{FAQ}}': faq, '{{CTA_T}}': e(c['cta_title']), '{{CTA_S}}': e(c['cta_sub']),
        '{{REL}}': rel, '{{CREDITS}}': ('Photos of ' + credits + '. Wikimedia Commons.') if credits else '', '{{KW}}': e(kw),
    }
    for k, v in rep.items(): T = T.replace(k, v)
    assert '{{' not in T, re.findall(r'\{\{\w+\}\}', T)
    return T

TEMPLATE = open(os.path.join(HERE, 'template.html'), encoding='utf-8').read()

if __name__ == '__main__':
    pim = json.load(open(os.path.join(HERE, 'data', '_place_images.json'), encoding='utf-8'))
    only = sys.argv[1:] or ORDER
    for i in only:
        c = json.load(open(os.path.join(HERE, 'data', i + '.json'), encoding='utf-8'))
        out = page(i, c, pim[i])
        assert '—' not in out and '–' not in out, i + ': raya larga'
        open(os.path.join(HERE, DEST[i]['slug'] + '.html'), 'w', encoding='utf-8', newline='\n').write(out)
        print('ok', i, DEST[i]['slug'], len(out))
