<?php
	get_header();
?>

	<div class="[ background-img background-img--main ]">
		<div class="[ container ]">
			<div class="[ row ]">
				<div class="[ col l6 ][ hide-on-med-and-up ]">
					<img class="[ img-responsive ][ middle ]" src="<?php echo THEMEPATH; ?>img/el_poder.png" alt="El poder de un traje">
				</div>
				<div class="[ col s12 m7 l5 ]">
					<form class="[ padding margin-vertical margin-vertical--large-md ]">

						<p class="[ text-uppercase white-text ]">¡hombre, muy bien! </p>
						<p class="[ white-text ]">Compártenos los siguientes datos para hacer una cita con uno de nuestros Expertos en Trajes y te ayude a encontrar tu traje perfecto.</p>

						<div class="[ input-field ]">
							<input type="text" placeholder="Nombre" type="text" class="[ validate ]" name="apellido" data-parsley-error-message="Este campo es obligatorio" required>
							<input type="text" placeholder="Apellido" type="text" class="[ validate ]" name="apellido" data-parsley-error-message="Este campo es obligatorio" required>	
							<select class="[ block ]" name="ciudad" data-parsley-error-message="Seleccione una ciudad" required>
								<option value="" disabled selected>Ciudad</option>
								<option value="1">Option 1</option>
								<option value="2">Option 2</option>
								<option value="3">Option 3</option>
							</select>	
							<select class="[ block ]" name="tienda" data-parsley-error-message="Seleccione una tienda" required>
								<option value="" disabled selected>Tienda</option>
								<option value="1">Option 1</option>
								<option value="2">Option 2</option>
								<option value="3">Option 3</option>
							</select>	
							<input class="[ block datepicker ]" type="date" id="all-datepicker" data-parsley-error-message="Por favor selecciona una fecha" data-parsley-type="digits" required>	
							<select class="[ block ]" name="horario" data-parsley-error-message="Por favor selecciona un horario" required>
								<option value="" disabled selected>Horario</option>
								<option value="1">Option 1</option>
								<option value="2">Option 2</option>
								<option value="3">Option 3</option>
							</select>
							<p>
								<input type="checkbox" id="test5" data-parsley-error-message="Debe estar de acuerdo con el aviso de privacidad" required/>
								<label for="test5"></label>
								<span class="[ white-text ]">He leído y estoy de acuerdo con el <a class="[ white-text underlined ]" href="#">Aviso de privacidad</a></span>
							</p>		
							<div class="[ block text-center margin-bottom ]">
								<a class="[ waves-effect waves-light ][ btn-large btn-fixed-width ][  ][ col-6 ][ grey darken ]">Geolocalizarme</a>
								<button type="submit" class="[ waves-effect waves-light ][ btn-large btn-fixed-width ][  ][ col-6 ][ red ]">Hacer mi cita</button>							
							</div>		
						</div>
					</form>
				</div>
				<!-- Modal Trigger/ Listo!-->
				<a class="[ waves-effect waves-light btn modal-trigger ]" href="#modal1">Listo</a>

				<!-- Modal Structure -->

					<div id="modal1" class="[ modal background-img ]">
						<div class="[ modal-content ]">
							<h4>¡LISTO!</h4>
							<p>NUESTRO EXPERTO EN TRAJES TE ESTARÁ ESPERANDO PARA ATENDERTE PERSONALMENTE</p>
							<p>SÓLO CONFIRMA TU CORREO PARA QUE TU CITA QUEDE PROGRAMADA</p>
							<a href="#!" class="[ red white-text modal-action modal-close waves-effect waves-green btn-flat ]">CERRAR</a>
						</div>
					</div>					
				<!-- Modal Trigger/ Gracias!-->
				<a class="[ waves-effect waves-light btn modal-trigger ]" href="#modal2">Gracias</a>

				<!-- Modal Structure -->

					<div id="modal2" class="[ modal background-img ]">
						<div class="[ modal-content ]">
							<h4>GRACIAS</h4>
							<p>TU CITA ESTÁ CONFIRMADA</p>
							<p>TE ESPERAMOS</p>
							<a href="#!" class="[ red white-text modal-action modal-close waves-effect waves-green btn-flat ]">CERRAR</a>
						</div>
					</div>

				<div class="[ col s6 m5 offset-l1 l6 ][ hide-on-small-only ]">
					<div class="[ relative ][ height-100vh ]">
						<img class="[ img-responsive ][ center-full ]" src="<?php echo THEMEPATH; ?>img/el_poder.png" alt="El poder de un traje">
					</div>
				</div>

			</div>
		</div>
	</div>


<?php get_footer(); ?>