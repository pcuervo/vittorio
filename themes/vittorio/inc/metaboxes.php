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

	add_meta_box( 'meta-box-ciudad', 'Ubicación la Ciudad', 'metabox_ciudad', 'ciudades');
}// add_metaboxes_PAGE

function add_metaboxes_tienda(){

	add_meta_box( 'meta-box-tienda', 'Tienda', 'metabox_tienda', 'tiendas');
	add_meta_box( 'meta-box-tienda-horario-lunes', 'Lunes Horarios ', 'metabox_tienda_horarios_lunes', 'tiendas');
	add_meta_box( 'meta-box-tienda-horario-martes', 'Martes Horarios ', 'metabox_tienda_horarios_martes', 'tiendas');
	add_meta_box( 'meta-box-tienda-horario-miercoles', 'Miercoles Horarios ', 'metabox_tienda_horarios_miercoles', 'tiendas');
	add_meta_box( 'meta-box-tienda-horario-jueves', 'Jueves Horarios ', 'metabox_tienda_horarios_jueves', 'tiendas');
	add_meta_box( 'meta-box-tienda-horario-viernes', 'Viernes Horarios ', 'metabox_tienda_horarios_viernes', 'tiendas');
	add_meta_box( 'meta-box-tienda-horario-sabado', 'Sabado Horarios ', 'metabox_tienda_horarios_sabado', 'tiendas');
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

	echo "<label for='ubicacion_punto' class=''>Ingresa la dirección la tienda: </label><br><br>";
	echo "<input type='text' class='widefat' id='_ubicacion_meta' name='_ubicacion_meta' value='$punto'/>";
	echo "<input type='hidden' class='widefat' id='_latitud_meta' name='_latitud_meta' value='$latitud_punto'/>";
	echo "<input type='hidden' class='widefat' id='_longitud_meta' name='_longitud_meta' value='$longitud_punto'/>";

	echo '<br><br><div class="iframe-cont">';
		if ($latitud_punto != '') {
			echo '<iframe width="100%" height="170" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q='.$latitud_punto.','.$longitud_punto.'&hl=es;z=14&amp;output=embed"></iframe>';
		}
	echo '</div><br>';

}

