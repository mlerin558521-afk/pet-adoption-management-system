#!/bin/bash
set -e

echo "🔧 Clearing old caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "🔗 Creating storage symlink..."
php artisan storage:link || true

echo "📦 Running migrations..."
php artisan migrate --force || true

echo "⚡ Caching config for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "🚀 Starting Apache..."
exec apache2-foreground