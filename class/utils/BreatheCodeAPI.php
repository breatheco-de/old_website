<?php
namespace Utils;

class BreatheCodeAPI{
    
    private static $clientId = "testclient";
    private static $clientSecret = "testpass";
    private static $accessToken = "";
    private static $host = 'https://talenttree-alesanchezr.c9users.io/';
    
    private static function request($method,$resource,$args){
        $method = strtoupper($method);
        
		$args['client_id'] = self::$clientId;
		$args['client_secret'] = self::$clientSecret;
        if($resource!='token' and empty(self::$accessToken))
        {
        	self::refreshAccessToken();
        }
        $args['access_token'] = self::$accessToken;
        
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
		    	throw new \Exception($error);
		    }
		    throw new \Exception('There was a problem, check your username and password.');
		}
		else if($http_code==401) throw new \Exception('Unauthorized BreatheCode API request');
		else if($http_code!=200){
		    $error = wp_remote_retrieve_body( $response );
		    throw new \Exception($error);
		}
		
		$bodyJson = wp_remote_retrieve_body( $response );
		$body = json_decode($bodyJson);
		
		
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
    	
		if(empty(self::$accessToken)){
        	self::$accessToken = get_option('breathecode-api-token');
        	if(empty(self::$accessToken))
        	{
        		$result = self::request('post','token',['grant_type'=>'client_credentials']);
        		if($result and !empty($result->access_token))
        		{
        			self::$accessToken = $result->access_token;
        			update_option('breathecode-api-token',self::$accessToken);
        		}
        		else throw new \Exception('Unable to get access token');
        	}
        }
        
        return self::$accessToken;
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
		    self::$accessToken = $token->access_token;
		    $user = self::request('get','me',[]);

    		if(empty($user) or $user->code!='200' or empty($user->data->wp_id)) {
    		    throw new \Exception('There is noo wordpress ID for this user in the Breathecode API');
    		}
    		else return $user->data;
		}
		
		return false;
    }
    
    public static function createCredentials($params){
        
        self::validate($params,'email');
        self::validate($params,'wp_id');
        self::validate($params,'type');

        return self::request('post','/credentials/user/',$params);
    }
}