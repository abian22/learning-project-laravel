FROM php:8.1-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    supervisor

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

COPY --from=composer:2.1 /usr/bin/composer /usr/bin/composer

COPY . /var/www

COPY --chown=www-data:www-data . /var/www

USER root

RUN touch /tmp/composer.log

RUN composer install --no-interaction --prefer-dist --optimize-autoloader -vvv 2>&1 | tee /tmp/composer.log

RUN cat /tmp/composer.log

USER www-data

EXPOSE 9000
CMD ["php-fpm"]