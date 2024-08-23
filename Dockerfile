# Use the official PHP image with Apache
FROM php:8.1-apache

# Install any additional PHP extensions your application needs
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite module
RUN a2enmod rewrite

# Copy custom Apache configuration file
COPY apache-vhost.conf /etc/apache2/sites-available/000-default.conf

# Copy your application code to the container
COPY . /var/www/html

# Set the working directory
WORKDIR /var/www/html

