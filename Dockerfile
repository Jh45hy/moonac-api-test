dockerfile
FROM php:8.3-apache

RUN a2enmod rewrite headers

WORKDIR /var/www/html

COPY index.php /var/www/html/index.php

EXPOSE 80

