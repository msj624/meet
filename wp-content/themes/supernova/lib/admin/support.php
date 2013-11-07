<?php
/*
* Page for Help tab in options page
* @package Supernova
* @since Supenova 1.1
*/
global $supernova_theme_uri;  ?>
<div class="sayed">


<div id="sup_support">
	<div id="sup_logo"><a href="<?php echo $supernova_theme_uri; ?>" target="_blank"><img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/logo.png"></a></div><br />
    <div id="sup_info">    	
        <p><?php _e('Designed & Developed By:', 'Supernova'); ?> <a style="text-decoration:none; font-size:14px;" href="<?php echo $supernova_theme_uri; ?>" target="_blank">Sayed Taqui</a></p>
        <p class="sup_wp_url"><?php _e('If you have any suggestion, question or issues, no matter how small or big it is, feel free to ask on WordPress', 'Supernova'); ?> <a href="http://wordpress.org/support/theme/supernova" target="_blank"><?php _e('support', 'Supernova'); ?></a> <?php _e('forum, or ', 'Supernova'); ?><a href="<?php echo $supernova_theme_uri; ?>/contact-me/" target="_blank"><?php _e('contact me directly', 'Supernova') ?></a><?php _e(' I will try to reply as quickly as possible.', 'Supernova') ?></p>
        <p class="sup_wp_url"><?php _e('If you like this theme please rate it on WordPress', 'Supernova'); ?> <a href="http://wordpress.org/support/theme/supernova" target="_blank"><?php _e('theme reviews', 'Supernova'); ?></a> <?php _e('page', 'Supernova'); ?></p>
        <p class="sup_wp_url"><?php _e('View Theme ', 'Supernova'); ?><a href='http://supernovathemes.com/supernova/' target="_blank"><?php _e('Demo', 'Supernova'); ?></a></p>  
</div><!--sup_info -->
</div>

<div class="clearfix"></div>
<div class="documentation">	
	<h3><?php _e('Getting Started:', 'Supernova'); ?></h3>
    <p><?php _e(' All features of this theme have been kept on, so you dont have hard time understanding them and you can remove the ones you dont want, however there are couple of things you would want to know on the first use of this theme. ', 'Supernova'); ?></p>    
	<p><strong><?php _e('Sidebar:', 'Supernova'); ?></strong><?php _e(' Supernova has two sidebars, "Sidebar Home" would only show on the home page and "Sidebar Page" would show on all pages except home." ', 'Supernova'); ?></p>
        <p><strong><?php _e('Recommended Posts:', 'Supernova'); ?></strong><?php _e(' Recommended posts can be chosen from where you create or edit posts, at the bottom right of the sidebar." ', 'Supernova'); ?></p>	
	<p><strong><?php _e('Author Info Box:', 'Supernova'); ?></strong><?php _e(' Author info box information can be filled from user profile.', 'Supernova'); ?></p>	
        <p><strong><?php _e('Navigation:', 'Supernova'); ?></strong><?php _e(' Your theme supports four navigations, Header Navigation, Header Categories, Main Navigation and Footer Navigation, when you activate this theme, the menu items may not appear since they are not saved, so please go to Appearance>Menus and save each navigation menu', 'Supernova'); ?></p>        
	<p><strong><?php _e('Plugins:', 'Supernova'); ?></strong><?php _e(' Though the theme loads fast however its highly recommended to use \'WP TOTAL CACHE\' plugin to decrease the page load time even more. The theme already has pagination however if you need to use a plugin, turn off pagination from advanced tab first, likewise turn off back-to-top feature and breadcrumb.', 'Supernova'); ?></p>        

    <h3><?php _e('What\'s new in this version(1.4.2)?', 'Supernova'); ?><sup>new</sup></h3>
    <p><?php _e('1) Added six more color schemes.' , 'Supernova'); ?></p>
    <p><?php _e('2) Option to turn off responsiveness(in advanced tab).' , 'Supernova'); ?></p>    
    <p><?php _e('3) Now you can center or right align your logo/site-title/logo-image from Apperance>Header> "Header Logo Position." .', 'Supernova'); ?></p>
    <p><?php _e('4) Added one more tab \'popular\' with recommended.', 'Supernova'); ?></p>
    <p><?php _e('5) Added one more social icon Linkedin. ', 'Supernova'); ?></p> 
    <p><?php _e('6) You can now know the slider image size even if you have slected a different content size.', 'Supernova'); ?></p>  
    <p><?php _e('8) Supernova is now HTML5 validated at w3.org .', 'Supernova'); ?></p>
    <p><?php _e('9) Added one more widget in header.', 'Supernova'); ?></p>
    <p><?php _e('10) Fixed bugs.', 'Supernova'); ?></p>
    <p><?php _e('11) Supernova now loads faster than before.', 'Supernova'); ?></p>
    
    	<h3><?php _e('Having Problem?:', 'Supernova'); ?></h3>
	<p><?php _e('If something goes wrong or stops working all of a sudden, follow these steps before putting the blame on your theme', 'Supernova'); ?></p>
   	<p><?php _e('a) Switch to Wordpress default Twenty Twelve theme to see if its a theme related issue or a plugin which is causing problem, dont worry, the theme settings would not be lost', 'Supernova'); ?></p>
	<p><?php _e('b) Deactivate all plugins and see if that solves the problem.', 'Supernova'); ?></p> 
    <p><?php _e('c) Please reset settings of Supernova theme', 'Supernova'); ?></p>  
	<p><?php _e('If the problem could not be solved even after following these three steps check worpdress support forum for Supernova and see if there is already a solution to it or start a new discussion', 'Supernova'); ?></p>
    <p><?php _e('Supernova doesn\'t alter your existing database, so you can always switch back to your old theme and all your previous settings would be intact.', 'Supernova'); ?></p>
            
    <p><strong><?php _e('Tip:', 'Supernova'); ?></strong><?php _e(' You dont have to hit \'save settings\' on each page, just edit all the information and hit \'save settings\' only once. You dont even have to hit \'save settings\' just hit enter', 'Supernova'); ?> </p>
    <h2 class="pstdoyt"><strong><?php _e('Please support the development of your theme', 'Supernova'); ?></strong></h2>    
    <table>
    <tr>
    	<td class="cofee"><img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/cofee_big.gif"><i><?php _e('Buy me a cup of coffee', 'Supernova'); ?></i></td>
    	<td class="paypal"><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=sayed2x2@gmail.com&item_name=Donation for Supernova" title="Thank You" target="_blank"><img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/donate.gif" ></a></td>
    </tr>     
    </table>
</div>
</div> <?php 