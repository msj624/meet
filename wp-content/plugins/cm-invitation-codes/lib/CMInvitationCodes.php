<?php
/**
 * CM Invitation Codes core
 * @package CMInvitationCodes/Library
 */
include_once CMIC_PATH . '/lib/CMInvitationCode.php';
include_once CMIC_PATH . '/lib/CMInvitationCodesFrontend.php';

/**
 * CM Invitation Codes core
 *
 * @author CreativeMinds
 * @version 1.0
 * @copyright Copyright (c) 2012, CreativeMinds
 * @package CMInvitationCodes/Library
 */
class CMInvitationCodes {
    /**
     * Main menu slug
     */
    const MENU_OPTION = 'cm_invitationcodes_menu';
    /**
     * About slug
     */
    const MENU_ABOUT = 'cm_invitationcodes_about';
    /**
     * Premium slug
     */
    const MENU_PREMIUM = 'cm_invitationcodes_premium';
    /**
     * Usermeta key for invitation code
     */
    const INVITATION_CODE_META = 'cmic_invitation_code';

    /**
     * DB Table name for invitation codes
     */
    const DB_INVITATION_CODES = 'cm_invitationcodes';

    /**
     * Name of option storing code format
     */
    const OPTION_CODE_FORMAT = 'cmic_code_format';
    const OPTION_DB_VERSION = 'cmic_db_version';
    const DB_VERSION = '2.1';
    /**
     * Default code format
     */
    const DEFAULT_CODE_FORMAT = 'CMIC-[group]-REGI-[code]';

    /**
     * @var string Code format 
     */
    protected static $_codeFormat;

    /**
     * @var CMInvitationCode[] Cached instances 
     */
    protected static $_instances = array();
    /**
     * @var array list of errors 
     */
    protected static $_errors = array();
    /**
     * @var array list of success messages
     */
    protected static $_messages = array();

    /**
     * Init the plugin
     */
    public static function init() {
        if (get_option(self::OPTION_DB_VERSION)!=self::DB_VERSION) {
            self::install();
        }
        add_action('admin_menu', array(get_class(), 'registerAdminMenu'));
        add_action('delete_user', array(get_class(), 'cleanUpUser'));
        self::_checkRegistrationOpen();
        add_action('admin_notices', array(get_class(), 'showAdminNotices'));
        add_action('cmic_admin_page', array(get_class(), 'showAdminPage'), 1, 1);
        CMInvitationCodesFrontend::init();
        do_action('cmic_init');
    }

    /**
     * Show warning when registration is disabled in wordpress
     */
    protected static function _checkRegistrationOpen() {
        if (!get_option('users_can_register')) {
            self::_showError('To use CM Invitation Codes, you must have registration enabled <a href="' . get_admin_url(null, 'options-general.php') . '">here</a>');
        }
    }

