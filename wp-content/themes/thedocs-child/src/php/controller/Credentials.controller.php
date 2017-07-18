<?php

namespace BreatheCode\Controller;

use WPAS\Controller\WPASController;
use WPAS\Exception\WPASException;

class Credentials{
   
    function ajax_custom_login() {
        header('Content-type: application/json');
    	// first check if data is being sent and that it is the data we want
      	if ( isset( $_POST["username"] ) && isset( $_POST["password"] ) ) {
    		// now set our response var equal to that of the POST var (this will need to be sanitized based on what you're doing with with it)
    		$username = $_POST["username"];
    		$password = $_POST["password"];
    		// send the response back to the front end
    		try{
    		    $bcUser = \Utils\BreatheCodeAPI::autenticate($username,$password);
    		}
    		catch(\Exception $e){
                WPASController::ajaxError($e->getMessage());
    		}

            $wpUser = get_user_by('id', $bcUser->wp_id);
            if (is_wp_error( $wpUser ) ) WPASController::ajaxError('Error retrieving the wordpress user: '.$wpUser->get_error_message());
            else if (!$wpUser) WPASController::ajaxError('Error retrieving the wordpress user');
            		
            wp_clear_auth_cookie();
    		wp_set_current_user( $wpUser->ID, $wpUser->user_login );
            wp_set_auth_cookie  ( $wpUser->ID );
        
			WPASController::ajaxSuccess(get_permalink(get_page_by_path( 'my-courses' )));
    	}
    	
        WPASController::ajaxError('There was an error in the autetication process');
    }
    
}