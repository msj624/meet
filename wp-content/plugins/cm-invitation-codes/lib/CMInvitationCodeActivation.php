<?php
/**
 * CM Invitation Codes activation keys mechanism
 * @package CMInvitationCodes/Library
 */

/**
 * CM Invitation Codes activation key mechanism
 *
 * @author CreativeMinds
 * @version 1.0
 * @copyright Copyright (c) 2012, CreativeMinds
 * @package CMInvitationCodes/Library
 */
class CMInvitationCodeActivation {
    /**
     * Menu item for activation keys
     */
    const MENU_ACTIVATION = 'cm_invitationcodes_activate_menu';
    /**
     * Slug for activate link
     */
    const VERIFY_SLUG = 'activate';
    /**
     * Usermeta for storing activation key
     */
    const ACTIVATION_KEY_META = 'cmic_activation_key';
    /**
     * Usermeta for storing activation creation time
     */
    const ACTIVATION_CREATION_META = 'cmic_activation_creation';
    /**
     * Usermeta for his status (pending, approved)
     */
    const USER_STATUS_META = 'cmic_user_status';
    /**
     * Option for activation key expiration
     */
    const EXPIRATION_OPTION = 'cmic_activationkey_expiration';
    /**
     * Cron hook for cleaning expired keys
     */
    const CLEAN_OLD_KEYS_HOOK = 'cmic_clean_old_keys';
    
    const OPTION_MAIL_ACTIVATION_SUBJECT = 'cmic_mail_activation_subject';
    const OPTION_MAIL_ACTIVATION_BODY = 'cmic_mail_activation_body';
    const DEFAULT_MAIL_ACTIVATION_BODY = 'If you want to activate your account in [blogname], please click or copy/paste to your browser this link: <a href="[activation_link]">[activation_link]</a>.';
    const DEFAULT_MAIL_ACTIVATION_SUBJECT = '[[blogname]] Activate your account';
    const OPTION_MAIL_CONFIRM_BODY = 'cmic_mail_confirm_body';
    const OPTION_MAIL_CONFIRM_SUBJECT = 'cmic_mail_confirm_subject';
    const DEFAULT_MAIL_CONFIRM_BODY = "You have confirmed your registration to [blogname]
        Username: [login]
        Password: [password]
        [login_url]";
    const DEFAULT_MAIL_CONFIRM_SUBJECT = '[[blogname]] Registration Confirmed';
    /**
     * Init, register actions and filters
     */
    public static function init() {
        add_action('admin_init', array(get_class(), 'registerExcelAction'));
        add_action('admin_menu', array(get_class(), 'registerActivationKeysPage'));
        add_action('cmic_custom_row_fields', array(get_class(), 'showRowField'), 1, 2);
        add_action('cmic_custom_add_form_fields', array(get_class(), 'showAddForm'), 1);
        add_action('cmic_custom_headers', array(get_class(), 'showHeader'), 1);
        add_action('user_register', array(get_class(), 'add_user_status'));
        add_action('register_post', array(get_class(), 'send_approval_email'), 10, 3);
        add_action('lostpassword_post', array(get_class(), 'lost_password'));
        //Make a fake page for verification code to use
        add_filter('the_posts', array(get_class(), 'verification_page'));
        add_filter('registration_errors', array(get_class(), 'show_user_pending_message'), 1000, 1);
        add_filter('login_message', array(get_class(), 'welcome_user'));
        add_filter('wp_authenticate_user', array(get_class(), 'authenticate_user'), 10, 2);

        if (!wp_next_scheduled(self::CLEAN_OLD_KEYS_HOOK)) {
            wp_schedule_event(time(), 'daily', self::CLEAN_OLD_KEYS_HOOK);
        }
        add_action(self::CLEAN_OLD_KEYS_HOOK, array(get_class(), 'runCron'));
    }

    /**
     * Run daily cron
     */
    public static function runCron() {
        self::deleteOldActivationKeys(false);
    }
    /**
     * Registers action for excel export
     */
    public static function registerExcelAction() {
        if (is_admin() && $_GET['page'] == self::MENU_ACTIVATION && $_GET['as_excel'] == 1) {
            require(CMIC_PATH . '/views/activations_excel.php');
        }
    }

