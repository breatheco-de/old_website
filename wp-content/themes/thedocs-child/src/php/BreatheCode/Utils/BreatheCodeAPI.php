<?php
namespace BreatheCode\Utils;

use \Exception;

class BreatheCodeAPI{
    
    private static $clientId = BREATHECODE_CLIENT_ID;
    private static $clientSecret = BREATHECODE_CLIENT_SECRET;
    private static $accessToken = "";
    private static $userToken = "";
    private static $attempts = 0;
    private static $host = BREATHECODE_API_HOST;
    
    private static $scopes = [
    	"student" => ['read_basic_info', 'read_talent_tree', 'student_assignments' ],
    	"teacher" => ['read_basic_info', 'read_talent_tree', 'student_assignments', 'teacher_assignments'],
    	"admin" => ['read_basic_info', 'super_admin']
    	];
    
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
		    	//echo print_r($error); die();
		    	throw new \Exception($errorObj->msg);
		    }
		    throw new \Exception('There was a problem, check your username and password.');
		}
		else if($http_code==401) 
		{
			if(!empty(self::getToken()) and self::$attempts == 0) self::refreshAccessToken();
			
			throw new \Exception('Unauthorized BreatheCode API request for method: '.$resource);
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
		$wpUser = get_user_by('email',$username);
		if(!$wpUser) throw new \Exception('The wp_user doest not exist');
		$type = get_user_meta($wpUser->ID, 'type', true);

		$args = [
    		'grant_type' => "password",
    		'username' => $username,
    		'password' => $password,
    		'scope' => implode (" ", self::$scopes[$type])
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
        
	    $studentBadges = self::request('GET','badges/student/'.$args['student_id']);
	    foreach($studentBadges as $badge) 
	    {
	        if(!isset($allBadges[$badge->slug])) $allBadges[$badge->slug] = [];
            $allBadges[$badge->slug]['name'] = $badge->name;
            $allBadges[$badge->slug]['points_acumulated'] = $badge->points_acumulated;
            $allBadges[$badge->slug]['is_achived'] = $badge->is_achieved;
            if($badge->points_acumulated>0) $allBadges[$badge->slug]['percent'] = floor(($badge->points_acumulated / $allBadges[$badge->slug]->total_points)*10);
            else $allBadges[$badge->slug]['percent'] = 0;
	    }
	    //print_r($allBadges); die();
	    return $allBadges;
	}
	
	public static function getStudentBriefing($args=[],$decode=true){
	
	    return self::request('GET','briefing/student/'.$args['student_id'],$args,$decode);
	}
	
	public static function getAllSpecialtiesByProfile($args=[],$decode=true){
	
	    $specialties = self::request('GET','specialties/profile/'.$args['profile_id']);
	    return $specialties;
	}
	
	public static function getAllBadges($args=[],$decode=true){
	
	    return self::request('GET','badges/',$args,$decode);
	}
	
	public static function getBadge($args=[],$decode=true){
	
	    return self::request('GET','badge/'.$args['badge_id'],$args,$decode);
	}
	
	public static function getStudentActivity($args=[],$decode=true){
	
		self::validate($args,'student_id');
		
	    $activities = self::request('GET','activity/student/'.$args['student_id']);
	    return $activities;
	}
	
	public static function getStudentAssignments($args=[],$decode=true){
	
		self::validate($args,'student_id');
		
	    $assignments = self::request('GET','assignments/student/'.$args['student_id']);
	    return $assignments;
	}
	
	public static function getTeacherAssignments($args=[],$decode=true){
	
	    $assignments = self::request('GET','assignments/teacher/'.$args['teacher_id'],$args);
	    return $assignments;
	}
	
	public static function getTeacherCohorts($args=[],$decode=true){
	
	    $cohorts = self::request('GET','cohorts/teacher/'.$args['teacher_id'],$args);
	    return $cohorts;
	}

	public static function getAssignmentTemplates($args=[],$decode=true){
	
	    $assignments = self::request('GET','atemplates/',$args);
	    return $assignments;
	}
	
	public static function getSingleStudentAssignment($args=[],$decode=true){

	    $assignment = self::request('GET','student/assignment/'.$args['assignment_id']);
	    return $assignment;
	}
	
	public static function updateStudentAssignment($args=[],$decode=true){

	    $assignment = self::request('POST','student/assignment/'.$args['assignment_id'],$args);
	    return $assignment;
	}
	
	public static function createCohortAssignment($args=[],$decode=true){

	    $assignment = self::request('POST','assignment/cohort/'.$args['cohort_id'],$args);
	    return $assignment;
	}
	
	public static function syncProjectTemplate($args=[],$decode=true){

	    $template = self::request('POST','atemplate/sync/'.$args['wp_id'],$args);
	    return $template;
	}
	
	public static function syncLocation($args=[],$decode=true){

	    $template = self::request('POST','location/sync/',$args);
	    return $template;
	}
	
	public static function syncCohort($args=[],$decode=true){

	    $cohort = self::request('POST','cohort/sync/',$args);
	    return $cohort;
	}
	
	public static function syncUser($params){
        
        self::validate($params,'email');
        self::validate($params,'wp_id');
        self::validate($params,'type');

        return self::request('post','/user/sync',$params);
    }
	
	public static function syncAssignment($params){
        
        self::validate($params,'template_slug');
        self::validate($params,'student_id');
        self::validate($params,'teacher_id');
        self::validate($params,'duedate');
        self::validate($params,'status');

        return self::request('post','/assignment/sync/',$params);
    }
}