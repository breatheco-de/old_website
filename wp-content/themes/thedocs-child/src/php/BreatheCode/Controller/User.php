<?php

namespace BreatheCode\Controller;

use BreatheCode\WPTypes\PostType\WPCohort;
use BreatheCode\BCThemeOptions;
use BreatheCode\Utils\BreatheCodeAPI;
use BreatheCode\GeeksAcademyOnline;
use \Exception, \WP_Error;
use WPAS\Utils\WPASValidator;
use WPAS\Controller\WPASController;

class User{
    
    private function isStudent($userId){ return (get_user_meta($userId, 'type', true) == 'student') ? true : false; }
	private function isTeacher($userId){ return (get_user_meta($userId, 'type', true) == 'teacher') ? true : false; }
	
    public function renderUserCohort(){
        
        $term = get_queried_object();
        $args['term'] = $term;
        
        $members = $this->getCohortMembers($term->term_id);
        $args['students'] = $members['students'];
        $args['teachers'] = $members['teachers'];
        
        $args['printRoles'] = $this->printRoles;
        
        $args['termMeta'] = get_option( 'taxonomy_'.$term->term_id);
        $args['teacher_id'] = $args['termMeta'][WPCohort::META_MAIN_TEACHER];
        
        $args['termParent'] = get_term($term->parent,WPCohort::POST_TYPE);
        
        $args['repls'] = $this->getReplitCoursesOptions($term->term_id);
        
        return $args;
    }
    
    public function renderProfile(){
        
        $user = get_user_by( 'id', get_current_user_id());
        $user = $this->_userToArray($user);
        $args['user'] = $user;
        if($user['type']=='student')
        {
            $args['allStudentBadges'] = BreatheCodeAPI::getStudentBadges(['student_id' => $user['bcId']]);
            $args['allBadges'] = BreatheCodeAPI::getAllBadges();
            $args['getBadge'] = function($allBadges, $slug){
                foreach($allBadges as $b) if($b->slug == $slug) return $b;
            };
        }
        //print_r($args['allBadges']); die();
        return $args;
    }
    
    public function renderStudent(){
        
        $user = get_user_by( 'id', get_current_user_id());
        $args['bcId'] = get_user_meta($user->id, 'breathecode_id', true);
        $user = $this->_userToArray($user);
        if($user['type']=='student')
        {
            $args['user']['type'] = 'student';
            $args['briefing'] = BreatheCodeAPI::getStudentBriefing(['student_id' => $args['bcId']]);
            $args['getBriefingMessage'] = function() use ($args){
                return 'You are here to become a '.$args['briefing']->profile->name.', you have acumulated '.$args['briefing']->acumulated_points.' points during '.$args['briefing']->days.' days at the academy!';
            };
            //print_r($args['briefing']); die();
        }
        if($user['type']=='teacher') wp_redirect('/teacher');

        return $args;
    }
    
    public function renderStudentProfile(){
        
        $user = get_user_by( 'id', $_GET['student']);
        if(!$user) return new WP_Error( 'default', 'The student doest not exists or was not specified' );
        
        $user = $this->_userToArray($user);
        if($user['type']=='student')
        {
            $args['user'] = $user;
            //$args['specialties'] = BreatheCodeAPI::getAllSpecialtiesByProfile(['profile_id' => 'full-stack-web']);
            $args['allStudentBadges'] = BreatheCodeAPI::getStudentBadges(['student_id' => $user['bcId']]);
            $args['allBadges'] = BreatheCodeAPI::getAllBadges();
            $args['assignments'] = BreatheCodeAPI::getStudentAssignments(['student_id' => $user['bcId']]);
            $args['getAssignmentStatus'] = function($status){
                switch($status){
                    case "delivered": return '<i class="fa fa-ship text-warning" aria-hidden="true"></i>'; break;
                    case "not-delivered": return '<i class="fa fa-question text-danger" aria-hidden="true"></i>'; break;
                    case "reviewed": return '<i class="fa fa-check-circle-o text-success" aria-hidden="true"></i>'; break;
                }
            };
            $args['activity'] = BreatheCodeAPI::getStudentActivity(['student_id' => $user['bcId']]);
            //$args['briefing'] = BreatheCodeAPI::getStudentBriefing(['student_id' => $args['bcId']]);
            /*$args['getBriefingMessage'] = function() use ($args){
                return 'You are here to become a '.$args['briefing']->profile->name.', you have acumulated '.$args['briefing']->acumulated_points.' points during '.$args['briefing']->days.' days at the academy!';
            };*/
            //print_r($args['briefing']); die();
            return $args;
        }
        
        return new WP_Error( 'default', 'This is user is not a student, but a '.$user['type'] );

    }
    
