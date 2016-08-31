<?php

/*------------------------------------*\
	CUSTOM POST TYPES
\*------------------------------------*/

add_action('init', function(){

	// Citas
	$labels = array(
		'name'          => 'Citas',
		'singular_name' => 'Cita',
		'add_new'       => 'Nueva cita',
		'add_new_item'  => 'Nueva cita',
		'edit_item'     => 'Editar cita',
		'new_item'      => 'Nueva cita',
		'all_items'     => 'Todos',
		'view_item'     => 'Ver cita',
		'search_items'  => 'Buscar citas',
		'not_found'     => 'No se encontró',
		'menu_name'     => 'Citas'
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'citas' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title' )
	);
	register_post_type( 'citas', $args );

});