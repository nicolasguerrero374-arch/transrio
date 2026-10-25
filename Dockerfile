FROM php:8.3-cli

RUN apt-get update && apt-get install -y git unzip libzip-dev libpng-dev libonig-dev libxml2-dev libicu-dev mariadb-server && docker-php-ext-install pdo_mysql zip gd intl && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN mkdir -p /var/run/mysqld && chown -R mysql:mysql /var/run/mysqld /var/lib/mysql

ENV APP_KEY=base64:dGhpc2lzYXZlcnlsb25ncmFuZG9ta2V5MTIzNDU2Nzg5MA==
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV DB_CONNECTION=mysql
ENV DB_HOST=127.0.0.1
ENV DB_PORT=3306
ENV DB_DATABASE=transrio
ENV DB_USERNAME=root
ENV DB_PASSWORD=

EXPOSE 10000

CMD bash -c "service mariadb start && sleep 3 && mysql -u root -e 'CREATE DATABASE IF NOT EXISTS transrio;' && mysql -u root transrio < /app/transrio.sql && php artisan config:clear && php artisan serve --host=0.0.0.0 --port=10000"
