FROM ubuntu

RUN apt-get update && apt-get -y upgrade && apt-get -y dist-upgrade
RUN apt -y install tzdata
RUN ln -sf /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

RUN apt -y install less vim curl

RUN apt -y install apache2

ADD ./project.conf /etc/apache2/sites-available/project.conf
RUN a2dissite 000-default
RUN a2ensite project
RUN a2enmod rewrite

RUN apt -y install software-properties-common
RUN add-apt-repository ppa:ondrej/php
RUN apt -y install php8.2
RUN apt -y install php8.2-bcmath
RUN apt -y install php8.2-mbstring
RUN apt -y install php8.2-xml
RUN apt -y install php8.2-curl
RUN apt -y install php8.2-mysql
RUN apt -y install php8.2-zip
RUN apt -y install php8.2-gd

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

#php.ini
ADD ./php-apache.ini /etc/php/8.2/apache2/php.ini
ADD ./php-cli.ini /etc/php/8.2/cli/php.ini

EXPOSE 80
