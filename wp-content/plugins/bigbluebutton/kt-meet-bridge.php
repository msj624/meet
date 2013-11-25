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

$attendeePW = 'ap';
$moderatorPW = 'mp';
$SALT = "ade7513b0851821b36c0b94bec4dd63d";
$URL = "http://183.110.207.43/bigbluebutton/";
$role = $_GET['role'];
$username = $_GET['username'];
$meetingID = $_GET['meetingID'];

$info = BigBlueButton::getMeetingInfoArray( $meetingID, $moderatorPW, $URL, $SALT);
//Analyzes the bigbluebutton server's response
if( $info['returncode'] == 'FAILED')
{
    echo "<script>alert('This meeting was finished by creator');window.location.href='http://183.110.207.46/wp/';</script>";
}
else
{
    if ($role == 'creator')
    {
        header("Location: ".BigBlueButton::getJoinURL( $meetingID, $username, $moderatorPW, $SALT, $URL ));
        exit();
    }
    else
    {
        header("Location: ".BigBlueButton::getJoinURL( $meetingID, $username, $attendeePW, $SALT, $URL ));
        exit();
    }
}