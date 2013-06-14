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
define('DB_NAME', 'falloutc_blog');

/** MySQL database username */
define('DB_USER', 'falloutc_blog');

/** MySQL database password */
define('DB_PASSWORD', '0l66Swu3Pg');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'tdveo4xv16nyflj2myhat25zorfwtlscwu2iymzaqojzl0rfyawpmjtmqhp9fjvc');
define('SECURE_AUTH_KEY',  'wph2tlmafbuv6qy324clgr8witxs9qfcs4tigzzglgowyui6diy4yevpignnig27');
define('LOGGED_IN_KEY',    'uuflebn7izurahnnirnnzidryssymdd3avvpgzyrlrabfiac4kw30ea37b6e2u7m');
define('NONCE_KEY',        'w5cnxafauil42jzeybgeqq2qo9g7jf3dp3m3cc45yrnmozrpagomkne20sra98m7');
define('AUTH_SALT',        'wpvggniwtackxkjecvdvoovfjouie4gurbfrzplw94x7jrbn5il1von6jlq1pmks');
define('SECURE_AUTH_SALT', 'noeqriefjajqcsma1un9ul5nrqyjeolk6ck6iiusc8zguaxmovg7gk58oolsfeou');
define('LOGGED_IN_SALT',   'bm6z0ihzs5bigehrysd7cwgrt7w5kmprrsx5phwgbpa6yktfnj9rcicld3tfhmri');
define('NONCE_SALT',       'cnsyxilmmbqtjljtyl05gqsbp4oi0ed1xkaiutpcztsgbzhhjpivkzjxrsqonloz');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define ('WPLANG', '');

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
