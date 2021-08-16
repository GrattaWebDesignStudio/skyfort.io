<?php
namespace WoocommerceSubscriptionsManage\Emails;

use WoocommerceSubscriptionsManage\Plugin;
use WoocommerceSubscriptionsManage\Emails\EmailsCoWorkerInviteEmail;
use WoocommerceSubscriptionsManage\Emails\EmailsSubscriptionExpiredEmail;

if(!defined('ABSPATH')) return;

class Emails {
    
    private $plugin;

	public function  __construct(Plugin $plugin) {
	   
        $this->plugin = $plugin;

		add_filter( 'woocommerce_email_classes', array( $this, 'register_email' ), 90, 1 );
	}

	public function register_email( $emails ) {

        $emails['EmailsCoWorkerInviteEmail'] = new EmailsCoWorkerInviteEmail();
        
        $emails['EmailsSubscriptionExpired'] = new EmailsSubscriptionExpiredEmail();

		return $emails;
	}
}