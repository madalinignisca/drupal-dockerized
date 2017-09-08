# Using Docker as a development environment for Drupal projects

Includes Nginx, PHP-FPM, MariaDB, Redis and Solr.

## Getting started:

* Have Docker installed, including `docker-compose`
  * Recommended: use the official Docker installer if on macOS or Windows 10+
    as they provide improved file sharing
* Copy and edit as required `.env.development` to `.env` and `.salt.example` to `.salt`
* Default is the **minimal** installation. To use **standard** edit `docker/drupal/entrypoint.sh:19`
* In the project root, run `docker-compose up`
* To stop hit `CTRL-C` and wait for the services to terminate (it's important!)

To use Drupal's Drush or Console in another terminal run `docker-composer exec drupal /bin/bash`
and it will allow you to interact with Drupal from the shell as expected.

## TODO:

* mail capturing
  Look for **[Mailhog](https://hub.docker.com/r/mailhog/mailhog/)** with Docker.
* prepare alternative for production
  - app must be built in the image and not using shared folders!
    the reason is performance (actually on Linux this is barely noticeble)
  - doing builds might be concept similar to compilation in other programming languages
    might be interestring to take this aproach even in development as it would
    provide a big performance improvement on doing *site building*
* Documentation
  - Detailed documentation and workflow examples.
    possible a Youtube channel?

## Important to know and take action:

### Mail on production must use a 3rd party system
You should use a 3rd party system like Sendgrid or Mailgun. Both have modules for Drupal and are
fully supported and also have generous free packages.

Alternative, you could add a smtp docker container to your project and use that if you are so brave
enough to fight against different spam control configuration the most important Mail services use.
To take note, this way will fail in most times to deliver to Gmail, Outlook or Yahoo, but using the above suggestion, corectly configured, delivery will be guatanteed 100% in the INBOX and not the
Spam folder.
