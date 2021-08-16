<?php if ( !defined('ABSPATH') ) exit; ?>
<?php get_header(); ?>

<?php while ( have_posts() ) :
 			the_post();

?>

<?php 

    global $post;
    
    $category = reset(get_the_category($post->ID));
    
    $category_id = $category->cat_ID;
?>

			<div class="content-main" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="container">
					<div class="content-main__header">
						<a href="<?php echo get_category_link( $category_id ); ?>" class="link-main">
							<span class="link-main__icon">
								<svg width="31" height="31"><use xlink:href="#svg-arrow"></use></svg>
							</span>
							<span class="link-main__txt"><?php esc_html_e( 'Blog', THEME_TEXTDOMAIN ); ?></span>
						</a>
					</div>

					<div class="width-centered">
						<div class="blog-main">
							<div class="blog-main__header">
                                <?php
                                    if ( is_singular() ) :
		                                    the_title( '<h1 class="blog-main__title">', '</h1>' );
		                              else :
			                                 the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	                               	endif;
                                ?>
								<div class="blog-main__time">
								    <?php 
                                                $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	                                           	$time_string = sprintf(
		                                                              	$time_string,
		                                                              	esc_attr( get_the_date( DATE_W3C ) ),
		                                                              	esc_html( get_the_date() )
		                                                            );
                                            
                                    ?>
									<?php echo  $time_string; ?>
								</div>
							</div>
                            
                            <?php if( has_post_thumbnail() ) { ?>
							<figure class="figure blog-main__img">
							   <?php
					                           the_post_thumbnail(
						                          'post-thumbnail-medium',
						                          array(
                                                         'class' => 'img-fluid',
							                             'alt' => the_title_attribute(
								                                 array(
									                                   'echo' => false,
								                                )
							                              ),
						                          )
					                           );
			                    ?>
							    <?php /* <figcaption class="figure__caption color-opacity">Image by Jimmie Gardners</figcaption>*/ ?>
							</figure>	
                            <?php } ?>
                            
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
						</div><!-- /.blog-main -->
                        
                        <?php $post_tags = wp_get_post_tags(get_the_ID()); ?>
                        
                        <?php if ($post_tags) : ?>
   
						<ul class="tags-list">
                            <?php foreach ($post_tags as $post_tag) : ?>
							<li class="tags-list__item">
								<a href="<?php echo get_tag_link($post_tag); ?>" class="tag">#<?php echo $post_tag -> name; ?></a>
							</li>
                            <?php endforeach; ?>
						</ul>
                        
                        <?php endif; ?>
                        
					</div><!-- /.width-centered -->
			
				</div>

			</div><!-- /.content-main -->

            <?php $previous = get_previous_post(); ?>

            <?php $next = get_next_post(); ?>
            
            <?php if ($previous || $next) : ?>
      
			<div class="blog-pagination hidden-sm">
				<div class="container blog-pagination__container">

                    <?php if ($previous) : ?>
                
					<div class="blog-pagination__item">
						<div class="blog-pagination__caption"><?php esc_html_e( 'Previous article', THEME_TEXTDOMAIN ); ?></div>
						<a href="<?php echo get_the_permalink($previous -> ID); ?>" class="link-main">
							<span class="link-main__icon">
								<svg width="31" height="31"><use xlink:href="#svg-arrow"></use></svg>
							</span>
							<span class="link-main__txt">
								<?php echo $previous -> post_title; ?>
							</span>
						</a>
					</div>
                    
                    <?php endif; ?>
                    
                    <?php if ($next) : ?>

					<div class="blog-pagination__item blog-pagination__next">
						<div class="blog-pagination__caption"><?php esc_html_e( 'Next article', THEME_TEXTDOMAIN ); ?></div>
						<a href="<?php echo get_the_permalink($next -> ID); ?>" class="link-main link-main_next">
							<span class="link-main__icon">
								<svg width="31" height="31"><use xlink:href="#svg-arrow"></use></svg>
							</span>
							<span class="link-main__txt">
								<?php echo $next -> post_title; ?>
							</span>
						</a>
					</div>
                    
                    <?php endif; ?>
                    
				</div>
			</div><!-- /.blog-pagination -->
            
            <?php endif; ?>
            
<?php

 		endwhile;
 get_sidebar();
get_footer();