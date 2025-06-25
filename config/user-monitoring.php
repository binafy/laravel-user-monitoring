<?php

return [
    /*
     * Main configuration settings for the package.
     */
    'config' => [
        'routes' => [
            /*
             * Path to the route file that handles user monitoring routes.
             */
            'file_path' => 'routes/user-monitoring.php',
        ],
    ],

    /*
     * User-specific configuration settings.
     *
     * Customize various aspects related to the user model, including the guard, table, foreign key, and display attributes.
     */
    'user' => [
        /*
         * Specify the fully qualified class name of the user model.
         */
        'model' => 'App\Models\User',

        /*
         * Name of the foreign key column linking user data to other models.
         */
        'foreign_key' => 'user_id',

        /*
         * Name of the table storing user data.
         */
        'table' => 'users',

        /*
         * Defines the authentication guards used for verifying the user.
         * Multiple guards can be specified for flexible authentication strategies.
         * Ensure these guards are configured correctly in the 'guards' section of the auth.php config file.
         */
        'guards' => ['web'],

        /*
         * Specify the type of foreign key being used (e.g., 'id', 'uuid', 'ulid').
         * For non-standard IDs, make sure to add the relevant traits to your models.
         */
        'foreign_key_type' => 'id', // Options: uuid, ulid, id

        /*
         * Attribute of the user model used to display the user's name.
         * If you wish to use a different attribute (e.g., username), change this value accordingly.
         */
        'display_attribute' => 'name',
    ],

    /*
     * Configuration settings for visit monitoring.
     */
    'visit_monitoring' => [
        /*
         * The table where visit data will be stored.
         */
        'table' => 'visits_monitoring',

        /*
         * Enable or disable the visit monitoring feature.
         * Set false to disable tracking of user visits.
         */
        'turn_on' => true,

        /*
         * Enable or disable monitoring for AJAX requests.
         * Set to false if you do not wish to track AJAX-based page loads.
         */
        'ajax_requests' => true,

        /*
         * List of pages that should be excluded from visit monitoring.
         * Add route names or URL paths to this array if you want to exclude certain pages.
         */
        'except_pages' => [
            'user-monitoring/visits-monitoring',
            'user-monitoring/actions-monitoring',
            'user-monitoring/authentications-monitoring',
        ],

        /*
         * Set the number of days after which visit records should be automatically deleted.
         * Set to 0 to disable automatic deletion.
         *
         * To enable automatic deletion, configure Laravel's task scheduling as outlined here:
         * https://laravel.com/docs/scheduling
         */
        'delete_days' => 0,

        /*
         * Determines whether to store `visits` even when the user is not logged in.
         */
        'guest_mode' => true,
    ],

    /*
     * Configuration settings for action monitoring.
     */
    'action_monitoring' => [
        /*
         * The table where action data (e.g., store, update, delete) will be stored.
         */
        'table' => 'actions_monitoring',

        /*
         * Enable or disable monitoring of specific actions (e.g., store, update, delete).
         * Set to true to monitor actions or false to disable.
         */
        'on_store'      => true,
        'on_update'     => true,
        'on_destroy'    => true,
        'on_read'       => true,
        'on_restore'    => false,
        'on_replicate'  => false,

        /*
         * If your application is behind a reverse proxy (e.g., Nginx or Cloudflare),
         * enable this setting to fetch the real client IP from the proxy headers.
         */
        'use_reverse_proxy_ip' => false,

        /*
         * The header used by reverse proxies to forward the real client IP.
         * Common values are 'X-Forwarded-For' or 'X-Real-IP'.
         */
        'real_ip_header' => 'X-Forwarded-For',

        /*
         * Determines whether to store `actions` even when the user is not logged in.
         */
        'guest_mode' => true,
    ],

    /*
     * Configuration settings for authentication monitoring.
     */
    'authentication_monitoring' => [
        /*
         * The table name.
         */
        'table' => 'authentications_monitoring',

        /*
         * If enabled, authentication records will be deleted when the associated user is deleted.
         */
        'delete_user_record_when_user_delete' => true,

        /*
         * Enable or disable monitoring of user login and logout events.
         * Set to true to track these actions, or false to disable.
         */
        'on_login' => true,
        'on_logout' => true,
    ],
];
