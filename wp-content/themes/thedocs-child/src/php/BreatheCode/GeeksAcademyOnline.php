<?php

namespace BreatheCode;

use \WPAS\Controller\WPASController;

class GeeksAcademyOnline {

	private $studentRoles = array(
				'premium_full_stack', 
				'prework_full_stack'
			);

	private $teacherRoles = array(
				'teacher_assistant',
				'main_teacher'
			);
	
	private $prependversion = 0.03;

	function __construct() {
		
		if(!defined('ASSETS_URL')) Utils\BCNotification::addTransientMessage(Utils\BCNotification::ERROR,'You need to define the ASSETS_URL inside of wp-config.php');
		if(WP_DEBUG) 
		{
			//error_reporting(E_ALL & ~E_NOTICE);
			error_reporting(E_ERROR | E_WARNING | E_PARSE);
			$this->prependversion = time();
		}
		
		//setup the child-theme
		add_action( 'after_setup_theme', [$this,'thedocs_child_theme_setup'] );
		//allowed mime types
		add_filter('upload_mimes', array($this,'custom_upload_mimes'));
		//redirect according to the role
		add_filter( 'login_redirect', array($this,'custom_user_redirect'), 10, 3 );
		//
		add_filter( 'wp_nav_menu_items', array($this,'wti_loginout_menu_link'), 10, 2 );
		add_action('wp_head', [$this,'include_head_scripts']);
		add_filter( 'cpt_post_types', [$this,'custom_post_type_templates'] );
		
		//Add styles and javascript's
		add_action( 'wp_enqueue_scripts', [$this,'add_styles'] );
		add_action( 'wp_enqueue_scripts', [$this,'add_scripts'] );
		
		//custom login page
		add_filter( 'login_url', [$this,'custom_login_url'], 10, 3 );
    	
    	$this->inicialize();
	}
	
    function inicialize(){
		if( is_user_logged_in() ) {
		    $page = get_page_by_path( 'my-courses' );
		    update_option( 'page_on_front', $page->ID );
		    update_option( 'show_on_front', 'page' );
		}
		else{
		    $page = get_page_by_path( 'breathe' );
		    update_option( 'page_on_front', $page->ID );
		    update_option( 'show_on_front', 'page' );
		}
    }
    
	/**
	 * Setup thedocs Child Theme's textdomain.
	 *
	 * Declare textdomain for this child theme.
	 * Translations can be filed in the /languages/ directory.
	 */
	function thedocs_child_theme_setup() {
		load_child_theme_textdomain( 'thedocs-child', get_stylesheet_directory() . '/languages' );
	
	    register_nav_menus( array(
	        'assets-menu' => 'Menu for browsing all the lesson assets'
	    ) );
	
	    //add formats suppor to the theme.
	    add_theme_support( 'post-formats', array( 'link', 'video', 'image' ) );
	    // add post-formats to post_type 'lesson-assets'
	    add_post_type_support( 'lesson-asset', 'post-formats' ); 
	}
    
	/*
	 ESTILOS Y SCRIPTS
	*/
	function add_styles(){
	 
	    wp_enqueue_style( 'style-skin', get_template_directory_uri().'/assets/css/skin-blue.css', array('theDocs.all.min.css'));
	    
	    //if(is_page('mytalents')) wp_enqueue_style( 'mytalents', get_stylesheet_directory_uri().'/public/css/pages/mytalents.css', array(),$this->prependversion);
	    
	}

	function add_scripts(){
	    
	    wp_register_script( 'bootstrap', get_stylesheet_directory_uri().'/public/bootstrap.min.js' ,['jquery'], $this->prependversion, true );
	    wp_enqueue_script( 'bootstrap' );
	    
	    wp_register_script( 'vendor', get_stylesheet_directory_uri().'/public/vendor.js' ,['jquery','bootstrap'], $this->prependversion, true );
	    wp_enqueue_script( 'vendor' );
	    
	    wp_register_script( 'appjs', get_stylesheet_directory_uri().'/public/app.js' , ['vendor'], '0.1' );
	    
	    $data = [];
        $data['ajax_url'] = admin_url( 'admin-ajax.php' );
        $data['host'] = 'https://talenttree-alesanchezr.c9users.io/';
        
        $ajaxController = WPASController::getAjaxController();
        if($ajaxController) $data['wpas_controller'] = $ajaxController;
	    
	    wp_localize_script( 'appjs', 'WPAS_APP', $data);
	    wp_enqueue_script( 'appjs' );
	    
	}

