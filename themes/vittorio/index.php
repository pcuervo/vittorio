<?php
	get_header();
?>
	<div style="display:none;" id="gmap_geo" class="gmaps"></div>

	<div  class="[ background-img background-img--main ]">
		<div class="[ container ]">
			<div class="[ row ]">
				<div class="[ col l7 ][ hide-on-med-and-up ]">
					<img class="[ img-responsive ][ middle ]" src="<?php echo THEMEPATH; ?>img/el_poder.png" alt="El poder de un traje">
				</div>

				<div class="[ col s12 m5 l4 ][ no-float ][ inline-block ][ middle ]">
					<div class="[ bg-dark ][ padding ][ margin-vertical ]">
						<p class="[ text-uppercase white-text ]">¡hombre, muy bien! </p>
						<p class="[ white-text ]">Compártenos los siguientes datos para hacer una cita con uno de nuestros Expertos en Trajes y te ayude a encontrar tu traje perfecto.</p>

						<form class="[ margin-top--l ]" method="post" name="front_end" action="citas">
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
											echo '<option value="'.get_the_title().'" class="opttienda '.$claseciudad.'" id="tienda_'.$posts->post->ID.'" data-claseciudad="'.$claseciudad.'" data-lat="'.$meta['_latitud_meta'][0].'" data-long="'.$meta['_longitud_meta'][0].'" data-direccion="'.$meta['_ubicacion_meta'][0].'" data-telefono="'.$meta['_telefono_meta'][0].'">'.get_the_title().'</option>';
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
									<option value="Option 1">Option 1</option>
									<option value="Option 2">Option 2</option>
									<option value="Option 3">Option 3</option>
								</select>
							</div>
							<p>
								<input type="checkbox" id="aviso" data-parsley-error-message="Debe estar de acuerdo con el aviso de privacidad" required/>
								<label class="[ white-text ]" for="aviso">He leído y estoy de acuerdo con el <a class="[ white-text underlined ]" href="<?php echo site_url('aviso-de-privacidad'); ?>">Aviso de privacidad</a></label>
							</p>
							<div class="[ block text-center margin-bottom ]">
								<button type="submit" class="[ waves-effect waves-light ][ btn-large ][ margin-top ][ red ]">Hacer mi cita</button>
							</div>
						</form>
					</div>
				</div>

				<div class="[ col s6 m4 l6 ][ hide-on-small-only ][ no-float ][ inline-block ][ middle ]">
					<img class="[ img-responsive ]" src="<?php echo THEMEPATH; ?>img/el_poder.png" alt="El poder de un traje">
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