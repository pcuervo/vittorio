<?php
	get_header();
	$ciudades = array(
		'Ciudad de México' => array(
			'lat' => '19.3209311',
			'long' => '99.432815',
			'tiendas' => array(
				'Pabellón Polanco' => array(
					'lat' => '21.3209311',
					'long' => '98.432815',
					'info' => 'lorem ipsum 123, Col. Dolor, C.P. 123456, Tel: 555-555-555'
				),
				'Pabellón Estrellas' => array(
					'lat' => '20.3209311',
					'long' => '95.432815',
					'info' => 'lorem ipsum 456, Col. Ipsum, C.P. 123456, Tel: 555-555-555'
				),
			)
		),
		'Monterrey' => array(
			'lat' => '59.3209311',
			'long' => '49.432815',
			'tiendas' => array(
				'Pabellón Monterrey' => array(
					'lat' => '21.3209311',
					'long' => '98.432815',
					'info' => 'lorem ipsum 123, Col. Dolor, C.P. 123456, Tel: 555-555-555'
				),
				'Pabellón Monterrey 2' => array(
					'lat' => '20.3209311',
					'long' => '95.432815',
					'info' => 'lorem ipsum 456, Col. Ipsum, C.P. 123456, Tel: 555-555-555'
				),
			)
		)
	);

	// foreach ($ciudades as $key => $value) {
	// 	echo $key;
	// 	echo '<pre>';
	// 		print_r($value);
	// 	echo '</pre>';
	// }


?>
	<div style="display:none;" id="gmap_geo" class="gmaps"></div>

	<div  class="[ background-img background-img--main ]">
		<div class="[ container ]">
			<div class="[ row ]">
				<div class="[ col l6 ][ hide-on-med-and-up ]">
					<img class="[ img-responsive ][ middle ]" src="<?php echo THEMEPATH; ?>img/el_poder.png" alt="El poder de un traje">
				</div>
				<div class="[ col s12 m7 l5 ]">

					<div class="[ bg-dark ][ padding ][ margin-vertical--large margin-vertical--large-md ]">
						<p class="[ text-uppercase white-text ]">¡hombre, muy bien! </p>
						<p class="[ white-text ]">Compártenos los siguientes datos para hacer una cita con uno de nuestros Expertos en Trajes y te ayude a encontrar tu traje perfecto.</p>

						<form class="[ margin-top ]" method="post">
							<div class="[ input-field ]">
								<input id="nombre" type="text" class="[ validate ]" data-parsley-error-message="Este campo es obligatorio" required>
								<label for="nombre">Nombre y apellido</label>
							</div>
							<div class="[ input-field ]">
								<input id="correo" type="email" class="[ validate ]" data-parsley-error-message="Este campo es obligatorio" required>
								<label for="correo">Correo</label>
							</div>
							<div class="[ input-field ]">
								<input id="telefono" type="text" class="[ validate ]" data-parsley-type="digits" data-parsley-error-message="Este campo sólo acepta números" required>
								<label for="telefono">Teléfono</label>
							</div>
							<div class="[ input-field ][ bg-white ]">
								<select id="ciudad" name="ciudad" data-parsley-error-message="Seleccione una ciudad" required>
									<option class="" value="" disabled selected>Ciudad</option>
									<?php
										foreach ($ciudades as $key => $value) {
											echo '<option class="optCiudad" data-lat="19.3209311" data-long="-99.432815" value="1">Ciudad de Mexico</option>'
										}
									?>

									<option class="optCiudad" data-lat="19.3209311" data-long="-99.432815" value="1">Ciudad de Mexico</option>
									<option class="optCiudad" data-lat="20.6489394" data-long="-98.4368711" value="2">Monterrey</option>
									<option class="optCiudad" data-lat="19.2942611" data-long="-99.7012545" value="3">Toluca</option>
								</select>
							</div>
							<div class="[ input-field ][ bg-white ]">
								<select id="tienda" name="tienda" data-parsley-error-message="Seleccione una tienda" required>
									<option class="" value="" disabled selected>Tienda</option>
									<option class="optTienda" value="1">Option 1</option>
									<option class="optTienda" value="2">Option 2</option>
									<option class="optTienda" value="3">Option 3</option>
								</select>
							</div>
							<div class="[ input-field ]">
								<input id="fecha" type="date" class="datepicker">
								<label for="fecha">Fecha</label>
							</div>
							<div class="[ input-field ][ bg-white ]">
								<select name="horario" data-parsley-error-message="Por favor selecciona un horario" required>
									<option value="" selected>Horario</option>
									<option value="1">Option 1</option>
									<option value="2">Option 2</option>
									<option value="3">Option 3</option>
								</select>
							</div>
							<p>
								<input type="checkbox" id="aviso" data-parsley-error-message="Debe estar de acuerdo con el aviso de privacidad" required/>
								<label class="[ white-text ]" for="aviso">He leído y estoy de acuerdo con el <a class="[ white-text underlined ]" href="<?php echo site_url('aviso-de-privacidad'); ?>">Aviso de privacidad</a></label>
							</p>
							<div class="[ block text-center margin-bottom ]">
								<button type="submit" class="[ waves-effect waves-light ][ btn-large ][ red ]">Hacer mi cita</button>
							</div>
						</form>
					</div>


				</div>

				<!-- Modal Structure/Listo! -->

					<div id="modal1" class="[ modal background-img ][ ]">
						<div class="[ modal-content ]">
							<h4>¡LISTO!</h4>
							<p>NUESTRO EXPERTO EN TRAJES TE ESTARÁ ESPERANDO PARA ATENDERTE PERSONALMENTE</p>
							<p>SÓLO CONFIRMA TU CORREO PARA QUE TU CITA QUEDE PROGRAMADA</p>
							<a href="#!" class="[ red white-text modal-action modal-close waves-effect waves-green btn-flat ]">CERRAR</a>
						</div>
					</div>

				<!-- Modal Structure/Gracias! -->

					<div id="modal2" class="[ modal background-img ]">
						<div class="[ modal-content ]">
							<h4>GRACIAS</h4>
							<p>TU CITA ESTÁ CONFIRMADA</p>
							<p>TE ESPERAMOS</p>
							<a href="#!" class="[ red white-text modal-action modal-close waves-effect waves-green btn-flat ]">CERRAR</a>
						</div>
					</div>

				<div class="[ col s6 m5 offset-l1 l6 ][ hide-on-small-only ]">
					<div class="[ relative ][ height-herovh ]">
						<img class="[ img-responsive ][ center-full ]" src="<?php echo THEMEPATH; ?>img/el_poder.png" alt="El poder de un traje">
					</div>
				</div>

			</div>
		</div>
	</div>

<?php get_footer(); ?>