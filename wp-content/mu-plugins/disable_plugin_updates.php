<?php
function disable_plugin_updates( $value ) {
        if ( isset($value) && is_object($value) && isset( $value->response['advanced-custom-fields-pro/acf.php'] ) ) {
                        unset( $value->response['advanced-custom-fields-pro/acf.php'] );
        }
	if ( isset($value) && is_object($value) && isset( $value->response['woocommerce-follow-up-emails/woocommerce-follow-up-emails.php'] ) ) {
                        unset( $value->response['woocommerce-follow-up-emails/woocommerce-follow-up-emails.php'] );
        }
	if ( isset($value) && is_object($value) && isset( $value->response['woocommerce-subscriptions/woocommerce-subscriptions.php'] ) ) {
                        unset( $value->response['woocommerce-subscriptions/woocommerce-subscriptions.php'] );
        }	
	if ( isset($value) && is_object($value) && isset( $value->response['contact-form-7/wp-contact-form-7.php'] ) ) {
                        unset( $value->response['contact-form-7/wp-contact-form-7.php'] );
        }
        return $value;
}

add_filter( 'site_transient_update_plugins', 'disable_plugin_updates'); 