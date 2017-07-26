FROM 16nsk/drupal-php:1.0.0

ENV WATCHMAN_VERSION 4.7.0
ENV WATCHMAN_URL="https://github.com/facebook/watchman/archive/v4.7.0.tar.gz"

# Install Watchman https://facebook.github.io/watchman
RUN set -xe; \
  fetchDeps=' \
    wget \
    gcc \
    make \
    autoconf \
    python-dev \
    libpython-dev \
    autotools-dev \
    automake \
  '; \
  apt-get update; \
  apt-get install -y --no-install-recommends $fetchDeps; \
  rm -rf /var/lib/apt/lists/*; \
  mkdir -p /usr/src; \
  cd /usr/src; \
  wget -O watchman.tar.gz "$WATCHMAN_URL"; \
  tar zxvf watchman.tar.gz; \
  rm watchman.tar.gz; \
  cd watchman-"$WATCHMAN_VERSION"; \
  ./autogen.sh; \
  ./configure; \
  make; \
  make install; \
  apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false $fetchDeps; \
  cd ..; \
  rm -rf watchman-"$WATCHMAN_VERSION"

# https://github.com/moby/moby/issues/3465
# UNSET EXPOSE


CMD ["watchman", "-f",  "watch", "/app"]
