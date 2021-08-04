FROM php:8.0-fpm
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer
RUN apt-get update \
    && apt-get install -y git zip unzip vim \
    && apt-get install -y zlib1g-dev mariadb-client libzip-dev \
    && docker-php-ext-install zip pdo_mysql
WORKDIR /var/www/html/src
