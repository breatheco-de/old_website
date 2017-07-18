<?php


class WPSessionManagment {

	function __construct() {
		add_action('init', array($this,'myStartSession'), 1);
		add_action('wp_logout', array($this,'myEndSession'));
		add_action('wp_login', array($this,'myEndSession'));
	}


	function myStartSession() {
	    if(!session_id()) {
			session_set_cookie_params(0, '/', '.breatheco.de');
	        session_start();
	    }
	}

	function myEndSession() {
		// resets the session data for the rest of the runtime 
		$_SESSION = array();
		// sends as Set-Cookie to invalidate the session cookie 
		if (isset($_COOKIE[session_name()])) { 
		    $params = session_get_cookie_params();
		    setcookie(session_name(), '', 1, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
		}
		session_destroy();
	}
}