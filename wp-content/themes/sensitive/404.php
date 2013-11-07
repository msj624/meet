<?php get_header(); ?>    
     
            
<div class="clear"></div>  
<div class="col2 green_posts single">
     
<?php 
while(have_posts()): the_post(); ?>
 
<div class="post">
<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<div class="meta">Posted on <?php the_date(); ?> / Posted by <?php the_author(); ?> / Category <?php the_category(', ');?></div>
<?php sensitive_post_thumb('wpeden-post-thumb'); ?>
<div class="clear"></div>
<p><?php the_content(); ?></p>
<?php wp_link_pages(  ); ?>
<?php if(get_post_type()=='attachment'): ?>
<div class="alignleft"><?php previous_image_link(0,'&#9668; Previous Image') ?></div>
<div class="alignright"><?php next_image_link(0,'Next Image &#9658;') ?></div>
<?php endif; ?>
<p><?php the_tags(); ?></p>
</div>
<div class="mx_comments"> 
<?php comments_template(); ?>
</div>
<?php endwhile; ?>
</div>
<div class="col1 sidebar">
 
<?php dynamic_sidebar('Single Post'); ?>
</div>
        <!-- The JavaScript -->

        
 <?php get_footer(); ?>