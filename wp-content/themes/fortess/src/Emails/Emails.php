<?php
namespace Fortess\Emails;

use Fortess\Plugin;
use Fortess\Emails\EmailsRecoveryPassword;
use Fortess\Emails\EmailsRegistration;

if(!defined('ABSPATH')) return;

use Fortess\Theme;

class Emails {
    
     private $theme;

	public function __construct( Theme $theme ) {
	   
	    $this->theme = $theme;

		add_filter( 'woocommerce_email_classes', array( $this, 'register_email' ), 90, 1 );
	}

	public function register_email( $emails ) {

        	$emails['EmailsRecoveryPassword'] = new EmailsRecoveryPassword();
        	$emails['EmailsRegistration'] = new EmailsRegistration();

		return $emails;
	}
}