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

define( 'DB_NAME', 'bitnami_wordpress' );


/** Database username */

define( 'DB_USER', 'bn_wordpress' );


/** Database password */

define( 'DB_PASSWORD', '586117620587e00c2765216382e4b710f50bd4e3495f0a307f307df175b8ed64' );


/** Database hostname */

define( 'DB_HOST', 'localhost:3306' );


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

define( 'AUTH_KEY',         'Mh}PB`vcE|zsbG%16<Td1^$WR:Xj<I#-$oW>rpuoS]]u@R:;yk[QlCa,%SyIIo)8' );

define( 'SECURE_AUTH_KEY',  'lPrJ),{Cl?Gs{].~_*#Jn-n/_,P*GI>_~eEC~/!z#lK,?a[EDkjL-%l:/`Ni5}gf' );

define( 'LOGGED_IN_KEY',    'lHoJE!{_Los12f bQZ,.RaDL8Q&02RvCpn~_eI0rB4=p;EIz-K%,e?z Xe1vo$aa' );

define( 'NONCE_KEY',        'dp-V*VCV~I9N0eSIC[0h_(j*9qt8n~tVAgJ:=LVO|ISYgqPD_d4sQK>YZlA27~Yv' );

define( 'AUTH_SALT',        '9D&gP]Jayo/!zg?yT;0B4lMFP2*gNm^pZx91C& h8<6<~rSD]CA/b-8eA|HH?m6(' );

define( 'SECURE_AUTH_SALT', 'v(}/M1sQ>CsabQ^:)hFZwYv3,wYbNC$:UO;w-3./Y}59I-+wk@t,JeGogU7UXd@V' );

define( 'LOGGED_IN_SALT',   'IbnMa4+c-*tZ^$m?L-pm*!/+B0@IH5Oq8)*[o?54}eN7QN1Soyqqu*dG]kNdAt9B' );

define( 'NONCE_SALT',       'zvYY<vu(re:P2HmoVq/(YWs%|,1vatY>6X,xg]@:9g8)S0qxBatu(eDXhEs]({Q3' );


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
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
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
