<?php

namespace Binafy\LaravelUserMonitoring\Controllers;

use Binafy\LaravelUserMonitoring\Models\VisitMonitoring;

class VisitMonitoringController extends BaseController
{
    public function index()
    {
        $visits = VisitMonitoring::query()->latest()->paginate();

        return view('LaravelUserMonitoring::visits-monitoring.index', compact('visits'));
    }

    public function destroy(int $id)
    {
        VisitMonitoring::query()->findOrFail($id)->delete();

        // TODO: Add alert
        return to_route('user-monitoring.visits-monitoring');
    }
}
