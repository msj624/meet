<?php
/*
* This files contains all the default values, and the arrays created for option's pages.
* If you wish to add more fields to the options page you can just add additional arrays here, and it will be added to the options
* page through the loop used in the pages in lib/admin/pages
*/

$supernova_defaults= array();

//General
$supernova_defaults[]=array(
		'name'=>__('Upload Favicon', 'Supernova'),
		'type'=>'text',
		'desc'=>__('Favicon is the tiny icon that you see on your browser\'s tab. Either create a 16x16px image or create it online and upload it here .', 'Supernova'),		'id'=> 'favicon',
		'page'=>__('General', 'Supernova'),
		);
				
$supernova_defaults[]=array(
		'name'=>__('Top Most Navigation', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove the top most navigation', 'Supernova'),					
		'id'=> 'disable-top-nav',
		'page'=>__('General', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Category Navigation', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove categories from header', 'Supernova'),
		'id'=> 'disable-categories',
		'page'=>__('General', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Main Navigation', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove the main navigation which is below header', 'Supernova'),					
		'id'=> 'disable-main-nav',
		'page'=>__('General', 'Supernova'),
		);
		
//Layout		
$supernova_defaults[]=array(
		'name'=>__('Layout Width', 'Supernova'),
		'type'=>'hidden',
		'desc'=>__('This is the total width of your website\'s layout in pixels', 'Supernova'),
		'id'=> 'layout-width',
		'page'=>__('Layout', 'Supernova'),
		'max'=>1320,
		'min'=>900,
		'default'=>1100,
		);		
		
$supernova_defaults[]=array(
		'name'=>__('Content Width', 'Supernova'),
		'type'=>'hidden',
		'desc'=>__('Decide the width of the content area (in percentage).', 'Supernova'),
		'id'=> 'content-width',
		'page'=>__('Layout', 'Supernova'),
		'max'=>100,
		'min'=>5,
		'default'=>70,
		);
				
$supernova_defaults[]=array(
		'name'=>__('Sidebar Width', 'Supernova'),
		'type'=>'hidden',
		'desc'=>__('THE TOTAL OF CONTENT AND SIDEBAR WIDTH SHOULD BE 100%.', 'Supernova'),
		'id'=> 'sidebar-width',
		'page'=>__('Layout', 'Supernova'),
		'max'=>100,
		'min'=>5,
		'default'=>30,
		);
		
$supernova_defaults[]=array(
		'name'=>__('Sidebar Position', 'Supernova'),
		'type'=>'radio',
		'desc'=>'',
		'id'=> 'sidebar-pos',
		'page'=>__('Layout', 'Supernova'),
		);					

//Styling
$supernova_defaults[]=array(
		'name'=>__('Color Scheme', 'Supernova'),
		'type'=>'color-scheme',
		'desc'=>'',
		'id'=> 'color-scheme',
		'page'=>__('Styling', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=> __('Font Family', 'Supernova').'<br></br>',
		'type'=>'select',
		'desc'=>__('Will affect the font family of the post content & sidebar', 'Supernova'),
		'id'=> 'font-style',
		'page'=>__('Styling', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Post Content', 'Supernova'),
		'type'=>'hidden',
		'desc'=>'',	
		'id'=> 'post-para-size',
		'page'=>__('Styling', 'Supernova'),
		'max'=>60,
		'min'=>5,
		'default'=>14,
		);
		
$supernova_defaults[]=array(
		'name'=>__('Post Heading', 'Supernova'),
		'type'=>'hidden',
		'desc'=>'',
		'id'=> 'post-heading-size',
		'page'=>__('Styling', 'Supernova'),
		'max'=>60,
		'min'=>5,
		'default'=>25,
		);	
		
$supernova_defaults[]=array(
		'name'=>__('Site Heading', 'Supernova'),
		'type'=>'hidden',
		'desc'=>'',
		'id'=> 'site-heading-size',
		'page'=>__('Styling', 'Supernova'),
		'max'=>80,
		'min'=>5,
		'default'=>30,
		);
		
$supernova_defaults[]=array(
		'name'=>__('Site Discription', 'Supernova'),
		'type'=>'hidden',
		'desc'=>'',
		'id'=> 'site-desc-size',
		'page'=>__('Styling', 'Supernova'),
		'max'=>60,
		'min'=>5,
		'default'=>14,
		);		
		
$supernova_defaults[]=array(
		'name'=>__('Sidebar Heading', 'Supernova'),
		'type'=>'hidden',
		'desc'=>'',
		'id'=> 'sidebar-heading-size',
		'page'=>__('Styling', 'Supernova'),
		'max'=>60,
		'min'=>5,
		'default'=>23,
		);

$supernova_defaults[]=array(
		'name'=>__('Footer Background', 'Supernova').'<br></br>',
		'type'=>'color',
		'desc'=>'',
		'id'=> 'footer-color',
		'page'=>__('Styling', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Footer Text Color', 'Supernova').'<br></br>',
		'type'=>'color',
		'desc'=>'',
		'id'=> 'footertext-color',
		'page'=>__('Styling', 'Supernova'),
		);		

$supernova_defaults[]=array(
		'name'=>__('Footer Heading Color', 'Supernova').'<br></br>',
		'type'=>'color',
		'desc'=>'',
		'id'=> 'footerheading-color',
		'page'=>__('Styling', 'Supernova'),
		);		

$supernova_defaults[]=array(
		'name'=>__('Post Paragraph', 'Supernova').'<br></br>',
		'type'=>'color',
		'desc'=>'',
		'id'=> 'post-para-color',
		'page'=>__('Styling', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Post Heading', 'Supernova').'<br></br>',
		'type'=>'color',
		'desc'=>'',
		'id'=> 'post-heading-color',
		'page'=>__('Styling', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Sidebar Heading', 'Supernova').'<br></br>',
		'type'=>'color',
		'desc'=>'',
		'id'=> 'sidebar-heading-color',
		'page'=>__('Styling', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Footer Background', 'Supernova').'<br></br>',
		'type'=>'text',
		'desc'=>__('You can use footer background image or color from above', 'Supernova'),					
		'id'=> 'footer-bg',
		'page'=>__('Styling', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Write Custom CSS', 'Supernova').'<br><small>&nbsp;'.__('(No style tag)', 'Supernova').'</small>',
		'type'=>'textarea',
		'desc'=>__('CSS written here will be applied everywhere on your theme, and loads after style.css, so it will override any existing css property. Also this css will not be lost even after you update supernova theme', 'Supernova'),
		'id'=> 'sup_css',
		'page'=>__('Styling', 'Supernova'),
		);
										
//Slider Posts
$supernova_defaults[]=array(
		'name'=>__('Disable Slider', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove slider from the home page(saves 18Kb)', 'Supernova'),
		'id'=> 'disable-slider',								
		'page'=>__('Slider Posts', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Slide Effect', 'Supernova').'<br></br>',
		'type'=>'select',
		'desc'=>__('Will change slider effect', 'Supernova'),
		'id'=> 'fade-slider',
		'value1'=>'slide',
		'value2'=>'fade',
		'page'=>__('Slider Posts', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Slide One', 'Supernova'),
		'type'=>'slider',
		'desc'=>__('Choose Post + Image OR just post which already has featured image.Click', 'Supernova').'<a href="'.site_url().'?slidesize" target="_blank"> <strong>HERE</strong></a>'.__(' to know the SIZE of the slider Image', 'Supernova'),
		'id'=> 'fat1',
		'id2'=>'slider1',
		'placeholder'=>'leave emtpy to show featured image',
		'page'=>__('Slider Posts', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Slide Two', 'Supernova'),
		'type'=>'slider',
		'desc'=>__('Choose Post + Image OR just post which already has featured image.Click', 'Supernova').'<a href="'.site_url().'?slidesize" target="_blank"> <strong>HERE</strong></a>'.__(' to know the SIZE of the slider Image', 'Supernova'),
		'id'=> 'fat2',
		'id2'=>'slider2',
		'placeholder'=>'leave emtpy to show featured image',
		'page'=>__('Slider Posts', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Slide Three', 'Supernova'),
		'type'=>'slider',
		'desc'=>__('Choose Post + Image OR just post which already has featured image.Click', 'Supernova').'<a href="'.site_url().'?slidesize" target="_blank"> <strong>HERE</strong></a>'.__(' to know the SIZE of the slider Image', 'Supernova'),
		'id'=> 'fat3',
		'id2'=>'slider3',
		'placeholder'=>'leave emtpy to show featured image',
		'page'=>__('Slider Posts', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Slide Four', 'Supernova'),
		'type'=>'slider',
		'desc'=>__('Choose Post + Image OR just post which already has featured image.Click', 'Supernova').'<a href="'.site_url().'?slidesize" target="_blank"> <strong>HERE</strong></a>'.__(' to know the SIZE of the slider Image', 'Supernova'),
		'id'=> 'fat4',
		'id2'=>'slider4',
		'placeholder'=>'leave emtpy to show featured image',
		'page'=>__('Slider Posts', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Slide Five', 'Supernova'),
		'type'=>'slider',
		'desc'=>__('Choose Post + Image OR just post which already has featured image.Click', 'Supernova').'<a href="'.site_url().'?slidesize" target="_blank"> <strong>HERE</strong></a>'.__('to know the SIZE of the slider Image', 'Supernova'),
		'id'=> 'fat5',
		'id2'=>'slider5',
		'placeholder'=>'leave emtpy to show featured image',
		'page'=>__('Slider Posts', 'Supernova'),
		);	

$supernova_defaults[]=array(
		'name'=>__('Slide Six', 'Supernova'),
		'type'=>'slider',
		'desc'=>__('Choose Post + Image OR just post which already has featured image.Click', 'Supernova').'<a href="'.site_url().'?slidesize" target="_blank"> <strong>HERE</strong></a>'.__('to know the SIZE of the slider Image', 'Supernova'),
		'id'=> 'fat6',
		'id2'=>'slider6',
		'placeholder'=>'leave emtpy to show featured image',
		'page'=>__('Slider Posts', 'Supernova'),
		);	

$supernova_defaults[]=array(
		'name'=>__('Slide Seven', 'Supernova'),
		'type'=>'slider',
		'desc'=>__('Choose Post + Image OR just post which already has featured image.Click', 'Supernova').'<a href="'.site_url().'?slidesize" target="_blank"> <strong>HERE</strong></a>'.__('to know the SIZE of the slider Image', 'Supernova'),
		'id'=> 'fat7',
		'id2'=>'slider7',
		'placeholder'=>'leave emtpy to show featured image',
		'page'=>__('Slider Posts', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Slide Eight', 'Supernova'),
		'type'=>'slider',
		'desc'=>__('Choose Post + Image OR just post which already has featured image.Click', 'Supernova').'<a href="'.site_url().'?slidesize" target="_blank"><strong>HERE</strong></a>'.__('to know the SIZE of the slider Image', 'Supernova'),
		'id'=> 'fat8',
		'id2'=>'slider8',
		'placeholder'=>'leave emtpy to show featured image',
		'page'=>__('Slider Posts', 'Supernova'),
		);	

//Social Profiles
$supernova_defaults[]=array(
		'name'=>'Facebook',
		'type'=>'links',
		'desc'=>__('Add Link to Show Icon', 'Supernova'),
		'id'=> 'facebook-link',
		'image'=>'facebook.gif',
		'placeholder'=>'http://facebook.com/yourfanpage',
		'page'=>__('Social Profiles', 'Supernova'),
		);	

$supernova_defaults[]=array(
		'name'=>'Twitter',
		'type'=>'links',
		'desc'=>__('Add Link to Show Icon', 'Supernova'),
		'id'=> 'twitter-link',
		'image'=>'twitter.gif',
		'placeholder'=>'',
		'page'=>__('Social Profiles', 'Supernova'),
		);	

$supernova_defaults[]=array(
		'name'=>'Goolge +1',
		'type'=>'links',
		'desc'=>__('Add Link to Show Icon', 'Supernova'),
		'id'=> 'google-link',
		'image'=>'google_plus.gif',
		'placeholder'=>'',
		'page'=>__('Social Profiles', 'Supernova'),
		);
					
$supernova_defaults[]=array(
		'name'=>'RSS',
		'type'=>'links',
		'desc'=>__('Add Link to Show Icon', 'Supernova'),
		'id'=> 'rss-link',
		'image'=>'rss.gif',
		'placeholder'=>'',
		'page'=>__('Social Profiles', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>'You Tube',
		'type'=>'links',
		'desc'=>__('Add Link to Show Icon', 'Supernova'),
		'id'=> 'youtube-link',
		'image'=>'youtube.gif',
		'placeholder'=>'',
		'page'=>__('Social Profiles', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>'Linkedin',
		'type'=>'links',
		'desc'=>__('Add Link to Show Icon', 'Supernova'),
		'id'=> 'linkedin-link',
		'image'=>'linkedin.gif',
		'placeholder'=>'',
		'page'=>__('Social Profiles', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Icon Color', 'Supernova').'<br></br>',
		'type'=>'icon-color',
		'desc'=>__('Will change Icon colors, you would need it if you use a light background color for footer', 'Supernova'),
		'id'=> 'icon-color',
		'page'=>__('Social Profiles', 'Supernova'),
		);		

//Ad
$supernova_defaults[]=array(
		'name'=>__('Header Ad', 'Supernova'),
		'type'=>'textarea',
		'desc'=>__('Drop your ad code here and the ad will show in the header next to logo', 'Supernova'),
		'id'=> 'header-ad',
		'page'=>__('Ad Spots', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Below Navigation', 'Supernova'),
		'type'=>'textarea',
		'desc'=>__('Ad will show below navigation, above slider', 'Supernova'),
		'id'=> 'belownav-ad',
		'page'=>__('Ad Spots', 'Supernova'),
		);		
		
$supernova_defaults[]=array(
		'name'=>__('Above Posts', 'Supernova'),
		'type'=>'textarea',
		'desc'=>__('Ad will show right above the posts on home page, below slider', 'Supernova'),
		'id'=> 'above-posts-ad',
		'page'=>__('Ad Spots', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Below Posts', 'Supernova'),
		'type'=>'textarea',
		'desc'=>__('Ad will show below the posts', 'Supernova'),
		'id'=> 'below-posts-ad',
		'page'=>__('Ad Spots', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Above Footer', 'Supernova'),
		'type'=>'textarea',
		'desc'=>__('Ad will show right above the footer where content ends', 'Supernova'),
		'id'=> 'abovefooter-ad',
		'page'=>__('Ad Spots', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Above Single Post', 'Supernova'),
		'type'=>'textarea',
		'desc'=>__('Ad will show right above the single post', 'Supernova'),
		'id'=> 'abovesinglepost-ad',
		'page'=>__('Ad Spots', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Below Single Post', 'Supernova'),
		'type'=>'textarea',
		'desc'=>__('Ad will show below single post', 'Supernova'),
		'id'=> 'belowsinglepost-ad',
		'page'=>__('Ad Spots', 'Supernova'),
		);		
		
//Advanced
$supernova_defaults[]=array(
		'name'=>__('Footer Text', 'Supernova'),
		'type'=>'only-text',
		'desc'=>__('Will replace the footer text', 'Supernova'),
		'image'=>'arrow.png',
		'id'=> 'footer-text',
		'placeholder'=> 'Copyright text',
		'page'=>__('Advanced', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Latest Blog Text', 'Supernova'),
		'type'=>'only-text',
		'desc'=>__('changes latest blog text on the home page', 'Supernova'),
		'image'=>'arrow.png',
		'id'=> 'latest-blog',
		'placeholder'=> 'Latest Blog',
		'page'=>__('Advanced', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Popular Text', 'Supernova'),
		'type'=>'only-text',
		'desc'=>__('changes popular text on the home page', 'Supernova'),
		'image'=>'arrow.png',
		'id'=> 'popular-text',
		'placeholder'=> 'Will replace the popular text',
		'page'=>__('Advanced', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Recommended Text', 'Supernova'),
		'type'=>'only-text',
		'desc'=>__('changes recommended text on the home page', 'Supernova'),
		'image'=>'arrow.png',
		'id'=> 'rec-text',
		'placeholder'=> 'Will replace the recommended text',
		'page'=>__('Advanced', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Sidebar on Home Page', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will make the home page full width and enlarge the slider', 'Supernova'),
		'id'=> 'nosidebar-home',
		'page'=>__('Advanced', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Sticky Navigation', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove stick effect(saves 3Kb)', 'Supernova'),					
		'id'=> 'sticky-nav',
		'page'=>__('Advanced', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Dropdown Effect', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Removes the navigation dropdown effect and arrows(saves 14Kb)', 'Supernova'),					
		'id'=> 'disable-nav-effect',
		'page'=>__('Advanced', 'Supernova'),
		);			

$supernova_defaults[]=array(
		'name'=>__('Disable Date', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove date from posts meta', 'Supernova'),
		'id'=> 'disable-date',
		'page'=>__('Advanced', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Disable Date from slider', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove date from slider', 'Supernova'),
		'id'=> 'disable-slider-date',
		'page'=>__('Advanced', 'Supernova'),
		);			

$supernova_defaults[]=array(
		'name'=>__('Disable Author', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove author from post meta', 'Supernova'),
		'id'=> 'disable-author',
		'page'=>__('Advanced', 'Supernova'),
		);	

$supernova_defaults[]=array(
		'name'=>__('Disable All Meta', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove all meta from the post', 'Supernova'),
		'id'=> 'disable-meta',
		'page'=>__('Advanced', 'Supernova'),
		);	

$supernova_defaults[]=array(
		'name'=>__('Search In Top Navigation', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove search box from the top most navigation', 'Supernova'),
		'id'=> 'disable-top-search',
		'page'=>__('Advanced', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Search In Main Navigation', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove search box from main navigation', 'Supernova'),
		'id'=> 'disable-search',
		'page'=>__('Advanced', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Back to Top', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove back to top from the bottom right', 'Supernova'),
		'id'=> 'disable-back-to-top',
		'page'=>__('Advanced', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Pagination', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove theme\'s default pagination so you can use some plugin you like', 'Supernova'),
		'id'=> 'disable-pagination',
		'page'=>__('Advanced', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Breadcrumb', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove breadcrumb from your theme', 'Supernova'),
		'id'=> 'disable-breadcrumb',
		'page'=>__('Advanced', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Font Resizer', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove font resizer from each single post', 'Supernova'),
		'id'=> 'disable-resizer',
		'page'=>__('Advanced', 'Supernova'),
		);
		
$supernova_defaults[]=array(
		'name'=>__('Comments In Pages', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove comments only from pages', 'Supernova'),
		'id'=> 'page-comment',
		'page'=>__('Advanced', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Comments In Posts', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove comments only from posts', 'Supernova'),
		'id'=> 'post-comment',
		'page'=>__('Advanced', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Show Full Content on homepage', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will show full content inplace of excerpt', 'Supernova'),
		'id'=> 'full-content',
		'page'=>__('Advanced', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Remove Author Box', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove author info box from each single post', 'Supernova'),					
		'id'=> 'disable-author-box',
		'page'=>__('Advanced', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Featured Image on post', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove featured image from single posts however featured image will show as thumbnail in post listing (if you want to remove featured image only from some pages use CSS instead, use <small> .single .supernova_thumb{display:none} </small> for each page)', 'Supernova'),
		'id'=> 'no-single-featured',
		'page'=>__('Advanced', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Responsivness', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('You website would look the same in small screen', 'Supernova'),
		'id'=> 'no-responsive',
		'page'=>__('Advanced', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Ajax Post Loader', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove ajax post loader from pagination', 'Supernova'),
		'id'=> 'ajax-postloader',
		'page'=>__('Advanced', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Popular Posts', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove popular posts tab from home page', 'Supernova'),
		'id'=> 'popular-tab',
		'page'=>__('Advanced', 'Supernova'),
		);

$supernova_defaults[]=array(
		'name'=>__('Recommended Posts', 'Supernova'),
		'type'=>'checkbox',
		'desc'=>__('Will remove recommended posts tab from home page', 'Supernova'),
		'id'=> 'rec-tab',
		'page'=>__('Advanced', 'Supernova'),
		);

//$supernova_defaults[]=array(
//		'name'=>__('Popular Posts Depend on', 'Supernova'),
//		'type'=>'selection',
//		'desc'=>'',
//		'id'=> 'poplular-pos-dep',
//		'page'=>__('Advanced', 'Supernova'),
//		);


//Font Array
$supernova_fonts=array(	
	'Georgia, serif', 
	'\'Palatino Linotype\', \'Book Antiqua\', Palatino, serif',
	'\'Times New Roman\', Times, serif',
	'Arial, Helvetica, sans-serif', 
	'\'Arial Black\', Gadget, sans-serif', 
	'\'Comic Sans MS\', cursive, sans-serif', 
	'Impact, Charcoal, sans-serif', 
	'\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif', 
	'Tahoma, Geneva, sans-serif', 
	'\'Trebuchet MS\', Helvetica, sans-serif', 
	'Verdana, Geneva, sans-serif', 
	'\'Courier New\', Courier, monospace', 
	'\'Lucida Console\', Monaco, monospace' 
);

$supernova_slide_effect= array('fade','slide');

//Setting Default values
$supernova_defaults_values = array(
		'favicon' => '',
		'footer-bg'=> SUPERNOVA_ROOT.'/images/black.png',
		'sticky-nav'=>false,
		'disable-nav-effect'=>false,
		'disable-top-nav'=>false,
		'disable-author-box'=> false,
		'layout-width' => 1100,
		'content-width' => 70,
		'sidebar-width'=> 30,
		'sidebar-pos'=> 2,
                'sup_css'=> '',
                'rec-text'=>'Recommended',
		'font-style'=>'default',
		'post-para-size' => 14,
		'post-heading-size'=>25,
		'site-heading-size'=>30,		
		'sidebar-heading-size'=>23,
		'site-desc-size'=>14,				
		'footer-color'=>'000000',
		'footertext-color'=>'CCCCCC',
		'footerheading-color'=>'FFFFFF',		
		'post-para-color'=> '000000',
		'post-heading-color'=> '525252',
		'sidebar-heading-color'=> '525252',
		'facebook-link'=> 'http://facebook.com',
		'twitter-link'=> 'http://twitter.com',
		'youtube-link'=> 'http://youtube.com',
		'google-link' => 'https://plus.google.com/',
		'rss-link' => 'http://rss.com',	
		'footer-text'=> supernova_copyright_custom_date().get_bloginfo('name'),
		'latest-blog'=> __('Latest Blogs','Supernova'),
		'disable-slider'=> false,
		'disable-categories'=> false,
		'disable-share'=> false,
		'disable-date'=> false,
		'disable-author'=> false,
		'disable-meta'=> false,
		'disable-search'=> false,
		'disable-main-nav'=>false,
		'disable-top-search'=>false,
		'disable-back-to-top'=> false,
		'disable-pagination'=>false,
		'disable-breadcrumb'=>false,
		'disable-resizer'=>false,
		'fade-slider'=>'slide',
		'fat1'=>'',
		'fat2'=>'',
		'fat3'=>'',
		'fat4'=>'',
		'fat5'=>'',
		'fat6'=>'',
		'fat7'=>'',
		'fat8'=>'',
		'fat9'=>'',
		'fat10'=>'',
		'slider1'=>SUPERNOVA_ROOT.'/images/key.jpg',
		'slider2'=>SUPERNOVA_ROOT.'/images/statue.jpg',
		'slider3'=>'',
		'slider4'=>'',
		'slider5'=>'',
		'slider6'=>'',
		'slider7'=>'',
		'slider8'=>'',
		'slider9'=>'',
		'slider10'=>'',
		'header-ad'=>'',
		'above-posts-ad'=>'',
		'below-posts-ad'=>'',
		'belownav-ad'=>'',
		'abovefooter-ad'=>'',
		'abovesinglepost-ad'=>'',
		'belowsinglepost-ad'=>'',								
);

/*
*These are the arrays created only for the validation and are used in validation callback function
*if you want to add more fields, dont forget to include those field ids in the appropriate array
*@since Supernova 1.0.1
*/

//Array for validating links
$supernova_link_array= array('favicon', 'footer-bg', 'facebook-link','twitter-link','youtube-link','google-link','rss-link','slider1','slider2',
'slider3','slider4','slider5','slider6','slider7','slider8');

//Array for validating checkboxes	
$supernova_checkbox_array= array('sticky-nav','disable-nav-effect','disable-top-nav','disable-slider','disable-categories','disable-share','disable-date',
'disable-author','disable-meta','disable-search','disable-back-to-top','disable-pagination','disable-breadcrumb', 'disable-resizer');

//Array for validating numbers		
$supernova_numbers_array= array('layout-width','content-width','sidebar-width','post-para-size','post-heading-size','site-heading-size',
'sidebar-heading-size','site-desc-size','sidebar-heading-size','sidebar-pos','color-scheme','fat1','fat2','fat3','fat4','fat5','fat6','fat7','fat8');	

//Array for validating text or number
$supernova_text_array = array('latest-blog', 'footer-color','footertext-color', 'footerheading-color', 'sidebar-heading-color', 'post-para-color','post-heading-color');