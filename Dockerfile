FROM php:8.2-apache

# Install MySQL extensions for PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite if needed
RUN a2enmod rewrite

# Copy project files to web server root
COPY . /var/www/html/

EXPOSE 80
