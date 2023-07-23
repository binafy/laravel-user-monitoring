<?php

namespace Binafy\LaravelUserMonitoring\Traits;

use Binafy\LaravelUserMonitoring\Enums\ActionEnum;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

trait Actionable
{
    /**
     * The "boot" method of the model.
     */
    protected static function boot(): void
    {
        if (config('user-monitoring.action_monitoring.on_store', false)) {
            static::created(function (mixed $model) {
                $this->insertActionMonitoring($model, ActionEnum::ACTION_STORE->value);
            });
        }

        if (config('user-monitoring.action_monitoring.on_update', false)) {
            static::updated(function (mixed $model) {
                $this->insertActionMonitoring($model, ActionEnum::ACTION_UPDATE->value);
            });
        }

        if (config('user-monitoring.action_monitoring.on_destroy', false)) {
            static::deleted(function (mixed $model) {
                $this->insertActionMonitoring($model, ActionEnum::ACTION_DELETE->value);
            });
        }

        if (config('user-monitoring.action_monitoring.on_read', false)) {
            static::retrieved(function (mixed $model) {
                $this->insertActionMonitoring($model, ActionEnum::ACTION_READ->value);
            });
        }

//        if (config('user-monitoring.action_monitoring.on_restore', false)) {
//            static::restored(function (mixed $model) {
//                $this->insertActionMonitoring($model, ActionEnum::ACTION_RESTORED->value);
//            });
//        }TODO: Release next version

//        if (config('user-monitoring.action_monitoring.on_replicate', false)) {
//            static::restored(function (mixed $model) {
//                $this->insertActionMonitoring($model, ActionEnum::ACTION_REPLICATE->value);
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
    private function insertActionMonitoring(mixed $model, string $actionType): void
    {
        $agent = new Agent();

        DB::table(config('user-monitoring.action_monitoring.table'))->insert([
            'user_id' => auth()->id(),
            'action_type' => $actionType,
            'table_name' => $model->getTable(),
            'browser_name' => $agent->browser(),
            'platform' => $agent->platform(),
            'device' => $agent->device(),
            'ip' => request()->ip(),
            'page' => request()->url(),
        ]);
    }
}