    /**
     * Adds activation keys admin panel
     */
    public static function registerActivationKeysPage() {
        do_action('cmic_settings_add_option', self::EXPIRATION_OPTION, 'Activation key expiration (in days)', 3);
                do_action('cmic_settings_add_option', self::OPTION_MAIL_ACTIVATION_SUBJECT, 'Mail with activation key - subject', self::DEFAULT_MAIL_ACTIVATION_SUBJECT);
        do_action('cmic_settings_add_option', self::OPTION_MAIL_ACTIVATION_BODY, 'Mail with activation key - body', self::DEFAULT_MAIL_ACTIVATION_BODY, 'textarea');
        do_action('cmic_settings_add_option', self::OPTION_MAIL_CONFIRM_SUBJECT, 'Mail with confirmation - subject', self::DEFAULT_MAIL_CONFIRM_SUBJECT);
        do_action('cmic_settings_add_option', self::OPTION_MAIL_CONFIRM_BODY, 'Mail with confirmation - body', self::DEFAULT_MAIL_CONFIRM_BODY, 'textarea');
        add_submenu_page(CMInvitationCodes::MENU_OPTION, 'CM Invitation Codes Activation Keys', 'Activation Keys', 'manage_options', self::MENU_ACTIVATION, array(get_class(), 'displayActivationPage'));
    }

    /**
     * Display activation keys admin panel
     */
    public static function displayActivationPage() {
        ob_start();
        require CMIC_PATH . '/views/admin_activation.php';
        $content = ob_get_contents();
        ob_end_clean();
        do_action('cmic_admin_page', $content);
    }

    /**
     * Shows activation link header in invitation codes panel
     */
    public static function showHeader() {
        echo '<th scope="col">Activation Link</th>';
    }

    /**
     * Shows activation needed input in invitation codes panel
     */
    public static function showAddForm() {
        echo '<strong>Registration Activation:</strong>&nbsp
                            <select name="activation[]" id="activation[]" style="width: auto;">					
                                <option value="1">With Activation</option>
                                <option value="0">No Activation</option>
                            </select>&nbsp;&nbsp;&nbsp;	    ';
    }

    /**
     * Shows activation field in invitation codes panel
     */
    public static function showRowField($invitationCode, $excel = false) {
        $txt = '<td>';
        if (!$excel) {
            $txt .= '<select name="activation_' . $invitationCode->getCode() . '" id="activation_' . $invitationCode->getCode() . '" style="width: auto;">';
            $txt.= '<option value="1"';
            $txt.= '>With Activation</option>';
            $txt.= '<option value="0"';
            if (!$invitationCode->isActivationNeeded())
                $txt.= ' selected';
            $txt.= '>No Activation</option>';
            $txt.= '</select>';
        } else {
            $txt.= $invitationCode->isActivationNeeded() ? 'TRUE' : 'FALSE';
        }
        $txt.= '</td>';
        echo $txt;
    }

    /**
     * Checks if given activation key is correct
     * @param string $login
     * @param string $key
     * @return bool 
     */
    public static function checkActivationKey($login, $key) {
        $user = get_user_by('login', $login);
        if (!empty($user))
            return ($user->{self::ACTIVATION_KEY_META} == $key);
        return false;
    }

    /**
     * Shows headers in activation keys panel
     * @param bool $excel 
     */
    protected static function _showHeader($excel = false) {
        ?>
        <thead>
            <tr valign="top">      
                <th scope="col">Creation</th>
                <th scope="col">Invitation Code</th>
                <th scope="col">Activation Key</th>
                <th scope="col">User Id</th>
                <th scope="col">User Name</th>
                <th scope="col">Used</th>
                <?php if (!$excel): ?>
                    <th scope="col">Options</th> 
                <?php endif; ?>
            </tr> 
        </thead>
        <?php
    }

