<?php
function classAutoLoaders($class)
{
    $class = strtolower($class);
    $thepath = "includes/{$class}.php";
    if (is_file($thepath) && !class_exists($class)) {
        include $thepath;
    } else {
        die("this file name {$class}.php was not found ");
    }
}
spl_autoload_register('classAutoLoaders');

function redirect($location)
{
return header("Location:".$location);

}
?>
