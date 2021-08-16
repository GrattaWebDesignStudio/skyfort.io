<?php if ( !defined('ABSPATH') ) exit; ?>
<?php
/**
 * Template Name: Product
 */
?>
<?php get_header(); ?>

<?php while ( have_posts() ) :
 			the_post();

?>

            <?php 
            /*
			<div class="container pt-md-30">
				<a href="<?php echo Fortess\Common\Pricing::get_url(); ?>" class="link-main">
					<span class="link-main__icon">
						<svg width="31" height="31" viewBox="0 0 31 32">
							<path d="M15.4997 28.9168C22.6334 28.9168 28.4163 23.1338 28.4163 16.0002C28.4163 8.86648 22.6334 3.0835 15.4997 3.0835C8.366 3.0835 2.58301 8.86648 2.58301 16.0002C2.58301 23.1338 8.366 28.9168 15.4997 28.9168Z" stroke-width="2.58333" stroke-linecap="round" stroke-linejoin="round"></path>
							<path d="M15.4997 10.8335L10.333 16.0002L15.4997 21.1668" stroke-width="2.58333" stroke-linecap="round" stroke-linejoin="round"></path>
							<path d="M20.6663 16H10.333" stroke-width="2.58333" stroke-linecap="round" stroke-linejoin="round"></path>
						</svg>
					</span>
					<span class="link-main__txt"><?php esc_html_e( 'Products', THEME_TEXTDOMAIN ); ?></span>
				</a>
			</div>		
            */
            ?>	
            
            <section class="section-intro">
				<div class="container section-intro__container">
					<div class="section-intro__content">
						<div class="text-styled"><?php the_field('product-title-2'); ?></div> 
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

						<a href="<?php the_field('product-title-button-link'); ?>" class="btn"><?php the_field('product-title-button-title'); ?></a>
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
										<img src="<?php echo $image_url[0]; ?>" decoding="async" loading="lazy" alt="<?php echo esc_attr( get_sub_field('advantage-title')); ?>">
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
                    
                    <?php if (get_field('business-steps-keeping-button-title') && get_field('business-steps-keeping-button-link')) : ?>

					<div class="text-center mt-25">
						<a href="<?php echo esc_url(get_field('business-steps-keeping-button-link')); ?>" class="btn"><?php the_field('business-steps-keeping-button-title'); ?></a>
					</div>
                    
                    <?php endif; ?>
				</div>
			</section><!-- /.section -->
            
            			<section class="section-work">
				<div class="container">
					<div class="section-work__container">
						<div class="section-work__content">
							<div class="text-styled"><?php the_field('how-it-works-title_2'); ?></div>

							<h2 class="mb-25"><?php the_field('how-it-works-title'); ?></h2>

							<div class="color-opacity">
								<?php the_field('how-it-works-descr'); ?>
							</div>
						</div>
                        
                        <?php $i = 0; ?>
                        
                        <?php while( have_rows('items')): the_row();  ?>
                        
                        <?php if ($i == 0 ) { ?>

						<div class="cloud-box">
							<div class="cloud-box__top">
								<picture>
								    <source srcset="<?php echo get_stylesheet_directory_uri();?>/assets/img/work/laptop-sm.png" media="(max-width: 900px)">
								    <source srcset="<?php echo get_stylesheet_directory_uri();?>/assets/img/work/laptop.png">
								    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/work/laptop.png" decoding="async" loading="lazy" alt="">
								</picture>

								<div class="notification-elem position-1">
									<button class="notification-elem__btn"><span></span></button>
									<div class="notification-elem__body">
										<div class="heading-3 mb-10"><?php the_sub_field('item-title'); ?></div>
										<div class="notification-elem__content color-opacity">
											<?php the_sub_field('item-description'); ?>
										</div>
									</div>
								</div>
							</div>

							<div class="cloud-box__center">
								<picture>
								    <source srcset="<?php echo get_stylesheet_directory_uri();?>/assets/img/work/cloud-sm.png" media="(max-width: 900px)">
								    <source srcset="<?php echo get_stylesheet_directory_uri();?>/assets/img/work/cloud.png">
								    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/work/cloud.png" decoding="async" loading="lazy" alt="">
								</picture>

								<div class="notification-elem-group">
                                
                            <?php } elseif ($i < 4) { ?>
									<div class="notification-elem position-body-left">
										<button class="notification-elem__btn"><span></span></button>
										<div class="notification-elem__body">
											<div class="heading-3 mb-10"><?php the_sub_field('item-title'); ?></div>
											<div class="notification-elem__content color-opacity">
												<?php the_sub_field('item-description'); ?>
											</div>
										</div>
									</div>
                            <?php } elseif ($i == 4) { ?>
                                 </div>
							</div>

							<div class="cloud-box__bottom">
								<picture>
								    <source srcset="<?php echo get_stylesheet_directory_uri();?>/assets/img/work/internet-sm.png" media="(max-width: 900px)">
								    <source srcset="<?php echo get_stylesheet_directory_uri();?>/assets/img/work/internet.png">
								    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/work/internet.png" decoding="async" loading="lazy" alt="">
								</picture>

								<div class="notification-elem position-3 position-body-left">
									<button class="notification-elem__btn"><span></span></button>
									<div class="notification-elem__body">
										<div class="heading-3 mb-10"><?php the_sub_field('item-title'); ?></div>
										<div class="notification-elem__content color-opacity">
											<?php the_sub_field('item-description'); ?>
										</div>
									</div>
								</div>
							</div>
                            <?php } ?>
                            
                            <?php $i++; ?>
                            
                          <?php endwhile; ?>  
						</div>
					</div>
				</div>
			</section><!-- /.section-work -->


			<section class="section">
				<div class="container product-features">
					<div class="section-header section-header_full">
						<div class="text-styled"><?php the_field('how-skyfort-protect-title_2'); ?></div>
						<h2 class="mb-10"><?php the_field('how-skyfort-protect-title'); ?></h2>
					</div>


					<div class="grid grid-lg-4 grid-md-3 grid-xs-2 grid-px-sm grid-mb-xl">
                    
                        <?php while( have_rows('benefits')): the_row();  ?>
						<div class="grid__col">
							<div class="benefit">
                                
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
            
            <section class="section-elem">
					<div class="container">
						<div class="section-header section-header_full mb-110">
							<div class="text-styled"><?php the_field('how-it-works-fortress-cloud-firewall-title_2'); ?></div>
							<h2 class="heading-1 mb-10"><?php the_field('how-it-works-fortress-cloud-firewall-title'); ?></h2>
						</div>

						<div class="section-elem__container">
							<div class="section-elem__body">
								<div class="grid grid-xs-2 grid-px-sm">
                                
                                     <?php while( have_rows('how-it-works-fortress-cloud-firewall-options')): the_row();  ?>
                                
									<div class="grid__col">
										<div class="benefit">
                                        
                                            <?php $image = get_sub_field('how-it-works-fortress-cloud-firewall-option-image'); ?>  
                                    
                                            <?php if ($image) : ?>
                                    
                                            <?php $image_url  = wp_get_attachment_image_src( $image,'full', true ); ?> 
                                        
											<div class="benefit__icon">
												<div class="benefit__icon-elem">
                                                        <img src="<?php echo $image_url[0]; ?>" decoding="async" loading="lazy" alt="">
												</div>
											</div>
                                            
                                            <?php endif; ?>
                                            
											<h3 class="benefit__title"><?php the_sub_field('how-it-works-fortress-cloud-firewall-option-title'); ?></h3>
											<div class="benefit__content color-opacity">
													<?php the_sub_field('how-it-works-fortress-cloud-firewall-option-descr'); ?>
											</div>
										</div>
									</div>
                                    
                                    <?php endwhile; ?>

								</div>
							</div>
                            
                            <?php $image = get_field('how-it-works-fortress-cloud-firewall-img'); ?>  
                            
                            <?php $image_mobile = get_field('how-it-works-fortress-cloud-firewall-img-2'); ?>  
    
                            <div class="section-elem__col">
								<img srcset="<?php echo wp_get_attachment_image_src( $image,'full', true )[0]; ?>,
								             <?php echo wp_get_attachment_image_src( $image_mobile,'full', true )[0]; ?> 2x"
								     src="<?php echo wp_get_attachment_image_src( $image,'full', true )[0]; ?>" decoding="async" loading="lazy" width="585" height="585" alt=""> 
							</div>
						</div>
					</div>
				</section><!-- /.section-elem -->
            
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

			<section class="section-info">
				<div class="container">
					<div class="app-box">
						<div class="app-box__body">
							<div class="text-styled mb-15"><?php the_field('mobile-app-title_2'); ?></div>
							<div class="heading-1 mb-15"><?php the_field('mobile-app-title'); ?></div>

							<div class="app-box__content color-opacity">
								<?php the_field('mobile-app-description'); ?>
							</div>

							<div class="button-group button-group_styled">
                            
                                <?php if (get_field('mobile-app-google-play')) : ?>
								<div class="button-group__item">
									<a href="<?php the_field('mobile-app-google-play'); ?>" class="btn-square">
										<span class="btn-square__icon">
											<img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/svg/google-play.svg" decoding="async" loading="lazy" alt="">
										</span>
										<span class="btn-square__content">
											<span class="btn-square__txt"><?php esc_html_e( 'GET IT ON', THEME_TEXTDOMAIN ); ?></span>
											<span class="btn-square__title"><?php esc_html_e( 'Google Play', THEME_TEXTDOMAIN ); ?></span>
										</span>
									</a>
								</div>
                                <?php endif; ?>

                                <?php if (get_field('mobile-app-app-store')) : ?>
								<div class="button-group__item">
									<a href="<?php the_field('mobile-app-app-store')?>" class="btn-square">
										<span class="btn-square__icon">
											<img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/svg/apple.svg" decoding="async" loading="lazy" alt="">
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
							    <source srcset="<?php echo get_stylesheet_directory_uri();?>/assets/img/devices.png" media="(max-width: 767px)">
							    <source srcset="<?php echo get_stylesheet_directory_uri();?>/assets/img/devices-2x.png">
							    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/devices-2x.png" decoding="async" loading="lazy" alt="">
							</picture>
						</div>
					</div>
				</div>
			</section>
            
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
            
            </div><!-- /.section-wrap -->
<?php

 		endwhile;
 get_sidebar();
get_footer();