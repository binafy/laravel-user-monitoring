<?php

namespace Binafy\LaravelUserMonitoring\Middlewares;

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

        return $next($request);
    }
}