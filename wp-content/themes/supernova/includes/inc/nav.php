<?php
/**
 * Template for displaying newer and older entries at different locations like archive
 *
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 */
?>

<div class="navigation">
	<div class="next-posts"><?php next_posts_link(__('&laquo; Older Entries', 'Supernova')) ?></div>
	<div class="prev-posts"><?php previous_posts_link(__('Newer Entries &raquo;', 'Supernova')) ?></div>
</div>