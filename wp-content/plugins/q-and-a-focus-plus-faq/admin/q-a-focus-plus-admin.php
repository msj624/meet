<?php 
global $qafp_options;	
$qafp_options = get_option( 'qafp_options' );
$qafp_admin = get_option( 'qafp_admin_options' );

$qafp_errors = array();

$page_exists = get_page_by_path( $qafp_options['faq_slug'] );
$qafp_admin = get_option( 'qafp_admin_options' );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$easytson = is_plugin_active('easy-taxonomy-support/easy-taxonomy-support.php');
if ( $easytson ) {
	$ezts_options = get_option( 'ezts_options' );
	$qafp_options['tax_off'] = ( !$ezts_options['cpt_off'] ) ? true : false;
	update_option( 'qafp_options', $qafp_options );
}

//function check_post_type() {
//if ( check_old_post_type() ) fix_old_post_type();

if ( ! $page_exists && $qafp_admin['dismiss_slug'] != true ) {
	$qafp_errors[] = '' . sprintf( __('The FAQ homepage (%s) doesn\'t exist yet. Would you like to create it?', 'qa-focus-plus'), $qafp_options['faq_slug'] )
	. '<br /><br />
	<form type="post" action="" id="createPage">
	<input type="hidden" name="action" value="addqafpPage"/>
	<input class="button-primary" type="submit" value="Create Page">
	</form>
	
	<form type="post" action="" id="dismissqaffp">
	<input type="hidden" name="action" value="dismissqaffpCreate"/>
	<input type="submit" value="dismiss">
	</form>
	<div id="feedback"></div>'; 
}

// Add a menu for our option page
add_action('admin_menu', 'qafp_add_page');
function qafp_add_page() {
	add_options_page( 'Q & A Focus Plus', 'Q & A Focus Plus', 'manage_options', 'qafp', 'qa_fp_option_page' );
}

function qafp_admin_scripts() {
	global $qafp_options;
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_register_script( 'q-a-focus-plus-admin', plugins_url( 'js/q-a-focus-plus-admin.js', __FILE__ ), false, $qafp_options['version'], true); 
	wp_enqueue_script( 'q-a-focus-plus-admin' );
	wp_register_style( 'q-a-focus-plus-admin', plugins_url( 'css/q-a-focus-plus-admin.css', __FILE__ ), false, $qafp_options['version'], 'screen' ); 
	wp_enqueue_style( 'q-a-focus-plus-admin' );
}

if ( isset( $_GET['page'] ) && $_GET['page'] == "qafp" ) {
	add_action('init', 'qafp_admin_scripts');
}

// Draw the option page
function qa_fp_option_page() {

global $qafp_errors;	

$qafp_options = get_option( 'qa_fp_settings' );

/* We're going to run this a second time here */
function qafp_flush_rules() {
	global $wp_rewrite;
	$wp_rewrite->flush_rules();
}

if ( isset($_GET['settings-updated'])) {
	qafp_flush_rules();
} 

?>
	<div class="wrap">

	<div id="tabs">
		<ul>
			<li><a id="tab-anchor-1" class="tab-anchor" href="#tabs-1"><?php _e('Plugin Settings', 'qa-focus-plus'); ?></a></li>
			<li><a id="tab-anchor-2" class="tab-anchor" href="#tabs-2"><?php _e('Documentation', 'qa-focus-plus'); ?></a></li>
		</ul>

		<div style="margin-left:4px;">
        <span style="float:right;margin-top:4px;"><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="3EHFFXE5WBUJ2">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form></span>

		<?php screen_icon(); ?>
		<h2>Q &amp; A Focus Plus</h2>
		</div>
		<div style="clear:right;"></div>

		<?php if ( $qafp_errors ) {
			foreach ( $qafp_errors as $error ) { 
				echo '<div id="message" class="updated fade" style="max-width: 780px; margin: 18px 0 0 18px;">
					<p>' . $error . '</p>
					</div>';	
			}
		}?>
		
		<div id="tabs-1" class="tab">

		<form action="options.php" method="post">
			<?php settings_fields('qafp_options'); ?>
			<?php do_settings_sections('qa_fp'); ?>
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes', 'qa-focus-plus'); ?>" />
			</p>
		</form>
		
		</div><!--#tabs-1-->
										
		<div id="tabs-2" class="tab" style="width:700px">
		
		<?php require('documentation.php'); ?>
								
		</div><!--#tabs-2-->
	</div><!--#tabs-->
		
	<a href="http://spectrumvisions.com"><img style="margin-top:30px;" src="<?php echo plugins_url( 'img/logo.png', __FILE__ );?>" width="249" height="60" alt="Spectrum Visions" /></a>
	<p><?php _e('You\'re using the all FREE Q &amp; A Focus Plus FAQ, made by', 'qa-focus-plus'); ?> <a href="http://spectrumvisions.com" target="_blank"><?php _e('Spectrum Visions', 'qa-focus-plus'); ?></a> <?php _e('Based on the original Q &amp; A Plus by Raygun.', 'qa-focus-plus'); ?></p>
</div>

<?php
}

