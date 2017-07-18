<?php
//Define autoloader 
spl_autoload_register('autoloadVCComponent');

function autoloadVCComponent($controller)
{
    $ce = explode('\\', $controller);
    $className = end($ce);
    if (in_array('VCComponent',$ce)) require($className.'.component.php');
}