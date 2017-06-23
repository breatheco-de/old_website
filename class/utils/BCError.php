<?php

namespace Utils;

class BCError{
    
    public static $errors = [];
    
    static function notifyError($message){
        if(count(self::$errors)==0) add_action( 'admin_notices', 'Utils\BCError::notice__error');
        array_push(self::$errors, $message);
    }
    
    static function notice__error() {
    	$class = 'notice notice-error';
        foreach(self::$errors as $er) printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), 'Important! '.esc_html( $er ) ); 
    }
}