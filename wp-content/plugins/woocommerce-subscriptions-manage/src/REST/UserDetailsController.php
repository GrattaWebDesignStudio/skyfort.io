<?php
namespace WoocommerceSubscriptionsManage\REST;

if(!defined('ABSPATH')) return;

class UserDetailsController {

	protected $namespace = 'wc/v3';

	protected $rest_base = 'user-details';

	public function get_data( \WP_REST_Request $request  ) {
	   
        global $wpdb;
        
        global $subscriptions_manage;
        
        if (is_user_logged_in() && in_array( 'administrator', (array) wp_get_current_user()->roles )) {
            
                   $id = $request->get_param( 'id' ) ?? 0;
        
                   $user_id = $wpdb->get_var( "SELECT ID FROM $wpdb->users WHERE MD5(CONCAT(ID, '".AUTH_SALT."')) = '".esc_sql($id)."'" );
        
                   if ($user_id && $user_info = get_userdata($user_id)) {
            
                            $user_info -> uid = md5($user_info -> ID . AUTH_SALT);
                            
                            $user_ref_id = get_user_meta( $user_info -> ID, '_ref_id',  true );
                            
                            if(!$user_ref_id) { 
                                
                                $user_ref_id = $user_info -> ID;
                                
                                $user_info -> team = [];
                                
                            } else {
                                
                                
                                $user_info -> team =  get_userdata($user_ref_id);
                            }
                            
                            
                            $user_info -> company =  get_user_meta( $user_ref_id, 'billing_company', true );
                            
                            $coworkers = [];
                            
                            $params = [];
        
                            $params['meta_query'] = array(
                                            'relation'  => 'AND',
                                            array( 
                                                 'key' => '_ref_id',
                                                 'value' =>  $user_info -> ID,
                                                 'compare' => '='
                                            )
                                    );
            
                            $user_query = new \WP_User_Query( $params );
                            
                            if ( ! empty( $user_query->get_results() ) ) {
                                       $coworkers = $user_query->get_results();
                            }
                            
                            $user_info -> coworkers = $coworkers;
                            
                            $user_subscriptions = [];
                            
                            $subscriptions = wcs_get_subscriptions(
                                                                                         array(
                                                                                                 'customer_id' => $user_ref_id,
                                                                                                 'subscription_status' => 'any',
                                                                                                 'subscriptions_per_page' => - 1
                                                                                              )
                                                                                );
                            
                                        
                            foreach ( $subscriptions as $subscription ) {
                                
                                $user_subscriptions[] = $subscription->get_data();
				            }
                            
                            $user_info -> subscriptions = $user_subscriptions;
                            
                            return $user_info;
                   } else {
                                return new \WP_Error( 'no_user', 'Invalid user', array( 'status' => 404 ) );
                   }
        } else {
                return new \WP_Error('unauthorized', __('You shall not pass'), [ 'status' => 401 ]);
        }
	}

	public function register_routes() {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base.'/(?P<id>[\w]+)',
			array(
				'methods' => 'GET',
				'callback' => array( $this, 'get_data' ),
                'args' => array(
                         'id' => array(
                                'validate_callback' => function($param, $request, $key) {
                                         return true;
                                }
                          ),
                ),
			)
		);
	}
}