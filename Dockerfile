# Usa la imagen oficial de PHP con Apache como base
FROM php:8.1-apache

# Instala las extensiones necesarias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Cambia el puerto que Apache utiliza a 10000
RUN sed -i 's/80/10000/' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Copia los archivos de tu aplicación al directorio raíz de Apache
COPY . /var/www/html/

# Otorga los permisos adecuados
RUN chown -R www-data:www-data /var/www/html/ \
    && chmod -R 755 /var/www/html/

# Exponer el puerto 10000 para la aplicación web
EXPOSE 10000

# Inicia Apache en el puerto correcto
CMD ["apache2-foreground"]
