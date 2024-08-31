FROM --platform=linux/amd64 php:7.4-fpm

# Set working directory
WORKDIR /var/www/tiket

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nginx

RUN docker-php-ext-install zip pdo_mysql mbstring exif pcntl bcmath gd
RUN docker-php-ext-install mysqli

#bind volume inside docker images
#COPY ./.env.example ./.env

COPY . .

COPY ./.docker/default.conf /etc/nginx/sites-enabled/default

# script to run on startup
COPY ./.docker/entrypoint.sh /etc/entrypoint.sh

#COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#RUN composer install
#RUN php artisan key:generate

RUN chmod +x /etc/entrypoint.sh
RUN chown -R www-data:www-data /var/www/tiket

EXPOSE 80 443

USER root

ENTRYPOINT ["/etc/entrypoint.sh"]
