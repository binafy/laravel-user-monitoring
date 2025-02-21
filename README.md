## Laravel User Monitoring

<img src="https://banners.beyondco.de/Laravel%20User%20Monitoring.png?theme=dark&packageManager=composer+require&packageName=binafy%2Flaravel-user-monitoring&pattern=volcanoLamp&style=style_1&description=Monitor+your+user+and+all+activity+on+your+application&md=1&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" alt="laravel-user-monitoring-banner">

[![PHP Version Require](https://img.shields.io/packagist/dependency-v/binafy/laravel-user-monitoring/php)](https://packagist.org/packages/binafy/laravel-user-monitoring)
[![Latest Stable Version](https://img.shields.io/packagist/v/binafy/laravel-user-monitoring.svg?style=flat-square)](https://packagist.org/packages/binafy/laravel-user-monitoring)
[![Total Downloads](https://img.shields.io/packagist/dt/binafy/laravel-user-monitoring.svg?style=flat-square)](https://packagist.org/packages/binafy/laravel-user-monitoring)
[![License](https://img.shields.io/packagist/l/binafy/laravel-user-monitoring)](https://packagist.org/packages/binafy/laravel-user-monitoring)
[![Passed Tests](https://github.com/binafy/laravel-user-monitoring/actions/workflows/tests.yml/badge.svg)](https://github.com/binafy/laravel-user-monitoring/actions/workflows/tests.yml)

- [Introduction](#introduction)
- [Installation](#installation)
- [Usage](#usage)
    - [Configuration](#configuration)
        - [Routes Configuration](#routes-configuration)
    - [User Configuration](#user-configuration)
        - [Foreign Key Type (UUID, ULID, ID)](#foreign-key-type-uuid-ulid-id)
    - [Visit Monitoring](#visit-monitoring)
        - [Delete Visit Monitoring Records By Specific Days](#delete-visit-monitoring-records-by-specific-days)
        - [Turn ON-OFF](#turn-on-off)
        - [Views](#visit-monitoring-views)
        - [Ajax Requests](#ajax-requests)
    - [Action Monitoring](#action-monitoring)
        - [Views](#action-monitoring-views)
        - [Reverse Proxy Config](#action-monitoring-reverse-proxy-config)
    - [Authentication Monitoring](#authentication-monitoring)
        - [Views](#authentication-monitoring-views)
    - [How to use in big projects](#how-to-use-in-big-projects)
- [Contributors](#contributors)
- [Security](#security)
- [Changelog](#changelog)
- [License](#license)
- [Star History](#start-history)
- [Conclusion](#conclusion)
- [Donate](#donate)

<a name="introduction"></a>
## Introduction

Welcome to the world of enhanced user monitoring with the groundbreaking `Laravel User Monitoring` package! Developed by the brilliant minds at `Binafy`, this innovative open-source solution is designed to empower Laravel developers and website administrators with invaluable insights into user activities.

Tracking user behavior and interactions is now made effortless, allowing you to gain a deeper understanding of your users' engagement, preferences, and pain points. With its seamless integration into Laravel projects, this package opens up a realm of possibilities, enabling you to optimize user experiences, detect bottlenecks, and make data-driven decisions for your platform's success.

Experience real-time monitoring like never before, as you access comprehensive analytics and visualize user interactions with ease. Rest assured, your users' data is handled securely, respecting privacy while giving you the tools to improve your application's performance and user satisfaction.

Whether you are building a new project or looking to enhance an existing one, "Laravel User Monitoring" is the missing piece to elevate your web applications to new heights. So, why wait? Dive into the world of intelligent user monitoring and witness the transformation of your Laravel-powered application today!

<a name="installation"></a>
## Installation

You can install the package with Composer.

```bash
composer require binafy/laravel-user-monitoring
```

## Publish

If you want to publish a config file you can use this command:

```shell
php artisan vendor:publish --tag="laravel-user-monitoring-config"
```

If you want to publish the migrations you can use this command:

```shell
php artisan vendor:publish --tag="laravel-user-monitoring-migrations"
```

If you want to publish the views you can use this command:

```shell
php artisan vendor:publish --tag="laravel-user-monitoring-views"
```

If you want to publish the middleware you can use this command:

```shell
php artisan vendor:publish --tag="laravel-user-monitoring-middlewares"
```

If you want to publish the routes you can use this command:

```shell
php artisan vendor:publish --tag="laravel-user-monitoring-routes"
```

For convenience, you can use this command to publish config, migration, and ... files:

```shell
php artisan vendor:publish --provider="Binafy\LaravelUserMonitoring\Providers\LaravelUserMonitoringServiceProvider"
```

After publishing, run the `php artisan migrate` command.

<a name="usage"></a>
## Usage

The `Laravel-User-Monitoring`, need to use middleware, traits, etc ... and it's not hard, enjoys :)

<a name="configuration"></a>
## Configuration

<a name="routes-configuration"></a>
## Routes Configuration

If you want to customize the routes, you can publish the route file with this command:

```shell
php artisan vendor:publish --tag="laravel-user-monitoring-routes"
```

After, you can go to the `routes/user-monitoring.php` file and customize the routes.

Also, if you want to change the route file name, you can go to the config file and change the `file_path`:

```php
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
```

<a name="user-configuration"></a>
## User Configuration

You can config your user with the `user-monitoring.php` configuration file:

```php
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
```

- `model`: If your user model exists in another place, you can change it to the correct namespace.
- `foreign_key`: You can set the user foreign_key name, like `customer_id`.
- `table`: You can write your users table name if is not `users.
- `guards`: The guards are used to authenticate.
- `foreign_key_type`: The foreign key type (uuid-ulid-id).
- `display_attribute`: The special attribute of user that you want to show in views.

<a name="foreign-key-type-uuid-ulid-id"></a>
### Foreign Key Type (UUID, ULID, ID)

If you are using `uuid` or `ulid`, you can change `foreign_key_type` to your correct foreign key type:

```php
'user' => [
    ...

    /*
     * Specify the type of foreign key being used (e.g., 'id', 'uuid', 'ulid').
     * For non-standard IDs, make sure to add the relevant traits to your models.
     */
    'foreign_key_type' => 'id', // Options: uuid, ulid, id
],
```

> **_NOTE:_**  You must write `uuid` or `ulid` or `id`.

<a name="visit-monitoring"></a>
## Visit Monitoring

When you want to monitor all views of your application, you must follow below:

1. Publish the [Migrations](#publish)

2. Use `VisitMonitoringMiddleware` in Kernel.php, you can go to the `App/Http` folder and open the `Kernel.php` file and add `VisitMonitoringMiddleware` into your middleware for example:
```php
protected $middlewareGroups = [
    'web' => [
        ...
        \Binafy\LaravelUserMonitoring\Middlewares\VisitMonitoringMiddleware::class,
    ],

    'api' => [
        // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],
];
```

After, you can see all pages monitoring :)

If you want to disable monitoring for specific pages you can go to `user-monitoring.php` that exists in the `config` folder and add pages into the `visit_monitoring` key:

```php
'visit_monitoring' => [
    /*
     * List of pages that should be excluded from visit monitoring.
     * Add route names or URL paths to this array if you want to exclude certain pages.
     */
    'except_pages' => [
        'user-monitoring/visits-monitoring',
        'user-monitoring/actions-monitoring',
        'user-monitoring/authentications-monitoring',
    ],
],
```

<a name="delete-visit-monitoring-records-by-specific-days"></a>
### Delete Visit Monitoring Records By Specific Days

You may delete records by specific days, Laravel-User-Monitoring also supports this 🤩.

First, you need to go to the `user-monitoring` config file and highlight the days that you want to delete:

```php
'visit_monitoring' => [
    ...

    /*
     * Set the number of days after which visit records should be automatically deleted.
     * Set to 0 to disable automatic deletion.
     *
     * To enable automatic deletion, configure Laravel's task scheduling as outlined here:
     * https://laravel.com/docs/scheduling
     */
    'delete_days' => 0,
],
```

After, you need to use [Task Scheduling](https://laravel.com/docs/10.x/scheduling) to fire-related command, so go to `app/Console/Kernel.php` and do like this:

```php
<?php

namespace App\Console;

...
use Binafy\LaravelUserMonitoring\Commands\RemoveVisitMonitoringRecordsCommand;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
         $schedule->command(RemoveVisitMonitoringRecordsCommand::class)->hourly();
    }
}
```

You can change `hourly` to `minute` or `second`, for more information you can read [Schedule Frequency Options](https://laravel.com/docs/10.x/scheduling#schedule-frequency-options).

<a name="turn-on-off"></a>
### Turn ON-OFF

Maybe you want to turn off visit monitoring for somedays or always, you can use configuration to turn it off:

```php
'visit_monitoring' => [
    ...

    /*
     * Enable or disable the visit monitoring feature.
     * Set false to disable tracking of user visits.
     */
    'turn_on' => true,
    
    ...
]
```

<a name="visit-monitoring-views"></a>
### Visit Monitoring Views

Laravel-User-Monitoring also has an amazing views that you can use it very easy, just need to go to `/user-monitoring/visits-monitoring` url, and enjoy:

![Visit Monitoring Preview](/art/visits-monitoring/preview.png "Visit Monitoring")

<a name="ajax-requests"></a>
### Ajax Requests

Maybe you may disable record visits for `Ajax` requests, you can use config to disable it:

```php
'visit_monitoring' => [
    ...

    /*
     * Enable or disable monitoring for AJAX requests.
     * Set to false if you do not wish to track AJAX-based page loads.
     */
    'ajax_requests' => true,

    ...
],
```

When set to false, Ajax requests will not be recorded.

<a name="action-monitoring"></a>
## Action Monitoring

If you want to monitor your model actions, you can use the `Actionable` trait in your model:

```php
<?php

namespace App\Models;

use Binafy\LaravelUserMonitoring\Traits\Actionable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Actionable;
}
```

Now when a product is read, created, updated, or deleted, you can see which users doing that.

If you want to disable some actions like created, you can use the config file:

```php
'action_monitoring' => [
    ...
    
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
],
```

<a name="action-monitoring-views"></a>
### Action Monitoring Views

`Laravel-User-Monitoring` also has amazing views that you can use very easily, just need to go to the `/user-monitoring/actions-monitoring` URL, and enjoy:

![Action Monitoring Preview](/art/actions-monitoring/preview.png "Action Monitoring")

<a name="authentication-monitoring"></a>
## Authentication Monitoring

Have you ever thought about monitoring the entry and exit of users of your application? Now you can :) <br>
If you want to monitor users when logging in or logout of your application, you need to migrate the migrations to the config file and change true for monitoring authentication.

```php
'authentication_monitoring' => [
    ...

    /*
     * You can set true/false for monitor login or logout. 
     */
    'on_login' => true,
    'on_logout' => true,
],
```

<a name="action-monitoring-reverse-proxy-config"></a>
### Action Monitoring Reverse Proxy Config

If you are using Reverse Proxy (Nginx or Cloudflare), you can use config to get real IP from a specific header like `X-Real-IP` or `X-Forwarded-For`:

```php
/** 
*   Determines if the application should use reverse proxy headers to fetch the real client IP
*   If set to true, it will try to get the IP from the specified header (X-Real-IP or X-Forwarded-For)
*   This is useful when using reverse proxies like Nginx or Cloudflare.
 */
'use_reverse_proxy_ip' => true,
'real_ip_header' => 'X-Forwarded-For',
```

<a name="authentication-monitoring-views"></a>
### Authentication Monitoring Views

`Laravel-User-Monitoring` also has amazing views that you can use very easily, need to go to the `/user-monitoring/authentications-monitoring` URL, and enjoy:

![Authentication Monitoring Preview](/art/authentications-monitoring/preview.png "Authentication Monitoring")

<a name="how-to-use-in-big-projects"></a>
## How to use in big projects

If you want to use `Laravel-User-Monitoring` for big projects, you have lots of ways, but I want to give some tips and ideas to help you:

> If you have an idea for this section you can create [PRs](https://github.com/binafy/laravel-user-monitoring/pulls) or [issues](https://github.com/binafy/laravel-user-monitoring/issues) to help us.

1. You can use this package with [Cache](https://laravel.com/docs/10.x/cache)
2. You can make a separate DB and connect to your project to separate monitoring and application.

<a name="contributors"></a>
## Contributors

Thanks to all the people who contributed. [Contributors](https://github.com/binafy/laravel-user-monitoring/graphs/contributors).

<a href="https://github.com/binafy/laravel-user-monitoring/graphs/contributors"><img src="https://opencollective.com/laravel-user-monitoring/contributors.svg?width=890&button=false" /></a>

<a name="security"></a>
## Security

If you discover any security-related issues, please email `binafy23@gmail.com` instead of using the issue tracker.

<a name="chanelog"></a>
## Changelog

The changelog can be found in the `CHANGELOG.md` file of the GitHub repository. It lists the changes, bug fixes, and improvements made to each version of the Laravel User Monitoring package.

<a name="license"></a>
## License

The MIT License (MIT). Please see [License File](https://github.com/binafy/laravel-user-monitoring/blob/1.x/LICENSE) for more information.

<a name="start-history"></a>
## Star History

[![Star History Chart](https://api.star-history.com/svg?repos=binafy/laravel-user-monitoring&type=Date)](https://star-history.com/#binafy/laravel-user-monitoring&Date)

<a name="conclusion"></a>
## Conclusion

Congratulations! You have successfully installed and integrated the Laravel User Monitoring package into your Laravel application. By effectively logging and analyzing user activity, you can gain valuable insights that can help you improve your application's user experience and performance. If you have any questions or need further assistance, please refer to the documentation or seek help from the package's GitHub repository. Happy monitoring!

<a name="donate"></a>
## Donate

If this package is helpful for you, you can buy a coffee for me :) ❤️

- Iraninan Gateway: https://daramet.com/milwad_khosravi
- Paypal Gateway: SOON
- MetaMask Address: `0xf208a562c5a93DEf8450b656c3dbc1d0a53BDE58`
