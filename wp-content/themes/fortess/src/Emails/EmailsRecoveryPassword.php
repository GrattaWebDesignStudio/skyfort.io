<?php
namespace Fortess\Emails;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WC_Email' ) ) {
	return;
}

class EmailsRecoveryPassword extends \WC_Email {
    
     public $user;
     
     public $url_confirmation;
    
 	 /**
	 * Create an instance of the class.
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {

		$this->id          = 'wc_user_password_recovery';
		$this->title       = __( 'Password recovery', THEME_TEXTDOMAIN );
		$this->description = __( 'An email sent to the customer when the password is recovered', THEME_TEXTDOMAIN );

		$this->customer_email = true;
		$this->heading     = __( 'Password recovery', THEME_TEXTDOMAIN );
		// translators: placeholder is {blogname}, a variable that will be substituted when email is sent out
		$this->subject     = sprintf( _x( '[%s] Password recovery', 'default email subject sent to the customer', THEME_TEXTDOMAIN ), '{blogname}' );
    

		$this->template_html  = 'email/password-revovery.php';
		$this->template_plain = 'email/plain/password-revovery.php';
		$this->template_base  = THEME_DIRECTORY . '/';

		parent::__construct();
	}
    
    /**
	 * Get content html.
	 *
	 * @access public
	 * @return string
	 */
	public function get_content_html() {
		return wc_get_template_html( $this->template_html, array(
			'email_heading' => $this->get_heading(),
            'additional_content' => $this->get_additional_content(),
			'sent_to_admin' => false,
			'plain_text'    => false,
			'email'			=> $this,
            'url_confirmation' => $this -> url_confirmation
		), '', $this->template_base );
	}

	/**
	 * Get content plain.
	 *
	 * @return string
	 */
	public function get_content_plain() {
		return wc_get_template_html( $this->template_plain, array(
			'email_heading' => $this->get_heading(),
            'additional_content' => $this->get_additional_content(),
			'sent_to_admin' => false,
			'plain_text'    => true,
			'email'			=> $this,
            'url_confirmation' => $this -> url_confirmation
		), '', $this->template_base );
	}
  
     /**
	 * Trigger Function that will send this email to the customer.
	 *
	 * @access public
	 * @return void
	 */
	public function trigger( $user = false ) {
	   
        $this->setup_locale();
  
        $this -> user = $user;

		$this->recipient = $user -> user_email;
        
		if ( ! $this->is_enabled() || ! $this->get_recipient() ) {
			return;
		}
        
        $code = md5(time());
                               
        update_user_meta($user->ID, 'new_password_confirmation_code', $code);
        
        $this -> url_confirmation = get_password_recovery_url(). '?password-confirm=' .base64_encode( serialize(array('id' => $user->ID, 'code' => $code)));
                          
        $result = $this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
        
        $this->restore_locale();
        
        return $result;
	}
}