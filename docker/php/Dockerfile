FROM php:7.1.9-fpm
RUN apt-get update; \
  fetchDeps=' \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng12-dev \
		libpq-dev \
  '; \
  apt-get install -y --no-install-recommends $fetchDeps; \
  rm -rf /var/lib/apt/lists/*; \
  docker-php-ext-install -j$(nproc) iconv mbstring mcrypt; \
  docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/; \
  docker-php-ext-install -j$(nproc) gd mbstring opcache pdo pdo_mysql zip; \
  pecl install redis-3.1.3; \
  pecl install apcu-5.1.8; \
  pecl install xdebug-2.5.5; \
  docker-php-ext-enable redis apcu xdebug

ADD php.ini /usr/local/etc/php/php.ini

WORKDIR /app
