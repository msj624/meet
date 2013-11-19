<?php
/**
 * CM Invitation Codes - Admin settings page
 * @package CMInvitationCodes/Views
 */
?>
<form method="post">
    <?php settings_fields(self::SETTINGS_GROUP); ?>
    <?php //do_settings(self::SETTINGS_GROUP); ?>
    <table class="form-table">
        <?php
        self::_displaySettings();
        ?>
    </table>
    
    <?php submit_button(); ?>

</form>

