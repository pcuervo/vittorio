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
			add_metaboxes_ciudad();
			add_metaboxes_tienda();
	}
});



/*------------------------------------*\
	CUSTOM METABOXES FUNCTIONS
\*------------------------------------*/

/**
* Add metaboxes for post type "Contacto"
**/
function add_metaboxes_citas(){

	add_meta_box( 'meta-box-citas', 'Información', 'metabox_informacion', 'citas', 'advanced', 'high' );

}// add_metaboxes_PAGE

function add_metaboxes_ciudad(){

	add_meta_box( 'meta-box-ciudad', 'Ubicación de la Ciudad', 'metabox_ciudad', 'ciudades');
}// add_metaboxes_PAGE

function add_metaboxes_tienda(){

	add_meta_box( 'meta-box-tienda', 'Tienda', 'metabox_tienda', 'tiendas');
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
	//echo '<label>Estatus</label>';
	//echo "<input type='text' disabled class='[ widefat ]' name='_status_meta' value='$status'>";
}// metabox_informacion

function metabox_ciudad($post){


	$punto = get_post_meta($post->ID, '_ubicacion_meta', true);
	$latitud_punto = get_post_meta($post->ID, '_latitud_meta', true);
	$longitud_punto = get_post_meta($post->ID, '_longitud_meta', true);

	wp_nonce_field(__FILE__, '_ubicacion_meta_nonce');
	wp_nonce_field(__FILE__, '_latitud_meta_nonce');
	wp_nonce_field(__FILE__, '_longitud_meta_nonce');

	echo "<label for='ubicacion_punto' class=''>Ingresa la dirección: </label><br><br>";
	echo "<input type='text' class='widefat' id='_ubicacion_meta' name='_ubicacion_meta' value='$punto'/>";
	echo "<input type='hidden' class='widefat' id='_latitud_meta' name='_latitud_meta' value='$latitud_punto'/>";
	echo "<input type='hidden' class='widefat' id='_longitud_meta' name='_longitud_meta' value='$longitud_punto'/>";

	echo '<br><br><div class="iframe-cont">';
		if ($latitud_punto != '') {
			echo '<iframe width="100%" height="170" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q='.$latitud_punto.','.$longitud_punto.'&hl=es;z=14&amp;output=embed"></iframe>';
		}
	echo '</div><br>';

}

function metabox_tienda($post){

	$ciudad = get_post_meta($post->ID, '_ciudad_meta', true);
	$telefono = get_post_meta($post->ID, '_telefono_meta', true);
	$punto = get_post_meta($post->ID, '_ubicacion_meta', true);
	$latitud_punto = get_post_meta($post->ID, '_latitud_meta', true);
	$longitud_punto = get_post_meta($post->ID, '_longitud_meta', true);

	wp_nonce_field(__FILE__, '_ciudad_meta_nonce');
	wp_nonce_field(__FILE__, '_telefono_meta_nonce');
	wp_nonce_field(__FILE__, '_ubicacion_meta_nonce');
	wp_nonce_field(__FILE__, '_latitud_meta_nonce');
	wp_nonce_field(__FILE__, '_longitud_meta_nonce');

	//Select ciudades post type
	$query_args = array(
		'post_type'      => 'ciudades',
		'orderby'        => 'title',
		'no_found_rows'  => true,
		'cache_results'  => false,
		'posts_per_page' => -1
	);

    $posts = new WP_Query( $query_args );

    echo '<label>Telefono</label>';
	echo "<input type='text' class='[ widefat ]' name='_telefono_meta' value='$telefono'>";
	echo '<label>Ciudad</label>';
 	echo '<select id="_ciudad_meta" name="_ciudad_meta"  class="[ widefat ] input-text form-row-wide">';
 		echo '<option></option>';
	if ( $posts->have_posts() ) {
		while ( $posts->have_posts() ) {
			$selected = '';
			$posts->the_post();
			$meta = get_post_meta($posts->post->ID);
			if(get_the_title() == $ciudad) { $selected = 'selected'; }
			echo '<option value="'.get_the_title().'" class="ciudad" id="ciudad_'.$posts->post->ID.'" data-lat="'.$meta['_latitud_meta'][0].'" data-long="'.$meta['_longitud_meta'][0].'" data-direccion="'.$meta['_direccion_meta'][0].'" data-tel="'.$meta['_telefono_meta'][0].'" '.$selected.'>'.get_the_title().'</option>';
		}
	}
	echo '</select><br>';

	echo "<label for='ubicacion_punto' class=''>Ingresa la dirección de la tienda: </label><br><br>";
	echo "<input type='text' class='widefat' id='_ubicacion_meta' name='_ubicacion_meta' value='$punto'/>";
	echo "<input type='hidden' class='widefat' id='_latitud_meta' name='_latitud_meta' value='$latitud_punto'/>";
	echo "<input type='hidden' class='widefat' id='_longitud_meta' name='_longitud_meta' value='$longitud_punto'/>";

	echo '<br><br><div class="iframe-cont">';
		if ($latitud_punto != '') {
			echo '<iframe width="100%" height="170" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q='.$latitud_punto.','.$longitud_punto.'&hl=es;z=14&amp;output=embed"></iframe>';
		}
	echo '</div><br>';

}



/*------------------------------------*\
	SAVE METABOXES DATA
\*------------------------------------*/

	add_action('save_post', function( $post_id ){

		save_metaboxes_cita( $post_id );
		save_metaboxes_ciudad( $post_id );
		save_metaboxes_tienda( $post_id );

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

	function save_metaboxes_ciudad( $post_id ){

		if ( isset($_POST['_ubicacion_meta']) and check_admin_referer( __FILE__, '_ubicacion_meta_nonce') ){
			update_post_meta($post_id, '_ubicacion_meta', $_POST['_ubicacion_meta']);
		}
		if ( isset($_POST['_latitud_meta']) and check_admin_referer( __FILE__, '_latitud_meta_nonce') ){
			update_post_meta($post_id, '_latitud_meta', $_POST['_latitud_meta']);
		}
		if ( isset($_POST['_longitud_meta']) and check_admin_referer( __FILE__, '_longitud_meta_nonce') ){
			update_post_meta($post_id, '_longitud_meta', $_POST['_longitud_meta']);
		}

	}// save_metaboxes_ciudad

	function save_metaboxes_tienda( $post_id ){

		if ( isset($_POST['_ciudad_meta']) and check_admin_referer( __FILE__, '_ciudad_meta_nonce') ){
			update_post_meta($post_id, '_ciudad_meta', $_POST['_ciudad_meta']);
		}
		if ( isset($_POST['_telefono_meta']) and check_admin_referer( __FILE__, '_telefono_meta_nonce') ){
			update_post_meta($post_id, '_telefono_meta', $_POST['_telefono_meta']);
		}
		if ( isset($_POST['_ubicacion_meta']) and check_admin_referer( __FILE__, '_ubicacion_meta_nonce') ){
			update_post_meta($post_id, '_ubicacion_meta', $_POST['_ubicacion_meta']);
		}
		if ( isset($_POST['_latitud_meta']) and check_admin_referer( __FILE__, '_latitud_meta_nonce') ){
			update_post_meta($post_id, '_latitud_meta', $_POST['_latitud_meta']);
		}
		if ( isset($_POST['_longitud_meta']) and check_admin_referer( __FILE__, '_longitud_meta_nonce') ){
			update_post_meta($post_id, '_longitud_meta', $_POST['_longitud_meta']);
		}

	}// save_metaboxes_tienda
