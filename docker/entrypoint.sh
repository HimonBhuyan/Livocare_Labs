#!/bin/bash
set -e

# Configure Apache port based on Render's PORT environment variable
PORT="${PORT:-80}"
sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf 2>/dev/null || true
sed -i "s/:80>/:$PORT>/g" /etc/apache2/sites-available/000-default.conf 2>/dev/null || true

# Ensure .env file exists in the container
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Set or generate APP_KEY
if [ -n "$APP_KEY" ]; then
    sed -i "s|^APP_KEY=.*|APP_KEY=$APP_KEY|g" .env
elif ! grep -q "^APP_KEY=base64:" .env; then
    php artisan key:generate --force || true
fi

# Ensure storage directories, database, and permissions
mkdir -p database storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs
touch database/database.sqlite
chown -R www-data:www-data storage bootstrap/cache database
chmod -R 775 storage bootstrap/cache database
chmod 664 database/database.sqlite

# Ensure storage link exists
php artisan storage:link || true

# Run database migrations and seed initial medical packages
php artisan migrate --force --seed || true

# Clear cached configs to reflect runtime environment variables
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true
php artisan route:clear || true

echo "Starting Apache on port $PORT..."
exec apache2-foreground
