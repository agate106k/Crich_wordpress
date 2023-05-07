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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('WP_DEBUG', true);
if ( WP_DEBUG ) {
    // debug.log ファイルに記録
    define( 'WP_DEBUG_LOG', true );
    // ブラウザ上に表示しない
    define( 'WP_DEBUG_DISPLAY', false );
    // ブラウザ上に表示しない
    @ini_set( 'display_errors',0 );
}

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'PiT2Imy4S0sdRfLiIo4zPISERtF3nVDKcEmQ2VvPxtIBqHlthO6jvFo/8eGAp04H0wAC/2X7tinnyDjCRPB72A==');
define('SECURE_AUTH_KEY',  'jKGV6ExxIfHGqowN6Uo+E/3BjORNM9x9ilv2pHmukPjPlYfdkgCJlbJtUVBWHCFFbd4h/w0k35U3HvvPsMWWjA==');
define('LOGGED_IN_KEY',    '7tzpesghFWc+wM7WLgHzzcgWGU646aTcao4LKxlfe6CKzpChh+AfdeyWp982q/q25jvA92OfWxmJBjKpu/236w==');
define('NONCE_KEY',        'VvcO81fTMeZlNz085CZjJ+nG1GH0UySfdnhAIxJ2cSg8nXsI+DvjYxzk00K5tKjmZHrgsPnRQQ6aIU2sIDaFHg==');
define('AUTH_SALT',        'Tdv5Ah1AxZtWc/ALb1T/gsk2FMQkFfC/RyiQqmblVHpPCUgFQOr8/amtuMqNC03MkZhdzO07CgrpYNenOqlpWQ==');
define('SECURE_AUTH_SALT', '9EEf6XSwxpVKuOMnVbJNkICUIpP2hEliY+YI//oSYvQ6No5rdRSWzXMRMIiY7cKu7gNaoNtpsAJDrTSH+oirnw==');
define('LOGGED_IN_SALT',   'wxmmerOGRe+UAP/lw2M2/tMF7VhKG1i/ELH+CBJScfghfIVxlofbSk3fQgUjOgXWXYV16BEkg1UQmWZt6ubv7Q==');
define('NONCE_SALT',       '8txdSN5OWdb3L7p+3FOfNNB90CyhEV5E7TLfdfM2UT21cgydN2Z0w5CbMg/hOODUzxRqQVjV1ITwQcUHBdq0dw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
