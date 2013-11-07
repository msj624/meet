<?php
/**
 * Wordspop Framework
 *
 * @category   Wordspop
 * @package    WPop
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 * @version    $Id:$
 */

/**
 * @see WPop_Theme
 */
require_once 'wpop_theme.php';

/**
 * @see WPop_Migration
 */
require_once 'wpop_migration.php';

/**
 * @see WPop_Widget
 */
require_once 'wpop_widget.php';

/**
 * @category   Wordspop
 * @package    WPop
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 */
class WPop
{
    /**
     * Initialization
     *
     * @access  public
     * @static
     */
    function init()
    {
        load_textdomain('wpop', WPOP_LANGUAGES . DS . get_locale() . '.mo');

        if (is_admin()) {
            add_action('init', array('WPop', 'setup'));
        }
        
        add_action('admin_init', array('WPop', 'loadAssets'));
        add_action('admin_menu', array('WPop', 'createMenu'));

        $migration = new WPop_Migration;
        if (!self::getOption('migrated') && $migration->isRequired()) {
            add_action('admin_init', array($migration, 'migrate'));
        }

        $theme = WPop_Theme::instance();
    }

    /**
     * Get option
     *
     * @param   string  $name                 Option name
     * @param   mixed   $default  (optional)  Default value
     * @return  mixed
     * @access  public
     * @static
     */
    function getOption($name, $default = false)
    {
        return get_option("wpop_{$name}", $default);
    }
    
    /**
     * Save the option
     * 
     * @access  public
     * @param   mixed   $name   Option name
     * @param   mixed   $value  Value
     * @return  bool
     * @static
     */
    function saveOption($name, $value)
    {
        return update_option("wpop_{$name}", stripslashes($value));
    }
    
    /**
     * Setup routine
     * 
     * @access  public
     * @static
     */
    function setup()
    {
        // Register new post type
        register_post_type('wpopframework', array(
            'labels'            => array(
                'name' => 'Wordspop Internal'
            ),
            'public'            => true,
            'show_ui'           => false,
            'rewrite'           => false,
            'supports'          => array('title', 'editor'),
            'query_var'         => false,
            'show_in_nav_menus' => false
        ));
    }
    
    /**
     * Get dummy post.
     *
     * Dummy post needed for attachement upload. A dummy post will be create if nothing found.
     *
     * @access  public
     * @return  integer
     * @static
     */
    function getDummyPost()
    {
        global $wpdb;

        $params = array(
            'post_type'       => 'wpopframework',
            'post_name'       => 'wpop-dummy',
        );

        $query = "SELECT ID FROM {$wpdb->posts} WHERE post_parent = 0";
        foreach ($params as $column => $value) {
            $query .= " AND {$column} = '{$value}'";
        }
        $query .= ' LIMIT 1';

        $post = $wpdb->get_row($query);
        if (count($post)) {
            return $post->ID;
        }

        $params['post_status'] = 'draft';
        $params['comment_status'] = 'closed';
        $params['ping_status'] = 'closed';
        $params['post_title'] = 'WORDSPOP DUMMY POST';
        return wp_insert_post($params);
    }

    /**
     * Call a callback
     *
     * Safely call a callback which is automatically load the script if needed and call function if exists.
     *
     * @param   string  $callback A string of function name or a callback
     * @return  mixed
     * @access  public
     * @static
     */
    function call($callback)
    {
        // only accept callback and string value
        if (!is_callable($callback) && !is_string($callback)) {
            wp_die('Invalid paramater for WPop::callback()', 'WPop');
        }

        if (!function_exists($callback)) {
            if (!file_exists(WPOP_THEME_FUNCTIONS . DS . $callback . '.php')) {
                if (!file_exists(WPOP_FUNCTIONS . DS . $callback . '.php')) {
                    // Gave up, no such callback!
                    wp_die('Callback "' . $callback . '" not found');
                } else {
                    // Found in theme functions directory
                    require_once WPOP_FUNCTIONS. DS . $callback . '.php';
                }
            } else {
                // Found in framework function directory
                require_once WPOP_THEME_FUNCTIONS . DS . $callback . '.php';
            }
        }

        // Get the arguments except the callback
        $args = func_get_args();
        array_shift($args);

        return call_user_func_array($callback, $args);
    }

    /**
     * Hook: admin_init
     *
     * Load the assets needed for admin interface setup.
     *
     * @access  public
     * @static
     */
    function loadAssets()
    {
        if (!is_admin()) {
            return false;
        }

        // Thickbox
        wp_enqueue_style('thickbox');

        // Wordspop admin
        wp_enqueue_style('wpop', WPOP_ASSETS . '/wpop.css');
        
        // Media uploader
        wp_enqueue_script('media-upload');
        
        // Thickbox
        wp_enqueue_script('thickbox');
        
        // Colorpicker
        wp_enqueue_script('jquery_colorpicker', WPOP_ASSETS . '/js/colorpicker.min.js', array('jquery'));
        
        // Wordspop
        wp_enqueue_script('wpop', WPOP_ASSETS . '/wpop.js', array('jquery', 'jquery_colorpicker'));
    }

    /**
     * Hook: admin_menu
     *
     * Creates the admin menu.
     *
     * @access public
     * @static
     */
    function createMenu()
    {
        global $menu;
        
        //if( !current_theme_supports('genesis-admin-menu') ) return;

        // Get theme object instance
        $theme = WPop_Theme::instance();

        // Create a new separator
        if (version_compare(get_bloginfo('version'), '2.9', '>=')) {
            $menu['58.995'] = array( '', 'manage_options', 'separator-wpop', '', 'wp-menu-separator' );
        }

        // Theme top level menu
        add_menu_page('Wordspop', $theme->name(), 'manage_options', $theme->slug(), array($theme, 'displaySettings'), WPOP_ASSETS . '/images/wpop-icon-edit.png', '58.996');

        // Theme settings submenu
        add_submenu_page($theme->slug(), $theme->name() . ' ' . __('Settings', 'wpop'), __('Settings', 'wpop'), 'manage_options', $theme->slug());

        // Mobile settings
        if (current_theme_supports('mobile')) {
            add_submenu_page($theme->slug(), __('Mobile', 'wpop'), __('Mobile', 'wpop'), 'manage_options', $theme->slug() . '_mobile', array($theme, 'displaySettings'));
        }

        // Theme update
        #add_submenu_page($theme->slug(), $theme->name() . ' Update' . 'Import/Export', 'Update', 'manage_options', $theme->slug() . '_update', array($theme, 'displaySettings'));

        // Wordspop top level menu
        add_menu_page ('Wordspop', 'Wordspop', 'manage_options', 'wpop', array('WPop', 'availableThemes'), WPOP_ASSETS . '/images/wpop-icon.png', '58.999');

        // Wordspop themes
        add_submenu_page('wpop', 'Wordspop ' .  __('Themes', 'wpop'), __('Themes', 'wpop'), 'manage_options', 'wpop');
    }
    
    function availableThemes()
    {
        self::call('wpop_themes');
    }
}
?>