<?php

namespace Binafy\LaravelUserMonitoring\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class MonitorVisitMiddleware
{
    /**
     * Handle.
     *
     * @param  Request $request
     * @param  Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next)
    {
        $agent = new Agent();
        $guard = config('user-monitoring.user.guard');

        // Store visit
        DB::table(config('user-monitoring.visit_monitoring.table'))->insert([
            'user_id' => auth($guard)->id(),
            'browser_name' => $agent->browser(),
            'platform' => $agent->platform(),
            'device' => $agent->device(),
            'ip' => $request->ip(),
            'page' => $request->url(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $next($request);
    }
}