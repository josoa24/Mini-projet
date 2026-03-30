FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    libavif-dev \
    libpq-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-avif
RUN docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install pdo_pgsql

WORKDIR /var/www/html