<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{assertDatabaseCount, delete, get};

/*
 * Use `RefreshDatabase` for delete migration data for each test.
 */
uses(RefreshDatabase::class);

test('index authentications-monitoring is return correct view with data', function () {
    $response = get(route('user-monitoring.authentications-monitoring'));
    $response->assertViewIs('LaravelUserMonitoring::authentications-monitoring.index');
    $response->assertViewHas('authentications');
});

test('delete authentications-monitoring route delete action monitoring and redirect', function () {
    $user = createUser();
    auth()->login($user);

    $response = delete(route('user-monitoring.authentications-monitoring-delete', 1));
    $response->assertRedirect(route('user-monitoring.authentications-monitoring'));

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 0);
});
