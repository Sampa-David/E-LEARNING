#!/bin/bash
# Quick test to check asset loading issues

echo "Testing asset files..."
echo ""

# Check if files exist
if [ -f "public/assets/css/main.css" ]; then
    echo "✅ main.css exists ($(stat -f%z public/assets/css/main.css 2>/dev/null || stat -c%s public/assets/css/main.css 2>/dev/null) bytes)"
else
    echo "❌ main.css NOT FOUND"
fi

if [ -f "public/assets/vendor/bootstrap/css/bootstrap.min.css" ]; then
    echo "✅ bootstrap.min.css exists"
else
    echo "❌ bootstrap.min.css NOT FOUND"
fi

# Check directory structure
echo ""
echo "Directory structure:"
find public/assets -type f -name "*.css" | head -10

echo ""
echo "✅ Asset test complete"
