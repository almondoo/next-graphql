FROM php:8.1-fpm-alpine

LABEL maintainer "morikawa"

WORKDIR /var/www/laravel

ARG TZ
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer

# 必要なものもろもろ
RUN set -eux
RUN apk update 
RUN apk add --update-cache --no-cache \
    tzdata && \
    apk add --no-cache \
    freetype \
    libpng \
    libjpeg-turbo \
    freetype-dev \
    libpng-dev \
    libjpeg-turbo-dev

COPY --from=composer:2.1 /usr/bin/composer /usr/bin/composer

# mysql pdo driver install
RUN docker-php-ext-configure gd \
    --with-freetype=/usr/include/ \
    --with-jpeg=/usr/include/ 
RUN docker-php-ext-install -j$(nproc) gd bcmath pdo_mysql

RUN apk add --update-cache nodejs npm

# デバッグのために追加
RUN apk add autoconf gcc g++ make
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
