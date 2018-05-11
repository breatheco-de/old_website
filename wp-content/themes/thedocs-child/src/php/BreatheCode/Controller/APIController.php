<?php

namespace BreatheCode\Controller;

use WPAS\Exception\WPASException;
use \WP_Query;

class APIController{
    
    function getLessons(){
        global $wpdb;
        debug($wpdb);
        //$rows = $wpdb->get_results("SELECT post_name, post_title, post_status, post_excerpt FROM wp_posts WHERE post_type='lesson'");
        $rows = $wpdb->get_results("SELECT post_name, post_title, post_status, post_excerpt FROM wp_posts");
        return $rows;
    }
    
}