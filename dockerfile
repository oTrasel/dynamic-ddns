# Use the official PHP image with Apache
FROM php:8.3-apache

# Install required extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    curl \
    unzip \
    cron

# Enable Apache mod_rewrite and mod_autoindex for directory listing
RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configure Apache to allow access to /var/www/html
RUN echo "<Directory /var/www/html>\n\
    AllowOverride All\n\
    Require all granted\n\
    Options +Indexes\n\
</Directory>" >> /etc/apache2/sites-available/000-default.conf

# Change permissions of the /var/www/html directory
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
RUN echo "0 */2 * * * php /var/www/html/scr/index.php" > /etc/cron.d/dynimic-dns
# Set working directory inside the container
WORKDIR /var/www/html