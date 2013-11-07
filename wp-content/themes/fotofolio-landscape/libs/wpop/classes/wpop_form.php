<?php
require_once 'wpop_utils.php';

$GLOBALS['wpop_fonts'] = array(
    'Arial, sans-serif' => 'Arial',
    '"Arial Black", sans-serif' => 'Arial Black',
    'Calibri, Candara, Segoe, Optima, sans-serif' => 'Calibri',
    '"Gill Sans", "Gill Sans MT", Calibri, sans-serif' => 'Gill Sans',
    'Geneva, Tahoma, Verdana, sans-serif' => 'Geneva',
    'Georgia, serif' => 'Georgia',
    '"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica',
    'Impact, Charcoal, sans-serif' => 'Impact',
    '"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", sans-serif' => 'Lucida Grande',
    '"Myriad Pro", Myriad, sans-serif' => 'Myriad Pro',
    'Tahoma, Geneva, Verdana, sans-serif' => 'Tahoma',
    '"Times New Roman", serif' => 'Times New Roman',
    '"Trebuchet MS", Tahoma, sans-serif' => 'Trebuchet',
    'Palatino, "Palatino Linotype", serif' => 'Palatino',
    'Verdana, Geneva, sans-serif' => 'Verdana',
    '' => '-- Google Font --',
    'google: "Droid Sans", Arial, serif' => 'Droid Sans',
    'google: "Droid Serif", Arial, serif' => 'Droid Serif',
    'google: Lobser, Arial, serif' => 'Lobser',
    'google: "Yanone Kaffeesatz", Arial, serif' => 'Yanone Kaffeesatz',
    'google: Nobile, Arial, serif' => 'Nobile',
    'google: "Reenie Beanie", Arial, serif' => 'Reenie Beanie',
    'google: Tangerine, Arial, serif' => 'Tangerine',
    'google: "Josefin Slab", Arial, serif' => 'Josefin Slab',
    'google: Neucha, Arial, serif' => 'Neucha',
    'google: Molengo, Arial, serif' => 'Molengo',
    'google: "OFL Sorts Mill Goudy TT", Arial, serif' => 'OFL Sorts Mill Goudy TT',
    'google: Vollkorn, Arial, serif' => 'Vollkorn',
    'google: "PT Sans", Arial, serif' => 'PT Sans',
    'google: Ubuntu, Arial, serif' => 'Ubuntu',
    'google: Cantarell, Arial, serif' => 'Cantarell',
    'google: Inconsolata, Arial, serif' => 'Inconsolata',
    'google: "Just Me Again Down Here", Arial, serif' => 'Just Me Again Down Here',
    'google: "Crimson Text", Arial, serif' => 'Crimson Text',
    'google: Cardo, Arial, serif' => 'Cardon',
    'google: Cuprum, Arial, serif' => 'Cuprum',
    'google: Neuton, Arial, serif' => 'Neuton',
    'google: Philosopher, Arial, serif' => 'Philosopher',
    'google: "Josefin Sans", Arial, serif' => 'Josefin Sans',
    'google: "Old Standard TT", Arial, serif' => 'Old Standard TT',
    'google: Arvo, Arial, serif' => 'Arvo',
    'google: "IM Fell", Arial, serif' => 'IM Fell',
    'google: Arimo, Arial, serif' => 'Arimo',
    'google: Allerta, Arial, serif' => 'Allerta',
    'google: "Just Another Hand", Arial, serif' => 'Just Another Hand',
    'google: Raleway, Arial, serif' => 'Raleway',
    'google: Kristi, Arial, serif' => 'Kristi',
    'google: "Covered By Your Grace", Arial, serif' => 'Covered By Your Grace',
    'google: "Mountains of Christmas", Arial, serif' => 'Mountains of Christmas',
    'google: Tinos, Arial, serif' => 'Tinos',
    'google: Copse, Arial, serif' => 'Copse',
    'google: Puritan, Arial, serif' => 'Puritan',
    'google: Kristi, Arial, serif' => 'Kristi',
    'google: Cabin, Arial, serif' => 'Cabin',
    'google: Sniglet, Arial, serif' => 'Sniglet',
    'google: Allan, Arial, serif' => 'Allan',
    'google: Lato, Arial, serif' => 'Lato',
    'google: Orbitron, Arial, serif' => 'Orbitron',
    'google: Vibur, Arial, serif' => 'Vibur',
    'google: "Allerta Stencil", Arial, serif' => 'Allerta Stencil',
    'google: Gruppo, Arial, serif' => 'Gruppo',
    'google: Cousine, Arial, serif' => 'Cousine',
    'google: Syncopate, Arial, serif' => 'Syncopate',
    'google: Merriweather, Arial, serif' => 'Merriweather',
    'google: "Anonymous Pro", Arial, serif' => 'Anonymous Pro',
    'google: Coda, Arial, serif' => 'Coda',
    'google: Corben, Arial, serif' => 'Corben',
    'google: Bentham, Arial, serif' => 'Bentham',
    'google: Buda, Arial, serif' => 'Buda',
    'google: Lekton, Arial, serif' => 'Lekton',
    'google: UnifrakturCook, Arial, serif' => 'UnifrakturCook',
    'google: Kenia, Arial, serif' => 'Kenia'
);

