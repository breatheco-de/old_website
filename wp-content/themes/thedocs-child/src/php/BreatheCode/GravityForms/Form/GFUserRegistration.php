<?php

namespace BreatheCode\GravityForms\Form;
use WPAS\Messaging\WPASAdminNotifier as BCNotification;
use BreatheCode\WPTypes\PostType\WPCohort;
use BreatheCode\Utils\BreatheCodeAPI;

class GFUserRegistration{
    
    const FORM_USER_REGISTRATION = 'Manual User Registration';
    function __construct(){
		add_filter( 'gform_pre_render', array($this,'populate_new_user_fields') );
		add_action( 'gform_user_registered', array($this,'finishUserRegistration'), 10, 4 );
    }
    
	function populate_new_user_fields($form){

		//Cut the execution of the function
		if($form['title']!=self::FORM_USER_REGISTRATION) return $form;

		foreach ( $form['fields'] as $field )
		{
			if ( $field->type == 'select' and strpos( $field->cssClass,'student-cohorts' )!==false ) {
			   	$terms = get_terms(array('taxonomy' => 'user_cohort','hide_empty' => 0));
			   	$choices = array();
				foreach($terms as $term) if($term->parent!=0) $choices[] = array( 'text' => $term->name, 'value' => $term->term_id );
			   	$field->choices = $choices;
			   	$field->placeholder = 'Select a cohort';
			}
			else if ( $field->type == 'select' and strpos( $field->cssClass,'available-courses' )!==false ) {
			   	$terms = get_terms( array( 'taxonomy' => 'course','hide_empty' => 0, 'parent'=>0));
			   	$choices = array();
				foreach($terms as $term) $choices[] = array( 'text' => $term->name, 'value' => $term->term_id );
			   	$field->choices = $choices;
			   	$field->placeholder = 'Select a course';
			}
		}
		return $form;
	}
	

	function finishUserRegistration($user_id, $feed, $entry)
	{
		//getting post
	    $cohortId = rgar( $entry, '11' );
	    $cohortTerm = get_term($cohortId);
		$users = wp_set_object_terms( $user_id, $cohortTerm->name,'user_cohort' );
		
		$this->sync_student_with_api($user_id);
		
	}
	
	function sync_student_with_api($userId){
		
		$wpUser = get_userdata($userId);
		if($wpUser)
		{
			$type = get_user_meta($userId, 'type',true);
			
			$studentCohorts = [];
			$terms = wp_get_post_terms($userId,WPCohort::POST_TYPE);
			foreach($terms as $t) $studentCohorts[] = $t->name;
			
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
			}
			else throw new Exception('There was an issue obtaining the Breathecode ID');
		}
		else throw new Exception('User '.$userId.' not found');
	}
}