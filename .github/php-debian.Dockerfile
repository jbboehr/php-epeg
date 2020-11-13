
ARG PHP_VERSION=7.4
ARG BASE_IMAGE=php:$PHP_VERSION

# image0
FROM ${BASE_IMAGE}
RUN apt-get update && apt-get install -y \
        autoconf \
        automake \
        gcc \
        git \
        libtool \
        m4 \
        make \
        pkg-config \
        libjpeg62-turbo-dev \
        libexif-dev

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
RUN apt-get update && apt-get install -y \
        libjpeg62-turbo \
        libexif12
COPY --from=0 /usr/local/lib/libepeg.so* /usr/local/lib/
COPY --from=0 /usr/local/lib/php/extensions /usr/local/lib/php/extensions
RUN docker-php-ext-enable epeg
ENTRYPOINT ["docker-php-entrypoint"]
