<?php

/**
 * @file
 * Local development override configuration feature.
 *
 * To activate this feature, copy and rename it such that its path plus
 * filename is 'sites/default/settings.local.php'. Then, go to the bottom of
 * 'sites/default/settings.php' and uncomment the commented lines that mention
 * 'settings.local.php'.
 *
 * If you are using a site name in the path, such as 'sites/example.com', copy
 * this file to 'sites/example.com/settings.local.php', and uncomment the lines
 * at the bottom of 'sites/example.com/settings.php'.
 */

/**
 * Assertions.
 *
 * The Drupal project primarily uses runtime assertions to enforce the
 * expectations of the API by failing when incorrect calls are made by code
 * under development.
 *
 * @see http://php.net/assert
 * @see https://www.drupal.org/node/2492225
 *
 * If you are using PHP 7.0 it is strongly recommended that you set
 * zend.assertions=1 in the PHP.ini file (It cannot be changed from .htaccess
 * or runtime) on development machines and to 0 in production.
 *
 * @see https://wiki.php.net/rfc/expectations
 */
assert_options(ASSERT_ACTIVE, TRUE);
\Drupal\Component\Assertion\Handle::register();

/**
 * Enable local development services.
 */
# $settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.yml';

/**
 * Show all error messages, with backtrace information.
 *
 * In case the error level could not be fetched from the database, as for
 * example the database connection failed, we rely only on this value.
 */
# $config['system.logging']['error_level'] = 'verbose';

/**
 * Disable CSS and JS aggregation.
 */
# $config['system.performance']['css']['preprocess'] = FALSE;
# $config['system.performance']['js']['preprocess'] = FALSE;

/**
 * Disable the render cache (this includes the page cache).
 *
 * Note: you should test with the render cache enabled, to ensure the correct
 * cacheability metadata is present. However, in the early stages of
 * development, you may want to disable it.
 *
 * This setting disables the render cache by using the Null cache back-end
 * defined by the development.services.yml file above.
 *
 * Do not use this setting until after the site is installed.
 */
# $settings['cache']['bins']['render'] = 'cache.backend.null';

/**
 * Disable caching for migrations.
 *
 * Uncomment the code below to only store migrations in memory and not in the
 * database. This makes it easier to develop custom migrations.
 */
# $settings['cache']['bins']['discovery_migration'] = 'cache.backend.memory';

/**
 * Disable Dynamic Page Cache.
 *
 * Note: you should test with Dynamic Page Cache enabled, to ensure the correct
 * cacheability metadata is present (and hence the expected behavior). However,
 * in the early stages of development, you may want to disable it.
 */
# $settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';

/**
 * Allow test modules and themes to be installed.
 *
 * Drupal ignores test modules and themes by default for performance reasons.
 * During development it can be useful to install test extensions for debugging
 * purposes.
 */
# $settings['extension_discovery_scan_tests'] = TRUE;

/**
 * Enable access to rebuild.php.
 *
 * This setting can be enabled to allow Drupal's php and database cached
 * storage to be cleared via the rebuild.php page. Access to this page can also
 * be gained by generating a query string from rebuild_token_calculator.sh and
 * using these parameters in a request to rebuild.php.
 */
$settings['rebuild_access'] = TRUE;

/**
 * Skip file system permissions hardening.
 *
 * The system module will periodically check the permissions of your site's
 * site directory to ensure that it is not writable by the website user. For
 * sites that are managed with a version control system, this can cause problems
 * when files in that directory such as settings.php are updated, because the
 * user pulling in the changes won't have permissions to modify files in the
 * directory.
 */
$settings['skip_permissions_hardening'] = TRUE;

/**
 * Trusted host configuration.
 */
$settings['trusted_host_patterns'] = array(
  '^127\.0\.0\.1$',
  '^localhost$',
);

/**
 * Databases
 */
$databases['default']['default'] = array (
  'database' => 'drupal',
  'username' => 'drupal',
  'password' => 'drupal',
  'prefix' => '',
  'host' => 'db',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);

/**
 * Redis
 *
 * Disabled by default as it fails new installations.
 * Enable it once required.
 */
# $settings['redis.connection']['interface'] = 'PhpRedis'; // Can be "Predis".
# $settings['redis.connection']['host']      = 'cache';  // Your Redis instance hostname.
# $settings['cache']['default'] = 'cache.backend.redis';
// Always set the fast backend for bootstrap, discover and config, otherwise
// this gets lost when redis is enabled.
# $settings['cache']['bins']['bootstrap'] = 'cache.backend.chainedfast';
# $settings['cache']['bins']['discovery'] = 'cache.backend.chainedfast';
# $settings['cache']['bins']['config'] = 'cache.backend.chainedfast';
# $settings['container_yamls'][] = 'web/default/redis.services.yml';

/**
 * Solr configuration
 */
$config['search_api.server.docker'] = [
  'backend_config' => [
    'connector_config' => [
      'host' => 'search',
      'path' => '/solr',
      'core' => 'drupal',
      'port' => '8983',
    ],
  ],
];

/**
 * S3 replacement service
 *
 * @TODO enhance documentation on and make reference to the official module
 */

$settings['flysystem'] = [
  'local.public' => [
    'driver' => 'local',
    'config' => [
      'root' => 'files',
      'public' => TRUE,  
      'name' => 'Local Public',
      'description' => 'Development flysystem storage',
      'cache' => FALSE,
      'serve_js' => TRUE,
      'serve_css' => TRUE,
    ]
  ],
  'local.private' => [
    'driver' => 'local',
    'config' => [
      'root' => '../files/private',
      'name' => 'Local Private',
      'description' => 'Development flysystem storage',
      'cache' => FALSE,
    ]
  ],
  // Enable this and make sure to set the right values in .env
  // 's3.public' => [
  //   'driver' => 's3',
  //   'config' => [
  //     'key'    => getenv('AWS_ACCESS_KEY_ID'),
  //     'secret' => getenv('AWS_SECRET_ACCESS_KEY'),
  //     'region' => getenv('AWS_REGION'),
  //     'bucket' => getenv('AWS_BUCKET_PUBLIC'),
  //     'public' => TRUE,
  //   ],
  //   'cache' => TRUE, // Creates a metadata cache to speed up lookups.
  // ],
  // 's3.private' => [
  //   'driver' => 's3',
  //   'config' => [
  //     'key'    => getenv('AWS_ACCESS_KEY_ID'),
  //     'secret' => getenv('AWS_SECRET_ACCESS_KEY'),
  //     'region' => getenv('AWS_REGION'),
  //     'bucket' => getenv('AWS_BUCKET_PRIVATE'),
  //     'public' => TRUE,
  //   ],
  //   'cache' => TRUE, // Creates a metadata cache to speed up lookups.
  // ],
];
$settings['flysystem']['public'] = $settings['flysystem']['local.public'];
$settings['flysystem']['private'] = $settings['flysystem']['local.public'];
