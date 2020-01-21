FROM php:7.4-cli
COPY . /var/www/app
WORKDIR /var/www/app

RUN apt-get update && apt-get install -y \
        zip \
        unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install
RUN composer coverage
CMD [ "php", "./index.php" ]

