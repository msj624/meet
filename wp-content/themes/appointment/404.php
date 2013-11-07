<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Spa salon
 * 
 */?>
<!---Pink Strip----->
<?php 
get_header();
get_template_part('orange','header');
?>

<!---/Pink Strip-----> 

	<div class="container">
	<div class="_blank"></div>
		<!--- Main ---> 
		<div class="row-fluid">
		<div class="span8"  >

			
				
				<h2 class="blog-detail-head"><?php _e( 'Unfortunately, the page you tried accessing could not be retrieved. ', 'sis_spa' ); ?></h2>
		

				
					 <div class="blog_content"><p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'sis_spa' ); ?></p></div>
					<?php get_search_form(); ?>
				<!-- .entry-content -->
	

		</div>
		<?php get_sidebar (); ?>

		</div><!-- #content -->
	</div><!-- #primary -->
		<div class="_blank"></div>	<div class="_blank"></div>	<div class="_blank"></div>	<div class="_blank"></div>
<?php get_footer(); ?>