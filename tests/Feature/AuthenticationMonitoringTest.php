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
//
//test('store authentication monitoring when a model created without login user', function () {
//    Product::query()->create([
//        'title' => 'milwad'
//    ]);
//
//    // Assertions
//    expect(ActionMonitoring::query()->value('table_name'))
//        ->toBe('products')
//        ->and(ActionMonitoring::query()->value('authentication_type'))
//        ->toBe(ActionEnum::ACTION_STORE->value)
//        ->and(ActionMonitoring::query()->first()->user)->toBeNull();
//
//    // DB Assertions
//    assertDatabaseCount(config('user-monitoring.authentication_monitoring.table'), 1);
//    assertDatabaseHas(config('user-monitoring.authentication_monitoring.table'), ['page' => url('/')]);
//});
//
//test('store authentication monitoring when a model updated with login user', function () {
//    $user = createUser();
//    auth()->login($user);
//
//    $product = Product::query()->create([
//        'title' => 'milwad'
//    ]);
//    $product->update(['title' => 'Binafy']);
//
//    // Assertions
//    expect(ActionMonitoring::query()->value('table_name'))
//        ->toBe('products')
//        ->and(ActionMonitoring::query()->where('id', 2)->value('authentication_type'))
//        ->toBe(ActionEnum::ACTION_UPDATE->value)
//        ->and($user->name)->toBe(ActionMonitoring::first()->user->name);
//
//    // DB Assertions
//    assertDatabaseCount(config('user-monitoring.authentication_monitoring.table'), 2);
//    assertDatabaseHas(config('user-monitoring.authentication_monitoring.table'), ['page' => url('/')]);
//});
//
//test('store authentication monitoring when a model updated without login user', function () {
//    $product = Product::query()->create([
//        'title' => 'milwad'
//    ]);
//    $product->update(['title' => 'Binafy']);
//
//    // Assertions
//    expect(ActionMonitoring::query()->value('table_name'))
//        ->toBe('products')
//        ->and(ActionMonitoring::query()->where('id', 2)->value('authentication_type'))
//        ->toBe(ActionEnum::ACTION_UPDATE->value)
//        ->and(ActionMonitoring::first()->user)->toBeNull();
//
//    // DB Assertions
//    assertDatabaseCount(config('user-monitoring.authentication_monitoring.table'), 2);
//    assertDatabaseHas(config('user-monitoring.authentication_monitoring.table'), ['page' => url('/')]);
//});
//
//test('store authentication monitoring when a model deleted with login user', function () {
//    $user = createUser();
//    auth()->login($user);
//
//    $product = Product::query()->create([
//        'title' => 'milwad'
//    ]);
//    $product->delete();
//
//    // Assertions
//    expect(ActionMonitoring::query()->value('table_name'))
//        ->toBe('products')
//        ->and(ActionMonitoring::query()->where('id', 2)->value('authentication_type'))
//        ->toBe(ActionEnum::ACTION_DELETE->value)
//        ->and($user->name)->toBe(ActionMonitoring::first()->user->name);
//
//    // DB Assertions
//    assertDatabaseCount(config('user-monitoring.authentication_monitoring.table'), 2);
//    assertDatabaseHas(config('user-monitoring.authentication_monitoring.table'), ['page' => url('/')]);
//});
//
//test('store authentication monitoring when a model deleted without login user', function () {
//    $product = Product::query()->create([
//        'title' => 'milwad'
//    ]);
//    $product->delete();
//
//    // Assertions
//    expect(ActionMonitoring::query()->value('table_name'))
//        ->toBe('products')
//        ->and(ActionMonitoring::query()->where('id', 2)->value('authentication_type'))
//        ->toBe(ActionEnum::ACTION_DELETE->value)
//        ->and(ActionMonitoring::first()->user)->toBeNull();
//
//    // DB Assertions
//    assertDatabaseCount(config('user-monitoring.authentication_monitoring.table'), 2);
//    assertDatabaseHas(config('user-monitoring.authentication_monitoring.table'), ['page' => url('/')]);
//});
//
//test('store authentication monitoring when a model read with login user', function () {
//    $user = createUser();
//    auth()->login($user);
//
//    Product::query()->create([
//        'title' => 'milwad'
//    ]);
//    Product::query()->get();
//
//    // Assertions
//    expect(ActionMonitoring::query()->value('table_name'))
//        ->toBe('products')
//        ->and(ActionMonitoring::query()->where('id', 2)->value('authentication_type'))
//        ->toBe(ActionEnum::ACTION_READ->value)
//        ->and($user->name)->toBe(ActionMonitoring::first()->user->name);
//
//    // DB Assertions
//    assertDatabaseCount(config('user-monitoring.authentication_monitoring.table'), 2);
//    assertDatabaseHas(config('user-monitoring.authentication_monitoring.table'), ['page' => url('/')]);
//});
//
//test('store authentication monitoring when a model read without login user', function () {
//    Product::query()->create([
//        'title' => 'milwad'
//    ]);
//    Product::query()->get();
//
//    // Assertions
//    expect(ActionMonitoring::query()->value('table_name'))
//        ->toBe('products')
//        ->and(ActionMonitoring::query()->where('id', 2)->value('authentication_type'))
//        ->toBe(ActionEnum::ACTION_READ->value)
//        ->and(ActionMonitoring::first()->user)->toBeNull();
//
//    // DB Assertions
//    assertDatabaseCount(config('user-monitoring.authentication_monitoring.table'), 2);
//    assertDatabaseHas(config('user-monitoring.authentication_monitoring.table'), ['page' => url('/')]);
//});
