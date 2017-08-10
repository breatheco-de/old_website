<?php
namespace BreatheCode\WPTypes\PostType;

use WP_Query, WP_User_Query, \Exception;
use BreatheCode\Utils\BreatheCodeAPI;
use WPAS\Messaging\WPASAdminNotifier as BCNotification;

class WPProjectAssignment
{
	const POST_TYPE = 'student-assignment';
	//const FORM_ASSIGNMENT_ID = '6';
	const FORM_ASSIGNMENT_TITLE = 'Assign Project to Class';
	const FORM_DELIVER_ASSIGNMENT_TITLE = 'Deliver Project Assignment';
	
	public static $actions = array(
		'sync_with_api' => 'Sync with API'
		);
	
	private static $assignmentStatus = array(
		"due" => "Assignment Delivered",
		"pending" => "Assignment Delivered",
		"done" => "Assignment Delivered",
		"missed" => "Assignment Delivered"
		);

	  function __construct() {
	    add_filter( 'wpt_field_options', array($this,'fill_select'), 10, 3);
	    add_action( 'manage_'.self::POST_TYPE.'_posts_columns' , array($this,'projectPostsColumns'), 10, 2 );
	    add_action( 'manage_'.self::POST_TYPE.'_posts_custom_column' , array($this,'customProjectSolumn'), 10, 2 );
	    add_action( 'transition_post_status', array($this,'post_published_notification'), 10, 2 );
	    add_action( 'save_post_'.self::POST_TYPE, array($this,'slug_save_post_callback'), 10, 3 );
	    add_filter( 'gform_pre_render', array($this,'populate_project_fields') );
	    add_action( 'gform_after_submission', array($this,'set_post_content'), 10, 2 );
	    
		add_filter( 'bulk_actions-edit-'.self::POST_TYPE, array($this,'register_my_bulk_actions' ), 10, 3);
		add_filter( 'handle_bulk_actions-edit-'.self::POST_TYPE, array($this,'my_bulk_action_handler'), 10, 3 );
	  }
	  
	function register_my_bulk_actions($bulk_actions) {
		foreach(self::$actions as $key => $value) $bulk_actions[$key] = __( $value, 'breathecode');
		return $bulk_actions;
	}
	
	function my_bulk_action_handler( $redirect_to, $doaction, $posts ) {
	  if ( !isset(self::$actions[$doaction]) ) {
	    return $redirect_to;
	  }

	  foreach ( $posts as $postId ) {
	    	call_user_func(array($this,$doaction), $postId);
	  }
	  
	  $redirect_to = add_query_arg( 'affected_ids', count( $posts ), $redirect_to );
	  return $redirect_to;
	}
	
	public function sync_with_api($assignmentId){
		$wpAssignment = get_post($assignmentId);
		if($wpAssignment)
		{
			$studentId = get_post_meta( $assignmentId, 'wpcf-student-assigned',true);
			if(!$studentId) throw new Exception('There was an issue obtaining the student id');
			$studentBCId = get_user_meta( $studentId, 'breathecode_id', true);
			if(!$studentBCId) throw new Exception('The student '.$studentId.' has no API id');
			
			$teacherId = get_post_meta( $assignmentId, 'wpcf-assignment-teacher',true);
			if(!$teacherId) throw new Exception('There was an issue obtaining the teacher id');
			$teacherBCId = get_user_meta( $teacherId, 'breathecode_id', true);
			if(!$teacherBCId) throw new Exception('The teacher '.$teacherId.' has no API id');
			
			$projectId = get_post_meta( $assignmentId, 'wpcf-project-assigned',true);
			$project = get_post($projectId);
			if(!$project) throw new Exception('Invalid project assinged id: '.$projectId);
			$templateSlug = $project->post_name;
			
			$duedate = get_post_meta( $assignmentId, 'wpcf-assignment-due-date',true);
			$status = get_post_meta( $assignmentId, 'wpcf-assignment-status',true);
			
			$result = BreatheCodeAPI::syncAssignment([
				"template_slug" => $templateSlug,
				"student_id" => $studentBCId,
				"teacher_id" => $teacherBCId,
				"duedate" => date('Y/m/d', $duedate),
				"status" => $this->_translateStatus($status)
				]);
			if($result){
				$result = update_post_meta( $assignmentId, 'breathecode_id', $result->id );
				if($result) BCNotification::addTransientMessage(BCNotification::SUCCESS,'The assignment was successfully synced with API ID '.$result->id);
			}
			else BCNotification::addTransientMessage(BCNotification::ERROR,'There was an issue obtaining the Breathecode ID');
		}
		else BCNotification::addTransientMessage(BCNotification::ERROR,'Assignment '.$assignmentId.' not found');
	}
	
