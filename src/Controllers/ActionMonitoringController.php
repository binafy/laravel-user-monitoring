<?php

namespace Binafy\LaravelUserMonitoring\Controllers;

use Binafy\LaravelUserMonitoring\Models\ActionMonitoring;

class ActionMonitoringController extends BaseController
{
    public function index()
    {
        $actions = ActionMonitoring::query()->latest()->paginate();

        return view('LaravelUserMonitoring::actions-monitoring.index', compact('actions'));
    }

    public function destroy(ActionMonitoring $actionMonitoring)
    {
        $actionMonitoring->delete();

        // TODO: Add alert
        return to_route('user-monitoring.actions-monitoring');
    }
}
