<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

checkInside('app/Singles');


function getInside($directory)
{
    return  array_diff(scandir($directory), array('.', '..'));
}


function remove_php_extension($fileName)
{
    return str_replace(".php", "", $fileName);
}


function addRoutes($fileName, $parent = null)
{
    $single = remove_php_extension($fileName);
    $route = Str::plural(Str::lower($single));

    if ($parent) {
        $lower = Str::lower($parent);
        Route::namespace($parent)->prefix($lower)->as("$lower.")->
        group(function () use ($route, $single) {
            singleResources($route, $single);
        });
    } else {
        singleResources($route, $single);
    }
}


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

function singleResources($route, $single)
{
    Route::get($route, $single."@singleIndex");
    Route::get($route."/create", $single."@singleCreate");
    Route::post($route, $single."@singleStore");
    Route::get($route."{id}", $single."@singleShow");
    Route::get($route."{id}/edit", $single."@singleEdit");
    Route::put($route."{id}", $single."@singleUpdate");
    Route::delete($route."{id}", $single."@singleDestroy");
}
