<?php

namespace BreatheCode\Controller;

use WPAS\Exception\WPASException;
use \WP_Query;

class AssetsController{
    
    public function renderAssets(){
        
        $assets = new WP_Query(['post_type' => 'lesson-asset', 'posts_per_page' => -1]);
        $args['posts_array'] = $assets->posts;
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
    
    public function renderAssetTechnology(){
        
        $args['term'] = get_queried_object();
        $args['posts_array'] = $this->getAssetsBy($args['term']);
        
        return $args;
    }
    
    public function renderAssetType(){
        
        $args['term'] = get_queried_object();
        $args['posts_array'] = $this->getAssetsBy($args['term']);
        
        return $args;
    }
    
    public function renderLessonAsset(){
        $args = [];
        $post = get_post();
        
        if(empty($post)) throw new WPASException('Lesson Asset not found');
        
        $args['post'] = $post;
        $args['assetUrl'] = get_post_meta( $post->ID, 'wpcf-asset_url',true);
        $args['assetType'] = get_post_meta( $post->ID, 'wpcf-asset_type',true);
        $args['preview'] = get_post_meta( $post->ID, 'wpcf-asset_preview',true);
        $args['types'] = wp_get_post_terms($args['post']->ID,'asset-type');
        $args['technologies'] = wp_get_post_terms($args['post']->ID,'asset-technology');
        return $args;
    }
    
    private function getAssetsBy($term){
        $posts = get_posts(
            array(
                'posts_per_page' => -1,
                'post_type' => 'lesson-asset',
                'tax_query' => array(
                    array(
                        'taxonomy' => $term->taxonomy,
                        'field' => 'term_id',
                        'terms' => $term->term_id,
                    )
                )
            )
        );
        
        return $posts;
    }
    
    public function whatever(){}
}