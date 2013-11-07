<?php
/**
 * The main template file which most of the time is used on the home page
 *
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 */

get_header(); ?>

<div id="content_wrapper">
    <section id="content" class="home_content">                         
    <?php get_template_part('includes/index-slider'); ?>

                    <!--CONTENT PART STARTS-->
                    
        <?php supernova_ajax_tabs();  ?>
        <section class="main_content">                        
            <?php do_action('supernova_above_posts'); ?>                                 
                    <div id="main_posts">
                        <div class="main_loop">
                            <?php get_template_part('loop');  //Main post content. Get it from loop.php ?>
                        </div><!--main-loop -->
                            <div id="popular_posts"></div>
                            <div id="rec_posts"></div>
                        <?php do_action('supernova_below_posts');?>
                    </div><!--main_posts -->            
        </section><!--main_content ENDS -->        
                <div class="clearfix"></div>
    </section><!--content ENDS -->
    
                <!--CONTENT PART ENDS-->

<?php get_sidebar(); ?>

		<div class="clearfix"></div>
<?php do_action('supernova_above_footer'); ?>
</div><!--content_wrapper ENDS -->

<?php get_footer(); ?>