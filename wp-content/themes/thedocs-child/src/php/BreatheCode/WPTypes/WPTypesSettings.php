<?php

namespace BreatheCode\WPTypes;

use WPAS\Messaging\WPASAdminNotifier;

class WPTypesSettings {

  function __construct() {

    if(!is_plugin_active('types/wpcf.php')) throw new \Exception('The plugin WP_Types is required, please install it. https://wp-types.com/');
    
    try{
      $projectAssignment = new PostType\WPProjectAssignment();
      $user = new PostType\WPUser();
      $course = new PostType\WPCourse();
      $cohort = new PostType\WPCohort();
      $lessonAsset = new PostType\WPLessonAsset();
      $lesson = new PostType\WPLesson();
      $lessonProject = new PostType\WPLessonProject();
    }
    catch(\Exception $e)
		{
			WPASAdminNotifier::addTransientMessage(WPASAdminNotifier::ERROR,$e->getMessage());
		}
  }


}