<?php
//Define autoloader 
spl_autoload_register('breathecodeControllerAutoload');

function breathecodeControllerAutoload($controller)
{
    $ce = explode('\\', $controller);
    $className = end($ce);
    if (in_array('Controller',$ce)) require($className.'.controller.php');
}