    /**
     * Install DB Table
     * @global type $wpdb 
     */
    public static function install() {
        global $wpdb;

        $table_name1 = $wpdb->prefix . self::DB_INVITATION_CODES;
        $sql = "CREATE TABLE `" . $table_name1 . "` (
            `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            `time` DATETIME NOT NULL,
            `invitationCode` VARCHAR(55) NOT NULL,
            `group` VARCHAR(140) NOT NULL,
            `registrationsLimit` INTEGER(9) UNSIGNED NOT NULL,
            `activationNeeded` TINYINT(1) UNSIGNED NOT NULL,
            `users` TEXT DEFAULT NULL,
            `deleted` TINYINT(1) UNSIGNED DEFAULT 0,
            `wlm` LONGTEXT DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE INDEX `group`(`group`)            
	);";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        update_option(self::OPTION_DB_VERSION, self::DB_VERSION);
    }

    /**
     * Uninstall plugin, removes DB table
     * @global type $wpdb 
     */
    public static function uninstall() {
        global $wpdb;

        $ICC_table_name = $wpdb->prefix . self::DB_INVITATION_CODES;
//        $wpdb->query("DROP TABLE IF EXISTS $ICC_table_name");
    }

    public static function showAdminPage($content) {
        require(CMIC_PATH . '/views/admin_template.php');
    }

    /**
     * Action when user is deleted - increases limit for invitation code he used
     * @param int $user_id 
     */
    public static function cleanUpUser($user_id) {
        $user = get_userdata($user_id);
        $login = $user->user_login;
        $invCodeUsed = $user->{self::INVITATION_CODE_META};
        $invCode = self::getCode($invCodeUsed);
        if (!empty($invCode))
            $invCode->removeUser($login);
    }

    /**
     * Add main menu
     */
    public static function registerAdminMenu() {
        do_action('cmic_settings_add_option', self::OPTION_CODE_FORMAT, 'Choose format of code<br />- [group] - group name abbreviation (optional),<br />- [code] is generated hash string (mandatory)', self::DEFAULT_CODE_FORMAT);
        self::$_codeFormat = apply_filters('cmic_settings_get_option', self::DEFAULT_CODE_FORMAT, self::OPTION_CODE_FORMAT);
        add_menu_page('CM Invitation Codes List', 'CM Invitation Codes', 'manage_options', self::MENU_OPTION, array(get_class(), 'displayAdminOptions'), '');
        add_submenu_page(self::MENU_OPTION, 'CM Invitation Codes About', 'About', 'manage_options', self::MENU_ABOUT, array(get_class(), 'displayAboutPage'));
        self::_processAdminOptions();
    }

    protected static function _processAdminOptions() {
        global $wpdb, $user_ID;

        $table_name = $wpdb->prefix . self::DB_INVITATION_CODES;

        $InvitationCodes = self::getAllExistingInvitationCodes();

        //update existing invitations code
        foreach ($InvitationCodes as $InvitationCode) {

            $InvCode = $InvitationCode->getCode();
            $NewInvCode = $InvCode;
            $changed = false;
            if (isset($_POST["i" . $InvCode])) {
                //get the invitaion code that might was edited by the user
                $NewInvitationCode = $_POST["i" . $InvCode];
                if ($NewInvitationCode != $InvCode) {
                    //the invitaion code field was edited.
                    //check if the new one is already exists.
                    $checkCode = self::getCode($NewInvitationCode);
                    if (!empty($checkCode)) {
                        self::_showError("Invitation Code:" . $NewInvitationCode . " already exists, therefore will not be updated");
                    }
                    //code was edited. remove chars that cannot be used in the code and update the DB
                    $NewInvCode = self::_removeBadChars($_POST["i" . $InvCode]);
                    $InvitationCode->setCode($NewInvCode);
                    $changed = true;

                    $msg = "The invitation code:" . $NewInvCode . " was updated instead of:" . $InvCode;
                    self::_showSuccess($msg);
                }
            }
            //update registrations limit value
            $oldRegisrationsLimit = $InvitationCode->getLimit();
            if (isset($_POST["registrationsLimit" . $InvCode])) {
                //get registrations limit edited value
                $newRegistrationsLimit = $_POST["registrationsLimit" . $InvCode];
                if ($newRegistrationsLimit != $oldRegisrationsLimit) {
                    //registration limit field was edited. check if it is a number
                    if (!ctype_digit($newRegistrationsLimit)) {
                        $msg = "The registrations limit value is not a number, therefore the default value (10) was set as limit";
                        self::_showError($msg);
                        $newRegistrationsLimit = 10;
                    }
                    //update the registrations limit in the DB
                    $InvitationCode->setLimit($newRegistrationsLimit);
                    $changed = true;
                    $msg = "The registrations Limit for the invitation code:" . $NewInvCode . " was updated to: " . $newRegistrationsLimit;
                    self::_showSuccess($msg);
                }
            }
            //update activation value (Yes/No)
            $oldActivationNeeded = $InvitationCode->isActivationNeeded();
            if (isset($_POST["activation_" . $InvCode])) {
                //get the new activation value
                $updatedActivation = $_POST["activation_" . $InvCode];
                if ($updatedActivation != $oldActivationNeeded) {
                    //activation value was edited. update the DB
                    $InvitationCode->setActivationNeeded($updatedActivation);
                    $changed = true;
                    $msg = "The activation settings of invitation code:" . $NewInvCode . " was updated to: ";
                    if ($updatedActivation)
                        $msg .= "With Activation.";
                    else
                        $msg .= "No Activation.";
                    self::_showSuccess($msg);
                }
            }
            if (CMInvitationWLM::isWLMInstalled() && CMInvitationWLM::isIntegrated()) {
            //update wlm
            $oldWLM = $InvitationCode->getWLM();
            if (isset($_POST["wlm_" . $InvCode])) {
                //get the new activation value
                $updatedWLM = $_POST["wlm_" . $InvCode];
                if ($updatedWLM != $oldWLM) {
                    //activation value was edited. update the DB
                    $InvitationCode->setWLM($updatedWLM);
                    $changed = true;
                    $msg = "The WishList Member Level for invitation code:" . $NewInvCode . " was updated to: ".CMInvitationWLM::getLevelById($updatedWLM);
                    self::_showSuccess($msg);
                }
            }
            }
            if ($changed)
                $InvitationCode->save();
        }

        //insert to DB new invitation codes added by the user
        $compCounter = count($_POST["group"]);

        for ($i = 0; $i < $compCounter; $i++) {

            //create code and insert to the table
            if ((strcmp(trim($_POST["group"][$i]), "") == 0) ||
                    (strcmp($_POST["group"][$i], "Enter Group Name") == 0)) {
                //company name field is empty
                continue;
            }
            $checkCode = array();
            //create invitation code and check if already exists
            //if exists try to create again until the code is not exists
            //and therefore legal code
            $NewInvitationCode = self::_createCode($_POST["group"][$i]);
            do {
                $NewInvitationCode = self::_createCode($_POST["group"][$i]);
                $checkCode = self::getCode($NewInvitationCode);
            } while (!empty($checkCode));

            $currentGroup = $_POST["group"][$i];
            $currentActivation = $_POST["activation"][$i];
            $currentWLM = $_POST['wlm'][$i];
            $regLimit = $_POST["limit"][$i];
            if (empty($regLimit) || (!ctype_digit($regLimit) && $regLimit != 'No limit')) {
                $regLimit = CMInvitationCode::NO_LIMIT;
            } elseif ($regLimit == 'No limit') {
                $regLimit = CMInvitationCode::NO_LIMIT;
            }
            //check if the company is already exists on the DB
            $checkGroup = self::getCodeByGroup($currentGroup);
            if (!empty($checkGroup)) {
                $msg = "The group: {$currentGroup} already exists, therefore, could not be added";
                self::_showError($msg);
                continue;
            }

            //insert the invitation code and the company to the DB
            $NewInvitationCode = self::_removeBadChars($NewInvitationCode);
            $currentGroup = self::_removeBadChars($currentGroup);
            CMInvitationCode::newCode(array(
                'invitationCode' => $NewInvitationCode,
                'group' => $currentGroup,
                'registrationsLimit' => (int)$regLimit,
                'activationNeeded' => $currentActivation,
                    'wlm' => $currentWLM)
             );
            $msg = "The group: {$currentGroup} was Added";
            self::_showSuccess($msg);

            //Send email to admin for Adding an Invitation Code
            $subject = "Adding a new Invitation Code.";
            $msg = "invitation Code was Added.\n\nGroup: $currentGroup\nInvitation Code: $NewInvitationCode\n\nLimit no. of registrations: $regLimit\n";
            if (!empty($currentWLM))
                $msg.='WLM Level: '.  CMInvitationWLM::getLevelById ($currentWLM);
            do_action('cmic_log_email', $subject, $msg);
        }
        self::_deleteGroup();
    }

    /**
     * Display table with invitation codes
     * @global type $wpdb
     * @global int $user_ID 
     */
    public static function displayAdminOptions() {

        ob_start();
        require(CMIC_PATH . '/views/admin_view.php');
        $content = ob_get_contents();
        ob_end_clean();
        do_action('cmic_admin_page', $content);
    }

    public static function displayAboutPage() {
        ob_start();
        require(CMIC_PATH . '/views/admin_about.php');
        $content = ob_get_contents();
        ob_end_clean();
        do_action('cmic_admin_page', $content);
    }

    public static function showNav() {
        global $submenu, $plugin_page, $pagenow;
        $submenus = array();
        if (isset($submenu[self::MENU_OPTION])) {
            $thisMenu = $submenu[self::MENU_OPTION];
            foreach ($thisMenu as $item) {
                $slug = $item[2];
                $isCurrent = $slug == $plugin_page;
                $submenus[] = array(
                    'link' => get_admin_url('', $pagenow . '?page=' . $slug),
                    'title' => $item[0],
                    'current' => $isCurrent
                );
            }
            require(CMIC_PATH . '/views/admin_nav.php');
        }
    }

    /**
     * Gets invitation code DB record by code string
     * @param string $code
     * @return CMInvitationCode 
     */
    public static function getCode($code) {
        if (isset(self::$_instances[$code]))
            return self::$_instances[$code];
        else {
            $instance = CMInvitationCode::getInstance($code);
            if (!empty($instance)) {
                self::$_instances[$code] = $instance;
                return $instance;
            }
        }
        return null;
    }

    /**
     * Gets code for group name
     * @param string $group
     * @return CMInvitationCode
     */
    public static function getCodeByGroup($group) {
        $instance = CMInvitationCode::getInstanceByGroup($group);
        if (!empty($instance)) {
            self::$_instances[$instance->getCode()] = $instance;
            return $instance;
        } else
            return null;
    }

    /**
     * Gets all invitation codes in the DB
     * @global type $wpdb
     * @global string $searchWord
     * @return CMInvitationCode[]
     */
    public static function getAllExistingInvitationCodes() {
        global $wpdb, $searchWord;
        $table_name = $wpdb->prefix . self::DB_INVITATION_CODES;
        $sql = "SELECT * FROM " . $table_name;
        if ($searchWord != "") {
            $sql .= " WHERE invitationCode LIKE '%" . $searchWord . "%' OR `group` LIKE '%" . $searchWord . "%' OR registrationsLimit LIKE '%" . $searchWord . "%'";
        }
        $sql .=" ORDER BY `deleted` ASC,`group` ASC";
        $InvCodes = $wpdb->get_results($sql);
        foreach ($InvCodes as $key => $val) {
            $instance = new CMInvitationCode($val);
            self::$_instances[$instance->getCode()] = $instance;
            $InvCodes[$key] = $instance;
        }
        return $InvCodes;
    }

    /**
     * Get only codes that should be presented on current page
     * @param int $pageNumber
     * @param int $itemsPerPage
     * @return CMInvitationCode[] 
     */
    protected static function _getExistingInvitationCodesOnPage($pageNumber, $itemsPerPage) {
        $InvCodes = self::getAllExistingInvitationCodes();

        //compute first index of item to show on the current page
        $startItem = $itemsPerPage * ($pageNumber - 1) + 1;
        //compute last index of item to show on the current page
        $endItem = $itemsPerPage * ($pageNumber);
        //build array contains only the invitation codes of the current page
        $retInvCodes = array();
        for ($i = $startItem - 1; $i <= $endItem - 1; $i++) {
            if ($i >= count($InvCodes))
                break;
            $retInvCodes[] = $InvCodes[$i];
        }

        return $retInvCodes;
    }

    /**
     * Shows header row
     * @param bool $excel 
     */
    public static function showHeader($excel = false) {
        ?><thead>
            <tr valign="top">

                <th scope="col">Invitation Code</th>
                <th scope="col">Group Name</th>
                <?php do_action('cmic_custom_headers');
                if (!$excel): ?>
                    <th scope="col">Users</th>
                    <th scope="col">Options</th>
                <?php else: ?>
                    <th scope="col">User count</th>
                    <th scole="col">Active?</th>
                <?php endif; ?>
            </tr></thead><?php
    }

    /**
     * Display all invitaion codes list on the current page
     */
    protected static function _displayExistingInvitationCodesOnPage($pageNumber, $itemsPerPage) {
        global $searchParam;


        $InvitationCodes = self::_getExistingInvitationCodesOnPage($pageNumber, $itemsPerPage);
        $num = 1;
        $Activation = true;
        if (empty($InvitationCodes)) {
            echo '<tr class="noitems" valign="top"><td class="colspanchange" colspan="4">No invitation codes found</td></tr>';
        } else
            foreach ($InvitationCodes as $InvitationCode) {
                $group = $InvitationCode->getGroup();
                $InvCode = $InvitationCode->getCode();
                $registrationsLimit = $InvitationCode->getLimit();
                $deleted = $InvitationCode->isDeleted();
                echo '<tr valign="top" class="' . ($num++ % 2 == 0 ? 'alternate' : '') . '">';
                $invCodeField = $InvCode;
                echo '<td class="' . ($deleted ? ' deleted' : '') . '">' . apply_filters('cmic_row_field_invitationCode', $invCodeField, $InvitationCode) . '</td>';
                echo '<td>' . apply_filters('cmic_row_field_group', $group, $InvitationCode) . '</td>';

                //$currentQueryString = get_bloginfo( 'wpurl').'/wp-admin/options-general.php?page=akrinvitationcodes_options_menu&del_invitation_code='.$InvCode.'&company='.$company;	          	                 	
                $deleteInvQueryString = get_bloginfo('wpurl') . '/wp-admin/admin.php?page=' . self::MENU_OPTION . '&del_invitation_code=' . $InvCode . '&del=' . ($deleted ? 0 : 1) . '&group=' . $group . '&paged=' . $pageNumber . $searchParam;

                do_action('cmic_custom_row_fields', $InvitationCode);

                //reformat group name to a temporary name to use as a part of unique name to a function
                $tempGroupName = str_replace('-', '_', sanitize_title($group));
                echo '<td>' . apply_filters('cmic_row_field_usercount', count($InvitationCode->getUsers()), $InvitationCode) . '</td>';
                //user can delete group only if he has certification to update plugin
                if ((is_user_logged_in()) && (current_user_can('update_plugins'))) {
                    if (!$deleted)
                        $deleteLink = '<a href="javascript:delete' . $tempGroupName . 'Confirmation(\'deactivate\')">[Deactivate]</a>';
                    else
                        $deleteLink = '<a href="javascript:delete' . $tempGroupName . 'Confirmation(\'activate\')">[Activate]</a>';
                    echo '<td>' . apply_filters('cmic_row_field_delete', $deleteLink, $InvitationCode) . '</td>';
                }
                echo '</tr>';


                echo '<script type="text/javascript">';
                echo 'function delete' . $tempGroupName . 'Confirmation(msg) {
			var answer = confirm("Are you sure you want to "+msg+" Invitation Code ' . $InvCode . '? ")
			if (answer){
				window.location = "' . $deleteInvQueryString . '";
			}
			else{
				alert("No action taken")
			}
		}';

                echo '</script>';
                do_action('cmic_row_after', $InvitationCode);
            }
                ?>

        <?php
    }

    /**
     * Set pagination arguments
     * @param array $args
     * @return array 
     */
    protected static function _setPaginationArgs($args) {
        $args = wp_parse_args($args, array(
            'total_items' => 0,
            'total_pages' => 0,
            'per_page' => 0,
                ));

        if (!$args['total_pages'] && $args['per_page'] > 0)
            $args['total_pages'] = ceil($args['total_items'] / $args['per_page']);

        return $args;
    }

    /**
     * Get page number
     * @param int $total_pages
     * @return int
     */
    protected static function _getPagenum($total_pages) {
        $pagenum = isset($_GET['paged']) ? absint($_GET['paged']) : 0;
        if ($pagenum > $total_pages)
            $pagenum = $total_pages;
        return max(1, $pagenum);
    }

    /**
     * Print pagination
     * @global string $searchParam
     * @param string $which
     * @param array $args 
     */
    protected static function _invitationPagination($which, $args) {
        global $searchParam;
        $args = self::_setPaginationArgs($args);
        extract($args);

        $output = '<span class="displaying-num">' . sprintf(_n('1 item found ', '%s items found ', $total_items), number_format_i18n($total_items)) . '</span>';

        $current = self::_getPagenum($total_pages);

        $current_url = get_bloginfo('wpurl') . '/wp-admin/admin.php?page=' . self::MENU_OPTION . $searchParam;

        $page_links = array();
        $disable_first = $disable_last = '';
        if ($current == 1)
            $disable_first = ' disabled';
        if ($current == $total_pages)
            $disable_last = ' disabled';

        $page_links[] = sprintf("<a class='%s' title='%s' href='%s'>%s</a>", 'first-page' . $disable_first, esc_attr__('Go to the first page'), esc_url(remove_query_arg('paged', $current_url)), '&laquo;'
        );

        $page_links[] = sprintf("<a class='%s' title='%s' href='%s'>%s</a>", 'prev-page' . $disable_first, esc_attr__('Go to the previous page'), esc_url(add_query_arg('paged', max(1, $current - 1), $current_url)), '&lsaquo;'
        );

        if ('bottom' == $which)
            $html_current_page = $current;
        else
            $html_current_page = sprintf("<input class='current-page' title='%s' type='text' name='%s' value='%s' size='%d' />", esc_attr__('Current page'), esc_attr('paged'),
                    /* $current */ $current <= $total_pages ? $current : 1, strlen($total_pages)
            );

        $html_total_pages = sprintf("<span class='total-pages'>%s</span>", number_format_i18n($total_pages));
        $page_links[] = '<span class="paging-input">' . sprintf(_x('%1$s of %2$s', 'paging'), $html_current_page, $html_total_pages) . '</span>';

        $page_links[] = sprintf("<a class='%s' title='%s' href='%s'>%s</a>", 'next-page' . $disable_last, esc_attr__('Go to the next page'), esc_url(add_query_arg('paged', min($total_pages, $current + 1), $current_url)), '&rsaquo;'
        );

        $page_links[] = sprintf("<a class='%s' title='%s' href='%s'>%s</a>", 'last-page' . $disable_last, esc_attr__('Go to the last page'), esc_url(add_query_arg('paged', $total_pages, $current_url)), '&raquo;'
        );

        $output .= "\n<span class='pagination-links'>" . join("\n", $page_links) . '</span>';

        if ($total_pages)
            $page_class = $total_pages < 2 ? ' one-page' : '';
        else
            $page_class = ' no-pages';

        $pagination = "<div class='tablenav-pages{$page_class}'>$output</div>";
        echo $pagination;
    }

    /**
     * Action for deleting group
     * @global type $wpdb 
     */
    protected static function _deleteGroup() {
        global $wpdb;
        $InvitationCode = $_GET["del_invitation_code"];
        $group = $_GET["group"];
        $toDelete = $_GET['del'] == 1 ? true : false;
        if ($InvitationCode != "") {
            $code = self::getCode($InvitationCode);
            $deleted = $code->isDeleted();
            if ($toDelete === !$deleted) {
                $code->setDeleted(!$deleted);
                $code->save();
                $msg = "The Invitation Code of group: " . $group . " was " . ($deleted ? 'activated' : 'deactivated') . " !";
                self::_showSuccess($msg);

//		Send email to admin for deletion Invitation Code
                $subject = ($deleted ? 'Activating' : 'Deactivating') . " Invitation Code.";
                $msg = "Invitation Code was " . ($deleted ? 'activated' : 'deactivated') . ".\n\nGroup Name: $group\nInvitation Code: $InvitationCode\n";
                do_action('cmic_log_email', $subject, $msg);
            }
        }
    }

    /**
     * Show error message
     * @param string $msg 
     */
    protected static function _showError($msg) {
        self::$_errors[] = '<div class="error fade"><p><strong>' . $msg . '</strong></p></div>';
    }

    /**
     * Show success message
     * @param string $msg 
     */
    protected static function _showSuccess($msg) {
        self::$_messages[] = '<div class="updated fade"><p><strong>' . $msg . '</strong></p></div>';
    }

    public static function showAdminNotices() {
        $errors = apply_filters('cmic_errors_messages', self::$_errors);
        $messages = apply_filters('cmic_success_messages', self::$_messages);
        foreach ($errors as $error)
            echo $error;
        foreach ($messages as $message)
            echo $message;
    }

    /**
     * Check if given code is correct
     * @param string $code
     * @return CMInvitationCode|null 
     */
    public static function verifyCode($code) {
        $record = self::getCode($code);
        if (!empty($record) && $record->isAvailable())
            return $record;
        else
            return null;
    }

    /**
     * Get list of users registered with given invitation code
     * @param string $InvitationCode
     * @return array User logins 
     */
    public static function getUsersByInvitationCode($InvitationCode) {
        $users = array();
        $invitationRecord = self::getCode($InvitationCode);
        if (!empty($invitationRecord))
            $users = $invitationRecord->getUsers();
        return $users;
    }

    /**
     * Return number of users using an invitation code
     */
    public static function getUserCountByInvitation($InvitationCode) {
        $users = self::getUsersByInvitationCode($InvitationCode);
        return count($users);
    }

    /**
     * Generate list of users
     * @param strig $InvitationCode 
     */
    protected static function _showMatchingUsers($InvitationCode) {
        $aUsers = $InvitationCode->getUsers();
        $i = 0;

        echo '<div style="background:#EBEBEB"><table width="300"><tr><th scope="col"><h3>Group Users List</h3></th></tr><tr><td colspan="3"><ul>';
        foreach ($aUsers as $iUser) {
            $user = get_user_by('login', $iUser);
            $i++;
            $name = trim($user->first_name . ' ' . $user->last_name);
            if (!empty($name))
                $name = ' (' . $name . ')';
            if (strpos($user->first_name, ".generic") !== false) {
                echo '<li>' . $i . ') <a href="' . get_bloginfo('wpurl') . '/wp-admin/user-edit.php?user_id=' . $user->ID . '" target="new">' . $user->display_name . $name . '</a> <span style="color:green">(Generic Account)</span></li>';
            } else {
                echo '<li>' . $i . ') <a href="' . get_bloginfo('wpurl') . '/wp-admin/user-edit.php?user_id=' . $user->ID . '" target="new">' . $user->display_name . $name . '</a> (Regular Account)</li>';
            }
        }
        if ($i == 0)
            echo "No matching users found! ";
        echo '</ul></td></tr></table></div>';
    }

    /**
     * Create invitation code
     * @param string $group
     * @return string 
     */
    protected static function _createCode($group) {
        $format = self::$_codeFormat;
        $GroupNameAbbrev = self::_createGroupNameAbbreviation($group);
        $prefixCode = str_replace('[group]', $GroupNameAbbrev, $format);
        $prefixCode = str_replace('[code]', self::rand_md5(8), $prefixCode);
        $NewInvitationCode = strtoupper($prefixCode);
        return $NewInvitationCode;
    }

    /**
     * Generate random hash string
     * @param int $length Length of string
     * @return string 
     */
    public static function rand_md5($length) {
        $max = ceil($length / 32);
        $random = '';
        for ($i = 0; $i < $max; $i++) {
            $random .= md5(microtime(true) . mt_rand(10000, 90000));
        }
        return substr($random, 0, $length);
    }

    /**
     * Creates group name abbreaviation
     * @param string $group
     * @return string 
     */
    protected static function _createGroupNameAbbreviation($group) {
        $words = explode(" ", $group);
        $groupAbbrev = "";
        if (count($words) == 1) {
            $groupAbbrev = substr($words[0], 0, 4);
        } elseif (count($words) == 2) {
            $groupAbbrev = substr($words[0], 0, 1);
            $groupAbbrev .= substr($words[1], 0, 3);
        } elseif (count($words) == 3) {
            $groupAbbrev = substr($words[0], 0, 1);
            $groupAbbrev .= substr($words[1], 0, 1);
            $groupAbbrev .= substr($words[2], 0, 2);
        } elseif (count($words) >= 4) {
            $groupAbbrev = substr($words[0], 0, 1);
            $groupAbbrev .= substr($words[1], 0, 1);
            $groupAbbrev .= substr($words[2], 0, 1);
            $groupAbbrev .= substr($words[3], 0, 1);
        }
        $groupAbbrev = str_replace(" ", "", $groupAbbrev);
        return $groupAbbrev;
    }

    /**
     * Removes bad characters from string
     * @param string $String
     * @return string 
     */
    protected static function _removeBadChars($String) {
        $removechars = array("!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "+", "}", "{", "]", "[", "|", ":", ";", ">", "<", "~");
        $NewString = str_replace($removechars, "", $String);
        return $NewString;
    }

}
?>
