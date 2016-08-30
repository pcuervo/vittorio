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
	#GENERAL FUNCTIONS
\*------------------------------------*/

/**
* Enqueue frontend scripts and styles
**/
add_action( 'wp_enqueue_scripts', function(){
	// scripts
	wp_enqueue_script( 'materialize_js', JSPATH.'bin/materialize.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'plugins', JSPATH.'plugins.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'functions', JSPATH.'functions.js', array('jquery'), '1s.0', true );

	// localize scripts
	// wp_localize_script( 'functions', 'siteUrl', SITEURL );
	// wp_localize_script( 'functions', 'theme_path', THEMEPATH );

	// styles
	wp_enqueue_style( 'styles', get_stylesheet_uri() );


});