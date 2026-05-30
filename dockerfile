FROM php:8.4-fpm

# تثبيت extensions الخاصة بـ Laravel
RUN docker-php-ext-install pdo pdo_mysql mysqli

# تثبيت Composer بشكل رسمي وآمن
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www