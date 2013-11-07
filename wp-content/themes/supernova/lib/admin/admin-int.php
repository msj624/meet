<?php 
/*
* The main layout of the admin options page, all the pages are called only from here
 * @package Supernova
 * @since Supenova 1.0.1
* 
*/

global $supernova_fonts, $supernova_slide_effect, $jpg_optimizer, $png_optimizer;
include SUPERNOVA_ADMIN.'page-setup.php';
 ?>
<div id="supernova_options_page">	
	<?php supernova_version_notice(); ?>
    <div class="supernova_tabs">
            <ul>
                <li id="tab_one"><i class="general"></i><span><?php _e('General', 'Supernova'); ?></span></li>
                <li id="tab_two"><i class="layout"></i><span><?php _e('Layout', 'Supernova') ?></span></li>
                <li id="tab_three"><i class="styling"></i><span><?php _e('Styling', 'Supernova'); ?></span></li>
                <li id="tab_four"><i class="slider"></i><span><?php _e('Slider', 'Supernova'); ?></span></li>
                <li id="tab_five"><i class="social"></i><span><?php _e('Social', 'Supernova'); ?></span></li>
                <li id="tab_six"><i class="footer"></i><span><?php _e('Advanced', 'Supernova'); ?></span></li>
                <li id="tab_eight"><i class="ad"></i><span><?php _e('Manage Ads', 'Supernova'); ?></span></li>
                <li id="tab_seven"><i class="support"></i><span><?php _e('Support', 'Supernova'); ?></span></li>                
            </ul>
        </div><!--supernova_tabs END -->        
    <div id="menu_right">    	
        <div id="one" class="tab_content">	
            <?php supernova_admin_page_setup('General', 200); ?>
        </div>            
        <div id="two" class="tab_content">
            <?php supernova_admin_page_setup('Layout', 150 , 1); ?>			
        </div>            
        <div id="three" class="tab_content">
            <?php supernova_admin_page_setup('Styling', 150 , 4, $supernova_fonts); ?>	
        </div>               
        <div id="four" class="tab_content">
            <?php supernova_admin_page_setup('Slider Posts', 120 , false, $supernova_slide_effect); ?>				
        </div>
        <div id="five" class="tab_content">
            <?php supernova_admin_page_setup('Social Profiles', 200); ?>
        </div>
         <div id="six" class="tab_content">
            <?php supernova_admin_page_setup('Advanced', 250); ?>
        </div>
        <div id="seven" class="tab_content">
            <?php include SUPERNOVA_ADMIN.'support.php'; ?>
        </div>
        <div id="eight" class="tab_content">
            <?php supernova_admin_page_setup('Ad Spots', 140); ?>
        </div>        
    </div><!--menu_right ENDS -->
<div class="image_size_notice">
    <table class="widefat" >
    <thead>
        <tr><th colspan="3"><?php _e('Let your site load fast', 'Supernova'); ?></th></tr>        
    </thead>
        <tr>
            <td><?php _e('Please do not upload heavy images which increase your page load time, and use the exact size so the images do not strech nor they affect your page load time.', 'Supernova'); ?><a href="<?php echo site_url(); ?>/?slidesize" target="_blank"><strong><?php _e('Click here ', 'Supernova'); ?></strong></a><?php _e('to know the correct size of your slider images, if you have changed the content or sidebar width.', 'Supernova'); ?><br><br>
                <span><strong><?php _e('Default : 735 X 300px','Supernova'); ?> </strong></span><br>
                 <span><strong><?php _e('Size : Around 50kb.', 'Supernova'); ?></strong></span><br><br>
                 <span><?php _e('Its recommended to use online tools like', 'Supernova'); ?> <a href="<?php echo $jpg_optimizer; ?>" target="_blank"><?php echo $jpg_optimizer; ?></a><?php _e(' to compress jpeg and ', 'Supernova'); ?><a href="<?php echo $png_optimizer; ?>" target="_blank"><?php echo $png_optimizer; ?></a> <?php _e(' for compressing png images, and make your site load faster.', 'Supernova'); ?></span>
            </td><br>        
        </tr>
        
    </table>
</div>    
</div><!--supernova_options_page ENDS -->

<noscript>
<style>
	#supernova_options_page{
		display:block; /*To accomodate people who have javascript disabled*/
	}
</style>
</noscript>

<span class="loader"></span>
<span class="saving_settings"></span>
<?php 	if( isset($_GET['settings-updated']) ) {
            echo '<span class="supernova_saved"></span>';}