<?php
/**
 * File contains <description of the class>
 * @package Library
 */
include_once CMIC_PATH . '/lib/CMInvitationCodeSettings.php';
include_once CMIC_PATH . '/lib/CMInvitationCodeActivation.php';
include_once CMIC_PATH . '/lib/CMInvitationCodeLimits.php';
include_once CMIC_PATH . '/lib/CMInvitationWLM.php';

/**
 * <Description for the class>
 *
 * @author SP
 * @version 0.1.0
 * @copyright Copyright (c) 2011, REC
 * @package Library
 */
class CMInvitationCodesPremium {

    public static function init() {
        add_action('cmic_init', array(get_class(), 'initLib'));
    }

    public static function initLib() {
        CMInvitationCodeLimits::init();
        CMInvitationCodeActivation::init();
        CMInvitationCodeSettings::init();
        CMInvitationWLM::init();
        add_filter('cmic_row_field_invitationCode', array(get_class(), 'makeInvitationCodeEditable'), 1, 2);
        self::addUserList();
        self::addExcelExport();
        add_action('cmic_log_email', array(get_class(), 'sendLogEmail'), 1, 2);
    }


    public static function makeInvitationCodeEditable($InvCode, $invCodeObj) {
        return '<input id="i' . $InvCode . '" class="mform_file" name="i' . $InvCode . '" type="text" maxlength=100 size="45" value="' . $InvCode . '"/>';
    }

    public static function addExcelExport() {
        add_action('admin_init', array(get_class(), 'registerExcelAction'));
        add_action('cmic_list_footer', array(get_class(), 'addExcelExportLink'));
    }

    public static function addExcelExportLink() {
        ?>
        &nbsp;&nbsp;&nbsp;<a href="<?php
        $query = add_query_arg(array('as_excel' => 1));
        echo $query;
        ?>">[Export All Invitation Codes to Excel]</a>
        <?php
    }

    /**
     * Registers handler for excel export
     */
    public static function registerExcelAction() {
        global $plugin_page;
        if (is_admin() && $plugin_page == CMInvitationCodes::MENU_OPTION && $_GET['as_excel'] == 1) {
            require(CMIC_PATH . '/views/invitations_excel.php');
        }
    }

    /**
     * Shows list of codes for Excel Export
     */
    protected static function _displayExcelInvitationCodes() {
        $InvitationCodes = CMInvitationCodes::getAllExistingInvitationCodes();
        foreach ($InvitationCodes as $invCode) {
            echo '<tr>';
            echo '<td>' . $invCode->getCode() . '</td>';
            echo '<td>' . $invCode->getGroup() . '</td>';
            do_action('cmic_custom_row_fields', $invCode, true);
            echo '<td>' . count($invCode->getUsers()) . '</td>';
            echo '<td>' . $invCode->isDeleted()?'inactive':'active' . '</td>';
            echo '</tr>';
        }
    }

    public static function addUserList() {
        add_filter('cmic_row_field_usercount', array(get_class(), 'showUsersLink'), 10, 2);
        add_action('cmic_row_after', array(get_class(), 'showUsersDiv'), 10, 1);
    }

    public static function showUsersLink($userCount, $invitationCode) {
        return $userCount . ' <a href="javascript:void(0)" onclick="showDiv(\'' . $invitationCode->getCode() . '\');">[Show/Hide]</a>';
    }

    public static function showUsersDiv($invitationCode) {
        echo '<tr id="' . $invitationCode->getCode() . '" style="display:none;"><td colspan="100">';
        //create div to display users of the current company
        self::_showMatchingUsers($invitationCode);
        echo '</tr></td>';
    }

    /**
     * Generate list of users
     * @param strig $InvitationCode 
     */
    protected static function _showMatchingUsers($InvitationCode) {
        $aUsers = $InvitationCode->getUsers();
        $i = 0;

        echo '<div style="background:#EBEBEB"><table width="300"><tr><th scope="col"><strong>Group Users List</strong></th></tr><tr><td><ul>';
        foreach ($aUsers as $iUser) {
            $user = get_user_by('login', $iUser);
            $i++;
            $name = trim($user->first_name . ' ' . $user->last_name);
            if (!empty($name))
                $name = ' (' . $name . ')';
            if (strpos($user->first_name, ".generic") !== false) {
                echo '<li>' . $i . ') <a href="' . get_admin_url('', 'user-edit.php?user_id=' . $user->ID) . '" target="new">' . $user->display_name . $name . '</a> <span style="color:green">(Generic Account)</span></li>';
            } else {
                echo '<li>' . $i . ') <a href="' . get_admin_url('', 'user-edit.php?user_id=' . $user->ID) . '" target="new">' . $user->display_name . $name . '</a> (Regular Account)</li>';
            }
        }
        if ($i == 0)
            echo "No matching users found! ";
        echo '</ul></td></tr></table></div>';
    }

    /**
     * Send log e-mail to admin
     * @param string $subject
     * @param string $msg 
     */
    protected static function _sendLogEmail($subject, $msg) {
        $from = get_option('admin_email');
        $sendlogemail = get_option('admin_email');
        $headers = 'From: ' . $from . "\r\n" . "X-Mailer: php";
        ;
        $siteurl = get_bloginfo('wpurl');
        $timestamp = date("Y-m-d H:i:s");
        $msg .= "Site: $siteurl\nDate & Time: $timestamp\n\n";
        wp_mail($sendlogemail, $subject, $msg, $headers);
    }

}
?>
