FROM php:8.2-cli
WORKDIR /app
RUN apt-get update && apt-get install -y nodejs npm git zip unzip libzip-dev && docker-php-ext-install zip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . .
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build
CMD php artisan serve --host 0.0.0.0 --port $PORT
