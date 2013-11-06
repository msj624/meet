<?php
/**
 * Created by PhpStorm.
 * User: Felix
 * Date: 13. 11. 4
 * Time: 오후 4:37
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
        if ($_POST['mader'] == $current_user->ID )
        {
            wp_redirect($_POST['join']);
        }
        else
        {
            wp_redirect($_POST['invite'].'&username='.$current_user->user_login);
        }
    }
    else
    {
        echo "Could not event mader";
        exit;
    }
}
else
{
    wp_redirect(wp_login_url());
}

