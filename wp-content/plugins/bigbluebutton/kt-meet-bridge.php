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