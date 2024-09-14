#!/bin/bash

if [ ! -f /var/www/html/database/database.sqlite ]; then
touch /var/www/html/database/database.sqlite
fi

php artisan migrate --force
php artisan serve --host=0.0.0.0 --port=8000

php-fpm
