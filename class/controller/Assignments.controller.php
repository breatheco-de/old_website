<?php

namespace BreatheCode\Controller;

class Assignments{
    
    public function renderMyAssignments(){
        
        $args = [];
        $args['assignments'] = \Utils\BreatheCodeAPI::getStudentAssignments(['student_id' => get_current_user_id()]);
        $args['getStatusTag'] = function($status)
        {
          switch($status)
          {
            case "done":
              return '<span class="label label-success">'.$status.'</span>';
              break;
            case "missed":
              return '<span class="label label-danger">'.$status.'</span>';
              break;
            case "due":
              return '<span class="label label-warning">'.$status.'</span>';
              break;
            default:
              return '<span class="label label-default">'.$status.'</span>';
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
    
    public function ajax_deliver_project() {
        
        header('Content-type: application/json');
    	// first check if data is being sent and that it is the data we want
      	if ( isset( $_POST["assignment"] )  ) {
    		// now set our response var equal to that of the POST var (this will need to be sanitized based on what you're doing with with it)
    		$assignmentId = $_POST["assignment"];
    		// send the response back to the front end
    		try{
    		    $bcUser = \Utils\BreatheCodeAPI::deliverStudentAssignment($assignmentId);
    		}
    		catch(\Exception $e){
                BCController::ajaxError($e->getMessage());
    		}
            
			BCController::ajaxSuccess(get_permalink(get_page_by_path( 'my-assignments' )));
    	}
    	
        BCController::ajaxError('There was an error deliver');
    }
}