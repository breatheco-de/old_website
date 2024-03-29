<?php


namespace BreatheCode\Controller;

use WPAS\Exception\WPASException;
use \WP_Query, \Exception;
use BreatheCode\Utils\BreatheCodeAPI;
use WPAS\Controller\WPASController;

class QuizController{
    
    public function renderQuiz(){
        
        $args = [];
        if(!isset($_GET['qslug'])) return $args;
        $args['student_id'] = get_current_user_id();
        
        $quizesContent = file_get_contents(ASSETS_URL.'apis/quiz/'.$_GET['qslug']);
        $quiz = json_decode($quizesContent);
        if($quiz && is_object($quiz))
        {
            $args['quiz'] = $quiz;

            $attempts = get_user_meta( $args['student_id'], 'quiz_attempts', true);
            if(isset($attempts[$args['quiz']->info->slug]) and $attempts[$args['quiz']->info->slug]>0){
                $args['blocked'] = true;
            }else $args['blocked'] = false;
            
            $args['badges'] = [];
            foreach($args['quiz']->info->badges as $b){
                try{
                    $badge = (array) BreatheCodeAPI::getBadge(['badge_id' => $b->slug]);
                    $badge['points'] = $b->points;
                    $args['badges'][] = $badge;
                }
                catch(Exception $e){}
            }
        }
        
        //print_r($attempts); die();
        return $args;
    }
    
    public function save_attempt(){
        
        if(!isset($_POST['quiz'])) WPASController::ajaxError(['The quiz slug must be specified']);
        
        $studentId = get_current_user_id();
        if(!isset($_POST['student']) || $_POST['student']!=$studentId) WPASController::ajaxError(['Invalid student id']);
        
        $attempts = get_user_meta( $studentId, 'quiz_attempts', true);
        if(!$attempts) $attempts = [];
        if(!isset($attempts[$_POST['quiz']])) $attempts[$_POST['quiz']] = 1;
        else $attempts[$_POST['quiz']]++;
        
        update_user_meta( $studentId, 'quiz_attempts', $attempts);
        
        WPASController::ajaxSuccess("The attempt was logged");
        
    }
    
    function getReplits(){
        $cohorts = \BreatheCode\Model\Cohort::all();
        $replits = [];
        foreach($cohorts as $c)
        {
            $term_meta = get_option( "taxonomy_".$c->term_id );
            if($term_meta)
            {
                $replits[$c->slug] = $term_meta;
            }
        }
        return $replits;
    }
    
}