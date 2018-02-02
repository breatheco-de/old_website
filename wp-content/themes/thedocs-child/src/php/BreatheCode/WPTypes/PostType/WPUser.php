<?php

namespace BreatheCode\WPTypes\PostType;

use BreatheCode\BCThemeOptions;
use WPAS\Messaging\WPASAdminNotifier as BCNotification;
use BreatheCode\Utils\BreatheCodeAPI;

class WPUser
{
	const POST_TYPE = 'user';
	
	private $user;
	public static $actions = array(
		'empty_bulk_action1' => '---- ACCESS TO BREATHECODE & COURSES -----',
		'disable_access_to_breathecode' => 'Disable all breathecode access',
		'give_access_to_fullstack_prework' => 'Give access to PREWORK Fullstack',
		'give_access_to_fullstack_all' => 'Give access to ALL of Fullstack',
		'give_access_to_teacher_course' => 'Give access to Teacher course',
		'remove_access_to_all_courses' => 'Remove access to all courses',
		'empty_bulk_action3' => '---- API SYNC -----',
		'sync_teacher_with_api' => 'Sync teacher with API (after location creation)',
		'sync_teacher_cohorts_with_api' => 'Sync teacher cohorts with API (after cohort creation)',
		'sync_student_with_api' => 'Sync Student with API (after cohort creation)'
		);

	function __construct() {
		add_action( 'init', array($this, 'register_user_taxonomies' ));
		add_action( 'admin_menu', array($this, 'add_user_cohort_menu' ));
		add_action( 'show_user_profile', array($this, 'tm_additional_profile_fields' ));
		add_action( 'edit_user_profile', array($this, 'tm_additional_profile_fields' ));
		add_action( 'set_user_role', array($this, 'set_user_role'), 10, 3 );
		add_action( 'personal_options_update', array($this, 'tm_save_profile_fields' ));
		add_action( 'edit_user_profile_update', array($this, 'tm_save_profile_fields' ));
	    
	    add_action( 'manage_users_columns' , array($this,'userColumns'), 10, 2 );
	    add_action( 'manage_users_custom_column' , array($this,'customUserColumn'), 10, 3 );
		add_action( 'restrict_manage_users', array($this,'userFilters'),10,3 );
		add_action( 'pre_get_users', array($this,'filterUsers'),10,3 );
		
		add_filter( 'bulk_actions-users', array($this,'register_my_bulk_actions' ), 10, 3);
		add_filter( 'handle_bulk_actions-users', array($this,'my_bulk_action_handler'), 10, 3 );

	}

