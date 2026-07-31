# ==============================================================================
# Protocol    : Deep State of Mind (DSOM) For My AI
# Author      : Harisfazillah Jamel (LinuxMalaysia)
# Timestamp   : 2026-07-30
# License     : GNU General Public License v3.0
# Standard    : UK English | DBP-standard Bahasa Melayu Malaysia (Piawai)
# ==============================================================================
# =============================================================================
# CmsForNerd v4.1.0 - Containerfile for Render Production Deployments
# Standards: PHP 8.4, Apache, Composer 2.x
# =============================================================================

FROM php:8.4-apache AS builder

# Install required system libraries and PHP extensions in builder stage
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY composer.json composer.lock ./

# Validate platform requirements and install production dependencies
RUN composer check-platform-reqs && \
    composer install --no-dev --no-scripts --no-progress --optimize-autoloader --no-interaction

FROM php:8.4-apache

# Install required system libraries and clean package lists
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite and mod_headers for routing and .htaccess security headers
RUN a2enmod rewrite headers

# Configure Apache to listen on unprivileged port 8080 instead of 80
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf && \
    sed -i 's/<VirtualHost \*:80>/<VirtualHost *:8080>/' /etc/apache2/sites-available/000-default.conf

# Configure Apache to allow .htaccess overrides specifically for /var/www/html
RUN cat <<'EOF' > /etc/apache2/conf-available/document-root-override.conf
<Directory /var/www/html>
    AllowOverride All
    Require all granted
</Directory>
EOF

RUN a2enconf document-root-override

# Set active working directory
WORKDIR /var/www/html

# Copy vendor dependencies from the composer builder stage
COPY --from=builder --chown=www-data:www-data /app/vendor /var/www/html/vendor

# Copy application source files explicitly (allow-list approach)
COPY --chown=www-data:www-data composer.json composer.lock .htaccess /var/www/html/
COPY --chown=www-data:www-data *.php /var/www/html/
COPY --chown=www-data:www-data *.html /var/www/html/
COPY --chown=www-data:www-data *.js /var/www/html/
COPY --chown=www-data:www-data *.ico /var/www/html/
COPY --chown=www-data:www-data *.xml /var/www/html/
COPY --chown=www-data:www-data *.rdf /var/www/html/
COPY --chown=www-data:www-data *.json /var/www/html/
COPY --chown=www-data:www-data *.txt /var/www/html/
COPY --chown=www-data:www-data robots.txt /var/www/html/
COPY --chown=www-data:www-data src /var/www/html/src
COPY --chown=www-data:www-data includes /var/www/html/includes
COPY --chown=www-data:www-data data /var/www/html/data
COPY --chown=www-data:www-data assets /var/www/html/assets
COPY --chown=www-data:www-data images /var/www/html/images
COPY --chown=www-data:www-data contents /var/www/html/contents
COPY --chown=www-data:www-data themes /var/www/html/themes
COPY --chown=www-data:www-data .well-known /var/www/html/.well-known

# Switch to non-root user for runtime
USER www-data

# Expose unprivileged port
EXPOSE 8080
