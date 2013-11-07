<?php
// Register the sidebar
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name'          => 'Sidebar',
        'id'            => 'main-sidebar',
        'description'   => 'Layout main sidebar',
        'before_widget' => '<div class="widgz">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => 'Blog Sidebar',
        'id'            => 'blog-sidebar',
        'description'   => 'Blog section sidebar',
        'before_widget' => '<div class="cat-desc">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ));
}

/**
 * Categories Widget
 */
class Fotofolio_Categories_Widget extends WP_Widget
{
    //Declare the Widget
    function Fotofolio_Categories_Widget()
    {
        $widget_ops = array(
            'classname'   => 'fotofolio_categories_widget',
            'description' => __( 'Custom categories list of Fotofolio Landscape')
        );
        $control_ops = array(/*
            'width'   => 350,
            'height'  => 300*/
        );
        $this->WP_Widget('wpop_fotofolio_categories', __('Fotofolio Landscape Categories'), $widget_ops, $control_ops);
    }

    // Display the Widget
    function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
        $cat_exclude = empty($instance['cat_exclude']) ? '1' : $instance['cat_exclude'];

        // Before the widget
        echo $before_widget;

        // The title
        if ($title) {
          echo $before_title . $title . $after_title;
        }

        // Category List 

        echo '<ul>' . wp_list_categories('echo=0&title_li=&show_empty=1&depth=1&exclude=' . $cat_exclude . '') . '</ul>';

        // After the widget
        echo $after_widget;
    }

    // Save Widget Setting
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['cat_exclude'] = strip_tags(stripslashes($new_instance['cat_exclude']));

        return $instance;
    }

    // Widget Options
    function form($instance)
    {
        // Default
        $blogCatID = wpop_get_option('blog');
        $testiCatID = wpop_get_option('testimonial');
        $excludes = !empty($blogCatID) ? $blogCatID : '';
        if (!empty($testiCatID) && !empty($excludes)) {
            $excludes .= ",{$testiCatID}";
        } else {
            $excludes = $testiCatID;
        }

        $instance = wp_parse_args(
            (array) $instance,
            array(
                'title'       => 'Categories',
                'cat_exclude' => $excludes
            )
        );

        $title = htmlspecialchars($instance['title']);
        $cat_exclude = htmlspecialchars($instance['cat_exclude']);

        // Output the options
        echo '<p><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" class="widefat" /></label></p>';

        // Text line 1
        echo '<p><label for="' . $this->get_field_name('cat_exclude') . '">' . __('Exclude:') . ' <input id="' . $this->get_field_id('cat_exclude') . '" name="' . $this->get_field_name('cat_exclude') . '" type="text" value="' . $cat_exclude . '" class="widefat" /></label><br />' .
             '<small>' . __('Category IDs, separated by commas. Blog and Testimonials category excluded by default (if any).') . '</small></p>';
    }
}
?>