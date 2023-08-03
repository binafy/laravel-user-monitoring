## Laravel User Monitoring

<img src="https://banners.beyondco.de/Laravel%20User%20Monitoring.png?theme=dark&packageManager=composer+require&packageName=binafy%2Flaravel-user-monitoring&pattern=volcanoLamp&style=style_1&description=Monitor+your+user+and+all+activity+on+your+application&md=1&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" alt="laravel-user-monitoring-banner">

[![PHP Version Require](http://poser.pugx.org/binafy/laravel-user-monitoring/require/php)](https://packagist.org/packages/binafy/laravel-user-monitoring)
[![Latest Stable Version](http://poser.pugx.org/binafy/laravel-user-monitoring/v)](https://packagist.org/packages/binafy/laravel-user-monitoring)
[![Total Downloads](http://poser.pugx.org/binafy/laravel-user-monitoring/downloads)](https://packagist.org/packages/binafy/laravel-user-monitoring)
[![License](http://poser.pugx.org/binafy/laravel-user-monitoring/license)](https://packagist.org/packages/binafy/laravel-user-monitoring)
[![Passed Tests](https://github.com/binafy/laravel-user-monitoring/actions/workflows/tests.yml/badge.svg)](https://github.com/binafy/laravel-user-monitoring/actions/workflows/tests.yml)

- [Introduction](#introduction)
- [Installation](#installation)
- Usage
  - [User Configuration](#user-configuration)
    - [Foreign Key Type (UUID, ULID, ID)](#foreign-key-type-uuid-ulid-id)
  - [Visit Monitoring](#visit-monitoring)
    - [Delete Visit Monitoring Records By Specific Days](#delete-visit-monitoring-records-by-specific-days)
    - [Turn ON-OFF](#turn-on-off)
  - [Action Monitoring](#action-monitoring)
  - [Authentication Monitoring](#authentication-monitoring)
- [Contributors](#contributors)
- [Security](#security)
- [Changelog](#changelog)
- [License](#license)
- [Conclusion](#conclusion)

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

If you want to publish a migration files you can use this command:

```shell
php artisan vendor:publish --tag="laravel-user-monitoring-migrations"
```

For convience, you can use this command to publish config and migration files:

```shell
php artisan vendor:publish --provider="Binafy\LaravelUserMonitoring\Providers\LaravelUserMonitoringServiceProvider"
```

After publishing, run `php artisan migrate` command.

<a name="user-configuration"></a>
## User Configuration

You can config your user with `user-monitoring.php` configuration file:

```php
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
     * If you are using uuid or ulid you can change it for type of foreign_key.
     *
     * When you are using ulid or uuid, you need to add related trait into the models.
     */
    'foreign_key_type' => 'id', // uuid, ulid, id
],
```

- `model`: If your user model is exists in another place, you can change it to correct namespace.
- `foreign_key`: You can set the user foreign_key name, like `customer_id`.
- `table`: You can write your users table name if is not `users.
- `guard`: The correct guard that using for user.

<a name="foreign-key-type-uuid-ulid-id"></a>
### Foreign Key Type (UUID, ULID, ID)

If you are using `uuid` or `ulid`, you can change `foreign_key_type` to your correct foreign key type:

```php
'user' => [
    ...

    /*
     * If you are using uuid or ulid you can change it for type of foreign_key.
     *
     * When you are using ulid or uuid, you need to add related trait into the models.
     */
    'foreign_key_type' => 'uuid', // uuid, ulid, id
],
```

> **_NOTE:_**  You must write `uuid` or `ulid` or `id`.

<a name="visit-monitoring"></a>
## Visit Monitoring

When you want to monitor all views of your application, you must follow below:

1. Publish the [Migrations](#publish)

2. Use `VisitMonitoringMiddleware` in Kernel.php, you can go to `App/Http` folder and open the `Kernel.php` file and add `VisitMonitoringMiddleware` into your middleware for example:
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

If you want to disable monitoring for specific pages you can go to `user-monitoring.php` that exists in `config` folder and add pages into `visit_monitoring` key:

```php
'visit_monitoring' => [
    /*
     * You can specify pages not to be monitored.
     */
    'expect_pages' => [
        'home',
        'admin/dashboard',
    ],
],
```

<a name="delete-visit-monitoring-records-by-specific-days"></a>
### Delete Visit Monitoring Records By Specific Days

You may to delete records by specific days, Laravel-User-Monitoring also support this 🤩.

First, you need go to `user-monitoring` config file and highlighting the days that you want to delete:

```php
'visit_monitoring' => [
    ...

    /*
     * If you want to delete visit rows after some days, you can change this like 360,
     * but you don't like to delete rows you can change it to 0.
     *
     * For this feature you need Task-Scheduling => https://laravel.com/docs/10.x/scheduling
     */
    'delete_days' => 10,
],
```

After, you need to use [Task Scheduling](https://laravel.com/docs/10.x/scheduling) to fire related command, so go to `app/Console/Kernel.php` and do like this:

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

Maybe you want to turn off visit monitoring for somedays or always, you can use configuration to turn off:

```php
'visit_monitoring' => [
    ...

    /*
     * If you want to disable visit monitoring, you can change it to false.
     */
    'turn_on' => true,
    
    ...
]
```

<a name="action-monitoring"></a>
## Action Monitoring

If you want to monitor your models actions, you can use `Actionable` trait into your model:

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

Now when a product readed, created, updated or deleted, you can see which users doing that.

If you want to disable some action like created, you can use config file:

```php
'action_monitoring' => [
    ...
    
    /*
     * Monitor actions.
     *
     * You can set true/false for monitor actions like (store, update, and ...).
     */
    'on_store'      => false,
    'on_update'     => true,
    'on_destroy'    => true,
    'on_read'       => true,
    'on_restore'    => false,
    'on_replicate'  => false,
],
```

<a name="authentication-monitoring"></a>
## Authentication Monitoring

Have you ever thought about monitoring the entry and exit of users of your application? Now you can :) <br>
If you want to monitor users when login or logout in your application, you need migrate the migrations and go to config file and change true for monitoring authentication.

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

<a name="contributors"></a>
## Contributors

Thanks to all the people who contribute. [Contributors](https://github.com/binafy/laravel-user-monitoring/graphs/contributors).

<a href="https://github.com/binafy/laravel-user-monitoring/graphs/contributors"><img src="https://opencollective.com/laravel-user-monitoring/contributors.svg?width=890&button=false" /></a>

<a name="security"></a>
## Security

If you discover any security-related issues, please email `binafy23@gmail.com` instead of using the issue tracker.

<a name="chanelog"></a>
## Changelog

The changelog can be found in the `CHANGELOG.md` file of the GitHub repository. It lists the changes, bug fixes, and improvements made to each version of the Laravel User Monitoring package.

<a name="license"></a>
## License

The MIT License (MIT). Please see [License File](https://github.com/binafy/laravel-user-monitoring/blob/0.x-dev/LICENSE) for more information.

<a name="conclusion"></a>
## Conclusion

Congratulations! You have successfully installed and integrated the Laravel User Monitoring package into your Laravel application. By effectively logging and analyzing user activity, you can gain valuable insights that can help you improve your application's user experience and performance. If you have any questions or need further assistance, feel free to refer to the documentation or seek help from the package's GitHub repository. Happy monitoring!
