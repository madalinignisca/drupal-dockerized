FROM php:7.1.7-fpm
RUN apt-get update; \
  fetchDeps=' \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng12-dev \
  '; \
  apt-get install -y --no-install-recommends $fetchDeps; \
  rm -rf /var/lib/apt/lists/*; \
  docker-php-ext-install -j$(nproc) iconv mbstring mcrypt; \
  docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/; \
  docker-php-ext-install -j$(nproc) gd; \
  apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false $fetchDeps;
