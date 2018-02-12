<?php

namespace BreatheCode\Model;
use \WP_Query;
use WPAS\Types\BasePostType;

class Lesson extends BasePostType{
    
    function getReplit($replit_slug,$termId){

        $term_meta = get_option( "taxonomy_".$termId );
        if($term_meta)
        {
            if(isset($term_meta['replit_'.$replit_slug])) return $term_meta['replit_'.$replit_slug];
            else return null;
        }
        else return null;
    }
}