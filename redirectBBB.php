<?php
/**
 * Created by PhpStorm.
 * User: Felix
 * Date: 13. 11. 4
 * Time: 오후 4:37
 */

global $current_user;
get_currentuserinfo();

wp_redirect($_POST['invite'].'&username='.$current_user->user_login);
