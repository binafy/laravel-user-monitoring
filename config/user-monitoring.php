<?php

return [
    /*
     * User properties.
     *
     * You can customize the user guard, table, foreign key, and ... .
     */
    'user' => [
        /*
         * User model.
         */
        'model' => 'App\Models\User',

        /*
         * Foreign Key column name.
         */
        'foreign_key' => 'user_id',

        /*
         * Users table name.
         */
        'table' => 'users',

        /*
         * The correct guard.
         */
        'guard' => 'web',

        /*
         * If you are using uuid or ulid you can change it for the type of foreign_key.
         *
         * When you are using ulid or uuid, you need to add related traits into the models.
         */
        'foreign_key_type' => 'id', // uuid, ulid, id
    ],

    /*
     * Visit monitoring configurations.
     */
    'visit_monitoring' => [
        'table' => 'visits_monitoring',

        /*
         * If you want to disable visit monitoring, you can change it to false.
         */
        'turn_on' => true,

        /*
         * You can specify pages not to be monitored.
         */
        'expect_pages' => [
            // 'home',
        ],

        /*
         * If you want to delete visit rows after some days, you can change this to 360 for example,
         * but you don't like to delete rows you can change it to 0.
         *
         * For this feature you need Task-Scheduling => https://laravel.com/docs/10.x/scheduling
         */
        'delete_days' => 0,
    ],

    /*
     * Action monitoring configurations.
     */
    'action_monitoring' => [
        'table' => 'actions_monitoring',

        /*
         * Monitor actions.
         *
         * You can set true/false for monitor actions like (store, update, and ...).
         */
        'on_store'      => true,
        'on_update'     => true,
        'on_destroy'    => true,
        'on_read'       => true,
        'on_restore'    => false, // Release for next version :)
        'on_replicate'  => false, // Release for next version :)
    ],

    /*
     * Authentication monitoring configurations.
     */
    'authentication_monitoring' => [
        'table' => 'authentications_monitoring',

        /*
         * If you want to delete authentications-monitoring rows when the user is deleted from the users table you can set true or false.
         */
        'delete_user_record_when_user_delete' => true,

        /*
         * You can set true/false for monitor login or logout.
         */
        'on_login' => true,
        'on_logout' => true,
    ],
];
