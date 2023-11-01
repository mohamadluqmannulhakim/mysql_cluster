# FROM ubuntu:22.04
FROM nginx:latest

LABEL maintainer="luqman"
# WORKDIR /var/www

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
    lsb-release

## locales
RUN apt-get install -y \
    locales \
    && locale-gen \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen

## start here
# RUN service apparmor stop \
#     service apparmor teardown \
#     systemctl disable apparmor

# RUN wget https://repo.mysql.com/apt/ubuntu/pool/mysql-apt-config/m/mysql-apt-config/mysql-apt-config_0.8.24-1_all.deb
COPY ./mysql/apt-config/mysql-apt-config_0.8.24-1_all.deb /tmp/mysql-apt-config_0.8.24-1_all.deb
RUN dpkg -i /tmp/mysql-apt-config_0.8.24-1_all.deb 

RUN apt-get update
RUN apt-get install -y mysql-shell
# RUN systemctl start mysql

## Clean repo cache
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
RUN apt-get -y autoremove
RUN apt-get clean

# CMD ["bash"]