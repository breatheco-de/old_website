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

	function __construct() {
		add_filter('upload_mimes', array($this,'custom_upload_mimes'));
		add_filter( 'login_redirect', array($this,'custom_user_redirect'), 10, 3 );
		add_filter( 'wp_nav_menu_items', array($this,'wti_loginout_menu_link'), 10, 2 );
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
		        update_user_meta($user->ID, 'prompt_page_on_login', '');
		        return $promtOnLogin;
		    }

			//check for admins
			if ( in_array( 'administrator', $user->roles ) ) 
			{
				// redirect them to the default place
				return $redirect_to;
			} 
			else if($this->matchAnyValues( $this->teacherRoles, $user->roles)) {

				return get_permalink( get_page_by_path( 'teacher-dashboard' ) );;
			} 
			else if($this->matchAnyValues( $this->studentRoles, $user->roles)) {

				return get_permalink( get_page_by_path( 'my-courses' ) );;
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
		$menu = wp_get_nav_menu_object($menu_name);
		$menu_items = wp_get_nav_menu_items($menu->term_id,array(
			//'post_status'            => 'publish'
			));
		$menuParents = array();

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
