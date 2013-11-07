<?php get_header(); ?>

	<div id="content">
	<?php if (have_posts()) : the_post();?>
		<div class="post">
			<h1 class="title">Author Archives: &ldquo;<?php the_author_posts_link(); ?>&rdquo;</h1>
		</div>
		<?php if ( get_the_author_meta( 'description' ) ) : ?>
		<div id="entry-author-info">
			<div id="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?>
			</div>
			<div id="author-description">
				<h2>About <?php echo get_the_author(); ?></h2>
				<?php the_author_meta( 'description' ); ?>
			</div>
		</div>
		<?php endif;
		rewind_posts();
		while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" class="post">
			<h1 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
				<?php the_title(); ?>
				</a></h1>
			<p class="meta"> <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" class="more">Read full article</a>
			<b>&nbsp;|&nbsp;</b><?php comments_popup_link('No Comments', '1 Comment', '% Comments', 'comments'); ?>
			</p>
			<div class="entry">
				<?php if ($classicbiz->showFull() == 'true' ): 
					global $more;
					$more=1;
					the_content(); ?>
				<?php else : ?>
				<div class="excerpt"><?php if ( get_the_excerpt() != '' ){
						the_excerpt();
					}else{
						global $more;
						$more=0;
						the_content();
					} ?></div>
				<?php endif; ?>
				<div style="clear:both;"></div>
				<p><a href="<?php the_permalink() ?>" class="links">Read More</a></p>
			</div>
		</div>
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php previous_posts_link('&laquo; Previous Entries') ?></div>
			<div class="alignright"><?php next_posts_link('Next Entries &raquo;') ?></div>
		</div>

	<?php else: ?>

		<div class="post">
			<h1 class="title">Author Archives</h1>
			<p>No posts found. Try a different search.</p>
		</div>

	<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>