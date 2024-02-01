<?php

namespace Binafy\LaravelUserMonitoring\Middlewares;

use Binafy\LaravelUserMonitoring\Utills\Detector;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitMonitoringMiddleware
{
    /**
     * Handle monitor visiting.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (config('user-monitoring.visit_monitoring.turn_on', false) === false) {
            return $next($request);
        }
        if (config('user-monitoring.visit_monitoring.ajax_requests', false) === false && $request->ajax()) {
            return $next($request);
        }

        $detector = new Detector();
        $guard = config('user-monitoring.user.guard', 'web');
        $exceptPages = config('user-monitoring.visit_monitoring.except_pages', []);

        if (empty($exceptPages) || !$this->checkIsExceptPages($request->path(), $exceptPages)) {
            // Store visit
            DB::table(config('user-monitoring.visit_monitoring.table'))->insert([
                'user_id' => auth($guard)->id(),
                'browser_name' => $detector->getBrowser(),
                'platform' => $detector->getDevice(),
                'device' => $detector->getDevice(),
                'ip' => $request->ip(),
                'page' => $request->url(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return $next($request);
    }

    /**
     * Check request page are exists in expect pages.
     */
    private function checkIsExceptPages(string $page, array $exceptPages): bool
    {
        return collect($exceptPages)->contains($page);
    }
}
