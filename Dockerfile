# Use official PHP with Apache
FROM php:8.2-apache

# Install PostgreSQL dependencies + extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Enable Apache rewrite (for clean URLs / .htaccess)
RUN a2enmod rewrite

# Allow .htaccess to work
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Set working directory
WORKDIR /var/www/html

# Copy all your project files into container
COPY . /var/www/html/

# Fix permissions (important for some setups)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port
EXPOSE 80
