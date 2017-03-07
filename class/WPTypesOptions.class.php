<?php

include('WPProjectAssignment.postfield.php');
include('WPUser.postfield.php');

class WPTypesOptions {

  function __construct() {
    $projectAssignment = new WPProjectAssignment();
    $user = new WPUser();
  }


}