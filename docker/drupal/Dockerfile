FROM 16nsk/php:1.0.0

ENV COMPOSER_VERSION 1.5.1
ENV DRUSH_VERSION 8.1.13
ENV DRUPAL_CONSOLE_LAUNCHER_VERSION 1.0.2

# Install Watchman https://facebook.github.io/watchman
RUN set -xe; \
  apt-get update; \
  apt-get install -y --no-install-recommends mysql-client wget; \
  rm -rf /var/lib/apt/lists/*

RUN wget https://github.com/composer/composer/releases/download/1.5.1/composer.phar; \
  mv composer.phar /usr/local/bin/composer; \
  chmod +x /usr/local/bin/composer

RUN wget https://github.com/drush-ops/drush/releases/download/8.1.13/drush.phar; \
  mv drush.phar /usr/local/bin/drush; \
  chmod +x /usr/local/bin/drush

# We have to wait until we can target exact versions of it...
RUN curl https://drupalconsole.com/installer -L -o drupal.phar; \
  mv drupal.phar /usr/local/bin/drupal; \
  chmod +x /usr/local/bin/drupal

# https://github.com/moby/moby/issues/3465
# UNSET EXPOSE

ADD entrypoint.sh /opt/entrypoint.sh
RUN chmod a+x /opt/entrypoint.sh

ENTRYPOINT ["/opt/entrypoint.sh"]

CMD ["tail", "-f",  "/dev/null"]
