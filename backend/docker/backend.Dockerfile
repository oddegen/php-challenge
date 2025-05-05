FROM php:7.3-alpine

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

RUN install-php-extensions bcmath intl opcache zip sockets grpc protobuf

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install

RUN curl -sSL https://github.com/spiral/php-grpc/releases/download/v1.4.0/protoc-gen-php-grpc-1.4.0-linux-amd64.tar.gz | tar -xvzf - -C /usr/local/bin protoc-gen-php-grpc
RUN chmod +x /usr/local/bin/protoc-gen-php-grpc

RUN curl -sSL https://github.com/spiral-modules/php-grpc/releases/download/v1.4.0/rr-grpc-1.4.0-linux-amd64.tar.gz | tar -xvzf - -C /usr/local/bin rr-grpc
RUN chmod +x /usr/local/bin/rr-grpc

EXPOSE 9001 2112

CMD ["rr-grpc", "serve", "-d", "-v"]
