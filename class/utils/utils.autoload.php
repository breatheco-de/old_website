<?php
//Define autoloader 
spl_autoload_register('autoloadUtils');

function autoloadUtils($controller)
{
    $ce = explode('\\', $controller);
    $className = end($ce);
    if (in_array('Utils',$ce)) require($className.'.component.php');
}