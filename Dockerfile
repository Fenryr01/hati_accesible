FROM php:8.0-cli

# Instala extensiones de PHP si es necesario
RUN docker-php-ext-install pdo pdo_mysql

# Copia tus archivos de la aplicación al contenedor
COPY . /var/www/html

# Cambia al directorio de trabajo
WORKDIR /var/www/html

# Expone el puerto que utilizará tu aplicación
EXPOSE 80

# Comando para ejecutar tu aplicación
CMD ["php", "-S", "0.0.0.0:80"]
