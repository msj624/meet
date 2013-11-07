<?php
/**
 * Wordspop Framework
 *
 * @category   Wordspop
 * @package    WPop_Migration
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 * @version    $Id:$
 */

/**
 * @category   Wordspop
 * @package    WPop_Migration
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 */
class WPop_Migration
{
    var $_migration = array();
    var $_required = false;

    function WPop_Migration()
    {
        $migration = WPOP_THEME_CONFIG . DS . 'migration.php';
        if (file_exists($migration)) {
            require_once $migration;
            if (isset($wpop_migration)) {
                $this->_migration = $wpop_migration;
                $this->_required = true;
            }
        }
    }
    
    function isRequired()
    {
        if (!$this->_required) {
            return false;
        }

        // Find the whether the previous theme settings available for import or not
        foreach ($this->_migration as $previously => $newly) {
            $value = get_option($previously);
            if ($value !== false) {
                // Found one option!
                return true;
            }
        }

        return false;
    }

    function migrate()
    {
        $theme = WPop_Theme::instance();

        // Imports the theme options
        $updated = false;
        foreach ($this->_migration as $previously => $newly) {
            $value = get_option($previously);
            if ($value !== false) {
                $res = $theme->saveOption($newly, $value);
                $updated = $res || $updated;
            }
        }

        if ($updated) {
            $theme->notification(__('Successfully migrated from previous version', 'wpop'));

            WPop::saveOption('migrated', true);
        }

        return $updated;
    }
}