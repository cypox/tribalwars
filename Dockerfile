FROM ubuntu:24.04

ENV DEBIAN_FRONTEND=noninteractive \
    TZ=America/Sao_Paulo

RUN apt-get update && apt-get install -y \
    apache2 \
    curl \
    mysql-client \
    mysql-server \
    php8.3 \
    libapache2-mod-php8.3 \
    php8.3-gd \
    php8.3-mysql \
    php8.3-curl \
    php8.3-mbstring \
    php8.3-xml \
    unzip \
 && a2enmod rewrite headers \
 && mkdir -p /var/run/mysqld \
 && chown -R mysql:mysql /var/run/mysqld /var/lib/mysql \
 && rm -rf /var/lib/apt/lists/*

COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/mysql/tribalwars.cnf /etc/mysql/conf.d/tribalwars.cnf
COPY docker/web/start-apache.sh /usr/local/bin/start-apache.sh
COPY tribalwars /var/www/html/tribalwars
COPY database/tribalwars_main.sql /opt/bootstrap/tribalwars_main.sql
COPY database/tribalwars_world.sql /opt/bootstrap/tribalwars_world.sql
RUN chmod +x /usr/local/bin/start-apache.sh

WORKDIR /var/www/html/tribalwars
EXPOSE 80 3306
ENTRYPOINT ["/usr/local/bin/start-apache.sh"]
