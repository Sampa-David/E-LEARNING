#!/bin/bash

# This script is run by Railway during deployment
# Set this as the "Start Command" in Railway dashboard

# Ensure the app directory is writable
chmod -R 775 storage bootstrap/cache

# Run migrations
php artisan migrate --force

# Seed the database
php artisan db:seed --force

# Start the application
php artisan serve --host=0.0.0.0 --port=${PORT:-3000}
