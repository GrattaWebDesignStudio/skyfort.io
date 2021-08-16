<?php if ( !defined('ABSPATH') ) exit; ?>
<?php get_header(); ?>

			<div class="content-main">

				<div class="container">
					<div class="text-center mb-55">
						<img srcset="<?php echo get_stylesheet_directory_uri();?>/assets/img/404.png,
									 assets/img/404-2x.png 2x" 
							 src="<?php echo get_stylesheet_directory_uri();?>/assets/img/404.png" alt="" decoding="async" loading="lazy">
					</div>			

					<div class="error-box">
						<h1 class="error-box__title"><?php esc_html_e( 'Page not found', THEME_TEXTDOMAIN ); ?></h1>

						<div class="error-box__caption"><?php esc_html_e( 'This is either because:', THEME_TEXTDOMAIN ); ?></div>

						<div class="error-box__content color-opacity">
							<div class="error-box__row">
								- <?php esc_html_e( 'There is an error in the URL entered into your web browser. Please check the URL and try again.', THEME_TEXTDOMAIN ); ?>
							</div>
							<div class="error-box__row">
								- <?php esc_html_e( 'The page you are looking for has been moved or deleted.', THEME_TEXTDOMAIN ); ?>
							</div>
						</div>

						<div class="error-box__footer">
							<a href="<?php echo site_url('/'); ?>" class="btn"><?php esc_html_e( 'Go to homepage', THEME_TEXTDOMAIN ); ?></a>
						</div>
					</div>
				</div>

			</div><!-- /.content-main -->
<?php
 get_sidebar();
get_footer();