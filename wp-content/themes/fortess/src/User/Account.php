<?php
namespace Fortess\User;

use Fortess\Theme;

if ( !defined('ABSPATH') ) exit;

class Account {
     
        private $theme;

        public function __construct( Theme $theme ) {
	   
            $this->theme = $theme;
            
            add_filter( 'woocommerce_account_menu_items', array($this, 'account_menu_items'), 10, 1 ); 
            
            add_action( 'woocommerce_save_account_details', array($this,'save_additional_fields_account_details'), 12, 1 );
            
            add_filter('woocommerce_save_account_details_required_fields', array($this,'remove_required_fields'));
            
		    remove_action( 'woocommerce_after_edit_address_form_billing', 'WC_Subscriptions_Addresses::maybe_add_edit_address_checkbox', 10 );
            
		    remove_action( 'woocommerce_after_edit_address_form_shipping',  'WC_Subscriptions_Addresses::maybe_add_edit_address_checkbox', 10 );
            
            add_filter( 'woocommerce_billing_fields', array($this,'custom_billing_fields') );
            
            add_filter( 'woocommerce_shipping_fields', array($this,'custom_shipping_fields') );
            
            if (is_account_page()) {
                 add_filter( 'the_title',  array($this,'woo_endpoint_title'), 10, 2 );
            }
            
            remove_all_actions( 'woocommerce_subscription_details_after_subscription_table');
       }
       
       public function account_menu_items( $items ) {
        
            unset($items['downloads']);
            
            unset($items['payment-methods']);
            
            $items['edit-account'] = __( 'Account details', WOOCOMMERCE_AWGT_CABINET_TEXTDOMAIN );
            
            //$items['orders'] = __( 'Billing', WOOCOMMERCE_AWGT_CABINET_TEXTDOMAIN );
            
            $items['edit-address'] = __( 'Addresses', WOOCOMMERCE_AWGT_CABINET_TEXTDOMAIN );
            
            $items['subscriptions'] = __( 'Billing', WOOCOMMERCE_AWGT_CABINET_TEXTDOMAIN );
    
            $items_tmp = [
                            //'orders' => $items['orders'],
                            'subscriptions' => $items['subscriptions'],
                            'edit-address' => $items['edit-address'],
                            'edit-account' => $items['edit-account'],
                            'customer-logout' => $items['customer-logout']
                         ];

            return $items_tmp;
      }
      
      public function save_additional_fields_account_details( $user_id ) {

            if( isset( $_POST['user-phone'] ) ) {
                update_user_meta( $user_id, 'user-phone', sanitize_text_field( $_POST['user-phone'] ) );
                
                update_user_meta( $user_id, 'billing_phone', sanitize_text_field( $_POST['user-phone'] ) );
            }
            
            if (isset($_POST['billing_company'])) {
                update_user_meta( $user_id, 'billing_company', sanitize_text_field( $_POST['billing_company'] ) );
            }
      }
      
      public function remove_required_fields( $required_fields ) {
        
            unset($required_fields['account_display_name']);

            return $required_fields;
      }
      
      public function custom_billing_fields( $fields ) {
        
           unset($fields['billing_phone']);
           
           unset($fields['billing_email']);
           
           $fields['billing_address_2']['label'] =  $fields['billing_address_2']['placeholder'];
           
           foreach ($fields as $key => $field) :
           
                if (isset($fields[$key]['label_class'])) {
                    
                    $fields[$key]['label_class'][] = 'form__label';
                    
                } else {
                    
                    $fields[$key]['label_class'] = 'form__label';
                }

           endforeach;

	       return $fields;
 
      }
      
      public function custom_shipping_fields( $fields ) {
        
           unset($fields['shipping_phone']);
           
           unset($fields['shipping_email']);  
           
           $fields['shipping_address_2']['label'] =  $fields['shipping_address_2']['placeholder'];
           
           foreach ($fields as $key => $field) :
           
                if (isset($fields[$key]['label_class'])) {
                    
                    $fields[$key]['label_class'][] = 'form__label';
                    
                } else {
                    
                    $fields[$key]['label_class'] = 'form__label';
                }

           endforeach;

	       return $fields;
 
      }
      
      public function woo_endpoint_title( $title, $id ) {

	       if ( is_account_page() && is_wc_endpoint_url( 'orders' ) && in_the_loop() ) {
	               	$title = __( 'Billing', WOOCOMMERCE_AWGT_CABINET_TEXTDOMAIN );
	       }

	       return $title;
    }
}