<?php

/*------------------------------------*\
	#CONSTANTS
\*------------------------------------*/

/**
* Define paths to javascript, styles, theme and site.
**/
define( 'JSPATH', get_template_directory_uri() . '/js/' );
define( 'CSSPATH', get_template_directory_uri() . '/css/' );
define( 'THEMEPATH', get_template_directory_uri() . '/' );
define( 'SITEURL', site_url('/') );




/*------------------------------------*\
	#SNIPPETS
\*------------------------------------*/

require_once( 'inc/pages.php' );
require_once( 'inc/post-types.php' );
require_once( 'inc/metaboxes.php' );
require_once( 'inc/taxonomies.php' );


/*------------------------------------*\
	#GENERAL FUNCTIONS
\*------------------------------------*/

/**
* Enqueue frontend scripts and styles
**/
add_action( 'wp_enqueue_scripts', function(){

	// scripts
	wp_enqueue_script( 'plugins', JSPATH.'plugins.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'materialize_js', JSPATH.'bin/materialize.min.js', array('plugins'), '1.0', true );
	wp_enqueue_script( 'functions', JSPATH.'functions.js', array('plugins'), '1.0', true );
	wp_enqueue_script( 'vimeo_player', 'https://player.vimeo.com/api/player.js', array('jquery'), '1.0', true );

	// localize scripts
	wp_localize_script( 'functions', 'siteUrl', SITEURL );
	wp_localize_script( 'functions', 'theme_path', THEMEPATH );
	wp_localize_script( 'functions', 'isHome', (string)is_front_page() );
	wp_localize_script( 'functions', 'isCurso', (string) is_curso( get_the_id() ) );
	wp_localize_script( 'functions', 'isProduct', (string) ('product' == get_post_type() AND ! is_curso( get_the_id() )  ) );
	wp_localize_script( 'functions', 'isModulo', (string) ('modulos' == get_post_type()) );
	wp_localize_script( 'functions', 'isLeccion', (string) ('lecciones' == get_post_type()) );
	wp_localize_script( 'functions', 'isMyAccount', (string) is_page('my-account') );
	wp_localize_script( 'functions', 'isCart', (string) is_page('cart') );
	wp_localize_script( 'functions', 'isCheckout', (string) is_page('checkout') );
	wp_localize_script( 'functions', 'isTienda', (string) is_page('tienda') );
	wp_localize_script( 'functions', 'isProductos', (string) is_page('productos') );

	// styles
	wp_enqueue_style( 'styles', get_stylesheet_uri() );

});