    /**
     * Get all activation keys
     * @global type $wpdb
     * @return array 
     */
    public static function getAllActivationKeys() {
        global $wpdb;
        $sql = "SELECT user_id FROM {$wpdb->usermeta} WHERE meta_key='" . self::ACTIVATION_KEY_META . "' AND meta_value!=''";
        $results = $wpdb->get_results($sql);
        $activationKeys = array();
        foreach ($results as $row) {
            $user = get_userdata($row->user_id);
            $activationKeys[$row->user_id] = array(
                'activationKey' => $user->{self::ACTIVATION_KEY_META},
                'activationCreation' => $user->{self::ACTIVATION_CREATION_META},
                'invitationCode' => $user->{CMInvitationCodes::INVITATION_CODE_META},
                'login' => $user->user_login,
                'id' => $user->ID,
                'used' => $user->{self::USER_STATUS_META} == 'approved' ? 1 : 0
            );
        }
        //Obtain a list of columns
        if (!empty($activationKeys)) {
            foreach ($activationKeys as $key => $row) {
                $creation[$key] = $row['activationCreation'];
                $used[$key] = $row['used'];
            }
            array_multisort($used, SORT_ASC, $creation, SORT_DESC, $activationKeys);
        }
        return $activationKeys;
    }

    /**
     * Display activation keys in excel format
     */
    protected static function _displayExcelActivationKeys() {
        $keys = self::getAllActivationKeys();
        foreach ($keys as $key) {
            echo '<tr>';
            echo '<td>' . date('Y-m-d H:i:s', $key['activationCreation']) . '</td>';
            echo '<td>' . $key['invitationCode'] . '</td>';
            echo '<td>' . $key['activationKey'] . '</td>';
            echo '<td>' . $key['id'] . '</td>';
            echo '<td>' . $key['login'] . '</td>';
            echo '<td>' . ($key['used'] ? 'used' : 'pending') . '</td>';
            echo '</tr>';
        }
    }

    /**
     * Display activation keys in admin panel
     */
    public static function displayExistingActivationKeys() {
        //delete All Activation Keys if plugin user press the delete all link
        self::_deleteAllActivationKeys();
        //delete specific Activation Keys if plugin user press the delete link	of the key
        self::_deleteActivationKey();
        //Activate registred user if the plugin user press the activate link of the key
        self::_manuallyActivate();
        //resend Activation Email to the registred user if the plugin user press the link to resend
        self::_resendActivationEmail();
        if (isset($_GET["del_old"])) {
            $del_old = $_GET["del_old"];
            if ($del_old == "1")
                self::deleteOldActivationKeys();
        }

        $keys = self::getAllActivationKeys();
        foreach ($keys as $row) {
            echo '<tr valign="top">';
            echo '<td>' . date('F j, Y H:i:s', $row['activationCreation']) . '</td>';
            echo '<td>' . $row['invitationCode'] . '</td>';
            echo '<td>' . $row['activationKey'] . '</td>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['login'] . '</td>';
            echo '<td>' . ($row['used'] ? 'Used' : 'Pending') . '</td>';
            $uri = self::_cleanURI();
            $deleteQueryString = add_query_arg(array('del_act_key' => $row['id']), $uri);
            $resendEmailQueryString = add_query_arg(array('resend' => $row['id']), $uri);
            $activateQueryString = add_query_arg(array('activate' => $row['id']), $uri);


            echo '<td><a href="javascript:deleteConfirmation(\'' . trim(urlencode($deleteQueryString)) . '\')">[Delete]</a>';
            if (!$row['used']) {
                echo '&nbsp;&nbsp;&nbsp;<a href="' . $activateQueryString . '">[Activate]</a><br><a href="' . $resendEmailQueryString . '">[Resend Activation Email]</a>';
            }
            echo '</td>';
            echo '</tr>';
        }
    }

    /**
     * Confirm/activate user
     * @global type $wpdb
     * @param int $user_id 
     */
    public static function confirmUser($user_id) {
        global $wpdb;

        $user = new WP_User($user_id);


        // reset password to know what to send the user
        $new_pass = wp_generate_password();
        $data = array(
            'user_pass' => md5($new_pass),
        );
        $where = array(
            'ID' => $user->ID,
        );
        $wpdb->update($wpdb->users, $data, $where);

        wp_cache_delete($user->ID, 'users');
        wp_cache_delete($user->user_login, 'userlogins');

        // send email to user telling of approval
        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);

