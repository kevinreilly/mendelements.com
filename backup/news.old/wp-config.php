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
define('DB_NAME', 'mendelements_com_5');

/** MySQL database username */
define('DB_USER', 'mendelementscom5');

/** MySQL database password */
define('DB_PASSWORD', '3*v2rnCT');

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
define('AUTH_KEY',         'yzs#le*yVi_j:s)AyD1*#LsqJB:ZU@G36cFJNL?LZ*73mxY2@O1%Nr7d8LI;QZ5O');
define('SECURE_AUTH_KEY',  'fDIEfe~VCYodmBN7rips/Rtv6ErNbC#`gRP7(@;moXkWExa_^#^vOOlW41^|I5$D');
define('LOGGED_IN_KEY',    'OTM1):oZ*^VuHjKn)H1xDExahPtMoMhUTPdv8Az1l&)Ic@r3~WLuv?&X(cS:RFu:');
define('NONCE_KEY',        '4W0vD!K%p18PJIH"GV%m03!|al0LPq/T)KrHW2;d2YRclA(1O*NM1(0CflnX~a|e');
define('AUTH_SALT',        '3Uyf6HBTly"zC5T&JC8Pu$MK^i?%mhd#2`azH2r`*W8Co1gXSK43nQeyx9U7z#R!');
define('SECURE_AUTH_SALT', '~U%kraq3wcN?Z&LiCj8IaMDVza0+7UENBxwKYrkHr1x:~vjvHOv00SSXo;2LsZ#y');
define('LOGGED_IN_SALT',   'jX;ucXCan0q/4W;VWh4yuumitDy2_M;a7oa`5Hyjd;"4xkH72q1Nqz3*!~VmVQH_');
define('NONCE_SALT',       '86mJFNsv/youQYpqI_laU_YK5ew/?ubHVuZNkb/BDY7HjP6(pye+c0~nsjC6RqKf');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_babtr9_';

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

