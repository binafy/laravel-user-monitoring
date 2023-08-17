<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{assertDatabaseCount, assertDatabaseMissing, delete, get};

/*
 * Use `RefreshDatabase` for delete migration data for each test.
 */
uses(RefreshDatabase::class);

test('index visits-monitoring is return correct view with data', function () {
    $response = get(route('user-monitoring.visits-monitoring'));
    $response->assertViewIs('LaravelUserMonitoring::visits-monitoring.index');
    $response->assertViewHas('visits');
});

test('delete visits-monitoring route delete visit monitoring and redirect', function () {
    get(route('user-monitoring.visits-monitoring'));

    $response = delete(route('user-monitoring.visits-monitoring-delete', 1));
    $response->assertRedirect(route('user-monitoring.visits-monitoring'));

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.visit_monitoring.table'), 1);
    assertDatabaseMissing(config('user-monitoring.visit_monitoring.table'), ['page' => route('user-monitoring.visits-monitoring')]);
});
