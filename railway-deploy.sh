#!/bin/bash

# Railway Deployment Script for Laravel
# This script runs during deployment on Railway

echo "🚀 Starting Railway Deployment..."

# Install Composer dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Generate application key
echo "🔑 Generating application key..."
php artisan key:generate --force

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Seed database
echo "🌱 Seeding database..."
php artisan db:seed --force

# Clear caches
echo "🧹 Clearing caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage symlink
echo "📁 Creating storage symlink..."
php artisan storage:link || true

echo "✅ Deployment completed successfully!"