	/**
	 * Hooks the WP cpt_post_types filter 
	 *
	 * @param array $post_types An array of post type names that the templates be used by
	 * @return array The array of post type names that the templates be used by
	 **/
	function custom_post_type_templates( $post_types ) {
	    $post_types[] = 'lesson';
	    $post_types[] = 'lesson-asset';
	    $post_types[] = 'lesson-project';
	    return $post_types;
	}
    
	function include_head_scripts(){
	    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
	}

	//aditional mime-types allowed
	function custom_upload_mimes ( $existing_mimes=array() ) {
	    // add your extension to the mimes array as below
	    $existing_mimes['zip'] = 'application/zip';
	    $existing_mimes['gz'] = 'application/x-gzip';
	    return $existing_mimes;
	}
	
	/**
	 * Set a custom login page
	 *
	 * @param string $url Default login URL
	 * @param string $redirect Redirect URL on login
	 * @param bool $force_reauth Whether to force reauthorization
	 * @link https://developer.wordpress.org/reference/hooks/login_url/
	 */
	function custom_login_url( $url, $redirect, $force_reauth ){
	    $new_login_url = home_url( '/bclogin/' );
	    if ( !empty($redirect) ){
	        $new_login_url = add_query_arg( 'redirect_to', urlencode( $redirect ), $new_login_url );
	    }
	    if ( $force_reauth ){
	        $new_login_url = add_query_arg( 'reauth', '1', $new_login_url ) ;
	    }
	    return $new_login_url;
	}

	/**
	 * Redirect users to custom URL based on their role after login
	 *
	 * @param string $redirect
	 * @param object $user
	 * @return string
	 */
	function custom_user_redirect( $redirect_to, $request, $user ) {
		//is there a user to check?
		if ( isset( $user->roles ) && is_array( $user->roles ) ) 
		{
			if(!isset($_SESSION['academy_roles']))
			{
				$_SESSION['academy_roles'] = $user->roles;
			}
			
		    // if first time login
			$promtOnLogin = get_user_meta($user->ID, 'prompt_page_on_login', true);
		    if(!empty($promtOnLogin) and $promtOnLogin != '' ) {
		        
		        $url = get_permalink( get_page_by_path( $promtOnLogin ));
		        if(!empty($url)) 
	        	{
	        		update_user_meta($user->ID, 'prompt_page_on_login', '');
		        	return $url;
		    	}
		    }

			//check for admins
			if ( in_array( 'administrator', $user->roles ) ) 
			{
				// redirect them to the default place
				return $redirect_to;
			} 
			else if($this->matchAnyValues( $this->teacherRoles, $user->roles)) {

				return get_permalink( get_page_by_path( 'teacher-cohorts' ) );
			} 
			else if($this->matchAnyValues( $this->studentRoles, $user->roles)) {

				return get_permalink( get_page_by_path( 'my-courses' ) );
			} 
			else if(in_array( 'unverified',$user->roles)) 
			{
				$perma = get_permalink( get_page_by_path( 'pending' ) );

				return $perma;

			} else {
				return get_permalink( get_page_by_path( 'pending' ) );
			}

		} else {
			return $redirect_to;
		}

	}

	private function matchAnyValues($matching, $toArray)
	{
		//print_r($toArray);
		foreach ($matching as $value) {
			if(in_array( $value, $toArray)) return true;
		}

		return false;
	}

	function wti_loginout_menu_link( $items, $args ) {
	   if ($args->theme_location == 'primary') {
	      if (is_user_logged_in()) {
	      	 if(!strpos($items,"Log Out")) $items .= '<li class="menu-item drop-normal"><a href="'. wp_logout_url() .'">'. __("Log Out") .'</a></li>';
	      } else {
	         if(!strpos($items,"Log In")) $items .= '<li class="menu-item drop-normal"><a href="'. wp_login_url(get_permalink()) .'">'. __("Log In") .'</a></li>';
	      }
	   }
	   return $items;
	}

}
