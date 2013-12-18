<!-- http://183.110.207.46/wp/ upper IE8 Support -->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?php
/**
 * default header template
 */
 get_template_part( 'template/header' );
 global $zAlive_options;
 $container_classes = '';
 $sidebar_layout_classes = '';
 if( $zAlive_options['primary_sidebar_layout'] == 1 ){
   $sidebar_layout_classes = 'content-two-columns';    
 }elseif ( $zAlive_options['primary_sidebar_layout'] == 2 ){
   $container_classes = 'container-sidebar-left';
   $sidebar_layout_classes = 'content-two-columns content-two-columns-sidebar-left';
 }else{
   $sidebar_layout_classes = 'content-full-width';
 }

add_action('login_head', 'wp_hi_res_admin_icons');
add_action('admin_head', 'wp_hi_res_admin_icons');

function wp_hi_res_admin_icons() {
    echo '<link rel="icon" href="/wp-content/themes/' . basename(dirname(__FILE__)) . '/img/icon_32.png" sizes="32x32" />'."\n";
    echo '<link rel="icon" href="/wp-content/themes/' . basename(dirname(__FILE__)) . '/img/icon_48.png" sizes="48x48" />'."\n";
}

?>
  <div id="content" class="container <?php echo $container_classes; ?>">
    <div class="<?php echo $sidebar_layout_classes; ?> clearfix">