<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : ?>
	
		<div class="post">
			<h1 class="title">Search Results for &ldquo;<?php the_search_query(); ?>&rdquo;</h1>
		</div>

		<?php while (have_posts()) : the_post(); ?>
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
					<div style="clear:both;"></div>					
				<?php else : ?>
				<div class="excerpt"><?php if ( get_the_excerpt() != '' ){
						the_excerpt();
					}else{
						global $more;
						$more=0;
						the_content();
					} ?></div>
					<div style="clear:both;"></div>
					<p><a href="<?php the_permalink() ?>" class="links">Read More</a></p>					
				<?php endif; ?>
			</div>
		</div>
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php previous_posts_link('&laquo; Previous Entries') ?></div>
			<div class="alignright"><?php next_posts_link('Next Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<div class="post">
			<h2 class="title">Search Results for &ldquo;<?php the_search_query(); ?>&rdquo;</h2>
			<div>
				<p>No posts found. Try a different search?</p>
			</div>
		</div>

	<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>