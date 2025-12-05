#!/bin/bash
# Post-install script for Railway
# This runs automatically after dependencies are installed

echo "🔧 Configuring Laravel for Railway deployment..."

# Ensure directories exist and have correct permissions
mkdir -p storage/logs storage/framework/{cache,sessions,testing}
chmod -R 775 storage bootstrap/cache

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    echo "📝 Generating APP_KEY..."
    php artisan key:generate --force
fi

echo "✅ Post-install configuration complete!"
