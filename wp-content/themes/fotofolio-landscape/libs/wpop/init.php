<?php
/**
 * Wordspop Framework
 *
 * @category   Wordspop
 * @package    WPop
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 * @version    $Id:$
 */

// WPop core version
define ('WPOP_VERSION', '1.0-beta');

// Define some shortcuts
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);

// WPop core directories
define('WPOP_PATH', dirname(__FILE__));
define('WPOP_FUNCTIONS', WPOP_PATH . DS . 'functions');
define('WPOP_CLASSES', WPOP_PATH . DS . 'classes');
define('WPOP_WIDGETS', WPOP_PATH . DS . 'widgets');
define('WPOP_BUNDLED', WPOP_PATH . DS . 'bundled');
define('WPOP_LANGUAGES', WPOP_PATH . DS . 'languages');
define('WPOP_ASSETS', get_bloginfo('template_url') . '/libs/wpop/assets');
define('WPOP_FEED_THEMES', 'http://firmanw.com/wordspop/themes.xml.php');

// Theme directories
define('WPOP_THEME_CONFIG', TEMPLATEPATH . DS . 'libs' . DS . 'config');
define('WPOP_THEME_FUNCTIONS', TEMPLATEPATH . DS . 'libs' . DS . 'functions');
define('WPOP_THEME_CLASSES', TEMPLATEPATH . DS . 'libs' . DS . 'classes');
define('WPOP_THEME_3RDPARTY', TEMPLATEPATH . DS . 'libs' . DS . '3rdparty');
define('WPOP_THEME_WIDGETS', TEMPLATEPATH . DS . 'libs' . DS . 'widgets');
define('WPOP_THEME_LANGUAGES', TEMPLATEPATH . DS . 'languages');
define('WPOP_THEME_URL', get_bloginfo('template_url'));

// Extras
define('WPOP_THEMES_FEED', 'http://wordspop.local/feeds/themes');
define('WPOP_APIS_URL', 'http://api.wordspop.local/');

// Add WPop libs directory into include_path
set_include_path(
    WPOP_THEME_CLASSES . PS .
    WPOP_THEME_FUNCTIONS . PS .
    WPOP_CLASSES . PS .
    WPOP_FUNCTIONS . PS .
    get_include_path()
);

/**
 * @see WPop
 */
require_once 'wpop.php';

// Autoload functions
require_once WPOP_FUNCTIONS . DS . '/wpop_get_option.php';
require_once WPOP_FUNCTIONS . DS . '/wpop_theme_settings.php';

// Simply call the initialization routine
WPop::init();
