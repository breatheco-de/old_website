<?php

namespace BreatheCode\Controller;

use WPAS\Exception\WPASException;
use \WP_Query;

class APIController{
    
    function getLessons(){
        global $wpdb;
        $rows = $wpdb->get_results("SELECT post_name, post_title, post_status, post_excerpt FROM {$wpdb->prefix}posts WHERE post_type='lesson'");
        return $rows;
    }
    
}