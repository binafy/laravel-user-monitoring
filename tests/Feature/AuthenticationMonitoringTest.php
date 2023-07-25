<?php

use Binafy\LaravelUserMonitoring\Models\AuthenticationMonitoring;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\SetUp\Models\User;

use function Pest\Laravel\{assertDatabaseCount, assertDatabaseHas, assertDatabaseMissing};

/*
 * Use `RefreshDatabase` for delete migration data for each test.
 */
uses(RefreshDatabase::class);

test('store authentication monitoring when a user login', function () {
    $user = createUser();
    auth()->login($user);

    // Assertions
    expect($user->name)
        ->toBe(AuthenticationMonitoring::first()->user->name)
        ->and('login')
        ->toBe(AuthenticationMonitoring::first()->value('action_type'));

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

    // Assertions
    expect($user->name)
        ->toBe(AuthenticationMonitoring::first()->user->name)
        ->and('logout')
        ->toBe(AuthenticationMonitoring::query()->firstWhere('id', 2)->action_type);

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.authentication_monitoring.table'), 2);
    assertDatabaseHas(config('user-monitoring.authentication_monitoring.table'), [
        'user_id' => $user->id,
        'action_type' => 'logout',
    ]);
});

test('when user deleted authentications-monitoring rows didnt deleted', function () {
    config(['user-monitoring.authentication_monitoring.delete_user_record_when_user_delete', false]);

    $user = createUser();
    auth()->login($user);
    User::query()->first()->delete();

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.authentication_monitoring.table'), 1);
    assertDatabaseHas(config('user-monitoring.authentication_monitoring.table'), [
        'user_id' => 1,
        'action_type' => 'login',
    ]);
});

test('when user deleted authentications-monitoring rows were deleted', function () {
    $user = createUser();
    auth()->login($user);

    User::query()->delete();

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.authentication_monitoring.table'), 0);
    assertDatabaseMissing(config('user-monitoring.authentication_monitoring.table'), [
        'user_id' => 1,
        'action_type' => 'login',
    ]);
});
