<?php
//Define autoloader 
spl_autoload_register('autoloadBCControllers');

function autoloadBCControllers($controller)
{
    $ce = explode('\\', $controller);
    $className = end($ce);
    if (in_array('Controller',$ce)) require($className.'.controller.php');
}