	function getUser(){
		if(!$this->user)
		{
			$this->user = wp_get_current_user();
		}

		return $this->user;
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
	
	function remove_access_to_all_courses($studentId){
		//print_r($terms);die();
		wp_set_object_terms( $studentId, null, WPCourse::TAX_SLUG, false );
	 
		//make sure you clear the term cache
		clean_object_term_cache($studentId, WPCourse::TAX_SLUG);
	}
	
	function disable_access_to_breathecode($studentId){

		$user = get_user_by('id', $studentId);
		foreach($user->roles as $roleName) $user->remove_role( $roleName );
		$user->add_role( 'disabled' );
	}
	
	function give_access_to_fullstack_prework($studentId){
		$prework = get_option(BCThemeOptions::PREWORK_FULLSTACK_OPTION);
		$prework_esp = get_option(BCThemeOptions::PREWORK_FULLSTACK_OPTION.'-es');
		if(isset($prework)) $this->giveAccessToParentCourse($studentId,$prework);
		if(isset($prework_esp)) $this->giveAccessToParentCourse($studentId,$prework_esp);
		$user = get_user_by('id', $studentId); 
		$user->remove_role( 'disabled' ); 
		if(!$user->has_role('premium_full_stack')) $user->add_role( 'prework_full_stack' );
	}
	
	function sync_teacher_cohorts_with_api($userId){
		
		$wpUser = get_userdata($userId);
		if($wpUser)
		{
			$type = $this->getUserType($userId, $wpUser->roles);
			if($type!='teacher'){
				BCNotification::addTransientMessage(BCNotification::ERROR,'This method can only be called for teachers, user '.$wpUser->user_email.' is a: '.$type);
				return;
			}
			
			$studentCohorts = [];
			$terms = wp_get_post_terms($userId,WPCohort::POST_TYPE);
			foreach($terms as $t) $studentCohorts[] = $t->name;
			
			$bcUser = BreatheCodeAPI::syncUser([
				"email" => $wpUser->user_email,
				"wp_id" => $userId,
				"type" => $type,
				"cohorts" => $studentCohorts
				]);
			if($bcUser){
				if($result) BCNotification::addTransientMessage(BCNotification::SUCCESS,'The user was successfully synced with ID '.$bcUser->id);
			}
			else BCNotification::addTransientMessage(BCNotification::ERROR,'There was an issue obtaining the Breathecode ID');
		}
		else BCNotification::addTransientMessage(BCNotification::ERROR,'User '.$userId.' not found');
	}
	
	function sync_teacher_with_api($userId){
		
		$wpUser = get_userdata($userId);
		if($wpUser)
		{
			$type = $this->getUserType($userId, $wpUser->roles);
			if($type!='teacher'){
				BCNotification::addTransientMessage(BCNotification::ERROR,'This method can only be called for students, user '.$wpUser->user_email.' is not');
				return;
			}
			
			$bcUser = BreatheCodeAPI::syncUser([
				"email" => $wpUser->user_email,
				"full_name" => $wpUser->display_name,
				"password" => $wpUser->user_pass,
				"wp_id" => $wpUser->ID,
				"type" => $type
				]);
			if($bcUser){
				$result = update_user_meta( $userId, 'breathecode_id', $bcUser->id );
				update_user_meta($userId, 'type',$type);
				if($result) BCNotification::addTransientMessage(BCNotification::SUCCESS,'The user was successfully synced with ID '.$bcUser->id);
			}
			else BCNotification::addTransientMessage(BCNotification::ERROR,'There was an issue obtaining the Breathecode ID');
		}
		else BCNotification::addTransientMessage(BCNotification::ERROR,'User '.$userId.' not found');
	}
	
	function sync_student_with_api($userId){
		
		$wpUser = get_userdata($userId);
		if($wpUser)
		{
			$type = $this->getUserType($userId, $wpUser->roles);
			if($type!='student'){
				BCNotification::addTransientMessage(BCNotification::ERROR,'This method can only be called for students, user '.$wpUser->user_email.' is: '.$type);
				return false;
			}
			
			$studentCohorts = [];
			$terms = wp_get_post_terms($userId,WPCohort::POST_TYPE);
			foreach($terms as $t) $studentCohorts[] = $t->slug;
			if(count($studentCohorts)==0){
				BCNotification::addTransientMessage(BCNotification::ERROR,'The user needs to belong at least to one cohort');
				return false;
			}
			
			$bcUser = BreatheCodeAPI::syncUser([
				"email" => $wpUser->user_email,
				"full_name" => $wpUser->display_name,
				"password" => $wpUser->user_pass,
				"wp_id" => $wpUser->ID,
				"cohorts" => $studentCohorts,
				"type" => $type
				]);
			if($bcUser){
				$result = update_user_meta( $userId, 'breathecode_id', $bcUser->id );
				$result2 = update_user_meta($userId, 'type',$type);
				if($result && $result2) BCNotification::addTransientMessage(BCNotification::SUCCESS,'The user was successfully synced with ID '.$bcUser->id);
			}
			else BCNotification::addTransientMessage(BCNotification::ERROR,'There was an issue obtaining the Breathecode ID');
		}
		else BCNotification::addTransientMessage(BCNotification::ERROR,'User '.$userId.' not found');
	}
	
	function getUserType($userId, $roles, $force=false){
		
		$useType = get_user_meta($userId, 'type',true);
		if($useType && !$force) return $useType;
		else{
			if(in_array('administrator',$roles)){
				update_user_meta($userId, 'type','admin');
				return 'admin';
			} 
			else if(in_array('teacher_assistant',$roles) || in_array('main_teacher',$roles)){
				update_user_meta($userId, 'type','teacher');
				return 'teacher';
			}
			else{
				update_user_meta($userId, 'type','student');
				return 'student';
			} 
		}
	}
	
	function set_user_role( $user_id, $role, $old_roles ) {
	    $this->getUserType($user_id, [$role], true);
	}
	
	function give_access_to_fullstack_all($studentId){
		
		$premium = get_option(BCThemeOptions::PREMIUM_FULLSTACK_OPTION);
		$premium_esp = get_option(BCThemeOptions::PREMIUM_FULLSTACK_OPTION.'-es');
		if(isset($premium)) $this->giveAccessToParentCourse($studentId,$premium);
		if(isset($premium_esp)) $this->giveAccessToParentCourse($studentId,$premium_esp);
		
		$user = get_user_by('id', $studentId); $user->remove_role( 'disabled' );
		if($user->has_role('prework_full_stack')) $user->remove_role( 'prework_full_stack' );
		$user->add_role( 'premium_full_stack' );
		
		$this->give_access_to_fullstack_prework($studentId);
	}

	function give_access_to_teacher_course($studentId){
		
		$breathecode = get_option(BCThemeOptions::BREATHECODE_OPTION);
		//$breathecode_esp = get_option(BCThemeOptions::BREATHECODE_OPTION.'-es');
		if(isset($breathecode)) $this->giveAccessToParentCourse($studentId,$breathecode);
		//if(isset($breathecode_esp)) $this->giveAccessToParentCourse($studentId,$breathecode_esp);
	}
	
	function empty_bulk_action($studentId){
		//empty action, just for estetics
	}
	
	private function giveAccessToParentCourse($studentId,$courseId){
		$courses = get_terms(array(
			'taxonomy' => 'course',
			'parent' => $courseId
		));
		$assigned_terms = wp_get_object_terms( $studentId, WPCourse::TAX_SLUG );
	    $assigned_term_ids = array();
	    foreach( $assigned_terms as $term ) array_push($assigned_term_ids, $term->term_id);
	    foreach( $courses as $term ) array_push($assigned_term_ids, $term->term_id);
	    array_push($assigned_term_ids, $courseId);
		$this->addUserToTaxonomies($studentId,$assigned_term_ids,WPCourse::TAX_SLUG);
	}

	function userColumns( $columns ) {
		unset( $columns['level'] );
		unset( $columns['posts'] );
		$columns[WPCohort::POST_TYPE] = 'Cohort';
		$columns['breathecode_id'] = 'API ID';
		//die(print_r($columns));
		return $columns;
	}

	function customUserColumn( $value, $column_name ,$userId) {
		switch ( $column_name ) {

			case WPCohort::POST_TYPE:
				$terms = wp_get_post_terms($userId,WPCohort::POST_TYPE);
				$termStrg = '';
				if(!$terms or count($terms)==0) return 'No cohorts';
				foreach ($terms as $term) {
					$termStrg .= $term->name.',';
				}
				return $termStrg;
			break;
			case 'breathecode_id':
				return get_user_meta( $userId, 'breathecode_id', true);
			break;
		}
	}
	
	function filterUsers( $query ) {
	    global $pagenow;
	
	    if ( is_admin() && 'users.php' == $pagenow && isset( $_GET[ WPCohort::POST_TYPE ] ) && is_array( $_GET[ WPCohort::POST_TYPE ] )) {
	        $section = $_GET[ WPCohort::POST_TYPE ];
	        $section = !empty( $section[ 0 ] ) ? $section[ 0 ] : $section[ 1 ];

			
			$users = get_objects_in_term( $section, WPCohort::POST_TYPE );
	        $query->set( 'include', $users );
	        //$query->set( 'meta_query', $meta_query );
	    }
	}
	
	function userFilters() {
	    if ( isset( $_GET[ WPCohort::POST_TYPE ]) ) {
	        $section = $_GET[ WPCohort::POST_TYPE ];
	        $section = !empty( $section[ 0 ] ) ? $section[ 0 ] : $section[ 1 ];
	    } else {
	        $section = -1;
	    }
	    $terms = get_terms(array('taxonomy' => WPCohort::POST_TYPE,
      				'hide_empty' => false,
      				'number' => 0
      	));
	    echo ' <select name="'.WPCohort::POST_TYPE.'[]" style="float:none;"><option value="">Filter by cohort...</option>';
	    foreach ( $terms as $t ) {
	        $selected = $t->term_id == $section ? ' selected="selected"' : '';
	        echo '<option value="' . $t->term_id . '"' . $selected . '>' . $t->name . '</option>';
	    }
	    echo '<input type="submit" class="button" value="Filter">';
	}

	function register_user_taxonomies(){
		$this->registerTaxonomy(array(
			"slug" => WPCohort::POST_TYPE,
			"singularName" => 'User Cohort',
			"pluralName" => 'User Cohorts',
			"hierarchical" => true,
			));
	}
	
	function registerTaxonomy($settings){
		$labels = array(
			'name' => 'User '.$settings['singularName'],
			'singular_name' => $settings['singularName'],
			'search_items' => 'Search '.$settings['pluralName'],
			'all_items' => 'All '.$settings['pluralName'],
			'parent_item' => 'Parent '.$settings['singularName'],
			'parent_item_colon' => 'Parent '.$settings['singularName'],
			'edit_item' => 'Edit '.$settings['singularName'],
			'update_item' => 'Update '.$settings['singularName'],
			'add_new_item' => 'Add New '.$settings['singularName'],
			'new_item_name' => 'New '.$settings['singularName'].' Name',
			'menu_name' => $settings['singularName']
		);
	 
		register_taxonomy( $settings['slug'] , 'user' , array(
			'hierarchical' => $settings['hierarchical'],
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => $settings['slug'])
		));
	}

