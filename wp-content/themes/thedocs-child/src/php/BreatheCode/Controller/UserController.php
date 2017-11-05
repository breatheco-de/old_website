<?php

namespace BreatheCode\Controller;

use BreatheCode\WPTypes\PostType\WPCohort;
use BreatheCode\BCThemeOptions;
use BreatheCode\Utils\BreatheCodeAPI;
use BreatheCode\GeeksAcademyOnline;
use \Exception, \WP_Error;
use WPAS\Utils\WPASValidator;
use WPAS\Controller\WPASController;
use BreatheCode\WPLanguages;

use BreatheCode\Model\User;
use BreatheCode\Model\Cohort;

class UserController{
    
    public function renderUserCohort(){
        
        $term = get_queried_object();
        $args['term'] = $term;
        
        $members = Cohort::wp_getMembers($term->term_id);
        $args['students'] = $members['students'];
        $args['teachers'] = $members['teachers'];
        
        $args['printRoles'] = $this->printRoles;
        
        $args['termMeta'] = get_option( 'taxonomy_'.$term->term_id);
        $args['teacher_id'] = $args['termMeta'][WPCohort::META_MAIN_TEACHER];
        
        $args['termParent'] = get_term($term->parent,WPCohort::POST_TYPE);
        
        $args['repls'] = $this->getReplitCoursesOptions($term->term_id);
        
        return $args;
    }
    
    public function renderProfile(){
        
        $user = get_user_by( 'id', get_current_user_id());
        $user = $this->_userToArray($user);
        $args['user'] = $user;
        if($args['user']['type']=='student')
        {
            $args['allStudentBadges'] = BreatheCodeAPI::getStudentBadges(['student_id' => $args['user']['bcId']]);
            $args['allBadges'] = BreatheCodeAPI::getAllBadges();
            $args['settings'] = BreatheCodeAPI::getUserSettings(['user_id' => $args['user']['bcId']]);
            //print_r($args['user']); die();
            $args['getBadge'] = function($allBadges, $slug){
                foreach($allBadges as $b) if($b->slug == $slug) return $b;
            };
        }
//        print_r($args['allStudentBadges']); die();
        return $args;
    }
    
    public function renderStudent(){
        
        $user = get_user_by( 'id', get_current_user_id());
        $args['user'] = $this->_userToArray($user);
        $args['user']['bcId'] = get_user_meta($user->id, 'breathecode_id', true);
        
        if($args['user']['type']=='student')
        {
            $args['briefing'] = BreatheCodeAPI::getStudentBriefing(['student_id' => $args['user']['bcId']]);
            $args['getBriefingMessage'] = function() use ($args){
                $temp = WPLanguages::getStudentTemplate('student-greeting',[
    	        'profile' => $args['briefing']->profile->name,
    	        'acumulated_points' => $args['briefing']->acumulated_points,
    	        'days' => $args['briefing']->days
    	        ]);
    	        //print_r($temp); die();
    	        return $temp;
            };
            
            $cohorts = wp_get_object_terms($args['user']["id"],'user_cohort',array('orderby'=>'term_order'));
            if(count($cohorts)==0) throw new WPASException('You need to belong to one cohort in order to access any lessons');
            
        	$args['cohort'] = $cohorts[0];
            //print_r($args['cohort']); die();
            $termMeta = get_option( 'taxonomy_'.$args['cohort']->term_id);
    		if(!$termMeta) throw new Exception('Could not find cohort data');
    	    $args['slack-url'] = $termMeta[WPCohort::META_COHORT_SLACK];
    	    
    	    $args['activity'] = BreatheCodeAPI::getStudentActivity(['student_id' => $args['user']['bcId']]);
    	    
    	    
        }
        if($args['user']['type']=='teacher') wp_redirect('/teacher');

        return $args;
    }
    
