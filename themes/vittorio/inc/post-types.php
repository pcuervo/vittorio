<?php

/*------------------------------------*\
	CUSTOM POST TYPES
\*------------------------------------*/

add_action('init', function(){

	$capabilities_citas = array(
	    'publish_posts' => 'publish_citas',
	    'edit_posts' => 'edit_citas',
	    'edit_others_posts' => 'edit_others_citas',
	    'delete_posts' => 'delete_citas',
	    'delete_others_posts' => 'delete_others_citas',
	    'read_private_posts' => 'read_private_citas',
	    'edit_post' => 'edit_cita',
	    'delete_post' => 'delete_cita',
	    'read_post' => 'read_cita'
	);

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
		'capabilities' 		 => $capabilities_citas,
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title' )
	);
	register_post_type( 'citas', $args );

	//CIUDAD
	$labels = array(
		'name'          => 'Ciudades',
		'singular_name' => 'Ciudad',
		'add_new'       => 'Nueva Ciudad',
		'add_new_item'  => 'Nueva Ciudad',
		'edit_item'     => 'Editar Ciudad',
		'new_item'      => 'Nueva Ciudad',
		'all_items'     => 'Todos',
		'view_item'     => 'Ver Ciudad',
		'search_items'  => 'Buscar Ciudades',
		'not_found'     => 'No se encontró',
		'menu_name'     => 'Ciudades'
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'ciudades' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title' )
	);
	register_post_type( 'ciudades', $args );

	//TIENDAS
	$labels = array(
		'name'          => 'Tiendas',
		'singular_name' => 'Tiendas',
		'add_new'       => 'Nueva Tiendas',
		'add_new_item'  => 'Nueva Tiendas',
		'edit_item'     => 'Editar Tiendas',
		'new_item'      => 'Nueva Tiendas',
		'all_items'     => 'Todos',
		'view_item'     => 'Ver Tiendas',
		'search_items'  => 'Buscar Tiendas',
		'not_found'     => 'No se encontró',
		'menu_name'     => 'Tiendas'
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'tiendas' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title' )
	);
	register_post_type( 'tiendas', $args );

});