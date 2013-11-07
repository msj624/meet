<?php
/**
 * Fotofolio Landscape Hooks
 *
 * @category   Wordspop
 * @package    WPop
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 * @version    $Id:$
 */

$wpop_hooks = array(
    'init'        => 'fotofolio_register_nav_menus',
    'admin_menu'  => 'fotofolio_create_metabox',
    'save_post'   => 'fotofolio_save_metadata',
)
?>