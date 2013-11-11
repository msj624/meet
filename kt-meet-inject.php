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

echo get_post_field('post_content', $post_id);
echo get_post_field('post_title', $post_id);