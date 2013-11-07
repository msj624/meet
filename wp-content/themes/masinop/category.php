
<?php get_header(); ?>
<div id="content">

<?php if (have_posts()) : ?>

	<div class="pagetitle">
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

		<?php if (is_category()) : ?>
		<h2>Archive for the &#8216; <?php single_cat_title(); ?> &#8217; Category</h2>
		<?php elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : ?>
		<h2>Blog Archives</h2>
		<?php endif; ?>
	</div>

	<div class="postgroup">
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
	</div>
		
	
<?php else : ?>
	<div class="postgroup">
		<div class="post">
			<div class="title">
				<h2>No Category Found</h2>
			</div>
			<div class="entry">
				<p>Sorry, but you are looking for a category that isn't here.</p>
			</div>
		</div>
	</div>
<?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
