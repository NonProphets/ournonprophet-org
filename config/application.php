<?php

/** @var string Directory containing all of the site's files */
$root_dir = dirname(__DIR__);

/** @var string Document Root */
$webroot_dir = $root_dir . '/web';

/**
 * Expose global env() function from oscarotero/env
 */
Env::init();

/**
 * Use Dotenv to set required environment variables and load .env file in root
 */
$dotenv = new Dotenv\Dotenv($root_dir);
if (file_exists($root_dir . '/.env')) {
    $dotenv->load();
    $dotenv->required(['DB_NAME', 'DB_USER', 'DB_PASSWORD', 'WP_HOME', 'WP_SITEURL']);
}

/**
 * Set up our global environment constant and load its config first
 * Default: production
 */
define('WP_ENV', env('WP_ENV') ?: 'production');

$env_config = __DIR__ . '/environments/' . WP_ENV . '.php';

if (file_exists($env_config)) {
    require_once $env_config;
}

/**
 * URLs
 */
define('WP_HOME', env('WP_HOME'));
define('WP_SITEURL', env('WP_SITEURL'));

/**
 * Custom Content Directory
 */
define('CONTENT_DIR', '/app');
define('WP_CONTENT_DIR', $webroot_dir . CONTENT_DIR);
define('WP_CONTENT_URL', WP_HOME . CONTENT_DIR);
define('WPMU_PLUGIN_DIR', WP_CONTENT_DIR . '/mu-plugins' );

/**
 * DB settings
 */
define('DB_NAME', env('DB_NAME'));
define('DB_USER', env('DB_USER'));
define('DB_PASSWORD', env('DB_PASSWORD'));
define('DB_HOST', env('DB_HOST') ?: 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
$table_prefix = env('DB_PREFIX') ?: 'wp_';

/**
 * Authentication Unique Keys and Salts
 */
define('AUTH_KEY', env('AUTH_KEY'));
define('SECURE_AUTH_KEY', env('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY', env('LOGGED_IN_KEY'));
define('NONCE_KEY', env('NONCE_KEY'));
define('AUTH_SALT', env('AUTH_SALT'));
define('SECURE_AUTH_SALT', env('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT', env('LOGGED_IN_SALT'));
define('NONCE_SALT', env('NONCE_SALT'));

/**
 * Amazon S3 Settings
 */
define( 'S3_UPLOADS_BUCKET', env('S3_UPLOADS_BUCKET') );
define( 'S3_UPLOADS_KEY', env('S3_UPLOADS_KEY') );
define( 'S3_UPLOADS_SECRET', env('S3_UPLOADS_SECRET') );
define( 'S3_UPLOADS_REGION', env('S3_UPLOADS_REGION') );
define( 'S3_UPLOADS_HTTP_CACHE_CONTROL', 365 * 24 * 60 * 60 );
define( 'S3_UPLOADS_BUCKET_URL', env('S3_UPLOADS_BUCKET_URL') );

/**
 * Custom Settings
 */
define('AUTOMATIC_UPDATER_DISABLED', true);
define('DISABLE_WP_CRON', env('DISABLE_WP_CRON') ?: false);
define('DISALLOW_FILE_EDIT', true);
define( 'WP_POST_REVISIONS', 10 );
define( 'WP_MEMORY_LIMIT', '128M' );
define( 'WP_MAX_MEMORY_LIMIT', '256M' );
define( 'EMPTY_TRASH_DAYS', 15 );
define( 'FORCE_SSL_ADMIN', true );
define( 'SUNRISE', true);

/*
Multisite Settings
*/
define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true); // Set to false if using subdirectories
define('DOMAIN_CURRENT_SITE', env('DOMAIN_CURRENT_SITE'));
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
// define( 'NOBLOGREDIRECT', env('WP_HOME')); // Uncomment this after deployment to prevent 404s

/**
 * Bootstrap WordPress
 */
if (!defined('ABSPATH')) {
    define('ABSPATH', $webroot_dir . '/wp/');
}
