<?php
namespace BreatheCode\WPTypes\PostType;

use WP_Query;
use Utils\BCNotification as BCNotification;
use Utils\BreatheCodeAPI as BreatheCodeAPI;

class WPLessonProject
{
	const POST_TYPE = 'lesson-project';
	const SCREEN_ID = 'edit-lesson-project';
	
	public static $actions = array(
	   'sync_with_api' => 'Sync with the BreatheCode API'
	);
	
    function __construct() {
		add_filter( 'bulk_actions-'.self::SCREEN_ID, array($this,'register_my_bulk_actions' ), 10, 3);
		add_filter( 'handle_bulk_actions-'.self::SCREEN_ID, array($this,'my_bulk_action_handler'), 10, 3 );
	    add_action( 'manage_'.self::POST_TYPE.'_posts_columns' , array($this,'renderColumns'), 10, 2 );
	    add_action( 'manage_'.self::POST_TYPE.'_posts_custom_column' , array($this,'renderCustomColumn'), 10, 3 );
    }
    
	function register_my_bulk_actions($bulk_actions) {
		foreach(self::$actions as $key => $value) $bulk_actions[$key] = __( $value, 'breathecode');
		return $bulk_actions;
	}
	
	function my_bulk_action_handler( $redirect_to, $doaction, $users ) {
	  if ( !isset(self::$actions[$doaction]) ) {
	    return $redirect_to;
	  }

	  foreach ( $users as $userId ) {
	    	call_user_func(array($this,$doaction), $userId);
	  }
	  
	  $redirect_to = add_query_arg( 'affected_ids', count( $users ), $redirect_to );
	  return $redirect_to;
	}

	function renderColumns( $columns ) {
		$columns['breathecode_id'] = 'API ID';
		return $columns;
	}

	function renderCustomColumn( $column_name, $postId) {
		switch ( $column_name ) {

			case 'breathecode_id':
				$result = get_post_meta( $postId, 'wpcf-breathecode_id', true);
				if(!empty($result)) echo $result;
				else echo 'Not synced';
			break;
		}
	}
	
	function sync_with_api($templateId){
	    
		$wpTemplate = get_post($templateId);
		if($wpTemplate)
		{
		    $terms = get_the_terms($templateId,'project-technology');
		    if(!empty($terms) && !is_wp_error( $terms ))
		    {
		        $terms = array_map(function ($term) { return esc_html($term->name); }, $terms);
                $terms = implode(', ', $terms);
		    }
		    else BCNotification::addTransientMessage(BCNotification::ERROR,'There was an error accessing the Template Terms');

			$template = BreatheCodeAPI::syncProjectTemplate([
                  "project_slug" => $wpTemplate->post_name,
                  "title" => $wpTemplate->post_title,
                  "excerpt" => $wpTemplate->post_excerpt,
                  "wp_id" => $wpTemplate->ID,
                  //"difficulty" => get_post_meta($templateId,'wpcf-project-difficulty',true),
                  "technologies" => $terms,
                  "duration" => get_post_meta($templateId,'wpcf-project-hour-duration',true)
				]);
			if(!$template) BCNotification::addTransientMessage(BCNotification::ERROR,'There was an issue syncronizing the template');
			else{
			    $result = update_post_meta( $templateId, 'wpcf-breathecode_id', $template->id);
			    BCNotification::addTransientMessage(BCNotification::SUCCESS,'The template '.$templateId.' was synced successfully with wp_id '.$template->wp_id.' and Breathecode ID: '.$template->id);
			}
		}
		else BCNotification::addTransientMessage(BCNotification::ERROR,'Template '.$templateId.' not found');
	}


}
