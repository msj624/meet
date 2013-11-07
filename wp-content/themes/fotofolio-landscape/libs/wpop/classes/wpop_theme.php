<?php
/**
 * Wordspop Framework
 *
 * @category   Wordspop
 * @package    WPop_Theme
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 * @version    $Id:$
 */

/**
 * @see WPop_Utils
 */
require_once 'wpop_utils.php';

/**
 * @category   Wordspop
 * @package    WPop_Theme
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 */
class WPop_Theme
{
    var $_bundledOptions = array();
    
    /**
     * Theme meta data
     *
     * @var     array
     * @access  private
     */
    var $_meta;

    /**
     * Theme ID
     *
     * @var     string
     * @access  private
     */
    var $_id;

    /**
     * Theme slug
     *
     * @var     string
     * @access  private
     */
    var $_slug;

    /**
     * Theme options
     *
     * References to $GLOBALS['wpop_options']
     *
     * @access  private
     */
    var $_options = array();
    
    /**
     * Notification
     *
     * @var     string
     * @access  private
     */
    var $_notification = '';
    
    /**
     * Initialition flag
     *
     * @var     bool
     * @access  private
     */
    var $_initialized = false;

    /**
     * Widgets list
     *
     * @var     array
     * @access  private
     */
    var $_widgets = array();
  
    /**
     * Hooks
     *
     * @var     array
     * @access  private
     */
    var $_hooks = array();

    /**
     * Constructor
     *
     * @access  public
     */
    function WPop_Theme()
    {
        $this->_meta = self::_getMeta();
        $this->_slug = WPop_Utils::idtify($this->_meta['Name']);
        $this->_id = 'wpop_' . $this->_slug;

        load_theme_textdomain($this->_slug, WPOP_THEME_LANGUAGES);

        // Load bundled options
        include_once WPOP_BUNDLED . DS . 'options.php';
        $this->_bundledOptions = $wpop_bundled_options;

        // Load theme options
        $options = WPOP_THEME_CONFIG . DS . 'options.php';
        if (file_exists($options)) {
            include_once $options;
            $this->_options = &$wpop_options;
        }

        // Load theme widgets
        $widgets = WPOP_THEME_CONFIG . DS . 'widgets.php';
        if (file_exists($widgets)) {
            include_once $widgets;
            $this->_widgets = &$wpop_widgets;
        }

        // Load theme hooks
        $hooks = WPOP_THEME_CONFIG . DS . 'hooks.php';
        if (file_exists($hooks)) {
            include_once $hooks;
            $this->_hooks = &$wpop_hooks;
        }

        // Call the initialization function
        $this->_init();
    }
    
    /**
     * Get theme meta data
     * 
     * @access  private
     * @return  array
     */
    function _getMeta()
    {
        $headers = array(
            'Name'        => 'Theme Name',
            'URI'         => 'Theme URI',
            'Description' => 'Description',
            'Author'      => 'Author',
            'AuthorURI'   => 'Author URI',
            'Version'     => 'Version',
            'Template'    => 'Template',
            'Status'      => 'Status',
            'Tags'        => 'Tags',
            'Notice'      => 'Notice'
        );
        
        return get_file_data(TEMPLATEPATH . '/style.css', $headers, 'theme');
    }

    /**
     * Get this object instance
     *
     * @return  WPop_Theme
     * @access  public
     * @static
     */
    function instance()
    {
        if (!isset($GLOBALS['wpop_theme']) || !is_object($GLOBALS['wpop_theme']) || !is_a($GLOBALS['wpop_theme'], 'wpop_theme')) {
            $GLOBALS['wpop_theme'] = new WPop_Theme;
        }
        
        return $GLOBALS['wpop_theme'];
    }

    /**
     * Get theme meta data
     *
     * @param   string  $key (optional) Meta key name
     * @return  mixed   An array if no key given, a string if key found otherwise FALSE
     * @access  public
     */
    function meta($key = null)
    {
        if (is_string($key)) {
            if (array_key_exists($key, $this->_meta)) {
                return $this->_meta[$key];
            } else {
                return false;
            }

        }

        return $this->_meta;
    }

