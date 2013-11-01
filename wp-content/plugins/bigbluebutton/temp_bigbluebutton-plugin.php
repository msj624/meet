<?php
echo "hello";

require('php/bbb_api.php');

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