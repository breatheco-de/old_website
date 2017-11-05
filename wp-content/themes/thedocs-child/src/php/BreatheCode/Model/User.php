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
}