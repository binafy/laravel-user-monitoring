<?php

namespace Binafy\LaravelUserMonitoring\Providers;

use Binafy\LaravelUserMonitoring\Middlewares\VisitMonitoringMiddleware;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class LaravelUserMonitoringRouteServiceProvider extends RouteServiceProvider
{
    /**
     * Register files.
     *
     * @return void
     */
    public function register()
    {
        $path = base_path(
            config('user-monitoring.config.routes.file_path', 'routes/user-monitoring.php')
        );

        if (! file_exists($path)) {
            $path = __DIR__ . '/../../routes/web.php';
        }

        Route::middleware('web')
            ->middleware(VisitMonitoringMiddleware::class)
            ->group($path);
    }
}
