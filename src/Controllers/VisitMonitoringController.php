<?php

namespace Binafy\LaravelUserMonitoring\Controllers;

use Binafy\LaravelUserMonitoring\Models\VisitMonitoring;
use Illuminate\Support\Facades\DB;

class VisitMonitoringController extends BaseController
{
    public function index()
    {
        $visits = VisitMonitoring::query()->latest()->paginate();

        return view('LaravelUserMonitoring::visits-monitoring.index', compact('visits'));
    }

    public function destroy(int $id)
    {
        DB::table(config('user-monitoring.visit_monitoring.table'))
            ->where('id', $id)
            ->delete();

        // TODO: Add alert
        return to_route('user-monitoring.visits-monitoring');
    }
}
