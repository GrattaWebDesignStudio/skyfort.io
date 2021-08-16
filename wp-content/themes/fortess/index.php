<?php if ( !defined('ABSPATH') ) exit; ?>
<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fortess
 */

get_header();
?>
<?php global $wp_query; ?>

<?php global $query_string; ?>

<?php $queried_object = get_queried_object(); ?>

<?php
      if (isset($_REQUEST['page'])) {
           $the_page = intval($_REQUEST['page']);  
      } elseif ( get_query_var('paged') ) {
           $the_page = get_query_var('paged');
      } elseif ( get_query_var('page') ) {
           $the_page = get_query_var('page');
      } else {
          $the_page = 1;
      }
?>

<?php if ($the_page == 1) : ?>

<?php get_header(); ?>

			<div class="content-main">

				<div class="container">
					<div class="mb-60">
						<div class="text-styled"><?php esc_html_e( 'Fortress.ai articles', THEME_TEXTDOMAIN ); ?></div>

						<h1 class="heading-lg"><?php single_post_title(); ?></h1>

						<div class="max-w color-opacity">
						      <?php echo  apply_filters( 'the_content', get_queried_object()->post_content); ?>
						</div>
					</div>
<?php endif; ?>                    
                    <?php if ( have_posts() ) : ?>
<?php if ($the_page == 1) : ?>
					<div class="grid grid-md-3 grid-xs-2">
<?php endif; ?>                                   
                     <?php $i = 0; ?>
                    
                     <?php while ( have_posts() ) : the_post(); ?>
                     
                        <?php if ($i == 0 && $the_page == 1) { ?>
                     
						<div class="grid__col grid__col-full">
							<article class="blog-preview blog-preview_line">
                            
                                <?php if( has_post_thumbnail() ) { ?>
                            
								<a href="<?php echo esc_url( get_permalink() ); ?>" class="blog-preview__img">
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
								</a>
                                
                                <?php } ?>
                                
								<div class="blog-preview__body">
									<div class="blog-preview__header">
										<div class="blog-preview__row">
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
										<div class="heading-3 blog-preview__title">
											<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
										</div>
									</div>

									<div class="blog-preview__content color-opacity">
										<?php the_content(); ?>
									</div>
								</div>
							</article>
						</div>
                        
                        <?php } else { ?>

						<div class="grid__col">
							<article class="blog-preview">
                                <?php if( has_post_thumbnail() ) { ?>
								<a href="<?php echo esc_url( get_permalink() ); ?>" class="blog-preview__img">
									<?php
					                           the_post_thumbnail(
						                          'post-thumbnail',
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
								</a>
                                <?php } ?>
								<div class="blog-preview__body">
									<div class="blog-preview__header">
										<div class="blog-preview__row">
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
										<div class="heading-3 blog-preview__title">
											<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
										</div>
									</div>

									<div class="blog-preview__content color-opacity">
										<?php the_content(); ?>
									</div>
								</div>
							</article>
						</div>
                        
                        <?php } ?>
                        
                        <?php $i++; ?>
                        
                       <?php endwhile; ?>
                       
<?php if ($the_page == 1) : ?>
					</div><!-- /.grid -->
                    
                    
                    <?php
                        $total_pages = $wp_query->max_num_pages;
                    ?>
                    
                    <?php if ($total_pages > $the_page) : ?>
                    
                    <?php 
                        global $wp;

                        $current_url =  home_url( $wp->request );
                        
                        $position = strpos( $current_url , '/page' );
                        
                        $nopaging_url = ( $position ) ? substr( $current_url, 0, $position ) : $current_url;
                    ?>
                    
					<div class="mt-20 text-center">
						<a href="#" class="btn" data-next-page="<?php echo ($the_page + 1); ?>" data-total-pages="<?php echo $total_pages; ?>" data-page-url="<?php echo $nopaging_url; ?>"><?php esc_html_e( 'Load more', THEME_TEXTDOMAIN ); ?></a>
					</div>
                    <?php endif; ?>
<?php endif; ?>                    
                    <?php endif; ?>
<?php if ($the_page == 1) : ?>                    
				</div>

			</div><!-- /.content-main -->
	<?php
 get_sidebar();
get_footer();
endif; 