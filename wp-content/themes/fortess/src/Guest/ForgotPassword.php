<?php
namespace Fortess\Guest;

use Fortess\Theme;

if ( !defined('ABSPATH') ) exit;

class ForgotPassword {
     
    private $theme;

	public function __construct( Theme $theme ) {
	   
	   $this->theme = $theme;
        
       add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts')); 
        
       add_action('wp_ajax_nopriv_forgot_password_member', array( $this, 'forgot_password_member') );
       
       add_action('template_redirect', array($this, 'forgot_password_confirm'));   
       
       add_action('wp_ajax_nopriv_forgot_password_confirm', array( $this, 'verify_user_code') );
       
       add_filter( 'send_password_change_email', '__return_false' );
    }
    
    public function enqueue_scripts() {           
        wp_register_script('forgot_password-scripts', THEME_DIRECTORY_URI. '/js/forgot_password.js', array(),_THEME_VERSION,true);
        
        wp_localize_script('forgot_password-scripts', 'ajaxurl', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

        wp_enqueue_script('forgot_password-scripts' );
    }
    
    // logs a member in after submitting a form
    public function forgot_password_member() {
        
       $result = ['status' => false,  'errors' => []];
 
	   if(isset($_POST['forgot_password_nonce']) && wp_verify_nonce($_POST['forgot_password_nonce'], 'forgot_password-nonce')) {
	           
            $email = $_POST['user_login'] ?? '';
            
            if( empty( $email ) ) {
                $result['errors']['user_login'] = __("Please enter your email address.", THEME_TEXTDOMAIN);
            } else if( ! is_email( $email )) {
                $result['errors']['user_login'] = __("Invalid email address.", THEME_TEXTDOMAIN);
            } else if( ! email_exists( $email ) ) {
                $result['errors']['user_login'] = __('There’s no user with provided E-mail', THEME_TEXTDOMAIN);
            } else {
                
                    $user = get_user_by( 'email', $email );
    
                    $mail = \WC()->mailer()->emails['EmailsRecoveryPassword']->trigger( $user );
                    
                    if( $mail ) {
                        
                        $result['status'] = true;
                        
                        $result['errors']['user_login'] = __("Check your email address for a new password.", THEME_TEXTDOMAIN);
                    }
            }
            
            if (sizeof($result['errors']) > 1) {
                        
                       $result['errors_message'] = __('Please fill up all required fields', THEME_TEXTDOMAIN);
                    
            } else {
                       $result['errors_message'] = implode('<br/>', $result['errors']); 
            }
	    }
           
        header("Content-type: application/json;charset=utf-8");

        echo json_encode($result);

        die();
    }
    
    // used for tracking error messages
    public function errors(){
        
            static $wp_error; // Will hold global variable safely
            
            return isset($wp_error) ? $wp_error : ($wp_error = new \WP_Error(null, null, null));
    }

    public function verify_user_code() {
        
       $result = ['status' => false, 'redirect' => '', 'errors' => [], 'errors_message' => ''];
 
	   if(isset($_POST['forgot_password_confirm_nonce']) && wp_verify_nonce($_POST['forgot_password_confirm_nonce'], 'forgot_password_confirm-nonce')) {
	          $errors = [];
           
              $id = sanitize_text_field($_POST['id']) ?? '';
              
              $code = sanitize_text_field($_POST['code']) ?? '';
           
              $password = sanitize_text_field($_POST['password']) ?? '';
              
              $passwordConfirmation = sanitize_text_field($_POST['passwordConfirmation']) ?? '';
              
              $code_confirm = get_user_meta((int)$id, 'new_password_confirmation_code', true);
              
              if ($password == '') {
                
                  $errors['password'] =  __('The Password is required', THEME_TEXTDOMAIN);
              }
              
              if ($passwordConfirmation == '') {
                
                  $errors['passwordConfirmation'] =  __('The Confirm Password is required', THEME_TEXTDOMAIN);
              }
              
              if ($password != '' && $passwordConfirmation != '' && $password != $passwordConfirmation) {
                    
                 $errors['password'] =  __('Password and Confirm password are not matched. ', THEME_TEXTDOMAIN);
              }
              
              if(!$code_confirm || ($code_confirm && $code_confirm != $code)) {
                  $errors['password'] =  __('Invalid code', THEME_TEXTDOMAIN);
              }
              
              $result['errors'] = $errors;
                  
              if (sizeof($result['errors']) > 1) {
                        
                       $result['errors_message'] = __('Please fill up all required fields', THEME_TEXTDOMAIN);
                    
              } else {
                       $result['errors_message'] = implode('<br/>', $result['errors']); 
              }
              
              if(!sizeof($errors)) {
                    
                     $update_user = wp_update_user( array (
                                                                'ID' => $id, 
                                                                'user_pass' => $password
                                                        )
                                                 );
                                                 
                     delete_user_meta($id, 'new_password_confirmation_code');
                     
                     update_user_meta($id, 'account_activated', 1);
                    
                     $creds = array();
                         
                     $creds['user_login'] = get_user_by( 'id',$id)->user_login;
                       
                     $creds['user_password'] = $password;
                         
                     $creds['remember'] = true;

                     $user = wp_signon( $creds, true );
                     
                     $result['status'] = true;
                                    
                     $result['redirect'] = function_exists('wc_get_account_endpoint_url') ? get_permalink( wc_get_page_id( 'myaccount' ) ) : get_home_url(); 
              }
       }
           
       header("Content-type: application/json;charset=utf-8");

       echo json_encode($result);

       die();
    }
    
    public function forgot_password_confirm() {
        
            global $wp_query;
        
            $queried_object = get_queried_object();
        
            if ( !is_user_logged_in() && (is_page() || is_single()) && !is_front_page()) {

                     if (isset($_GET['password-confirm']) && $queried_object -> ID == get_password_recovery_page_id()) {
                            $data = unserialize(base64_decode($_GET['password-confirm']));
                 
                            $code = get_user_meta((int)$data['id'], 'new_password_confirmation_code', true);
                            
                            // verify whether the code given is the same as ours
                            if(!$code || ($code && $code != $data['code'])) {
                                 wp_redirect( get_sign_in_url());
                                 exit;    
                            }
                    }
            } 
    } 
    
    static public function get_url() {
        
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