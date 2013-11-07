<?php
/**
 * The template for displaying footer
 * Contains the closing tag of the div ID 'wrapper' started in header
 * 
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 */
?>
<div class="clearfix"></div>
</div><!--wrapper ENDS -->
            
<footer id="footer_wrapper">
    <div id="footer">
    	<?php if( is_active_sidebar( 'Footer Widgets' ) ) : ?>
            <div id="footer_widgets">
                <?php dynamic_sidebar('Footer Widgets');?>
                <div class="clearfix"></div>
            </div>
        <?php endif; ?>
        
        <div id="lower_footer">
            <div id="footer_left_part">                
                <?php do_action('supernova_footer_nav'); ?>
                <span class="powered_by"><?php _e('Powered by', 'Supernova'); ?><a href="http://wordpress.org" target="_blank">WordPress</a></span>
            </div><!--footer_left_part -->
            <div id="footer_right_part">                
                <?php do_action('supernova_footer_right'); ?>
            </div><!--footer_right_part -->
        </div><!--lower_footer-->
        
    </div><!--footer ENDS -->
    			<div class="clearfix"></div>
</footer><!--footer_wrapper ENDS -->
										
	<?php wp_footer(); ?>
</body>
</html>