<?php
/**
 * CM Invitation Codes premium settings
 * @package CMInvitationCodes/Library
 */

/**
 * CM Invitation Codes premium settings
 *
 * @author CreativeMinds
 * @version 1.0
 * @copyright Copyright (c) 2012, CreativeMinds
 * @package CMInvitationCodes/Library
 */
class CMInvitationCodeSettings {
    /**
     * Settings page slug
     */
    const MENU_SETTINGS = 'cm_invitationcodes_settings';
    /**
     * Settings group slug
     */
    const SETTINGS_GROUP = 'cmic_settings';
    /**
     * @var array Options 
     */
    protected static $_options = array();

    /**
     * Init
     */
    public static function init() {
        add_action('cmic_settings_add_option', array(get_class(), 'addOption'), 1, 4);
        add_filter('cmic_settings_get_option', array(get_class(), 'getOptionValue'), 1, 2);
        add_action('admin_menu', array(get_class(), 'registerSettingsPage'));
    }

    /**
     * Register settings page
     */
    public static function registerSettingsPage() {
        add_submenu_page(CMInvitationCodes::MENU_OPTION, 'CM Invitation Codes Settings', 'Settings', 'manage_options', self::MENU_SETTINGS, array(get_class(), 'displaySettingsPage'));
    }

    /**
     * Display settings page
     */
    public static function displaySettingsPage() {
        ob_start();
        require CMIC_PATH . '/views/admin_settings.php';
        $content = ob_get_contents();
        ob_end_clean();
        do_action('cmic_admin_page', $content);
    }

    /**
     * Add new option
     * @param string $name
     * @param string $label
     * @param mixed $defaultValue 
     */
    public static function addOption($name, $label, $defaultValue, $type='text') {
        self::$_options[$name] = array(
            'name' => $name,
            'label' => $label,
            'default' => $defaultValue,
            'type' => $type
        );
    }

    /**
     * Gets value of option
     * @param string $name
     * @return mixed 
     */
    public static function getOptionValue($default, $name) {
        if (isset(self::$_options[$name])) {
            $option = get_option($name, self::$_options[$name]['default']);
        } else {
            $option = get_option($name);
        }
        return stripslashes($option);
    }

    /**
     * Display settings fields
     */
    protected static function _displaySettings() {
        if (!empty($_POST)) {
            foreach ($_POST as $key=>$val) {
                if (isset(self::$_options[$key])) {
                    update_option($key, $val);
                }
            }
        }
        foreach (self::$_options as $name => $option) {
            ?>
            <tr valign="top">
                <th scope="row"><?php echo $option['label']; ?></th>
                <td><?php
            switch ($option['type']) {
                case 'textarea':
                    ?>
                            <textarea name="<?php echo $name; ?>" cols="60" rows="4"><?php echo self::getOptionValue($option['default'], $name); ?></textarea>
                            <?php
                            break;
                        default:
                            ?>
                            <input type="text" size="60" name="<?php echo $name; ?>" value="<?php echo self::getOptionValue($option['default'], $name); ?>" />
                            <?php
                            break;
                    }
                    ?></td>
            </tr><?php
        }
    }

}
        ?>
