<?php
// Code Snippets 39: «JETCAB feed RSS sin UTM» (16 oct 2026).
// MonsterInsights agrega ?utm_source=rss a los enlaces del feed y Google los registra como URLs duplicadas.
add_filter('the_permalink_rss', function ($url) {
	return remove_query_arg(array('utm_source', 'utm_medium', 'utm_campaign'), $url);
}, 999);
