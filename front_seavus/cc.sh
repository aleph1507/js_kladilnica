#!/usr/bin/env bash
php artisan cache:clear
php artisan route:cache
php artisan view:clear
composer dumpautoload
php artisan config:cache
