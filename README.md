
# php-epeg

[![GitHub Linux Build Status](https://github.com/jbboehr/php-epeg/workflows/linux/badge.svg)](https://github.com/jbboehr/php-epeg/actions?query=workflow%3Alinux)
[![GitHub OSX Build Status](https://github.com/jbboehr/php-epeg/workflows/osx/badge.svg)](https://github.com/jbboehr/php-epeg/actions?query=workflow%3Aosx)
[![GitHub Docker Build Status](https://github.com/jbboehr/php-epeg/workflows/docker/badge.svg)](https://github.com/jbboehr/php-epeg/actions?query=workflow%3Adocker)
[![Coverage Status](https://coveralls.io/repos/jbboehr/php-epeg/badge.svg?branch=master&service=github)](https://coveralls.io/github/jbboehr/php-epeg?branch=master)

PHP bindings for [epeg](https://github.com/jbboehr/epeg).


## Installation

Install [epeg](https://github.com/jbboehr/epeg).


### Ubuntu

```bash
sudo apt-get install php5-dev libexif-dev
git clone https://github.com/jbboehr/php-epeg.git
cd php-epeg
phpize
./configure
make
make test
sudo make install

# precise
echo extension=epeg.so | sudo tee /etc/php5/conf.d/epeg.ini

# trusty
echo extension=epeg.so | sudo tee /etc/php5/mods-available/epeg.ini
sudo php5enmod epeg
```


## License

This project is licensed under the [MIT license](http://opensource.org/licenses/MIT).

