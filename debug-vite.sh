#!/bin/bash
# Vite Build Debug Script
# Manually build and verify Vite assets

echo "🎨 Vite Build Debug"
echo "===================="

echo "📦 Installing npm dependencies..."
npm ci --omit=dev

echo "🔨 Building assets with Vite..."
npm run build

echo "📂 Checking output..."
echo ""
echo "Public directory:"
ls -la public/

echo ""
echo "Build directory:"
ls -la public/build/ 2>/dev/null || echo "❌ No build directory!"

echo ""
echo "Manifest file:"
cat public/build/manifest.json 2>/dev/null || echo "❌ No manifest.json!"

echo ""
echo "✅ Build debug complete"
