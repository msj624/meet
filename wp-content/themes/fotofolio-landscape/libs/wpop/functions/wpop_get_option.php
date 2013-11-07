<?php
/**
 * Get theme option
 *
 * @category   Wordspop
 * @package    WPop
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 * @version    $Id:$
 */
function wpop_get_option($name) {
    if (!class_exists('WPop_Theme')) {
        return false;
    }
    
    return WPop_Theme::getOption($name);
}