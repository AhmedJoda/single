<?php

namespace Syscape\Single;

use Livewire\Livewire;
use Syscape\Single\Console\CreateSingleModel;
use Syscape\Single\Livewire\SingleTable;
use Syscape\Single\View\Components\Modal;
use Illuminate\Support\ServiceProvider;

class SingleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
         $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'single');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'single');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
//        if (!is_dir('app/Singles')) {
//            mkdir("app/Singles", 0700);
//        }

        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'single');
        $this->loadViewComponentsAs(__DIR__.'/../resources/views',[
            Modal::class,
        ]);
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('single.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/single'),
            ], 'views');

            // Publishing assets.
            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/single'),
            ], 'assets');

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/single'),
            ], 'lang');*/

            // Registering package commands.
             $this->commands([
                 CreateSingleModel::class,
             ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'single');

        // Register the main class to use with the facade
        $this->app->singleton('single', function () {
            return new Single;
        });
    }
}
