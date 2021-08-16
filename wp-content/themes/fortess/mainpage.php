<?php if ( !defined('ABSPATH') ) exit; ?>
<?php
/**
 * Template Name: Mainpage
 */
?>
<?php get_header(); ?>

<?php while ( have_posts() ) :
 			the_post();

?>
		<section class="section-intro">
				<div class="container section-intro__container">
					<div class="section-intro__content">
						<div class="text-styled"><?php the_field('mainpage-page-title2'); ?></div> 
						<?php the_title( '<h1 class="heading-lg">', '</h1>' ); ?>
                        
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

						<div class="button-group">
							<div class="button-group__item">
								<a href="#section-sign" class="btn js-go-sign"><?php esc_html_e( 'Sign up', THEME_TEXTDOMAIN ); ?> <span class="hidden-xs ml-5"><?php esc_html_e( 'now', THEME_TEXTDOMAIN ); ?></span></a>
							</div>
                            
                            <?php if (get_field('mainpage-button-title') && get_field('mainpage-button-link')) : ?>
                            
							<div class="button-group__item">
								<a href="<?php echo esc_url(get_field('mainpage-button-link')) ; ?>" class="btn btn_outline"><?php the_field('mainpage-button-title'); ?></a>
							</div>
                            
                            <?php endif; ?>
						</div>
					</div>
                    
                    <div class="section-intro__col">
						<div class="section-intro__img section-intro__img_pa">
                            <img srcset="<?php echo get_stylesheet_directory_uri();?>/assets/img/intro-img-sm.png 1000w,
							             <?php echo get_stylesheet_directory_uri();?>/assets/img/intro-img.png 1610w"
							     sizes="(max-width: 767px) 500px,
							            1610px"
							     src="<?php echo get_stylesheet_directory_uri();?>/assets/img/intro-img.png" decoding="async" loading="lazy" width="805" height="506" alt="">
						</div>
					</div>
				</div>
			</section><!-- /.section-intro -->


			<div class="section-wrap">

				<div class="gradient-center-right-2"></div>
				<div class="gradient-bottom"></div>
				<div class="gradient-center-left"></div>

                <section class="t-section-work">
					<div class="container">
						<div class="logo-group logo-group_center logo-group_mb">
							<div class="logo-group__txt"><?php the_field('enterprise-grade-protection-title_2'); ?></div>
							<div class="logo-group__img">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/fortress-logo.svg" decoding="async" loading="lazy" alt="">
							</div>
						</div>
                        
                         <?php if (have_rows('enterprise-grade-protection-options')) : ?>
                        
						<div class="t-section-work__container">
                        
                            <?php $i = 0; ?>
                        
                            <?php $count = count(get_field('enterprise-grade-protection-options')); ?>
                    
                            <?php while( have_rows('enterprise-grade-protection-options')): the_row();  ?>  

                            <?php if ($count - 1 == $i) { ?>

							<div class="t-section-work__bottom">
								<div class="heading-3"><?php the_sub_field('title'); ?></div>
								<div class="color-opacity"> 
									<?php the_sub_field('descr'); ?>
								</div>
							</div>

                            <?php } else { ?>
                            
                            <div class="t-section-work__content">
                                <?php if ($i == 0) { ?>
								<div class="text-styled"><?php the_field('enterprise-grade-protection-title'); ?></div>
                                <?php } ?>
								<h2 class="t-section-work__title"><?php the_sub_field('title'); ?></h2>

								<div class="color-opacity">
									<?php the_sub_field('descr'); ?>
								</div>
							</div>
                            
                            <?php } ?>
                            
                            <?php if ($i ==0) : ?>
                        
							<div class="t-section-work__media">
							    <picture>
								    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/cloud-group-sm.png" media="(max-width: 767px)">
								    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/cloud-group.png">
								    <img srcset="<?php echo get_template_directory_uri(); ?>/assets/img/cloud-group.png" alt="" width="1170" height="712">
								</picture>
							</div>	
                            
                            <?php endif; ?>
                        
                            <?php $i++; ?>
                            	
                            <?php endwhile; ?>    
						</div>
                        
                        <?php endif; ?>
                        
					</div>
			</section><!-- /.t-section-work -->

	    	<section class="t-section-default">
				<div class="container">
					<div class="section-header">
						<div class="text-styled"><?php the_field('next-gen-performance-title'); ?></div>
						<h2 class="section-header__title"><?php the_field('next-gen-performance-title2'); ?></h2>
						<div class="color-opacity">
							<?php the_field('next-gen-performance-descr'); ?>
						</div>
					</div>
                    
                    <?php if (have_rows('next-gen-performance-options')) : ?>

					<div class="grid grid-lg-4 grid-xs-2 grid-px-sm grid-mb-lg">
                    
                        <?php while( have_rows('next-gen-performance-options')): the_row();  ?>  
                        
                         <?php $image = get_sub_field('image'); ?>
                        
						<div class="grid__col">
							<div class="benefit">
                            
                                <?php if ($image) : ?>
                                
                                <?php $image_url  = wp_get_attachment_image_src( $image,'full', true ); ?>
                                
								<div class="benefit__icon">
									<div class="benefit__icon-elem">
										<img src="<?php echo $image_url[0]; ?>" decoding="async" loading="lazy" alt="<?php echo esc_attr( apply_filters( 'the_title', get_sub_field('title') ) ); ?>">
									</div>
								</div>
                                <?php endif; ?>
								<h3 class="benefit__title"><?php the_sub_field('title'); ?></h3>
								<div class="benefit__content color-opacity">
									<?php the_sub_field('descr'); ?>
								</div>
							</div>
						</div>
                        <?php endwhile; ?>
					</div>
                    
                    <?php endif; ?>
				</div>
			</section><!-- /.section-default -->


                <?php 
                /*
				<section class="section-brands">
					<div class="container">
						<h2 class="section-brands__title"><?php the_field('mainpage-customers-title'); ?></h2>

						<div class="grid grid-md-6 grid-sm-4 grid-xs-3 grid-2 grid-mb-sm">
                        
                            <?php while( have_rows('customers')): the_row();  ?>
                        
                            <?php $image = get_sub_field('mainpage-customers-image'); ?>  
                        
                            <?php if ($image) : ?>
                                    
                            <?php $image_url  = wp_get_attachment_image_src( $image,'full', true ); ?>  
                        
							<div class="grid__col">
							     <a href="<?php the_sub_field('mainpage-customers-url'); ?>" class="brand-box">
								        <img src="<?php echo $image_url[0]; ?>" decoding="async" loading="lazy" alt="">
							     </a>
						   </div>
                        
                           <?php endif; ?>
                        
                           <?php endwhile; ?>
						</div>
					</div>
				</section><!-- /.section-brands -->
                */
                ?>

                <?php 
                /*
				<section class="section-advantages">
					<div class="container">
						<div class="section-header">
							<div class="text-styled"><?php the_field('mainpage-whyskyfort-title_2'); ?></div>
							<h2 class="mb-10"><?php the_field('mainpage-whyskyfort-title'); ?></h2>
							<div class="section-header__content color-opacity">
								<?php the_field('mainpage-whyskyfort-descr'); ?>
							</div>
						</div>

						<div class="grid grid-sm-3">
						<?php while( have_rows('mainpage-whyskyfort-advantages')): the_row();  ?>
                        
                        <?php $image = get_sub_field('mainpage-whyskyfort-advantage-image'); ?>  
                    
						<div class="grid__col">
							<div class="advantages">
								<div class="advantages__header">
                                
                                    <?php if ($image) : ?>
                                    
                                    <?php $image_url  = wp_get_attachment_image_src( $image,'full', true ); ?>  
                                
									<div class="advantages__icon">
										<img src="<?php echo $image_url[0]; ?>" decoding="async" loading="lazy" alt="<?php echo esc_attr( apply_filters( 'the_title', get_sub_field('mainpage-whyskyfort-advantage-title') ) ); ?>">
									</div>
                                    
                                    <?php endif; ?>
                                    
									<div class="advantages__title heading-3"><?php the_sub_field('mainpage-whyskyfort-advantage-title'); ?></div>
								</div>
								<div class="advantages__content">
									<?php the_sub_field('mainpage-whyskyfort-advantage-descr'); ?>
								</div>
							</div>
						</div>
                        
                        <?php endwhile; ?>
						</div>
					</div>
				</section><!-- /.section-advantages -->
                */
                ?>
                
                <?php $img = get_field('mainpage-skyfort-img'); ?>
            
                <?php $image_url  = ($img) ? wp_get_attachment_image_src( $img,'full', true ) : false; ?> 

				<section class="section">
					<div class="container">
						<div class="column">
							<?php if ($image_url) { ?>
                    
						<div class="column__col text-center">
							<img src="<?php echo $image_url[0]; ?>" decoding="async" loading="lazy" width="337" height="308" alt="">
						</div>
                        
                        <?php } ?>

						<div class="column__content">
							<div class="heading-1"><span class="color-main"><?php the_field('mainpage-skyfort-title_2'); ?></span> <?php the_field('mainpage-skyfort-title'); ?></div>

							<p class="color-opacity mb-40"><?php the_field('mainpage-skyfort-descr'); ?></p>
                            
                            <?php if (get_field('mainpage-skyfort-button-title') && get_field('mainpage-skyfort-button-link')) : ?>

							<a href="<?php echo esc_url(get_field('mainpage-skyfort-button-link')); ; ?>" class="btn"><?php the_field('mainpage-skyfort-button-title'); ?></a>
                            <?php endif; ?>
						</div>
						</div>
					</div>
				</section>

	            <?php $img = get_field('mainpage-fortress-one-hardware-img'); ?>
            
            <?php $image_url  = ($img) ? wp_get_attachment_image_src( $img,'full', true ) : false; ?>  

			<section class="section-home" <?php if ($image_url) { ?>style="background-image: url(<?php echo $image_url[0]; ?>);"<?php } ?>>
				<div class="container">
					<div class="section-home__body">
						<div class="text-styled"><?php the_field('mainpage-fortress-one-hardware-title_2'); ?></div>
						<div class="heading-1 section-home__title">
							<?php the_field('mainpage-fortress-one-hardware-title'); ?>
						</div>
						<div class="button-group">
							<div class="button-group__item">
								<a href="#section-sign" class="btn"><?php esc_html_e( 'Pre-order', THEME_TEXTDOMAIN ); ?> <span class="hidden-xs ml-5"><?php esc_html_e( 'now', THEME_TEXTDOMAIN ); ?></span></a>
							</div>
                            <?php if (get_field('mainpage-fortress-one-button-title') && get_field('mainpage-fortress-one-button-link')) : ?>
							<div class="button-group__item">
								<a href="<?php echo esc_url(get_field('mainpage-fortress-one-button-link')); ?>" class="btn btn_outline"><?php the_field('mainpage-fortress-one-button-title'); ?></a>
							</div>
                            <?php endif; ?>
						</div>
					</div>
				</div>
			</section><!-- /.section-home -->


			<section id="section-sign" class="section-sign">
				<div class="container">
					<div class="grid grid_center grid-md-2">
						<div class="grid__col">
							<div class="text-styled"><?php the_field('mainpage-waitlist-title_2'); ?></div>
							<div class="heading-1 mb-10"><?php the_field('mainpage-waitlist-title'); ?></div>

							<div class="section-sign__info">
								<?php the_field('mainpage-waitlist-descr'); ?>
							</div>
						</div>

						<div class="grid__col">
                            <?php  echo do_shortcode(get_field('contact_form_main_page_shortcode', 'options-settings')); ?>
						</div>		
					</div>
				</div>
			</section><!-- /.section-sign -->	

<?php

 		endwhile;
 get_sidebar();
get_footer();