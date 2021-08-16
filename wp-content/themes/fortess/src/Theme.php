<?php
namespace Fortess;

use Fortess\Guest\ForgotPassword;
use Fortess\Guest\Login;
use Fortess\Guest\Registration;
use Fortess\Common\Blog;
use Fortess\Common\Pricing;
use Fortess\Common\About;
use Fortess\Common\Cart;
use Fortess\User\Account;
use Fortess\Emails\Emails;

if(!defined('ABSPATH')) return;

class Theme {

    private function __construct() {
        
        $this -> load_dependencies();
        
        add_action('template_redirect', array($this, 'account_guest_redirect'));   
        
        add_action('template_redirect', array($this, 'sign_up_promo_redirect'));  
        
        add_filter( 'manage_users_columns', array($this, 'modify_user_table') );
        
        add_filter( 'manage_users_custom_column', array($this, 'modify_user_table_row'), 10, 3 );
        
        add_filter('query_vars', array($this ,'query_vars'));
         
        add_action('admin_init', array($this,  'user_activation_admin'), 0  );
    }
    
    private function load_dependencies() {
        
        new Blog($this);
        new Pricing($this);
        new About($this);
        new Cart($this);
   	             
        if ( is_user_logged_in() ) {
            new Account($this);
		} else {
            new ForgotPassword($this);
            new Login($this);
		}
        
        new Registration($this);
        new Emails($this);
	}
    
    public static function instance() {
		static $instance;
		if(!is_object($instance)) $instance = new self();
		return $instance;
    }
    
    public function account_guest_redirect() {
        
            global $wp_query;
        
            $queried_object = get_queried_object();
        
            if ( is_user_logged_in() && (is_page() || is_single()) && !is_front_page()) {
                
                $signPages = query_posts( array(
                                                    'fields' => 'ids',
                                                    'post_type' => 'page',
                                                    'meta_query' => array(
                                                    'relation' => 'AND',
                                                             array(
                                                                    'relation' => 'OR',
                                                                    array(
                                                                            'key' => '_wp_page_template',
                                                                            'value' => 'login.php'
                                                                         ),
                                                                    array(
                                                                            'key' => '_wp_page_template',
                                                                            'value' => 'sign-up.php'
                                                                         ),
                                                                    array(
                                                                            'key' => '_wp_page_template',
                                                                            'value' => 'reset-password.php'
                                                                         )                
                                                                ),
                                                    )
                                        ) );
                                        
                wp_reset_query();
                                        
                if (is_array($signPages) && in_array($queried_object -> ID, $signPages)) {
                    
                    wp_redirect( get_permalink( wc_get_page_id( 'myaccount' ) ) );
                    
                    exit;
                }
                
            } elseif (! is_user_logged_in() && is_plugin_active("woocommerce/woocommerce.php") && is_account_page()) {
                
                wp_redirect( get_sign_in_url());
                    
                exit;
            }
     } 
     
     public function sign_up_promo_redirect() {
        
            global $wp_query;
        
            $queried_object = get_queried_object();
        
            if ( !is_user_logged_in() && (is_page() || is_single()) && !is_front_page()) {
                
                $signPages = query_posts( array(
                                                    'fields' => 'ids',
                                                    'post_type' => 'page',
                                                    'meta_query' => array(
                                                    'relation' => 'AND',
                                                             array(
                                                                    'relation' => 'OR',
                                                                    array(
                                                                            'key' => '_wp_page_template',
                                                                            'value' => 'sign-up.php'
                                                                         )             
                                                                ),
                                                    )
                                        ) );
                                        
                wp_reset_query();
                                        
                if (is_array($signPages) && in_array($queried_object -> ID, $signPages) && get_field('promo_mode', 'options-settings')) {
                    
                    $args = [
                                        'post_type' => 'page',
                                        'fields' => 'ids',
                                        'nopaging' => true,
                                        'meta_key' => '_wp_page_template',
                                        'meta_value' => 'mainpage.php'
                        
                    ];
                
                    $pages = get_posts( $args );
            
                    if ($pages) {
                
                        wp_redirect( get_the_permalink($pages[0]).'#section-sign' );
                        
                        exit;
                    } 
                }
                
            } 
     }
     
     public function modify_user_table( $column ) {
         
            $column['user-activated'] = __('Activation', THEME_TEXTDOMAIN);
            
            return $column;
    }
    
    public function query_vars($query_vars) {
            $query_vars[] = 'act';

            return $query_vars;
    }

    public function modify_user_table_row( $val, $column_name, $user_id ) {
            switch ($column_name) {
                case 'user-activated' : 
                
                    $userdata = get_userdata( $user_id );
                    
                    $link = admin_url( 'users.php?act=user_active&user_id='.$user_id ) ;
                
                    if (get_user_meta( $user_id, 'account_activated', true ) != 1) {
                        
                        return '<a href="'.$link.'">'.__( 'Pending', THEME_TEXTDOMAIN).'</a>';
                        
                    } else {
                        
                        return '<a href="'.$link.'">'.__( 'Active', THEME_TEXTDOMAIN).'</a>';
                    }
            
                default:
            }
            return $val;
    }
    
   public function user_activation_admin() {
    
        $action = $_REQUEST['act'] ?? false;

        if ($action == 'user_active') {
         
            if (!current_user_can('edit_user')) {
                return;
            }

            if (isset($_REQUEST['user_id'])) {
                
                $user_id = $_GET['user_id'] ?? 0;

                $status_activated = (get_user_meta( $user_id, 'account_activated', true ) == 1) ? true : false;
                
                if ($status_activated) {
                
                    update_user_meta($user_id, 'account_activated', 0);
                
                } else {
                              
                    update_user_meta($user_id, 'account_activated', 1);
                }

                wp_redirect(admin_url('/users.php'), 301);
            
                exit;
            }   
        }
   }
}