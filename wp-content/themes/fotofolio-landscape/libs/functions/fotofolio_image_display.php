<?php

// Add image resizing
if(function_exists( 'add_theme_support' )) { 
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'single-post-thumbnail', 668, 351, true );
    add_image_size( 'single-post-thumbnail-lands', 379, 568, true );
    add_image_size( 'category-thumbnail', 110, 110, true );
}

function fotofolio_image_display() {
    global $src;

    $id_thumb = get_post_thumbnail_id();
    $image_info = wp_get_attachment_image_src($id_thumb, 'full');
    
    if ($image_info[1] > $image_info[2] ) {
        echo '<div class="stage">';
        echo '<div class="slide">';
        echo '<a href="' . $src[0] . '" class="full" title="' . the_title('', '', false) . '">';
        the_post_thumbnail( 'single-post-thumbnail', array('title' => the_title('', '', false)) );
        echo '</a>';
        echo '</div>';
        echo '<div class="intro">';
        the_content();
        echo '</div>';
        echo '</div>';
    } else if ($image_info[1] < $image_info[2]) {
        echo '<div class="stage">';
        echo '<div class="slide-lands">';
        echo '<a href="' . $src[0] . '" class="full" title="' . the_title('', '', false) . '">';
        the_post_thumbnail( 'single-post-thumbnail-lands', array('title' => the_title('', '', false)) );
        echo '</a>';
        echo '</div>';
        echo '<div class="intro-lands">';
        the_content();
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="stage">';
        echo '<div class="slide">';
        echo '<a href="' . $src[0] . '" class="full" title="' . the_title('', '', false) . '">';
        the_post_thumbnail( 'single-post-thumbnail', array('title' => the_title('', '', false)) );
        echo '</a>';
        echo '</div>';
        echo '<div class="intro">';
        the_content();
        echo '</div>';
        echo '</div>';
    }
}
?>