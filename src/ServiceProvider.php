<?php

namespace Datakrama\Lapiuth;

use Datakrama\Lapiuth\Commands\LapiuthInstall;
use Illuminate\Support\Facades\Route;
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
        $this->publishes([
            __DIR__.'/config/frontend.php' => config_path('frontend.php'),
        ], 'config');

        $this->loadViewsFrom(__DIR__.'/views', 'lapiuth');
        
        $this->mapApiRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace('Datakrama\Lapiuth\Controllers')
             ->group(function () {
                $this->loadRoutesFrom(__DIR__.'/routes/api.php');
             });
    }
}