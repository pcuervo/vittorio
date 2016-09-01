<?php
	get_header();
	the_post();
?>

	<div class="[ background-img background-img--main ]">
		<div class="[ container ]">
			<div class="[ row ]">
				<div class="[ col l6 ][ hide-on-med-and-up ]">
					<img class="[ img-responsive ][ middle ]" src="<?php echo THEMEPATH; ?>img/el_poder.png" alt="El poder de un traje">
				</div>
				<div class="[ col s12 m7 ][ padding ]">
					<div class="[ bg-dark white-text ][ padding margin-top margin-vertical--large-md ]">
						<?php the_content(); ?>
					</div>
				</div>

				<div class="[ col s6 m5 ][ hide-on-small-only ]">
					<div class="[ relative ][ height-100vh ]">
						<img class="[ img-responsive ][ center-full ]" src="<?php echo THEMEPATH; ?>img/el_poder.png" alt="El poder de un traje">
					</div>
				</div>

			</div>
		</div>
	</div>

<?php get_footer(); ?>