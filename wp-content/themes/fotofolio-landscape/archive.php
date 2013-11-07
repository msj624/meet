<?php 
get_header(); 
get_sidebar();
?>
		<div class="main grid_17">
			<h2 class="title"><?php single_cat_title(); ?> <span style="color: #cecece;"><?php _e('Category'); ?></span></h2>
			<div class="this-category grid_10">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="this-category-photo"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'category-thumbnail' ); ?></a></div>
				<?php endwhile; ?>
				<div class="navigation">
					<div class="alignleft"><?php next_posts_link(__('Older')) ?></div>
					<div class="alignright"><?php previous_posts_link(__('Newer')) ?></div>
				</div>
			</div>
            <?php endif;?>
			
				<?php if(category_description()) : ?>
					<div class="cat-desc grid_6">
					<?php echo category_description(); ?>
					</div>
				<?php endif; ?>
			
		</div> <!-- end of main -->
		<div class="clear"></div>
<?php get_footer(); ?>