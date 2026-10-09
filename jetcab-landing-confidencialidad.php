<?php
/*
 * JETCAB Landing — Vuelos Privados Confidenciales (Identity Shield)
 * /vuelos-privados-confidenciales/
 * Keyword: vuelos privados confidenciales México · Avatar: El Poder Silencioso
 * Mismo patrón técnico que jetcab-routes-domestic-v1.php (rewrite + query var + template_redirect).
 */

add_action("init", function() {
    add_rewrite_rule('^(vuelos-privados-confidenciales)/?$', 'index.php?jetcab_landing=$matches[1]', 'top');
});
add_filter("query_vars", function($vars) { $vars[] = "jetcab_landing"; return $vars; });
add_action("template_redirect", function() {
    $slug = get_query_var("jetcab_landing");
    if (!$slug) return;
    $pages = [
        "vuelos-privados-confidenciales" => [
            "title"     => 'Vuelos Privados Confidenciales en México | Identity Shield',
            "meta_desc" => 'Vuelos privados confidenciales en México con protocolo Identity Shield: tripulación bajo NDA, abordaje directo sin terminal y FBO privado Toluca. JETCAB.',
            "h1"        => 'Vuelos privados confidenciales en México',
            "tag"       => 'Identity Shield · Confidencialidad de grado gubernamental',
            "sub"       => 'Nadie sabe que voló. Nadie sabe con quién. Abordaje directo en el FBO privado de Toluca, tripulación bajo acuerdo de confidencialidad y cero exposición en terminales comerciales.',
            "wa_text"   => 'Hola%2C+necesito+un+vuelo+privado+con+protocolo+de+confidencialidad.',
            "hero_img"  => '1436491865332-7a61a109cc05',
            "hero_alt"  => 'Jet privado en plataforma de Toluca al atardecer, vuelos privados confidenciales en México',
            "img_1"     => '1540962351504-03099e0a754b',
            "alt_1"     => 'Gulfstream en plataforma privada, abordaje directo sin terminal comercial',
            "img_2"     => '1521791136064-7986c2920216',
            "alt_2"     => 'Oficina ejecutiva en penumbra, discreción para directivos y figuras públicas',
            "img_3"     => '1581093806997-124204d9fa9d',
            "alt_3"     => 'Cabina exclusiva de jet privado Challenger, conversaciones que se quedan a bordo',
            "answer"    => 'Un vuelo privado confidencial es una operación en la que el pasajero no pasa por ninguna terminal comercial, no aparece en sistemas de reservación públicos, aborda directamente desde su vehículo en el FBO privado del Aeropuerto Internacional de Toluca (AIT) y vuela con una tripulación que firmó un acuerdo de confidencialidad. En JETCAB este protocolo se llama Identity Shield, se aplica en cada vuelo nacional o internacional y no tiene cargo adicional: desde $1,800 USD por aeronave en rutas cortas.',
            "faqs" => [
                ["q" => '¿Qué incluye el protocolo Identity Shield de JETCAB?', "a" => 'Cuatro capas: tripulación bajo acuerdo de confidencialidad firmado antes de cada vuelo, abordaje directo desde su vehículo en el FBO privado de Toluca (AIT), ausencia de su nombre en sistemas de reservación comercial y última milla coordinada con camioneta blindada. Se aplica sin costo adicional en cada aeronave de la flota, del Learjet 35 al Gulfstream GV.'],
                ["q" => '¿Mi nombre aparece en algún registro público al volar en jet privado?', "a" => 'No en sistemas comerciales, pantallas de terminal ni listas de abordaje de aerolínea. El manifiesto de vuelo se entrega únicamente a la autoridad aeronáutica mexicana, como exige la ley, y no es de acceso público. En la plataforma del FBO privado de Toluca nadie más que su tripulación conoce su identidad ni su destino.'],
                ["q" => '¿La tripulación firma un acuerdo de confidencialidad?', "a" => 'Sí. Pilotos y personal de cabina firman un acuerdo de confidencialidad (NDA) antes de cada operación con cliente Identity Shield. Prohíbe comentar, fotografiar o compartir cualquier dato del vuelo: pasajeros, acompañantes, conversaciones, destino o itinerario. Si su empresa exige un NDA propio, la tripulación lo firma antes de abordar.'],
                ["q" => '¿Cómo es el abordaje sin pasar por terminal?', "a" => 'Su camioneta ingresa a la plataforma del FBO privado del Aeropuerto Internacional de Toluca (AIT), con acceso controlado, y lo deja al pie de la escalinata. No hay sala de espera, mostrador, filtro comercial ni pasajeros ajenos. Del tarmac a la cabina transcurren menos de 10 minutos. Basta llegar 15 minutos antes del despegue.'],
                ["q" => '¿Cuánto cuesta un vuelo privado confidencial en México?', "a" => 'Lo mismo que cualquier vuelo privado JETCAB: Identity Shield no tiene cargo adicional. Referencia CDMX–Cancún: Learjet 35 desde $3,200 USD, Challenger 605 desde $6,500 USD y Gulfstream GV desde $12,000 USD por aeronave. Rutas cortas como Toluca–Guadalajara desde $1,800 USD. Cotización por WhatsApp en 30 minutos.'],
                ["q" => '¿Puedo viajar con acompañantes sin que figuren en ningún lado?', "a" => 'Sus acompañantes reciben el mismo tratamiento: ninguno aparece en sistemas comerciales y la tripulación no registra nombres fuera del manifiesto legal. En una cabina exclusiva de 7 a 16 asientos solo viaja su grupo. Escoltas, asistentes o personal de seguridad abordan por la misma escalinata, sin filtros separados ni registros adicionales.'],
                ["q" => '¿Qué pasa al aterrizar? ¿Hay terminal en destino?', "a" => 'No. En destinos nacionales aterriza en la terminal de aviación general, separada de las salas comerciales; su vehículo lo espera al pie de la escalinata y sale en menos de 5 minutos. En destinos internacionales (Houston, Miami, Teterboro) el FBO privado procesa migración en sala reservada, sin fila pública ni contacto con pasajeros comerciales.'],
                ["q" => '¿Con cuánta anticipación puedo solicitar un vuelo confidencial?', "a" => 'Con 2 horas desde su mensaje, sujeto a disponibilidad de aeronave. La coordinación se hace con un solo interlocutor por WhatsApp o llamada; no hay formularios en línea ni correos a listas de distribución. Para vuelos internacionales recomendamos 24 horas de anticipación por permisos de sobrevuelo y slots del FBO en destino.'],
            ],
        ],
    ];
    if (!isset($pages[$slug])) return;
    status_header(200);
    header("Content-Type: text/html; charset=UTF-8");
    echo jetcab_landing_confidencialidad_page($pages[$slug], $slug);
    exit;
});


