"""Generador de carruseles Rankeo (Instagram + LinkedIn).

Uso: python redes/gen.py <datos.json> <carpeta-salida>
Cada entrada del JSON produce <salida>/<nombre>/slideK.html y slideK.jpg (1080x1350).
Marca fija: Oswald (titulares), Nunito (texto), Syne (logo), naranja #F04E23, negro, crema.
Fotos: oscuras, cinematográficas y tecnológicas, protagonistas en cada slide.
"""
import json, pathlib, re, subprocess, sys
from PIL import Image

PH = 'file:///C:/Users/berna_1oneq3n/Downloads/rankeo/'
CHROME = r'C:\Program Files\Google\Chrome\Application\chrome.exe'


def hl(t):
    return re.sub(r'\*(.+?)\*', r'<span class="o">\1</span>', t)


def icon(bg='#F04E23', fg='#fff'):
    return (f'<svg viewBox="0 0 88 88" class="ic"><rect width="88" height="88" rx="20" fill="{bg}"/>'
            f'<line x1="44" y1="70" x2="44" y2="26" stroke="{fg}" stroke-width="6.5" stroke-linecap="round"/>'
            f'<polyline points="25,45 44,25 63,45" fill="none" stroke="{fg}" stroke-width="6.5" stroke-linecap="round" stroke-linejoin="round"/></svg>')


def logo(c='#fff', k='#F04E23', bg='#F04E23', fg='#fff', tag='rgba(255,255,255,.7)', cls='logo'):
    return (f'<div class="{cls}">{icon(bg, fg)}<div><div class="wm" style="color:{c}">Ran<span style="color:{k}">keo</span></div>'
            f'<div class="tg" style="color:{tag}">SEO + GEO · COLOMBIA · MÉXICO · USA</div></div></div>')


CSS = """@import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;500;700&family=Nunito:wght@500;600;700;800;900&family=Syne:wght@800&display=swap');
*{margin:0;padding:0;box-sizing:border-box}html,body{width:1080px;height:1350px;overflow:hidden}body{position:relative;font-family:Nunito,sans-serif}
.o{color:#F04E23}
.logo,.logo.sm{display:flex;align-items:center;gap:14px}.logo .ic{width:52px;height:52px}
.wm{font-family:Syne;font-weight:800;font-size:50px;letter-spacing:-2px;line-height:.9}.tg{font-family:Syne;font-weight:800;font-size:10px;letter-spacing:3px;margin-top:6px;white-space:nowrap}
h1,h2{font-family:Oswald;font-weight:700;text-transform:uppercase;line-height:1.04}
.sm .ic{width:42px;height:42px}.sm .wm{font-size:40px}.sm .tg{display:none}
.ph{background-size:cover}
"""


def page(cls, css, inner):
    return f'<!doctype html><html><head><meta charset="utf-8"><style>{CSS}{css}</style></head><body class="{cls}">{inner}</body></html>'


def bg(s):
    return f'background-image:url({PH}{s["img"]});background-position:{s.get("pos", "center")}'


SM = logo(cls='logo sm')
SM_DARK = logo('#111', cls='logo sm')

