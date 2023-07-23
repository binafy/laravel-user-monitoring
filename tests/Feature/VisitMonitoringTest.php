<?php

use Binafy\LaravelUserMonitoring\Tests\SetUp\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;

/*
 * Use `RefreshDatabase` for delete migration data for each test.
 */
uses(RefreshDatabase::class);

test('store login user activity when see a page', function () {
    $user = createUser();

    $response = actingAs($user)->get('/');
    $response->assertContent('milwad');

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.visit_monitoring,table'), 1);
});

/**
 * Create user.
 *
 * @param  array $data
 * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
 */
function createUser(array $data = [])
{
    $data = array_merge($data, [
        'name' => 'milwad',
        'email' => 'milwad@gmail.com',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    ]);

    return User::query()->create($data);
}
