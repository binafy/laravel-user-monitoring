<?php

return [
    /*
     * User properties.
     *
     * You can customize the use guard, table, foreign_key and ... .
     */
    'user' => [
        'model' => 'App\Models\User',
        'foreign_key' => 'user_id',
        'tables' => 'users',
        'guard' => 'web',
    ],

    /*
     * Monitor actions.
     *
     * You can set true/false for monitor action like (store, update and ...).
     */
    'monitor_actions' => [
        'on_store'      => false,
        'on_update'     => true,
        'on_destroy'    => true,
        // TODO: Check for truncate
    ]
];
