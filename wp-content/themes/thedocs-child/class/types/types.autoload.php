<?php
//Define autoloader 
spl_autoload_register('autoloadWPTypes');

function autoloadWPTypes($controller)
{
    $ce = explode('\\', $controller);
    $className = end($ce);
    if (in_array('WPTypes',$ce)) require($className.'.postfield.php');
}