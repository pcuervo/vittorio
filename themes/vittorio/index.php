<?php
	get_header();
?>
	<div style="display:none;" id="gmap_geo" class="gmaps"></div>

	<div  class="[ background-img background-img--main ]">
		<div class="[ container ]">
			<div class="[ row ]">
				<div class="[ col l6 ][ hide-on-med-and-up ]">
					<img class="[ img-responsive ][ middle ]" src="<?php echo THEMEPATH; ?>img/el_poder.png" alt="El poder de un traje">
				</div>

				<div class="[ col s12 m7 l5 ][ no-float ][ inline-block ][ middle ]">
					<div class="[ bg-dark ][ padding ][ margin-vertical ]">
						<p class="[ text-uppercase white-text ]">¡hombre, muy bien! </p>
						<p class="[ white-text ]">Compártenos los siguientes datos para hacer una cita con uno de nuestros Expertos en Trajes y te ayude a encontrar tu traje perfecto.</p>

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
								<select id="ciudad" name="ciudad" data-parsley-error-message="Seleccione una ciudad" required>
									<option class="" value="" disabled selected>Ciudad</option>
									<option class="optCiudad" data-lat="19.3209311" data-long="-99.432815" value="Ciudad de Mexico">Ciudad de Mexico</option>
									<option class="optCiudad" data-lat="20.6489394" data-long="-98.4368711" value="Monterrey">Monterrey</option>
									<option class="optCiudad" data-lat="19.2942611" data-long="-99.7012545" value="Toluca">Toluca</option>
								</select>
							</div>
							<div class="[ input-field ][ bg-white ]">
								<select id="tienda" name="tienda" data-parsley-error-message="Seleccione una tienda" required>
									<option class="" value="" disabled selected>Tienda</option>
									<option class="optTienda" value="GALERÍAS GUADALAJARA">GALERÍAS GUADALAJARA</option>
									<option class="optTienda" value="GALERIAS MONTERREY">GALERIAS MONTERREY</option>
									<option class="optTienda" value="CENTRAL DE TRAJES">CENTRAL DE TRAJES</option>
								</select>
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
								<label class="[ white-text ]" for="aviso">He leído y estoy de acuerdo con el <a class="[ white-text underlined ]" href="#">Aviso de privacidad</a></label>
							</p>
							<div class="[ block text-center margin-bottom ]">
								<button type="submit" class="[ waves-effect waves-light ][ btn-large ][ red ]">Hacer mi cita</button>
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