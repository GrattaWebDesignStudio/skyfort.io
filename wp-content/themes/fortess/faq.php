<?php if ( !defined('ABSPATH') ) exit; ?>
<?php
/**
 * Template Name: FAQ
 */
?>

<?php get_header(); ?>

<?php while ( have_posts() ) :
 			the_post();

?>
			<div class="content-main">

				<div class="container">
					<div class="text-styled"><?php the_field('faq-page-title2'); ?></div>
                    
                    <?php the_title( '<h1 class="heading-lg mb-45">', '</h1>' ); ?>
                    
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

					<div class="grid grid-md-2 grid-mb-0 grid-px-lg">
                    
                        <?php $i = 0; ?>
                        
                        <?php $count = count(get_field('faq')); ?>

                        <?php while( have_rows('faq')): the_row();  ?>  
                        
                            <?php if ($i == 0 || ($i == ceil($count / 2))) : ?>
                                	<div class="grid__col">
                            <?php endif; ?>
                            
                            <div class="collapse">
								<div class="collapse__header">
									<div class="collapse__header-item">
										<div class="heading-3 collapse__title"><?php the_sub_field('faq-question'); ?></div>
									</div>
									<div class="collapse__circle"></div>
								</div>
								<div class="collapse__drop">
									<div class="collapse__content color-opacity">
										<?php the_sub_field('faq-answer'); ?>
									</div>
								</div>
							</div><!-- /.collapse -->
                            
                            <?php if (($i == ceil($count / 2) - 1) || ($i == $count - 1)) : ?>
                                    </div>
                            <?php endif; ?>
                        
                        <?php $i++; ?>
                        
                        <?php endwhile; ?>
 
					</div>			
				</div>

			</div><!-- /.content-main -->
<?php

 		endwhile;
 get_sidebar();
get_footer();