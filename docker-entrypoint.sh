#!/bin/bash
set -e

echo "==> Generando APP_KEY si no existe..."
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

echo "==> Ejecutando migraciones..."
php artisan migrate --force

echo "==> Ejecutando seeders..."
php artisan db:seed --force

echo "==> Cacheando configuración, rutas y vistas..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Iniciando Apache..."
exec apache2-foreground
