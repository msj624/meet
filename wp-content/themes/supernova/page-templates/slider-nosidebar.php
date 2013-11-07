<?php
/**
 * Template for displaying full page with slider
 *
 * @package Supernova
 * @since Supenova 1.1.0
 * @license GPL 2.0
 *
 * Template Name: Slider Page(full width)
 */
?>

<?php get_header(); ?>
<div id="content_wrapper">
    <div class="slider_page_full" id="content">
    
		<?php get_template_part('includes/index', 'slider'); ?> 
            
        <section class="main_content">        
            <?php get_template_part('loop', 'page'); //The main content ?>
        </section><!--main_content -->
    </div><!--content ENDS -->
    
<div class="clearfix"></div>
<?php do_action('supernova_above_footer'); ?>
</div><!--content_wrapper ENDS -->

<?php get_footer(); ?>