FROM keittirat/nds-php7:debian-mongo-node

WORKDIR /var/www/html/rdu-community

COPY . /var/www/html/rdu-community

RUN cd /var/www/html/rdu-community
RUN cp .env.example .env
RUN composer.phar install
RUN npm update && npm install
RUN php artisan key:generate
RUN npm run prod

# install git service to version retrievable and clear cache
RUN apt-get update && apt-get install -y git
RUN apt-get autoremove -y gcc g++ perl make nodejs python && apt-get autoclean && rm -rf /tmp/*

VOLUME /var/www/html
