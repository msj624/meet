<?php
/**
 * New Post Administration Screen.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** Load WordPress Administration Bootstrap */
require_once( dirname( __FILE__ ) . '/admin.php' );

if ( !isset($_GET['post_type']) )
	$post_type = 'post';
elseif ( in_array( $_GET['post_type'], get_post_types( array('show_ui' => true ) ) ) )
	$post_type = $_GET['post_type'];
else
	wp_die( __('Invalid post type') );

$post_type_object = get_post_type_object( $post_type );

if ( 'post' == $post_type ) {
	$parent_file = 'edit.php';
	$submenu_file = 'post-new.php';
} elseif ( 'attachment' == $post_type ) {
	if ( wp_redirect( admin_url( 'media-new.php' ) ) )
		exit;
} else {

	$submenu_file = "post-new.php?post_type=$post_type";
	if ( isset( $post_type_object ) && $post_type_object->show_in_menu && $post_type_object->show_in_menu !== true ) {
		$parent_file = $post_type_object->show_in_menu;
		if ( ! isset( $_registered_pages[ get_plugin_page_hookname( "post-new.php?post_type=$post_type", $post_type_object->show_in_menu ) ] ) )
			$submenu_file = $parent_file;
	} else {
		$parent_file = "edit.php?post_type=$post_type";
	}
}

$title = $post_type_object->labels->add_new_item;

$editing = true;

if ( ! current_user_can( $post_type_object->cap->edit_posts ) || ! current_user_can( $post_type_object->cap->create_posts ) )
	wp_die( __( 'Cheatin&#8217; uh?' ) );

// Schedule auto-draft cleanup
if ( ! wp_next_scheduled( 'wp_scheduled_auto_draft_delete' ) )
	wp_schedule_event( time(), 'daily', 'wp_scheduled_auto_draft_delete' );

wp_enqueue_script( 'autosave' );

if ( is_multisite() ) {
	add_action( 'admin_footer', '_admin_notice_post_locked' );
} else {
	$check_users = get_users( array( 'fields' => 'ID', 'number' => 2 ) );

	if ( count( $check_users ) > 1 )
		add_action( 'admin_footer', '_admin_notice_post_locked' );

	unset( $check_users );
}

add_filter( 'default_title', 'my_editor_title' );

function my_editor_title( $title ) {

    $title = $_POST['title'];

    return $title;
}

add_action('publish_post','redirect');

function redirect($post_id) {
    $permalink = get_permalink($post_id);
    $location = get_home_url()."/?url=".$permalink;
    wp_redirect($location);
}

add_filter( 'default_content' , 'my_default_content' );
function my_default_content( $post_content ) {

    $post_content = get_home_url().'




    <a title="Join" href="'.$_POST['invite'].'">Join Meeting (Guest)</a>

    Enter password (Creator): <input id=\'password\' type=\'password\' required />

    <a href='.$_POST['join'].' onclick="javascript:return validatePass()">Enter starting password and click this link to start meeting</a>
    <script>
    function validatePass(){
        if(document.getElementById(\'password\').value == \''.$_POST['password'].'\'){
            return true;
        }else{
            alert(\'wrong password!!\');
            return false;
        }
    }
    </script>';

    return $post_content;
}

add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );
// Show post form.
$post = get_default_post_to_edit( $post_type, true );

$post_ID = $post->ID;
include( ABSPATH . 'wp-admin/edit-form-advanced.php' );
include( ABSPATH . 'wp-admin/admin-footer.php' );
