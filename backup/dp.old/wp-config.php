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
define('DB_NAME', 'mendelements_com_4');

/** MySQL database username */
define('DB_USER', 'mendelementscom4');

/** MySQL database password */
define('DB_PASSWORD', 'HAh!Jxnj');

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
define('AUTH_KEY',         'rLY9/7gn~feDe&X2%Qs2m4A?l?$FAW@xJe0a%wc*rKLDscU"K6+FBqeIZ^AHJ:vL');
define('SECURE_AUTH_KEY',  '|0:84VZT`pm_^3Ti?*2x;WLY$8yN"chCafwb`7k?m3U:^3v8YXRkKf#l)4DQ33)(');
define('LOGGED_IN_KEY',    't4/o3!j`TycSUjhiUI~z7+11q?VXMS5Newjr%~L_9T^0E_wADTw6a0P^o5^M3fYr');
define('NONCE_KEY',        '39q4jiPPbeJqkmAQ2lg0IkR*oWxVVuOcL@smgW$r@A)A;/NPv%@~bUUGU2b_|!cp');
define('AUTH_SALT',        '|ki!AsrN(noC5w?Jf8Gwfh*~9&MwKq&`Lb~u:sR(7LtekI%;V7QUy_wzFb9onntd');
define('SECURE_AUTH_SALT', 'J*Ao/6|1@O&QdxC;FZ;Idr)|t?zObo6mS/?B2kw#mvsO%6w~"qrhr)ufxOh`@KcC');
define('LOGGED_IN_SALT',   'K`n2t8hb(+*z/?H)B5DsSP1#!%W7WA:BIv1hU5i98XzK|aeUX5M%tWU$LX?HmbLq');
define('NONCE_SALT',       'SN7*lGcis0?5zA|a/NjW$hnLb`/0$OGK1@lXKQxpdrpK:S~u&D)G?H@D|/sS9BJ`');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_tehd65_';

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