# ---------- Plantilla: error vs solución (foto arriba, solución abajo) ----------
EFCSS = """
.cv{background:#0b0b0b}.cv .ph{position:absolute;inset:0}
.cv .ph:after{content:'';position:absolute;inset:0;background:linear-gradient(180deg,rgba(0,0,0,.6) 0%,rgba(0,0,0,.1) 25%,rgba(0,0,0,.3) 48%,rgba(0,0,0,.9) 70%,rgba(0,0,0,.97) 100%)}
.cv .logo{position:absolute;top:56px;left:60px}
.cv .tag{position:absolute;bottom:470px;left:70px;display:flex;font-family:Oswald;font-weight:700;font-size:30px;letter-spacing:3px;transform:rotate(-2deg)}
.cv .tag span{padding:10px 22px}.cv .tag .e{background:#fff;color:#111}.cv .tag .s{background:#F04E23;color:#fff}
.cv h1{position:absolute;left:70px;right:70px;bottom:150px;color:#fff;font-size:104px}
.cv .sw{position:absolute;left:72px;bottom:70px;color:rgba(255,255,255,.75);font-weight:800;font-size:24px;letter-spacing:3px}
.bd{background:#111}
.bd .ph{position:absolute;top:0;left:0;right:0;height:760px}
.bd .ph:after{content:'';position:absolute;inset:0;background:linear-gradient(180deg,rgba(0,0,0,.5) 0%,rgba(0,0,0,0) 22%,rgba(0,0,0,.2) 50%,rgba(0,0,0,.9) 100%)}
.bd .top{position:absolute;top:52px;left:70px}
.bd .num{position:absolute;top:30px;right:60px;font-family:Oswald;font-weight:700;font-size:230px;line-height:1;color:transparent;-webkit-text-stroke:5px #fff;filter:drop-shadow(0 8px 30px rgba(0,0,0,.5))}
.bd .er{position:absolute;left:70px;right:70px;bottom:680px}
.bd .lb{display:inline-flex;align-items:center;gap:12px;font-family:Oswald;font-weight:700;font-size:30px;letter-spacing:4px;padding:8px 20px 8px 14px;border-radius:8px}
.bd .er .lb{background:#fff;color:#111}.bd .so .lb{background:#111;color:#fff}
.bd .lb svg{width:28px;height:28px}
.bd .er h2{margin-top:22px;font-size:92px;color:#fff;text-decoration:line-through;text-decoration-color:#F04E23;text-decoration-thickness:8px;text-shadow:0 4px 24px rgba(0,0,0,.6)}
.bd .so{position:absolute;top:720px;left:0;right:0;bottom:0;background:#F04E23;border-radius:44px 44px 0 0;padding:60px 70px 0}
.bd .so h2{margin-top:26px;font-size:68px;color:#fff}
.bd .so p{margin-top:24px;font-size:37px;line-height:1.42;color:#fff;font-weight:600}
.bd .so p b{font-weight:900;color:#111}
.bd .ft{position:absolute;left:70px;right:70px;bottom:44px}
.bd .ft .cnt{font-family:Oswald;font-weight:500;font-size:26px;letter-spacing:4px;color:rgba(255,255,255,.9)}
.cl{background:#0b0b0b}.cl .ph{position:absolute;inset:0}
.cl .ph:after{content:'';position:absolute;inset:0;background:linear-gradient(180deg,rgba(10,8,6,.75),rgba(10,8,6,.55) 40%,rgba(10,8,6,.93))}
.cl .logo{position:absolute;top:70px;left:50%;transform:translateX(-50%)}
.cl h1{position:absolute;top:360px;left:80px;right:80px;text-align:center;color:#fff;font-size:126px}
.cl p{position:absolute;top:740px;left:110px;right:110px;text-align:center;color:#fff;font-size:40px;line-height:1.4;font-weight:700}
.cl p b{color:#F04E23;font-weight:900}
.cl .btn{position:absolute;bottom:160px;left:50%;transform:translateX(-50%);background:#F04E23;color:#fff;font-family:Oswald;font-weight:700;font-size:46px;letter-spacing:2px;padding:22px 60px;border-radius:14px;white-space:nowrap;text-transform:uppercase;box-shadow:0 0 40px rgba(240,78,35,.45)}
.cl .url{position:absolute;bottom:80px;left:0;right:0;text-align:center;color:rgba(255,255,255,.8);font-weight:900;font-size:26px;letter-spacing:3px}
"""
X = '<svg viewBox="0 0 30 30"><path d="M7 7l16 16M23 7L7 23" stroke="#F04E23" stroke-width="5" stroke-linecap="round"/></svg>'
OK = '<svg viewBox="0 0 30 30"><path d="M6 16l6 6L24 8" fill="none" stroke="#F04E23" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/></svg>'


