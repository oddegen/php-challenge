FROM php:7.3-alpine

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

RUN install-php-extensions bcmath intl opcache zip sockets grpc protobuf

COPY --from=composer/composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install

RUN  mkdir /tmp/rr-grpc-install && cd /tmp/rr-grpc-install && curl -sSL https://github.com/spiral-modules/php-grpc/releases/download/v1.4.0/rr-grpc-1.4.0-linux-amd64.tar.gz | tar -xvzf -
RUN mv /tmp/rr-grpc-install/rr-grpc-1.4.0-linux-amd64/rr-grpc /usr/local/bin/
RUN chmod +x /usr/local/bin/rr-grpc && rm -rf /tmp/rr-grpc-install

EXPOSE 9001 2112

CMD ["rr-grpc", "serve", "-v", "-d"]
