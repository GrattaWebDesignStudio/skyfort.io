<?php if ( !defined('ABSPATH') ) exit; ?>
<?php
/**
 * Template Name: Pricing
 */
?>
<?php get_header(); ?>

<?php while ( have_posts() ) :
 			the_post();

?>
			<div class="content-main">

				<div class="container">
					<div class="section-header">
						<div class="text-styled"><?php the_field('pricing-page-title2'); ?></div>
                        <?php the_title( '<h1>', '</h1>' ); ?>
					</div>
                    
                    <?php if ( get_field('promo_mode', 'options-settings')) : ?>
                    
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
                    
                    <?php endif; ?>
                    
                    <?php 
                             $args = array(
                                              'orderby'  => 'menu_order',
                                              'order' => 'ASC',  
                                              'status' => 'publish', 
                                              'limit' => -1
                                          );
                            $products = wc_get_products( $args );
                    ?>
                    
                    <?php if ($products) : ?>
                    
					<div class="price-grid grid grid-lg-3 grid-sm-2">
                    
                     <?php $i = 1; ?>
                    
                     <?php foreach ($products as $product) : ?>
                     
                        <?php $product_id = $product->get_id(); ?>
        
                        <?php $product_title = $product->get_title(); ?>
                        
                        <?php $product_features = wc_get_product_terms( $product_id, 'pa_features', array( 'fields' => 'names' ) ); ?>
                        
						<div class="grid__col">
							<div class="price-box">
								<div class="price-box__header">
									<h3 class="price-box__title"><?php echo $product_title; ?></h3>
                                    
                                    <?php if ($product->get_price()) : ?>                    
									<div class="price-box__price price-box__row">
										<div class="price-box__price-val"><?php echo $product->get_price(); ?></div>
										<div class="price-box__price-item">
											<div class="price-box__price-title"><?php echo get_woocommerce_currency(); ?></div>
                                            <?php if ( class_exists('\WC_Subscriptions_Product') && \WC_Subscriptions_Product::is_subscription( $product )) : ?>
											<div class="price-box__price-txt"><?php esc_html_e( 'Per', THEME_TEXTDOMAIN ); ?> <?php echo \WC_Subscriptions_Product::get_period( $product_id ); ?></div>
                                            <?php endif; ?>
										</div>
									</div>
                                    <?php endif; ?>
   
									<div class="price-box__txt"><?php echo apply_filters( 'the_excerpt', get_the_excerpt( $product_id ) ); ?></div>
								</div>
                                
                                <?php if ($product_features) : ?>
								<div class="price-box__body">

                                    <?php foreach ($product_features as $product_feature) : ?>
									<div class="feature-line">
										<div class="feature-line__icon">
											<img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/svg/check-2.svg" decoding="async" loading="lazy" alt="">
										</div>
										<div class="feature-line__txt"><?php echo $product_feature; ?></div>
									</div>
                                    <?php endforeach; ?>
								</div>
                                <?php endif; ?>
                                
								<div class="price-box__footer">
                                     <?php 
                                     if ( get_field('promo_mode', 'options-settings')) {
                                     ?>
                                         <a href="#modal-contact" class="btn <?php if ($i == 2) {?>btn_outline<?php } ?>btn_outline btn_fluid js-modal"><?php esc_html_e( 'Choose', THEME_TEXTDOMAIN ); ?> <?php echo $product_title; ?></a>
                                     <?php  
                                     } else {
                                            
                                          if ($product->get_price()) { ?>          
                                             <a href="<?php echo esc_url(wc_get_cart_url()); ?>?add-to-cart=<?php echo $product_id; ?>&quantity=1" class="btn <?php if ($i == 2) {?>btn_outline<?php } ?>btn_outline btn_fluid" data-product-id="<?php echo $product_id; ?>" data-variation-id="" data-quantity="1"><?php esc_html_e( 'Choose', THEME_TEXTDOMAIN ); ?> <?php echo $product_title; ?></a>
                                     <?php } else { ?>
                                             <a href="#modal-contact" class="btn <?php if ($i == 2) {?>btn_outline<?php } ?>btn_outline btn_fluid js-modal" data-product-id="<?php echo $product_id; ?>" data-variation-id="" data-quantity="1"><?php esc_html_e( 'Choose', THEME_TEXTDOMAIN ); ?> <?php echo $product_title; ?></a>    
                                            <?php }   
                                     }
                                     ?>
								</div>
							</div>
						</div>
                        
                        <?php $i++; ?>
                        
                       <?php endforeach; ?>
					</div>
                    
                    <?php endif; ?>
                    
				</div>

			</div><!-- /.content-main -->
            
            <?php if ( get_field('promo_mode', 'options-settings')) { ?>
            
            <section id="section-sign" class="section-sign">
				<div class="container">
					<div class="grid grid_center grid-md-2">
						<div class="grid__col">
							<div class="text-styled"><?php the_field('pricing-title'); ?></div>
							<div class="heading-1 mb-10"><?php the_field('pricing-title2'); ?></div>

							<div class="section-sign__info">
								<?php the_field('pricing-descr'); ?>
							</div>
						</div>

						<div class="grid__col">
							<?php  echo do_shortcode(get_field('contact_form_main_page_shortcode', 'options-settings')); ?>
						</div>		
					</div>
				</div>
			</section><!-- /.section-sign -->
            
            <?php } ?>
<?php

 		endwhile;
?>

		<div id="modal-contact" class="modal modal_styled">
			<div class="modal-overlay"></div>

			<div class="modal-content">
				<button type="button" class="modal-close js-modal-close"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/svg/close.svg" decoding="async" loading="lazy" alt=""></button>     
                <?php  echo do_shortcode(get_field('pricing_form_shortcode', 'options-settings')); ?>   
			</div>
		</div><!-- /.modal -->


		<div id="modal-notification" class="modal">
			<div class="modal-overlay"></div>

			<div class="modal-content">
				<button type="button" class="modal-close js-modal-close"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/svg/close.svg" decoding="async" loading="lazy" alt=""></button>
				<div class="modal-content__inner font-lg">
					<?php esc_html_e( 'Someone will be in touch with you shortly.', THEME_TEXTDOMAIN ); ?>
				</div>
			</div>
		</div><!-- /.modal -->

<?php
 get_sidebar();
get_footer();