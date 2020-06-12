<?php

namespace Datakrama\Lapiuth\Test;

use Artisan;
use Config;
use Datakrama\Lapiuth\ServiceProvider;
use Laravel\Passport\Passport;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadLaravelMigrations();
        $this->artisan('migrate')->run();
        $this->withFactories(__DIR__.'/database/factories');
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('auth.guards.api.driver', 'passport');
    }

    /**
     * Define package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }

    /** @test */
    public function it_loads_config_facade()
    {
        $this->assertEquals('passport', \Config::get('auth.guards.api.driver'));
    }
}