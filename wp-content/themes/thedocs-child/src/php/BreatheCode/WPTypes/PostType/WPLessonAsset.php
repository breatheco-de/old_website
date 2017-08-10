<?php

namespace BreatheCode\WPTypes\PostType;
use WPAS\Messaging\WPASAdminNotifier as BCNotification;
use BCThemeOptions;

class WPLessonAsset{

	const POST_TYPE = 'lesson-asset';


	function __construct(){
		add_filter('wp_insert_post_data', array($this,'validate_fields'));
	
	}

	function validate_fields($data) {
		if ($data['post_type']!=self::POST_TYPE) return $data;
		 
	  $excerpt = $data['post_excerpt'];
	
	  if (empty(trim($excerpt))) {
	    if ($data['post_status'] === 'publish') {
	      //add_filter('redirect_post_location', 'excerpt_error_message_redirect', '99');
	      Utils\BCNotification::addTransientMessage(Utils\BCNotification::ERROR,'Excerpt is required');
	      
	    }
	
	    $data['post_status'] = 'draft';
	  }
	
	  return $data;
	}

}