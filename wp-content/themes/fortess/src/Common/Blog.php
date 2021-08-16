<?php
namespace Fortess\Common;

use Fortess\Theme;

if ( !defined('ABSPATH') ) exit;

class Blog {
     
    private $theme;

	public function __construct( Theme $theme ) {
	   
	   $this->theme = $theme;
       
       add_action('pre_get_posts', array($this, 'show_all_posts'), 999);
       
       add_filter('template_include',  array($this,'swith_page_event_template' ), 999);
       
       add_filter("the_content", array($this,'the_content_short_descr' ), 999);
       
       add_filter( 'get_the_archive_title',  array($this,'prefix_category_title') );
    }
    
    public function show_all_posts( $query ) {
            if ( ! is_admin() && $query->is_main_query() && is_page_template('blog.php') ) {
                $query->set('page', false);
                $query->set('pagename', false);
                $query->is_singular = false;
                $query->is_page = false;
                $query->is_home = false;
                $query->set('post_type', 'post');
                $query->set('posts_per_page', 10);
                unset($query->query_vars['p']);
                unset($query->query_vars['name']);
                unset($query->query_vars['pagename']);
            }
    }
    
    public function swith_page_event_template($page_template) {
        
        $queried_object = get_queried_object();   
        
	    if ($queried_object -> post_name == 'blog' || is_tag()) {	
	       
            $page_template = locate_template('blog.php'); 
		}
        
		return $page_template;
	}
    
    static public function get_url() {
        
            $page_link = false;
               
            $args = [
                                        'post_type' => 'page',
                                        'fields' => 'ids',
                                        'nopaging' => true,
                                        'meta_key' => '_wp_page_template',
                                        'meta_value' => 'blog.php'
                        
                                    ];
            $pages = get_posts( $args );
            
            if ($pages) {
                
                return get_the_permalink($pages[0]);
            } else {
                return '';
            }
   } 
 
   public function the_content_short_descr($content){
    
            $queried_object = get_queried_object();   
    
            if ( ! is_admin() && is_main_query() && in_the_loop() &&  !is_single() && ($queried_object -> post_name == 'blog' || is_tag() || is_category())) {
                
                  $limit = 190;
                  
                  if (strlen(strip_tags($content)) > $limit) {
                    $content = substr(strip_tags($content), 0, $limit).'...';
                  } 
            }
            
            return $content;
   }
   
   
   public function prefix_category_title( $title ) {
            if ( is_category() ) {
                    $title = single_cat_title( '', false );
            }
            return $title;
   }
}