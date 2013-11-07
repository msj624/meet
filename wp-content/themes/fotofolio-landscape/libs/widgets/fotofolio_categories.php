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
class Fotofolio_Categories_Widget extends WPop_Widget
{
    /**
     * Constructor
     */
    function Fotofolio_Categories_Widget()
    {
        parent::init();
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

    function defaults()
    {
        parent::defaults();

        // Work out with default category excludes
        $blog_catid = wpop_get_option('blog');
        $testi_catid = wpop_get_option('testimonial');
        $cat_exclude = !empty($blog_catid) ? $blog_catid : '';
        if (!empty($testi_catid) && !empty($cat_exclude)) {
            $cat_exclude .= ",{$testi_catid}";
        } else {
            $cat_exclude = $testi_catid;
        }

        $this->defaults['cat_exclude'] = $cat_exclude;

        return $this->defaults;
    }
}
?>