	function add_user_cohort_menu() {
	    add_submenu_page( 'users.php' , 'User Cohort', 'User Cohort' , 'add_users',  'edit-tags.php?taxonomy=user_cohort' );
	}

	private function show_user_cohort( $user ) {
	 
	 	$currentUser = $this->getUser();
	 	if(in_array( 'administrator', $currentUser->roles ))
	 	{
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
		    echo '<table class="widefat fixed"  cellspacing="0">';
		    $className = 'class="alternate"';
		    foreach( $user_cats as $cat ) {
		        if(!$cat->parent) { 
					echo '<tr '.$className.'><td><h5>'.$cat->name.' ('.$cat->term_id.')</h5></td>';
		        	if($className) $className = null; 
		        	else $className = 'class="alternate"';
					$args3 = array(
						'child_of' => $cat->term_id,
						'orderby'  => 'id',
						'hide_empty'=>false,
						'order'    => 'DESC'
					);
					$childTerms = get_terms('user_cohort', $args3);
		        	echo '<td>';
		    		foreach( $childTerms as $cterm ) {
		        ?>
				        <input type="checkbox" id="user-cohort-<?php echo $cterm->term_id ?>" <?php if(in_array( $cterm->term_id, $assigned_term_ids )) echo 'checked=checked';?> name="user_cohort[]"  value="<?php echo $cterm->term_id;?>"/> 
				    <?php
				    	echo '<label for="user-cohort-'.$cterm->term_id.'">'.$cterm->name.' ('.$cterm->slug.')</label>';
				    	echo '<br />';
					}
					echo '</td>';
	    		}
				echo '</tr>';
	    	}
	    	echo '</table>';
 		}
	}

