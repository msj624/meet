<?php 
get_header();
get_sidebar();
?>
		<div class="main grid_17">
			<div class="slideshow">
				<?php $the_query = new WP_Query ('cat=' . wpop_get_option('slide_category') . '&posts_per_page=' . wpop_get_option('slide_num') . ''); ?><?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<div class="slide">
					<h2><?php the_title(); ?></h2>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'single-post-thumbnail', array('title' => the_title('', '', false)) ); ?></a>
				</div>
				<?php endwhile; ?>
			</div>
			
			<div class="latest grid_17 alpha omega">
				<h2 class="grid_5 alpha omega"><?php _e('Recently Added', 'fotofolio_landscape'); ?></h2>
				<div class="photos grid_12 alpha omega">
					<?php $the_query = new WP_Query ('cat=-' . wpop_get_option('testimonial') . ',-' . wpop_get_option('blog') . '&posts_per_page=6'); ?>
					<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(array(68,68)); ?></a>
					<?php endwhile; ?>
					<div class="clear"></div>
				</div>
			</div>
			
			<div class="intro grid_8 alpha omega">
				<p><?php echo wpop_get_option('intro'); ?></p>
			</div>
			
			<div class="testimonial grid_7 prefix_1 alpha omega">
				<h2><?php _e('Testimonial', 'fotofolio_landscape'); ?></h2>
				<?php $the_query = new WP_Query ('cat=' . wpop_get_option('testimonial') . '&posts_per_page=1&orderby=rand'); ?>
				<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<?php the_content(); ?>
				<?php endwhile; ?>
			</div>
						
		</div> <!-- end of main -->
		<div class="clear"></div>
<?php get_footer(); ?>