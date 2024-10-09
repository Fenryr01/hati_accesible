# Usa una imagen base oficial de PHP con Apache ya instalado
FROM php:8.1-apache

# Copia todos los archivos de tu proyecto al directorio público del servidor web Apache
COPY . /var/www/html/

# Establece el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html/

# Expone el puerto 80 para que Render lo utilice
EXPOSE 80

# Inicia el servidor Apache cuando se despliegue la aplicación
CMD ["apache2-foreground"]
