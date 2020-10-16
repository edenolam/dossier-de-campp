FROM composer:1.9

# Installing Symfony following https://symfony.com/download
RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN mv $HOME/.symfony/bin/symfony /usr/local/bin/symfony

# Installing required packages
#RUN apk add yarn

# Configuration for the aplication
RUN apk --no-cache add postgresql-dev \
 && docker-php-ext-install pdo_pgsql
RUN sed -i 's/;extension=sodium/extension=sodium/' /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini-development \
 && sed -i 's/;extension=intl/extension=intl/' /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini-development

# Specific user for this app
RUN addgroup -S -g 10000 ddc && adduser -S -u 10000 ddc -G ddc && mkdir /.symfony && chmod 777 /.symfony

# CMD cd /api-server && php composer.phar install && symfony server:start --no-tls
CMD cd /api-server \
 && FOLDERS="vendor var public/build public/bundles" && mkdir -p $FOLDERS && chown -R ddc:ddc $FOLDERS \
 && su ddc -s /bin/bash -c "bash -c 'export APP_ENV=prod && export APP_DEBUG=0 \
 && composer install --no-dev --optimize-autoloader \
 && symfony server:start --no-tls'"

