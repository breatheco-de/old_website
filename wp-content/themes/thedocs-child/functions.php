<?php

if(!defined('ABSPATH')) define('ABSPATH', dirname(__FILE__) . '/');
if(!defined('VIEWS_PATH')) define('VIEWS_PATH','src/php/view/');

require ABSPATH . 'vendor/autoload.php';


use BreatheCode\Controller;
use BreatheCode\WPLanguages;
use WPAS\Controller\WPASController;
use WPAS\Messaging\WPASAdminNotifier;

/**
 * Simple routs for binding controller phpes with Views and AJAX
 * Binding render methods with views and controllers
  * @param view of the page the page that is going to do the ajax request
  * @param controller fot the controller file (for example User will be the value for User.controller.php)
  * @param aajax_action of the ajax action parameter (you have to pass this like a post parameter in the ajax request)
  */
if(class_exists('WPAS\Controller\WPASController')){
    $controller = new WPASController([
        'namespace' => 'BreatheCode\\Controller\\',
        'data' => [ 'host' => BREATHECODE_API_HOST ]
    ]);
    $controller->route([ 'slug' => 'Project', 'controller' => 'ProjectController']);
    
    $controller->route([ 'slug' => 'MyTalents', 'controller' => 'TalentTreeController']);
    
    $controller->route([ 'slug' => 'My-Assignments', 'controller' => 'AssignmentsController']);
    $controller->route([ 'slug' => 'Lesson-Project', 'controller' => 'AssignmentsController']);
    $controller->route([ 'slug' => 'Review-Assignments', 'controller' => 'AssignmentsController']);
    
    $controller->route([ 'slug' => 'Category:Course', 'controller' => 'LessonController']);
    $controller->route([ 'slug' => 'lesson', 'controller' => 'LessonController']);
    $controller->route([ 'slug' => 'Lesson-Project', 'controller' => 'LessonController']);
    
    $controller->route([ 'slug' => 'My-Courses', 'controller' => 'LessonController']);
    $controller->route([ 'slug' => 'Mis-Cursos', 'controller' => 'LessonController:renderMyCourses']);
    
    $controller->route([ 'slug' => 'Category:Asset-Technology', 'controller' => 'AssetsController']);
    $controller->route([ 'slug' => 'Category:Asset-Type', 'controller' => 'AssetsController']);
    $controller->route([ 'slug' => 'Lesson-Asset', 'controller' => 'AssetsController']);
    $controller->route([ 'slug' => 'Assets', 'controller' => 'AssetsController']);
    
    $controller->route([ 'slug' => 'Category:User_Cohort', 'controller' => 'UserController']);
    $controller->route([ 'slug' => 'Teacher-Cohorts', 'controller' => 'UserController']);
    $controller->route([ 'slug' => 'Profile', 'controller' => 'UserController']);
    $controller->route([ 'slug' => 'Student-Profile', 'controller' => 'UserController']);
    $controller->route([ 'slug' => 'Student', 'controller' => 'UserController']);
    $controller->route([ 'slug' => 'Search:search', 'controller' => 'SearchController']);
    
    $controller->route([ 'slug' => 'Quiz', 'controller' => 'QuizController']);
    
    $controller->route([ 'slug' => 'bulk-badges', 'controller' => 'TeacherController:renderBulkBadges']);
    
    /**
     * Binding Ajax methos with views and controllers
     * @param view
     * @param controller
     * @param method
     */
    $controller->routeAjax([ 'slug' => 'bclogin', 'controller' => 'CredentialsController:custom_login', 'scope' => 'public']);     
    $controller->routeAjax([ 'slug' => 'My-Assignments', 'controller' => 'AssignmentsController:deliver_project']);    
    $controller->routeAjax([ 'slug' => 'Review-Assignments', 'controller' => 'AssignmentsController:create_new_assignment']);    
    $controller->routeAjax([ 'slug' => 'Review-Assignments', 'controller' => 'AssignmentsController:get_assignment_earnings']);    
    $controller->routeAjax([ 'slug' => 'Review-Assignments', 'controller' => 'AssignmentsController:accept_assignment']);    
    $controller->routeAjax([ 'slug' => 'Review-Assignments', 'controller' => 'AssignmentsController:reject_assignment']);    
    $controller->routeAjax([ 'slug' => 'Category:User_Cohort', 'controller' => 'TeacherController:check_attendancy']);     
    $controller->routeAjax([ 'slug' => 'Category:User_Cohort', 'controller' => 'TeacherController:update_replits']);     
    $controller->routeAjax([ 'slug' => 'profile', 'controller' => 'TalentTreeController:get_badge']);    
    $controller->routeAjax([ 'slug' => 'profile', 'controller' => 'UserController:update_profile']);    
    $controller->routeAjax([ 'slug' => 'profile', 'controller' => 'UserController:update_settings']);    
    $controller->routeAjax([ 'slug' => 'assets', 'controller' => 'AssetsController:whatever']); 
    $controller->routeAjax([ 'slug' => 'Search:search', 'controller' => 'SearchController:whatever' ]);
    $controller->routeAjax([ 'slug' => 'Quiz', 'controller' => 'QuizController:save_attempt' ]);
    $controller->routeAjax([ 'slug' => 'Lesson', 'controller' => 'LessonController:whatever' ]);
    $controller->routeAjax([ 'slug' => 'Student-Profile', 'controller' => 'UserController:enable_quiz' ]);
    $controller->routeAjax([ 'slug' => 'Student-Profile', 'controller' => 'UserController:get_all_badges' ]);
    $controller->routeAjax([ 'slug' => 'Student-Profile', 'controller' => 'UserController:give_points' ]);
    
    $controller->routeAjax([ 'slug' => 'Category:User_Cohort', 'controller' => 'UserController:save_slack_url']);   
    $controller->routeAjax([ 'slug' => 'Project', 'controller' => 'ProjectController:whatever']);   
    
    $controller->routeAjax([ 'slug' => 'projects', 'controller' => 'ProjectController:get_projects']);   
    
    $controller->routeAjax([ 'slug' => 'bulk-badges', 'controller' => 'TeacherController:add_bulk_badges']);   
}

