#!/bin/bash

echo "🚀 Starting deployment..."

# Pull latest changes
echo "🔄 Pulling latest changes from Git..."
git pull origin main

# Install/update dependencies
# echo "📦 Installing dependencies..."
# composer install --no-dev --optimize-autoloader

# Clear and cache Laravel stuff
echo "⚙️ Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment complete!"
