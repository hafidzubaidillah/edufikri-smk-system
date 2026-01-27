#!/bin/bash

echo "Starting Laravel application with Apache"

# Run migrations
php artisan migrate --force

# Clear and cache config
php artisan config:clear
php artisan config:cache

# Clear and cache routes
php artisan route:clear
php artisan route:cache

# Clear view cache
php artisan view:clear

# Create storage link if it doesn't exist
php artisan storage:link

# Start Apache in foreground
apache2-foreground