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
define('DB_NAME', 'mendelements_com_2');

/** MySQL database username */
define('DB_USER', 'mendelementscom2');

/** MySQL database password */
define('DB_PASSWORD', '65Wkgwcw');

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
define('AUTH_KEY',         '2S5VW0cC9El29p|l+m%E5e_22xqow;:)20D0U:&0(mFj&PCfG|Hcs;w6Jy/U(kuw');
define('SECURE_AUTH_KEY',  'z5p^iyyBeAy@tEvn7&4@tCGIXZ0+OcZa!LC%~F%u2:686qT&_4l#DTHZkaSCB~5@');
define('LOGGED_IN_KEY',    'Lt7c;huGOoBFuaTVXgLjC(WX;bZ_7M~wJ3Yt2)GrSiPdu:*jJdyn|N;c(EVaTvgL');
define('NONCE_KEY',        'kc!6b#DT28HCwy6JiIJ1N8wLx*8$6hv:H;LG%^pJeu#;5rWB8z$eN7wHQzD5?C~Q');
define('AUTH_SALT',        'OElc_aR*yW@1$xAT0:AD38^GeJs:~%+8UcF54ENF0yaH&+gYAyl"79EW^6RJ;Z/$');
define('SECURE_AUTH_SALT', '|MDn6AIqzLfDO?99KRGDk8VJ/;E1I7e$KBA~hg:tAaSES_q`%C726mteyd~FT$JD');
define('LOGGED_IN_SALT',   ')`TL#HC9?!(;*#$Hp0WiuT#x;;b:;G~kWRB:aP3CIkPMKXbe*9QS*uZNRO"nj!X5');
define('NONCE_SALT',       'uB!m~Tbjvu9dd&#qOt+lBy+!Cb#kxvbz6@Q%:iodo2$Cn;LdY|13(i(^%b9IQgbt');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_dj695k_';

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

