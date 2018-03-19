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
define('DB_NAME', 'theo');

/** MySQL database username */
define('DB_USER', 'theoadmin');

/** MySQL database password */
define('DB_PASSWORD', 'Super66admin!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '0)2 9W09]1bhN%xkL!Rd`f&ys#Atlk+v!n&;*^R,[v}TC@ddSLx=gJ=XzRkT/aH3');
define('SECURE_AUTH_KEY',  '@GRs%~/)_sY:GM*~WzqfQYBe+Z<i>,+^SDObcW-e.UI6dbGLvN4qTwg!JykR;k6f');
define('LOGGED_IN_KEY',    'Ji<[.4_;0~$2WCIsz9hG ZwJzg>5`wJa4#wZJVDw}Z$4`(yBx;&f.Sl&^Punc7e[');
define('NONCE_KEY',        'X3Cs:r?LG3ubV`97ZCJS>XS|.,GqdvzgR=A`LKO}NEw):<VtYKV@,GM{o5=Mj%=V');
define('AUTH_SALT',        '4-`ZT*q]U/m^3M`TcI-Jc;9yAiz?P8PwNp^.xF4mfR4Em@ABUONZCWElm`F1M~v(');
define('SECURE_AUTH_SALT', 'nT!ID wsov8@r//B@5jukj2_Do7.BE.yuIN)w#ZM[+|,Si]ybq|N^<V0HF*c*8Dh');
define('LOGGED_IN_SALT',   '&ufXIkLC;r*sC?D:.?4yS[67HCw3P)iE3r_<OnWjGDApp_Fi{:}m<F-BGA_} lHE');
define('NONCE_SALT',       '53dIo8OEV+6xSvEPEa4w*<icnx0WhpDFdDRzSuVPL6&o[q):(C0lv(pt[Ol~Gj$_');

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
