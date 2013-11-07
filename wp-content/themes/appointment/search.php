<?php get_header();

	get_template_part('orange','header');
 ?>


	
		<div class="container">
			<div class="row-fluid">
			
			<div class="span12 main_space">
			<div class="span8 appo_main_content">
		      <div class="row-fluid appo_blog_post">
			<?php if ( have_posts() ) : ?>

			
                
					<h2><?php printf( __( 'Search Results for:%s', 'appointment' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
			
                  <?php if(wp_link_pages(array('echo'=>0))):?>
                    <div class="pagination_blog"><ul class="page-numbers"><?php 
					 $args=array('before' => '<li>'.__('Pages:','appointment'),'after' => '</li>');
					 wp_link_pages($args); ?></ul></div>
					 <?php endif; ?>
		

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

			
      
			<?php else : ?>

		<!--<article id="post-0" class="post no-results not-found">-->
			     
						<h2><?php _e( 'Nothing Found', 'appointment' ); ?></h2>
			

			        <div class="blog_con_mn">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'appointment' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .blog_con_mn -->
			
              
			<?php endif; ?>
             
			</div>
			</div><!-- #content -->
			<?php get_sidebar();?>
			</div>
		
		</div>
</div>	
		<!-- #primary -->

    	<?php get_footer();?>