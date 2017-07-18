<?php

use BreatheCode\Controller;


if(!defined('ABSPATH')) define('ABSPATH', dirname(__FILE__) . '/');
if(!defined('LANGUAGES_PATH')) define('LANGUAGES_PATH',ABSPATH.'wp-content/themes/thedocs-child/src/languages/');
if(!defined('VIEWS_PATH')) define('VIEWS_PATH','src/php/view/');

use \WPAS\Controller\WPASController;
use \WPAS\Messaging\WPASAdminNotifier;
if(!function_exists( 'is_wpas_plugin_active' )) throw new Exception('You need to download and activate the WPAS plugin');

require ABSPATH."vendor/autoload.php";
include('src/php/utils/utils.autoload.php');
include('src/php/controller/controller.autoload.php');

    
/**
 * Simple routs for binding controller phpes with Views and AJAX
 * Binding render methods with views and controllers
  * @param view of the page the page that is going to do the ajax request
  * @param controller fot the controller file (for example User will be the value for User.controller.php)
  * @param aajax_action of the ajax action parameter (you have to pass this like a post parameter in the ajax request)
  */
$controller = new WPASController([
    'namespace' => 'BreatheCode\\Controller\\',
    'mainscript' => '/public/app.js',
    'data' => [
        'host' => 'https://talenttree-alesanchezr.c9users.io/'
        ]
]);
$controller->route([ 'slug' => 'MyTalents', 'controller' => 'TalentTree']);

$controller->route([ 'slug' => 'My-Assignments', 'controller' => 'Assignments']);
$controller->route([ 'slug' => 'Lesson-Project', 'controller' => 'Assignments']);
$controller->route([ 'slug' => 'Review-Assignments', 'controller' => 'Assignments']);

$controller->route([ 'slug' => 'Category:Course', 'controller' => 'Lessons']);
$controller->route([ 'slug' => 'lesson', 'controller' => 'Lessons']);
$controller->route([ 'slug' => 'Lesson-Project', 'controller' => 'Lessons']);
$controller->route([ 'slug' => 'My-Courses', 'controller' => 'Lessons']);

$controller->route([ 'slug' => 'Category:Asset-Technology', 'controller' => 'Assets']);
$controller->route([ 'slug' => 'Category:Asset-Type', 'controller' => 'Assets']);
$controller->route([ 'slug' => 'Lesson-Asset', 'controller' => 'Assets']);

$controller->route([ 'slug' => 'Category:User_Cohort', 'controller' => 'User']);
$controller->route([ 'slug' => 'Teacher-Cohorts', 'controller' => 'User']);

/**
 * Binding Ajax methos with views and controllers
 * @param view
 * @param controller
 * @param method
 */
$controller->routeAjax([ 'slug' => 'bclogin', 'controller' => 'Credentials', 'ajax_action' => 'Public:custom_login']);     
$controller->routeAjax([ 'slug' => 'My-Assignments', 'controller' => 'Assignments', 'ajax_action' => 'Private:deliver_project']);    
$controller->routeAjax([ 'slug' => 'Review-Assignments', 'controller' => 'Assignments', 'ajax_action' => 'Private:create_new_assignment']);    
$controller->loadAjax();

include('src/php/GeeksAcademyOnline.class.php');
include('src/php/vc_composer/VisualComposerSettings.class.php');
include('src/php/gravity_forms/GravityFormSettings.class.php');
include('src/php/types/TypesSettings.class.php');
try{
    /**
     * This class takes care of all the theme setup
     * */
    $GeeksAcademyOnline = new GeeksAcademyOnline();
    /**
     * Everything related to the visual composer settings and components.
     * */
    $VisualComposerSettings = new VisualComposerSettings();
    /**
     * Everything related to te gravityforms integration
     * */
    $GravityFormOptions = new GravityFormSettings();
    /**
     * The custom post types like (Lesson, Lesson Assets, Course, Assignment, etc.).
     * */
    $TypesSettings = new WPTypesSettings();
}
catch(\Exception $e)
{
	WPASAdminNotifier::addTransientMessage(Utils\BCNotification::ERROR,$e->getMessage());
}

/**
 * This theme is multilangual and this class handles most of the logic by integrating with
 * the PolilangPlugin.
 * */
include('src/php/WPLanguages.class.php');
$WPLanguages = new WPLanguages();

/**
 * This class takes care of the adminisitation interface under appereache->theme_options
 **/
$BCThemeOptions = new BCThemeOptions();
/**
 * Load the notifications
 **/
WPASAdminNotifier::loadTransientMessages();