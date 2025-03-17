FROM php:8.2-fpm

COPY php/conf.d/custom.ini /usr/local/etc/php/conf.d/custom.ini

RUN docker-php-ext-install pdo_mysql
