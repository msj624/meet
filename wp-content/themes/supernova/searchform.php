<?php
/**
 * The template for displaying search forms in Supernova
 *
 * @package Supernova
 * @since Supenova 1.0.4
 * @license GPL 2.0
 */
?>

<form action="<?php echo esc_url(home_url( '/' )); ?>" class="searchform" method="get">
    <div>
        <input type="text" placeholder="<?php _e('Search...', 'Supernova'); ?>" name="s" class="supernova_search search_input supernova-input" value="" />        
        <input type="submit" value="" class="searchsubmit" />
    </div>
</form>