    public function renderTeacherCohorts(){
        
        $teacherId = get_current_user_id();
        $args['cohorts'] = $this->getWPCohortsByTeacher($teacherId);
        
        return $args;
    }
    
    private function getCohortMembers($cohortId){
        $auxUsers = array();
        $users = get_objects_in_term( $cohortId, WPCohort::POST_TYPE );
        
        foreach($users as $u) 
        {
            $user = get_userdata($u);
            if($this->isStudent($u)) $auxUsers['students'][] = $user;
            else if($this->isTeacher($u)) $auxUsers['teachers'][] = $user;
        }
        return $auxUsers;
    }
    
    private function getCohortsByTeacher($teacherId){
        
        $bcId = get_user_meta( get_current_user_id(), 'breathecode_id', true);
        
	    $cohorts = BreatheCodeAPI::getTeacherCohorts([
	      'teacher_id' => $bcId
	    ]);
	    return $cohorts;
        
    }
    
    private function getWPCohortsByTeacher($teacherId){
        $taxonomy = WPCohort::POST_TYPE;
        $args = array(	'taxonomy' => $taxonomy,
      //  				'meta_key' => WPCohort::META_MAIN_TEACHER,
    //    				'meta_value' => $teacherId,
    //    				'orderby' => 'meta_value',
     //   				'order' => 'DESC',
          				'hide_empty' => false,
          				'number' => 0
        			);
        $user_meta = get_user_by('id',$teacherId);
        $user_roles = $user_meta->roles; //array of roles the user is part of.
        $terms = get_terms($args); // Get all terms of a taxonomy
        
        $resultingCohorts = array();
        if (!in_array( 'administrator', $user_roles ) )
        {
            foreach($terms as $term){
                $meta = get_option('taxonomy_'.$term->term_id);
                if($meta[WPCohort::META_MAIN_TEACHER]==$teacherId)
                    array_push($resultingCohorts, $term);
            }
            
            return $resultingCohorts;
        }
        else return $terms;
    }
    
    private function printRoles($roles){
        $resultStr = '';
        for($i=0;$i<count($roles);$i++){
            $resultStr .= $roles[$i];
            if($i<count($roles)-1) $resultStr .=  ",";
        }
        return $resultStr;
    }
    
	private function getReplitCoursesOptions($cohortId){
		$replitCourses = array();
		$replitCourses = $rawValue = BCThemeOptions::getThemeOptions('replit-courses');
		
		$term_meta = get_option( "taxonomy_".$cohortId );
		foreach ($replitCourses as $key => $value) {
			$metaKey = "replit_".$key;
			$replitCourses[$key] = $term_meta[$metaKey];
		}
		return $replitCourses;
		
	}
	
	public function update_profile(){
	    
	    $newData = [];
	    $newData['ID'] = get_current_user_id();
	    $newData['first_name'] = WPASValidator::validate(WPASValidator::NAME,$_POST['firstname'],'First Name');
	    $newData['last_name'] = WPASValidator::validate(WPASValidator::NAME,$_POST['lastname'],'Last Name');
	    $newData['description'] = WPASValidator::validate(WPASValidator::DESCRIPTION,$_POST['bio'],'Bio');
	    
	    $github = WPASValidator::validate(WPASValidator::USERNAME,$_POST['github'],'Github username');
	    $phonenumber = WPASValidator::validate(WPASValidator::PHONE,$_POST['phonenumber'],'Phone Number');

	    $errors = WPASValidator::getErrors();
	    if(count($errors)==0){
	        
	        if($github) update_user_meta( $newData['ID'], 'github', $github);
	        if($phonenumber) update_user_meta( $newData['ID'], 'phone', $phonenumber);
	        
            $user_data = wp_update_user( $newData );
            if ( !is_wp_error( $user_data ) ) WPASController::ajaxSuccess("Ok");
            else WPASController::ajaxError([$user_data->get_error_message()]);
	    }
	    else{
	        WPASController::ajaxError($errors);
	    }
	}
	
	private function _userToArray($user){
        $userArray = (array) $user;
        $userArray['first_name'] = $user->first_name;
        $userArray['last_name'] = $user->last_name;
        $userArray['email'] = $user->email;
        $userArray['description'] = $user->description;
        $userArray['user_registered'] = $user->user_registered;
        $userArray['bcId'] = get_user_meta($user->ID, 'breathecode_id', true);
        $userArray['github'] = get_user_meta($user->ID, 'github', true);
        $userArray['phone'] = get_user_meta($user->ID, 'phone', true);
        $userArray['type'] = get_user_meta($user->ID, 'type', true);
        
        return $userArray;
	}
    
}