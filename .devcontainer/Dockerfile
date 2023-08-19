ARG PHP_VERSION="8.2"

FROM mcr.microsoft.com/vscode/devcontainers/php:1-${PHP_VERSION}-bullseye

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash && \
    apt-get update && apt install -y libpq-dev sqlite3 symfony-cli

RUN docker-php-ext-install pdo_pgsql
# RUN docker-php-ext-enable xdebug

RUN curl -sS 'https://getcomposer.org/installer' | php -- --install-dir=/usr/local/bin --filename=composer