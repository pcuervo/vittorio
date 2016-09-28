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

add_action( 'admin_enqueue_scripts', 'load_maps_js');
function load_maps_js(){

	if(get_post_type() == 'ciudades' || get_post_type() == 'tiendas')
	{
		// scripts
		wp_enqueue_script( 'api-google', 'https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyABZ4eSBYBsLi5WQ7WdXZpivNq6n4wQZPA&language=es-ES', array('jquery'), '1.0', true );
		wp_enqueue_script( 'google-function-autocomplete', THEMEPATH. 'js/google-autocomplete.js', array('api-google'), '1.0', true );
		wp_enqueue_script( 'manage-checks', THEMEPATH. 'js/manage-checks.js', array('jquery'), '1.0', true );
	}

}

/*------------------------------------*\
	#GENERAL FUNCTIONS
\*------------------------------------*/
/**
* Enqueue frontend scripts and styles
**/
add_action( 'wp_enqueue_scripts', function(){

	// scripts
	wp_enqueue_script( 'materialize_js', JSPATH.'bin/materialize.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'plugins', JSPATH.'plugins.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'functions', JSPATH.'functions.js', array('jquery'), '1s.0', true );

	//SCRIPT TO GEOLOCATE
	wp_enqueue_script( 'geo-map-api', 'https://maps.googleapis.com/maps/api/js?&key=AIzaSyABZ4eSBYBsLi5WQ7WdXZpivNq6n4wQZPA');
	wp_enqueue_script( 'geo-map-gmaps', JSPATH . 'gmaps/gmaps.js', array('geo-map-api' ));
	wp_enqueue_script( 'geo-location', JSPATH . 'geolocation.js', array('geo-map-api', 'geo-map-gmaps'));

	// localize scripts
	// wp_localize_script( 'functions', 'siteUrl', SITEURL );
	// wp_localize_script( 'functions', 'theme_path', THEMEPATH );

	// styles
	wp_enqueue_style( 'styles', get_stylesheet_uri() );
});

/*------------------------------------*\
	#INSERT POST FROM FRONTEND
\*------------------------------------*/

if ( 'POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['nombre']) && !empty($_POST['nombre']) ) {

	//store our post vars into variables for later use
	$title     = 'Cita: '.$_POST['nombre'];
	$post_type = 'citas';
	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$telefono = $_POST['telefono'];
	$ciudad = $_POST['ciudad'];
	$tienda = $_POST['tienda'];
	$tiendanombre = get_the_title( $_POST['tienda'] );
	$fecha = $_POST['fecha'];
	$horario = $_POST['horario'];
	$porque = $_POST['porque'];
	$quebuscas = $_POST['quebuscas'];

	//the array of arguements to be inserted with wp_insert_post
	$new_post = array(
	'post_title'    => $title,
	'post_status'   => 'draft',
	'post_type'     => $post_type

	);

	//insert the the post into database by passing $new_post to wp_insert_post
	//store our post ID in a variable $pid
	$pid = wp_insert_post($new_post);

	//URL TO EMAL
	$emailurl = SITEURL.'?citaid='.$pid;


	//we now use $pid (post id) to help add out post meta data
	add_post_meta($pid, '_nombre_meta', $nombre, true);
	add_post_meta($pid, '_email_meta', $correo, true);
	add_post_meta($pid, '_telefono_meta', $telefono, true);
	add_post_meta($pid, '_ciudad_meta', $ciudad, true);
	add_post_meta($pid, '_tienda_meta', $tienda, true);
	add_post_meta($pid, '_fecha_meta', $fecha, true);
	add_post_meta($pid, '_horario_meta', $horario, true);
	add_post_meta($pid, '_porque_meta', $porque, true);
	add_post_meta($pid, '_quebuscas_meta', $quebuscas, true);
	//add_post_meta($pid, '_status_meta', 'PENDIENTE', true);

	echo '<input type="hidden" id="citaid" value="'.$pid.'" />';

	$subject = 'Vittorio - Confirma tu Cita';
	$body = 'Hemos registrado tu cita, para confirmarla haz click en el siguiente link: <br />'.$emailurl;
	$headers = array('Content-Type: text/html; charset=UTF-8');
	$headers = 'From: Vittorio Forti <no-reply@vittorio.com.mx>' . "\r\n";
	$message = '<html><body>';

	$message .= '
			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
				<tbody>
					<tr>
						<td align="center" valign="top">
							<div>
								<p style="margin-top:2em"></p>
							</div>
							<table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#000000;border:1px solid #dcdcdc;border-radius:3px!important">
								<tbody>
									<tr>
										<td align="center" valign="top">
											<table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#252525;border-radius:3px 3px 0 0!important;color:#ffffff;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif">
												<tbody>
													<tr>
														<td style="padding:36px 48px;display:block; text-align:center; ">
															<img src="http://pcuervo.com/vittorio/wp-content/themes/vittorio/img/logo.png" alt="Logo Vitorio Forti" style="border:none;display:inline;font-size:14px;font-weight:bold;min-height:auto;line-height:100%;outline:none;text-decoration:none;text-transform:capitalize" class="CToWUd">
															<h1 style="color:#ffffff;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:center">Hemos registrado tu cita</h1>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
										<td align="center" valign="top">
											<table border="0" cellpadding="0" cellspacing="0" width="600">
												<tbody>
													<tr>
														<td valign="top" style="background-color:#fdfdfd">
															<table border="0" cellpadding="20" cellspacing="0" width="100%">
																<tbody>
																	<tr>
																		<td valign="top" style="padding:48px">
																			<div style="color:#737373;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">
																				<p class="">Nombre: '.$nombre.'</p>
																				<p>Email: '. $correo . '</p>
																				<p>Tienda: '. $tiendanombre . '</p>
																				<p>Fecha: '. $fecha . '</p>
																				<p>Horario: '. $horario . '</p>
																				<p style="margin:0 0 16px">Para confirmarla haz click en el siguiente link:</p>
																				<p style="margin:0 0 16px">'.$emailurl.'</p>
																			</div>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
										<td align="center" valign="top">
											<table border="0" cellpadding="10" cellspacing="0" width="600">
												<tbody>
													<tr>
														<td valign="top" style="padding:0">
															<table border="0" cellpadding="10" cellspacing="0" width="100%">
																<tbody>
																	<tr>
																		<td colspan="2" valign="middle" style="padding:2em;border:0;color:#fff;font-family:Arial;font-size:12px;line-height:125%;text-align:center">
																			<img class="CToWUd" width="50%" style="border:none;display:inline;font-size:14px;font-weight:bold;min-height:auto;line-height:100%;outline:none;text-decoration:none;text-transform:capitalize" alt="Logo Vitorio Forti" src="http://pcuervo.com/vittorio/wp-content/themes/vittorio/img/el_poder.png">
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>';

	$message .= '</body></html>';

	add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));

	//SEND EMAIL CONFIRMATION
	$resp = wp_mail( $correo, $subject, $message, $headers );
	//var_dump($resp);
}

