<?php



if(!defined('ABSPATH')) define('ABSPATH', dirname(__FILE__) . '/');
if(!defined('LANGUAGES_PATH')) define('LANGUAGES_PATH',ABSPATH.'wp-content/themes/thedocs-child/src/languages/');
if(!defined('VIEWS_PATH')) define('VIEWS_PATH','src/php/view/');

require ABSPATH . 'vendor/autoload.php';


use BreatheCode\Controller;
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
        'namespace' => 'BreatheCode\\Controller\\'
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
    $controller->route([ 'slug' => 'Profile', 'controller' => 'User']);
    
    /**
     * Binding Ajax methos with views and controllers
     * @param view
     * @param controller
     * @param method
     */
    $controller->routeAjax([ 'slug' => 'bclogin', 'controller' => 'Credentials:custom_login', 'scope' => 'public']);     
    $controller->routeAjax([ 'slug' => 'My-Assignments', 'controller' => 'Assignments:deliver_project']);    
    $controller->routeAjax([ 'slug' => 'Review-Assignments', 'controller' => 'Assignments:create_new_assignment']);    
    $controller->routeAjax([ 'slug' => 'Category:User_Cohort', 'controller' => 'Teacher:check_attendancy']);     
    $controller->routeAjax([ 'slug' => 'Category:User_Cohort', 'controller' => 'Teacher:update_replits']);     
    $controller->routeAjax([ 'slug' => 'mytalents', 'controller' => 'TalentTree:get_badge']);    
    $controller->routeAjax([ 'slug' => 'profile', 'controller' => 'User:update_profile']);    
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
	WPASAdminNotifier::addTransientMessage(Utils\BCNotification::ERROR,$e->getMessage());
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
 * Load the notifications
 **/
if(class_exists('WPAS\Messaging\WPASAdminNotifier')) WPASAdminNotifier::loadTransientMessages();