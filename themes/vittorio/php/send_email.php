<?php 

	$name = $_POST['nombre'];
	$email = $_POST['correo'];
	$destinatario = $_POST['destinatario'];
	$contact_message = isset( $_POST['mensaje'] ) ? $_POST['mensaje'] : '-';

	// Contacto Real Michoacana
	$to = "<$destinatario>\r\n";
	$subject = 'Contacto página web Real Michoacana';
	$headers = "From: $name <$email>\r\n";
	$headers .= "Reply-To: <$destinatario>\r\n";
	$headers .= "Return-Path: <$destinatario>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$message = '<html><body>';
	$message .= '<p>'.$name.' te ha contactado</p>';
	$message .= '<p>Email: '. $email . '</p>';
	if( $contact_message != '' ) $message .= '<p>Mensaje: '. $contact_message . '</p>';
	$message .= '</body></html>';

	mail($to, $subject, $message, $headers );

	$message = array(
		'error'		=> 0,
		'name'	=> $name,
		);
	echo json_encode($message , JSON_FORCE_OBJECT);
