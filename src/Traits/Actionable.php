<?php

namespace Binafy\LaravelUserMonitoring\Traits;

use Binafy\LaravelUserMonitoring\Contracts\MonitoringCondition;
use Binafy\LaravelUserMonitoring\Utills\ActionType;
use Binafy\LaravelUserMonitoring\Utills\Detector;
use Binafy\LaravelUserMonitoring\Utills\UserUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait Actionable
{
    /**
     * The "boot" method of the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        if (!config('user-monitoring.action_monitoring.guest_mode', true) && is_null(UserUtils::getUserId())) {
            return;
        }

        // Custom conditions from config
        if (! static::shouldMonitor(request())) {
            return;
        }

        if (config('user-monitoring.action_monitoring.on_store', false)) {
            static::created(function (mixed $model) {
                static::insertActionMonitoring($model, ActionType::ACTION_STORE);
            });
        }

        if (config('user-monitoring.action_monitoring.on_update', false)) {
            static::updated(function (mixed $model) {
                static::insertActionMonitoring($model, ActionType::ACTION_UPDATE);
            });
        }

        if (config('user-monitoring.action_monitoring.on_destroy', false)) {
            static::deleted(function (mixed $model) {
                static::insertActionMonitoring($model, ActionType::ACTION_DELETE);
            });
        }

        if (config('user-monitoring.action_monitoring.on_read', false)) {
            static::retrieved(function (mixed $model) {
                static::insertActionMonitoring($model, ActionType::ACTION_READ);
            });
        }

        if (config('user-monitoring.action_monitoring.on_replicate', false)) {
            static::replicating(function (mixed $model) {
                static::insertActionMonitoring($model, ActionType::ACTION_REPLICATE);
            });
        }

        if (config('user-monitoring.action_monitoring.on_restore', false)) {
            static::restored(function (mixed $model) {
                static::insertActionMonitoring($model, ActionType::ACTION_RESTORED);
            });
        }
        /*
         * Events:
         * trashed
         * replicating
         * restored
         */
    }

    /**
     * Insert action monitoring into DB.
     */
    private static function insertActionMonitoring(mixed $model, string $actionType): void
    {
        $detector = new Detector;

        DB::table(config('user-monitoring.action_monitoring.table'))->insert([
            'user_id' => UserUtils::getUserId(),
            'action_type' => $actionType,
            'table_name' => $model->getTable(),
            'browser_name' => $detector->getBrowser(),
            'platform' => $detector->getDevice(),
            'device' => $detector->getDevice(),
            'ip' => self::getRealIP(),
            'user_guard' => UserUtils::getCurrentGuardName(),
            'page' => request()->url(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Get real ip.
     */
    private static function getRealIP(): string
    {
        return config('user-monitoring.use_reverse_proxy_ip')
                ? request()->header(config('user-monitoring.real_ip_header'))
                : request()->ip();
    }

    /**
     * Determine if monitoring should be performed for the given request and user.
     */
    protected static function shouldMonitor(Request $request): bool
    {
        $config = config('user-monitoring.action_monitoring.conditions', []);

        foreach ($config as $condition) {
            if (is_callable($condition)) {
                if (! $condition($request)) {
                    return false;
                }
            } elseif (is_string($condition)) {
                $instance = new $condition;
                if (! $instance instanceof MonitoringCondition) {
                    continue;
                }
                if (! $instance->shouldMonitor($request)) {
                    return false;
                }
            }
        }

        return true;
    }
}
