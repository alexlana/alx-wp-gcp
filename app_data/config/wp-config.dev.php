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

define( 'DB_PASSWORD', 'L4S77JK34z882jkalsd' );


/** Database hostname */

define( 'DB_HOST', 'alx-wp-db:3306' );


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

define( 'AUTH_KEY',         'zN& ^z/t$.Y8@}qaFIBw;7{;d%T@ `L1;r7~Exo DP}j$5P{By%.w*n1.v w%JwN' );

define( 'SECURE_AUTH_KEY',  '2Kr2IUoy`.Ir:@^V&a_Z-~WHn+wbe;WLM?3Z#`&>Mg<;5|Sb ;Ek>dVm`4,|z_eZ' );

define( 'LOGGED_IN_KEY',    'o^..ZX9(#FqG@h`u(d@x9rJ(@|+IJ(MD;^M<1O ?-:.XA|j8hxR>AYefXf@D(LYT' );

define( 'NONCE_KEY',        '46s?Mf&FZ Ay1]~1CTwwP]8`#jzU[Q8 5C;,z_q,h<jn:m[T_4T#*nrWQM<msdQZ' );

define( 'AUTH_SALT',        'AlD,]l9lMUuI.:]F4[aMfUPui<&[(KYP%!.PP6+k%Mkzx5m73NtW<B--;iZSA8]f' );

define( 'SECURE_AUTH_SALT', '%X8r^;%`Wy~-0!-B_rY-FSn3LYGSI9uiv6fK=amd?%6JZ%,D6FErJrAA8H5<Kqv+' );

define( 'LOGGED_IN_SALT',   'NV}kV&+ViBoWSGP=];1eLs# +!;T;eq<+Eu%;GNA:?)lN1?gK&>&m1k!{06]*T]k' );

define( 'NONCE_SALT',       '1!VJQ6B+_%oOnf70to/vDA}9;6z {]2GxwRwk]&%OzUCZT[oKr!ED{ts=5H)![cw' );


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
