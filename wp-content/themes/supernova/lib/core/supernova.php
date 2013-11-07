<?php 
/* 
 * All files for the theme have been included only from here so debugging can be easier.
 * There is a seprate folder named 'enqueue' where all the script and styles have been enqueued.
 * This theme has used some custom funtions which can be found in 'functions' folder under custom_functions.php file
 * @package Supernova
 * @since Supenova 1.0.1
*/

//Supernova Definitions
$upload_dir = wp_upload_dir();
if(!defined('SUPERNOVA_ROOT')){
	define('SUPERNOVA_ROOT', get_template_directory_uri());
}
if(!defined('SUPERNOVA_ROOT_ADMIN')){
	define('SUPERNOVA_ROOT_ADMIN', SUPERNOVA_ROOT.'/lib/admin/');
}
if(!defined('SUPERNOVA_LIB')){
	define('SUPERNOVA_LIB', SUPERNOVA_DIR.'/lib/');
}
if(!defined('SUPERNOVA_ADMIN')){
	define('SUPERNOVA_ADMIN', SUPERNOVA_LIB.'admin/' );
}
if(!defined('SUPERNOVA_FUNCTIONS')){
	define('SUPERNOVA_FUNCTIONS', SUPERNOVA_LIB.'functions/');
}
if(!defined('SUPERNOVA_WIDGETS')){
	define('SUPERNOVA_WIDGETS', SUPERNOVA_LIB.'widgets/' );
}
if(!defined('SUPERNOVA_ENQUEUE')){
	define('SUPERNOVA_ENQUEUE', SUPERNOVA_LIB.'enqueue/' );
}
if(!defined('SUPERNOVA_METABOX')){
	define('SUPERNOVA_METABOX', SUPERNOVA_LIB.'metaboxes/' );
}
if(!defined('SUPERNOVA_DIRECTORY')){
	define('SUPERNOVA_DIRECTORY', $upload_dir['baseurl'].'/supernova_directory/');
}
if(!defined('SUPERNOVA_INC')){
	define('SUPERNOVA_INC', '/includes/inc/');
}

//File includes
include_once SUPERNOVA_ENQUEUE.'front-enqueue.php';
include_once SUPERNOVA_ENQUEUE.'admin-enqueue.php';
include_once SUPERNOVA_ADMIN.'admin-setup.php';
include_once SUPERNOVA_FUNCTIONS.'pagination.php';
include_once SUPERNOVA_FUNCTIONS.'custom-functions.php';
include_once SUPERNOVA_FUNCTIONS.'supernova-ajax.php';
include_once SUPERNOVA_FUNCTIONS.'supernova-hooks.php';
include_once SUPERNOVA_WIDGETS.'recent-posts.php';
include_once SUPERNOVA_ADMIN.'custom-css.php';
include_once SUPERNOVA_METABOX.'metaboxes.php';

$supernova_theme_uri= 'http://supernovathemes.com';
$png_optimizer = 'http://tinypng.org/';
$jpg_optimizer = 'http://jpeg-optimizer.com/';

//Page title
add_filter( 'wp_title', 'supernova_wp_title', 10, 2 );
function supernova_wp_title($title){
	global $page, $paged;
	if ( is_feed() )
		return $title;
		$site_description = get_bloginfo( 'description' );
		$supernova_title = $title . get_bloginfo( 'name' );
		$supernova_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
		$supernova_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s', 'Supernova' ), max( $paged, $page ) ) : '';
		return $supernova_title;
	}

//Favicon	
add_action('wp_head', 'supernova_wp_favicon');
function supernova_wp_favicon(){
	global $supernova_options;
	if($supernova_options['favicon']){
		echo '<link rel="shortcut icon" href="'.esc_url(trim($supernova_options['favicon'])).'">';
		}
	}	
	
