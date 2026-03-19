FROM php:8.2-apache

# Install MySQL PDO driver
RUN docker-php-ext-install pdo pdo_mysql

# Enable rewrite (for routing if needed)
RUN a2enmod rewrite

# Allow .htaccess
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Copy project files
COPY . /var/www/html/

WORKDIR /var/www/html

EXPOSE 80