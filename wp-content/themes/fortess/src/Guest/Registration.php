<?php
namespace Fortess\Guest;

use Fortess\Theme;

if ( !defined('ABSPATH') ) exit;

class Registration {
    
    private $theme;
    
    private $fiels = [];        

	public function __construct( Theme $theme ) {
	   
	   $this->theme = $theme;
       
       $this->fields = [
                            [
                                'name' => 'firstname',
                                'label'      => __('First Name', THEME_TEXTDOMAIN),
                                'required' => true
                            ],
                            [
                                'name' => 'lastname',
                                'label'      => __('Last name', THEME_TEXTDOMAIN),
                                'required' => true
                            ],
                            [
                                'name' => 'email',
                                'label'      => __('Email address', THEME_TEXTDOMAIN),
                                'required' => true
                            ],
                            [
                                'name' => 'mobilePhone',
                                'label'      => __('Phone', THEME_TEXTDOMAIN),
                                'required' => true
                            ],
                            [
                                'name' => 'password',
                                'label'      => __('Password', THEME_TEXTDOMAIN),
                                'required' => true
                            ],
                            [
                                'name' => 'passwordConfirmation',
                                'label'      => __('Confirm Password', THEME_TEXTDOMAIN),
                                'required' => true
                            ]
                       ];
        
       add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts')); 

       add_action('wp_ajax_nopriv_registration_member', array( $this, 'registration_member') );
       
       add_action( 'init', array($this, 'verify_user_code'), 0 );
       
       add_action( 'user_register', array($this, 'send_verify_user_code'), 10, 1 );
       
       //Remove original use created emails
	   remove_action( 'register_new_user', 'wp_send_new_user_notifications' );
       
	   remove_action( 'edit_user_created_user', 'wp_send_new_user_notifications', 10, 2 );
    }
    
