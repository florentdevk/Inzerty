FROM php:8.2-apache

RUN a2enmod rewrite

COPY config/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default
RUN a2enmod rewrite

RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

WORKDIR /var/www/html

EXPOSE 80