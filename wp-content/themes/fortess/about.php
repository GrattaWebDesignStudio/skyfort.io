<?php if ( !defined('ABSPATH') ) exit; ?>
<?php
/**
 * Template Name: About
 */
?>

<?php get_header(); ?>

<?php while ( have_posts() ) :
 			the_post();

?>
			<div class="content-main content-main_py">

				<div class="container">
					<div class="content-block">
						<div class="text-styled mb-15"><?php the_field('about-page-title2'); ?></div>
                        
                        <?php the_title( '<h1 class="heading-lg heading-max-w mb-30">', '</h1>' ); ?>
    
                        <?php $content = get_post_field( 'post_content', get_the_ID() ); ?>

                        <?php $content_parts = get_extended( $content ); ?>

						<div class="info-box">
							<div class="info-box__item">
								<div class="font-lg">
									<?php echo  apply_filters( 'the_content', $content_parts['main']); ?>
								</div>
							</div>

							<div class="info-box__item">
								<div class="color-opacity max-w-md info-box__offset">
									<?php echo  apply_filters( 'the_content', $content_parts['extended']); ?>
								</div>
							</div>
						</div>
					</div><!-- /.content-block -->


					<div class="content-block">
						<div class="team-box">
							<h2 class="heading-1 team-box__title"><?php the_field('team-title'); ?></h2>

							<div class="info-box mb-60">
								<div class="info-box__item">
									<div class="font-lg">
										<?php the_field('team-descr-left'); ?>
									</div>
								</div>

								<div class="info-box__item">
									<div class="color-opacity max-w-md">
										<?php the_field('team-descr-right'); ?>
									</div>
								</div>
							</div>	

							<div class="grid grid-lg-4 grid-sm-3 grid-xs-2 grid-mb-lg">
                            
                                <?php while( have_rows('team')): the_row();  ?>  
                                
                                <?php $team_image = get_sub_field('team-image'); ?>
                            
								<div class="grid__col">
									<div class="team">
										<div class="team__img">
                                        
                                            <?php if ($team_image) : ?>
                                            
                                            <?php $image_url  = wp_get_attachment_image_src( $team_image,'full', true ); ?>  
                                        
											<img src="<?php echo $image_url[0]; ?>" alt="<?php echo esc_attr( apply_filters( 'the_title', get_sub_field('team-name') ) ); ?>" decoding="async" loading="lazy">
                                                 
                                            <?php endif; ?>      
										</div>
										<div class="team__content">
											<div class="team__title"><?php the_sub_field('team-name'); ?></div>
											<div class="team__txt color-opacity"><?php the_sub_field('team-position'); ?></div>
										</div>
									</div>
								</div>
                                
                                <?php endwhile; ?>

								<div class="grid__col">
									<div class="team">
										<div class="team__join">
											<div class="heading-2 team__join-title"><?php the_field('team-title2'); ?></div>
											<div class="color-opacity"><?php the_field('team-title3'); ?></div>
											<a href="mailto:<?php the_field('team-email'); ?>"><?php the_field('team-email'); ?></a>
										</div>
									</div>
								</div>
							</div>		
						</div>
					</div><!-- /.content-block -->


					<div class="content-block">
						<div class="text-styled"><?php the_field('about-working-from-home-title-2'); ?></div>

						<div class="grid grid-md-2">
							<div class="grid__col">
                            
                                <h2 class="heading-1 mb-10"><?php the_field('about-working-from-home-title'); ?></h2>

								<div class="max-w-md-2">
									<p class="color-opacity">
										<?php the_field('about-working-from-home-descr'); ?>
									</p>
								</div>		
							</div>
                            
                            <?php $about_image = get_field('about-working-from-home-image'); ?>
                            
                            <?php if ($about_image) : ?>
                            
                            <?php $image_url  = wp_get_attachment_image_src( $about_image,'full', true ); ?>  

							<div class="grid__col">
								<div class="img-box img-box_styled">
									<img src="<?php echo $image_url[0]; ?>" alt="<?php echo esc_attr( apply_filters( 'the_title', get_field('about-working-from-home-title') ) ); ?>" decoding="async" loading="lazy">
								</div>
							</div>
                            
                            <?php endif; ?>
						</div>
					</div><!-- /.content-block -->
				</div>

			</div><!-- /.content-main -->
<?php

 		endwhile;
 get_sidebar();
get_footer();