<?php


// CUSTOM PAGES //////////////////////////////////////////////////////////////////////


	add_action('init', function(){

		// Aviso de privacidad
		if( ! get_page_by_path('aviso-de-privacidad') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Aviso de privacidad',
				'post_name'   => 'aviso-de-privacidad',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		// Aviso de privacidad
		if( ! get_page_by_path('mail') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'mail',
				'post_name'   => 'mail',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

	});
