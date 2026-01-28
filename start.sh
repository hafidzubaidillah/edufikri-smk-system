#!/usr/bin/env bash
# Start script for Render deployment

echo "🚀 Starting application..."

# Run database migrations
echo "📊 Running database migrations..."
php artisan migrate --force

# Seed database with admin user
echo "🌱 Seeding database..."
php artisan db:seed --class=ProductionSeeder --force

# Clear and cache config for production
echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the server
echo "🌐 Starting web server..."
php artisan serve --host=0.0.0.0 --port=$PORT