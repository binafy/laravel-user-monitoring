<?php

namespace Binafy\LaravelUserMonitoring;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaravelUserMonitoringServiceProvider extends ServiceProvider
{
    /**
     * Register files.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'LaravelUserMonitoring');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/../config/user-monitoring.php', 'user-monitoring');

        Route::middleware('web')->group(__DIR__ . '/../routes/web.php');

        // TODO: Add publish
    }

    /**
     * Boot provider.
     *
     * @return void
     */
    public function boot()
    {

    }
}