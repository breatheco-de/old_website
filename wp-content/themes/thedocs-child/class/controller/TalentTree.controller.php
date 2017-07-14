<?php

namespace BreatheCode\Controller;

class TalentTree{
    
    public function renderMyTalents(){
        
        $args = [];
        $args['bcId'] = get_user_meta( get_current_user_id(), 'breathecode_id', true);
        $args['specialties'] = \Utils\BreatheCodeAPI::getAllSpecialtiesByProfile(['profile_id' => 1]);
        $args['allStudentBadges'] = \Utils\BreatheCodeAPI::getStudentBadges(['student_id' => 21]);
        $args['allBadges'] = \Utils\BreatheCodeAPI::getAllBadges();
        $args['getBadge'] = function($allBadges, $slug){
            foreach($allBadges as $b) if($b->slug == $slug) return $b;
        };
        
        return $args;
    }
}