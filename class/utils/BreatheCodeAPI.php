<?php
namespace Utils;

class BreatheCodeAPI{
    
    private static $clientId = BREATHECODE_CLIENT_ID;
    private static $clientSecret = BREATHECODE_CLIENT_SECRET;
    private static $accessToken = "";
    private static $userToken = "";
    private static $attempts = 0;
    private static $host = BREATHECODE_API_HOST;
    
    private static function setToken($token){
    	$result = set_transient("bc_api_token", $token, 86400);//one day
    	if($result)
    	{
    		self::$accessToken = $token;
    		return true;
    	}
    	else return false;
    }
    
    public static function getToken(){
    	
    	if(!empty(self::$accessToken)) return self::$accessToken;

    	$token = get_transient( "bc_api_token" );
    	if(!empty($token)) return $token;
    	else return null;
    }
    
    public static function request($method,$resource,$args=[],$decode=true){
        $method = strtoupper($method);

		$args['client_id'] = self::$clientId;
		$args['client_secret'] = self::$clientSecret;
        if($resource!='token' and empty(self::getToken()))
        {
        	self::refreshAccessToken();
        }
        $args['access_token'] = self::getToken();
        
        if($method=='GET') $response = wp_remote_get(self::$host.$resource.'?'.http_build_query($args));
        else if($method=='POST') $response = wp_remote_post(self::$host.$resource,['body'=>$args]);
		else throw new \Exception('Invalid HTTP request type '.$method);
		
		if(is_wp_error( $response )) throw new \Exception($return->get_error_message());
		$http_code = wp_remote_retrieve_response_code( $response );
		if($http_code==500) 
		{
		    if(WP_DEBUG) 
		    {
		    	$error = wp_remote_retrieve_body( $response ); 
		    	$errorObj = json_decode($error);
		    	throw new \Exception($errorObj->msg);
		    }
		    throw new \Exception('There was a problem, check your username and password.');
		}
		else if($http_code==401) 
		{
			if(!empty(self::getToken()) and self::$attempts ==0) self::refreshAccessToken();
			
			throw new \Exception('Unauthorized BreatheCode API request');
		}
		else if($http_code!=200){
		    $error = wp_remote_retrieve_body( $response );
		    throw new \Exception('Code: '.$http_code.', '.$resource.$error);
		}
		
		$bodyJson = wp_remote_retrieve_body( $response );
		if(!$decode) return $bodyJson;

		
		$body = json_decode($bodyJson);
		if(!$body)
		{
			$message = 'Error decoding API result: ';
			if(WP_DEBUG) 
			{
				$message .= json_last_error_msg();
				$message .= $bodyJson;
			}
			throw new \Exception($message);
		}
		
		if(isset($body->code))
		{
    		if($body->code!='200') {
    		    if(WP_DEBUG) throw new \Exception($body->msg);
    		    else throw new \Exception('There was a problem in the request');
    		}
    		return $body->data;
		}
		else return $body;
    }
    
    private static function refreshAccessToken(){

		if(empty(self::getToken())){
        	self::setToken(get_option('breathecode-api-token'));
		}
		
		$result = self::request('post','token',['grant_type'=>'client_credentials']);
		if($result and !empty($result->access_token))
		{
			self::setToken($result->access_token);
			update_option('breathecode-api-token',$result->access_token);
		}
		else throw new \Exception('Unable to get access token');
        
        return self::getToken();
    }
    
    private static function validate($params,$key){
        if(empty($params[$key])) throw new \Exception('Undefined required parameter '.$key);
    }
    
    public static function autenticate($username, $password){
		$args = [
    		'grant_type' => "password",
    		'username' => $username,
    		'password' => $password
		];
		// send the response back to the front end
		$token = self::request('post','token',$args);
		if(!empty($token->access_token))
		{
		    self::setToken($token->access_token);
		    $user = self::request('get','me',[]);

    		if(empty($user) or empty($user->wp_id)) {
    		    throw new \Exception('There is no wordpress ID for this user in the Breathecode API');
    		}
    		else return $user;
    		
		}else throw new \Exception('There is no access_token for worpress client in the API');
		
		return false;
    }
    
    public static function createCredentials($params){
        
        self::validate($params,'email');
        self::validate($params,'wp_id');
        self::validate($params,'type');

        return self::request('post','/credentials/user/',$params);
    }
    
	public static function getStudentBadges($args=[],$decode=true){
	
	    $allBadges = [];
	    $allSpecialties = self::getAllSpecialtiesByProfile(['profile_id' => 1]);
        if($allSpecialties and count($allSpecialties)>0)
        {
            foreach($allSpecialties as $specialty) 
            {
                $badges = $specialty->badges;
                foreach($badges as $b) 
                {
                	$badgeArray = [];
                    $badgeArray['points_acumulated'] = 0;
                    $badgeArray['is_achived'] = false;
                    $badgeArray['name'] = $b;
                    $badgeArray['percent'] = 0;
                    $badgeArray['slug'] = $b;
                    $allBadges[$b] = $badgeArray;
                }
            }
        }
        
	    $studentBadges = \Utils\BreatheCodeAPI::request('GET','badges/student/'.$args['student_id']);
	    foreach($studentBadges as $badge) 
	    {
	        if(!isset($allBadges[$badge->slug])) $allBadges[$badge->slug] = [];
	        
            $allBadges[$badge->slug]['name'] = $badge->name;
            $allBadges[$badge->slug]['points_acumulated'] = $badge->points_acumulated;
            $allBadges[$badge->slug]['is_achived'] = $badge->is_achieved;
            $allBadges[$badge->slug]['percent'] = ($badge->points_acumulated/$badge->points_acumulated)*100;
	    }
	    
	    return $allBadges;
	}
	
	public static function getAllSpecialtiesByProfile($args=[],$decode=true){
	
	    $specialties = \Utils\BreatheCodeAPI::request('GET','specialties/profile/'.$args['profile_id']);
	    return $specialties;
	}
	
	public static function getAllBadges($args=[],$decode=true){
	
	    return \Utils\BreatheCodeAPI::request('GET','badges/',$args,$decode);
	}
	
	public static function getStudentAssignments($args=[],$decode=true){
	
	    $assignments = self::request('GET','assignments/student/'.$args['student_id']);
	    return $assignments;
	}
	
	public static function getSingleStudentAssignment($args=[],$decode=true){

	    $assignment = self::request('GET','student/assignment/'.$args['assignment_id']);
	    return $assignment;
	}
	
	public static function deliverStudentAssignment($args=[],$decode=true){

	    $assignment = self::request('GET','student/assignment/'.$args['assignment_id']);
	    return $assignment;
	}
	
	public static function syncProjectTemplate($args=[],$decode=true){

	    $template = self::request('POST','atemplate/sync/'.$args['wp_id'],$args);
	    return $template;
	}
}