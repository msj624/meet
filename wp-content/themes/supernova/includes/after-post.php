<?php
/**
 * Template for displaying the contents after one of each single post
 *
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 */
?>

<div class="clearfix"></div>
<?php  do_action('supernova_below_single_posts');
       get_template_part('includes/inc/tags');
       
if(!supernova_options('disable-author-box')){ ?>
<div id="authorarea">
    <?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '100' ); }?>
    <div class="authorinfo">        
        <h3><?php _e('About', 'Supernova'); the_author_posts_link(); ?></h3>
        <p><?php the_author_meta('description'); ?></p>
    </div>
</div>
<?php } ?>

<?php get_template_part('includes/meta'); ?>

<div class="clearfix"></div>

<div class="next_prev_post">    
    <span class="prev_post"><?php previous_post_link('%link', __('<< PREVIOUS', 'Supernova')); ?></span>
    <span class="next_post"><?php next_post_link('%link', __('NEXT >>','Supernova')); ?></span>
</div>