/*Call back functions for header */
function supernova_header_style() {
	$text_color = get_header_textcolor();

	// If no custom options for text are set
	if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;
	?>
	<style type="text/css">
	<?php
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php else : // If the user has set a custom color for the text, use that. ?>
		.site-title a,
		.site-description {
			color: #<?php echo $text_color; ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}

// Styles the header image displayed in admin panel appearance.
function supernova_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg{border:none}
	#headimg h1,#headimg h2{line-height:1.6;margin:0;padding:0}
	#headimg h1{font-size:30px;color:rgba(147,147,147,0.6);text-shadow:0 0 0 #5a5a5a 2px 2px 3px #fff;font-family:Georgia,Sans-serif;font-weight:400}
	#headimg h1 a{color:#000;text-shadow:none;text-decoration:none}
	#headimg h1 a:hover{color:#21759b}
	#headimg h2{font-family:HelveticaNeue-Light, "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;margin-bottom:24px;font-weight:300;font-style:italic;color:#000;font-size:14px;line-height:1.3em;text-shadow:none}
	#headimg img {max-width: <?php echo get_theme_support( 'custom-header', 'max-width' ); ?>px;}
	</style>
<?php
}

/*
* Outputs the markup to be displayed in admin panel.
* This callback overrides the default markup displayed there.
*/ 
function supernova_admin_header_image() {
	?>
	<div id="headimg">
		<?php
		if ( ! display_header_text() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
					
//Adding back to top button
if(!supernova_options('disable-back-to-top')){
add_action('wp_footer', 'supernova_back_to_top' );}
function supernova_back_to_top(){ ?>
     	<div id="backtotop"></div> <?php }

/*When the page or post title is empty	
 *@param $title
 *@returns $title
*/

add_filter('the_title', 'supernova_post_title');
function supernova_post_title($title) {
	if ($title == '') {
		return 'Untitled';
	} else {
		return $title;
	}
}

/*Breadcrumb*/
function supernova_breadcrumb() {
	global $supernova_options;
	if(!supernova_options('disable-breadcrumb')){
        echo '<ul id="supernova_breadcrumbs">';
    if (!is_home()) {
        echo '<li><a href="';
        echo home_url();
        echo '">';
        echo 'Home';
        echo "</a></li>";
        if (is_category() || is_single()) {
            echo '<li>';
            the_category(' </li><li> ');
            if (is_single()) {
                echo "</li><li>";
                the_title();
                echo '</li>';
            }
        } elseif (is_page()) {
            echo '<li>';
            echo the_title();
            echo '</li>';
        }
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_author()) {echo"<li>".__('Author Archive', 'Supernova'); echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>".__('Blog Archives', 'Supernova'); echo'</li>';}
    elseif (is_search()) {echo"<li>".__('Search Results', 'Supernova'); echo'</li>';}
    echo '</ul>';
} 
	}

/*
*Adds a widget to the dashboard
* @package Supernova
* @since Supenova 1.2.0
*/	
add_action('wp_dashboard_setup', 'supernova_dashboard_widgets');
function supernova_dashboard_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', __('Theme Support', 'Supernova'), 'supernova_dashboard_widgets_custom');
}

function supernova_dashboard_widgets_custom() {
?>
        <p><?php _e('If you have any question or issues related to the theme, you can always ask on WordPress', 'Supernova'); ?> <a href="http://wordpress.org/support/forum" target="_blank"><?php _e('support', 'Supernova'); ?></a> <?php _e('forum', 'Supernova'); ?></p>
        <p><?php _e('If you like this theme please rate it on WordPress', 'Supernova'); ?> <a href="http://wordpress.org/support/view/theme-reviews/supernova" target="_blank"><?php _e('theme reviews', 'Supernova'); ?></a> <?php _e('page', 'Supernova'); ?></p>        
<?php
}

/*
*Adds custom date for the copyright
* @package Supernova
* @since Supenova 1.2.0
* @return copyright date
*/
function supernova_copyright_custom_date() {
	global $wpdb;
	$copyright_dates = $wpdb->get_results("
	SELECT
	YEAR(min(post_date_gmt)) AS firstdate,
	YEAR(max(post_date_gmt)) AS lastdate
	FROM
	$wpdb->posts
	WHERE
	post_status = 'publish'
	");
	$output = '';
	if($copyright_dates) {
	$copyright = "&copy; " . $copyright_dates[0]->firstdate;
	if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
	$copyright .= '-' . $copyright_dates[0]->lastdate;
	}
	$output = $copyright;
	}
	return $output.'&nbsp;';
}

/*
* Updates post counts from each post
* @param $postID
* Returns NULL.
*/

function supernova_count_post_views($postID) {
    $count_key = 'supernova_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

//To keep the count accurate
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

add_action('wp_head', 'supernova_google_analytics');
function supernova_google_analytics(){    
    global $supernova_options;
    echo $supernova_options['head-script'];
}

//php error fix
if(!isset($supernova_options['rec-text']))
    $supernova_options['rec-text'] = 'Recommended';
if(!isset($supernova_options['head-script']))
    $supernova_options['head-script'] = '';
if(!isset($supernova_options['sup_css']))
    $supernova_options['sup_css'] = '';
if(!isset($supernova_options['linkedin-link']))
    $supernova_options['linkedin-link'] = '';
if(!isset($supernova_options['popular-text']))
    $supernova_options['popular-text'] = 'Popular Posts'; 
if(!isset($supernova_options['poplular-pos-dep']))
    $supernova_options['poplular-pos-dep'] = ''; 

/*
 * @package Supernova
 * @since Supernova 1.3.0
 */

add_action('wp_head', 'supernova_single_post_css');
function supernova_single_post_css(){
    $post_id = get_the_ID() ;
    $custom_css = get_post_meta( $post_id, 'post-style', true );        
    if(isset($custom_css)){
        echo $custom_css;  
    }
   // echo '<i style="display:none"> total_views = '.get_post_meta(get_the_ID(), 'supernova_post_views_count', true).'</i>'; // Only for testing
}

/*
 * File Write Function, based on Otto's Work
 * @param NULL
 * @since Supernova 1.4.2
 */

function supernova_writer(){    
    if (!isset($_GET['settings-updated']) && !isset($_GET['_wpnonce'])) return false;	      	
        
		// okay, let's see about getting credentials
		$url = wp_nonce_url('themes.php?page=theme-options');                
                $method = '';
                
		if (false === ($creds = request_filesystem_credentials($url, $method , false,false, null) ) ) {		
			// if we get here, then we don't have credentials yet,			
			return true;
		}
			
		// now we have some credentials, try to get the wp_filesystem running
		if ( ! WP_Filesystem($creds) ) {
			// our credentials were no good, ask the user for them again
			request_filesystem_credentials($url, '', true, false, $_POST);
			return true;
		}
		
                global $wp_filesystem;
		$upload_dir = wp_upload_dir();
                if( !is_dir(trailingslashit($upload_dir['basedir']).'supernova_directory') ){
                   if ( ! $wp_filesystem->mkdir( trailingslashit($upload_dir['basedir']).'supernova_directory' ) ) {
                        update_option('supernova_file_write_status', 'failed'); // We will hook it normally if something goes wrong                        
                    }else{
                        update_option('supernova_old_user_check','no');
                    }
                }
                
                $filename = trailingslashit($upload_dir['basedir']).'supernova_directory/custom-styles.css';
		if ( ! $wp_filesystem->put_contents( $filename, supernova_user_css() , FS_CHMOD_FILE) ) {
			update_option('supernova_file_write_status', 'failed');                        
                }else{
                    update_option('supernova_old_user_check','no');
                    if (function_exists('wp_cache_clear_cache')){                            
                             wp_cache_clear_cache();                 
                    } elseif(function_exists('w3tc_minify_flush')) {                                                        
                             w3tc_minify_flush();  
                    }
                }
                	
	return true;
}

/*
 * To tell the user of the slider image size
 * @since Supernova 1.4.2
 * 
 */
add_action('wp_footer', 'supernova_tell_slider_image_size');
function supernova_tell_slider_image_size(){
    if(isset($_GET['slidesize'])){
     ?>
        <script>
SupernovaImg = jQuery('.flexslider .slides img'); ImgDim= 'Your Slider Image Height is '+SupernovaImg.height()+'px & '+'Width is '+SupernovaImg.width()+'px'; alert(ImgDim);        
        </script>
        <?php
    }    
}

/*
 * Ads option in Custom Header Field
 * 
 */


// add our custom header options hook
add_action('custom_header_options', 'supernova_custom_image_options');
 
/* Adds two new text fields, custom_option_one and custom_option_two to the Custom Header options screen */
function supernova_custom_image_options(){
    $value = (get_theme_mod( 'supernova_header_logopos', 'Default Value' )) ? esc_attr( get_theme_mod( 'supernova_header_logopos', 'Default Value' )) : '1';
?>
<table class="form-table">
    <tbody>
        <tr valign="top" class="hide-if-no-js">
            <th scope="row">
                <strong style="font-size:14px;margin-left: -10px;"><?php _e( 'Header Logo Position', 'Supernova' ); ?><sup style="color:red">new</sup></strong>
            </th>
            <td>
               <label>
               <input type="radio" name="supernova_header_logopos" id="custom_option_one" value="1" <?php if($value == '1') echo 'checked="checked"';  ?>  />
               <span><?php _e('Left ','Supernova'); ?>&nbsp;</span>
               </label>
                <label>
               <input type="radio" name="supernova_header_logopos" id="custom_option_one" value="2" <?php if($value == '2') echo 'checked="checked"';  ?>  />
               <span><?php _e('Center ','Supernova'); ?>&nbsp;</span>
                </label>
                <label>
               <input type="radio" name="supernova_header_logopos" id="custom_option_one" value="3" <?php if($value == '3') echo 'checked="checked"';  ?>  />
               <span><?php _e('Right ','Supernova'); ?></span>
               </label>
            </td>
        </tr>
    </tbody>
</table>
<?php
} // end my_custom_image_options


add_action('admin_head', 'supernova_save_header_options');
function supernova_save_header_options(){
        if ( isset( $_POST['supernova_header_logopos']))
        {                
                check_admin_referer( 'custom-header-options', '_wpnonce-custom-header-options' );                
                if ( current_user_can('manage_options') ) {                    
                set_theme_mod( 'supernova_header_logopos', intval($_POST['supernova_header_logopos']) );                
                }
        }
        return;
}