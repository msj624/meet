<?php get_header();
  get_template_part('orange','header');
?>
	
 
    
 	<!-- Main_area -->
	<div class="container">
		<div class="row-fluid">
		<div class="span12 main_space">
			<!-- Main_content -->
			<div class="span8 appo_main_content"> 
			
			<?php if (have_posts()) : 
        while (have_posts()) : the_post(); ?>
			
			 <div class="row-fluid appo_blog">
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
			 
               <h2><?php the_title();?>
				 <?php  echo  get_template_part( 'post-meta-page' ); ?></h2>
				      <?php if ( has_post_thumbnail()) : ?>
				         	<div class="blog_img">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
							<?php the_post_thumbnail(); ?></a>
						
						    </div>
					<?php endif; ?>
					<p><?php the_content(); ?></p>
                   
					<?php if(wp_link_pages(array('echo'=>0))):?>
                    <div class="pagination">
					   <ul >
					     <?php $args=array('before' => '<li>'.__('Pages:','appointment'),'after' => '</li>');
					     wp_link_pages($args); ?>
					    </ul>
					 </div>
					 <?php endif; ?>
					
           </div>
			 <?php comments_template( '', true );?>
    </div>
<?php
endwhile;
 endif;?>

		
				
</div><!--appo_main_content-->
<!-- sidebar section -->
<div class="span4 appo_sidebar">

	  <?php get_sidebar();?>
</div>	  


	</div>
		</div>
	</div>
	<!-- /Main_area -->	  


<?php get_footer(); ?>