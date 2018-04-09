<?php

namespace BreatheCode\Model;

class User{


    function all(){
        
    }
    
	public static function getBreathecodeId($id){
        return get_user_meta( $id, 'breathecode_id', true);
	}
	
	public static function getBlockedQuizes($studentId){
        $attempts = get_user_meta( $studentId, 'quiz_attempts', true);
        if(!$attempts) return [];
        
        $quizzes = [];
        foreach($attempts as $key => $val) $quizzes[] = $key;
        return $quizzes;
	}
	
    function isAdmin($userId){
        $user_meta = get_user_by('id',$userId);
        $user_roles = $user_meta->roles; //array of roles the user is part of.

        if (!in_array( 'administrator', $user_roles ) ) return false;
        else return true;
    }
    
    public static function isStudent($userId){ return (get_user_meta($userId, 'type', true) == 'student') ? true : false; }
	public static function isTeacher($userId){ return (get_user_meta($userId, 'type', true) == 'teacher') ? true : false; }
	
    public static function getCourses($userId, $currentLang=null){
        $auxTerms = array();
        
        $parentTerms = wp_get_object_terms( $userId, 'course' );
        //print_r($parentTerms); die();
        foreach($parentTerms as $pTerm){
            //array_push($auxTerms,$pTerm);
            $childrens = get_term_children( $pTerm->term_id, 'course' );
            //taxonomy-status
            foreach($childrens as $cTerm){
                $status = get_term_meta($cTerm,'wpcf-taxonomy-status',true);
                if(!$currentLang) $currentLang = pll_current_language();
                $language = pll_get_term_language($cTerm);
                //echo $currentLang.'=='.$language; die();
                if($status=='publish' and $currentLang==$language)
                {
                    $cTerm = get_term_by('id', $cTerm, 'course');
                    array_push($auxTerms,$cTerm);
                }
            }
        }
        
        return $auxTerms;
    }
    public static function getAllCourses($currentLang=null){
        $auxTerms = array();
        
        $terms = get_terms( 'course');
        foreach($terms as $cTerm){
            $status = get_term_meta($cTerm->term_id,'wpcf-taxonomy-status',true);
            if(!$currentLang) $currentLang = pll_current_language();
            $language = pll_get_term_language($cTerm->term_id);
            //print_r($terms); die();
            //echo $currentLang.'=='.$language; die();
            if($status=='publish' and $cTerm->parent != 0 and $currentLang==$language) array_push($auxTerms,$cTerm);
        }
        
        return $auxTerms;
    }
}