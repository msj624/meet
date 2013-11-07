<?php
/**
 * Template for displaying meta in all posts
 *
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 */
?>

<?php global $supernova_options; ?>
<?php if(!supernova_options('disable-meta')){ ?>
    <div class="postmetadata">
<div class="meta">
	<span class="left_meta">		
	<?php if(!supernova_options('disable-author')){ ?>
	<em class="meta_by"><?php _e('By', 'Supernova'); ?></em><em class="meta_author"><?php the_author_posts_link(); ?></em> | 
    <?php } ?>
    <?php if(!supernova_options('disable-date')){ ?>
    <em class="meta_date"><?php the_time('F jS, Y') ?></em>  
    <?php } ?>
	<span class="leave_comment"><?php comments_popup_link(__('| LEAVE A COMMENT', 'Supernova'), __('| SHOW COMMENT(1)', 'Supernova') , __('| SHOW COMMENTS (%)', 'Supernova'), 'comments-link', ''); ?></span>
    </span>
    <span class="social_black">
   	 <?php  do_action('supernova_meta_hook');  //You can hook or replace your social icons here ?>
    </span>
</div>
    </div>
<?php }else{
	echo '<div class="dvd_line"></div>';
	}