FROM php:7.4.26-fpm
COPY ./config/php.ini /usr/local/etc/php/php.ini

# install composer
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

# install packages
# RUN apt-get update \
#   && apt-get install -y \
RUN apt-get update && apt-get install -y \
    gcc \
    make \
    libpng-dev \
    # mbstring削除し、libonig-devを追加
    libonig-dev \
    git \
    unzip \
    vim \
    libmcrypt-dev \
    mariadb-client \
    curl \
    gnupg \
    openssl \
    zlib1g-dev \ 
    # zipをインストールするため追加
    libzip-dev \ 
    # mbstring削除し、libonig-devを追加
    && docker-php-ext-install pdo_mysql mysqli zip 

# Node.jsとnpmをインストール
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

# # 確認
RUN node --version
RUN npm --version

# install bootstrap
# RUN cd /var/www/html/ && npm install bootstrap@5.3.2
RUN cd /var/www/html/ && npm install bootstrap@5.1.3

# install xdebug
RUN pecl install xdebug-3.1.6 && docker-php-ext-enable xdebug

# # set WORKDIR
# WORKDIR /var/www/html/

# # install local project
# ADD ./laravel-project /var/www/html/

WORKDIR /var/www/html/laravel-project
ADD . /var/www/html/laravel-project
RUN chown -R www-data:www-data /var/www/html