<?php
namespace WoocommerceSubscriptionsManage\Front;

use WoocommerceSubscriptionsManage\Plugin;

if(!defined('ABSPATH')) return;

class Cron {

	private $plugin;

	public function __construct( Plugin $plugin ) {
		$this->plugin = $plugin;
  
        add_action( 'woocommerce_send_email_subscription_expired_event', array($this, 'send_email_subscription_expired') );
	}

	public static function schedule_events() {
        
        if ( ! wp_next_scheduled( 'woocommerce_send_email_subscription_expired_event' ) ) {
			wp_schedule_event( time(), 'every_minute', 'woocommerce_send_email_subscription_expired_event' );
		}
	}

	public static function unschedule_events() {

        wp_clear_scheduled_hook( 'woocommerce_send_email_subscription_expired_event' );
	}

	public static function cron_schedules( $schedules ) {
		if ( ! isset( $schedules['1min'] ) ) {
			$schedules['1min'] = array(
				'interval' => 60,
				'display'  => __( 'Every minute' )
			);
		}
		if ( ! isset( $schedules['5min'] ) ) {
			$schedules['5min'] = array(
				'interval' => 5 * 60,
				'display'  => __( 'Every 5 minutes' )
			);
		}
		if ( ! isset( $schedules['30min'] ) ) {
			$schedules['30min'] = array(
				'interval' => 30 * 60,
				'display'  => __( 'Every 30 minutes' )
			);
		}

		return $schedules;
	}
    
    public function send_email_subscription_expired() {
        
                $the_query = new \WP_Query( array(
                                                    'post_type' => 'shop_subscription',
                                                    'post_status' => 'wc-active',
                                                    'meta_query' => array(
                                                                              'relation' => 'AND',
                                                                               array(
                                                                                         'relation' => 'OR',
                                                                                          array(
                                                                                                  'key' => '_schedule_next_payment_email',
                                                                                                  'compare' => 'NOT EXISTS', 
                                                                                                  'value' => '' 
                                                                                                ),
                                                                                          array(
                                                                                                  'key' => '_schedule_next_payment_email',
                                                                                                  'value' => date( 'Y-m-d H:i:s',get_post_timestamp( current_time('timestamp')) - 24 * 3600), 
                                                                                                  'compare' => '<=', 
                                                                                                  'type' => 'DATETIME'
                                                                                                )
                                                                              ),
                                                                              array(
                                                                                     'key' => '_schedule_next_payment',
                                                                                     'value' => date( 'Y-m-d H:i:s', current_time('timestamp') + 22 * 3600),
                                                                                     'compare' => '<=',
                                                                                     'type' => 'DATETIME'
                                                                                    )
                                                                         )
                                                ) 
                                         );
                                         
               while ( $the_query->have_posts() ) :
               
                      $the_query->the_post();
                      
                      update_post_meta( $the_query->post->ID, '_schedule_next_payment_email', date( 'Y-m-d H:i:s', current_time('timestamp')) );
                      
                      $subscription = wcs_get_subscription($the_query->post->ID);
                      
                      $pay_url =  wcs_get_early_renewal_url( $subscription );
                      
                      $userid = $subscription->get_user_id();
                      
                      $user_info = get_userdata($userid);
                      
                      $user_email = $user_info->get('user_email');
                      
                      $mail = \WC()->mailer()->emails['EmailsSubscriptionExpired']->trigger( $user_email,  $pay_url );
  
               endwhile;
    }
        
	private function get_lock() {
		//get XML path and use 'lock':
		$lock = $this->get_lock_file_path();

		$lockFile = @fopen( $lock, 'w+' );
		if ( flock( $lockFile, LOCK_EX ) ) {
			return $lockFile;
		} else {
			fclose( $lockFile );

			return false;
		}
	}

	private function get_lock_file_path() {
		return trailingslashit(\oocommerceSubscriptionsManage\Plugin::get_data_directory() ) . '.lock';
	}
}