<?php

namespace Binafy\LaravelUserMonitoring\Providers;

use Binafy\LaravelUserMonitoring\Commands\RemoveVisitMonitoringRecordsCommand;
use Binafy\LaravelUserMonitoring\Middlewares\MonitorVisitMiddleware;
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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/', 'LaravelUserMonitoring');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/../../config/user-monitoring.php', 'user-monitoring');
        $this->commands(RemoveVisitMonitoringRecordsCommand::class);

        $this->app['router']->aliasMiddleware('monitor-visit-middleware', MonitorVisitMiddleware::class);
        $this->app->register(LaravelUserMonitoringEventServiceProvider::class);

        Route::middleware('web')
            ->middleware(MonitorVisitMiddleware::class)
            ->group(__DIR__ . '/../../routes/web.php');
    }

    /**
     * Boot provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfig();
        $this->publishMigrations();
    }

    /**
     * Publish config files.
     *
     * @return void
     */
    private function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../../config/user-monitoring.php' => config_path('user-monitoring.php'),
        ], 'laravel-user-monitoring-config');
    }

    /**
     * Publish migration files.
     *
     * @return void
     */
    private function publishMigrations()
    {
        $this->publishes([
            __DIR__ . '/../../database/migrations' => database_path('migrations'),
        ], 'laravel-user-monitoring-migrations');
    }
}