<?php if ( !defined('ABSPATH') ) exit; ?>
<?php
/**
 * Template Name: Reset Password
 */
?>
<?php get_header(); ?>

<?php $password_confirm = $_GET['password-confirm'] ?? ''; ?>

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
                
                    <?php if ($password_confirm) { ?>
    
                    <?php $data = unserialize(base64_decode($_GET['password-confirm'])); ?>
                    
                    <form id="forgot_password_confirm_form" action="" method="POST" class="form form_center">
                    
                        <input type="hidden" name="action" value="forgot_password_confirm" />
        
                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
        
                        <input type="hidden" name="code" value="<?php echo $data['code']; ?>" />
            
                        <input type="hidden" name="forgot_password_confirm_nonce" value="<?php echo wp_create_nonce('forgot_password_confirm-nonce'); ?>"/>
    
                    
						<div class="form-header">
							<div class="heading-3 form-title"><?php esc_html_e( 'Set a new password', THEME_TEXTDOMAIN ); ?></div>
						</div>
						<div class="form__row">
							<div class="form__label"><?php esc_html_e( 'New password', THEME_TEXTDOMAIN ); ?></div>
							<input type="password" id="password" name="password" placeholder="<?php esc_html_e( 'Enter password', THEME_TEXTDOMAIN ); ?>">
						</div>
						<div class="form__row">
							<div class="form__label"><?php esc_html_e( 'Confirm new password', THEME_TEXTDOMAIN ); ?></div>
							<input type="password" id="passwordConfirmation" name="passwordConfirmation" placeholder="<?php esc_html_e( 'Enter password', THEME_TEXTDOMAIN ); ?>">
						</div>
						<div class="form__footer">
							<button class="btn btn_fluid" type="submit"><?php esc_html_e( 'Confirm', THEME_TEXTDOMAIN ); ?></button>
						</div>
					</form>
                   
                    <?php } else { ?>
                
					<form id="forgot_password_form" action="" method="POST" class="form form_center">
                    
                        <input type="hidden" name="action" value="forgot_password_member" />
            
                        <input type="hidden" name="forgot_password_nonce" value="<?php echo wp_create_nonce('forgot_password-nonce'); ?>"/>
                    
						<div class="form-header">
							<div class="heading-3 form-title"><?php esc_html_e( 'Reset password', THEME_TEXTDOMAIN ); ?></div>
						</div>
						<div class="form__row">
							<div class="form__label"><?php esc_html_e( 'E-mail address', THEME_TEXTDOMAIN ); ?></div>
							<input type="email" placeholder="<?php esc_html_e( 'Enter your e-mail', THEME_TEXTDOMAIN ); ?>" name="user_login">
						</div>
						<div class="form__footer">
							<button class="btn btn_fluid" type="submit"><?php esc_html_e( 'Reset', THEME_TEXTDOMAIN ); ?></button>
						</div>
					</form>
                    
                    <?php } ?>
                    
				</div>

			</div><!-- /.content-main -->
            
             <div id="modal-resetpassword-complete" class="modal">
			 <div class="modal-overlay"></div>

			 <div class="modal-content">
				<button type="button" class="modal-close js-modal-close"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/svg/close.svg" decoding="async" loading="lazy" alt=""></button>
				<div class="modal-content__inner font-lg">
				    <p>
		                <?php esc_html_e( 'Password recovery link has been sent to provided E-mail.', THEME_TEXTDOMAIN ); ?>
	                </p>
				</div>
			 </div>
	       	</div><!-- /.modal -->
<?php

 		endwhile;
 get_sidebar();
get_footer();