    public function enqueue_scripts() {       
        wp_register_script('registration-scripts', THEME_DIRECTORY_URI. '/js/registration.js', array(),_THEME_VERSION,true);
        
        wp_localize_script('registration-scripts', 'ajaxurl', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

        wp_enqueue_script('registration-scripts' );
    }
    
    // logs a member in after submitting a form
    public function registration_member() {
        
           $result = ['status' => false, 'redirect' => '', 'errors' => [], 'errors_message' => ''];
 
	       if(wp_verify_nonce($_POST['registration_nonce'], 'registration-nonce')) {
	           
                  $errors = [];
                  
                  foreach ($this->fields as $field) :
                  
                    $name = $field['name'];
                  
                    if ((!isset($_POST[$field['name']]) || (isset($_POST[$field['name']]) && empty($_POST[$field['name']]))) && $field['required']) {
                        
                        $errors[$field['name']] = __('The', THEME_TEXTDOMAIN).' "'. $field['label'].'" '.__('is required', THEME_TEXTDOMAIN);
                    }
                    
                    $$name = sanitize_text_field($_POST[$field['name']]) ?? '';
     
                  endforeach;
 
                  if ($email != '' && is_email($email)) {
                
                            $user_by_email = get_user_by( 'email', $email );
                
                            if ($user_by_email) {
                    
                                   $errors['email'] =  __('User with '.$email.' e-mail is already registered in the System', THEME_TEXTDOMAIN);   
                            }
                
                  } else {
                
                            $errors['email'] =  __('The '.$email.' email is incorrect', THEME_TEXTDOMAIN);
                  }
                  
 
                  if ($password != '' && $passwordConfirmation != '' && $password != $passwordConfirmation) {
                    
                            $errors['password'] =  __('Password and Confirm password are not matched. ', THEME_TEXTDOMAIN);
                            
                  }

                  $result['errors'] = $errors;
                  
                  $result['errors_message'] = implode('<br/>', $result['errors']);
 
		          // only log the user in if there are no errors

                  if(!sizeof($errors)) {
		                  
                         $user_id = wp_create_user( $email, $password, $email ) ;

                         if ($user_id) {
                            
                                    $team_status = $_REQUEST['team-status'] ?? 0;
                            
                                    $args = array(
                                                            'ID'         => $user_id,
                                                            'display_name' => $firstname.' '.$lastname
                                                );
                                 
                                    wp_update_user( $args );
                                    
                                    $billing_data = array(
	                                                           'first_name'		=> $firstname,
                                                               'last_name'		=> $lastname,
                                                               'billing_email'         => $email,
                                                               'billing_phone'         => $mobilePhone,
	                                                           'billing_first_name'	=> $firstname,
	                                                           'billing_last_name'	=> $lastname,
                                                               'user-phone' => $mobilePhone,
                                                               'team-status' => $team_status
                                                          );
                                                          
                                    foreach ($billing_data as $billing_meta_key => $billing_meta_value ) {
                                            update_user_meta( $user_id, $billing_meta_key, $billing_meta_value );
                                    }
                                    
                                    $result['status'] = true;
                                    
                                    $result['redirect'] = ''; 
                         } 
		          }
	       }
           
           header("Content-type: application/json;charset=utf-8");

           echo json_encode($result);

           die();
    }
    
    /**
     * Registration::verify_user_code()
     * 
     * @return void
     */
    public function verify_user_code(){
        
            if(isset($_GET['act'])){
                $data = unserialize(base64_decode($_GET['act']));
                 
                $code = get_user_meta($data['id'], 'activation_code', true);
                
                // verify whether the code given is the same as ours
                if($code == $data['code']){
                    // update the user meta
                    update_user_meta($data['id'], 'account_activated', 1);
                    
                    //delete_user_meta($data['id'], 'activation_code');
                    
                    wp_set_auth_cookie((int)$data['id'], $remember = true);
                    
                    $url = function_exists('wc_get_account_endpoint_url') ? get_permalink( wc_get_page_id( 'myaccount' ) ) : get_home_url();

                    wp_safe_redirect( $url );
                      
                    exit;
                }
            }
    }
    
    static public function randomPassword() {
        
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            
            $pass = array(); //remember to declare $pass as an array
            
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            
            for ($i = 0; $i < 8; $i++) {
                     $n = rand(0, $alphaLength);
                 $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
    }
    
    public function send_verify_user_code($user_id) {
        
            // create the activation code and activation status       
            $code = md5(time());
                                    
            add_user_meta($user_id, 'account_activated', 0);
                                    
            add_user_meta($user_id, 'activation_code', $code);
                                                          
            wp_new_user_notification( $user_id);
    }
}


/**
 * Snippet Name: Customize registration emails sent to new users
 */
function wp_new_user_notification($user_id, $plaintext_pass = '') {
    
    $user = get_userdata( $user_id );
    
    $mail = \WC()->mailer()->emails['EmailsRegistration']->trigger( $user );
    
	/*
    $user = get_userdata( $user_id );

	// The blogname option is escaped with esc_html on the way into the database in sanitize_option
	// we want to reverse this for the plain text arena of emails.
	$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

	$message  = sprintf(__('Registration of a new user on the site  %s:', THEME_TEXTDOMAIN), $blogname) . "\r\n\r\n";
	$message .= sprintf(__('E-mail: %s', THEME_TEXTDOMAIN), $user->user_email) . "\r\n";

	@wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration', THEME_TEXTDOMAIN), $blogname), $message);

	//if ( empty($plaintext_pass) )
	//	return;

    $message  = '';
	$message  .= sprintf(__('E-mail: %s', THEME_TEXTDOMAIN), $user->user_email) . "<br/><br/>";
	//$message  .= sprintf(__('Password: %s', THEME_TEXTDOMAIN), $plaintext_pass) . "<br/><br/>";
	//$message .= 'To log into the admin area please us the following address ' . wp_login_url() . "<br/><br/>";
    
    $code = get_user_meta( $user_id, 'activation_code', true );
    
    $string = array('id' => $user_id, 'code' => $code);
    
    // create the url
    //$url = get_sign_in_url(). '?act=' .base64_encode( serialize($string));
    
    $url = get_home_url(). '?act=' .base64_encode( serialize($string));
            
    // basically we will edit here to make this nicer
    $message  .= __('Follow the link to confirm :', THEME_TEXTDOMAIN).' <br/><br/> <a href="'.$url.'">'.$url.'</a>';

    // send an email out to user
    
    add_filter( 'wp_mail_content_type', function($content_type){
	       return "text/html";
    });
    
	wp_mail($user->user_email, sprintf(__('Registration on the site - MAIL CONFIRMATION', THEME_TEXTDOMAIN), $blogname), $message);
    
    remove_all_filters( 'wp_mail_content_type' );
    */
}