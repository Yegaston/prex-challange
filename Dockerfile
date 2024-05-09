# Use the official PHP image with FPM
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    nginx \
    && docker-php-ext-install zip pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html

WORKDIR /var/www/html

RUN composer install --optimize-autoloader

RUN php artisan key:generate

RUN php artisan migrate --seed

RUN php artisan passport:client --personal

EXPOSE 9000

COPY nginx.conf /etc/nginx/sites-available/default

CMD ["nginx", "-g", "daemon off;"]
