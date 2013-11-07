
<?php get_header(); ?>

<div id="content">

	<div class="postgroup">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="post" id="post-<?php the_ID(); ?>">
		<div class="title">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<p>
				<span class="date"><?php the_time('F j, Y'); ?></span>
			</p>
		</div>
		<div class="entry">
			<?php the_content('[More]'); ?>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>
	</div>	
<?php endwhile; else: ?>
	<div class="post">
		<div class="title">
			<h2>No Page Found</h2>
		</div>
		<div class="entry">
			<p>Sorry, but you are looking for a page that isn't here.</p>
		</div>
	</div>
<?php endif; ?>
	</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>