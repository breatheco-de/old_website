<?php

namespace BreatheCode\Model;

use BreatheCode\Utils\BreatheCodeAPI;

class Badge{

    public static function getAll(){
        return BreatheCodeAPI::getAllBadges();        
    }
}