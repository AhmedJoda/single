<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use PHPUnit\TextUI\XmlConfiguration\Group;

if (! is_dir(base_path('app/Singles'))){
    mkdir(base_path('app/Singles'));
}

checkInside(base_path('app/Singles'));



function checkInside($directory, $parent = null)
{
    foreach (getInside($directory) as $fileName) {
        $file  = strpos($fileName, '.php');
        if ($file) {
            addRoutes($fileName, $parent);
        } else {
            checkInside("$directory/$fileName", $fileName);
        }
    }
}

function getInside($directory)
{

    return  array_diff(scandir($directory), array('.', '..'));
}
function addRoutes($fileName, $parent = null)
{

    $single = remove_php_extension($fileName);
    if ($parent) {
        $class =  "\\App\\Singles\\$parent\\$single";
    } else {
        $class =  "\\App\\Singles\\$single";
    }
    if ($class::$autoPublishRoute)
        $class::routes();
}

function remove_php_extension($fileName)
{
    return str_replace(".php", "", $fileName);
}