function metabox_tienda_horarios_lunes($post){
	
	$lunes_horario_9am = get_post_meta($post->ID, '_lunes_horario_9am', true);
	$lunes_horario_930am = get_post_meta($post->ID, '_lunes_horario_930am', true);
	$lunes_horario_10am = get_post_meta($post->ID, '_lunes_horario_10am', true);
	$lunes_horario_1030am = get_post_meta($post->ID, '_lunes_horario_1030am', true);
	$lunes_horario_11am = get_post_meta($post->ID, '_lunes_horario_11am', true);
	$lunes_horario_1130am = get_post_meta($post->ID, '_lunes_horario_1130am', true);
	$lunes_horario_12pm = get_post_meta($post->ID, '_lunes_horario_12pm', true);
	$lunes_horario_1230pm = get_post_meta($post->ID, '_lunes_horario_1230pm', true);
	$lunes_horario_1pm = get_post_meta($post->ID, '_lunes_horario_1pm', true);
	$lunes_horario_130pm = get_post_meta($post->ID, '_lunes_horario_130pm', true);
	$lunes_horario_2pm = get_post_meta($post->ID, '_lunes_horario_2pm', true);
	$lunes_horario_230pm = get_post_meta($post->ID, '_lunes_horario_230pm', true);
	$lunes_horario_3pm = get_post_meta($post->ID, '_lunes_horario_3pm', true);
	$lunes_horario_330pm = get_post_meta($post->ID, '_lunes_horario_330pm', true);
	$lunes_horario_4pm = get_post_meta($post->ID, '_lunes_horario_4pm', true);
	$lunes_horario_430pm = get_post_meta($post->ID, '_lunes_horario_430pm', true);
	$lunes_horario_5pm = get_post_meta($post->ID, '_lunes_horario_5pm', true);
	$lunes_horario_530pm = get_post_meta($post->ID, '_lunes_horario_530pm', true);
	$lunes_horario_6pm = get_post_meta($post->ID, '_lunes_horario_6pm', true);
	$lunes_horario_630pm = get_post_meta($post->ID, '_lunes_horario_630pm', true);
	$lunes_horario_7pm = get_post_meta($post->ID, '_lunes_horario_7pm', true);
	$lunes_horario_730pm = get_post_meta($post->ID, '_lunes_horario_730pm', true);
	$lunes_horario_8pm = get_post_meta($post->ID, '_lunes_horario_8pm', true);
	$lunes_horario_830pm = get_post_meta($post->ID, '_lunes_horario_830pm', true);


	wp_nonce_field(__FILE__, '_lunes_horario_9am_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_930am_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_10am_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_1030am_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_11am_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_1130am_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_12pm_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_1230pm_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_1pm_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_130pm_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_2pm_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_230pm_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_3pm_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_330pm_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_4pm_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_430pm_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_5pm_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_530pm_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_6pm_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_630pm_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_7pm_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_730pm_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_8pm_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_830pm_nonce');

	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9am - 9:30am  <input type='checkbox' class='[ widefat ]' name='_lunes_horario_9am' ";checked( $lunes_horario_9am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9:30am - 10am  <input type='checkbox' class='[ widefat ]' name='_lunes_horario_930am' ";checked( $lunes_horario_930am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10am - 10:30am <input type='checkbox' class='[ widefat ]' name='_lunes_horario_10am' ";checked( $lunes_horario_10am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10:30am - 11am <input type='checkbox' class='[ widefat ]' name='_lunes_horario_1030am' ";checked( $lunes_horario_1030am , 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11am - 11:30am <input type='checkbox' class='[ widefat ]' name='_lunes_horario_11am' ";checked( $lunes_horario_11am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11:30am - 12pm   <input type='checkbox' class='[ widefat ]' name='_lunes_horario_1130am' ";checked( $lunes_horario_1130am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12pm - 12:30pm <input type='checkbox' class='[ widefat ]' name='_lunes_horario_12pm' ";checked( $lunes_horario_12pm, 'SI' ); echo " value='SI'></div>";			 
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12:30pm - 1pm  <input type='checkbox' class='[ widefat ]' name='_lunes_horario_1230pm' ";checked( $lunes_horario_1230pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 1pm - 1:30pm <input type='checkbox' class='[ widefat ]' name='_lunes_horario_1pm' ";checked( $lunes_horario_1pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 1:30pm - 2pm <input type='checkbox' class='[ widefat ]' name='_lunes_horario_130pm' ";checked( $lunes_horario_130pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 2pm - 2:30pm <input type='checkbox' class='[ widefat ]' name='_lunes_horario_2pm' ";checked( $lunes_horario_2pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 2:30pm - 3pm   <input type='checkbox' class='[ widefat ]' name='_lunes_horario_230pm' ";checked( $lunes_horario_230pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 3pm - 3:30pm  <input type='checkbox' class='[ widefat ]' name='_lunes_horario_3pm' ";checked( $lunes_horario_3pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 3:30pm - 4pm <input type='checkbox' class='[ widefat ]' name='_lunes_horario_330pm' ";checked( $lunes_horario_330pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 4pm - 4:30pm <input type='checkbox' class='[ widefat ]' name='_lunes_horario_4pm' ";checked( $lunes_horario_4pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 4:30pm - 5pm <input type='checkbox' class='[ widefat ]' name='_lunes_horario_430pm' ";checked( $lunes_horario_430pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 5pm - 5:30pm   <input type='checkbox' class='[ widefat ]' name='_lunes_horario_5pm' ";checked( $lunes_horario_5pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 5:30pm - 6pm  <input type='checkbox' class='[ widefat ]' name='_lunes_horario_530pm' ";checked( $lunes_horario_530pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 6pm - 6:30pm <input type='checkbox' class='[ widefat ]' name='_lunes_horario_6pm' ";checked( $lunes_horario_6pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 6:30pm - 7pm <input type='checkbox' class='[ widefat ]' name='_lunes_horario_630pm' ";checked( $lunes_horario_630pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 7pm - 7:30pm <input type='checkbox' class='[ widefat ]' name='_lunes_horario_7pm' ";checked( $lunes_horario_7pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 7:30pm - 8pm <input type='checkbox' class='[ widefat ]' name='_lunes_horario_730pm' ";checked( $lunes_horario_730pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 8pm - 8:30pm <input type='checkbox' class='[ widefat ]' name='_lunes_horario_8pm' ";checked( $lunes_horario_8pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 8:30pm - 9pm <input type='checkbox' class='[ widefat ]' name='_lunes_horario_830pm' ";checked( $lunes_horario_830pm, 'SI' ); echo " value='SI'></div>";
	echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';
	


}

function metabox_tienda_horarios_martes($post){

	$martes_horario_9am = get_post_meta($post->ID, '_martes_horario_9am', true);
	$martes_horario_930am = get_post_meta($post->ID, '_martes_horario_930am', true);
	$martes_horario_10am = get_post_meta($post->ID, '_martes_horario_10am', true);
	$martes_horario_1030am = get_post_meta($post->ID, '_martes_horario_1030am', true);
	$martes_horario_11am = get_post_meta($post->ID, '_martes_horario_11am', true);
	$martes_horario_1130am = get_post_meta($post->ID, '_martes_horario_1130am', true);
	$martes_horario_12pm = get_post_meta($post->ID, '_martes_horario_12pm', true);
	$martes_horario_1230pm = get_post_meta($post->ID, '_martes_horario_1230pm', true);
	$martes_horario_1pm = get_post_meta($post->ID, '_martes_horario_1pm', true);
	$martes_horario_130pm = get_post_meta($post->ID, '_martes_horario_130pm', true);
	$martes_horario_2pm = get_post_meta($post->ID, '_martes_horario_2pm', true);
	$martes_horario_230pm = get_post_meta($post->ID, '_martes_horario_230pm', true);
	$martes_horario_3pm = get_post_meta($post->ID, '_martes_horario_3pm', true);
	$martes_horario_330pm = get_post_meta($post->ID, '_martes_horario_330pm', true);
	$martes_horario_4pm = get_post_meta($post->ID, '_martes_horario_4pm', true);
	$martes_horario_430pm = get_post_meta($post->ID, '_martes_horario_430pm', true);
	$martes_horario_5pm = get_post_meta($post->ID, '_martes_horario_5pm', true);
	$martes_horario_530pm = get_post_meta($post->ID, '_martes_horario_530pm', true);
	$martes_horario_6pm = get_post_meta($post->ID, '_martes_horario_6pm', true);
	$martes_horario_630pm = get_post_meta($post->ID, '_martes_horario_630pm', true);
	$martes_horario_7pm = get_post_meta($post->ID, '_martes_horario_7pm', true);
	$martes_horario_730pm = get_post_meta($post->ID, '_martes_horario_730pm', true);
	$martes_horario_8pm = get_post_meta($post->ID, '_martes_horario_8pm', true);
	$martes_horario_830pm = get_post_meta($post->ID, '_martes_horario_830pm', true);


	wp_nonce_field(__FILE__, '_martes_horario_9am_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_930am_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_10am_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_1030am_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_11am_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_1130am_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_12pm_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_1230pm_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_1pm_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_130pm_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_2pm_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_230pm_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_3pm_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_330pm_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_4pm_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_430pm_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_5pm_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_530pm_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_6pm_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_630pm_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_7pm_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_730pm_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_8pm_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_830pm_nonce');

	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9am - 9:30am  <input type='checkbox' class='[ widefat ]' name='_martes_horario_9am' ";checked( $martes_horario_9am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9:30am - 10am  <input type='checkbox' class='[ widefat ]' name='_martes_horario_930am' ";checked( $martes_horario_930am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10am - 10:30am <input type='checkbox' class='[ widefat ]' name='_martes_horario_10am' ";checked( $martes_horario_10am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10:30am - 11am <input type='checkbox' class='[ widefat ]' name='_martes_horario_1030am' ";checked( $martes_horario_1030am , 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11am - 11:30am <input type='checkbox' class='[ widefat ]' name='_martes_horario_11am' ";checked( $martes_horario_11am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11:30am - 12pm   <input type='checkbox' class='[ widefat ]' name='_martes_horario_1130am' ";checked( $martes_horario_1130am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12pm - 12:30pm <input type='checkbox' class='[ widefat ]' name='_martes_horario_12pm' ";checked( $martes_horario_12pm, 'SI' ); echo " value='SI'></div>";			 
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12:30pm - 1pm  <input type='checkbox' class='[ widefat ]' name='_martes_horario_1230pm' ";checked( $martes_horario_1230pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 1pm - 1:30pm <input type='checkbox' class='[ widefat ]' name='_martes_horario_1pm' ";checked( $martes_horario_1pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 1:30pm - 2pm <input type='checkbox' class='[ widefat ]' name='_martes_horario_130pm' ";checked( $martes_horario_130pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 2pm - 2:30pm <input type='checkbox' class='[ widefat ]' name='_martes_horario_2pm' ";checked( $martes_horario_2pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 2:30pm - 3pm   <input type='checkbox' class='[ widefat ]' name='_martes_horario_230pm' ";checked( $martes_horario_230pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 3pm - 3:30pm  <input type='checkbox' class='[ widefat ]' name='_martes_horario_3pm' ";checked( $martes_horario_3pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 3:30pm - 4pm <input type='checkbox' class='[ widefat ]' name='_martes_horario_330pm' ";checked( $martes_horario_330pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 4pm - 4:30pm <input type='checkbox' class='[ widefat ]' name='_martes_horario_4pm' ";checked( $martes_horario_4pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 4:30pm - 5pm <input type='checkbox' class='[ widefat ]' name='_martes_horario_430pm' ";checked( $martes_horario_430pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 5pm - 5:30pm   <input type='checkbox' class='[ widefat ]' name='_martes_horario_5pm' ";checked( $martes_horario_5pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 5:30pm - 6pm  <input type='checkbox' class='[ widefat ]' name='_martes_horario_530pm' ";checked( $martes_horario_530pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 6pm - 6:30pm <input type='checkbox' class='[ widefat ]' name='_martes_horario_6pm' ";checked( $martes_horario_6pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 6:30pm - 7pm <input type='checkbox' class='[ widefat ]' name='_martes_horario_630pm' ";checked( $martes_horario_630pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 7pm - 7:30pm <input type='checkbox' class='[ widefat ]' name='_martes_horario_7pm' ";checked( $martes_horario_7pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 7:30pm - 8pm <input type='checkbox' class='[ widefat ]' name='_martes_horario_730pm' ";checked( $martes_horario_730pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 8pm - 8:30pm <input type='checkbox' class='[ widefat ]' name='_martes_horario_8pm' ";checked( $martes_horario_8pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 8:30pm - 9pm <input type='checkbox' class='[ widefat ]' name='_martes_horario_830pm' ";checked( $martes_horario_830pm, 'SI' ); echo " value='SI'></div>";
	echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';

}

function metabox_tienda_horarios_miercoles($post){

	$miercoles_horario_9am = get_post_meta($post->ID, '_miercoles_horario_9am', true);
	$miercoles_horario_930am = get_post_meta($post->ID, '_miercoles_horario_930am', true);
	$miercoles_horario_10am = get_post_meta($post->ID, '_miercoles_horario_10am', true);
	$miercoles_horario_1030am = get_post_meta($post->ID, '_miercoles_horario_1030am', true);
	$miercoles_horario_11am = get_post_meta($post->ID, '_miercoles_horario_11am', true);
	$miercoles_horario_1130am = get_post_meta($post->ID, '_miercoles_horario_1130am', true);
	$miercoles_horario_12pm = get_post_meta($post->ID, '_miercoles_horario_12pm', true);
	$miercoles_horario_1230pm = get_post_meta($post->ID, '_miercoles_horario_1230pm', true);
	$miercoles_horario_1pm = get_post_meta($post->ID, '_miercoles_horario_1pm', true);
	$miercoles_horario_130pm = get_post_meta($post->ID, '_miercoles_horario_130pm', true);
	$miercoles_horario_2pm = get_post_meta($post->ID, '_miercoles_horario_2pm', true);
	$miercoles_horario_230pm = get_post_meta($post->ID, '_miercoles_horario_230pm', true);
	$miercoles_horario_3pm = get_post_meta($post->ID, '_miercoles_horario_3pm', true);
	$miercoles_horario_330pm = get_post_meta($post->ID, '_miercoles_horario_330pm', true);
	$miercoles_horario_4pm = get_post_meta($post->ID, '_miercoles_horario_4pm', true);
	$miercoles_horario_430pm = get_post_meta($post->ID, '_miercoles_horario_430pm', true);
	$miercoles_horario_5pm = get_post_meta($post->ID, '_miercoles_horario_5pm', true);
	$miercoles_horario_530pm = get_post_meta($post->ID, '_miercoles_horario_530pm', true);
	$miercoles_horario_6pm = get_post_meta($post->ID, '_miercoles_horario_6pm', true);
	$miercoles_horario_630pm = get_post_meta($post->ID, '_miercoles_horario_630pm', true);
	$miercoles_horario_7pm = get_post_meta($post->ID, '_miercoles_horario_7pm', true);
	$miercoles_horario_730pm = get_post_meta($post->ID, '_miercoles_horario_730pm', true);
	$miercoles_horario_8pm = get_post_meta($post->ID, '_miercoles_horario_8pm', true);
	$miercoles_horario_830pm = get_post_meta($post->ID, '_miercoles_horario_830pm', true);


	wp_nonce_field(__FILE__, '_miercoles_horario_9am_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_930am_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_10am_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_1030am_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_11am_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_1130am_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_12pm_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_1230pm_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_1pm_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_130pm_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_2pm_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_230pm_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_3pm_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_330pm_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_4pm_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_430pm_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_5pm_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_530pm_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_6pm_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_630pm_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_7pm_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_730pm_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_8pm_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_830pm_nonce');

	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9am - 9:30am  <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_9am' ";checked( $miercoles_horario_9am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9:30am - 10am  <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_930am' ";checked( $miercoles_horario_930am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10am - 10:30am <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_10am' ";checked( $miercoles_horario_10am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10:30am - 11am <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_1030am' ";checked( $miercoles_horario_1030am , 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11am - 11:30am <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_11am' ";checked( $miercoles_horario_11am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11:30am - 12pm   <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_1130am' ";checked( $miercoles_horario_1130am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12pm - 12:30pm <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_12pm' ";checked( $miercoles_horario_12pm, 'SI' ); echo " value='SI'></div>";			 
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12:30pm - 1pm  <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_1230pm' ";checked( $miercoles_horario_1230pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 1pm - 1:30pm <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_1pm' ";checked( $miercoles_horario_1pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 1:30pm - 2pm <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_130pm' ";checked( $miercoles_horario_130pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 2pm - 2:30pm <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_2pm' ";checked( $miercoles_horario_2pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 2:30pm - 3pm   <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_230pm' ";checked( $miercoles_horario_230pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 3pm - 3:30pm  <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_3pm' ";checked( $miercoles_horario_3pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 3:30pm - 4pm <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_330pm' ";checked( $miercoles_horario_330pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 4pm - 4:30pm <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_4pm' ";checked( $miercoles_horario_4pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 4:30pm - 5pm <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_430pm' ";checked( $miercoles_horario_430pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 5pm - 5:30pm   <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_5pm' ";checked( $miercoles_horario_5pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 5:30pm - 6pm  <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_530pm' ";checked( $miercoles_horario_530pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 6pm - 6:30pm <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_6pm' ";checked( $miercoles_horario_6pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 6:30pm - 7pm <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_630pm' ";checked( $miercoles_horario_630pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 7pm - 7:30pm <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_7pm' ";checked( $miercoles_horario_7pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 7:30pm - 8pm <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_730pm' ";checked( $miercoles_horario_730pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 8pm - 8:30pm <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_8pm' ";checked( $miercoles_horario_8pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 8:30pm - 9pm <input type='checkbox' class='[ widefat ]' name='_miercoles_horario_830pm' ";checked( $miercoles_horario_830pm, 'SI' ); echo " value='SI'></div>";
	echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';

}

function metabox_tienda_horarios_jueves($post){

	$jueves_horario_9am = get_post_meta($post->ID, '_jueves_horario_9am', true);
	$jueves_horario_930am = get_post_meta($post->ID, '_jueves_horario_930am', true);
	$jueves_horario_10am = get_post_meta($post->ID, '_jueves_horario_10am', true);
	$jueves_horario_1030am = get_post_meta($post->ID, '_jueves_horario_1030am', true);
	$jueves_horario_11am = get_post_meta($post->ID, '_jueves_horario_11am', true);
	$jueves_horario_1130am = get_post_meta($post->ID, '_jueves_horario_1130am', true);
	$jueves_horario_12pm = get_post_meta($post->ID, '_jueves_horario_12pm', true);
	$jueves_horario_1230pm = get_post_meta($post->ID, '_jueves_horario_1230pm', true);
	$jueves_horario_1pm = get_post_meta($post->ID, '_jueves_horario_1pm', true);
	$jueves_horario_130pm = get_post_meta($post->ID, '_jueves_horario_130pm', true);
	$jueves_horario_2pm = get_post_meta($post->ID, '_jueves_horario_2pm', true);
	$jueves_horario_230pm = get_post_meta($post->ID, '_jueves_horario_230pm', true);
	$jueves_horario_3pm = get_post_meta($post->ID, '_jueves_horario_3pm', true);
	$jueves_horario_330pm = get_post_meta($post->ID, '_jueves_horario_330pm', true);
	$jueves_horario_4pm = get_post_meta($post->ID, '_jueves_horario_4pm', true);
	$jueves_horario_430pm = get_post_meta($post->ID, '_jueves_horario_430pm', true);
	$jueves_horario_5pm = get_post_meta($post->ID, '_jueves_horario_5pm', true);
	$jueves_horario_530pm = get_post_meta($post->ID, '_jueves_horario_530pm', true);
	$jueves_horario_6pm = get_post_meta($post->ID, '_jueves_horario_6pm', true);
	$jueves_horario_630pm = get_post_meta($post->ID, '_jueves_horario_630pm', true);
	$jueves_horario_7pm = get_post_meta($post->ID, '_jueves_horario_7pm', true);
	$jueves_horario_730pm = get_post_meta($post->ID, '_jueves_horario_730pm', true);
	$jueves_horario_8pm = get_post_meta($post->ID, '_jueves_horario_8pm', true);
	$jueves_horario_830pm = get_post_meta($post->ID, '_jueves_horario_830pm', true);


	wp_nonce_field(__FILE__, '_jueves_horario_9am_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_930am_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_10am_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_1030am_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_11am_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_1130am_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_12pm_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_1230pm_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_1pm_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_130pm_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_2pm_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_230pm_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_3pm_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_330pm_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_4pm_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_430pm_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_5pm_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_530pm_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_6pm_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_630pm_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_7pm_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_730pm_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_8pm_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_830pm_nonce');

	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9am - 9:30am  <input type='checkbox' class='[ widefat ]' name='_jueves_horario_9am' ";checked( $jueves_horario_9am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9:30am - 10am  <input type='checkbox' class='[ widefat ]' name='_jueves_horario_930am' ";checked( $jueves_horario_930am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10am - 10:30am <input type='checkbox' class='[ widefat ]' name='_jueves_horario_10am' ";checked( $jueves_horario_10am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10:30am - 11am <input type='checkbox' class='[ widefat ]' name='_jueves_horario_1030am' ";checked( $jueves_horario_1030am , 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11am - 11:30am <input type='checkbox' class='[ widefat ]' name='_jueves_horario_11am' ";checked( $jueves_horario_11am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11:30am - 12pm   <input type='checkbox' class='[ widefat ]' name='_jueves_horario_1130am' ";checked( $jueves_horario_1130am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12pm - 12:30pm <input type='checkbox' class='[ widefat ]' name='_jueves_horario_12pm' ";checked( $jueves_horario_12pm, 'SI' ); echo " value='SI'></div>";			 
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12:30pm - 1pm  <input type='checkbox' class='[ widefat ]' name='_jueves_horario_1230pm' ";checked( $jueves_horario_1230pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 1pm - 1:30pm <input type='checkbox' class='[ widefat ]' name='_jueves_horario_1pm' ";checked( $jueves_horario_1pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 1:30pm - 2pm <input type='checkbox' class='[ widefat ]' name='_jueves_horario_130pm' ";checked( $jueves_horario_130pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 2pm - 2:30pm <input type='checkbox' class='[ widefat ]' name='_jueves_horario_2pm' ";checked( $jueves_horario_2pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 2:30pm - 3pm   <input type='checkbox' class='[ widefat ]' name='_jueves_horario_230pm' ";checked( $jueves_horario_230pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 3pm - 3:30pm  <input type='checkbox' class='[ widefat ]' name='_jueves_horario_3pm' ";checked( $jueves_horario_3pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 3:30pm - 4pm <input type='checkbox' class='[ widefat ]' name='_jueves_horario_330pm' ";checked( $jueves_horario_330pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 4pm - 4:30pm <input type='checkbox' class='[ widefat ]' name='_jueves_horario_4pm' ";checked( $jueves_horario_4pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 4:30pm - 5pm <input type='checkbox' class='[ widefat ]' name='_jueves_horario_430pm' ";checked( $jueves_horario_430pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 5pm - 5:30pm   <input type='checkbox' class='[ widefat ]' name='_jueves_horario_5pm' ";checked( $jueves_horario_5pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 5:30pm - 6pm  <input type='checkbox' class='[ widefat ]' name='_jueves_horario_530pm' ";checked( $jueves_horario_530pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 6pm - 6:30pm <input type='checkbox' class='[ widefat ]' name='_jueves_horario_6pm' ";checked( $jueves_horario_6pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 6:30pm - 7pm <input type='checkbox' class='[ widefat ]' name='_jueves_horario_630pm' ";checked( $jueves_horario_630pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 7pm - 7:30pm <input type='checkbox' class='[ widefat ]' name='_jueves_horario_7pm' ";checked( $jueves_horario_7pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 7:30pm - 8pm <input type='checkbox' class='[ widefat ]' name='_jueves_horario_730pm' ";checked( $jueves_horario_730pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 8pm - 8:30pm <input type='checkbox' class='[ widefat ]' name='_jueves_horario_8pm' ";checked( $jueves_horario_8pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 8:30pm - 9pm <input type='checkbox' class='[ widefat ]' name='_jueves_horario_830pm' ";checked( $jueves_horario_830pm, 'SI' ); echo " value='SI'></div>";
	echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';

}

function metabox_tienda_horarios_viernes($post){

	$viernes_horario_9am = get_post_meta($post->ID, '_viernes_horario_9am', true);
	$viernes_horario_930am = get_post_meta($post->ID, '_viernes_horario_930am', true);
	$viernes_horario_10am = get_post_meta($post->ID, '_viernes_horario_10am', true);
	$viernes_horario_1030am = get_post_meta($post->ID, '_viernes_horario_1030am', true);
	$viernes_horario_11am = get_post_meta($post->ID, '_viernes_horario_11am', true);
	$viernes_horario_1130am = get_post_meta($post->ID, '_viernes_horario_1130am', true);
	$viernes_horario_12pm = get_post_meta($post->ID, '_viernes_horario_12pm', true);
	$viernes_horario_1230pm = get_post_meta($post->ID, '_viernes_horario_1230pm', true);
	$viernes_horario_1pm = get_post_meta($post->ID, '_viernes_horario_1pm', true);
	$viernes_horario_130pm = get_post_meta($post->ID, '_viernes_horario_130pm', true);
	$viernes_horario_2pm = get_post_meta($post->ID, '_viernes_horario_2pm', true);
	$viernes_horario_230pm = get_post_meta($post->ID, '_viernes_horario_230pm', true);
	$viernes_horario_3pm = get_post_meta($post->ID, '_viernes_horario_3pm', true);
	$viernes_horario_330pm = get_post_meta($post->ID, '_viernes_horario_330pm', true);
	$viernes_horario_4pm = get_post_meta($post->ID, '_viernes_horario_4pm', true);
	$viernes_horario_430pm = get_post_meta($post->ID, '_viernes_horario_430pm', true);
	$viernes_horario_5pm = get_post_meta($post->ID, '_viernes_horario_5pm', true);
	$viernes_horario_530pm = get_post_meta($post->ID, '_viernes_horario_530pm', true);
	$viernes_horario_6pm = get_post_meta($post->ID, '_viernes_horario_6pm', true);
	$viernes_horario_630pm = get_post_meta($post->ID, '_viernes_horario_630pm', true);
	$viernes_horario_7pm = get_post_meta($post->ID, '_viernes_horario_7pm', true);
	$viernes_horario_730pm = get_post_meta($post->ID, '_viernes_horario_730pm', true);
	$viernes_horario_8pm = get_post_meta($post->ID, '_viernes_horario_8pm', true);
	$viernes_horario_830pm = get_post_meta($post->ID, '_viernes_horario_830pm', true);


	wp_nonce_field(__FILE__, '_viernes_horario_9am_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_930am_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_10am_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_1030am_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_11am_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_1130am_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_12pm_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_1230pm_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_1pm_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_130pm_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_2pm_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_230pm_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_3pm_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_330pm_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_4pm_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_430pm_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_5pm_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_530pm_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_6pm_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_630pm_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_7pm_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_730pm_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_8pm_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_830pm_nonce');

	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9am - 9:30am  <input type='checkbox' class='[ widefat ]' name='_viernes_horario_9am' ";checked( $viernes_horario_9am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9:30am - 10am  <input type='checkbox' class='[ widefat ]' name='_viernes_horario_930am' ";checked( $viernes_horario_930am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10am - 10:30am <input type='checkbox' class='[ widefat ]' name='_viernes_horario_10am' ";checked( $viernes_horario_10am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10:30am - 11am <input type='checkbox' class='[ widefat ]' name='_viernes_horario_1030am' ";checked( $viernes_horario_1030am , 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11am - 11:30am <input type='checkbox' class='[ widefat ]' name='_viernes_horario_11am' ";checked( $viernes_horario_11am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11:30am - 12pm   <input type='checkbox' class='[ widefat ]' name='_viernes_horario_1130am' ";checked( $viernes_horario_1130am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12pm - 12:30pm <input type='checkbox' class='[ widefat ]' name='_viernes_horario_12pm' ";checked( $viernes_horario_12pm, 'SI' ); echo " value='SI'></div>";			 
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12:30pm - 1pm  <input type='checkbox' class='[ widefat ]' name='_viernes_horario_1230pm' ";checked( $viernes_horario_1230pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 1pm - 1:30pm <input type='checkbox' class='[ widefat ]' name='_viernes_horario_1pm' ";checked( $viernes_horario_1pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 1:30pm - 2pm <input type='checkbox' class='[ widefat ]' name='_viernes_horario_130pm' ";checked( $viernes_horario_130pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 2pm - 2:30pm <input type='checkbox' class='[ widefat ]' name='_viernes_horario_2pm' ";checked( $viernes_horario_2pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 2:30pm - 3pm   <input type='checkbox' class='[ widefat ]' name='_viernes_horario_230pm' ";checked( $viernes_horario_230pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 3pm - 3:30pm  <input type='checkbox' class='[ widefat ]' name='_viernes_horario_3pm' ";checked( $viernes_horario_3pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 3:30pm - 4pm <input type='checkbox' class='[ widefat ]' name='_viernes_horario_330pm' ";checked( $viernes_horario_330pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 4pm - 4:30pm <input type='checkbox' class='[ widefat ]' name='_viernes_horario_4pm' ";checked( $viernes_horario_4pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 4:30pm - 5pm <input type='checkbox' class='[ widefat ]' name='_viernes_horario_430pm' ";checked( $viernes_horario_430pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 5pm - 5:30pm   <input type='checkbox' class='[ widefat ]' name='_viernes_horario_5pm' ";checked( $viernes_horario_5pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 5:30pm - 6pm  <input type='checkbox' class='[ widefat ]' name='_viernes_horario_530pm' ";checked( $viernes_horario_530pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 6pm - 6:30pm <input type='checkbox' class='[ widefat ]' name='_viernes_horario_6pm' ";checked( $viernes_horario_6pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 6:30pm - 7pm <input type='checkbox' class='[ widefat ]' name='_viernes_horario_630pm' ";checked( $viernes_horario_630pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 7pm - 7:30pm <input type='checkbox' class='[ widefat ]' name='_viernes_horario_7pm' ";checked( $viernes_horario_7pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 7:30pm - 8pm <input type='checkbox' class='[ widefat ]' name='_viernes_horario_730pm' ";checked( $viernes_horario_730pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 8pm - 8:30pm <input type='checkbox' class='[ widefat ]' name='_viernes_horario_8pm' ";checked( $viernes_horario_8pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 8:30pm - 9pm <input type='checkbox' class='[ widefat ]' name='_viernes_horario_830pm' ";checked( $viernes_horario_830pm, 'SI' ); echo " value='SI'></div>";
	echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';

}

function metabox_tienda_horarios_sabado($post){

	$sabado_horario_9am = get_post_meta($post->ID, '_sabado_horario_9am', true);
	$sabado_horario_930am = get_post_meta($post->ID, '_sabado_horario_930am', true);
	$sabado_horario_10am = get_post_meta($post->ID, '_sabado_horario_10am', true);
	$sabado_horario_1030am = get_post_meta($post->ID, '_sabado_horario_1030am', true);
	$sabado_horario_11am = get_post_meta($post->ID, '_sabado_horario_11am', true);
	$sabado_horario_1130am = get_post_meta($post->ID, '_sabado_horario_1130am', true);
	$sabado_horario_12pm = get_post_meta($post->ID, '_sabado_horario_12pm', true);
	$sabado_horario_1230pm = get_post_meta($post->ID, '_sabado_horario_1230pm', true);
	$sabado_horario_1pm = get_post_meta($post->ID, '_sabado_horario_1pm', true);
	$sabado_horario_130pm = get_post_meta($post->ID, '_sabado_horario_130pm', true);
	$sabado_horario_2pm = get_post_meta($post->ID, '_sabado_horario_2pm', true);
	$sabado_horario_230pm = get_post_meta($post->ID, '_sabado_horario_230pm', true);
	$sabado_horario_3pm = get_post_meta($post->ID, '_sabado_horario_3pm', true);
	$sabado_horario_330pm = get_post_meta($post->ID, '_sabado_horario_330pm', true);
	$sabado_horario_4pm = get_post_meta($post->ID, '_sabado_horario_4pm', true);
	$sabado_horario_430pm = get_post_meta($post->ID, '_sabado_horario_430pm', true);
	$sabado_horario_5pm = get_post_meta($post->ID, '_sabado_horario_5pm', true);
	$sabado_horario_530pm = get_post_meta($post->ID, '_sabado_horario_530pm', true);
	$sabado_horario_6pm = get_post_meta($post->ID, '_sabado_horario_6pm', true);
	$sabado_horario_630pm = get_post_meta($post->ID, '_sabado_horario_630pm', true);
	$sabado_horario_7pm = get_post_meta($post->ID, '_sabado_horario_7pm', true);
	$sabado_horario_730pm = get_post_meta($post->ID, '_sabado_horario_730pm', true);
	$sabado_horario_8pm = get_post_meta($post->ID, '_sabado_horario_8pm', true);
	$sabado_horario_830pm = get_post_meta($post->ID, '_sabado_horario_830pm', true);


	wp_nonce_field(__FILE__, '_sabado_horario_9am_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_930am_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_10am_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_1030am_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_11am_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_1130am_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_12pm_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_1230pm_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_1pm_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_130pm_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_2pm_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_230pm_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_3pm_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_330pm_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_4pm_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_430pm_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_5pm_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_530pm_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_6pm_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_630pm_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_7pm_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_730pm_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_8pm_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_830pm_nonce');

	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9am - 9:30am  <input type='checkbox' class='[ widefat ]' name='_sabado_horario_9am' ";checked( $sabado_horario_9am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9:30am - 10am  <input type='checkbox' class='[ widefat ]' name='_sabado_horario_930am' ";checked( $sabado_horario_930am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10am - 10:30am <input type='checkbox' class='[ widefat ]' name='_sabado_horario_10am' ";checked( $sabado_horario_10am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10:30am - 11am <input type='checkbox' class='[ widefat ]' name='_sabado_horario_1030am' ";checked( $sabado_horario_1030am , 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11am - 11:30am <input type='checkbox' class='[ widefat ]' name='_sabado_horario_11am' ";checked( $sabado_horario_11am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11:30am - 12pm   <input type='checkbox' class='[ widefat ]' name='_sabado_horario_1130am' ";checked( $sabado_horario_1130am, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12pm - 12:30pm <input type='checkbox' class='[ widefat ]' name='_sabado_horario_12pm' ";checked( $sabado_horario_12pm, 'SI' ); echo " value='SI'></div>";			 
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12:30pm - 1pm  <input type='checkbox' class='[ widefat ]' name='_sabado_horario_1230pm' ";checked( $sabado_horario_1230pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 1pm - 1:30pm <input type='checkbox' class='[ widefat ]' name='_sabado_horario_1pm' ";checked( $sabado_horario_1pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 1:30pm - 2pm <input type='checkbox' class='[ widefat ]' name='_sabado_horario_130pm' ";checked( $sabado_horario_130pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 2pm - 2:30pm <input type='checkbox' class='[ widefat ]' name='_sabado_horario_2pm' ";checked( $sabado_horario_2pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 2:30pm - 3pm   <input type='checkbox' class='[ widefat ]' name='_sabado_horario_230pm' ";checked( $sabado_horario_230pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 3pm - 3:30pm  <input type='checkbox' class='[ widefat ]' name='_sabado_horario_3pm' ";checked( $sabado_horario_3pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 3:30pm - 4pm <input type='checkbox' class='[ widefat ]' name='_sabado_horario_330pm' ";checked( $sabado_horario_330pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 4pm - 4:30pm <input type='checkbox' class='[ widefat ]' name='_sabado_horario_4pm' ";checked( $sabado_horario_4pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 4:30pm - 5pm <input type='checkbox' class='[ widefat ]' name='_sabado_horario_430pm' ";checked( $sabado_horario_430pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 5pm - 5:30pm   <input type='checkbox' class='[ widefat ]' name='_sabado_horario_5pm' ";checked( $sabado_horario_5pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 5:30pm - 6pm  <input type='checkbox' class='[ widefat ]' name='_sabado_horario_530pm' ";checked( $sabado_horario_530pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 6pm - 6:30pm <input type='checkbox' class='[ widefat ]' name='_sabado_horario_6pm' ";checked( $sabado_horario_6pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 6:30pm - 7pm <input type='checkbox' class='[ widefat ]' name='_sabado_horario_630pm' ";checked( $sabado_horario_630pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 7pm - 7:30pm <input type='checkbox' class='[ widefat ]' name='_sabado_horario_7pm' ";checked( $sabado_horario_7pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 7:30pm - 8pm <input type='checkbox' class='[ widefat ]' name='_sabado_horario_730pm' ";checked( $sabado_horario_730pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 8pm - 8:30pm <input type='checkbox' class='[ widefat ]' name='_sabado_horario_8pm' ";checked( $sabado_horario_8pm, 'SI' ); echo " value='SI'></div>";
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 8:30pm - 9pm <input type='checkbox' class='[ widefat ]' name='_sabado_horario_830pm' ";checked( $sabado_horario_830pm, 'SI' ); echo " value='SI'></div>";
	echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';

}

/*------------------------------------*\
	SAVE METABOXES DATA
\*------------------------------------*/

	add_action('save_post', function( $post_id ){

		save_metaboxes_cita( $post_id );
		save_metaboxes_ciudad( $post_id );
		save_metaboxes_tienda( $post_id );
		save_metaboxes_tienda_lunes_horario( $post_id );
		save_metaboxes_tienda_martes_horario( $post_id );
		save_metaboxes_tienda_miercoles_horario( $post_id );
		save_metaboxes_tienda_jueves_horario( $post_id );
		save_metaboxes_tienda_viernes_horario( $post_id );
		save_metaboxes_tienda_sabado_horario( $post_id );

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

	function save_metaboxes_tienda_lunes_horario( $post_id ){

		if ( check_admin_referer( __FILE__, '_lunes_horario_9am_nonce') ){
			update_post_meta($post_id, '_lunes_horario_9am', $_POST['_lunes_horario_9am']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_930am_nonce') ){
			update_post_meta($post_id, '_lunes_horario_930am', $_POST['_lunes_horario_930am']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_10am_nonce') ){
			update_post_meta($post_id, '_lunes_horario_10am', $_POST['_lunes_horario_10am']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_1030am_nonce') ){
			update_post_meta($post_id, '_lunes_horario_1030am', $_POST['_lunes_horario_1030am']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_11am_nonce') ){
			update_post_meta($post_id, '_lunes_horario_11am', $_POST['_lunes_horario_11am']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_1130am_nonce') ){
			update_post_meta($post_id, '_lunes_horario_1130am', $_POST['_lunes_horario_1130am']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_12pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_12pm', $_POST['_lunes_horario_12pm']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_1230pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_1230pm', $_POST['_lunes_horario_1230pm']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_1pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_1pm', $_POST['_lunes_horario_1pm']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_130pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_130pm', $_POST['_lunes_horario_130pm']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_2pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_2pm', $_POST['_lunes_horario_2pm']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_230pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_230pm', $_POST['_lunes_horario_230pm']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_3pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_3pm', $_POST['_lunes_horario_3pm']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_330pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_330pm', $_POST['_lunes_horario_330pm']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_4pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_4pm', $_POST['_lunes_horario_4pm']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_430pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_430pm', $_POST['_lunes_horario_430pm']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_5pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_5pm', $_POST['_lunes_horario_5pm']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_530pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_530pm', $_POST['_lunes_horario_530pm']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_6pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_6pm', $_POST['_lunes_horario_6pm']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_630pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_630pm', $_POST['_lunes_horario_630pm']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_7pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_7pm', $_POST['_lunes_horario_7pm']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_730pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_730pm', $_POST['_lunes_horario_730pm']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_8pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_8pm', $_POST['_lunes_horario_8pm']);
		}
		if ( check_admin_referer( __FILE__, '_lunes_horario_830pm_nonce') ){
			update_post_meta($post_id, '_lunes_horario_830pm', $_POST['_lunes_horario_830pm']);
		}
		

	}// save_metaboxes_tienda

	function save_metaboxes_tienda_martes_horario( $post_id ){

		if ( check_admin_referer( __FILE__, '_martes_horario_9am_nonce') ){
			update_post_meta($post_id, '_martes_horario_9am', $_POST['_martes_horario_9am']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_930am_nonce') ){
			update_post_meta($post_id, '_martes_horario_930am', $_POST['_martes_horario_930am']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_10am_nonce') ){
			update_post_meta($post_id, '_martes_horario_10am', $_POST['_martes_horario_10am']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_1030am_nonce') ){
			update_post_meta($post_id, '_martes_horario_1030am', $_POST['_martes_horario_1030am']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_11am_nonce') ){
			update_post_meta($post_id, '_martes_horario_11am', $_POST['_martes_horario_11am']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_1130am_nonce') ){
			update_post_meta($post_id, '_martes_horario_1130am', $_POST['_martes_horario_1130am']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_12pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_12pm', $_POST['_martes_horario_12pm']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_1230pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_1230pm', $_POST['_martes_horario_1230pm']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_1pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_1pm', $_POST['_martes_horario_1pm']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_130pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_130pm', $_POST['_martes_horario_130pm']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_2pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_2pm', $_POST['_martes_horario_2pm']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_230pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_230pm', $_POST['_martes_horario_230pm']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_3pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_3pm', $_POST['_martes_horario_3pm']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_330pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_330pm', $_POST['_martes_horario_330pm']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_4pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_4pm', $_POST['_martes_horario_4pm']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_430pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_430pm', $_POST['_martes_horario_430pm']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_5pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_5pm', $_POST['_martes_horario_5pm']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_530pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_530pm', $_POST['_martes_horario_530pm']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_6pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_6pm', $_POST['_martes_horario_6pm']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_630pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_630pm', $_POST['_martes_horario_630pm']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_7pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_7pm', $_POST['_martes_horario_7pm']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_730pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_730pm', $_POST['_martes_horario_730pm']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_8pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_8pm', $_POST['_martes_horario_8pm']);
		}
		if ( check_admin_referer( __FILE__, '_martes_horario_830pm_nonce') ){
			update_post_meta($post_id, '_martes_horario_830pm', $_POST['_martes_horario_830pm']);
		}
		

	}

	function save_metaboxes_tienda_miercoles_horario( $post_id ){

		if ( check_admin_referer( __FILE__, '_miercoles_horario_9am_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_9am', $_POST['_miercoles_horario_9am']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_930am_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_930am', $_POST['_miercoles_horario_930am']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_10am_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_10am', $_POST['_miercoles_horario_10am']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_1030am_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_1030am', $_POST['_miercoles_horario_1030am']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_11am_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_11am', $_POST['_miercoles_horario_11am']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_1130am_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_1130am', $_POST['_miercoles_horario_1130am']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_12pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_12pm', $_POST['_miercoles_horario_12pm']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_1230pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_1230pm', $_POST['_miercoles_horario_1230pm']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_1pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_1pm', $_POST['_miercoles_horario_1pm']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_130pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_130pm', $_POST['_miercoles_horario_130pm']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_2pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_2pm', $_POST['_miercoles_horario_2pm']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_230pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_230pm', $_POST['_miercoles_horario_230pm']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_3pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_3pm', $_POST['_miercoles_horario_3pm']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_330pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_330pm', $_POST['_miercoles_horario_330pm']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_4pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_4pm', $_POST['_miercoles_horario_4pm']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_430pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_430pm', $_POST['_miercoles_horario_430pm']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_5pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_5pm', $_POST['_miercoles_horario_5pm']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_530pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_530pm', $_POST['_miercoles_horario_530pm']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_6pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_6pm', $_POST['_miercoles_horario_6pm']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_630pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_630pm', $_POST['_miercoles_horario_630pm']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_7pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_7pm', $_POST['_miercoles_horario_7pm']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_730pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_730pm', $_POST['_miercoles_horario_730pm']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_8pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_8pm', $_POST['_miercoles_horario_8pm']);
		}
		if ( check_admin_referer( __FILE__, '_miercoles_horario_830pm_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_830pm', $_POST['_miercoles_horario_830pm']);
		}
		

	}

	function save_metaboxes_tienda_jueves_horario( $post_id ){

		if ( check_admin_referer( __FILE__, '_jueves_horario_9am_nonce') ){
			update_post_meta($post_id, '_jueves_horario_9am', $_POST['_jueves_horario_9am']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_930am_nonce') ){
			update_post_meta($post_id, '_jueves_horario_930am', $_POST['_jueves_horario_930am']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_10am_nonce') ){
			update_post_meta($post_id, '_jueves_horario_10am', $_POST['_jueves_horario_10am']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_1030am_nonce') ){
			update_post_meta($post_id, '_jueves_horario_1030am', $_POST['_jueves_horario_1030am']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_11am_nonce') ){
			update_post_meta($post_id, '_jueves_horario_11am', $_POST['_jueves_horario_11am']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_1130am_nonce') ){
			update_post_meta($post_id, '_jueves_horario_1130am', $_POST['_jueves_horario_1130am']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_12pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_12pm', $_POST['_jueves_horario_12pm']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_1230pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_1230pm', $_POST['_jueves_horario_1230pm']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_1pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_1pm', $_POST['_jueves_horario_1pm']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_130pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_130pm', $_POST['_jueves_horario_130pm']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_2pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_2pm', $_POST['_jueves_horario_2pm']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_230pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_230pm', $_POST['_jueves_horario_230pm']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_3pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_3pm', $_POST['_jueves_horario_3pm']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_330pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_330pm', $_POST['_jueves_horario_330pm']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_4pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_4pm', $_POST['_jueves_horario_4pm']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_430pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_430pm', $_POST['_jueves_horario_430pm']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_5pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_5pm', $_POST['_jueves_horario_5pm']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_530pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_530pm', $_POST['_jueves_horario_530pm']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_6pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_6pm', $_POST['_jueves_horario_6pm']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_630pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_630pm', $_POST['_jueves_horario_630pm']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_7pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_7pm', $_POST['_jueves_horario_7pm']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_730pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_730pm', $_POST['_jueves_horario_730pm']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_8pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_8pm', $_POST['_jueves_horario_8pm']);
		}
		if ( check_admin_referer( __FILE__, '_jueves_horario_830pm_nonce') ){
			update_post_meta($post_id, '_jueves_horario_830pm', $_POST['_jueves_horario_830pm']);
		}
		

	}

	function save_metaboxes_tienda_viernes_horario( $post_id ){

		if ( check_admin_referer( __FILE__, '_viernes_horario_9am_nonce') ){
			update_post_meta($post_id, '_viernes_horario_9am', $_POST['_viernes_horario_9am']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_930am_nonce') ){
			update_post_meta($post_id, '_viernes_horario_930am', $_POST['_viernes_horario_930am']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_10am_nonce') ){
			update_post_meta($post_id, '_viernes_horario_10am', $_POST['_viernes_horario_10am']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_1030am_nonce') ){
			update_post_meta($post_id, '_viernes_horario_1030am', $_POST['_viernes_horario_1030am']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_11am_nonce') ){
			update_post_meta($post_id, '_viernes_horario_11am', $_POST['_viernes_horario_11am']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_1130am_nonce') ){
			update_post_meta($post_id, '_viernes_horario_1130am', $_POST['_viernes_horario_1130am']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_12pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_12pm', $_POST['_viernes_horario_12pm']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_1230pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_1230pm', $_POST['_viernes_horario_1230pm']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_1pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_1pm', $_POST['_viernes_horario_1pm']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_130pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_130pm', $_POST['_viernes_horario_130pm']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_2pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_2pm', $_POST['_viernes_horario_2pm']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_230pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_230pm', $_POST['_viernes_horario_230pm']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_3pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_3pm', $_POST['_viernes_horario_3pm']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_330pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_330pm', $_POST['_viernes_horario_330pm']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_4pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_4pm', $_POST['_viernes_horario_4pm']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_430pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_430pm', $_POST['_viernes_horario_430pm']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_5pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_5pm', $_POST['_viernes_horario_5pm']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_530pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_530pm', $_POST['_viernes_horario_530pm']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_6pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_6pm', $_POST['_viernes_horario_6pm']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_630pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_630pm', $_POST['_viernes_horario_630pm']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_7pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_7pm', $_POST['_viernes_horario_7pm']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_730pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_730pm', $_POST['_viernes_horario_730pm']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_8pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_8pm', $_POST['_viernes_horario_8pm']);
		}
		if ( check_admin_referer( __FILE__, '_viernes_horario_830pm_nonce') ){
			update_post_meta($post_id, '_viernes_horario_830pm', $_POST['_viernes_horario_830pm']);
		}
		

	}

	function save_metaboxes_tienda_sabado_horario( $post_id ){

		if ( check_admin_referer( __FILE__, '_sabado_horario_9am_nonce') ){
			update_post_meta($post_id, '_sabado_horario_9am', $_POST['_sabado_horario_9am']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_930am_nonce') ){
			update_post_meta($post_id, '_sabado_horario_930am', $_POST['_sabado_horario_930am']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_10am_nonce') ){
			update_post_meta($post_id, '_sabado_horario_10am', $_POST['_sabado_horario_10am']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_1030am_nonce') ){
			update_post_meta($post_id, '_sabado_horario_1030am', $_POST['_sabado_horario_1030am']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_11am_nonce') ){
			update_post_meta($post_id, '_sabado_horario_11am', $_POST['_sabado_horario_11am']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_1130am_nonce') ){
			update_post_meta($post_id, '_sabado_horario_1130am', $_POST['_sabado_horario_1130am']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_12pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_12pm', $_POST['_sabado_horario_12pm']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_1230pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_1230pm', $_POST['_sabado_horario_1230pm']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_1pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_1pm', $_POST['_sabado_horario_1pm']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_130pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_130pm', $_POST['_sabado_horario_130pm']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_2pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_2pm', $_POST['_sabado_horario_2pm']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_230pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_230pm', $_POST['_sabado_horario_230pm']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_3pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_3pm', $_POST['_sabado_horario_3pm']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_330pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_330pm', $_POST['_sabado_horario_330pm']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_4pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_4pm', $_POST['_sabado_horario_4pm']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_430pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_430pm', $_POST['_sabado_horario_430pm']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_5pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_5pm', $_POST['_sabado_horario_5pm']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_530pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_530pm', $_POST['_sabado_horario_530pm']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_6pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_6pm', $_POST['_sabado_horario_6pm']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_630pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_630pm', $_POST['_sabado_horario_630pm']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_7pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_7pm', $_POST['_sabado_horario_7pm']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_730pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_730pm', $_POST['_sabado_horario_730pm']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_8pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_8pm', $_POST['_sabado_horario_8pm']);
		}
		if ( check_admin_referer( __FILE__, '_sabado_horario_830pm_nonce') ){
			update_post_meta($post_id, '_sabado_horario_830pm', $_POST['_sabado_horario_830pm']);
		}
		

	}
