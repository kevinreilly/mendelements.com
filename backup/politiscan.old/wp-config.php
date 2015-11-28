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
define('DB_NAME', 'mendelements_com_6');

/** MySQL database username */
define('DB_USER', 'mendelementscom6');

/** MySQL database password */
define('DB_PASSWORD', 'XA6jWTnM');

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
define('AUTH_KEY',         'y`H4ny#j6gfb0H_#|7rNQ8Mk|?rPeF%FXdfrnrxEp5m/*w*T07JdrLA/m*VTs:fo');
define('SECURE_AUTH_KEY',  'qcMS;D31?LJVluDlJ$vRH+YMAgseU40kQxD8SE%ttiX*wwK|A4d_+~T#89wy~??s');
define('LOGGED_IN_KEY',    'n~Smk;W7j/6Mj5C5e|Xj6kBlainS3H8I)I"kKVZ65|Xp2ReDUZ^gyKro0!_o_j+Q');
define('NONCE_KEY',        'H~~:+D+UifMyScDIFSeCFe$?N$!GbA$0Akru0PXiP7ZRAqw!fAjKESMT8K#APIwY');
define('AUTH_SALT',        'EV%I?scuZmhrDEMYBZTB:;H73KANETPOeYAK$Jrj"p/I9N`/F1dvv:SjkeUE5yOR');
define('SECURE_AUTH_SALT', '$hZERIu+n;;qAO@N&*x?!psy23t96cy2HR$as31X;77sHz?WAMNR|`_k:+9?:f9+');
define('LOGGED_IN_SALT',   'h@l3Q|Kz4eL7*y/*Z$Y*DQ@D2BHyd#6;/WjExb1:c4_2D;v|_trzK1VJ)bcm_95E');
define('NONCE_SALT',       '^2Vz^7;QB7F8r0G%RGA2Ne^R6BAO~kj*$/Wb?V@DvV^JkEALx37Ekr0;Fx1D$J(z');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_w8xciz_';

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

