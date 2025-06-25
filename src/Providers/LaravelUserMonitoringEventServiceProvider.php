<?php

namespace Binafy\LaravelUserMonitoring\Providers;

use Binafy\LaravelUserMonitoring\Utills\Detector;
use Binafy\LaravelUserMonitoring\Utills\UserUtils;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class LaravelUserMonitoringEventServiceProvider extends EventServiceProvider
{
    public function boot(): void
    {
        $detector = new Detector;
        $table = config('user-monitoring.authentication_monitoring.table');

        // Login Event
        if (config('user-monitoring.authentication_monitoring.on_login', false)) {
            Event::listen(function (Login $event) use ($detector, $table) {
                DB::table($table)
                    ->insert(
                        $this->insertData($detector, 'login'),
                    );
            });
        }

        // Logout Event
        if (config('user-monitoring.authentication_monitoring.on_logout', false)) {
            Event::listen(function (Logout $event) use ($detector, $table) {
                DB::table($table)
                    ->insert(
                        $this->insertData($detector, 'logout'),
                    );
            });
        }
    }

    /**
     * Get insert data.
     */
    private function insertData(Detector $detector, string $actionType): array
    {
        return [
            'user_id' => UserUtils::getUserId(),
            'action_type' => $actionType,
            'browser_name' => $detector->getBrowser(),
            'platform' => $detector->getDevice(),
            'device' => $detector->getDevice(),
            'ip' => request()->ip(),
            'user_guard' => UserUtils::getCurrentGuardName(),
            'page' => request()->url(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
