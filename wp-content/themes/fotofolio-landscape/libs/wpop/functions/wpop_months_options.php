<?php
/**
 * Month options list
 *
 * @category   Wordspop
 * @package    WPop
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 * @version    $Id:$
 */
function wpop_months_options() {
    $options = array();
    for ($i = 1; $i <= 12; $i++) {
        $options[$i] = strftime('%B', mktime(0, 0, 0, $i, 1, 1970));
    }

    return $options;
}
