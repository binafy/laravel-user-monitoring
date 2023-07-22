<?php

namespace Binafy\LaravelUserMonitoring\Middlewares;

use App\Models\VisitMonitoring;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        // TODO: read guard for user from somewhere
        VisitMonitoring::query()->create([
            'user_id' => auth()->id(),
            'browse_name' => ,
            'platform' => ,
            'device' => $request->userAgent(),
            'ip' => $request->ip(),
            'page' => $request->url(),
        ]);

        return $next($request);
    }
}