    /**
     * Get theme name
     *
     * Shortcuts function to WPop_Theme::meta('Name')
     *
     * @return  mixed
     * @access  public
     */
    function name()
    {
        return $this->meta('Name');
    }

    /**
     * Get theme title
     *
     * Shortcuts function to WPop_Theme::meta('Title')
     *
     * @return mixed
     * @access public
     */
    function title()
    {
        return $this->meta('Title');
    }

    /**
     * Get theme description
     *
     * Shortcuts function to WPop_Theme::meta('Description)
     *
     * @return  mixed
     * @access  public
     */
    function description() {
        return $this->meta('Description');
    }

    /**
     * Get theme author
     *
     * Shortcuts function to WPop_Theme::meta('Author')
     *
     * @return  mixed
     * @access  public
     */
    function author()
    {
        return $this->meta('Author');
    }

    /**
     * Get theme version
     *
     * Shortcuts function to WPop_Theme::meta('Version')
     *
     * @return  mixed
     * @access  public
     */
    function version()
    {
        return $this->meta('Version');
    }

    /**
     * Get theme parent name (if any)
     *
     * Shortcuts function to WPop_Theme::meta('Template')
     *
     * @return  mixed
     * @access  public
     */
    function template()
    {
        return $this->meta('Template');
    }

    /**
     * Get theme status
     *
     * Shortcuts function to WPop_Theme::meta('Status')
     *
     * @return  mixed
     * @access  public
     */
    function status()
    {
        return $this->meta('Status');
    }
    
    /**
     * Get theme notice
     *
     * Shortcuts to WPop_Theme::meta('Notice')
     *
     * @return  mixed
     * @access  public
     */
    function notice()
    {
        return $this->meta('Notice');
    }

    /**
     * Get theme slug
     *
     * @return  string
     * @access  public
     */
    function slug()
    {
        return $this->_slug;
    }

    /**
     * Get theme ID
     *
     * @return  string
     * @access  public
     */
    function id()
    {
        return $this->_id;
    }

    /**
     * Get theme options
     *
     * @return  array
     * @access  public
     */
    function options()
    {
        return $this->_options;
    }
    
    /**
     * Get theme widget(s)
     *
     * @return  array
     * @access  public
     */
    function widgets($id = null)
    {
        if (is_string($id) && array_key_exists($id, $this->_widgets)) {
            return $this->_widgets[$id];
        }
        
        return $this->_widgets;
    }

    /**
     * Set noticiation
     */
    function notification($message = null)
    {
        if (is_string($message)) {
            $this->_notification = $message;
        }

        return $this->_notification;
    }

    /**
     * Theme initialization
     *
     * @access private
     */
    function _init()
    {
        if ($this->_initialized) {
            return;
        }

        $this->_addBundledOptions();

        // Register theme framework hooks
        add_action('admin_init', array($this, 'prepareOptions'));
        add_action('wp_ajax_wpop_theme_save_options', array($this, 'saveOptions'));
        add_action('widgets_init', array($this, 'registerWidgets'));
        add_action('wp_head', array($this, 'addHeader'));
        add_action('wp_footer', array($this, 'addFooter'));
        
        if (current_theme_supports('webfont') && !is_admin()) {
            //wp_enqueue_script('webfont_loader', WPOP_ASSETS . '/js/webfont-loader.js', false, false, true);
        }

        if (is_dir(WPOP_THEME_FUNCTIONS)) {
            // Load the function files automatically
            $files = WPop_Utils::getFiles(WPOP_THEME_FUNCTIONS, array('php'));
            foreach ($files as $file) {
                include_once $file;
            }
        }

        // Register curent theme hooks
        foreach ($this->_hooks as $action => $function) {
            if (function_exists($function)) {
                add_action($action, $function);
            }
        }

        // Set initialization flag
        $this->_initialized = true;
    }

