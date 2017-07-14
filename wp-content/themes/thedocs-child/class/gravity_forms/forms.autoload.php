<?php
//Define autoloader 
spl_autoload_register('autoloadGFForm');

function autoloadGFForm($controller)
{
    $ce = explode('\\', $controller);
    $className = end($ce);
    if (in_array('GFForm',$ce)) require($className.'.form.php');
}