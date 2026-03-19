FROM php:8.2-apache

# Enable Apache rewrite module (required for clean URLs)
RUN a2enmod rewrite

# Allow .htaccess to work (VERY IMPORTANT)
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Set working directory
WORKDIR /var/www/html

# Copy all project files into Apache root
COPY . /var/www/html/

# Fix permissions (important on Render)
RUN chown -R www-data:www-data /var/www/html

# Ensure Apache recognizes index.php
RUN echo "<Directory /var/www/html>\n\
    DirectoryIndex index.php index.html\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" > /etc/apache2/conf-available/app.conf \
    && a2enconf app.conf

# Expose port
EXPOSE 80