    /**
     * Add bundled options
     *
     * @access private
     */
    function _addBundledOptions()
    {
        foreach ($this->_options as $i => $option) {
            $options = $this->_getBundledOptions($option['type'], $option);

            // Add the theme support and register the hook(s) if needed
            switch ($option['type']) {
                case 'header':
                    add_theme_support('custom-header');
                    break;

                case 'footer':
                    add_theme_support('custom-footer');
                    break;
                    
                case 'styling':
                    add_theme_support('custom-style');
                    break;
                    
                case 'slideshow':
                    add_theme_support('slideshow');
                    break;
                
                case 'typography':
                    add_theme_support('custom-typography');
                    break;
            }

            if (is_array($options)) {
                array_splice($this->_options, $i, 1, $options);
            }
        }
    }
    
    /**
     * Get bundled options per section
     *
     * @param string $section Section name
     * @param array $info Options
     * @return mixed An array if section options found otherwise FALSE
     */
    function _getBundledOptions($section, $info)
    {
        if (!isset($this->_bundledOptions[$section])) {
            return false;
        }
        
        $options = array();
        foreach ($this->_bundledOptions[$section] as $i => $option) {
            if (isset($info['excepts']) && !in_array($option['name'], $info['excepts'])) {
                $options[$i] = $option;
                if (isset($info['std']) && array_key_exists($option['name'], $info['std'])) {
                    $options[$i]['std'] = $info['std'][$option['name']];
                }
            } else if (!isset($info['excepts'])) {
                $options[$i] = $option;
            }
        }
        

        return $options;
    }

    /**
     * Hook: admin_init
     *
     * Prepare the options
     *
     * @access public
     */
    function prepareOptions()
    {
        foreach ($this->_options as $option) {
            if ($option['type'] != 'heading') {
                if (get_option("wpop_theme_{$option['name']}", false) === false) {
                    $this->saveOption($option['name'], isset($option['std']) ? $option['std'] : '');
                }
            }
        }
    }

    /**
     * Display theme settings page.
     *
     * @access public
     */
    function displaySettings()
    {
        require_once 'wpop.php';
        WPop::call('wpop_theme_settings', $this);
    }

    /**
     * Hook: widgets_init
     *
     * Register current distributed theme widgets.
     *
     * @access public
     */
    function registerWidgets()
    {
        foreach ($this->_widgets as $widget => $params) {
            $classname = "{$widget}_widget";
            include_once WPOP_THEME_WIDGETS . DS . $widget . '.php';
            if (class_exists($classname)) {
                register_widget($classname);
            }
            
        }
    }

    /**
     * Hook: wp_ajax_wpop_theme_save_options
     *
     * @access public
     * @see WPop_Theme::normalize()
     */
    function saveOptions()
    {
        $data = array();
        if (!empty($_POST)) {
            parse_str($_POST['data'], $data);
            $data = $this->_normalizeOptions($data);
        }

        $updated = false;
        foreach ($data as $option => $value) {
            $res = $this->saveOption($option, $value);
            $updated = $updated || $res;
        }


        if ($updated) {
            $message = array(
                'type' => 'succeed',
                'text' => 'Options has been saved successfully'
            );
        } else {
            $message = array(
                'type' => 'error',
                'text' => 'No option changed, update canceled'
            );
        }

        echo json_encode($message);
        exit;
    }

