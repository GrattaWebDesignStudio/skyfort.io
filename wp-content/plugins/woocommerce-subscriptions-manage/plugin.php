<?php
/**
 * Plugin Name:         Woocommerce Subscriptions Manage
 * Description:         Woocommerce Subscriptions Manage
 * Version:             1.0.0
 * Requires at least:   4.9
 * Requires PHP:        5.5
 * Author:              Valerii Vasyliev
 * Author URI:          https://gratta.pro/
 * License:             MIT
 * Text Domain:         woocommerce-subscriptions-manage
 *
 * @package     Woocommerce Subscriptions Manage
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( version_compare( phpversion(), '7.2.5', '<' ) ) {

	/**
	 * Display the notice after deactivation.
	 *
	 * @since 1.0.0
	 */
	function woocommerce_subscriptions_manage_php_notice() {
		?>
		<div class="notice notice-error">
			<p>
				<?php
				echo wp_kses(
					__( 'The minimum version of PHP is <strong>7.2.5</strong>. Please update the PHP on your server and try again.', 'woocommerce-awgt-cabinet' ),
					[
						'strong' => [],
					]
				);
				?>
			</p>
		</div>

		<?php
		// In case this is on plugin activation.
		if ( isset( $_GET['activate'] ) ) { //phpcs:ignore
			unset( $_GET['activate'] ); //phpcs:ignore
		}
	}

	add_action( 'admin_notices', 'woocommerce_subscriptions_manage_php_notice' );

	// Don't process the plugin code further.
	return;
}

if ( ! defined( 'WOOCOMMERCE_SUBCRIPTIONS_MANAGE_DEBUG' ) ) {
	/**
	 * Enable plugin debug mod.
	 */
	define( 'WOOCOMMERCE_SUBCRIPTIONS_MANAGE_DEBUG', true );
}
/**
 * Path to the plugin root directory.
 */
define( 'WOOCOMMERCE_SUBCRIPTIONS_MANAGE_PATH', plugin_dir_path( __FILE__ ) );
/**
 * Url to the plugin root directory.
 */
define( 'WOOCOMMERCE_SUBCRIPTIONS_MANAGE_URL', plugin_dir_url( __FILE__ ) );

define( 'WOOCOMMERCE_SUBCRIPTIONS_MANAGE_PLUGIN_FILE', __FILE__ );

define( 'WOOCOMMERCE_SUBCRIPTIONS_MANAGE_TEXTDOMAIN', 'woocommerce-subscriptions-manage');

define( 'WOOCOMMERCE_SUBCRIPTIONS_MANAGE_VERSION', '1.0.0' );

require_once WOOCOMMERCE_SUBCRIPTIONS_MANAGE_PATH . 'vendor/autoload.php';
    
function woocommerce_subscriptions_manage_plugin_activate() {
    \WoocommerceSubscriptionsManage\Plugin::create_database();
    
    // this can't be lazy loaded
    add_filter( 'cron_schedules', '\WoocommerceSubscriptionsManage\Front\Cron::cron_schedules' );
    
    \WoocommerceSubscriptionsManage\Front\Cron::schedule_events();
}

register_activation_hook( __FILE__ , 'woocommerce_subscriptions_manage_plugin_activate');

function woocommerce_subscriptions_manage_plugin_deactivate() {
   
    // this can't be lazy loaded
    add_filter( 'cron_schedules', '\WoocommerceSubscriptionsManage\Front\Cron::cron_schedules' );
    
    \WoocommerceSubscriptionsManage\Front\Cron::unschedule_events();     
}
        
register_deactivation_hook( __FILE__ , 'woocommerce_subscriptions_manage_plugin_deactivate');
        

/**
 * Run plugin function.
 *
 * @since 1.0.0
 *
 * @throws Exception If something went wrong.
 */
function run_woocommerce_subscriptions_manage() {
    
   global $subscriptions_manage;
    
   $subscriptions_manage = \WoocommerceSubscriptionsManage\Plugin::instance();
   
   add_filter( 'woocommerce_rest_api_get_rest_namespaces', 'woo_custom_api' );

   function woo_custom_api( $controllers ) {
    
	       $controllers['wc/v3']['user-auth'] = '\WoocommerceSubscriptionsManage\REST\UserAuthController';
           
           $controllers['wc/v3']['user-details'] = '\WoocommerceSubscriptionsManage\REST\UserDetailsController';

	       return $controllers;
   }
}

add_action( 'plugins_loaded', 'run_woocommerce_subscriptions_manage' );