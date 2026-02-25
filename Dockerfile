# Usamos PHP 8.2 con Apache
FROM php:8.2-apache

# 1. Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl

# 2. Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip

# Habilitar mod_rewrite para las rutas de Laravel
RUN a2enmod rewrite

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Configurar Apache para apuntar a /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Permisos de carpetas para Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Puerto de Render
EXPOSE 80

# Comando de inicio: Optimización de caché + Migraciones + Servidor
CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    apache2-foreground