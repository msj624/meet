<?php
/**
 * Created by PhpStorm.
 * User: Felix
 * Date: 13. 11. 11
 * Time: 오후 4:45
 */

require('php/bbb_api.php');

$id = $_GET['id'];
$name = $_GET['title'];
$record = $_GET['record']; //false, true

$meetingID = bigbluebutton_generateToken();
$SALT = "ade7513b0851821b36c0b94bec4dd63d";

$attendeePW = 'ap';
$moderatorPW = 'mp';
$URL = "http://183.110.207.43/bigbluebutton/";
$url_create = $URL."api/create?";

$params = 'name='.urlencode($name).'&meetingID='.urlencode($meetingID).'&attendeePW='.urlencode($attendeePW).'&moderatorPW='.urlencode($moderatorPW).'&record='.$record;

$url_create = $url_create.$params.'&checksum='.sha1("create".$params.$SALT);

$xml = bbb_wrap_simplexml_load_file($url_create);

if( $xml && $xml->returncode == 'SUCCESS' ) {
    header("Location: http://183.110.207.46/wp/kt-meet-inject.php?id=".$id."&meetingID=".$meetingID);
    exit();
}
else if( $xml ) {
    echo (string)$xml->messageKey.' : '.(string)$xml->message;
}
else {
    echo 'Unable to fetch URL '.$url_create.$params.'&checksum='.sha1("create".$params.$SALT);
}

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