FROM php:8.2-apache

RUN apt update && apt install -y docker.io
RUN docker-php-ext-install mysqli

RUN groupadd -g 988 hostdocker
RUN usermod -aG hostdocker www-data