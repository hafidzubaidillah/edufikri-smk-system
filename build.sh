#!/bin/bash

echo "Building Laravel for Vercel..."

# Install Composer dependencies
composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies
npm ci

# Build assets
npm run build

# Clear Laravel caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "Build completed successfully!"