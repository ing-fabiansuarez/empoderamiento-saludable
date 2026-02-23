FROM php:8.2-apache

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    libpng-dev zlib1g-dev libxml2-dev zip unzip

# Extensiones PHP necesarias para Laravel
RUN docker-php-ext-install pdo_mysql bcmath gd

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Copiar el proyecto
COPY . /var/www/html

# Configurar el DocumentRoot de Apache a la carpeta /public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# Instalar Composer y dependencias
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache