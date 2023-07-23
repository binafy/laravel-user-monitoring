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

test('store action monitoring when a model created without login user', function () {
    Product::query()->create([
        'title' => 'milwad'
    ]);

    // Assertions
    expect(ActionMonitoring::query()->value('table_name'))
        ->toBe('products')
        ->and(ActionMonitoring::query()->value('action_type'))
        ->toBe(ActionEnum::ACTION_STORE->value)
        ->and(ActionMonitoring::query()->first()->user)->toBeNull();

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 1);
    assertDatabaseHas(config('user-monitoring.action_monitoring.table'), ['page' => url('/')]);
});

test('update action monitoring when a model created with login user', function () {
    $user = createUser();
    auth()->login($user);

    $product = Product::query()->create([
        'title' => 'milwad'
    ]);
    $product->update(['title' => 'Binafy']);

    // Assertions
    expect(ActionMonitoring::query()->value('table_name'))
        ->toBe('products')
        ->and(ActionMonitoring::query()->where('id', 2)->value('action_type'))
        ->toBe(ActionEnum::ACTION_UPDATE->value)
        ->and($user->name)->toBe(ActionMonitoring::first()->user->name);

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 2);
    assertDatabaseHas(config('user-monitoring.action_monitoring.table'), ['page' => url('/')]);
});


test('update action monitoring when a model created without login user', function () {
    $product = Product::query()->create([
        'title' => 'milwad'
    ]);
    $product->update(['title' => 'Binafy']);

    // Assertions
    expect(ActionMonitoring::query()->value('table_name'))
        ->toBe('products')
        ->and(ActionMonitoring::query()->where('id', 2)->value('action_type'))
        ->toBe(ActionEnum::ACTION_UPDATE->value)
        ->and(ActionMonitoring::first()->user)->toBeNull();

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 2);
    assertDatabaseHas(config('user-monitoring.action_monitoring.table'), ['page' => url('/')]);
});
