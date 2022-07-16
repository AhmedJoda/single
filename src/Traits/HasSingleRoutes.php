<?php


namespace Syscape\Single\Traits;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

trait HasSingleRoutes
{
    public static $autoPublishRoute = true;
    public static function classRef(){
        return new \ReflectionClass(static::class);
    }
    public static function getSingleName(){
        return static::classRef()->name;
    }
    public static function getSinglePlural(){
        $name = static::classRef()->name;
        $word = last(explode('\\',$name));
        return Str::plural(Str::lower($word));
    }
    public static function getSingleParent(){
        $name = static::classRef()->name;
        $reflections = explode('\\',$name);
        if (count($reflections) == 4){
            return Str::lower($reflections[2]);
        }else{
            return null;
        }
    }
    public static function setMiddleware(){
        return config("single.middleware.".static::getSingleParent(),['web']) ;
    }
    public static function routes()
    {
        Route::middleware('web')->group(function (){
            if (static::getSingleParent()){
                Route::middleware(static::setMiddleware())
                    ->prefix(static::getSingleParent())
                    ->name(static::getSingleParent().'.')
                    ->as(static::getSingleParent().'.')
                    ->group(function (){
                        static::resourceRoutes();
                    });
            }else{
                Route::middleware(static::setMiddleware())
                    ->group(function (){
                        static::resourceRoutes();
                    });
            }
        });
        // TODO : api routes pattern
    }
    public static function  resourceRoutes(){
        $single = static::getSingleName();
        $route = static::getSinglePlural();
        Route::get($route, "$single"."@singleIndex")->name("$route.index");
        Route::get($route."/create", "$single"."@singleCreate")->name("$route.create");
        Route::post($route, "$single"."@singleStore")->name("$route.store");
        Route::get($route."{id}", "$single"."@singleShow")->name("$route.show");
        Route::get($route."{id}/edit", "$single"."@singleEdit")->name("$route.edit");
        Route::put($route."{id}", "$single"."@singleUpdate")->name("$route.update");
        Route::delete($route."{id}", "$single"."@singleDestroy")->name("$route.destroy");
    }
}
