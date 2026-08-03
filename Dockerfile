# ==========================================
# Stage 1: Build Frontend Assets (Node/Mix/Tailwind)
# ==========================================
FROM node:20-alpine AS frontend

WORKDIR /app
COPY package.json package-lock.json* ./
RUN npm install

COPY . .
# Laravel Mix uses 'production' script to compile assets
RUN npm run production

# ==========================================
# Stage 2: Install Composer Dependencies
# ==========================================
FROM composer:2.7 AS vendor

WORKDIR /app
COPY composer.json ./
COPY composer.lock* ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    --ignore-platform-reqs

COPY . .
RUN composer dump-autoload --optimize

# ==========================================
# Stage 3: Production Apache/PHP Runtime
# ==========================================
FROM php:8.3-apache AS production

# 1. Install Linux system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    curl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Configure and install GD & PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    intl \
    zip \
    opcache

# 3. Enable Apache mod_rewrite
RUN a2enmod rewrite

# 4. Point Apache DocumentRoot to Laravel /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

# 5. Copy core application code
COPY . /var/www/html

# 6. Copy compiled vendor files from Stage 2
COPY --from=vendor /app/vendor /var/www/html/vendor

# 7. Copy compiled frontend assets from Laravel Mix (Stage 1)
# Laravel Mix typically outputs compiled files to public/css and public/js
COPY --from=frontend /app/public/css /var/www/html/public/css
COPY --from=frontend /app/public/js /var/www/html/public/js
# If you compile fonts or images into public, copy those too if needed:
# COPY --from=frontend /app/public/images /var/www/html/public/images

# 8. Setup persistent storage permissions for www-data (UID 33)
RUN mkdir -p /var/www/html/storage/framework/{sessions,views,cache} \
    /var/www/html/storage/logs \
    /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]
