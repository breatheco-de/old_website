<?php

namespace BreatheCode;

use \WPAS\Controller\WPASController;
use \BreatheCode\Utils\BreatheCodeAPI;

class GeeksAcademyOnline {

	public static $studentRoles = array(
				'premium_full_stack', 
				'prework_full_stack'
			);

	public static $teacherRoles = array(
				'teacher_assistant',
				'main_teacher'
			);
	
	private $prependversion = 0.07;
	private $defaultViews = ["private" => 'breathe',"login" => 'bclogin', 'student' => 'student', 'teacher' => 'my-cohorts', 'pending' => 'pending'];

	function __construct() {
		
		if(!defined('ASSETS_URL')) WPASAdminNotifier::addTransientMessage(WPASAdminNotifier::ERROR,'You need to define the ASSETS_URL inside of wp-config.php');
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
		add_action( 'wp_logout', [$this,'custom_logout_url'], 10, 3 );
		
		add_action( 'password_reset', [$this,'password_reset'], 10, 2 );
		
		add_action("template_redirect", [$this,'replit_redirects']);
		
	}
	
	function init_theme(){
		$this->addAPISupport(['lesson']);
	}
	
    function inicialize(){
		if( is_user_logged_in() ) {
		    $page = get_page_by_path( $this->defaultViews['private'] );
		    update_option( 'page_on_front', $page->ID );
		    update_option( 'show_on_front', 'page' );
		}
		else{
		    $page = get_page_by_path( $this->defaultViews['login'] );
		    update_option( 'page_on_front', $page->ID );
		    update_option( 'show_on_front', 'page' );
		}
    }
    
    function password_reset( $user, $new_pass ) {
        // Do something before password reset.
        $bcId = get_user_meta($user->ID, 'breathecode_id', true);
        if($bcId)
        {
	        $result = BreatheCodeAPI::updateCredentials([
	        	'user_id' => $bcId,
	        	'password' => $new_pass
	        	]);
	        	
	        if(!$result) throw new Exception('The password reset failed');
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
	    
        if (!current_user_can('administrator') && !is_admin()) {
	        show_admin_bar(false);
	    }
	}
    
	/*
	 ESTILOS Y SCRIPTS
	*/
	function add_styles(){
	 
	    wp_enqueue_style( 'style-skin', get_template_directory_uri().'/assets/css/skin-blue.css', array('theDocs.all.min.css'), $this->prependversion);
	    
	    //if(is_page('mytalents')) wp_enqueue_style( 'mytalents', get_stylesheet_directory_uri().'/public/css/pages/mytalents.css', array(),$this->prependversion);
	    
	}

	function add_scripts(){
	    
	    //wp_register_script( 'bootstrap', get_stylesheet_directory_uri().'/public/bootstrap.min.js' ,[], $this->prependversion, true );
	    //wp_enqueue_script( 'bootstrap' );
	    
	    wp_register_script( 'vendor', get_stylesheet_directory_uri().'/public/vendor.js' ,[], $this->prependversion, true );
	    wp_enqueue_script( 'vendor' );
	    
	    wp_register_script( 'appjs', get_stylesheet_directory_uri().'/public/app.js' , ['vendor'], $this->prependversion );
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
	    $new_login_url = home_url( '/'.$this->defaultViews['login'].'/' );
	    if ( !empty($redirect) ){
	        $new_login_url = add_query_arg( 'redirect_to', urlencode( $redirect ), $new_login_url );
	    }
	    if ( $force_reauth ){
	        $new_login_url = add_query_arg( 'reauth', '1', $new_login_url ) ;
	    }
	    return $new_login_url;
	}
	
	function custom_logout_url(){
	  wp_redirect( home_url( '/'.$this->defaultViews['login'].'/' ) );
	  exit();
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
			else if($this->matchAnyValues( self::$teacherRoles, $user->roles)) {

				return get_permalink( get_page_by_path( $this->defaultViews['teacher'] ) );
			} 
			else if($this->matchAnyValues( self::$studentRoles, $user->roles)) {
				return get_permalink( get_page_by_path( $this->defaultViews['student'] ) );
			} 
			else if(in_array( 'unverified',$user->roles)) 
			{
				$perma = get_permalink( get_page_by_path( $this->defaultViews['pending'] ) );

				return $perma;

			} else {
				return get_permalink( get_page_by_path( $this->defaultViews['pending'] ) );
			}

		} else {
			return $redirect_to;
		}

	}

	private function matchAnyValues($matching, $toArray)
	{
		foreach ($matching as $value) {
			if(in_array( $value, $toArray)) return true;
		}

		return false;
	}

	function wti_loginout_menu_link( $items, $args ) {
	   if ($args->theme_location == 'primary') {
	      if (is_user_logged_in()) {
	      	 if(!strpos($items,"Log Out")) $items .= '<li class="menu-item drop-normal"><a href="'. wp_logout_url() .'"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>';
	      } else {
	         if(!strpos($items,"Log In")) $items .= '<li class="menu-item drop-normal"><a href="'. wp_login_url(get_permalink()) .'">'. __("Log In") .'</a></li>';
	      }
	   }
	   return $items;
	}
	
    function replit_redirects() {

        $dpath = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ;
        if (strpos($dpath,'/replit/') !== false){    
                $cohort = new \BreatheCode\Model\Cohort('cohort');
                if(empty($_GET['r'])){ echo "Please spacify the replit class slug with variable 'r'"; die(); }
                if(empty($_GET['c'])){ 
                    
                    $content = "You are trying to access the replit class ".$_GET['r']." but you have not specified any particular cohort (classes can vary depending on the cohort).";
                    $content .= "<h2>Please specify the cohort to access the invitation link:</h2>";
                    $content .= "<ul>";
                    $cohorts = \BreatheCode\Model\Cohort::all();
                    foreach($cohorts as $c)
                    {
                        $content .="<li><a href='/replit/?r=".$_GET['r']."&c=".$c->slug."'>".$c->name."</a></li>";
                    }
                    $content .= "</ul>";
                    echo $content; die();
                }
                
                $cohort_slug = $_GET['c'];
                $cohort = \BreatheCode\Model\Cohort::getBySlug($cohort_slug);
                if(empty($cohort)){
                    echo "The cohort ".$cohort_slug." does not seem to exist.";
                    die();
                } 
                
                $replit_slug = $_GET['r'];
                $replit_url = \BreatheCode\Model\Lesson::getReplit($replit_slug, $cohort->term_id);
                
                if(empty($replit_url)){
                    echo 'This replit class ('.$replit_slug.') has not been configured for this cohort yet ('.$cohort_slug.') please talk to your teacher to have it fixed.';
                    die();
                }
                else if (filter_var($replit_url, FILTER_VALIDATE_URL) === FALSE) {
                    echo 'The following URL looks invalid: '.$replit_url;
                }
                
                wp_redirect($replit_url);
                exit;               
            }
    }
    
	function my_awesome_func( WP_REST_Request $request ) {
	  // You can access parameters via direct array access on the object:
	  $param = $request['some_param'];
	 
	  // Or via the helper method:
	  $param = $request->get_param( 'some_param' );
	 
	  // You can get the combined, merged set of parameters:
	  $parameters = $request->get_params();
	 
	  // The individual sets of parameters are also available, if needed:
	  $parameters = $request->get_url_params();
	  $parameters = $request->get_query_params();
	  $parameters = $request->get_body_params();
	  $parameters = $request->get_json_params();
	  $parameters = $request->get_default_params();
	 
	  // Uploads aren't merged in, but can be accessed separately:
	  $parameters = $request->get_file_params();
	}

}
