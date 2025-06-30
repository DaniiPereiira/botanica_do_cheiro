FROM php:8.2-apache

# Instala o driver PDO para MySQL
RUN docker-php-ext-install pdo pdo_mysql

