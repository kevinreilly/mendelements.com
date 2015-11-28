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
define('DB_NAME', 'mendelements_com');

/** MySQL database username */
define('DB_USER', 'mendelementscom');

/** MySQL database password */
define('DB_PASSWORD', 'LcCQXTSf');

/** MySQL hostname */
define('DB_HOST', 'mysql.mendelements.com');

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
define('AUTH_KEY',         'Qw*l1gSCQ**G#RMZ7e~y|wu8Js/NM&l)EY4e_h;?omBBbkFl|ne($9+vNmlHmSvF');
define('SECURE_AUTH_KEY',  'VURhb(+E~Vt^^Bha0Y;r@dJ7/0e*2:v)Lgn$5l8le^#br;O1UlCVxL:G0meFdsv#');
define('LOGGED_IN_KEY',    'EuGr2|P#hl70vh;Q^*Ealmm^^1R^^IG!;m!)HB@Q(Mv#eAaxi(*)&|+jVI^q@)tW');
define('NONCE_KEY',        '|+URHp0|_m0o5l(@9ioT9~Q4zjt#92kw8AUJPgwv7YySr4Z8+5r!JwimsbdjK52i');
define('AUTH_SALT',        'K;nE@C1iuB^49HAi/y/FRzeX0h;6lmHTATmDlwRh_q4L^dPa:C$EW@_Um?ubd9pv');
define('SECURE_AUTH_SALT', 'Bax:/@("+;OA/e/B/4HeudO7S3Cz2e_wJ_NT*"~N;_KzoQj8q`*0QG)AZgfiUAw3');
define('LOGGED_IN_SALT',   'ko""HFJ|BZl~tB$8SoIeb$FoWH&:`@piJ/u!?uKUKBcHWekQ@G9FlH@orjTL@*a8');
define('NONCE_SALT',       'bSMAG5A?9Dx_;~XN"!1V_m2QAyujE11KHVRf6HoGPV9~q#k?MDx7C58z5dhKgN0;');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_cy9n9s_';

/**
 * Limits total Post Revisions saved per Post/Page.
 * Change or comment this line out if you would like to increase or remove the limit.
 */
define('WP_POST_REVISIONS',  10);

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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

