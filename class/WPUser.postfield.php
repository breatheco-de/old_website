<?php

require_once('PHPUtils.class.php');

class WPUser
{
	const POST_TYPE = 'user';
	const FORM_USER_REGISTRATION = 'Manual User Registration';
	private $user;

	function __construct() {
		add_action( 'init', array($this, 'register_user_taxonomy' ));
		add_action( 'admin_menu', array($this, 'add_user_cohort_menu' ));
		add_action( 'show_user_profile', array($this, 'tm_additional_profile_fields' ));
		add_action( 'edit_user_profile', array($this, 'tm_additional_profile_fields' ));
		add_action( 'personal_options_update', array($this, 'tm_save_profile_fields' ));
		add_action( 'edit_user_profile_update', array($this, 'tm_save_profile_fields' ));
	    
	    add_action( 'manage_users_columns' , array($this,'userColumns'), 10, 2 );
	    add_action( 'manage_users_custom_column' , array($this,'customUserColumn'), 10, 3 );
		
		add_filter( 'bulk_actions-users', array($this,'register_my_bulk_actions' ), 10, 3);
		add_filter( 'handle_bulk_actions-users', array($this,'my_bulk_action_handler'), 10, 3 );

		add_filter( 'gform_pre_render', array($this,'populate_new_user_fields') );
		add_action( 'gform_user_registered', array($this,'finishUserRegistration'), 10, 4 );
	}

	function getUser(){
		if(!$this->user)
		{
			$this->user = wp_get_current_user();
		}

		return $this->user;
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

	private function show_user_cohort( $user ) {
	 
	 	$currentUser = $this->getUser();
	 	if(!in_array( 'administrator', $currentUser->roles )) return;

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

	private function save_user_cohort( $user_id ) {
	 
	 	//Only the admin
	 	$currentUser = $this->getUser();
	 	if(!in_array( 'administrator', $currentUser->roles )) return;

	 	if(!empty($_POST['user_cohort']))
	 	{
			$user_terms = $_POST['user_cohort'];
			$terms = array_unique( array_map( 'intval', $user_terms ) );
			wp_set_object_terms( $user_id, $terms, 'user_cohort', false );
		 
			//make sure you clear the term cache
			clean_object_term_cache($user_id, 'user_cohort');
	 	}
	}

	function populate_new_user_fields($form){

		//Cut the execution of the function
		if($form['title']!=self::FORM_USER_REGISTRATION) return $form;

		foreach ( $form['fields'] as $field )
		{
			if ( $field->type == 'select' and strpos( $field->cssClass,'student-cohorts' )!==false ) {
			   	$terms = get_terms('user_cohort',array('hide_empty' => 0));
			   	$choices = array();
				foreach($terms as $term) if($term->parent!=0) $choices[] = array( 'text' => $term->name, 'value' => $term->term_id );
			   	$field->choices = $choices;
			   	$field->placeholder = 'Select a cohort';
			}
		}
		return $form;
	}

	function finishUserRegistration($user_id, $feed, $entry)
	{
		//getting post
	    $cohort = rgar( $entry, '11' );
	    $term = get_term($cohort);
		$users = wp_set_object_terms( $user_id, $term->name,'user_cohort' );
	}


	/**
	 * Add new fields above 'Update' button.
	 *
	 * @param WP_User $user User object.
	 */
	function tm_additional_profile_fields( $user ) {

	    $months 	= array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );
	    $default	= array( 'day' => 1, 'month' => 'January', 'year' => 1950, );
	    $birth_date = wp_parse_args( get_user_meta( $user->ID, 'birth_date', true), $default );
	    
	    $prompt_page_on_login = get_user_meta( $user->ID, 'prompt_page_on_login', true);
	    ?>
	    <h3>Extra profile information </h3>

	    <table class="form-table">
	   	 <tr>
	   		 <th><label for="birth-date-day">Birth date</label></th>
	   		 <td>
	   			 <select id="birth-date-day" name="birth_date[day]"><?php
	   				 for ( $i = 1; $i <= 31; $i++ ) {
	   					 printf( '<option value="%1$s" %2$s>%1$s</option>', $i, selected( $birth_date['day'], $i, false ) );
	   				 }
	   			 ?></select>
	   			 <select id="birth-date-month" name="birth_date[month]"><?php
	   				 foreach ( $months as $month ) {
	   					 printf( '<option value="%1$s" %2$s>%1$s</option>', $month, selected( $birth_date['month'], $month, false ) );
	   				 }
	   			 ?></select>
	   			 <select id="birth-date-year" name="birth_date[year]"><?php
	   				 for ( $i = 1950; $i <= 2015; $i++ ) {
	   					 printf( '<option value="%1$s" %2$s>%1$s</option>', $i, selected( $birth_date['year'], $i, false ) );
	   				 }
	   			 ?></select>
	   		 </td>
	   	 </tr>
	   	 <?php

	    $this->show_user_redirect_field($user);
	    
	    $this->show_user_cohort($user);
	}

	private function show_user_redirect_field($user)
	{
	 	//Only the admin
	 	$currentUser = $this->getUser();
	 	if(!in_array( 'administrator', $currentUser->roles )) return false;
	   	 ?>
		 <tr>
	   		 <th><label>Prompt page on next sign-in</label></th>
	   		 <td>
				<select name="prompt_page_on_login"> 
				<option value="">
				<?php echo esc_attr( 'No page' ); ?></option> 
				<?php 
				$pages = get_pages(); 
				foreach ( $pages as $page ) {
					$selectPage = '';
					if($prompt_page_on_login==get_page_link( $page->ID )) $selectPage = 'selected="selected"';
					
					$option = '<option value="' . get_page_link( $page->ID ) . '" '.$selectPage.'>';
					$option .= $page->post_title;
					$option .= '</option>';
					echo $option;
				}
				?>
				</select>
	   		 </td>
	   	 </tr>
	    </table>
	    <?php
	}

	/**
	 * Save additional profile fields.
	 *
	 * @param  int $user_id Current user ID.
	 */
	function tm_save_profile_fields( $user_id ) {

	    if ( ! current_user_can( 'edit_user', $user_id ) ) return false;

	    if ( !empty( $_POST['birth_date'] ) ) {
		    update_user_meta( $user_id, 'birth_date', $_POST['birth_date'] );
	    }

	 	//Only the admin
	 	$currentUser = $this->getUser();
	 	if(!in_array( 'administrator', $currentUser->roles )) return false;
	    
	    if (!empty($_POST['prompt_page_on_login'])) update_user_meta( $user_id, 'prompt_page_on_login', $_POST['prompt_page_on_login'] );
	    else update_user_meta( $user_id, 'prompt_page_on_login', '' );

	    //also save the cohort field
	    $this->save_user_cohort($user_id);
	}

}
