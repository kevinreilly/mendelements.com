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
define('DB_NAME', 'mendelements_com_7');

/** MySQL database username */
define('DB_USER', 'mendelementscom7');

/** MySQL database password */
define('DB_PASSWORD', 'wBEEFASC');

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
define('AUTH_KEY',         'cL2_/OQc7ZBR!|4@3$19bnS7VnVq2m+jKAQ6p#Z4pgYGmMb;QEBOG`Q|e!Bl+`s^');
define('SECURE_AUTH_KEY',  '?HAIN;|jIpFg/zoemZ"@PfjIwD|0y+@kC;$tUtB7zhyND9Ei5gpCAu|vo/xwqry?');
define('LOGGED_IN_KEY',    'Y$mIsUMaCBtOsjGM?weK$o0yVYV?(RSQ&xNd"#Xi4+rSet76;JFTOVuh%kfb46gw');
define('NONCE_KEY',        'YmL|U$0;1_GSUd5%3nMQp!R7XzRl~gMWI~+xpOd"@lWJw?t3C:V@@*IcE2u)Np3J');
define('AUTH_SALT',        '%afy"r(hIk)zuJKbiIWu!ZN6*7qI/0a`"|!beAz"Q4S)jX#ZFCK5FS__^j"Ztj(`');
define('SECURE_AUTH_SALT', 'e1ZQ~YhX@CHc2an8~tTNTLS25((6Yp4ErDbXZjy4Sc@*:YYtMWu21oe1XPfUJVCY');
define('LOGGED_IN_SALT',   'PetE6;1mkSvub%;veGuH1q:nkoazZW(H3M8G2$9lxRvu@@j/Th855zoJ|D55c@gd');
define('NONCE_SALT',       '3U/rA|apGfs!Z(GA6oB_XOt:7yyano&neKq7M!:B1@X?lw"NA;?PCGlUP55^80a7');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_9gfeze_';

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

