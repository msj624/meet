<?php get_header(); ?>

<div id="content">
	<?php if (have_posts()) : 
		while (have_posts()) : 
		the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>');?>
				<div class="navigation" style="clear:both;">
					<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));?>
				</div>
				<br />
				<?php comments_template(); ?>
			</div>
		</div>

		<?php endwhile; 
	endif; ?>
	<div class="navigation">
		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>