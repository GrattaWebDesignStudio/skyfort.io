<?php
namespace WoocommerceSubscriptionsManage\Front;

use WoocommerceSubscriptionsManage\Plugin;

if(!defined('ABSPATH')) return;

class CoWorkers {
    
   	private $plugin;
    
	public function __construct(Plugin $plugin) {
	   $this->plugin = $plugin;
       
       add_filter("woocommerce_get_query_vars", function ($vars) {

           foreach (['co-workers'] as $e) {
                        $vars[$e] = $e;
            }

            return $vars;

        });
        
       add_action( 'init', array($this, 'add_endpoint') );
       
       add_filter( 'woocommerce_account_menu_items', array($this, 'account_menu_items'), 999 ); 
       
       add_action( 'woocommerce_account_co-workers_endpoint', array($this, 'endpoint_content'), 10, 1 ); 
       
       add_filter( 'the_title', array($this, 'endpoint_title'), 10, 2 );
        
       add_filter( 'wp_title',  array($this, 'seo_title'), 100, 2 );

       add_filter( 'wpseo_title',   array($this, 'seo_title'), 100, 2 );
       
       add_action( 'init', array($this, 'send_invites'), 0 );
       
       add_action('template_redirect', array($this, 'account_coworker_redirect'));   
	}
    
    public function add_endpoint() {
        
          $current_user_id = get_current_user_id();
          
          if (!get_user_meta( $current_user_id, '_ref_id',  true ) /* && get_user_meta( $current_user_id, 'team-status',  true ) == 1 */ ) {
            
             add_rewrite_endpoint( 'co-workers', EP_PAGES );
                
             flush_rewrite_rules();
          }
    }

    public function account_menu_items( $items ) {
        
         $current_user_id = get_current_user_id();
          
         if (!get_user_meta( $current_user_id, '_ref_id',  true )  /* && get_user_meta( $current_user_id, 'team-status',  true ) == 1 */ ) {
        
                 $items['co-workers'] = __( 'Co-Workers', WOOCOMMERCE_SUBCRIPTIONS_MANAGE_TEXTDOMAIN );
                 
         }

         return $items;
    }
    
    public function endpoint_content() {
       
         $current_user_id = get_current_user_id();
  
         if (isset($_GET['delete_coworkes']) && isset($_GET['email'])) {
            
                    $args = array(
                                        'search' => $_GET['email'],
                                        'meta_query' => array(
                                                                array(
                                                                    'key' =>  '_ref_id',
                                                                    'value' => $current_user_id,
                                                                    'compare' => '='
                                                                )
                                                )
                                );
 
                    $users = get_users($args);
                    
                    if ($users) {
    
                         require_once(ABSPATH.'wp-admin/includes/user.php' );
      
                         if (wp_delete_user( $users[0] -> ID )) {
                            update_user_meta( $$users[0] -> ID, '_ref_id',  '' );
                    
                            $this -> plugin -> get_co_workers() ->  delete_by_email($current_user_id, $_GET['email']);
                         }
                    }

                    wp_redirect( wc_get_account_endpoint_url('co-workers'));
            
                    exit;
         }
         
         $users_coworkers = $this -> plugin -> get_co_workers() ->  get_coworkers_list_by_user($current_user_id);
        
         $page_template = locate_template('woocommerce-subscriptions-manage/account-co-workers.php');  
            
         if (!$page_template) {
                    
             $page_template = WOOCOMMERCE_SUBCRIPTIONS_MANAGE_PATH . "templates/front/account-co-workers.php";
         }

         include($page_template);
    }
    
    public function endpoint_title( $title) {
        
            if (is_user_logged_in() &&  is_wc_endpoint_url( 'co-workers' )) {
                    $title =  __( 'Co-Workers', WOOCOMMERCE_SUBCRIPTIONS_MANAGE_TEXTDOMAIN );
            }

            return $title;
    }
    
    public function seo_title( $title, $sep ) {
            
            if ( is_user_logged_in() &&  is_wc_endpoint_url( 'co-workers' )) {
                    $title =  __( 'Co-Workers', WOOCOMMERCE_SUBCRIPTIONS_MANAGE_TEXTDOMAIN );
            }
            
            return $title;
    }
    
    public function send_invites() {
            
            if(is_user_logged_in() && isset($_POST['account_coworkers_invite_nonce']) && wp_verify_nonce($_POST['account_coworkers_invite_nonce'], 'account_coworkers_invite-nonce')) {
                
                    $emails = $_POST['emails'] ?? false;
                    
                    if ($emails) {
                        
                        $current_user_id = get_current_user_id();
                        
                        $current_user = wp_get_current_user();

                        $ref_link = \WoocommerceSubscriptionsManage\Front\Ref::get_ref_link($current_user_id);
                        
                        foreach ($emails as $email) : 
                        
                            $user_exists = $this -> plugin -> get_co_workers() -> exists_by_email($current_user_id, $email);
                        
                            if ($email != '' && is_email($email) && !$user_exists) {
                                
                                    $user_by_email = get_user_by( 'email', $email );
                                    
                                    if (!$user_by_email) {
                                        
                                        $coworker_ref_link = $ref_link.'&email='.$email;
                                        
                                        $this -> plugin -> get_co_workers() -> add_invite($current_user_id, $email);
                                        
                                        $mail = \WC()->mailer()->emails['EmailsCoWorkerInviteEmail']->trigger( $email, $coworker_ref_link, $current_user->user_firstname.' '.$current_user->user_lastname  );
                                    }
                            }
                        
                        endforeach;
                    }
                    
                    wp_redirect( wc_get_account_endpoint_url('co-workers'));
            
                    exit;
            }
    }
    
    public function account_coworker_redirect() {
        
         $current_user_id = get_current_user_id();
          
         if (get_user_meta( $current_user_id, '_ref_id',  true ) > 0 && is_wc_endpoint_url( 'co-workers' )  /*&& !get_user_meta( $current_user_id, 'team-status',  true )*/ ) {
            
             wp_redirect( get_permalink( wc_get_page_id( 'myaccount' ) ) );
                    
             exit;
         }
    }
}