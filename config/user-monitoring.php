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
     * Visit monitoring configurations.
     *
     * You can config of visit monitoring.
     */
    'visit_monitoring' => [
        'table' => 'visits_monitoring',
    ],

    /*
     * Action monitoring configurations.
     */
    'action_monitoring' => [
        'table' => 'actions_monitoring',

        /*
         * Monitor actions.
         *
         * You can set true/false for monitor action like (store, update and ...).
         */
        'on_store'      => true,
        'on_update'     => true,
        'on_destroy'    => true,
        'on_read'       => true,
        'on_restore'    => false, // Release next version :)
        'on_replicate'  => false, // Release next version :)
        // TODO: Check for truncate
    ],
];
