<?php
/**
 * Template for displaying all 404 page, when no page is found
 *
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 */

 get_header(); ?>
	
            <div id="content_wrapper">
        	<div id="content">
	<h2 class="not_found_text"><?php _e('We are sorry looks like we dont have the page you are looking for', 'Supernova'); ?></h2>
	</div>

<?php get_sidebar('page'); ?>

</div>

<?php get_footer(); ?>