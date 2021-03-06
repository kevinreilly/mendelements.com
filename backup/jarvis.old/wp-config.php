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
define('DB_NAME', 'mendelements_com_10');

/** MySQL database username */
define('DB_USER', 'wzbpgi9');

/** MySQL database password */
define('DB_PASSWORD', 'qSNGLLtg');

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
define('AUTH_KEY',         'aKte%J009p4?/yQ$aoK(Z_EQDGqJLoHr(12Qz/DFq4KMXLL!t$?QWNk|s30I0JL6');
define('SECURE_AUTH_KEY',  '39XtM!dNghT?wp+9xEIUhyFMGk29cae(O1JnqUr8/TJSb6U841lxtAL)EmXk$KZ1');
define('LOGGED_IN_KEY',    '!f!d$8OU6?#2eR3z/0lDjHv1oSXsgmtfrEjj6DoC1p^2aYg~XrAP%aW:W?_QA^T(');
define('NONCE_KEY',        '_Up+y?hgis~*7:|CoQENH(0"/b$de3?sD6#hNrVlLCW#IE%r3jVLPY2e+oo:&7$K');
define('AUTH_SALT',        'n!F5:GHrE5du1?v66geETE2IS8hf)AVZ4rj(oagU:`QMFspM;y*RVE7K$Z*m_NkO');
define('SECURE_AUTH_SALT', 'x~oHZZR/KGCRRsS*Y+7@t@9/!dhn*fX%wjfvOyHw$!ogYi#RO*XS9Qx1/7R+15oh');
define('LOGGED_IN_SALT',   '7"Wa?XmkEmWf0#hsLt2~$i!uvVavX(@?Kf$kfXBQQqCvm|CT#x4OxhfS&y!PERgC');
define('NONCE_SALT',       'nxA3ogaFIp0zB1n5U`^KNYCIyM*|4#4O!FUYB*_Z^g!Uyk3tRiS;p3jmq?bOPXl_');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_gfwbsf_';

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

