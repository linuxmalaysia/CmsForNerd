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

FROM composer:2.8 AS builder
WORKDIR /app
COPY composer.json composer.lock ./
# Install production dependencies only, ignoring platform requirements during build
RUN composer install --no-dev --no-scripts --no-progress --ignore-platform-reqs

FROM php:8.4-apache

# Install required system libraries and clean package lists
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite and mod_headers for routing and .htaccess security headers
RUN a2enmod rewrite headers

# Configure Apache to allow .htaccess overrides on the DocumentRoot
RUN sed -ri -e 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set active working directory
WORKDIR /var/www/html

# Copy vendor dependencies from the composer builder stage
COPY --from=builder /app/vendor /var/www/html/vendor

# Copy the application source code
COPY . /var/www/html/

# Ensure web server has proper ownership over all copied files
RUN chown -R www-data:www-data /var/www/html

# Expose standard web port
EXPOSE 80
