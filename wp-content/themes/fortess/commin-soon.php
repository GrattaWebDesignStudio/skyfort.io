<?php if ( !defined('ABSPATH') ) exit; ?>
<?php
/**
 * Template Name: Comming Soon
 */
?>
<?php get_header('comminsoon'); ?>

<?php while ( have_posts() ) :
 			the_post();

?>

            <?php $post_id = get_the_ID(); ?>

            <section class="section-full">
				<div class="container section-full__container">
					<div class="section-full__content">
						<div class="text-styled"><?php the_field('coming-soon-page-title-2'); ?></div> 

                        <?php the_title( '<h1 class="heading">', '</h1>' ); ?>

						<div class="section-full__info">
							<?php the_content(); ?>
						</div>

                         <?php  echo do_shortcode(get_field('comming_soon_form_shortcode', 'options-settings')); ?>

						<div class="note"><?php the_field('coming-soon-page-descr-2'); ?></div>
					</div>

					<div class="section-full__col">
						<div class="section-title"><?php esc_html_e( 'SkyFort', THEME_TEXTDOMAIN ); ?></div>
						<div class="section-full__media">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/img-comminsoon.png" decoding="async" loading="lazy" alt="" width="961" height="751">
						</div>
					</div>
				</div>
			</section><!-- /.section-full -->


			<section class="section-work">
				<div class="container">
					<div class="logo-group logo-group_center logo-group_mb">
						<div class="logo-group__txt"><?php the_field('enterprise-grade-protection-title_2'); ?></div>
						<div class="logo-group__img">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/fortress-logo.svg" decoding="async" loading="lazy" alt="">
						</div>
					</div>
                    
                     <?php if (have_rows('enterprise-grade-protection-options')) : ?>
                    
					<div class="section-work__container">
                    
                        <?php $i = 0; ?>
                        
                        <?php $count = count(get_field('enterprise-grade-protection-options')); ?>
                    
                        <?php while( have_rows('enterprise-grade-protection-options')): the_row();  ?>  
                        
                        <?php if ($count - 1 == $i) { ?>

						<div class="section-work__bottom">
							<div class="heading-3"><?php the_sub_field('title'); ?></div>
							<div class="color-opacity"> 
								<?php the_sub_field('descr'); ?>
							</div>
						</div>	
                        
                        <?php } else { ?>
                  
						<div class="section-work__content">
                            <?php if ($i == 0) { ?>
							<div class="text-styled"><?php the_field('enterprise-grade-protection-title'); ?></div>
                            <?php } ?>
							<h2 class="section-work__title"><?php the_sub_field('title'); ?></h2>

							<div class="color-opacity">
								<?php the_sub_field('descr'); ?>
							</div>
						</div>
                        
                        <?php } ?>
                        
                        <?php if ($i ==0) : ?>
                        
						<div class="section-work__media">
						    <picture>
							    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/cloud-group-sm.png" media="(max-width: 767px)">
							    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/cloud-group.png">
							    <img srcset="<?php echo get_template_directory_uri(); ?>/assets/img/cloud-group.png" alt="" width="1170" height="712">
							</picture>
						</div>	
                        
                        <?php endif; ?>
                        
                        <?php $i++; ?>
                        
                        <?php endwhile ?>
					</div>
                    
                    <?php endif; ?>
				</div>
			</section><!-- /.section-work -->


			<section class="section-default">
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


			<section class="section-sign">
				<div class="container">
					<div class="grid grid_center grid-md-2">
						<div class="grid__col">
							<div class="text-styled"><?php the_field('coming-soon-lets-do-this-title'); ?></div>
							<div class="heading-1 mb-10"><?php the_field('coming-soon-lets-do-this-title_2'); ?></div>

							<div class="section-sign__info">
								<?php the_field('coming-soon-lets-do-this-description'); ?>
							</div>
						</div>

						<div class="grid__col">
							<div class="centered">
								 <?php  echo do_shortcode(get_field('comming_soon_form_shortcode', 'options-settings')); ?>
								<div class="note"><?php the_field('coming-soon-lets-do-this-description_2'); ?></div>
							</div>				
						</div>		
					</div>
				</div>
        </section><!-- /.section-sign -->
<?php

 		endwhile;
 get_sidebar();
get_footer('comminsoon');