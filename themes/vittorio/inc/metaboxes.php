<?php

/*------------------------------------*\
	CUSTOM METABOXES
\*------------------------------------*/

add_action('add_meta_boxes', function(){
	global $post;
	switch ( $post->post_name ) {
		case 'PAGENAME':
			//add_metaboxes_PAGENAE();
			break;
		default:
			// POST TYPES
			add_metaboxes_citas();
	}
});



/*------------------------------------*\
	CUSTOM METABOXES FUNCTIONS
\*------------------------------------*/

/**
* Add metaboxes for post type "Contacto"
**/
function add_metaboxes_citas(){

	add_meta_box( 'tienda', 'Información', 'metabox_informacion', 'citas', 'advanced', 'high' );

}// add_metaboxes_PAGE



/*-----------------------------------------*\
	CUSTOM METABOXES CALLBACK FUNCTIONS
\*-----------------------------------------*/

/**
* Display metabox in page or post type
* @param obj $post
**/
function metabox_informacion( $post ){

	$nombre = get_post_meta($post->ID, '_nombre_meta', true);
	$email = get_post_meta($post->ID, '_email_meta', true);
	$telefono = get_post_meta($post->ID, '_telefono_meta', true);
	$ciudad = get_post_meta($post->ID, '_ciudad_meta', true);
	$tienda = get_post_meta($post->ID, '_tienda_meta', true);
	$fecha = get_post_meta($post->ID, '_fecha_meta', true);
	$horario = get_post_meta($post->ID, '_horario_meta', true);
	$status = get_post_meta($post->ID, '_status_meta', true);

	wp_nonce_field(__FILE__, '_nombre_meta_nonce');
	wp_nonce_field(__FILE__, '_email_meta_nonce');
	wp_nonce_field(__FILE__, '_telefono_meta_nonce');
	wp_nonce_field(__FILE__, '_ciudad_meta_nonce');
	wp_nonce_field(__FILE__, '_tienda_meta_nonce');
	wp_nonce_field(__FILE__, '_fecha_meta_nonce');
	wp_nonce_field(__FILE__, '_horario_meta_nonce');
	wp_nonce_field(__FILE__, '_status_meta_nonce');

	echo '<label>Nombre</label>';
	echo "<input type='text' class='[ widefat ]' name='_nombre_meta' value='$nombre'>";
	echo '<label>Email</label>';
	echo "<input type='text' class='[ widefat ]' name='_email_meta' value='$email'>";
	echo '<label>Telefono</label>';
	echo "<input type='text' class='[ widefat ]' name='_telefono_meta' value='$telefono'>";
	echo '<label>Ciudad</label>';
	echo "<input type='text' class='[ widefat ]' name='_ciudad_meta' value='$ciudad'>";
	echo '<label>Tienda</label>';
	echo "<input type='text' class='[ widefat ]' name='_tienda_meta' value='$tienda'>";
	echo '<label>Fecha</label>';
	echo "<input type='text' class='[ widefat ]' name='_fecha_meta' value='$fecha'>";
	echo '<label>Horario</label>';
	echo "<input type='text' class='[ widefat ]' name='_horario_meta' value='$horario'>";
	echo '<label>Estatus</label>';
	echo "<input type='text' disabled class='[ widefat ]' name='_status_meta' value='$status'>";
}// metabox_informacion



/*------------------------------------*\
	SAVE METABOXES DATA
\*------------------------------------*/

	add_action('save_post', function( $post_id ){

		save_metaboxes_cita( $post_id );

	});

	/**
	* Save the metaboxes for post type "Productos"
	**/
	function save_metaboxes_cita( $post_id ){

		if ( isset($_POST['_nombre_meta']) and check_admin_referer( __FILE__, '_nombre_meta_nonce') ){
			update_post_meta($post_id, '_nombre_meta', $_POST['_nombre_meta']);
		}
		if ( isset($_POST['_email_meta']) and check_admin_referer( __FILE__, '_email_meta_nonce') ){
			update_post_meta($post_id, '_email_meta', $_POST['_email_meta']);
		}
		if ( isset($_POST['_telefono_meta']) and check_admin_referer( __FILE__, '_telefono_meta_nonce') ){
			update_post_meta($post_id, '_telefono_meta', $_POST['_telefono_meta']);
		}
		if ( isset($_POST['_ciudad_meta']) and check_admin_referer( __FILE__, '_ciudad_meta_nonce') ){
			update_post_meta($post_id, '_ciudad_meta', $_POST['_ciudad_meta']);
		}
		if ( isset($_POST['_tienda_meta']) and check_admin_referer( __FILE__, '_tienda_meta_nonce') ){
			update_post_meta($post_id, '_tienda_meta', $_POST['_tienda_meta']);
		}
		if ( isset($_POST['_fecha_meta']) and check_admin_referer( __FILE__, '_fecha_meta_nonce') ){
			update_post_meta($post_id, '_fecha_meta', $_POST['_fecha_meta']);
		}
		if ( isset($_POST['_horario_meta']) and check_admin_referer( __FILE__, '_horario_meta_nonce') ){
			update_post_meta($post_id, '_horario_meta', $_POST['_horario_meta']);
		}
		if ( isset($_POST['_status_meta']) and check_admin_referer( __FILE__, '_status_meta_nonce') ){
			update_post_meta($post_id, '_status_meta', $_POST['_status_meta']);
		}

	}// save_metaboxes_cita
