<?php
/**
 * WordPress Administration Template Footer
 *
 * @package WordPress
 * @subpackage Administration
 */

// don't load directly
if ( !defined('ABSPATH') )
	die('-1');
?>

<div class="clear"></div></div><!-- wpbody-content -->

<?php
/**
 * Print scripts or data before the default footer scripts.
 *
 * @since 1.2.0
 * @param string The data to print.
 */
do_action('admin_footer', '');

/**
 * Prints any scripts and data queued for the footer.
 *
 * @since 2.8.0
 */
do_action('admin_print_footer_scripts');

/**
 * Print scripts or data after the default footer scripts.
 *
 * @since 2.8.0
 *
 * @param string $GLOBALS['hook_suffix'] The current admin page.
 */
do_action("admin_footer-" . $GLOBALS['hook_suffix']);

// get_site_option() won't exist when auto upgrading from <= 2.7
if ( function_exists('get_site_option') ) {
	if ( false === get_site_option('can_compress_scripts') )
		compression_test();
}

?>

<div class="clear"></div></div><!-- wpwrap -->
<script type="text/javascript">if(typeof wpOnload=='function')wpOnload();</script>
</body>
</html>
