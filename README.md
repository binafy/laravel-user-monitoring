## Laravel User Monitoring

<img src="https://banners.beyondco.de/Laravel%20User%20Monitoring.png?theme=dark&packageManager=composer+require&packageName=binafy%2Flaravel-user-monitoring&pattern=volcanoLamp&style=style_1&description=Monitor+your+user+and+all+activity+on+your+application&md=1&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" alt="laravel-user-monitoring-banner">

[![PHP Version Require](http://poser.pugx.org/binafy/laravel-user-monitoring/require/php)](https://packagist.org/packages/binafy/laravel-user-monitoring)
[![Latest Stable Version](http://poser.pugx.org/binafy/laravel-user-monitoring/v)](https://packagist.org/packages/binafy/laravel-user-monitoring)
[![Total Downloads](http://poser.pugx.org/binafy/laravel-user-monitoring/downloads)](https://packagist.org/packages/binafy/laravel-user-monitoring)
[![License](http://poser.pugx.org/binafy/laravel-user-monitoring/license)](https://packagist.org/packages/binafy/laravel-user-monitoring)
[![Passed Tests](https://github.com/binafy/laravel-user-monitoring/actions/workflows/tests.yml/badge.svg)](https://github.com/binafy/laravel-user-monitoring/actions/workflows/tests.yml)

- [Introduction](#introduction)
- [Installation](#installation)
- [Usage](#usage)
  - [Visit Monitoring](#visit-monitoring)
  - [Action Monitoring](#action-monitoring)
  - [Authentication Monitoring](#authentication-monitoring)
- [Contributors](#contributors)
- [Security](#security)
- [License](#license)

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

<a name="visit-monitoring"></a>
## Visit Monitoring


<a name="action-monitoring"></a>
## Action Monitoring


<a name="authentication-monitoring"></a>
## Authentication Monitoring


<a name="contributors"></a>
## Contributors

Thanks to all the people who contribute. [Contributors](https://github.com/binafy/laravel-user-monitoring/graphs/contributors).

<a href="https://github.com/binafy/laravel-user-monitoring/graphs/contributors"><img src="https://opencollective.com/laravel-user-monitoring/contributors.svg?width=890&button=false" /></a>

<a name="security"></a>
## Security

If you discover any security-related issues, please email `binafy23@gmail.com` instead of using the issue tracker.

<a name="license"></a>
## License

The MIT License (MIT). Please see [License File](https://github.com/binafy/laravel-user-monitoring/blob/0.x-dev/LICENSE) for more information.
