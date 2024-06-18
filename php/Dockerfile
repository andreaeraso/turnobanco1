# Utilizar la imagen oficial de PHP con Apache
FROM php:7.4-apache

# Instalar extensiones necesarias de PHP
RUN docker-php-ext-install mysqli

# Copiar los archivos de la aplicación al directorio root de Apache
COPY . /var/www/html/

# Establecer permisos adecuados para los archivos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exponer el puerto 80 para el servidor web
EXPOSE 80