if (!function_exists('jc_json_str')) {
    // Escapa un string para usarlo dentro de un literal JSON (esc_js produce \' que es JSON inválido).
    function jc_json_str($str) {
        return substr(json_encode((string)$str, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), 1, -1);
    }
}

function jetcab_landing_confidencialidad_page($p, $slug) {
    $wa = 'https://wa.me/527291081200?text=' . $p['wa_text'];
    $canonical = 'https://jetcab.mx/' . $slug . '/';
    $hero_url = 'https://images.unsplash.com/photo-' . $p['hero_img'] . '?auto=format&fit=crop&w=1400&q=80';
    ob_start();
?><!DOCTYPE html>
<html lang="es-MX">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo esc_html($p['title']); ?></title>
<meta name="description" content="<?php echo esc_attr($p['meta_desc']); ?>">
<link rel="canonical" href="<?php echo $canonical; ?>">
<link rel="alternate" hreflang="es" href="<?php echo $canonical; ?>">
<link rel="alternate" hreflang="x-default" href="<?php echo $canonical; ?>">
<meta property="og:title" content="<?php echo esc_attr($p['title']); ?>">
<meta property="og:description" content="<?php echo esc_attr($p['meta_desc']); ?>">
<meta property="og:url" content="<?php echo $canonical; ?>">
<meta property="og:type" content="website">
<meta property="og:locale" content="es_MX">
<meta property="og:image" content="https://jetcab.mx/wp-content/uploads/2023/09/jetcab-og.jpg">
<meta name="twitter:card" content="summary_large_image">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800&family=Barlow:wght@300;400;500;600&display=swap" rel="stylesheet">
<script type="application/ld+json">
{"@context":"https://schema.org","@graph":[
{"@type":"WebPage","@id":"<?php echo $canonical; ?>","url":"<?php echo $canonical; ?>","name":"<?php echo jc_json_str($p['title']); ?>","description":"<?php echo jc_json_str($p['meta_desc']); ?>","inLanguage":"es-MX","isPartOf":{"@type":"WebSite","@id":"https://jetcab.mx/#website","url":"https://jetcab.mx","name":"JETCAB"}},
{"@type":"Service","name":"Vuelos privados confidenciales en México — Protocolo Identity Shield","description":"<?php echo jc_json_str($p['meta_desc']); ?>","provider":{"@type":"LocalBusiness","name":"JETCAB","url":"https://jetcab.mx","telephone":"+52-729-108-1200","foundingDate":"1999","areaServed":"México"},"serviceType":"Renta de jet privado con protocolo de confidencialidad","areaServed":["México","Estados Unidos"],"audience":{"@type":"Audience","audienceType":"Directivos, consejos de administración, figuras públicas y familias de alto patrimonio"},"offers":{"@type":"Offer","priceCurrency":"USD","price":"1800","priceSpecification":{"@type":"UnitPriceSpecification","priceCurrency":"USD","price":"1800","unitText":"por aeronave, ruta corta"}}},
{"@type":"FAQPage","mainEntity":[<?php $fq=array_map(function($f){return '{"@type":"Question","name":"'.jc_json_str($f["q"]).'","acceptedAnswer":{"@type":"Answer","text":"'.jc_json_str($f["a"]).'"}}';},$p['faqs']);echo implode(',',$fq);?>]}
]}
</script>
<style>
:root{--orange:#E85A1E;--gold:#C9973F;--dark:#0D0D0D;--dark2:#141414;--text:#E8E8E8;--muted:#888;--ff-head:'Barlow Condensed',sans-serif;--ff-body:'Barlow',sans-serif}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{background:var(--dark);color:var(--text);font-family:var(--ff-body);line-height:1.6}
.jc-nav{position:fixed;top:0;left:0;right:0;z-index:100;display:flex;align-items:center;justify-content:space-between;padding:1rem 2rem;background:rgba(13,13,13,0.9);backdrop-filter:blur(14px);border-bottom:1px solid rgba(255,255,255,0.07)}
.jc-nav-logo{font-family:var(--ff-head);font-size:1.5rem;font-weight:800;letter-spacing:0.08em;color:#fff;text-decoration:none}
.jc-nav-logo span{color:var(--orange)}
.jc-nav-links{display:flex;align-items:center;gap:2rem}
.jc-nav-links a{color:var(--muted);text-decoration:none;font-size:0.875rem;transition:color 0.2s}
.jc-nav-links a:hover{color:#fff}
.jc-nav-cta{background:var(--orange);color:#fff!important;padding:0.5rem 1.25rem;border-radius:50px;font-family:var(--ff-head);font-weight:700;letter-spacing:0.05em}
.jc-nav-cta:hover{background:#ff6a2f!important}
@media(max-width:768px){.jc-nav-links{display:none}}
.jc-hero{position:relative;min-height:90vh;display:flex;align-items:flex-end;background-size:cover;background-position:center}
.jc-hero::after{content:'';position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.92) 0%,rgba(0,0,0,.45) 60%,rgba(0,0,0,.15) 100%)}
.jc-hero-inner{position:relative;z-index:2;padding:80px 24px 56px;max-width:900px;margin:0 auto;width:100%}
.jc-route-tag{font-family:var(--ff-head);font-size:.85rem;letter-spacing:.15em;text-transform:uppercase;color:var(--orange);margin-bottom:12px}
.jc-hero h1{font-family:var(--ff-head);font-size:clamp(2.5rem,6vw,5rem);font-weight:700;line-height:1.05;text-transform:uppercase;margin-bottom:16px;color:#fff}
.jc-hero-sub{font-size:1.1rem;color:rgba(255,255,255,.78);margin-bottom:32px;max-width:600px;line-height:1.6}
.jc-trust-row{display:flex;gap:2rem;flex-wrap:wrap;margin-bottom:32px}
.jc-trust-row span{font-size:0.78rem;color:rgba(255,255,255,0.45);letter-spacing:0.05em;text-transform:uppercase}
.jc-trust-row span strong{color:var(--gold);font-weight:600}
.jc-btn{display:inline-block;background:var(--orange);color:#fff;font-family:var(--ff-head);font-size:.95rem;letter-spacing:.1em;text-transform:uppercase;padding:14px 32px;border-radius:50px;text-decoration:none;transition:background 0.2s,transform 0.15s}
.jc-btn:hover{background:#ff6a2f;transform:translateY(-1px)}
.jc-btn-ghost{background:transparent;border:1px solid rgba(255,255,255,.4);margin-left:12px;color:#fff!important}
.jc-btn-ghost:hover{border-color:rgba(255,255,255,.75);background:transparent!important}
.jc-section{padding:64px 24px;max-width:900px;margin:0 auto}
.jc-section h2{font-family:var(--ff-head);font-size:clamp(1.8rem,4vw,3rem);font-weight:700;text-transform:uppercase;color:var(--orange);margin-bottom:20px;line-height:1.1}
.jc-section p{font-size:1rem;line-height:1.75;color:var(--text);margin-bottom:16px}
.jc-section p:last-child{margin-bottom:0}
.jc-answer{font-size:1.15rem!important;line-height:1.7!important;color:#fff!important;border-left:3px solid var(--gold);padding-left:20px;margin-bottom:24px!important}
.jc-quote{font-family:var(--ff-head);font-size:clamp(1.4rem,3vw,2.2rem);font-weight:600;line-height:1.25;color:#fff;border-left:4px solid var(--orange);padding-left:24px;margin:32px 0}
.jc-photo{width:100%;height:480px;object-fit:cover;display:block}
.jc-photo.tall{height:600px}
.jc-pillars{display:grid;grid-template-columns:1fr;gap:16px;margin-top:32px}
@media(min-width:640px){.jc-pillars{grid-template-columns:repeat(2,1fr)}}
.jc-pillar{background:var(--dark2);border-top:3px solid var(--orange);padding:28px 24px}
.jc-pillar .num{font-family:var(--ff-head);font-size:2.4rem;font-weight:800;color:var(--gold);line-height:1;margin-bottom:10px}
.jc-pillar h3{font-family:var(--ff-head);font-size:1.3rem;font-weight:700;text-transform:uppercase;letter-spacing:.04em;color:#fff;margin-bottom:10px}
.jc-pillar p{font-size:.92rem;color:#aaa;line-height:1.65;margin:0}
.jc-steps{list-style:none;margin:32px 0 0;counter-reset:step}
.jc-steps li{position:relative;padding:0 0 28px 64px;border-left:1px solid rgba(255,255,255,.12);margin-left:20px}
.jc-steps li:last-child{padding-bottom:0}
.jc-steps li::before{counter-increment:step;content:counter(step,decimal-leading-zero);position:absolute;left:-21px;top:-4px;width:42px;height:42px;border-radius:50%;background:var(--dark);border:1px solid var(--orange);color:var(--orange);font-family:var(--ff-head);font-weight:700;font-size:1rem;display:flex;align-items:center;justify-content:center}
.jc-steps h3{font-family:var(--ff-head);font-size:1.25rem;font-weight:700;text-transform:uppercase;color:#fff;margin-bottom:6px;letter-spacing:.03em}
.jc-steps p{font-size:.95rem;color:#aaa;line-height:1.65;margin:0}
.jc-fleet-grid{display:grid;grid-template-columns:1fr;gap:16px;margin-top:32px}
@media(min-width:640px){.jc-fleet-grid{grid-template-columns:repeat(2,1fr)}}
.jc-fleet-card{background:var(--dark2);border:1px solid rgba(255,255,255,.07);border-radius:6px;overflow:hidden;transition:border-color 0.2s,transform 0.2s}
.jc-fleet-card:hover{border-color:rgba(232,90,30,.4);transform:translateY(-2px)}
.jc-fleet-card-img{position:relative;aspect-ratio:16/10;overflow:hidden}
.jc-fleet-card-img img{width:100%;height:100%;object-fit:cover;opacity:0.85;transition:opacity 0.3s;display:block}
.jc-fleet-card:hover .jc-fleet-card-img img{opacity:1}
.jc-fleet-badge{position:absolute;bottom:10px;left:10px;font-family:var(--ff-head);font-size:0.7rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:var(--orange);background:rgba(0,0,0,.85);padding:4px 8px;border-radius:2px}
.jc-fleet-body{padding:20px}
.jc-fleet-class{font-size:.7rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:var(--orange);margin-bottom:4px}
.jc-fleet-name{font-family:var(--ff-head);font-size:1.4rem;font-weight:800;color:#fff;margin-bottom:8px}
.jc-fleet-desc{font-size:.85rem;color:#999;line-height:1.6;margin-bottom:12px}
.jc-fleet-specs{display:flex;gap:16px;flex-wrap:wrap;margin-bottom:12px}
.jc-fleet-spec{font-size:.78rem;color:var(--muted)}
.jc-fleet-spec strong{display:block;font-size:.92rem;color:#fff;font-weight:700;font-family:var(--ff-head)}
.jc-fleet-price{display:flex;align-items:baseline;gap:6px;margin-bottom:12px}
.jc-fleet-price-from{font-size:.72rem;color:var(--muted)}
.jc-fleet-price-amount{font-family:var(--ff-head);font-size:1.5rem;font-weight:800;color:var(--gold)}
.jc-fleet-cta{display:block;text-align:center;background:transparent;border:1px solid var(--orange);color:var(--orange);padding:10px;border-radius:4px;font-size:.875rem;font-weight:600;text-decoration:none;transition:background 0.2s,color 0.2s;font-family:var(--ff-head);letter-spacing:.05em;text-transform:uppercase}
.jc-fleet-cta:hover{background:var(--orange);color:#fff}
.jc-faq{margin:32px 0 0}
.jc-faq-item{border-bottom:1px solid rgba(255,255,255,.1);padding:20px 0}
.jc-faq-item:first-child{border-top:1px solid rgba(255,255,255,.1)}
.jc-faq-item h3{font-family:var(--ff-head);font-size:1.15rem;font-weight:600;color:var(--text);margin-bottom:8px}
.jc-faq-item p{font-size:.95rem;color:var(--muted);line-height:1.65;margin:0}
.jc-links{display:grid;grid-template-columns:1fr;gap:10px;margin-top:24px}
@media(min-width:640px){.jc-links{grid-template-columns:repeat(2,1fr)}}
.jc-links a{display:flex;align-items:center;justify-content:space-between;background:var(--dark2);border:1px solid rgba(255,255,255,.07);padding:16px 20px;color:var(--text);text-decoration:none;font-family:var(--ff-head);font-size:1.05rem;font-weight:600;letter-spacing:.03em;transition:border-color .2s,color .2s}
.jc-links a:hover{border-color:var(--orange);color:#fff}
.jc-links a span{color:var(--orange);font-size:1.2rem}
.jc-cta-final{background:var(--dark2);padding:80px 24px;text-align:center;border-top:1px solid rgba(255,255,255,.07)}
.jc-cta-final h2{font-family:var(--ff-head);font-size:clamp(1.6rem,4vw,2.8rem);font-weight:700;text-transform:uppercase;color:#fff;margin-bottom:16px;line-height:1.1}
.jc-cta-final p{color:var(--muted);margin-bottom:32px;font-size:1rem;max-width:480px;margin-left:auto;margin-right:auto;line-height:1.65}
.jc-footer{background:#0A0A0A;border-top:1px solid rgba(255,255,255,.07);padding:3rem 24px;overflow:hidden}
.jc-footer-inner{max-width:900px;margin:0 auto;display:flex;justify-content:space-between;align-items:flex-start;gap:2rem;flex-wrap:wrap}
.jc-footer-brand p{font-size:.8rem;color:var(--muted);margin-top:8px;max-width:240px;line-height:1.6}
.jc-footer-links{display:flex;flex-direction:column;gap:8px}
.jc-footer-links a{font-size:.85rem;color:var(--muted);text-decoration:none;transition:color 0.2s}
.jc-footer-links a:hover{color:#fff}
.jc-footer-bottom{text-align:center;font-size:.75rem;color:#444;padding-top:2rem;margin-top:2rem;border-top:1px solid rgba(255,255,255,.07);max-width:900px;margin-left:auto;margin-right:auto}
@keyframes pulse-wa{0%,100%{box-shadow:0 4px 16px rgba(37,211,102,.4)}50%{box-shadow:0 4px 24px rgba(37,211,102,.65)}}
@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation:none!important;transition:none!important}}
@media(max-width:640px){
  .jc-photo{height:280px}
  .jc-photo.tall{height:360px}
  .jc-btn-ghost{margin-left:0;margin-top:12px;display:inline-block}
}
</style>
</head>
<body>

<nav class="jc-nav">
  <a href="https://jetcab.mx" class="jc-nav-logo">JET<span>CAB</span></a>
  <div class="jc-nav-links">
    <a href="https://jetcab.mx/#flota">Flota</a>
    <a href="https://jetcab.mx/light-jets-toluca/">Light Jets</a>
    <a href="https://jetcab.mx/long-range-jets-toluca/">Long Range</a>
    <a href="https://jetcab.mx/cotizar/">Cotizar</a>
    <a href="<?php echo $wa; ?>" class="jc-nav-cta" target="_blank" rel="noopener">Hablar con un concierge</a>
  </div>
</nav>

<!-- 1. HERO -->
<div class="jc-hero" style="background-image:url('<?php echo $hero_url; ?>')" role="img" aria-label="<?php echo esc_attr($p['hero_alt']); ?>">
  <div class="jc-hero-inner">
    <div class="jc-route-tag"><?php echo esc_html($p['tag']); ?></div>
    <h1><?php echo esc_html($p['h1']); ?></h1>
    <p class="jc-hero-sub"><?php echo esc_html($p['sub']); ?></p>
    <div class="jc-trust-row">
      <span><strong>25 años</strong> desde Toluca</span>
      <span><strong>NDA</strong> de tripulación</span>
      <span><strong>Tarmac-to-Cabin</strong> 10 min</span>
      <span>Jet <strong>listo en 2h</strong></span>
    </div>
    <a href="<?php echo $wa; ?>" class="jc-btn" target="_blank" rel="noopener">Coordinar vuelo discreto</a>
    <a href="#protocolo" class="jc-btn jc-btn-ghost">Ver el protocolo</a>
  </div>
</div>

<!-- 2. RESPUESTA DIRECTA -->
<div class="jc-section">
  <h2>¿Qué es un vuelo privado confidencial?</h2>
  <p class="jc-answer"><?php echo esc_html($p['answer']); ?></p>
  <p>En una terminal comercial, la discreción no existe: 40,000 personas al día en el AICM, cámaras en cada pasillo, un pasajero con celular en cada fila y su nombre impreso en un pase de abordar. Para un presidente de consejo que negocia una fusión, para un funcionario en tránsito o para una familia con apellido reconocido, eso no es una molestia. Es un riesgo.</p>
  <p>Identity Shield elimina ese riesgo desde el minuto uno. No es un servicio adicional ni una cabina especial: es la forma en la que JETCAB opera cada vuelo desde hace 25 años.</p>
</div>

<!-- 3. FOTO -->
<img class="jc-photo tall" src="https://images.unsplash.com/photo-<?php echo esc_attr($p['img_1']); ?>?auto=format&fit=crop&w=1400&q=80" alt="<?php echo esc_attr($p['alt_1']); ?>" loading="lazy">

<!-- 4. PROTOCOLO IDENTITY SHIELD -->
<div class="jc-section" id="protocolo">
  <h2>El protocolo Identity Shield</h2>
  <p>Cuatro capas que operan juntas en cada vuelo. Ninguna depende de la buena voluntad de un tercero: todas están bajo control de JETCAB.</p>
  <div class="jc-pillars">
    <div class="jc-pillar">
      <div class="num">01</div>
      <h3>Tripulación bajo NDA</h3>
      <p>Pilotos y personal de cabina firman un acuerdo de confidencialidad antes de cada operación. Quién viaja, con quién y a dónde no se comenta, no se fotografía y no se comparte. Si su empresa exige su propio NDA, la tripulación lo firma antes de abordar.</p>
    </div>
    <div class="jc-pillar">
      <div class="num">02</div>
      <h3>Abordaje directo sin terminal</h3>
      <p>Su camioneta entra a la plataforma del FBO privado de Toluca y lo deja al pie de la escalinata. Sin sala de espera, sin mostrador, sin filtro comercial, sin pasajeros ajenos. Tarmac-to-Cabin en menos de 10 minutos.</p>
    </div>
    <div class="jc-pillar">
      <div class="num">03</div>
      <h3>Cero registros públicos de pasajeros</h3>
      <p>Su nombre no entra en ningún sistema de reservación comercial, pantalla de terminal ni lista de abordaje de aerolínea. El manifiesto se entrega únicamente a la autoridad aeronáutica, como marca la ley, y a nadie más.</p>
    </div>
    <div class="jc-pillar">
      <div class="num">04</div>
      <h3>FBO privado en Toluca</h3>
      <p>Operamos desde el hangar y la terminal de aviación general del Aeropuerto Internacional de Toluca (AIT), a 40 minutos de Santa Fe y Lomas. Acceso controlado, plataforma separada del tráfico comercial, 25 años bajo el mismo protocolo.</p>
    </div>
  </div>
</div>

<!-- 5. PARA QUIÉN -->
<div class="jc-section" style="padding-top:0">
  <h2>Para quien no puede permitirse ser visto</h2>
  <p>Un presidente de consejo no puede coincidir en la sala VIP del AICM con la contraparte de la fusión que cierra esa tarde. Un secretario de Estado en tránsito no necesita a un desconocido grabando desde la fila de abordaje. Un apellido reconocido no debería cruzar una terminal abarrotada con sus hijos.</p>
  <p class="jc-quote">"La discreción no se contrata al llegar al aeropuerto. Se diseña desde que usted decide volar."</p>
  <p>Nuestros clientes Identity Shield lideran corporativos, ocupan o han ocupado cargos públicos, o protegen a su familia de la exposición. Lo que compran no es un asiento más ancho: es la certeza de que nadie sabrá que volaron, ni con quién, ni a dónde. Y de que su agenda se cumple al minuto, sin que un retraso de dos horas en una aerolínea comercial les cueste un acuerdo.</p>
</div>

<!-- 6. FOTO -->
<img class="jc-photo" src="https://images.unsplash.com/photo-<?php echo esc_attr($p['img_2']); ?>?auto=format&fit=crop&w=1400&q=80" alt="<?php echo esc_attr($p['alt_2']); ?>" loading="lazy">

<!-- 7. CÓMO FUNCIONA -->
<div class="jc-section">
  <h2>Así se coordina un vuelo confidencial</h2>
  <p>Un solo interlocutor de principio a fin. Sin formularios en línea, sin correos a listas de distribución, sin intermediarios.</p>
  <ol class="jc-steps">
    <li><h3>Solicitud por WhatsApp o llamada</h3><p>Indica destino, fecha, número de pasajeros y si viaja con escoltas o personal. Su concierge aéreo es la única persona que conoce la solicitud.</p></li>
    <li><h3>Confirmación en 30 minutos</h3><p>Aeronave asignada, tripulación bajo NDA, hora de despegue y acceso al FBO privado de Toluca. Jet listo en 2 horas si así lo requiere.</p></li>
    <li><h3>Tarmac-to-Cabin</h3><p>Su camioneta ingresa a la plataforma con acceso controlado y lo deja al pie de la escalinata. Del tarmac a la cabina en menos de 10 minutos. Basta llegar 15 minutos antes del despegue.</p></li>
    <li><h3>Vuelo en cabina exclusiva</h3><p>Solo su grupo a bordo. Starlink y catering de firma si lo requiere. Lo que se conversa en la cabina se queda en la cabina.</p></li>
    <li><h3>Última milla en destino</h3><p>Camioneta blindada al pie de la escalinata en la terminal de aviación general del destino. En rutas internacionales, migración en sala reservada del FBO, sin fila pública.</p></li>
  </ol>
</div>

<!-- 8. FOTO -->
<img class="jc-photo" src="https://images.unsplash.com/photo-<?php echo esc_attr($p['img_3']); ?>?auto=format&fit=crop&w=1400&q=80" alt="<?php echo esc_attr($p['alt_3']); ?>" loading="lazy">

<!-- 9. AERONAVES RECOMENDADAS -->
<div class="jc-section" id="flota">
  <h2>Cabinas para quien negocia en el aire</h2>
  <p>Toda la flota opera bajo Identity Shield. Estas dos cabinas son las que eligen nuestros clientes cuando el vuelo es una sala de consejo. Precio de referencia CDMX–Cancún, por aeronave completa.</p>
  <div class="jc-fleet-grid">
    <div class="jc-fleet-card">
      <div class="jc-fleet-card-img">
        <img src="https://jetcab.mx/wp-content/uploads/2024/11/Challenger-605-en-renta.jpeg" width="700" height="394" decoding="async" alt="Challenger 605, jet privado midsize con mesa de juntas" loading="lazy">
        <span class="jc-fleet-badge">Midsize Jet</span>
      </div>
      <div class="jc-fleet-body">
        <div class="jc-fleet-class">Midsize Jet</div>
        <div class="jc-fleet-name">Challenger 605</div>
        <p class="jc-fleet-desc">Cabina de pie de 1.85 m, 12 asientos, mesa de juntas y Starlink. La aeronave que más reservan consejos de administración para seguir la sesión a 40,000 pies.</p>
        <div class="jc-fleet-specs">
          <div class="jc-fleet-spec"><strong>12</strong>Pasajeros</div>
          <div class="jc-fleet-spec"><strong>882 km/h</strong>Crucero</div>
          <div class="jc-fleet-spec"><strong>Starlink</strong>Wi-Fi</div>
        </div>
        <div class="jc-fleet-price"><span class="jc-fleet-price-from">Desde</span><span class="jc-fleet-price-amount">$6,500 USD</span></div>
        <a href="<?php echo $wa; ?>" class="jc-fleet-cta" target="_blank" rel="noopener">Reservar esta aeronave</a>
      </div>
    </div>
    <div class="jc-fleet-card">
      <div class="jc-fleet-card-img">
        <img src="https://jetcab.mx/wp-content/uploads/2024/11/Gulfstream-Gv-en-Renta.jpeg" width="700" height="394" decoding="async" alt="Gulfstream GV, jet privado long range con recámara y sala de juntas" loading="lazy">
        <span class="jc-fleet-badge">Long Range</span>
      </div>
      <div class="jc-fleet-body">
        <div class="jc-fleet-class">Long Range</div>
        <div class="jc-fleet-name">Gulfstream GV</div>
        <p class="jc-fleet-desc">Recámara completa, sala de juntas para 8, Starlink y 16 asientos. La aeronave de jefes de Estado. Para el vuelo que define el trato, no hay otra cabina.</p>
        <div class="jc-fleet-specs">
          <div class="jc-fleet-spec"><strong>16</strong>Pasajeros</div>
          <div class="jc-fleet-spec"><strong>904 km/h</strong>Crucero</div>
          <div class="jc-fleet-spec"><strong>Recámara</strong>A bordo</div>
        </div>
        <div class="jc-fleet-price"><span class="jc-fleet-price-from">Desde</span><span class="jc-fleet-price-amount">$12,000 USD</span></div>
        <a href="<?php echo $wa; ?>" class="jc-fleet-cta" target="_blank" rel="noopener">Reservar esta aeronave</a>
      </div>
    </div>
  </div>
</div>

<!-- 10. FAQ -->
<div class="jc-section">
  <h2>Preguntas frecuentes sobre vuelos privados confidenciales</h2>
  <div class="jc-faq">
    <?php foreach ($p['faqs'] as $faq): ?>
    <div class="jc-faq-item">
      <h3><?php echo esc_html($faq['q']); ?></h3>
      <p><?php echo esc_html($faq['a']); ?></p>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- 11. ENLACES INTERNOS -->
<div class="jc-section" style="padding-top:0">
  <h2>Siguiente paso</h2>
  <div class="jc-links">
    <a href="https://jetcab.mx/light-jets-toluca/">Light Jets: vuelos cortos nacionales desde Toluca <span>&rarr;</span></a>
    <a href="https://jetcab.mx/long-range-jets-toluca/">Long Range: jets intercontinentales desde Toluca <span>&rarr;</span></a>
    <a href="https://jetcab.mx/vuelos-privados-a-cancun/">Vuelos privados a Cancún <span>&rarr;</span></a>
    <a href="https://jetcab.mx/vuelos-privados-a-monterrey/">Vuelos privados a Monterrey <span>&rarr;</span></a>
    <a href="https://jetcab.mx/cotizar/">Cotizar un vuelo privado <span>&rarr;</span></a>
    <a href="https://jetcab.mx/#flota">Ver toda la flota JETCAB <span>&rarr;</span></a>
  </div>
</div>

<!-- 12. CTA FINAL -->
<div class="jc-cta-final">
  <h2>¿Necesita volar sin ser visto?</h2>
  <p>Un solo interlocutor. Jet listo en 2 horas desde Toluca. Tripulación bajo NDA. Nadie más lo sabe.</p>
  <a href="<?php echo $wa; ?>" class="jc-btn" target="_blank" rel="noopener">Escribir al concierge &rarr;</a>
</div>

<footer class="jc-footer">
  <div class="jc-footer-inner">
    <div class="jc-footer-brand">
      <a href="https://jetcab.mx" style="font-family:var(--ff-head);font-size:1.25rem;font-weight:800;color:#fff;text-decoration:none">JET<span style="color:var(--orange)">CAB</span></a>
      <p>Renta de jets privados desde Toluca desde 1999. Certificación DGAC. Disponibles los 365 días del año.</p>
    </div>
    <div class="jc-footer-links">
      <a href="https://jetcab.mx/">Inicio</a>
      <a href="https://jetcab.mx/#flota">Nuestra flota</a>
      <a href="https://jetcab.mx/cotizar/">Cotizar</a>
      <a href="https://jetcab.mx/sobre-nosotros/">Sobre JETCAB</a>
      <a href="https://jetcab.mx/en/">English</a>
    </div>
    <div class="jc-footer-links">
      <a href="https://jetcab.mx/vuelos-privados-a-cancun/">CDMX a Cancún</a>
      <a href="https://jetcab.mx/vuelos-privados-a-los-cabos/">CDMX a Los Cabos</a>
      <a href="https://jetcab.mx/vuelos-privados-a-monterrey/">CDMX a Monterrey</a>
      <a href="https://jetcab.mx/vuelos-privados-a-guadalajara/">CDMX a Guadalajara</a>
      <a href="https://jetcab.mx/vuelos-privados-a-puerto-vallarta/">CDMX a Puerto Vallarta</a>
    </div>
  </div>
  <p class="jc-footer-bottom">&copy; <?php echo date('Y'); ?> JETCAB. Todos los derechos reservados. &mdash; <a href="https://jetcab.mx/aviso-de-privacidad/" style="color:#444">Aviso de privacidad</a></p>
</footer>

<a href="<?php echo $wa; ?>" target="_blank" rel="noopener" style="position:fixed;bottom:1.5rem;right:1.5rem;background:#25D366;color:#fff;width:56px;height:56px;border-radius:50%;display:flex;align-items:center;justify-content:center;text-decoration:none;box-shadow:0 4px 16px rgba(37,211,102,0.4);z-index:999;animation:pulse-wa 2.5s infinite" aria-label="WhatsApp JETCAB">
  <svg width="28" height="28" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
</a>

</body>
</html>
<?php
    return ob_get_clean();
}
