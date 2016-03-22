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
define('DB_NAME', 'akad');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'jGsf]-~4?<9k($-w;FOeqr$<(8PnS[/3`0!$EkY~zcwZbh&+0-40=zL20|3U9-Vn');
define('SECURE_AUTH_KEY',  '[O8,PR5F3zBBOD~-KJL!/O9;$+E T5,j9e]=_+&C5yGT}|p6au~TU:]?3)7f$Lg}');
define('LOGGED_IN_KEY',    'fZVt9?vw0P+VG4+oP<[I:v,UV _}PCZ^;JhpLDP1Of|B|@h9/37<GClNV!Z+8,pP');
define('NONCE_KEY',        '|%?HD=9)t|#b6gADkG+4N}mPY6mp]}plzIPB8rKpgpJ#rC-XZou_h=R-kb8CIq`F');
define('AUTH_SALT',        '|L>.-!Zj$a}q#/e6?F:hEq[6-VIC&z#_yU=jiIB2@#5M11tr(`7gskq((i.9BF)[');
define('SECURE_AUTH_SALT', '0st&?Slc#Hv|FuY)!_x#,XV`Q0aQAZ>R)}>wp|ps(E_#ukZL1r|b<_BXcRz?RA[3');
define('LOGGED_IN_SALT',   '{Qd5_|<J$%oZkaIb0@7jy!FSnc};@.Au.a%/A9=;4GRjDGiLNjH79R^-/#&D2<fz');
define('NONCE_SALT',       '6 T?BdU._AzKb}4A4L41J.Y|-iT7/cz!$V&iJ``v_1A<t+}!Ig,1O)PB<Tqa*|4d');

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
