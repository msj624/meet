<?php 
get_header();
get_sidebar();
?>
		<div class="main grid_17">
			<?php if (have_posts()) : while (have_posts()) : the_post(); $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 800,9999 ), true, '' ); ?>
			<h2 class="title"><?php the_title(); ?></h2>
			<?php echo fotofolio_image_display(); ?>
			<div class="navigation navpic" <?php echo $horizontal; ?>>
				<div class="alignright">
					<?php $prevPost = get_previous_post(true);
					if($prevPost) {?>
					<?php $prevthumbnail = get_the_post_thumbnail($prevPost->ID, array(70,70) );}?>
					<?php previous_post_link('%link',"$prevthumbnail", TRUE); ?>
				</div>
				<div class="alignleft">
					<?php $nextPost = get_next_post(true);
					if($nextPost) { ?>
					<?php $nextthumbnail = get_the_post_thumbnail($nextPost->ID, array(70,70) ); } ?>
					<?php next_post_link('%link',"$nextthumbnail", TRUE); ?>
				</div>  
				<div class="clear"></div>
			</div>
			<div class="section">
			<?php if(wpop_get_option('detail_comment')=='yes'): ?>
				<div class="comments">
					<?php comments_template(); ?>
				</div>
			<?php endif; ?>
				<div class="clear"></div>
			</div>
			<?php endwhile; endif;?>		
			</div> <!-- end of main -->
		<div class="clear"></div>
<?php get_footer(); ?>