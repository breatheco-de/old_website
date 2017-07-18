<?php

namespace BreatheCode\Controller;

use WPTypes\WPCohort as WPCohort;

class User{
    
    public function renderUserCohort(){
        
        $term = get_queried_object();
        $args['term'] = $term;
        $args['students'] = $this->getStudentsByCohort($term->term_id);
        $args['printRoles'] = $this->printRoles;
        $args['termMeta'] = get_option( 'taxonomy_'.$term->term_id);
        
        $teacher = get_userdata($args['termMeta'][WPCohort::META_MAIN_TEACHER]);
        $args['teacher'] = $teacher;
        $args['teacher_name'] = (isset($teacher) && isset($teacher->display_name)) ? $teacher->display_name : 'Not assigned';;
        
        $args['termParent'] = get_term($term->parent,WPCohort::POST_TYPE);
        
        $args['repls'] = $this->getReplitCoursesOptions($term->term_id);
        
        return $args;
    }
    
    public function renderTeacherCohorts(){
        
        $teacherId = get_current_user_id();
        $args['cohorts'] = $this->getCohorsWithByTeacher($teacherId);
        
        return $args;
    }
    
    private function getStudentsByCohort($cohortId){
        $auxUsers = array();
        $users = get_objects_in_term( $cohortId, WPCohort::POST_TYPE );
        foreach($users as $u) 
        {
            array_push($auxUsers,get_user_by('id',$u));
        }
        return $auxUsers;
    }
    
    private function getCohorsWithByTeacher($teacherId){
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
		$replitCourses = $rawValue = \BCThemeOptions::getThemeOptions('replit-courses');
		
		$term_meta = get_option( "taxonomy_".$cohortId );
		foreach ($replitCourses as $key => $value) {
			$metaKey = "replit_".$key;
			$replitCourses[$key] = $term_meta[$metaKey];
		}
		return $replitCourses;
		
	}
    
}