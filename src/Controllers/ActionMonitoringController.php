<?php

namespace Binafy\LaravelUserMonitoring\Controllers;

use Binafy\LaravelUserMonitoring\Models\ActionMonitoring;
use Illuminate\Support\Facades\DB;

class ActionMonitoringController extends BaseController
{
    public function index()
    {
        $actions = ActionMonitoring::query()->latest()->paginate();

        return view('LaravelUserMonitoring::actions-monitoring.index', compact('actions'));
    }

    public function destroy(int $id)
    {
        DB::table(config('user-monitoring.action_monitoring.table'))
            ->where('id', $id)
            ->delete();

        // TODO: Add alert
        return to_route('user-monitoring.actions-monitoring');
    }
}
