<?php

namespace BreatheCode\Controller;

use WPAS\Controller\WPASController;
use \Exception;
use BreatheCode\Utils\BreatheCodeAPI;

class AssignmentsController{
    
    public function renderMyAssignments(){
        
        $wpID = get_current_user_id();
        $bcId = get_user_meta($wpID, 'breathecode_id',true);
        $type = get_user_meta($wpID, 'type',true);
        
        $args = [];
        if($type=='student') $args['assignments'] = BreatheCodeAPI::getStudentAssignments(['student_id' => $bcId]);
        $args['getStatusTag'] = function($status)
        {
          switch($status)
          {
            case "delivered":
              return '<span class="label label-success label-outline">'.$status.'</span>';
              break;
            case "not-delivered":
              return '<span class="label label-warning label-outline">'.$status.'</span>';
              break;
            default:
              return '<span class="label label-default label-outline">'.$status.'</span>';
              break;
          }
        };
        
        $args['getAssignmentPermalink'] = function($a){
          
            return 'http://projects.breatheco.de/d/'.$a->template->project_slug.'#readme';
        };
        
        return $args;
    }
    
    public function renderLessonProject(){
        $args = [];
        if(isset($_GET['sa'])) $args['assignment'] = BreatheCodeAPI::getSingleStudentAssignment(['assignment_id' => $_GET['sa']]);
        
        return $args;
    }
    
    public function renderReviewAssignments(){
        $args = [];
        if($_GET['teacher'])
        {
        		$bcId = get_user_meta($_GET['teacher'], 'breathecode_id',true);
	          if(!$bcId) throw new Exception('The user '.$_GET['teacher'].' is not synced with the API');
	          
            $args['templates'] = $this->groupAssignmentsByTemplate(BreatheCodeAPI::getTeacherAssignments([
              'cohort_slug' => $_GET['cohort'],
              'teacher_id' => $bcId
            ]));
            
            $args['cohort_slug'] = $_GET['cohort'];
            $args['all-templates'] = BreatheCodeAPI::getAssignmentTemplates();
        }
        
        //print_r($args['templates']); die();
        
        return $args;
    }
    
    public function deliver_project() {

    	// first check if data is being sent and that it is the data we want
      	if ( isset( $_POST["assignment"]) && isset($_POST["github"])  ) {
      		// now set our response var equal to that of the POST var (this will need to be sanitized based on what you're doing with with it)
      		$assignmentId = $_POST["assignment"];
      		$github = $_POST["github"];
      		// send the response back to the front end
      		try{
      		    $bcUser = BreatheCodeAPI::updateStudentAssignment([
      		      'assignment_id' => $assignmentId,
      		      'github_url' => $github,
      		      'status' => 'delivered'
      		    ]);
      		}
      		catch(Exception $e){
                  WPASController::ajaxError($e->getMessage());
      		}
            
			    WPASController::ajaxSuccess(get_permalink(get_page_by_path( 'my-assignments' )));
    	  }
    	
        WPASController::ajaxError('There was an error');
    }
    
    public function create_new_assignment() {
    	// first check if data is being sent and that it is the data we want
      	if(!isset( $_POST["cohort_id"] )) WPASController::ajaxError('Missing cohort_id');
      	if(!isset( $_POST["template_id"] )) WPASController::ajaxError('Missing cohort_id');
      	if(!isset( $_POST["duedate"] )) WPASController::ajaxError('Missing Due Date');
    		// now set our response var equal to that of the POST var (this will need to be sanitized based on what you're doing with with it)
    		// send the response back to the front end
    		try{
    		    $assignemnt = BreatheCodeAPI::createCohortAssignment([
    		      'template_id' => $_POST["template_id"],
    		      'cohort_id' => $_POST["cohort_id"],
    		      'duedate' => $_POST["duedate"]
    		    ]);
    		    
    		    WPASController::ajaxSuccess("Assignments created successfully");
    		}
    		catch(Exception $e){
            WPASController::ajaxError($e->getMessage());
    		}
    }
    
    public function accept_assignment() {
      
    	// first check if data is being sent and that it is the data we want
      	if(!isset( $_POST["assignment_id"] )) WPASController::ajaxError('Missing assignment_id');
      	if(!isset( $_POST["points"] )) WPASController::ajaxError('Missing earned badges by the student');
    		// now set our response var equal to that of the POST var (this will need to be sanitized based on what you're doing with with it)
    		// send the response back to the front end
    		try{
    		  
    		    $result = BreatheCodeAPI::updateStudentAssignment([
    		      'assignment_id' => $_POST["assignment_id"],
    		      'status' => 'reviewed',
    		      'badges' => $_POST["points"]
    		    ]);

    		    WPASController::ajaxSuccess($result);
    		}
    		catch(Exception $e){
            WPASController::ajaxError($e->getMessage());
    		}
    }
    
    public function get_assignment_earnings(){
      
      $assignmentSlug = $_REQUEST['slug'];
      $assignmentSlug = 'instagram-feed';
      
      $content = file_get_contents(PROJECTS_URL.'projects.php?slug='.$assignmentSlug);
      $project = json_decode($content);
      
      if(empty($project)) WPASController::ajaxError($project);
      else WPASController::ajaxSuccess($project);
    }
    
    private function groupAssignmentsByTemplate($assignments){
      $aux = [];
      foreach($assignments as $as){
        if(!isset($aux[$as->template->id])) $aux[$as->template->id] = [];
        $aux[$as->template->id]['info'] = $as->template;
        if(!isset($aux[$as->template->id]['assignments'])) $aux[$as->template->id]['assignments'] = [];
        $aux[$as->template->id]['assignments'][] = $as;
      }
      
      //print_r($aux); die();
      return $aux;
    }
}