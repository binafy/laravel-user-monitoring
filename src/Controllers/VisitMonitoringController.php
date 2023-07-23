<?php

namespace Binafy\LaravelUserMonitoring\Controllers;

use Binafy\LaravelUserMonitoring\Models\VisitMonitoring;

class VisitMonitoringController extends BaseController
{
    public function index()
    {
        $visits = VisitMonitoring::query()->latest()->get();

        return view('LaravelUserMonitoring::visit-monitoring.index', compact('visits'));
    }

    public function destroy(int $id)
    {
        VisitMonitoring::query()->where('id', $id)->delete();

        // TODO: Add alert
        return to_route('user-monitoring.visits-monitoring');
    }
}