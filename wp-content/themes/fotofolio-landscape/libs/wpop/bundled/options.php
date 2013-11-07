<?php
/**
 * Bundled options
 *
 * @category   Wordspop
 * @package    WPop
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 * @version    $Id:$
 */
$wpop_bundled_options = array(
    'general' => array(
        array(
            'type'      => 'heading',
            'title'     => __('General', 'wpop'),
            'name'      => 'general',
            'icon'      => 'general'
        ),
        array(
            'type'      => 'upload',
            'title'     => __('Logo', 'wpop'),
            'name'      => 'logo',
            'desc'      => __('An image that will represent your website\'s logo. 185px x 42px PNG transparent image would be the great one.', 'wpop')
        ),
        array(
            'type'      => 'upload',
            'title'     => __('Favicon', 'wpop'),
            'name'      => 'favicon',
            'desc'      => __('16px x 16px PNG/GIF/Ico image that will represent your website\'s icon. You can create it using online tools such as <a href="http://favikon.com/">favikon</a>.', 'wpop')
        )
    ),
    'header' => array(
        array(
            'type'      => 'heading',
            'name'      => 'header',
            'title'     => __('Header', 'wpop'),
            'icon'      => 'header'
        ),
        array(
            'type'      => 'textarea',
            'name'      => 'header_extras',
            'title'     => __('Extras', 'wpop'),
            'desc'      => __('Additional custom codes to be added to the header.', 'wpop'),
            'std'       => '',
            'attrs'     => array('rows' => 10)
        ),
    ),
    'footer' => array(
        array(
            'type'      => 'heading',
            'name'      => 'footer',
            'title'     => __('Footer', 'wpop'),
            'icon'      => 'footer'
        ),
        array(
            'type'      => 'textarea',
            'name'      => 'copyright',
            'title'     => __('Copyright', 'wpop'),
            'desc'      => __('Enter the Copyright notice of the website.', 'wpop'),
            'std'       => sprintf('%s &copy; %s %s. %s', __('Copyright', 'wpop'), date('Y'), get_bloginfo('title'), __('All rights reserved', 'wpop'))
        ),
        array(
            'type'      => 'textarea',
            'name'      => 'tracking_code',
            'title'     => __('Tracking Code', 'wpop'),
            'desc'      => __('Paste the <a href="http://google.com/analytics/">Google Analytics</a> (nor others) tracking code to be added to footer.', 'wpop'),
            'attrs'     => array('rows' => 10)
        ),
        array(
            'type'      => 'textarea',
            'name'      => 'footer_extras',
            'title'     => __('Extras', 'wpop'),
            'desc'      => __('Additional custom codes to be added to the footer.', 'wpop'),
            'attrs'     => array('rows' => 10)
        )
    ),
    'styling' => array(
        array(
            'type'      => 'heading',
            'title'     => __('Styling', 'wpop'),
            'name'      => 'styling',
            'icon'      => 'styling'
        ),
        array(
            'type'      => 'checkbox',
            'name'      => 'styling_enable',
            'title'     => __('Custom Style', 'wpop'),
            'desc'      => __('Enable and applies custom styling to the theme.', 'wpop')
        ),
        array(
            'type'      => 'color',
            'name'      => 'background_color',
            'title'     => __('Background Color', 'wpop'),
            'desc'      => __('Custom body background color.', 'wpop')
        ),
        array(
            'type'      => 'upload',
            'name'      => 'background_image',
            'title'     => __('Background Image', 'wpop'),
            'desc'      => __('Custom body background image.', 'wpop')
        ),
        array(
            'type'      => 'select',
            'name'      => __('background_repeat', 'wpop'),
            'title'     => __('Background Image Repeat', 'wpop'),
            'options'   => array(
                'no-repeat' => __('No Repeat', 'wpop'),
                'repeat-x'  => __('Repeat Horizontally', 'wpop'),
                'repeat-y'  => __('Repeat Vertically', 'wpop'),
                'repeat'    => __('Repeat Both Horizontally and Vertically', 'wpop')
            )
        ),
        array(
            'type'      => 'select',
            'name'      => 'background_position',
            'title'     => __('Background Image Position', 'wpop'),
            'options'   => array(
                'top left'      => __('Top Left', 'wpop'),
                'top center'    => __('Top Center', 'wpop'),
                'top right'     => __('Top Right', 'wpop'),
                'center left '  => __('Center Left', 'wpop'),
                'center center' => __('Center Center', 'wpop'),
                'center right'  => __('Center Right', 'wpop'),
                'bottom left'   => __('Bottom Left', 'wpop'),
                'bottom center' => __('Bottom Center', 'wpop'),
                'bottom right'  => __('Bottom Right', 'wpop')
            )
        ),
        array(
            'type'      => 'color',
            'name'      => 'link_color',
            'title'     => __('Link', 'wpop'),
            'desc'      => __('Customize the color of the link.', 'wpop')
        ),
        array(
            'type'      => 'color',
            'name'      => 'link_hover_color',
            'title'     => __('Link Hover', 'wpop'),
            'desc'      => __('Customize the color of the link hover.', 'wpop')
        ),
        array(
            'type'      => 'textarea',
            'name'      => 'custom_css',
            'title'     => __('Custom CSS', 'wpop'),
            'desc'      => __('Additional custom css to be added to template.', 'wpop'),
            'attrs'     => array('rows' => 10)
        )
    ),
    'typography'  => array(
        array(
            'type'      => 'heading',
            'title'     => __('Typography', 'wpop'),
            'name'      => 'typography',
            'icon'      => 'typography',
            'desc'      => __('Here you can use custom typography which also support the <a href="http://code.google.com/webfonts">Google Fonts</a>.', 'wpop')
        ),
        array(
            'type'      => 'character',
            'name'      => 'heading1',
            'title'     => __('Heading 1', 'wpop')
        ),
        array(
            'type'      => 'character',
            'name'      => 'h2',
            'title'     => __('Heading 2', 'wpop')
        ),
        array(
            'type'      => 'character',
            'name'      => 'h3',
            'title'     => __('Heading 3', 'wpop')
        ),
        array(
            'type'      => 'character',
            'name'      => 'h4',
            'title'     => __('Heading 4', 'wpop')
        ),
        array(
            'type'      => 'character',
            'name'      => 'h5',
            'title'     => __('Heading 5', 'wpop')
        ),
        array(
            'type'      => 'character',
            'name'      => 'p',
            'title'     => __('Paragraph', 'wpop')
        ),
        array(
            'type'      => 'character',
            'name'      => 'blockquote',
            'title'     => __('Blockquote', 'wpop')
        ),
        array(
            'type'      => 'character',
            'name'      => 'ul',
            'title'     => __('List', 'wpop')
        )
    ),
    'slideshow' => array(
        array(
            'type'      => 'heading',
            'title'     => __('Slideshow', 'wpop'),
            'name'      => 'slideshow',
            'icon'      => 'slider'
        ),
        array(
            'type'      => 'select',
            'title'     => __('Category', 'wpop'),
            'name'      => 'slide_category',
            'desc'      => __('Which category should be use as slideshow.', 'wpop'),
            'options'   => 'wpop_categories_options'
        ),
        array(
            'type'      => 'select',
            'title'     => __('Number of Items', 'wpop'),
            'name'      => 'slide_num',
            'desc'      => __('How many pictures to show within the slideshow.', 'wpop'),
            'options'   => array(
                2 => __('Two', 'wpop'), 
                3 => __('Three', 'wpop'), 
                4 => __('Four', 'wpop'),
                5 => __('Five', 'wpop'),
                6 => __('Sixth', 'wpop'),
                7 => __('Seven', 'wpop')
            )
        )
    )
);
?>