<?php

namespace BreatheCode\Controller;

use WPAS\Controller\WPASController;
use BreatheCode\Utils\BreatheCodeAPI;

class Teacher{
    
    public function check_attendancy(){
        
        $attendantsIds = $_POST['attendants'];
        
        //TODO: Send email with attendants names
        
        WPASController::ajaxSuccess($attendantsIds);
    }
}