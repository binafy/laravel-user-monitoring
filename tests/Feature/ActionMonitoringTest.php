<?php

use Binafy\LaravelUserMonitoring\Enums\ActionEnum;
use Binafy\LaravelUserMonitoring\Models\ActionMonitoring;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\SetUp\Models\Product;

use function Pest\Laravel\{assertDatabaseCount, assertDatabaseHas};

/*
 * Use `RefreshDatabase` for delete migration data for each test.
 */
uses(RefreshDatabase::class);

test('store action monitoring when a model created with login user', function () {
    $user = createUser();
    auth()->login($user);

    Product::query()->create([
         'title' => 'milwad'
    ]);

    // Assertions
    expect(ActionMonitoring::query()->value('table_name'))
        ->toBe('products')
        ->and(ActionMonitoring::query()->value('action_type'))
        ->toBe(ActionEnum::ACTION_STORE->value)
        ->and($user->name)->toBe(ActionMonitoring::first()->user->name);

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 1);
    assertDatabaseHas(config('user-monitoring.action_monitoring.table'), ['page' => url('/')]);
});
