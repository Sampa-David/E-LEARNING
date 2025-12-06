#!/bin/bash

# Get the Railway domain from the request host or use default
# Railway provides RAILWAY_PUBLIC_DOMAIN or we can construct from environment
if [ -n "$RAILWAY_PUBLIC_DOMAIN" ]; then
    APP_URL="https://$RAILWAY_PUBLIC_DOMAIN"
else
    # Fallback: Try to get from X-Forwarded-Host or use localhost
    APP_URL="${APP_URL:-http://localhost:${PORT:-8080}}"
fi

# Export the URL for PHP server to use
export APP_URL

echo "=========================================="
echo "🚀 Starting Laravel E-Learning Platform"
echo "=========================================="
echo "APP_URL=$APP_URL"
echo "APP_ENV=$APP_ENV"
echo "PORT=${PORT:-8080}"
echo ""

# Run migrations if on production
if [ "$APP_ENV" = "production" ]; then
    echo "=========================================="
    echo "🔄 Running Database Migrations..."
    echo "=========================================="
    php artisan migrate --force --no-interaction
    MIGRATE_STATUS=$?
    
    if [ $MIGRATE_STATUS -eq 0 ]; then
        echo "✅ Migrations completed successfully!"
    else
        echo "❌ Migrations failed with status code: $MIGRATE_STATUS"
    fi
    echo ""
else
    echo "⏭️  Skipping migrations (not in production)"
    echo ""
fi

echo "=========================================="
echo "🌐 Starting PHP Server on 0.0.0.0:${PORT:-8080}"
echo "=========================================="
echo ""

# Run PHP built-in server
php -S 0.0.0.0:${PORT:-8080} -t public
