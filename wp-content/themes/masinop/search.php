
<?php get_header(); ?>
<div id="content">
	
	<div class="pagetitle">
		<h2>Search Results</h2>
	</div>

	<div class="postgroup">
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="title">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<p>
					<span class="date"><?php the_time('F j, Y'); ?></span>
					<span class="divider">&bull;</span>
					<span class="categories"><?php the_category(', ') ?></span>
					<span class="divider">&bull;</span>
					<span class="comments"><?php comments_popup_link('Comments', 'Comments', 'Comments'); ?></span>
				</p>
			</div>
			<div class="entry">
				<?php the_content('[More]'); ?>
			</div>
		</div>

	<?php endwhile; ?>
		<div id="pagenav"><?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } else { posts_nav_link(); } ?></div>
<?php else : ?>
	
	<div class="post">
		<div class="title">
			<h2>Not Found</h2>
		</div>
		<div class="entry">
			<p>Sorry, but you are looking for something that isn't here.</p>
		</div>
	</div>
		
<?php endif; ?>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>