    public function renderStudentProfile(){
        
        $user = get_user_by( 'id', $_GET['student']);
        if(!$user) return new WP_Error( 'default', 'The student doest not exists or was not specified' );
        
        $user = $this->_userToArray($user);
        if($user['type']=='student')
        {
            $args['user'] = $user;
            //$args['specialties'] = BreatheCodeAPI::getAllSpecialtiesByProfile(['profile_id' => 'full-stack-web']);
            $args['allStudentBadges'] = BreatheCodeAPI::getStudentBadges(['student_id' => $user['bcId']]);
            $args['allBadges'] = BreatheCodeAPI::getAllBadges();
            $args['assignments'] = BreatheCodeAPI::getStudentAssignments(['student_id' => $user['bcId']]);
            $args['getAssignmentStatus'] = function($status){
                switch($status){
                    case "delivered": return '<i class="fa fa-ship text-warning" aria-hidden="true"></i>'; break;
                    case "not-delivered": return '<i class="fa fa-question text-danger" aria-hidden="true"></i>'; break;
                    case "reviewed": return '<i class="fa fa-check-circle-o text-success" aria-hidden="true"></i>'; break;
                }
            };
            
            $args['blocked-quizzes'] = User::getBlockedQuizes($args['user']['id']);
            
            $args['activity'] = BreatheCodeAPI::getStudentActivity(['student_id' => $user['bcId']]);
            //$args['briefing'] = BreatheCodeAPI::getStudentBriefing(['student_id' => $args['bcId']]);
            /*$args['getBriefingMessage'] = function() use ($args){
                return 'You are here to become a '.$args['briefing']->profile->name.', you have acumulated '.$args['briefing']->acumulated_points.' points during '.$args['briefing']->days.' days at the academy!';
            };*/
            //print_r($args['briefing']); die();
            return $args;
        }
        
        return new WP_Error( 'default', 'This is user is not a student, but a '.$user['type'] );

    }
    
    public function renderTeacherCohorts(){
        
        $teacherId = get_current_user_id();
        $args['cohorts'] = Cohort::wp_getByTeacher($teacherId);
        
        return $args;
    }
    
    private function getCohortsByTeacher($teacherId){
        
        $bcId = get_user_meta( get_current_user_id(), 'breathecode_id', true);
        
	    $cohorts = BreatheCodeAPI::getTeacherCohorts([
	      'teacher_id' => $bcId
	    ]);
	    return $cohorts;
        
    }
    
    private function printRoles($roles){
        $resultStr = '';
        for($i=0;$i<count($roles);$i++){
            $resultStr .= $roles[$i];
            if($i<count($roles)-1) $resultStr .=  ",";
        }
        return $resultStr;
    }
    
	private function getReplitCoursesOptions($cohortId){
		$replitCourses = array();
		$replitCourses = $rawValue = BCThemeOptions::getThemeOptions('replit-courses');
		
		$term_meta = get_option( "taxonomy_".$cohortId );
		foreach ($replitCourses as $key => $value) {
			$metaKey = "replit_".$key;
			$replitCourses[$key] = $term_meta[$metaKey];
		}
		return $replitCourses;
		
	}
	
	public function update_profile(){
	    
	    $newData = [];
	    $newData['ID'] = get_current_user_id();
	    $newData['first_name'] = WPASValidator::validate(WPASValidator::NAME,$_POST['firstname'],'First Name');
	    $newData['last_name'] = WPASValidator::validate(WPASValidator::NAME,$_POST['lastname'],'Last Name');
	    $newData['description'] = WPASValidator::validate(WPASValidator::DESCRIPTION,$_POST['bio'],'Bio');
	    
	    $github = WPASValidator::validate(WPASValidator::USERNAME,$_POST['github'],'Github username');
	    $phonenumber = WPASValidator::validate(WPASValidator::PHONE,$_POST['phonenumber'],'Phone Number');

	    $errors = WPASValidator::getErrors();
	    if(count($errors)==0){
	        
	        if($github) update_user_meta( $newData['ID'], 'github', $github);
	        if($phonenumber) update_user_meta( $newData['ID'], 'phone', $phonenumber);
	        
            $user_data = wp_update_user( $newData );
            if ( !is_wp_error( $user_data ) ) WPASController::ajaxSuccess("Ok");
            else WPASController::ajaxError([$user_data->get_error_message()]);
	    }
	    else{
	        WPASController::ajaxError($errors);
	    }
	}
	
	public function update_settings(){
	    
	    $errors = [];
	    
	    $settings = null;
	    if(!is_array($_POST['settings'])) $errors[] = "Invalid settings";
	    else $settings = $_POST['settings'];

	    if(count($errors)==0){
	        
    		try{
    		    
    		    $args["user_id"] = User::getBreathecodeId(get_current_user_id());
    		    $args["settings"] = $settings;
    		    //print_r($args); die();
    		    $result = BreatheCodeAPI::updateUserSettings($args);
    		    
    		    WPASController::ajaxSuccess($result);
    		}
    		catch(\Exception $e){
                WPASController::ajaxError([$e->getMessage()]);
    		}
	    }
	    else{
	        WPASController::ajaxError($errors);
	    }
	}
	
