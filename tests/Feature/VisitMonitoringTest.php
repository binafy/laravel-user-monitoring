<?php

use Binafy\LaravelUserMonitoring\Models\VisitMonitoring;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\SetUp\Models\User;
use function Pest\Laravel\{actingAs, get};
use function Pest\Laravel\{assertDatabaseCount, assertDatabaseHas, assertDatabaseMissing};

/*
 * Use `RefreshDatabase` for delete migration data for each test.
 */
uses(RefreshDatabase::class);

test('store login user activity when see a page', function () {
    $user = createUser();

    $response = actingAs($user)->get('/');
    $response->assertContent('milwad');

    // Assertions
    expect($user->name)->toBe(VisitMonitoring::first()->user->name);

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.visit_monitoring.table'), 1);
    assertDatabaseHas(config('user-monitoring.visit_monitoring.table'), ['page' => url('/')]);
});

test('store activity without user when see a page', function () {
    $response = get('/');
    $response->assertContent('milwad');

    // Assertions
    expect(VisitMonitoring::first()->user)->toBeNull();

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.visit_monitoring.table'), 1);
    assertDatabaseHas(config('user-monitoring.visit_monitoring.table'), ['page' => url('/')]);
});

test('check except pages are not store', function () {
    config()->set('user-monitoring.visit_monitoring.except_pages', ['/']);

    $response = get('/');
    $response->assertContent('milwad');

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.visit_monitoring.table'), 0);
    assertDatabaseMissing(config('user-monitoring.visit_monitoring.table'), ['page' => url('/')]);
});

test('visit monitoring records didn"t store when turn_on key is off', function () {
    config()->set('user-monitoring.visit_monitoring.turn_on', false);

    $response = get('/');
    $response->assertContent('milwad');

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.visit_monitoring.table'), 0);
    assertDatabaseMissing(config('user-monitoring.visit_monitoring.table'), ['page' => url('/')]);
});

/**
 * Create user.
 *
 * @return bool
 */
function createUser()
{
    return User::query()->create([
        'name' => 'milwad',
        'email' => 'milwad@gmail.com',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    ]);
}
