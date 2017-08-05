<?php

namespace BreatheCode\Controller;

use BreatheCode\WPTypes\PostType\WPCohort;
use BreatheCode\BCThemeOptions;
use BreatheCode\Utils\BreatheCodeAPI;
use BreatheCode\GeeksAcademyOnline;
use \Exception;
use WPAS\Utils\WPASValidator;
use WPAS\Controller\WPASController;

class User{
    
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
        $args['bcId'] = get_user_meta($user->id, 'breathecode_id', true);
        $args['user'] = (array) $user;
        $args['user']['first_name'] = $user->first_name;
        $args['user']['last_name'] = $user->first_name;
        $args['user']['email'] = $user->email;
        $args['user']['description'] = $user->description;
        $args['user']['user_registered'] = $user->user_registered;
        $args['user']['github'] = get_user_meta($user->id, 'github', true);
        $args['user']['phone'] = get_user_meta($user->id, 'phone', true);
        if($this->isStudent($user))
        {
            $args['user']['type'] = 'student';
            $args['specialties'] = BreatheCodeAPI::getAllSpecialtiesByProfile(['profile_id' => 'full-stack-web']);
            $args['allStudentBadges'] = BreatheCodeAPI::getStudentBadges(['student_id' => $args['bcId']]);
            $args['allBadges'] = BreatheCodeAPI::getAllBadges();
            //print_r($args['allBadges']); die();
            $args['getBadge'] = function($allBadges, $slug){
                foreach($allBadges as $b) if($b->slug == $slug) return $b;
            };
        }
        if($this->isTeacher($user)){
            $args['user']['type'] = 'teacher';
        }
        //print_r($args['user']); die();
        return $args;
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
            if($this->isStudent($user)) $auxUsers['students'][] = $user;
            else if($this->isTeacher($user)) $auxUsers['teachers'][] = $user;
        }
        return $auxUsers;
    }
    
    private function isStudent($user){
        foreach(GeeksAcademyOnline::$studentRoles as $role)
            if(in_array($role, $user->roles)) return true;
            
        return false;
    }
    
    private function isTeacher($user){
        foreach(GeeksAcademyOnline::$teacherRoles as $role)
            if(in_array($role, $user->roles)) return true;
            
        return false;
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
    
}