<?php
/* JETCAB — Página del blog (/blog/ en español, /private-jet-guides/ en inglés) con el shortcode [jetcab_blog lang="es|en"].
   Lista solo artículos publicados, del más reciente al más antiguo, en tarjetas con imagen, categoría, título, resumen,
   fecha y autor. Los programados aparecen solos el día de su publicación. Snippet 26. */

add_shortcode('jetcab_blog', function ($atts) {
    $en = isset($atts['lang']) && $atts['lang'] === 'en';
    $args = array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 60, 'orderby' => 'date', 'order' => 'DESC',
                  'tax_query' => array(array('taxonomy' => 'category', 'field' => 'slug', 'terms' => array('english'), 'operator' => $en ? 'IN' : 'NOT IN')));
    $q = new WP_Query($args);
    $author = $en ? 'JETCAB operations team' : 'Equipo de operaciones de JETCAB';
    $by = $en ? 'By' : 'Por';
    $read = $en ? 'Read article' : 'Leer artículo';
    $h = '<div class="jcb">';
    if (!$q->have_posts()) {
        $h .= '<p>' . ($en ? 'New articles coming soon.' : 'Pronto publicaremos nuevos artículos.') . '</p>';
    }
    while ($q->have_posts()) {
        $q->the_post();
        $id = get_the_ID();
        $cats = get_the_category($id);
        $cat = '';
        foreach ($cats as $c) { if ($c->slug !== 'english') { $cat = $c->name; break; } }
        if ($en && $cat === '') $cat = 'Guide';
        $date = $en ? gmdate('F j, Y', get_post_time('U', true)) : date_i18n('j \d\e F \d\e Y', get_post_time('U'));
        $img = get_the_post_thumbnail($id, 'medium_large', array('class' => 'jcb-img', 'loading' => 'lazy', 'alt' => esc_attr(get_the_title())));
        $ex = wp_trim_words(get_the_excerpt(), 32, '…');
        $h .= '<article class="jcb-card">'
            . '<a class="jcb-media" href="' . esc_url(get_permalink()) . '" tabindex="-1" aria-hidden="true">' . $img . '</a>'
            . '<div class="jcb-body">'
            . ($cat ? '<p class="jcb-cat">' . esc_html($cat) . '</p>' : '')
            . '<h2 class="jcb-title"><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></h2>'
            . '<p class="jcb-ex">' . esc_html($ex) . '</p>'
            . '<p class="jcb-meta">' . $by . ' ' . esc_html($author) . ' · <time datetime="' . esc_attr(get_the_date('c')) . '">' . esc_html($date) . '</time></p>'
            . '<a class="jcb-more" href="' . esc_url(get_permalink()) . '">' . $read . ' →</a>'
            . '</div></article>';
    }
    wp_reset_postdata();
    $h .= '</div><style>'
        . '.jcb{display:grid;grid-template-columns:1fr;gap:28px;margin:28px 0 48px}@media(min-width:760px){.jcb{grid-template-columns:repeat(2,1fr)}}@media(min-width:1100px){.jcb{grid-template-columns:repeat(3,1fr)}}'
        . '.jcb-card{background:#141414;border:1px solid rgba(255,255,255,.08);border-radius:10px;overflow:hidden;display:flex;flex-direction:column}'
        . '.jcb-media{display:block;aspect-ratio:16/9;overflow:hidden;background:#0D0D0D}.jcb-img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .3s ease}.jcb-card:hover .jcb-img{transform:scale(1.03)}'
        . '.jcb-body{padding:20px 22px 22px;display:flex;flex-direction:column;flex:1}'
        . '.jcb-cat{font-size:.75rem;letter-spacing:.2em;text-transform:uppercase;color:#C9973F;margin:0 0 8px}'
        . '.jcb-title{font-size:1.3rem;line-height:1.3;margin:0 0 10px}.jcb-title a{color:#fff;text-decoration:none}.jcb-title a:hover{color:#E85A1E}'
        . '.jcb-ex{font-size:.97rem;line-height:1.6;color:#bdbdbd;margin:0 0 14px;flex:1}'
        . '.jcb-meta{font-size:.85rem;color:#8a8a8a;margin:0 0 14px}'
        . '.jcb-more{color:#E85A1E;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;min-height:44px}'
        . '@media(prefers-reduced-motion:reduce){.jcb-img{transition:none}}'
        . '</style>';
    return $h;
});
