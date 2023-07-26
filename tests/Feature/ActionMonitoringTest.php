<?php

use Binafy\LaravelUserMonitoring\Utills\ActionType;
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
        ->toBe(ActionType::ACTION_STORE)
        ->and($user->name)
        ->toBe(ActionMonitoring::first()->user->name);

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
        ->toBe(ActionType::ACTION_STORE)
        ->and(ActionMonitoring::query()->first()->user)->toBeNull();

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 1);
    assertDatabaseHas(config('user-monitoring.action_monitoring.table'), ['page' => url('/')]);
});

test('store action monitoring when a model updated with login user', function () {
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
        ->toBe(ActionType::ACTION_UPDATE)
        ->and($user->name)->toBe(ActionMonitoring::first()->user->name);

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 2);
    assertDatabaseHas(config('user-monitoring.action_monitoring.table'), ['page' => url('/')]);
});

test('store action monitoring when a model updated without login user', function () {
    $product = Product::query()->create([
        'title' => 'milwad'
    ]);
    $product->update(['title' => 'Binafy']);

    // Assertions
    expect(ActionMonitoring::query()->value('table_name'))
        ->toBe('products')
        ->and(ActionMonitoring::query()->where('id', 2)->value('action_type'))
        ->toBe(ActionType::ACTION_UPDATE)
        ->and(ActionMonitoring::first()->user)->toBeNull();

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 2);
    assertDatabaseHas(config('user-monitoring.action_monitoring.table'), ['page' => url('/')]);
});

test('store action monitoring when a model deleted with login user', function () {
    $user = createUser();
    auth()->login($user);

    $product = Product::query()->create([
        'title' => 'milwad'
    ]);
    $product->delete();

    // Assertions
    expect(ActionMonitoring::query()->value('table_name'))
        ->toBe('products')
        ->and(ActionMonitoring::query()->where('id', 2)->value('action_type'))
        ->toBe(ActionType::ACTION_DELETE)
        ->and($user->name)->toBe(ActionMonitoring::first()->user->name);

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 2);
    assertDatabaseHas(config('user-monitoring.action_monitoring.table'), ['page' => url('/')]);
});

test('store action monitoring when a model deleted without login user', function () {
    $product = Product::query()->create([
        'title' => 'milwad'
    ]);
    $product->delete();

    // Assertions
    expect(ActionMonitoring::query()->value('table_name'))
        ->toBe('products')
        ->and(ActionMonitoring::query()->where('id', 2)->value('action_type'))
        ->toBe(ActionType::ACTION_DELETE)
        ->and(ActionMonitoring::first()->user)->toBeNull();

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 2);
    assertDatabaseHas(config('user-monitoring.action_monitoring.table'), ['page' => url('/')]);
});

test('store action monitoring when a model read with login user', function () {
    $user = createUser();
    auth()->login($user);

    Product::query()->create([
        'title' => 'milwad'
    ]);
    Product::query()->get();

    // Assertions
    expect(ActionMonitoring::query()->value('table_name'))
        ->toBe('products')
        ->and(ActionMonitoring::query()->where('id', 2)->value('action_type'))
        ->toBe(ActionType::ACTION_READ)
        ->and($user->name)->toBe(ActionMonitoring::first()->user->name);

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 2);
    assertDatabaseHas(config('user-monitoring.action_monitoring.table'), ['page' => url('/')]);
});

test('store action monitoring when a model read without login user', function () {
    Product::query()->create([
        'title' => 'milwad'
    ]);
    Product::query()->get();

    // Assertions
    expect(ActionMonitoring::query()->value('table_name'))
        ->toBe('products')
        ->and(ActionMonitoring::query()->where('id', 2)->value('action_type'))
        ->toBe(ActionType::ACTION_READ)
        ->and(ActionMonitoring::first()->user)->toBeNull();

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 2);
    assertDatabaseHas(config('user-monitoring.action_monitoring.table'), ['page' => url('/')]);
});
