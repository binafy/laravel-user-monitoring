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
}