<?php if ( !defined('ABSPATH') ) exit; ?>
<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fortess
 */

?>
        </div><!-- /.content-page -->
        
        <footer class="footer">
	<div class="container">
		<div class="footer__top footer__group">
			<div class="footer__group-item">
				<a href="<?php echo site_url('/'); ?>" class="logo">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/skyFort-logo.svg" decoding="async" loading="lazy" alt="">
				</a>
			</div>

            <?php
              $menu_name = 'menu-header';

              $locations = get_nav_menu_locations();

              if( $locations && isset($locations[ $menu_name ]) ) :

                   $menu = wp_get_nav_menu_object( $locations[ $menu_name ] ); 
                   
                   $menu_items = wp_get_nav_menu_items( $menu );
            ?> 
			<div class="footer__group-item">
				<ul class="nav-list nav-list__footer">
					<?php foreach ( (array) $menu_items as $key => $menu_item ) : ?>      

                        <?php $page_template = get_post_meta( $menu_item -> object_id, '_wp_page_template', true );?>

                        <li><a href="<?php echo $menu_item->url; ?>"><?php if ($page_template == 'business.php') { ?><span class="nav-list__label"><?php esc_html_e( 'new', THEME_TEXTDOMAIN ); ?></span> <?php } ?><?php echo $menu_item->title; ?></a></li>
                    <?php endforeach; ?>
				</ul>
			</div>
            <?php endif;?>
		</div>


		<div class="footer__bottom footer__group">
			<div class="footer__group-item">
				&copy; <?php echo date('Y'); ?> Fortress Artificial Intelligence Inc.
			</div>

			<div class="footer__group-item footer-first-mobile">
				<div class="footer__block">
					<div class="social-list social-list_center">
						<?php $url = get_field('link', 'options-settings');  ?>
                        <?php if ($url) : ?>
						<a href="<?php echo esc_url($url); ?>" class="social-list__item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/link.svg" decoding="async" loading="lazy" alt="">
						</a>
                        <?php endif; ?>
                        <?php $url = get_field('twitter', 'options-settings');  ?>
                        <?php if ($url) : ?>
						<a href="<?php echo esc_url($url); ?>" class="social-list__item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/twitter.svg" decoding="async" loading="lazy"> 
						</a>
                        <?php endif; ?>
                        <?php $url = get_field('instagram', 'options-settings');  ?>
                        <?php if ($url) : ?>
						<a href="<?php echo esc_url($url); ?>" class="social-list__item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/instagram.svg" decoding="async" loading="lazy">
						</a>
                        <?php endif; ?>
					</div>
                    
                    <?php
                    $menu_name = 'menu-footer';

                    $locations = get_nav_menu_locations();

                    if( $locations && isset($locations[ $menu_name ]) ) :

                        $menu = wp_get_nav_menu_object( $locations[ $menu_name ] ); 
                   
                        $menu_items = wp_get_nav_menu_items( $menu );
                    ?> 

					<div class="footer__links">
                        <?php foreach ( (array) $menu_items as $key => $menu_item ) : ?>      
						<a href="<?php echo $menu_item->url; ?>" class="footer__link"><?php echo $menu_item->title; ?></a>
                        <?php endforeach; ?>
					</div>
                    
                    <?php endif; ?>
                    
				</div>
			</div>

			<div class="footer__group-item">
				<div class="creator">
					<div class="creator__txt"><?php esc_html_e( 'Designed by', THEME_TEXTDOMAIN ); ?></div>
					<a href="#" class="creator__link">Phenomenon Studio</a>
				</div>
			</div>
		</div>		
	</div>
</footer>
        
	</div>
    
    <?php wp_footer(); ?>
    
    <svg class="d-none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="0" height="0">
			<symbol id="svg-arrow" viewBox="0 0 31 32">
				<path d="M15.4997 28.9168C22.6334 28.9168 28.4163 23.1338 28.4163 16.0002C28.4163 8.86648 22.6334 3.0835 15.4997 3.0835C8.366 3.0835 2.58301 8.86648 2.58301 16.0002C2.58301 23.1338 8.366 28.9168 15.4997 28.9168Z" stroke-width="2.58333" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M15.4997 10.8335L10.333 16.0002L15.4997 21.1668" stroke-width="2.58333" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M20.6663 16H10.333" stroke-width="2.58333" stroke-linecap="round" stroke-linejoin="round"/>
			</symbol>
		</svg>
        
    <div class="box-overlay" style="display: none;"></div>

	<div class="notification" style="display: none;">
		<button type="button" class="notification__close">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/close.svg" decoding="async" loading="lazy" alt="">
		</button>
		<div class="notification__content">
			<?php esc_html_e( 'Thank you, your spot in line is reserved', THEME_TEXTDOMAIN ); ?>
		</div>
	</div>

</body>
</html>