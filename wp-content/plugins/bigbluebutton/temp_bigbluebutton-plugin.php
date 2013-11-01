<?php
echo "hello";

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