	private function _translateStatus($status){
		switch($status)
		{
			case "done": return 'reviewed'; break;
			case "missed": return 'not-delivered'; break;
			case "due": return 'not-delivered'; break;
			case "pending": return 'not-delivered'; break;
		}
		
		return null;
	}

	  /**
	   * Gets triggered when a new "student-assignment" is created
	   */
	  function post_published_notification($new_status, $old_status )
	  {
	  	if(isset($_POST['post_type']) and $_POST['post_type']==self::POST_TYPE)
	  	{
		  	if ( $old_status != 'publish'  &&  $new_status == 'publish' ) {
		  		$assignmentId = get_the_ID();
		  		$assignmentSlug = get_post_field( 'post_name', $assignmentId );
				$studentId = get_post_meta( $assignmentId, 'wpcf-student-assigned',true);
	            $user = get_user_by('id',$studentId);
	            if ($user)
	            {
	            	$projectId = get_post_meta( $assignmentId, 'wpcf-project-assigned',true);
	            	$duedate = get_post_meta( $assignmentId, 'wpcf-assignment-due-date',true);
	            	$project = array(
	            		"title" => get_the_title($projectId),
	            		"assignment" => $assignmentSlug,
	            		"duedate" => date('jS \of F: hA', $duedate),
	            		"duration" => get_post_meta( $projectId, 'wpcf-project-hour-duration',true),
	            		"excerpt" => get_post_meta( $projectId, 'wpcf-project-excerpt',true)
	            		);
					$this->notifyNewProjectToUser($user,$project);
	            }
		  	}
	  	}
	  }

	  function projectPostsColumns( $columns ) {
	  	
	    unset( $columns['title'] );
	    unset( $columns['date'] );
	    $columns['student'] = 'Student';
	    $columns['project'] = 'Project';
	    $columns['duedate'] = 'Due Date';
	    $columns['assignment-status'] = 'Status';
	    $columns['api-id'] = 'API ID';
	    //die(print_r($columns));
	    return $columns;
	  }

	  function customProjectSolumn( $column, $postId ) {
	      switch ( $column ) {

	          case 'student' :
	              $studentId = get_post_meta( $postId, 'wpcf-student-assigned',true);
	              $user = get_user_by('id',$studentId);
	              if ($user) echo $user->data->display_name.' ('.$user->data->user_email.')';
	              else echo 'Unable to get user';
	            break;

	          case 'project' :
	              $projectId = get_post_meta( $postId, 'wpcf-project-assigned',true);
	              $projectTitle = get_the_title($projectId);
	              if ( is_string( $projectTitle ) ) echo $projectTitle;
	              else echo 'Unable to get project title';
	            break;

	          case 'duedate' :
	              $duedate = get_post_meta( $postId, 'wpcf-assignment-due-date',true);
	              if ( is_string( $duedate ) ) echo  date('l jS \of F', $duedate);
	              else echo 'Unable to get due date';
	            break;

	          case 'assignment-status' :
	              $status = get_post_meta( $postId, 'wpcf-assignment-status',true);
	              if ($status and is_string( $status ) ) echo $status;
	              else echo 'Unable to get the satus';
	            break;
	            
	          case 'api-id' :
	              $bdId = get_post_meta( $postId, 'breathecode_id', true);
	              echo ($bdId) ? $bdId : 'not synced';
	            break;

	      }
	  }

	  function fill_select( $options, $title, $type ) {
	      switch($title)  
	      {
	        case "Student Assigned": $options = $this->getStudents($options); break;
	        case "Project Assigned": $options = $this->getProjects($options); break;
	        case "Teacher Assigned": $options = $this->getTeachers($options); break;
	      }

	      return $options;
	  }

	  function getStudents($optns){
	      $optns = array();
	      
	      $users = new WP_User_Query( array( 'meta_key' => 'type', 'meta_value' => 'student' ) );
	      foreach ($users->results as $u) {
	          $optns[] = array(
	              '#value' => $u->ID,
	              '#title' => $u->display_name.' ('.$u->user_email.')'
	          );
	      } 

	      return $optns;
	  }