def errfix(c):
    n = len(c['body'])
    cv = c['cover']
    fs = [page('cv', EFCSS, f'<div class="ph" style="{bg(cv)}"></div>{logo()}'
                            f'<div class="tag"><span class="e">ERROR</span><span class="s">SOLUCIÓN</span></div>'
                            f'<h1>{hl(cv["h"])}</h1><div class="sw">DESLIZA Y REVISA LA TUYA →</div>')]
    for i, s in enumerate(c['body'], 1):
        fs.append(page('bd', EFCSS,
                       f'<div class="ph" style="{bg(s)}"></div><div class="top">{SM}</div><div class="num">{i}</div>'
                       f'<div class="er"><div class="lb">{X}ERROR</div><h2>{s["err"]}</h2></div>'
                       f'<div class="so"><div class="lb">{OK}SOLUCIÓN</div><h2>{s["sol"]}</h2><p>{s["p"]}</p></div>'
                       f'<div class="ft"><span class="cnt">{i:02d} / {n:02d}</span></div>'))
    cl = c['close']
    fs.append(page('cl', EFCSS, f'<div class="ph" style="{bg(cl)}"></div>{logo()}<h1>{hl(cl["h"])}</h1><p>{cl["p"]}</p>'
                                f'<div class="btn">{cl["btn"]}</div><div class="url">RANKEO.AGENCY</div>'))
    return fs


# ---------- Plantilla: editorial (foto grande arriba, número gigante) ----------
EDCSS = """
.cv{background:#0b0b0b}.cv .ph{position:absolute;inset:0}
.cv .ph:after{content:'';position:absolute;inset:0;background:linear-gradient(180deg,rgba(0,0,0,.6),rgba(0,0,0,.2) 28%,rgba(0,0,0,.85) 58%,rgba(0,0,0,.97))}
.cv .logo{position:absolute;top:56px;left:60px}
.cv .k{position:absolute;bottom:590px;left:80px;font-family:Oswald;font-weight:500;font-size:28px;letter-spacing:6px;color:#fff;background:#F04E23;padding:6px 16px}
.cv h1{position:absolute;bottom:250px;left:80px;right:80px;color:#fff;font-size:100px}
.cv .sub{position:absolute;bottom:140px;left:80px;right:160px;color:rgba(255,255,255,.88);font-size:32px;font-weight:600;line-height:1.4}
.cv .sw{position:absolute;bottom:70px;left:80px;color:rgba(255,255,255,.6);font-weight:800;font-size:22px;letter-spacing:4px}
.bd{background:#f4f1ec}
.bd .ph{position:absolute;top:0;left:0;right:0;height:700px}
.bd .ph:after{content:'';position:absolute;inset:0;background:linear-gradient(180deg,rgba(0,0,0,.45),rgba(0,0,0,0) 25%,rgba(0,0,0,0) 55%,rgba(0,0,0,.6))}
.bd .top{position:absolute;top:52px;left:70px}
.bd .k{position:absolute;top:58px;right:70px;font-family:Oswald;font-weight:500;font-size:26px;letter-spacing:5px;color:#fff;background:#F04E23;padding:6px 16px}
.bd .num{position:absolute;top:450px;left:58px;font-family:Oswald;font-weight:700;font-size:300px;line-height:1;color:transparent;-webkit-text-stroke:6px #fff;filter:drop-shadow(0 8px 30px rgba(0,0,0,.5))}
.bd h2{position:absolute;top:760px;left:80px;right:80px;font-size:80px;color:#111}
.bd p{position:absolute;top:960px;left:80px;right:90px;font-size:40px;line-height:1.45;color:#333;font-weight:600}
.bd p b{color:#111;font-weight:900;box-shadow:inset 0 -14px 0 rgba(240,78,35,.35)}
.bd .ft{position:absolute;left:80px;right:80px;bottom:50px;display:flex;justify-content:space-between;align-items:center}
.bd .ft .cnt{font-family:Oswald;font-weight:500;font-size:26px;letter-spacing:4px;color:#777}
.cl{background:#0b0b0b}.cl .ph{position:absolute;inset:0}
.cl .ph:after{content:'';position:absolute;inset:0;background:linear-gradient(180deg,rgba(10,8,6,.7),rgba(10,8,6,.5) 40%,rgba(10,8,6,.93))}
.cl .logo{position:absolute;top:70px;left:50%;transform:translateX(-50%)}
.cl h1{position:absolute;top:380px;left:90px;right:90px;text-align:center;color:#fff;font-size:100px}
.cl p{position:absolute;top:760px;left:120px;right:120px;text-align:center;color:#fff;font-size:38px;line-height:1.4;font-weight:600}
.cl .btn{position:absolute;bottom:160px;left:50%;transform:translateX(-50%);background:#F04E23;color:#fff;font-family:Oswald;font-weight:700;font-size:44px;letter-spacing:2px;padding:20px 60px;border-radius:14px;white-space:nowrap;text-transform:uppercase;box-shadow:0 0 40px rgba(240,78,35,.45)}
.cl .url{position:absolute;bottom:80px;left:0;right:0;text-align:center;color:rgba(255,255,255,.8);font-weight:900;font-size:24px;letter-spacing:3px}
"""


