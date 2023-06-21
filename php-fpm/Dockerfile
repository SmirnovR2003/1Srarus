# Для начала указываем исходный образ, он будет использован как основа
FROM php:7.4-fpm

# RUN выполняет идущую за ней команду в контексте нашего образа.
# В данном случае мы установим некоторые зависимости и модули PHP.
# Для установки модулей используем команду docker-php-ext-install. losst
# На каждый RUN создается новый слой в образе, поэтому рекомендуется объединять команды.
RUN apt-get update \
&& apt-get install -y cron
RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
	libpng-dev \
	libonig-dev \
	libzip-dev \
	libmcrypt-dev \
        && pecl install mcrypt-1.0.3 \
	&& docker-php-ext-enable mcrypt \
        && docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo_mysql zip \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) gd 

# Куда же без composer'а.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Добавим свой php.ini, можем в нем определять свои значения конфига
ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

# Copy your cronjob file
COPY cron/my-cron-job /etc/cron.d/crontab
COPY cron/log /var/log
#COPY ./ /var/www/

#RUN chmod 0644 /var/www/api/clients/change-work-status.php
# owner can read and write into the crontab, group and others can read it
RUN chmod 0644 /etc/cron.d/crontab
# running our crontab using the binary from the package we installed
RUN /usr/bin/crontab /etc/cron.d/crontab

CMD cron && docker-php-entrypoint php-fpm
