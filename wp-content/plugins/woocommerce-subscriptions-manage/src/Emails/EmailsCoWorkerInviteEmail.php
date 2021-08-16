<?php
namespace WoocommerceSubscriptionsManage\Emails;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WC_Email' ) ) {
	return;
}

class EmailsCoWorkerInviteEmail extends \WC_Email {
    
     private $coworker_ref_link;
     
     private $team_user;
    
 	 /**
	 * Create an instance of the class.
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {

		$this->id          = 'wc_co_workers_invite';
		$this->title       = __( 'Registration invitation link', WOOCOMMERCE_SUBCRIPTIONS_MANAGE_TEXTDOMAIN );
		$this->description = __( 'An email sent to the customer when the user is invited ', WOOCOMMERCE_SUBCRIPTIONS_MANAGE_TEXTDOMAIN );

		$this->customer_email = true;
		$this->heading     = __( 'Registration invitation link', WOOCOMMERCE_SUBCRIPTIONS_MANAGE_TEXTDOMAIN );
		// translators: placeholder is {blogname}, a variable that will be substituted when email is sent out
		$this->subject     = sprintf( _x( '[%s] Registration invitation link', WOOCOMMERCE_SUBCRIPTIONS_MANAGE_TEXTDOMAIN ), '{blogname}' );

		$this->template_html  = 'email/co-workers-invite.php';
		$this->template_plain = 'email/plain/co-workers-invite.php';
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
            'coworker_ref_link' => $this -> coworker_ref_link,
            'team_user' => $this -> team_user
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
            'coworker_ref_link' => $this -> coworker_ref_link,
            'team_user' => $this -> team_user
		), '', $this->template_base );
	}
  
     /**
	 * Trigger Function that will send this email to the customer.
	 *
	 * @access public
	 * @return void
	 */
	public function trigger( $email, $coworker_ref_link, $team_user ) {
	   
        $this->setup_locale();
        
        $this->recipient = $email;
  
		if ( ! $this->is_enabled() || ! $this->get_recipient() ) {
			return;
		}
        
        $this -> coworker_ref_link = $coworker_ref_link;
     
        $this -> team_user = $team_user;
         
        $result = $this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
        
        $this->restore_locale();
        
        return $result;
	}
}