// Register and define the settings
add_action('admin_init', 'qafp_admin_init');

function qafp_admin_init(){
	
	global $gallery_style_options;

	register_setting(
		'qafp_options',
		'qafp_options',
		'qa_fp_validate_options'
	);
	
	add_settings_section(
		'qa_fp_homepage_settings',
		__('FAQ Homepage Options', 'qa-focus-plus'),
		'qa_fp_section_text',
		'qa_fp'
	);
	
	add_settings_section(
		'qa_fp_general_settings',
		__('Global Options','qa-focus-plus'),
		'qa_fp_section_text',
		'qa_fp'
	);

	add_settings_section(
		'qa_fp_ratings_settings',
		__('Ratings Options','qa-focus-plus'),
		'qa_fp_section_text',
		'qa_fp'
	);

	add_settings_section(
		'qa_fp_advanced_settings',
		__('Advanced Options','qa-focus-plus'),
		'qa_fp_section_text',
		'qa_fp'
	);
			
	add_settings_field(
		'qa_fp_slug',
		__( 'FAQ homepage', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Where would you like your FAQ homepage to live? This can be a page that already exists on your site, but it shouldn\'t be the front page.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_slug_input',
		'qa_fp',
		'qa_fp_homepage_settings'
	);
	
	add_settings_field(
		'qa_fp_limit',
		__( 'FAQs per category', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('How many items should we show in each category on the Q & A homepage? -1 shows all FAQ entries. Users will be able to click a link to see all questions on the category page.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_limit_input',
		'qa_fp',
		'qa_fp_homepage_settings'
	);

	add_settings_field(
		'qa_fp_catlink',
		__( 'Show category links', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Show links to the single category page below each category. Works well in conjunction with the limit setting to condense your FAQ homepage.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_catlink_input',
		'qa_fp',
		'qa_fp_homepage_settings'
	);

	add_settings_field(
		'qa_fp_postnumber',
		__( 'Show number of entries', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Show total number of FAQ entries in the category header.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_postnumber_input',
		'qa_fp',
		'qa_fp_homepage_settings'
	);

	add_settings_field(
		'qa_fp_excerpts',
		__( 'Show excerpts', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Show excerpts instead of full entries on the FAQ homepage.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_excerpt_input',
		'qa_fp',
		'qa_fp_homepage_settings'
	);

	add_settings_field(
		'qa_fp_sort',
		__( 'Sort order', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Sort the questions on the FAQ homepage by menu order, or ratings (ratings must be enabled first).', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_sort_input',
		'qa_fp',
		'qa_fp_homepage_settings'
	);

	add_settings_field(
		'qa_fp_last_update',
		__( 'Show FAQ last updated', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Show the date the FAQ was last updated on the FAQ home page.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_last_update_input',
		'qa_fp',
		'qa_fp_homepage_settings'
	);

	add_settings_field(
		'qa_fp_search',
		__( 'Show search', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Show the search form on the home and category pages.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_search_input',
		'qa_fp',
		'qa_fp_general_settings'
	);

	add_settings_field(
		'qa_fp_search_position',
		__( 'Search box position', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Add the search box before or after the FAQ content.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_search_position_input',
		'qa_fp',
		'qa_fp_general_settings'
	);

	add_settings_field(
		'qa_fp_show_permalinks',
		__( 'Show permalinks', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Add a permalink to each FAQ entry.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_show_permalinks_input',
		'qa_fp',
		'qa_fp_general_settings'
	);

	add_settings_field(
		'qa_fp_animation_style',
		__( 'Animation style', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('What animation should be used to show/hide the FAQs?', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_animation_style_input',
		'qa_fp',
		'qa_fp_general_settings'
	);

	add_settings_field(
		'qa_fp_accordion',
		__( 'Accordion behavior', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Clicking a FAQ title closes any other open FAQs.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_accordion_input',
		'qa_fp',
		'qa_fp_general_settings'
	);

	add_settings_field(
		'qa_fp_collapsible',
		__( 'Enable show/hide behavior', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Uncheck this to turn off the show/hide behavior.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_collapsible_input',
		'qa_fp',
		'qa_fp_general_settings'
	);

	add_settings_field(
		'qa_fp_focus',
		__( 'Focus open question at top', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Uncheck this to turn off the focus behavior.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_focus_input',
		'qa_fp',
		'qa_fp_general_settings'
	); // FOCUS

	add_settings_field(
		'qa_fp_hr',
		__( 'Horizontal rule below answers', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Uncheck this to turn off the horizontal rule.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_hr_input',
		'qa_fp',
		'qa_fp_general_settings'
	); // HR

	add_settings_field(
		'qa_fp_ratings',
		__( 'Enable ratings', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Check this to turn ratings on. Uncheck this to turn off the ratings.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_ratings_input',
		'qa_fp',
		'qa_fp_ratings_settings'
	); // RATINGS ON

	add_settings_field(
		'qa_fp_restrict_ratings',
		__( 'Ratings require log in', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Restrict ratings to logged in users only (registered users can only rate once). Uncheck to allow anonymous visitors to rate questions (may not be as accurate).', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_restrict_ratings_input',
		'qa_fp',
		'qa_fp_ratings_settings'
	); // RATINGS RESTRICTED

	add_settings_field(
		'qa_fp_rate_wait',
		__( 'Visitor rating wait time', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('The amount of time anonymous visitors must wait before being able to rate questions they have already rated. Leave blank to prevent more than one vote from the same IP address. Uncheck \'Ratings require log in\' to enable this.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_rate_wait_input',
		'qa_fp',
		'qa_fp_ratings_settings'
	); // RATINGS RESTRICTED

	add_settings_field(
		'qa_fp_ricons',
		__( 'Rating icon colors', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Select icons for light, or dark templates (ratings must be enabled first).', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_ricons_input',
		'qa_fp',
		'qa_fp_ratings_settings'
	); // RATING ICONS

	add_settings_field(
		'qa_fp_tax_off',
		__( 'Disable built-in tag support', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Check this if you are already using a plugin that adds post tag taxonomy support for custom post types. Checking this without having any other custom post type taxonomy support enabled will break any tags that you have added to your FAQs. Broken tags will produce \'nothing found\' or other errors when clicked on. It is safe to leave this unchecked if you are unsure whether, or not you need this and all of your tags are working fine. If checking this option breaks your FAQ tags you will need to uncheck it. This option will be disabled if you are using our Easy Taxonomy Support plugin.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_tax_off_input',
		'qa_fp',
		'qa_fp_advanced_settings'
	); // Disable native taxonomy support
	
	add_settings_field(
		'qa_fp_hide_tags',
		__( 'Hide tags on FAQ pages', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Check this if you do not want to display the tags on your FAQs. This should be checked if you do not have any other taxonomy support and your tags are producing \'nothing found\' errors.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_hide_tags_input',
		'qa_fp',
		'qa_fp_advanced_settings'
	); // Disable native taxonomy support

	add_settings_field(
		'qa_fp_categoryhead',
		__( 'Category heading', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('What HTML heading would you like to use for the category names? Select H1, H2, H3, or H4. The default is H3.', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_categoryhead_input',
		'qa_fp',
		'qa_fp_advanced_settings'
	);		

	add_settings_field(
		'qa_fp_titlecss',
		__( 'Question title CSS', 'qa-focus-plus' ) . ' <span class="vtip" title="' . __('Edit the default CSS to change the appearance of the question titles.', 'qa-focus-plus' ) . '<br />' . __( 'Allowed characters: a-z 0-9 . - : ; %', 'qa-focus-plus' ) . '">?</span>',
		'qa_fp_titlecss_input',
		'qa_fp',
		'qa_fp_advanced_settings'
	);

	add_settings_field(
		'QAFP_VERSION',
		__( 'Version', 'qa-focus-plus' ),
		'QAFP_VERSION_input',
		'qa_fp',
		'qa_fp_advanced_settings'
	);		
}


// Draw the section header
function qa_fp_section_text() {
}

// Display and fill the form fields

function qa_fp_slug_input() {
	$qafp_options = get_option( 'qafp_options' );
	
	echo "<input name='qafp_options[faq_slug]' type='text' size='20' value='$qafp_options[faq_slug]' />";
}

function qa_fp_limit_input() {
	$qafp_options = get_option( 'qafp_options' ); ?>
	
	<input name="qafp_options[limit]" type="text" size="5" value="<?php echo $qafp_options['limit'];?>" />
<?php }

function qa_fp_catlink_input() {
	$qafp_options = get_option( 'qafp_options' ); ?>
	
	<input type="checkbox" name="qafp_options[catlink]" value="true" <?php checked( $qafp_options['catlink'] ); ?> />
<?php }

function qa_fp_postnumber_input() {
	$qafp_options = get_option( 'qafp_options' ); ?>
	
	<input type="checkbox" name="qafp_options[postnumber]" value="true" <?php checked( $qafp_options['postnumber'] ); ?> />
<?php }

function qa_fp_excerpt_input() {
	$qafp_options = get_option( 'qafp_options' ); ?>
	
	<input type="checkbox" name="qafp_options[excerpts]" value="true" <?php checked( $qafp_options['excerpts'] ); ?> />
<?php }

function qa_fp_sort_input() {
	$qafp_options = get_option( 'qafp_options' );?>

	<select name="qafp_options[sort]" />
		<option value="menu_order" <?php if ( $qafp_options['sort'] == "menu_order" ) echo " selected='selected'";?>><?php _e( 'Menu order', 'qa-focus-plus');?></option>
		<?php if ( $qafp_options['ratings'] == true ) { ?>
        <option value="ratings" <?php if ( $qafp_options['sort'] == "ratings" ) echo " selected='selected'";?>><?php _e( 'Ratings', 'qa-focus-plus');?></option>
        <?php } ?>
	</select>
<?php }

function qa_fp_last_update_input() {
	$qafp_options = get_option( 'qafp_options' ); ?>
	
	<input type="checkbox" name="qafp_options[last_update]" value="true" <?php checked( $qafp_options['last_update'] ); ?> />
<?php }

function qa_fp_search_input() {
	$qafp_options = get_option( 'qafp_options' );?>

	<select name="qafp_options[search]" />
		<option value="home" <?php if ( $qafp_options['search'] == "home" ) echo " selected='selected'";?>><?php _e( 'On home page', 'qa-focus-plus');?></option>
		<option value="category" <?php if ( $qafp_options['search'] == "categories" ) echo " selected='selected'";?>><?php _e( 'On category pages', 'qa-focus-plus');?></option>
		<option value="both" <?php if ( $qafp_options['search'] == "both" ) echo " selected='selected'";?>><?php _e( 'Both home and category pages', 'qa-focus-plus');?></option>
		<option value="none" <?php if ( $qafp_options['search'] == "none" ) echo " selected='selected'";?>><?php _e( 'Do not enable search', 'qa-focus-plus');?></option>
	</select>
<?php }

function qa_fp_search_position_input() {
	$qafp_options = get_option( 'qafp_options' );?>

	<select name="qafp_options[searchpos]" />
		<option value="top" <?php if ( $qafp_options['searchpos'] == "top" ) echo " selected='selected'";?>><?php _e( 'Top', 'qa-focus-plus');?></option>
		<option value="bottom" <?php if ( $qafp_options['searchpos'] == "bottom" ) echo " selected='selected'";?>><?php _e( 'Bottom', 'qa-focus-plus');?></option>
	</select>
<?php }

function qa_fp_animation_style_input() {
	$qafp_options = get_option( 'qafp_options' );?>

	<select name="qafp_options[animation]" />
		<option value="fade" <?php if ( $qafp_options['animation'] == "fade" ) echo " selected='selected'";?>><?php _e( 'Fade', 'qa-focus-plus'); ?></option>
		<option value="slide" <?php if ( $qafp_options['animation'] == "slide" ) echo " selected='selected'";?>><?php _e( 'Reveal', 'qa-focus-plus'); ?></option>
		<option value="none" <?php if ( $qafp_options['animation'] == "none" ) echo " selected='selected'";?>><?php _e( 'None', 'qa-focus-plus'); ?></option>
	</select>
<?php }

function qa_fp_accordion_input() {
	$qafp_options = get_option( 'qafp_options' ); ?>
	
	<input type="checkbox" name="qafp_options[accordion]" value="true" <?php checked( $qafp_options['accordion'] ); ?> />
<?php }

function qa_fp_collapsible_input() {
	$qafp_options = get_option( 'qafp_options' ); ?>
	
	<input type="checkbox" name="qafp_options[collapsible]" value="true" <?php checked( $qafp_options['collapsible'] ); ?> />
<?php }
 // FOCUS
function qa_fp_focus_input() {
	$qafp_options = get_option( 'qafp_options' ); ?>
	
	<input type="checkbox" name="qafp_options[focus]" value="true" <?php checked( $qafp_options['focus'] ); ?> />
<?php }

 // HR
function qa_fp_hr_input() {
	$qafp_options = get_option( 'qafp_options' ); ?>
	
	<input type="checkbox" name="qafp_options[hr]" value="true" <?php checked( $qafp_options['hr'] ); ?> />
<?php }

 // RATINGS
function qa_fp_ratings_input() {
	$qafp_options = get_option( 'qafp_options' ); ?>
	
	<input type="checkbox" name="qafp_options[ratings]" value="true" <?php checked( $qafp_options['ratings'] ); ?> />
<?php }

function qa_fp_restrict_ratings_input() {
	$qafp_options = get_option( 'qafp_options' ); ?>
	
	<input type="checkbox" name="qafp_options[restrict_ratings]" value="true" <?php checked( $qafp_options['restrict_ratings'] ); if ( !$qafp_options['ratings'] ) echo 'disabled="disabled"'; ?> />
<?php }

function qa_fp_rate_wait_input() {
	$qafp_options = get_option( 'qafp_options' ); ?>
	
	<input name="qafp_options[rate_wait]" type="text" size="8" value="<?php echo $qafp_options['rate_wait'];?>" <?php if ( $qafp_options['restrict_ratings'] ) echo 'disabled="disabled"'; ?> /> <span style="padding-top: 4px;"><?php if ( !$qafp_options['restrict_ratings'] && $qafp_options['ratings'] ) _e( 'Minutes - Leave blank to allow only one vote for each IP address.', 'qa-focus-plus'); ?></span>
<?php }

function qa_fp_ricons_input() {
	$qafp_options = get_option( 'qafp_options' ); ?>

	<select name="qafp_options[ricons]" <?php if ( !$qafp_options['ratings'] ) echo 'disabled="disabled"'; ?> />
		<option value="light" <?php if ( $qafp_options['ricons'] == "light" ) echo "selected='selected'";?>><?php _e( 'Light', 'qa-focus-plus'); ?></option>
		<option value="dark" <?php if ( $qafp_options['ricons'] == "dark" ) echo "selected='selected'";?>><?php _e( 'Dark', 'qa-focus-plus'); ?></option>
	</select>
    <br /><br />
    For light backgrounds: &nbsp;<span style="width:47px;height:14px;padding:8px 4px 2px 4px;border:none;background-color:#ffffff;"><img src="<?php echo QAFP_URL; ?>/img/ratings-light.png" style="width:47px;height:14px;border:none;" alt="<?php _e( 'Icons for light backgrounds.',  'qa-focus-plus' ); ?>" /></span><br /><br />
    For dark backgrounds: &nbsp;<span style="width:47px;height:14px;padding:8px 4px 2px 4px;border:none;background-color:#000000;"><img src="<?php echo QAFP_URL; ?>/img/ratings-dark.png" style="width:47px;height:14px;border:none;" alt="<?php _e( 'Icons for dark backgrounds.',  'qa-focus-plus' ); ?>" /></span>
<?php }

function qa_fp_show_permalinks_input() {
	$qafp_options = get_option( 'qafp_options' ); ?>
	
	<input type="checkbox" name="qafp_options[permalinks]" value="true" <?php checked( $qafp_options['permalinks'] ); ?> />
<?php }

function qa_fp_tax_off_input() {
	global $easytson;
	$qafp_options = get_option( 'qafp_options' ); ?>
	
	<input type="checkbox" name="qafp_options[tax_off]" value="true" <?php checked( $qafp_options['tax_off'] ); if ( $easytson ) echo 'disabled="disabled"'; ?> />
	<?php if ( $easytson ) {
		echo '&nbsp;&nbsp;<span style="font-size:90%">';
		_e( 'The Easy Taxonomy Support plugin is active.', '');
		echo '</span>
		';
	} ?>
<?php }

function qa_fp_hide_tags_input() {
	$qafp_options = get_option( 'qafp_options' ); ?>
	
	<input type="checkbox" name="qafp_options[hide_tags]" value="true" <?php checked( $qafp_options['hide_tags'] ); ?> />
<?php }

function qa_fp_categoryhead_input() {
	$qafp_options = get_option( 'qafp_options' );
	if ( $qafp_options['categoryhead'] == '' ) $qafp_options['categoryhead'] = 'h3'; ?>
	<select name="qafp_options[categoryhead]" />
        <option value="h1" <?php if ( $qafp_options['categoryhead'] == "h1" ) echo " selected='selected'";?>><?php _e( 'H1', 'qa-focus-plus');?></option>
        <option value="h2" <?php if ( $qafp_options['categoryhead'] == "h2" ) echo " selected='selected'";?>><?php _e( 'H2', 'qa-focus-plus');?></option>
		<option value="h3" <?php if ( $qafp_options['categoryhead'] == "h3" ) echo " selected='selected'";?>><?php _e( 'H3', 'qa-focus-plus');?></option>
        <option value="h4" <?php if ( $qafp_options['categoryhead'] == "h4" ) echo " selected='selected'";?>><?php _e( 'H4', 'qa-focus-plus');?></option>
	</select> &nbsp;<span style="font-size:80%"><a href="http://www.w3schools.com/html/html_headings.asp" target="_blank">Learn about headings.</a></span>
<?php }

function qa_fp_titlecss_input() {
	$qafp_options = get_option( 'qafp_options' );
	if ( $qafp_options['titlecss'] == '' ) $qafp_options['titlecss'] = 'font-size:110%;font-weight:bold;margin-bottom:.5em'; ?>
	<input type="text" id="titlecss" name="qafp_options[titlecss]" size="54" maxlength="100" value="<?php echo $qafp_options['titlecss']; ?>" /> &nbsp;<span style="font-size:80%"><a href="http://www.w3schools.com/css/" target="_blank">Learn about CSS.</a></span>
<?php }

function QAFP_VERSION_input() {
	// get option 'text_string' value from the database
	$qafp_options = get_option( 'qafp_options' );
		
	// echo the field
	echo '<input type="text" readonly="readonly" id="version" name="qafp_options[version]" value="' . $qafp_options['version'] . '" />';
}

// Validate user input
function qa_fp_validate_options( $input ) {
	global $qafp_options;
	if ( isset( $input['faq_slug'] ) ) {
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
	}	   

	if ( !$input['limit'] || !is_numeric($input['limit']) )
		$input['limit'] = 10;

	if ( ! isset( $input['postnumber'] ) )
		$input['postnumber'] = null;
	$input['postnumber'] = ( $input['postnumber'] == true ? true : false );

	if ( ! isset( $input['catlink'] ) )
		$input['catlink'] = null;
	$input['catlink'] = ( $input['catlink'] == true ? true : false );

	if ( ! isset( $input['excerpts'] ) )
		$input['excerpts'] = null;
	$input['excerpts'] = ( $input['excerpts'] == true ? true : false );

	if ( ! isset( $input['last_update'] ) )
		$input['last_update'] = null;
	$input['last_update'] = ( $input['last_update'] == true ? true : false );

	if ( ! isset( $input['accordion'] ) )
		$input['accordion'] = null;
	$input['accordion'] = ( $input['accordion'] == true ? true : false );

	if ( ! isset( $input['collapsible'] ) )
		$input['collapsible'] = null;
	$input['collapsible'] = ( $input['collapsible'] == true ? true : false );
	// FOCUS
	if ( ! isset( $input['focus'] ) )
		$input['focus'] = null;
	$input['focus'] = ( $input['focus'] == true ? true : false );
	// RATINGS
	if ( ! isset( $input['ratings'] ) )
		$input['ratings'] = null;
	$input['ratings'] = ( $input['ratings'] == true ? true : false );
	// RESTRICT RATINGS
	if ( ! isset( $input['restrict_ratings'] ) )
		$input['restrict_ratings'] = null;
	$input['restrict_ratings'] = ( $input['restrict_ratings'] == true ? true : false );
	// Rate Wait
	if ( !is_numeric($input['rate_wait']) && $input['rate_wait'] != '' ) $input['rate_wait'] = $qafp_options['rate_wait'];
	else if ( $input['rate_wait'] == '' ) $input['rate_wait'] = null;
	// RATINGS ICONS
	$input['ricons'] = ( $input['ricons'] == "light" ? "light" : "dark" );
	// HR
	if ( ! isset( $input['hr'] ) )
		$input['hr'] = null;
	$input['hr'] = ( $input['hr'] == true ? true : false );

	if ( ! isset( $input['permalinks'] ) )
		$input['permalinks'] = null;
	$input['permalinks'] = ( $input['permalinks'] == true ? true : false );
	// tax_off
	if ( ! isset( $input['tax_off'] ) )
		$input['tax_off'] = null;
	$input['tax_off'] = ( $input['tax_off'] == true ? true : false );
	// hide tags
	if ( ! isset( $input['hide_tags'] ) )
		$input['hide_tags'] = null;
	$input['hide_tags'] = ( $input['hide_tags'] == true ? true : false );
	// CSS
	$input['titlecss'] = trim($input['titlecss']);
	$input['titlecss'] = wp_filter_nohtml_kses($input['titlecss']); // REMOVE HTML
	$input['titlecss'] = str_replace(' ', '', $input['titlecss']);
	$input['titlecss'] = preg_replace('/^[^A-Za-z]+/', '', $input['titlecss']);
	$isvalid = preg_match('/[^\w\-\%\;\:\.\/]+/', $input['titlecss']);
	$input['titlecss'] = strtolower($input['titlecss']);
	if ( ! isset( $input['titlecss'] ) || $isvalid !== 0 )
		$input['titlecss'] = 'font-size:110%;font-weight:bold;margin-bottom:.5em';
	// slug
	$input['faq_slug'] = wp_filter_nohtml_kses($input['faq_slug']);
	$input['faq_slug'] = str_replace(' ', '-', $input['faq_slug']);
	$input['faq_slug'] = strtolower($input['faq_slug']);
	
	if ( $input['faq_slug'] != $qafp_options['faq_slug'] ) {
		$qafp_admin = get_option( 'qafp_admin_options' );
		$qafp_admin['dismiss_slug'] = false;
		update_option( 'qafp_admin_options', $qafp_admin );
	}
	
	return $input;		
}