# Usamos una imagen oficial de PHP con Apache
FROM php:8.2-apache

# 1. Instalar dependencias del sistema necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# 2. Limpiar caché del gestor de paquetes
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Instalar extensiones de PHP requeridas por Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 4. Habilitar el módulo de reescritura de Apache (vital para las rutas de Laravel)
RUN a2enmod rewrite

# 5. Configurar el directorio de trabajo
WORKDIR /var/www/html

# 6. Copiar los archivos del proyecto al contenedor
COPY . .

# 7. Instalar Composer (herramienta de dependencias de PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 8. Configurar Apache para que apunte a la carpeta /public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 9. Dar permisos a las carpetas de almacenamiento y caché
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 10. Exponer el puerto que usa Render (por defecto 80 o el que asignen)
EXPOSE 80

# 11. Comando final: Migrar base de datos y encender Apache
# El flag --force es obligatorio en producción
CMD php artisan migrate --force && apache2-foreground