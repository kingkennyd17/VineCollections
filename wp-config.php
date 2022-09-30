<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'vinewears2' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'if}>uxhBo{f*T_f@GX3fu%s;_&$7,9$tzN[S{Z4|9gkQ83c:Bw8l%FyP@U9Fz0c!' );
define( 'SECURE_AUTH_KEY',  'v)XzC{Y/~Z;psr&B_bYBit(8mf+Ol}eD96O^/1vr5A$Kp}dp-209jQ)O.m1`UmPc' );
define( 'LOGGED_IN_KEY',    ';4Ou5]Av%*7Io0tHG.ODMZ+YL8l>?5jX3.*pX5RB$hN+qp-dal3I*:f` QI@utkD' );
define( 'NONCE_KEY',        '0[];7S1^Z[} pIA1FfEa~-rTv=i,9C2`K!~dp+1whtk=8+?D+YdNXRBqU@oiQ6^K' );
define( 'AUTH_SALT',        'ej2Tp+j0V6p i=o5~CVeVky^hQFwfWI}oU?8u,2x_Irq6(V)9NdSOrr;#$:|,*Kq' );
define( 'SECURE_AUTH_SALT', 'DLl(-PjC4qS^yz`m8L[6,J;FKhPZa0yF)_Uu $v.@r?Xcn}mLxDUM2&x=drq<:bk' );
define( 'LOGGED_IN_SALT',   'KN8MlZBcRZeqND8-a7E2a-~T22Q9%3K[~zk}QAj%?L$_Y6OD9fUBslo_+l|:9FXJ' );
define( 'NONCE_SALT',       'F8A5p8a)wpm8>:zXU8#AL%-t9`sS@o}$t.XVl_M$fv/|ER mI1?LfGce7(%V4K~r' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
