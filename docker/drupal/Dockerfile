FROM 16nsk/drupal-php:1.0.0

ENV WATCHMAN_VERSION="4.7.0"
ENV COMPOSER_VERSION="1.4.2"
ENV DRUSH_VERSION="8.1.12"

RUN wget https://github.com/composer/composer/releases/download/"$COMPOSER_VERSION"/composer.phar; \
  mv composer.phar /usr/local/bin/composer; \
  chmod +x /usr/local/bin/composer

RUN wget https://github.com/drush-ops/drush/releases/download/"$DRUSH_VERSION"/drush.phar; \
  mv drush.phar /usr/local/bin/drush; \
  chmod +x /usr/local/bin/drush

# Install Watchman https://facebook.github.io/watchman
# RUN set -xe; \
#   fetchDeps=' \
#     wget \
#     gcc \
#     make \
#     autoconf \
#     python-dev \
#     libpython-dev \
#     autotools-dev \
#     automake \
#   '; \
#   apt-get update; \
#   apt-get install -y --no-install-recommends $fetchDeps mysql-client; \
#   rm -rf /var/lib/apt/lists/*; \
#   mkdir -p /usr/src; \
#   cd /usr/src; \
#   wget -O watchman.tar.gz https://github.com/facebook/watchman/archive/v"$WATCHMAN_VERSION".tar.gz; \
#   tar zxvf watchman.tar.gz; \
#   rm watchman.tar.gz; \
#   cd watchman-"$WATCHMAN_VERSION"; \
#   ./autogen.sh; \
#   ./configure; \
#   make; \
#   make install; \
#   apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false $fetchDeps; \
#   cd ..; \
#   rm -rf watchman-"$WATCHMAN_VERSION"

# https://github.com/moby/moby/issues/3465
# UNSET EXPOSE

ADD entrypoint.sh /opt/entrypoint.sh
RUN chmod a+x /opt/entrypoint.sh

ENTRYPOINT ["/opt/entrypoint.sh"]

CMD ["watchman", "-f",  "watch", "/app"]
