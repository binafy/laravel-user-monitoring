<?php

namespace Binafy\LaravelUserMonitoring\Controllers;

use Binafy\LaravelUserMonitoring\Models\AuthenticationMonitoring;
use Illuminate\Support\Facades\DB;

class AuthenticationMonitoringController extends BaseController
{
    public function index()
    {
        $authentications = AuthenticationMonitoring::query()->latest()->paginate();

        return view('LaravelUserMonitoring::authentications-monitoring.index', compact('authentications'));
    }

    public function destroy(int $id)
    {
        DB::table(config('user-monitoring.authentication_monitoring.table'))
            ->where('id', $id)
            ->delete();

        return to_route('user-monitoring.authentications-monitoring');
    }
}
