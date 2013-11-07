
<?php get_header(); ?>

<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<div class="post singlepost" id="post-<?php the_ID(); ?>">
		<div class="title">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<p>
				<span class="date"><?php the_time('F j, Y'); ?></span>
				<span class="divider">&bull;</span>
				<span class="categories"><?php the_category(', ') ?></span>
			</p>
		</div>
		<div class="entry">
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>
	</div>
	
	<div class="postmeta">
			<?php if ( function_exists('the_tags') ) { the_tags('<p><span id="tags"><strong>Tagged as:</strong> ', ', ', '</span></p>'); } ?>
	</div>
		
	<div class="comments">
		<?php comments_template(); ?>
	</div>
	
	<?php endwhile; else: ?>
	
	<div class="post singlepost">
		<div class="title">
			<h2>No Page Found</h2>
		</div>
		<div class="entry">
			<p>Sorry, but you are looking for a page that isn't here.</p>
		</div>
	</div>

	<?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
