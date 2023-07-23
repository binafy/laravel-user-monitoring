<?php

use Binafy\LaravelUserMonitoring\Controllers\VisitMonitoringController;
use Illuminate\Support\Facades\Route;

Route::prefix('user-monitoring')->as('user-monitoring.')->group(function ($router) {
    // Visit Monitoring Routes
    $router->get('visits-monitoring', [VisitMonitoringController::class, 'index'])->name('visit-monitoring');
});

