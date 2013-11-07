<?php
/*
 * Loop used for single pages
 * 
 */


if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <h2 class="single_heading post_title"><?php the_title(); ?></h2>
        <?php get_template_part('includes/before', 'post'); ?>
       <div class="entry" id="entry">
            <span class="supernova_thumb"><?php supernova_thumbnail(); ?></span>
                <?php the_content(); ?>
             <span class="page_links"><?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?></span>
       </div>                                   
        <?php edit_post_link(__('Edit this entry', 'Supernova'),'','.'); ?>                
    </article>             	
    <?php   get_template_part('includes/after', 'post');
            if(!supernova_options('post-comment')){ comments_template();}
            supernova_count_post_views(get_the_ID());
 endwhile; endif; ?>
