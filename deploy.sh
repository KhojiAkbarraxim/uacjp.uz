#!/bin/bash
# Production deploy script for uacjp.uz
# Usage: ./deploy.sh

set -e

echo "🚀 Starting deployment..."

cd /home/uacjpuz/laravel_app

# 1. Pull latest code from GitHub
echo "📥 Pulling latest code..."
git pull origin main

# 2. Install dependencies (no dev)
echo "📦 Installing dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# 3. Run database migrations
echo "🗄 Running migrations..."
php artisan migrate --force

# 4. Cache configuration and views for performance
echo "⚡ Caching configuration and views..."
php artisan config:cache
php artisan view:cache
php artisan route:cache

# 5. Clear any other caches
echo "🧹 Clearing caches..."
php artisan cache:clear

# 6. Rebuild assets (optional, if assets changed)
echo "🎨 Rebuilding assets..."
npm run build || echo "⚠️ npm build skipped (frontend assets may be unchanged)"

echo "✅ Deployment completed successfully!"
