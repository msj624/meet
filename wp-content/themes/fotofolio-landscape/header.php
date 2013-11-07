<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<?php wp_enqueue_script("jquery"); ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/grid.css" type="text/css" />
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
		<?php wp_head(); ?>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/cycle.js"></script>
		<script type="text/javascript">
		var $j = jQuery.noConflict();
		$j(function() {
		    // run the code in the markup!
		    $j('.slideshow').cycle({ 
		    fx: '<?php echo wpop_get_option('slide_fx'); ?>',
		    speed: <?php echo wpop_get_option('slide_speed'); ?>,
		    timeout: <?php echo wpop_get_option('slide_timeout'); ?>,
        next:   '#stagenav-r', 
		    prev:   '#stagenav-l'
			});
		});
		</script>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/fancybox/jquery.mousewheel-3.0.2.pack.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/fancybox/jquery.fancybox-1.3.0.pack.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/js/fancybox/jquery.fancybox-1.3.0.css" media="screen" />
		<script type="text/javascript">
		var $j = jQuery.noConflict();
		$j(document).ready(function() {
			$j("a.full").fancybox({
			  'autoScale': <?php echo wpop_get_option('fancybox_autoscale') ? 'true' : 'false' ?>,
				'titleShow': <?php echo wpop_get_option('fancybox_titleshow') ? 'true' : 'false' ?>,
				'titlePosition': '<?php echo wpop_get_option('fancybox_titleposition') ?>',
				'centerOnScroll': <?php echo wpop_get_option('fancybox_centeronscroll') ? 'true' : 'false' ?>,
				'hideOnContentClick': <?php echo wpop_get_option('fancybox_hideoncontentclick') ? 'true' : 'false' ?>
				});	
			});
		<?php if(wpop_get_option('prevent_rightclick') == "yes"): ?>
			$j(document).bind("contextmenu",function(e){
		        return false;
		    });
        <?php endif; ?>
		</script>
		<!--[if IE 6]>
		<script src="<?php bloginfo('template_url'); ?>/js/belatedpng.js"></script>
		<script>
		  DD_belatedPNG.fix('img, .slideshow, .wordspop a, .testimonial h2, .testimonial p');
		</script>
		<style type="text/css">
			.slideshow, .latest {
				background: none !important;
			}
		</style>
		<![endif]-->
		<?php if (wpop_get_option('favicon')): ?><link rel="shortcut icon" href="<?php echo wpop_get_option('favicon'); ?>" /><?php endif; ?>
	</head>
	<body <?php body_class(); ?>>
	<div class="container container_24"><div class="container2 <?php if(fotofolio_in_category_extended(get_option('fotofolio_blog'))) echo "single-blog"; ?>">