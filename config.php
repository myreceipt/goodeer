<?php
/**
 * The "config.php" file is the base configuration for this script
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * PHP Error Reporting
 * * Root Directory Path
 * * Template Directory Path
 */

/** MySQL hostname */
define("DB_HOST", 'localhost');

/** MySQL database username */
/** define("DB_USER", 'voucher24jam_demo'); */
define("DB_USER", 'movie_straight_line');

/** MySQL database password */
/** define("DB_PASS", '!Q@W#E$R'); */
define("DB_PASS", '$uw@Rd!j3M8lun9');

/** MySQL database name */
/** define("DB_NAME", 'voucher24jam_demo'); */
define("DB_NAME", 'straight_line_movies');

/** PHP Error Reporting */
define("DEBUG", false);

/** PHP Display Error */
define("SHOW_DEBUG", false);

/**
 * That's all! Dude, please stop editing !
 */

/** Absolute path of root directory */
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

/** Full Path of template directory */
if (!defined('TEMPLATES')) {
    define('TEMPLATES', dirname(__FILE__) . '/templates/');
}

if (!defined('JUICYCODES')) {
    define("JUICYCODES", true);
}

/** Initialize required components */
require_once ABSPATH . '/framework/init.php';
