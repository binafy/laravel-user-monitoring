<?php

namespace Binafy\LaravelUserMonitoring\Middlewares;

use App\Models\VisitMonitoring;
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

        // TODO: read guard for user from somewhere
        // Store visit
        VisitMonitoring::query()->create([
            'user_id' => auth()->id(),
            'browser_name' => $agent->browser(),
            'platform' => $agent->platform(),
            'device' => $agent->device(),
            'ip' => $request->ip(),
            'page' => $request->url(),
        ]);

        return $next($request);
    }
}