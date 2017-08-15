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
define('DB_NAME', 'root_behat-example');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'example');

/** MySQL hostname */
define('DB_HOST', 'mysql.dev');

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
define('AUTH_KEY',         '*i,J1@L>s,n95*,(v931AA}#8RGwO#:o.tL!iEBEPYL< Y@cIpW8Pn,_-&[C.*zY');
define('SECURE_AUTH_KEY',  'oCqX/;LCe4;I1x?YHQ=0;g7S+!3KO Op)41E89w(bji/24/>7=KjByg!!X)_~}zP');
define('LOGGED_IN_KEY',    'LNK;0i)@uTWmjz|kkDKg)qWP0oZGVy*w<y1My>=-OYFPY$PSgAXN74[i*W%g{vVF');
define('NONCE_KEY',        'VNSK=vUtg:tx?-Cm]S3=(`Eu9dS{{2@$t9~wl$L1dg.@@SMs1If9C^!.42]SOfX)');
define('AUTH_SALT',        '1YLQH[WW2z[f1VD >ii9;UXx{A}I7krgM#Z]t/gREIaAqSlo%rO0|nutI+uAy=dB');
define('SECURE_AUTH_SALT', 'KKi0V*8HRY@]EVh-b`*/PB<,]J;a:wFq(e4[i;O(4=}j2:lj?4Yrb,V_0nxm,~R ');
define('LOGGED_IN_SALT',   '1mxZDXP[:F#05,Y^v Ms+d>mCD~7iKK%mXOAS;8S2c}{u9;zwHXp4P($26Ih%~)[');
define('NONCE_SALT',       '(.D1tK$(**A9A1BOA59LbS[KOmk lpBHiWKmG|sGaVnG=U&EpyEyY*^W eb$u8VY');

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

