# Using Docker as a development environment for Drupal projects

Includes Nginx, PHP-FPM, MariaDB, Redis and Solr.

## Getting started:

* Have Docker installed, including `docker-compose`
  * Recommended: use the official Docker installer if on macOS or Windows 10+
    as they provide improved file sharing
* Copy and edit as required `.env.development` to `.env` and `.salt.example` to `.salt`
* In the project root, run `docker-compose up`
* To stop hit `CTRL-C` and wait for the services to terminate (it's important)

To use Drupal's Drush or Console in another terminal run `docker-composer exec drupal /bin/bash`
and it will allow you to interact with Drupal from the shell as expected.
