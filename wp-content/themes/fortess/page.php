<?php if ( !defined('ABSPATH') ) exit; ?>
<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fortess
 */

get_header();
?>

<?php $current_post_id = get_queried_object_id(); ?>

		<?php
		while ( have_posts() ) :
			the_post();

?>
            <?php if ( is_plugin_active("woocommerce/woocommerce.php") && is_user_logged_in() && is_account_page()) { ?>
                <div class="content-main content-main_pt">
            <?php } elseif ( is_plugin_active("woocommerce/woocommerce.php") && is_checkout()) { ?>
        	    <div id="post-<?php the_ID(); ?>" <?php post_class('content-main content-main_pt'); ?>>
            <?php } else { ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class('content-main'); ?>>
            <?php } ?>

				<div class="container">
                
                    <?php if ( is_plugin_active("woocommerce/woocommerce.php") && is_user_logged_in() && is_account_page()) { ?>
                        <div class="account-main">
						      <div class="account-main__header account-main__inner">
                                 <?php the_title( '<h1 class="heading-2 account-main__title">', '</h1>' ); ?>
						      </div>

						      <div class="account-main__body">
                              
                                    <?php the_content(); ?>
                                    
                              </div>
                        </div>
                    
                    <?php } elseif ($current_post_id == get_option('woocommerce_myaccount_page_id') || is_wc_endpoint_url() || is_checkout()) { ?>
                    
                        <?php
                                    if ( is_singular() ) :
		                                      	the_title( '<h1 class="blog-main__title">', '</h1>' );
		                              else :
			                                 the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	                               	endif;
                        ?>
                        
                         <?php the_content(); ?>
        
                    <?php } else { ?>
                        
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
                            
                            <?php
                                         // If comments are open or we have at least one comment, load up the comment template.
			                              if ( comments_open() || get_comments_number() ) :
				                                comments_template();
			                             endif;
                            ?>
                            
                            
					     </div><!-- /.blog-main -->

					   </div><!-- /.width-centered -->
  
                    <?php } ?>

				</div>

			</div><!-- /.content-main -->

<?php
		endwhile; // End of the loop.
?>
<?php
get_sidebar();
get_footer();
