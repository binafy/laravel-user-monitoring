<?php

namespace Binafy\LaravelUserMonitoring\Controllers;

class VisitMonitoringController extends BaseController
{
    public function index()
    {
        return view('LaravelUserMonitoring::visit-monitoring.index');
    }
}