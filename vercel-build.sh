#!/bin/bash

echo "Building for Vercel deployment..."

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Install Node dependencies and build assets
npm install
npm run build

# Clear and optimize Laravel
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "Build completed!"