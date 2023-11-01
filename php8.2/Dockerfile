FROM php:8.2.9RC1-fpm-bullseye

LABEL maintainer="luqman"
WORKDIR /var/www

### ENV SECTION ###
ENV TZ=Asia/Kuala_Lumpur
ENV PHPFPM__access.format '"%R - %u [%t] \"%m %r\" %s %l %Q %f"'

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && \
    apt-get install -y \
    # php php-fpm \
    wget \
    nano \
    gnupg2 \
    git \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    zip \
    systemctl \
    libfreetype6-dev \
    supervisor \
    gosu \
    systemctl \
    nano \
    dpkg \
    lsb-release \
    net-tools \
    vim

## locales
RUN apt-get install -y \
    locales \
    && locale-gen \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen

## PHP EXT mysql
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-configure mysqli --with-mysqli=mysqlnd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli

# PHP EXT File exif
RUN docker-php-ext-install exif && docker-php-ext-enable exif

# PHP EXT Zip
RUN docker-php-ext-install zip

# PHP EXT GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# PHP EXT Redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis 

# PHP EXT pcntl
RUN docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install \
    pcntl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

## Clean repo cache
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
RUN apt-get -y autoremove
RUN apt-get clean

## start here
# RUN service apparmor stop \
#     service apparmor teardown \
#     systemctl disable apparmor

# RUN wget https://repo.mysql.com/apt/ubuntu/pool/mysql-apt-config/m/mysql-apt-config/mysql-apt-config_0.8.24-1_all.deb
COPY ./mysql/apt-config/mysql-apt-config_0.8.24-1_all.deb /tmp/mysql-apt-config_0.8.24-1_all.deb
RUN dpkg -i /tmp/mysql-apt-config_0.8.24-1_all.deb 

RUN apt-get update
RUN apt-get install -y mysql-router
RUN apt-get install -y mysql-shell
RUN apt-get update -y && apt-get dist-upgrade -y
# RUN apt install -y mysql-client
# RUN systemctl start mysql
# RUN mysqlrouter --bootstrap clusteradmin@db1:3306 --directory myrouter --user=root
# CMD [ "mysqlrouter --bootstrap clusteradmin@db1:3306 --directory myrouter --user=root" ] 
## end here

COPY ./index.php /var/www/