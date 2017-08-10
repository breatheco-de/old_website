<?php

namespace BreatheCode\WPTypes\PostType;
use BreatheCode\BCThemeOptions;
use BreatheCode\Utils\BreatheCodeAPI;
use WPAS\Messaging\WPASAdminNotifier as BCNotification;
use PostTypes\PostType;

class WPLocation{

	const POST_TYPE = 'location';

	function __construct(){
		
		$location = new PostType('location');
		
		add_filter( 'bulk_actions-edit-'.self::POST_TYPE, array($this,'register_bulk_actions' ));
		add_filter( 'handle_bulk_actions-edit-'.self::POST_TYPE,array($this, 'my_bulk_action_handler'), 10, 3 );
		
	    add_action( 'manage_'.self::POST_TYPE.'_posts_columns' , array($this,'renderColumns'), 10, 2 );
	    add_action( 'manage_'.self::POST_TYPE.'_posts_custom_column' , array($this,'renderCustomColumn'), 10, 3 );
	}
	
	/**
	 * Adds a new item into the Bulk Actions dropdown.
	 */
	function register_bulk_actions( $bulk_actions ) {
		$bulk_actions['sync_with_api'] = __( 'Add to API', 'breatehcode' );
		return $bulk_actions;
	}
	
	function my_bulk_action_handler( $redirect_to, $doaction, $post_ids ) {
	  if ( $doaction !== 'sync_with_api' ) {
	    return $redirect_to;
	  }
	  foreach($post_ids as $postId)
	  {
	  	$this->sync_with_api($postId);
	  }
	  //$redirect_to = add_query_arg( 'cohorts', count( $post_ids ), $redirect_to );
	  return $redirect_to;
	}
	
	function sync_with_api($locationId){
	    
		$wpLocation = get_post($locationId);
		if($wpLocation)
		{
			$location = BreatheCodeAPI::syncLocation([
                  "slug" => $wpLocation->post_name,
                  "name" => $wpLocation->post_title,
                  "country" => get_post_meta($templateId,'wpcf-location-country',true),
                  "address" => get_post_meta($templateId,'wpcf-location-address',true)
				]);
			if(!$location) BCNotification::addTransientMessage(BCNotification::ERROR,'There was an issue syncronizing the location');
			else{
			    $result = update_post_meta( $locationId, 'wpcf-breathecode_id', $location->id);
			    BCNotification::addTransientMessage(BCNotification::SUCCESS,'The location '.$locationId.' was synced successfully with breathecode ID: '.$location->id);
			}
		}
		else BCNotification::addTransientMessage(BCNotification::ERROR,'Location '.$locationId.' not found');
	}
	
	function renderColumns($columns){
		//unset( $columns['description'] );
	    $columns['breathecode_id'] = 'API Id';
	    return $columns;
	}
	

	function renderCustomColumn($column_name, $postId) {
		switch ( $column_name ) {
			case 'breathecode_id':
				$result = get_post_meta( $postId, 'wpcf-breathecode_id', true);
				if(!empty($result)) echo $result;
				else echo 'Not synced';
			break;
		}
	}
}