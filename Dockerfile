FROM php:8.4-fpm-alpine

RUN apk add \
    git \
    bash \
    curl \
    libpng \
    libpng-dev \
    zip \
    unzip \
    oniguruma-dev \
    icu-dev \
    libzip-dev \
    mysql-client \
    imagemagick-dev \
    autoconf \
    g++ \
    make

RUN pecl install redis
RUN docker-php-ext-install pdo pdo_mysql zip intl exif
RUN docker-php-ext-enable redis

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --no-progress --no-interaction

CMD ["php-fpm"]
