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

echo "Starting Laravel with APP_URL=$APP_URL"

# Run migrations if on production
if [ "$APP_ENV" = "production" ]; then
    echo "Running migrations..."
    php artisan migrate --force --no-interaction
    echo "Migrations completed!"
fi

# Run PHP built-in server
php -S 0.0.0.0:${PORT:-8080} -t public
