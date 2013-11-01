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

//================================================================================
//------------------Code for development------------------------------------------
//================================================================================
if(!function_exists('_log')){
    function _log( $message ) {
        if( WP_DEBUG === true ){
            if( is_array( $message ) || is_object( $message ) ){
                error_log( print_r( $message, true ) );
            } else {
                error_log( $message );
            }
        }
    }
}
_log('Loading the plugin');

//================================================================================
//------------------------------------Main----------------------------------------
//================================================================================
//hook definitions
register_activation_hook(__FILE__, 'bigbluebutton_install' ); //Runs the install script (including the databse and options set up)
//register_deactivation_hook(__FILE__, 'bigbluebutton_uninstall') ); //Runs the uninstall function (it includes the database and options delete)
register_uninstall_hook(__FILE__, 'bigbluebutton_uninstall' ); //Runs the uninstall function (it includes the database and options delete)

//shortcode definitions
add_shortcode('bigbluebutton', 'bigbluebutton_shortcode');
add_shortcode('bigbluebutton_recordings', 'bigbluebutton_recordings_shortcode');

//action definitions
add_action('init', 'bigbluebutton_init');
add_action('admin_menu', 'bigbluebutton_add_pages', 1);
add_action('admin_init', 'bigbluebutton_admin_init', 1);
add_action('plugins_loaded', 'bigbluebutton_update' );
add_action('plugins_loaded', 'bigbluebutton_widget_init' );
set_error_handler("bigbluebutton_warning_handler", E_WARNING);