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

$post_contents = get_post_field('post_content', $post_id);
$post_title = get_post_field('post_title', $post_id);
/*
$name = $post_title;
$meetingID = bigbluebutton_generateToken();
$SALT = "ade7513b0851821b36c0b94bec4dd63d";
$record = 'false'; //false, true
$attendeePW = 'ap';
$moderatorPW = 'mp';
$URL = "http://183.110.207.45/bigbluebutton/";
$url_create = $URL."api/create?";

$params = 'name='.urlencode($name).'&meetingID='.urlencode($meetingID).'&attendeePW='.urlencode($attendeePW).'&moderatorPW='.urlencode($moderatorPW).'&record='.$record;

$url_create = $url_create.$params.'&checksum='.sha1("create".$params.$SALT);

echo $url_create;
*/
/*
$xml = bbb_wrap_simplexml_load_file($url_create);

if( $xml && $xml->returncode == 'SUCCESS' ) {

    $event_mader = '';
    if ( is_user_logged_in() ) {
        global $current_user;
        get_currentuserinfo();
        $event_mader = $current_user->ID ;
    }

    $post_contents = $post_contents.'<br/><form  action="redirect-to-meet.php" method="post">
    <input type="hidden" value="'.$meetingID.'" name="meetingID" />
    <input type="hidden" value="'.$event_mader.'" name="mader" />
    <button name="redirect_submit" value="redirect">Join Meeting</button>
    </form>';

    $my_post = array();
    $my_post['ID'] = $post_id;
    $my_post['post_content'] = $post_contents;
    wp_update_post( $my_post );
}
else if( $xml ) {
    echo (string)$xml->messageKey.' : '.(string)$xml->message;
}
else {
    echo 'Unable to fetch URL '.$url_create.$params.'&checksum='.sha1("create".$params.$SALT);
}
*/
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

function bbb_wrap_simplexml_load_file($url){

    if (extension_loaded('curl')) {
        $ch = curl_init() or die ( curl_error() );
        $timeout = 10;
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec( $ch );
        curl_close( $ch );

        if($data)
            return (new SimpleXMLElement($data));
        else
            return false;
    }

    return (simplexml_load_file($url));
}
//get_permalink($post->ID)