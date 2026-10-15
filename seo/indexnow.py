"""Avisa a Bing (y a los buscadores de IndexNow) de URLs nuevas o cambiadas.

Uso:
  python seo/indexnow.py <url> [<url> ...]   # URLs concretas
  python seo/indexnow.py --ultimo-commit     # las <loc> que agregó el último commit al sitemap
  python seo/indexnow.py --todo              # todas las URLs del sitemap (solo tras cambios grandes)

La clave vive en la raíz del sitio: https://rankeo.agency/<KEY>.txt
"""
import json, os, re, subprocess, sys, urllib.error, urllib.request

KEY = 'baee7d98d0334497a2745e82826c5e08'
HOST = 'rankeo.agency'
REPO = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))


def urls_del_sitemap():
    with open(os.path.join(REPO, 'sitemap.xml'), encoding='utf-8') as f:
        return re.findall(r'<loc>(.*?)</loc>', f.read())


def urls_del_ultimo_commit():
    diff = subprocess.run(['git', 'diff', 'HEAD~1', 'HEAD', '--', 'sitemap.xml'],
                          cwd=REPO, capture_output=True, text=True, encoding='utf-8').stdout
    return re.findall(r'^\+\s*<loc>(.*?)</loc>', diff, re.M)


def enviar(urls):
    body = json.dumps({'host': HOST, 'key': KEY,
                       'keyLocation': f'https://{HOST}/{KEY}.txt',
                       'urlList': urls}).encode()
    req = urllib.request.Request('https://api.indexnow.org/indexnow', data=body,
                                 headers={'Content-Type': 'application/json; charset=utf-8'})
    try:
        with urllib.request.urlopen(req, timeout=30) as r:
            return r.status
    except urllib.error.HTTPError as e:
        return e.code


def main():
    args = sys.argv[1:]
    if args == ['--todo']:
        urls = urls_del_sitemap()
    elif args == ['--ultimo-commit']:
        urls = urls_del_ultimo_commit()
    else:
        urls = args
    if not urls:
        print('IndexNow: sin URLs que avisar')
        return 0
    estado = enviar(urls)
    print(f'IndexNow: {len(urls)} URL(s), respuesta {estado}')
    return 0 if estado in (200, 202) else 1


if __name__ == '__main__':
    sys.exit(main())
