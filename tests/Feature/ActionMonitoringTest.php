<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\SetUp\Models\Product;

/*
 * Use `RefreshDatabase` for delete migration data for each test.
 */
uses(RefreshDatabase::class);

test('store action monitoring when a model created with login user', function () {
    $user = createUser();

    Product::query()->create([
         'title' => 'milwad'
    ]);
});
