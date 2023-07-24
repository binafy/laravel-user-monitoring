<?php

namespace Binafy\LaravelUserMonitoring\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Support\Facades\Event;

class LaravelUserMonitoringEventServiceProvider extends EventServiceProvider
{
    public function boot()
    {
        // Login Event
        Event::listen(function (Login $event) {

        });

        // Logout Event
        Event::listen(function (Logout $event) {

        });
    }
}