def editorial(c):
    n = len(c['body'])
    cv = c['cover']
    fs = [page('cv', EDCSS, f'<div class="ph" style="{bg(cv)}"></div>{logo()}<div class="k">{cv["k"]}</div>'
                            f'<h1>{hl(cv["h"])}</h1><div class="sub">{cv["sub"]}</div><div class="sw">DESLIZA →</div>')]
    for i, s in enumerate(c['body'], 1):
        fs.append(page('bd', EDCSS,
                       f'<div class="ph" style="{bg(s)}"></div><div class="top">{SM}</div><div class="k">{s["k"]}</div>'
                       f'<div class="num">{i:02d}</div><h2>{hl(s["h"])}</h2><p>{s["p"]}</p>'
                       f'<div class="ft"><span class="cnt">{i:02d} / {n:02d}</span>{SM_DARK}</div>'))
    cl = c['close']
    fs.append(page('cl', EDCSS, f'<div class="ph" style="{bg(cl)}"></div>{logo()}<h1>{hl(cl["h"])}</h1><p>{cl["p"]}</p>'
                                f'<div class="btn">{cl["btn"]}</div><div class="url">RANKEO.AGENCY</div>'))
    return fs


TPL = {'errfix': errfix, 'editorial': editorial}


def render(html, png):
    subprocess.run([CHROME, '--headless=new', '--disable-gpu', '--hide-scrollbars', '--allow-file-access-from-files',
                    '--virtual-time-budget=6000', '--window-size=1080,1350', f'--screenshot={png}', html.as_uri()],
                   check=True, capture_output=True)


def preview(jpgs, out):
    W, H, g = 480, 600, 16
    cols = 4
    rows = (len(jpgs) + cols - 1) // cols
    sheet = Image.new('RGB', (cols * W + (cols + 1) * g, rows * H + (rows + 1) * g), (34, 34, 34))
    for i, j in enumerate(jpgs):
        im = Image.open(j).resize((W, H))
        sheet.paste(im, (g + (i % cols) * (W + g), g + (i // cols) * (H + g)))
    sheet.save(out, quality=85)


if __name__ == '__main__':
    data = json.load(open(sys.argv[1], encoding='utf-8'))
    OUT = pathlib.Path(sys.argv[2])
    for name, c in data.items():
        d = OUT / name
        d.mkdir(parents=True, exist_ok=True)
        jpgs = []
        for k, h in enumerate(TPL[c['tpl']](c), 1):
            html = (d / f'slide{k}.html').resolve()
            html.write_text(h, encoding='utf-8')
            png = d / f'slide{k}.png'
            render(html, png)
            jpg = d / f'slide{k}.jpg'
            Image.open(png).convert('RGB').save(jpg, quality=92)
            png.unlink()
            jpgs.append(jpg)
        preview(jpgs, d / 'vista-previa.jpg')
        print(name, len(jpgs), 'slides')
