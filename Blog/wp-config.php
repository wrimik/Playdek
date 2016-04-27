<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'i550157_wp1');

/** MySQL database username */
define('DB_USER', 'i550157_wp1');

/** MySQL database password */
define('DB_PASSWORD', 'H~*EmLRxgA06*~4');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'xL7zxWHQlUz8lUMO8DTOCTSnblZBxPEmbMfpwb4OlbSWiNpMVsYnanzu4VAiAr9y');
define('SECURE_AUTH_KEY',  'k7fJSMEk3SCN2IFyVceV8YSF89Q6x2wCTmodc4dLlMLbWNf1cgf7JjA5SVN3qTzE');
define('LOGGED_IN_KEY',    'RDUsLPK8O6jrQrYFX6qGeffLbcQCq1YhwhedHRTDpBtGxRIrCkZjX3YK0NMCUX2O');
define('NONCE_KEY',        '2m7WIRAwmDSGkD7cgeeGmM8jOUdfJpQgM3M9KhSkjWMKmFgSP8HbtjamQzw1c7mK');
define('AUTH_SALT',        '39NJWi61DxbmBhbzqndIIu3EkQlAdPKIQyCaxCy6RalsGYbbR1zSUkJ3c7OtSpok');
define('SECURE_AUTH_SALT', '2WruuklJ1GLY5ji3sBzb9W6o2x8DMqXQaI5Hs9KvmkvuwDfaIQYZeczTxg3Q0EFT');
define('LOGGED_IN_SALT',   'GQz7n1WNH3JT090K1b37GZnl7Ci3z0aA8WDPPAUNkHJCZ2gI8jglB0oQPYt19aP2');
define('NONCE_SALT',       'IYkWIuqV0IvtNlB6RRVztmA3ETCUFx9rwCNLeBXs61SonRt1WyRBd6UJ2x4GT1M9');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
