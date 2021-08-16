<?php if ( !defined('ABSPATH') ) exit; ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport"  content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
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

        <div class="gradient-top"></div>
        <div class="gradient-bottom"></div>
        <div class="gradient-center-right"></div>
        <div class="gradient-center-left"></div>

		<header class="header">
			<div class="container header__container">
				<div class="logo">
                    <a href="<?php echo site_url('/'); ?>" class="logo">
					   <img src="<?php echo get_template_directory_uri(); ?>/assets/img/skyFort-logo.svg" decoding="async" loading="lazy" alt="">
                    </a>
				</div>

                <?php $email = get_field('email', 'options-settings');  ?>
                <?php if ($email) : ?>
				<div class="header__contact">
					<div class="header__contact-txt"><?php esc_html_e( 'Get in touch:', THEME_TEXTDOMAIN ); ?></div>
					<a class="link" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
				</div>
                <?php endif; ?>

				<div class="header__social">
					<div class="social-list">
                                    <?php $url = get_field('link', 'options-settings');  ?>
                                    <?php if ($url) : ?>
						               <a href="<?php echo $url; ?>" class="social-list__item"  target="_blank">
							             <img src="<?php echo get_template_directory_uri(); ?>/assets/img/link.svg" decoding="async" loading="lazy" alt="">
						               </a>
                                    <?php endif; ?>
                                    <?php $url = get_field('twitter', 'options-settings');  ?>
                                    <?php if ($url) : ?>
						              <a href="<?php echo $url; ?>" class="social-list__item"  target="_blank">
							             <img src="<?php echo get_template_directory_uri(); ?>/assets/img/twitter.svg" decoding="async" loading="lazy"> 
						              </a>
                                    <?php endif; ?>
                                    <?php $url = get_field('instagram', 'options-settings');  ?>
                                    <?php if ($url) : ?>
						              <a href="<?php echo $url; ?>" class="social-list__item"  target="_blank">
							             <img src="<?php echo get_template_directory_uri(); ?>/assets/img/instagram.svg" decoding="async" loading="lazy">
						              </a>
                                    <?php endif; ?>
					</div>
				</div>
			</div>
		</header>