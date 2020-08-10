FROM php:7.4.1-fpm

ENV LANG C.UTF-8

RUN apt-get update \ 
    && apt-get install -y \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    unzip \
    && docker-php-ext-install zip \
    && yes "" | pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# nodejs install
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get install -y nodejs

#composer install

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

RUN composer global require "laravel/installer" 

RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql

RUN apt-get update \
  && apt-get install -my wget gnupg

RUN curl -sL https://deb.nodesource.com/setup_6.x | bash - 
RUN apt-get update
RUN apt-get install -y nodejs


WORKDIR /src/mix

# ここから最後までがポイント
RUN apt-get update && apt-get install -y openssh-server supervisor git
RUN mkdir -p /var/run/sshd

RUN sed -i 's/PermitRootLogin without-password/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -i 's/#PasswordAuthentication yes/PasswordAuthentication no/' /etc/ssh/sshd_config

# SSH login fix. Otherwise user is kicked off after login
RUN sed 's@session\s*required\s*pam_loginuid.so@session optional pam_loginuid.so@g' -i /etc/pam.d/sshd

ENV NOTVISIBLE "in users profile"
RUN echo "export VISIBLE=now" >> /etc/profile

# supervisor
# Docker で nginx + php-fpm + Laravel5.3 の開発環境を作る - takaya030の備忘録
# http://takaya030.hatenablog.com/entry/2016/09/20/230739
RUN mkdir -p /var/log/supervisor && \
    chmod 777 /var/log/supervisor && \
    touch /var/log/supervisor/supervisord.log && \
    chmod 777 /var/log/supervisor/supervisord.log
COPY ./supervisord.conf /etc/supervisor/conf.d/
#CMD ["/usr/bin/supervisord"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# SSH デーモンの Docker 化 — Docker-docs-ja 1.9.0b ドキュメント
# http://docs.docker.jp/v1.9/engine/examples/running_ssh_service.html
#CMD ["/usr/sbin/sshd", "-D"]
