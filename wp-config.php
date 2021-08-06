<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'Elementor-addon' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '<ua[@_Km' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'vz76RiL5D5yz5S6sbVSTMyCelYQAQDocEJxhXvK8d9tWYemBCvVF68qnKqA4Gxkf' );
define( 'SECURE_AUTH_KEY',  'WE7vBVBdAC5IZKYnyjiGOGiIxXShMcdQjfi615kSInf4p2YaPDR41sA245A3pKx3' );
define( 'LOGGED_IN_KEY',    'bL5vWHn6deeggjryefogYzr4K9dv1x20uQPMH1JUcuUJkdl2pFVArCCwT8Sh1Cq5' );
define( 'NONCE_KEY',        'wl5HuoGB2OzCRwDBgp0Xz6lXsIUtzuQDUUZ2zKJiHF89vIkeOfVxCRI7ss2UFEuZ' );
define( 'AUTH_SALT',        'NhnMeNjGH59LVilonLOURQ5aP23hf3kFv1JeECksb8inQGzbl9DyYnrXxVVWXfLD' );
define( 'SECURE_AUTH_SALT', 'i25kMJPfLWr7nBHzFYkrbIVlnhC961uLYuT5v5hrH68D71VZqXSTHrYjlraw3TKH' );
define( 'LOGGED_IN_SALT',   'YKOjHyp50J7ZrdrtEBacoQjGVmTsEbEeWThZI9oadb4jSUyw9S15UFEMCx9PfT4w' );
define( 'NONCE_SALT',       'LXAvPjwwGvWGPuTfYtG53AszXQvxAYOR9Lhs936fKmzHS8OpFl6GRZojCVWvw3we' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
