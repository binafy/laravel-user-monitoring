<?php

namespace Tests;

use Binafy\LaravelUserMonitoring\Middlewares\MonitorVisitMiddleware;
use Binafy\LaravelUserMonitoring\Providers\LaravelUserMonitoringServiceProvider;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Route;
use Tests\SetUp\Models\User;

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
        // Set default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        // Set app key
        $app['config']->set('app.key', 'base64:'.base64_encode(
            Encrypter::generateKey(config()['app.cipher'])
        ));

        // Set views config
        $app['config']->set('view.paths', [__DIR__.'/SetUp/Resources/views']);

        // Set user model
        $app['config']->set('auth.providers.users.model', User::class);

        // Set user model for monitoring config
        $app['config']->set('user-monitoring.user.model', User::class);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware([MonitorVisitMiddleware::class, 'web'])->group(__DIR__ . '/SetUp/Routes/web_tests.php');

        $this->loadMigrationsFrom(__DIR__.'/SetUp/Migrations');
    }
}
