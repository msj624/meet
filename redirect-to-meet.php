<?php
/**
 * Created by PhpStorm.
 * User: Felix
 * Date: 13. 11. 11
 * Time: 오후 6:10
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

if ( is_user_logged_in() ) {
    global $current_user;
    get_currentuserinfo();

    if ( isset($_POST['mader']) )
    {
        $meetingID = $_POST['meetingID'];
        if ($_POST['mader'] == $current_user->ID )
        {
            wp_redirect("http://183.110.207.46/wp/wp-content/plugins/bigbluebutton/kt-meet-bridge.php?role=creator&username=".$current_user->display_name."&meetingID=".$meetingID);
        }
        else
        {
            wp_redirect("http://183.110.207.46/wp/wp-content/plugins/bigbluebutton/kt-meet-bridge.php?role=guest&username=".$current_user->display_name."&meetingID=".$meetingID);
        }
    }
    else
    {
        echo "Could not find event mader";
        exit;
    }
}
else
{
    wp_redirect(wp_login_url());
}
