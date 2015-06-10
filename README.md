
# php-epeg

[![Build Status](https://travis-ci.org/jbboehr/php-epeg.svg?branch=master)](https://travis-ci.org/jbboehr/php-epeg)

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

