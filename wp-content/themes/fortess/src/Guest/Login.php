<?php
namespace Fortess\Guest;

use Fortess\Theme;

if ( !defined('ABSPATH') ) exit;

class Login {
    
    private $theme;

	public function __construct( Theme $theme ) {
	   
	   $this->theme = $theme;
        
       add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts')); 
        
       //add_filter( 'login_redirect', array($this, 'users_login_redirect'), 10, 3 );
       
       add_action( 'wp_authenticate', array($this,'email_address_login' ));
       
       add_action('wp_ajax_nopriv_login_member', array( $this, 'login_member') );
    }
    
    public function enqueue_scripts() {
        wp_register_script('login-scripts', THEME_DIRECTORY_URI. '/js/login.js', array(),_THEME_VERSION,true);
        
        wp_localize_script('login-scripts', 'ajaxurl', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

        wp_enqueue_script('login-scripts' );
    }

    public function users_login_redirect($redirect_to, $request, $user) {
        
         if( isset( $user->roles ) && is_array( $user->roles )) {
            
                return '';
         }
    }

    public function email_address_login($username) {
        
        $user = get_user_by( 'email', $username );
        
        if(!empty($user->user_login)) {
            $username = $user->user_login;
        }
        return $username;
    }
    
    // logs a member in after submitting a form
    public function login_member() {
        
           $result = ['status' => false, 'redirect' => '', 'errors' => [], 'errors_message' => ''];
 
	       if(isset($_POST['user_login']) && wp_verify_nonce($_POST['login_nonce'], 'login-nonce')) {
	           
                  $user_remember = $_POST['user_remember'] ?? 0; 
 
		          // this returns the user ID and other info from the user name
	         	  $user = get_user_by( 'email', $_POST['user_login'] );
                  
                  if (!$user) {
                        $user = get_user_by( 'login', $_POST['user_login'] );
                  }
 
		          if(!$user) {
                             $result['errors']['user_login'] =  __('Invalid username or e-mail', THEME_TEXTDOMAIN);
		          }
 
		          if(!isset($_POST['user_pass']) || $_POST['user_pass'] == '') {
			             // if no password was entered
                         $result['errors']['user_pass'] =  __('Enter password', THEME_TEXTDOMAIN);
		          }
 
		          // check the user's login with their password
		          if($user && !wp_check_password($_POST['user_pass'], $user->user_pass, $user->ID)) {
			             // if the password is incorrect for the specified user
                         $result['errors']['user_login'] =  __('Invalid email or password', THEME_TEXTDOMAIN);
		          }
                  
                  $userdata = get_userdata( $user->ID );
                  
                  if($user && !(in_array( 'administrator', (array) $userdata->roles )) && get_user_meta( $user->ID, 'account_activated', true ) != 1) {
			             // if no password was entered
                         $result['errors']['user_login'] =  __('Account not verified. Follow the link sent to your e-mail.', THEME_TEXTDOMAIN);
		          }
                  
                  $result['errors_message'] = implode('<br/>', $result['errors']);
                  
		          // only log the user in if there are no errors
		          if(!sizeof($result['errors'])) {
		              
                         $creds = array();
                         
                         $creds['user_login'] = $user->user_login;
                         
                         $creds['user_password'] = $_POST['user_pass'];
                         
                         $creds['remember'] = ($user_remember) ? true : false;

                         $user = wp_signon( $creds, true );

                         if ( !is_wp_error($user) ) {
     
                            $result['status'] = true;
                            
                            $userdata = get_userdata( $user->ID );
                            
                            if (function_exists('wc_get_page_id')) {
                                $result['redirect'] = get_permalink( wc_get_page_id( 'myaccount' ) ); 
                            } else {
                                $result['redirect'] = ''; 
                            }
                         } else {
                            
                            $result['errors']['user_login'] =  $user->get_error_message();
                         }
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
    
    static public function get_url() {
        
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