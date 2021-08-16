<?php
namespace WoocommerceSubscriptionsManage;

use WoocommerceSubscriptionsManage\Emails\Emails;
use WoocommerceSubscriptionsManage\Front\CoWorkers as FrontCoWorkers;
use WoocommerceSubscriptionsManage\Front\Ref;
use WoocommerceSubscriptionsManage\Front\Cron;
use WoocommerceSubscriptionsManage\Classes\Logger;
use WoocommerceSubscriptionsManage\Classes\CoWorkers;

if(!defined('ABSPATH')) return;

class Plugin {
    
    private $logger;
    
    private $co_workers;
    
    private function __construct() {
        
        $this->logger = new Logger( WOOCOMMERCE_SUBCRIPTIONS_MANAGE_DEBUG ? Logger::DEBUG : Logger::WARNING );

        $this ->co_workers = new CoWorkers;
        
        add_action('plugins_loaded', array($this, 'load_textdomain'));

        $this -> load_dependencies();
        
        add_filter( 'woocommerce_rest_prepare_customer', array($this, 'custom_woocommerce_rest_prepare_customer'), 10, 3 );
    }
    
    public static function instance() {
		static $instance;
		if(!is_object($instance)) $instance = new self();
		return $instance;
    }

    public function load_textdomain() {
        
        load_plugin_textdomain(
			WOOCOMMERCE_SUBCRIPTIONS_MANAGE_TEXTDOMAIN,
			false,
            dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
    
    private function load_dependencies() {
    
        new Emails($this);

		if ( is_admin() && (!defined('DOING_AJAX') || (defined('DOING_AJAX') && !DOING_AJAX))) {
            
		} else {
		    	    new FrontCoWorkers($this);
            		new Ref($this);
                    new Cron($this);
		}
	}
    
    public function custom_woocommerce_rest_prepare_customer( $response, $user_data, $request ){
        
           $user_id = $user_data -> ID;
           
           $ref_id = get_user_meta( $user_id, '_ref_id', $single = true );
           
           $response_customer_data = $response->get_data();
           
           $response_customer_data['uid'] = md5($user_data -> ID . AUTH_SALT);

           $response->set_data( $response_customer_data );
   
	       return $response;
           
   }
   
   public static function get_data_directory() {
		$upload_dir = wp_upload_dir();
		$dir        = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . 'woocommerce-subscriptions-manage';
		if ( ! is_dir( $dir ) ) {
			mkdir( $dir, 0777, true );
		}
		$htaccess = $dir . DIRECTORY_SEPARATOR . ".htaccess";
		if ( ! file_exists($htaccess)){
			if ( $file_handle = @fopen( $htaccess, 'w' ) ) {
				fwrite( $file_handle, 'deny from all' );
				fclose( $file_handle );
			}
		}
	
		return $dir;
	}
    
    public function get_logger() {
		return $this->logger;
	}
    
    public function get_co_workers() {
		return $this->co_workers;
	}
    
    static function create_database() {
        
		    global $wpdb;

		    $charset_collate = $wpdb->get_charset_collate();

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            
            $table_name = $wpdb->prefix . CoWorkers::TABLE_NAME;
            
			$sql = "CREATE TABLE IF NOT EXISTS $table_name (
                            `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                            `user_id` bigint(20) unsigned NOT NULL,
                            `coworker_email` varchar(100) NOT NULL,
                            `coworker_user_id` bigint(20) unsigned DEFAULT NULL,
                            `date_created` datetime NOT NULL,
                            `date_registered` datetime DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            UNIQUE KEY `user_id_coworker_email` (`user_id`,`coworker_email`),
                            KEY `user_id` (`user_id`),
                            KEY `coworker_user_id` (`coworker_user_id`),
                            KEY `date_created` (`date_created`),
                            KEY `date_registered` (`date_registered`),
                            KEY `coworker_email` (`coworker_email`)
                    ) ENGINE=MyISAM DEFAULT $charset_collate;";
                    
			dbDelta( $sql );
	}
}