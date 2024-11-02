# [Laravel Application](https://laravel.com/docs/11.x/deployment)

This application use laravel 11 to create a modern web application using Next.JS & Tailwind. Jetstream handles authentication and we'll use filament to build the website.

# [PHP extensions](./php-extensions)


# Filament

[Official Panels Install Docs](https://filamentphp.com/docs/3.x/panels/installation)

## Installation

```shell
composer require filament/filament:"^3.2" -W
 
php artisan filament:install --panels 
```

## Create a User

the below command will create an admin user and write it to db

```shell
php artisan make:filament-user
```

Open /admin in your web browser, sign in, and start building your app!


# self hosting runners for arm builds.

# [Docker Setup](./docker)

# Kubernetes Example Setup