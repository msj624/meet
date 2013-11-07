<?php get_header(); ?>

	<div id="content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post" id="post-<?php the_ID(); ?>">
			<h2 class="title">
				<a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_post_thumbnail( array(25,25) );?><?php the_title(); ?></a>
			</h2>
			<div class="meta">
				<p>
						This entry was posted on <?php the_time( get_option( 'date_format' ) ) ?>
						under <?php the_category(', ') ?>. Written by: <?php the_author_posts_link(); ?><br /> 

						<?php edit_post_link('Edit this entry.','',''); ?>
				</p>
			</div>			
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this post &raquo;</p>');?>
				<div class="navigation" style="clear:both;">
					<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));?>
				</div>
				<br /><br />
				<?php comments_template(); ?>
			</div>

			<div class="navigation" style="clear:both;">
				<div class="alignleft">
					<?php previous_post_link('%link','&laquo; Previous'); ?>
				</div>
				<div class="alignright">
					<?php next_post_link('%link','Next &raquo;');?>
				</div>
			</div>			
		</div>


	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

	<?php endif; ?>

	</div>
	<!-- End content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
