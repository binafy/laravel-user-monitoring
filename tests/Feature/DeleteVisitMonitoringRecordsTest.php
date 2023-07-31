<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseMissing;

/*
 * Use `RefreshDatabase` for delete migration data for each test.
 */
uses(RefreshDatabase::class);

test('rows are delete by 1 days', function () {
    // Set delete days
    config(['user-monitoring.visit_monitoring.delete_days', 1]);

     // Store old records for 1 day age
    $user = createUser();

    DB::table(config('user-monitoring.visit_monitoring.table'))->insert([
        [
            'user_id' => $user->id,
            'browser_name' => 'Chrome',
            'platform' => 'Windows',
            'device' => 'WebKit',
            'ip' => '127.0.0.1',
            'page' => 'http://localhost:8000',
            'created_at' => now()->subDays(2),
        ],
        [
            'user_id' => $user->id,
            'browser_name' => 'Firefox',
            'platform' => 'Linux',
            'device' => 'WebKit',
            'ip' => '123.12.531.11',
            'page' => 'http://localhost:8000/milwad',
            'created_at' => now()->subDays(2),
        ]
    ]);

    artisan('laravel-user-monitoring:remove-visit-monitoring-records');

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.visit_monitoring.table'), 0);
});
