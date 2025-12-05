#!/bin/bash

# Pre-deployment checklist for Railway

echo "🔍 Running pre-deployment checks..."

# Check PHP version
echo "✓ PHP Version:"
php -v

# Check Composer
echo "✓ Composer version:"
composer --version

# Check Node.js (if needed)
if command -v node &> /dev/null; then
    echo "✓ Node version:"
    node -v
    echo "✓ NPM version:"
    npm -v
fi

# Check if .env exists
if [ -f .env ]; then
    echo "✓ .env file exists"
else
    echo "✗ .env file not found"
    exit 1
fi

# Check if APP_KEY is set
if grep -q "APP_KEY=base64:" .env; then
    echo "✓ APP_KEY is set"
else
    echo "⚠ APP_KEY might not be properly set"
fi

# Check if git is initialized
if [ -d .git ]; then
    echo "✓ Git repository initialized"
else
    echo "✗ Git repository not found"
    exit 1
fi

# Check database configuration
if grep -q "DB_CONNECTION=pgsql" .env; then
    echo "✓ PostgreSQL configured"
else
    echo "⚠ PostgreSQL not configured in .env"
fi

# Check composer.lock
if [ -f composer.lock ]; then
    echo "✓ composer.lock exists"
else
    echo "⚠ composer.lock not found - running composer install"
    composer install --no-dev --optimize-autoloader
fi

# Check storage permissions
if [ -d storage ]; then
    echo "✓ storage directory exists"
    chmod -R 775 storage bootstrap/cache
else
    echo "✗ storage directory not found"
    exit 1
fi

echo ""
echo "✅ All pre-deployment checks passed!"
echo ""
echo "Next steps:"
echo "1. Push to GitHub: git push origin main"
echo "2. Create Railway project and connect GitHub repo"
echo "3. Add PostgreSQL plugin"
echo "4. Set environment variables"
echo "5. Deploy!"
