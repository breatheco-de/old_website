<?php

namespace BreatheCode\Controller;

use WPAS\Exception\WPASException;
use \WP_Query;

class Search{
    
    public function renderSearch(){
        
        $query_args = array( 
            's' => $_GET['s'], 
            'post_type' => $_GET['post_type'],
            'posts_per_page' => -1
        );
        $query = new WP_Query( $query_args );
        $args['posts_array'] = $query->posts;
        print_r($args['posts_array']); die();
        
        $postsByTechnology = $this->getPostsByTerm($_GET['post_type'], 'asset-technology', $_GET['s']);
        $args['posts_array'] = array_merge($args['posts_array'], $postsByTechnology);
        
        $args['getIcon'] = function($type){
            if(empty($type)) return '';
            switch($type->slug)
            {
                case 'infographics':
                    return '<i class="fa fa-file-text" aria-hidden="true"></i>';
                break;
                case 'config-file':
                    return '<i class="fa fa-cog" aria-hidden="true"></i>';
                break;
                case 'snippet':
                    return '<i class="fa fa-code" aria-hidden="true"></i>';
                break;
                case 'books':
                    return '<i class="fa fa-book" aria-hidden="true"></i>';
                break;
                case 'youtube-channels':
                    return '<i class="fa fa-youtube" aria-hidden="true"></i>';
                break;
                case 'cheat-sheet':
                    return '<i class="fa fa-newspaper-o" aria-hidden="true"></i>';
                break;
                default:
                    return $type->slug;
                break;
            }
        };
        
        return $args;
    }
    
    function getPostsByTerm($post_type, $taxonomy, $term){
        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $term,
                ),
            ),
         );
    
         $loop = new WP_Query($args);
         return $loop->posts;
    }
    
    function whatever(){}
    
}