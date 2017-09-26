<?php

namespace BreatheCode\Model;

class User{


    function all(){
        
    }
    
    function isAdmin($userId){
        $user_meta = get_user_by('id',$userId);
        $user_roles = $user_meta->roles; //array of roles the user is part of.

        if (!in_array( 'administrator', $user_roles ) ) return false;
        else return true;
    }
}