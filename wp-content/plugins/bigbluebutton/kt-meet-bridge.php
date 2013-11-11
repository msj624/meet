<?php
/**
 * Created by PhpStorm.
 * User: Felix
 * Date: 13. 11. 11
 * Time: 오후 1:41
 */
//================================================================================
//------------------Required Libraries and Global Variables-----------------------
//================================================================================
require('php/bbb_api.php');

$meetingID = bigbluebutton_generateToken();
$duration = 0;
$voicebridge = 0;
$logouturl = "http://183.110.207.46/wp/";

echo $meetingID;
//wp_redirect('http://183.110.207.45/demo/create.jsp?action=init&creator='.$current_user->user_login);

function bigbluebutton_generateToken($tokenLength=6){
    $token = '';

    if(function_exists('openssl_random_pseudo_bytes')) {
        $token .= bin2hex(openssl_random_pseudo_bytes($tokenLength));
    } else {
        //fallback to mt_rand if php < 5.3 or no openssl available
        $characters = '0123456789abcdef';
        $charactersLength = strlen($characters)-1;
        $tokenLength *= 2;

        //select some random characters
        for ($i = 0; $i < $tokenLength; $i++) {
            $token .= $characters[mt_rand(0, $charactersLength)];
        }
    }
    $token = bigbluebutton_normalizeMeetingID($token);
    return $token;
}

function bigbluebutton_normalizeMeetingID($meetingID){
    return (strlen($meetingID) == 12)? sha1($meetingID): $meetingID;
}