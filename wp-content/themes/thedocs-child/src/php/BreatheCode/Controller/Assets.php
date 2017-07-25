<?php

namespace BreatheCode\Controller;

use WPAS\Exception\WPASException;

class Assets{
    
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
        $args['$assetType'] = get_post_meta( $post->ID, 'wpcf-asset_type',true);
        $args['$preview'] = get_post_meta( $post->ID, 'wpcf-asset_preview',true);
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
}