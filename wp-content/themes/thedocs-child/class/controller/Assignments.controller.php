<?php

namespace BreatheCode\Controller;

use \BCController,\Exception;
use \Utils\BreatheCodeAPI;

class Assignments{
    
    public function renderMyAssignments(){
        
        $args = [];
        $args['assignments'] = \Utils\BreatheCodeAPI::getStudentAssignments(['student_id' => get_current_user_id()]);
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
        
        $args['getAssignmentPermalink'] = function($a)
        {
            return '/lesson-project/'.$a->template->project_slug.'/?sa='.$a->id;
        };
        
        return $args;
    }
    
    public function renderLessonProject(){
        $args = [];
        if(isset($_GET['sa'])) $args['assignment'] = \Utils\BreatheCodeAPI::getSingleStudentAssignment(['assignment_id' => $_GET['sa']]);
        
        return $args;
    }
    
    public function renderReviewAssignments(){
        $args = [];
        if($_GET['teacher'])
        {
        		$bcId = get_user_meta($_GET['teacher'], 'breathecode_id',true);
	          if(!$bcId) throw new Exception('The user '.$_GET['teacher'].' is not synced with the API');
	          
            $args['assignments'] = \Utils\BreatheCodeAPI::getTeacherAssignments([
              'cohort_slug' => $_GET['cohort'],
              'teacher_id' => $bcId
            ]);
        }
        
        return $args;
    }
    
    public function ajax_deliver_project() {

        header('Content-type: application/json');
    	// first check if data is being sent and that it is the data we want
      	if ( isset( $_POST["assignment"] )  ) {
      		// now set our response var equal to that of the POST var (this will need to be sanitized based on what you're doing with with it)
      		$assignmentId = $_POST["assignment"];
      		// send the response back to the front end
      		try{
      		    $bcUser = BreatheCodeAPI::deliverStudentAssignment([
      		      'assignment_id' => $assignmentId,
      		      'status' => 'delivered'
      		    ]);
      		}
      		catch(Exception $e){
                  BCController::ajaxError($e->getMessage());
      		}
            
			    BCController::ajaxSuccess(get_permalink(get_page_by_path( 'my-assignments' )));
    	  }
    	
        BCController::ajaxError('There was an error deliver');
    }
    
    public function ajax_create_new_assignment() {

        header('Content-type: application/json');
    	// first check if data is being sent and that it is the data we want
      	if(!isset( $_POST["cohort_id"] )) BCController::ajaxError('Missing cohort_id');
      	if(!isset( $_POST["template_id"] )) BCController::ajaxError('Missing cohort_id');
    		// now set our response var equal to that of the POST var (this will need to be sanitized based on what you're doing with with it)
    		// send the response back to the front end
    		try{
    		    $bcUser = BreatheCodeAPI::createCohortAssignment([
    		      'template_id' => $_POST["template_id"],
    		      'cohort_id' => $_POST["cohort_id"]
    		    ]);
    		}
    		catch(Exception $e){
            BCController::ajaxError($e->getMessage());
    		}
          
		    BCController::ajaxSuccess(get_permalink(get_page_by_path( 'review-assignments' )));
    	
        BCController::ajaxError('There was an error deliver');
    }
}