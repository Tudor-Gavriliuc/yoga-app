FROM php:8.3-cli-alpine

RUN apk add --no-cache postgresql-dev nodejs npm

RUN docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www

COPY . .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

RUN chmod -R 775 storage bootstrap/cache

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["/entrypoint.sh"]
