<?php

namespace Binafy\LaravelUserMonitoring\Contracts;

use Illuminate\Http\Request;

interface MonitoringCondition
{
    public function shouldMonitor(Request $request): bool;
}
