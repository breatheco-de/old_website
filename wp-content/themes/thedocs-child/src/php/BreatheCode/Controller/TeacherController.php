<?php

namespace BreatheCode\Controller;

use WPAS\Controller\WPASController;
use BreatheCode\Utils\BreatheCodeAPI;
use BreatheCode\WPLanguages;
use WPAS\Utils\WPASValidator;

use BreatheCode\Model\Badge;
use BreatheCode\Model\Cohort;
use BreatheCode\Model\User;

class TeacherController{
    
    public function check_attendancy(){
        
        $attendants = $_POST['attendants'];
        $cohortId = $_POST['cohort_id'];
        $cohort = get_term_by( 'id', $cohortId, 'user_cohort' );
        //TODO: Send email with attendants names
        $result = $this->sendAttendancy($cohort,$attendants);
        
        if($result) WPASController::ajaxSuccess('The attendancy was logged successfully');
        else WPASController::ajaxError('Ubable to log the attendancy');
    }
    
    public function update_replits(){
        
        $replitValues = $_POST['repls'];
        $cohortId = $_POST['cohort_id'];
        
        $termeta = get_option('taxonomy_'.$cohortId);
        foreach($replitValues as $key => $val)
            if(isset($termeta['replit_'.$key])) $termeta['replit_'.$key] = $val;
        
        $result = update_option( "taxonomy_$cohortId", $termeta );

        if($result) WPASController::ajaxSuccess('The values where updated successfully');
        else WPASController::ajaxError('Nothing was saved.');
    }
    
    public function renderBulkBadges(){
        
        $vars = [];
        
        $teacherId = get_current_user_id();
        
        $vars['cohorts'] = Cohort::wp_getByTeacher($teacherId);
        $vars['badges'] = Badge::getAll();
        
        if(isset($_GET['cohort']))
        {
            $members = Cohort::wp_getMembers($_GET['cohort']); //115
            $vars['students'] = $members['students'];
            //print_r($vars['students']); die();
        }
        
        return $vars;
    }
    
    private function sendAttendancy($cohort, $attendants){
		$subject = 'Class Attendancy: '.$cohort->name.' '.date('d-m-Y');
		$content = '<p>The following students attended to the class at '.$cohort->name.' on the '.date('d-m-Y').'</p>';
		$content .= '<table style="width: 100%;">';
		$count=0;
		foreach($attendants as $key => $val)
		{
		    if(!$val or $val=='false') continue;
		    $count++;
			$content .= '<tr>';
				$content .= '<td>'.$count.') '.$val.'</td>';
			$content .= '</tr>';
		}
		$content .= '</table>';

		add_filter( 'wp_mail_content_type', array($this,'set_html_content_type' ));
		$status = wp_mail('info@4geeksacademy.com', $subject, $content);
		remove_filter( 'wp_mail_content_type', array($this,'set_html_content_type' ));
		
		return $status;
    }
    
    function set_html_content_type() {return 'text/html';}
    
    function add_bulk_badges(){
        
        try{
            $students = $_POST['students'];
    	    $badgeSlug = WPASValidator::validate(WPASValidator::SLUG,$_POST['badge'],'Badge Slug');
    	    //$points = WPASValidator::validate(WPASValidator::INTEGER,$_POST['points'],'Points Earned'); //Now an array
    	    $points = $_POST['points'];
    	    if(!is_array($points)) $points = WPASValidator::validate(WPASValidator::INTEGER,$points,'Points Earned');
    	    $template = WPLanguages::getActivityTemplate('teacher-points-earned',[
        	        'badge_slug' => $badgeSlug,
        	        'points' => $points,
        	        'first_name' => $teacher->first_name
        	        ]);
            
            $activities = [];
            foreach($students as $index => $std)
            {
        	    $wordpressId = WPASValidator::validate(WPASValidator::INTEGER,$std,'Student Id');
                $activities[] = [
                    'student_id'    => User::getBreathecodeId($wordpressId),
                    'badge_slug'    => $badgeSlug,
                    'type'    => 'teacher_reward',
                    'points_earned'    => is_array($points) ? $points[$index] : $points,//Index of points array
            	    'name'          => $template['title'],
            	    'description'   => $template['description']
                ];
            }
		}
		catch(\Exception $e){
            WPASController::ajaxError([$e->getMessage()]);
		}
        
        foreach($activities as $act){
    		try{
    		    $result = BreatheCodeAPI::addStudentActivity($act);
    		}
    		catch(\Exception $e){
                WPASController::ajaxError([$e->getMessage()]);
    		}
        }
	    
	    WPASController::ajaxSuccess('Ok');
    }
    
}