	  function getTeachers($optns){
	      $optns = array();
	      
	      $users = new WP_User_Query( array( 'meta_key' => 'type', 'meta_value' => 'teacher' ) );
	      foreach ($users->results as $u) {
	          $optns[] = array(
	              '#value' => $u->ID,
	              '#title' => $u->display_name.' ('.$u->user_email.')'
	          );
	      } 

	      return $optns;
	  }

	  function getProjects($optns){
	      $optns = array();
	      $args = array( 'post_type' => 'lesson-project', 'posts_per_page' => -1 );
		  
		  global $post;
	      $this->setup_admin_postdata($post);
	      $loop = new WP_Query( $args );
	      while ( $loop->have_posts() ) { $loop->the_post();
	          $id = get_the_ID();
	          $title = get_the_title();
	          $optns[] = array(
	              '#value' => $id,
	              '#title' => $title
	          );
	      }
	      wp_reset_postdata();
	      $this->wp_reset_admin_postdata();

	      return $optns;
	  }

	function populate_project_fields($form){

		//Cut the execution of the function
		if($form['title']!=self::FORM_ASSIGNMENT_TITLE) return $form;

		foreach ( $form['fields'] as $field )
		{
			if ( $field->type == 'select' and strpos( $field->cssClass,'student-cohorts' )!==false ) {
			   	$terms = get_terms('user_cohort');
			   	$choices = array();
				foreach($terms as $term) if($term->parent!=0) $choices[] = array( 'text' => $term->name, 'value' => $term->term_id );
			   	$field->choices = $choices;
			   	$field->placeholder = 'Select a cohort';
			}
			if ( $field->type == 'select' and strpos( $field->cssClass,'student-projects' )!==false ) {
				$args = array( 'post_type' => 'lesson-project', 'posts_per_page' => -1 );
			   	$choices = array();
				global $post;
				$this->setup_admin_postdata($post);
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) { $loop->the_post();
					$id = get_the_ID();
					$title = get_the_title();
					$choices[] = array( 'text' => $title, 'value' => $id );
				}
				wp_reset_postdata();
				$this->wp_reset_admin_postdata();
			   	$field->choices = $choices;
			   	$field->placeholder = 'Select a project';
			}
		}
		return $form;
	}

	/**
	 * Gets called right after ANY gravity form gets submited by the user
	 */
	function set_post_content( $entry, $form ) {

	    if($form['title']==self::FORM_ASSIGNMENT_TITLE)
	    {
		    $this->createNewClassAssignment($entry, $form);
	    }
	    else if($form['title']==self::FORM_DELIVER_ASSIGNMENT_TITLE)
	    {
		    $this->createDeliverAssignmentFromStudent($entry, $form);
	    }
	}

	function setup_admin_postdata( $post_to_setup ) {
	 
		//only on the admin side
		if( is_admin() ) {
	 
			//get the post for both setup_postdata() and to be cached
			global $post;
	 
			//only cache $post the first time through the loop
			if ( ! isset( $GLOBALS['post_cache'] ) ) {
				$GLOBALS['post_cache'] = $post;
			}
	 
			//setup the post data as usual
			$post = $post_to_setup;
			setup_postdata( $post );
		}
	}

	/**
	 * Reset $post back to the original item
	 *
	 */
	function wp_reset_admin_postdata() {
	 
		//only on the admin and if post_cache is set
		if( is_admin() && !empty( $GLOBALS[ 'post_cache' ] ) ) {
	 
			//globalize post as usual
			global $post;
	 
			//set $post back to the cached version and set it up
			$post = $GLOBALS[ 'post_cache' ];
			setup_postdata( $post );
	 
			//cleanup
			unset( $GLOBALS[ 'post_cache' ] );
		}
	}

	function slug_save_post_callback( $post_ID, $post, $update ) {
	    // allow 'publish', 'draft', 'future'
	    if ($post->post_status == 'auto-draft')
	        return;

	    // only change slug when the post is created (both dates are equal)
	    if ($post->post_date_gmt != $post->post_modified_gmt)
	        return;

	    // unhook this function to prevent infinite looping
	    remove_action( 'save_post_'.self::POST_TYPE, array($this,'slug_save_post_callback'), 10, 3 );
	    // update the post slug (WP handles unique post slug)
	    wp_update_post( array(
	        'ID' => $post_ID,
	        'post_name' => 'SA'.$post_ID,
	        'post_title' => 'Student Assigment '.$post_ID
	    ));
	    // re-hook this function
	    add_action( 'save_post_'.self::POST_TYPE, array($this,'slug_save_post_callback'), 10, 3 );
	}

	function notifyNewProjectToUser($user,$project)
	{
		$userNickname = '';
		if($user->first_name and $user->first_name!='') $userNickname = $user->first_name;
		else if($user->display_name and $user->display_name!='') $userNickname = $user->display_name;
		
		$tdTitleStyles = 'style="padding: 5px; background: #f1f1f1; color: #bc7a16;"';
		$tdStyles = 'padding: 5px;';
		$buttonStyle = 'style="padding: 10px 15px; background: #bc7a16; color: #FFF; margin-top: 10px; text-decoration: none;"';
		
		$subject = 'New Project Assigned: '.$project['title'];
		$content = 'Hi '.$userNickname.',';
		$content .= '<p>Your teacher has assigned you a new project: <strong>'.$project['title'].'</strong></p>';
		$content .= '<table style="width: 100%;">';
			$content .= '<tr>';
				$content .= '<td '.$tdTitleStyles.' valign="top">Project Description</td>';
				$content .= '<td style="'.$tdStyles.'" valign="top">'.$project['excerpt'].'</td>';
			$content .= '</tr>';
			$content .= '<tr>';
				$content .= '<td '.$tdTitleStyles.' valign="top">Estimated Duration</td>';
				$content .= '<td style="'.$tdStyles.'" valign="top">'.$project['duration'].' hrs</td>';
			$content .= '</tr>';
			$content .= '<tr>';
				$content .= '<td '.$tdTitleStyles.' valign="top">Due Date</td>';
				$content .= '<td style="'.$tdStyles.'" valign="top">'.$project['duedate'].'</td>';
			$content .= '</tr>';
			$content .= '<tr>';
				$content .= '<td style="padding-top: 20px;" align="center" colspan="2"><a '.$buttonStyle.' href="'.get_site_url().'?student-assignment='.$project['assignment'].'">Click here for more details</a></td>';
			$content .= '</tr>';
		$content .= '</table>';

		add_filter( 'wp_mail_content_type', array($this,'set_html_content_type' ));
		$status = wp_mail($user->user_email, $subject, $content);
		remove_filter( 'wp_mail_content_type', array($this,'set_html_content_type' ));
	}
	function set_html_content_type() {return 'text/html';}
	
	private function createDeliverAssignmentFromStudent($entry, $form)
	{
		$curerntUser = get_current_user_id();
		$assignmentId = rgar( $entry, '2' );
		$assignment = update_post_meta($assignmentId, 'wpcf-assignment-status', 'done');
	}

	private function createNewClassAssignment($entry, $form)
	{
		//getting post
		$post = get_post( $entry['post_id'] );

		$projectId = rgar( $entry, '1' );
		$cohort = rgar( $entry, '2' );
		$duedate = rgar( $entry, '3' );

		$users = get_objects_in_term( $cohort, 'user_cohort' );
		foreach( $users as $u ) {
		    $options = array(
		        'post_status' => 'publish',
		        'post_type' => 'student-assignment',
		        'meta_input' => array(
		        	'wpcf-assignment-due-date' => strtotime($duedate),
		        	'wpcf-project-assigned' => $projectId,
		        	'wpcf-assignment-status' => 'pending',
		        	'wpcf-student-assigned' => $u
		        	)
		    );

		    $assignmentId = wp_insert_post($options);
		    if($assignmentId===false) throw new Exception("Error creating assignment", 1);

			$projectObj = array(
				"title" => get_the_title($projectId),
				"assignment" => 'SA'.$assignmentId,
				"duedate" => date('jS \of F', strtotime($duedate)),
				"duration" => get_post_meta( $projectId, 'wpcf-project-hour-duration',true),
				"excerpt" => get_post_meta( $projectId, 'wpcf-project-excerpt',true)
				);
			$this->notifyNewProjectToUser(get_user_by('id',$u),$projectObj);
		}
	}

}
