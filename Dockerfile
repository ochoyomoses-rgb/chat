FROM php:8.2-apache

# Enable rewrite (important for APIs)
RUN a2enmod rewrite

# Copy project into apache root
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Ensure index.php is recognized
RUN echo "<Directory /var/www/html>\nDirectoryIndex index.php index.html\nAllowOverride All\nRequire all granted\n</Directory>" > /etc/apache2/conf-available/app.conf \
 && a2enconf app.conf

EXPOSE 80