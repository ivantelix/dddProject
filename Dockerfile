# Dockerfile
FROM php:8.1-apache

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git && \
    docker-php-ext-install pdo pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar composer.json y composer.lock primero para aprovechar el caché
COPY composer.json ./

# Instalar dependencias PHP
RUN composer install

# Copiar el resto del proyecto
COPY . .

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite

# Configuración de Apache
EXPOSE 80