        // format the message
        $message = stripslashes(get_option(self::OPTION_MAIL_CONFIRM_BODY, self::DEFAULT_MAIL_CONFIRM_BODY));
        $subject = stripslashes(get_option(self::OPTION_MAIL_CONFIRM_SUBJECT, self::DEFAULT_MAIL_CONFIRM_SUBJECT));
        $message = str_replace('[blogname]', get_option('blogname'), $message);
        $message = str_replace('[login]', $user_login, $message);
        $message = str_replace('[password]', $new_pass, $message);
        $message = str_replace('[login_url]', get_option('siteurl') . "/wp-login.php", $message);
        $subject = str_replace('[blogname]', get_option('blogname'), $subject);

        // send the mail
        @wp_mail($user_email, $subject, $message);

        // change usermeta tag in database to approved
        update_user_meta($user->ID, self::USER_STATUS_META, 'approved');
        CMInvitationWLM::setActive($user->ID);
    }

    /**
     * Get invitation code that was just entered by user during registration
     * @return CMInvitationCode 
     */
    public static function getCurrentInvitationCode() {
        $invCode = $_POST[CMInvitationCodesFrontend::INVITATION_CODE_NAME];
        if (!empty($invCode))
            return CMInvitationCodes::getCode($invCode);
        else
            return null;
    }

    /**
     * Display a message to the user after they have registered
     */
    public static function show_user_pending_message($errors) {
        if (!empty($_POST['redirect_to'])) {
            // if a redirect_to is set, honor it
            wp_safe_redirect($_POST['redirect_to']);
            exit();
        }

        // if there is an error already, let it do it's thing
        if ($errors->get_error_code())
            return $errors;

        $message .= sprintf('You will receive an email with instructions on what you will need to do next. Thanks for your patience.');

        $errors->add('registration_required', $message, 'message');

        $success_message = 'Registration successful.';

        if (function_exists('login_header')) {
            login_header('Pending Approval', '<p class="message register">' . $success_message . '</p>', $errors);
            login_footer();

            // an exit is necessay here so the normal process for user registration doesn't happen
            exit();
        }
    }

    /**
     * Only give a user their password if they have been approved
     */
    public static function lost_password() {
        $is_email = strpos($_POST['user_login'], '@');
        if ($is_email === false) {
            $username = sanitize_user($_POST['user_login']);
            $user_data = get_user_by('login', trim($username));
        } else {
            $email = is_email($_POST['user_login']);
            $user_data = get_user_by('email', $email);
        }

        if ($user_data->{self::USER_STATUS_META} != 'approved') {
            wp_redirect('wp-login.php');
            exit();
        }

        return;
    }

    /**
     * Add message to login page saying registration is required.
     * 
     * @param string $message
     * @return string
     */
    public static function welcome_user($message) {
        if (!isset($_GET['action'])) {
            $welcome = sprintf('Welcome to %s. This site is accessible to confirmed users only. To be confirmed, you must first register.', get_option('blogname'));

            if (!empty($welcome)) {
                $message .= '<p class="message">' . $welcome . '</p>';
            }
        }

        if (isset($_GET['action']) && $_GET['action'] == 'register' && !$_POST) {
            $instructions = sprintf('You will receive an email with the confirmation key.');

            if (!empty($instructions)) {
                $message .= '<p class="message">' . $instructions . '</p>';
            }
        }

        return $message;
    }

    /**
     * Determine if the user is good to sign inbased on their status
     * 
     * @param array $userdata
     * @param string $password
     */
    public static function authenticate_user($userdata, $password) {
        $status = get_user_meta($userdata->ID, self::USER_STATUS_META, true);

        if (empty($status)) {
            // the user does not have a status so let's assume the user is good to go
            return $userdata;
        }

        $message = false;
        switch ($status) {
            case 'pending':
                $pending_message = '<strong>ERROR</strong>: Your account is not activated.';

                $message = new WP_Error('pending_approval', $pending_message);
                break;
            case 'approved':
                $message = $userdata;
                break;
        }

        return $message;
    }

    /**
     * Give the user a status
     * @param int $user_id
     */
    public static function add_user_status($user_id) {
        $status = 'pending';
        if (isset($_REQUEST['action']) && 'createuser' == $_REQUEST['action']) {
            $status = 'approved';
        }
        update_user_meta($user_id, self::USER_STATUS_META, $status);
    }

    /**
     * Check if activation is needed and send email with key or activate right away
     * @param string $user_login
     * @param string $user_email
     * @param array $errors
     */
    public static function send_approval_email($user_login, $user_email, $errors) {
        if (!$errors->get_error_code()) {
            /* check if already exists */
            $user_data = get_user_by('login', $user_login);
            if (!empty($user_data)) {
                $errors->add('registration_required', __('User name already exists'), 'message');
            } else {


              
					// create the user
					$user_pass = wp_generate_password();
					$user_id = wp_create_user($user_login, $user_pass, $user_email);
					$invCode = self::getCurrentInvitationCode();
					//Websthetics was here :)
					if($invCode) {
					CMInvitationWLM::addUser($user_id, $invCode->getWLM());
					if (!empty($invCode) && $invCode->isActivationNeeded())
					self::sendActivationKey($user_id);
					else
					self::confirmUser($user_id);
					}
            }
        }
    }

    /**
     * Send user activation key
     * @param int $user_id
     * @param bool $createNew Is this newly created key?
     */
    public static function sendActivationKey($user_id, $createNew = true) {
        $user = get_userdata($user_id);
        if ($createNew) {
            $activationKey = CMInvitationCodes::rand_md5(20);
            $activationKeyCreation = current_time('timestamp');
            update_user_meta($user_id, self::ACTIVATION_KEY_META, $activationKey);
            update_user_meta($user_id, self::ACTIVATION_CREATION_META, $activationKeyCreation);
        } else {
            $activationKey = $user->{self::ACTIVATION_KEY_META};
            $activationKeyCreation = $user->{self::ACTIVATION_CREATION_META};
        }
        CMInvitationWLM::setPending($user_id);
        $activationLink = get_bloginfo('wpurl') . '/' . self::VERIFY_SLUG . '?activation_key=' . $activationKey . '&activation_login=' . $user->user_login;
        $message = stripslashes(get_option(self::OPTION_MAIL_ACTIVATION_BODY, self::DEFAULT_MAIL_ACTIVATION_BODY));
        $message = str_replace('[blogname]', get_option('blogname'), $message);
        $message = str_replace('[activation_link]', $activationLink, $message);
        $subject = stripslashes(get_option(self::OPTION_MAIL_ACTIVATION_SUBJECT, self::DEFAULT_MAIL_ACTIVATION_SUBJECT));
        $subject = str_replace('[blogname]', get_option('blogname'), $subject);
//
        // send the mail
        wp_mail($user->user_email, $subject, $message);
    }

    /**
     * Create page for activation key/login pair verification
     * @global type $wp
     * @global type $wp_query
     * @param type $posts
     * @return stdClass 
     */
    public static function verification_page($posts) {
        global $wp, $wp_query;
        $page_slug = self::VERIFY_SLUG;
        $page_title = 'Verify Activation Key';

        //check if user is requesting our fake page
        if ((strtolower($wp->request) == $page_slug || $wp->query_vars['page_id'] == $page_slug)) {

            //create a fake post
            $post = new stdClass;
            $post->post_author = 1;
            $post->post_name = $page_slug;
            $post->guid = get_bloginfo('wpurl' . '/' . $page_slug);
            $post->post_title = $page_title;
            //put your custom content here
            $post->post_content = self::_verificationContent();
            //just needs to be a number - negatives are fine
            $post->ID = -42;
            $post->post_status = 'static';
            $post->comment_status = 'closed';
            $post->ping_status = 'closed';
            $post->comment_count = 0;
            //dates may need to be overwritten if you have a "recent posts" widget or similar - set to whatever you want
            $post->post_date = current_time('mysql');
            $post->post_date_gmt = current_time('mysql', 1);

            $posts = NULL;
            $posts[] = $post;

            $wp_query->is_page = true;
            $wp_query->is_singular = true;
            $wp_query->is_home = false;
            $wp_query->is_archive = false;
            $wp_query->is_category = false;
            unset($wp_query->query["error"]);
            $wp_query->query_vars["error"] = "";
            $wp_query->is_404 = false;
        }

        return $posts;
    }

    /**
     * Generate verification page content
     * @return string 
     */
    protected static function _verificationContent() {
        $key = $_GET['activation_key'];
        $login = $_GET['activation_login'];
        if (!empty($key) && !empty($login) && self::checkActivationKey($login, $key)) {
            $user = get_user_by('login', $login);
            self::confirmUser($user->ID);
            return 'Congratulations! Your account has been activated. You will now receive e-mail with generated password.';
        } else {
            return 'Error! Sorry, but your activation key is invalid or has already expired.';
        }
    }

    /**
     * Delete all activation keys
     * @return void
     */
    protected static function _deleteAllActivationKeys() {
        if (!isset($_GET["del_all"]))
            return;
        $del_all = $_GET["del_all"];
        if ($del_all != "1")
            return;

        $keys = self::getAllActivationKeys();
        foreach ($keys as $key) {
            update_user_meta($key['id'], self::ACTIVATION_KEY_META, '');
            update_user_meta($key['id'], self::ACTIVATION_CREATION_META, '');
            if (!$key['used']) {
                //the user activated the account after registration and shouldn't be deleted
                wp_delete_user($key['id']);
            }
        }
        $msg = "All activation keys and registered pending users, which were not activated yet, were deleted !";
        self::_showSuccess($msg);
    }

    /**
     * Get expiration time (days)
     * @return int 
     */
    public static function getExpirationTime() {
        return apply_filters('cmic_settings_get_option', 3, self::EXPIRATION_OPTION);
    }

    /**
     * Delete expired activation keys
     * @global type $wpdb
     * @param bool $showMsg Show message to the user?
     */
    public static function deleteOldActivationKeys($showMsg = true) {
        global $wpdb;
        $expirationDays = self::getExpirationTime();
        $keys = self::getAllActivationKeys();
        foreach ($keys as $key) {
            if (!$key['used'] && $key['activationCreation'] + ($expirationDays * 24 * 60 * 60) < time()) {
                wp_delete_user($key['id']);
            }
        }
        if ($showMsg) {
            $msg = "All activation keys older than " . $expirationDays . " days and old registered pending users, which were not activated yet, were deleted!";
            self::_showSuccess($msg);
        }
    }

    /**
     * Delete given activation key
     * @return void 
     */
    protected static function _deleteActivationKey() {
        if (!isset($_GET["del_act_key"]))
            return;
        $del_key = $_GET["del_act_key"];

        $user = get_userdata($del_key);
        $activationKey = $user->{self::ACTIVATION_KEY_META};
        if ($user->{self::USER_STATUS_META} == 'pending') {
            wp_delete_user($del_key);
            $msg = "Activation key for user ID:" . $del_key . " and the registered pending user:" . $user->user_login . " was deleted !";
        } else {
            update_user_meta($del_key, self::ACTIVATION_KEY_META, '');
            update_user_meta($del_key, self::ACTIVATION_CREATION_META, '');
            $msg = "Activation key for user ID:" . $del_key . " was deleted, but user:" . $user->user_login . " was already activated so wasn't deleted !";
        }
        self::_showSuccess($msg);
    }

    /**
     * Activate user by pressing a link
     */
    protected static function _manuallyActivate() {

        if (!isset($_GET["activate"]))
            return;
        $user_id = $_GET["activate"];

        self::confirmUser($user_id);

        $msg = "User ID:" . $user_id . " was manually activated !";
        self::_showSuccess($msg);
    }

    /**
     * Resend the mail with activation key to the user
     */
    protected static function _resendActivationEmail() {

        if (!isset($_GET["resend"]))
            return;
        $user_id = $_GET["resend"];
        self::sendActivationKey($user_id, false);
        $user = get_userdata($user_id);

        $msg = "An Activation Email For user ID:" . $user_id . " was resend to email:" . $user->user_email . " !";
        self::_showSuccess($msg);
    }

    /**
     * Show error message
     * @param string $msg 
     */
    protected static function _showError($msg) {
        echo '<div class="error fade"><p><strong>' . $msg . '</strong></p></div>';
    }

    /**
     * Show success message
     */
    protected static function _showSuccess($msg) {
        echo '<div class="updated fade"><p><strong>' . $msg . '</strong></p></div>';
    }

    /**
     * Clean URI from recent query arguments
     * @return string URI 
     */
    protected static function _cleanURI() {
        $uri = $_SERVER['REQUEST_URI'];
        $bannedValues = array('del_all', 'del_old', 'del_act_key', 'resend', 'activate');
        foreach ($bannedValues as $value) {
            $uri = remove_query_arg($value, $uri);
        }
        return $uri;
    }

}
?>
