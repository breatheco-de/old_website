<?php

namespace BreatheCode\Controller;

use WPAS\Controller\WPASController;
use BreatheCode\Utils\BreatheCodeAPI;

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
}