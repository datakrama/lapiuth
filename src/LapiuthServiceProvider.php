<?php

namespace Datakrama\Lapiuth;

use Datakrama\Lapiuth\Commands\LapiuthInstall;
use Illuminate\Support\ServiceProvider;

class LapiuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                LapiuthInstall::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/config/frontend.php' => config_path('frontend.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/Controllers' => app_path('Http/Controllers'),
        ], 'controllers');

        $this->loadViewsFrom(__DIR__.'/views', 'lapiuth');

        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
    }
}