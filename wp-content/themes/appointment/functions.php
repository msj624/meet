<?php 



/**
 * Theme's Functions and Definitions
 *
 *
 * @file           functions.php
 * @package        Appointment
 * @author         Priyanshu Mittal,Shahid Mansuri and Akhilesh Nagar
 * @copyright      2013 Appointment
 * @license        license.txt
 * @version        Release: 1.1
 * @filesource     wp-content/themes/appointment/functions.php
 */
 ?>
<?php
   require_once('appointment_nav_walker.php');
     require_once('appointment_nav_walker.php');
    
  require_once ( get_template_directory() . '/functions/Excerpt/excerpt_length.php' );// code for limit the length of excerpt
  require_once ( get_template_directory() . '/functions/Pagination/pagination.php' );// code for limit the length of excerpt
if ( ! isset( $content_width ) ) $content_width = 900;

add_action('add_meta_boxes','appointment_slider_meta');
function appointment_slider_meta() {

 add_action('admin_enqueue_scripts', 'appointment_admin_enqueue_script'); 
 function appointment_admin_enqueue_script(){
	wp_enqueue_script('my-upload-admin',get_bloginfo('template_directory').'/js/media-upload-script.js',array('media-upload','thickbox'));
	} 
    $screens = array( 'post' );
    foreach ($screens as $screen) {
        add_meta_box(
            'slider_section',
            __( 'HomePage Slider', 'appointment' ),
            'appointment_slider_custom_box',
            $screen
        );
    }
	}
	
	
	function appointment_slider_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );

  // The actual fields for data entry
  // Use get_post_meta to retrieve an existing value from the database and use the value for the form
  $value = get_post_meta( $post->ID, '_meta_value_key', true );?>
  
 <div class="wp-media-buttons" id="wp-content-media-buttons">
<?php 
	$src= get_post_meta( get_the_ID(), '_meta_image', true );$cp= get_post_meta( get_the_ID(), '_meta_caption', true );
	echo '<label for="myplugin_new_field">';
       _e("Image Caption", 'appointment' );
  echo '</label> ';?>
  <input type="textarea" id="myplugin_new_field" name="myplugin_new_field" value="<?php if (!empty($cp)) echo $cp ?>" size="25" />
    
 <br />
 <?php _e('Upload Image','appointment');?>: <input  class="upload" type="text" size="36" name="upload_image" value="<?php if(!empty($src)) echo $src?>" />
<input class="upload_image_button" type="button" value="<?php _e('Add File','appointment');?>" /><br />
	</div>
				
	
	
	
<?php }

add_action( 'save_post', 'appointment_save_slider_data' );
function appointment_save_slider_data( $post_id ) {

 
     if ( ! current_user_can( 'edit_page', $post_id ) ){
        return ;
  } 

  if ( ! isset( $_POST['myplugin_noncename'] ) || ! wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) )
      return ;



  $post_ID = $_POST['post_ID'];
  echo $post_ID;

  $caption = sanitize_text_field( $_POST['myplugin_new_field'] );
  $meta_image = sanitize_text_field( $_POST['upload_image'] );


  add_post_meta($post_ID, '_meta_caption', $caption, true) or
    update_post_meta($post_ID, '_meta_caption', $caption);
		
	add_post_meta($post_ID, '_meta_image', $meta_image, true) or
    update_post_meta($post_ID, '_meta_image', $meta_image);
	
 
}
 add_action('after_setup_theme', 'appointment_setup_theme');
 
//enqueue scripts
  add_action('wp_enqueue_scripts','appointment_enqueue_script');
function appointment_enqueue_script() {

   wp_enqueue_style('appointment_style', get_template_directory_uri('template_directory').'/style.css');
   wp_enqueue_style('appointment_bootstrap', get_template_directory_uri('template_directory').'/css/bootstrap.css');
   wp_enqueue_style('appointment_bootstrap-responsive', get_template_directory_uri('template_directory').'/css/bootstrap-responsive.css');
   wp_enqueue_style('spa_docs', get_template_directory_uri('template_directory').'/css/docs.css');
   wp_enqueue_style('font',get_template_directory_uri('template_directory').'/css/font/font.css');
  
   if ( is_singular() ) wp_enqueue_script( "comment-reply" );
  if(!is_admin())
  {
       wp_enqueue_script('jquery');
       wp_enqueue_script('bootstrap', get_template_directory_uri('template_directory').'/js/bootstrap.js');
       wp_enqueue_script('bootstrap-transition', get_template_directory_uri('template_directory').'/js/bootstrap-transition.js');
	   
    }
	//menu js
	  wp_enqueue_script('spa_menu', get_template_directory_uri('template_directory').'/js/menu/menu.js');
	  wp_enqueue_script('spa-boot-menu-active', get_template_directory_uri('template_directory').'/js/menu/boot-business.js');
	   wp_enqueue_script('spa-boot-menus', get_template_directory_uri('template_directory').'/js/menu/bootstrap.min.js'); 
	   //js for portfolio page
		//wp_enqueue_style('appointment_bootstraplightbox.min', get_template_directory_uri('template_directory').'/css/lightbox/bootstrap-lightbox.min.css');
        //wp_enqueue_script('bootstrap-lightbox', get_template_directory_uri('template_directory').'/js/lightbox/bootstrap-lightbox.js');
		 //wp_enqueue_script('spa_menu', get_template_directory_uri('template_directory').'/js/lightbox/bootstrap-lightbox.min.js');
		 //portfolio template js files
		// wp_enqueue_script('portfolio-column', get_template_directory_uri('template_directory').'/js/portfolio/portfolio-column.js');
}

 add_action('after_setup_theme', 'appointment_setup_theme');
