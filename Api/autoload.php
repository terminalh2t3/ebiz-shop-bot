<?php
/**
 * Created by PhpStorm.
 * User: vu
 * Date: 11/26/16
 * Time: 9:39 PM
 */

function my_autoloader($class)
{
    $filename = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    include($filename);
}
spl_autoload_register('my_autoloader');