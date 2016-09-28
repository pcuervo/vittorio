<?php

/*------------------------------------*\
	CUSTOM METABOXES
\*------------------------------------*/

add_action('add_meta_boxes', function(){
	global $post;
	//var_dump($post);
	switch ( $post->post_type ) {
		case 'tiendas':
			//add_metaboxes_PAGENAE();
			add_metaboxes_tienda();
			break;
		default:
			// POST TYPES
			add_metaboxes_citas();
			add_metaboxes_ciudad();
			
	}
});



function validar_horarios() {
	global $wpdb;
	$resp = "OK";
	$fecha = $_POST['fecha'];
	$diaSemana = $_POST['dia'];
	$resp .= "-".$fecha;

	$horarios = get_post_meta($_POST['tiendaid'], $diaSemana.'_horario', true);
	
    $citas = $wpdb->get_results(
		"SELECT (select meta_value FROM ".$wpdb->prefix . "postmeta where post_id = p.ID and meta_key = '_horario_meta') as hora FROM ".$wpdb->prefix . "posts p, ".$wpdb->prefix . "postmeta pm WHERE p.post_type = 'citas' and p.ID = pm.post_id and pm.meta_key = '_fecha_meta' and pm.meta_value = '".$fecha."' and p.post_status = 'publish'"
		);
	//echo "SELECT ID FROM ".$wpdb->prefix . "posts p, ".$wpdb->prefix . "postmeta pm WHERE p.post_type = 'citas' and p.ID = pm.post_id and pm.meta_key = '_fecha_meta' and pm.meta_value = '".$fecha."' and p.post_status = 'publish'<br />";
	//var_dump($citas);

	$c = '';

	for($i=0; $i<count($citas); $i++) {
		$c .= $citas[$i]->hora.'-';
	}
	//$c = substr($c, -1);
	//echo $_POST['tiendaid'].' - '.$diaSemana;
	echo $horarios."*****".$c;
	wp_die();
}

add_action( 'wp_ajax_validar_horarios', 'validar_horarios');
add_action( 'wp_ajax_nopriv_validar_horarios', 'validar_horarios');



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
	add_meta_box( 'meta-box-ayuda-checks', 'Todos los horarios ', 'metabox_fast_checks', 'tiendas');
	add_meta_box( 'meta-box-tienda-horario-lunes', 'Lunes Horarios ', 'metabox_tienda_horarios_lunes', 'tiendas');
	add_meta_box( 'meta-box-tienda-horario-martes', 'Martes Horarios ', 'metabox_tienda_horarios_martes', 'tiendas');
	add_meta_box( 'meta-box-tienda-horario-miercoles', 'Miercoles Horarios ', 'metabox_tienda_horarios_miercoles', 'tiendas');
	add_meta_box( 'meta-box-tienda-horario-jueves', 'Jueves Horarios ', 'metabox_tienda_horarios_jueves', 'tiendas');
	add_meta_box( 'meta-box-tienda-horario-viernes', 'Viernes Horarios ', 'metabox_tienda_horarios_viernes', 'tiendas');
	add_meta_box( 'meta-box-tienda-horario-sabado', 'Sabado Horarios ', 'metabox_tienda_horarios_sabado', 'tiendas');
	add_meta_box( 'meta-box-tienda-horario-domingo', 'Domingo Horarios ', 'metabox_tienda_horarios_domingo', 'tiendas');
}// add_metaboxes_PAGE




/*-----------------------------------------*\
	CUSTOM POST LIST'S CALLBACK FUNCTIONS
\*-----------------------------------------*/
add_filter( 'manage_edit-citas_columns', 'my_edit_citas_columns' );

function my_edit_citas_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Cliente' ),
		'_ciudad_meta' => __( 'Ciudad' ),
		'_tienda_meta' => __( 'Tienda' ),
		'_fecha_meta' => __( 'Fecha' ),
		'_horario_meta' => __( 'Hora' ),
		'_porque_meta' => __( '¿Por qué?' ),
		'_quebuscas_meta' => __( '¿Qué buscas?' )
	);

	return $columns;
}

add_action( 'manage_citas_posts_custom_column', 'my_manage_citas_columns', 10, 2 );

function my_manage_citas_columns( $column, $post_id ) {
	global $post;
	
	switch( $column ) {

		/* If displaying the '_ciudad_meta' column. */
		case '_ciudad_meta' :

			/* Get the post meta. */
			$_ciudad_meta = get_post_meta( $post_id, '_ciudad_meta', true );

			/* If no _ciudad_meta is found, output a default message. */
			if ( empty( $_ciudad_meta ) )
				echo __( 'Unknown' );

			/* If there is a _ciudad_meta, append 'minutes' to the text string. */
			else
				echo $_ciudad_meta;

			break;
		case '_tienda_meta' :

			/* Get the post meta. */
			$_tienda_meta = get_post_meta( $post_id, '_tienda_meta', true );
			$tiendanombre = get_the_title( $_tienda_meta );

			/* If no _tienda_meta is found, output a default message. */
			if ( empty( $_tienda_meta ) )
				echo __( 'Unknown' );

			/* If there is a _tienda_meta, append 'minutes' to the text string. */
			else
				echo $tiendanombre;

			break;
		case '_fecha_meta' :

			/* Get the post meta. */
			$_fecha_meta = get_post_meta( $post_id, '_fecha_meta', true );

			/* If no _fecha_meta is found, output a default message. */
			if ( empty( $_fecha_meta ) )
				echo __( 'Unknown' );

			/* If there is a _fecha_meta, append 'minutes' to the text string. */
			else
				echo $_fecha_meta;

			break;
		case '_horario_meta' :

			/* Get the post meta. */
			$_horario_meta = get_post_meta( $post_id, '_horario_meta', true );

			/* If no _horario_meta is found, output a default message. */
			if ( empty( $_horario_meta ) )
				echo __( 'Unknown' );

			/* If there is a _horario_meta, append 'minutes' to the text string. */
			else
				echo $_horario_meta.':00';

			break;
		case '_porque_meta' :

			/* Get the post meta. */
			$_porque_meta = get_post_meta( $post_id, '_porque_meta', true );

			/* If no _porque_meta is found, output a default message. */
			if ( empty( $_porque_meta ) )
				echo __( 'Desconocido' );

			/* If there is a _porque_meta, append 'minutes' to the text string. */
			else
				echo $_porque_meta;

			break;			
		case '_quebuscas_meta' :

			/* Get the post meta. */
			$_quebuscas_meta = get_post_meta( $post_id, '_quebuscas_meta', true );

			/* If no _quebuscas_meta is found, output a default message. */
			if ( !empty( $_quebuscas_meta ) ) echo $_quebuscas_meta;


			break;
		/* If displaying the 'genre' column. */
		case 'genre' :

			/* Get the genres for the post. */
			$terms = get_the_terms( $post_id, 'genre' );

			/* If terms were found. */
			if ( !empty( $terms ) ) {

				$out = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'genre' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'genre', 'display' ) )
					);
				}

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			/* If no terms were found, output a default message. */
			else {
				_e( 'No Genres' );
			}

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}

add_filter( 'manage_edit-citas_sortable_columns', 'my_citas_sortable_columns' );

function my_citas_sortable_columns( $columns ) {

	$columns['_ciudad_meta'] = '_ciudad_meta';
	$columns['_tienda_meta'] = '_tienda_meta';
	$columns['_fecha_meta'] = '_fecha_meta';
	$columns['_horario_meta'] = '_horario_meta';

	return $columns;
}

/* Only run our customization on the 'edit.php' page in the admin. */
add_action( 'load-edit.php', 'my_edit_citas_load' );

function my_edit_citas_load() {
	add_filter( 'request', 'my_sort_citas' );
}

/* Sorts the citas. */
function my_sort_citas( $vars ) {

	/* Check if we're viewing the 'citas' post type. */
	if ( isset( $vars['post_type'] ) && 'citas' == $vars['post_type'] ) {

		/* Check if 'orderby' is set to '_ciudad_meta'. */
		if ( isset( $vars['orderby'] ) && '_ciudad_meta' == $vars['orderby'] ) {

			/* Merge the query vars with our custom variables. */
			$vars = array_merge(
				$vars,
				array(
					'meta_key' => '_ciudad_meta',
					'orderby' => 'meta_value_num'
				)
			);
		}
		/* Check if 'orderby' is set to '_tienda_meta'. */
		if ( isset( $vars['orderby'] ) && '_tienda_meta' == $vars['orderby'] ) {

			/* Merge the query vars with our custom variables. */
			$vars = array_merge(
				$vars,
				array(
					'meta_key' => '_tienda_meta',
					'orderby' => 'meta_value_num'
				)
			);
		}
		/* Check if 'orderby' is set to '_fecha_meta'. */
		if ( isset( $vars['orderby'] ) && '_fecha_meta' == $vars['orderby'] ) {

			/* Merge the query vars with our custom variables. */
			$vars = array_merge(
				$vars,
				array(
					'meta_key' => '_fecha_meta',
					'orderby' => 'meta_value_num'
				)
			);
		}
		/* Check if 'orderby' is set to '_horario_meta'. */
		if ( isset( $vars['orderby'] ) && '_horario_meta' == $vars['orderby'] ) {

			/* Merge the query vars with our custom variables. */
			$vars = array_merge(
				$vars,
				array(
					'meta_key' => '_horario_meta',
					'orderby' => 'meta_value_num'
				)
			);
		}
	}

	return $vars;
}

