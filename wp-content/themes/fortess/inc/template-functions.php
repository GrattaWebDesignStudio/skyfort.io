<?php if ( !defined('ABSPATH') ) exit; ?>
<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package fortess
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function fortess_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'fortess_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function fortess_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'fortess_pingback_header' );

if (!function_exists('get_sign_up_url')) {
   
   function get_sign_up_url() {
        
            $page_link = false;
            
            if ( get_field('promo_mode', 'options-settings')) {
                
                $args = [
                                        'post_type' => 'page',
                                        'fields' => 'ids',
                                        'nopaging' => true,
                                        'meta_key' => '_wp_page_template',
                                        'meta_value' => 'mainpage.php'
                        
                ];
                
                $pages = get_posts( $args );
            
                if ($pages) {
                
                    return get_the_permalink($pages[0]).'#section-sign';
                } else {
                    return '';
                }
                
            } else {
                
                $args = [
                                        'post_type' => 'page',
                                        'fields' => 'ids',
                                        'nopaging' => true,
                                        'meta_key' => '_wp_page_template',
                                        'meta_value' => 'sign-up.php'
                        
                ];
                
                $pages = get_posts( $args );
            
                if ($pages) {
                
                    return get_the_permalink($pages[0]);
                } else {
                    return '';
                }
            }      
  }  
}

if (!function_exists('get_sign_in_url')) {
    function get_sign_in_url() {
        
            $page_link = false;
               
            $args = [
                                        'post_type' => 'page',
                                        'fields' => 'ids',
                                        'nopaging' => true,
                                        'meta_key' => '_wp_page_template',
                                        'meta_value' => 'login.php'
                        
                                    ];
            $pages = get_posts( $args );
            
            if ($pages) {
                
                return get_the_permalink($pages[0]);
            } else {
                return '';
            }
   } 

}   

if (!function_exists('get_password_recovery_url')) {
    function get_password_recovery_url() {
        
            $page_link = false;
               
            $args = [
                                        'post_type' => 'page',
                                        'fields' => 'ids',
                                        'nopaging' => true,
                                        'meta_key' => '_wp_page_template',
                                        'meta_value' => 'reset-password.php'
                        
                                    ];
            $pages = get_posts( $args );
            
            if ($pages) {
                
                return get_the_permalink($pages[0]);
            } else {
                return '';
            }
   } 

}   

if (!function_exists('get_password_recovery_page_id')) {
    function get_password_recovery_page_id() {
        
            $page_link = false;
               
            $args = [
                                        'post_type' => 'page',
                                        'fields' => 'ids',
                                        'nopaging' => true,
                                        'meta_key' => '_wp_page_template',
                                        'meta_value' => 'reset-password.php'
                        
                                    ];
            $pages = get_posts( $args );
            
            if ($pages) {
                
                return $pages[0];
            } else {
                return '';
            }
   } 
}   