<?php
/**
 * Created by PhpStorm.
 * User: Felix
 * Date: 13. 11. 11
 * Time: 오후 4:45
 */

$incfile = 'wp-load.php';
$c=0;
while(!is_file($incfile))
{
    $incfile = '../' . $incfile;
    $c++;
    if($c==30) {
        echo "Could not find wp-load.php";
        exit;
    }
}
require_once($incfile);

$post_id = $_GET['id'];
$meetingID = $_GET['meetingID'];

$post_contents = get_post_field('post_content', $post_id);

$event_mader = '';

if ( is_user_logged_in() ) {
    global $current_user;
    get_currentuserinfo();
    $event_mader = $current_user->ID ;

    $post_contents = $post_contents.
        '<form  id="my_form" action="redirect-to-meet.php" method="post">
        <input type="hidden" value="'.$meetingID.'" name="meetingID" />
        <input type="hidden" value="'.$event_mader.'" name="mader" />
        <a id="joinbutton" onclick="document.getElementById("my_form").submit(); return false;"></a>
        </form>';

    $my_post = array();
    $my_post['ID'] = $post_id;
    $my_post['post_content'] = $post_contents;
    wp_update_post( $my_post );
    echo get_permalink($post_id);
    wp_redirect(get_permalink($post_id));
}
else
{
    echo "Can not get current_user->ID";
}