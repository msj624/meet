<?php
/**
 * Display theme options page
 *
 * @category   Wordspop
 * @package    WPop
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 * @version    $Id:$
 */
function wpop_theme_settings(WPop_Theme $theme) {
    // Works out on the options to collect the headings
    $headings = array();
    $options = $theme->options();
    foreach($options as $option) {
        if ($option['type'] == 'heading') {
            $headings[$option['name']] = array(
                'title' => $option['title'],
                'icon'  => $option['icon']
            );
        }
    }

    // Load the WPop_Form
    require_once 'wpop_form.php';
?>
<div id="wpop_container" class="wrap">
  <div id="wpop_dummy_post" style="display: none; visibility: hidden;"><?php echo WPop::getDummyPost(); ?></div>
  <form id="wpop_theme_form" enctype="multipart/form-data" method="post" action="options.php">
    <?php settings_fields('wpop_theme_options') ?> 
    <div id="wpop_body">
      <!-- sidebar -->
      <div id="wpop_sidebar">
        <div id="wpop_logo">
          <h2>Wordspop</h2>
          <p>Framework <?php echo WPOP_VERSION; ?></p>
        </div>
        <div id="wpop_nav">
          <ul>
            <?php foreach($headings as $name => $info): ?>
            <li id="wpop_nav_<?php echo $name; ?>" class="<?php echo $info['icon']; ?>"><a href="#wpop_options_<?php echo $name; ?>"><span><?php echo wp_specialchars($info['title']); ?></span></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <!-- end sidebar -->
      <!-- main layout -->
      <div id="wpop_main">
        <div id="wpop_main_inner">
          <?php if ($theme->notification()): ?><div id="wpop_notification"><?php echo $theme->notification(); ?></div><?php endif; ?>
          <div id="wpop_message" class="wpop_message" style="display: none;">&nbsp;</div>
          <!-- header -->
          <div id="wpop_header">
            <div id="wpop_theme_info">
              <h2><?php echo $theme->name(); ?></h2>
              <p><?php echo __('Version', 'wpop') . ' ' . $theme->version(); ?></p>
              <div class="clear"></div>
            </div>
           <div id="wpop_menu">
              <div id="wpop_support">
                <ul>
                  <li><a href="http://docs.wordspop.com/<?php echo $theme->slug(); ?>/changelog#<?php echo $theme->version(); ?>" target="_blank" title="<?php _e('View theme changelog', 'wpop'); ?>"><?php _e('Changelog', 'wpop'); ?></a></li>
                  <li><a href="http://docs.wordspop.com/<?php echo $theme->slug(); ?>" target="_blank" title="<?php _e('View theme documentation', 'wpop'); ?>"><?php _e('Documentation', 'wpop'); ?></a></li>
                  <li><a href="http://forum.wordspop.com/" target="_blank" title="<?php _e('Visit the Wordspop support forum', 'wpop'); ?>"><?php _e('Support Forum', 'wpop'); ?></a></li>
                </ul>
              </div>
              <div id="wpop_submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Changes'); ?>">
              </div>
              <div class="clear"></div>
            </div>
          </div>
          <!-- end header -->
          <!-- content -->
          <div id="wpop_content">

            <?php $heading = 0; ?>
            <?php foreach($options as $i => $option): ?>
              <?php if ($option['type'] == 'heading'): // hits the heading ?>

                <?php if ($heading > 0): // close if heading greater than zero ?>
            </div>
            <!-- end group -->
                <?php endif; ?>

            <!-- start group -->
            <div id="wpop_options_<?php echo $option['name'] ?>" class="group">
            <?php if (!empty($option['desc'])): ?><p class="group_desc"><?php _e($option['desc'], 'wpop'); ?></p><?php endif; ?>
                <?php $heading++; ?>

              <?php else: // hits the input option ?>
              <div class="section section_<?php echo $option['type']; ?>">
                <h3><?php echo wp_specialchars($option['title']); ?></h3>
                <div class="option">
                  <div class="input"><?php echo WPop_Form::input("wpop_theme_{$option['name']}", $option); ?></div>
                  <?php if ($option['type'] != 'checkbox'): // skip this for checkbox ?>
                  <div class="desc"><?php echo $option['desc']; ?></div>
                  <?php endif; ?>
                  <div class="clear"></div>
                </div>
              </div>
              <?php endif; ?>

              <?php if ($i == count($options) - 1): // close the heading on the last option ?>
            </div>
            <!-- end group -->
              <?php endif; ?>

            <?php endforeach; ?>

          </div>
          <!-- end content -->
        </div>
        <!-- end main inner -->
      </div>
      <!-- end main layout -->
      <div class="clear"></div>
    </div>
    <!-- end body -->
    <!-- bottom -->
    <div id="wpop_bottom">
      <div id="wpop_bottom_left">&nbsp;</div>
      <div id="wpop_bottom_right">
        <p><input type="submit" class="button-primary" value="<?php _e('Save Changes'); ?>"></p>
      </div>
      <div id="wpop_footer">
        <?php if ($theme->notice()): ?><p id="wpop_theme_notice"><?php _e($theme->notice()) ?></p><?php endif; ?>
        <p id="wpop_copy">&copy; 2011 Wordspop. All rights reserved.</p>
      </div>
      <div class="clear"></div>
    </div>
    <!-- end bottom -->
  </form>
</div>
<?php
}
?>