<?php if ( !defined('ABSPATH') ) exit; ?>

<?php global $template; ?>

<!doctype html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport"  content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
    <?php if (is_singular() && pings_open(get_queried_object())) : ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php endif; ?>
    <?php
            if ( is_front_page() ) {
                $canonical_url = get_home_url();
                if ( ! is_main_site() ) { // add trailing slash for subsite home directories
                    $canonical_url = $canonical_url . '/';
                }
            } else {
                $canonical_url = get_permalink();
            }
     ?>
     <link rel="canonical" href="<?php echo $canonical_url ?>" />
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<div class="wrapper">
		<div class="content-page">
        
            <?php if (basename($template) == 'mainpage.php' || basename($template) == 'business.php' || basename($template) == 'product.php' || basename($template) == 'how-it-works.php') { ?>
                <div class="gradient-top-2"></div>
            <?php } elseif (basename($template) == 'how-it-works.php') { ?>
                <div class="gradient-top"></div>
			    <div class="gradient-bottom"></div>
			    <div class="gradient-center-right"></div>
			    <div class="gradient-center-left"></div>
            <?php } else { ?>      
			    <div class="gradient-top"></div>
			    <div class="gradient-bottom"></div>
			    <div class="gradient-center-right"></div>
			    <div class="gradient-center-left"></div>
            <?php } ?>

                <header class="header-main">
	<div class="container header-main__container">
		<div class="header-main__logo elem-over">
			<a href="<?php echo site_url('/'); ?>" class="logo">
				<img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/skyFort-logo.svg" decoding="async" loading="lazy" alt="">
			</a>
		</div>

		<div class="header-main__block mobile-menu">
			
            <?php
              $menu_name = 'menu-header';

              $locations = get_nav_menu_locations();

              if( $locations && isset($locations[ $menu_name ]) ) :

                   $menu = wp_get_nav_menu_object( $locations[ $menu_name ] ); 
                   
                   $menu_items = wp_get_nav_menu_items( $menu );
            ?> 
            
            <div class="header-main__nav">
				<nav class="nav">
					<ul class="nav-list nav-list_center">
                    <?php foreach ( (array) $menu_items as $key => $menu_item ) : ?>      

                        <?php $page_template = get_post_meta( $menu_item -> object_id, '_wp_page_template', true );?>
                        
                        <li><a href="<?php echo $menu_item->url; ?>"><?php if ($page_template == 'business.php') { ?><span class="nav-list__label"><?php esc_html_e( 'new', THEME_TEXTDOMAIN ); ?></span> <?php } ?><?php echo $menu_item->title; ?></a></li>
                    <?php endforeach; ?>
                    </ul>
				</nav>
			</div>
            <?php endif;?>

			<div class="header-main__actions">
				<div class="header-main__item">
					<a href="<?php echo Fortess\Common\Contact::get_url(); ?>" class="btn"><?php esc_html_e( 'Contact', THEME_TEXTDOMAIN ); ?></a>
				</div>
				
                <?php 
                if (!get_field('promo_mode', 'options-settings')) {
                ?>
                
                <div class="header-main__item shrink-none">
                
                    <?php if (!is_user_logged_in()) { ?>
					<a href="<?php echo Fortess\Guest\Login::get_url(); ?>" class="btn-sign">
						<span class="btn-sign__txt"><?php esc_html_e( 'Sign in', THEME_TEXTDOMAIN ); ?></span>
						<span class="btn-sign__icon">
							<img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/svg/user.svg" decoding="async" loading="lazy" alt="">
						</span>
					</a>
                    <?php } else { ?>
                    <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>" class="btn-sign">
						<span class="btn-sign__txt"><?php esc_html_e( 'Account', THEME_TEXTDOMAIN ); ?></span>
						<span class="btn-sign__icon">
							<img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/svg/user.svg" decoding="async" loading="lazy" alt="">
						</span>
					</a>
                    <?php } ?>
				</div>
                <?php } ?>
			</div>
		</div>

		<button type="button" class="hamburger elem-over js-hamburger"><span></span></button>
	</div>
</header>