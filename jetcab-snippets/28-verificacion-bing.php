<?php
// Code Snippets 38: «JETCAB verificacion Bing Webmaster» (16 oct 2026).
// Verifica jetcab.mx en Bing Webmaster Tools (cuenta de Luis). No borrar: Bing revisa la verificación periódicamente.
add_action('wp_head', function () {
	echo '<meta name="msvalidate.01" content="3183F95D4DD70BD29FE1E96F9552E7AA" />' . "\n";
}, 1);

add_action('init', function () {
	if (strtolower(strtok($_SERVER['REQUEST_URI'] ?? '', '?')) === '/bingsiteauth.xml') {
		header('Content-Type: application/xml; charset=utf-8');
		echo '<?xml version="1.0"?>' . "\n" . '<users>' . "\n\t" . '<user>3183F95D4DD70BD29FE1E96F9552E7AA</user>' . "\n" . '</users>';
		exit;
	}
}, 0);
