<?php

use Binafy\LaravelUserMonitoring\Models\ActionMonitoring;
use Binafy\LaravelUserMonitoring\Utills\ActionType;
use Binafy\LaravelUserMonitoring\Utills\UserUtils;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\SetUp\Models\Product;
use Tests\SetUp\Models\ProductSoftDelete;
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

test('store action monitoring when a model created with login user with unknow guard', function () {
    config(['user-monitoring.user.guards' => ['milwad']]);

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
        ->and(ActionMonitoring::first()->user)
        ->toBeNull();

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

test('store action monitoring when a model replicate with login user', function () {
    config()->set('user-monitoring.action_monitoring.on_replicate', true);

    $user = createUser();
    auth()->login($user);

    $milwadPro = Product::query()->create([
        'title' => 'milwad',
        'description' => 'WE ARE HELPING TO OPEN-SOURCE WORLD'
    ]);

    $binafyPro = $milwadPro->replicate()->fill([
        'title' => 'binafy'
    ])->save();

    // Assertions
    expect(ActionMonitoring::query()->value('table_name'))
        ->toBe('products')
        ->and(ActionMonitoring::query()->where('id', 2)->value('action_type'))
        ->toBe(ActionType::ACTION_REPLICATE)
        ->and($user->name)
        ->toBe(ActionMonitoring::first()->user->name);

    // DB Assertions
    assertDatabaseCount('products', 2);
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 3);
    assertDatabaseHas(config('user-monitoring.action_monitoring.table'), ['page' => url('/')]);
});

test('restore a model in acting monitoring', function () {
    config()->set('user-monitoring.action_monitoring.on_restore', true);

    $user = createUser();
    auth()->login($user);

    $product = ProductSoftDelete::query()->create([
        'title' => 'milwad',
        'description' => 'WE ARE HELPING TO OPEN-SOURCE WORLD'
    ]);

    $product->delete();
    $product->restore();

    // Assertions
    expect(ActionMonitoring::query()->value('table_name'))
        ->toBe('products')
        ->and(ActionMonitoring::query()->where('id', 4)->value('action_type'))
        ->toBe(ActionType::ACTION_RESTORED)
        ->and($user->name)
        ->toBe(ActionMonitoring::first()->user->name);

    // DB Assertions
    assertDatabaseCount('products', 1);
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 4);
    assertDatabaseHas(config('user-monitoring.action_monitoring.table'), ['page' => url('/')]);
});

test('action not stored when the on_restore config is false', function () {
    $user = createUser();
    auth()->login($user);

    $product = ProductSoftDelete::query()->create([
        'title' => 'milwad',
        'description' => 'WE ARE HELPING TO OPEN-SOURCE WORLD'
    ]);

    $product->delete();
    $product->restore();

    // Assertions
    expect(ActionMonitoring::query()->value('table_name'))
        ->toBe('products')
        ->and(ActionMonitoring::query()->where('id', 4)->value('action_type'))
        ->toBeNull()
        ->and($user->name)
        ->toBe(ActionMonitoring::first()->user->name);

    // DB Assertions
    assertDatabaseCount('products', 1);
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 3);
    assertDatabaseHas(config('user-monitoring.action_monitoring.table'), ['page' => url('/')]);
});

test('the getTypeColor method work as expected', function () {
    $defaultData = [
        'user_id' => null,
        'table_name' => 'products',
        'browser_name' => 'Chrome',
        'platform' => 'Windows',
        'device' => 'Macbook M4',
        'ip' => '192.168.0.1',
        'user_guard' => 'web',
        'page' => 'https://github.com/milwad-dev',
    ];
    $colors = [
        ActionType::ACTION_READ => 'blue',
        ActionType::ACTION_STORE => 'green',
        ActionType::ACTION_UPDATE => 'purple',
        ActionType::ACTION_DELETE => 'red',
        ActionType::ACTION_RESTORED => 'yellow',
        ActionType::ACTION_REPLICATE => 'pink',
    ];

    foreach (ActionType::$types as $type) {
        $actionMonitoring = ActionMonitoring::query()->create($defaultData + [
            'action_type' => $type
        ]);

        expect($actionMonitoring->getTypeColor())->toBe($colors[$type]);
    }
});

test('action not stored when the guest mode is off and user not logged in', function () {
    config()->set('user-monitoring.action_monitoring.guest_mode', false);

    $product = Product::query()->create([
        'title' => 'milwad',
        'description' => 'WE ARE HELPING TO OPEN-SOURCE WORLD'
    ]);
    $product->delete();

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 0);
});

test('action stored when the guest mode is on and user not logged in', function () {
    config()->set('user-monitoring.action_monitoring.guest_mode', true);

    $product = Product::query()->create([
        'title' => 'milwad',
        'description' => 'WE ARE HELPING TO OPEN-SOURCE WORLD'
    ]);
    $product->delete();

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 2);
});

test('action stored when the guest mode is off and user logged in', function () {
    config()->set('user-monitoring.action_monitoring.guest_mode', false);

    $user = createUser();
    auth()->login($user);

    $product = Product::query()->create([
        'title' => 'milwad',
        'description' => 'WE ARE HELPING TO OPEN-SOURCE WORLD'
    ]);
    $product->delete();

    // DB Assertions
    assertDatabaseCount(config('user-monitoring.action_monitoring.table'), 2);
});
