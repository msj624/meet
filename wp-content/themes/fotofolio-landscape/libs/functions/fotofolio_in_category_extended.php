<?php
function fotofolio_in_category_extended($category) {
    if (!(is_category() || is_single())) {
        return false;
    }
 
    $obj_specified_category = is_numeric($category) ? get_category($category) : get_category_by_slug($category);
    if (empty($obj_specified_category->cat_ID)) {
        return false;
    }

    if (is_category()) {
        $current_category_ID = get_query_var('cat');
        return ($obj_specified_category->cat_ID == $current_category_ID or cat_is_ancestor_of($obj_specified_category->cat_ID,$current_category_ID));
    } else {
        global $wp_query;
        $obj_post = $wp_query->get_queried_object();
        if (empty($obj_post->ID)) {
            return false; 
        }

        if (in_category($obj_specified_category->cat_ID, $obj_post->ID)) {
            return true;
        } else {
            return in_category(get_term_children($obj_specified_category->cat_ID, 'category'), $obj_post->ID);
        }
    }
}