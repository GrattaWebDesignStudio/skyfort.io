<?php if ( !defined('ABSPATH') ) exit; ?>

<?php
/**
 * Template Name: Contacts
 */
?>

<?php get_header(); ?>

<?php while ( have_posts() ) :
 			the_post();

?>

			<div class="content-main">

				<div class="container">
					
					<div class="contact-box">
						<div class="contact-box__body">
							<div class="text-styled mb-15"><?php the_field('contact-page-title'); ?></div>

                            <?php the_title( '<h1 class="contact-box__title">', '</h1>' ); ?>
                            
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

							<div class="contact-box__row">
                            
                                <?php $email = get_field('email', 'options-settings');  ?>
                                <?php if ($email) : ?>
								<div class="contact">
									<div class="contact__icon">
										<img class="img-fluid" src="<?php echo get_stylesheet_directory_uri();?>/assets/img/icons/email.png" decoding="async" loading="lazy" alt="">
									</div>
									<div class="contact__txt">
										<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
									</div>
								</div>
                                <?php endif; ?>

                                <?php $phone = get_field('phone', 'options-settings');  ?>
                                <?php if ($phone) : ?>
								<div class="contact">
									<div class="contact__icon">
										<img class="img-fluid" src="<?php echo get_stylesheet_directory_uri();?>/assets/img/icons/phone.png" decoding="async" loading="lazy" alt="">
									</div>
									<div class="contact__txt">
										<a href="tel:<?php echo str_replace(' ','',$phone); ?>"><?php echo $phone;?></a>
									</div>
								</div>
                                <?php endif; ?>
							</div>

							<div class="contact-box__row">
								<div class="color-opacity mb-10"><?php esc_html_e( 'Social media:', THEME_TEXTDOMAIN ); ?></div>

								<div class="social-list social-list_styled">
                                    <?php $url = get_field('link', 'options-settings');  ?>
                                    <?php if ($url) : ?>
						               <a href="<?php echo $url; ?>" class="social-list__item"  target="_blank">
							             <img src="<?php echo get_template_directory_uri(); ?>/assets/img/link.svg" decoding="async" loading="lazy" alt="">
						               </a>
                                    <?php endif; ?>
                                    <?php $url = get_field('twitter', 'options-settings');  ?>
                                    <?php if ($url) : ?>
						              <a href="<?php echo $url; ?>" class="social-list__item"  target="_blank">
							             <img src="<?php echo get_template_directory_uri(); ?>/assets/img/twitter.svg" decoding="async" loading="lazy"> 
						              </a>
                                    <?php endif; ?>
                                    <?php $url = get_field('instagram', 'options-settings');  ?>
                                    <?php if ($url) : ?>
						              <a href="<?php echo $url; ?>" class="social-list__item"  target="_blank">
							             <img src="<?php echo get_template_directory_uri(); ?>/assets/img/instagram.svg" decoding="async" loading="lazy">
						              </a>
                                    <?php endif; ?>
								</div>
							</div>
						</div>

						<div class="contact-box__col">
                        
                            <?php echo do_shortcode(get_field('contacts_form_shortcode', 'options-settings')); ?>
           
						</div>
					</div>															

				</div>

			</div><!-- /.content-main -->

<?php

 		endwhile;
 get_sidebar();
get_footer();
	