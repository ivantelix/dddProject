# Usar la imagen oficial de PHP con Apache
FROM php:8.3-apache

# Instalar dependencias necesarias (si las hay)
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git && \
    docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get install -y nano


# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto al contenedor
COPY . /var/www/html/

# Copiar el archivo de configuración de Apache para suprimir el mensaje de error
COPY docker/apache/ddd_test.conf /etc/apache2/sites-available/ddd_test.conf

# Habilitar el sitio en Apache
RUN a2ensite ddd_test.conf

# Deshabilitar el sitio por defecto
RUN a2dissite 000-default.conf

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Habilitar mod_rewrite en Apache
RUN a2enmod rewrite

# Exponer el puerto 80
EXPOSE 80

# Comando para iniciar Apache en primer plano
CMD ["apache2-foreground"]
