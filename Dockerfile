FROM php:8.3-cli
RUN apt-get update && apt-get install -y git unzip libzip-dev libpng-dev libonig-dev libxml2-dev && docker-php-ext-install pdo_mysql zip gd mbstring
WORKDIR /app
COPY . .
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader
RUN chmod -R 775 storage bootstrap/cache
ENV APP_KEY=base64:4uUdgaSp/n5lIh0BdnE7jmlb93bQcskLTYpR0qYHK+c=
ENV APP_ENV=production
ENV APP_DEBUG=true
ENV APP_URL=https://transrio-1.onrender.com
CMD php artisan config:clear && php artisan serve --host=0.0.0.0 --port=$PORT
