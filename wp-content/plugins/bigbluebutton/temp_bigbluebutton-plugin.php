<?php
/*
Plugin Name: KT-Conference
Plugin URI: http://blindsidenetworks.com/integration
Description: BigBlueButton is an open source web conferencing system. This plugin integrates BigBlueButton into WordPress allowing bloggers to create and manage meetings rooms to interact with their readers. For more information on setting up your own BigBlueButton server or for using an external hosting provider visit http://bigbluebutton.org/support
Version: 1.3.6
Author: Blindside Networks
Author URI: http://blindsidenetworks.com/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

//================================================================================
//---------------------------Standard Plugin definition---------------------------
//================================================================================

//validate
global $wp_version;
$wp_version = '3.6.1';


//constant definition
define("BIGBLUEBUTTON_DIR", WP_PLUGIN_URL . '/bigbluebutton/' );
define('BIGBLUEBUTTON_PLUGIN_VERSION', bigbluebutton_get_version());
define('BIGBLUEBUTTON_PLUGIN_URL', plugin_dir_url( __FILE__ ));

//constant message definition
define('BIGBLUEBUTTON_STRING_WELCOME', '<br>Welcome to <b>%%CONFNAME%%</b>!<br><br><br>To join the audio bridge click the headset icon (upper-left hand corner). <b>Please use a headset to avoid causing noise for others.</b>');
define('BIGBLUEBUTTON_STRING_MEETING_RECORDED', '<br><br>This session is being recorded.');

//================================================================================
//------------------Required Libraries and Global Variables-----------------------
//================================================================================
require('php/bbb_api.php');

add_shortcode('bigbluebutton', 'bigbluebutton_shortcode');

bigbluebutton_init_sessions();
bigbluebutton_init_scripts();

function bigbluebutton_init_sessions() {
    if (!session_id()) {
        session_start();
    }
}

function bigbluebutton_init_scripts() {
    if (!is_admin()) {
        wp_enqueue_script('jquery');
    }
}

//================================================================================
//---------------------------------ShortCode functions----------------------------
//================================================================================
//Inserts a bigbluebutton form on a post or page of the blog
function bigbluebutton_shortcode($args) {
    extract($args);

    return bigbluebutton_form($args);

}

//================================================================================
//Create the form called by the Shortcode and Widget functions
function bigbluebutton_form($args) {
    global $wpdb, $wp_version, $current_site, $current_user, $wp_roles;
    $table_name = $wpdb->prefix . "bigbluebutton";
    $table_logs_name = $wpdb->prefix . "bigbluebutton_logs";

    $token = isset($args['token']) ?$args['token']: null;
    $submit = isset($args['submit']) ?$args['submit']: null;

    //Initializes the variable that will collect the output
    $out = '';

    //Set the role for the current user if is logged in
    $role = null;
    if( $current_user->ID ) {
        $role = "unregistered";
        foreach($wp_roles->role_names as $_role => $Role) {
            if (array_key_exists($_role, $current_user->caps)){
                $role = $_role;
                break;
            }
        }
    } else {
        $role = "anonymous";
    }

    //Read in existing option value from database
    $url_val = get_option('bigbluebutton_url');
    $salt_val = get_option('bigbluebutton_salt');
    //Read in existing permission values from database
    $permissions = get_option('bigbluebutton_permissions');

    //Gets all the meetings from wordpress database
    $listOfMeetings = $wpdb->get_results("SELECT meetingID, meetingName, meetingVersion, attendeePW, moderatorPW FROM ".$table_name." ORDER BY meetingName");

    $dataSubmitted = false;
    $meetingExist = false;
    if( isset($_POST['SubmitForm']) ) { //The user has submitted his login information
        $dataSubmitted = true;
        $meetingExist = true;

        $meetingID = $_POST['meetingID'];

        $found = $wpdb->get_row("SELECT * FROM ".$table_name." WHERE meetingID = '".$meetingID."'");
        if( $found ){
            $found->meetingID = bigbluebutton_normalizeMeetingID($found->meetingID);

            if( !$current_user->ID ) {
                $name = isset($_POST['display_name']) && $_POST['display_name']?$_POST['display_name']: $role;

                if( bigbluebutton_validate_defaultRole($role, 'none') ) {
                    $password = $_POST['pwd'];
                } else {
                    $password = $permissions[$role]['defaultRole'] == 'none'? $found->moderatorPW: $found->attendeePW;
                }

            } else {
                if( $current_user->display_name != '' ){
                    $name = $current_user->display_name;
                } else if( $current_user->user_firstname != '' || $current_user->user_lastname != '' ){
                    $name = $current_user->user_firstname != ''? $current_user->user_firstname.' ': '';
                    $name .= $current_user->user_lastname != ''? $current_user->user_lastname.' ': '';
                } else if( $current_user->user_login != ''){
                    $name = $current_user->user_login;
                } else {
                    $name = $role;
                }
                $password = $permissions[$role]['defaultRole'] == 'moderator'? $found->moderatorPW: $found->attendeePW;

            }

            //Extra parameters
            $recorded = $found->recorded;
            $welcome = (isset($args['welcome']))? html_entity_decode($args['welcome']): BIGBLUEBUTTON_STRING_WELCOME;
            if( $recorded ) $welcome .= BIGBLUEBUTTON_STRING_MEETING_RECORDED;
            $duration = 0;
            $voicebridge = 0;
            $logouturl = (is_ssl()? "https://": "http://") . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];

            //Metadata for tagging recordings
            $metadata = Array(
                'meta_origin' => 'WordPress',
                'meta_originversion' => $wp_version,
                'meta_origintag' => 'wp_plugin-bigbluebutton '.BIGBLUEBUTTON_PLUGIN_VERSION,
                'meta_originservername' => home_url(),
                'meta_originservercommonname' => get_bloginfo('name'),
                'meta_originurl' => $logouturl
            );
            //Call for creating meeting on the bigbluebutton server
            $response = BigBlueButton::createMeetingArray($name, $found->meetingID, $found->meetingName, $welcome, $found->moderatorPW, $found->attendeePW, $salt_val, $url_val, $logouturl, $recorded? 'true':'false', $duration, $voicebridge, $metadata );

            //Analyzes the bigbluebutton server's response
            if(!$response || $response['returncode'] == 'FAILED' ){//If the server is unreachable, or an error occured
                $out .= "Sorry an error occured while joining the meeting.";
                return $out;

            } else{ //The user can join the meeting, as it is valid
                if( !isset($response['messageKey']) || $response['messageKey'] == '' ){
                    // The meeting was just created, insert the create event to the log
                    $rows_affected = $wpdb->insert( $table_logs_name, array( 'meetingID' => $found->meetingID, 'recorded' => $found->recorded, 'timestamp' => time(), 'event' => 'Create' ) );
                }

                $bigbluebutton_joinURL = BigBlueButton::getJoinURL($found->meetingID, $name, $password, $salt_val, $url_val );
                //If the meeting is already running or the moderator is trying to join or a viewer is trying to join and the
                //do not wait for moderator option is set to false then the user is immediately redirected to the meeting
                if ( (BigBlueButton::isMeetingRunning( $found->meetingID, $url_val, $salt_val ) && ($found->moderatorPW == $password || $found->attendeePW == $password ) )
                    || $response['moderatorPW'] == $password
                    || ($response['attendeePW'] == $password && !$found->waitForModerator)  ){
                    //If the password submitted is correct then the user gets redirected
                    $out .= '<script type="text/javascript">window.location = "'.$bigbluebutton_joinURL.'";</script>'."\n";
                    return $out;
                }
                //If the viewer has the correct password, but the meeting has not yet started they have to wait
                //for the moderator to start the meeting
                else if ($found->attendeePW == $password){
                    //Stores the url and salt of the bigblubutton server in the session
                    $_SESSION['mt_bbb_url'] = $url_val;
                    $_SESSION['mt_salt'] = $salt_val;
                    //Displays the javascript to automatically redirect the user when the meeting begins
                    $out .= bigbluebutton_display_redirect_script($bigbluebutton_joinURL, $found->meetingID, $found->meetingName, $name);
                    return $out;
                }
            }
        }
    }

    //If a valid meeting was found the login form is displayed
    if(sizeof($listOfMeetings) > 0){
        //Alerts the user if the password they entered does not match
        //the meeting's password

        if($dataSubmitted && !$meetingExist){
            $out .= "***".$meetingID." no longer exists.***";
        }
        else if($dataSubmitted){
            $out .= "***Incorrect Password***";
        }

        if ( bigbluebutton_can_participate($role) ){
            $out .= '
            <form id="bbb-join-form" class="bbb-join" name="form1" method="post" action="">';

            if(sizeof($listOfMeetings) > 1 && !$token ){
                $out .= '
                <label>Meeting:</label>
                <select name="meetingID">';

                foreach ($listOfMeetings as $meeting) {
                    $out .= '
                    <option value="'.$meeting->meetingID.'">'.$meeting->meetingName.'</option>';
                }

                $out .= '
                </select>';
            } else if ($token) {
                $out .= '
                <input type="hidden" name="meetingID" id="meetingID" value="'.$token.'" />';

            } else {
                $meeting = reset($listOfMeetings);
                $out .= '
                <input type="hidden" name="meetingID" id="meetingID" value="'.$meeting->meetingID.'" />';

            }

            if( !$current_user->ID ) {
                $out .= '
                <label>Name:</label>
                <input type="text" id="name" name="display_name" size="10">';
            }
            if( bigbluebutton_validate_defaultRole($role, 'none') ) {
                $out .= '
                <label>Password:</label>
                <input type="password" name="pwd" size="10">';
            }
            $out .= '
            </table>';
            if(sizeof($listOfMeetings) > 1 && !$token ){
                $out .= '

                <input type="submit" name="SubmitForm" value="'.($submit? $submit: 'Join').'">';
            } else if ($token) {
                foreach ($listOfMeetings as $meeting) {
                    if($meeting->meetingID == $token ){
                        $out .= '
                <input type="submit" name="SubmitForm" value="'.($submit? $submit: 'Join '.$meeting->meetingName).'">';
                        break;
                    }
                }

                if($meeting->meetingID != $token ){
                    $out .= '
                <div>Invalid meeting token</div>';
                }

            } else {
                $out .= '
                <input type="submit" name="SubmitForm" value="'.($submit? $submit: 'Join '.$meeting->meetingName).'">';

            }
            $out .= '
            </form>';

        } else {
            $out .= $role." users are not allowed to participate in meetings";

        }

    } else if($dataSubmitted){
        //Alerts the user if the password they entered does not match
        //the meeting's password
        $out .= "***".$meetingID." no longer exists.***<br />";
        $out .= "No meeting rooms are currently available to join.";

    } else{
        $out .= "No meeting rooms are currently available to join.";

    }

    return $out;
}