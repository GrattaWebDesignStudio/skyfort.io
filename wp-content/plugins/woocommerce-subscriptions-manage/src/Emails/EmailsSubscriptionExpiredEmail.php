<?php
namespace WoocommerceSubscriptionsManage\Emails;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WC_Email' ) ) {
	return;
}

class EmailsSubscriptionExpiredEmail extends \WC_Email {
    
     private $pay_url;
    
 	 /**
	 * Create an instance of the class.
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {

		$this->id          = 'wc_subscription_expired';
		$this->title       = __( 'Your subscription has expired', WOOCOMMERCE_SUBCRIPTIONS_MANAGE_TEXTDOMAIN );
		$this->description = __( 'Your subscription has expired ', WOOCOMMERCE_SUBCRIPTIONS_MANAGE_TEXTDOMAIN );

		$this->customer_email = true;
		$this->heading     = __( 'Your subscription has expired', WOOCOMMERCE_SUBCRIPTIONS_MANAGE_TEXTDOMAIN );
		// translators: placeholder is {blogname}, a variable that will be substituted when email is sent out
		$this->subject     =__( 'Your subscription has expired', WOOCOMMERCE_SUBCRIPTIONS_MANAGE_TEXTDOMAIN );

		$this->template_html  = 'email/subscription-expired.php';
		$this->template_plain = 'email/plain/subscription-expired.php';
		$this->template_base  = WOOCOMMERCE_SUBCRIPTIONS_MANAGE_PATH . '/templates/';

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
            'pay_url' => $this -> pay_url
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
            'pay_url' => $this -> pay_url
		), '', $this->template_base );
	}
  
     /**
	 * Trigger Function that will send this email to the customer.
	 *
	 * @access public
	 * @return void
	 */
	public function trigger( $email, $pay_url) {
	   
        $this->setup_locale();
        
        $this->recipient = $email;
  
		if ( ! $this->is_enabled() || ! $this->get_recipient() ) {
			return;
		}
        
        $this -> pay_url = $pay_url;

        $result = $this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
        
        $this->restore_locale();
        
        return $result;
	}
}