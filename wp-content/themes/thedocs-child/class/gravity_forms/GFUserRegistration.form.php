<?php
namespace GFForm;

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
		
		//getting post
	    $courseId = rgar( $entry, '13' );
	    $courseTerm = get_term($courseId);
		$users = wp_set_object_terms( $user_id, $courseTerm->name,'course' );
	}
}