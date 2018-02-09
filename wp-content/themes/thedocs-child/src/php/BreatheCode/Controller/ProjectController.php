<?php
namespace BreatheCode\Controller;

use WPAS\Controller\WPASController;
use WPAS\Exception\WPASException;
use BreatheCode\Utils\BreatheCodeAPI;
use WP_Error;

class ProjectController{
    
    public function renderProject(){

        $args = [];
        if(empty($_GET['slug'])){
            $error = new WP_Error();
            $error->add( 'empty', 'It seems that there is no particular project to display.' );
            return $error;
        } 
        $slug = $_GET['slug'];
        
        $projectJSON = @file_get_contents(PROJECTS_URL.'projects.php?slug='.$slug);
        if(!$projectJSON){
            $error = new WP_Error();
            $error->add( 'empty', 'Project '.$slug.' could not be found' );
            return $error;
        }
        
        $project = json_decode($projectJSON);
        if(!$project){
            $error = new WP_Error();
            $error->add( 'empty', 'Project '.$slug.' could not be found' );
            return $error;
        }
        
        $args['project'] = (array) $project;
        
        $readme = @file_get_contents(PROJECTS_URL.$project->readme);
        if(!$readme) return $args;
        $Parsedown = new \Parsedown();
        $args['readme'] = $Parsedown->text($readme);
        
        $args['badges'] = [];
        /*
        foreach($args['project']['talents'] as $b){

            try{
                $badge = (array) BreatheCodeAPI::getBadge(['badge_id' => $b->badge]);
                $badge['points'] = $b->points;
                $args['badges'][] = $badge;
            }
            catch(Exception $e){}
        }*/
        
        return $args;

    }
    
    function whatever(){}
    
    function get_projects(){
        
        $templates = BreatheCodeAPI::getAssignmentTemplates();
        WPASController::ajaxSuccess($templates);
    }

}