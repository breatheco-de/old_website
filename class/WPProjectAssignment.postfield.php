<?php

require_once('ActiveCampaignWrapper.php');
require_once('PHPUtils.class.php');

class WPProjectAssignment
{
	const POST_TYPE = 'student-assignment';
	  function __construct() {
	    add_filter( 'wpt_field_options', array($this,'fill_select'), 10, 3);
	    add_action( 'manage_'.self::POST_TYPE.'_posts_columns' , array($this,'projectPostsColumns'), 10, 2 );
	    add_action( 'manage_'.self::POST_TYPE.'_posts_custom_column' , array($this,'customProjectSolumn'), 10, 2 );
	    add_action( 'transition_post_status', array($this,'post_published_notification'), 10, 2 );
	    add_action( 'save_post_'.self::POST_TYPE, array($this,'slug_save_post_callback'), 10, 3 );
	  }

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
	            		"duration" => get_post_meta( $projectId, 'wpcf-project-hour-duration',true)
	            		);
					$this->notifyNewProjectToUser($user,$project);
	            }
		  	}
	  	}
	  }

	  function projectPostsColumns( $column ) {
	    //unset( $columns['author'] );
	    $columns['student'] = 'Student';
	    $columns['project'] = 'Project';
	    $columns['duedate'] = 'Due Date';
	    $columns['assignment-status'] = 'Status';
	    //die(print_r($columns));
	    return $columns;
	  }

	  function customProjectSolumn( $column, $postId ) {
	      switch ( $column ) {

	          case 'student' :
	              $studentId = get_post_meta( $postId, 'wpcf-student-assigned',true);
	              $user = get_user_by('id',$studentId);
	              if ($user) echo $user->display_name.' ('.$user->user_email.')';
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
	              if ( is_string( $duedate ) ) echo  date('l jS \of F Y h:i:s A', $duedate);
	              else echo 'Unable to get due date';
	            break;

	          case 'assignment-status' :
	              $status = get_post_meta( $postId, 'wpcf-assignment-status',true);
	              if ($status and is_string( $status ) ) echo $status;
	              else echo 'Unable to get the satus';
	            break;

	      }
	  }

	  function fill_select( $options, $title, $type ) {
	      switch($title)  
	      {
	        case "Student Assigned": $options = $this->getStudents($options); break;
	        case "Project Assigned": $options = $this->getProjects($options); break;
	      }

	      return $options;
	  }

	  function getStudents($optns){
	      $optns = array();
	      $users = get_users(array(
	        'role__in' =>  array(
	          'subscriber',
	          'premium_full_stack',
	          'prework_full_stack')
	        ) 
	      );
	       
	      foreach ($users as $u) {
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

	    $new_slug = 'SA'.$post_ID;
	    // unhook this function to prevent infinite looping
	    remove_action( 'save_post_'.self::POST_TYPE, array($this,'slug_save_post_callback'), 10, 3 );
	    // update the post slug (WP handles unique post slug)
	    wp_update_post( array(
	        'ID' => $post_ID,
	        'post_name' => $new_slug
	    ));
	    // re-hook this function
	    add_action( 'save_post_'.self::POST_TYPE, array($this,'slug_save_post_callback'), 10, 3 );
	}

	function notifyNewProjectToUser($user,$project)
	{
		$userNickname = '';
		if($user->first_name and $user->first_name!='') $userNickname = $user->first_name;
		else if($user->display_name and $user->display_name!='') $userNickname = $user->display_name;
		
		$subject = 'New Project Assigned';
		$content = 'Hi '.$userNickname.',';
		$content .= '<p>Your teacher has assign a new project:</p>';
		$content .= '<table>';
			$content .= '<tr>';
				$content .= '<td>Project Title</td>';
				$content .= '<td>'.$project['title'].'</td>';
			$content .= '</tr>';
			$content .= '<tr>';
				$content .= '<td>Project Duration</td>';
				$content .= '<td>'.$project['duration'].'</td>';
			$content .= '</tr>';
			$content .= '<tr>';
				$content .= '<td>Due Date</td>';
				$content .= '<td>'.$project['duedate'].'</td>';
			$content .= '</tr>';
			$content .= '<tr>';
				$content .= '<td colspan="2"><a href="http://online.4geeksacademy.com/?student-assignment='.$project['assignment'].'/">Click here for more details</a></td>';
			$content .= '</tr>';
		$content .= '</table>';

		add_filter( 'wp_mail_content_type', array($this,'set_html_content_type' ));
		$status = wp_mail($user->user_email, $subject, $content);
		remove_filter( 'wp_mail_content_type', array($this,'set_html_content_type' ));
	}
	function set_html_content_type() {return 'text/html';}

}
