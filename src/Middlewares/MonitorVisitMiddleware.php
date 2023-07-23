<?php

namespace Binafy\LaravelUserMonitoring\Middlewares;

use Binafy\LaravelUserMonitoring\Models\VisitMonitoring;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
    public function handle(Request $request, Closure $next): Response
    {
        $agent = new Agent();
        $guard = config('user-monitoring.user.guard');

        // Store visit
        VisitMonitoring::query()->create([
            'user_id' => auth($guard)->id(),
            'browser_name' => $agent->browser(),
            'platform' => $agent->platform(),
            'device' => $agent->device(),
            'ip' => $request->ip(),
            'page' => $request->url(),
        ]);

        return $next($request);
    }
}