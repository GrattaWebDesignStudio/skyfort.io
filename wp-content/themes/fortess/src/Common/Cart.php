<?php
namespace Fortess\Common;

use Fortess\Theme;

if ( !defined('ABSPATH') ) exit;

class Cart {
    
    private $theme;

	public function __construct( Theme $theme ) {
	   
	    $this->theme = $theme;

        remove_all_actions('woocommerce_checkout_terms_and_conditions');
        
        add_filter('woocommerce_checkout_fields', array($this, 'custom_checkout_fields_class_attribute_value'), 20, 1);
        
        add_filter( 'woocommerce_default_address_fields' ,  array($this, 'checkout_disable_address_fields_validation') );
        
        add_filter( 'woocommerce_checkout_fields',   array($this, 'checkout_remove_fields'), 999 );
        
        add_filter( 'woocommerce_checkout_fields' ,  array($this, 'checkout_not_required_fields'), 999 );

        add_filter( 'woocommerce_is_sold_individually', array($this, 'wc_remove_all_quantity_fields'), 10, 2 );
        
        add_filter( 'woocommerce_add_to_cart_validation', array($this, 'remove_cart_item_before_add_to_cart'), 20, 3 );
        
        add_action( 'template_redirect', array($this, 'redirect_to_checkout_if_cart') );
        
        remove_action( 'woocommerce_review_order_after_order_total', 'action_woocommerce_review_order_after_order_total', 10, 0 );
        
        remove_action( 'woocommerce_review_order_after_order_total', 'WC_Subscriptions_Cart::display_recurring_totals' );
        
        add_filter( 'woocommerce_cart_needs_shipping', '__return_false' );
        
        add_filter( 'woocommerce_coupons_enabled', '__return_false' );
        
        //add_filter( 'woocommerce_cart_needs_payment', '__return_false' );
        
        add_filter( 'wc_add_to_cart_message_html', '__return_false' );
        
        add_action( 'woocommerce_checkout_update_order_meta', array($this, 'account_register') );
    }
    
    public function checkout_disable_address_fields_validation( $address_fields_array ) {
 
	       unset( $address_fields_array['state']['validate']);
	       unset( $address_fields_array['postcode']['validate']);
	       // you can also hook first_name and last_name, company, country, city, address_1 and address_2
 
	       return $address_fields_array;
 
    }
    
