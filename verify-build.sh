#!/bin/bash
# Post-build verification script
# Ensure build artifacts are created

echo "🔍 Checking build artifacts..."

# Check if build directory exists
if [ ! -d "public/build" ]; then
    echo "❌ Build directory not found! Running npm build..."
    npm install
    npm run build
else
    echo "✅ Build directory exists"
    ls -la public/build/
fi

# Verify manifest.json exists
if [ ! -f "public/build/manifest.json" ]; then
    echo "⚠️  WARNING: manifest.json not found!"
    echo "Running fresh build..."
    rm -rf node_modules package-lock.json
    npm install --production=false
    npm run build
fi

echo "✅ Build verification complete"
