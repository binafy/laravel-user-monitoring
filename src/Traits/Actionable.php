<?php

namespace Binafy\LaravelUserMonitoring\Traits;

use Binafy\LaravelUserMonitoring\Utills\ActionType;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

trait Actionable
{
    /**
     * The "boot" method of the model.
     */
    protected static function boot(): void
    {
        parent::boot();

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

//        if (config('user-monitoring.action_monitoring.on_restore', false)) {
//            static::restored(function (mixed $model) {
//                static::insertActionMonitoring($model, ActionType::ACTION_RESTORED);
//            });
//        }TODO: Release next version

//        if (config('user-monitoring.action_monitoring.on_replicate', false)) {
//            static::restored(function (mixed $model) {
//                static::insertActionMonitoring($model, ActionType::ACTION_REPLICATE);
//            });
//        }TODO: Release next version
        /*
         * Events:
         * trashed
         * replicating
         * restored
         */
    }

    /**
     * Insert action monitoring into DB.
     *
     * @param  mixed $model
     * @param  string $actionType
     * @return void
     */
    private static function insertActionMonitoring(mixed $model, string $actionType): void
    {
        $agent = new Agent();
        $guard = config('user-monitoring.user.guard');

        DB::table(config('user-monitoring.action_monitoring.table'))->insert([
            'user_id' => auth($guard)->id(),
            'action_type' => $actionType,
            'table_name' => $model->getTable(),
            'browser_name' => $agent->browser(),
            'platform' => $agent->platform(),
            'device' => $agent->device(),
            'ip' => request()->ip(),
            'page' => request()->url(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}