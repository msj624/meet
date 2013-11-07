<?php
/**
 * Template for displaying top navigation in each page
 *
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 */
?>


<div id="media_nav">
    <div class="media_left" title="Browse Menu"></div>
    <div class="media_search"><?php get_search_form(); ?></div>
    <div class="media_right" title="Browse Menu"></div>
    <div class="clearfix"></div>
</div>

<?php if(!supernova_options('disable-top-nav')){ ?>
<div id="header_navigation">
    <div class="wrapper">
        <div id="top_most">
            <div class="header_nav">
                <?php 
                    echo '<div id="top_nav">';
                    wp_nav_menu( array('theme_location'=>'Header_Nav', 'menu'=>'Header Navigation', 'menu_id' => 'menu'));
                    echo '</div>';
                ?>
                    <span class="media_left_close" title="close"></span>
            </div><!--header_nav -->
            
                <?php supernova_category_navigation(); ?>
            
            <?php if(!supernova_options('disable-top-search')){ ?>
            <div class="top_search">
                <div class="top_search_icon"></div>
                <div class="top_search_box"><?php get_search_form(); ?></div>
            </div>
            <?php } ?>
                <div class="clearfix"></div>
        </div><!--top_most -->
    </div><!--wrapper class ENDS -->
</div><!--Header_navigation -->
<?php } ?>