try{
    /**
     * This class takes care of all the theme setup
     * */
    $GeeksAcademyOnline = new BreatheCode\GeeksAcademyOnline();
    /**
     * Everything related to the visual composer settings and components.
     * */
    $VisualComposerSettings = new BreatheCode\VCComposer\VisualComposerSettings();
    /**
     * Everything related to te gravityforms integration
     * */
    $GravityFormOptions = new BreatheCode\GravityForms\GravityFormSettings();
    /**
     * The custom post types like (Lesson, Lesson Assets, Course, Assignment, etc.).
     * */
    $TypesSettings = new BreatheCode\WPTypes\WPTypesSettings();
}
catch(\Exception $e)
{
	WPASAdminNotifier::addTransientMessage(WPASAdminNotifier::ERROR,$e->getMessage());
}

/**
 * This theme is multilangual and this class handles most of the logic by integrating with
 * the PolilangPlugin.
 * */
$WPLanguages = new BreatheCode\WPLanguages();

/**
 * This class takes care of the adminisitation interface under appereache->theme_options
 **/
$BCThemeOptions = new BreatheCode\BCThemeOptions();

/**
 * To create new API calls, you have to instanciate the API controller and start adding endpoints
*/
$api = new \WPAS\Controller\WPASAPIController([ 
    'version' => '1', 
    'application_name' => 'bc', 
    'namespace' => 'BreatheCode\\Controller\\' 
]);
$api->get([ 'path' => '/lesson', 'controller' => 'APIController:getLessons' ]); 

    
/**
 * Load the notifications
 **/
if(class_exists('WPAS\Messaging\WPASAdminNotifier')) WPASAdminNotifier::loadTransientMessages();