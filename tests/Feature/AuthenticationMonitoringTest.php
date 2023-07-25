<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{assertDatabaseCount, assertDatabaseHas};

/*
 * Use `RefreshDatabase` for delete migration data for each test.
 */
uses(RefreshDatabase::class);

test('store authentication monitoring when a user login', function () {
    $user = createUser();
    auth()->login($user);

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.authentication_monitoring.table'), 1);
    assertDatabaseHas(config('user-monitoring.authentication_monitoring.table'), [
        'user_id' => $user->id,
        'action_type' => 'login',
    ]);
});

test('store authentication monitoring when a user logout', function () {
    $user = createUser();
    auth()->login($user);
    auth()->logout();

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.authentication_monitoring.table'), 2);
    assertDatabaseHas(config('user-monitoring.authentication_monitoring.table'), [
        'user_id' => $user->id,
        'action_type' => 'logout',
    ]);
});
