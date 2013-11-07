<?php
/**
 * Fotofolio Landscape Widgets
 *
 * @category   Wordspop
 * @package    WPop
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 * @version    $Id:$
 */

$wpop_widgets = array(
    'fotofolio_categories' => array(
        'title' => 'Fotofolio Landscape Categories',
        'description' => 'Custom categories list of Fotofolio Landscape',
        'control'    => array(),
        'options' => array(
            array(
                'type'    => 'text',
                'title'   => 'Title',
                'name'    => 'title',
                'desc'    => 'List heading title',
                'std'     => 'Categories',
                'filters' => 'strip_tags'
            ),
            array(
                'type'    => 'text',
                'name'    => 'cat_exclude',
                'title'   => 'Exclude',
                'desc'    => 'Category IDs, separated by commas. Blog and Testimonials category excluded by default (if any).',
                'filters' => 'strip_tags'
            )
        )
    )
);
?>