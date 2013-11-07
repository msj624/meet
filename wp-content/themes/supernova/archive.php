<?php
/**
 * The template for displaying archive
 *
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 */
?>

<?php get_header(); ?>
		
	<div id="content_wrapper">
    	<div id="content">
        	<section class="main_content">
		<?php if (have_posts()) : ?>

 			<?php $post = $posts[0];?>

			<?php /* If this is a category archive */ if (is_category()) { ?>
				<h1 class="archive_title">&#8216;<?php single_cat_title(); ?>&#8217; Category</h1>

			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h1 class="archive_title"><?php single_tag_title(); ?>&#8217;</h1>

			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h1 class="archive_title"><?php _e('Author Archive', 'Supernova'); ?></h1>

			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h1 class="archive_title"><?php _e('Blog Archives', 'Supernova'); ?></h1>
			
			<?php  } else{ ?>
				<h1 class="archive_title"><?php _e('Archives', 'Supernova'); ?></h1>            
			<?php }; ?>

			<?php   get_template_part('includes/inc/nav');
                                get_template_part('loop'); //Actual content, get it from loop.php
                                do_action('supernova_below_posts');
                                endif;
                        ?>                                                                                  
    	</section><!--main_content ENDS -->
	</div><!--content ENDS -->
	
<?php get_sidebar('page'); ?>

<div class="clearfix"></div>
<?php do_action('supernova_above_footer'); ?>
</div><!--content_wrapper ENDS -->

<?php get_footer(); ?>