# Usa una imagen base oficial de PHP con Apache preinstalado
FROM php:8.1-apache

# Habilita el módulo de reescritura de Apache
RUN a2enmod rewrite

# Copia todos los archivos de tu proyecto al directorio público del servidor web Apache
COPY . /var/www/html/

# Establece el directorio de trabajo
WORKDIR /var/www/html/

# Cambia los permisos del directorio para permitir que Apache lo sirva
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80 para que Render lo utilice
EXPOSE 80

# Inicia el servidor Apache cuando se despliegue la aplicación
CMD ["apache2-foreground"]
