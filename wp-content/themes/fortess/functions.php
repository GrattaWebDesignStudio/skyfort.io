<?php if ( !defined('ABSPATH') ) exit; ?>
<?php
/**
 * fortess functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fortess
 */

if ( ! defined( '_THEME_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_THEME_VERSION', '1.0.36' );
}

define('THEME_TEXTDOMAIN',  'fortess');

define('THEME_DIRECTORY',  get_template_directory());

define('THEME_DIRECTORY_URI',  get_stylesheet_directory_uri());

include_once THEME_DIRECTORY . '/vendor/autoload.php';

if ( ! function_exists( 'fortess_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fortess_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on fortess, use a find and replace
		 * to change THEME_TEXTDOMAIN to the name of your theme in all the template files.
		 */
		load_theme_textdomain( THEME_TEXTDOMAIN, get_template_directory() . '/languages' );
        
        add_theme_support('woocommerce' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
        
       	add_image_size('post-thumbnail-medium', 740, 400);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-header' => esc_html__( 'Header Menu', THEME_TEXTDOMAIN ),
                		'menu-footer' => esc_html__( 'Footer Menu', THEME_TEXTDOMAIN ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'fortess_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
        
        if( function_exists('acf_add_options_page') ) {
    
                    acf_add_options_page(array(
                           'page_title' => __('Site settings', THEME_TEXTDOMAIN),
                           'menu_slug' => 'options-settings',
                           'post_id' => 'options-settings',
                           'capability' => 'edit_posts'
                    ));
    
        }
	}
endif;
add_action( 'after_setup_theme', 'fortess_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fortess_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fortess_content_width', 640 );
}
add_action( 'after_setup_theme', 'fortess_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fortess_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', THEME_TEXTDOMAIN ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', THEME_TEXTDOMAIN ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'fortess_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fortess_scripts() {
    
   	global $template;

    wp_enqueue_style( 'fortess-normalize', THEME_DIRECTORY_URI.'/assets/css/normalize.min.css', array(), _THEME_VERSION );
    
    if (basename($template) == 'commin-soon.php') {

	   wp_enqueue_style( 'fortess-style', THEME_DIRECTORY_URI.'/assets/css/style-comming-soon.css', array(), _THEME_VERSION );

    } else {

       wp_enqueue_style( 'fortess-slick', THEME_DIRECTORY_URI.'/assets/css/slick.css', array(), _THEME_VERSION );
       
       wp_enqueue_style( 'fortess-selectize', THEME_DIRECTORY_URI.'/assets/css/selectize.css', array(), _THEME_VERSION ); 

	   wp_enqueue_style( 'fortess-style', THEME_DIRECTORY_URI.'/assets/css/style.css', array(), _THEME_VERSION );
    }
    
	wp_enqueue_style( 'fortess-main', get_stylesheet_uri(), array(), _THEME_VERSION );
    
	wp_style_add_data( 'fortess-style', 'rtl', 'replace' );
    
    wp_enqueue_script('jquery');
    
    wp_enqueue_script( 'fortess-slick', get_template_directory_uri() . '/assets/js/vendor/slick.min.js', array(), _THEME_VERSION, true );
    
    wp_enqueue_script( 'fortess-selectize', get_template_directory_uri() . '/assets/js/vendor/selectize.min.js', array(), _THEME_VERSION, true );
    
    wp_enqueue_script( 'fortess-plugins', get_template_directory_uri() . '/assets/js/plugins.js', array(), _THEME_VERSION, true );
    
    wp_enqueue_script( 'fortess-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), _THEME_VERSION, true );
    
    //wp_enqueue_script( 'fortess-video-bg-color', get_template_directory_uri() . '/assets/js/videoBgColor.js', array('jquery'), _THEME_VERSION, true );
    
    wp_enqueue_script( 'fortess-blog', get_template_directory_uri() . '/js/blog.js', array('jquery'), _THEME_VERSION, true );

	wp_enqueue_script( 'fortess-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _THEME_VERSION, true );
    
    if ( is_plugin_active("woocommerce/woocommerce.php") && (is_checkout())) {
        
        wp_enqueue_script( 'fortess-checkout-js',  get_template_directory_uri() . '/js/checkout.js', array('jquery'), _THEME_VERSION, true );
    }

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fortess_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/customizer-woocommerce.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

require get_template_directory() . '/inc/acf.php';

\Fortess\Theme::instance();


// overried jQuery
function override_jquery() {
    if( !is_admin()){
        wp_deregister_script('jquery');
        wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
    }
}

add_action('wp_enqueue_scripts', 'override_jquery', 0);

add_filter( 'wpcf7_validate_configuration', '__return_false' );

add_action('in_admin_header', function () {
			remove_all_actions('admin_notices');
			remove_all_actions('all_admin_notices');
  
	   }, 1000);
       
add_filter( 'body_class', 'wpse15850_body_class', 10, 2 );

function wpse15850_body_class( $wp_classes, $extra_classes ) {

    # List tag to delete
    $class_delete = array('tag');

    # Verify if exist the class of WP in $class_delete
    foreach ($wp_classes as $class_css_key => $class_css) {
        if (in_array($class_css, $class_delete)) {
            unset($wp_classes[$class_css_key]);
        }
    }

    // Add the extra classes back untouched
    return array_merge( $wp_classes, (array) $extra_classes );
}

function fc_opengraph() {
    if( is_single() || is_page() ) {
        $post_id = get_queried_object_id();
        $url = get_permalink($post_id);
        $title = get_the_title($post_id);
        $site_name = get_bloginfo('name');
        $description = wp_trim_words( get_post_field('post_content', $post_id), 25 );
        $image = get_the_post_thumbnail_url($post_id);
        if( !empty( get_post_meta($post_id, 'og_image', true) ) )  {   
                $image = get_post_meta($post_id, 'og_image', true);
        } 
        $locale = get_locale();

        if($image) echo '<meta property="og:image:secure_url" content="' . esc_url($image) . '" />';
   }
}

add_action('wp_head', 'fc_opengraph');

//add_action( 'wp_footer', 'meks_which_template_is_loaded' );

function meks_which_template_is_loaded() {
	if ( is_super_admin() ) {
		global $template;
		print_r( $template );
	}
}

//add_filter('posts_request', 'dump_request');

function dump_request( $input ) {
        
            if ( is_super_admin() ) {
                var_dump($input);
            }
            return $input; 
}

if ( defined( 'WP_DEBUG') && WP_DEBUG == true ) {
        
            add_filter('auto_update_plugin', '__return_false' );
        
            add_filter('auto_update_theme', '__return_false' );
        
} else {
        
            add_filter('auto_update_plugin', '__return_true' );
        
            add_filter('auto_update_theme', '__return_true' );
}