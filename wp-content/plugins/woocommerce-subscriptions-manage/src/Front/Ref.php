<?php
namespace WoocommerceSubscriptionsManage\Front;

use WoocommerceSubscriptionsManage\Plugin;

if ( !defined('ABSPATH') ) exit;

class Ref {
    
    private $plugin;
    
	public function __construct(Plugin $plugin) {
	   
        $this->plugin = $plugin;
        
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts')); 
        
        add_shortcode('woocommerce-loyalty-ref-link', array($this, 'account_page_show_link') );
        
        add_action( 'user_register', array($this, 'save_ref_id'), 10, 1 );
        
        add_action( 'template_redirect', array($this, 'redirect_to_registration') );
        
    }

	public function save_ref_id($user_id) {
	   
		if ( isset($_POST["ref"])) {
		  
			$refID = sanitize_text_field($_POST["ref"]);
            
            $args = array(
                        'meta_query' => array(
                                            array(
                                                    'key' => '_referral_id',
                                                    'value' => $refID,
                                                    'compare' => '='
                                                )
                                        )
                       );
 
            $users = get_users($args);
            
            if ($users) {
                
                $the_user = get_user_by( 'id', $user_id );
                
                if ($this -> plugin -> get_co_workers() -> exists_by_email($users[0] -> ID, $the_user->user_email)){
                    
                        update_user_meta( $user_id, '_ref_id',  $users[0] -> ID );
                        
                        $this -> plugin -> get_co_workers() -> complete_invite($users[0] -> ID , $the_user->user_email, $user_id);
                    
                }
            }
		}
	}

	/**
	 * Show or call to generate new referal ID
	 *
	 * @since    1.0.0
	 * @return string
	 */
	static public function get_referral_id($user_id) {

		if ( !$user_id ) {
			return false;
		}
		$referralID = get_user_meta($user_id, "_referral_id", true);
		if($referralID && $referralID != "") {
			return $referralID;
		} else {
			do{
			    $referralID = self::generate_referral_id();
			} while (self::exists_ref_id($referralID));
			update_user_meta( $user_id, '_referral_id', $referralID );
			return $referralID;
		}

	}

	/**
	 * Check if ID already exists
	 *
	 * @since    1.0.0
	 * @return string
	 */
	static public function exists_ref_id($referralID) {

		$args = array('meta_key' => "_referral_id", 'meta_value' => $referralID );
		if (get_users($args)) {
			return true;
		} else {
			return false;
		}

	}

	/**
	 * Generate a new Referral ID
	 *
	 * @since    1.0.0
	 * @return string
	 */
	static public function generate_referral_id($randomString="ref")	{

	    $characters = "0123456789";
	    for ($i = 0; $i < 7; $i++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
	}

	/**
	 * Remove Cookie after checkout if Setting is set
	 * woocommerce_thankyou hook
	 *
	 * @since    1.0.0
	 */
	public function remove_cookie_after( $order_id ) {
		$remove = get_option( 'skyfort_sys_ref_cookie_remove' );
		if (isset($_COOKIE['skyfort_sys_ref']) && $remove == "yes") {
		    unset($_COOKIE['skyfort_sys_ref']);
		    setcookie('skyfort_sys_ref', '', time() - 3600, '/'); // empty value and old timestamp
		}
	}

	/**
	 * Show Unique URL - get referral id and create link
	 * woocommerce_before_my_account hook
	 *
	 * @since    1.0.0
	 */
	public function account_page_show_link() {

		$referral_id = $this->get_referral_id( get_current_user_id() );
        
		$refLink = esc_url(add_query_arg( 'ref', $referral_id, get_home_url() )); 
        
        return $refLink;
	}
    
   	static public function get_ref_link($user_id) {

		$referral_id = self::get_referral_id( $user_id );
        
        $args = [
                                        'post_type' => 'page',
                                        'fields' => 'ids',
                                        'nopaging' => true,
                                        'meta_key' => '_wp_page_template',
                                        'meta_value' => 'sign-up.php'
                        
                ];
                
        $pages = get_posts( $args );
            
        if ($pages) {

                     $refLink = add_query_arg( 'ref', $referral_id, get_the_permalink($pages[0]) ); 
                    
        } else {
                     $refLink = add_query_arg( 'ref', $referral_id, get_home_url() ); 
        }

       	return $refLink;
	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'loyalty_cookieJS',  WOOCOMMERCE_SUBCRIPTIONS_MANAGE_URL. 'assets/js/cookie.min.js', array( 'jquery' ), WOOCOMMERCE_SUBCRIPTIONS_MANAGE_VERSION, false );

		wp_enqueue_script( 'loyalty_ref', WOOCOMMERCE_SUBCRIPTIONS_MANAGE_URL. 'assets/js/ref.js', array( 'jquery' ), WOOCOMMERCE_SUBCRIPTIONS_MANAGE_VERSION, false );
        
		$time =  1000 * 36000;
        
		$cookies = array( 'timee' => $time );
        
		wp_localize_script( 'loyalty_ref', 'skyfort_sys_ref', $cookies );
	}
    
    
    public function redirect_to_registration( ) {

            if (isset( $_GET[ 'ref' ] ) && isset($_GET['email'])) {
                
                   $searchInvitation = false; 

                   $args = array(
                        'meta_query' => array(
                                            array(
                                                    'key' => '_referral_id',
                                                    'value' => $_GET[ 'ref' ],
                                                    'compare' => '='
                                                )
                                        )
                       );
 
                    $users = get_users($args);
                    
                    if ($users) {
                        
                        $user_id = $users[0] -> ID; 
                        
                        if ($this -> plugin -> get_co_workers() -> exists_by_email($user_id, $_GET[ 'email' ])){
                            $searchInvitation = true;
                        }
                    }
                    
                    if (!$searchInvitation) {
                        wp_redirect( get_home_url() ); 
                        
                        exit();
                    }
            }
    }
}