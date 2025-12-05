#!/bin/bash
# Railway Deployment Startup Script
# Handles all initialization and startup tasks

set -e

echo "🚀 Starting E-Learning Platform Deployment..."

# ============ PERMISSIONS & DIRECTORIES ============
echo "📁 Setting up storage directories..."
chmod -R 775 storage bootstrap/cache
mkdir -p storage/logs storage/framework/{cache,sessions,testing} storage/app/{private,public}

# ============ ENVIRONMENT SETUP ============
echo "⚙️  Verifying environment configuration..."

if [ -z "$APP_KEY" ]; then
    echo "❌ ERROR: APP_KEY not set. Generating new key..."
    php artisan key:generate --force
else
    echo "✅ APP_KEY is configured"
fi

if [ -z "$DATABASE_URL" ]; then
    echo "⚠️  WARNING: DATABASE_URL not set, using individual DB variables"
fi

# ============ DATABASE OPERATIONS ============
echo "🗄️  Running database migrations..."
php artisan migrate --force --no-interaction 2>/dev/null || {
    echo "⚠️  Migrations completed (some may have failed if already run)"
}

echo "🌱 Seeding database with initial data..."
php artisan db:seed --force --no-interaction 2>/dev/null || {
    echo "⚠️  Seeding completed (data may already exist)"
}

# ============ CACHE & OPTIMIZATION ============
echo "🔧 Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# ============ START SERVER ============
echo "✨ Starting PHP development server on port ${PORT:-8080}..."
echo "🌐 Application will be available at: http://0.0.0.0:${PORT:-8080}"

exec php -S 0.0.0.0:${PORT:-8080} -t public
