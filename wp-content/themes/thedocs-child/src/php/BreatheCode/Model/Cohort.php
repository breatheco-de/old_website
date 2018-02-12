<?php

namespace BreatheCode\Model;

use BreatheCode\WPTypes\PostType\WPCohort;
use BreatheCode\Utils\BreatheCodeAPI;
use BreatheCode\Model\User;

use WPAS\Types\BasePostType;
use WPAS\Utils\WPASException;
use \WP_Query;

class Cohort extends BasePostType{

    public static function getByTeacher($teacherId){
        
        $bcId = get_user_meta( get_current_user_id(), 'breathecode_id', true);
        
	    $cohorts = BreatheCodeAPI::getTeacherCohorts([
	      'teacher_id' => $bcId
	    ]);
	    return $cohorts;
        
    }
    
    public static function wp_getByTeacher($teacherId){
        $taxonomy = WPCohort::POST_TYPE;
        $args = array(	'taxonomy' => $taxonomy,
      //  				'meta_key' => WPCohort::META_MAIN_TEACHER,
    //    				'meta_value' => $teacherId,
    //    				'orderby' => 'meta_value',
     //   				'order' => 'DESC',
                        'lang' => 'en,es',
          				'hide_empty' => false,
          				'number' => 0
        			);
        $terms = get_terms($args); // Get all terms of a taxonomy
        $resultingCohorts = array();
        if (!User::isAdmin($teacherId))
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
    
    public static function wp_getMembers($cohortId){
        $auxUsers = array();
        $users = get_objects_in_term( $cohortId, WPCohort::POST_TYPE );
        
        foreach($users as $u) 
        {
            $user = get_userdata($u);
            if(User::isStudent($u)) $auxUsers['students'][] = $user;
            else if(User::isTeacher($u)) $auxUsers['teachers'][] = $user;
        }
        return $auxUsers;
    }
    
    public static function getBySlug($slug){
        
        if(empty(self::$postType)) throw new WPASException('Please instanciete the class '.get_called_class().' at least one time before using it');
        if(!is_string($slug)) throw new WPASException('getBySlug must receive a string as parameter $slug');

        $term = get_term_by('slug',$slug,'user_cohort');
        if(!empty($term)){
            return $term;
        }else return null;
    }
    
    public static function all($args = [], $hook = NULL){
        $terms = get_terms( array(
            'taxonomy' => 'user_cohort',
            'hide_empty' => false,
        ) );
        return $terms;
    }
}