<?php get_header(); ?>

	<div id="content">
		<h2 class="pagetitle">Error 404: Page Not Found</h2>
		<p>We are terribly sorry, but it seems we can't find what you're looking for. Perhaps searching, or one of the links below, can help.</p>

		<?php get_search_form(); ?>
		
		<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>

		<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
		
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>