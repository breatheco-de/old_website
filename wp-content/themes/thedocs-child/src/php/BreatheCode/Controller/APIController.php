<?php

namespace BreatheCode\Controller;

use WPAS\Exception\WPASException;
use \WP_Query;

class APIController{
    
    function getLessons(){
        global $wpdb;
        $status = '';
        if(isset($_GET['status'])) $status = " and post_status='".sanitize_text_field($_GET['status'])."'";
        
        $query = "SELECT post_name, post_title, post_status, post_excerpt FROM {$wpdb->prefix}posts WHERE post_type='lesson'".$status;
        $rows = $wpdb->get_results($query);
        return $rows;
    }
    
}