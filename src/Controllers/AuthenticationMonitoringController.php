<?php

namespace Binafy\LaravelUserMonitoring\Controllers;

use Binafy\LaravelUserMonitoring\Models\AuthenticationMonitoring;

class AuthenticationMonitoringController extends BaseController
{
    public function index()
    {
        $authentications = AuthenticationMonitoring::query()->latest()->get();

        return view('LaravelUserMonitoring::authentications-monitoring.index', compact('authentications'));
    }

    public function destroy(AuthenticationMonitoring $authenticationMonitoring)
    {
        $authenticationMonitoring->delete();

        // TODO: Add alert
        return to_route('user-monitoring.authentications-monitoring');
    }
}