    /**
     * Normalize post data
     *
     * Rewrite the value for saving into database according the data type
     *
     * @param $post array Post data
     * @access private
     * @return array
     */
    function _normalizeOptions($post)
    {
        $res = array();
        foreach ($this->_options as $option) {
            $value = isset($option['std']) ? $option['std'] : '';

            if ($option['type'] == 'checkbox') {
                if (array_key_exists("wpop_theme_{$option['name']}", $post)) {
                    $res[$option['name']] = 1;
                } else {
                    $res[$option['name']] = 0;
                }
            } else if (array_key_exists("wpop_theme_{$option['name']}", $post)) {
                $value = $post["wpop_theme_{$option['name']}"];
                switch ($option['type']) {
                    case 'date':
                        $time = mktime(0, 0, 0, $value['month'], $value['day'], $value['year']);
                        $res[$option['name']] = date('Y/m/d', $time);
                        break;
                    case 'checkbox':
                        $res[$option['name']] = (bool) $value;
                        break;
                    case 'character':
                        $res[$option['name']] = serialize($value);
                        break;
                    default:
                        $res[$option['name']] = $value;
                        break;
                }
            }
        }

        return $res;
    }

    /**
     * Save option
     *
     * @param   string  $name Option name
     * @param   mixed   $value Option value
     * @return  bool
     * @access  public
     */
    function saveOption($name, $value)
    {
        return update_option("wpop_theme_{$name}", stripslashes($value));
    }

    /**
     * Get theme option value
     *
     * Attempt to retrieve value from database or return default if not exists.
     *
     * @param   string  $name  Option name
     * @return  mixed
     * @access  public
     * @static
     */
    function getOption($name)
    {
        if (isset($this)) {
            $theme = $this;
        } else {
            $theme = WPop_Theme::instance();
        }

        $res = get_option("wpop_theme_{$name}");

        if ($res === false) {
            $options = $theme->options();
            foreach ($options as $option) {
                if ($option['name'] == $name && isset($option['std'])) {
                    return $option['std'];
                }
            }
        }

        return $res;
    }

    /**
     * Get custom header
     *
     * @return string
     * @access private
     */
    function _customHeader()
    {
        return $this->getOption('header_extras');
    }

    /**
     * Get custom footer
     *
     * @return string
     * @access private
     */
    function _customFooter()
    {
        $retval = '';

        $extras = $this->getOption('footer_extras');
        if ($extras) {
            $retval = $extras;
        }

        $tracking = $this->getOption('tracking_code');
        if ($tracking) {
            $retval .= $tracking;
        }
        
        return $retval;
    }

    /**
     * Get custom styling
     *
     * @return string
     * @access private
     */
    function _customStyle()
    {
        if (!$this->getOption('styling_enable')) {
            return false;
        }

        $custom_css = $this->getOption('custom_css');
        $link_color = $this->getOption('link_color');
        $link_hover_color = $this->getOption('link_hover_color');
        $background_color = $this->getOption('background_color');
        $background_image = $this->getOption('background_image');
        $background_repeat = $this->getOption('background_repeat');
        $background_position = $this->getOption('background_position');

        $css = '';
        if ($link_color) {
            $css .= "a { color: {$link_color}; }\n";
        }
        if ($link_hover_color) {
            $css .= "a:hover { color: {$link_hover_color}; }\n";
        }
        
        if ($background_color || $background_image || $background_repeat || $background_position) {
            $css .= 'body {';
            if ($background_color) {
                $css .= "background-color: {$background_color};";
            }
            if ($background_image) {
                $css .= "background-image: url({$background_image});";
            }
            if ($background_repeat) {
                $css .= "background-repeat: {$background_repeat};";
            }
            if ($background_position) {
                $css .= "background-position: {$background_position};";
            }
            $css .= '}' . "\n";
        }

        return $css;
    }
    
    /**
     * Get custom typography css
     *
     * @return string
     * @access private
     */
    function _customTypography()
    {
        return $this->_getTypographyCSS('h1', @unserialize($this->getOption('h1'))) .
               $this->_getTypographyCSS('h2', @unserialize($this->getOption('h2'))) .
               $this->_getTypographyCSS('h3', @unserialize($this->getOption('h3'))) .
               $this->_getTypographyCSS('h4', @unserialize($this->getOption('h5'))) .
               $this->_getTypographyCSS('h5', @unserialize($this->getOption('h5'))) .
               $this->_getTypographyCSS('p', @unserialize($this->getOption('p'))) .
               $this->_getTypographyCSS('blockquote', @unserialize($this->getOption('blockquote'))) .
               $this->_getTypographyCSS('ul', @unserialize($this->getOption('ul')));
    }
    
