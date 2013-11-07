<?php
/**
 * Display available Wordspop themes
 *
 * @category   Wordspop
 * @package    WPop
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 * @version    $Id:$
 */
function wpop_themes(){
    include_once ABSPATH . WPINC . '/class-feed.php';
    $cache = new WP_Feed_Cache_Transient('', md5(WPOP_FEED_THEMES), '');
    $cache->load();

    $feed = fetch_feed(WPOP_FEED_THEMES);
    $items = $feed->get_items();
?>
<div class="wrap">
<div class="icon32" id="icon-wpop"><br></div>
<h2>Themes by Wordspop</h2>
<table cellspacing="0" cellpadding="0" id="availablethemes">
<tbody>
<?php
$rows = ceil(count($items) / 3);
$k = 0;
?>
  <?php for ($i = 0; $i < $rows; $i++): ?>
<tr>
  <?php for ($j = 0; $j < 3; $j++): ?>
  <?php
    $pos = '';
    if ($k % 3 == 0) {
      $pos = ' left';
    } else if ($k % 3 == 2) {
      $pos = ' right';
    }
  ?>
  <td class="available-theme<?php echo $pos ?>">
    <?php if (isset($items[$k])): ?><?php echo $items[$k]->get_description(); ?><?php else: ?>&nbsp;<?php endif; ?>
  </td>
  <?php $k++; ?>
  <?php endfor; ?>
</tr>
  <?php endfor; ?>
</tbody>
</table>
<br class="clear">
<br class="clear">
</div>
<?php
}
?>
