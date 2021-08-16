<?php if ( !defined('ABSPATH') ) exit; ?>
<?php
/**
 * Template Name: Business
 */
?>
<?php get_header(); ?>

<?php while ( have_posts() ) :
 			the_post();

?>
  	     <section class="section-intro">
				<div class="container section-intro__container">
					<div class="section-intro__content">
						<div class="text-styled"><?php the_field('business-page-title'); ?></div> 
						<h1 class="section-intro__heading"><?php the_title( '<h1 class="section-intro__heading">', '</h1>' ); ?></h1>
						<div class="heading-3 mb-25"><?php the_field('bussiness-title2'); ?></div>

						<div class="section-intro__info color-opacity">
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
						</div>
                        
                        <?php if (get_field('business-page-button-title')) : ?>

						<a href="#section-sign" class="btn js-go-sign"><?php the_field('business-page-button-title'); ?></a>
                        
                        <?php endif; ?>
                        
					</div>

                    <div class="section-intro__col">
						<div class="section-intro__img section-intro__img_pa">
                            <img srcset="<?php echo get_stylesheet_directory_uri();?>/assets/img/business.png 804w,
							             <?php echo get_stylesheet_directory_uri();?>/assets/img/business-2x.png 1608w"
							     sizes="(max-width: 767px) 500px,
							            1608px"
							     src="<?php echo get_stylesheet_directory_uri();?>/assets/img/business-2x.png" decoding="async" loading="lazy" width="805" height="501" alt="">
						</div>
					</div>
                    
				</div>
			</section><!-- /.section-intro -->
            
            <div class="section-wrap">

				<div class="gradient-center-right-2"></div>
				<div class="gradient-bottom"></div>
				<div class="gradient-center-left"></div>

			<section class="section">
				<div class="container">
					<div class="info-box mb-50">
						<div class="info-box__item">
							<div class="heading-1 max-w-md mb-0"><?php the_field('business-how-can-skyfort-help-title'); ?></div>
						</div>

						<div class="info-box__item">
							<div class="color-opacity">
								<?php the_field('business-how-can-skyfort-help-descr'); ?>
							</div>
						</div>
					</div>


					<div class="grid grid-lg-4 grid-xs-2 grid-px-sm grid-mb-lg">
                    
                        <?php while( have_rows('benefits')): the_row();  ?>
                    
						<div class="grid__col">
							<div class="benefit benefit_w">
                            
                                <?php $image = get_sub_field('benefit-image'); ?>  
                        
                                <?php if ($image) : ?>
                                    
                                <?php $image_url  = wp_get_attachment_image_src( $image,'full', true ); ?>  
                            
								<div class="benefit__icon">
									<div class="benefit__icon-elem">
										<img src="<?php echo $image_url[0]; ?>" decoding="async" loading="lazy" alt="">
									</div>
								</div>
                                
                                <?php endif; ?>
                                
								<h3 class="benefit__title"><?php the_sub_field('benefit-title'); ?></h3>
								<div class="benefit__content color-opacity">
									<?php the_sub_field('benefit-descr'); ?>
								</div>
							</div>
						</div>
                        
                        <?php endwhile; ?>
					</div>
				</div>
			</section><!-- /.section -->


			<section class="section">
				<div class="container">
					<h2 class="heading-lg heading-max-w mb-30"><?php the_field('business-steps-keeping-title'); ?></h2>

					<div class="info-box mb-60">
						<div class="info-box__item">
							<div class="font-lg">
								<?php the_field('business-steps-keeping-descr'); ?>
							</div>
						</div>

						<div class="info-box__item">
							<div class="color-opacity max-w-md info-box__offset">
								<?php the_field('business-steps-keeping-descr2'); ?>
							</div>
						</div>
					</div>


					<div class="grid grid-sm-3">
                    
                        <?php while( have_rows('advantages')): the_row();  ?>
                    
						<div class="grid__col">
							<div class="advantages">
								<div class="advantages__header">
                                    <?php $image = get_sub_field('advantage-image'); ?>  
                        
                                    <?php if ($image) : ?>
                                    
                                    <?php $image_url  = wp_get_attachment_image_src( $image,'full', true ); ?>  
									<div class="advantages__icon">
										<img src="<?php echo $image_url[0]; ?>" decoding="async" loading="lazy" alt="">
									</div>
                                    <?php endif; ?>
									<div class="advantages__title heading-3"><?php the_sub_field('advantage-title'); ?></div>
								</div>
								<div class="advantages__content">
									<?php the_sub_field('advantage-descr'); ?>
								</div>
							</div>
						</div>
                        
                        <?php endwhile; ?>
					</div>
				</div>
			</section><!-- /.section -->

            
            <?php 
            /*
			<section class="section-default">
				<div class="container">
					<div class="text-styled"><?php esc_html_e( 'working from home', THEME_TEXTDOMAIN ); ?></div>

					<div class="grid grid-md-2">
						<div class="grid__col">
							<h2 class="heading-1 mb-10"><?php the_field('business-protect-title'); ?></h2>

							<p class="font-lg mb-20">
								<?php the_field('business-protect-descr'); ?>
							</p>

							<p class="color-opacity">
								<?php the_field('business-protect-descr2'); ?>
							</p>	
						</div>

						<div class="grid__col">
							<div class="img-box img-box_styled">
								<img srcset="<?php echo get_stylesheet_directory_uri();?>/assets/img/business-content.jpg,
								             assets/img/business-content-2x.jpg 2x" 
								     src="<?php echo get_stylesheet_directory_uri();?>/assets/img/business-content.jpg" alt="" decoding="async" loading="lazy">
							</div>
						</div>
					</div>
				</div>
			</section>
            */
            ?>


			<section id="section-sign" class="section-sign">
				<div class="container">
					<div class="grid grid_center grid-md-2">
						<div class="grid__col">
							<div class="text-styled"><?php the_field('business-lets-do-this-title_2'); ?></div>
							<div class="heading-1 mb-10"><?php the_field('business-lets-do-this-title'); ?></div>

							<div class="section-sign__info">
								<?php the_field('business-lets-do-this-description'); ?>
							</div>
						</div>

						<div class="grid__col">
							<?php  echo do_shortcode(get_field('bussiness_form_shortcode', 'options-settings')); ?>
						</div>		
					</div>
				</div>
			</section><!-- /.section-sign -->
            
          </div><!-- /.section-wrap -->		

<?php

 		endwhile;
 get_sidebar();
get_footer();