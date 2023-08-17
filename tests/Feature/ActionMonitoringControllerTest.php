<?php

use Binafy\LaravelUserMonitoring\Models\ActionMonitoring;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\SetUp\Models\Product;
use function Pest\Laravel\{assertDatabaseCount, delete, get};

/*
 * Use `RefreshDatabase` for delete migration data for each test.
 */
uses(RefreshDatabase::class);

test('index actions-monitoring is return correct view with data', function () {
    $response = get(route('user-monitoring.actions-monitoring'));
    $response->assertViewIs('LaravelUserMonitoring::actions-monitoring.index');
    $response->assertViewHas('actions');
});

test('delete actions-monitoring route delete action monitoring and redirect', function () {
    Product::query()->create(['title' => 'Binafy']);

    $response = delete(route('user-monitoring.actions-monitoring-delete', 1));
    $response->assertRedirect(route('user-monitoring.actions-monitoring'));

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 0);
});
