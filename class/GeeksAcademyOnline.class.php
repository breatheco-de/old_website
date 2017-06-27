<?php

Class GeeksAcademyOnline {

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
		
		if(!defined('ASSETS_URL')) Utils\BCError::notifyError('You need to define the ASSETS_URL inside of wp-config.php');
		if(WP_DEBUG) $this->prependversion = time();
		
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
	    
	    wp_enqueue_style( 'breathecodecss', get_stylesheet_directory_uri().'/assets/css/components.breathecode.css', array('theDocs.all.min.css'),$this->prependversion);
	    
	    //wp_enqueue_style( 'stretchynav', get_stylesheet_directory_uri().'/assets/css/stretchy-nav.component.css', array(),$this->prependversion);
	        
	}

	function add_scripts(){
	
	    wp_register_script( 'jquerytemplate', get_stylesheet_directory_uri().'/assets/js/jquery.tmpl.min.js' , array('jquery'), NULL, true );
	    wp_enqueue_script( 'jquerytemplate' );
	    
	    wp_register_script( 'bootstrapjs', get_stylesheet_directory_uri().'/assets/js/bootstrap.min.js' , array('jquery'), NULL, true );
	    wp_enqueue_script( 'bootstrapjs' );
	    
	    if(is_user_logged_in() && is_singular('lesson'))
	    {
	        wp_register_script( 'breathecodejs', get_stylesheet_directory_uri().'/assets/js/components.breathecode.js' , array('jquery','jquerytemplate','bootstrapjs'), $this->prependversion, true );
	        wp_enqueue_script( 'breathecodejs' );
	    }
	
	    wp_register_script( 'main-js', get_stylesheet_directory_uri().'/assets/js/new-scripts.js' , array('jquery'), $this->prependversion, true );
	    wp_enqueue_script( 'main-js' );
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

	function custom_upload_mimes ( $existing_mimes=array() ) {
	    // add your extension to the mimes array as below
	    $existing_mimes['zip'] = 'application/zip';
	    $existing_mimes['gz'] = 'application/x-gzip';
	    return $existing_mimes;
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

	function createCourseHierarchy($menu_name) 
	{
		$menuParents = array();
		$menu = wp_get_nav_menu_object($menu_name);
		if(!$menu) return $menuParents;
		$menu_items = wp_get_nav_menu_items($menu->term_id,array(
			//'post_status'            => 'publish'
			));

		foreach ( (array) $menu_items as $key => $menu_item ) {
		  $id = $menu_item->ID;
		  $title = $menu_item->title;
		  $url = $menu_item->url;
		  if(!$menu_item->menu_item_parent or $menu_item->menu_item_parent=='')
		  {
		    $menuParents[$id] = array("id"=>$id,"title"=>$title, "url"=>$url, "childs"=>array());
		  }
		  else
		  {
		    if(isset($menuParents[$menu_item->menu_item_parent]))
		      $menuParents[$menu_item->menu_item_parent]["childs"][$id] = array("id"=>$id,"title"=>$title, "url"=>$url, "childs"=>array());
		    else
		      foreach ($menuParents as $parent){
		        if(isset($parent["childs"][$menu_item->menu_item_parent]))
		        {
		          $menuParents[$parent["id"]]["childs"][$menu_item->menu_item_parent]["childs"][$id] = array("id"=>$id,"title"=>$title, "url"=>$url, "childs"=>array());
		        }
		      }
		  }
		}

		return $menuParents;
	}

}
