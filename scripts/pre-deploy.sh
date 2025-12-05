#!/bin/bash
# Pre-deploy initialization script for Railway

echo "🔧 Initializing Laravel application for Railway..."

# Create required directories
mkdir -p storage/logs
mkdir -p storage/framework/{cache,sessions,testing}
mkdir -p storage/app/{private,public}

# Set permissions
chmod -R 775 storage bootstrap/cache

# Generate APP_KEY if not exists
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating APP_KEY..."
    php artisan key:generate --force
else
    echo "✅ APP_KEY already configured"
fi

# Run migrations
echo "🗄️  Running database migrations..."
php artisan migrate --force --no-interaction || echo "⚠️  Migrations skipped or already run"

# Seed database
echo "🌱 Seeding database..."
php artisan db:seed --force --no-interaction || echo "⚠️  Seeding skipped or already run"

# Cache configuration
echo "⚡ Caching configuration..."
php artisan config:cache
php artisan route:cache

echo "✅ Initialization complete!"
