<?php
/*
 * Loop used for pages, and also for all page templates
 */

?>


    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="post" id="post-<?php the_ID(); ?>">
    <h2 class="post_title page_title"><?php the_title(); ?></h2>
        <div class="entry"> 
            <span class="supernova_thumb"><?php supernova_thumbnail(); ?></span>
            <?php the_content(); ?>
            <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
        </div><!--entry -->
        <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
</div><!--post -->
 <?php if(!supernova_options('page-comment')) { comments_template(); }?> 
    <?php endwhile; endif; ?>