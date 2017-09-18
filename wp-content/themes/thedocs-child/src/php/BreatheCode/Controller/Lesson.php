<?php
namespace BreatheCode\Controller;

use WPAS\Controller\WPASController;
use WPAS\Exception\WPASException;
use BreatheCode\Utils\BreatheCodeAPI;

class Lesson{
    
    public function renderCourse(){

        $args['course'] = get_queried_object();
        $args['menu_name'] = types_render_termmeta('course-sidebar-id',["term_id" => $args['course']->term_id]);
        $args['createCourseHierarchy'] = [$this,'createCourseHierarchy'];
        
        $termIndex = get_term_meta($args['course']->term_id,'wpcf-index-lesson',true);
        if($termIndex) $args['index-lesson'] = get_permalink($termIndex);
        else $args['index-lesson'] = null;
        
        $args['getCourseSubheading'] = [$this,'getCourseSubheading'];
        return $args;

    }
    
    public function renderLesson(){

        $lessonId = get_the_ID();
    	$terms = wp_get_post_terms($lessonId,'course');
    	$totalTerms = count($terms);
    	if($totalTerms!=1) throw new WPASException('This lesson needs to be asigned to one course and is assigned to '.$totalTerms);

        
    	$args['course'] = $terms[0];
        $args['menu_name'] = types_render_termmeta('course-sidebar-id',["term_id" => $args['course']->term_id]);
        $args['createCourseHierarchy'] = [$this,'createCourseHierarchy'];
        $args['getLessonAssets'] = [$this,'getLessonAssets'];
        
        $cohorts = wp_get_object_terms(get_current_user_id(),'user_cohort',array('orderby'=>'term_order'));
        if(!count($cohorts)==0) $args['lesson'] = $this->getLesson($lessonId, $cohorts[0]->term_id);
        else $args['lesson'] = $this->getLesson($lessonId, null);
        //print_r($terms); die();
        return $args;

    }
    
    public function renderMyCourses(){
        $userId = get_current_user_id();
        //echo 'hello'; die();
        $args = [];
        if(!empty($userId)) $args['courses'] = $this->getCourses($userId);
        return $args;
    }
    
    public function renderLessonProject(){
        $args = [];
        $post = get_post();
        
        if(empty($post)) throw new WPASException('Lesson Project not found');
        
        $args['post'] = $post;
        $args['thumbnail'] = get_the_post_thumbnail( $post->ID, 'post_thumbnail', array( 'class' => 'alignleft img-responsive' ) );
        $args['filesUrl'] = get_post_meta( $post->ID, 'wpcf-project-files',true);
        $args['duration'] = get_post_meta( $post->ID, 'wpcf-project-hour-duration',true);
        $args['dificulty'] = get_post_meta( $post->ID, 'wpcf-project-difficulty',true);
        $args['technologies'] = wp_get_post_terms($post->ID,'project-technology');
        return $args;
    }
    
    public function getCourses($userId){
        $auxTerms = array();
        
        $parentTerms = wp_get_object_terms( $userId, 'course' );
        //print_r($parentTerms); die();
        foreach($parentTerms as $pTerm)
        {
            //array_push($auxTerms,$pTerm);
            $childrens = get_term_children( $pTerm->term_id, 'course' );
            //taxonomy-status
            //die(print_r($childrens));
            foreach($childrens as $cTerm){
                $status = get_term_meta($cTerm,'wpcf-taxonomy-status',true);
                $currentLang = pll_current_language();
                $language = pll_get_term_language($cTerm);
                //echo $currentLang.'=='.$language; die();
                if($status=='publish' and $currentLang==$language)
                {
                    $cTerm = get_term_by('id', $cTerm, 'course');
                    array_push($auxTerms,$cTerm);
                }
            }
        }
        
        return $auxTerms;
    }
    