add_action( 'restrict_manage_posts' , 'modify_citas_filters'  );

function modify_citas_filters()
{
    // Only apply the filter to our specific post type
    global $wpdb;
	
    global $typenow;
    global $current_user;
    //wp_get_current_user();
    //var_dump($current_user);
    //$user_info = get_userdata(1);
    if( $typenow == 'citas' )
    {
    	$tiendas = $wpdb->get_results(
		"SELECT * FROM " . $wpdb->prefix . "posts WHERE post_type = 'tiendas' and post_status = 'publish'"
		);
		if (count($tiendas[0]) > 0) {
			$dis = '';
			$tid = 0;
			$tiendaid = get_the_author_meta('tiendas', $current_user->ID);
			if(in_array('citas_admin', $current_user->roles) && isset($tiendaid) && is_numeric($tiendaid) && $tiendaid > 0 ) {
				$dis = 'disabled';
				$tid = $tiendaid;
			}
			echo '<select id="tienda" name="tienda" data-parsley-error-message="Todas las tiendas" '.$dis.'>';
	 		echo '<option class="" value="" selected>Todas las Tiendas</option>';
			foreach ( $tiendas as $tienda )
			{
				if($tid > 0 && is_numeric($tid)) {
					if(isset($tid)) { $selected = $tienda->ID == $tid ? ' selected ' : ''; }
					else { $selected = ''; }
					echo '<option value="'.$tienda->ID.'" '.$selected.'>'.$tienda->post_title.'</option>';	
				}
				else {
					if(isset($_GET['tienda'])) { $selected = $tienda->ID == $_GET['tienda'] ? ' selected ' : ''; }
					else { $selected = ''; }
					echo '<option value="'.$tienda->ID.'" '.$selected.'>'.$tienda->post_title.'</option>';	
				}
			}
			echo '</select>';
		}
    	
    	$fechas = $wpdb->get_results(
		"SELECT distinct(pm.meta_value) FROM " . $wpdb->prefix . "posts p, " . $wpdb->prefix . "postmeta pm WHERE p.post_type = 'citas' and p.post_status = 'publish' and p.ID = pm.post_id AND pm.meta_key = '_fecha_meta';"
		);
		echo '<input type="date" id="fecha" name="fecha" value="" class="example-datepicker" />';
		/*
		if (count($fechas[0]) > 0) {
			echo '<select id="fecha" name="fecha" data-parsley-error-message="Cualquier Fecha" >';
	 		echo '<option class="" value="" selected>Cualquier Fecha</option>';
			foreach ( $fechas as $fecha )
			{
				if(isset($_GET['fecha'])) { $selected = $fecha->meta_value == $_GET['fecha'] ? ' selected ' : ''; }
				else { $selected = ''; }
				echo '<option value="'.$fecha->meta_value.'" '.$selected.'>'.$fecha->meta_value.'</option>';
			}
			echo '</select>';
		}
		*/
    }
}

add_filter( 'parse_query', 'modify_filter_citas' );
function ajusta_fecha( $fecha ) {
	$meses = array(
		'01' => 'Enero', 
		'02' => 'Febrero', 
		'03' => 'Marzo', 
		'04' => 'Abril', 
		'05' => 'Mayo', 
		'06' => 'Junio', 
		'07' => 'Julio', 
		'08' => 'Agosto', 
		'09' => 'Septiembre', 
		'10' => 'Octubre', 
		'11' => 'Noviembre', 
		'12' => 'Diciembre'
	);
	$fec = explode("-", $fecha);

	$fecFormat = $fec[2].' '.$meses[$fec[1]].', '.$fec[0];
	return $fecFormat;
}
function modify_filter_citas( $query )
{
    global $typenow;
    global $pagenow;
    global $current_user;

    $tiendaid = get_the_author_meta('tiendas', $current_user->ID);
	if(in_array('citas_admin', $current_user->roles) && isset($tiendaid) && is_numeric($tiendaid) && $tiendaid > 0 ) {
		$_GET['tienda'] = $tiendaid;
	}

    if( isset($_GET['tienda']) && $_GET['tienda'] != '' && isset($_GET['fecha']) && $_GET['fecha'] != '') {
    	//FILTRO COMBINADO
    	$query->query_vars['meta_query'] =  array(
										        'relation' => 'AND',
										        array(
										            'key'     	=> '_tienda_meta',
										            'value'		=> $_GET['tienda']
										        ),
										        array(
										            'key'     => '_fecha_meta',
										            'value'		=> ajusta_fecha($_GET['fecha'])
										        ),
										    );
    } else {
	    if( isset($_GET['tienda']) && $_GET['tienda'] != '') {
		    if( $pagenow == 'edit.php' && $typenow == 'citas' && $_GET['tienda'] )
		    {
		        $query->query_vars[ 'meta_key' ] = '_tienda_meta';
		        $query->query_vars[ 'meta_value' ] = (int)$_GET['tienda'];
		    }
		}
		if( isset($_GET['fecha']) && $_GET['fecha'] != '') {
		    if( $pagenow == 'edit.php' && $typenow == 'citas' && $_GET['fecha'] )
		    {
		        $query->query_vars[ 'meta_key' ] = '_fecha_meta';
		        $query->query_vars[ 'meta_value' ] = ajusta_fecha($_GET['fecha']);
		    }
		}
	}
}

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
	if($tienda != '') { $tiendanombre = get_the_title( $tienda ); }
	else { $tiendanombre = ''; }
	$fecha = get_post_meta($post->ID, '_fecha_meta', true);
	$horario = get_post_meta($post->ID, '_horario_meta', true);
	$porque = get_post_meta($post->ID, '_porque_meta', true);
	$quebuscas = get_post_meta($post->ID, '_quebuscas_meta', true);
	//$status = get_post_meta($post->ID, '_status_meta', true);
	
	wp_nonce_field(__FILE__, '_nombre_meta_nonce');
	wp_nonce_field(__FILE__, '_email_meta_nonce');
	wp_nonce_field(__FILE__, '_telefono_meta_nonce');
	wp_nonce_field(__FILE__, '_ciudad_meta_nonce');
	wp_nonce_field(__FILE__, '_tienda_meta_nonce');
	wp_nonce_field(__FILE__, '_fecha_meta_nonce');
	wp_nonce_field(__FILE__, '_horario_meta_nonce');
	wp_nonce_field(__FILE__, '_porque_meta_nonce');
	wp_nonce_field(__FILE__, '_quebuscas_meta_nonce');
	//wp_nonce_field(__FILE__, '_status_meta_nonce');

	echo '<label>Nombre</label>';
	echo "<input type='text' class='[ widefat ]' name='_nombre_meta' value='$nombre'>";
	echo '<label>Email</label>';
	echo "<input type='text' class='[ widefat ]' name='_email_meta' value='$email'>";
	echo '<label>Telefono</label>';
	echo "<input type='text' class='[ widefat ]' name='_telefono_meta' value='$telefono'>";
	echo '<label>Ciudad</label>';
	echo "<input type='text' class='[ widefat ]' name='_ciudad_meta' value='$ciudad'>";
	echo '<label>Tienda</label>';
	echo "<input type='text' class='[ widefat ]' name='_tienda_meta' value='$tiendanombre'>";
	echo '<label>Fecha</label>';
	echo "<input type='text' class='[ widefat ]' name='_fecha_meta' value='$fecha'>";
	echo '<label>Horario</label>';
	echo "<input type='text' class='[ widefat ]' name='_horario_meta' value='$horario'>";
	echo '<label>¿Por qué necesitas un traje?</label>';
	echo "<input type='text' class='[ widefat ]' name='_porque_meta' value='$porque'>";
	echo '<label>¿Qué buscas en un traje?</label>';
	echo "<input type='text' class='[ widefat ]' name='_quebuscas_meta' value='$quebuscas'>";
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
			echo '<option value="'.get_the_title().'" class="ciudad" id="ciudad_'.$posts->post->ID.'" data-lat="'.$meta['_latitud_meta'][0].'" data-long="'.$meta['_longitud_meta'][0].'" '.$selected.'>'.get_the_title().'</option>';
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

function metabox_fast_checks() {
	echo "<strong>Todos los horarios: </strong><input type='checkbox' class='[ widefat ]' id='ayudachecks' name='ayudachecks' value=''>";
}

