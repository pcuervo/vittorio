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
						<p class="[ text-uppercase white-text ][ no-margin-top ]">EL ÉXITO ESTÁ A UNOS PASOS DE DISTANCIA</p>
						<p class="[ white-text ]">Encuentra el traje perfecto para ti, con la ayuda de un Experto en Trajes.</p>

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
									<option data-clasehorario="9" id="9" class="opthorario" value="9">De 9:00 - 10:00</option>
									<option data-clasehorario="10" id="10" class="opthorario" value="10">De 10:00 - 11:00</option>
									<option data-clasehorario="11" id="11" class="opthorario" value="11">De 11:00 - 12:00</option>
									<option data-clasehorario="12" id="12" class="opthorario" value="12">De 12:00 - 13:00</option>
									<option data-clasehorario="13" id="13" class="opthorario" value="13">De 13:00 - 14:00</option>
									<option data-clasehorario="14" id="14" class="opthorario" value="14">De 14:00 - 15:00</option>
									<option data-clasehorario="15" id="15" class="opthorario" value="15">De 15:00 - 16:00</option>
									<option data-clasehorario="16" id="16" class="opthorario" value="16">De 16:00 - 17:00</option>
									<option data-clasehorario="17" id="17" class="opthorario" value="17">De 17:00 - 18:00</option>
									<option data-clasehorario="18" id="18" class="opthorario" value="18">De 18:00 - 19:00</option>
									<option data-clasehorario="19" id="19" class="opthorario" value="19">De 19:00 - 20:00</option>
									<option data-clasehorario="20" id="20" class="opthorario" value="20">De 20:00 - 21:00</option>
									<option data-clasehorario="21" id="21" class="opthorario" value="21">De 21:00 - 22:00</option>
								</select>

							</div>
							<div class="[ input-field ][ bg-white ]">
								<select id="porque" name="porque" data-parsley-error-message="¿Por qué necesitas un traje?" required>
									<option value="" selected>¿Por qué necesitas un traje?</option>
									<option id="porque0"  value="Boda">Boda</option>
									<option id="porque1"  value="Trabajo">Trabajo</option>
									<option id="porque2"  value="Graduación">Gracuación</option>
									<option id="porque3"  value="XV Años">XV Años</option>
									<option id="porque4"  value="Bautizo">Bautizo</option>
									<option id="porque5"  value="Comida / Cena">Comida / Cena</option>
									<option id="porque6"  value="Otros">Otros</option>
								</select>

							</div>
							<div class="[ input-field ]">
								<input type="text" class="" id="quebuscas" data-parsley-error-message="¿Qué buscas en un traje?" name="quebuscas" >
								<label for="quebuscas">¿Qué buscas en un traje?</label>
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