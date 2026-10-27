FROM php:8.3-cli

RUN apt-get update && apt-get install -y git unzip libzip-dev libpng-dev libonig-dev libxml2-dev libicu-dev mariadb-server && docker-php-ext-install pdo_mysql zip gd intl && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /app
COPY . .

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 775 storage bootstrap/cache

RUN php artisan storage:link || true

RUN mkdir -p /var/run/mysqld && chown -R mysql:mysql /var/run/mysqld /var/lib/mysql

ENV APP_KEY=base64:MTIzNDU2Nzg5MDEyMzQ1Njc4OTAxMjM0NTY3ODkwMTI=
ENV APP_ENV=production
ENV APP_DEBUG=true
ENV LOG_CHANNEL=stderr
ENV LOG_LEVEL=debug
ENV APP_URL=https://transrio-1.onrender.com
ENV DB_CONNECTION=mysql
ENV DB_HOST=127.0.0.1
ENV DB_PORT=3306
ENV DB_DATABASE=transrio
ENV DB_USERNAME=root
ENV DB_PASSWORD=

CMD service mariadb start && \
    sleep 5 && \
    mysql -u root -e "CREATE DATABASE IF NOT EXISTS transrio; ALTER USER 'root'@'localhost' IDENTIFIED BY '12345678'; GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' WITH GRANT OPTION; FLUSH PRIVILEGES;" && \
    mysql -u root -p12345678 transrio < transrio.sql || true && \
    php artisan migrate --force || true && \
    php artisan serve --host 0.0.0.0 --port $PORT
