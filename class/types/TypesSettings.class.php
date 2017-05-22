<?php

require('types.autoload.php');

class WPTypesSettings {

  function __construct() {
    $projectAssignment = new WPTypes\WPProjectAssignment();
    $user = new WPTypes\WPUser();
    $course = new WPTypes\WPCourse();
    $cohort = new WPTypes\WPCohort();
  }


}