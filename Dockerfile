# Usa la imagen oficial de PHP 8.1 con Apache
FROM php:8.1-apache

# Instalar GD y otras extensiones necesarias para el manejo de imágenes
RUN apt-get update && \
    apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd
    
# Instalar extensiones adicionales de PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitar el módulo de reescritura de Apache para .htaccess y URLs amigables
RUN a2enmod rewrite

# Copiar el contenido de tu carpeta html dentro del contenedor
COPY ./html /var/www/html/
# COPY ./html /usr/local/apache2/htdocs

# Configuración de permisos opcional para la carpeta HTML
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80 (el predeterminado de Apache)
EXPOSE 80


#FROM php:latest

# Instalar extensiones adicionales de PHP si es necesario
#RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar el contenido de tu carpeta html dentro del contenedor
#COPY ./html /var/www/html/

# Configurar Apache para que reconozca archivos .php
#RUN a2enmod rewrite

