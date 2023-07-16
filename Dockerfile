FROM php:7.2-apache

# Install git
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git

# Install dependencies required by Composer and the PHP extensions we want to use
RUN apt-get install -y \
        libzip-dev \
        unzip \
    && docker-php-ext-install \
        pdo_mysql \
        zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /var/www/html

# Copiar el proyecto a la carpeta /var/www/html del contenedor
COPY . .

# Configurar permisos para Apache
RUN chown -R www-data:www-data /var/www/html

# Install project dependencies
RUN composer install