if ( isset($_GET['citaid']) && !empty($_GET['citaid']) ) {
	//update_post_meta($_GET['citaid'], '_status_meta', 'CONFIRMADA');
	// Update post 37
	  $my_post = array(
	      'ID'           => $_GET['citaid'],
	      'post_status'   => 'publish'
	  );

	// Update the post into the database
	  wp_update_post( $my_post );
	echo '<input type="hidden" id="confirmada" value="'.$_GET['citaid'].'" />';
}



/*------------------------------------*\
	#INCLUDES
\*------------------------------------*/

require_once('inc/post-types.php');
require_once('inc/metaboxes.php');
require_once('inc/pages.php');

// Add a custom user role
remove_role( 'citas_admin' );

$result = add_role( 'citas_admin', __('Admin de Citas' ),
	array(
		'publish_citas' => true,
		'edit_citas' => true,
		'edit_others_citas' => true,
		'delete_citas' => true,
		'delete_others_citas' => true,
		'read_private_citas' => true,
		'edit_cita' => false,
		'delete_cita' => true,
		'read_cita' => true,
		"read" => true,
		"upload_files" => false
	)
);

function add_theme_caps() {
	
    // gets the administrator role
    $admins = get_role( 'administrator' );

    $admins->add_cap( 'publish_citas' ); 
    $admins->add_cap( 'edit_citas' ); 
    $admins->add_cap( 'edit_others_citas' ); 
    $admins->add_cap( 'delete_citas' ); 
    $admins->add_cap( 'delete_others_citas' ); 
    $admins->add_cap( 'read_private_citas' ); 
    //$admins->add_cap( 'edit_cita' ); 
    $admins->add_cap( 'delete_cita' ); 
    $admins->add_cap( 'read_cita' ); 

    //REMOVE CAPABLITIES
  	//$admins->remove_cap(  'edit_citas' ); 
  	//$admins->remove_cap(  'edit_others_citas' ); 
  	$admins->remove_cap(  'edit_cita' ); 
}
add_action( 'admin_init', 'add_theme_caps');


//add_action('show_user_profile', 'show_my_extra_fields' );
add_action( 'edit_user_profile', 'show_my_extra_fields' );
		
function show_my_extra_fields($user) {

	echo '<h3>Tienda</h3>';
	//Select area-entrega post type
    $query_args = array(
		'post_type'      => 'tiendas',
		'orderby'        => 'date',
		'no_found_rows'  => true,
		'cache_results'  => false,
	);

    $posts = new WP_Query( $query_args );
    $area = get_the_author_meta('tiendas', $user->ID);
    echo '<select id="tiendas" name="tiendas" class="input-text" >';
 		echo '<option></option>';
	if ( $posts->have_posts() ) {
		while ( $posts->have_posts() ) {
			$posts->the_post();
			$sel = '';
			if($area == $posts->post->ID) { $sel = 'selected'; }
			echo '<option value="'.$posts->post->ID.'" id="ae_'.$posts->post->ID.'" '.$sel.'>'.get_the_title().'</option>';
		}
	}

	echo '</select>';

	
}

//add_action('personal_options_update', 'update_extra_fields');
add_action( 'edit_user_profile_update', 'update_extra_fields');
function update_extra_fields($user_id) {
	update_user_meta($user_id, 'tiendas', $_POST['tiendas']);
	
}