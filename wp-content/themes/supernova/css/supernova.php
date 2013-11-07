<?php
/** 
 * Template Name: Supernova 
  */
?>
    
<?php get_header(); ?>

<div id="content_wrapper">
    <div id="content">        
        <section class="main_content">
            <div id="theme_demo">
                <section class="theme_image"><img class="theme_screen" src="<?php echo SUPERNOVA_ROOT; ?>/screenshot.png"></section>
                <section class="theme_content">                
                    <h2>Supernova Theme</h2>                
                    <p>Supernova is a fully responsive theme which has been specially designed for blogging websites however due to its plenty of customization options it can easily be used for any purpose. This theme has been created for WordPress repository and is licensed under the GPL</p>
                    <div class="theme_buttons">
                        <div class="demo_button">
                            <a href="http://supernovathemes.com/supernova" target="_blank">
                                <button>Demo</button></a>
                        </div>
                        <div class="download_button">
                            <a href="http://wordpress.org/themes/download/supernova.1.4.1.zip" target="_blank">
                                <button>Download</button></a></br><span>(Latest version 1.4.1 )</span>
                        </div>
                    </div><br /><br /><br />
                    <div class="download_button">
                        <a href="http://wordpress.org/themes/download/supernova.1.4.0.zip" target="_blank">
                            <button style="font-size:10px; padding:6px;">Download</button></a></br>
                            <span>(Previous version 1.4.0 )</span>
                    </div>
                </section>
            </div><!--theme_demo-->
            <div id="theme_features">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="post" id="post-<?php the_ID(); ?>">
                    <div class="entry">
                    <?php the_content(); ?>
                        <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
                    </div><!--entry -->
                        <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
                </div><!--post -->
                    <?php endwhile; endif; ?>
            </div><!--theme_features End-->				        
        </section><!--main_content -->
    </div><!--content ENDS -->
        <?php get_sidebar('page'); ?>
</div><!--content_wrapper ENDS -->
    <?php get_footer(); ?>