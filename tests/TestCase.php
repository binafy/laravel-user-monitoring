<?php

namespace Tests;

use Binafy\LaravelUserMonitoring\LaravelUserMonitoringServiceProvider;
use Binafy\LaravelUserMonitoring\Middlewares\MonitorVisitMiddleware;
use Illuminate\Support\Facades\Route;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Load package service provider.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [LaravelUserMonitoringServiceProvider::class];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware([MonitorVisitMiddleware::class, 'web'])->group(__DIR__ . '/SetUp/Routes/web_tests.php');

        $this->loadMigrationsFrom(__DIR__.'/SetUp/Migrations');
    }
}