function metabox_tienda_horarios_lunes($post){
	$meta = get_post_meta($post->ID, 'Lunes_horario', true);
	//var_dump($meta);
	$lunes_horario_9 = get_post_meta($post->ID, '_lunes_horario_9', true);
	$lunes_horario_10 = get_post_meta($post->ID, '_lunes_horario_10', true);
	$lunes_horario_11 = get_post_meta($post->ID, '_lunes_horario_11', true);
	$lunes_horario_12 = get_post_meta($post->ID, '_lunes_horario_12', true);
	$lunes_horario_13 = get_post_meta($post->ID, '_lunes_horario_13', true);
	$lunes_horario_14 = get_post_meta($post->ID, '_lunes_horario_14', true);
	$lunes_horario_15 = get_post_meta($post->ID, '_lunes_horario_15', true);
	$lunes_horario_16 = get_post_meta($post->ID, '_lunes_horario_16', true);
	$lunes_horario_17 = get_post_meta($post->ID, '_lunes_horario_17', true);
	$lunes_horario_18 = get_post_meta($post->ID, '_lunes_horario_18', true);
	$lunes_horario_19 = get_post_meta($post->ID, '_lunes_horario_19', true);
	$lunes_horario_20 = get_post_meta($post->ID, '_lunes_horario_20', true);
	$lunes_horario_21 = get_post_meta($post->ID, '_lunes_horario_21', true);


	wp_nonce_field(__FILE__, '_lunes_horario_9_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_10_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_11_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_12_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_13_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_14_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_15_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_16_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_17_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_18_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_19_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_20_nonce');
	wp_nonce_field(__FILE__, '_lunes_horario_21_nonce');

	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9:00 - 10:00  <input type='checkbox' class='[ widefat ] check_horario' name='_lunes_horario_9' ";checked( $lunes_horario_9, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10:00 - 11:00 <input type='checkbox' class='[ widefat ] check_horario' name='_lunes_horario_10' ";checked( $lunes_horario_10, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11:00 - 12:00 <input type='checkbox' class='[ widefat ] check_horario' name='_lunes_horario_11' ";checked( $lunes_horario_11, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12:00 - 13:00 <input type='checkbox' class='[ widefat ] check_horario' name='_lunes_horario_12' ";checked( $lunes_horario_12, 'SI' ); echo " value='SI'></div>";			 
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 13:00 - 14:00 <input type='checkbox' class='[ widefat ] check_horario' name='_lunes_horario_13' ";checked( $lunes_horario_13, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 14:00 - 15:00 <input type='checkbox' class='[ widefat ] check_horario' name='_lunes_horario_14' ";checked( $lunes_horario_14, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 15:00 - 16:00  <input type='checkbox' class='[ widefat ] check_horario' name='_lunes_horario_15' ";checked( $lunes_horario_15, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 16:00 - 17:00 <input type='checkbox' class='[ widefat ] check_horario' name='_lunes_horario_16' ";checked( $lunes_horario_16, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 17:00 - 18:00   <input type='checkbox' class='[ widefat ] check_horario' name='_lunes_horario_17' ";checked( $lunes_horario_17, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 18:00 - 19:00 <input type='checkbox' class='[ widefat ] check_horario' name='_lunes_horario_18' ";checked( $lunes_horario_18, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 19:00 - 20:00 <input type='checkbox' class='[ widefat ] check_horario' name='_lunes_horario_19' ";checked( $lunes_horario_19, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 20:00 - 21:00 <input type='checkbox' class='[ widefat ] check_horario' name='_lunes_horario_20' ";checked( $lunes_horario_20, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 21:00 - 22:00 <input type='checkbox' class='[ widefat ] check_horario' name='_lunes_horario_21' ";checked( $lunes_horario_21, 'SI' ); echo " value='SI'></div>";			 
	echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';
	


}

function metabox_tienda_horarios_martes($post){
	$meta = get_post_meta($post->ID, 'Martes_horario', true);
	//var_dump($meta);
	$martes_horario_9 = get_post_meta($post->ID, '_martes_horario_9', true);
	$martes_horario_10 = get_post_meta($post->ID, '_martes_horario_10', true);
	$martes_horario_11 = get_post_meta($post->ID, '_martes_horario_11', true);
	$martes_horario_12 = get_post_meta($post->ID, '_martes_horario_12', true);
	$martes_horario_13 = get_post_meta($post->ID, '_martes_horario_13', true);
	$martes_horario_14 = get_post_meta($post->ID, '_martes_horario_14', true);
	$martes_horario_15 = get_post_meta($post->ID, '_martes_horario_15', true);
	$martes_horario_16 = get_post_meta($post->ID, '_martes_horario_16', true);
	$martes_horario_17 = get_post_meta($post->ID, '_martes_horario_17', true);
	$martes_horario_18 = get_post_meta($post->ID, '_martes_horario_18', true);
	$martes_horario_19 = get_post_meta($post->ID, '_martes_horario_19', true);
	$martes_horario_20 = get_post_meta($post->ID, '_martes_horario_20', true);
	$martes_horario_21 = get_post_meta($post->ID, '_martes_horario_21', true);


	wp_nonce_field(__FILE__, '_martes_horario_9_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_10_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_11_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_12_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_13_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_14_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_15_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_16_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_17_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_18_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_19_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_20_nonce');
	wp_nonce_field(__FILE__, '_martes_horario_21_nonce');

	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9:00 - 10:00  <input type='checkbox' class='[ widefat ] check_horario' name='_martes_horario_9' ";checked( $martes_horario_9, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10:00 - 11:00 <input type='checkbox' class='[ widefat ] check_horario' name='_martes_horario_10' ";checked( $martes_horario_10, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11:00 - 12:00 <input type='checkbox' class='[ widefat ] check_horario' name='_martes_horario_11' ";checked( $martes_horario_11, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12:00 - 13:00 <input type='checkbox' class='[ widefat ] check_horario' name='_martes_horario_12' ";checked( $martes_horario_12, 'SI' ); echo " value='SI'></div>";			 
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 13:00 - 14:00 <input type='checkbox' class='[ widefat ] check_horario' name='_martes_horario_13' ";checked( $martes_horario_13, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 14:00 - 15:00 <input type='checkbox' class='[ widefat ] check_horario' name='_martes_horario_14' ";checked( $martes_horario_14, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 15:00 - 16:00  <input type='checkbox' class='[ widefat ] check_horario' name='_martes_horario_15' ";checked( $martes_horario_15, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 16:00 - 17:00 <input type='checkbox' class='[ widefat ] check_horario' name='_martes_horario_16' ";checked( $martes_horario_16, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 17:00 - 18:00   <input type='checkbox' class='[ widefat ] check_horario' name='_martes_horario_17' ";checked( $martes_horario_17, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 18:00 - 19:00 <input type='checkbox' class='[ widefat ] check_horario' name='_martes_horario_18' ";checked( $martes_horario_18, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 19:00 - 20:00 <input type='checkbox' class='[ widefat ] check_horario' name='_martes_horario_19' ";checked( $martes_horario_19, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 20:00 - 21:00 <input type='checkbox' class='[ widefat ] check_horario' name='_martes_horario_20' ";checked( $martes_horario_20, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 21:00 - 22:00 <input type='checkbox' class='[ widefat ] check_horario' name='_martes_horario_21' ";checked( $martes_horario_21, 'SI' ); echo " value='SI'></div>";			 
	echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';
	


}

function metabox_tienda_horarios_miercoles($post){
	$meta = get_post_meta($post->ID, 'Miercoles_horario', true);
	//var_dump($meta);
	$miercoles_horario_9 = get_post_meta($post->ID, '_miercoles_horario_9', true);
	$miercoles_horario_10 = get_post_meta($post->ID, '_miercoles_horario_10', true);
	$miercoles_horario_11 = get_post_meta($post->ID, '_miercoles_horario_11', true);
	$miercoles_horario_12 = get_post_meta($post->ID, '_miercoles_horario_12', true);
	$miercoles_horario_13 = get_post_meta($post->ID, '_miercoles_horario_13', true);
	$miercoles_horario_14 = get_post_meta($post->ID, '_miercoles_horario_14', true);
	$miercoles_horario_15 = get_post_meta($post->ID, '_miercoles_horario_15', true);
	$miercoles_horario_16 = get_post_meta($post->ID, '_miercoles_horario_16', true);
	$miercoles_horario_17 = get_post_meta($post->ID, '_miercoles_horario_17', true);
	$miercoles_horario_18 = get_post_meta($post->ID, '_miercoles_horario_18', true);
	$miercoles_horario_19 = get_post_meta($post->ID, '_miercoles_horario_19', true);
	$miercoles_horario_20 = get_post_meta($post->ID, '_miercoles_horario_20', true);
	$miercoles_horario_21 = get_post_meta($post->ID, '_miercoles_horario_21', true);


	wp_nonce_field(__FILE__, '_miercoles_horario_9_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_10_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_11_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_12_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_13_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_14_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_15_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_16_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_17_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_18_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_19_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_20_nonce');
	wp_nonce_field(__FILE__, '_miercoles_horario_21_nonce');

	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9:00 - 10:00  <input type='checkbox' class='[ widefat ] check_horario' name='_miercoles_horario_9' ";checked( $miercoles_horario_9, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10:00 - 11:00 <input type='checkbox' class='[ widefat ] check_horario' name='_miercoles_horario_10' ";checked( $miercoles_horario_10, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11:00 - 12:00 <input type='checkbox' class='[ widefat ] check_horario' name='_miercoles_horario_11' ";checked( $miercoles_horario_11, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12:00 - 13:00 <input type='checkbox' class='[ widefat ] check_horario' name='_miercoles_horario_12' ";checked( $miercoles_horario_12, 'SI' ); echo " value='SI'></div>";			 
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 13:00 - 14:00 <input type='checkbox' class='[ widefat ] check_horario' name='_miercoles_horario_13' ";checked( $miercoles_horario_13, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 14:00 - 15:00 <input type='checkbox' class='[ widefat ] check_horario' name='_miercoles_horario_14' ";checked( $miercoles_horario_14, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 15:00 - 16:00  <input type='checkbox' class='[ widefat ] check_horario' name='_miercoles_horario_15' ";checked( $miercoles_horario_15, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 16:00 - 17:00 <input type='checkbox' class='[ widefat ] check_horario' name='_miercoles_horario_16' ";checked( $miercoles_horario_16, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 17:00 - 18:00   <input type='checkbox' class='[ widefat ] check_horario' name='_miercoles_horario_17' ";checked( $miercoles_horario_17, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 18:00 - 19:00 <input type='checkbox' class='[ widefat ] check_horario' name='_miercoles_horario_18' ";checked( $miercoles_horario_18, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 19:00 - 20:00 <input type='checkbox' class='[ widefat ] check_horario' name='_miercoles_horario_19' ";checked( $miercoles_horario_19, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 20:00 - 21:00 <input type='checkbox' class='[ widefat ] check_horario' name='_miercoles_horario_20' ";checked( $miercoles_horario_20, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 21:00 - 22:00 <input type='checkbox' class='[ widefat ] check_horario' name='_miercoles_horario_21' ";checked( $miercoles_horario_21, 'SI' ); echo " value='SI'></div>";			 
	echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';
	


}

function metabox_tienda_horarios_jueves($post){
	$meta = get_post_meta($post->ID, 'Jueves_horario', true);
	//var_dump($meta);
	$jueves_horario_9 = get_post_meta($post->ID, '_jueves_horario_9', true);
	$jueves_horario_10 = get_post_meta($post->ID, '_jueves_horario_10', true);
	$jueves_horario_11 = get_post_meta($post->ID, '_jueves_horario_11', true);
	$jueves_horario_12 = get_post_meta($post->ID, '_jueves_horario_12', true);
	$jueves_horario_13 = get_post_meta($post->ID, '_jueves_horario_13', true);
	$jueves_horario_14 = get_post_meta($post->ID, '_jueves_horario_14', true);
	$jueves_horario_15 = get_post_meta($post->ID, '_jueves_horario_15', true);
	$jueves_horario_16 = get_post_meta($post->ID, '_jueves_horario_16', true);
	$jueves_horario_17 = get_post_meta($post->ID, '_jueves_horario_17', true);
	$jueves_horario_18 = get_post_meta($post->ID, '_jueves_horario_18', true);
	$jueves_horario_19 = get_post_meta($post->ID, '_jueves_horario_19', true);
	$jueves_horario_20 = get_post_meta($post->ID, '_jueves_horario_20', true);
	$jueves_horario_21 = get_post_meta($post->ID, '_jueves_horario_21', true);


	wp_nonce_field(__FILE__, '_jueves_horario_9_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_10_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_11_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_12_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_13_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_14_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_15_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_16_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_17_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_18_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_19_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_20_nonce');
	wp_nonce_field(__FILE__, '_jueves_horario_21_nonce');

	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9:00 - 10:00  <input type='checkbox' class='[ widefat ] check_horario' name='_jueves_horario_9' ";checked( $jueves_horario_9, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10:00 - 11:00 <input type='checkbox' class='[ widefat ] check_horario' name='_jueves_horario_10' ";checked( $jueves_horario_10, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11:00 - 12:00 <input type='checkbox' class='[ widefat ] check_horario' name='_jueves_horario_11' ";checked( $jueves_horario_11, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12:00 - 13:00 <input type='checkbox' class='[ widefat ] check_horario' name='_jueves_horario_12' ";checked( $jueves_horario_12, 'SI' ); echo " value='SI'></div>";			 
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 13:00 - 14:00 <input type='checkbox' class='[ widefat ] check_horario' name='_jueves_horario_13' ";checked( $jueves_horario_13, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 14:00 - 15:00 <input type='checkbox' class='[ widefat ] check_horario' name='_jueves_horario_14' ";checked( $jueves_horario_14, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 15:00 - 16:00  <input type='checkbox' class='[ widefat ] check_horario' name='_jueves_horario_15' ";checked( $jueves_horario_15, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 16:00 - 17:00 <input type='checkbox' class='[ widefat ] check_horario' name='_jueves_horario_16' ";checked( $jueves_horario_16, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 17:00 - 18:00   <input type='checkbox' class='[ widefat ] check_horario' name='_jueves_horario_17' ";checked( $jueves_horario_17, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 18:00 - 19:00 <input type='checkbox' class='[ widefat ] check_horario' name='_jueves_horario_18' ";checked( $jueves_horario_18, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 19:00 - 20:00 <input type='checkbox' class='[ widefat ] check_horario' name='_jueves_horario_19' ";checked( $jueves_horario_19, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 20:00 - 21:00 <input type='checkbox' class='[ widefat ] check_horario' name='_jueves_horario_20' ";checked( $jueves_horario_20, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 21:00 - 22:00 <input type='checkbox' class='[ widefat ] check_horario' name='_jueves_horario_21' ";checked( $jueves_horario_21, 'SI' ); echo " value='SI'></div>";			 
	echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';
	


}

function metabox_tienda_horarios_viernes($post){
	$meta = get_post_meta($post->ID, 'Viernes_horario', true);
	//var_dump($meta);
	$viernes_horario_9 = get_post_meta($post->ID, '_viernes_horario_9', true);
	$viernes_horario_10 = get_post_meta($post->ID, '_viernes_horario_10', true);
	$viernes_horario_11 = get_post_meta($post->ID, '_viernes_horario_11', true);
	$viernes_horario_12 = get_post_meta($post->ID, '_viernes_horario_12', true);
	$viernes_horario_13 = get_post_meta($post->ID, '_viernes_horario_13', true);
	$viernes_horario_14 = get_post_meta($post->ID, '_viernes_horario_14', true);
	$viernes_horario_15 = get_post_meta($post->ID, '_viernes_horario_15', true);
	$viernes_horario_16 = get_post_meta($post->ID, '_viernes_horario_16', true);
	$viernes_horario_17 = get_post_meta($post->ID, '_viernes_horario_17', true);
	$viernes_horario_18 = get_post_meta($post->ID, '_viernes_horario_18', true);
	$viernes_horario_19 = get_post_meta($post->ID, '_viernes_horario_19', true);
	$viernes_horario_20 = get_post_meta($post->ID, '_viernes_horario_20', true);
	$viernes_horario_21 = get_post_meta($post->ID, '_viernes_horario_21', true);


	wp_nonce_field(__FILE__, '_viernes_horario_9_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_10_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_11_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_12_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_13_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_14_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_15_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_16_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_17_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_18_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_19_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_20_nonce');
	wp_nonce_field(__FILE__, '_viernes_horario_21_nonce');

	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9:00 - 10:00  <input type='checkbox' class='[ widefat ] check_horario' name='_viernes_horario_9' ";checked( $viernes_horario_9, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10:00 - 11:00 <input type='checkbox' class='[ widefat ] check_horario' name='_viernes_horario_10' ";checked( $viernes_horario_10, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11:00 - 12:00 <input type='checkbox' class='[ widefat ] check_horario' name='_viernes_horario_11' ";checked( $viernes_horario_11, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12:00 - 13:00 <input type='checkbox' class='[ widefat ] check_horario' name='_viernes_horario_12' ";checked( $viernes_horario_12, 'SI' ); echo " value='SI'></div>";			 
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 13:00 - 14:00 <input type='checkbox' class='[ widefat ] check_horario' name='_viernes_horario_13' ";checked( $viernes_horario_13, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 14:00 - 15:00 <input type='checkbox' class='[ widefat ] check_horario' name='_viernes_horario_14' ";checked( $viernes_horario_14, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 15:00 - 16:00  <input type='checkbox' class='[ widefat ] check_horario' name='_viernes_horario_15' ";checked( $viernes_horario_15, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 16:00 - 17:00 <input type='checkbox' class='[ widefat ] check_horario' name='_viernes_horario_16' ";checked( $viernes_horario_16, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 17:00 - 18:00   <input type='checkbox' class='[ widefat ] check_horario' name='_viernes_horario_17' ";checked( $viernes_horario_17, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 18:00 - 19:00 <input type='checkbox' class='[ widefat ] check_horario' name='_viernes_horario_18' ";checked( $viernes_horario_18, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 19:00 - 20:00 <input type='checkbox' class='[ widefat ] check_horario' name='_viernes_horario_19' ";checked( $viernes_horario_19, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 20:00 - 21:00 <input type='checkbox' class='[ widefat ] check_horario' name='_viernes_horario_20' ";checked( $viernes_horario_20, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 21:00 - 22:00 <input type='checkbox' class='[ widefat ] check_horario' name='_viernes_horario_21' ";checked( $viernes_horario_21, 'SI' ); echo " value='SI'></div>";			 
	echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';
	


}

function metabox_tienda_horarios_sabado($post){
	$meta = get_post_meta($post->ID, 'Sabado_horario', true);
	//var_dump($meta);
	$sabado_horario_9 = get_post_meta($post->ID, '_sabado_horario_9', true);
	$sabado_horario_10 = get_post_meta($post->ID, '_sabado_horario_10', true);
	$sabado_horario_11 = get_post_meta($post->ID, '_sabado_horario_11', true);
	$sabado_horario_12 = get_post_meta($post->ID, '_sabado_horario_12', true);
	$sabado_horario_13 = get_post_meta($post->ID, '_sabado_horario_13', true);
	$sabado_horario_14 = get_post_meta($post->ID, '_sabado_horario_14', true);
	$sabado_horario_15 = get_post_meta($post->ID, '_sabado_horario_15', true);
	$sabado_horario_16 = get_post_meta($post->ID, '_sabado_horario_16', true);
	$sabado_horario_17 = get_post_meta($post->ID, '_sabado_horario_17', true);
	$sabado_horario_18 = get_post_meta($post->ID, '_sabado_horario_18', true);
	$sabado_horario_19 = get_post_meta($post->ID, '_sabado_horario_19', true);
	$sabado_horario_20 = get_post_meta($post->ID, '_sabado_horario_20', true);
	$sabado_horario_21 = get_post_meta($post->ID, '_sabado_horario_21', true);


	wp_nonce_field(__FILE__, '_sabado_horario_9_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_10_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_11_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_12_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_13_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_14_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_15_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_16_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_17_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_18_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_19_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_20_nonce');
	wp_nonce_field(__FILE__, '_sabado_horario_21_nonce');

	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9:00 - 10:00  <input type='checkbox' class='[ widefat ] check_horario' name='_sabado_horario_9' ";checked( $sabado_horario_9, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10:00 - 11:00 <input type='checkbox' class='[ widefat ] check_horario' name='_sabado_horario_10' ";checked( $sabado_horario_10, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11:00 - 12:00 <input type='checkbox' class='[ widefat ] check_horario' name='_sabado_horario_11' ";checked( $sabado_horario_11, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12:00 - 13:00 <input type='checkbox' class='[ widefat ] check_horario' name='_sabado_horario_12' ";checked( $sabado_horario_12, 'SI' ); echo " value='SI'></div>";			 
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 13:00 - 14:00 <input type='checkbox' class='[ widefat ] check_horario' name='_sabado_horario_13' ";checked( $sabado_horario_13, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 14:00 - 15:00 <input type='checkbox' class='[ widefat ] check_horario' name='_sabado_horario_14' ";checked( $sabado_horario_14, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 15:00 - 16:00  <input type='checkbox' class='[ widefat ] check_horario' name='_sabado_horario_15' ";checked( $sabado_horario_15, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 16:00 - 17:00 <input type='checkbox' class='[ widefat ] check_horario' name='_sabado_horario_16' ";checked( $sabado_horario_16, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 17:00 - 18:00   <input type='checkbox' class='[ widefat ] check_horario' name='_sabado_horario_17' ";checked( $sabado_horario_17, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 18:00 - 19:00 <input type='checkbox' class='[ widefat ] check_horario' name='_sabado_horario_18' ";checked( $sabado_horario_18, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 19:00 - 20:00 <input type='checkbox' class='[ widefat ] check_horario' name='_sabado_horario_19' ";checked( $sabado_horario_19, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 20:00 - 21:00 <input type='checkbox' class='[ widefat ] check_horario' name='_sabado_horario_20' ";checked( $sabado_horario_20, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 21:00 - 22:00 <input type='checkbox' class='[ widefat ] check_horario' name='_sabado_horario_21' ";checked( $sabado_horario_21, 'SI' ); echo " value='SI'></div>";			 
	echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';
	


}

function metabox_tienda_horarios_domingo($post){
	$meta = get_post_meta($post->ID, 'Domingo_horario', true);
	//var_dump($meta);
	$domingo_horario_9 = get_post_meta($post->ID, '_domingo_horario_9', true);
	$domingo_horario_10 = get_post_meta($post->ID, '_domingo_horario_10', true);
	$domingo_horario_11 = get_post_meta($post->ID, '_domingo_horario_11', true);
	$domingo_horario_12 = get_post_meta($post->ID, '_domingo_horario_12', true);
	$domingo_horario_13 = get_post_meta($post->ID, '_domingo_horario_13', true);
	$domingo_horario_14 = get_post_meta($post->ID, '_domingo_horario_14', true);
	$domingo_horario_15 = get_post_meta($post->ID, '_domingo_horario_15', true);
	$domingo_horario_16 = get_post_meta($post->ID, '_domingo_horario_16', true);
	$domingo_horario_17 = get_post_meta($post->ID, '_domingo_horario_17', true);
	$domingo_horario_18 = get_post_meta($post->ID, '_domingo_horario_18', true);
	$domingo_horario_19 = get_post_meta($post->ID, '_domingo_horario_19', true);
	$domingo_horario_20 = get_post_meta($post->ID, '_domingo_horario_20', true);
	$domingo_horario_21 = get_post_meta($post->ID, '_domingo_horario_21', true);


	wp_nonce_field(__FILE__, '_domingo_horario_9_nonce');
	wp_nonce_field(__FILE__, '_domingo_horario_10_nonce');
	wp_nonce_field(__FILE__, '_domingo_horario_11_nonce');
	wp_nonce_field(__FILE__, '_domingo_horario_12_nonce');
	wp_nonce_field(__FILE__, '_domingo_horario_13_nonce');
	wp_nonce_field(__FILE__, '_domingo_horario_14_nonce');
	wp_nonce_field(__FILE__, '_domingo_horario_15_nonce');
	wp_nonce_field(__FILE__, '_domingo_horario_16_nonce');
	wp_nonce_field(__FILE__, '_domingo_horario_17_nonce');
	wp_nonce_field(__FILE__, '_domingo_horario_18_nonce');
	wp_nonce_field(__FILE__, '_domingo_horario_19_nonce');
	wp_nonce_field(__FILE__, '_domingo_horario_20_nonce');
	wp_nonce_field(__FILE__, '_domingo_horario_21_nonce');

	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 9:00 - 10:00  <input type='checkbox' class='[ widefat ] check_horario' name='_domingo_horario_9' ";checked( $domingo_horario_9, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 10:00 - 11:00 <input type='checkbox' class='[ widefat ] check_horario' name='_domingo_horario_10' ";checked( $domingo_horario_10, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 11:00 - 12:00 <input type='checkbox' class='[ widefat ] check_horario' name='_domingo_horario_11' ";checked( $domingo_horario_11, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 12:00 - 13:00 <input type='checkbox' class='[ widefat ] check_horario' name='_domingo_horario_12' ";checked( $domingo_horario_12, 'SI' ); echo " value='SI'></div>";			 
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 13:00 - 14:00 <input type='checkbox' class='[ widefat ] check_horario' name='_domingo_horario_13' ";checked( $domingo_horario_13, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 14:00 - 15:00 <input type='checkbox' class='[ widefat ] check_horario' name='_domingo_horario_14' ";checked( $domingo_horario_14, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 15:00 - 16:00  <input type='checkbox' class='[ widefat ] check_horario' name='_domingo_horario_15' ";checked( $domingo_horario_15, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 16:00 - 17:00 <input type='checkbox' class='[ widefat ] check_horario' name='_domingo_horario_16' ";checked( $domingo_horario_16, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 17:00 - 18:00   <input type='checkbox' class='[ widefat ] check_horario' name='_domingo_horario_17' ";checked( $domingo_horario_17, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 18:00 - 19:00 <input type='checkbox' class='[ widefat ] check_horario' name='_domingo_horario_18' ";checked( $domingo_horario_18, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 19:00 - 20:00 <input type='checkbox' class='[ widefat ] check_horario' name='_domingo_horario_19' ";checked( $domingo_horario_19, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 20:00 - 21:00 <input type='checkbox' class='[ widefat ] check_horario' name='_domingo_horario_20' ";checked( $domingo_horario_20, 'SI' ); echo " value='SI'></div>";
	
	echo "<div style='border: 1px solid gray; width: 16%; float:left; padding: 2px;'>
			 21:00 - 22:00 <input type='checkbox' class='[ widefat ] check_horario' name='_domingo_horario_21' ";checked( $domingo_horario_21, 'SI' ); echo " value='SI'></div>";			 
	echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';
	


}


/*------------------------------------*\
	SAVE METABOXES DATA
\*------------------------------------*/

	add_action('save_post', function( $post_id ){
		global $post;
		if(isset($post)) {
			switch ( $post->post_type ) {
				case 'tiendas':
					save_metaboxes_tienda( $post_id );
					save_metaboxes_tienda_lunes_horario( $post_id );
					save_metaboxes_tienda_martes_horario( $post_id );
					save_metaboxes_tienda_miercoles_horario( $post_id );
					save_metaboxes_tienda_jueves_horario( $post_id );
					save_metaboxes_tienda_viernes_horario( $post_id );
					save_metaboxes_tienda_sabado_horario( $post_id );
					save_metaboxes_tienda_domingo_horario( $post_id );
					break;
				case 'citas':
					save_metaboxes_cita( $post_id );
					break;
				case 'ciudades':
					save_metaboxes_ciudad( $post_id );
					break;				
				default:
			}
		}
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
		/*
		if ( isset($_POST['_status_meta']) and check_admin_referer( __FILE__, '_status_meta_nonce') ){
			update_post_meta($post_id, '_status_meta', $_POST['_status_meta']);
		}
		*/

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
		$horario_lunes = '';
		if ( check_admin_referer( __FILE__, '_lunes_horario_9_nonce') ){
			update_post_meta($post_id, '_lunes_horario_9', $_POST['_lunes_horario_9']);
			if (isset($_POST['_lunes_horario_9'])) { $horario_lunes .= '9-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_lunes_horario_10_nonce') ){
			update_post_meta($post_id, '_lunes_horario_10', $_POST['_lunes_horario_10']);
			if (isset($_POST['_lunes_horario_10'])) { $horario_lunes .= '10-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_lunes_horario_11_nonce') ){
			update_post_meta($post_id, '_lunes_horario_11', $_POST['_lunes_horario_11']);
			if (isset($_POST['_lunes_horario_11'])) { $horario_lunes .= '11-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_lunes_horario_12_nonce') ){
			update_post_meta($post_id, '_lunes_horario_12', $_POST['_lunes_horario_12']);
			if (isset($_POST['_lunes_horario_12'])) { $horario_lunes .= '12-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_lunes_horario_13_nonce') ){
			update_post_meta($post_id, '_lunes_horario_13', $_POST['_lunes_horario_13']);
			if (isset($_POST['_lunes_horario_13'])) { $horario_lunes .= '13-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_lunes_horario_14_nonce') ){
			update_post_meta($post_id, '_lunes_horario_14', $_POST['_lunes_horario_14']);
			if (isset($_POST['_lunes_horario_14'])) { $horario_lunes .= '14-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_lunes_horario_15_nonce') ){
			update_post_meta($post_id, '_lunes_horario_15', $_POST['_lunes_horario_15']);
			if (isset($_POST['_lunes_horario_15'])) { $horario_lunes .= '15-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_lunes_horario_16_nonce') ){
			update_post_meta($post_id, '_lunes_horario_16', $_POST['_lunes_horario_16']);
			if (isset($_POST['_lunes_horario_16'])) { $horario_lunes .= '16-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_lunes_horario_17_nonce') ){
			update_post_meta($post_id, '_lunes_horario_17', $_POST['_lunes_horario_17']);
			if (isset($_POST['_lunes_horario_17'])) { $horario_lunes .= '17-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_lunes_horario_18_nonce') ){
			update_post_meta($post_id, '_lunes_horario_18', $_POST['_lunes_horario_18']);
			if (isset($_POST['_lunes_horario_18'])) { $horario_lunes .= '18-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_lunes_horario_19_nonce') ){
			update_post_meta($post_id, '_lunes_horario_19', $_POST['_lunes_horario_19']);
			if (isset($_POST['_lunes_horario_19'])) { $horario_lunes .= '19-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_lunes_horario_20_nonce') ){
			update_post_meta($post_id, '_lunes_horario_20', $_POST['_lunes_horario_20']);
			if (isset($_POST['_lunes_horario_20'])) { $horario_lunes .= '20-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_lunes_horario_21_nonce') ){
			update_post_meta($post_id, '_lunes_horario_21', $_POST['_lunes_horario_21']);
			if (isset($_POST['_lunes_horario_21'])) { $horario_lunes .= '21-'; }
		}
		/*
		if (isset($_POST['_lunes_horario_21'])) { 
			$horario_lunes .= '21-'; 
			if ( check_admin_referer( __FILE__, '_lunes_horario_21_nonce') ){
				update_post_meta($post_id, '_lunes_horario_21', $_POST['_lunes_horario_21']);
			}
		}
		*/
		update_post_meta($post_id, 'Lunes_horario',$horario_lunes);		

	}// save_metaboxes_tienda

	function save_metaboxes_tienda_martes_horario( $post_id ){
		$horario_martes = '';
		if ( check_admin_referer( __FILE__, '_martes_horario_9_nonce') ){
			update_post_meta($post_id, '_martes_horario_9', $_POST['_martes_horario_9']);
			if (isset($_POST['_martes_horario_9'])) { $horario_martes .= '9-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_martes_horario_10_nonce') ){
			update_post_meta($post_id, '_martes_horario_10', $_POST['_martes_horario_10']);
			if (isset($_POST['_martes_horario_10'])) { $horario_martes .= '10-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_martes_horario_11_nonce') ){
			update_post_meta($post_id, '_martes_horario_11', $_POST['_martes_horario_11']);
			if (isset($_POST['_martes_horario_11'])) { $horario_martes .= '11-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_martes_horario_12_nonce') ){
			update_post_meta($post_id, '_martes_horario_12', $_POST['_martes_horario_12']);
			if (isset($_POST['_martes_horario_12'])) { $horario_martes .= '12-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_martes_horario_13_nonce') ){
			update_post_meta($post_id, '_martes_horario_13', $_POST['_martes_horario_13']);
			if (isset($_POST['_martes_horario_13'])) { $horario_martes .= '13-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_martes_horario_14_nonce') ){
			update_post_meta($post_id, '_martes_horario_14', $_POST['_martes_horario_14']);
			if (isset($_POST['_martes_horario_14'])) { $horario_martes .= '14-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_martes_horario_15_nonce') ){
			update_post_meta($post_id, '_martes_horario_15', $_POST['_martes_horario_15']);
			if (isset($_POST['_martes_horario_15'])) { $horario_martes .= '15-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_martes_horario_16_nonce') ){
			update_post_meta($post_id, '_martes_horario_16', $_POST['_martes_horario_16']);
			if (isset($_POST['_martes_horario_16'])) { $horario_martes .= '16-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_martes_horario_17_nonce') ){
			update_post_meta($post_id, '_martes_horario_17', $_POST['_martes_horario_17']);
			if (isset($_POST['_martes_horario_17'])) { $horario_martes .= '17-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_martes_horario_18_nonce') ){
			update_post_meta($post_id, '_martes_horario_18', $_POST['_martes_horario_18']);
			if (isset($_POST['_martes_horario_18'])) { $horario_martes .= '18-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_martes_horario_19_nonce') ){
			update_post_meta($post_id, '_martes_horario_19', $_POST['_martes_horario_19']);
			if (isset($_POST['_martes_horario_19'])) { $horario_martes .= '19-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_martes_horario_20_nonce') ){
			update_post_meta($post_id, '_martes_horario_20', $_POST['_martes_horario_20']);
			if (isset($_POST['_martes_horario_20'])) { $horario_martes .= '20-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_martes_horario_21_nonce') ){
			update_post_meta($post_id, '_martes_horario_21', $_POST['_martes_horario_21']);
			if (isset($_POST['_martes_horario_21'])) { $horario_martes .= '21-'; }
		}
		/*
		if (isset($_POST['_martes_horario_21'])) { 
			$horario_martes .= '21-'; 
			if ( check_admin_referer( __FILE__, '_martes_horario_21_nonce') ){
				update_post_meta($post_id, '_martes_horario_21', $_POST['_martes_horario_21']);
			}
		}
		*/
		update_post_meta($post_id, 'Martes_horario',$horario_martes);		

	}// save_metaboxes_tienda

	function save_metaboxes_tienda_miercoles_horario( $post_id ){
		$horario_miercoles = '';
		if ( check_admin_referer( __FILE__, '_miercoles_horario_9_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_9', $_POST['_miercoles_horario_9']);
			if (isset($_POST['_miercoles_horario_9'])) { $horario_miercoles .= '9-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_miercoles_horario_10_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_10', $_POST['_miercoles_horario_10']);
			if (isset($_POST['_miercoles_horario_10'])) { $horario_miercoles .= '10-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_miercoles_horario_11_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_11', $_POST['_miercoles_horario_11']);
			if (isset($_POST['_miercoles_horario_11'])) { $horario_miercoles .= '11-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_miercoles_horario_12_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_12', $_POST['_miercoles_horario_12']);
			if (isset($_POST['_miercoles_horario_12'])) { $horario_miercoles .= '12-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_miercoles_horario_13_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_13', $_POST['_miercoles_horario_13']);
			if (isset($_POST['_miercoles_horario_13'])) { $horario_miercoles .= '13-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_miercoles_horario_14_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_14', $_POST['_miercoles_horario_14']);
			if (isset($_POST['_miercoles_horario_14'])) { $horario_miercoles .= '14-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_miercoles_horario_15_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_15', $_POST['_miercoles_horario_15']);
			if (isset($_POST['_miercoles_horario_15'])) { $horario_miercoles .= '15-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_miercoles_horario_16_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_16', $_POST['_miercoles_horario_16']);
			if (isset($_POST['_miercoles_horario_16'])) { $horario_miercoles .= '16-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_miercoles_horario_17_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_17', $_POST['_miercoles_horario_17']);
			if (isset($_POST['_miercoles_horario_17'])) { $horario_miercoles .= '17-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_miercoles_horario_18_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_18', $_POST['_miercoles_horario_18']);
			if (isset($_POST['_miercoles_horario_18'])) { $horario_miercoles .= '18-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_miercoles_horario_19_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_19', $_POST['_miercoles_horario_19']);
			if (isset($_POST['_miercoles_horario_19'])) { $horario_miercoles .= '19-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_miercoles_horario_20_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_20', $_POST['_miercoles_horario_20']);
			if (isset($_POST['_miercoles_horario_20'])) { $horario_miercoles .= '20-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_miercoles_horario_21_nonce') ){
			update_post_meta($post_id, '_miercoles_horario_21', $_POST['_miercoles_horario_21']);
			if (isset($_POST['_miercoles_horario_21'])) { $horario_miercoles .= '21-'; }
		}
		/*
		if (isset($_POST['_miercoles_horario_21'])) { 
			$horario_miercoles .= '21-'; 
			if ( check_admin_referer( __FILE__, '_miercoles_horario_21_nonce') ){
				update_post_meta($post_id, '_miercoles_horario_21', $_POST['_miercoles_horario_21']);
			}
		}
		*/
		update_post_meta($post_id, 'Miercoles_horario',$horario_miercoles);		

	}// save_metaboxes_tienda

	function save_metaboxes_tienda_jueves_horario( $post_id ){
		$horario_jueves = '';
		if ( check_admin_referer( __FILE__, '_jueves_horario_9_nonce') ){
			update_post_meta($post_id, '_jueves_horario_9', $_POST['_jueves_horario_9']);
			if (isset($_POST['_jueves_horario_9'])) { $horario_jueves .= '9-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_jueves_horario_10_nonce') ){
			update_post_meta($post_id, '_jueves_horario_10', $_POST['_jueves_horario_10']);
			if (isset($_POST['_jueves_horario_10'])) { $horario_jueves .= '10-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_jueves_horario_11_nonce') ){
			update_post_meta($post_id, '_jueves_horario_11', $_POST['_jueves_horario_11']);
			if (isset($_POST['_jueves_horario_11'])) { $horario_jueves .= '11-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_jueves_horario_12_nonce') ){
			update_post_meta($post_id, '_jueves_horario_12', $_POST['_jueves_horario_12']);
			if (isset($_POST['_jueves_horario_12'])) { $horario_jueves .= '12-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_jueves_horario_13_nonce') ){
			update_post_meta($post_id, '_jueves_horario_13', $_POST['_jueves_horario_13']);
			if (isset($_POST['_jueves_horario_13'])) { $horario_jueves .= '13-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_jueves_horario_14_nonce') ){
			update_post_meta($post_id, '_jueves_horario_14', $_POST['_jueves_horario_14']);
			if (isset($_POST['_jueves_horario_14'])) { $horario_jueves .= '14-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_jueves_horario_15_nonce') ){
			update_post_meta($post_id, '_jueves_horario_15', $_POST['_jueves_horario_15']);
			if (isset($_POST['_jueves_horario_15'])) { $horario_jueves .= '15-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_jueves_horario_16_nonce') ){
			update_post_meta($post_id, '_jueves_horario_16', $_POST['_jueves_horario_16']);
			if (isset($_POST['_jueves_horario_16'])) { $horario_jueves .= '16-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_jueves_horario_17_nonce') ){
			update_post_meta($post_id, '_jueves_horario_17', $_POST['_jueves_horario_17']);
			if (isset($_POST['_jueves_horario_17'])) { $horario_jueves .= '17-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_jueves_horario_18_nonce') ){
			update_post_meta($post_id, '_jueves_horario_18', $_POST['_jueves_horario_18']);
			if (isset($_POST['_jueves_horario_18'])) { $horario_jueves .= '18-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_jueves_horario_19_nonce') ){
			update_post_meta($post_id, '_jueves_horario_19', $_POST['_jueves_horario_19']);
			if (isset($_POST['_jueves_horario_19'])) { $horario_jueves .= '19-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_jueves_horario_20_nonce') ){
			update_post_meta($post_id, '_jueves_horario_20', $_POST['_jueves_horario_20']);
			if (isset($_POST['_jueves_horario_20'])) { $horario_jueves .= '20-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_jueves_horario_21_nonce') ){
			update_post_meta($post_id, '_jueves_horario_21', $_POST['_jueves_horario_21']);
			if (isset($_POST['_jueves_horario_21'])) { $horario_jueves .= '21-'; }
		}
		/*
		if (isset($_POST['_jueves_horario_21'])) { 
			$horario_jueves .= '21-'; 
			if ( check_admin_referer( __FILE__, '_jueves_horario_21_nonce') ){
				update_post_meta($post_id, '_jueves_horario_21', $_POST['_jueves_horario_21']);
			}
		}
		*/
		update_post_meta($post_id, 'Jueves_horario',$horario_jueves);		

	}// save_metaboxes_tienda

	function save_metaboxes_tienda_viernes_horario( $post_id ){
		$horario_viernes = '';
		if ( check_admin_referer( __FILE__, '_viernes_horario_9_nonce') ){
			update_post_meta($post_id, '_viernes_horario_9', $_POST['_viernes_horario_9']);
			if (isset($_POST['_viernes_horario_9'])) { $horario_viernes .= '9-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_viernes_horario_10_nonce') ){
			update_post_meta($post_id, '_viernes_horario_10', $_POST['_viernes_horario_10']);
			if (isset($_POST['_viernes_horario_10'])) { $horario_viernes .= '10-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_viernes_horario_11_nonce') ){
			update_post_meta($post_id, '_viernes_horario_11', $_POST['_viernes_horario_11']);
			if (isset($_POST['_viernes_horario_11'])) { $horario_viernes .= '11-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_viernes_horario_12_nonce') ){
			update_post_meta($post_id, '_viernes_horario_12', $_POST['_viernes_horario_12']);
			if (isset($_POST['_viernes_horario_12'])) { $horario_viernes .= '12-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_viernes_horario_13_nonce') ){
			update_post_meta($post_id, '_viernes_horario_13', $_POST['_viernes_horario_13']);
			if (isset($_POST['_viernes_horario_13'])) { $horario_viernes .= '13-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_viernes_horario_14_nonce') ){
			update_post_meta($post_id, '_viernes_horario_14', $_POST['_viernes_horario_14']);
			if (isset($_POST['_viernes_horario_14'])) { $horario_viernes .= '14-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_viernes_horario_15_nonce') ){
			update_post_meta($post_id, '_viernes_horario_15', $_POST['_viernes_horario_15']);
			if (isset($_POST['_viernes_horario_15'])) { $horario_viernes .= '15-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_viernes_horario_16_nonce') ){
			update_post_meta($post_id, '_viernes_horario_16', $_POST['_viernes_horario_16']);
			if (isset($_POST['_viernes_horario_16'])) { $horario_viernes .= '16-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_viernes_horario_17_nonce') ){
			update_post_meta($post_id, '_viernes_horario_17', $_POST['_viernes_horario_17']);
			if (isset($_POST['_viernes_horario_17'])) { $horario_viernes .= '17-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_viernes_horario_18_nonce') ){
			update_post_meta($post_id, '_viernes_horario_18', $_POST['_viernes_horario_18']);
			if (isset($_POST['_viernes_horario_18'])) { $horario_viernes .= '18-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_viernes_horario_19_nonce') ){
			update_post_meta($post_id, '_viernes_horario_19', $_POST['_viernes_horario_19']);
			if (isset($_POST['_viernes_horario_19'])) { $horario_viernes .= '19-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_viernes_horario_20_nonce') ){
			update_post_meta($post_id, '_viernes_horario_20', $_POST['_viernes_horario_20']);
			if (isset($_POST['_viernes_horario_20'])) { $horario_viernes .= '20-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_viernes_horario_21_nonce') ){
			update_post_meta($post_id, '_viernes_horario_21', $_POST['_viernes_horario_21']);
			if (isset($_POST['_viernes_horario_21'])) { $horario_viernes .= '21-'; }
		}
		/*
		if (isset($_POST['_viernes_horario_21'])) { 
			$horario_viernes .= '21-'; 
			if ( check_admin_referer( __FILE__, '_viernes_horario_21_nonce') ){
				update_post_meta($post_id, '_viernes_horario_21', $_POST['_viernes_horario_21']);
			}
		}
		*/
		update_post_meta($post_id, 'Viernes_horario',$horario_viernes);		

	}// save_metaboxes_tienda

	function save_metaboxes_tienda_sabado_horario( $post_id ){
		$horario_sabado = '';
		if ( check_admin_referer( __FILE__, '_sabado_horario_9_nonce') ){
			update_post_meta($post_id, '_sabado_horario_9', $_POST['_sabado_horario_9']);
			if (isset($_POST['_sabado_horario_9'])) { $horario_sabado .= '9-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_sabado_horario_10_nonce') ){
			update_post_meta($post_id, '_sabado_horario_10', $_POST['_sabado_horario_10']);
			if (isset($_POST['_sabado_horario_10'])) { $horario_sabado .= '10-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_sabado_horario_11_nonce') ){
			update_post_meta($post_id, '_sabado_horario_11', $_POST['_sabado_horario_11']);
			if (isset($_POST['_sabado_horario_11'])) { $horario_sabado .= '11-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_sabado_horario_12_nonce') ){
			update_post_meta($post_id, '_sabado_horario_12', $_POST['_sabado_horario_12']);
			if (isset($_POST['_sabado_horario_12'])) { $horario_sabado .= '12-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_sabado_horario_13_nonce') ){
			update_post_meta($post_id, '_sabado_horario_13', $_POST['_sabado_horario_13']);
			if (isset($_POST['_sabado_horario_13'])) { $horario_sabado .= '13-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_sabado_horario_14_nonce') ){
			update_post_meta($post_id, '_sabado_horario_14', $_POST['_sabado_horario_14']);
			if (isset($_POST['_sabado_horario_14'])) { $horario_sabado .= '14-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_sabado_horario_15_nonce') ){
			update_post_meta($post_id, '_sabado_horario_15', $_POST['_sabado_horario_15']);
			if (isset($_POST['_sabado_horario_15'])) { $horario_sabado .= '15-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_sabado_horario_16_nonce') ){
			update_post_meta($post_id, '_sabado_horario_16', $_POST['_sabado_horario_16']);
			if (isset($_POST['_sabado_horario_16'])) { $horario_sabado .= '16-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_sabado_horario_17_nonce') ){
			update_post_meta($post_id, '_sabado_horario_17', $_POST['_sabado_horario_17']);
			if (isset($_POST['_sabado_horario_17'])) { $horario_sabado .= '17-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_sabado_horario_18_nonce') ){
			update_post_meta($post_id, '_sabado_horario_18', $_POST['_sabado_horario_18']);
			if (isset($_POST['_sabado_horario_18'])) { $horario_sabado .= '18-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_sabado_horario_19_nonce') ){
			update_post_meta($post_id, '_sabado_horario_19', $_POST['_sabado_horario_19']);
			if (isset($_POST['_sabado_horario_19'])) { $horario_sabado .= '19-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_sabado_horario_20_nonce') ){
			update_post_meta($post_id, '_sabado_horario_20', $_POST['_sabado_horario_20']);
			if (isset($_POST['_sabado_horario_20'])) { $horario_sabado .= '20-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_sabado_horario_21_nonce') ){
			update_post_meta($post_id, '_sabado_horario_21', $_POST['_sabado_horario_21']);
			if (isset($_POST['_sabado_horario_21'])) { $horario_sabado .= '21-'; }
		}
		/*
		if (isset($_POST['_sabado_horario_21'])) { 
			$horario_sabado .= '21-'; 
			if ( check_admin_referer( __FILE__, '_sabado_horario_21_nonce') ){
				update_post_meta($post_id, '_sabado_horario_21', $_POST['_sabado_horario_21']);
			}
		}
		*/
		update_post_meta($post_id, 'Sabado_horario',$horario_sabado);		

	}// save_metaboxes_tienda

	function save_metaboxes_tienda_domingo_horario( $post_id ){
		$horario_domingo = '';
		if ( check_admin_referer( __FILE__, '_domingo_horario_9_nonce') ){
			update_post_meta($post_id, '_domingo_horario_9', $_POST['_domingo_horario_9']);
			if (isset($_POST['_domingo_horario_9'])) { $horario_domingo .= '9-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_domingo_horario_10_nonce') ){
			update_post_meta($post_id, '_domingo_horario_10', $_POST['_domingo_horario_10']);
			if (isset($_POST['_domingo_horario_10'])) { $horario_domingo .= '10-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_domingo_horario_11_nonce') ){
			update_post_meta($post_id, '_domingo_horario_11', $_POST['_domingo_horario_11']);
			if (isset($_POST['_domingo_horario_11'])) { $horario_domingo .= '11-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_domingo_horario_12_nonce') ){
			update_post_meta($post_id, '_domingo_horario_12', $_POST['_domingo_horario_12']);
			if (isset($_POST['_domingo_horario_12'])) { $horario_domingo .= '12-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_domingo_horario_13_nonce') ){
			update_post_meta($post_id, '_domingo_horario_13', $_POST['_domingo_horario_13']);
			if (isset($_POST['_domingo_horario_13'])) { $horario_domingo .= '13-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_domingo_horario_14_nonce') ){
			update_post_meta($post_id, '_domingo_horario_14', $_POST['_domingo_horario_14']);
			if (isset($_POST['_domingo_horario_14'])) { $horario_domingo .= '14-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_domingo_horario_15_nonce') ){
			update_post_meta($post_id, '_domingo_horario_15', $_POST['_domingo_horario_15']);
			if (isset($_POST['_domingo_horario_15'])) { $horario_domingo .= '15-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_domingo_horario_16_nonce') ){
			update_post_meta($post_id, '_domingo_horario_16', $_POST['_domingo_horario_16']);
			if (isset($_POST['_domingo_horario_16'])) { $horario_domingo .= '16-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_domingo_horario_17_nonce') ){
			update_post_meta($post_id, '_domingo_horario_17', $_POST['_domingo_horario_17']);
			if (isset($_POST['_domingo_horario_17'])) { $horario_domingo .= '17-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_domingo_horario_18_nonce') ){
			update_post_meta($post_id, '_domingo_horario_18', $_POST['_domingo_horario_18']);
			if (isset($_POST['_domingo_horario_18'])) { $horario_domingo .= '18-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_domingo_horario_19_nonce') ){
			update_post_meta($post_id, '_domingo_horario_19', $_POST['_domingo_horario_19']);
			if (isset($_POST['_domingo_horario_19'])) { $horario_domingo .= '19-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_domingo_horario_20_nonce') ){
			update_post_meta($post_id, '_domingo_horario_20', $_POST['_domingo_horario_20']);
			if (isset($_POST['_domingo_horario_20'])) { $horario_domingo .= '20-'; }
		}
		
		if ( check_admin_referer( __FILE__, '_domingo_horario_21_nonce') ){
			update_post_meta($post_id, '_domingo_horario_21', $_POST['_domingo_horario_21']);
			if (isset($_POST['_domingo_horario_21'])) { $horario_domingo .= '21-'; }
		}
		/*
		if (isset($_POST['_domingo_horario_21'])) { 
			$horario_domingo .= '21-'; 
			if ( check_admin_referer( __FILE__, '_domingo_horario_21_nonce') ){
				update_post_meta($post_id, '_domingo_horario_21', $_POST['_domingo_horario_21']);
			}
		}
		*/
		update_post_meta($post_id, 'Domingo_horario',$horario_domingo);		

	}// save_metaboxes_tienda
	