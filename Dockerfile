FROM alpine:3.13

# for laravel lumen run smoothly
RUN apk --no-cache add \
php7 \
php7-fpm \
php7-pdo \
php7-mbstring \
php7-openssl

# for composer & our project depency run smoothly
RUN apk --no-cache add \
php7-phar \
php7-xml \
php7-xmlwriter \
php7-json \
php7-dom \
curl \
php7-curl \
php7-tokenizer \
php7-intl \
php7-opcache \
php7-pdo \
php7-pdo_pgsql \
php7-pgsql

# if need composer to update plugin / vendor used
RUN php7 -r "copy('http://getcomposer.org/installer', 'composer-setup.php');" && \
php7 composer-setup.php --install-dir=/usr/bin --filename=composer && \
php7 -r "unlink('composer-setup.php');"

# copy all of the file in folder to /src
COPY . /src
WORKDIR /src

RUN composer install

# run the php server service
# move this command to -> docker-compose.yml
# CMD php -S 0.0.0.0:8080 public/index.php