	private function save_user_cohort( $user_id ) {
	 
	 	//Only the admin
	 	$currentUser = $this->getUser();
	 	if(in_array( 'administrator', $currentUser->roles ))
	 	{
		 	if(isset($_POST[WPCohort::POST_TYPE]))
		 	{
				$user_terms = $_POST[WPCohort::POST_TYPE];
				$this->addUserToTaxonomies($user_id,$user_terms,WPCohort::POST_TYPE);
		 	}
	 	}
	}

	private function addUserToTaxonomies($user_id, $taxonomies, $taxonomyType){
		$terms = array_unique( array_map( 'intval', $taxonomies ) );
		//print_r($terms);die();
		wp_set_object_terms( $user_id, $terms, $taxonomyType, false );
	 
		//make sure you clear the term cache
		clean_object_term_cache($user_id, $taxonomyType);
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
	   		 <th><label for="breathecode_id">BreatheCode API ID</label></th>
	   		 <td>
	   			 <?php echo get_user_meta( $user->ID, 'breathecode_id', true); ?>
	   		 </td>
	   	 </tr>
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
	   	 <tr>
	   		 <th><label for="phone">Phone Number</label></th>
	   		 <td>
	   		 	<input type="text" name="phone" value="<?php echo get_user_meta( $user->ID, 'phone', true); ?>" />
	   		 </td>
	   	 </tr>
	   	 <tr>
	   		 <th><label for="github">Github</label></th>
	   		 <td>
	   		 	<input type="text" name="github" value="<?php echo get_user_meta( $user->ID, 'github', true); ?>" />
	   		 </td>
	   	 </tr>
	   	 <?php

	    $this->show_user_redirect_field($user);
	    
	    $this->show_user_cohort($user);
	}

	private function show_user_redirect_field($user){
		
	 	//Only the admin
	 	$currentUser = $this->getUser();
	 	if(in_array( 'administrator', $currentUser->roles ))
	 	{

		 	$prompt_page_on_login = get_user_meta( $user->ID, 'prompt_page_on_login', true);
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
						if($prompt_page_on_login==$page->post_name) $selectPage = 'selected="selected"';
						
						$option = '<option value="' . $page->post_name . '" '.$selectPage.'>';
						$option .= $page->post_title;
						$option .= '</option>';
						echo $option;
					}
					?>
					</select>
					<?php echo $prompt_page_on_login; ?>
		   		 </td>
		   	 </tr>
		    </table>
		    <?php
		}
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
	 	if(in_array( 'administrator', $currentUser->roles ))
	 	{
		    if (!empty($_POST['prompt_page_on_login'])) update_user_meta( $user_id, 'prompt_page_on_login', $_POST['prompt_page_on_login'] );
		    else update_user_meta( $user_id, 'prompt_page_on_login', '' );

		    if (!empty($_POST['github'])) update_user_meta( $user_id, 'github', $_POST['github'] );
		    if (!empty($_POST['phone'])) update_user_meta( $user_id, 'phone', $_POST['phone'] );
		    //also save the cohort field
		    $this->save_user_cohort($user_id);
	 	}
	}

}
