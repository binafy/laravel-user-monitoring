<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

/*
 * Use `RefreshDatabase` for delete migration data for each test.
 */
uses(RefreshDatabase::class);

test('index actions-monitoring is return correct view with data', function () {
    $response = get(route('user-monitoring.actions-monitoring'));
    $response->assertViewIs('LaravelUserMonitoring::actions-monitoring.index');
    $response->assertViewHas('actions');
});
