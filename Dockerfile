FROM php:7.4-cli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer;

# Add tooling -> need java for sonar qube agent

RUN set -e; \
    apt-get update; \
    apt-get upgrade -y --no-install-recommends; \
    apt-get install -y --no-install-recommends apt-utils build-essential wget make autoconf ssh bash sqlite3 libsqlite3-dev vim git unzip;

# Install from PECL: Yaml Redis xdebug
RUN apt-get install -y libyaml-dev \
    && pecl install yaml \
    && pecl install psr \
    && pecl install xdebug-2.8.1 \
    && docker-php-ext-enable yaml xdebug psr

COPY src /myapp/src
COPY tests /myapp/tests
COPY composer.json /myapp/composer.json
COPY run.sh /myapp/run.sh
RUN chmod +x /myapp/run.sh
WORKDIR /myapp
CMD ["/myapp/run.sh"]
