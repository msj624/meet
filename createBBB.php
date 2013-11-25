<?php
/**
 * Created by PhpStorm.
 * User: Felix
 * Date: 13. 11. 6
 * Time: 오전 9:27
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

    wp_redirect('http://183.110.207.43/demo/create.jsp?action=init&creator='.$current_user->user_login);
}
else
{
    wp_redirect(wp_login_url());
}