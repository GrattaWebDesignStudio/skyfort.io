<?php
namespace Fortess\Common;

use Fortess\Theme;

if ( !defined('ABSPATH') ) exit;

class Contact {
     
    private $theme;

	public function __construct( Theme $theme ) {
	   
	   $this->theme = $theme;
    }
    
    static public function get_url() {
        
            $page_link = false;
               
            $args = [
                                        'post_type' => 'page',
                                        'fields' => 'ids',
                                        'nopaging' => true,
                                        'meta_key' => '_wp_page_template',
                                        'meta_value' => 'contacts.php'
                        
                                    ];
            $pages = get_posts( $args );
            
            if ($pages) {
                
                return get_the_permalink($pages[0]);
            } else {
                return '';
            }
   } 
}