<?php

require('types.autoload.php');

class WPTypesSettings {

  function __construct() {

    if(!is_plugin_active('types/wpcf.php')) throw new \Exception('The plugin WP_Types is required, please install it. https://wp-types.com/');
    
    try{
      $projectAssignment = new WPTypes\WPProjectAssignment();
      $user = new WPTypes\WPUser();
      $course = new WPTypes\WPCourse();
      $cohort = new WPTypes\WPCohort();
      $cohort = new WPTypes\WPLesson();
    }
    catch(\Exception $e)
		{
			Utils\BCError::notifyError($e->getMessage());
		}
  }


}