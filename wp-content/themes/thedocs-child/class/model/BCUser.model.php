<?php

class BCUser{
    
    private $ID;
    private $metadata = [];
    
    function __construct($ID){
        $this->metadata = array(
            "promt_on_login" => "prompt_page_on_login"
        );
    }
    
    function getValue($key)
    {
        if(!empty($this->metadata[$key])) return $this->metadata[$key];
        else get_user_meta( $this->ID, 'prompt_page_on_login', true);
    }
    
}