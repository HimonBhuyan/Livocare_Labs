#!/bin/bash
set -e

# Configure Apache port based on Render's PORT environment variable
PORT="${PORT:-80}"
sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf 2>/dev/null || true
sed -i "s/:80>/:$PORT>/g" /etc/apache2/sites-available/000-default.conf 2>/dev/null || true

# Generate APP_KEY if not provided
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force || true
fi

# Ensure storage link
php artisan storage:link || true

# Ensure permissions
chown -R www-data:www-data storage bootstrap/cache database 2>/dev/null || true
chmod -R 775 storage bootstrap/cache database 2>/dev/null || true

# Database setup
if [ "$DB_CONNECTION" = "sqlite" ] || [ -z "$DB_CONNECTION" ]; then
    touch database/database.sqlite
    chown www-data:www-data database/database.sqlite
    chmod 664 database/database.sqlite
    php artisan migrate --force --seed || true
else
    php artisan migrate --force || true
fi

# Clear and optimize cache
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "Starting Apache on port $PORT..."
exec apache2-foreground
