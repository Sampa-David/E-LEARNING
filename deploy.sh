#!/bin/bash
set -e

echo "🚀 Starting deployment..."

# Create or update .env file with Railway environment variables
echo "Configuring environment variables..."
cat > .env << EOF
APP_NAME=${APP_NAME:-"E-Learning"}
APP_ENV=${APP_ENV:-"production"}
APP_KEY=${APP_KEY}
APP_DEBUG=${APP_DEBUG:-"false"}
APP_URL=${APP_URL:-"https://learning-online.up.railway.app"}

# Database - Use proxy URL (not internal host)
DB_CONNECTION=mysql
DB_HOST=${DB_HOST:-"maglev.proxy.rlwy.net"}
DB_PORT=${DB_PORT:-"38036"}
DB_DATABASE=${DB_DATABASE:-"railway"}
DB_USERNAME=${DB_USERNAME:-"root"}
DB_PASSWORD=${DB_PASSWORD}

# Cache & Session
CACHE_STORE=${CACHE_STORE:-"database"}
SESSION_DRIVER=${SESSION_DRIVER:-"database"}
SESSION_ENCRYPT=${SESSION_ENCRYPT:-"true"}
SESSION_LIFETIME=${SESSION_LIFETIME:-"120"}

# Logging
LOG_CHANNEL=${LOG_CHANNEL:-"stack"}
LOG_LEVEL=${LOG_LEVEL:-"info"}

# Other
BROADCAST_CONNECTION=${BROADCAST_CONNECTION:-"log"}
QUEUE_CONNECTION=${QUEUE_CONNECTION:-"sync"}
FILESYSTEM_DISK=${FILESYSTEM_DISK:-"local"}
EOF

echo "✅ Environment file created with Railway variables"

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
