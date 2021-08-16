<?php
namespace WoocommerceSubscriptionsManage\Classes;

use WoocommerceSubscriptionsManage\Plugin;

if(!defined('ABSPATH')) return;

class CoWorkers {
    
    const TABLE_NAME = 'user_coworkers';

    public function __construct() {

    }
    
    public function delete_by_email($user_id, $coworker_email) {
        
        global $wpdb;
        
        $sql = 'DELETE
                FROM 
                    '.$wpdb->prefix . self::TABLE_NAME.'
                WHERE 
                     user_id = '.(int)$user_id.'
                     AND 
                     coworker_email =  "'.esc_sql($coworker_email).'"'; 
                             
        $wpdb->query($sql);
    }
    
    public function exists_by_email($user_id, $coworker_email) {
        
        global $wpdb;
        
        $sql = 'SELECT 
                    COUNT(1)
                FROM 
                    '.$wpdb->prefix . self::TABLE_NAME.' coworkers
                WHERE 
                     coworkers.user_id = '.(int)$user_id.'
                     AND 
                     coworkers.coworker_email =  "'.esc_sql($coworker_email).'"'; 
                             
         $rowcount = $wpdb->get_var($sql);
         
         return ($rowcount) ? true : false;;
    }
    
    public function add_invite($user_id, $coworker_email) {

        global $wpdb;
    
        $wpdb->insert(
					$wpdb->prefix . self::TABLE_NAME,
					array(
                              'user_id' => $user_id,
                              'coworker_email' => $coworker_email,
                              'date_created' => current_time('mysql', 1)
					)
				);
    }
    
    public function complete_invite($user_id, $coworker_email, $coworker_user_id) {
        
        global $wpdb;
        
        $sql = 'UPDATE 
                     '.$wpdb->prefix . self::TABLE_NAME.' 
                SET 
                     coworker_user_id = '.(int)$coworker_user_id.', 
                     date_registered  = "'.current_time('mysql', 1).'"
                WHERE 
                     user_id = '.(int)$user_id.'
                     AND 
                     coworker_email =  "'.esc_sql($coworker_email).'"'; 
                     
        $wpdb->query($sql);
    }
     
    public function get_coworkers_list_by_user($user_id, $status = false) {
        
        global $wpdb;
        
        $sql = 'SELECT 
                    coworkers.*
                FROM 
                    '.$wpdb->prefix . self::TABLE_NAME.' coworkers
                WHERE 
                    coworkers.user_id = '.(int)$user_id;
                
        if ($status == 'active') {
            
            $sql .= ' AND coworkers.date_registered IS NOT NULL ';
            
        } elseif ($status == 'pending') {
            
            $sql .= ' AND coworkers.date_registered IS NULL ';
        }
        
        $sql .= ' ORDER BY coworkers.coworker_email';
        
        $results = $wpdb->get_results($sql);
  
        return $results;
    }
}