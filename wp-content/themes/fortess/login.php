<?php if ( !defined('ABSPATH') ) exit; ?>
<?php
/**
 * Template Name: Login
 */
?>
<?php get_header(); ?>

<?php while ( have_posts() ) :
 			the_post();

?>

			<div class="content-main content-main_pt">
            
                <?php 
                                the_content(
			                     sprintf(
				                            wp_kses(
				                        	   /* translators: %s: Name of current post. Only visible to screen readers */
				                        	   __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', THEME_TEXTDOMAIN ),
				                            	array(
					                               	'span' => array(
						                                          	'class' => array(),
						                             ),
                                                )
				                            ),
			                            	wp_kses_post( get_the_title() )
			                             )
		                      );
                ?>

				<div class="container">
					<form  method="POST" action="" id="login_form" class="form form_center">
                    
                        <input type="hidden" name="action" value="login_member" />
            
                        <input type="hidden" name="login_nonce" value="<?php echo wp_create_nonce('login-nonce'); ?>"/>
                    
						<div class="form-header">
							<div class="heading-3 form-title"><?php esc_html_e( 'Log in to', THEME_TEXTDOMAIN ); ?> <span class="color-main">SkyFort</span></div>
						</div>
						<div class="form__row">
							<div class="form__label"><?php esc_html_e( 'E-mail address', THEME_TEXTDOMAIN ); ?></div>
							<input type="email" placeholder="<?php esc_html_e( 'Enter your e-mail', THEME_TEXTDOMAIN ); ?>" name="user_login">
						</div>
						<div class="form__row">
							<div class="form__label"><?php esc_html_e( 'Password', THEME_TEXTDOMAIN ); ?></div>
							<input type="password" placeholder="<?php esc_html_e( 'Enter password', THEME_TEXTDOMAIN ); ?>" name="user_pass">
						</div>
						<div class="form__note">
							<a href="<?php echo Fortess\Guest\ForgotPassword::get_url(); ?>" class="color-opacity link-reverse"><?php esc_html_e( 'Forgot password?', THEME_TEXTDOMAIN ); ?></a>
						</div>
						<div class="form__footer">
							<button class="btn btn_fluid" type="submit"><?php esc_html_e( 'Log in', THEME_TEXTDOMAIN ); ?></button>
						</div>
					</form>
				</div>

			</div><!-- /.content-main -->
<?php

 		endwhile;
 get_sidebar();
get_footer();