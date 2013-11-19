<?php

class CMInvitationWLM {
    const MENU_WLM = 'cm_invitationcodes_wlm_menu';
    const OPTION_INTEGRATE = 'cm_invitationcodes_wlm_integrate';
    const OPTION_DEFAULT_LEVEL = 'cm_invitationcodes_wlm_default_level';
    protected static $_wlmapi = null;

    public static function init() {
        add_action('admin_menu', array(get_class(), 'registerWLMPage'));
        add_action('cmic_custom_row_fields', array(get_class(), 'showRowField'), 1, 2);
        add_action('cmic_custom_add_form_fields', array(get_class(), 'showAddForm'), 1);
        add_action('cmic_custom_headers', array(get_class(), 'showHeader'), 1);
    }

    public static function isWLMInstalled() {
        if (empty(self::$_wlmapi) && class_exists('WLMAPI'))
            self::$_wlmapi = new WLMAPI();
        return!empty(self::$_wlmapi);
    }

    public static function getLevelsList() {
        $levels = array();
        if (self::isWLMInstalled()) {
            $levelsArray = self::$_wlmapi->GetLevels();
            foreach ($levelsArray as $key => $options) {
                $levels[$key] = $options['name'];
            }
        }
        return $levels;
    }

    public static function isIntegrated() {
        return (bool) get_option(self::OPTION_INTEGRATE, false) && self::isWLMInstalled();
    }

    public static function setIntegrated($value = false) {
        update_option(self::OPTION_INTEGRATE, $value);
    }

    public static function getDefaultLevel() {
        return get_option(self::OPTION_DEFAULT_LEVEL);
    }

    public static function setDefaultLevel($defaultLevel) {
        update_option(self::OPTION_DEFAULT_LEVEL, $defaultLevel);
    }

    public static function getLevelById($id) {
        $levels = self::getLevelsList();
        if (isset($levels[$id]))
            return $levels[$id];
        else
            return 'No level';
    }

    public static function registerWLMPage() {
        add_submenu_page(CMInvitationCodes::MENU_OPTION, 'CM Invitation Codes WishList Member Integration', 'WishList Member', 'manage_options', self::MENU_WLM, array(get_class(), 'displayWLMPage'));
    }

    public static function displayWLMPage() {
        if (!empty($_POST) && isset($_POST['cmic_integrate_wlm'])) {
            $toIntegrate = (bool) $_POST['cmic_integrate_wlm'];
            if (!self::isWLMInstalled() && $toIntegrate) {
                $messages[] = 'You need to have WishList Member installed to use this option! (http://member.wishlistproducts.com/)';
            } else {
                self::setIntegrated($toIntegrate);
            }
        }
        $integrate = self::isIntegrated();
        if ($integrate) {
            if (!empty($_POST) && isset($_POST['cmic_default_level'])) {
                self::setDefaultLevel($_POST['cmic_default_level']);
            }
        }
        $levels = self::getLevelsList();
        $defaultLevel = self::getDefaultLevel();
        ob_start();
        require CMIC_PATH . '/views/admin_wlm.php';
        $content = ob_get_contents();
        ob_end_clean();
        do_action('cmic_admin_page', $content);
    }

    /**
     * Shows activation link header in invitation codes panel
     */
    public static function showHeader() {
        if (self::isWLMInstalled() && self::isIntegrated())
            echo '<th scope="col">WLM Level</th>';
    }

    /**
     * Shows activation needed input in invitation codes panel
     */
    public static function showAddForm() {
        if (self::isWLMInstalled() && self::isIntegrated()) {
            echo '<strong>WLM Level:</strong>&nbsp
                            <select name="wlm[]" id="wlm[]" style="width: auto;">';
            foreach (self::getLevelsList() as $key => $val) {
                echo '<option value="' . $key . '"';
                if ($key == self::getDefaultLevel())
                    echo ' selected="selected"';
                echo '>' . $val . '</option>';
            }
            echo '                    </select>&nbsp;&nbsp;&nbsp;	    ';
        }
    }

    /**
     * Shows activation field in invitation codes panel
     */
    public static function showRowField($invitationCode, $excel = false) {
        if (self::isWLMInstalled() && self::isIntegrated()) {
            $txt = '<td>';
            if (!$excel) {
                $txt .= '<select name="wlm_' . $invitationCode->getCode() . '" id="wlm_' . $invitationCode->getCode() . '" style="width: auto;">';
                $txt .= '<option value="0">No level</option>';
                foreach (self::getLevelsList() as $key => $val) {
                    $txt.='<option value="' . $key . '" ';
                    if ($key == $invitationCode->getWLM())
                        $txt.=' selected="selected"';
                    $txt.='>' . $val . '</option>';
                }
                $txt.= '</select>';
            } else {
                $txt.= $invitationCode->getWLM();
            }
            $txt.= '</td>';
            echo $txt;
        }
    }

    public static function addUser($userId, $wlmLevel) {
        if (self::isWLMInstalled() && self::isIntegrated() && $wlmLevel != 0) {
            self::$_wlmapi->AddUserLevels($userId, array($wlmLevel));
        }
    }

    public static function setPending($userId) {
        if (self::isWLMInstalled() && self::isIntegrated()) {
            self::$_wlmapi->MakePending($userId);
        }
    }

    public static function setActive($userId) {
        if (self::isWLMInstalled() && self::isIntegrated()) {
            self::$_wlmapi->MakeActive($userId);
        }
    }

}

?>