class WPop_Form
{
    function text($name, $option, $value = null)
    {
        return sprintf('<input type="text" id="%1$s" name="%2$s" value="%3$s" %4$s />', self::_id($name, $option), $name, $value, self::_attributes($option));
    }
    
    function textarea($name, $option, $value = null)
    {
        return sprintf('<textarea id="%1$s" name="%2$s" %4$s>%3$s</textarea>', self::_id($name, $option), $name, $value, self::_attributes($option));
    }
    
    function select($name, $option, $value = null)
    {
        $html = sprintf('<select id="%1$s" name="%2$s">' . "\n", self::_id($name, $option), $name);
        $current = $value;
        $options = self::_options($option['options']);
        $html .= self::options($options, $current);
        $html .= '</select>' . "\n";

        return $html;
    }
    
    function options($options, $current)
    {
        $html = '';
        foreach ($options as $value => $caption) {
            $selected = '';
            if ($value == $current) {
                $selected = ' selected="selected"';
            }

            $html .= sprintf('<option value="%1$s"%3$s>%2$s</option>' . "\n", htmlspecialchars($value), htmlspecialchars($caption), $selected);
        }
        return $html;
    }
    
    function checkbox($name, $option, $value = null)
    {
        $checked = '';
        if (!empty($value)) {
            $checked = ' checked="checked"';
        }
        return sprintf('<input type="checkbox" id="%1$s" name="%2$s" value="1"%4$s /><label for="%1$s">%3$s</label>', self::_id($name, $option), $name, $option['desc'], $checked);
    }

    function radio($name, $option, $value = null)
    {
        $html = '';
        $options = self::_options($option['options']);
        foreach ($options as $val => $caption) {
            $checked = '';
            if ($val == $value) {
                $checked = ' checked="checked"';
            }
  
            $class = '';
            if (isset($option['align']) && $option['align'] == 'vertical') {
                $class = ' class="vertical"';
            }
            $html .= sprintf('<span%6$s><input type="radio" id="%1$s" name="%2$s" value="%3$s"%5$s /><label for="%1$s">%4$s</label></span>', WPop_Utils::idtify("{$name}_{$value}"), $name, $val, $caption, $checked, $class);
        }

        return $html;
    }

    function color($name, $option, $value = null)
    {
        $color = '';
        if ($value) {
            $color = sprintf(' style="background-color: %s;"', $value);
        }

        $html = sprintf('<div id="%s_picker" class="wpop_colorpicker"><div%s></div></div>', self::_id($name, $option), $color);
        $html .= sprintf('<input type="text" id="%1$s" name="%2$s" value="%3$s" class="wpop_color" />', self::_id($name, $option), $name, $value);
        return $html;
    }

    function upload($name, $option, $value = null)
    {
        $img = '';
        if ($value) {
          if (WPop_Utils::attachmentExists($value)) {
              $img = sprintf('<div><a href="%1$s" title="View full size" class="upload_fullsize" target="_blank"><img src="%1$s" /></a><a href="#" class="upload_remove" title="Remove">Remove</a></div>', $value);
          } else {
              $img = '<div class="wpop_filenotfound">File not found</div>';
          }
        }

        $html = sprintf('<input type="text" id="%1$s" name="%2$s" value="%3$s" class="upload" />', self::_id($name, $option), $name, $value);
        $html .= sprintf('<input type="button" id="%s_upload" class="button upload_button" value="Upload" />', self::_id($name, $option));
        $html .= sprintf('<div id="%s_preview" class="upload_preview">%s</div>', self::_id($name, $option), $img);
        return $html;
    }
    
