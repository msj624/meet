
<?php get_header(); ?>
<div id="content">

<?php if (have_posts()) : ?>

	<div class="pagetitle">
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		<?php /* If this is a category archive */ if (is_category()) { ?>
		<h2>Archive for the &#8216; <?php single_cat_title(); ?> &#8217; Category</h2>
		<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h2>Posts Tagged &#8216; <?php single_tag_title(); ?> &#8217;</h2>
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2>Archive for <?php the_time('F jS, Y'); ?></h2>
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2>Archive for <?php the_time('F, Y'); ?></h2>
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2>Archive for <?php the_time('Y'); ?></h2>
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2>Author Archive</h2>
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2>Blog Archives</h2><?php } ?>
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
		
	<div id="pagenav"><?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } else { posts_nav_link(); } ?></div>

<?php else : ?>

	<div class="postgroup">
		<div class="post">
			<div class="title">
				<h2>No Archive Found</h2>
			</div>
			<div class="entry">
				<p>Sorry, but you are looking for an archive that isn't here.</p>
			</div>
		</div>
	</div>

<?php endif; ?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
