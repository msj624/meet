<?php
	error_reporting( E_ALL ^ E_NOTICE );
	require_once( 'classicbiz-admin.php' );

	if (!class_exists('ClassicBiz')) {
		class ClassicBiz extends GetBusinessBlog {

		function ClassicBiz () {
		$classicbiz_theme=wp_get_theme();
		/* THEME VARIABLES */
		$this->themename = $classicbiz_theme['Title'];
		$this->themeurl = $classicbiz_theme['URI'];
		$this->shortname = "SB";
		$directory = get_stylesheet_directory_uri();
		$this->paths = wp_upload_dir(true);
		
			$this->options = array(

				array(	"name" => __('Header Spot <span>customize your header</span>', 'classicbiz'),
								"type" => "subhead"),
									
				array(	"name" => __('Custom content for Spot 1', 'classicbiz'),
								"id" => $this->shortname."_spot1",
								"desc" => __('Use text or properly formatted XHTML/HTML to be displayed to the right of your site title', 'classicbiz'),
								"std" => '',
								"type" => "textarea",
								"options" => array( "rows" => "5", "cols" => "40") 
								),									

				array(	"name" => __('Hide Spot 1', 'classicbiz'),
								"id" => $this->shortname."_hide_spot1",
								"desc" => __('Check this box to disable Spot 1 in the header', 'classicbiz'),
								"std" => '',
								"type" => "checkbox"),
								
				array(	"name" => __('Top Menu <span>control your top navigation menu</span>', 'classicbiz'),
								"type" => "subhead"),
									
				array(	"name" => __('Hide all pages', 'classicbiz'),
								"id" => $this->shortname."_hide_pages",
								"desc" => __('Check this box to hide your blog pages in the navigation menu', 'classicbiz'),
								"std" => '',
								"type" => "checkbox"),
									
				array(	"name" => __('Hide all categories', 'classicbiz'),
								"id" => $this->shortname."_hide_categories",
								"desc" => __('Check this box to hide your blog categories in the navigation menu', 'classicbiz'),
								"std" => '',
								"type" => "checkbox"),
								
				array(	"name" => __('Featured Section <span>manage featured section</span>', 'classicbiz'),
								"type" => "subhead"),
									
				array(	"name" => __('Featured section title', 'classicbiz'),
								"id" => $this->shortname."_title_featured",
								"desc" => __('Input title to be displayed in the featured section', 'classicbiz'),
								"std" => '',
								"type" => "text"),	

				array(	"name" => __('Featured section text', 'classicbiz'),
								"id" => $this->shortname."_text_featured",
								"desc" => __('Add text to be displayed in the featured section of your blog header', 'classicbiz'),
								"type" => "textarea",
								"options" => array( "rows" => "5", "cols" => "40") 
								),

				array(	"name" => __('Featured section button text', 'classicbiz'),
								"id" => $this->shortname."_button_featured",
								"desc" => __('Add button text to be displayed in the featured section', 'classicbiz'),
								"std" => '',
								"type" => "text"),							

				array(	"name" => __('Featured section button hyperlink', 'classicbiz'),
								"id" => $this->shortname."_button_featured_url",
								"desc" => __('Provide the URL, where featured button and image should link to', 'classicbiz'),
								"std" => '',
								"type" => "text"),
								
				array(	"name" => __('Featured image file URL', 'classicbiz'),
								"id" => $this->shortname."_featured_image_url",
								"desc" => __('Replace the default image with your custom one by providing full URL of your custom image here', 'classicbiz'),
								"std" => '',
								"type" => "text"),

				array(	"name" => __('Hide featured section', 'classicbiz'),
								"id" => $this->shortname."_hide_featured",
								"desc" => __('Check this box to hide featured section in your header', 'classicbiz'),
								"std" => '',
								"type" => "checkbox"),								
	
				array(	"name" => __('Content Display <span>content display options</span>', 'classicbiz'),
								"type" => "subhead"),
									
				array(	"name" => __('Show full posts', 'classicbiz'),
								"id" => $this->shortname."_show_full",
								"desc" => __('Check this box to display full posts instead of the excerpts', 'classicbiz'),
								"std" => '',
								"type" => "checkbox"),

				array(	"name" => __('Sidebar Spots <span>customize your sidebar</span>', 'classicbiz'),
								"type" => "subhead"),

				array(	"name" => __('Custom content for Spot 2', 'classicbiz'),
								"id" => $this->shortname."_spot2",
								"desc" => __('Use text or properly formatted XHTML/HTML to be displayed on top of the widgets', 'classicbiz'),
								"std" => '',
								"type" => "textarea",
								"options" => array( "rows" => "5", "cols" => "40") 
								),									

				array(	"name" => __('Hide Spot 2', 'classicbiz'),
								"id" => $this->shortname."_hide_spot2",
								"desc" => __('Check this box to disable Spot 2 in the sidebar', 'classicbiz'),
								"std" => '',
								"type" => "checkbox"),

				array(	"name" => __('Custom content for Spot 3', 'classicbiz'),
								"id" => $this->shortname."_spot3",
								"desc" => __('Use text or properly formatted XHTML/HTML to be displayed below the widgets', 'classicbiz'),
								"std" => '',
								"type" => "textarea",
								"options" => array( "rows" => "5", "cols" => "40") 
								),									

				array(	"name" => __('Hide Spot 3', 'classicbiz'),
								"id" => $this->shortname."_hide_spot3",
								"desc" => __('Check this box to disable Spot 3 in the sidebar', 'classicbiz'),
								"std" => '',
								"type" => "checkbox"),									

				array(	"name" => __('Footer <span>manage your footer</span>', 'classicbiz'),
								"type" => "subhead"),

				array(	"name" => __('Custom content for Spot 4', 'classicbiz'),
								"id" => $this->shortname."_spot4",
								"desc" => __('Use text or properly formatted XHTML/HTML to be displayed below your page content', 'classicbiz'),
								"std" => '',
								"type" => "textarea",
								"options" => array( "rows" => "5", "cols" => "40") 
								),									

				array(	"name" => __('Hide Custom Section in the footer', 'classicbiz'),
								"id" => $this->shortname."_hide_spot4",
								"desc" => __('Check this box to hide Custom Section', 'classicbiz'),
								"std" => '',
								"type" => "checkbox"),	
								
				array(	"name" => __('Copyright name', 'classicbiz'),
								"id" => $this->shortname."_copyright",
								"desc" => __('Provide the name of your business here', 'classicbiz'),
								"std" => '',
								"type" => "text"),

				array(	"name" => __('Statistics code', 'classicbiz'),
								"id" => $this->shortname."_statistics",
								"desc" => __('Paste your Google Analytics or any other tracking code here. The script will be inserted before the closing <code>&#60;/body&#62;</code> tag.', 'classicbiz'),
								"std" => '',
								"type" => "textarea",
								"options" => array( "rows" => "5", "cols" => "40") ),

				);
				parent::GetBusinessBlog();
			}

			/* HEADER SPOT FUNCTIONS */
			function spot1Content () {
				return	stripslashes(wpautop(get_option($this->shortname.'_spot1')));
			}			
			function hideSpot1 () {
				return get_option($this->shortname.'_hide_spot1');
			}
			
			/* TOP MENU FUNCTIONS */
			function hidePages () {
				return get_option($this->shortname.'_hide_pages');
			}			
			function hideCategories () {
				return get_option($this->shortname.'_hide_categories');
			}
			
			/* FEATURED SECTION FUNCTIONS */
			function titleFeatured () {
				return stripslashes(get_option($this->shortname.'_title_featured'));
			}
			function headerFeatured () {
				return stripslashes(wpautop(get_option($this->shortname.'_text_featured')));
			}
			function buttonFeatured () {
				return stripslashes(get_option($this->shortname.'_button_featured'));
			}
			function buttonUrl () {
				return get_option($this->shortname.'_button_featured_url');
			}			
			function headerUrl () {
				return get_option($this->shortname.'_featured_image_url');
			}
			function hideFeatured () {
				return get_option($this->shortname.'_hide_featured');
			}			
			
			/* CONTENT DISPLAY FUNCTIONS */
			function showFull () {
				return get_option($this->shortname.'_show_full');
			}

			/* SIDEBAR SPOTS FUNCTIONS */
			function spot2Content () {
				return	stripslashes(wpautop(get_option($this->shortname.'_spot2')));
			}			
			function hideSpot2 () {
				return get_option($this->shortname.'_hide_spot2');
			}
			function spot3Content () {
				return	stripslashes(wpautop(get_option($this->shortname.'_spot3')));
			}			
			function hideSpot3 () {
				return get_option($this->shortname.'_hide_spot3');
			}			

			/* FOOTER FUNCTIONS */
			function spot4Content () {
				return	stripslashes(wpautop(get_option($this->shortname.'_spot4')));
			}			
			function hideSpot4 () {
				return get_option($this->shortname.'_hide_spot4');
			}			
			function copyrightName () {
				return wp_filter_post_kses(get_option($this->shortname.'_copyright'));
			}
			function statisticsCode () {
				return stripslashes(get_option($this->shortname.'_statistics'));
			}

		}
	}

	if (class_exists('ClassicBiz')) {
		$classicbiz = new ClassicBiz();
	}

?>