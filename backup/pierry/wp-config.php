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
define('DB_NAME', 'mendelements_com_8');

/** MySQL database username */
define('DB_USER', 'ixnpu3uz');

/** MySQL database password */
define('DB_PASSWORD', 'xG28Bjxm');

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
define('AUTH_KEY',         'tk0D$d7r:m!nn6p)?R^C$lr7(dL8K+niP|)AGc~HgX%N)UzTJZ`p!6sewN^5Lpq8');
define('SECURE_AUTH_KEY',  '&_g8;OTq69`W9R11$Rv^&$$IjbA|9Uqd6vBhrBrJ@JH|?Z2l4DoNy+unKW8+)l|m');
define('LOGGED_IN_KEY',    'J8/2uN;nn4#:!ku)xV:FvongC/*N@hx;as`3fawHU!9_d"/3srJM8rF*d`vyIjxh');
define('NONCE_KEY',        'N!ZCOeb++Alo/XaP7w;$g43g?4O)c*f"?~9ijduZ@NSPM$4Lt/@2mAF8Ak6BFoaa');
define('AUTH_SALT',        '*X/`N0f+CvmlR|^UpVj3vph+"X4s8tkaDLKo0K0fyasWPSSCP%QL)6SZx~+FB~ei');
define('SECURE_AUTH_SALT', 'Kd:j$ed/4KRcS:TZI8!T**qP|yFjGmoThvIka^I!krr%;mXsq9m~ZFDe:5wQB4mh');
define('LOGGED_IN_SALT',   'sTvCzg5!@M%0TL|NPgs2(JG*`EmOK?uFp;)Ff+#9@DbzP3IpW1uvP9IfuGu:/@eJ');
define('NONCE_SALT',       'Xe*nsDwfvMbVbn4M8jMhJHT(^ej*0uTINK3g/iDpqkQW7VkM5FDR9i~H3DD+kAOz');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_jfapaz_';

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

