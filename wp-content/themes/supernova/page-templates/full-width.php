<?php
/**
 * The template displays full with pages
 *
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 *
 *	Template Name: Full Width
 */
?>

<?php get_header(); ?>

<div id="content_wrapper">
    <div class="content_full">
        <section class="main_content">
            <?php get_template_part('loop', 'page'); //The main content ?>
        </section><!--main_content -->
    </div><!--content ENDS -->

<div class="clearfix"></div>    
<?php do_action('supernova_above_footer'); ?>
</div><!--content_wrapper ENDS -->

<?php get_footer(); ?>