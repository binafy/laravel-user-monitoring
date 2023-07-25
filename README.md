## Laravel User Monitoring

<img src="https://banners.beyondco.de/Laravel%20User%20Monitoring.png?theme=dark&packageManager=composer+require&packageName=binafy%2Flaravel-user-monitoring&pattern=volcanoLamp&style=style_1&description=Monitor+your+user+and+all+activity+on+your+application&md=1&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" alt="laravel-user-monitoring-banner">

[![PHP Version Require](http://poser.pugx.org/binafy/laravel-user-monitoring/require/php)](https://packagist.org/packages/binafy/laravel-user-monitoring)
[![Latest Stable Version](http://poser.pugx.org/binafy/laravel-user-monitoring/v)](https://packagist.org/packages/binafy/laravel-user-monitoring)
[![Total Downloads](http://poser.pugx.org/binafy/laravel-user-monitoring/downloads)](https://packagist.org/packages/binafy/laravel-user-monitoring)
[![License](http://poser.pugx.org/binafy/laravel-user-monitoring/license)](https://packagist.org/packages/binafy/laravel-user-monitoring)
[![Passed Tests](https://github.com/binafy/laravel-user-monitoring/actions/workflows/tests.yml/badge.svg)](https://github.com/binafy/laravel-user-monitoring/actions/workflows/tests.yml)

# Installation

You can install the package with Composer.

```bash
composer require binafy/laravel-user-monitoring
```

# Publish

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
