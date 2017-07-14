<?php
namespace BreatheCode\Controller;

use \BCController,\Exception;
use \Utils\BreatheCodeAPI;

class Lessons{

    function renderCourse(){
        
        $args = [];
        $args['createCourseHierarchy'] = function($menu_name) 
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

}