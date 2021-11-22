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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dbsafespaces' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'admin' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Ph+g{-C 6UnnU9oFA6n(@~e4Fll^;!wg9%rz$Bmbr8D&w(/5*6}d+pV7V?QttK9r' );
define( 'SECURE_AUTH_KEY',  '4Nn:W?4g%21&N?k!D$EHTIF~Il[/!ppW<h].0StPsVm<z+`k3lUQ>,q3#u@XV 1_' );
define( 'LOGGED_IN_KEY',    ']91Ea%H4yD|QnY$lEIe`t!<y_n)^.fY{_=IfVI$XV6uZ2;+>:SlO:M%sMe_? -Nw' );
define( 'NONCE_KEY',        '6Vh~tI^BxF8@hb=4Q2vN{E{lp`~7UIqKIbiTM[W7uU0,!g^hNM4@g?t{]W*]Loz2' );
define( 'AUTH_SALT',        'XyvKE.NSkbltkmFG=t5}L+FVV,Gvk@LD5=e kqjz{/Il6*qxQV;n1l[`|AnZ?ZJD' );
define( 'SECURE_AUTH_SALT', 'eYrj|z%)WGNN67Ydxl{W;M(nMtI<}WE($RIIN!!GB51lk4$^VDUUlRNX2FlT+f+$' );
define( 'LOGGED_IN_SALT',   'Zt|&j7Fdt7/XCfhX/,a9x?EM1m27*m.FQ$lL?N0D?r4KI[CkJx/zF4i$IP}ZUtF0' );
define( 'NONCE_SALT',       'z.IqQbR%fg%sLye|}4{tD;1sK(<>, X0qA,TlNI=PQ%q@.NQQJW;W6Q`M92bYN]$' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'sf_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_MEMORY_LIMIT', '512M' );
define( 'WP_MAX_MEMORY_LIMIT', '1024M' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
/*define('WP_MEMORY_LIMIT', '256M');*/