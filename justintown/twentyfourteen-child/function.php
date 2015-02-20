<?php

function add_styles_scripts() {
	wp_enqueue_style( 'style-css', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'add_styles_scripts' );
