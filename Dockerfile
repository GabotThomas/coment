FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction
COPY . .
RUN composer dump-autoload --no-dev --optimize --no-scripts

FROM php:8.4-apache

# Refuse une version de PHP vulnérable à PHP2Shell (CVE-2026-109618 / CVE-2026-109619)
RUN php -r 'exit(version_compare(PHP_VERSION, "8.4.27", "<") ? 1 : 0);'

RUN docker-php-ext-install pdo_mysql opcache \
    && a2enmod rewrite headers \
    && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri 's!^ServerTokens .*!ServerTokens Prod!; s!^ServerSignature .*!ServerSignature Off!' /etc/apache2/conf-available/security.conf
COPY docker/php.ini "$PHP_INI_DIR/conf.d/zz-app.ini"

WORKDIR /var/www/html
COPY --from=vendor /app /var/www/html
RUN ln -s ../storage/app/public public/storage \
    && chown -R www-data:www-data storage bootstrap/cache

COPY docker/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint
ENTRYPOINT ["entrypoint"]
CMD ["apache2-foreground"]