    /**
     * Get typography css
     *
     * @return string
     * @access private
     */
    function _getTypographyCSS($selector, $options)
    {
        if (!is_array($options) || !$options['enable']) {
            return false;
        }
        
        if (self::_isWebFont($options['font'])) {
            $res = $this->_addWebFont($options['font']);
            if (!$res) {
                return false;
            }
            $options['font'] = $res;
        }

        $css = "{$selector} {\n" .
               "font-family: {$options['font']};\n" .
               "font-size: {$options['size']}{$options['unit']};\n";
        
        switch ($option['style']) {
            case 'normal':
                $css .= 'font-weight: normal;' . "\n" .
                        'font-style: normal;' . "\n";
                break;
            case 'bold':
                $css .= 'font-weight: bold;' . "\n" .
                        'font-style: normal;' . "\n";
                break;
            case 'italic':
                $css .= 'font-weight: normal;' . "\n" .
                        'font-style: italic;' . "\n";
                break;
            case 'bold italic':
                $css .= 'font-weight: bold;' . "\n" .
                        'font-style: italic;' . "\n";
        }
        
        if (!empty($options['color'])) {
            $css .= "color: {$options['color']};\n";
        }
        
        $css .= '}' . "\n";

        return $css;
    }
    
    /**
     * Find the whether font is a webfont or not
     *
     * @return bool
     * @access private
     */
    function _isWebFont($font)
    {
        if (($pos = strpos($font, ':')) !== false) {
            return true;
        }
        
        return false;
    }

    /**
     * Add webfont to the list for loading
     *
     * @access private
     */
    function _addWebFont($font)
    {
        if (!preg_match('/(\w+):\s+("*([\w\s]+)"*(,|$).*)/', $font, $matches)) {
            return false;
        }

        $this->_webFonts[$matches[1]][] = $matches[3];
        return $matches[2];
    }

    /**
     * Hook: wp_head
     *
     * Add the custom generated header
     *
     * @access public
     */
    function addHeader()
    {
        $custom_header = '';
        $custom_style = '';
        $custom_typography = '';

        if (current_theme_supports('custom-header')) {
            $custom_header = $this->_customHeader();
        }
        
        if (current_theme_supports('custom-style')) {
            $custom_style = $this->_customStyle();
        }
        
        if (current_theme_supports('custom-typography')) {
            $custom_typography = $this->_customTypography();

            if (!empty($this->_webFonts)) {
                echo '<script type="text/javascript">' . "\n";
                echo 'WebFontConfig = {';
                $i = 0;
                foreach ($this->_webFonts as $provider => $fonts) {
                    echo "{$provider}: {";
                    switch ($provider) {
                        case 'google':
                          echo 'families: [ \'' .implode('\',\'', $fonts) . '\' ]';
                          break;
                    }
                    echo '}' . ($i < count($this->_webFonts) - 1 ? ',' : '');
                    $i++;
                }
                echo '};' . "\n";
                echo '</script>'. "\n";
            }
        }
        
        if ($custom_header) {
            echo $custom_header;
        }
        
        if ($custom_style || $custom_typography) {
            echo '<style type="text/css">' . "\n" .
                 $custom_style .
                 $custom_typography .
                 '</style>' . "\n";
        }
    }
    
    /**
     * Hook: wp_footer
     *
     * Add custom generated footer
     *
     * @access public
     */
    function addFooter()
    {
        $custom_footer = '';
        if (current_theme_supports('custom-footer')) {
            $custom_footer = $this->_customFooter();
        }
        
        if ($custom_footer) {
            echo $custom_footer;
        }
    }
}
?>