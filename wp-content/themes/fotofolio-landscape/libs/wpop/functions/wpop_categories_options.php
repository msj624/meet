<?php
/**
 * Categories options list
 *
 * @category   Wordspop
 * @package    WPop
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 * @version    $Id:$
 */
function wpop_categories_options() {
    $cats = get_categories('hide_empty=0');
    $options = array();
    foreach($cats as $cat){
        $options[$cat->cat_ID] = $cat->name;
    }
    return $options;
}
