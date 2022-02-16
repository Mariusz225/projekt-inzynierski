FROM php:7.4-apache-buster
WORKDIR /var/www
RUN rm -rf /var/www/html && a2enmod rewrite && DEBIAN_FRONTEND=noninteractive apt-get -y update && apt-get -y install git zip curl 
RUN docker-php-ext-install pdo_mysql mysqli
RUN DEBIAN_FRONTEND=noninteractive apt-get -y update && apt-get -y install mariadb-client nano


RUN apt-get install git unzip wait-for-it wget libicu-dev -y && \
    docker-php-ext-install intl pdo_mysql && \
    echo 'extension=intl.so' > /usr/local/etc/php/conf.d/docker-php-ext-intl.ini
    
    
COPY --from=composer /usr/bin/composer /usr/bin/composer
