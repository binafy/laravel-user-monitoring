<?php

namespace Binafy\LaravelUserMonitoring\Controllers;

use Binafy\LaravelUserMonitoring\Models\VisitMonitoring;

class VisitMonitoringController extends BaseController
{
    public function index()
    {
        $visits = VisitMonitoring::query()->latest()->get();

        return view('LaravelUserMonitoring::visits-monitoring.index', compact('visits'));
    }

    public function destroy(VisitMonitoring $visitMonitoring)
    {
        $visitMonitoring->delete();

        // TODO: Add alert
        return to_route('user-monitoring.visits-monitoring');
    }
}
