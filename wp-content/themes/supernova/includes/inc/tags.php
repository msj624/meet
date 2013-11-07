<?php
/**
 * Template for displaying tags in single posts
 *
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 */
?>
<div class="clearfix"></div>
<?php if (get_the_tags()) :?>
 <p class="tags">Tags: <?php the_tags('', ' ', ''); ?></p>
<?php endif;?>