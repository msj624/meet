<?php
/**
 * Template for displaying all single posts
 *
 * @package Supernova
 * @since Supenova 1.0.8
 * @license GPL 2.0
 */
?>

<?php get_header(); ?>

<div id="content_wrapper">
	<section id="content">
            <article class="single_entry main_content">
                    <?php get_template_part('loop', 'single'); ?>
            </article><!--main_content ENDS -->
        </section><!--content ENDS -->        
    
<?php get_sidebar('page'); ?>
<div class="clearfix"></div>
<?php do_action('supernova_above_footer'); ?>
</div><!--content_wrapper ENDS -->
		
<?php get_footer(); ?>