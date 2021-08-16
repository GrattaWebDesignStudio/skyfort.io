<?php if ( !defined('ABSPATH') ) exit; ?>
<?php
/**
 * Template Name: Sign Up
 */
?>
<?php get_header(); ?>

<?php while ( have_posts() ) :
 			the_post();

?>
			<div class="content-main content-main_pt">

				<div class="container">
                    <?php the_title( '<h1 class="heading-lg text-center mb-45">', '</h1>' ); ?>
                    
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

					<div class="box box_pa box_center">
						<div class="heading-3 mb-0"><?php esc_html_e( 'Registration details', THEME_TEXTDOMAIN ); ?></div>

						<form action="" method="POST" id="register_form">
                        
                            <input type="hidden" name="action" value="registration_member" />
            
                            <input type="hidden" name="registration_nonce" value="<?php echo wp_create_nonce('registration-nonce'); ?>"/>
                            
                            <?php if (isset($_GET['ref']) && isset($_GET['email'])) { ?>
                            
                            <input type="hidden" name="ref" value="<?php echo $_GET['ref']; ?>" />
                            
                            <?php } ?>
                        
							<div class="form-group">

                                <div class="form-group__item">
                                <?php 
                                    woocommerce_form_field('firstname', array(
                                                             'type'       => 'text',
                                                             'class'      => array(),
                                                             'label_class' =>  array('form__label'),
                                                             'input_class' => array(),
                                                             'label'      => __('First Name', THEME_TEXTDOMAIN),
                                                             'placeholder'    =>  __('Enter your first name', THEME_TEXTDOMAIN),
                                                             'required' => true
                                                            )
                                           );
                                ?> 
                                </div>
								<div class="form-group__item">
                                    <?php 
                                    woocommerce_form_field('lastname', array(
                                                             'type'       => 'text',
                                                             'class'      => array(),
                                                             'label_class' =>  array('form__label'),
                                                             'input_class' => array(),
                                                             'label'      => __('Last name', THEME_TEXTDOMAIN),
                                                             'placeholder'    =>  __('Enter your last name', THEME_TEXTDOMAIN),
                                                             'required' => true
                                                            )
                                           );
                                    ?> 
								</div>		
							</div>

							<div class="form-group">
								<div class="form-group__item">
                                    <?php 
                                        woocommerce_form_field('email', array(
                                                             'type'       => 'text',
                                                             'class'      => array(),
                                                             'label_class' =>  array('form__label'),
                                                             'input_class' => array(),
                                                             'label'      => __('Email address', THEME_TEXTDOMAIN),
                                                             'placeholder'    => __('Enter your email', THEME_TEXTDOMAIN),
                                                             'required' => true,
                                                             'default' => ((isset($_GET['ref']) && isset($_GET['email'])) ? $_GET['email'] : '')
                                                            )
                                           );
                                     ?> 
								</div>

								<div class="form-group__item">
                                    <?php 
                                        woocommerce_form_field('mobilePhone', array(
                                                             'type'       => 'text',
                                                             'class'      => array(),
                                                             'label_class' =>  array('form__label'),
                                                             'input_class' => array(),
                                                             'label'      => __('Phone', THEME_TEXTDOMAIN),
                                                             'placeholder'    => __('Enter your phone number', THEME_TEXTDOMAIN),
                                                             'required' => true
                                                            )
                                           );
                                    ?> 
								</div>		
							</div>

							<div class="form-group">
								<div class="form-group__item">
                                     <?php 
                                         woocommerce_form_field('password', array(
                                                             'type'       => 'password',
                                                             'class'      => array(),
                                                             'label_class' =>  array('form__label'),
                                                             'input_class' => array(),
                                                             'label'      => __('Password', THEME_TEXTDOMAIN),
                                                             'placeholder'    => __('Enter password', THEME_TEXTDOMAIN),
                                                             'required' => true
                                                            )
                                           );
                                    ?>
								</div>

								<div class="form-group__item">
                                    <?php 
                                        woocommerce_form_field('passwordConfirmation', array(
                                                             'type'       => 'password',
                                                             'class'      => array(),
                                                             'label_class' =>  array('form__label'),
                                                             'input_class' => array(),
                                                             'label'      => __('Confirm Password', THEME_TEXTDOMAIN),
                                                             'placeholder'    => __('Enter password again', THEME_TEXTDOMAIN),
                                                             'required' => true
                                                            )
                                           );
                                    ?>
								</div>	
                                
                                <?php /*if (!(isset($_GET['ref']) && isset($_GET['email']))) { ?>
                                    <div class="form-group__item">
                                    <?php 
                                        woocommerce_form_field('team-status', array(
                                                             'type'       => 'checkbox',
                                                             'class'      => array(),
                                                             'label_class' =>  array('form__label'),
                                                             'input_class' => array(),
                                                             'label'      => __('Register as a team ', THEME_TEXTDOMAIN),
                                                             'placeholder'    => __('Register as a team ', THEME_TEXTDOMAIN),
                                                             'required' => false
                                                            )
                                           );
                                    ?>
								    </div>	
                                <?php }*/ ?>
                                	
							</div>

							<div class="mt-25">
								<button class="btn btn_fluid-xs" type="submit"><?php esc_html_e( 'sign up', THEME_TEXTDOMAIN ); ?></button>
							</div>
						</form>
					</div>
				</div>

			</div><!-- /.content-main -->
            
            <div id="modal-registration-complete" class="modal">
			 <div class="modal-overlay"></div>

			 <div class="modal-content">
				<button type="button" class="modal-close js-modal-close"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/svg/close.svg" decoding="async" loading="lazy" alt=""></button>
				<div class="modal-content__inner font-lg">
				    <p class="client-title">
		                  	<?php esc_html_e( 'Dear', THEME_TEXTDOMAIN ); ?> <span class="new-user-name"></span>
                    </p>
		            <p class="description">
			             <?php esc_html_e( 'Your Registration is complete.', THEME_TEXTDOMAIN ); ?>
			             <br>
                         <?php esc_html_e( 'Please confirm your E-mail to activate your account.', THEME_TEXTDOMAIN ); ?>
			             <br>
			             <?php esc_html_e( 'The confirmation link has been sent to your E-mail.', THEME_TEXTDOMAIN ); ?>
		            </p>
				</div>
			 </div>
	       	</div><!-- /.modal -->

		<?php

 		endwhile;
 get_sidebar();
get_footer();