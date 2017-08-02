<?php

namespace BreatheCode\Controller;

use WPAS\Controller\WPASController;
use BreatheCode\Utils\BreatheCodeAPI;

class TalentTree{
    
    public function renderMyTalents(){
        
        $args['bcId'] = get_user_meta( get_current_user_id(), 'breathecode_id', true);
        $args['specialties'] = BreatheCodeAPI::getAllSpecialtiesByProfile(['profile_id' => 1]);
        $args['allStudentBadges'] = BreatheCodeAPI::getStudentBadges(['student_id' => 21]);
        $args['allBadges'] = BreatheCodeAPI::getAllBadges();
        $args['getBadge'] = function($allBadges, $slug){
            foreach($allBadges as $b) if($b->slug == $slug) return $b;
        };
        
        return $args;
    }
    
    //ajax
    public function get_badge(){
        
        try{
            $badge = BreatheCodeAPI::getBadge(['badge_id' => $_GET['badge']]);
            WPASController::ajaxSuccess($badge);
        }
        catch(Exception $e){
            WPASController::ajaxError($e->getMessage());
        }
    }
    
    
}