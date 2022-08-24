FROM php:8.1.6-apache

ARG UID

RUN apt-get upgrade && apt-get update -y
# Enable needed Apache modules
RUN a2enmod rewrite headers ssl actions session session_cookie cgi auth_digest dav dav_fs include suexec

# Create user and some useful stuff
RUN adduser -u ${UID} --disabled-password --gecos "" appuser
RUN mkdir /home/appuser/.ssh
RUN chown -R appuser:appuser /home/appuser/
RUN echo "StrictHostKeyChecking no" >> /home/appuser/.ssh/config
RUN echo "export COLUMNS=300" >> /home/appuser/.bashrc
RUN echo "alias sf=/appdata/www/bin/console" >> /home/appuser/.bashrc

# Install packages and PHP extensions
RUN apt update \
    && apt install -y git acl openssl openssh-client wget zip vim libssh-dev \
    && apt install -y libpng-dev zlib1g-dev libzip-dev libxml2-dev libicu-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip \
    && pecl install xdebug \
    && docker-php-ext-enable --ini-name 05-opcache.ini opcache xdebug

# Install and update composer
RUN curl -sS https://getcomposer.org/installer | php -- --version=2.3.9 --install-dir=/usr/local/bin --filename=composer


# Install PHP-CS-FIXER
RUN wget https://cs.symfony.com/download/php-cs-fixer-v3.phar -O php-cs-fixer
RUN chmod a+x php-cs-fixer
RUN mv php-cs-fixer /usr/local/bin/php-cs-fixer

## Install Symfony binary
#USER appuser
#RUN wget https://get.symfony.com/cli/installer -O - | bash
USER root
RUN curl -sS https://get.symfony.com/cli/installer | bash -s - --install-dir /usr/local/bin/symfony

RUN mkdir -p /appdata/www

# Config XDEBUG
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

WORKDIR /var/www
