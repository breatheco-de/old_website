<?php

include('class/utils/utils.autoload.php');

/**
 * Simple routs for binding controller classes with Views and AJAX
 **/
include('class/controller/BCController.class.php');
$c = new BCController();
/**
 * Binding render methods with views and controllers
 * @param view
 * @param controller
 */
$c->route('MyTalents','TalentTree');
$c->route('My-Assignments','Assignments');
$c->route('Lesson-Project','Assignments');

/**
 * Binding Ajax methos with views and controllers
 * @param view
 * @param controller
 * @param method
 */
$c->routeAjax('bclogin','Credentials','custom_login');     
$c->routeAjax('My-Assignments','Assignments','deliver_project');    
$c->loadAjax();


include('class/GeeksAcademyOnline.class.php');
include('class/vc_composer/VisualComposerSettings.class.php');
include('class/gravity_forms/GravityFormSettings.class.php');
include('class/types/TypesSettings.class.php');
try{
    /**
     * This class takes care of all the theme setup
     * */
    $GeeksAcademyOnline = new GeeksAcademyOnline($c);
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
	Utils\BCNotification::addTransientMessage(Utils\BCNotification::ERROR,$e->getMessage());
}

/**
 * This theme is multilangual and this class handles most of the logic by integrating with
 * the PolilangPlugin.
 * */
include('class/WPLanguages.class.php');
$WPLanguages = new WPLanguages();

/**
 * This class takes care of the adminisitation interface under appereache->theme_options
 **/
$BCThemeOptions = new BCThemeOptions();

\Utils\BCNotification::loadTransientMessages();