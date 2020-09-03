FROM php:7.3-fpm-buster

RUN apt-get -y update
RUN apt-get -y install curl

RUN docker-php-ext-install -j$(nproc) opcache mysqli pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
update-ca-certificates

WORKDIR /var/www
