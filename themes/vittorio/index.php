<?php
	get_header();
?>
	<div style="display:none;" id="gmap_geo" class="gmaps"></div>

	<div  class="[ background-img background-img--main ]">
		<div class="[ container ]">
			<div class="[ row ]">
				<div class="[ col l7 ][ hide-on-med-and-up ]">
					<img class="[ img-responsive ][ middle ]" src="<?php echo THEMEPATH; ?>img/el_poder.svg" alt="El poder de un traje">
				</div>

				<div class="[ col s12 m5 ][ no-float ][ inline-block ][ middle ]">
					<div class="[ bg-dark ][ padding ][ margin-vertical ]">
						<p class="[ text-uppercase white-text ][ no-margin-top ]">¡hombre, muy bien! </p>
						<p class="[ white-text ]">Tu próximo traje y el éxito que viene incluido, a unos datos de distancia.Un Experto en trajes te estará esperando para ayudarte a encontrar el traje perfecto para ti.</p>

						<form class="[ margin-top ]" method="post" name="front_end" action="citas">
							<div class="[ input-field ]">
								<input id="nombre" name="nombre" type="text" class="[ validate ]" data-parsley-error-message="Este campo es obligatorio" required>
								<label for="nombre">Nombre y apellido</label>
							</div>
							<div class="[ input-field ]">
								<input id="correo" name="correo" type="email" class="[ validate ]" data-parsley-error-message="Este campo es obligatorio" required>
								<label for="correo">Correo</label>
							</div>
							<div class="[ input-field ]">
								<input id="telefono" name="telefono" type="text" class="[ validate ]" data-parsley-type="digits" data-parsley-error-message="Este campo sólo acepta números" required>
								<label for="telefono">Teléfono</label>
							</div>
							<div class="[ input-field ][ bg-white ]">
								<?php
									$query_args = array(
										'post_type'      => 'ciudades',
										'order' 		 => 'ASC',
										'orderby'        => 'title',
										'no_found_rows'  => true,
										'cache_results'  => false,
										'posts_per_page' => -1
									);

								    $posts = new WP_Query( $query_args );

								    echo '<select id="ciudad" name="ciudad" data-parsley-error-message="Seleccione una ciudad" required>';
								 	echo '<option class="" value="" disabled selected>Selecciona una Ciudad</option>';
									if ( $posts->have_posts() ) {
										while ( $posts->have_posts() ) {
											$posts->the_post();
											$meta = get_post_meta($posts->post->ID);
											$lat = $meta['_latitud_meta'][0];
											$long = $meta['_longitud_meta'][0];

											echo '<option value="'.get_the_title().'" class="optciudad" id="ciudad_'.$posts->post->ID.'" data-lat="'.$meta['_latitud_meta'][0].'" data-long="'.$meta['_longitud_meta'][0].'" >'.get_the_title().'</option>';
										}
									}
									echo '</select>';
								?>
							</div>
							<div class="[ input-field ][ bg-white ]">
								<?php
									$query_args = array(
										'post_type'      => 'tiendas',
										'orderby'        => 'title',
										'order' 		=> 'ASC',
										'no_found_rows'  => true,
										'cache_results'  => false,
										'posts_per_page' => -1
									);

								    $posts = new WP_Query( $query_args );

								    echo '<select id="tienda" name="tienda" data-parsley-error-message="Seleccione una tienda" required>';
								 	echo '<option class="" value="" disabled selected>Selecciona una Tienda</option>';
									if ( $posts->have_posts() ) {
										while ( $posts->have_posts() ) {
											$posts->the_post();
											$meta = get_post_meta($posts->post->ID);
											$claseciudad = str_replace(' ', '', $meta['_ciudad_meta'][0]);
											echo '<option value="'.$posts->post->ID.'" class="opttienda '.$claseciudad.'" id="tienda_'.$posts->post->ID.'" data-claseciudad="'.$claseciudad.'" data-lat="'.$meta['_latitud_meta'][0].'" data-long="'.$meta['_longitud_meta'][0].'" data-direccion="'.$meta['_ubicacion_meta'][0].'" data-telefono="'.$meta['_telefono_meta'][0].'">'.get_the_title().'</option>';
										}
									}
									echo '</select>';
								?>
							</div>
							<div class="[ input-field ]">
								<input id="fecha" name="fecha" type="date" class="datepicker">
								<label for="fecha">Fecha</label>
							</div>
							<div class="[ input-field ][ bg-white ]">
								<select id="horario" name="horario" data-parsley-error-message="Por favor selecciona un horario" required>
									<option value="" selected>Horario</option>
									<option data-clasehorario="9am" id="9am" class="opthorario" value="9am">De 9:00am - 9:30am</option>
									<option data-clasehorario="930am" id="930am" class="opthorario" value="930am">De 9:30am - 10:00am</option>
									<option data-clasehorario="10am" id="10am" class="opthorario" value="10am">De 10:00am - 10:30am</option>
									<option data-clasehorario="1030am" id="1030am" class="opthorario" value="1030am">De 10:30am - 11:00am</option>
									<option data-clasehorario="11am" id="11am" class="opthorario" value="11am">De 11:00am - 11:30am</option>
									<option data-clasehorario="1130am" id="1130am" class="opthorario" value="1130am">De 11:30am - 12:00pm</option>
									<option data-clasehorario="12pm" id="12pm" class="opthorario" value="12pm">De 12:00pm - 12:30pm</option>
									<option data-clasehorario="1230pm" id="1230pm" class="opthorario" value="1230pm">De 12:30pm - 1:00pm</option>
									<option data-clasehorario="1pm" id="1pm" class="opthorario" value="1pm">De 1:00pm - 1:30pm</option>
									<option data-clasehorario="130pm" id="130pm" class="opthorario" value="130pm">De 1:30pm - 2:00pm</option>
									<option data-clasehorario="2pm" id="2pm" class="opthorario" value="2pm">De 2:00pm - 2:30pm</option>
									<option data-clasehorario="230pm" id="230pm" class="opthorario" value="230pm">De 2:30pm - 3:00pm</option>
									<option data-clasehorario="3pm" id="3pm" class="opthorario" value="3pm">De 3:00pm - 3:30pm</option>
									<option data-clasehorario="330pm" id="330pm" class="opthorario" value="330pm">De 3:30pm - 4:00pm</option>
									<option data-clasehorario="4pm" id="4pm" class="opthorario" value="4pm">De 4:00pm - 4:30pm</option>
									<option data-clasehorario="430pm" id="430pm" class="opthorario" value="430pm">De 4:30pm - 5:00pm</option>
									<option data-clasehorario="5pm" id="5pm" class="opthorario" value="5pm">De 5:00pm - 5:30pm</option>
									<option data-clasehorario="530pm" id="530pm" class="opthorario" value="530pm">De 5:30pm - 5:00pm</option>
									<option data-clasehorario="6pm" id="6pm" class="opthorario" value="6pm">De 6:00pm - 6:30pm</option>
									<option data-clasehorario="630pm" id="630pm" class="opthorario" value="630pm">De 6:30pm - 7:00pm</option>
									<option data-clasehorario="7pm" id="7pm" class="opthorario" value="7pm">De 7:00pm - 7:30pm</option>
									<option data-clasehorario="730pm" id="730pm" class="opthorario" value="730pm">De 7:30pm - 8:00pm</option>
									<option data-clasehorario="8pm" id="8pm" class="opthorario" value="8pm">De 8:00pm - 8:30pm</option>
									<option data-clasehorario="830pm" id="830pm" class="opthorario" value="830pm">De 8:30pm - 9:00pm</option>
									<option data-clasehorario="9pm" id="9pm" class="opthorario" value="9pm">De 9:00pm - 9:30pm</option>
								</select>

							</div>
							<input type="hidden" id="rutaAjax" name="rutaAjax" value="<?php echo admin_url('admin-ajax.php'); ?>" />
							<p>
								<input type="checkbox" id="aviso" data-parsley-error-message="Debe estar de acuerdo con el aviso de privacidad" required/>
								<label class="[ white-text ]" for="aviso">He leído y estoy de acuerdo con el <a class="[ white-text underlined ]" target="_blank" href="<?php echo THEMEPATH.'docs/vittorio-aviso-de-privacidad.pdf'; ?>">Aviso de privacidad</a></label>
							</p>
							<div class="[ block text-center margin-bottom ]">
								<button type="submit" class="[ waves-effect waves-light ][ btn-large ][ red ]">Hacer mi cita</button>
							</div>
						</form>
					</div>
				</div><div
					class="[ col s6 m7 ][ hide-on-small-only ][ no-float ][ inline-block ][ middle ]">
					<img class="[ img-responsive ]" src="<?php echo THEMEPATH; ?>img/el_poder.svg" alt="El poder de un traje">
				</div>


				<!-- Modal Structure/Listo! -->
				<div id="modal1" class="[ modal background-img ]">
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

			</div>
		</div>
	</div>

<?php get_footer(); ?>