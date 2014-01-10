<?php
/*
Plugin Name: Admin Favicon 
Plugin URI: http://www.johnkolbert.com/portfolio/wp-plugins/admin-favicon
Description: Adds a custom favicon to your WP-Admin Console. It can be configured under the "Settings" tab.
Version: 1.4
Author: John Kolbert
Author URI: http://www.johnkolbert.com/
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

function favi_option_menu() {
	if (function_exists('current_user_can')) {
		if (!current_user_can('manage_options')) return;
	} else {
		global $user_level;
		get_currentuserinfo();
		if ($user_level < 8) return;
	}
	if (function_exists('add_options_page')) {
		add_options_page(__('Admin Favicon'), __('Admin Favicon'), 1, __FILE__, 'favi_options_page');
	}
} 

// Install the options page
add_action('admin_menu', 'favi_option_menu');

function favi_options_page(){
	global $wpdb;
	if (isset($_POST['update_options'])) {
		$options['favi_url'] = trim($_POST['favi_url'],'{}');
		update_option('favi_insert_url', $options);
		// Show a message to say we've done something
		echo '<div class="updated"><p>' . __('Options saved') . '</p></div>';
	} else {
		
		$options = get_option('favi_insert_url');
	}
	
	?>
		<div class="wrap">
		<h2><?php echo __('Admin Favicon Options Page'); ?></h2>
		<form method="post" action="">
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e('Favicon URL:') ?></th>
				<td><input name="favi_url" type="text" id="favi_url" value="<?php echo $options['favi_url']; ?>" size="60" /><br /> Use the above option to set the URL for your favicon. This should be the direct link. Example: <em>http://www.example.com/favicon.ico</em><br />You may have to refresh your browser to see your changes.</td>
			</tr>
		<p>Admin favicon allows you to set a custom favicon for your WordPress administrative pages (like the one you're in now!).<br>
		This plugin was created by <a href="http://www.johnkolbert.com/">John Kolbert</a>. The plugin's official page can be found <a href="http://www.johnkolbert.com/portfolio/wp-plugins/admin-favicon/">here</a>.</p>
		
		</table>
	
		<div class="submit"><input type="submit" name="update_options" value="<?php _e('Update') ?>"  style="font-weight:bold;" /></div>
		</form> <br />
    Help support free plugins. Any donation is appreciated!<br /><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_donations">
<input type="hidden" name="business" value="admin@simply-basic.com">
<input type="hidden" name="item_name" value="Support Free Plugins">
<input type="hidden" name="no_shipping" value="0">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="tax" value="0">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="bn" value="PP-DonationsBF">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>   		
       		
	</div>
	<?php	
}
function Adminfavicon() {

$options = get_option('favi_insert_url');
echo"<link rel=\"shortcut icon\" href=\"$options[favi_url]\" />";
}

add_action('admin_head', 'Adminfavicon');


?>