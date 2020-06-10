<?php

namespace Datakrama\Lapiuth;

use Datakrama\Lapiuth\Commands\LapiuthInstall;
use Illuminate\Support\ServiceProvider as DefaultServiceProvider;

class ServiceProvider extends DefaultServiceProvider
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
        $this->app->register(RouteServiceProvider::class);

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