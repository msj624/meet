<?php
$post_meta = nimbus_get_option('nimbus_post_meta_single');
?>

<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php wp_title('', true); ?></title>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>" />
        <!--[if IE 8 ]>
            <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" />
        <![endif]-->
        <?php 
        wp_head(); 
        ?>
        <!--[if lt IE 9]>
            <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
            <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body <?php body_class(); ?>>
        <div id="header<?php
            if (is_front_page()) {
                echo"_frontpage";
            } ?>">
            <div class="row" >
                <div id="contact_line"  class="span12 center none">
                    <?php 
                    if ((nimbus_get_option('public_email') || nimbus_get_option('public_phone') || nimbus_get_option('public_fax')) != "") { 
                    ?>
                    <div>
                        <ul>
                            <?php 
                            if (nimbus_get_option('public_email') != "") { 
                            ?>
                                <li><a href="mailto:<?php echo nimbus_get_option('public_email') ?>"><?php echo nimbus_get_option('public_email') ?></a></li> 
                            <?php 
                            } 
                            if (nimbus_get_option('public_fax') != "") { 
                            ?>
                                <li>Fax <span><?php echo nimbus_get_option('public_fax') ?></span></li>
                            <?php 
                            }  
                            if (nimbus_get_option('public_phone') != "") { 
                            ?>
                                <li>Call us! <span><?php echo nimbus_get_option('public_phone') ?></span></li>
                            <?php 
                            } 
                            ?>				
                        </ul>
                        <div class="clear"></div>
                    </div>
<?php } ?>
                </div>
            </div>
            <div id="ribbon_wrap">
                <div class="row">
                    <div id="ribbon" class="span12 center none">	
                        <div class="navbar navbar-inverse navbar-fixed-top">
                            <div class="navbar-inner">
                                <div class="container">
                                    <h1 class="text_logo"><a href="<?php get_home_url(); ?>"><?php echo nimbus_get_option('text_logo') ?></a></h1>
                                    <a class="btn btn-navbar" data-toggle="collapse" data-target="#mobile_menu">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </a>
                                    <div class="clear"></div>
                                    <?php 
                                    wp_nav_menu(array('theme_location' => 'mobile', 'menu' => 'Primary Menu', 'depth' => 3, 'menu_class' => 'collapse', 'menu_id' => 'mobile_menu', 'container' => false)); 
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php 
                        get_template_part('parts/logo');
                        wp_nav_menu(array('theme_location' => 'primary', 'menu' => 'Primary Menu', 'depth' => 3, 'menu_id' => 'menu', 'container' => 'div', 'container_class' => 'menu' )); 
                        ?>
                    </div>
                </div>
            </div>
            <?php
            if (is_front_page()) {
                get_template_part('parts/banner');
            } else { 
            ?>    
                <div class="row">
                    <div id="sub_title" class="span12 center none">
                        <?php 
                        get_template_part('parts/title'); 
                        ?> 
                    </div>    
                </div>
            <?php    
            }
            ?>
            <div class="clear"></div>
        </div>
