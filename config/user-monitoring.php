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

        /*
         * You can specify pages not to be monitored.
         */
        'expect_pages' => [
            // 'home',
        ],
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
    ],

    /*
     * Authentication monitoring configurations.
     */
    'authentication_monitoring' => [
        'table' => 'authentications_monitoring',

        /*
         * If you want to delete authentications-monitoring rows when user deleted from users table you can set true.
         */
        'delete_user_record_when_user_delete' => false,
    ],
];
