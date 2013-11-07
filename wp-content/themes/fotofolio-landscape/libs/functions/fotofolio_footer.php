<?php
function fotofolio_footer() {
    $code = wpop_get_option('tracking_code');
    if ($code) {
        echo $code;
    }
}
?>