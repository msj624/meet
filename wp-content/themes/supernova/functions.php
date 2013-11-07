<?php
/**
 * All files have been loaded from 'core.php' file which is under lib/core folder
 * All front and back end files have been enqueued from lib/enqueue folder
 * Its recommended to create a child theme instead of editing this theme because your changes would go away if this theme gets updated.
 * Edit this file only if you know what you are doing.
 *
 * @package Supernova
 * @version 1.4.2
 * @license GPL 2.0
 */

if( ! defined('SUPERNOVA_DIR')){
define('SUPERNOVA_DIR', get_template_directory());}
require_once SUPERNOVA_DIR. '/lib/core/supernova.php';

//Widget area Registration	
add_action( 'widgets_init', 'supernova_widgets_setup' );
function supernova_widgets_setup(){
register_sidebar(array(
	'name' => __('Sidebar Home', 'Supernova'),
	'id'   => 'sidebar-widgets',
	'description'   => __('I will only show on Home page', 'Supernova'),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2>',
	'after_title'   => '</h2>'
));
register_sidebar(array(
	'name' => __('Sidebar Page', 'Supernova'),
	'id'   => 'sidebar-page-widgets',
	'description'   => __('I will show on all pages except home', 'Supernova'),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2>',
	'after_title'   => '</h2>'
));
register_sidebar(array(
	'name' => __('Header Widgets', 'Supernova'),
	'id'   => 'header-widgets',
	'description'   => __('I will show next to logo( I CAN HANDLE ONLY ONE WIDGET)', 'Supernova'),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2>',
	'after_title'   => '</h2>'
));
register_sidebar(array(
	'name' => __('Footer Widgets', 'Supernova'),
	'id'   => 'footer-widgets',
	'description'   => __('I will show at the footer', 'Supernova'),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2>',
	'after_title'   => '</h2>'
));
}
	   
//Default Values for Custom Background
$background_defaults = array(
	'default-color'          => '',
	'default-image'          => get_template_directory_uri().'/images/background.png',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);

//Default Values for Custom Header
$header_defaults = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 960,
	'height'                 => 100,
	'flex-height'            => true,
	'flex-width'             => true,
	'default-text-color'     => '000',
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'       => 'supernova_header_style',
	'admin-head-callback'    => 'supernova_admin_header_style',
	'admin-preview-callback' => 'supernova_admin_header_image',
	);

add_action('after_setup_theme', 'supernova_theme_setup');
function supernova_theme_setup(){	
	global $background_defaults, $header_defaults, $wp_version;
	
	//Featured image for both page and post
	add_theme_support('post-thumbnails');
	
	//Adds automatic feed links
	add_theme_support( 'automatic-feed-links' );		
	
	//Adds Custom background
	add_theme_support('custom-background', $background_defaults);
	
	//Adds Custom Header
	add_theme_support( 'custom-header', $header_defaults );
		
	//Setting Avatar Size	
	wp_list_comments('avatar_size=80');	
	
	// Visual Editor Style
	add_editor_style();
	
	//Loading Language File 
	load_theme_textdomain( 'Supernova', SUPERNOVA_ROOT.'/languages/' );
	
	//Navigation Registration
	register_nav_menus(
		array(
			'Header_Nav'=>__('Header Navigation', 'Supernova'),
			'Header_Cat'=> __('Header Categories', 'Supernova'),			
			'Main_Nav'=> __('Main Navigation', 'Supernova'),
			'Footer_Nav'=> __('Footer Navigation', 'Supernova'),			
				)
		   );		   		   		   		   
	}
	
if ( ! isset( $content_width ) ) $content_width = 900;

/*Replaces [...] to read more
* @param $more
* returns read more link
*/
add_filter('excerpt_more', 'supernova_new_excerpt_more');
function supernova_new_excerpt_more($more) {
       global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '">'.__('... Read More', 'Supernova').'</a>';}        