#!/bin/bash

composer install
php artisan migrate --force
php artisan serve --host=0.0.0.0 --port=8000

php-fpm