function appointment_setup_theme(){
    load_theme_textdomain('appointment', get_template_directory() . '/languages');
	if ( function_exists( 'add_theme_support' ) ) 
 {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		
		$header_args = array(
		'flex-width'    => true,
		'width'         => 200,
		'flex-height'    => true,
		'height'        => 40,
		'default-image' => get_template_directory_uri() . '/images/appointment_logo.png',
		);
add_theme_support( 'custom-header', $header_args );
		
		// Add support for a variety of post formats
	    add_theme_support( 'post-formats', array(   'aside','link', 'gallery', 'status', 'quote', 'image','chat','audio','video' ) );
}
	
}




//code for the admin custom menu...

add_action( 'init', 'appointment_admin' );
   
   function appointment_admin() {
  add_editor_style( get_template_directory_uri() . '/custom-editor-style.css' );
  
   register_nav_menus(
    array( 'header-menu' => __('Header Menu','appointment') )
  );
}



//code for register sidebar
add_action( 'widgets_init', 'appointment_widgets_init');
function appointment_widgets_init() {


/*sidebar*/
register_sidebar( array(
		'name' => __( ' Sidebar', 'appointment' ),
		'id' => 'sidebar-primary',
		'description' => __( 'The primary widget area', 'appointment' ),
		'before_widget' => '<div class="widget widget_archive">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	) );
/*footer sidebar*/

register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'appointment' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'appointment' ),
		'before_widget' => '<div id="footer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="app-widget-title">',
		'after_title' => '</h2>',
	) );
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'appointment' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'appointment' ),
		'before_widget' => '<div id="footer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="app-widget-title">',
		'after_title' => '</h2>',
	) );
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'appointment' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'appointment' ),
		'before_widget' => '<div id="footer-widget"">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="app-widget-title">',
		'after_title' => '</h2>',
	) );
	
	
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'appointment' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'appointment' ),
		'before_widget' => '<div id="footer-widget">',
		'after_widget' => '<div>',
		'before_title' => '<h2 class="app-widget-title">',
		'after_title' => '</h2>',
	) );
}	                     






// code for comment
if ( ! function_exists( 'appointment_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own appointment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since appointment
 */
function appointment_comment( $comment, $args, $depth ) {
	
	$GLOBALS['comment'] = $comment;

//get theme data
global $comment_data;

//translations
$leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] : __('Reply','appointment');
?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-body <?php if ($comment->comment_approved == '0') echo 'pending-comment'; ?> clearfix">
                <div class="comment_mn_row_mn">
                    <div class="comment_mn_row_mn_thu comment_john_bg">
                        <?php echo get_avatar($comment, $size = '65'); ?>
                    </div><!-- /comment-avatar -->
                    <div class="comment_mn_row_sub">
						<?php printf(__('<cite class="author">%s</cite>'), get_comment_author_link()) ?>
						<span class="comment-date"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">- <?php echo get_comment_date(); ?></a></span>
                    </div><!-- /comment-meta -->
                    <div class="comment-content">
									<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'appointment' ); ?></em>
					<br />
				<?php endif; ?>
    	                <div class="comment_mn_row_sub1">
    	                    <?php comment_text() ?>
    	                </div><!-- /comment-text -->
    	              <div class="comment_mn_row_sub2">
    	                    <?php comment_reply_link(array_merge( $args, array('reply_text' => $leave_reply. '&rarr;','depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    	              </div><!-- /reply -->
                    </div><!-- /comment-content -->
				</div><!-- /comment-details -->
		</div><!-- /comment -->
<?php
}
endif;



add_filter( 'the_password_form', 'custom_password_form' );
function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-pass.php" method="post">
	' . __( "This post is password protected. To view it please enter your password below:",'appointment' ) . '
	<label for="' . $label . '">' . __( "Password:",'appointment' ) . ' </label><input name="search_form" id="' . $label . '" type="password" size="20" />
	<input type="submit" class="btn appo_btn"	name="Submit" value="' . esc_attr__( "Submit",'appointment' ) . '" />
	</form>
	';
	return $o;
}
add_theme_support( 'woocommerce' );


?>

