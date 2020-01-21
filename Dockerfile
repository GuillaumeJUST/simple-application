FROM php:7.4-cli
COPY . /var/www/app
WORKDIR /var/www/app

RUN apt-get update && apt-get install -y \
        zip \
        unzip

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Composer install
RUN composer install
RUN composer coverage-docker
CMD [ "php", "./index.php" ]

