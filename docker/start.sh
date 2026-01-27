#!/bin/bash
set -e

echo "Starting Laravel application..."

# Run migrations
php artisan migrate --force
echo "Migrations completed"

# Cache configuration
php artisan config:cache
echo "Config cached"

# Cache routes
php artisan route:cache
echo "Routes cached"

echo "Starting services..."

# Start PHP-FPM in background
php-fpm &

# Start Nginx in foreground
exec nginx -g "daemon off;"