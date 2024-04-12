FROM alpine:3.15

RUN apk update

# install tool, apache2
RUN apk add --no-cache \
  git \
  curl \
  apache2 \
  apache2-utils

RUN apk add --no-cache php7

RUN apk add --no-cache \
  php7-fpm \
  php7-cli \
  php7-ctype \
  php7-curl \
  php7-dom \
  php7-fileinfo \
  php7-gd \
  php7-intl \
  php7-mbstring \
  php7-mysqli \
  php7-opcache \
  php7-openssl \
  php7-phar \
  php7-session \
  php7-tokenizer \
  php7-xml \
  php7-xmlreader \
  php7-xmlwriter \
  php7-json \
  php7-pdo \
  php7-pdo_mysql \
  php7-sqlite3 \
  php7-zip \
  php7-xdebug \
  php7-pdo_sqlite \
  php7-bcmath \
  php7-redis \
  php7-apache2

RUN apk add --no-cache \
  php7-common \
  php7-pear \
  php7-pecl-yaml \
  php7-pecl-mongodb \
  php7-soap \
  php7-mysqlnd \
  php7-xmlrpc \
  php7-pecl-mcrypt \
  php7-pdo_dblib

# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# copy source app
COPY . /var/www/app
WORKDIR /var/www/app

# copy config for apache2
COPY /docker/conf.d/default.conf /etc/apache2/conf.d/default.conf

# expose ports
EXPOSE 80

RUN whoami

CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]