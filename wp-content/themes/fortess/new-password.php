<?php if ( !defined('ABSPATH') ) exit; ?>
<?php get_header(); ?>

<?php while ( have_posts() ) :
 			the_post();

?>

			<div class="content-main content-main_pt">

				<div class="container">
					<form action="#" class="form form_center">
						<div class="form-header">
							<div class="heading-3 form-title">Set a new password</div>
						</div>
						<div class="form__row">
							<div class="form__label">New password</div>
							<input type="password" placeholder="Enter password">
						</div>
						<div class="form__row">
							<div class="form__label">Confirm new password</div>
							<input type="password" placeholder="Enter password">
						</div>
						<div class="form__footer">
							<button class="btn btn_fluid" type="submit">Confirm</button>
						</div>
					</form>
				</div>

			</div><!-- /.content-main -->
<?php

 		endwhile;
 get_sidebar();
get_footer();
	