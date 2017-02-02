<?php

Class GeeksAcademyOnline {

	function __construct() {
		add_filter('upload_mimes', array($this,'custom_upload_mimes'));
		add_filter( 'login_redirect', array($this,'custom_user_redirect'), 10, 3 );

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
		if ( isset( $user->roles ) && is_array( $user->roles ) ) {
			//check for admins
			if ( in_array( 'administrator', $user->roles ) ) {
				// redirect them to the default place
				return $redirect_to;
			} else if(in_array( 'subscriber',$user->roles)) {

				return home_url();

			} else if(in_array( 'unverified',$user->roles)) {

				return get_permalink( get_page_by_path( 'pending' ) );
				
			} else {
				return get_permalink( get_page_by_path( 'pending' ) );
			}

		} else {
			return $redirect_to;
		}

	}

	function createCourseHierarchy($menu_name) 
	{
		$menu = wp_get_nav_menu_object($menu_name);
		$menu_items = wp_get_nav_menu_items($menu->term_id);
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
