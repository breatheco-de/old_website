<?php

include('class/utils/utils.autoload.php');

include('class/WPSessionManagment.class.php');
$WPSessionManagment = new WPSessionManagment();

include('class/GeeksAcademyOnline.class.php');
include('class/vc_composer/VisualComposerSettings.class.php');
include('class/gravity_forms/GravityFormSettings.class.php');
include('class/types/TypesSettings.class.php');
try{
    $GeeksAcademyOnline = new GeeksAcademyOnline();
    $VisualComposerSettings = new VisualComposerSettings();
    $GravityFormOptions = new GravityFormSettings();
    $TypesSettings = new WPTypesSettings();
}
catch(\Exception $e)
{
	Utils\BCError::notifyError($e->getMessage());
}

include('class/WPLanguages.class.php');
$WPLanguages = new WPLanguages();

$BCThemeOptions = new BCThemeOptions();

