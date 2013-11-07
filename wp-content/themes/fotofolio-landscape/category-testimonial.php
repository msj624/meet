<?php 
get_header(); 
get_sidebar();
?>
		<div class="main grid_17">
			<h2 class="title"><?php single_cat_title(); ?> <span style="color: #cecece;"></span></h2>
			<div class="this-category">
				<?php 
				query_posts('cat='. wpop_get_option('testimonial').'');
				if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="testimonials grid_10">
					<?php the_content(); ?>
				</div>
				<div class="client_name grid_6">
					<?php the_title(); ?>
				</div>
				<div class="clear"></div>
            <?php endwhile; endif;?>
            </div>
		</div> <!-- end of main -->
		<div class="clear"></div>
<?php get_footer(); ?>