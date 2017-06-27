<?php

namespace Utils;

class BCError{
    
    public static $errors = [];
    
    static function addTransientError($message)
    {
        $user_id = get_current_user_id();
        
        $transientErrors = get_transient( "bc_errors_{$user_id}" );
        if(!$transientErrors) $transientErrors = [];
        $transientErrors[] = $message;
        
        set_transient("bc_errors_{$user_id}", $transientErrors, 45);
    }
    
    static function loadTransientErrors(){
        $user_id = get_current_user_id();
        if ( $transientErrors = get_transient( "bc_errors_{$user_id}" ) ) {
            foreach ($transientErrors as $e) {
                self::$errors[] = $e;
            }
        }
        
        if(count(self::$errors)>0) add_action( 'admin_notices', 'Utils\BCError::notice__error');
    }
    
    static function notifyError($message)
    {
        if(count(self::$errors)==0) add_action( 'admin_notices', 'Utils\BCError::notice__error');
        array_push(self::$errors, $message);
    }
    
    static function notice__error() {
    	$class = 'notice notice-error';
        foreach(self::$errors as $er) printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), 'Important! '.esc_html( $er ) ); 
        
        $user_id = get_current_user_id();
        delete_transient("bc_errors_{$user_id}");
    }
    
}