    public function getLessonAssets($postId){
        
      $array_assets = array();
      //Empiezo a imprimir las proximas fechas de los cursos
      $args = array(
      'post_type'     => 'lesson-asset',
      'meta_key'      => '_wpcf_belongs_lesson_id',
      'posts_per_page'  =>  -1,
      'meta_value'      => $postId
      );
      $query_assets = new \WP_Query($args);
      $cont = 0;
      while($query_assets->have_posts()) : $query_assets->the_post();
        $assetId = get_the_ID();
        $description = get_the_content();
        $title = get_the_title();
        $assetUrl = get_post_meta( $assetId, 'wpcf-asset_url', true);
        $assetType = get_post_meta( $assetId, 'wpcf-asset_type', true);
        $assetPreview = get_post_meta( $assetId, 'wpcf-asset_preview', true);
    
        $asset = array(
          "title"=> $title, 
          "description"=>$description ,
          "url"=> $assetUrl ,
          "type"=> $assetType, 
          "preview"=> $assetPreview
          );
    
        array_push($array_assets,$asset);
      endwhile; 
      wp_reset_postdata();
    
      return $array_assets;
    }
    
    public function getCourseSubheading(){
        $subheading = types_render_termmeta('course-subheading',array( "term_id" => $args['course']->term_id));
        return $subheading;
    }
    
    public function createCourseHierarchy($menu_name) {
    		
		$menuParents = array();
		$menu = wp_get_nav_menu_object($menu_name);
		if(!$menu) return $menuParents;
		$menu_items = wp_get_nav_menu_items($menu->term_id,array(
			//'post_status'            => 'publish'
			));

		foreach ( (array) $menu_items as $key => $menu_item ) {
		  $id = $menu_item->ID;
		  $title = $menu_item->title;
		  $url = $menu_item->url;
		  if(!$menu_item->menu_item_parent or $menu_item->menu_item_parent=='')
		  {
		    $menuParents[$id] = array("id"=>$id,"title"=>$title, "url"=>$url, "childs"=>array());
		  }
		  else
		  {
		    if(isset($menuParents[$menu_item->menu_item_parent]))
		      $menuParents[$menu_item->menu_item_parent]["childs"][$id] = array("id"=>$id,"title"=>$title, "url"=>$url, "childs"=>array());
		    else
		      foreach ($menuParents as $parent){
		        if(isset($parent["childs"][$menu_item->menu_item_parent]))
		        {
		          $menuParents[$parent["id"]]["childs"][$menu_item->menu_item_parent]["childs"][$id] = array("id"=>$id,"title"=>$title, "url"=>$url, "childs"=>array());
		        }
		      }
		  }
		}

		return $menuParents;
    }
    
    private function getLesson($lessonId, $termId){
        
        $lessonObj = get_post($lessonId);
        $lessonMeta = get_post_meta($lessonId, 'meta_'.$lessonObj->post_type, true);
        
        $lesson = [];
        $lesson["title"] = $lessonObj->post_title;
        $lesson["excerpt"] = $lessonObj->post_excerpt;
        
        if(!empty($lessonMeta['quiz'])) $lesson["quiz"] = get_permalink( get_page_by_path( 'quiz' ) ) .'?qslug='. $lessonMeta['quiz'];
        else $lesson["quiz"] = null;
        
        if(!empty($lessonMeta['replit']) && !empty($termId)){
            $term_meta = get_option( "taxonomy_".$termId );
            if($term_meta)
            {
                $exercisestringkey = $lessonMeta['replit'];
                if(isset($term_meta['replit_'.$exercisestringkey])) $lesson["replit"] = $term_meta['replit_'.$exercisestringkey];
                else $lesson["replit"] = null;
                
            }
            else $lesson["replit"] = null;
        }
        else $lesson["replit"] = null;
        
        if(!empty($lessonMeta['previous-lesson'])) $lesson["previous-lesson"] = get_permalink($lessonMeta['previous-lesson']);
        else $lesson["previous-lesson"] = null;
        
        if(!empty($lessonMeta['next-lesson'])) $lesson["next-lesson"] = get_permalink($lessonMeta['next-lesson']);
        else $lesson["next-lesson"] = null;

        $backgroundURL = get_post_meta($lessonId, 'wpcf-lesson-background', true);
        if($backgroundURL) $lesson["background"] = $backgroundURL;
        else $lesson["background"] = get_stylesheet_directory_uri().'/assets/img/lesson-bg.jpg';

        $readingTime = get_post_meta($lessonId, 'wpcf-reading-time', true);
        if($readingTime) $lesson["reading-time"] = $readingTime .' minutes';
        else $lesson["reading-time"] = 'Not defined.';
        
        return $lesson;
        
    }
    
    function whatever(){}

}