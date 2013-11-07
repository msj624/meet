<?php
/**
 * Template for displaying search results
 *
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 */
?>

<?php get_header(); ?>

<div id="content_wrapper">
	<section id="content">    		
        <section class="main_content">	
        <?php $user_term= $_GET['s']; ?>
        	<h1 class="latest_blogs"><?php _e('Search Results for ', 'Supernova'); echo '"'.$user_term.'"'; ?></h1>
                        <?php get_template_part('loop'); ?>
            <?php supernova_pagination(); ?>
        </section><!--main_content ENDS -->
        	<div class="clearfix"></div>                                   
	</section><!--content ENDS -->
    
<?php get_sidebar(); ?>

<div class="clearfix"></div>
<?php do_action('supernova_above_footer'); ?>
</div><!--content_wrapper ENDS -->


<?php get_footer(); ?>