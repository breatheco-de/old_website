<?php

Class GeeksAcademyOnline {

	function __construct() {
		add_filter('upload_mimes', array($this,'custom_upload_mimes'));

	}

	function custom_upload_mimes ( $existing_mimes=array() ) {
	    // add your extension to the mimes array as below
	    $existing_mimes['zip'] = 'application/zip';
	    $existing_mimes['gz'] = 'application/x-gzip';
	    return $existing_mimes;
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
