<?php

use Binafy\LaravelUserMonitoring\Controllers\VisitMonitoringController;
use Binafy\LaravelUserMonitoring\Controllers\ActionMonitoringController;
use Illuminate\Support\Facades\Route;

Route::prefix('user-monitoring')->as('user-monitoring.')->group(function ($router) {
    // Visit Monitoring Routes
    $router->get('visits-monitoring', [VisitMonitoringController::class, 'index'])->name('visits-monitoring');
    $router->delete('visits-monitoring/{visitMonitoring}', [VisitMonitoringController::class, 'destroy'])->name('visits-monitoring-delete');

    // Action Monitoring Routes
    $router->get('actions-monitoring', [ActionMonitoringController::class, 'index'])->name('actions-monitoring');
    $router->delete('actions-monitoring/{visitMonitoring}', [ActionMonitoringController::class, 'destroy'])->name('actions-monitoring-delete');
});
