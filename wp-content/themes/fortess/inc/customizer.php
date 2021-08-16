<?php if ( !defined('ABSPATH') ) exit; ?>
<?php
/**
 * fortess Theme Customizer
 *
 * @package fortess
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function fortess_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'fortess_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'fortess_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'fortess_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function fortess_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function fortess_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fortess_customize_preview_js() {
	wp_enqueue_script( 'fortess-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'fortess_customize_preview_js' );


add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-acceptance(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-list-item(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

    return $content;
});

add_filter('wpcf7_autop_or_not', '__return_false');

add_action(
			'wp_enqueue_scripts',
			 function() {
				// Если это НЕ страницы магазина.
			    if ( is_plugin_active("woocommerce/woocommerce.php") && ! is_woocommerce() && !is_cart() && !is_checkout() && !is_account_page()) {
					 // Отключаем стили магазина.
					 wp_dequeue_style( 'woocommerce_frontend_styles' );
					 wp_dequeue_style( 'woocommerce-general');
					 wp_dequeue_style( 'woocommerce-layout' );
					 wp_dequeue_style( 'woocommerce-smallscreen' );
					 wp_dequeue_style( 'woocommerce_fancybox_styles' );
					 wp_dequeue_style( 'woocommerce_chosen_styles' );
					 wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
					 wp_dequeue_style( 'select2' );
			 
					// Отключаем скрипты магазина.
					wp_dequeue_script( 'wc-add-payment-method' );
					wp_dequeue_script( 'wc-lost-password' );
					wp_dequeue_script( 'wc_price_slider' );
					wp_dequeue_script( 'wc-single-product' );
					wp_dequeue_script( 'wc-add-to-cart' );
					wp_dequeue_script( 'wc-cart-fragments' );
					wp_dequeue_script( 'wc-credit-card-form' );
					wp_dequeue_script( 'wc-checkout' );
					wp_dequeue_script( 'wc-add-to-cart-variation' );
					wp_dequeue_script( 'wc-single-product' );
					wp_dequeue_script( 'wc-cart' ); 
					wp_dequeue_script( 'wc-chosen' );
					wp_dequeue_script( 'woocommerce' );
					wp_dequeue_script( 'prettyPhoto' );
					wp_dequeue_script( 'prettyPhoto-init' );
					wp_dequeue_script( 'jquery-blockui' );
					wp_dequeue_script( 'jquery-placeholder' );
					wp_dequeue_script( 'jquery-payment' );
					wp_dequeue_script( 'jqueryui' );
					wp_dequeue_script( 'fancybox' );
					wp_dequeue_script( 'wcqi-js' );
				}
			},
			 99
	   );   

function block_wp_admin() {

	       if ( is_admin() && ! current_user_can( 'administrator' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		      wp_safe_redirect( home_url() );
		      exit;
	       }
}


add_action( 'admin_init', 'block_wp_admin' );

add_filter( 'rest_endpoints', function( $endpoints ){
    if ( isset( $endpoints['/wp/v2/users'] ) ) {
        unset( $endpoints['/wp/v2/users'] );
    }
    if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
        unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
    }
    return $endpoints;
});

function ecs_add_post_state( $post_states, $post ) {
    
    $template = get_post_meta( $post->ID, '_wp_page_template', true );
    
    if( $template != 'default' ) {
        
        $templates = wp_get_theme()->get_page_templates();
        
        if (isset($templates[$template])) {
            $post_states[] = $templates[$template];
        }
    }
    return $post_states;
}

add_filter( 'display_post_states', 'ecs_add_post_state', 10, 2 );


function yoasttobottom() {
	       return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


function my_login_logo() { ?>
    <style type="text/css">
        body.login {
            background-color: #03091E;
            min-width: 320px;
            -webkit-overflow-scrolling: touch;
            letter-spacing: .02em;
        }
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/img/skyFort-logo.svg);
		      height:68px;
		      width:270px;
		      background-size: 270px 68px;
		      background-repeat: no-repeat;
        	  padding-bottom: 30px;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'my_login_logo' );


function my_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'my_login_logo_url' );

if (!function_exists('embed_images_in_mail')) {
    
  function embed_images_in_mail() {
    
    global $phpmailer;
    $body = $phpmailer->Body; //Email content send to mailer
    $uploadDir = wp_upload_dir(); //Wordpress upload directory
    //$baseUploadUrl = $uploadDir['baseurl'];
    //$baseUploadPath = $uploadDir['basedir'];
    $baseUploadUrl = get_bloginfo('url');
    $baseUploadPath = ABSPATH;
    
    // get all img tags
    preg_match_all('/<img.*?>/', $body, $matches);
    if (!isset($matches[0])) {
        return;
    }
    
    // foreach tag, create the cid and embed image
    $i = 1;
    
    $images = [];
    
    foreach ($matches[0] as $img) {
        
        // make cid
        $id = 'img'.($i++);
        
        // replace image web path with local path
        preg_match('/src=\'(.*?)\'/', $img, $m);
        if (empty($m)) {
            preg_match('/src="(.*?)"/', $img, $m);
        }
        
        if (!isset($m[1])) {
            continue;
        }
        if (strpos($m[1], get_bloginfo('url')) === false) {
            continue;
        }
        // $m[1] holds the url of image
        $uploadPathSegment = str_ireplace($baseUploadUrl, '', $m[1]);
        $uploadPathSegment = rtrim($uploadPathSegment, '/');
        $completeImagePath = $baseUploadPath.$uploadPathSegment;
        
        if (file_exists($completeImagePath)) {
            
           if (isset($images[$baseUploadPath.$uploadPathSegment])) {
                     $id = $images[$baseUploadPath.$uploadPathSegment];
           } else {
                $images[$baseUploadPath.$uploadPathSegment] = $id;
            
                $phpmailer->AddEmbeddedImage($completeImagePath, $id, basename($baseUploadPath.$uploadPathSegment), 'base64');
          }
            
          $body = str_replace($m[1], 'cid:'.$id, $body);
        }
    }
    
    $phpmailer->Body = $body;
  }

  add_action('phpmailer_init', 'embed_images_in_mail');
}

function woocommerce_disable_shop_page() {
    global $post;
    
    if (is_shop()):
            global $wp_query;
            $wp_query->set_404();
            status_header(404);
    endif;
}

add_action( 'wp', 'woocommerce_disable_shop_page' );


function custom_woocommerce_return_to_shop_redirect() {
    
        return esc_url( \Fortess\Common\Pricing::get_url() );
}
add_filter( 'woocommerce_return_to_shop_redirect', 'custom_woocommerce_return_to_shop_redirect', 10, 2 );