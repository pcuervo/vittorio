<?php
	get_header();
?>

	<div class="[ background-img background-img--main ]">
		<div class="[ container ]">
			<div class="[ row ]">
				<div class="[ col l6 ][ hide-on-med-and-up ]">
					<img class="[ img-responsive ][ middle ]" src="img/el_poder.png" alt="El poder de un traje">
				</div>
				<div class="[ col s12 m6 l5 ]">
					<form class="[ padding margin-vertical ]">

						<p class="[ text-uppercase white-text ]">¡hombre, muy bien! </p>
						<p class="[ white-text ]">Compártenos los siguientes datos para hacer una cita con uno de nuestros Expertos en Trajes y te ayude a encontrar tu traje perfecto.</p>

						<div class="[ input-field ]">
							<input placeholder="Nombre" type="text" class="validate">
							<input placeholder="Apellido" type="text" class="validate">	
							<select class="[ block ]">
								<option value="" disabled selected>Ciudad</option>
								<option value="1">Option 1</option>
								<option value="2">Option 2</option>
								<option value="3">Option 3</option>
							</select>	
							<select class="[ block ]">
								<option value="" disabled selected>Tienda</option>
								<option value="1">Option 1</option>
								<option value="2">Option 2</option>
								<option value="3">Option 3</option>
							</select>	
							<input class="[ block ]" type="date" class="datepicker">	
							<select class="[ block ]">
								<option value="" disabled selected>Horario</option>
								<option value="1">Option 1</option>
								<option value="2">Option 2</option>
								<option value="3">Option 3</option>
							</select>
							<p>
								<input type="checkbox" id="test5" />
								<label for="test5">He leído y estoy de acuerdo con el Aviso de Privacidad</label>		
							</p>		
							<div class="[ block text-center margin-bottom ]">
								<a class="[ waves-effect waves-light ][ btn-large btn-fixed-width ][  ][ col-6 ][ grey darken ]">Geolocalizarme</a>
								<a class="[ waves-effect waves-light ][ btn-large btn-fixed-width ][  ][ col-6 ][ red ]">Hacer mi cita</a>							
							</div>		
						</div>
					</form>
				</div>

				<div class="[ col offset-l1 l6 s6 ][ hide-on-small-only ]">
					<div class="[ relative ][ height-100vh ]">
						<img class="[ img-responsive ][ center-full ]" src="img/el_poder.png" alt="El poder de un traje">
					</div>
				</div>

			</div>
		</div>
	</div>


<?php get_footer(); ?>