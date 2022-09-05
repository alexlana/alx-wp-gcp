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

define( 'DB_NAME', 'alx-wp-db' );


/** Database username */

define( 'DB_USER', 'alx-wp-db' );


/** Database password */

define( 'DB_PASSWORD', 'sua-senha-do-db-123' );


/** Database hostname */

define( 'DB_HOST', 'IP.INTERNO.DO.DB:3306' );


/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );


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

define( 'AUTH_KEY',         'q([|nfwG%f=_de>L9N?)_| djYHztR0KdiNS[AxO)Y_8cWd4>TbnOeSwr+GX3`=#' );

define( 'SECURE_AUTH_KEY',  '|_;6P7@aUT-nTH/y&$VzVd[wQww!<B,L4&+#}d I@T]b{-`|YWlWIE--^)JOE.ge' );

define( 'LOGGED_IN_KEY',    'XXuV,F#in?oBm RyU)IGntOVm:J-Sf$3/^Yrx<<;=BXt#,GCo5H^|$NDpUA7e1hV' );

define( 'NONCE_KEY',        '*[[8i~8 X7M)Wd#[r5aotYrN%q+(!t&w}7U!g9ebBFQS^Yf77g0gnf)&$8_{_{q8' );

define( 'AUTH_SALT',        '4Q&A1^es?$<(`etQxq_q/fR@y6R~|8-R .VI?<K8xM%b~9KM6_AdZXwbPG&N2 ?8' );

define( 'SECURE_AUTH_SALT', '?]I<y<+w5N{>)O8P|6s,z Mae4G?@2 7-[n~@*ss5;GPON3eBy(`QrHM@,Np0Bng' );

define( 'LOGGED_IN_SALT',   'bjfy>M {}XdSaphLf^X9d?D-Be$6H PRydUpK*2@r7UjRqKjn8GULi]<`L[f+u@L' );

define( 'NONCE_SALT',       'pROfV*hp:hTNRM&uIXvY.T>3|HRt&^$~s$xa5&P|,3?(5SXtUN)@3V>Y2E}:~A-:' );


/**#@-*/


/**

 * WordPress database table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix = 'alxwp_';


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




define( 'FS_METHOD', 'direct' );
/**
 * Handle potential reverse proxy headers. Ref:
 *  - https://wordpress.org/support/article/faq-installation/#how-can-i-get-wordpress-working-when-im-behind-a-reverse-proxy
 *  - https://wordpress.org/support/article/administration-over-ssl/#using-a-reverse-proxy
 */
if ( ! empty( $_SERVER['HTTP_X_FORWARDED_HOST'] ) ) {
	$_SERVER['HTTP_HOST'] = $_SERVER['HTTP_X_FORWARDED_HOST'];
}
if ( ! empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === $_SERVER['HTTP_X_FORWARDED_PROTO'] ) {
	$_SERVER['HTTPS'] = 'on';
}

/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'https://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'https://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', false );
$_SERVER['HTTPS']='on';

/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
