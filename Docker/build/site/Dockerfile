FROM php:7.2-apache

# Install PDO MySQL driver
# See https://github.com/docker-library/php/issues/62
RUN docker-php-ext-install pdo mysqli pdo_mysql

RUN apt-get update -y && apt-get install -y libpng-dev libfreetype6-dev

RUN docker-php-ext-configure gd \
        --with-freetype-dir=/usr/include/freetype2 \
    && docker-php-ext-install gd

RUN apt-get update && apt-get install -y --no-install-recommends libmagickwand-dev && rm -rf /var/lib/apt/lists/*

RUN pecl install imagick-3.4.3 && docker-php-ext-enable imagick
# Workaround for write permission on write to MacOS X volumes
# See https://github.com/boot2docker/boot2docker/pull/534
RUN usermod -u 1000 www-data

# Enable Apache mod_rewrite
RUN a2enmod rewrite