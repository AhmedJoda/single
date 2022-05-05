<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use PHPUnit\TextUI\XmlConfiguration\Group;

Route::namespace('App\Singles')->
group(function () {
    checkInside(base_path('app/Singles'));
});


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
    $route = Str::plural(Str::lower($single));

    if ($parent) {
        $lower = Str::lower($parent);
        Route::namespace("$parent")->prefix($lower)->as("$lower.")->
        group(function () use ($route, $single) {
            singleResources($route, $single);
        });
    } else {
        singleResources($route, $single);
    }
}

function remove_php_extension($fileName)
{
    return str_replace(".php", "", $fileName);
}

function singleResources($route, $single)
{
    Route::get($route, "$single"."@singleIndex")->name("$route.index");
    Route::get($route."/create", "$single"."@singleCreate")->name("$route.create");
    Route::post($route, "$single"."@singleStore")->name("$route.store");
    Route::get($route."{id}", "$single"."@singleShow")->name("$route.show");
    Route::get($route."{id}/edit", "$single"."@singleEdit")->name("$route.edit");
    Route::put($route."{id}", "$single"."@singleUpdate")->name("$route.update");
    Route::delete($route."{id}", "$single"."@singleDestroy")->name("$route.destroy");
}
