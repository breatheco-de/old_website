<?php

include('class/utils/utils.autoload.php');
\Utils\BCError::loadTransientErrors();

/**
 * TODO: An attempt to have a single sessions in between several websites (wordpress or not)
 * */
//include('class/WPSessionManagment.class.php');
//$WPSessionManagment = new WPSessionManagment();

include('class/GeeksAcademyOnline.class.php');
include('class/vc_composer/VisualComposerSettings.class.php');
include('class/gravity_forms/GravityFormSettings.class.php');
include('class/types/TypesSettings.class.php');
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
	Utils\BCError::notifyError($e->getMessage());
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

