<?php
// include the prefered template according to category behaviour
if (is_category(wpop_get_option('testimonial'))) {
    include_once TEMPLATEPATH . '/category-testimonial.php';
} else if(is_category(wpop_get_option('blog'))) {
    include_once TEMPLATEPATH . '/category-blog.php';
} else {
    include_once TEMPLATEPATH . '/category-default.php';
}
?>