<?php if ( !defined('ABSPATH') ) exit; ?>
<?php
/**
 * Template Name: How It Works
 */
?>
<?php get_header(); ?>

<?php remove_filter('acf_the_content', 'wpautop'); ?>

<?php while ( have_posts() ) :
 			the_post();

?>

            <section class="section-intro">
				<div class="container section-intro__container">
					<div class="section-intro__content">
						<div class="text-styled"><?php the_field('how-it-works-page-title2'); ?></div> 
						<?php the_title( '<h1>', '</h1>' ); ?>

						<div class="heading-3 section-intro__caption">
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

						<a href="<?php echo Fortess\Common\Contact::get_url(); ?>" class="btn"><?php esc_html_e( 'Contact us', THEME_TEXTDOMAIN ); ?></a>
					</div>

                    <div class="section-intro__col">
                        <div class="section-intro__img section-intro__img_lg">
							<img srcset="<?php echo get_template_directory_uri(); ?>/assets/img/how-it-work-sm.png 1000w,
							             <?php echo get_template_directory_uri(); ?>/assets/img/how-it-work.png 1760w"
							     sizes="(max-width: 767px) 500px,
							            1760px"
							     src="<?php echo get_template_directory_uri(); ?>/assets/img/how-it-work.png" decoding="async" loading="lazy" width="880" height="542" alt="">
						</div>
					</div>
                    
				</div>
			</section><!-- /.section-intro -->
            
            <div class="section-wrap">

				<div class="gradient-center-right-2"></div>
				<div class="gradient-bottom"></div>
				<div class="gradient-center-left"></div>
            
            
            <?php if (have_rows('how-it-works-security-guarantee-options')) : ?>

			<section class="section pb-45">
				<div class="container">
					<div class="section-header section-header_full">
						<div class="text-styled"><?php the_field('how-it-works-security-guarantee-title_2'); ?></div>
						<h2 class="mb-10"><?php the_field('how-it-works-security-guarantee-title'); ?></h2>
					</div>


					<div class="grid grid-md-4 grid-xs-2 grid-px-sm grid-mb-xl">
                    
                        <?php while( have_rows('how-it-works-security-guarantee-options')): the_row();  ?>
                    
						<div class="grid__col">
							<div class="benefit">
                            
                                
                                <?php $image = get_sub_field('how-it-works-security-guarantee-option-image'); ?>  
                                    
                                <?php if ($image) : ?>
                                    
                                 <?php $image_url  = wp_get_attachment_image_src( $image,'full', true ); ?> 
                            
								<div class="benefit__icon">
									<div class="benefit__icon-elem">
										<img src="<?php echo $image_url[0]; ?>" decoding="async" loading="lazy" alt="<?php echo esc_attr( apply_filters( 'the_title', get_sub_field('how-it-works-security-guarantee-option-title') ) ); ?>">
									</div>
								</div>
                                
                                <?php endif; ?>
                                
								<h3 class="benefit__title"><?php the_sub_field('how-it-works-security-guarantee-option-title'); ?></h3>
								<div class="benefit__content color-opacity">
									<?php the_sub_field('how-it-works-security-guarantee-option-descr'); ?>
								</div>
							</div>
						</div>
                        
                        <?php endwhile; ?>
					</div>
				</div>
			</section><!-- /.section -->
            
            <?php endif; ?>


			<section class="section-elem">
				<div class="container section-elem__container">
					<div class="section-elem__body">
						<div class="text-styled"><?php the_field('how-it-works-fortress-cloud-firewall-title_2'); ?></div>

						<div class="heading-md"><?php the_field('how-it-works-fortress-cloud-firewall-title'); ?></div>

						<p class="color-opacity">
							<?php the_field('how-it-works-fortress-cloud-firewall-descr'); ?>
						</p>
					</div>

					<div class="section-elem__col">
						<picture>
						    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/img-sm.png" media="(max-width: 991px)">
						    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/img-2x.png">
						    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/img-2x.png" decoding="async" loading="lazy" width="963" height="682" alt="">
						</picture>
					</div>
				</div>
			</section><!-- /.section-elem -->


            <?php if (have_rows('what_does_fortressone_do-options')) : ?>

			<section class="section">
				<div class="container">
					<div class="heading-1 text-center mb-45"><?php the_field('what_does_fortressone_do-title'); ?></div>

					<div class="grid grid-sm-3">
                    
                        <?php while( have_rows('what_does_fortressone_do-options')): the_row();  ?>
                    
						<div class="grid__col">
							<div class="advantages">
								<div class="advantages__header">
                                
                                    <?php $image = get_sub_field('what_does_fortressone_do-option-image'); ?>  
                                    
                                    <?php if ($image) : ?>
                                    
                                    <?php $image_url  = wp_get_attachment_image_src( $image,'full', true ); ?> 
                                
									<div class="advantages__icon">
										<img src="<?php echo $image_url[0]; ?>" decoding="async" loading="lazy" alt="<?php echo esc_attr( apply_filters( 'the_title', get_sub_field('what_does_fortressone_do-option-title') ) ); ?>">
									</div>
                                    
                                    <?php endif; ?>
                                    
									<div class="advantages__title heading-3"><?php the_sub_field('what_does_fortressone_do-option-title'); ?></div>
								</div>
								<div class="advantages__content">
									<?php the_sub_field('what_does_fortressone_do-option-descr'); ?>
								</div>
							</div>
						</div>
                        
                        <?php endwhile; ?>

					</div>

				</div>
			</section><!-- /.section -->
            
            <?php endif; ?>
            
            <?php if( have_rows('how-it-works-groups') ): ?>

			<section class="section">
				<div class="media-box">
					<img srcset="<?php echo get_template_directory_uri(); ?>/assets/img/group/media.png, <?php echo get_template_directory_uri(); ?>/assets/img/group/media-2x.png 2x" src="<?php echo get_template_directory_uri(); ?>/assets/img/group/media.png" alt="" decoding="async" loading="lazy" width="1404" height="440">
					<div class="media-box__group">
                    
                        <?php $i = 1; ?>
                        
                        <?php while( have_rows('how-it-works-groups')): the_row();  ?>
                        
                        <?php $video = get_sub_field('how-it-works-group-video'); ?>
    
						<div class="media-box__item js-tab-<?php echo $i; ?> <?php if ($i == 1) {?>is-active<?php } ?>">
                            <?php if ($video) : ?>
							<video autoplay loop muted playsinline>
							  <source src="<?php echo $video['url']; ?>" type="video/mp4">
							</video>
                            <?php endif; ?>
						</div>
                        
                        <?php $i++; ?>
                            
                        <?php endwhile; ?>
					</div>

					<div class="media-box__logo">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/img/skyFort-logo.svg" decoding="async" loading="lazy" alt="">
					</div>
				</div>

				<div class="container text-center">
					<div class="tabs tabs_mt">
						<div class="tabs__list">
                        
                            <?php $i = 1; ?>
                        
                            <?php while( have_rows('how-it-works-groups')): the_row();  ?>
                        
							<div class="tabs__list-item <?php if ($i == 1) {?>is-active<?php } ?>" data-name="js-tab-<?php echo $i; ?>"><?php the_sub_field('how-it-works-group-title'); ?></div>
                            
                            <?php $i++; ?>
                            
                            <?php endwhile; ?>
						</div>

						<div class="tabs__body">
                        
                            <?php $i = 1; ?>
                        
                            <?php while( have_rows('how-it-works-groups')): the_row();  ?>
                        
							<div class="tabs__content js-tab-<?php echo $i; ?> <?php if ($i == 1) {?>is-active<?php } ?>">
								<div class="tabs__content-animate">
									<?php the_sub_field('how-it-works-group-description'); ?>
								</div>
							</div>
                            
                            <?php $i++; ?>
                            
                            <?php endwhile; ?>
						</div>
					</div>
				</div>
			</section>	
            
            <?php endif; ?>		

			<section class="section-info">
				<div class="container">
					<div class="app-box">
						<div class="app-box__body">
							<div class="text-styled mb-15"><?php the_field('how-it-works-mobile-app-title_2'); ?></div>
							<div class="heading-1 mb-15"><?php the_field('how-it-works-mobile-app-title'); ?></div>

							<div class="app-box__content color-opacity">
								<?php the_field('how-it-works-mobile-app-descr'); ?>
							</div>

							<div class="button-group button-group_styled">
                            
                                <?php if (get_field('how-it-works-mobile-app-google-play-app')) : ?>
                            
								<div class="button-group__item">
									<a href="<?php the_field('how-it-works-mobile-app-google-play-app'); ?>" class="btn-square">
										<span class="btn-square__icon">
											<img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/google-play.svg" decoding="async" loading="lazy" alt="">
										</span>
										<span class="btn-square__content">
											<span class="btn-square__txt"><?php esc_html_e( 'GET IT ON', THEME_TEXTDOMAIN ); ?></span>
											<span class="btn-square__title"><?php esc_html_e( 'Google Play', THEME_TEXTDOMAIN ); ?></span>
										</span>
									</a>
								</div>
                                
                                <?php endif; ?>
                                
                                <?php if (get_field('how-it-works-mobile-app-store')) : ?>

								<div class="button-group__item">
									<a href="<?php the_field('how-it-works-mobile-app-store'); ?>" class="btn-square">
										<span class="btn-square__icon">
											<img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/apple.svg" decoding="async" loading="lazy" alt="">
										</span>
										<span class="btn-square__content">
											<span class="btn-square__txt"><?php esc_html_e( 'Download on the', THEME_TEXTDOMAIN ); ?></span>
											<span class="btn-square__title"><?php esc_html_e( 'App Store', THEME_TEXTDOMAIN ); ?></span>
										</span>
									</a>
								</div>
                                
                                <?php endif; ?>
                                
							</div>
						</div>

						<div class="app-box__media">
							<picture>
							    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/devices.png" media="(max-width: 767px)">
							    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/devices-2x.png">
							    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/devices-2x.png" decoding="async" loading="lazy" alt="">
							</picture>
						</div>
					</div>
				</div>
			</section>


            <?php if( have_rows('lets-compare-options') ): ?>

			<section class="section-default">
				<div class="container">
					<div class="heading-1 text-center mb-60"><?php the_field('lets-compare-title'); ?></div>

					<div class="compare">
						<div class="compare__row compare__hidden-mobile">
							<div class="compare__col"></div>
							<div class="compare__col">
								<div class="logo-line">
									<div class="logo-line__icon">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-1.svg" decoding="async" loading="lazy" alt="">
									</div>
									<div class="font-lg"><?php esc_html_e( 'SkyFort firewall', THEME_TEXTDOMAIN ); ?></div>
								</div>
							</div>
							<div class="compare__col">
								<div class="font-lg"><?php esc_html_e( 'Antivirus + VPN', THEME_TEXTDOMAIN ); ?></div>
							</div>
						</div>
                        
                        <?php while( have_rows('lets-compare-options')): the_row();  ?>

						<div class="compare__row">
							<div class="compare__col">
								<div class="option-line">
                                
                                    <?php $image = get_sub_field('lets-compare-option-image'); ?>  
                                    
                                    <?php if ($image) : ?>
                                    
                                    <?php $image_url  = wp_get_attachment_image_src( $image,'full', true ); ?>  
                                
									<div class="option-line__icon">
										<img src="<?php echo $image_url[0]; ?>" decoding="async" loading="lazy" alt="<?php echo esc_attr( apply_filters( 'the_title', get_sub_field('lets-compare-option-title') ) ); ?>">
									</div>
                                    
                                    <?php endif; ?>
                                    
									<div class="option-line__txt"><?php the_sub_field('lets-compare-option-title'); ?></div>
								</div>
							</div>
							<div class="compare__col">
								<div class="compare__group">
									<div class="compare__group-item compare__visible-mobile">
										<div class="logo-line">
											<div class="logo-line__icon">
												<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-1.svg" decoding="async" loading="lazy" alt="">
											</div>
											<div class="font-sm"><?php esc_html_e( 'SkyFort firewall', THEME_TEXTDOMAIN ); ?></div>
										</div>
									</div>
									<div class="compare__group-item">
										<div class="color-opacity">
										   <?php the_sub_field('lets-compare-option-skyfort-firewall'); ?>
										</div>
									</div>
								</div>
							</div>
							<div class="compare__col">
								<div class="compare__group">
									<div class="compare__group-item compare__visible-mobile">
										<div class="font-sm"><?php esc_html_e( 'Antivirus + VPN', THEME_TEXTDOMAIN ); ?></div>
									</div>
									<div class="compare__group-item">
										<div class="color-opacity">
											<?php the_sub_field('lets-compare-option-antivirus-vpn'); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
                        
                        <?php endwhile; ?>
                        
					</div>												
				</div>
			</section>
            
            <?php endif; ?>
            
                        
            	</div><!-- /.section-wrap -->
            
<?php

 		endwhile;
        
        add_filter('acf_the_content', 'wpautop');
        
 get_sidebar();
get_footer();