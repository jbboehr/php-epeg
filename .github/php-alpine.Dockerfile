ARG PHP_VERSION=7.4
ARG PHP_TYPE=alpine
ARG BASE_IMAGE=php:${PHP_VERSION}-${PHP_TYPE}

# image0
FROM ${BASE_IMAGE}
RUN apk update && \
    apk --no-cache add alpine-sdk automake autoconf libtool jpeg-dev libexif-dev

WORKDIR /build/epeg
RUN git clone https://github.com/mattes/epeg .
RUN autoreconf -fiv
RUN ./configure
RUN make
RUN make install

WORKDIR /build/php-epeg
ADD . .
RUN phpize
RUN ./configure CFLAGS="-O3"
RUN make
RUN make install

# image1
FROM ${BASE_IMAGE}
RUN apk --no-cache add jpeg libexif
COPY --from=0 /usr/local/lib/libepeg.so* /usr/local/lib/
COPY --from=0 /usr/local/lib/php/extensions /usr/local/lib/php/extensions
RUN docker-php-ext-enable epeg
ENTRYPOINT ["docker-php-entrypoint"]
