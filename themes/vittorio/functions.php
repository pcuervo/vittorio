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
	$fecha = $_POST['fecha'];
	$horario = $_POST['horario'];

	//the array of arguements to be inserted with wp_insert_post
	$new_post = array(
	'post_title'    => $title,
	'post_status'   => 'publish',          
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
	add_post_meta($pid, '_status_meta', 'PENDIENTE', true);

	echo '<input type="hidden" id="citaid" value="'.$pid.'" />';

	$subject = 'Vittorio - Confirma tu Cita';
	$body = 'Hemos registrado tu cita, para confirmarla haz click en el siguiente link: <br>'.$emailurl;
	$headers = array('Content-Type: text/html; charset=UTF-8');
	//$headers = 'From: My Name <' . $correo . '>' . "\r\n";
	$message = '<html><body>';
	$message .= '<h3>Contacto a través de www.sunland.mx</h3>';
	$message .= '<p>Nombre: '.$nombre.'</p>';
	$message .= '<p>Email: '. $correo . '</p>';
	$message .= '<p>Tienda: '. $tienda . '</p>';
	$message .= '<p>Fecha: '. $fecha . '</p>';
	$message .= '<p>Horario: '. $horario . '</p>';
	$message .= '<p>Hemos registrado tu cita, para confirmarla haz click en el siguiente link: <br>'.$emailurl.'</p>';
	$message .= '</body></html>';

	add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));

	//SEND EMAIL CONFIRMATION 
	$resp = wp_mail( $correo, $subject, $message, $headers );
	//var_dump($resp);
}

if ( isset($_GET['citaid']) && !empty($_GET['citaid']) ) {
	update_post_meta($_GET['citaid'], '_status_meta', 'CONFIRMADA');
	echo '<input type="hidden" id="confirmada" value="'.$_GET['citaid'].'" />';
}



/*------------------------------------*\
	#INCLUDES
\*------------------------------------*/

require_once('inc/post-types.php');
require_once('inc/metaboxes.php');
require_once('inc/pages.php');