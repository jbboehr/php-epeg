
ARG BASE_IMAGE=fedora:latest

# image0
FROM ${BASE_IMAGE}
RUN dnf groupinstall 'Development Tools' -y
RUN dnf install \
    gcc \
    automake \
    autoconf \
    libtool \
    php-devel \
    libjpeg \
    libexif \
    -y
RUN dnf install libjpeg-turbo-devel libexif-devel -y

WORKDIR /build/epeg
RUN git clone https://github.com/mattes/epeg .
RUN autoreconf -fiv
RUN ./configure --prefix=/usr
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
RUN dnf install php-cli libjpeg-turbo libexif -y
# this probably won't work on other arches
COPY --from=0 /usr/lib64/libepeg.so* /usr/lib64/
COPY --from=0 /usr/lib64/php/modules/epeg.so /usr/lib64/php/modules/epeg.so
# please forgive me
COPY --from=0 /usr/lib64/php/build/run-tests.php /usr/local/lib/php/build/run-tests.php
RUN echo extension=epeg.so | sudo tee /etc/php.d/90-epeg.ini
