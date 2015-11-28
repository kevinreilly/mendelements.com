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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'pierryemail');

/** MySQL database username */
define('DB_USER', 'kreilly253');

/** MySQL database password */
define('DB_PASSWORD', 'Douglas2');

/** MySQL hostname */
define('DB_HOST', 'pierryemail.mendelements.com');

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
define('AUTH_KEY',         'b VMehprFbo:@Ei89bqgauL2koT1)L`sku0D>_4<d|yv=dqlX];OY 8));Ch6|!-');
define('SECURE_AUTH_KEY',  'r^OA)1&gmX5-^-obdLXee+-`Etmn{?/wt$V|;TC<*i:}b!20_CR BNwgb-9$z8e@');
define('LOGGED_IN_KEY',    '0q[q{X71Cj+J.UF`G)bl,j5i9`?-nVmqFLDdQ=Qi{Rt.0HT+q@9_(P< xJ146C N');
define('NONCE_KEY',        'x7`7bg$hft2((fR=a5--[|iX?_3t+r?!5D}_9!R%d<j_x./]+/q>< K#[RsjKA`3');
define('AUTH_SALT',        '|Y!*9V;*~$ ?Kx=J.Gl%z9rUOV9)a-;SMNC<s):nV}<CzX=E.OLn:=rc~FXle}Pb');
define('SECURE_AUTH_SALT', 'Ca}u Bpn8z/4#FR9C1-oI@mKW71L+hk^p<cMJm|q^]9G;c>ObP[.FB3j[N+GO.:Q');
define('LOGGED_IN_SALT',   't#J pJ|DnO:QhAB@9bL;d8;uEIeVNVEu1c;!uP(#P$?crbq0zp%[Fl^[G/;,9lw:');
define('NONCE_SALT',       'Ox>,@JA=&D;8x>s-L:29$kY:T;WN*+Er8Jb&SDQ8|0c]RmpY42_j))NDn`+ovVXx');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
