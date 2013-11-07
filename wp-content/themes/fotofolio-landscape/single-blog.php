<?php 
get_header();
get_sidebar();
?>
		<div class="main blogsingle grid_17">
			
			<h2 class="title"><?php echo wpop_get_option('blog_title'); ?></h2>
			<div class="postmain">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="blogpost">
			<h3><?php the_title(); ?></h3>
			<div class="meta"><?php _e('Published'); ?>: <?php echo get_the_date(); ?>,<?php _e('on', 'fotofolio_landscape'); ?> <?php the_category(', '); ?></div>
			<?php the_content(); ?>
			</div>
			<div class="navigation">
				<div class="alignright"><?php previous_post_link( '%link', __('Next', 'fotofolio_landscape'), TRUE ); ?></div>
				<div class="alignleft"><?php next_post_link( '%link', __('Previous', 'fotofolio_landscape'), TRUE ); ?></div>
				<div class="clear"></div>
			</div>
			</div>
			
			<?php get_sidebar('blog'); ?>
			<div class="clear"></div>
			<div class="section">
				<div class="comments">
					<?php comments_template(); ?>
				</div>
				<div class="clear"></div>
			</div>
			<?php endwhile; endif;?>		
			</div> <!-- end of main -->
		<div class="clear"></div>
<?php get_footer(); ?>