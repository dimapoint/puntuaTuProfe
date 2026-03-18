# Etapa 1: Compilar Assets (Vite / Tailwind CSS 4)
FROM node:20-alpine as assets
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Etapa 2: Servidor PHP 8.3 + Nginx
FROM php:8.3-fpm-alpine

# Instalar dependencias esenciales del sistema para extensiones de PHP
RUN apk add --no-cache \
    nginx \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    oniguruma-dev \
    libxml2-dev \
    icu-dev

# Instalar extensiones de PHP comunes en Laravel
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd intl

# Directorio de trabajo
WORKDIR /var/www/html

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar el código fuente y los assets compilados
COPY . .
COPY --from=assets /app/public/build ./public/build

# Instalar dependencias de producción (omitiendo tests y desarrollo)
RUN composer install --no-dev --optimize-autoloader

# Ajustar permisos para carpetas de caché y storage
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configuración personalizada de Nginx
COPY docker/nginx.conf /etc/nginx/http.d/default.conf

# Exponer puerto 80
EXPOSE 80

# Comando de inicio: Limpia caché, cachea configuraciones y arranca servicios
CMD ["sh", "-c", "php artisan config:cache && php artisan route:cache && php artisan view:cache && nginx && php-fpm"]
