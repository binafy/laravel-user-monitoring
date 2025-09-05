<?php

namespace Binafy\LaravelUserMonitoring\Middlewares;

use Binafy\LaravelUserMonitoring\Contracts\MonitoringCondition;
use Binafy\LaravelUserMonitoring\Utills\Detector;
use Binafy\LaravelUserMonitoring\Utills\UserUtils;
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
        if (!config('user-monitoring.visit_monitoring.guest_mode', true) && is_null(UserUtils::getUserId())) {
            return $next($request);
        }

        // Custom conditions from config
        if (! $this->shouldMonitor($request)) {
            return $next($request);
        }

        $detector = new Detector;
        $exceptPages = config('user-monitoring.visit_monitoring.except_pages', []);

        if (empty($exceptPages) || !$this->checkIsExceptPages($request->path(), $exceptPages)) {
            // Store visit
            DB::table(config('user-monitoring.visit_monitoring.table'))->insert([
                'user_id' => UserUtils::getUserId(),
                'browser_name' => $detector->getBrowser(),
                'platform' => $detector->getDevice(),
                'device' => $detector->getDevice(),
                'ip' => $request->ip(),
                'user_guard' => UserUtils::getCurrentGuardName(),
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
    protected function checkIsExceptPages(string $page, array $exceptPages): bool
    {
        return collect($exceptPages)->contains($page);
    }

    /**
     * Determine if monitoring should be performed for the given request and user.
     */
    protected function shouldMonitor(Request $request): bool
    {
        $config = config('user-monitoring.visit_monitoring.conditions', []);

        foreach ($config as $condition) {
            if (is_callable($condition)) {
                if (! $condition($request)) {
                    return false;
                }
            } elseif (is_string($condition)) {
                $instance = new $condition;
                if (! $instance instanceof MonitoringCondition) {
                    continue;
                }
                if (! $instance->shouldMonitor($request)) {
                    return false;
                }
            }
        }

        return true;
    }
}
