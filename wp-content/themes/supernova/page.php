<?php
/**
 * Template for displaying all pages
 *
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 */

get_header(); ?>

<div id="content_wrapper">
    <div id="content">
        <section class="main_content">
                <?php get_template_part('loop', 'page'); //The main content ?>
        </section><!--main_content -->
    </div><!--content ENDS -->
    
<?php get_sidebar('page'); ?>

<div class="clearfix"></div>
<?php do_action('supernova_above_footer'); ?>
</div><!--content_wrapper ENDS -->

<?php get_footer(); ?>