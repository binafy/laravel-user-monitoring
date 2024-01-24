<?php

namespace Binafy\LaravelUserMonitoring\Providers;

use Binafy\LaravelUserMonitoring\Utills\Detector;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Jenssegers\Agent\Agent;

class LaravelUserMonitoringEventServiceProvider extends EventServiceProvider
{
    public function boot()
    {
        $agent = new Agent();
        $guard = config('user-monitoring.user.guard');
        $table = config('user-monitoring.authentication_monitoring.table');

        // Login Event
        if (config('user-monitoring.authentication_monitoring.on_login', false)) {
            Event::listen(function (Login $event) use ($agent, $guard, $table) {
                DB::table($table)
                    ->insert(
                        $this->insertData($guard, $agent, 'login'),
                    );
            });
        }

        // Logout Event
        if (config('user-monitoring.authentication_monitoring.on_logout', false)) {
            Event::listen(function (Logout $event) use ($agent, $guard, $table) {
                DB::table($table)
                    ->insert(
                        $this->insertData($guard, $agent, 'logout'),
                    );
            });
        }
    }

    /**
     * Get insert data.
     */
    private function insertData(string $guard, Detector $detector, string $actionType): array
    {
        return [
            'user_id' => auth($guard)->id(),
            'action_type' => $actionType,
            'browser_name' => $detector->getBrowser(),
            'platform' => $detector->getBrowser(),
            'device' => $detector->getDevice(),
            'ip' => request()->ip(),
            'page' => request()->url(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
