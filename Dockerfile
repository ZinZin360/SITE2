FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpq-dev

# Install PHP extensions
RUN docker-php-ext-install zip pdo pdo_pgsql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files into container
COPY . /var/www

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Fix permissions (important for Laravel/Lumen cache/logs)
RUN chmod -R 775 storage bootstrap/cache || true

# Expose port (Render uses 10000 by default usually)
EXPOSE 10000

# Start the Laravel/Lumen server
CMD php -S 0.0.0.0:10000 -t public