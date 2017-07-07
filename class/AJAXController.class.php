<?php

class MyAjaxHandler
{
    private $routs = [
        'custom_login' => 'loginHandler'
        ];
        
    public function __construct(){
        foreach($this->routs as $name => $handler)
            add_action('wp_ajax_nopriv_'.$name, [$this,$handler]);
    }
    
    function loginHandler() {
        
        header('Content-type: application/json');
    	// first check if data is being sent and that it is the data we want
      	if ( isset( $_POST["username"] ) && isset( $_POST["password"] ) ) {
    		// now set our response var equal to that of the POST var (this will need to be sanitized based on what you're doing with with it)
    		$username = $_POST["username"];
    		$password = $_POST["password"];
    		// send the response back to the front end
    		
    		//hashing the password just like how wordpress hashes it
    		$password = wp_hash_password($password);
    		
    		try{
    		    $bcUser = \Utils\BreatheCodeAPI::autenticate($username,$password);
    		}
    		catch(\Exception $e){
                $this->error($e->getMessage());
    		}

            $wpUser = get_user_by('id', $bcUser->wp_id);
            if (is_wp_error( $wpUser ) ) $this->error('Error retrieving the wordpress user: '.$wpUser->get_error_message());
            else if (!$wpUser) $this->error('Error retrieving the wordpress user');
            		
            wp_clear_auth_cookie();
    		wp_set_current_user( $wpUser->ID, $wpUser->user_login );
            wp_set_auth_cookie  ( $wpUser->ID );
        
			$this->success(get_permalink(get_page_by_path( 'my-courses' )));
    	}
    	
        $this->error('There was an error in the autetication process');
    }
    
    private function success($data){
		echo json_encode([
		    "code" => 200,
		    "data" => $data
		    ]);
		die(); 
    }
    
    private function error($message){
		echo json_encode([
		    "code" => 500,
		    "msg" => $message
		    ]);
		die(); 
    }
}