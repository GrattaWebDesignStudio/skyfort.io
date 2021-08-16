<?php
namespace WoocommerceSubscriptionsManage\REST;

if(!defined('ABSPATH')) return;

class UserAuthController {

	protected $namespace = 'wc/v3';

	protected $rest_base = 'user-auth';

	public function get_data( \WP_REST_Request $request ) { 
	   
        if (is_user_logged_in() && in_array( 'administrator', (array) wp_get_current_user()->roles )) {

            $username = $request->get_param( 'user' ) ?? '';
         
            $password = $request->get_param( 'pass' ) ?? '';
        
            // this returns the user ID and other info from the user name
 	        $user = get_user_by( 'email', $username );
                  
            if (!$user) {
                        $user = get_user_by( 'login', $username );
            }
            
            if($user && !wp_check_password($password,  $user->user_pass, $user->ID) || !$user) {
                 return new \WP_Error( 'no_user', 'Invalid email or password', array( 'status' => 404 ) );  
            } else {
                 $userdata = get_userdata( $user->ID );
                 
                 $userdata -> uid = md5($userdata -> ID . AUTH_SALT);
             
                 if($user && !(in_array( 'administrator', (array) $userdata->roles )) && get_user_meta( $user->ID, 'account_activated', true ) != 1) {
                    
                         return new \WP_Error( 'no_user', 'Account not verified. Follow the link sent to your e-mail.', array( 'status' => 404 ) );
                 } else {
                         
                            $user_ref_id = get_user_meta( $userdata -> ID, '_ref_id',  true );
                            
                            if(!$user_ref_id) { 
                                
                                $user_ref_id = $userdata -> ID;
                                
                                $userdata -> team = [];
                                
                            } else {
                                
                                
                                $userdata -> team =  get_userdata($user_ref_id);
                            }
                            
                            $userdata -> company =  get_user_meta( $user_ref_id, 'billing_company', true );
  
                            $coworkers = [];
                            
                            $params = [];
        
                            $params['meta_query'] = array(
                                            'relation'  => 'AND',
                                            array( 
                                                 'key' => '_ref_id',
                                                 'value' =>  $userdata -> ID,
                                                 'compare' => '='
                                            )
                                    );
            
                            $user_query = new \WP_User_Query( $params );
                            
                            if ( ! empty( $user_query->get_results() ) ) {
                                       $coworkers = $user_query->get_results();
                            }
                            
                            $userdata -> coworkers = $coworkers;
                            
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
                            
                            $userdata -> subscriptions = $user_subscriptions;  
                    
                            return $userdata;
                 }
            }
        
        } else {
            return new \WP_Error('unauthorized', __('You shall not pass'), [ 'status' => 401 ]);
        }
	}

	public function register_routes() {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base,
			array(
				'methods'  => 'POST',
				'callback' => array( $this, 'get_data' ),
			)
		);
	}
}