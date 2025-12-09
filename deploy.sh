#!/bin/bash
set -e

echo "🚀 Starting deployment..."

# Clear caches
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Generate application key if not exists
if [ -z "$APP_KEY" ]; then
  echo "Generating APP_KEY..."
  php artisan key:generate --force
fi

# Run migrations
echo "Running migrations..."
php artisan migrate --force --no-interaction

# Seed database if needed
echo "Seeding database..."
php artisan db:seed --force --no-interaction || true

# Optimize for production
echo "Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment completed!"
