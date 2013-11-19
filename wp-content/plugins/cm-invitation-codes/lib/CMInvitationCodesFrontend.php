<?php
/**
 * CM Invitation Codes frontend methods
 * @package CMInvitationCodes/Library
 */
require_once CMIC_PATH . '/lib/CMInvitationCodes.php';

/**
 * CM Invitation Codes frontend methods
 *
 * @author CreativeMinds
 * @version 1.0
 * @copyright Copyright (c) 2012, CreativeMinds
 * @package CMInvitationCodes/Library
 */
class CMInvitationCodesFrontend {
    /**
     * Form input name for invitation code
     */
    const INVITATION_CODE_NAME = 'cm_invitation_code';
    /**
     * @var string User login 
     */
    protected static $_user_login = '';

    /**
     * Init
     */
    public static function init() {
        add_action('register_form', array(get_class(), 'addRegisterFormField'));
        add_filter('registration_errors', array(get_class(), 'verifyCode'), 100, 3);
        add_action('login_footer', array(get_class(), 'loginFooter'));
    }

    /**
     * Display register form field with invitation code
     */
    public static function addRegisterFormField() {
        require(CMIC_PATH . '/views/register_form_field.php');
    }

    /**
     * Verify if given invitation code is correct and available
     * @param array $errors
     * @param string $sanitized_user_login
     * @param string $user_email
     * @return WP_Error 
     */
    public static function verifyCode($errors, $sanitized_user_login, $user_email) {
        self::$_user_login = $sanitized_user_login;
        if (count($errors->errors) > 0)
            return $errors;
        $invitation_code = isset($_POST[self::INVITATION_CODE_NAME]) ? strtoupper($_POST[self::INVITATION_CODE_NAME]) : '';
        $verifiedCode = CMInvitationCodes::verifyCode($invitation_code);
        if (empty($verifiedCode)) {
            add_action('login_head', 'wp_shake_js', 12);
            return new WP_Error('authentication_failed', '<strong>ERROR</strong>: Wrong Invitation Code.');
        } else {
            $verifiedCode->addUser($sanitized_user_login);
        }
        return $errors;
    }

    /**
     * Add footer snippet
     */
    public static function loginFooter() {
        $invitation_code = isset($_POST[self::INVITATION_CODE_NAME]) ? strtoupper($_POST[self::INVITATION_CODE_NAME]) : '';
        if (!CMInvitationCodes::verifyCode($invitation_code)):
            ?>
            <script type="text/javascript">
                try{document.getElementById('<?php echo self::INVITATION_CODE_NAME; ?>').focus();}catch(e){}
            </script>
            <?php
        else:
            $user = get_user_by('login', self::$_user_login);
            if (!empty($user)) {
                update_user_meta($user->ID, CMInvitationCodes::INVITATION_CODE_META, $invitation_code);
            }
        endif;
    }

}
?>