    public function checkout_remove_fields( $woo_checkout_fields_array ) {
 
	       // she wanted me to leave these fields in checkout
	       // unset( $woo_checkout_fields_array['billing']['billing_first_name'] );
	       //unset( $woo_checkout_fields_array['billing']['billing_last_name'] );
   	       unset( $woo_checkout_fields_array['billing']['billing_phone'] );
	       unset( $woo_checkout_fields_array['billing']['billing_email'] );
	       // unset( $woo_checkout_fields_array['order']['order_comments'] ); // remove order notes
 
	       // and to remove the billing fields below
	       //unset( $woo_checkout_fields_array['billing']['billing_company'] ); // remove company field
	       //unset( $woo_checkout_fields_array['billing']['billing_country'] );
	       //unset( $woo_checkout_fields_array['billing']['billing_address_1'] );
	       //unset( $woo_checkout_fields_array['billing']['billing_address_2'] );
	       //unset( $woo_checkout_fields_array['billing']['billing_city'] );
	       //unset( $woo_checkout_fields_array['billing']['billing_state'] ); // remove state field
	       //unset( $woo_checkout_fields_array['billing']['billing_postcode'] ); // remove zip code field

           unset( $woo_checkout_fields_array['shipping']['shipping_first_name'] );
	       unset( $woo_checkout_fields_array['shipping']['shipping_last_name'] );
           unset( $woo_checkout_fields_array['shipping']['shipping_country'] );
           unset( $woo_checkout_fields_array['shipping']['shipping_city'] );
           unset( $woo_checkout_fields_array['shipping']['shipping_company'] );
           unset( $woo_checkout_fields_array['shipping']['shipping_state'] ); // remove zip code field
           unset( $woo_checkout_fields_array['shipping']['shipping_postcode'] ); // remove zip code field
           unset( $woo_checkout_fields_array['shipping']['shipping_address_2'] );
            
           $woo_checkout_fields_array['billing']['billing_company']['label'] =  __('Company name', THEME_TEXTDOMAIN);
           $woo_checkout_fields_array['billing']['billing_city']['label'] =  __('Town / City', THEME_TEXTDOMAIN);
           $woo_checkout_fields_array['billing']['billing_address_1']['label'] =  __('House number and street name', THEME_TEXTDOMAIN);
           $woo_checkout_fields_array['billing']['billing_address_2']['label'] =  __('Apartment, suite, unit etc.', THEME_TEXTDOMAIN);
           $woo_checkout_fields_array['billing']['billing_postcode']['label'] =  __('Postcode', THEME_TEXTDOMAIN);
           
           $current_user_id = get_current_user_id();
          
           //if (!get_user_meta( $current_user_id, '_ref_id',  true )  && get_user_meta( $current_user_id, 'team-status',  true ) == 1) {
           
           /*
           $woo_checkout_fields_array['billing']['billing_team_status'] = array(
		                                                     'type'       => 'checkbox',
                                                             'class'      => array(),
                                                             'label_class' =>  array('form__label'),
                                                             'input_class' => array(),
                                                             'label'      => __('Team', THEME_TEXTDOMAIN),
                                                             'placeholder'    => __('Team ', THEME_TEXTDOMAIN),
                                                             'required' => false
	                                   );
           */                            
           //}
           
           $woo_checkout_fields_array['account']    = array(
                                                                'billing_email' => array(
                                                                    'type' => 'text',
                                                                    'label' => __('Email address', THEME_TEXTDOMAIN),
                                                                    'label_class' => array('form__label'),
                                                                    'placeholder' => _x('Enter your e-mail', 'placeholder', THEME_TEXTDOMAIN),
                                                                    'required' => true
                                                                ),
                                                                'billing_phone' => array(
                                                                    'type' => 'text',
                                                                    'label' => __('Phone', THEME_TEXTDOMAIN),
                                                                    'label_class' => array('form__label'),
                                                                    'placeholder' => _x('Enter your phone number', 'placeholder', THEME_TEXTDOMAIN),
                                                                    'required' => true
                                                                ),
                                                                'account_password' => array(
                                                                    'type' => 'password',
                                                                    'label' => __('Password', THEME_TEXTDOMAIN),
                                                                    'label_class' => array('form__label'),
                                                                    'placeholder' => _x('Enter password', 'placeholder', THEME_TEXTDOMAIN),
                                                                    'required' => true
                                                                ),
                                                               'account_password-2' => array(
                                                                   'type' => 'password',
                                                                   'label' => __('Confirm password', THEME_TEXTDOMAIN),
                                                                   'label_class' => array('form__label'),
                                                                   'placeholder' => _x('Enter password again', 'placeholder', THEME_TEXTDOMAIN),
                                                                   'required' => true
                                                                )
                                                           );
           
	       return $woo_checkout_fields_array;
    }
    
    public function checkout_not_required_fields( $f ) {
        
           $f['billing']['billing_company']['required'] = false; 
        
           foreach ( \WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            
                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                
                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    
                    if (strpos($_product->get_name(), 'Team') !== false) {
                        $f['billing']['billing_company']['required'] = true;
                    }
                }
           }

           unset( $f['shipping']['shipping_address_1']['required'] );
 
	       return $f;
    }
    
    public function custom_checkout_fields_class_attribute_value( $fields ) {
        
            foreach( $fields as $fields_group_key => $group_fields_values ){
                foreach( $group_fields_values as $field_key => $field ){
                    // Remove other classes (or set yours)
                        $fields[$fields_group_key][$field_key]['class'] = array(); 
                 }
            }       

             return $fields;
    }
    
    public function wc_remove_all_quantity_fields( $return, $product ) {
            return true;
    }
    
    public function remove_cart_item_before_add_to_cart( $passed, $product_id, $quantity ) {
            if( ! \WC()->cart->is_empty() )
                    \WC()->cart->empty_cart();
            return $passed;
    }
    
    public function redirect_to_checkout_if_cart() {
	
	       if ( !is_cart() ) return;

	       global $woocommerce;

	       if ( $woocommerce->cart->is_empty() ) {
		          // If empty cart redirect to home
		          wp_redirect( get_home_url(), 302 );
           } else {
		          // Else redirect to check out url
		          wp_redirect( $woocommerce->cart->get_checkout_url(), 302 );
	       }
	
	       exit;
    }
    
    public function account_register( $order_id ){

    }
}