	public function enable_quiz(){
	    
	    $newData = [];
	    $studentId = $_POST['student'];
	    $quizSlug = WPASValidator::validate(WPASValidator::SLUG,$_POST['quiz'],'Slug');
	    
	    $errors = WPASValidator::getErrors();
	    if(count($errors)==0){
	        
	        $attempts = get_user_meta( $studentId, 'quiz_attempts', true);
	        
	        if(!isset($attempts[$quizSlug])) WPASController::ajaxError('There was a problem re-enabling the quiz.');
	        
	        unset($attempts[$quizSlug]);
	        update_user_meta( $studentId, 'quiz_attempts', $attempts);

            WPASController::ajaxSuccess("Ok");
	    }
	    else{
	        WPASController::ajaxError($errors);
	    }
	}
	
	public function get_all_badges(){
	    
		try{
		    $badges = BreatheCodeAPI::getAllBadges([]);
		    
		    WPASController::ajaxSuccess($badges);
		}
		catch(\Exception $e){
            WPASController::ajaxError($e->getMessage());
		}
	}
	
	public function give_points(){
	    
		try{
		    
		    $teacher = get_user_by( 'id', get_current_user_id());
		    
    	    $wordpressId = WPASValidator::validate(WPASValidator::INTEGER,$_POST['student'],'Student Id');
    	    $args['student_id'] = User::getBreathecodeId($wordpressId);
    	    $args['badge_slug'] = WPASValidator::validate(WPASValidator::SLUG,$_POST['badge'],'Badge Slug');
    	    $args['points_earned'] = WPASValidator::validate(WPASValidator::INTEGER,$_POST['points'],'Points Earned');
    	    $args['type'] = 'teacher_reward';
    	    
    	    $template = WPLanguages::getActivityTemplate('teacher-points-earned',[
    	        'badge_slug' => $args['badge_slug'],
    	        'points' => $args['points_earned'],
    	        'first_name' => $teacher->first_name
    	        ]);
    	    $args['name'] = $template['title'];
    	    $args['description'] = $template['description'];

		    $result = BreatheCodeAPI::addStudentActivity($args);
		    
		    WPASController::ajaxSuccess($result);
		}
		catch(\Exception $e){
            WPASController::ajaxError([$e->getMessage()]);
		}
	}
	
	public function save_slack_url(){
	    
		try{
		    $slackURL = WPASValidator::validate(WPASValidator::URL,$_POST['slack'],'Slack URL');
		    $cohortId = WPASValidator::validate(WPASValidator::INTEGER,$_POST['cohort_id'],'Cohort Id');
		    
    	    $errors = WPASValidator::getErrors();
    	    if(count($errors)==0){
    		    $termMeta = get_option( 'taxonomy_'.$cohortId);
    		    if(!$termMeta) throw new Exception('Could not find cohort data');
    		    $termMeta[WPCohort::META_COHORT_SLACK] = $slackURL;
    		    update_option( "taxonomy_".$cohortId, $termMeta );
    	        
    	        WPASController::ajaxSuccess("Ok");
    	    }
    	    else WPASController::ajaxError($errors); 
		}
		catch(\Exception $e){
            WPASController::ajaxError([$e->getMessage()]);
		}
	}
	
	private function _userToArray($user){
        $userArray = (array) $user;
        $userArray['id'] = $user->ID;
        if($user->first_name) $userArray['first_name'] = $user->first_name;
        if($user->last_name) $userArray['last_name'] = $user->last_name;
        if($user->display_name) $userArray['display_name'] = $user->display_name;
        $userArray['email'] = $user->user_email;
        $userArray['description'] = $user->description;
        $userArray['user_registered'] = $user->user_registered;
        $userArray['bcId'] = get_user_meta($user->ID, 'breathecode_id', true);
        $userArray['github'] = get_user_meta($user->ID, 'github', true);
        $userArray['phone'] = get_user_meta($user->ID, 'phone', true);
        $userArray['type'] = get_user_meta($user->ID, 'type', true);
        
        
        return $userArray;
	}
	
}