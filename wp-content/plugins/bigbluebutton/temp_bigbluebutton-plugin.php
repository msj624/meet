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

echo "hello";