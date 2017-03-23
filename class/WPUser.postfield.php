<?php

require_once('PHPUtils.class.php');

class WPUser
{
	const POST_TYPE = 'user';
	const FORM_TITLE = 'Assign Project to Class';

	function __construct() {
		add_action( 'init', array($this, 'register_user_taxonomy' ));
		add_action( 'admin_menu', array($this, 'add_user_cohort_menu' ));
		add_action( 'show_user_profile', array($this, 'show_user_cohort' ));
		add_action( 'edit_user_profile', array($this, 'show_user_cohort' ));
		add_action( 'personal_options_update', array($this, 'save_user_cohort' ));
		add_action( 'edit_user_profile_update', array($this, 'save_user_cohort' ));
	    
	    add_action( 'manage_users_columns' , array($this,'userColumns'), 10, 2 );
	    add_action( 'manage_users_custom_column' , array($this,'customUserColumn'), 10, 3 );
		
		add_filter( 'bulk_actions-users', array($this,'register_my_bulk_actions' ), 10, 3);
		add_filter( 'handle_bulk_actions-users', array($this,'my_bulk_action_handler'), 10, 3 );
	
	}

 
	function register_my_bulk_actions($bulk_actions) {
		$bulk_actions['add_to_cohort'] = __( 'Add to Cohort', 'add_to_cohort');
		return $bulk_actions;
	}

	 
	function my_bulk_action_handler( $redirect_to, $doaction, $post_ids ) {
	  if ( $doaction !== 'add_to_cohort' ) {
	    return $redirect_to;
	  }
	  foreach ( $post_ids as $post_id ) {
	    // Perform action for each post.
	  }
	  $redirect_to = add_query_arg( 'bulk_emailed_posts', count( $post_ids ), $redirect_to );
	  return $redirect_to;
	}

	function userColumns( $columns ) {
		//unset( $columns['title'] );
		$columns['cohort'] = 'Cohort';
		//die(print_r($columns));
		return $columns;
	}


	function customUserColumn( $value, $column_name ,$userId) {
		switch ( $column_name ) {

			case 'cohort' :
				$terms = wp_get_post_terms($userId,'user_cohort');
				$termStrg = '';
				if(!$terms or count($terms)==0) return 'No cohorts';
				foreach ($terms as $term) {
					$termStrg .= $term->name.',';
				}
				return $termStrg;
			break;
		}
	}

	function register_user_taxonomy(){
	 
		$labels = array(
			'name' => 'User Cohort',
			'singular_name' => 'User Cohort',
			'search_items' => 'Search User Cohorts',
			'all_items' => 'All User Cohorts',
			'parent_item' => 'Parent User Cohort',
			'parent_item_colon' => 'Parent User Cohort',
			'edit_item' => 'Edit User Cohort',
			'update_item' => 'Update User Cohort',
			'add_new_item' => 'Add New User Cohort',
			'new_item_name' => 'New User Cohort Name',
			'menu_name' => 'User Cohort'
		);
	 
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'user_cohort')
		);
	 
		register_taxonomy( 'user_cohort' , 'user' , $args );
	}

	function add_user_cohort_menu() {
	    add_submenu_page( 'users.php' , 'User Cohort', 'User Cohort' , 'add_users',  'edit-tags.php?taxonomy=user_cohort' );
	}

	function show_user_cohort( $user ) {
	 
	    //get the terms that the user is assigned to 
	    $assigned_terms = wp_get_object_terms( $user->ID, 'user_cohort' );
	    $assigned_term_ids = array();
	    foreach( $assigned_terms as $term ) {
	        $assigned_term_ids[] = $term->term_id;
	    }
	 
	    //get all the terms we have
	    $user_cats = get_terms( 'user_cohort', array('hide_empty'=>false) );
	 
	    echo "<h3>User Cohort</h3>";
	 
	     //list the terms as checkbox, make sure the assigned terms are checked
	    foreach( $user_cats as $cat ) { ?>
	        <input type="checkbox" id="user-cohort-<?php echo $cat->term_id ?>" <?php if(in_array( $cat->term_id, $assigned_term_ids )) echo 'checked=checked';?> name="user_cohort[]"  value="<?php echo $cat->term_id;?>"/> 
	        <?php
	    	echo '<label for="user-cohort-'.$cat->term_id.'">'.$cat->name.'</label>';
	    	echo '<br />';
	    }
	}

	function save_user_cohort( $user_id ) {
	 
		$user_terms = $_POST['user_cohort'];
		$terms = array_unique( array_map( 'intval', $user_terms ) );
		wp_set_object_terms( $user_id, $terms, 'user_cohort', false );
	 
		//make sure you clear the term cache
		clean_object_term_cache($user_id, 'user_cohort');
	}

}
