<?php

/**
 * CM Invitation Codes registrations limits
 * @package CMInvitationCodes/Library
 */

/**
 * CM Invitation Codes registrations limits
 *
 * @author CreativeMinds
 * @version 1.0
 * @copyright Copyright (c) 2012, CreativeMinds
 * @package CMInvitationCodes/Library
 */
class CMInvitationCodeLimits {

    /**
     * Init
     */
    public static function init() {
        add_action('cmic_custom_row_fields', array(get_class(), 'showRowField'), 1, 2);
        add_action('cmic_custom_add_form_fields', array(get_class(), 'showAddForm'), 1);
        add_action('cmic_custom_headers', array(get_class(), 'showHeader'), 1);
    }

    /**
     * Show limits header in invitation codes panel
     */
    public static function showHeader() {
        echo '<th scope="col">Registrations Limit</th>';
    }

    /**
     * Show add code field in invitation codes panel
     */
    public static function showAddForm() {
        echo '<strong>Registrations Limit:</strong>&nbsp<input id="limit[]" class="mform_file" name="limit[]" type="text" maxlength="1000" placeholder="Enter Limit No."  />&nbsp&nbsp&nbsp&nbsp;';
    }

    /**
     * Show row field in invitation codes panel
     * @param CMInvitationCode $invitationCode
     * @param bool $excel 
     */
    public static function showRowField($invitationCode, $excel = false) {
        if (!$excel) {
            echo '<td><input id="registrationsLimit' . $invitationCode->getCode() . '" class="mform_file" name="registrationsLimit' . $invitationCode->getCode() . '" type="text" maxlength=100 size="10" value="' . $invitationCode->getLimit() . '"/>';
            if (!$invitationCode->isAvailable())
                echo '<span style="color:red">***</span>';
            echo '</td>';
        } else {
            echo '<td>' . $invitationCode->getLimit() . '</td>';
        }
    }

}

?>