    function date($name, $option)
    {
        $date = array(
            'month' => date('n'),
            'day'   => date('j'),
            'year'  => date('Y')
        );

        if ($value) {
            $time = strtotime($value);
            $date['month'] = date('n', $time);
            $date['day'] = date('j');
            $date['year'] = date('Y');
        }

        $html = sprintf('<select class="date_month" id="%1$s[month]" name="%2$s[month]">%3$s</select>', self::_id($name, $option), $name, self::options(WPop::call('wpop_months_options'), $date['month']));
        $html .= sprintf('<select class="date_day" id="%1$s[day]" name="%2$s[day]">%3$s</select>', self::_id($name, $option), $name, self::options(WPop::call('wpop_days_options'), $date['day']));
        $html .= sprintf('<input type="text" id="%1$s[year]" name="%2$s[year]" class="date_year" maxlength="4" value="%3$s" />', self::_id($name, $option), $name, $date['year']);
        return $html;
    }
    
    function character($name, $option, $value)
    {
        $id = self::_id($name, $option);
        $sizes = array();
        for ($i = 9; $i <= 70; $i++) {
          $sizes[$i] = $i;
        }

        $color = '';
        if ($value['color']) {
            $color = sprintf(' style="background-color: %s;"', $value['color']);
        }
        
        $checked = '';
        if ($value['enable']) {
            $checked = ' checked="checked"';
        }

        $html = sprintf('<select id="%s_font" name="%s[font]" class="character_font">' . "\n" . '%s</select>' . "\n", $id, $name, self::options($GLOBALS['wpop_fonts'], $value['font']));
        $html .= sprintf('<select id="%s_size" name="%s[size]" class="character_size">' . "\n" . '%s</select>' . "\n", $id, $name, self::options($sizes, $value['size']));
        $html .= sprintf('<select id="%s_unit" name="%s[unit]" class="character_unit">' . "\n" . '%s</select>' . "\n", $id, $name, self::options(array('px' => 'px', 'em' => 'em'), $value['unit']));
        $html .= sprintf('<select id="%s_style" name="%s[style]" class="character_style">' . "\n" . '%s</select>' . "\n", $id, $name, self::options(array('normal' => 'Normal', 'bold' => 'Bold', 'italic' => 'Italic', 'bold italic' => 'Bold Italic'), $value['style']));
        $html .= sprintf('<div id="%s_picker" class="wpop_colorpicker"><div%s></div></div>', $id, $color);
        $html .= sprintf('<input type="text" id="%s_color" name="%s[color]" value="%s" class="character_color" />', $id, $name, $value['color']);
        $html .= sprintf('<input type="checkbox" id="%1$s_enable" name="%2$s[enable]" class="character_enable"%3$s /><label for="%1$s_enable">Enable</label>', $id, $name, $checked);

        return $html;
    }

    function _value($name, $option)
    {
        $value = '';
        if (trim(get_option($name)) != '') {
            $value = get_option($name);
        } else if (array_key_exists('std', $option)) {
            $value = $option['std']; 
        }
        
        return $value;
    }
    
    function _attributes($option)
    {
        if (!array_key_exists('attrs', $option)) {
            return '';
        }

        if (!is_array($option['attrs'])) {
            return $option['attrs'];
        }
        
        $html = '';
        foreach ($option['attrs'] as $name => $value) {
            $html .= "{$name}=\"{$value}\"";
        }

        return $html;
    }
    
    function _options($options)
    {
        if (is_array($options)) {
            return $options;
        } else if (is_string($options) || is_callable($options)) {
            require_once 'wpop.php';
            $res = WPop::call($options);

            // Make the returns is an array
            settype($res, 'array');
            return $res;
        } else {
            wp_die('Invalid options');
        }
    }
    
    function _id($name, $option)
    {
        $id = $name;
        if (isset($option['id'])) {
            $id = $option['id'];
        }
        
        return $id;
    }
    
    function input($name, $option, $value = null)
    {
        if ($value === null) {
          $value = self::_value($name, $option);
        }

        switch ( $option['type'] ) {
            case 'text':
                return self::text($name, $option, $value);
                break;
            case 'textarea':
                return self::textarea($name, $option, $value);
                break;
            case 'select':
                return self::select($name, $option, $value);
                break;
            case 'radio':
                return self::radio($name, $option, $value);
                break;
            case 'checkbox':
                return self::checkbox($name, $option, $value);
                break;
            case 'color':
                return self::color($name, $option, $value);
                break;
            case 'upload':
                return self::upload($name, $option, $value);
                break;
            case 'date':
                return self::date($name, $option, $value);
                break;
            case 'character':
                $values = array(
                    'font'  => '',
                    'size'  => '',
                    'unit'  => '',
                    'style' => '',
                    'color' => ''
                );

                if (is_string($value)) {
                    $value = @unserialize($value);
                    if (is_array($value)) {
                        $values = array_merge($values, $value);
                    }
                }
                return self::character($name, $option, $values);
                break;
        }
    }
}